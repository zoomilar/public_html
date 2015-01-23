<?php /* Smarty version Smarty-3.1.12, created on 2015-01-20 12:30:56
         compiled from "8c36f505e814eccd8ba1353802724815713d321e" */ ?>
<?php /*%%SmartyHeaderCode:26902059454be2e60f395d0-27121234%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8c36f505e814eccd8ba1353802724815713d321e' => 
    array (
      0 => '8c36f505e814eccd8ba1353802724815713d321e',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '26902059454be2e60f395d0-27121234',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'kalba' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_54be2e6111db00_72876218',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54be2e6111db00_72876218')) {function content_54be2e6111db00_72876218($_smarty_tpl) {?><?php if (!is_callable('smarty_function_title')) include '/home/w2.texus.lt/domains/tuscias.w2.texus.lt/public_html/plugins/function.title.php';
if (!is_callable('smarty_function_sitename')) include '/home/w2.texus.lt/domains/tuscias.w2.texus.lt/public_html/plugins/function.sitename.php';
if (!is_callable('smarty_function_root_url')) include '/home/w2.texus.lt/domains/tuscias.w2.texus.lt/public_html/plugins/function.root_url.php';
if (!is_callable('smarty_function_metadata')) include '/home/w2.texus.lt/domains/tuscias.w2.texus.lt/public_html/plugins/function.metadata.php';
?><?php echo CMS_Content_Block::smarty_fetch_pagedata(array(),$_smarty_tpl);?>

<?php $_smarty_tpl->_capture_stack[0][] = array('default', "kalbumeniu", null); ob_start(); ?>
    <?php echo MenuManager::function_plugin(array('template'=>"lang",'number_of_levels'=>"1"),$_smarty_tpl);?>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php if ($_smarty_tpl->tpl_vars['kalba']->value!=''){?>
	<?php  $_config = new Smarty_Internal_Config("../../tmp/languages/".((string)$_smarty_tpl->tpl_vars['kalba']->value).".conf", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars("strings", 'global'); ?>
<?php }?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if lt IE 7]>      <html xmlns="http://www.w3.org/1999/xhtml" class="lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html xmlns="http://www.w3.org/1999/xhtml" class="lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html xmlns="http://www.w3.org/1999/xhtml" class="lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html xmlns="http://www.w3.org/1999/xhtml"> <!--<![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo smarty_function_title(array(),$_smarty_tpl);?>
 - <?php echo smarty_function_sitename(array(),$_smarty_tpl);?>
</title>
    <base href="<?php echo smarty_function_root_url(array(),$_smarty_tpl);?>
"/>
    <?php echo smarty_function_metadata(array(),$_smarty_tpl);?>



</head>

<body>
        	<?php }} ?>