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

//
// functions
//
function _get_childnode(&$parent,$nodename)
{
  $children = $parent->childNodes;
  foreach( $children as $childnode )
    {
	if( $childnode->nodeName == $nodename )
	  {
	    return $childnode;
	  }
    }
  return NULL;
}


//
// initialize
//
$this->SetCurrentTab('companies');
$ignore_address = 0;
$do_convert_address = 0;
$status = 'draft';
$imported = 0;
$check_duplicate_name = 0;
$errors = array();
$can_do_lookups = 0;
$cggm = $this->GetModuleInstance('CGGoogleMaps');
if( is_object($cggm) )
  {
    $can_do_lookups = 1;
  }

//
// handle form data
//
if( isset($params['cancel']) )
{
  $this->RedirectToTab($id);
}
else if( isset($params['submit']) )
{
  if( isset($params['status']) )
    {
      $status = trim($params['status']);
    }
  if( isset($params['ignore_address']) )
    {
      $ignore_adderess = (int)$params['ignore_address'];
    }
  if( isset($params['do_convert_address']) )
    {
      $do_convert_address = (int)$params['do_convert_address'];
    }
  if( isset($params['check_duplicate_name']) )
    {
      $check_duplicate_name = (int)$params['check_duplicate_name'];
    }

  $name = $id.'kmlfile';
  if( !isset($_FILES) ||
    !isset($_FILES[$name]) || 
    $_FILES[$name]['error'] > 0 ||
    $_FILES[$name]['size'] == 0 )
  {
    //bad upload
    $this->SetError($this->Lang('error_upload'));
    $this->RedirectToTab();
  }

  $doc = new DomDocument();
  $doc->load($_FILES[$name]['tmp_name']);
  $places = $doc->getElementsByTagName('Placemark');
  if( $places->length == 0 ) 
    {
      $this->SetError($this->Lang('error_kml_noplacemarks'));
      $this->RedirectToTab();
    }

  for( $idx = 0; $idx < $places->length; $idx++ )
    {
      $node = $places->item($idx);
      if( !$node ) continue;

      $address = '';
      $name = '';
      $description = '';
      $latitude = '';
      $longitude = '';
      
      $name    = _get_childnode($node,'name')->nodeValue;
      $desc    = _get_childnode($node,'description')->nodeValue;

      // get the address.
      if( !$ignore_address )
	{
	  $_address_N = _get_childnode($node,'address');
	  if( !$_address_N )
	    {
	      $errors[] = $this->Lang('error_kmlimport_noaddress',$idx);
	      continue;
	    }

	  $address = $_address_N->nodeValue;
	  
	}

      // get the coordinates.
	{
	  $_point_N  = _get_childnode($node,'Point');
	  if( !$_point_N )
	    {
	      $errors[] = $this->Lang('error_kmlimport_nopoint',$idx);
	      continue;
	    }
	  $_coords_N  = _get_childnode($_point_N,'coordinates');
	  if( !$_coords_N )
	    {
	      $errors[] = $this->Lang('error_kmlimport_nopoint',$idx);
	      continue;
	    }
	  $coords = $_coords_N->nodeValue;
	  list($latitude,$longitude) = explode(',',$coords);
	}

      if( $address != '' && ($latitude == '' || $longitude == '') && $do_convert_address == 1 )
	{
	  $coords = $cggm->GetCoordsFromAddress($address);
	  $latitude = $coords['lat'];
	  $longitude = $coords['lon'];
	}

      // got enough information to add a node.
      if( $name != '' && ($address != '' || ($latitude != '' && $longitude != '')) )
	{
	  if( $check_duplicate_name )
	    {
	      $query = 'SELECT id FROM '.cms_db_prefix().'module_compdir_companies
                         WHERE company_name = ?';
	      $tmp = $db->GetOne($query,array($name));
	      if( $tmp )
		{
		  // it's a duplicate
		  // continue without error
		  continue;
		}
	    }

	  $query = 'INSERT INTO '.cms_db_prefix().'module_compdir_companies
                      (company_name, address, details, status, latitude, longitude)
                    VALUES (?,?,?,?,?,?)';
	  $dbr = $db->Execute($query,
			      array($name,$address,$description,$status,$latitude,$longitude));
	  if( !$dbr )
	    {
	      $errors[] = $this->Lang('error_kmlimport_dberror',$idx);
	      continue;
	    }
	  $imported++;
	}
    }

  // woot, done
  $smarty->assign('finished',1);
  $smarty->assign('imported',$imported);
  if( count($errors) )
    {
      $smarty->assign('errorcount',count($errors));
      $smarty->assign('errors',$errors);
    }
}

//
// build the form
//
$statuses = array($this->Lang('published')=>'published',
		  $this->Lang('draft')=>'draft',
		  $this->Lang('disabled')=>'disabled');
$smarty->assign('statustext',$this->Lang('status'));
$smarty->assign('inputstatus',
		$this->CreateInputDropdown($id,'status',
					   $statuses,-1,'draft'));
$smarty->assign('can_do_lookups',$can_do_lookups);
$smarty->assign('formstart',$this->CGCreateFormStart($id,'importkml','',array(),false,'post','multipart/form-data'));
$smarty->assign('formend',$this->CreateFormEnd());

echo $this->ProcessTemplate('importkml.tpl');

#
# EOF
#
?>