<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * Smarty {ci_session} function plugin
 *
 * Type:     function<br>
 * Name:     ci_db_session<br>
 * Purpose:  bridge to code igniter db_session properties
 * @author Neighbor Webmastert <kepler ar neighborwebmaster dot com>
 * @param array Format:
 * <pre>
 * array(
 *   'name' => required name of the db_session properties
 *   'type' => optional type 'user' or 'flash' - defaults to 'user'
 *   'assign' => optional smarty variable name to assign to - defaults to name
 * )
 * </pre>
 * @param Smarty
 */
if(!function_exists('smarty_function_ci_session'))
{
	function smarty_function_ci_session($params, &$smarty)
	{
	        if ($smarty->debugging) {
	            $_params = array();
	            require_once(SMARTY_CORE_DIR . 'core.get_microtime.php');
	            $_debug_start_time = smarty_core_get_microtime($_params, $smarty);
	        }
	
	        $_name = isset($params['name']) ? $params['name'] : '';
	        $_assign = isset($params['assign']) ? $params['assign'] : '';
	
	        if ($_name != '')
	        {
			    // get a Code Igniter instance
			    $CI = &get_instance();
			    $CI->load->library('admin_auth');
			    $value = '';
	            $value = $CI->admin_auth->get_session_value($_name);
	            if($_assign != ''){
	            	$smarty->assign( $_assign, $value );
	            }else{
	            	echo $value;
	            }
			    
			}
	
	        if ($smarty->debugging) {
	            $_params = array();
	            require_once(SMARTY_CORE_DIR . 'core.get_microtime.php');
	            $smarty->_smarty_debug_info[] = array('type'      => 'config',
	                                                'filename'  => $_file.' ['.$_section.'] '.$_scope,
	                                                'depth'     => $smarty->_inclusion_depth,
	                                                'exec_time' => smarty_core_get_microtime($_params, $smarty) - $_debug_start_time);
	        }
	
	}
}
/* vim: set expandtab: */

?>
