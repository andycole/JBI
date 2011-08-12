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

$thetemplate = 'detail_'.$this->GetPreference(COMPANYDIR_PREF_DFLTDETAIL_TEMPLATE);
if( isset($params['detailtemplate'] ) )
  {
    $thetemplate = 'detail_'.$params['detailtemplate'];
  }

$entryarray = array();

$query = "SELECT * FROM ".cms_db_prefix()."module_compdir_companies WHERE id = ?";
$dbresult = $db->Execute($query,array($params['companyid']));

global $gCms;
$config =& $gCms->GetConfig();

if ($dbresult->RecordCount() > 0)
{
	while ($dbresult && $row = $dbresult->FetchRow())
	{
		$onerow = new stdClass();

		$onerow->id = $row['id'];
		$onerow->company_name = $row['company_name'];
		$onerow->address = $row['address'];
		$onerow->latitude = $row['latitude'];
		$onerow->longitude = $row['longitude'];
		$onerow->telephone = $row['telephone'];
		$onerow->fax = $row['fax'];
		$onerow->contact_email = $row['contact_email'];
		$onerow->website = $row['website'];
		$onerow->details = $row['details'];
		$onerow->picture_location = $row['picture_location'];
		$onerow->picture_path = $config['root_url'] . '/uploads/companydirectory/id' . $row['id'] . '/' . $row['picture_location'];
		$onerow->logo_location = $row['logo_location'];
		$onerow->logo_path = $config['root_url'] . '/uploads/companydirectory/id' . $row['id'] . '/' . $row['logo_location'];	
		
		$fielddefs = $this->GetFieldDefsForCompany($params['companyid']);
		$fieldarray = array();
		$fieldsbyname = array();
		if (count($fielddefs) > 0)
		{
			foreach ($fielddefs as $fielddef)
			{
				$field = new stdClass();
				$field->type = $fielddef->type;
				$field->id = $fielddef->id;
				$field->name = $fielddef->name;
				$field->value = $fielddef->value;
				$fieldarray[] = $field;

				$fieldsbyname[$fielddef->name] = $fielddef->value;
			}
		}		
		$onerow->customfieldsbyname = $fieldsbyname;

		$this->smarty->assign_by_ref('customfields', $fieldarray);
		$this->smarty->assign('customfieldscount', count($fieldarray));

		$categories = $this->GetCategoriesForCompany($params['companyid']);
		$catarray = array();
		$catnamearray = array();

		if (count($categories) > 0)
		{
			foreach ($categories as $fielddef)
			{
				$field = new stdClass();

				$value = $fielddef->value;
				if ($value)
				{
					$field->id = $fielddef->id;
					$field->name = $fielddef->name;
					
					$catarray[] = $field;

					$catnamearray[] = $fielddef->name;
				}
			}
		}
		
		$this->smarty->assign_by_ref('entry', $onerow);
		$this->smarty->assign('categorytext', implode(", ", $catnamearray));
		$this->smarty->assign('categories', $catarray);
		$this->smarty->assign('categoriescount', count($catarray));
	
		echo $this->ProcessTemplateFromDatabase($thetemplate);
	}
}
else
{
	echo 'Entry Not Found';
}

?>