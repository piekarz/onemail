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
            $this->load->model('Email_model');
            //Check if session exist and when exist check if user is logged in or not
            if(!$this->session->userdata('logged_in')) redirect(base_url());
            //Load email list from database and save in session
            $emails = new Email_model();
            $getem=$emails->get_all_email($this->session->userdata('iduser'));
            if($getem!=null){
                if(is_array($getem))
                    foreach($getem as $email){
                        $tab[$email->idemail]=$email->memail;
                    }
                else $tab[$getem->idemail]=$email->memail;
                $this->session->set_userdata('emails',$tab);
                }else{
                    $tab=null;
                    $this->session->set_userdata('emails',$tab);
                }
        }
	
        public function index()
	{
                $this->mode='index';
                $data['mode']=$this->mode;
                $data['header']=lang('mailbox');
		$this->load->view("main_view",$data);
	}
        public function mailbox($page=1){
            $this->mode='mailbox';
//            $mailLib = new MailLib(); 
//            $mailLib->connect('pppiekarz@gmail.com','ppp72301849','imap.gmail.com','993');
            $emailRow=$this->session->userdata('emaildb');
            $this->maillib->connect($emailRow->memail,$emailRow->mpassword,$emailRow->imapserv,$emailRow->portimap);
            $tabemail=$this->maillib->getHeadersList($page);
            $data['emails']=$tabemail;
            $data['mode']=$this->mode;
            $data['header']=lang('mailbox');
            $this->load->view("main_view", $data);
        }
}
