<?php

/**
 * Description of base_model
 * This is a model for base table.
 * @author Piekarz
 */
class Base_model extends CI_Model {
    
    var     $idbase;
    var     $iduser;
    var     $name;
    var     $coord;
    
    function __construct()
    {
        parent::__construct();
    }
    
    function insert_base($iduser,$name,$coord){
        $this->iduser = $iduser;
        $this->name = $name;
        $this->coord = $coord;
        $this->db->insert('base', $this);
    }
}

