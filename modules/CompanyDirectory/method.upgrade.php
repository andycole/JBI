<?php
if (!isset($gCms)) exit;

$dict = NewDataDictionary($db);
$current_version = $oldversion;
$db =& $this->GetDb();

switch($current_version)
{
 case "1.0.4":
   $sqlarray = $dict->AddColumnSQL(cms_db_prefix()."module_compdir_fielddefs", "item_order I");
   $dict->ExecuteSQLArray($sqlarray);
   
   $count = 0;
   $dbresult = $db->Execute('SELECT * FROM ' . cms_db_prefix() . 'module_compdir_fielddefs');
   while ($dbresult && $row = $dbresult->FetchRow())
     {
       $db->Execute('UPDATE ' . cms_db_prefix() . 'module_compdir_fielddefs SET item_order = ? WHERE id = ?', array($count, $row['id']));
       $count++;
     }
   $current_version = "1.0.5";
   
 case "1.0.5":
   $sqlarray = $dict->AddColumnSQL(cms_db_prefix()."module_compdir_fielddefs", "user_editable I, user_viewable I");
   $dict->ExecuteSQLArray($sqlarray);
   $sqlarray = $dict->AddColumnSQL(cms_db_prefix()."module_compdir_companies", "status C(50)");
   $dict->ExecuteSQLArray($sqlarray);
   $db->Execute( 'UPDATE '.cms_db_prefix().'module_compdir_fielddefs SET admin_only = 1, public = 1' );
   
   // convert displaysummary to summary_blah and mark it as default
   $template = $this->GetTemplate('displaysummary');
   $this->SetTemplate('summary__dflt',$template);
   $this->SetPreference(COMPANYDIR_PREF_DFLTSUMMARY_TEMPLATE,'_dflt');
   $this->DeleteTemplate('displaysummary');
   
   // convert displaydetail to detail_blah and mark it as default
   $template = $this->GetTemplate('displaydetail');
   $this->SetTemplate('detail__dflt',$template);
   $this->SetPreference(COMPANYDIR_PREF_DFLTDETAIL_TEMPLATE,'_dflt');
   $this->DeleteTemplate('displaydetail');
   
   // Setup default category list template
   $fn = cms_join_path(dirname(__FILE__),'templates','orig_categorylist_template.tpl');
   if( file_exists( $fn ) )
     {
       $template = file_get_contents( $fn );
       $this->SetPreference(COMPANYDIR_PREF_NEWCATEGORYLIST_TEMPLATE,$template);
       $this->SetTemplate('categorylist_Sample',$template);
       $this->SetPreference(COMPANYDIR_PREF_DFLTCATEGORYLIST_TEMPLATE,'Sample');
     }
   
   // Setup default front end form template
   $fn = cms_join_path(dirname(__FILE__),'templates','orig_frontendform_template.tpl');
   if( file_exists( $fn ) )
     {
       $template = file_get_contents( $fn );
       $this->SetPreference(COMPANYDIR_PREF_NEWFRONTENDFORM_TEMPLATE,$template);
       $this->SetTemplate('frontendform_Sample',$template);
       $this->SetPreference(COMPANYDIR_PREF_DFLTFRONTENDFORM_TEMPLATE,'Sample');
     }   
   $current_version = "1.1";

 case '1.1.6':
   $sqlarray = $dict->AddColumnSQL(cms_db_prefix().'module_compdir_fielddefs','dropdown_data X');
   $dict->ExecuteSQLArray($sqlarray);
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
				     cms_db_prefix().'module_compdir_company_fielddefs',
				     'name,id');
   $dict->ExecuteSQLArray($sqlarray);

 case '1.1.7':
   $sqlarray = $dict->CreateIndexSQL('cd_status',
				     cms_db_prefix().'module_compdir_companies',
				     'status');
   $dict->ExecuteSQLArray($sqlarray);
   
   $sqlarray = $dict->CreateIndexSQL('cd_fld_name',
				     cms_db_prefix().'module_compdir_fielddefs',
				     'name');
   $dict->ExecuteSQLArray($sqlarray);
   
   $sqlarray = $dict->CreateIndexSQL('cd_fld_order',
				     cms_db_prefix().'module_compdir_fielddefs',
				     'item_order');
   $dict->ExecuteSQLArray($sqlarray);
   
   $sqlarray = $dict->CreateIndexSQL('cd_fld_public',
				     cms_db_prefix().'module_compdir_fielddefs',
				     'public');
   $dict->ExecuteSQLArray($sqlarray);

  case '1.1.8':
   $sqlarray = $dict->AddColumnSQL(cms_db_prefix().'module_compdir_companies','latitude F, longitude F,owner_id I');
   $dict->ExecuteSQLArray($sqlarray);

   $sqlarray = $dict->CreateIndexSQL('cd_fld_coords',
				     cms_db_prefix().'module_compdir_companies',
				     'latitude, longitude');
   $dict->ExecuteSQLArray($sqlarray);

   $sqlarray = $dict->CreateIndexSQL('cd_fld_owner',
				     cms_db_prefix().'module_compdir_companies',
				     'owner_id');
   $dict->ExecuteSQLArray($sqlarray);

   $this->SetPreference('import_delimeter','|');
   $this->SetPreference('import_fielddefs',1);
   $this->SetPreference('import_fieldvals',1);
   $this->SetPreference('import_categorydefs',1);
   $this->SetPreference('import_categoryvals',1);
   $this->SetPreference('import_lookuplatlong',0);
   $this->SetPreference('import_checkduplicates',1);

   # Setup default search form template
   $fn = cms_join_path(dirname(__FILE__),'templates','orig_searchform_template.tpl');
   if( file_exists( $fn ) )
     {
       $template = file_get_contents( $fn );
       $this->SetPreference(COMPANYDIR_PREF_NEWSEARCHFORM_TEMPLATE,$template);
       $this->SetTemplate('searchform_Sample',$template);
       $this->SetPreference(COMPANYDIR_PREF_DFLTSEARCHFORM_TEMPLATE,'Sample');
     }

 case '1.2':
   {
     $flds = "
	company_id I KEY NOT NULL,
	date_searched ".CMS_ADODB_DT." NOT NULL,
        postcode C(20)";
     $sqlarray = $dict->CreateTableSQL(cms_db_prefix()."module_compdir_searchstats", 
				       $flds, $taboptarray);
     $dict->ExecuteSQLArray($sqlarray);
   }
}

?>