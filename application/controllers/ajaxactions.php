<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajaxactions extends CI_Controller {
        public function __construct() {
            $langtemp = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
            parent::__construct();
            $this->language = loadLang($langtemp);
            $this->lang->load('welcome',$this->language);
            $this->lang->load('menu',$this->language);
            $this->lang->load('global',$this->language);
            $this->load->model('Email_model');
            if(FALSE==$this->session->userdata('lang')) $this->session->set_userdata(sessionDataAdd());
        }
	public function index()
	{
            redirect(base_url());
	}
        public function post_ajax(){
            if(!$this->session->userdata('logged_in')) redirect(base_url()); 
            if(isset($_POST['email'])){
                if(substr_count($_POST['email'],'@')==1)
                $this->session->set_userdata('selectedemail',$_POST['email']);
                redirect(base_url($_POST['uri']));
            }else{
                redirect(base_url($_POST['uri']));
            }
            redirect(base_url('main'));
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */