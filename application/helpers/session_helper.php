<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function getsessiondata(){
$sessiondata = array(
                   'username'  => '',
                   'logged_in' => FALSE
               );

return $sessiondata;
}
