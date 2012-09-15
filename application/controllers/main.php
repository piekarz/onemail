<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Main extends CI_Controller {
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
                $this->mode='index';
                $data['mode']=$this->mode;
		$this->load->view("main_view",$data);
	}
        public function mailbox(){
            $this->mode='mailbox';
            $mailLib = new MailLib(); 
            $mailLib->connect('pppiekarz@wp.pl','chlebek1','imap.wp.pl','993');
//            $emails=$mailLib->getMails(false, 30, 'DESC');
//            $i=0;
            $tabemail=$mailLib->getHeadersList(2);
//            foreach($emails as $mail){
//                $tabemail[$i]=$mailLib->getMail($mail);
//                $i++;
//            }
            $data['emails']=$tabemail;
            $data['mode']=$this->mode;
            $this->load->view("main_view", $data);
        }
}
