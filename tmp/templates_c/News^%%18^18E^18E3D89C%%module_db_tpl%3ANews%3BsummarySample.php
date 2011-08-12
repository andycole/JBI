<?php /* Smarty version 2.6.25, created on 2009-11-08 19:48:33
         compiled from module_db_tpl:News%3BsummarySample */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cms_escape', 'module_db_tpl:News;summarySample', 17, false),array('modifier', 'cms_date_format', 'module_db_tpl:News;summarySample', 22, false),array('function', 'eval', 'module_db_tpl:News;summarySample', 34, false),)), $this); ?>
<?php $this->_cache_serials['/homepages/30/d170410374/htdocs/justbuyit/tmp/templates_c/News^%%18^18E^18E3D89C%%module_db_tpl%3ANews%3BsummarySample.inc'] = '775fab6fcbf74bbe2ad2335c758baeef'; ?><!-- Start News Display Template -->
<?php if ($this->_tpl_vars['pagecount'] > 1): ?>
  <p>
<?php if ($this->_tpl_vars['pagenumber'] > 1): ?>
<?php echo $this->_tpl_vars['firstpage']; ?>
&nbsp;<?php echo $this->_tpl_vars['prevpage']; ?>
&nbsp;
<?php endif; ?>
<?php echo $this->_tpl_vars['pagetext']; ?>
&nbsp;<?php echo $this->_tpl_vars['pagenumber']; ?>
&nbsp;<?php echo $this->_tpl_vars['oftext']; ?>
&nbsp;<?php echo $this->_tpl_vars['pagecount']; ?>

<?php if ($this->_tpl_vars['pagenumber'] < $this->_tpl_vars['pagecount']): ?>
&nbsp;<?php echo $this->_tpl_vars['nextpage']; ?>
&nbsp;<?php echo $this->_tpl_vars['lastpage']; ?>

<?php endif; ?>
</p>
<?php endif; ?>
<?php $_from = $this->_tpl_vars['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['entry']):
?>
<div class="NewsSummary">

<div class="NewsSummaryLink">
<a href="<?php echo $this->_tpl_vars['entry']->moreurl; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['entry']->title)) ? $this->_run_mod_handler('cms_escape', true, $_tmp, 'htmlall') : smarty_cms_modifier_cms_escape($_tmp, 'htmlall')); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['entry']->title)) ? $this->_run_mod_handler('cms_escape', true, $_tmp) : smarty_cms_modifier_cms_escape($_tmp)); ?>
</a>
</div>

<?php if ($this->_tpl_vars['entry']->postdate): ?>
	<div class="NewsSummaryPostdate">
		<?php echo ((is_array($_tmp=$this->_tpl_vars['entry']->postdate)) ? $this->_run_mod_handler('cms_date_format', true, $_tmp) : smarty_cms_modifier_cms_date_format($_tmp)); ?>

	</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['entry']->author): ?>
	<div class="NewsSummaryAuthor">
		<?php echo $this->_tpl_vars['author_label']; ?>
 <?php echo $this->_tpl_vars['entry']->author; ?>

	</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['entry']->summary): ?>
	<div class="NewsSummarySummary">
		<?php echo smarty_function_eval(array('var' => $this->_tpl_vars['entry']->summary), $this);?>

	</div>

	<div class="NewsSummaryMorelink">
		<?php echo $this->_tpl_vars['entry']->morelink; ?>
&raquo;
	</div>

<?php else: ?>

	<div class="NewsSummaryContent">
		<?php if ($this->caching && !$this->_cache_including): echo '{nocache:775fab6fcbf74bbe2ad2335c758baeef#0}'; endif;echo smarty_function_eval(array('var' => $this->_tpl_vars['entry']->content), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:775fab6fcbf74bbe2ad2335c758baeef#0}'; endif;?>

	</div>
<?php endif; ?>

<?php if (isset ( $this->_tpl_vars['entry']->extra )): ?>
    <div class="NewsSummaryExtra">
        <?php if ($this->caching && !$this->_cache_including): echo '{nocache:775fab6fcbf74bbe2ad2335c758baeef#1}'; endif;echo smarty_function_eval(array('var' => $this->_tpl_vars['entry']->extra), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:775fab6fcbf74bbe2ad2335c758baeef#1}'; endif;?>

	    </div>
<?php endif; ?>
<?php if (isset ( $this->_tpl_vars['entry']->fields )): ?>
  <?php $_from = $this->_tpl_vars['entry']->fields; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field']):
?>
     <div class="NewsSummaryField">
        <?php if ($this->_tpl_vars['field']->type == 'file'): ?>
          <img src="<?php echo $this->_tpl_vars['entry']->file_location; ?>
/<?php echo $this->_tpl_vars['field']->value; ?>
"/>
        <?php else: ?>
          <?php echo $this->_tpl_vars['field']->name; ?>
:&nbsp;<?php if ($this->caching && !$this->_cache_including): echo '{nocache:775fab6fcbf74bbe2ad2335c758baeef#2}'; endif;echo smarty_function_eval(array('var' => $this->_tpl_vars['field']->value), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:775fab6fcbf74bbe2ad2335c758baeef#2}'; endif;?>

        <?php endif; ?>
     </div>
  <?php endforeach; endif; unset($_from); ?>
<?php endif; ?>

</div>
<?php endforeach; endif; unset($_from); ?>
<!-- End News Display Template -->