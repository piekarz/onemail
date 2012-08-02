<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of playerinfo_model
 *
 * @author Piekarz
 */
class playerinfo_model extends CI_Model {
    
    var     $idplayerinfo;
    var     $score;
    var     $alliance;
    
    function __construct() {
        parent::__construct();
    }
    function insert_playerinfo($id){
        $this->idplayerinfo = $id;
        $this->score = 0;
        $this->alliance = 0;
        $this->db->insert('playerinfo',$this);
    }
}
