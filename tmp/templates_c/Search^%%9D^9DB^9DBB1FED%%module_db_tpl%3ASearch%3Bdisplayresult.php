<?php /* Smarty version 2.6.25, created on 2009-11-09 00:59:45
         compiled from module_db_tpl:Search%3Bdisplayresult */ ?>
<h3><?php echo $this->_tpl_vars['searchresultsfor']; ?>
 &quot;<?php echo $this->_tpl_vars['phrase']; ?>
&quot;</h3>
<?php if ($this->_tpl_vars['itemcount'] > 0): ?>
<ul>
  <?php $_from = $this->_tpl_vars['results']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['entry']):
?>
  <li><a href="<?php echo $this->_tpl_vars['entry']->url; ?>
"><?php echo $this->_tpl_vars['entry']->urltxt; ?>
</a> (Relevance <?php echo $this->_tpl_vars['entry']->weight; ?>
%)</li>
    <?php endforeach; endif; unset($_from); ?>
</ul>

<!--<p><?php echo $this->_tpl_vars['timetaken']; ?>
: <?php echo $this->_tpl_vars['timetook']; ?>
</p>-->
<?php else: ?>
  <p><strong><?php echo $this->_tpl_vars['noresultsfound']; ?>
</strong></p>
<?php endif; ?>