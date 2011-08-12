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

if (!$this->CheckPermission('Modify Company Directory'))
{
	echo $this->ShowErrors($this->Lang('needpermission', array('Modify Company Directory')));
	return;
}

if (isset($params['cancel']))
{
	$this->Redirect($id, 'defaultadmin', $returnid);
}

$company_name = '';
if (isset($params['company_name']))
{
	$company_name = $params['company_name'];
}

$address = '';
if (isset($params['address']))
{
	$address = $params['address'];
}

$latitude = '';
if (isset($params['latitude']))
{
	$latitude = $params['latitude'];
}

$longitude = '';
if (isset($params['longitude']))
{
	$longitude = $params['longitude'];
}

$telephone = '';
if (isset($params['telephone']))
{
	$telephone = $params['telephone'];
}

$fax = '';
if (isset($params['fax']))
{
	$fax = $params['fax'];
}

$contact_email = '';
if (isset($params['contact_email']))
{
	$contact_email = $params['contact_email'];
}

$website = '';
if (isset($params['website']))
{
	$website = $params['website'];
}

$details = '';
if (isset($params['details']))
{
	$details = $params['details'];
}

$status = '';
if (isset($params['status']))
{
	$status = $params['status'];
}

function handle_initial_upload($id, $fieldname)
{
	global $gCms;
	$config =& $gCms->GetConfig();

	if (!is_dir($config['uploads_path'] . DIRECTORY_SEPARATOR . 'companydirectory')) {
		@mkdir($config['uploads_path'] . DIRECTORY_SEPARATOR . 'companydirectory');
	}
	if (!is_dir($config['uploads_path'] . DIRECTORY_SEPARATOR . 'companydirectory' . DIRECTORY_SEPARATOR . 'tmp')) {
		@mkdir($config['uploads_path'] . DIRECTORY_SEPARATOR . 'companydirectory' . DIRECTORY_SEPARATOR . 'tmp');
	}
	
	@cms_move_uploaded_file($_FILES[$id . $fieldname]['tmp_name'], $config['uploads_path'] . DIRECTORY_SEPARATOR . 'companydirectory' . DIRECTORY_SEPARATOR . 'tmp' . DIRECTORY_SEPARATOR . basename($_FILES[$id . $fieldname]['name']));
	
	return basename($_FILES[$id . $fieldname]['name']);
}

function handle_tmp_upload($id, $itemid, $filename)
{
	global $gCms;
	$config =& $gCms->GetConfig();

	if (!is_dir($config['uploads_path'] . DIRECTORY_SEPARATOR . 'companydirectory' . DIRECTORY_SEPARATOR . 'id' . $itemid))
	{
		@mkdir($config['uploads_path'] . DIRECTORY_SEPARATOR . 'companydirectory' . DIRECTORY_SEPARATOR . 'id' . $itemid);
	}
	@rename($config['uploads_path'] . DIRECTORY_SEPARATOR . 'companydirectory' . DIRECTORY_SEPARATOR . 'tmp' . DIRECTORY_SEPARATOR . $filename, $config['uploads_path'] . DIRECTORY_SEPARATOR . 'companydirectory' . DIRECTORY_SEPARATOR . 'id' . $itemid . DIRECTORY_SEPARATOR . $filename);
}

$image = '';
if (isset($_FILES[$id . 'imageupload']) && $_FILES[$id . 'imageupload']['tmp_name'] != '')
{	
	$image = handle_initial_upload($id, 'imageupload');
}
else if (isset($params['imagecurrent']))
{
	$image = $params['imagecurrent'];
}

$logo = '';
if (isset($_FILES[$id . 'logoupload']) && $_FILES[$id . 'logoupload']['tmp_name'] != '')
{
	$logo = handle_initial_upload($id, 'logoupload');
}
else if (isset($params['logocurrent']))
{
	$logo = $params['logocurrent'];
}

$userid = get_userid();

if (isset($params['submit']))
{
	if ($company_name != '')
	{
		$query = 'INSERT INTO '.cms_db_prefix().'module_compdir_companies (company_name, address, telephone, 
                            fax, contact_email, website, details, picture_location, logo_location, create_date, 
                            modified_date, status, latitude, longitude) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
		// about line 159 - action.addcompany.php
		$dbr = $db->Execute($query, array($company_name, $address, $telephone, $fax, $contact_email, $website, $details, $image, $logo, trim($db->DBTimeStamp(time()), "'"), trim($db->DBTimeStamp(time()), "'"), $status, $latitude, $longitude));
		if( !$dbr )
		  {
		    echo "QUERY: ".$db->sql.'<br/>';
		    echo "ERROR: ".$db->ErrorMsg().'<br/>';
		    die();
		  }
		
		$cid = $db->Insert_ID();
		
		if (isset($_REQUEST[$id.'customfield']))
		{
			foreach ($_REQUEST[$id.'customfield'] as $k=>$v)
			{
				if (startswith($k, 'field-'))
				{
					$fid = substr($k, 6);
					$query = 'INSERT INTO '.cms_db_prefix().'module_compdir_fieldvals (company_id, fielddef_id, value, create_date, modified_date) VALUES (?,?,?,?,?)';
					$db->Execute($query, array($cid, $fid, $v, trim($db->DBTimeStamp(time()), "'"), trim($db->DBTimeStamp(time()), "'")));
				}
			}
		}
		
		if (isset($_REQUEST[$id.'category']))
		{
			foreach ($_REQUEST[$id.'category'] as $k=>$v)
			{
				if (startswith($k, 'id-'))
				{
					$fid = substr($k, 3);
					$query = 'INSERT INTO '.cms_db_prefix().'module_compdir_company_categories (company_id, category_id, create_date, modified_date) VALUES (?,?,?,?)';
					$db->Execute($query, array($cid, $fid, trim($db->DBTimeStamp(time()), "'"), trim($db->DBTimeStamp(time()), "'")));
				}
			}
		}
		
		if ($image != '')
		{
			handle_tmp_upload($id, $cid, $image);
		}
	
		if ($logo != '')
		{
			handle_tmp_upload($id, $cid, $logo);
		}
		
		//Update search index
		$module =& $this->GetModuleInstance('Search');
		if ($module != FALSE)
		{
			$module->AddWords($this->GetName(), $cid, 'company', implode(' ', array($company_name, $company_name, $address, $telephone, $fax, $details)));
		}

		$params = array('tab_message'=> 'companyadded', 'active_tab' => 'companies');
		$this->Redirect($id, 'defaultadmin', $returnid, $params);
	}
	else
	{
		echo $this->ShowErrors($this->Lang('nonamegiven'));
	}
}

$fielddefs = $this->GetFieldDefs(true);
$fieldarray = array();

if (count($fielddefs) > 0)
{
	foreach ($fielddefs as $fielddef)
	{
		$field = new stdClass();

        $value = '';
        if (isset($fielddef->value))
        {
                $value = $fielddef->value;
        }

		if (isset($_REQUEST[$id.'customfield']['field-'.$fielddef->id]))
			$value = $_REQUEST[$id.'customfield']['field-'.$fielddef->id];
		$field->id = $fielddef->id;
		$field->name = $fielddef->name;
		switch ($fielddef->type)
		{
		case 'dropdown':
		  {
		    $tmp = explode("\n",$fielddef->dropdown_data);
		    $tmp2 = array();
		    for( $i = 0; $i < count($tmp); $i++ )
		      {
			if( strpos($tmp[$i],'=') === FALSE )
			  {
			    $tmp2[$tmp[$i]] = $tmp[$i];
			  }
			else
			  {
			    list($okey,$ovalue) = explode('=',$tmp[$i],2);
			    $tmp2[$ovalue] = $okey;
			  }
		      }
		    $field->input_box = $this->CreateInputDropdown($id,'customfield[field-'.$fielddef->id.']',$tmp2,-1,$value);
		  }
		  break;

		case 'checkbox':
		  $field->input_box = '<input type="hidden" name="' . $id . 'customfield[field-'.$fielddef->id.']' . '" value="false" />'.$this->CreateInputCheckbox($id, 'customfield[field-'.$fielddef->id.']', 'true', $value == 'true');
		  break;
		case 'textarea':
		  $field->input_box = $this->CreateTextArea(true, $id, $value, 'customfield[field-'.$fielddef->id.']');
		  break;
		case 'textbox':
		default:
		  $maxlength = $fielddef->max_length;
		  $size = min($maxlength,80);
		  $field->input_box = $this->CreateInputText($id, 'customfield[field-'.$fielddef->id.']', $value, $size, $maxlength);
		  break;
		}
		$fieldarray[] = $field;
	}
}

