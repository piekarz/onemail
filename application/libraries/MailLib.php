<?php 
/**
* @file     Mail Library
* 
* @author   Hristo Georigev
* @editedby Przemysław Piekarski
* @company  42soft ltd
* @email    h.georgiev@hotmail.com 
* @license  check LICENSE.txt
*/   
class MailLib  { 
    
    public $inbox;
    public $emails;
    public $header;
    
    function __construct(){
        $this->CI =& get_instance(); // needed for CodeIgniter
    }
    
    /**
    * connect
    * 
    * @access   public
    * @param    string  $username
    * @param    string  $password
    * @param    string  $server
    * @param    int     $port
    * @param    true    $ssl
    * @return   void
    */
    function connect($username, $password, $server, $port, $ssl){
        $this->username = $username;
        $ssl = ($ssl == 'ssl') ? "/ssl" : '';
        $hostname = "{" . $server . ":" .$port . "/imap" . $ssl ."}INBOX"; 
        
		/*
		 * Should produce something like this: 
         * $hostname = "{imap.google.com:993/imap/ssl}INBOX"; 
         * /novalidate-cert ( maybe you would like to add this)
		 */
        
             
            $this->inbox = @imap_open($hostname,$username,$password);
            if(false!=imap_errors()){ 
                imap_alerts();
                return false;}
                
            return (bool)$this->inbox;
    }
    function close(){
        imap_close($this->inbox);
        return (bool)$this->inbox;
    }
    
    
    /**
    * getMails
    * 
    * @access   public
    * @param    string      $type   (which mails to be retrieved)
    * @param    mixed       $limit  
    * @param    string      int
    * @return   voi
    */
    function getMails($type = false, $limit = null, $order='DESC'){
        if(!$this->inbox){
            throw new Exception('No IMAP connection established');
        }
        
        if($type == false){
            $type = 'ALL';
        }
        
        $this->emails = null;
        $emails = imap_search($this->inbox, $type); 
        
        if( strtoupper($order) == "DESC"){
            rsort($emails);
        } 
    
        
        if($limit != null){
            /* last|first X emails */
            if((int)$limit !== 0 && !is_array($limit)){
                $count = 0;
                foreach($emails as $k=>$i){
                    if($count <= $limit){
                        $this->emails[$k] = $i;
                    } else {
                        break;
                    }
                    $count++;    
                }
            }
            
            /* limit between X and Y */
            if(is_array($limit)){
                $start = current(array_keys($limit));
                $end = current($limit);
                foreach($emails as $k=>$i){
                    if($k >$start && $k <= $end){
                        $this->emails[$k] = $i;
                    }
                }
            }
        } else {
            /* all emails */
            $this->emails = $emails;          
        }
        return $this->emails;
    }
    function numberOfPages(){
        $numbermsg=imap_num_msg($this->inbox);
        if(($numbermsg%20) > 0)
            return ceil($numbermsg/20);
        else 
            return round($numbermsg/20);
    }
    
     /**
     * getMail
     * 
     * @access  public
     * @param   int  $email_id
     * @return  array
     */
    function getMail($email_id){
        
        if ($email_id>imap_num_msg($this->inbox) OR $email_id<1) return false;
        $header = $this->getHeader($email_id);
        if(empty($header)){
            throw new Exception('Cannot retrieve header');
        }
     

        $email = array();
        $email['id'] = $email_id;
        $email['sender'] = $this->getSender($header);
        $email['recipient'] = $this->getRecipient();
        $email['subject'] = $this->getSubject($header);
        $email['date'] = $header->udate;
        $email['body'] = $this->getBody($email_id);
        $email['attachments']= $this->getAttachments($email_id);
     
        return $email;
    }
    
