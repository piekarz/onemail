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

    
    function __construct()
    {
        parent::__construct();
    }
    function insert_email($idemail, $iduserfk, $memail, $mpassword, $portimap,$portsmtp, $imapserv, $smtpserv){
        $this->db->insert('email', array('iduserfk'=>$iduserfk, 'memail'=>$memail, 'mpassword'=>$mpassword,'portimap'=>$portimap,'portsmtp'=>$portsmtp, 'imapserv'=>$imapserv, 'smtpserv'=>$smtpserv));
    }
    function update_email($array,$id){
         $this->db->where('idemail', $id);
         $this->db->update('email', $array); 
    }
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
}