{literal}
<script type="text/javascript">//<![CDATA[
    $(document).ready(function(){
		$('#user_name').focus();
	});
//]]>
</script>
{/literal}
<div id="login_main">
	
	<div id="login" class="login">
		{if $errors|@count > 0}
		<div class="login_error_box">
			{foreach from=$errors item=e}
		    {$e}<br />
			{/foreach}
		</div>
		{/if}
		<form name="login_form" class="login_form" action="{ci_baseurl name='login'}" method="post">
			<h1><a href="http://www.xgeek.net" title="Xgeek CI">Xgeek CI</a></h1>
			<p class="placeholding">
				<input type="text" name="user_name" id="user_name" class="input{if $errors.user_name} error{/if}" value="{$params.user_name|escape}" size="20" tabindex="10">
				<label for="user_name" class="holder">{ci_language line="account"}</label>
				
			</p>
			<p class="placeholding">
				<input type="password" name="password" id="user_pass" class="input{if $errors.password} error{/if}" value="" size="20" tabindex="20">
				<label for="user_pass" class="holder">{ci_language line="password"}</label>
			</p>
			<p class="submit">
				<input type="submit" name="submit" class="input-button ui-btn ui-btn-blue" value="{ci_language line="login"}">
			</p>
		</form>
	</div>
</div>

