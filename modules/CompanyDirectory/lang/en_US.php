<?php
$lang['prompt_numimported'] = 'Number of Imported Records';
$lang['prompt_duplicate_name'] = 'Check for duplicate company names';
$lang['prompt_status'] = 'Status for imported record';
$lang['prompt_ignore_address'] = 'Ignore address field';
$lang['prompt_convert_address'] = 'Convert Addresses to coordinates (if there are no coordinates)';
$lang['prompt_kmlfile'] = 'KML File to Import';
$lang['importkml'] = 'Import KML';
$lang['import_kml'] = 'Import KML File';
$lang['selectone'] = 'Select One';
$lang['error_feu_loggedin'] = 'To use this function you must be logged in to the frontend of the website';
$lang['active'] = 'Active';
$lang['addlink'] = 'Add Link';
$lang['address'] = 'Address';
$lang['addresstext'] = 'Address';
$lang['addcategory'] = 'Add Category';
$lang['addcompany'] = 'Add Company';
$lang['addfielddef'] = 'Add Field Definition';
$lang['admin_only'] = 'Visible To Admin Only';
$lang['areyousure'] = 'Are you sure you want to remove this?';
$lang['ascending'] = 'Ascending';
$lang['cancel'] = 'Cancel';
$lang['canuseredit'] = 'Can frontend users edit this field?';
$lang['canuserview'] = 'Can frontend users view this field?';
$lang['category'] = 'Category';
$lang['categories'] = 'Categories';
$lang['categorytext'] = 'Category';
$lang['categoryadded'] = 'Category Added';
$lang['categoryupdated'] = 'Category Updated';
$lang['categorylisttemplate_addedit'] = 'Add/Edit a Category List Template';
$lang['categorylisttemplates'] = 'Category List Templates';
$lang['categorylisttemplateupdated'] = 'Category List Updated';
$lang['company'] = 'Company';
$lang['companyadded'] = 'Company Added';
$lang['companyname'] = 'Company name';
$lang['companyupdated'] = 'Company Updated';
$lang['companies'] = 'Companies';
$lang['companytext'] = 'Company';
$lang['companydirectory'] = 'Company Directory';
$lang['contactemail'] = 'Contact Email';
$lang['createddate'] = 'Date Entered';
$lang['defaulttemplates'] = 'Default Templates';
$lang['default_template_notice'] = <<<EOT
<strong>Note:</strong> The contents of these text areas are used to determine the default content of templates when you click &quot;Add Template&quot; in the appropriate template tab.  Editing one of these text areas will have no immediate effect on your website.
EOT;
$lang['delete'] = 'Delete';
$lang['deletecategory'] = 'Delete Category';
$lang['deletecompany'] = 'Delete Company';
$lang['deletefielddef'] = 'Delete Field Definition';
$lang['descending'] = 'Descending';
$lang['description'] = 'Description';
$lang['details'] = 'Details';
$lang['detailstext'] = 'Details';
$lang['detailtemplate_addedit'] = 'Add/Edit a Detail Template';
$lang['detailtemplates'] = 'Detail Templates';
$lang['detailtemplateupdated'] = 'Detail Template Updated';
$lang['disabled'] = 'Disabled';
$lang['down'] = 'Down';
$lang['draft'] = 'Draft';
$lang['edit'] = 'Edit';
$lang['editcategory'] = 'Edit Category';
$lang['editcompany'] = 'Edit Company';
$lang['editfielddef'] = 'Edit Field Definition';
$lang['emailtext'] = 'Email';
$lang['error_badupload'] = 'A problem occurred with the uploaded file';
$lang['error_companyname'] = 'Company Name is Invalid';
$lang['error_companyname_inuse'] = 'A Company by that name is already in the database';
$lang['error_duplicate_category'] = 'A category by that name already exists';
$lang['error_duplicate_company'] = 'A company with that name (%s) already exists';
$lang['error_duplicate_fielddef'] = 'A field by that name already exists';
$lang['error_import_badline'] = 'Bad record found at line %d.  Is there a rule missing?';
$lang['error_import_badvalue'] = 'A bad value was found for the %s field';
$lang['error_import_duplicaterule'] = 'Duplicate %s rule at line %d';
$lang['error_import_duplicaterule_identifier'] = 'Duplicate rule identifier at line %d';
$lang['error_import_unknownrow'] = 'Dont know how to handle line %d with the rule identifier %s';
$lang['error_import_unknownrule'] = 'Unknown rule at line %d';
$lang['error_insert_category'] = 'A database error occurred trying to insert the category definition';
$lang['error_insert_company'] = 'A database error occurred trying to insert the company definition';
$lang['error_insert_fielddef'] = 'A database error occurred trying to insert the field definition';
$lang['error_invalid_param'] = 'The value specified for %s is invalid';
$lang['error_missingupload'] = 'No file was uploaded';
$lang['error_missingparam'] = 'A required value was missing from the form input';
$lang['error_nodropdownoptions'] = 'No Dropdown options supplied';
$lang['error_nofeu'] = 'Could not find the FrontEndUsers module';
$lang['error_nolength'] = 'No maximum length field supplied';
$lang['error_noresultsfound'] = 'No records matching your criteria could be found in the database';
$lang['error_postcode_lookup'] = 'Could not find any information for postal/zip code %s';
$lang['error_prefix_msg'] = 'An error occurred at line %d: %s';
$lang['exportcsv'] = 'Export CSV';
$lang['fax'] = 'Fax';
$lang['faxtext'] = 'Fax';
$lang['fielddef'] = 'Field Definition';
$lang['fielddefs'] = 'Field Definitions';
$lang['fielddeftext'] = 'Field Definition';
$lang['fielddefadded'] = 'Field Definition Added';
$lang['fielddefupdated'] = 'Field Definition Updated';
$lang['fielddefdeleted'] = 'Field Definition Deleted';
$lang['field_checkbox'] = 'Checkbox';
$lang['field_dropdown'] = 'Dropdown';
$lang['field_textarea'] = 'Text Area';
$lang['field_textbox'] = 'Text Input';
$lang['firstpage'] = '<<';
$lang['frontendformtemplate_addedit'] = 'Add/Edit a Frontend Form Template';
$lang['frontendformtemplates'] = 'Edit Company Templates';
$lang['frontendformtemplateupdated'] = 'Edit Company Template Updated';
$lang['help'] = <<<EOT
<h3>What does this do?</h3>
<p>This module provides a way to collect, organize, and display information about companies.  Usually this is the contact information and a logo, but it is flexibile enough to allow for extendable fields, and discriminating public from private data.</p>
<p>This module could be used for a variety of purposes. From a suppliers list to a contact list.  It is flexible enough that it could be re-used for many different purposes.</p>
<h3>How Do I Use It</h3>
<p>The easiest way to use this module is by placing the <code>{CompanyDirectory}</code> tag into either your page template or page content.  You would then start editing records in the &quot;Company Directory&quot; admin interface.  Explore the various parameters (described below) for ways to customize the behaviour of the module.</p>
<h3>Security</h3>
<p>In order to manage the companies inside this module, the administrator must have the '</em>Modify Company Directory</em>' permission.</p>
<p>In order to edit the built in templates that control the layout of the companydirectory information, the administrator needs the '<em>Modify Templates</em>' permission.</p>
<p>To adjust the various settings, the '<em>Modify Site Preferences</em>' permission is required.</p>
<h3>Pretty URLS</h3>
<p>Functionality and flexibility is reduced when using pretty urls.  For example, if using pretty URLS with this module, you should post the tag for this module in the default content block, and when clicking on a link or submitting a button from this module, it's results will always replace the default content block.</p>
EOT;
$lang['id'] = 'Id';
$lang['info_dropdown_options'] = 'Specify the options for the dropdown control.  One line per entry.  Seperate keys from values with the =.  i.e: key=value';
$lang['imagecurrenthidden'] = '';
$lang['imagetext'] = 'Image';
$lang['importcsv'] = 'Import CSV';

