<?php 

/**
 * Description of user_model
 * This is model for user. Join 2 tables: user, playerinfo
 * @author Piekarz
 */

require_once APPPATH.'models/playerinfo_model.php';

class User_model extends CI_Model {

    //User table data
    var     $iduser;
    var     $login;
    var     $password;
    var     $email;
    var     $lang;
    var     $regdate;
    var     $idrolefk;
    var     $session;
    var     $active;
    var     $lastip;
    
    function __construct()
    {
        parent::__construct();
    }
    /*
     * This method show last 5 new users
     */
    function get_last_ten_users()
    {
        $query = $this->db->get('user', 5);
        return $query->result();
    }
    /*
     * This method create new user
     */
    function insert_user($login, $password, $email, $lang, $session, $active, $lastip)
    {
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->lang = $lang;
        $this->idrolefk = 3;
        $this->session = $session;
        $this->active = $active;
        $this->lastip = $lastip;
        //Insert
        $this->db->insert('user', $this);
        $playerinfo = new playerinfo_model();
        $this->db->select('iduser');
        $this->db->where('login',$this->login);
        $query = $this->db->get('user');

        $playerinfo->insert_playerinfo($this->iduser);
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
    function getonequery($query){
            foreach($query->result() as $q){
            $this->iduser = $q->iduser;
            break;
        }
    }
}
