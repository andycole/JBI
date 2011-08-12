<?php /* Smarty version 2.6.25, created on 2009-12-13 13:50:17
         compiled from siteprefs.tpl */

$this->_cache_serials['/homepages/30/d170410374/htdocs/justbuyit/tmp/templates_c/%%1B^1B2^1B2DE232%%siteprefs.tpl.inc'] = 'c7393878fae6a1aaf3cd8b98908a2dd6';

?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'siteprefs.tpl', 25, false),)), $this); ?>
<?php
function _smarty_tplfunc_c7393878fae6a1aaf3cd8b98908a2dd6_0(&$_smarty)
{
echo smarty_function_html_options(array('options' => $_smarty->_tpl_vars['wysiwyg'],'selected' => $_smarty->_tpl_vars['frontendwysiwyg']), $_smarty);
}


function _smarty_tplfunc_c7393878fae6a1aaf3cd8b98908a2dd6_1(&$_smarty)
{
echo smarty_function_html_options(array('options' => $_smarty->_tpl_vars['themes'],'selected' => $_smarty->_tpl_vars['logintheme']), $_smarty);
}


function _smarty_tplfunc_c7393878fae6a1aaf3cd8b98908a2dd6_2(&$_smarty)
{
echo smarty_function_html_options(array('options' => $_smarty->_tpl_vars['templates'],'selected' => $_smarty->_tpl_vars['custom404template']), $_smarty);
}


function _smarty_tplfunc_c7393878fae6a1aaf3cd8b98908a2dd6_3(&$_smarty)
{
echo smarty_function_html_options(array('options' => $_smarty->_tpl_vars['all_attributes'],'selected' => $_smarty->_tpl_vars['basic_attributes']), $_smarty);
}



?>