$categories = $this->GetCategories();
$catarray = array();

if (count($categories) > 0)
{
	foreach ($categories as $fielddef)
	{
		$field = new stdClass();

		$value = 'false';
		if (isset($_REQUEST[$id.'category']['id-'.$fielddef->id]))
			$value = 'true';

		$field->id = $fielddef->id;
		$field->name = $fielddef->name;
		$field->checkbox = $this->CreateInputCheckbox($id, 'category[id-'.$fielddef->id.']', $value, 'true');

		$catarray[] = $field;
	}
}

#Display template
$this->smarty->assign('startform', $this->CreateFormStart($id, 'addcompany', $returnid, 'post', 'multipart/form-data'));
$this->smarty->assign('endform', $this->CreateFormEnd());
$this->smarty->assign('nametext', $this->Lang('name'));
$this->smarty->assign('inputname', $this->CreateInputText($id, 'company_name', $company_name, 30, 255));

$this->smarty->assign('addresstext', $this->Lang('address'));
$this->smarty->assign('inputaddress', $this->CreateInputText($id, 'address', $address, 30, 255));
$this->smarty->assign('inputlatitude', $this->CreateInputText($id, 'latitude', $latitude, 30, 255));
$this->smarty->assign('inputlongitude', $this->CreateInputText($id, 'longitude', $longitude, 30, 255));
$this->smarty->assign('telephonetext', $this->Lang('telephone'));
$this->smarty->assign('inputtelephone', $this->CreateInputText($id, 'telephone', $telephone, 30, 255));
$this->smarty->assign('faxtext', $this->Lang('fax'));
$this->smarty->assign('inputfax', $this->CreateInputText($id, 'fax', $fax, 30, 255));

$this->smarty->assign('emailtext', $this->Lang('contactemail'));
$this->smarty->assign('inputemail', $this->CreateInputText($id, 'contact_email', $contact_email, 30, 255));
$this->smarty->assign('websitetext', $this->Lang('website'));
$this->smarty->assign('inputwebsite', $this->CreateInputText($id, 'website', $website, 30, 255));
$this->smarty->assign('detailstext', $this->Lang('details'));
$this->smarty->assign('inputdetails', $this->CreateTextArea(true, $id, $details, 'details', '', '', '', '', '80', '5'));
$this->smarty->assign('imageupload', $this->CreateFileUploadInput($id, 'imageupload', '', 80));
$this->smarty->assign('imagecurrent', $image);
$this->smarty->assign('imagetext', $this->Lang('imagetext'));
$this->smarty->assign('imagecurrenthidden', $this->CreateInputHidden($id, 'imagecurrent', $returnid, $image));
$this->smarty->assign('logoupload', $this->CreateFileUploadInput($id, 'logoupload', '', 80));
$this->smarty->assign('logocurrent', $logo);
$this->smarty->assign('logocurrenthidden', $this->CreateInputHidden($id, 'logocurrent', $returnid, $logo));
$this->smarty->assign('logotext', $this->Lang('logotext'));

$statuses = array($this->Lang('published')=>'published',
		  $this->Lang('draft')=>'draft',
		  $this->Lang('disabled')=>'disabled');
$smarty->assign('statustext',$this->Lang('status'));
$smarty->assign('inputstatus',
		$this->CreateInputDropdown($id,'status',
					   $statuses,-1,$status));
$this->smarty->assign('hidden', '');
$this->smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', lang('submit')));
$this->smarty->assign('cancel', $this->CreateInputSubmit($id, 'cancel', lang('cancel')));
$this->smarty->assign_by_ref('customfields', $fieldarray);
$this->smarty->assign('customfieldscount', count($fieldarray));
$this->smarty->assign_by_ref('categories', $catarray);
$this->smarty->assign('categoriescount', count($catarray));

echo $this->ProcessTemplate('editcompany.tpl');

?>
