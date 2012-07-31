<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
        var $language;
        public function __construct() {
           // require_once "/application/helpers/Method_helper.php";
           // $helper = new Method_helper();
            $langtemp = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
           // $this->language = $helper->load_Lang($langtemp);
            
            parent::__construct();
            $this->language = loadLang($langtemp);
            $this->lang->load('welcome',$this->language);
            $this->lang->load('menu',$this->language);
            $this->lang->load('global',$this->language);
            $this->load->file('ajaxfw.php');
            
           
            
        }
	public function index()
	{
                $data['header'] = lang("global_header");
		$this->load->view("welcome_view",$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */