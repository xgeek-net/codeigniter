<?php
/**
 * Admin_user class use for reading(writing) admin data from(to) admin_user table
 * @author Lin
 * http://www.xgeek.net/
 */
class Admin_user extends EX_Model {

    function __construct()
    {
        parent::__construct();
    }
    /**
     * Get admin user info
     * This may be used for check login user / password
     * @param $where
     */
    function get_admin_info($where = array())
    {
    	$where = array_merge($where , array('del_flg' => '0'));
		$query = $this->db->get_where('admin_users',$where, 1);
		return $query->row_array();
    }
    /**
     * Update admin user info
     * @param $admin_id
     * @param $user_info
     */
	function update_user($admin_id , $user_info = array())
    {
    	if(!is_numeric($admin_id))
    	{
    		return FALSE;
    	}
        return $this->db->update('admin_users', $user_info, array('admin_id' => $admin_id));
    }

}

/* End of file admin_user.php */
/* Location: ./application/models/admin_user.php */