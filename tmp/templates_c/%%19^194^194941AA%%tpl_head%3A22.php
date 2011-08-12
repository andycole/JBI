<?php /* Smarty version 2.6.25, created on 2009-11-12 00:36:49
         compiled from tpl_head:22 */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'title', 'tpl_head:22', 4, false),array('function', 'sitename', 'tpl_head:22', 4, false),array('function', 'metadata', 'tpl_head:22', 7, false),array('function', 'stylesheet', 'tpl_head:22', 10, false),array('function', 'cms_selflink', 'tpl_head:22', 13, false),)), $this); ?>
<?php $this->_cache_serials['/homepages/30/d170410374/htdocs/justbuyit/tmp/templates_c/%%19^194^194941AA%%tpl_head%3A22.inc'] = 'eb71102117c31d02fcbd272d493e46c7'; ?><head>
<?php if (isset ( $this->_tpl_vars['canonical'] )): ?><link rel="canonical" href="<?php echo $this->_tpl_vars['canonical']; ?>
" /><?php elseif (isset ( $this->_tpl_vars['content_obj'] )): ?><link rel="canonical" href="<?php echo $this->_tpl_vars['content_obj']->GetURL(); ?>
" /><?php endif; ?>

<title><?php if ($this->caching && !$this->_cache_including): echo '{nocache:eb71102117c31d02fcbd272d493e46c7#0}'; endif;echo smarty_cms_function_title(array(), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:eb71102117c31d02fcbd272d493e46c7#0}'; endif;?>
 | <?php if ($this->caching && !$this->_cache_including): echo '{nocache:eb71102117c31d02fcbd272d493e46c7#1}'; endif;echo smarty_cms_function_sitename(array(), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:eb71102117c31d02fcbd272d493e46c7#1}'; endif;?>
</title>

<?php if ($this->caching && !$this->_cache_including): echo '{nocache:eb71102117c31d02fcbd272d493e46c7#2}'; endif;echo smarty_cms_function_metadata(array(), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:eb71102117c31d02fcbd272d493e46c7#2}'; endif;?>


<?php if ($this->caching && !$this->_cache_including): echo '{nocache:eb71102117c31d02fcbd272d493e46c7#3}'; endif;echo smarty_cms_function_stylesheet(array(), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:eb71102117c31d02fcbd272d493e46c7#3}'; endif;?>


<?php if ($this->caching && !$this->_cache_including): echo '{nocache:eb71102117c31d02fcbd272d493e46c7#4}'; endif;echo smarty_cms_function_cms_selflink(array('dir' => 'start','rellink' => 1), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:eb71102117c31d02fcbd272d493e46c7#4}'; endif;?>

<?php if ($this->caching && !$this->_cache_including): echo '{nocache:eb71102117c31d02fcbd272d493e46c7#5}'; endif;echo smarty_cms_function_cms_selflink(array('dir' => 'prev','rellink' => 1), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:eb71102117c31d02fcbd272d493e46c7#5}'; endif;?>

<?php if ($this->caching && !$this->_cache_including): echo '{nocache:eb71102117c31d02fcbd272d493e46c7#6}'; endif;echo smarty_cms_function_cms_selflink(array('dir' => 'next','rellink' => 1), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:eb71102117c31d02fcbd272d493e46c7#6}'; endif;?>


<!--[if IE 6]>
<script type="text/javascript" src="modules/MenuManager/CSSMenu.js"></script>
<![endif]-->

<?php echo '
<!--[if IE 6]>
<script type="text/javascript"  src="uploads/NCleanBlue/js/ie6fix.js"></script>
<script type="text/javascript">
 // argument is a CSS selector
 DD_belatedPNG.fix(\'.sbar-top,.sbar-bottom,.main-top,.main-bottom,#version\');
</script>
<style type="text/css">
/* enable background image caching in IE6 */
html {filter:expression(document.execCommand("BackgroundImageCache", false, true));} 
</style>
<![endif]-->
'; ?>


  </head>