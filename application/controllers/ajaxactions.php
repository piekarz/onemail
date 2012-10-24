<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajaxactions extends CI_Controller {
        public function __construct() {
            $langtemp = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
            parent::__construct();
            $this->language = loadLang($langtemp);
            $this->lang->load('welcome',$this->language);
            $this->lang->load('menu',$this->language);
            $this->lang->load('global',$this->language);
            $this->load->model('Email_model');
            if(FALSE==$this->session->userdata('lang')) $this->session->set_userdata(sessionDataAdd());
        }
	public function index()
	{
            redirect(base_url());
	}
        public function post_ajax(){
            if(!$this->session->userdata('logged_in')) redirect(base_url()); 
            if(isset($_POST['email'])){
                $this->maillib->close();
                if(substr_count($_POST['email'],'@')==1)
                $this->session->set_userdata('selectedemail',$_POST['email']);                
//                $where = array('memail'=>$this->session->userdata('selectedemail'));
//                $emailModel = new Email_model();
//                $result=$emailModel->get_email_where($where);
//                $emailRow=getDataOfOneRow($result);
//                $this->session->set_userdata('emaildb',$emailRow);
            }else{
                redirect(base_url('main'));
            }
            redirect(base_url('main'));
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */