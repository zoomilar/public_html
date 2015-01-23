<?php /* Smarty version Smarty-3.1.12, created on 2015-01-23 11:48:37
         compiled from "tpl_body:26" */ ?>
<?php /*%%SmartyHeaderCode:124270989554be2e60d55116-46922375%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ad8109c5108364fff0b4269a015ffc8d99f9e790' => 
    array (
      0 => 'tpl_body:26',
      1 => 1422006517,
      2 => 'tpl_body',
    ),
  ),
  'nocache_hash' => '124270989554be2e60d55116-46922375',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_54be2e60f2fd74_41384455',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54be2e60f2fd74_41384455')) {function content_54be2e60f2fd74_41384455($_smarty_tpl) {?><?php if (!is_callable('smarty_function_cms_include')) include '/home/w4.texus.lt/domains/alna.w4.texus.lt/public_html/lib/smarty/plugins/function.cms_include.php';
?><?php if (isset($_smarty_tpl->tpl_vars["titulinis"])) {$_smarty_tpl->tpl_vars["titulinis"] = clone $_smarty_tpl->tpl_vars["titulinis"];
$_smarty_tpl->tpl_vars["titulinis"]->value = 1; $_smarty_tpl->tpl_vars["titulinis"]->nocache = null; $_smarty_tpl->tpl_vars["titulinis"]->scope = 0;
} else $_smarty_tpl->tpl_vars["titulinis"] = new Smarty_variable(1, null, 0);?>

<?php echo smarty_function_cms_include(array('tpl'=>"header"),$_smarty_tpl);?>



<?php echo smarty_function_cms_include(array('tpl'=>"footer"),$_smarty_tpl);?>

 
<?php }} ?>