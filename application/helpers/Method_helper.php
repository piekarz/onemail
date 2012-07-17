<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Method_helper
 *
 * @author Piekarz
 */
class Method_helper {

    public function load_Lang($lang){
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

