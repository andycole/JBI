<?php /* Smarty version 2.6.25, created on 2009-11-12 23:30:45
         compiled from module_db_tpl:News%3BdetailSample */

$this->_cache_serials['/homepages/30/d170410374/htdocs/justbuyit/tmp/templates_c/News^%%E8^E85^E85D59E8%%module_db_tpl%3ANews%3BdetailSample.inc'] = '492024d4a515b769bea6774f6237e882';

?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cms_date_format', 'module_db_tpl:News;detailSample', 8, false),array('modifier', 'cms_escape', 'module_db_tpl:News;detailSample', 11, false),array('function', 'eval', 'module_db_tpl:News;detailSample', 18, false),)), $this); ?>
<?php
function _smarty_tplfunc_492024d4a515b769bea6774f6237e882_0(&$_smarty)
{
echo smarty_function_eval(array('var' => $_smarty->_tpl_vars['entry']->summary), $_smarty);
}


function _smarty_tplfunc_492024d4a515b769bea6774f6237e882_1(&$_smarty)
{
echo smarty_function_eval(array('var' => $_smarty->_tpl_vars['entry']->content), $_smarty);
}


function _smarty_tplfunc_492024d4a515b769bea6774f6237e882_2(&$_smarty)
{
echo smarty_function_eval(array('var' => $_smarty->_tpl_vars['field']->value), $_smarty);
}



?>
