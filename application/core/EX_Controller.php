<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Application base controller
 * Every front page extentds from this controller
 * @author Lin
 * http://www.xgeek.net/
 */
class EX_Controller extends CI_Controller {
	
	public $tpl_page_layout = 'page_layout.tpl';
	public $tpl_page_main;
	public $tpl_page_title;
	public $tpl_base_url;
	
	public $lang_for_javascript;
	
	public $tpl_controller_name;
	public $tpl_action_name;
	
	public $params;
	
	public function __construct()
	{
		parent::__construct();
		
		$this->tpl_controller_name = $this->router->fetch_class();
		$this->tpl_action_name = $this->router->fetch_method();
		
		$this->smarty->setTemplateDir(APPPATH . "views/templates/default");
		$this->smarty->setCompileDir(APPPATH . "views/templates_c/default");
	}
	
	/**
	 * Display the page by Smarty
	 * @param String $template
	 * @param Array $data
	 * @param Bool  $return
	 * @param Bool  $auto_assign
	 */
	public function display($template = '' , $data = array() , $return = FALSE , $auto_assign = TRUE){
		if($auto_assign == TRUE){
			$this->lang_for_javascript = 'var lang = '.json_encode($this->lang->language) . ';';
			
			$this->assignobj($this);
		}
		if(empty($template)){
			$template = $this->tpl_page_layout;
		}
		
		$output = $this->smarty->view( $template, $data , $return);
		if($return == true)
		{
			return $output;
		}
	}
	/**
	 * You can use this fcuntion assign some like $this
	 * @param $obj
	 */
	public function assignobj($obj) {
        $data = get_object_vars($obj);

        foreach ($data as $key => $value){
            $this->smarty->assign($key, $value);
        }
     }
}
/**
 * Admin application base controller
 * Every admin page extentds from this controller
 * @author Lin
 * 
 */
class EX_Admin_Controller extends EX_Controller {
	public $admin_user;
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('session');
		$this->load->library('admin_auth');
		
		$this->load->helper('url');
		
		$this->tpl_base_url = base_url();
		/*
		 * Reset site config for admin controller
		 */
		$admin_folder = $this->config->item('admin_folder');
		$this->smarty->setTemplateDir(APPPATH . "views/templates/admin");
		$this->smarty->setCompileDir(APPPATH . "views/templates_c/admin");
		
		$url = explode('/',base_url());
		if(!in_array($admin_folder , $url)){
			$admin_base_url = base_url() . $admin_folder;
			$this->config->set_item('base_url', $admin_base_url);
		}
	}
	/**
	 * Used for every page to load master data and check admin user
	 */
	public function init()
	{
		if(! $this->admin_auth->check_login() ){
			redirect(base_url("login"));
		}
		$session = $this->session->all_userdata();
		$this->admin_user = $session[$this->config->item('cookie_prefix').'admin'];
	}
}


/* End of file EX_controller.php */
/* Location: ./application/controllers/EX_controller.php */
