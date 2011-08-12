<?php /* Smarty version 2.6.25, created on 2009-11-08 19:48:22
         compiled from module_file_tpl:TinyMCE%3Btinyconfig.tpl */ ?>
<?php echo ' tinyMCE.init({ '; ?>

    mode : "<?php echo $this->_tpl_vars['startupmode']; ?>
",
  elements : "<?php echo $this->_tpl_vars['textareas']; ?>
",
  body_class : "CMSMSBody",
  content_css : "<?php echo $this->_tpl_vars['css']; ?>
",

    entity_encoding : "<?php echo $this->_tpl_vars['encoding']; ?>
", 
  button_tile_map : true, //performance update

		
  theme : "advanced",
  skin : "<?php echo $this->_tpl_vars['skin']; ?>
",
  skin_variant : "<?php echo $this->_tpl_vars['skinvariation']; ?>
",
  theme_advanced_toolbar_location : "top",
  theme_advanced_toolbar_align : "left",
  visual : true,
	      
  accessibility_warnings : false,
      			
  fix_list_elements : true,
  verify_html : true,
  verify_css_classes : false,
  
  plugins : "-cmslinker,-customdropdown,<?php echo $this->_tpl_vars['plugins']; ?>
",
  
  paste_auto_cleanup_on_paste : true,
  paste_remove_spans : true,
  paste_remove_styles : true,

  theme_advanced_buttons1 : "<?php if (isset ( $this->_tpl_vars['toolbar1'] )): ?><?php echo $this->_tpl_vars['toolbar1']; ?>
<?php endif; ?>",
  theme_advanced_buttons2 : "<?php if (isset ( $this->_tpl_vars['toolbar2'] )): ?><?php echo $this->_tpl_vars['toolbar2']; ?>
<?php endif; ?>",
  theme_advanced_buttons3 : "<?php if (isset ( $this->_tpl_vars['toolbar3'] )): ?><?php echo $this->_tpl_vars['toolbar3']; ?>
<?php endif; ?>",
  theme_advanced_buttons4 : "<?php if (isset ( $this->_tpl_vars['toolbar4'] )): ?><?php echo $this->_tpl_vars['toolbar4']; ?>
<?php endif; ?>",


  theme_advanced_blockformats : "<?php echo $this->_tpl_vars['blockformats']; ?>
",
  document_base_url : "<?php echo $this->_tpl_vars['rooturl']; ?>
/",

<?php if ($this->_tpl_vars['relativeurls'] == 'true'): ?>
  relative_urls : true,
  remove_script_host : true,
<?php else: ?>
  relative_urls : false,
  remove_script_host : false,
<?php endif; ?>
  	
  language: "<?php echo $this->_tpl_vars['language']; ?>
",
  dialog_type: "modal",
  apply_source_formatting : <?php echo $this->_tpl_vars['sourceformatting']; ?>
,

<?php if ($this->_tpl_vars['showpath'] != ''): ?>
  theme_advanced_statusbar_location : 'bottom',
  theme_advanced_path : true,
<?php endif; ?>
			
<?php if ($this->_tpl_vars['editorwidth'] != ''): ?>
  width : <?php echo $this->_tpl_vars['editorwidth']; ?>
,
<?php endif; ?>
<?php if ($this->_tpl_vars['editorheight'] != ''): ?>
  height : <?php echo $this->_tpl_vars['editorheight']; ?>
,
<?php endif; ?>
		
	force_br_newlines : <?php echo $this->_tpl_vars['force_br_newlines']; ?>
,
  force_p_newlines : <?php echo $this->_tpl_vars['force_p_newlines']; ?>
,		
			 
  forced_root_block : <?php echo $this->_tpl_vars['forcedrootblock']; ?>
,		
		
  plugin_insertdate_dateFormat : "<?php echo $this->_tpl_vars['dateformat']; ?>
",
  plugin_insertdate_timeFormat : "<?php echo $this->_tpl_vars['timeformat']; ?>
"


<?php if ($this->_tpl_vars['css_styles'] != ''): ?>
  ,theme_advanced_styles : '<?php echo $this->_tpl_vars['css_styles']; ?>
'
<?php endif; ?>
<?php if ($this->_tpl_vars['extraconfig'] != ''): ?>
  <?php echo $this->_tpl_vars['extraconfig']; ?>

<?php endif; ?>

  <?php if ($this->_tpl_vars['isfrontend'] == 'false'): ?>
  ,file_browser_callback : 'CMSMSFilePicker'
  <?php endif; ?>
  <?php echo '
});
  '; ?>

	
  <?php echo '
function toggleEditor(id) {
  if (!tinyMCE.getInstanceById(id))
    tinyMCE.execCommand(\'mceAddControl\', false, id);
  else
    tinyMCE.execCommand(\'mceRemoveControl\', false, id);
}
  '; ?>


  <?php if ($this->_tpl_vars['isfrontend'] == 'false'): ?>
  <?php echo '
function CMSMSFilePicker (field_name, url, type, win) {
  '; ?>
   
  var cmsURL = "<?php echo $this->_tpl_vars['rooturl']; ?>
/modules/TinyMCE/filepicker.php<?php echo $this->_tpl_vars['urlext']; ?>
&type="+type;
  <?php echo '
  tinyMCE.activeEditor.windowManager.open({
  '; ?>

    file : cmsURL,
    title : '<?php echo $this->_tpl_vars['filepickertitle']; ?>
',
    width : '<?php echo $this->_tpl_vars['fpwidth']; ?>
',
    height : '<?php echo $this->_tpl_vars['fpheight']; ?>
',
    resizable : "yes",
    scrollbars : "yes",
    inline : "yes",      close_previous : "no"
  <?php echo '
  }, {
    window : win,
    input : field_name
  });
  return false;
}
'; ?>

<?php endif; ?>