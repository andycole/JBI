<?php  /* -*- Mode: PHP; tab-width: 4; c-basic-offset: 2 -*- */
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

$cgextensions = cms_join_path($gCms->config['root_path'],'modules',
			      'CGExtensions','CGExtensions.module.php');
if( !is_readable( $cgextensions ) )
{
  echo '<h1><font color="red">ERROR: The CGExtensions module could not be found.</font></h1>';
  return;
}
require_once($cgextensions);

define('COMPANYDIR_PREF_NEWSUMMARY_TEMPLATE','companydir_pref_newsummary_template');
define('COMPANYDIR_PREF_DFLTSUMMARY_TEMPLATE','companydir_pref_dfltsummary_template');
define('COMPANYDIR_PREF_NEWDETAIL_TEMPLATE','companydir_pref_newdetail_template');
define('COMPANYDIR_PREF_DFLTDETAIL_TEMPLATE','companydir_pref_dfltdetail_template');
define('COMPANYDIR_PREF_NEWCATEGORYLIST_TEMPLATE','companydir_pref_newcategorylist_template');
define('COMPANYDIR_PREF_DFLTCATEGORYLIST_TEMPLATE','companydir_pref_dfltcategorylist_template');
define('COMPANYDIR_PREF_NEWSEARCHFORM_TEMPLATE','companydir_pref_newsearchform_template');
define('COMPANYDIR_PREF_DFLTSEARCHFORM_TEMPLATE','companydir_pref_dfltsearchform_template');
define('COMPANYDIR_PREF_NEWFRONTENDFORM_TEMPLATE','companydir_pref_newfrontendform_template');
define('COMPANYDIR_PREF_DFLTFRONTENDFORM_TEMPLATE','companydir_pref_dfltfrontendform_template');

class CompanyDirectory extends CGExtensions
{
  var $_company_name_cache;

  function CompanyDirectory()
  {
    parent::CMSModule();
	$this->_company_name_cache = array();
  }

	function GetName()
	{
		return 'CompanyDirectory';
	}

	function GetFriendlyName()
	{
		return $this->Lang('companydirectory');
	}

	function GetDependencies()
	{
	  return array('CGExtensions'=>'1.17',
		   'CGSimpleSmarty'=>'1.4.3');
	}

	function IsPluginModule()
	{
		return true;
	}

	function HasAdmin()
	{
		return true;
	}

	function GetVersion()
	{
		return '1.4.1';
	}

	function MinimumCMSVersion()
	{
		return '1.6.5';
	}

	function GetAdminDescription()
	{
		return $this->Lang('description');
	}

	function VisibleToAdminUser()
	{
	  return $this->CheckPermission('Modify Company Directory') ||
		$this->CheckPermission('Modify Templates') ||
		$this->CheckPermission('Modify Site Preferences');
	}

	function SetParameters()
	{
	  $this->RegisterModulePlugin();
	  $this->RestrictUnknownParams();

	  $this->CreateParameter('action','default',$this->Lang('param_action'));

	  $this->CreateParameter('companyid','',$this->Lang('param_companyid'));
	  $this->SetParameterType('companyid',CLEAN_INT);

	  $this->CreateParameter('detailpage','',$this->Lang('param_detailpage'));
	  $this->SetParameterType('detailpage',CLEAN_STRING);

	  $this->CreateParameter('categorylisttemplate','',$this->Lang('param_categorylisttemplate'));
	  $this->SetParameterType('categorylisttemplate',CLEAN_STRING);

	  $this->CreateParameter('searchformtemplate','',$this->Lang('param_searchformtemplate'));
	  $this->SetParameterType('searchformtemplate',CLEAN_STRING);

	  $this->CreateParameter('detailtemplate','',$this->Lang('param_detailtemplate'));
	  $this->SetParameterType('detailtemplate',CLEAN_STRING);

	  $this->CreateParameter('frontendformtemplate','',$this->Lang('param_frontendformtemplate'));
	  $this->SetParameterType('frontendformtemplate',CLEAN_STRING);

	  $this->CreateParameter('summarytemplate','',$this->Lang('param_summarytemplate'));
	  $this->SetParameterType('summarytemplate',CLEAN_STRING);

	  $this->CreateParameter('showall','',$this->Lang('param_showall'));
	  $this->SetParameterType('showall',CLEAN_INT);

	  $this->CreateParameter('sortby','company_name',$this->Lang('param_sortby'));
	  $this->SetParameterType('sortby',CLEAN_STRING);
	  $this->CreateParameter('sortorder','asc',$this->Lang('param_sortorder'));
	  $this->SetParameterType('sortorder',CLEAN_STRING);
	  $this->CreateParameter('selectcategory',0,$this->Lang('param_selectcategory'));
	  $this->SetParameterType('selectcategory',CLEAN_INT);
	  $this->CreateParameter('category','',$this->Lang('param_category'));
	  $this->SetParameterType('category',CLEAN_STRING);

	  $this->CreateParameter('inline',0,$this->Lang('param_inline'));
	  $this->SetParameterType('inline',CLEAN_INT);

	  $this->CreateParameter('pagelimit','',$this->Lang('param_pagelimit'));
	  $this->SetParameterType('pagelimit',CLEAN_INT);

	  $this->SetParameterType('categoryid',CLEAN_INT);
      $this->SetParameterType(CLEAN_REGEXP.'/cd_.*/',CLEAN_STRING);

	  $this->SetParameterType('page',CLEAN_INT);
	  $this->SetParameterType('inputsubmit',CLEAN_STRING);

	  // Friendly URL stuff
	  // todo, add defaults here
	  $this->RegisterRoute('/[cC]ompanies\/(?P<companyid>[0-9]+)\/(?P<returnid>[0-9]+)$/');
	  $this->RegisterRoute('/[cC]ompanies\/(?P<companyid>[0-9]+)\/(?P<returnid>[0-9]+)\/d,(?P<detailtemplate>.*?)$/');
	  $this->RegisterRoute('/[cC]ompanies\/(?P<companyid>[0-9]+)$/');
	  $this->RegisterRoute('/[cC]ompanies\/bycategory\/(?P<categoryid>[0-9]+)$/');
	  $this->RegisterRoute('/[cC]ompanies\/bycategory\/(?P<categoryid>[0-9]+)\/(?P<returnid>[0-9]+)$/');
	}

