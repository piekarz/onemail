<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Settings extends CI_Controller {
    var $mode;
    public function __construct() {
            parent::__construct();
            $langtemp = $this->session->userdata('lang');
            $this->language = loadLang($langtemp);
            $this->lang->load('welcome',$this->language);
            $this->lang->load('menu',$this->language);
            $this->lang->load('login',$this->language);
            $this->lang->load('global',$this->language);
            $this->load->model('User_model');
            $this->load->file('ajaxfw.php');
            if(isset($_SESSION['username'])) sessionDataAdd($this->session);
            if(!$this->session->userdata('logged_in')) redirect(base_url());
        }
	public function index()
	{       
            
            $this->load->view("settings_view");
	}
        
}