$lang['latitude'] = 'Latitude';
$lang['lastpage'] = '>>';
$lang['logocurrenthidden'] = '';
$lang['logotext'] = 'Logo';
$lang['longitude'] = 'Longitude';
$lang['lookup'] = 'Lookup Coordinates';

$lang['maxlength'] = 'Max Length';
$lang['max_length'] = 'Max Length';
$lang['maxlengthtext'] = 'Max Length';
$lang['modifieddate'] = 'Date Last Modified';

$lang['name'] = 'Name';
$lang['nametext'] = 'Name';
$lang['needpermission'] = 'You need the \'%s\' permission to perform that function.';
$lang['no'] = 'No';
$lang['nocompanynamegiven'] = 'No Company Name Given';
$lang['nonamegiven'] = 'No Name Given';
$lang['notanumber'] = 'Not a Number';
$lang['nextpage'] = '>';

$lang['of'] = 'Of';

$lang['page'] = 'Page';
$lang['param_action'] = 'Determine the primary behaviour of the module.  Possible values for this parameter are:
<ul>
  <li>categorylist -- Display a list of categories.  Users can drill down to summary mode, andd then to detail mode.</li>
  <li><strong>default</strong> -- Display companies in a summary mode.</li>
  <li>details -- Display detailed information about a specific company.</li>
  <li>fe_edit -- Display a form to allow editing information about a specific company.</li>
  <li>search  -- Display a form to allow searching for specific companies.</li>
   
