<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Admin_auth Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Auth
 * @author		Lin
 */

class Admin_auth {
	var $_session_key;

	public function __construct()
	{
		$this->_assign_libraries();
		$this->_session_key = $this->config->item('cookie_prefix')."admin";
	}
	/**
	 * Admin_auth::login()
	 *
	 * Process a login, either from username/password or a "remember me" cookie
	 */
	public function login($user_name , $password , $remember = FALSE , $token = NULL)
	{
		$admin_info = $this->admin_user->get_admin_info(
			array(
				'user_name' => $user_name
		));
		if($admin_info['password'] === $this->encrypt->sha1($password)){
			
			$this->set_session_values($admin_info);
			$ip_address = $this->session->userdata('ip_address');
			$update_user = array('login_time' 	=> date('YmdHis',now()) , 
								'login_ip' 		=> $ip_address );
			$admin_session = $this->session->userdata($this->_session_key);
			return $this->admin_user->update_user($admin_session['admin_id'] , $update_user);
		}
		return FALSE;
	}
	/**
	 * Admin user logout
	 */
	public function logout()
	{
		$this->session->sess_destroy();
		return TRUE;
	}
	/**
	 * Admin_auth::check_login
	 */
	public function check_login()
	{
		$admin_session = $this->session->userdata($this->_session_key);
		if(empty($admin_session)){
			return FALSE;
		}
		$admin_info = $this->admin_user->get_admin_info(
			array(
				'admin_id' => $admin_session['admin_id']
		));
		if($admin_info['user_name'] === $admin_session['user_name']){
			return TRUE;
		}
		return FALSE;
	}
	
	/**
	 * Admin_auth::set_session_values()
	 *
	 * Set values to be saved in the session
	 */
	public function set_session_values($values)
	{
		$session_data = array();
		foreach($values as $_key => $_value)
		{
			if($_key !== 'password')
			{
				if($_key == 'roles')
				{
					$_value = $this->encrypt->encode($_value);
				}
				
				$session_data[$this->_session_key][$_key] = $_value;
			}
		}

		$this->session->set_userdata($session_data);
	}
	/**
	 * Admin_auth::set_session_value()
	 *
	 * Set value to be saved in the session
	 */
	public function set_session_value($key , $value)
	{
		$session_data = $this->session->all_userdata();
		$session_data[$this->_session_key][$key] = $value;

		$this->session->set_userdata($session_data);
	}
	/**
	 * Admin_auth::get_session_value()
	 *
	 * Get values from session
	 */
	public function get_session_value($key)
	{
		$admin_session = $this->session->userdata($this->_session_key);
		if(empty($key))
		{
			return $admin_session;
		}
		return $admin_session[$key];
	}
	
	/**
	 * Admin_auth::_assign_libraries()
	 *
	 * Grab everything from the CI superobject that we need
	 */
	 public function _assign_libraries()
	 {
 		if($CI =& get_instance())
 		{
 			$this->input	= $CI->input;
			$this->load		= $CI->load;
			$this->config	= $CI->config;
			$this->lang		= $CI->lang;
			
			$CI->load->model('admin/admin_user');
			$this->admin_user = $CI->admin_user;
			
			$CI->load->library('session');
			$this->session	= $CI->session;

			$CI->load->library('encrypt');
			$this->encrypt	= $CI->encrypt;
			
			$CI->load->helper('date');
			
			return;
		}

		log_message('error', $this->lang->line('admin_auth_instance_error'));
		show_error($this->lang->line('admin_auth_instance_error'));

	 }
}

/* End of file admin_auth.php */
/* Location: ./application/libraries/admin_auth.php */