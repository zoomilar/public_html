<?php /* Smarty version Smarty-3.1.12, created on 2015-01-17 12:37:28
         compiled from "/home/w2.texus.lt/domains/tuscias.w2.texus.lt/public_html/admin/themes/OneEleven/templates/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2422544354ba3b686ac4e4-46157703%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f7f2fb7c64911cec0ea0fc2303886db607ec3366' => 
    array (
      0 => '/home/w2.texus.lt/domains/tuscias.w2.texus.lt/public_html/admin/themes/OneEleven/templates/login.tpl',
      1 => 1406716205,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2422544354ba3b686ac4e4-46157703',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'encoding' => 0,
    'config' => 0,
    'error' => 0,
    'usernamefld' => 0,
    'changepwhash' => 0,
    'warninglogin' => 0,
    'acceptlogin' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_54ba3b68ade9b9_41266621',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ba3b68ade9b9_41266621')) {function content_54ba3b68ade9b9_41266621($_smarty_tpl) {?><?php if (!is_callable('smarty_function_sitename')) include '/home/w2.texus.lt/domains/tuscias.w2.texus.lt/public_html/plugins/function.sitename.php';
if (!is_callable('smarty_function_cms_jquery')) include '/home/w2.texus.lt/domains/tuscias.w2.texus.lt/public_html/plugins/function.cms_jquery.php';
?><!doctype html>
<html>
	<head>
		<meta charset="<?php echo $_smarty_tpl->tpl_vars['encoding']->value;?>
" />
		<title><?php echo smarty_function_sitename(array(),$_smarty_tpl);?>
</title>
		<base href="<?php echo $_smarty_tpl->tpl_vars['config']->value['admin_url'];?>
/" />
		<meta name="robots" content="noindex, nofollow" />
		<meta name="viewport" content="initial-scale=1.0 maximum-scale=1.0 user-scalable=no" />
		<meta name="HandheldFriendly" content="True"/>
		<link rel="stylesheet" href="loginstyle.php" />
		<!-- learn IE html5 -->
		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<?php echo smarty_function_cms_jquery(array('exclude'=>"jquery.ui.nestedSortable-1.3.4.js,jquery.json-2.2.js",'append'=>((string)$_smarty_tpl->tpl_vars['config']->value['admin_url'])."/themes/OneEleven/includes/login.js"),$_smarty_tpl);?>

	</head>
	<body id="login">
		<div id="wrapper">
			<div class="login-container">
				<div class="login-box cf"<?php if (isset($_smarty_tpl->tpl_vars['error']->value)){?> id="error"<?php }?>>

					<form method="post" action="login.php">
						<fieldset>
                                                        <?php if (isset($_smarty_tpl->tpl_vars['usernamefld'])) {$_smarty_tpl->tpl_vars['usernamefld'] = clone $_smarty_tpl->tpl_vars['usernamefld'];
$_smarty_tpl->tpl_vars['usernamefld']->value = 'username'; $_smarty_tpl->tpl_vars['usernamefld']->nocache = null; $_smarty_tpl->tpl_vars['usernamefld']->scope = 0;
} else $_smarty_tpl->tpl_vars['usernamefld'] = new Smarty_variable('username', null, 0);?>
							<?php if (isset($_GET['forgotpw'])){?><?php if (isset($_smarty_tpl->tpl_vars['usernamefld'])) {$_smarty_tpl->tpl_vars['usernamefld'] = clone $_smarty_tpl->tpl_vars['usernamefld'];
$_smarty_tpl->tpl_vars['usernamefld']->value = 'forgottenusername'; $_smarty_tpl->tpl_vars['usernamefld']->nocache = null; $_smarty_tpl->tpl_vars['usernamefld']->scope = 0;
} else $_smarty_tpl->tpl_vars['usernamefld'] = new Smarty_variable('forgottenusername', null, 0);?><?php }?>
							<label for="lbusername"><?php echo lang('username');?>
</label>
							<input id="lbusername"<?php if (!isset($_POST['lbusername'])){?> class="focus"<?php }?> placeholder="<?php echo lang('username');?>
" name="<?php echo $_smarty_tpl->tpl_vars['usernamefld']->value;?>
" type="text" size="15" value="" autofocus="autofocus" />
						<?php if (isset($_GET['forgotpw'])&&!empty($_GET['forgotpw'])){?>
							<input type="hidden" name="forgotpwform" value="1" />
						<?php }?>
						<?php if (!isset($_GET['forgotpw'])&&empty($_GET['forgotpw'])){?>
							<label for="lbpassword"><?php echo lang('password');?>
</label>
							<input id="lbpassword"<?php if (!isset($_POST['lbpassword'])||isset($_smarty_tpl->tpl_vars['error']->value)){?> class="focus"<?php }?> placeholder="<?php echo lang('password');?>
" name="password" type="password" size="15" />
						<?php }?>
						<?php if (isset($_smarty_tpl->tpl_vars['changepwhash']->value)&&!empty($_smarty_tpl->tpl_vars['changepwhash']->value)){?> 
							<label for="lbpasswordagain"><?php echo lang('passwordagain');?>
</label>
							<input id="lbpasswordagain"  name="passwordagain" type="password" size="15" placeholder="<?php echo lang('passwordagain');?>
" />
							<input type="hidden" name="forgotpwchangeform" value="1" />
							<input type="hidden" name="changepwhash" value="<?php echo $_smarty_tpl->tpl_vars['changepwhash']->value;?>
" />
						<?php }?>
							<input class="loginsubmit" name="loginsubmit" type="submit" value="<?php echo lang('submit');?>
" />
							<input class="loginsubmit" name="logincancel" type="submit" value="<?php echo lang('cancel');?>
" />
						</fieldset>
					</form>

					<?php if (isset($_smarty_tpl->tpl_vars['error']->value)){?>
						<div class="message error">
							<?php echo $_smarty_tpl->tpl_vars['error']->value;?>

						</div>
					<?php }?>
					<?php if (isset($_smarty_tpl->tpl_vars['warninglogin']->value)){?>
						<div class="message warning">
							<?php echo $_smarty_tpl->tpl_vars['warninglogin']->value;?>

						</div>
					<?php }?>
					<?php if (isset($_smarty_tpl->tpl_vars['acceptlogin']->value)){?>
						<div class="message success">
							<?php echo $_smarty_tpl->tpl_vars['acceptlogin']->value;?>

						</div>
					<?php }?>
					<?php if (isset($_smarty_tpl->tpl_vars['changepwhash']->value)&&!empty($_smarty_tpl->tpl_vars['changepwhash']->value)){?>
						<div class="warning message">
							<?php echo lang('passwordchange');?>

						</div>
					<?php }?> 
				</div>			

			</div>
		</div>
	</body>
</html><?php }} ?>