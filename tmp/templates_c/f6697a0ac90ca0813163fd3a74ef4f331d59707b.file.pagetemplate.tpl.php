<?php /* Smarty version Smarty-3.1.12, created on 2014-12-10 13:58:35
         compiled from "/home/w2.texus.lt/domains/tuscias.w2.texus.lt/public_html/admin/themes/OneEleven/templates/pagetemplate.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11817510255488356bbf74b8-44151683%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f6697a0ac90ca0813163fd3a74ef4f331d59707b' => 
    array (
      0 => '/home/w2.texus.lt/domains/tuscias.w2.texus.lt/public_html/admin/themes/OneEleven/templates/pagetemplate.tpl',
      1 => 1406716205,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11817510255488356bbf74b8-44151683',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'lang' => 0,
    'lang_dir' => 0,
    'pagetitle' => 0,
    'config' => 0,
    'secureparam' => 0,
    'headertext' => 0,
    'fmgood' => 0,
    'pagealias' => 0,
    'user' => 0,
    'theme' => 0,
    'is_notifications' => 0,
    'is_ie' => 0,
    'module_icon_url' => 0,
    'module_name' => 0,
    'module_help_url' => 0,
    'wiki_url' => 0,
    'droparea' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5488356c2ddde5_78395843',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5488356c2ddde5_78395843')) {function content_5488356c2ddde5_78395843($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include '/home/w2.texus.lt/domains/tuscias.w2.texus.lt/public_html/lib/smarty/plugins/modifier.truncate.php';
if (!is_callable('smarty_function_sitename')) include '/home/w2.texus.lt/domains/tuscias.w2.texus.lt/public_html/plugins/function.sitename.php';
if (!is_callable('smarty_function_cms_jquery')) include '/home/w2.texus.lt/domains/tuscias.w2.texus.lt/public_html/plugins/function.cms_jquery.php';
if (!is_callable('smarty_cms_function_module_available')) include '/home/w2.texus.lt/domains/tuscias.w2.texus.lt/public_html/plugins/function.module_available.php';
if (!is_callable('smarty_function_cms_module')) include '/home/w2.texus.lt/domains/tuscias.w2.texus.lt/public_html/plugins/function.cms_module.php';
?><!doctype html>
<html lang="<?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['lang']->value,'2','');?>
" dir="<?php echo $_smarty_tpl->tpl_vars['lang_dir']->value;?>
">
	<head>
		<meta charset="utf-8" />
		<title><?php if (!empty($_smarty_tpl->tpl_vars['pagetitle']->value)){?><?php echo $_smarty_tpl->tpl_vars['pagetitle']->value;?>
 - <?php }?><?php echo smarty_function_sitename(array(),$_smarty_tpl);?>
</title>
		<base href="<?php echo $_smarty_tpl->tpl_vars['config']->value['admin_url'];?>
/" />
		<meta name="generator" content="CMS Made Simple - Copyright (C) 2004-12 Ted Kulp. All rights reserved." />
		<meta name="robots" content="noindex, nofollow" />
		<meta name="viewport" content="initial-scale=1.0 maximum-scale=1.0 user-scalable=no" />
		<meta name="HandheldFriendly" content="True"/>
		<link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['config']->value['admin_url'];?>
/themes/OneEleven/images/favicon/cmsms-favicon.ico"/>
		<link rel='apple-touch-icon' href='<?php echo $_smarty_tpl->tpl_vars['config']->value['admin_url'];?>
/themes/OneEleven/images/favicon/apple-touch-icon-iphone.png' /> 
		<link rel='apple-touch-icon' sizes='72x72' href='<?php echo $_smarty_tpl->tpl_vars['config']->value['admin_url'];?>
/themes/OneEleven/images/favicon/apple-touch-icon-ipad.png' /> 
		<link rel='apple-touch-icon' sizes='114x114' href='<?php echo $_smarty_tpl->tpl_vars['config']->value['admin_url'];?>
/themes/OneEleven/images/favicon/apple-touch-icon-iphone4.png' />
		<link rel='apple-touch-icon' sizes='144x144' href='<?php echo $_smarty_tpl->tpl_vars['config']->value['admin_url'];?>
/themes/OneEleven/images/favicon/apple-touch-icon-ipad3.png' />		
		<meta name='msapplication-TileImage' content='<?php echo $_smarty_tpl->tpl_vars['config']->value['admin_url'];?>
/themes/OneEleven/images/favicon/ms-application-icon.png' />
		<meta name='msapplication-TileColor' content='#f89938'>
		<link rel="stylesheet" href="style.php?<?php echo $_smarty_tpl->tpl_vars['secureparam']->value;?>
" />
		<!-- learn IE html5 -->
		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<?php echo smarty_function_cms_jquery(array('append'=>((string)$_smarty_tpl->tpl_vars['config']->value['admin_url'])."/themes/OneEleven/includes/jquery.cookie.min.js,".((string)$_smarty_tpl->tpl_vars['config']->value['admin_url'])."/themes/OneEleven/includes/standard.js"),$_smarty_tpl);?>

		<!-- THIS IS WHERE HEADER STUFF SHOULD GO -->
	 	<?php echo (($tmp = @$_smarty_tpl->tpl_vars['headertext']->value)===null||$tmp==='' ? '' : $tmp);?>

		<!-- custom jQueryUI Theme 1.8.21 see style.css or link in UI Stylesheet for color reference //-->
		<link href="<?php echo $_smarty_tpl->tpl_vars['config']->value['admin_url'];?>
/themes/OneEleven/css/default-cmsms/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
        <?php echo smarty_cms_function_module_available(array('name'=>'FileManager','assign'=>'fmgood'),$_smarty_tpl);?>

        <?php if (isset($_smarty_tpl->tpl_vars['fmgood']->value)&&$_smarty_tpl->tpl_vars['fmgood']->value){?><?php echo smarty_function_cms_module(array('module'=>'FileManager','action'=>'javascript'),$_smarty_tpl);?>
<?php }?>
	</head>
	<body##BODYSUBMITSTUFFGOESHERE## lang="<?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['lang']->value,'2','');?>
" id="<?php echo md5($_smarty_tpl->tpl_vars['pagetitle']->value);?>
" class="oe_<?php echo $_smarty_tpl->tpl_vars['pagealias']->value;?>
">
		<!-- start container -->
		<div id="oe_container" class="sidebar-on">
			<!-- start header -->
			<header role="banner" class="cf header">
				<!-- start header-top -->
				<div class="header-top cf">
					<!-- logo -->
					<div class="cms-logo">
						<a href="http://www.cmsmadesimple.org" rel="external"><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['admin_url'];?>
/themes/OneEleven/images/layout/cmsms-logo.jpg" width="205" height="69" alt="CMS Made Simple" title="CMS Made Simple" /></a>
					</div>
					<!-- title -->
					<span class="admin-title"> <?php echo lang('adminpaneltitle');?>
 - <?php echo smarty_function_sitename(array(),$_smarty_tpl);?>
<?php if (!empty($_smarty_tpl->tpl_vars['pagetitle']->value)){?> - <?php echo $_smarty_tpl->tpl_vars['pagetitle']->value;?>
<?php }?></span>
				</div>
				<div class='clear'></div>
				<!-- end header-top //-->
				<!-- start header-bottom -->
				<div class="header-bottom cf">
					<!-- welcome -->
					<div class="welcome">
						<span><a class="welcome-user" href="myaccount.php?<?php echo $_smarty_tpl->tpl_vars['secureparam']->value;?>
" title="<?php echo lang('myaccount');?>
"><?php echo lang('myaccount');?>
</a> <?php echo lang('welcome_user');?>
: <a href="myaccount.php?<?php echo $_smarty_tpl->tpl_vars['secureparam']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['user']->value->username;?>
</a></span>
					</div>
					<!-- breadcrubms -->
					<?php echo $_smarty_tpl->getSubTemplate ('breadcrumbs.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('items'=>$_smarty_tpl->tpl_vars['theme']->value->get_breadcrumbs()), 0);?>
 
					<!-- bookmarks -->
					
					<?php echo $_smarty_tpl->getSubTemplate ('shortcuts.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

				</div>
				<!-- end header-bottom //-->
			</header>
			<!-- end header //-->
			<!-- start content -->
			<div id="oe_admin-content">
				<div class="shadow">
					&nbsp;
				</div>
				<!-- start sidebar -->
				<div id="oe_sidebar">
					<aside>
						<?php if (isset($_smarty_tpl->tpl_vars['is_notifications'])) {$_smarty_tpl->tpl_vars['is_notifications'] = clone $_smarty_tpl->tpl_vars['is_notifications'];
$_smarty_tpl->tpl_vars['is_notifications']->value = $_smarty_tpl->tpl_vars['theme']->value->get_notifications(); $_smarty_tpl->tpl_vars['is_notifications']->nocache = null; $_smarty_tpl->tpl_vars['is_notifications']->scope = 0;
} else $_smarty_tpl->tpl_vars['is_notifications'] = new Smarty_variable($_smarty_tpl->tpl_vars['theme']->value->get_notifications(), null, 0);?>
						<span title="<?php echo lang('open');?>
/<?php echo lang('close');?>
" class="toggle-button close<?php if (empty($_smarty_tpl->tpl_vars['is_notifications']->value)){?> top<?php }?>"><?php echo lang('open');?>
/<?php echo lang('close');?>
</span>
						<!-- notifications -->
						<?php echo $_smarty_tpl->getSubTemplate ('notifications.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('items'=>$_smarty_tpl->tpl_vars['theme']->value->get_notifications()), 0);?>
 
							<!-- start navigation -->
						<?php if (isset($_smarty_tpl->tpl_vars["depth"])) {$_smarty_tpl->tpl_vars["depth"] = clone $_smarty_tpl->tpl_vars["depth"];
$_smarty_tpl->tpl_vars["depth"]->value = 0; $_smarty_tpl->tpl_vars["depth"]->nocache = null; $_smarty_tpl->tpl_vars["depth"]->scope = 0;
} else $_smarty_tpl->tpl_vars["depth"] = new Smarty_variable(0, null, 0);?><!--2013-02-20 bugas-->
						<?php echo $_smarty_tpl->getSubTemplate ('navigation.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('nav'=>$_smarty_tpl->tpl_vars['theme']->value->get_navigation_tree()), 0);?>
 
						<!-- end navigation //-->
					</aside>
				</div>
				<!-- end sidebar //-->
				<!-- start main -->
				<div id="oe_mainarea" class="cf">
					<?php echo $_smarty_tpl->getSubTemplate ('messages.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php if (isset($_smarty_tpl->tpl_vars['fmgood']->value)&&$_smarty_tpl->tpl_vars['fmgood']->value){?><?php echo smarty_function_cms_module(array('module'=>'FileManager','action'=>'dropzone','id'=>'dropzone','assign'=>'droparea'),$_smarty_tpl);?>
<?php }?><article role="main" class="content-inner"><header class="pageheader<?php if (isset($_smarty_tpl->tpl_vars['is_ie']->value)){?> drop-hidden<?php }?> cf"><?php if (isset($_smarty_tpl->tpl_vars['module_icon_url']->value)||isset($_smarty_tpl->tpl_vars['pagetitle']->value)){?><h1><?php if (isset($_smarty_tpl->tpl_vars['module_icon_url']->value)){?><img src="<?php echo $_smarty_tpl->tpl_vars['module_icon_url']->value;?>
" alt="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['module_name']->value)===null||$tmp==='' ? '' : $tmp);?>
" class="module-icon" /><?php }?><?php echo (($tmp = @$_smarty_tpl->tpl_vars['pagetitle']->value)===null||$tmp==='' ? '' : $tmp);?>
</h1><?php if (isset($_smarty_tpl->tpl_vars['module_help_url']->value)||isset($_smarty_tpl->tpl_vars['wiki_url']->value)){?> <span class="helptext"> <?php if (isset($_smarty_tpl->tpl_vars['module_help_url']->value)){?><a href="<?php echo $_smarty_tpl->tpl_vars['module_help_url']->value;?>
"><?php echo lang('module_help');?>
</a><?php }?><?php if (isset($_smarty_tpl->tpl_vars['wiki_url']->value)){?><a href="<?php echo $_smarty_tpl->tpl_vars['wiki_url']->value;?>
" class="external" target="_blank"><?php echo lang('help');?>
</a> <em>(<?php echo lang('new_window');?>
)</em><?php }?> </span> <?php }?><?php }?><?php if (isset($_smarty_tpl->tpl_vars['droparea']->value)&&!isset($_smarty_tpl->tpl_vars['is_ie']->value)){?><?php echo $_smarty_tpl->tpl_vars['droparea']->value;?>
<?php }?></header><section class="cf"><?php echo $_smarty_tpl->tpl_vars['content']->value;?>
</section></article>
				</div>
				<!-- end main //-->
				<div class="spacer">
					&nbsp;
				</div>
			</div>
			<!-- end content //-->
			<!-- start footer -->
			<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
 
			<!-- end footer //-->
		</div>
		<!-- end container //-->
		</body>
</html><?php }} ?>