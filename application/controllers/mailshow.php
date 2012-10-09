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
            if(!$this->session->userdata('logged_in')) redirect(base_url());
        }
	public function index($id)
	{       
                $data['header']=lang('email');
                if($id==null){
                    $data['email']=null;
                }else{
                    $emailRow=$this->session->userdata('emaildb');
                    
                    $this->maillib->connect($emailRow->memail,$emailRow->mpassword,$emailRow->imapserv,$emailRow->portimap);
                    $email=$this->maillib->getMail($id);
                    if($email!=false){
                    //$email['body']=quoted_printable_decode($email['body']);    
                    //$email['body']=mb_convert_encoding($email['body'],'UTF-8');
//                    if(mb_detect_encoding($email['body'])!='UTF-8')
                        $email['body']=iconv(mb_detect_encoding($email['body']),'UTF-8//IGNORE',$email['body']);
                        }
                    $email['body']=transformHtmlTags($email['body']);
                    $data['email']=removeBadChar($email);
                }
                $this->maillib->close();
		$this->load->view("mailshow_view",$data);
	}
        
}

