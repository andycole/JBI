<?php
#CMS - CMS Made Simple
#(c)2004-6 by Ted Kulp (ted@cmsmadesimple.org)
#This project's homepage is: http://cmsmadesimple.org
#
#This program is free software; you can redistribute it and/or modify
#it under the terms of the GNU General Public License as published by
#the Free Software Foundation; either version 2 of the License, or
#(at your option) any later version.
#
#This program is distributed in the hope that it will be useful,
#but WITHOUT ANY WARRANTY; without even the implied warranty of
#MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#GNU General Public License for more details.
#You should have received a copy of the GNU General Public License
#along with this program; if not, write to the Free Software
#Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
#
#$Id$

if (!isset($gCms)) exit;

$db =& $this->GetDb();

$dict = NewDataDictionary($db);
$flds = "
	id I KEY AUTO,
	company_name C(255) NOT NULL,
	address X,
	telephone C(50),
	fax C(50),
	contact_email C(255),
	website C(255),
	details X,
	picture_location C(255),
	logo_location C(255),
	create_date " . CMS_ADODB_DT . ",
	modified_date " . CMS_ADODB_DT . ",
        status C(50),
        latitude F,
        longitude F,
        owner_id I
";

$taboptarray = array('mysql' => 'TYPE=MyISAM');
$sqlarray = $dict->CreateTableSQL(cms_db_prefix()."module_compdir_companies", 
		$flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);

$flds = "
	id I KEY AUTO,
	name C(255) NOT NULL,
	create_date " . CMS_ADODB_DT . ",
	modified_date " . CMS_ADODB_DT . "
";

$taboptarray = array('mysql' => 'TYPE=MyISAM');
$sqlarray = $dict->CreateTableSQL(cms_db_prefix()."module_compdir_categories", 
		$flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);

$flds = "
	company_id I KEY NOT NULL,
	category_id I KEY NOT NULL,
	create_date " . CMS_ADODB_DT . ",
	modified_date " . CMS_ADODB_DT . "
";

$taboptarray = array('mysql' => 'TYPE=MyISAM');
$sqlarray = $dict->CreateTableSQL(cms_db_prefix()."module_compdir_company_categories", 
		$flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);

$flds = "
	id I KEY AUTO,
	name C(255) NOT NULL,
	type C(50),
	max_length I,
	create_date " . CMS_ADODB_DT . ",
	modified_date " . CMS_ADODB_DT . ",
        item_order I,
        admin_only I,
        public I,
        dropdown_data X
";

$taboptarray = array('mysql' => 'TYPE=MyISAM');
$sqlarray = $dict->CreateTableSQL(cms_db_prefix()."module_compdir_fielddefs", 
		$flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);

$flds = "
	company_id I KEY NOT NULL,
	fielddef_id I KEY NOT NULL,
	value X,
	create_date " . CMS_ADODB_DT . ",
	modified_date " . CMS_ADODB_DT . "
";

$taboptarray = array('mysql' => 'TYPE=MyISAM');
$sqlarray = $dict->CreateTableSQL(cms_db_prefix()."module_compdir_fieldvals", 
		$flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);


$flds = "
	company_id I KEY NOT NULL,
	date_searched ".CMS_ADODB_DT." NOT NULL,
        postcode C(20)
";
$sqlarray = $dict->CreateTableSQL(cms_db_prefix()."module_compdir_searchstats", 
				  $flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);

# Indexes
$sqlarray = $dict->CreateIndexSQL('compdir_comp_name',
				  cms_db_prefix().'module_compdir_companies',
				  'company_name');
$dict->ExecuteSQLArray($sqlarray);

$sqlarray = $dict->CreateIndexSQL('compdir_catg_name',
				  cms_db_prefix().'module_compdir_categories',
				  'name');
$dict->ExecuteSQLArray($sqlarray);

$sqlarray = $dict->CreateIndexSQL('compdir_compcat',
				  cms_db_prefix().'module_compdir_company_categories',
				  'category_id,company_id');
$dict->ExecuteSQLArray($sqlarray);

