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