	function InstallPostMessage()
	{
	  return $this->Lang('postinstall');
	}

	function UninstallPostMessage()
	{
	  return $this->Lang('postuninstall');
	}

	function UninstallPreMessage()
	{
	  return $this->Lang('preuninstall');
	}

	function GetHelp($lang='en_US')
	{
		return $this->Lang('help');
	}

	function GetAdminSection()
	{
	  return 'content';
	}

	function AllowAutoInstall()
	{
		return FALSE;
	}

	function AllowAutoUpgrade()
	{
		return FALSE;
	}

	function GetAuthor()
	{
		return 'Ted Kulp';
	}

	function GetAuthorEmail()
	{
		return 'ted@ten39.com';
	}

	function GetChangeLog()
	{
	  $fn = dirname(__FILE__).'/changelog.inc';
	  if( file_exists($fn) )
		{
		  $t = file_get_contents($fn);
		  return $t;
		}
	}

	function GetEventDescription( $eventname )
	{
		return $this->lang('eventdesc-' . $eventname);
	}

	function GetEventHelp( $eventname )
	{
		return $this->lang('eventhelp-' . $eventname);
	}

	
  /*---------------------------------------------------------
   GetHeaderHTML()
   ---------------------------------------------------------*/
  function GetHeaderHTML()
  {
    $obj =& $this->GetModuleInstance('JQueryTools');
    if( is_object($obj) )
      {
$tmpl = <<<EOT
{JQueryTools action='incjs' exclude='form'}
{JQueryTools action='ready'}
EOT;
        return $this->ProcessTemplateFromData($tmpl);
      }
  }	


	function GetFieldTypes()
	{
	  return array('textbox'  => $this->Lang('field_textbox'),
				   'checkbox' => $this->Lang('field_checkbox'),
				   'textarea' => $this->Lang('field_textarea'),
				   'dropdown' => $this->Lang('field_dropdown'));
	}
	
	function GetCategories()
	{
		$entryarray = array();
		
		global $gCms;
		$db =& $gCms->GetDB();
		
		$query = 'SELECT * FROM '.cms_db_prefix().'module_compdir_categories';
		$dbresult = $db->Execute($query);

		while ($dbresult && $row = $dbresult->FetchRow())
		{
			$onerow = new stdClass();
			
			$onerow->id = $row['id'];
			$onerow->name = $row['name'];
			$onerow->value = false;
			
			$entryarray[] = $onerow;
		}
		
		return $entryarray;
	}
	
	function GetCategoriesForCompany($id)
	{
		$entryarray = array();

		global $gCms;
		$db =& $gCms->GetDB();
		
		$entryarray = $this->GetCategories();

		$query = 'SELECT c.* FROM '.cms_db_prefix().'module_compdir_company_categories c WHERE c.company_id = ?';
		$dbresult = $db->Execute($query, array($id));

		while ($dbresult && $row = $dbresult->FetchRow())
		{
			$count = 0;
			foreach ($entryarray as $field)
			{
				//$entryarray[$count]->value = false;
				if ($row['category_id'] == $field->id)
				{
					$entryarray[$count]->value = true;
				}
				$count++;
			}
		}
		
		return $entryarray;
	}
	
	function GetFieldDefs($admin = false,$public = true)
	{
		$entryarray = array();
		
		global $gCms;
		$db =& $gCms->GetDB();
		
		if( $admin == true && $public == true )
		  {
			$query = 'SELECT * FROM '.cms_db_prefix().'module_compdir_fielddefs ORDER BY item_order';
		  }
		else if( $public == true )
		  {
			$query = 'SELECT * FROM '.cms_db_prefix().'module_compdir_fielddefs WHERE public > 0 ORDER BY item_order';
		  }
		else
		  {
			$query = 'SELECT * FROM '.cms_db_prefix().'module_compdir_fielddefs WHERE admin_only <= 0 ORDER BY item_order';
		  }
		$dbresult = $db->Execute($query);

		while ($dbresult && $row = $dbresult->FetchRow())
		{
			$onerow = new stdClass();
			
			$onerow->id = $row['id'];
			$onerow->name = $row['name'];
			$onerow->type = $row['type'];
			$onerow->max_length = $row['max_length'];
			$onerow->dropdown_data = $row['dropdown_data'];
			$entryarray[] = $onerow;
		}
		
		return $entryarray;
	}
	
