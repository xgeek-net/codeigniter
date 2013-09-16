<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends EX_Controller {

	/**
	 * Index Page for this controller.
	 *
	 */
	function __construct() 
	{
		parent::__construct();
		
	}
	public function index()
	{
		$this->tpl_page_title = $this->config->item('system_name');
		$this->tpl_page_main = "index.tpl";
		$this->display();
	}
	
}


/* End of file index.php */
/* Location: ./application/controllers/app/index.php */