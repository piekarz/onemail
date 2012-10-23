<?php 

/**
 * Description of user_model
 * This is model for user table
 * @author Piekarz
 */

class User_model extends CI_Model {

    //User table data
    var     $iduser;
    var     $login;
    var     $password;
    var     $email;
    var     $lang;
    var     $regdate;
    var     $session;
    var     $active;
    var     $lastip;
    var     $passwordkey;
    
    function __construct()
    {
        parent::__construct();
    }
    /*
     * This method show last 5 new users
     */
    function get_last_ten_users()
    {
        $query = $this->db->get('user', 10);
        return $query->result();
    }
    /*
     * This search user by conditions
     */
    function get_user_where($where){
        $this->db->where($where);
        $query = $this->db->get('user');
        return $query->result();
    }
    /*
     * This methot search user by id
     */
    function get_user_by_id($id){
        $this->db->where(array('iduser'=>$id));
        $query = $this->db->get('user');
        return $query->result();
    }
    
    function insert_user($login, $password, $email, $lang, $session, $active, $lastip)
    {
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->lang = $lang;
        $this->session = $session;
        $this->active = $active;
        $this->lastip = $lastip;
        $this->passwordkey=generateRandomKey();
        //Insert
        $this->db->insert('user', $this);
    }
    /*
     * This method update information about user
     */
    function update_user($login, $password, $email, $lang, $session, $active, $lastip)
    {
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->lang = $lang;
        $this->session = $session;
        $this->active = $active;
        $this->lastip = $lastip;
        //Update
        $this->db->update('user', $this, $iduser);
    }
    /**
     * This method check if user exist in db with that $login and hash $password
     * @param type $login
     * @param type $password 
     */
    function check_user($login, $password){
        $this->db->where(array('login'=>$login, 'password'=>$password));
        $query = $this->db->get('user');
        if ( count($query->result()) == 1) return true; 
        return false; 
    }
    
    function getonequery($query){
            foreach($query->result() as $q){
            $this->iduser = $q->iduser;
            break;
        }
    }
}
