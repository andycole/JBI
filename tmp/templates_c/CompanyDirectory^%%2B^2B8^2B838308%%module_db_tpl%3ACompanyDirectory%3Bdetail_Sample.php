<?php /* Smarty version 2.6.25, created on 2009-11-12 00:36:03
         compiled from module_db_tpl:CompanyDirectory%3Bdetail_Sample */ ?>
<div class="CompanyDirectoryItem">


<?php echo $this->_tpl_vars['entry']->company_name; ?>
<br />

<?php if ($this->_tpl_vars['entry']->address != ''): ?>
Address: <?php echo $this->_tpl_vars['entry']->address; ?>
<br />
<?php endif; ?>

<?php if ($this->_tpl_vars['entry']->telephone != ''): ?>
Telephone: <?php echo $this->_tpl_vars['entry']->telephone; ?>
<br />
<?php endif; ?>

<?php if ($this->_tpl_vars['entry']->fax != ''): ?>
Fax: <?php echo $this->_tpl_vars['entry']->fax; ?>

<?php endif; ?>

<?php if ($this->_tpl_vars['entry']->contact_email != ''): ?>
Contact Email: <a href="mailto:<?php echo $this->_tpl_vars['entry']->contact_email; ?>
"><?php echo $this->_tpl_vars['entry']->contact_email; ?>
</a><br />
<?php endif; ?>

<?php if ($this->_tpl_vars['entry']->website != ''): ?>
<a href="<?php echo $this->_tpl_vars['entry']->website; ?>
" rel="nofollow" class="cta_btn">Go Shopping on <br/> <?php echo $this->_tpl_vars['entry']->company_name; ?>
!</a>
<?php endif; ?>
<br class="clear" />

<!--<?php if ($this->_tpl_vars['entry']->details != ''): ?>
Details:<br />
<?php echo $this->_tpl_vars['entry']->details; ?>
<br />
<?php endif; ?>-->

<?php if ($this->_tpl_vars['entry']->picture_location != ''): ?>
Picture: <img src="<?php echo $this->_tpl_vars['entry']->picture_path; ?>
" /><br />
<?php endif; ?>

<?php if ($this->_tpl_vars['entry']->logo_location != ''): ?>
<img src="<?php echo $this->_tpl_vars['entry']->logo_path; ?>
" /><br />
<?php endif; ?>

<?php if ($this->_tpl_vars['customfieldscount'] > 0): ?>
	<?php $_from = $this->_tpl_vars['customfields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['customfield']):
?>
		<?php echo $this->_tpl_vars['customfield']->name; ?>
: <?php echo $this->_tpl_vars['customfield']->value; ?>
<br />
	<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>

</div>