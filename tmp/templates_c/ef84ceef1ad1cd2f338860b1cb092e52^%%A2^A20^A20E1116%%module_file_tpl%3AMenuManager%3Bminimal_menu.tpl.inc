<?php /* Smarty version 2.6.25, created on 2009-11-08 19:48:33
         compiled from module_file_tpl:MenuManager%3Bminimal_menu.tpl */

$this->_cache_serials['/homepages/30/d170410374/htdocs/justbuyit/tmp/templates_c/ef84ceef1ad1cd2f338860b1cb092e52^%%A2^A20^A20E1116%%module_file_tpl%3AMenuManager%3Bminimal_menu.tpl.inc'] = 'a97cc36a3e993a3ddfc4f080b88ca525';

?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'repeat', 'module_file_tpl:MenuManager;minimal_menu.tpl', 9, false),)), $this); ?>
<?php
function _smarty_tplfunc_a97cc36a3e993a3ddfc4f080b88ca525_0(&$_smarty)
{
echo smarty_cms_function_repeat(array('string' => "<ul>",'times' => $_smarty->_tpl_vars['node']->depth-$_smarty->_tpl_vars['node']->prevdepth), $_smarty);
}


function _smarty_tplfunc_a97cc36a3e993a3ddfc4f080b88ca525_1(&$_smarty)
{
echo smarty_cms_function_repeat(array('string' => "</li></ul>",'times' => $_smarty->_tpl_vars['node']->prevdepth-$_smarty->_tpl_vars['node']->depth), $_smarty);
}


function _smarty_tplfunc_a97cc36a3e993a3ddfc4f080b88ca525_2(&$_smarty)
{
echo smarty_cms_function_repeat(array('string' => "</li></ul>",'times' => $_smarty->_tpl_vars['node']->depth-1), $_smarty);
}



?>
