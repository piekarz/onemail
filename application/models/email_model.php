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
    var $port;

    
    function __construct()
    {
        parent::__construct();
    }
    function insert_email($idemail, $iduserfk, $memail, $mpassword, $lastemaildate,$port){
        $this->idemail=$idemail;
        $this->iduserfk=$iduserfk;
        $this->memail=$memail;
        $this->mpassword=$mpassword;
        $this->lastemaildate=$lastemaildate;
        $this->port=$port;
        $this->db->insert('email', $this);
    }
    function update_email($array,$id){
         $this->db->where('idemail', $id);
         $this->db->update('email', $array); 
    }
}