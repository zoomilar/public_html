<?php /* Smarty version Smarty-3.1.12, created on 2014-12-10 13:58:37
         compiled from "/home/w2.texus.lt/domains/tuscias.w2.texus.lt/public_html/admin/themes/OneEleven/templates/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12437039725488356d1784b7-98734349%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c381944b3f11f9bfc855111e617d29f38ae40c2e' => 
    array (
      0 => '/home/w2.texus.lt/domains/tuscias.w2.texus.lt/public_html/admin/themes/OneEleven/templates/footer.tpl',
      1 => 1406716205,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12437039725488356d1784b7-98734349',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'marks' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5488356d216cd9_56981738',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5488356d216cd9_56981738')) {function content_5488356d216cd9_56981738($_smarty_tpl) {?><?php if (!is_callable('smarty_function_cms_version')) include '/home/w2.texus.lt/domains/tuscias.w2.texus.lt/public_html/plugins/function.cms_version.php';
if (!is_callable('smarty_function_cms_versionname')) include '/home/w2.texus.lt/domains/tuscias.w2.texus.lt/public_html/plugins/function.cms_versionname.php';
?><footer id="oe_footer" class="cf"><div class="footer-left"><small class="copyright">Copyright &copy; <a rel="external" href="http://www.cmsmadesimple.org">CMS Made Simple&trade; <?php echo smarty_function_cms_version(array(),$_smarty_tpl);?>
 &ldquo;<?php echo smarty_function_cms_versionname(array(),$_smarty_tpl);?>
&rdquo;</a></small></div><?php if (isset($_smarty_tpl->tpl_vars['marks']->value)){?><div class="footer-right cf"><ul class="links"><li><a href="http://docs.cmsmadesimple.org/" rel="external" title="<?php echo lang('documentation');?>
"><?php echo lang('documentation');?>
</a></li><li><a href="http://forum.cmsmadesimple.org/" rel="external" title="<?php echo lang('forums');?>
"><?php echo lang('forums');?>
</a></li><li><a href="http://www.cmsmadesimple.org/about-link/" rel="external" title="<?php echo lang('about');?>
"><?php echo lang('about');?>
</a></li><li><a href="http://www.cmsmadesimple.org/about-link/about-us/" rel="external" title="<?php echo lang('team');?>
"><?php echo lang('team');?>
</a></li></ul></div><?php }?></footer><?php }} ?>