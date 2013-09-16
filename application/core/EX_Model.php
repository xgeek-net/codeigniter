<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Application base controller
 * Every model extentds from this model
 * @author Lin
 * http://www.xgeek.net/
 */
class EX_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    /**
     * Escape a string by db model
     * @param String $val
     */
    public function escape($val)
    {
    	return $this->db->escape($val);
    }
}

/* End of file EX_model.php */
/* Location: ./application/core/EX_model.php */