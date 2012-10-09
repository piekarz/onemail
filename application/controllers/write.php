<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Write extends CI_Controller {
    var $data;
    public function __construct() {
            parent::__construct();
            $langtemp = $this->session->userdata('lang');
            $this->language = loadLang($langtemp);
            $this->lang->load('welcome',$this->language);
            $this->lang->load('menu',$this->language);
            $this->lang->load('login',$this->language);
            $this->lang->load('global',$this->language);
            $this->load->model('User_model');
            if(!$this->session->userdata('logged_in')) redirect(base_url());
            $this->data['header']=lang('write');
            //print_r($this->session->all_userdata());
        }
	public function index()
	{       
                
                if(''!=$this->session->userdata('selectedemail')){
                    $this->data['selectedemail']=true;
                    $this->data['email']=$this->session->userdata('emaildb');
                }else
                   $this->data['selectedemail']=false; 
                $this->load->view("write_view",$this->data);
	}
        
}

