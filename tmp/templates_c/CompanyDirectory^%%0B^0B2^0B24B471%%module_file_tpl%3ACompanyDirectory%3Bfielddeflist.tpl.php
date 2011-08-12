<?php /* Smarty version 2.6.25, created on 2009-12-05 20:37:26
         compiled from module_file_tpl:CompanyDirectory%3Bfielddeflist.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'module_file_tpl:CompanyDirectory;fielddeflist.tpl', 35, false),)), $this); ?>
<?php $this->_cache_serials['/homepages/30/d170410374/htdocs/justbuyit/tmp/templates_c/CompanyDirectory^%%0B^0B2^0B24B471%%module_file_tpl%3ACompanyDirectory%3Bfielddeflist.tpl.inc'] = '02bd3c3e6834ec96c9f6ea4528044d45'; ?>
<?php if ($this->_tpl_vars['itemcount'] > 0): ?>
<table cellspacing="0" class="pagetable">
	<thead>
		<tr>
			<th><?php echo $this->_tpl_vars['fielddeftext']; ?>
</th>
			<th><?php echo $this->_tpl_vars['typetext']; ?>
</th>
			<th class="move">&nbsp;</th>
			<th class="pageicon">&nbsp;</th>
			<th class="pageicon">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php $_from = $this->_tpl_vars['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['entry']):
?>
	<?php if ($this->caching && !$this->_cache_including): echo '{nocache:02bd3c3e6834ec96c9f6ea4528044d45#0}'; endif;echo smarty_function_cycle(array('values' => "row1,row2",'assign' => 'rowclass'), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:02bd3c3e6834ec96c9f6ea4528044d45#0}'; endif;?>

		<tr class="<?php echo $this->_tpl_vars['rowclass']; ?>
" onmouseover="this.className='<?php echo $this->_tpl_vars['rowclass']; ?>
hover';" onmouseout="this.className='<?php echo $this->_tpl_vars['rowclass']; ?>
';">
			<td><?php echo $this->_tpl_vars['entry']->name; ?>
</td>
			<td><?php ob_start(); ?>field_<?php echo $this->_tpl_vars['entry']->type; ?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('tmp', ob_get_contents());ob_end_clean(); ?><?php echo $this->_tpl_vars['mod']->Lang($this->_tpl_vars['tmp']); ?>
</td>
			<td><?php echo $this->_tpl_vars['entry']->uplink; ?>
 <?php echo $this->_tpl_vars['entry']->downlink; ?>
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
</p></div>