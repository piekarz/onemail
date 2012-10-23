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
            if(!$this->session->userdata('logged_in')) redirect(base_url());
            $this->emailModel = new Email_model();
            $this->userModel = new User_model();
        }
	public function index()
	{   
            $data['warning']='';
            $data['success']='';
            $data['dtshowid']='';
 
            //Delete email
            if( isset($_POST['delete'])){
                
                $this->emailModel->delete_email($_POST['idemail']);
                $tab=$this->session->userdata('emails');
                unset($tab[$_POST['idemail']]);
                $this->session->set_userdata('emails',$tab);
                //Choose first email from list in session and set as selected
                foreach($this->session->userdata('emails') as $email){
                    $this->session->set_userdata('selectedemail',$email);
                    break;
                 }
            } //Edit Email
            elseif( isset($_POST['edit'])){
                $data['dtshowid']=$_POST['idemail'];
                if($_POST['mpassword']!=''){
                    //If passwords aren't same
                    if($_POST['mpassword']!=$_POST['rempassword']){ 
                            $data['warning']=$data['warning'].lang('notsamepass').'<br />';
                        }else unset($_POST['rempassword']);
                } else{ 
                    unset($_POST['mpassword']); 
                    unset($_POST['rempassword']);
                    }
                //If port's numbers are out of range
                if($_POST['portsmtp']<0 OR $_POST['portsmtp']>65535 OR $_POST['portimap']<0 OR $_POST['portimap']>65535) $data['warning']=$data['warning'].lang('badportnum').'<br />';
                //If port's numbers aren't NUMBERS!
                if(!is_numeric($_POST['portsmtp']) or !is_numeric($_POST['portimap']))$data['warning']=$data['warning'].lang('portnummustbnum').'<br />';
                if($data['warning']==''){
                    $idemail=$_POST['idemail'];
                    //I unset postvariables to give model array $_POST
                    unset($_POST['idemail']);
                    unset($_POST['edit']);
                    $emailtoupdate=$_POST;
                    $emailfromdb=$this->emailModel->get_email_where(array('idemail'=>$idemail));
                    
                    //Set previous password if wasn't change
                    if($emailtoupdate['mpassword']=='')$emailtoupdate['mpassword']=$emailfromdb[0]->mpassword;
                    //Set new password if was change
                    else {
                        $user=$this->userModel->get_user_by_id($this->session->userdata('iduser'));
                        $emailtoupdate['mpassword'] =  encrypt($user[0]->passwordkey, $emailtoupdate['mpassword']);
                        }
                    
                    //Update edited email
                    $this->emailModel->update_email($emailtoupdate, $idemail);
                    //Update session data
                    $tab=$this->session->userdata('emails');
                    $tab[$idemail]=$_POST['memail'];
                    $this->session->set_userdata('emails',$tab);
                    //Choose first email from list in session and set as selected
                    foreach($this->session->userdata('emails') as $email){
                        $this->session->set_userdata('selectedemail',$email);
                        break;
                    }
                    $data['success']=lang('success_em_edit');
                }
                
            }
            $data['header']=lang('Settings');
            $user=$this->userModel->get_user_where(array('login'=>$this->session->userdata('username')));
            $tabEmail=$this->emailModel->get_all_email($user[0]->iduser);
            if($tabEmail==null) $data['accemails']=false;
            else {
                $data['accemails']=$tabEmail;
            }
            $this->load->view("settings_view",$data);
	}
        //Add new email
        public function add(){
            $data['warning']='';
            $data['success']='';
            if( isset($_POST['add']) ){ 
                $data['postdata']=$_POST;
                //If password is empty
                if($_POST['mpassword']=='') $data['warning']=$data['warning'].lang('emptypass').'<br />';
                    //If password not same
                    elseif($_POST['mpassword']!=$_POST['rempassword']) $data['warning']=$data['warning'].lang('notsamepass').'<br />';
                //If email exist
                $array=$this->emailModel->get_email_where(array('memail'=>$_POST['memail']));
                if(!empty($array))$data['warning']=$data['warning'].lang('emailexist').'<br />';
                //If port's numbers are out of range
                if($_POST['portsmtp']<0 OR $_POST['portsmtp']>65535 OR $_POST['portimap']<0 OR $_POST['portimap']>65535) $data['warning']=$data['warning'].lang('badportnum').'<br />';
                //If port's numbers aren't NUMBERS!
                if(!is_numeric($_POST['portsmtp']) or !is_numeric($_POST['portimap']))$data['warning']=$data['warning'].lang('portnummustbnum').'<br />';
                //If ok then add email
                if($data['warning']==''){
                    //get a key for encrypt
                    $user=$this->userModel->get_user_by_id($this->session->userdata('iduser'));
                    //encrypt password
                    $empassword=encrypt($user[0]->passwordkey, $_POST['mpassword']);
                    
                    //add new email to database
                    $this->emailModel->insert_email($this->session->userdata('iduser'),$_POST['memail'] , $empassword, $_POST['portimap'], $_POST['portsmtp'], $_POST['imapserv'], $_POST['smtpserv']);
                    $data['success']=lang('successaddemail');
                    
                    //Add email to leftmenu list
                    $tab=$this->session->userdata('emails');
                    $email=$this->emailModel->get_email_where(array('memail'=>$_POST['memail']));
                    $tab[$email[0]->idemail]=$email[0]->memail;
                    $this->session->set_userdata('emails',$tab);
                }
            }else $data['postdata']=array('memail'=>'','imapserv'=>'','smtpserv'=>'','portsmtp'=>'','portimap'=>'');
            $data['header']=lang('h_addaccount');
            $this->load->view("settings_view",$data);
        }
        
}

