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
if ( ! function_exists('langLess'))
{
	function langLess($lang)
	{
            switch($lang){
                case 'polish': 
                    return "pl";
                    break;
                case 'english':
                    return "en";
                    break;
                default: 
                    return "pl";
                    break;
                }
	}
}
if ( ! function_exists('langList'))
{
	function langList()
	{
            $langlist=array(0=>'pl',
                            1=>'en');
            return $langlist;
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
                '±','Ľ','ˇ','¶','¦','¬','Ĺ›','Ä‡','Ĺ‚','Ä…','Ăł','Ä™'
            );
            $arrayGood = array(
                'ą','ł','Ą','ś','Ś','Ł','ś','ć','ł','ą','ó','ę'
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

if ( ! function_exists('transformHtmlTags')){
    
    function transformHtmlTags($text){
        //$tagsDelete = 'style|STYLE|class|CLASS|align|ALIGN';
        //$delete = '/([\s]+)('.$tagsDelete.')([\s]*)=([\s]*)(("|\')([^"\']+)("|\')|([^>"\']+))*/';
        $allowable_tags='<p><span><br><img><a><style>';
        //$text = preg_replace($delete, '', $text);
        $text = preg_replace('/(?<!\")(http(s)?:\/\/\S+)(?=\n)/', '<a href="$1" target="_blank">$1</a>', $text);
        $arrayDelete = array('<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2" />','<head>','</head>','<html>','</html>','<body>','</body>','body','<HEAD>','</HEAD>','<HTML>','</HTML>','<BODY>','</BODY>');
        //$text = str_replace($arrayDelete, '', $text);
        
        //Repair links by adding _blank atribute ;]
        $text=str_replace('href="', ' target="_blank" href="', $text);
        return$text;// strip_tags($text, $allowable_tags);
    }
}


/*
 * Functions for crypt data
 */

//Salt for user passwords
if ( ! function_exists('getPasswordSalt')){
    
        function getPasswordSalt()
        {
            return'96b3f8d0ea77a6f309598cf06f7a03ff81b9811aa9779bc6adec943d7739ffd6';
        }
}

//Random Keys generate
if ( ! function_exists('generateRandomKey')){
    
        function generateRandomKey()
        {
            $alphas = array_merge(range('A', 'Z'), range('a', 'z'));
            $random='';
            for($i=32;$i!=0;$i--){
                $random=$random.$alphas[rand(0, ( count( $alphas ) - 1 ) )];
            }
            return md5($random);
        }
}

//Encrypt data
if ( ! function_exists('encrypt')){
    
        function encrypt($key,$data)
        {
            return mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $data, MCRYPT_MODE_ECB);
        }
}

//Decrypt data
if ( ! function_exists('decrypt')){
    
        function decrypt($key, $data)
        {
            return mcrypt_decrypt ( MCRYPT_RIJNDAEL_256, $key , $data , MCRYPT_MODE_ECB);
        }
}