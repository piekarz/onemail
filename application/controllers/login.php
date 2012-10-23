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
            $this->data['header'] = lang("global_header");
            $this->data['baddata'] ='';
            $this->data['success'] ='';
            if(FALSE==$this->session->userdata('lang')) $this->session->set_userdata(sessionDataAdd());
        }
        /**
         * Default action in login page
         */
        public function index()
	{
            if(detect_ie())
                $this->data['mode']='login';
            else
                $this->data['mode']='default';
            //If user is loggedin redirect
            if($this->session->userdata('logged_in')) redirect(base_url('main'));
            $this->load->view("login_view",$this->data);
	}
        /**
         * When form data will send then try to login
         */
        public function send()
        {
            if(detect_ie())
                $this->data['mode']='login';
            else
                $this->data['mode']='default';
            //If user is loggedin redirect
            if($this->session->userdata('logged_in')) redirect(base_url('main'));
            //Check data from login form with database
            if($this->User_model->check_user($_POST['username'],  hash('sha256',$_POST['password'].getPasswordSalt()) )){ 
                //Set session data
                $this->session->set_userdata('username', $_POST['username']);
                $this->session->set_userdata('logged_in',TRUE);
                //Set lang session data
                $result = $this->User_model->get_user_where(array('login'=>$this->session->userdata('username')));
                $data = getDataOfOneRow($result);
                $this->session->set_userdata('lang',$data->lang);
                $this->session->set_userdata('iduser',$data->iduser);
                redirect(base_url('main'));
            }else{
                $this->data['baddata'] = lang('baddata');
            }
            $this->load->view("login_view",$this->data);
        }
        /**
         * Register function
         */
        public function register(){
            $this->data['mode']='register';
            $baddata='';
            //If user is loggedin redirect
            if($this->session->userdata('logged_in')) redirect(base_url('main'));
            //Check POST array is set
            if(isset($_POST['username'])){
                //Check data form is empty
                if(''==$_POST['username'] or ''==$_POST['email'] or ''==$_POST['password'] or ''==$_POST['repassword']) $baddata=lang('empty').'<br />';
                //Check passwords are same
                if($_POST['password']!==$_POST['repassword']) $baddata=$baddata.lang('r_notsame').'<br />';
                //Check Password is too short
                if(strlen($_POST['password'])<6) $baddata=$baddata.lang('r_passtoshort').'<br />';
                //Check if login exist
                $result=$this->User_model->get_user_where(array('login'=>$_POST["username"]));
                if(!empty($result)) $baddata=$baddata.lang('r_userexist').'<br />';
                //Check if email exist
                $result=$this->User_model->get_user_where(array('email'=>$_POST["email"]));
                if(!empty($result)) $baddata=$baddata.lang('r_emailexist').'<br />';
                //Check if email is EMAIL!
                if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))$baddata=$baddata.lang('r_noemail').'<br />';
                
             //IF everything is ok then add new user!
                if(''==$baddata) {
                    $this->User_model->insert_user($_POST['username'],hash('sha256',$_POST['password'].getPasswordSalt()),$_POST['email'],  langLess($this->language),'',1,$_SERVER['REMOTE_ADDR']);
                    $this->data['success']=lang('r_useradded');
                }
                $this->data['baddata']=$baddata;
            }else{
                
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