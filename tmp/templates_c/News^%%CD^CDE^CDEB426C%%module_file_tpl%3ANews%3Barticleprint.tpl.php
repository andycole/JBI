<?php /* Smarty version 2.6.25, created on 2009-11-14 05:17:52
         compiled from module_file_tpl:News%3Barticleprint.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cms_date_format', 'module_file_tpl:News;articleprint.tpl', 10, false),array('function', 'eval', 'module_file_tpl:News;articleprint.tpl', 32, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
  <title><?php echo $this->_tpl_vars['entry']->title; ?>
</title>
</head>
<body>
<pre>
Categories: <?php echo $this->_tpl_vars['entry']->category; ?>

      Date: <?php echo ((is_array($_tmp=$this->_tpl_vars['entry']->postdate)) ? $this->_run_mod_handler('cms_date_format', true, $_tmp) : smarty_cms_modifier_cms_date_format($_tmp)); ?>

     Title: <?php echo $this->_tpl_vars['entry']->title; ?>

</pre>

<?php if ($this->_tpl_vars['entry']->summary): ?>

<?php echo $this->_tpl_vars['entry']->summary; ?>

<br />
<br />

<?php endif; ?>

<?php echo $this->_tpl_vars['entry']->content; ?>



<?php if (isset ( $this->_tpl_vars['entry']->fields )): ?>
  <?php $_from = $this->_tpl_vars['entry']->fields; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field']):
?>
     <div class="NewsDetailField">
        <?php if ($this->_tpl_vars['field']->type == 'file'): ?>
	            <img src="<?php echo $this->_tpl_vars['entry']->file_location; ?>
/<?php echo $this->_tpl_vars['field']->value; ?>
"/>
        <?php else: ?>
          <?php echo $this->_tpl_vars['field']->name; ?>
:&nbsp;<?php echo smarty_function_eval(array('var' => $this->_tpl_vars['field']->value), $this);?>

        <?php endif; ?>
     </div>
  <?php endforeach; endif; unset($_from); ?>
<?php endif; ?>


</body>
</html>