<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Main extends CI_Controller {
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
                $data['mode']='index';
                $data['header']=lang('mailbox');
		$this->load->view("main_view",$data);
	}
        public function mailbox($page=1){
            $data['mode']='mailbox';
            $data['header']=lang('mailbox');
            $data['thispage']=$page;
            if($this->session->userdata('selectedemail')!==''){
            //get email and decrypt password
                    $emailModel = new Email_model();
                    $email = $emailModel->get_email_where(array('memail'=>$this->session->userdata('selectedemail')));
                    $userModel = new User_model();
                    $user = $userModel->get_user_by_id($this->session->userdata('iduser'));
                    $emailRow=$email[0];
                    $emailRow->mpassword = decrypt($user[0]->passwordkey, $emailRow->mpassword);
                    
                    //Try to connect with imap
                    $connection=$this->maillib->connect($emailRow->memail,$emailRow->mpassword,$emailRow->imapserv,$emailRow->portimap,$emailRow->imapssl);
                    if($connection!=false){
                            $tabemail=$this->maillib->getHeadersList($page);
                            $data['numberpages']=$this->maillib->numberOfPages();
                            $data['emails']=$tabemail;
                            $data['header']=lang('mailbox');
                            }
                            
                        else {
                            $data['nochoose']='noconn';
                            
                        }
            }else $data['nochoose']='nochoose';
            $this->load->view("main_view", $data);
        }
}
