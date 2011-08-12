<?php /* Smarty version 2.6.25, created on 2009-11-12 00:36:00
         compiled from module_file_tpl:CGExtensions%3Bedittemplate.tpl */ ?>
<div class="pageoverflow">
<h3><?php if (isset ( $this->_tpl_vars['module_description'] )): ?><?php echo $this->_tpl_vars['module_description']; ?>
 - <?php endif; ?><?php echo $this->_tpl_vars['title']; ?>
:</h3>
</div>
<?php echo $this->_tpl_vars['formstart']; ?>
<?php echo $this->_tpl_vars['hidden']; ?>

<?php if (isset ( $this->_tpl_vars['template_info'] )): ?>
<div class="pageoverflow">
  <?php echo $this->_tpl_vars['template_info']; ?>

</div>
<?php endif; ?>
<div class="pageoverflow">
  <p class="pagetext"><?php echo $this->_tpl_vars['prompt_templatename']; ?>
:</p>
  <p class="pageinput"><?php echo $this->_tpl_vars['templatename']; ?>
</p>
</div>
<div class="pageoverflow">
  <p class="pagetext"><?php echo $this->_tpl_vars['prompt_template']; ?>
:</p>
  <p class="pageinput"><?php echo $this->_tpl_vars['template']; ?>
</p>
</div>
<div class="pageoverflow">
  <p class="pagetext">&nbsp;</p>
  <p class="pageinput"><?php echo $this->_tpl_vars['submit']; ?>
<?php echo $this->_tpl_vars['cancel']; ?>
<?php echo $this->_tpl_vars['apply']; ?>
</p>
</div>
<?php echo $this->_tpl_vars['formend']; ?>
