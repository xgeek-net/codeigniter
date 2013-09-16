<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends EX_Admin_Controller {

	/**
	 * Index page for this controller.
	 *
	 */
	function __construct() 
	{
		parent::__construct();
		$this->lang->load('index');
	}
	public function index()
	{
		parent::init();
		
		$this->tpl_page_title = $this->config->item('system_name');
		$this->tpl_page_main = "index.tpl";
		$this->display();
	}
	
}


/* End of file home.php */
/* Location: ./application/controllers/admin/home.php */