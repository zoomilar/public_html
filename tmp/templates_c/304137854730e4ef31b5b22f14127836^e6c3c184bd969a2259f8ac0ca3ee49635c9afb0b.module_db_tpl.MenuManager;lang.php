<?php /* Smarty version Smarty-3.1.12, created on 2015-01-20 12:30:57
         compiled from "module_db_tpl:MenuManager;lang" */ ?>
<?php /*%%SmartyHeaderCode:181283949854be2e611e3f44-08390088%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e6c3c184bd969a2259f8ac0ca3ee49635c9afb0b' => 
    array (
      0 => 'module_db_tpl:MenuManager;lang',
      1 => 1413295416,
      2 => 'module_db_tpl',
    ),
  ),
  'nocache_hash' => '181283949854be2e611e3f44-08390088',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'nodelist' => 0,
    'node' => 0,
    'kalba2' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_54be2e612efdb6_19612198',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54be2e612efdb6_19612198')) {function content_54be2e612efdb6_19612198($_smarty_tpl) {?><div class="langs_drop">
    <ul class="drop">
        <?php if (isset($_smarty_tpl->tpl_vars['kiekkalbu'])) {$_smarty_tpl->tpl_vars['kiekkalbu'] = clone $_smarty_tpl->tpl_vars['kiekkalbu'];
$_smarty_tpl->tpl_vars['kiekkalbu']->value = count($_smarty_tpl->tpl_vars['nodelist']->value); $_smarty_tpl->tpl_vars['kiekkalbu']->nocache = null; $_smarty_tpl->tpl_vars['kiekkalbu']->scope = 0;
} else $_smarty_tpl->tpl_vars['kiekkalbu'] = new Smarty_variable(count($_smarty_tpl->tpl_vars['nodelist']->value), null, 0);?>
        <?php  $_smarty_tpl->tpl_vars['node'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['node']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['nodelist']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['node']->key => $_smarty_tpl->tpl_vars['node']->value){
$_smarty_tpl->tpl_vars['node']->_loop = true;
?>
            <?php if ($_smarty_tpl->tpl_vars['node']->value->depth==1){?>
                <li class="<?php if (($_smarty_tpl->tpl_vars['node']->value->current==true)||($_smarty_tpl->tpl_vars['node']->value->parent)){?> selected<?php if (isset($_smarty_tpl->tpl_vars['kalba'])) {$_smarty_tpl->tpl_vars['kalba'] = clone $_smarty_tpl->tpl_vars['kalba'];
$_smarty_tpl->tpl_vars['kalba']->value = $_smarty_tpl->tpl_vars['node']->value->alias; $_smarty_tpl->tpl_vars['kalba']->nocache = null; $_smarty_tpl->tpl_vars['kalba']->scope = 0;
} else $_smarty_tpl->tpl_vars['kalba'] = new Smarty_variable($_smarty_tpl->tpl_vars['node']->value->alias, null, 0);?><?php if (isset($_smarty_tpl->tpl_vars['kalba2'])) {$_smarty_tpl->tpl_vars['kalba2'] = clone $_smarty_tpl->tpl_vars['kalba2'];
$_smarty_tpl->tpl_vars['kalba2']->value = $_smarty_tpl->tpl_vars['node']->value->menutext; $_smarty_tpl->tpl_vars['kalba2']->nocache = null; $_smarty_tpl->tpl_vars['kalba2']->scope = 0;
} else $_smarty_tpl->tpl_vars['kalba2'] = new Smarty_variable($_smarty_tpl->tpl_vars['node']->value->menutext, null, 0);?><?php }?>"><a href="/<?php echo $_smarty_tpl->tpl_vars['node']->value->alias;?>
/"><?php echo $_smarty_tpl->tpl_vars['node']->value->menutext;?>
</a></li>
            <?php }?>
        <?php } ?>
    </ul>
    <a href="#"><?php echo $_smarty_tpl->tpl_vars['kalba2']->value;?>
</a>
</div>
<?php }} ?>