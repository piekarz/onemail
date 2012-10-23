<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {
        var $language;
        var $data;
        public function __construct() {
            parent::__construct();
            if(!$this->session->userdata('logged_in')) redirect(base_url());
            $langtemp = $this->session->userdata('lang');
            $this->language = loadLang($langtemp);
            $this->lang->load('welcome',$this->language);
            $this->lang->load('menu',$this->language);
            $this->lang->load('login',$this->language);
            $this->lang->load('global',$this->language);
            $this->load->model('User_model');
            $this->data['header'] = lang("profile_header");
            $this->data['baddata'] ='';
            $this->data['success'] ='';
            if(FALSE==$this->session->userdata('lang')) $this->session->set_userdata(sessionDataAdd());
        }

        public function index(){
            $userModel = new User_model();
            $this->data['msg']='';
            $this->data['success']='';
            $this->data['langlist']=langList();
            //Check if was send to edit
            if(isset($_POST['edit'])){
                //Check datas are empty
                if($_POST['password']=='' or $_POST['email']=='')$this->data['msg']=$this->data['msg'].lang('empty').'<br />';
                //Check passwords aren't the same
                if($_POST['password']!==$_POST['repassword']) $this->data['msg']=$this->data['msg'].lang('r_notsame').'<br />';
                //Check Password is too short
                if(strlen($_POST['password'])<6) $this->data['msg']=$this->data['msg'].lang('r_passtoshort').'<br />';
                //Check email exist
                $result=$userModel->get_user_where(array('email'=>$_POST['email']));
                $user=getDataOfOneRow($result);
                if(0<count($result))
                    if($user->iduser!==$this->session->userdata('iduser') and $user->email==$_POST['email']) $this->data['msg']=$this->data['msg'].lang('r_emailexist').'<br />';
                //Check if email is EMAIL!
                if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))$this->data['msg']=$this->data['msg'].lang('r_noemail').'<br />';
                
                //If everything ok, then update
                if($this->data['msg']==''){
                    unset($_POST['repassword']);
                    unset($_POST['edit']);
                    unset($_POST['iduser']);
                    $_POST['password']=hash('sha256',$_POST['password'].getPasswordSalt());
                    $userModel->update_choosen_user($this->session->userdata('iduser'), $_POST);
                    $this->session->set_userdata(array('lang'=>$_POST['lang']));
                    $this->data['success']=lang('profile_updated');
                }
                
            }
            $this->data['user']=getDataOfOneRow($userModel->get_user_by_id($this->session->userdata('iduser')));
            $this->load->view("profile_view",$this->data);
        }
}