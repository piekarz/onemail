<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Write extends CI_Controller {
    var $data;
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
            $this->data['header']=lang('write');
            //print_r($this->session->all_userdata());
        }
	public function index()
	{       
                
                if(''!=$this->session->userdata('selectedemail')){
                    $this->data['selectedemail']=true;
                    //get email and decrypt password
                        $emailModel = new Email_model();
                        $email = $emailModel->get_email_where(array('memail'=>$this->session->userdata('selectedemail')));
                        $userModel = new User_model();
                        $user = $userModel->get_user_by_id($this->session->userdata('iduser'));
                        $emailRow=$email[0];
                        $emailRow->mpassword = decrypt($user[0]->passwordkey, $emailRow->mpassword);
                    $this->data['email']=$emailRow;
                }else
                   $this->data['selectedemail']=false; 
                $this->load->view("write_view",$this->data);
	}
        public function send(){
            if(isset($_POST['send'])){
                
                 //get email and decrypt password
                        $emailModel = new Email_model();
                        $email = $emailModel->get_email_where(array('memail'=>$this->session->userdata('selectedemail')));
                        $userModel = new User_model();
                        $user = $userModel->get_user_by_id($this->session->userdata('iduser'));
                        $emailRow=$email[0];
                        $emailRow->mpassword = decrypt($user[0]->passwordkey, $emailRow->mpassword);
                 $emaildb = $emailRow;
                 $config = Array(
                    'protocol' => 'smtp',
                    'smtp_host' => $emaildb->smtpserv,
                    'smtp_port' => $emaildb->portsmtp,
                    'smtp_user' => $emaildb->memail,
                    'smtp_pass' => $emaildb->mpassword,
                    'mailtype'  => 'html', 
                    'charset'   => 'utf-8'
                );
                 $this->email->initialize($config);
                 $this->email->set_newline("\r\n");
                 $this->email->from($emaildb->memail, $_POST['signature']);
                 $this->email->to($_POST['recipment']);  
                 $this->email->subject($_POST['subject']);  
                 $this->email->message($_POST['body']);
                 $this->data['result']= $this->email->send();
                 //echo $this->email->print_debugger();
                 $this->load->view("write_view",$this->data);
                
            }else redirect(base_url('write'));
        }
}

