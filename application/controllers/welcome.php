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
            $this->load->file('ajaxfw.php');
            $this->session->set_userdata(getsessiondata());
        }
	public function index()
	{
                //$this->User_model->insert_user('test','hastpassworda','email@email.com','en','123123123123','1','127.0.0.1');
                $data['header'] = lang("global_header");
		$this->load->view("welcome_view",$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */