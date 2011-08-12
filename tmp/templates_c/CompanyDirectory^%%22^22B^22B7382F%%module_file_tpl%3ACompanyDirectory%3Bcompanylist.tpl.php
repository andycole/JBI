<?php /* Smarty version 2.6.25, created on 2009-12-05 20:37:26
         compiled from module_file_tpl:CompanyDirectory%3Bcompanylist.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'module_file_tpl:CompanyDirectory;companylist.tpl', 35, false),)), $this); ?>

<?php if ($this->_tpl_vars['itemcount'] > 0): ?>
<table cellspacing="0" class="pagetable">
	<thead>
		<tr>
			<th><?php echo $this->_tpl_vars['idtext']; ?>
</th>
			<th><?php echo $this->_tpl_vars['companytext']; ?>
</th>
			<th><?php echo $this->_tpl_vars['websitetext']; ?>
</th>
			<th class="pageicon">&nbsp;</th>
			<th class="pageicon">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php $_from = $this->_tpl_vars['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['entry']):
?>
	<?php echo smarty_function_cycle(array('values' => "row1,row2",'assign' => 'rowclass'), $this);?>

		<tr class="<?php echo $this->_tpl_vars['rowclass']; ?>
" onmouseover="this.className='<?php echo $this->_tpl_vars['rowclass']; ?>
hover';" onmouseout="this.className='<?php echo $this->_tpl_vars['rowclass']; ?>
';">
			<td><?php echo $this->_tpl_vars['entry']->id; ?>
</td>
			<td><?php echo $this->_tpl_vars['entry']->company_name; ?>
</td>
			<td><?php echo $this->_tpl_vars['entry']->website; ?>
</td>
			<td><?php echo $this->_tpl_vars['entry']->editlink; ?>
</td>
			<td><?php echo $this->_tpl_vars['entry']->deletelink; ?>
</td>
		</tr>
<?php endforeach; endif; unset($_from); ?>
	</tbody>
</table>
<?php endif; ?>

<div class="pageoptions"><p class="pageoptions"><?php echo $this->_tpl_vars['addlink']; ?>
<?php if (isset ( $this->_tpl_vars['exportcsv'] )): ?>&nbsp;&nbsp;<?php echo $this->_tpl_vars['exportcsv']; ?>
<?php endif; ?>&nbsp;&nbsp;<?php echo $this->_tpl_vars['importcsv']; ?>
<?php echo $this->_tpl_vars['importkml']; ?>
</p></div>