<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Delemail extends CI_Controller {
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
	public function index()
	{               
            if(isset($_POST)){
                    $emailModel = new Email_model();
                    $email = $emailModel->get_email_where(array('memail'=>$_POST['emailinbox']));
                    $userModel = new User_model();
                    $user = $userModel->get_user_by_id($this->session->userdata('iduser'));
                    $emailRow=$email[0];
                    $emailRow->mpassword = decrypt($user[0]->passwordkey, $emailRow->mpassword);
                    
                    //Try to connect with imap
                    $connection = new MailLib();
                    $con = $connection->connect($emailRow->memail,$emailRow->mpassword,$emailRow->imapserv,$emailRow->portimap,$emailRow->imapssl);
                    if($con!=false)
                            $email=$connection->deleteEmail($_POST['emailid']);
                    $connection->close();
                    redirect(base_url('main/mailbox'));
            }
	}
        
}

