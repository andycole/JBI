<?php /* Smarty version 2.6.25, created on 2009-11-12 00:36:49
         compiled from tpl_body:22 */

$this->_cache_serials['/homepages/30/d170410374/htdocs/justbuyit/tmp/templates_c/%%76^763^76313DB0%%tpl_body%3A22.inc'] = '0d2d80ac755bd9f6927533a00581a3a4';

?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'anchor', 'tpl_body:22', 7, false),array('function', 'cms_selflink', 'tpl_body:22', 18, false),array('function', 'search', 'tpl_body:22', 23, false),array('function', 'news', 'tpl_body:22', 65, false),array('function', 'title', 'tpl_body:22', 84, false),array('function', 'content', 'tpl_body:22', 85, false),array('function', 'menu', 'tpl_body:22', 124, false),array('function', 'global_content', 'tpl_body:22', 134, false),)), $this); ?>
<?php
function _smarty_tplfunc_0d2d80ac755bd9f6927533a00581a3a4_0(&$_smarty)
{
echo smarty_cms_function_anchor(array('anchor' => 'menu_vert','title' => 'Skip to navigation','accesskey' => 'n','text' => 'Skip to navigation'), $_smarty);
}


function _smarty_tplfunc_0d2d80ac755bd9f6927533a00581a3a4_1(&$_smarty)
{
echo smarty_cms_function_anchor(array('anchor' => 'main','title' => 'Skip to content','accesskey' => 's','text' => 'Skip to content'), $_smarty);
}


function _smarty_tplfunc_0d2d80ac755bd9f6927533a00581a3a4_2(&$_smarty)
{
echo smarty_cms_function_cms_selflink(array('dir' => 'start','text' => ($_smarty->_tpl_vars['sitename'])), $_smarty);
}


function _smarty_tplfunc_0d2d80ac755bd9f6927533a00581a3a4_3(&$_smarty)
{
echo smarty_cms_function_search(array('search_method' => 'post'), $_smarty);
}


function _smarty_tplfunc_0d2d80ac755bd9f6927533a00581a3a4_4(&$_smarty)
{
echo smarty_cms_function_news(array('number' => '3','detailpage' => 'news'), $_smarty);
}


function _smarty_tplfunc_0d2d80ac755bd9f6927533a00581a3a4_5(&$_smarty)
{
echo smarty_cms_function_title(array(), $_smarty);
}


function _smarty_tplfunc_0d2d80ac755bd9f6927533a00581a3a4_6(&$_smarty)
{
echo smarty_cms_function_content(array(), $_smarty);
}


function _smarty_tplfunc_0d2d80ac755bd9f6927533a00581a3a4_7(&$_smarty)
{
echo smarty_cms_function_anchor(array('anchor' => 'main','text' => '^&nbsp;&nbsp;Top'), $_smarty);
}


function _smarty_tplfunc_0d2d80ac755bd9f6927533a00581a3a4_8(&$_smarty)
{
echo smarty_cms_function_cms_selflink(array('dir' => 'previous','label' => "Previous page: "), $_smarty);
}


function _smarty_tplfunc_0d2d80ac755bd9f6927533a00581a3a4_9(&$_smarty)
{
echo smarty_cms_function_cms_selflink(array('dir' => 'next'), $_smarty);
}


function _smarty_tplfunc_0d2d80ac755bd9f6927533a00581a3a4_10(&$_smarty)
{
echo smarty_cms_function_menu(array('template' => 'minimal_menu.tpl','number_of_levels' => '1'), $_smarty);
}


function _smarty_tplfunc_0d2d80ac755bd9f6927533a00581a3a4_11(&$_smarty)
{
echo smarty_cms_function_menu(array('template' => 'minimal_menu.tpl','start_level' => '2'), $_smarty);
}


function _smarty_tplfunc_0d2d80ac755bd9f6927533a00581a3a4_12(&$_smarty)
{
echo smarty_cms_function_global_content(array('name' => 'footer'), $_smarty);
}



?>
