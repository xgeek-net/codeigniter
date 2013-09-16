<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends EX_Admin_Controller {

	/**
	 * Logout Page for this controller.
	 * Just use for logout
	 */
	function __construct()
	{
		parent::__construct();

		$this->lang->load('login');
		$this->load->library('form_validation');
	}
	public function index()
	{
		if($this->admin_auth->logout() )
		{
			redirect(base_url("login"));
		}
	}
}


/* End of file logout.php */
/* Location: ./application/controllers/logout.php */