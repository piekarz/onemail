<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if ( ! function_exists('loadLang'))
{
	function loadLang($lang)
	{
            switch($lang){
                case 'pl': 
                    return "polish";
                    break;
                case 'en':
                    return "english";
                    break;
                default: 
                    return "polish";
                    break;
                }
	}
}

if ( ! function_exists('sessionDataAdd')){
    
    function sessionDataAdd(){
        $newdata = array(
                   'lang' => '',
                   'username'  => '',
                   'logged_in' => FALSE,
                   'selectedemail'=>''
               );
        return $newdata;
    }
}
if ( ! function_exists('getDataOfOneRow')){
    
    function getDataOfOneRow($result){
        foreach($result as $row) return $row;
    }   
}
if ( ! function_exists('removeBadChar')){
    
        function removeBadChar($string){
            $arrayBad = array(
                '±','Ľ','ˇ','¶','¦','¬'
            );
            $arrayGood = array(
                'ą','ł','Ą','ś','Ś','Ł'
            );
            return str_replace($arrayBad, $arrayGood, $string);
        }
}

if ( ! function_exists('detect_ie')){
    
        function detect_ie()
        {
            if (isset($_SERVER['HTTP_USER_AGENT']) && 
            (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false))
                return true;
            else
                return false;
        }
}