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
if( !isset($gCms) ) exit;

#
# Cached data
#
$_fielddef_cache = null;
$_category_cache = null;
$_error = '';


#
# Functions
#
function _set_error($msg)
{
  global $_error;
  
  $_error = $msg;
}


function _get_error()
{
  global $_error;
  return $_error;
}


function _get_fielddef_id($name)
{
  global $_fielddef_cache;
  global $gCms;
  $db =& $gCms->GetDb();

  if( !is_array($_fielddef_cache) )
    {
      $query = 'SELECT id,name FROM '.cms_db_prefix().'module_compdir_fielddefs ORDER BY item_order';
      $tmp = $db->GetArray($query);
      if( is_array($tmp) )
	{
	  $_fielddef_cache = array();
	  for( $i = 0; $i < count($tmp); $i++ )
	    {
	      $_fielddef_cache[$tmp[$i]['name']] = $tmp[$i]['id'];
	    }
	}
    }
  else if( !isset($_fielddef_cache[$name]) )
    {
      // try to get it from the db and cache it
      $query = 'SELECT id FROM '.cms_db_prefix().'module_compdir_fielddefs WHERE name = ?';
      $tmp = $db->GetOne($query,array($name));
      if( $tmp )
	{
	  $_fielddef_cache[$name] = $tmp;
	}
    }

  if( is_array($_fielddef_cache) && isset($_fielddef_cache[$name]) )
    {
      return $_fielddef_cache[$name];
    }
  return FALSE;
}


function _get_category_id($name)
{
  global $_category_cache;
  global $gCms;
  $db =& $gCms->GetDb();

  if( !is_array($_category_cache) )
    {
      $query = 'SELECT id,name FROM '.cms_db_prefix().'module_compdir_categories';
      $tmp = $db->GetArray($query);
      if( is_array($tmp) )
	{
	  $_category_cache = array();
	  for( $i = 0; $i < count($tmp); $i++ )
	    {
	      $_category_cache[$tmp[$i]['name']] = $tmp[$i]['id'];
	    }
	}
    }
  else if( !isset($_category_cache[$name]) )
    {
      // try to get it from the db and cache it
      $query = 'SELECT id FROM '.cms_db_prefix().'module_compdir_categories WHERE name = ?';
      $tmp = $db->GetOne($query,array($name));
      if( $tmp )
	{
	  $_category_cache[$name] = $tmp;
	}
    }

  if( is_array($_category_cache) && isset($_category_cache[$name]) )
    {
      return $_category_cache[$name];
    }
  return FALSE;

}


function _unprocess_data($data)
{
  // strip quotes
  $data = trim($data,'"');
  
  // newlines
  $data = str_replace("^^","\n",$data);

  return $data;
}


function _process_fielddef(&$mod,$line,$rule,$delimeter)
{
  global $gCms;
  $db =& $gCms->GetDb();

  // break the line into fields again
  $fields = explode($delimeter,$line);
  
  // build a new record
  $record = array();
  $record['dropdown_data'] = '';
  for( $fld = 1; $fld < count($rule['flds']); $fld++ )
    {
      $fname = $rule['flds'][$fld];

      $record[$fname] = _unprocess_data($fields[$fld]);
    }

  // check for duplicate
  $tmp = _get_fielddef_id($record['name']);
  if( $tmp ) 
    {
      _set_error($mod->Lang('error_duplicate_fielddef'));
      return FALSE;
    }

  // insert that record
  $now = $db->DbTimeStamp(time());
  $item_order = $db->GetOne('SELECT max(item_order) + 1 FROM ' . cms_db_prefix() . 'module_compdir_fielddefs');
  $query = "INSERT INTO ".cms_db_prefix()."module_compdir_fielddefs
             (name, type, max_length, admin_only, public, dropdown_data, item_order, create_date, modified_date)
            VALUES (?,?,?,?,?,?,?,$now,$now)";
  $dbr = $db->Execute($query,array($record['name'],$record['type'],$record['max_length'],
				   $record['admin_only'],$record['public'],
				   $record['dropdown_data'],$item_order));

  // trap the error.
  if( !$dbr )
    {
      _set_error($mod->Lang('error_insert_fielddef'));
      return FALSE;
    }
  return TRUE;

}

function _process_category(&$mod,$line,$rule,$delimeter)
{
  global $gCms;
  $db =& $gCms->GetDb();

  // break the line into fields again
  $fields = explode($delimeter,$line);

  // build a new record
  $record = array();
  for( $fld = 1; $fld < count($rule['flds']); $fld++ )
    {
      $fname = $rule['flds'][$fld];

      $record[$fname] = _unprocess_data($fields[$fld]);
    }

  // check for duplicate
  $tmp = _get_category_id($record['name']);
  if( $tmp ) 
    {
      _set_error($mod->Lang('error_duplicate_category'));
      return FALSE;
    }
  
  // insert that record
  $now = $db->DbTimeStamp(time());
  $query = "INSERT INTO ".cms_db_prefix()."module_compdir_categories (name,create_date,modified_date)
             VALUES (?,$now,$now)";
  $dbr = $db->Execute($query,array($record['name']));
  
  // trap the error.
  if( !$dbr )
    {
      _set_error($mod->Lang('error_insert_category'));
      return FALSE;
    }
  return TRUE;
}


function _process_company(&$mod,$fields,$rule,$delimeter,$do_fieldvals,$do_categoryvals,$do_lookup,$check_duplicates)
{
  global $gCms;
  $db =& $gCms->GetDb();
  $userid = get_userid();

  // build a new record
  $record = array();
  $record['contact_email'] = '';
  $record['details'] = '';
  $record['status'] = 'published';
  $record['latitude'] = '';
  $record['longitude'] = '';

  $fieldvals = array();
  $categories = array();
  for( $fld = 1; $fld < count($rule['flds']); $fld++ )
    {
      if( !isset($fields[$fld]) ) continue;
      $fname = $rule['flds'][$fld];

      if( startswith($fname,'FIELD:') )
	{
	  $fieldvals[substr($fname,6)] = $fields[$fld];
	}
      else if( startswith($fname,'CAT:') )
	{
	  $categories[substr($fname,4)] = $fields[$fld];
	}
      else
	{
	  $record[$fname] = _unprocess_data($fields[$fld]);
	}
    }

  // data validation
  if( !isset($record['company_name']) || empty($record['company_name']) )
    {
      _set_error($mod->Lang('error_import_badvalue','company_name'));
      return FALSE;
    }

  // do optional lat/long lookup
  $record['latitude'] = '';
  if( empty($record['latitude']) || empty($record['longitude']) && !empty($record['address']) )
    {
      if( isset($gCms->modules['CGGoogleMaps']) && isset($gCms->modules['CGGoogleMaps']['object']) )
	{
	  $cggm =& $gCms->modules['CGGoogleMaps']['object'];
	  if( $cggm )
	    {
	      $data = $cggm->GetCoordsFromAddress($record['address']);
	      $record['latitude'] = $data['lat'];
	      $record['longitude'] = $data['lon'];
	    }
	}
    }

  // check for duplicate?
  if( $check_duplicates )
    {
      $query = 'SELECT id FROM '.cms_db_prefix().'module_compdir_companies WHERE company_name = ?';
      $tmp = $db->GetOne($query,array($record['company_name']));
      if( $tmp ) 
	{
	  _set_error($mod->Lang('error_duplicate_company',$record['company_name']));
	  return FALSE;
	}
    }
  
  // insert that record
  $now = $db->DbTimeStamp(time());
  $query =  "INSERT INTO ".cms_db_prefix()."module_compdir_companies 
              (company_name,address,telephone,fax,contact_email,website,details,status,latitude,longitude,
               owner_id, create_date, modified_date)
             VALUES (?,?,?,?,?,?,?,?,?,?,?,$now,$now)";
  $dbr = $db->Execute($query,array($record['company_name'],$record['address'],
				   $record['telephone'],$record['fax'],
				   $record['contact_email'],$record['website'],
				   $record['details'],$record['status'],
				   $record['latitude'],$record['longitude'],
		                   $userid));
  if( !$dbr ) {
    _set_error($mod->Lang('error_insert_company'));
    return FALSE;
  }
  $company_id = $db->Insert_ID();
    
  // insert fieldvals
  if( count($fieldvals) )
    {

      foreach( $fieldvals as $name => $value )
	{
	  if( empty($value) ) continue;
	  $fielddef_id = _get_fielddef_id($name);
	  if( $fielddef_id === FALSE ) continue;
	  
	  $query = 'INSERT INTO '.cms_db_prefix()."module_compdir_fieldvals 
                     (company_id, fielddef_id, value, create_date, modified_date)
                    VALUES (?,?,?,$now,$now)";
	  $dbr = $db->Execute($query,array($company_id,$fielddef_id,$value));
	}
    }

  // insert categories
  if( count($categories) )
    {
      foreach($categories as $name => $value )
	{
	  if( $value == 0 ) continue;
	  $category_id = _get_category_id($name);
	  if( $category_id === FALSE ) continue;

	  $query = 'INSERT INTO '.cms_db_prefix()."module_compdir_company_categories
                     (company_id,category_id,create_date,modified_date)
                    VALUES (?,?,$now,$now)";
	  $db->Execute($query,array($company_id,$category_id));
	}
    }

  return TRUE;
}

function _smart_explode($str,$delim = ',',$safe_char = '"')
{
  $out = array();
  $col = '';
  $is_safe = 0;
  for( $i = 0; $i < strlen($str); $i++ )
    {
      switch($str[$i])
	{
	case $delim:
          if( !$is_safe )
	    {
	      $out[] = $col;
	      $col = '';
	    }
	  break;
	case $safe_char:
	  $is_safe = !$is_safe;
	  break;

	default:
	  $col .= $str[$i];
	  break;
	}
    }

  if( !empty($col) )
    $out[] = $col;

  return $out;
}



#
# Initialization
#
$delimeter = '';
$do_fielddefs = 0;
$do_fieldvals = 0;
$do_categorydefs = 0;
$do_categoryvals = 0;
$do_lookup = 0;
$check_duplicates = 1;

#
# Get Form Data
#
if( isset($params['cancel']) )
  {
    $this->CGRedirect($id,'defaultadmin',$returnid);
  }
if( isset($params['delimeter']) )
  {
    $delimeter = trim($params['delimeter']);
  }
if( isset($params['do_fielddefs']) )
  {
    $do_fielddefs = (int)trim($params['do_fielddefs']);
  }
if( isset($params['do_fieldvals']) )
  {
    $do_fieldvals = (int)trim($params['do_fieldvals']);
  }
if( isset($params['do_categorydefs']) )
  {
    $do_categorydefs = (int)trim($params['do_categorydefs']);
  }
if( isset($params['do_categoryvals']) )
  {
    $do_categoryvals = (int)trim($params['do_categoryvals']);
  }
if( isset($params['do_lookup']) )
  {
    $do_lookup = (int)trim($params['do_lookup']);
  }
if( isset($params['check_duplicates']) )
  {
    $check_duplicates = (int)trim($params['check_duplicates']);
  }

if( $delimeter == '' )
  {
    $this->SetError($this->Lang('error_missingparam'));
    $this->CGRedirect($id,'importcsv',$returnid);
  }
else if( !isset($_FILES[$id.'csvfile']) || $_FILES[$id.'csvfile']['size'] == 0 )
  {
    $this->SetError($this->Lang('error_missingupload'));
    $this->CGRedirect($id,'importcsv',$returnid);
  }
else if( $_FILES[$id.'csvfile']['error'] != 0 )
  {
    $this->SetError($this->Lang('error_badupload'));
    $this->CGRedirect($id,'importcsv',$returnid);
  }
$filename = $_FILES[$id.'csvfile']['tmp_name'];

#
# Now do the processing
#
$rules = array();
$errors = array();
$linenum = 0;
$num_companies = 0;
$num_categories = 0;
$num_fielddefs = 0;
$fh = fopen($filename,'r');
if( !$fh )
  {
    $this->SetError($this->Lang('error_badupload'));
    $this->CGRedirect($id,'importcsv',$returnid);
  }
while( !feof($fh) )
  {
    $line = fgets($fh);
    $linenum++;

    // strip off extra whitespace
    $line = trim($line);

    // skip empty lines
    if ($line == '') {
      continue;
    }

    //
    // handle definition lines
    //
    $fields = _smart_explode($line,$delimeter);
    if(startswith($fields[0],'#COMPANY'))
      {
	// company rule
	if( isset($rules['company']) )
	  {
	    // this is bad.
	    $errors[] = $this->Lang('error_import_duplicaterule','COMPANY',$linenum);
	    continue;
	  }
	$tmp = explode('=',$fields[0],2);
	$identifier = $tmp[1];

	$rules['company'] = array();
	$rules['company']['rule'] = $line;
	$rules['company']['identifier'] = $identifier;
	$rules['company']['flds'] = $fields;
	continue;
      }
    else if( startswith($fields[0],'#FIELDDEF') )
      {
	// fielddef rule
	if( isset($rules['fielddef']) )
	  {
	    // this is bad.
	    $errors[] = $this->Lang('error_import_duplicaterule','FIELDDEF',$linenum);
	    continue;
	  }

	$tmp = explode('=',$fields[0],2);
	$identifier = $tmp[1];

	$rules['fielddef'] = array();
	$rules['fielddef']['rule'] = $line;
	$rules['fielddef']['identifier'] = $identifier;
	$rules['fielddef']['flds'] = $fields;
	continue;
	// fielddef rule
      }
    else if( startswith($fields[0],'#CATEGORY') )
      {
	// category rule
	if( isset($rules['category']) )
	  {
	    // this is bad.
	    $errors[] = $this->Lang('error_import_duplicaterule','CATEGORY',$linenum);
	    continue;
	  }
	$tmp = explode('=',$fields[0],2);
	$identifier = $tmp[1];

	$rules['category'] = array();
	$rules['category']['rule'] = $line;
	$rules['category']['identifier'] = $identifier;
	$rules['category']['flds'] = $fields;
	continue;
	// category rule.
      }
    else if( startswith($line,'#') )
      {
	// don't know this one.
	$errors[] = $this->Lang('error_import_unknownrule',$linenum);
	continue;
      }

    //
    // do real importing
    //
    $rowtype = '';
    foreach( $rules as $name => $data )
      {
	if( $fields[0] == $rules[$name]['identifier'] )
	  {
	    $rowtype = $name;
	    break;
	  }
      }
    if( empty($rowtype) )
      {
	$errors[] = $this->Lang('error_import_unknownrow',$linenum,$fields[0]);
	continue;
      }

    $ret = '';
    switch( $rowtype )
      {
      case 'company':
	$ret = _process_company($this,$fields,$rules['company'],$delimeter,$do_fieldvals,$do_categoryvals,$do_lookup,$check_duplicates);
	if( $ret !== TRUE )
	  {
	    $errors[] = $this->Lang('error_prefix_msg',$linenum,_get_error());
	    continue;
	  }
	else
	  {
	    $num_companies++;
	  }
	break;

      case 'category':
	if( $do_categorydefs )
	  {
	    $ret = _process_category($this,$line,$rules['category'],$delimeter);
	    if( $ret !== TRUE )
	      {
		$errors[] = $this->Lang('error_prefix_msg',$linenum,_get_error());
		continue;
	      }
	    else
	      {
		$num_categories++;
	      }
	  }
	break;

      case 'fielddef':
	if( $do_fielddefs )
	  {
	    $ret = _process_fielddef($this,$line,$rules['fielddef'],$delimeter);
	    if( $ret !== TRUE )
	      {
		$errors[] = $this->Lang('error_prefix_msg',$linenum,_get_error());
		continue;
	      }
	    else
	      {
		$num_fielddefs++;
	      }
	  }
	break;

      default:
	$errors[] = $this->Lang('error_import_unknownrow',$linenum,$fields[0]);
	continue;
	break;
      }
  }

if( count($errors) )
  {
    $smarty->assign('errors',$errors);
  }
$smarty->assign('num_companies',$num_companies);
$smarty->assign('num_categories',$num_categories);
$smarty->assign('num_fielddefs',$num_fielddefs);
$smarty->assign('return_url',$this->CreateURL($id,'defaultadmin',$returnid));

echo $this->ProcessTemplate('do_importcsv.tpl');
#
# EOF
#
?>