    function getHeadersList($page){
        $how=ceil(imap_num_msg($this->inbox)/20);
        if($page>$how OR $page<1) return false;
        
        $number=$page*20;
        $endnumber=$number-20;
        $a=0+$endnumber;
        $emails=$this->getMails();
        for ($i=$number; $i>$endnumber; $i--){ 
            if(!isset($emails[$a]))break;
            $aheader=$this->getHeader($emails[$a]);
            $header[$a]['id']=$emails[$a];
            $header[$a]['sender']=$this->getSender($aheader);
            $header[$a]['unread']=$this->getUnread($aheader);
            $header[$a]['subject']=$this->getSubject($aheader);
            $header[$a]['date']=$aheader->udate;
            $a++;
        }
        
        return $header;
    }
    private function getUnread($header){
        if($header->Unseen == 'U')
            return true;
        if($header->Recent == 'N')
            return true;
        return false;
    }
    /**
    * getOverview
    * 
    * @access   public
    * @param    resource     $inbox
    * @param    int          $email_id
    * @return   void
    */
    function getOverview($inbox, $email_id){
         $overview = imap_fetch_overview($inbox, $email_id, 0);    
         return $overview;
    }
    
    
    /**
    * getHeader
    * 
    * @access   private
    * @param    int      $email_id
    * @return   object
    */
    private function getHeader($email_id){
        $header = imap_headerinfo($this->inbox, $email_id);
        return $header;
    }
    
    
    /**
    * getSender
    * 
    * @access   private
    * @param    object   $header
    * @return   string
    */
    private function getSender($header){
        
        $mailbox = $header->from[0]->mailbox;
        $host = $header->from[0]->host;
        $sender = $mailbox . "@" . $host;
        return $sender;
    }
    
    
    /**
    * getRecipient
    * 
    * @access   private
    * @param    void
    * @return   string
    */
    private function getRecipient(){
        $recipient = $this->username;
        return $recipient;
    }
    
    
    /**
    * getSubject
    * 
    * @access   public
    * @param    object      $header
    * @return   string
    */
    private function getSubject($header){
        if(isset($header->subject)){
            $subject = $header->subject;
            $subject = imap_mime_header_decode($subject);
        
        
            if(!empty($subject)){
                $encoding = $subject[0]->charset;
                if($encoding == "default"){  // i have no idea why 
                    $encoding = "US-ASCII";
                }
                $text='';
                foreach($subject as $sub)
                $text = $text.$sub->text;
                $subject_text = iconv($encoding, 'UTF-8//IGNORE', $text);
                return $subject_text;    
            }
        }
        
    }
    
    
    /**
    * getBody
    * 
    * @access   private
    * @param    int      $email_id
    * @return   string
    */
    private function getBody($email_id){
        $structure = imap_fetchstructure($this->inbox, $email_id);  
        
        $txt = $this->get_part($this->inbox, $email_id, 'TEXT/PLAIN');
        $html = $this->get_part($this->inbox, $email_id, 'TEXT/HTML');
        
        if($html != ""){
            $body = $html;
        } else {
            $body = str_replace("\n", '<br />', $txt); 
        }
        

        return $body;
    }
    
    
    /**
    * getAttachments
    * @author Kevin Steffer
    * http://www.linuxscope.net/articles/mailAttachmentsPHP.html
    * slightly modified
    * 
    * @access   private
    * @param    int      $email_id
    * @return   array
    */
    private function getAttachments($email_id){
        $struct = imap_fetchstructure($this->inbox, $email_id);
        $contentParts = isset($struct->parts) ? count($struct->parts) : 0;

        if ($contentParts >= 2) {
            for ($i=2;$i<=$contentParts;$i++) {
                $att[$i-2] = imap_bodystruct($this->inbox, $email_id, $i);
            }
            for ($k=0;$k<sizeof($att);$k++) {
                if(is_array($att[$k]->parameters)){
                if ($att[$k]->parameters[0]->value == "us-ascii" || $att[$k]->parameters[0]->value    == "US-ASCII") {
                    //It generate bugg for some emails if I didn't use this two "ifs":
                    if(is_array($att[$k]))
                    if(is_object($att[$k]->parameters[1]))
                    //End of two "ifs"
                    if ($att[$k]->parameters[1]->value != "") {
                        $selectBoxDisplay[$k] = $att[$k]->parameters[1]->value;
                    }
                } elseif ($att[$k]->parameters[0]->value != "iso-8859-1" && $att[$k]->parameters[0]->value != "ISO-8859-1") {
                    $selectBoxDisplay[$k] = $att[$k]->parameters[0]->value;
                }
                }
            }
        }
        
        
        if(isset($selectBoxDisplay)){
            return $selectBoxDisplay;
        }
        return false;
    }
    
    
    /**
    * getAttachment
    * 
    * @access   public
    * @param    string   $file
    * @param    string   $type
    * @param    int      $email_id
    * @return   res
    */
    public function getAttachment($file, $email_id){
        
        // get in which part of the mail is the required attachment
        $struct = imap_fetchstructure($this->inbox, $email_id);
        $attachment_part = null;
        foreach($struct->parts as $part_id => $p){
            if(isset($p->parameters[0]->value) && $p->parameters[0]->value == $file){
                $attachment_part = $part_id + 1;
            }
        }
        if($attachment_part == null){
            return false;
        }
        
        
        // get attached file
        $att = imap_fetchbody($this->inbox, $email_id, $attachment_part);
        $att = base64_decode($att);
        return $att;
    }
    
    /**
    * get_mime_type
    * @author Kevin Steffer
    * http://www.linuxscope.net/articles/mailAttachmentsPHP.html
    * 
    * @access   private
    * @param    resource    $structure
    * @return   string
    */
    private function get_mime_type(&$structure) {
        $primary_mime_type = array("TEXT", "MULTIPART","MESSAGE", "APPLICATION", "AUDIO","IMAGE", "VIDEO", "OTHER");
        if($structure->subtype) {
           return $primary_mime_type[(int) $structure->type] . '/' .$structure->subtype;
        }
        return "TEXT/PLAIN";
    }
    
    
    /**
    * get_part
    * @author Kevin Steffer
    * http://www.linuxscope.net/articles/mailAttachmentsPHP.html
    * 
    * @access   private
    * @param    resource     $stream
    * @param    int          $msg_number
    * @param    mixed        $mime_type
    * @param    resource     $structure
    * @param    int          $part_number
    */
    private function get_part($stream, $msg_number, $mime_type, $structure = false, $part_number    = false) {
   
       if(!$structure) {
           $structure = imap_fetchstructure($stream, $msg_number);
       }
       if($structure) {
           if($mime_type == $this->get_mime_type($structure)) {
               if(!$part_number) {
                   $part_number = "1";
               }
               $text = imap_fetchbody($stream, $msg_number, $part_number);
               if($structure->encoding == 3) {
                   return imap_base64($text);
               } else if($structure->encoding == 4) {
                   return imap_qprint($text);
               } else {
               return $text;
           }
       }
   
        $prefix = '';
        if($structure->type == 1) /* multipart */ {
               while(list($index, $sub_structure) = each($structure->parts)) {
                   if($part_number) {
                       $prefix = $part_number . '.';
                   }
                   $data = $this->get_part($stream, $msg_number, $mime_type, $sub_structure,$prefix .    ($index + 1));
                   if($data) {
                       return $data;
                   }
               } // END OF WHILE
           } // END OF MULTIPART
       } // END OF STRUTURE
       return false;
   } // END OF FUNCTION

    
}  