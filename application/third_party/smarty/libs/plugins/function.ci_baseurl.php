<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * Smarty {ci_base} function plugin
 *
 * Type:     function<br>
 * Name:     ci_base<br>
 * Purpose:  bridge to code igniter config properties
 * @author Lin
 * @param array Format:
 * <pre>
 * array(
 *   'name' => required name of the config properties
 *   'assign' => optional smarty variable name to assign to - defaults to name
 * )
 * </pre>
 * @param Smarty
 */
if(!function_exists('smarty_function_ci_baseurl'))
{
	function smarty_function_ci_baseurl($params, &$smarty)
	{
	        if ($smarty->debugging) {
	            $_params = array();
	            require_once(SMARTY_CORE_DIR . 'core.get_microtime.php');
	            $_debug_start_time = smarty_core_get_microtime($_params, $smarty);
	        }
	
	        $_name = isset($params['name']) ? $params['name'] : '';
	        $_assign = isset($params['assign']) ? $params['assign'] : '';
	
	        // get a Code Igniter instance
			$CI = &get_instance();
		    $value = $CI->config->base_url($_name);
			if($_assign != ''){
	           	$smarty->assign( $_assign, $value );
	        }else{
	            echo $value;
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