</ul>
';
$lang['param_inline'] = 'Applicable only to the <em>default</em> summary, and <em>search</em> modes, this parameter allows specifying wether the resulting data should replace the default content block, or should replace the original tag (inline).';
$lang['param_searchformtemplate'] = 'Applicable only to the <em>search</em> mode, this parameter allows specifying a non default search form template.';
$lang['param_pagelimit'] = 'When used with the <em>default</em> summary mode, or the <em>search</em> mode, this will limit the results to a specified number.';
$lang['param_category'] = 'When used in the <em>default</em> summary mode, this parameter, which should match the name of an existing category will be used to display only those companies that are in that categoory. (a comma seperated list can be supplied)';
$lang['param_categorylisttemplate'] = 'Specify a template (by name) to use when displaying the category list view.';
$lang['param_companyid'] = 'Required for the frontend editing and detail modes, this parameter determines which company record to edit or view.';
$lang['param_detailpage'] = 'Specify a page alias (by name) to use for displaying a detail record. <strong>Note:</strong> This tag parameter is not compatible with pretty urls.';
$lang['param_detailtemplate'] = 'Specify a template (by name) to use when displaying the detail view.  <strong>Note:</strong> This tag parameter is not compatible with pretty urls.';
$lang['param_frontendformtemplate'] = 'Specify a template (by name) to use when displaying the front end company edit form.';
$lang['param_selectcategory'] = 'If this parameter is set, then a form will be generated allowing users to interactively filter company records on a single category.  This flag should not be used in conjunction with the \'category\' parameter.';
$lang['param_showall'] = 'Applicable only to the categorylist action, if this parameter is set, then even categories with no matching companies will be displayed in the output';
$lang['param_sortorder'] = 'Specify the order of sorted fields in summary view.  Possible values are:
<ul>
  <li><strong>asc</strong> -- Ascending order</li>
  <li>desc -- Descending order</li>
</ul>';
$lang['param_sortby'] = 'Applicable only in summary mode, this parameter determines the sorting of the output companies.  Possible values are:
<ul>
  <li><strong>company_name</strong></li>
  <li>phone</li>
  <li>fax</li>
  <li>email</li>
  <li>website -- The website url</li>
  <li>created -- The creation date for this company record</li>
  <li>modified -- The modified date for this company record</li>
