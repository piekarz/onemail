<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
        var $language;
        public function __construct() {
            $langtemp = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
            parent::__construct();
            $this->language = loadLang($langtemp);
            $this->lang->load('welcome',$this->language);
            $this->lang->load('menu',$this->language);
            $this->lang->load('global',$this->language);
            $this->load->model('User_model');
            if(FALSE==$this->session->userdata('lang')) $this->session->set_userdata(sessionDataAdd());
        }
	public function index()
	{
            if($this->session->userdata('logged_in')) redirect(base_url('main'));    
            $data['header'] = lang("global_header");
            $this->load->view("welcome_view",$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */