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


// NOTE IF NOT USED PROPERLY THIS COULD ALLOW ANYBODY TO
// EDIT ANYBODY ELSES RECORDS
// TODO: CHECK IF LOGGED IN AND SILENTLY FAIL IF NOT
// AN OPTIONAL DEPENDENCY ON FEU

if( !isset($gCms) ) exit;

$feu = $this->GetModuleInstance('FrontEndUsers');
if( !$feu )
  {
    echo '<h3><font color="red">'.$this->Lang('error_nofeu')."</font></h3>\n";
    return;
  }
else if( !$feu->LoggedIn() )
  {
    echo '<h3><font color="red">'.$this->Lang('error_feu_loggedin')."</font></h3>\n";
  }

$thetemplate = 'frontendform_'.$this->GetPreference(COMPANYDIR_PREF_DFLTFRONTENDFORM_TEMPLATE);
if( isset($params['summarytemplate'] ) )
  {
    $thetemplate = 'frontendform_'.$params['summarytemplate'];
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

function handle_tmp_upload($id, $itemid, $filename, $fieldname, &$db)
{
	global $gCms;
	$config =& $gCms->GetConfig();

	if (!is_dir($config['uploads_path'] . DIRECTORY_SEPARATOR . 'companydirectory' . DIRECTORY_SEPARATOR . 'id' . $itemid))
	{
		@mkdir($config['uploads_path'] . DIRECTORY_SEPARATOR . 'companydirectory' . DIRECTORY_SEPARATOR . 'id' . $itemid);
	}
	if ($filename == 'deleteme')
	{
		$oldfilename = $db->GetOne('SELECT ' . $fieldname . ' FROM '.cms_db_prefix().'module_compdir_companies WHERE id = ?', array($itemid));
		if (is_file($config['uploads_path'] . DIRECTORY_SEPARATOR . 'companydirectory' . DIRECTORY_SEPARATOR . 'id' . $itemid . DIRECTORY_SEPARATOR . $oldfilename))
		{
			unlink($config['uploads_path'] . DIRECTORY_SEPARATOR . 'companydirectory' . DIRECTORY_SEPARATOR . 'id' . $itemid . DIRECTORY_SEPARATOR . $oldfilename);
		}
		$db->Execute('UPDATE '.cms_db_prefix().'module_compdir_companies SET ' . $fieldname . ' = ? WHERE id = ?', array('', $itemid));
	}
	else if (is_file($config['uploads_path'] . DIRECTORY_SEPARATOR . 'companydirectory' . DIRECTORY_SEPARATOR . 'tmp' . DIRECTORY_SEPARATOR . $filename))
	{
		$oldfilename = $db->GetOne('SELECT ' . $fieldname . ' FROM '.cms_db_prefix().'module_compdir_companies WHERE id = ?', array($itemid));
		if (is_file($config['uploads_path'] . DIRECTORY_SEPARATOR . 'companydirectory' . DIRECTORY_SEPARATOR . 'id' . $itemid . DIRECTORY_SEPARATOR . $oldfilename))
		{
			unlink($config['uploads_path'] . DIRECTORY_SEPARATOR . 'companydirectory' . DIRECTORY_SEPARATOR . 'id' . $itemid . DIRECTORY_SEPARATOR . $oldfilename);
		}
		@rename($config['uploads_path'] . DIRECTORY_SEPARATOR . 'companydirectory' . DIRECTORY_SEPARATOR . 'tmp' . DIRECTORY_SEPARATOR . $filename, $config['uploads_path'] . DIRECTORY_SEPARATOR . 'companydirectory' . DIRECTORY_SEPARATOR . 'id' . $itemid . DIRECTORY_SEPARATOR . $filename);
		$db->Execute('UPDATE '.cms_db_prefix().'module_compdir_companies SET ' . $fieldname . ' = ? WHERE id = ?', array($filename, $itemid));
	}
}

//
// Strip all params of the cd_ prefix
//
$p2 = array();
foreach( $params as $key => $value )
{
  $t = substr($key,0,3);
  if( $t == 'cd_' )
    {
      $newkey = substr($key,3);
      $p2[$newkey] = $value;
    }
  else
    {
      $p2[$key] = $value;
    }
}
$params = $p2;

if( !isset( $params['companyid'] ) )
  {
    // todo, put an error here
    return;
  }
$companyid = $params['companyid'];
$fielddefs = array();
{
  $tmp = $this->GetFieldDefsForCompany($companyid,false,false);
  foreach( $tmp as $one )
    {
      $fielddefs[$one->id] = $one;
    }
}



$image = '';
if (isset($_FILES[$id . 'cd_imageupload']) && $_FILES[$id . 'cd_imageupload']['tmp_name'] != '')
{	
	$image = handle_initial_upload($id, 'cd_imageupload');
}
else if (isset($params['cd_deleteimage']))
{
	$image = 'deleteme';
}
else if (isset($params['cd_imagecurrent']))
{
	$image = $params['cd_imagecurrent'];
}


$logo = '';
if (isset($_FILES[$id . 'cd_logoupload']) && 
    $_FILES[$id . 'cd_logoupload']['tmp_name'] != '')
{
	$logo = handle_initial_upload($id, 'cd_logoupload');
}
else if (isset($params['cd_deletelogo']))
{
	$logo = 'deleteme';
}
else if (isset($params['cd_logocurrent']))
{
	$logo = $params['cd_logocurrent'];
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
	$details = cms_html_entity_decode($params['details']);
}

$origname = '';
if (isset($params['origname']))
{
	$origname = $params['origname'];
}

if( isset( $params['submit'] ) )
  {
    $error = false;
    if( $company_name == '' )
      {
	$smarty->assign('message',$this->Lang('error_companyname'));
	$error = true;
      }
    else if( $company_name != $origname )
      {
	// check to make sure that the company name isn't already
	// used
	$query = 'SELECT id FROM '.cms_db_prefix().'module_compdir_companies
                   WHERE company_name = ? AND id != ?';
	$dbresult = $db->Execute( $query, array( $company_name, $companyid ));
	if( $dbresult && $dbresult->RecordCount() > 0 )
	  {
	    $smarty->assign('message',$this->Lang('error_companyname_inuse'));
	    $error = true;
	  }
      }

    if( !$error )
      {
	//
	// update the company record
	//
	$now = trim($db->DBTimeStamp(time()),"'");
	$query = 'UPDATE '.cms_db_prefix().'module_compdir_companies
                 SET company_name = ?, address = ?, telephone = ?, 
                     fax = ?, contact_email = ?, website = ?,
                     details = ?, modified_date = ?
               WHERE id = ?';
	$parms = array($company_name,$address,$telephone,$fax,$contact_email,
		       $website,$details,$now,$companyid);
	$db->Execute( $query, $parms );
	
	//
	// Update the custom fields
	//
	if( count($fielddefs) )
	  {
	    $ids = array();
	    foreach( $params['customfield'] as $k=>$v )
	      {
		if(startswith($k,'field-')) {
		  $ids[] = (int)substr($k,6);
		}
	      }
	    $db->Execute('DELETE FROM '.cms_db_prefix().'module_compdir_fieldvals
                   WHERE company_id = ? AND fielddef_id IN ('.implode(',',$ids).')',
			 array($companyid));
	    if( isset( $params['customfield'] ) )
	      {
		foreach( $params['customfield'] as $k=>$v )
		  {
		    if(startswith($k,'field-')) {
		      $fid = substr($k,6);
		      
		      // do an entity decode on text area fields
		      if( $fielddefs[$fid]->type == 'textarea' || $fielddefs[$fid]->type == 'textbox' )
			{
			  $v = cms_html_entity_decode($v);
			}
		      
		      $query = 'INSERT INTO '.cms_db_prefix().'module_compdir_fieldvals
                         (company_id, fielddef_id, value, create_date, modified_date) VALUES (?,?,?,?,?)';
		      $parms = array( $companyid, $fid, $v, $now, $now );
		      $dbr = $db->Execute( $query, $parms );
		    }
		  }
	      }
	  }

	//
	// Update the categories
	//
	$db->Execute('DELETE FROM '.cms_db_prefix().'module_compdir_company_categories WHERE company_id = ?', array($companyid));
	
	if( isset( $params['category'] ) )
	  {
	    foreach( $params['category'] as $k=>$v )
	      {
		if( startswith($k,'id-') )
		  {
		    $fid = substr($k,3);
		    $query = 'INSERT INTO '.cms_db_prefix().'module_compdir_company_categories (company_id, category_id, create_date, modified_date )
                           VALUES (?,?,?,?)';
		    $parms = array($companyid,$fid,$now,$now);
		    $db->Execute($query,$parms);
		  }
	      }
	  }

	//
	// Handle any image stuff
	//
	if ($image != '')
	  {
	    handle_tmp_upload($id, $companyid, $image, 'picture_location', $db);
	  }
	
	if ($logo != '')
	  {
	    handle_tmp_upload($id, $companyid, $logo, 'logo_location', $db);
	  }

	//
	// Update Search
	//
	$module =& $this->GetModuleInstance('Search');
	if ($module != FALSE)
	  {
	    $module->AddWords($this->GetName(), $comanyid, 'company', implode(' ', array($company_name, $company_name, $address, $telephone, $fax, $details)));
	  }
	
      } // if( !$error )

    if( isset($params['referer']) )
      {
	redirect($params['referer']);
      }
  }
else
  {
    $query = 'SELECT * FROM '.cms_db_prefix().'module_compdir_companies WHERE id = ?';
    $row = $db->GetRow($query, array($companyid));
    if( $row )
      {
	$company_name = $row['company_name'];
	$address = $row['address'];
	$telephone = $row['telephone'];
	$fax = $row['fax'];
	$contact_email = $row['contact_email'];
	$website = $row['website'];
	$details = $row['details'];
	$image = $row['picture_location'];
	$logo = $row['logo_location'];
	$origname = $row['company_name'];
      }
	
  }


//
// Get the field definitions
//
$fieldarray = array();

if (count($fielddefs) > 0)
  {
    foreach ($fielddefs as $fid => $fielddef)
      {
	$field = new stdClass();
	    
	$value = '';
	if (isset($fielddef->value))
	  {
	    $value = $fielddef->value;
	  }
	    
	if (isset($params['customfield']['field-'.$fielddef->id]))
	  $value = $params['customfield']['field-'.$fielddef->id];
	    
	$field->id = $fielddef->id;
	$field->name = $fielddef->name;
	switch ($fielddef->type)
	  {
	  case 'checkbox':
	    $field->input_box = '<input type="hidden" name="' . $id . 'cd_customfield[field-'.$fielddef->id.']' . '" value="false" />' . 
	      $this->CreateInputCheckbox($id, 'cd_customfield[field-'.$fielddef->id.']', 'true', 
					 $value);
	    break;
	  case 'textarea':
	    $field->input_box = $this->CreateTextArea(true, $id, $value, 'cd_customfield[field-'.$fielddef->id.']');
	    break;
	  case 'textbox':
	  default:
	    $maxlength = $fielddef->max_length;
	    $size = min($maxlength,80);
	    $field->input_box = $this->CreateInputText($id, 'cd_customfield[field-'.$fielddef->id.']', $value, $size, $maxlength);
	    break;
	  }
	    
	$fieldarray[] = $field;
      }
  }


//
// Get the categories
//
$categories = $this->GetCategoriesForCompany($companyid,false);
$catarray = array();
    
if (count($categories) > 0)
  {
    foreach ($categories as $fielddef)
      {
	$field = new stdClass();

	$value = '';
	if (isset($params['category']))
	  {
	    if (isset($params['category']['id-'.$fielddef->id]))
	      $value = 'true';
	    else
	      $value = 'false';
	  }

	$field->id = $fielddef->id;
	$field->name = $fielddef->name;
	$field->checkbox = $this->CreateInputCheckbox($id, 'cd_category[id-'.$fielddef->id.']', $value, 'true');

	$catarray[] = $field;
      }
  }


//
// Populate The Template
//
$parms = array();
if( isset($_SERVER['HTTP_REFERER']) )
  {
    global $gCms;
    $config =& $gCms->GetConfig();

    $admin_dir = $config['root_url'].'/'.$config['admin_dir'];
    if( strstr($admin_dir,$_SERVER['HTTP_REFERER']) !== FALSE )
      {
	$parms['cd_referer'] = $_SERVER['HTTP_REFERER'];
      }
  }
$smarty->assign('startform',
		$this->CGCreateFormStart($id,'fe_edit',$returnid,
					 $parms,
					 false,'post','multipart/form-data'));
$smarty->assign('endform',$this->CreateFormEnd());

$smarty->assign('nametext',$this->Lang('name'));
$smarty->assign('inputname',$this->CreateInputText($id,'cd_company_name',$company_name, 30));

$smarty->assign('addresstext', $this->Lang('address'));
$smarty->assign('inputaddress', $this->CreateInputText($id, 'cd_address', $address, 30));

$smarty->assign('telephonetext', $this->Lang('telephone'));
$smarty->assign('inputtelephone', $this->CreateInputText($id, 'cd_telephone', $telephone, 30));

$smarty->assign('faxtext', $this->Lang('fax'));
$smarty->assign('inputfax', $this->CreateInputText($id, 'cd_fax', $fax, 30, 255));

$smarty->assign('emailtext', $this->Lang('contactemail'));
$smarty->assign('inputemail', $this->CreateInputText($id, 'cd_contact_email', $contact_email, 30));

$smarty->assign('websitetext', $this->Lang('website'));
$smarty->assign('inputwebsite', $this->CreateInputText($id, 'cd_website', $website, 30));

$smarty->assign('detailstext', $this->Lang('details'));
$smarty->assign('inputdetails', $this->CreateTextArea(true, $id, $details, 'cd_details', '', '', '', '', '80', '5'));

$smarty->assign('deletetext',$this->Lang('delete'));
$smarty->assign('imageupload', $this->CreateFileUploadInput($id, 'cd_imageupload'));
$smarty->assign('imagecurrent', $image);
$smarty->assign('imagecurrenthidden', $this->CreateInputHidden($id, 'cd_imagecurrent', $returnid, $image));
$smarty->assign('imagecurrentdelete', $this->CreateInputCheckbox($id, 'cd_deleteimage', 'checked', ''));
$smarty->assign('imagetext', $this->Lang('imagetext'));

$smarty->assign('logoupload', $this->CreateFileUploadInput($id, 'cd_logoupload'));
$smarty->assign('logocurrent', $logo);
$smarty->assign('logocurrenthidden', $this->CreateInputHidden($id, 'cd_logocurrent', $returnid, $logo));
$smarty->assign('logocurrentdelete',$this->CreateInputCheckbox($id, 'cd_deletelogo', 'checked', ''));
$smarty->assign('logotext', $this->Lang('logotext'));

$smarty->assign('companyid',$companyid);
$this->smarty->assign('hidden', 
		      $this->CreateInputHidden($id, 'cd_companyid', $companyid).
		      $this->CreateInputHidden($id, 'cd_origname', $origname));
$this->smarty->assign('submit', $this->CreateInputSubmit($id, 'cd_submit', 
							 $this->Lang('submit')));

$this->smarty->assign_by_ref('customfields', $fieldarray);
$this->smarty->assign('customfieldscount', count($fieldarray));

$this->smarty->assign_by_ref('categories', $catarray);
$this->smarty->assign('categoriescount', count($catarray));

echo $this->ProcessTemplateFromDatabase($thetemplate);

// EOF
?>