	function GetFieldDefsForCompany($id,$admin = false,$public = true)
	{
		$entryarray = array();

		global $gCms;
		$db =& $gCms->GetDB();
		
		$entryarray = $this->GetFieldDefs($admin,$public);


		$query = '';
		if( $admin == true && $public == true )
		  {
			$query = 'SELECT fv.* FROM '.cms_db_prefix().'module_compdir_fieldvals fv WHERE fv.company_id = ?';
		  }
		else if( $public == true )
		  {
			$query = 'SELECT b.* FROM '.cms_db_prefix().'module_compdir_fielddefs a, '.cms_db_prefix().'module_compdir_fieldvals b WHERE a.id = b.fielddef_id AND a.public > 0 and b.company_id = ?';
		  }
		else 
		  {
			$query = 'SELECT b.* FROM '.cms_db_prefix().'module_compdir_fielddefs a, '.cms_db_prefix().'module_compdir_fieldvals b WHERE a.id = b.fielddef_id AND a.admin_only <= 0 and b.company_id = ?';
		  }
		$dbresult = $db->Execute($query, array($id));

		while ($dbresult && $row = $dbresult->FetchRow())
		{
			$count = 0;
			foreach ($entryarray as $field)
			{
				if ($row['fielddef_id'] == $field->id)
				{
					$entryarray[$count]->fielddef_id = $field->id;
					$entryarray[$count]->value = $row['value'];
				}
				$count++;
			}
		}
		
		return $entryarray;
	}
	
	function SearchResult($returnid, $companyid, $attr = '')
	{
		$result = array();
		
		if ($attr == 'company')
		{
			$db =& $this->GetDb();
			$q = "SELECT company_name FROM ".cms_db_prefix()."module_compdir_companies WHERE
			      id = ?";
			$dbresult = $db->Execute( $q, array( $companyid ) );
			if ($dbresult)
			{
				$row = $dbresult->FetchRow();

				//0 position is the prefix displayed in the list results.
				$result[0] = $this->GetFriendlyName();
		
				//1 position is the title
				$result[1] = $row['company_name'];

				//2 position is the URL to the title.
				$result[2] = $this->CreateLink('cntnt01', 'details', $returnid, '', array('companyid' => $companyid) ,'', true, false, '', true);
			}
		}
		
		return $result;
	}
	
	function SearchReindex(&$module)
	{
		$db =& $this->GetDb();
		
		$query = 'SELECT * FROM '.cms_db_prefix().'module_compdir_companies';
		$result = &$db->Execute($query);

		while ($result && !$result->EOF)
		{
			$module->AddWords($this->GetName(), $result->fields['id'], 'company', implode(' ', array($result->fields['company_name'], $result->fields['company_name'], $result->fields['address'], $result->fields['telephone'], $result->fields['fax'], $result->fields['details'])));
			$result->MoveNext();
		}
	}


	function CreateCompanyPulldown($id,$name,$selected = '')
	{
	  $db =& $this->GetDb();
	  $query = 'SELECT id,company_name FROM '.cms_db_prefix().'module_compdir_companies WHERE status = \'published\'';

	  $dbr = $db->Execute( $query );
	  $companies = array();
	  while( $dbr && ($row = $dbr->FetchRow()) )
		{
		  $companies[$row['company_name']] = $row['id'];
		}

	  $addtext = '';
	  if(count($companies) == 0 )
		{
		  $addtext='disabled';
		}
	  $fld = $this->CreateInputDropdown( $id, $name, $companies, -1, 
										 $selected, $addtext );
	  return $fld;
	}

	
	function GetCompanyNameFromId( $id )
	{
	  if( !isset( $this->_company_name_cache[$id] ) )
		{
		  $db =& $this->GetDb();
		  $query = "SELECT company_name FROM ".cms_db_prefix()."module_compdir_companies
                     WHERE id = ?";
		  $name = $db->GetOne( $query, array( $id ) );
		  if(!$name) return FALSE;
		  $this->_company_name_cache[$id] = $name;
		}

	  return $this->_company_name_cache[$id];
	}

  // radius in miles.
  function GetBoundingBox($latitude,$longitude,$radius) 
  {
	$lng_min = $longitude - $radius / abs(cos(deg2rad($latitude)) * 69);
	$lng_max = $longitude + $radius / abs(cos(deg2rad($latitude)) * 69);
	$lat_min = $latitude - ($radius / 69);
	$lat_max = $latitude + ($radius / 69);
	
	$tmp = array($lat_min,$lat_max,$lng_min,$lng_max);
	return $tmp;
  }


}

# vim:ts=4 sw=4 noet
?>
