<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Settings extends CI_Controller {
    var $emailModel;
    var $userModel;
    public function __construct() {
            parent::__construct();
            $langtemp = $this->session->userdata('lang');
            $this->language = loadLang($langtemp);
            $this->lang->load('welcome',$this->language);
            $this->lang->load('menu',$this->language);
            $this->lang->load('login',$this->language);
            $this->lang->load('global',$this->language);
            $this->load->model('User_model');
            $this->load->model('Email_model');
            $this->load->file('ajaxfw.php');
            if(isset($_SESSION['username'])) sessionDataAdd($this->session);
            if(!$this->session->userdata('logged_in')) redirect(base_url());
            $this->emailModel = new Email_model();
            $this->userModel = new User_model();
        }
	public function index()
	{       
            $data['header']=lang('settings');
            $data['mode']='index';
            $user=$this->userModel->get_user_where(array('login'=>$this->session->userdata('username')));
            $tabEmail=$this->emailModel->get_all_email($user[0]->iduser);
            if($tabEmail==null) $data['accemails']=false;
            else {
                $data['accemails']=$tabEmail;
            }
            $this->load->view("settings_view",$data);
	}
        public function add(){
            $data['mode']='add';
            $data['header']=lang('settings');
            if(isset($_POST)){
                $user=$userModel->get_user_where(array('login'=>$this->session->userdata('username')));
                
            }
            $this->load->view("settings_view",$data);
        }
        
}

