<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
        var $language;
        var $data;
        public function __construct() {
            $langtemp = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
            parent::__construct();
            $this->language = loadLang($langtemp);
            $this->lang->load('welcome',$this->language);
            $this->lang->load('menu',$this->language);
            $this->lang->load('login',$this->language);
            $this->lang->load('global',$this->language);
            $this->load->model('User_model');
            $this->load->file('ajaxfw.php');
            $this->data['header'] = lang("global_header");
            $this->data['baddata'] ='';
            if(isset($_SESSION['username'])) sessionDataAdd($this->session);
        }
        /**
         * Default action in login page
         */
        public function index()
	{
            if($this->session->userdata('logged_in')) redirect(base_url());
            $this->load->view("login_view",$this->data);
	}
        /**
         * When form data will send then try to login
         */
        public function send()
        {
            if($this->session->userdata('logged_in')) redirect(base_url());
            if($this->User_model->check_user($_POST['username'],  sha1($_POST['password']) )){ 
                $this->session->set_userdata('username', $_POST['username']);
                $this->session->set_userdata('logged_in',TRUE);
                redirect(base_url());
            }else{
                $this->data['baddata'] = lang('baddata');
            }
            $this->load->view("login_view",$this->data);
        }
        /**
         * Logout function
         */
        public function logout()
        {
            $this->session->sess_destroy();
            redirect(base_url());
        }
}