</ul>';
$lang['param_summarytemplate'] = 'Specify a template (by name) to use when displaying the summary view.  <strong>Note:</strong> This tag parameter is not compatible with pretty urls.';

$lang['postal_code'] = 'Postal/Zip code';
$lang['postinstall'] = 'Company Directory module successfully installed';
$lang['postuninstall'] = 'The Company Directory module successfully uninstalled.  All associated company data has been erased';
$lang['preuninstall'] = 'Are you sure you want to uninstall this module? Uninstalling this module will permanently erase all associated company data.';
$lang['prevpage'] = '<';
$lang['prompt_categories_imported'] = 'Categories Imported';
$lang['prompt_check_duplicates'] = 'Check for duplicate company names?';
$lang['prompt_collectstats'] = 'Collect Search Statistics';
$lang['prompt_companies_imported'] = 'Companies Imported';
$lang['prompt_delimeter'] = 'Field Delimeter';
$lang['prompt_detailpage'] = 'The default page to redirect to in detail mode';
$lang['prompt_dropdown_options'] = 'Dropdown Options';
$lang['prompt_fielddefs_imported'] = 'Field Definitions Imported';
$lang['prompt_import_categorydefs'] = 'Create missing categories on import';
$lang['prompt_import_categoryvals'] = 'Popuplate category values on import';
$lang['prompt_import_csvfile'] = 'Upload CSV File';
$lang['prompt_import_fielddefs'] = 'Create missing &quot;additional field&quot; definitions on import';
$lang['prompt_import_fieldvals'] = 'Populate &quot;additional field&quot; values on import';
$lang['prompt_import_lookuplatlong'] = 'Lookup latitude and longitude values if missing';
$lang['prompt_pagelimit'] = 'The number of records to view per page in summary mode';
$lang['prompt_summarysorting'] = 'Default sorting in summary mode';
$lang['prompt_summarysortorder'] = 'The default sort order in summary mode <em>(does not apply when sorting is \'random\'</em>';
$lang['prompt_template'] = 'Template';
$lang['public'] = 'Public';
$lang['published'] = 'Published';
$lang['preferences'] = 'Preferences';

$lang['radius'] = 'Radius';
$lang['random'] = 'Random';
$lang['return'] = 'Return';
$lang['resettofactory'] = 'Reset to Defaults';
$lang['restoretodefaultsmsg'] = 'This operation will restore the template contents to their system defaults.  Are you sure you want to procede?';

$lang['search'] = 'Search';
$lang['searches'] = 'Searches';
$lang['searchformtemplates'] = 'Search Form Templates';
$lang['searchformtemplate_addedit'] = 'Add/Edit a Search Form Template';
$lang['status'] = 'Status';
$lang['submit'] = 'Submit';
$lang['summarytemplate_addedit'] = 'Add/Edit a Summary Template';
$lang['summarytemplates'] = 'Summary Templates';
$lang['summarytemplateupdated'] = 'Summary Template Updated';
$lang['sysdefaults'] = 'Restore to defaults';

$lang['telephone'] = 'Telephone';
$lang['telephonetext'] = 'Telephone';
$lang['title_categorylist_dflttemplate'] = 'Default Category List Template';
$lang['title_detail_dflttemplate'] = 'Default Detail Template';
$lang['title_frontendform_dflttemplate'] = 'Default Frontend Form Template';
$lang['title_import_report'] = 'CSV Import Report';
$lang['title_searchform_dflttemplate'] = 'Default Search Form Template';
$lang['title_summary_dflttemplate'] = 'Default Summary Template';
$lang['type'] = 'Type';
$lang['typetext'] = 'Type';

$lang['up'] = 'Up';

$lang['website'] = 'Website';
$lang['websitetext'] = 'Website';

$lang['yes'] = 'Yes';
?>
