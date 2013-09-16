<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en"> 
 
<head> 
	<meta http-equiv="content-type" content="application/xhtml+xml;charset=utf-8" /> 
	<title>{$tpl_page_title|escape|default:''}</title> 
	<link rel='stylesheet' href='{ci_baseurl}css/page.css' type='text/css' media='all' />
	<link rel='stylesheet' href='{ci_baseurl}css/ui.css' type='text/css' media='all' />
	<script src="{ci_baseurl}js/jquery.min.js" type="text/javascript"></script>
	<script src="{ci_baseurl}js/jquery.ui.js" type="text/javascript"></script>
	<script src="{ci_baseurl}js/admin-ui.js" type="text/javascript"></script>
	
	<script type="text/javascript">//<![CDATA[
		{$lang_for_javascript}
		{literal}
	    $(document).ready(function(){
			initHodingInput(".input");
		});
		{/literal}
	//]]>
	</script>
</head> 
<body class="admin">
<input type="hidden" id="ci_baseurl" value="{ci_baseurl}"/>