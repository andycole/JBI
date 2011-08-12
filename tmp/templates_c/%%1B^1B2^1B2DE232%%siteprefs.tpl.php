<?php /* Smarty version 2.6.25, created on 2009-12-13 13:50:17
         compiled from siteprefs.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'siteprefs.tpl', 25, false),)), $this); ?>
<?php $this->_cache_serials['/homepages/30/d170410374/htdocs/justbuyit/tmp/templates_c/%%1B^1B2^1B2DE232%%siteprefs.tpl.inc'] = 'c7393878fae6a1aaf3cd8b98908a2dd6'; ?><?php echo $this->_tpl_vars['mod']->StartTabHeaders(); ?>

<?php echo $this->_tpl_vars['mod']->SetTabHeader('general',$this->_tpl_vars['lang_general'],$this->_tpl_vars['active_general']); ?>

<?php echo $this->_tpl_vars['mod']->SetTabHeader('sitedown',$this->_tpl_vars['lang_sitedown'],$this->_tpl_vars['active_sitedown']); ?>

<?php echo $this->_tpl_vars['mod']->SetTabHeader('handle_404',$this->_tpl_vars['lang_handle404'],$this->_tpl_vars['active_handle_404']); ?>

<?php echo $this->_tpl_vars['mod']->SetTabHeader('setup',$this->_tpl_vars['lang_setup'],$this->_tpl_vars['active_setup']); ?>

<?php echo $this->_tpl_vars['mod']->EndTabHeaders(); ?>

<?php echo $this->_tpl_vars['mod']->StartTabContent(); ?>


<?php echo $this->_tpl_vars['mod']->StartTab('general'); ?>

<form id="siteprefform_general" method="post" action="siteprefs.php">
<div>
  <input type="hidden" name="<?php echo $this->_tpl_vars['SECURE_PARAM_NAME']; ?>
" value="<?php echo $this->_tpl_vars['CMS_USER_KEY']; ?>
"/>
  <input type="hidden" name="active_tab" value="general" />
  <input type="hidden" name="editsiteprefs" value="true" />
</div>

<div class="pageoverflow">
  <p class="pagetext"><?php echo $this->_tpl_vars['lang_sitename']; ?>
</p>
  <p class="pageinput"><input type="text" class="pagesmalltextarea" name="sitename" size="30" value="<?php echo $this->_tpl_vars['sitename']; ?>
" /></p>
</div>
<div class="pageoverflow">
  <p class="pagetext"><?php echo $this->_tpl_vars['lang_frontendlang']; ?>
</p>
  <p class="pageinput">
    <select name="frontendlang" style="vertical-align: middle;">
       <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['languages'],'selected' => $this->_tpl_vars['frontendlang']), $this);?>

    </select>
  </p>
</div>

<div class="pageoverflow">
	<p class="pagetext"><?php echo $this->_tpl_vars['lang_frontendwysiwygtouse']; ?>
:</p>
	<p class="pageinput">
		<select name="frontendwysiwyg">
		<?php if ($this->caching && !$this->_cache_including): echo '{nocache:c7393878fae6a1aaf3cd8b98908a2dd6#0}'; endif;echo smarty_function_html_options(array('options' => $this->_tpl_vars['wysiwyg'],'selected' => $this->_tpl_vars['frontendwysiwyg']), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:c7393878fae6a1aaf3cd8b98908a2dd6#0}'; endif;?>

		</select>
	</p>
</div>

<div class="pageoverflow">
  <p class="pagetext"><?php echo $this->_tpl_vars['lang_nogcbwysiwyg']; ?>
:</p>
  <p class="pageinput"><input type="hidden" name="nogcbwysiwyg" value="0"/><input class="pagenb" type="checkbox" value="1" name="nogcbwysiwyg" <?php if ($this->_tpl_vars['nogcbwysiwyg'] == '1'): ?>checked="checked"<?php endif; ?> /></p>
</div>
<div class="pageoverflow">
  <p class="pagetext"><?php echo $this->_tpl_vars['lang_globalmetadata']; ?>
:</p>
  <p class="pageinput"><textarea class="pagesmalltextarea" name="metadata" cols="80" rows="20"><?php echo $this->_tpl_vars['metadata']; ?>
</textarea>
  </p>
</div>
<?php if (isset ( $this->_tpl_vars['themes'] )): ?>
<div class="pageoverflow">
  <p class="pagetext"><?php echo $this->_tpl_vars['lang_logintheme']; ?>
:</p>
  <p class="pageinput">
    <select name="logintheme">
      <?php if ($this->caching && !$this->_cache_including): echo '{nocache:c7393878fae6a1aaf3cd8b98908a2dd6#1}'; endif;echo smarty_function_html_options(array('options' => $this->_tpl_vars['themes'],'selected' => $this->_tpl_vars['logintheme']), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:c7393878fae6a1aaf3cd8b98908a2dd6#1}'; endif;?>

    </select>
  </p>
</div>
<?php endif; ?>

<div class="pageoverflow">
  <p class="pagetext"><?php echo $this->_tpl_vars['lang_date_format_string']; ?>
:</p>
  <p class="pageinput">
    <input class="pagenb" type="text" name="defaultdateformat" size="20" maxlength="255" value="<?php echo $this->_tpl_vars['defaultdateformat']; ?>
"/>
    <br/><?php echo $this->_tpl_vars['lang_date_format_string_help']; ?>

  </p>
</div>

<div class="pageoverflow">
  <p class="pagetext">&nbsp;</p>
  <p class="pageinput">
    <input type="submit" name="submit" value="<?php echo $this->_tpl_vars['lang_submit']; ?>
" class="pagebutton" onmouseover="this.className='pagebuttonhover'" onmouseout="this.className='pagebutton'" />
    <input type="submit" name="cancel" value="<?php echo $this->_tpl_vars['lang_cancel']; ?>
" class="pagebutton" onmouseover="this.className='pagebuttonhover'" onmouseout="this.className='pagebutton'" />
  </p>
</div>
</form>
<?php echo $this->_tpl_vars['mod']->EndTab(); ?>



<?php echo $this->_tpl_vars['mod']->StartTab('sitedown'); ?>

<form id="siteprefform_sitedown" method="post" action="siteprefs.php">
<div>
  <input type="hidden" name="<?php echo $this->_tpl_vars['SECURE_PARAM_NAME']; ?>
" value="<?php echo $this->_tpl_vars['CMS_USER_KEY']; ?>
"/>
  <input type="hidden" name="active_tab" value="sitedown" />
  <input type="hidden" name="editsiteprefs" value="true" />
</div>

<div class="pageoverflow">
  <p class="pagetext"><?php echo $this->_tpl_vars['lang_enablesitedown']; ?>
:</p>
  <p class="pageinput"><input type="hidden" name="enablesitedownmessage" value="0"/><input class="pagenb" type="checkbox" value="1" name="enablesitedownmessage" <?php if ($this->_tpl_vars['enablesitedownmessage'] == '1'): ?>checked="checked"<?php endif; ?>/></p>
</div>
<div class="pageoverflow">
  <p class="pagetext"><?php echo $this->_tpl_vars['lang_sitedownmessage']; ?>
:</p>
  <p class="pageinput"><?php echo $this->_tpl_vars['textarea_sitedownmessage']; ?>
</p>
</div>
<div class="pageoverflow">
  <p class="pagetext"><?php echo $this->_tpl_vars['lang_sitedownexcludes']; ?>
:</p>
  <p class="pageinput">
     <input type="text" name="sitedownexcludes" size="50" maxlength="255" value="<?php echo $this->_tpl_vars['sitedownexcludes']; ?>
"/>
     <br/>
     <?php echo $this->_tpl_vars['lang_info_sitedownexcludes']; ?>

  </p>
</div>

<div class="pageoverflow">
  <p class="pagetext">&nbsp;</p>
  <p class="pageinput">
    <input type="submit" name="submit" value="<?php echo $this->_tpl_vars['lang_submit']; ?>
" class="pagebutton" onmouseover="this.className='pagebuttonhover'" onmouseout="this.className='pagebutton'" />
    <input type="submit" name="cancel" value="<?php echo $this->_tpl_vars['lang_cancel']; ?>
" class="pagebutton" onmouseover="this.className='pagebuttonhover'" onmouseout="this.className='pagebutton'" />
  </p>
</div>
</form>
<?php echo $this->_tpl_vars['mod']->EndTab(); ?>



<?php echo $this->_tpl_vars['mod']->StartTab('handle_404'); ?>

<form id="siteprefform_handle_404" method="post" action="siteprefs.php">
<div>
  <input type="hidden" name="<?php echo $this->_tpl_vars['SECURE_PARAM_NAME']; ?>
" value="<?php echo $this->_tpl_vars['CMS_USER_KEY']; ?>
"/>
  <input type="hidden" name="active_tab" value="handle_404" />
  <input type="hidden" name="editsiteprefs" value="true" />
</div>

<div class="pageoverflow">
  <p class="pagetext"><?php echo $this->_tpl_vars['lang_enablecustom404']; ?>
:</p>
  <p class="pageinput"><input type="hidden" name="enablecustom404" value="0"/><input class="pagenb" type="checkbox" value="1" name="enablecustom404" <?php if ($this->_tpl_vars['enablecustom404'] == '1'): ?>checked="checked"<?php endif; ?>/></p>
</div>
<div class="pageoverflow">
  <p class="pagetext"><?php echo $this->_tpl_vars['lang_custom404']; ?>
</p>
  <p class="pageinput"><?php echo $this->_tpl_vars['textarea_custom404']; ?>
</p>
</div>
<div class="pageoverflow">
  <p class="pagetext"><?php echo $this->_tpl_vars['lang_template']; ?>
:</p>
  <p class="pageinput">
    <select name="custom404template">
      <?php if ($this->caching && !$this->_cache_including): echo '{nocache:c7393878fae6a1aaf3cd8b98908a2dd6#2}'; endif;echo smarty_function_html_options(array('options' => $this->_tpl_vars['templates'],'selected' => $this->_tpl_vars['custom404template']), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:c7393878fae6a1aaf3cd8b98908a2dd6#2}'; endif;?>

    </select>
  </p>
</div>

<div class="pageoverflow">
  <p class="pagetext">&nbsp;</p>
  <p class="pageinput">
    <input type="submit" name="submit" value="<?php echo $this->_tpl_vars['lang_submit']; ?>
" class="pagebutton" onmouseover="this.className='pagebuttonhover'" onmouseout="this.className='pagebutton'" />
    <input type="submit" name="cancel" value="<?php echo $this->_tpl_vars['lang_cancel']; ?>
" class="pagebutton" onmouseover="this.className='pagebuttonhover'" onmouseout="this.className='pagebutton'" />
  </p>
</div>
</form>
<?php echo $this->_tpl_vars['mod']->EndTab(); ?>


<?php echo $this->_tpl_vars['mod']->StartTab('setup'); ?>

<form id="siteprefform_setup" method="post" action="siteprefs.php">
<div>
  <input type="hidden" name="<?php echo $this->_tpl_vars['SECURE_PARAM_NAME']; ?>
" value="<?php echo $this->_tpl_vars['CMS_USER_KEY']; ?>
"/>
  <input type="hidden" name="active_tab" value="setup" />
  <input type="hidden" name="editsiteprefs" value="true" />
</div>

<div class="pageoverflow">
  <p class="pagetext"><?php echo $this->_tpl_vars['lang_clearcache']; ?>
:</p>
  <p class="pageinput">
    <input class="pagebutton" onmouseover="this.className='pagebuttonhover'" onmouseout="this.className='pagebutton'" type="submit" name="clearcache" value="<?php echo $this->_tpl_vars['lang_clear']; ?>
" />
  </p>
</div>  
<div class="pageoverflow">
  <p class="pagetext"><?php echo $this->_tpl_vars['lang_global_umask']; ?>
:</p>
  <p class="pageinput"><input type="text" class="pagesmalltextarea" name="global_umask" size="4" value="<?php echo $this->_tpl_vars['global_umask']; ?>
" /></p>
</div>
<?php if (isset ( $this->_tpl_vars['testresults'] )): ?>
<div class="pageoverflow">
  <p class="pagetext"><?php echo $this->_tpl_vars['lang_results']; ?>
</p>
  <p class="pageinput"><strong><?php echo $this->_tpl_vars['testresults']; ?>
</strong></p>
</div>
<?php endif; ?>
<div class="pageoverflow">
  <p class="pagetext">&nbsp;</p>
  <p class="pageinput"><input type="submit" name="testumask" value="<?php echo $this->_tpl_vars['lang_test']; ?>
" class="pagebutton" onmouseover="this.className='pagebuttonhover'" onmouseout="this.className='pagebutton'" /></p>
</div>
<div class="pageoverflow">
  <p class="pagetext"><?php echo $this->_tpl_vars['lang_css_max_age']; ?>
:</p>
  <p class="pageinput">
    <input type="text" class="pagesmalltextarea" name="css_max_age" size="10" maxlength="10" value="<?php echo $this->_tpl_vars['css_max_age']; ?>
" />
    <br/><?php echo $this->_tpl_vars['lang_help_css_max_age']; ?>

  </p>
</div>

<div class="pageoverflow">
  <p class="pagetext"><?php echo $this->_tpl_vars['lang_urlcheckversion']; ?>
:</p>
  <p class="pageinput">
    <input class="pagenb" type="text" name="urlcheckversion" size="80" maxlength="255" value="<?php echo $this->_tpl_vars['urlcheckversion']; ?>
"/>
    <br/><?php echo $this->_tpl_vars['lang_info_urlcheckversion']; ?>

  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext"><?php echo $this->_tpl_vars['lang_clear_version_check_cache']; ?>
:</p>
  <p class="pageinput"><input type="hidden" name="clear_vc_cache" value="0"/><input class="pagenb" value="1" type="checkbox" name="clear_vc_cache" <?php if ($this->_tpl_vars['clear_vc_cache']): ?>checked="checked"<?php endif; ?> /></p>
</div>

<div class="pageoverflow">
  <p class="pagetext"><?php echo $this->_tpl_vars['lang_disablesafemodewarning']; ?>
:</p>
  <p class="pageinput"><input type="hidden" name="disablesafemodwarning" value="0"/><input class="pagenb" type="checkbox" value="1" name="disablesafemodewarning" <?php if ($this->_tpl_vars['disablesafemodewarning']): ?>checked="checked"<?php endif; ?> /></p>
</div>

<div class="pageoverflow">
  <p class="pagetext"><?php echo $this->_tpl_vars['lang_allowparamcheckwarnings']; ?>
:</p>
  <p class="pageinput"><input type="hidden" name="allowparamcheckwarnings" value="0" /><input class="pagenb" type="checkbox" value="1" name="allowparamcheckwarnings" <?php if ($this->_tpl_vars['allowparamcheckwarnings']): ?>checked="checked"<?php endif; ?> /></p>
</div>

<div class="pageoverflow">
  <p class="pagetext"><?php echo $this->_tpl_vars['lang_admin_enablenotifications']; ?>
:</p>
  <p class="pageinput"><input type="hidden" name="enablenotifications" value="0"/><input class="pagenb" type="checkbox" value="1" name="enablenotifications" <?php if ($this->_tpl_vars['enablenotifications']): ?>checked="checked"<?php endif; ?> /></p>
</div>

<div class="pageoverflow">
  <p class="pagetext"><?php echo $this->_tpl_vars['lang_basic_attributes']; ?>
:</p>
  <p class="pageinput">
    <select name="basic_attributes[]" multiple="multiple" size="5">
      <?php if ($this->caching && !$this->_cache_including): echo '{nocache:c7393878fae6a1aaf3cd8b98908a2dd6#3}'; endif;echo smarty_function_html_options(array('options' => $this->_tpl_vars['all_attributes'],'selected' => $this->_tpl_vars['basic_attributes']), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:c7393878fae6a1aaf3cd8b98908a2dd6#3}'; endif;?>

    </select>
    <br/>
    <?php echo $this->_tpl_vars['lang_info_basic_attributes']; ?>

  </p>
</div>

<div class="pageoverflow">
  <p class="pagetext">&nbsp;</p>
  <p class="pageinput">
    <input type="submit" name="submit" value="<?php echo $this->_tpl_vars['lang_submit']; ?>
" class="pagebutton" onmouseover="this.className='pagebuttonhover'" onmouseout="this.className='pagebutton'" />
    <input type="submit" name="cancel" value="<?php echo $this->_tpl_vars['lang_cancel']; ?>
" class="pagebutton" onmouseover="this.className='pagebuttonhover'" onmouseout="this.className='pagebutton'" />
  </p>
</div>
</form>
<?php echo $this->_tpl_vars['mod']->EndTab(); ?>


<?php echo $this->_tpl_vars['mod']->EndTabContent(); ?>
