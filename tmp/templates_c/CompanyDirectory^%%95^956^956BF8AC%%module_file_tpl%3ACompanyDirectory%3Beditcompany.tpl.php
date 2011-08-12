<?php /* Smarty version 2.6.25, created on 2009-12-05 20:36:58
         compiled from module_file_tpl:CompanyDirectory%3Beditcompany.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'module_action_link', 'module_file_tpl:CompanyDirectory;editcompany.tpl', 24, false),)), $this); ?>
<?php $this->_cache_serials['/homepages/30/d170410374/htdocs/justbuyit/tmp/templates_c/CompanyDirectory^%%95^956^956BF8AC%%module_file_tpl%3ACompanyDirectory%3Beditcompany.tpl.inc'] = '1f5f1224bd3faafa1a7c1d8a2d03cb81'; ?>
<script type="text/javascript">
var actionid = '<?php echo $this->_tpl_vars['actionid']; ?>
';
var ajaxurl  = '<?php if ($this->caching && !$this->_cache_including): echo '{nocache:1f5f1224bd3faafa1a7c1d8a2d03cb81#0}'; endif;echo module_action_link(array('module' => 'CGGoogleMaps','action' => 'getgeocode','urlonly' => 1), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:1f5f1224bd3faafa1a7c1d8a2d03cb81#0}'; endif;?>
' + '&suppressoutput=false';
<?php echo '
function geocode_lookup()
{
  if( typeof jQuery == \'undefined\') 
  {
    return false;
  }

  // 1.  Get the address
  var $tmp = document.getElementsByName(actionid+\'address\');
  var $address = $tmp[0].value;

  // 2.  do the ajax request
  var url = ajaxurl.replace(/amp;/g,\'\');
  var lat = 0;
  var long = 0;
  jQuery.post(url, \'m1_address=\'+$address,
	function(data) { 
          if( data.status == \'success\' ) {
            lat = data.lat; long=data.lon;
         
            var latfield = document.getElementsByName(actionid+\'latitude\')[0];
            var longfield = document.getElementsByName(actionid+\'longitude\')[0];	
	    latfield.value = lat;
	    longfield.value = long;
          }
	}, "json" );

  // 3.  parse the result
  // 4.  populate fields.

  return false;
}

'; ?>

</script>

<?php echo $this->_tpl_vars['startform']; ?>

<?php if (isset ( $this->_tpl_vars['compid'] )): ?>
	<div class="pageoverflow">
		<p class="pagetext"><?php echo $this->_tpl_vars['idtext']; ?>
:</p>
		<p class="pageinput"><?php echo $this->_tpl_vars['compid']; ?>
</p>
	</div>
<?php endif; ?>
	<div class="pageoverflow">
		<p class="pagetext">*<?php echo $this->_tpl_vars['nametext']; ?>
:</p>
		<p class="pageinput"><?php echo $this->_tpl_vars['inputname']; ?>
</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext"><?php echo $this->_tpl_vars['addresstext']; ?>
:</p>
		<p class="pageinput"><?php echo $this->_tpl_vars['inputaddress']; ?>
&nbsp;
                  <?php if (isset ( $this->_tpl_vars['can_geocode'] )): ?>
                  <input type="submit" name="<?php echo $this->_tpl_vars['actionid']; ?>
lookup" value="<?php echo $this->_tpl_vars['mod']->Lang('lookup'); ?>
" onclick="geocode_lookup(); return false;"/>
                  <?php endif; ?>
                </p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext"><?php echo $this->_tpl_vars['mod']->Lang('latitude'); ?>
:</p>
		<p class="pageinput"><?php echo $this->_tpl_vars['inputlatitude']; ?>
</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext"><?php echo $this->_tpl_vars['mod']->Lang('longitude'); ?>
:</p>
		<p class="pageinput"><?php echo $this->_tpl_vars['inputlongitude']; ?>
</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext"><?php echo $this->_tpl_vars['telephonetext']; ?>
:</p>
		<p class="pageinput"><?php echo $this->_tpl_vars['inputtelephone']; ?>
</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext"><?php echo $this->_tpl_vars['faxtext']; ?>
:</p>
		<p class="pageinput"><?php echo $this->_tpl_vars['inputfax']; ?>
</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext"><?php echo $this->_tpl_vars['emailtext']; ?>
:</p>
		<p class="pageinput"><?php echo $this->_tpl_vars['inputemail']; ?>
</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext"><?php echo $this->_tpl_vars['websitetext']; ?>
:</p>
		<p class="pageinput"><?php echo $this->_tpl_vars['inputwebsite']; ?>
</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext"><?php echo $this->_tpl_vars['statustext']; ?>
:</p>
		<p class="pageinput"><?php echo $this->_tpl_vars['inputstatus']; ?>
</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext"><?php echo $this->_tpl_vars['detailstext']; ?>
:</p>
		<p class="pageinput"><?php echo $this->_tpl_vars['inputdetails']; ?>
</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext"><?php echo $this->_tpl_vars['imagetext']; ?>
:</p>
		<p class="pageinput"><?php echo $this->_tpl_vars['imageupload']; ?>
 <?php if ($this->_tpl_vars['imagecurrent'] != ''): ?><?php echo $this->_tpl_vars['currentimagetext']; ?>
: <?php echo $this->_tpl_vars['imagecurrent']; ?>
<?php echo $this->_tpl_vars['imagecurrenthidden']; ?>
<?php endif; ?></p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext"><?php echo $this->_tpl_vars['logotext']; ?>
:</p>
		<p class="pageinput"><?php echo $this->_tpl_vars['logoupload']; ?>
 <?php if ($this->_tpl_vars['logocurrent'] != ''): ?><?php echo $this->_tpl_vars['currentlogotext']; ?>
: <?php echo $this->_tpl_vars['logocurrent']; ?>
<?php echo $this->_tpl_vars['logocurrenthidden']; ?>
<?php endif; ?></p>
	</div>
	<?php if ($this->_tpl_vars['customfieldscount'] > 0): ?>
		<?php $_from = $this->_tpl_vars['customfields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['customfield']):
?>
			<div class="pageoverflow">
				<p class="pagetext"><?php echo $this->_tpl_vars['customfield']->name; ?>
:</p>
				<p class="pageinput"><?php echo $this->_tpl_vars['customfield']->input_box; ?>
</p>
			</div>
		<?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['categoriescount'] > 0): ?>
		<?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['category']):
?>
			<div class="pageoverflow">
				<p class="pagetext"><?php echo $this->_tpl_vars['category']->name; ?>
:</p>
				<p class="pageinput"><?php echo $this->_tpl_vars['category']->checkbox; ?>
</p>
			</div>
		<?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>
	<div class="pageoverflow">
		<p class="pagetext">&nbsp;</p>
		<p class="pageinput"><?php echo $this->_tpl_vars['hidden']; ?>
<?php echo $this->_tpl_vars['submit']; ?>
<?php echo $this->_tpl_vars['cancel']; ?>
</p>
	</div>
<?php echo $this->_tpl_vars['endform']; ?>
