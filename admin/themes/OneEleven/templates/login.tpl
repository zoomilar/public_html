<!doctype html>
<html>
	<head>
		<meta charset="{$encoding}" />
		<title>{sitename}</title>
		<base href="{$config.admin_url}/" />
		<meta name="robots" content="noindex, nofollow" />
		<meta name="viewport" content="initial-scale=1.0 maximum-scale=1.0 user-scalable=no" />
		<meta name="HandheldFriendly" content="True"/>
		<link rel="stylesheet" href="loginstyle.php" />
		<!-- learn IE html5 -->
		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		{cms_jquery exclude="jquery.ui.nestedSortable-1.3.4.js,jquery.json-2.2.js" append="`$config.admin_url`/themes/OneEleven/includes/login.js"}
	</head>
	<body id="login">
		<div id="wrapper">
			<div class="login-container">
				<div class="login-box cf"{if isset($error)} id="error"{/if}>

					<form method="post" action="login.php">
						<fieldset>
                                                        {assign var='usernamefld' value='username'}
							{if isset($smarty.get.forgotpw)}{assign var='usernamefld' value='forgottenusername'}{/if}
							<label for="lbusername">{'username'|lang}</label>
							<input id="lbusername"{if !isset($smarty.post.lbusername)} class="focus"{/if} placeholder="{'username'|lang}" name="{$usernamefld}" type="text" size="15" value="" autofocus="autofocus" />
						{if isset($smarty.get.forgotpw) && !empty($smarty.get.forgotpw)}
							<input type="hidden" name="forgotpwform" value="1" />
						{/if}
						{if !isset($smarty.get.forgotpw) && empty($smarty.get.forgotpw)}
							<label for="lbpassword">{'password'|lang}</label>
							<input id="lbpassword"{if !isset($smarty.post.lbpassword) or isset($error)} class="focus"{/if} placeholder="{'password'|lang}" name="password" type="password" size="15" />
						{/if}
						{if isset($changepwhash) && !empty($changepwhash)} 
							<label for="lbpasswordagain">{'passwordagain'|lang}</label>
							<input id="lbpasswordagain"  name="passwordagain" type="password" size="15" placeholder="{'passwordagain'|lang}" />
							<input type="hidden" name="forgotpwchangeform" value="1" />
							<input type="hidden" name="changepwhash" value="{$changepwhash}" />
						{/if}
							<input class="loginsubmit" name="loginsubmit" type="submit" value="{'submit'|lang}" />
							<input class="loginsubmit" name="logincancel" type="submit" value="{'cancel'|lang}" />
						</fieldset>
					</form>

					{if isset($error)}
						<div class="message error">
							{$error}
						</div>
					{/if}
					{if isset($warninglogin)}
						<div class="message warning">
							{$warninglogin}
						</div>
					{/if}
					{if isset($acceptlogin)}
						<div class="message success">
							{$acceptlogin}
						</div>
					{/if}
					{if isset($changepwhash) && !empty($changepwhash)}
						<div class="warning message">
							{'passwordchange'|lang}
						</div>
					{/if} 
				</div>			

			</div>
		</div>
	</body>
</html>