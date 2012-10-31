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
            $this->load->helper('file');
            if(!$this->session->userdata('logged_in')) redirect(base_url());
        }
	public function index($id = NULL)
	{                      
                $data['header']=lang('email');
                if($id == NULL){
                    $data['email']=NULL;
                }else{
                    //get email and decrypt password
                        $emailModel = new Email_model();
                        $email = $emailModel->get_email_where(array('memail'=>$this->session->userdata('selectedemail')));
                        $userModel = new User_model();
                        $user = $userModel->get_user_by_id($this->session->userdata('iduser'));
                        $emailRow=$email[0];
                        $emailRow->mpassword = decrypt($user[0]->passwordkey, $emailRow->mpassword);
                    
                    $this->maillib->connect($emailRow->memail,$emailRow->mpassword,$emailRow->imapserv,$emailRow->portimap,$emailRow->imapssl);
                    $email=$this->maillib->getMail($id);
//                    if($email!=false){
//                        $email['body']=iconv(mb_detect_encoding($email['body']),'UTF-8//IGNORE',$email['body']);
//                        }
                    //Check if there is no charset defined
                    if(strstr(strtolower($email['body']),'charset')==FALSE){
                        //detecting charset
                        $ary[] = "ASCII";
                        $ary[] = "UTF-8";
                        $ary[] = "ISO-8859-2";
                        $enc=mb_detect_encoding($email['body'], $ary);
                        //add html with charset and css
                        echo $enc;
                        if($enc!=FALSE)
                                $email['body']='<html><head>
                                <meta charset="'.$enc.'" />
                                <link rel="stylesheet" type="text/css" href="'.base_url("application/views/css/mailshow.css").'" />
                                </head><body>'.
                                $email['body'].
                                '</body></html>';   
                    }
                    //for windows-1250 charset code
                    if(strstr(strtolower($email['body']), "windows-1250")!==FALSE){
                                $email['body']=iconv("windows-1250",'UTF-8//IGNORE',$email['body']);
                                $search[]='WINDOWS-1250';
                                $search[]='windows-1250';
                                $replace='utf-8';
                                $email['body']=str_replace($search, $replace, $email['body']);
                    }
                    //iconv for utf-8 - idk why i must use it but it works!
                    if(strstr(strtolower($email['body']),'utf-8')!==FALSE)
                        $email['body'] = iconv('', 'UTF-8//IGNORE', $email['body']);
                
                    $email['body']=transformHtmlTags($email['body']);
                    $data['email']=removeBadChar($email);
                    $this->maillib->close();
                }                
		$this->load->view("mailshow_view",$data);
	}
        
}

