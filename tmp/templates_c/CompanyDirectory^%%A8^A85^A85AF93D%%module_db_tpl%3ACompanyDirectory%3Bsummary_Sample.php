<?php /* Smarty version 2.6.25, created on 2009-11-09 00:59:29
         compiled from module_db_tpl:CompanyDirectory%3Bsummary_Sample */ ?>
<?php if (isset ( $this->_tpl_vars['catformstart'] )): ?>
<?php echo $this->_tpl_vars['catformstart']; ?>

<?php echo $this->_tpl_vars['catdropdown']; ?>
<?php echo $this->_tpl_vars['catbutton']; ?>

<?php echo $this->_tpl_vars['catformend']; ?>

<?php endif; ?>

<?php if (isset ( $this->_tpl_vars['messages'] )): ?>
<div class="CompanyDirectoryMessage">
 <ul>
   <?php $_from = $this->_tpl_vars['messages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['one']):
?>
     <li><?php echo $this->_tpl_vars['one']; ?>
</li>
   <?php endforeach; endif; unset($_from); ?>
 </ul>
</div>
<?php endif; ?>

<?php if (isset ( $this->_tpl_vars['errors'] )): ?>
<div class="CompanyDirectoryError">
 <ul>
   <?php $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['one']):
?>
     <li><?php echo $this->_tpl_vars['one']; ?>
</li>
   <?php endforeach; endif; unset($_from); ?>
 </ul>
</div>
<?php endif; ?>

<?php if (isset ( $this->_tpl_vars['items'] )): ?>
<!--  <div>
  <?php echo $this->_tpl_vars['firstlink']; ?>
 <?php echo $this->_tpl_vars['prevlink']; ?>
  <?php echo $this->_tpl_vars['pagetext']; ?>
 <?php echo $this->_tpl_vars['curpage']; ?>
 <?php echo $this->_tpl_vars['oftext']; ?>
 <?php echo $this->_tpl_vars['pagecount']; ?>
  <?php echo $this->_tpl_vars['nextlink']; ?>
 <?php echo $this->_tpl_vars['lastlink']; ?>

  </div> -->

  <?php $_from = $this->_tpl_vars['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['entry']):
?>
  <div class="CompanyDirectoryItem">
<a href="<?php echo $this->_tpl_vars['entry']->detail_url; ?>
" class="store_link"><?php echo $this->_tpl_vars['entry']->company_name; ?>
</a>

<?php if ($this->_tpl_vars['entry']->logo_location != ''): ?>
<img src="<?php echo $this->_tpl_vars['entry']->logo_path; ?>
" /><br />
<?php endif; ?>

  <?php if ($this->_tpl_vars['entry']->website != ''): ?>
  <a href="<?php echo $this->_tpl_vars['entry']->website; ?>
" rel="nofollow" class="cta_btn">Go Shopping Now!</a>
  <?php endif; ?>
<br class="clear" />

  </div>
  <?php endforeach; endif; unset($_from); ?>
<?php endif; ?>