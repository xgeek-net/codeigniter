<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends EX_Admin_Controller {

	/**
	 * Login Page for this controller.
	 *
	 */
	function __construct() 
	{
		parent::__construct();
		$this->tpl_page_layout = "login_layout.tpl";
		
		$this->lang->load('login');
		$this->load->library('form_validation');
	}
	public function index()
	{
		if($this->admin_auth->check_login() )
		{
			redirect(base_url());
		}
		$this->tpl_page_title = "Login | " . $this->config->item('system_name');
		$this->tpl_page_main = "login.tpl";
		if ( $this->input->post() )
		{
			$this->params = $this->input->post();
			if (! $this->_check_error() )
			{
				$this->errors = $this->form_validation->error_array();
			}
			else
			{
				if($this->admin_auth->login($this->params['user_name'] , $this->params['password']))
				{
					redirect(base_url('home'));
				}else{
					$this->errors['password'] = $this->lang->line('error_user_name_password_not_correct');
				}
			}
				
		}
		$this->display();
	}
	/**
	 * Check login form params
	 */
	private function _check_error()
	{
		$this->form_validation->set_rules('user_name', $this->lang->line('account'), 'trim|required|min_length[3]|max_length[12]|xss_clean');
		$this->form_validation->set_rules('password', $this->lang->line('password'), 'trim|required|xss_clean');
		return $this->form_validation->run();
	}
}


/* End of file login.php */
/* Location: ./application/controllers/login.php */