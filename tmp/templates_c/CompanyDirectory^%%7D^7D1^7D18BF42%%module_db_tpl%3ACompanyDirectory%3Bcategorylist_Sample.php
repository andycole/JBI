<?php /* Smarty version 2.6.25, created on 2009-11-08 19:52:11
         compiled from module_db_tpl:CompanyDirectory%3Bcategorylist_Sample */ ?>
<?php $_from = $this->_tpl_vars['categorylist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['obj']):
?>
  <div class="CompanyDirectoryCategory">
  <?php if (isset ( $this->_tpl_vars['obj']->count ) && $this->_tpl_vars['obj']->count > 0): ?>
    <a href="<?php echo $this->_tpl_vars['obj']->summary_url; ?>
"><?php echo $this->_tpl_vars['obj']->name; ?>
</a><span class="dir-count">(<?php echo $this->_tpl_vars['obj']->count; ?>
)</span>
  <?php else: ?>
    <?php echo $this->_tpl_vars['obj']->name; ?>
 (0)
  <?php endif; ?>
  </div>
<?php endforeach; endif; unset($_from); ?>