$sqlarray = $dict->CreateIndexSQL('compdir_fielddef',
				  cms_db_prefix().'module_compdir_fielddefs',
				  'name,id');
$dict->ExecuteSQLArray($sqlarray);

$sqlarray = $dict->CreateIndexSQL('cd_status',cms_db_prefix().'module_compdir_companies','status');
$dict->ExecuteSQLArray($sqlarray);

$sqlarray = $dict->CreateIndexSQL('cd_fld_name',cms_db_prefix().'module_compdir_fielddefs','name');
$dict->ExecuteSQLArray($sqlarray);

$sqlarray = $dict->CreateIndexSQL('cd_fld_order',cms_db_prefix().'module_compdir_fielddefs','item_order');
$dict->ExecuteSQLArray($sqlarray);

$sqlarray = $dict->CreateIndexSQL('cd_fld_public',cms_db_prefix().'module_compdir_fielddefs','public');
$dict->ExecuteSQLArray($sqlarray);

#
# Templates
#


# Setup summary template
$fn = cms_join_path(dirname(__FILE__),'templates','orig_summary_template.tpl');
if( file_exists( $fn ) )
  {
    $template = file_get_contents( $fn );
    $this->SetPreference(COMPANYDIR_PREF_NEWSUMMARY_TEMPLATE,$template);
    $this->SetTemplate('summary_Sample',$template);
    $this->SetPreference(COMPANYDIR_PREF_DFLTSUMMARY_TEMPLATE,'Sample');
  }

# Setup detail template
$fn = cms_join_path(dirname(__FILE__),'templates','orig_detail_template.tpl');
if( file_exists( $fn ) )
  {
    $template = file_get_contents( $fn );
    $this->SetPreference(COMPANYDIR_PREF_NEWDETAIL_TEMPLATE,$template);
    $this->SetTemplate('detail_Sample',$template);
    $this->SetPreference(COMPANYDIR_PREF_DFLTDETAIL_TEMPLATE,'Sample');
  }

# Setup default category list template
$fn = cms_join_path(dirname(__FILE__),'templates','orig_categorylist_template.tpl');
if( file_exists( $fn ) )
  {
    $template = file_get_contents( $fn );
    $this->SetPreference(COMPANYDIR_PREF_NEWCATEGORYLIST_TEMPLATE,$template);
    $this->SetTemplate('categorylist_Sample',$template);
    $this->SetPreference(COMPANYDIR_PREF_DFLTCATEGORYLIST_TEMPLATE,'Sample');
  }

# Setup default search form template
$fn = cms_join_path(dirname(__FILE__),'templates','orig_searchform_template.tpl');
if( file_exists( $fn ) )
  {
    $template = file_get_contents( $fn );
    $this->SetPreference(COMPANYDIR_PREF_NEWSEARCHFORM_TEMPLATE,$template);
    $this->SetTemplate('searchform_Sample',$template);
    $this->SetPreference(COMPANYDIR_PREF_DFLTSEARCHFORM_TEMPLATE,'Sample');
  }

# Setup default front end form template
$fn = cms_join_path(dirname(__FILE__),'templates','orig_frontendform_template.tpl');
if( file_exists( $fn ) )
  {
    $template = file_get_contents( $fn );
    $this->SetPreference(COMPANYDIR_PREF_NEWFRONTENDFORM_TEMPLATE,$template);
    $this->SetTemplate('frontendform_Sample',$template);
    $this->SetPreference(COMPANYDIR_PREF_DFLTFRONTENDFORM_TEMPLATE,'Sample');
  }


#Set Permission
$this->CreatePermission('Modify Company Directory', 'Modify Company Directory');

# Preferences
$this->SetPreference('import_delimeter','|');
$this->SetPreference('import_fielddefs',1);
$this->SetPreference('import_fieldvals',1);
$this->SetPreference('import_categorydefs',1);
$this->SetPreference('import_categoryvals',1);
$this->SetPreference('import_lookuplatlong',0);
$this->SetPreference('import_checkduplicates',1);

?>