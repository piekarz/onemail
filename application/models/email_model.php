<?php 

/**
 * Description of user_model
 * This is model for email table
 * @author Piekarz
 */

class Email_model extends CI_Model {

    //Email table data
    var $idemail;
    var $iduserfk;
    var $memail;
    var $mpassword;
    var $lastemaildate;
    var $portimap;
    var $portsmtp;
    var $imapserv;
    var $smtpserv;
    var $imapssl;
    var $smtpssl;

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();
    }
    /**
     * Insert new email in database
     * @param type $iduserfk
     * @param type $memail
     * @param type $mpassword
     * @param type $portimap
     * @param type $portsmtp
     * @param type $imapserv
     * @param type $smtpserv
     * @param type $imapssl
     * @param type $smtpssl 
     */
    function insert_email($iduserfk, $memail, $mpassword, $portimap, $portsmtp, $imapserv, $smtpserv, $imapssl, $smtpssl){
        $this->db->insert('email', array('iduserfk'=>$iduserfk, 
                                         'memail'=>$memail,
                                         'mpassword'=>$mpassword,
                                         'portimap'=>$portimap,
                                         'portsmtp'=>$portsmtp, 
                                         'imapserv'=>$imapserv, 
                                         'smtpserv'=>$smtpserv, 
                                         'imapssl'=>$imapssl, 
                                         'smtpssl'=>$smtpssl));
    }
    /**
     * Update email
     * @param type $array
     * @param type $id 
     */
    function update_email($array,$id){
         $this->db->where('idemail', $id);
         $this->db->update('email', $array); 
    }
    /**
     * Get all emails from database by user id
     * @param type $iduserfk
     * @return type 
     */
    function get_all_email($iduserfk){
        $query = $this->db->get_where('email', array('iduserfk'=>$iduserfk));
        $i=0;
        if($query->num_rows() > 1){
            foreach($query->result() as $row){
                $tab[$i]=$row;
                $i++;
            } 
            return $tab;
        }elseif($query->num_rows()==1){
            return $query->result();
        }
        else return null;
    }
    /**
     * Get email where 'condition'
     * @param type $where
     * @return type 
     */
    function get_email_where($where){
        $query = $this->db->get_where('email',$where);
        return $query->result();
    }
    /**
     * Delete choosen email by email id
     * @param type $idemail 
     */
    function delete_email($idemail){
        $query = $this->db->delete('email', array('idemail'=>$idemail));
    }
}