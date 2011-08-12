<?php /* Smarty version 2.6.25, created on 2009-12-05 20:37:26
         compiled from module_file_tpl:CGExtensions%3Blisttemplates.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'module_file_tpl:CGExtensions;listtemplates.tpl', 12, false),)), $this); ?>
<?php $this->_cache_serials['/homepages/30/d170410374/htdocs/justbuyit/tmp/templates_c/CGExtensions^%%27^275^27507CDF%%module_file_tpl%3ACGExtensions%3Blisttemplates.tpl.inc'] = '75a826017e15ad24b674a2c7030a0b0a'; ?><div class="pageoverflow">
<table cellspacing="0" class="pagetable">
  <thead>
    <tr>
      <th width="75%"><?php echo $this->_tpl_vars['nameprompt']; ?>
</th>
      <th><?php echo $this->_tpl_vars['defaultprompt']; ?>
</th>
      <th class="pageicon">&nbsp;</th>
      <th class="pageicon">&nbsp;</th>
    </tr>
  </thead>
<?php $_from = $this->_tpl_vars['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['entry']):
?>
   <?php if ($this->caching && !$this->_cache_including): echo '{nocache:75a826017e15ad24b674a2c7030a0b0a#0}'; endif;echo smarty_function_cycle(array('values' => "row1,row2",'assign' => 'rowclass'), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:75a826017e15ad24b674a2c7030a0b0a#0}'; endif;?>

   <tr class="<?php echo $this->_tpl_vars['rowclass']; ?>
" onmouseover="this.className='<?php echo $this->_tpl_vars['rowclass']; ?>
hover';" onmouseout="this.className='<?php echo $this->_tpl_vars['rowclass']; ?>
';">
     <td><?php echo $this->_tpl_vars['entry']->name; ?>
</td>
     <td><?php echo $this->_tpl_vars['entry']->default; ?>
</td>
     <td><?php echo $this->_tpl_vars['entry']->editlink; ?>
</td>
     <td><?php echo $this->_tpl_vars['entry']->deletelink; ?>
</td>
   </tr>
<?php endforeach; endif; unset($_from); ?>
</table>
</div>
<div class="pageoverflow">
  <p class="pageoptions"><?php echo $this->_tpl_vars['newtemplatelink']; ?>
</p>
</div>