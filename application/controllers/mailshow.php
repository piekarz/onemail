<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Mailshow extends CI_Controller {
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
            if(!$this->session->userdata('logged_in')) redirect(base_url());
        }
	public function index($id)
	{                      
                $data['header']=lang('email');
                if($id==null){
                    $data['email']=null;
                }else{
                    //get email and decrypt password
                        $emailModel = new Email_model();
                        $email = $emailModel->get_email_where(array('memail'=>$this->session->userdata('selectedemail')));
                        $userModel = new User_model();
                        $user = $userModel->get_user_by_id($this->session->userdata('iduser'));
                        $emailRow=$email[0];
                        $emailRow->mpassword = decrypt($user[0]->passwordkey, $emailRow->mpassword);
                    
                    $this->maillib->connect($emailRow->memail,$emailRow->mpassword,$emailRow->imapserv,$emailRow->portimap);
                    $email=$this->maillib->getMail($id);
                    if($email!=false){
                        $email['body']=iconv(mb_detect_encoding($email['body']),'UTF-8//IGNORE',$email['body']);
                        }
                    $email['body']=transformHtmlTags($email['body']);
                    $data['email']=removeBadChar($email);
                }
                $this->maillib->close();
		$this->load->view("mailshow_view",$data);
	}
        
}

