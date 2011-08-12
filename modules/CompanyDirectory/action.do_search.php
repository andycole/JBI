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

#
# Initialization
#
$country = 'US';
$postal = '';
$radius = '50';
$units  = 'miles';
$company_name = '';
$name_type = 'exact';
$use_categories = '';
$errors = array();
$base_lat = '';
$base_long = '';
$postcode =& $this->GetModuleInstance('Postcode');
$do_zip_search = 0;
$postal_data = '';
$bounding_box = '';
$sortorder = $this->GetPreference('sortorder','asc');
$sortby = $this->GetPreference('sortby','company_name');
$detailpage = $returnid;
$inline = 0;
$page = 1;
$pagelimit = 100000;
$count = 0;
$numpages = 0;
$summarytemplate = $this->GetPreference(COMPANYDIR_PREF_DFLTSUMMARY_TEMPLATE);
$urlfmt = 'companies/%d/'.($detailpage!=''?$detailpage:$returnid);
$entryarray = array();
$config =& $gCms->GetConfig();
$stored_categories = '';

#
# Setup
#
if( isset( $params['page'] ) )
  {
    $page = (int)$params['page'];
  }
if( isset( $params['pagelimit'] ) )
  {
    $pagelimit = (int)$params['pagelimit'];
  }
if( isset( $params['inline'] ) && $params['inline'] != 0 )
  {
    $inline = 1;
  }
if( isset( $params['detailpage'] ) )
  {
    $tmp = $this->resolve_alias_or_id($params['detailpage']);
    if( $tmp )
      {
	$detailpage = $tmp;
	$inline = 0;
      }
  }
if( isset( $params['sortorder'] ) )
  {
    switch( $params['sortorder'] )
      {
      case 'asc':
      case 'desc':
	$sortorder = $params['sortorder'];
      }
  }
if( isset( $params['sortby'] ) )
  {
    switch( $params['sortby'] )
      {
      case 'company_name':
	$sortby = 'company_name';
	break;
      case 'phone':
	$sortby = 'telephone';
	break;
      case 'fax':
	$sortby = 'fax';
	break;
      case 'email':
	$sortby = 'contact_email';
	break;
      case 'website':
	$sortby = 'website';
	break;
      case 'created':
	$sortby = 'create_date';
	break;
      case 'modified':
	$sortby = 'modified_date';
	break;
      case 'status':
	$sortby = 'status';
	break;
      case 'random':
	$sortby = 'RAND()';
	$sortorder = '';
	break;
      }
  }
if( $sortby == 'random' )
  {
    $sortby = 'RAND()';
    $sortorder = '';
  }
if( isset($params['summarytemplate'] ) )
  {
    $summarytemplate = $params['summarytemplate'];
  }
if( isset( $params['detailtemplate'] ) )
  {
	$urlfmt .= '/d,'.$params['detailtemplate'];
  }
if( isset($params['cd_stored_categories']) )
  {
    $stored_categories = explode(',',$params['cd_stored_categories']);
  }


#
# Handle form submission
#
if( isset($params['cd_cancel']) )
  {
    $destpage = $returnid;
    if( isset($params['cd_origpage']) )
      {
	$destpage = (int)$params['cd_origpage'];
      }
    $this->RedirectContent($destpage);
  }
else if( isset($params['cd_submit']) || isset($params['cd_dosearch']) )
  {
    //
    // get the data
    //
    if( $postcode )
      {
	if( isset($params['cd_country']) )
	  {
	    $country = trim($params['cd_country']);
	  }
	if( isset($params['cd_postal']) )
	  {
	    $postal = trim($params['cd_postal']);
	    $do_zip_search = 1;
	  }
	if( isset($params['cd_radius']) )
	  {
	    $radius = (int)$params['cd_radius'];
	  }
	if( isset($params['cd_units']) )
	  {
	    $units = strtolower(trim($params['cd_units']));
	  }
      }
    if( isset( $params['cd_inline'] ) && $params['cd_inline'] != 0 )
      {
	$inline = 1;
	$params['inline'] = $inline;
      }
    if( isset($params['cd_name']) )
      {
	$company_name = trim($params['cd_name']);
      }
    if( isset($params['cd_name_type']) )
      {
	$name_type = strtolower(trim($params['cd_name_type']));
      }
    if( isset($params['cd_use_categories']) && is_array(($params['cd_use_categories'])) && count($params['cd_use_categories']) > 0 )
      {
	$use_categories = $params['cd_use_categories'];
	$params['cd_stored_categories'] = implode(',',$use_categories);
	unset($params['cd_use_categories']);
      }
    else if (isset($params['cd_dosearch']))
      {
	// comping from a link
	$use_categories = $stored_categories;
      }
    if( isset($params['cd_submit']) )
      {
	unset($params['cd_submit']);
	$params['cd_dosearch'] = 1;
      }

    //
    // validate the data
    //
    if( $do_zip_search )
      {
	if( $country == '' )
	  {
	    $errors[] = $this->Lang('error_invalid_param','cd_country');
	  }
	if( $units != 'miles' && $units != 'km' )
	  {
	    // invalid units
	    $errors[] = $this->Lang('error_invalid_param','cd_units');
	  }
	if( $radius <= 0 )
	  {
	    // invalid units
	    $errors[] = $this->Lang('error_invalid_param','cd_radius');
	  }
      }
    if( $name_type != 'exact' && $name_type != 'like')
      {
	// invalid units
	$errors[] = $this->Lang('error_invalid_param','cd_name_type');
      }

    // convert distance to miles
    if( empty($errors) && $cd_units == 'km' )
      {
	$radius = (float)$radius * 0.621371192;
      }

    // if we can find the Postcode module now we can find a base latitude and longitude.
    if( empty($errors) && !empty($postal) && $postcode && $do_zip_search  )
      {
	$postal_data = $postcode->Lookup_Zip($country,$postal);
	if( !is_array($postal_data) )
	  {
	    // it didn't work
	    $errors[] = $this->Lang('error_postcode_lookup',$postal);
	  }
      }

    // if we have postal data, we can get a bounding box.
    if( empty($errors) && is_array($postal_data) )
      {
	$bounding_box = $this->GetBoundingBox($postal_data['latitude'],$postal_data['longitude'],$radius);
      }

    //
    // build the query
    //
    if( empty($errors) )
      {
	$qparms = array();
	$where = array();
	$query = 'SELECT c.* FROM '.cms_db_prefix().'module_compdir_companies c';
	$query2 = 'SELECT count(*) AS count FROM '.cms_db_prefix().'module_compdir_companies c';

	$where[] = '(status = ?)';
	$qparms[] = 'published';
	if( is_array($bounding_box) )
	  {
	    $where[] = '(c.latitude BETWEEN ? AND ?) AND (c.longitude BETWEEN ? AND ?)';
	    $qparms[] = $bounding_box[0];
	    $qparms[] = $bounding_box[1];
	    $qparms[] = $bounding_box[2];
	    $qparms[] = $bounding_box[3];
	  }
	if( !empty($company_name) )
	  {
	    switch( $name_type )
	      {
	      case 'exact':
		$where[] = '(c.company_name = ?)';
		$qparms[] = $company_name;
		break;
	      case 'like':
		$qparms[] = '%'.$company_name.'%';
		$where[] = '(c.company_name LIKE ?)';
	      }
	  }
	if( is_array($use_categories) && count($use_categories) )
	  {
	    $str = " INNER JOIN ".cms_db_prefix()."module_compdir_company_categories cc ON cc.company_id = c.id";
	    $query .= $str;
	    $query2 .= $str;
	    $where[] = 'cc.category_id IN ('.implode(',',$use_categories).')';
	  }

	//
	// assembly
	//
	if( count($where) )
	  {
	    $query = $query . ' WHERE ' . implode(' AND ',$where );
	    $query2 = $query2 . ' WHERE ' . implode(' AND ',$where );
	  }
	$query .= ' ORDER BY '.$sortby.' '.$sortorder;

	//
	// more setup
	//
	$startelement = ($page-1)*$pagelimit;

	//
	// Execution
	//
	$count = $db->GetOne($query2,$qparms);
	if( !$count ) return;

	$dbr = $db->SelectLimit($query,$pagelimit,$startelement,$qparms);
	if( !$dbr )
	  {
	    echo 'FATAL ERROR<br/>';
	    echo $db->ErrorMsg().'<br/>';
	    echo $db->sql;
	    return;
	  }

	// determine number of pages
	$numpages = (int)($count / $pagelimit);
	if( $count % $pagelimit != 0 ) $numpages++;

	//
	// now build the object list.
	//
	$idlist = array();
	while( $dbr && $row = $dbr->FetchRow() )
	  {
	    $idlist[] = $row['id'];
	    $prettyurl = sprintf($urlfmt,$row['id']);

	    $onerow = new stdClass;
	    foreach( $row as $key => $value )
	      {
		$onerow->$key = $value;
	      }
	    $onerow->detail_url = $this->CreateLink($id,'details',($detailpage!=''?$detailpage:$returnid),'',
						    $params,
						    '',true,$inline,'',false,$prettyurl);

	    $onerow->company_name_link = $this->CreateLink($id, 'details', $returnid, 
							   $row['company_name'], 
							   $params);
	    $onerow->picture_path = $config['root_url'].'/uploads/companydirectory/id'.$row['id'].'/'.$row['picture_location'];
	    $onerow->logo_path = $config['root_url'] . '/uploads/companydirectory/id'.$row['id'].'/'.$row['logo_location'];

	    // get the custom fields
	    $fielddefs = $this->GetFieldDefsForCompany($row['id']);
	    $fieldarray = array();
	    $onerow->customfieldscount = count($fielddefs);
	    $onerow->customfieldsbyname = array();
	    if ($onerow->customfieldscount > 0)
	      {
		foreach ($fielddefs as $fielddef)
		  {
		    $field = new stdClass();
		    $field->id = $fielddef->id;
		    $field->name = $fielddef->name;
		    $field->value = $fielddef->value;
		    $fieldarray[$field->id] = $field;
		    $onerow->customfieldsbyname[$fielddef->name] = $fielddef->value;
		  }
		$onerow->customfields = $fieldarray;
	      }

	    $entryarray[] = $onerow;
	  } // while

	// update search stats
	if( count($idlist) && $this->GetPreference('collectstats',0) )
	  {
	    $now = $db->DbTimeStamp(time());
	    $query = 'INSERT INTO '.cms_db_prefix()."module_compdir_searchstats
                        (company_id,date_searched,postcode) VALUES (?,$now,?)";
	    foreach( $idlist as $one )
	      {
		$db->Execute($query,array($one,$postal));
	      }
	  }
	
      } // no errors
  } // submit

#
# Give Everything to Smarty
#
if( count($errors) )
  {
    $smarty->assign('errors',$errors);
  }
if( count($entryarray) )
  {
    $smarty->assign('items',$entryarray);
  }
else
  {
    $smarty->assign('message',$this->Lang('error_noresultsfound'));
  }
if( is_array($postal_data) )
  {
    $smarty->assign('postal_data',$postal_data);
  }
$smarty->assign('itemcount',count($entryarray));
$smarty->assign('itemcount', count($entryarray));
$smarty->assign('pagetext',$this->Lang('page'));
$smarty->assign('oftext',$this->Lang('of'));
$smarty->assign('pagecount',$numpages);
$smarty->assign('curpage',$page);
if( $numpages )
  {
    if( $page == 1)
      {
	$smarty->assign('firstlink',$this->Lang('firstpage'));
	$smarty->assign('prevlink',$this->Lang('prevpage'));
      }
    else
      {
	$parms = $params;
	$parms['page'] = 1;
	$smarty->assign('firstlink',$this->CreateLink($id,'default',$returnid,
						      $this->Lang('firstpage'),
						      $parms));
	$parms['page'] = $page - 1;
	$smarty->assign('prevlink',$this->CreateLink($id,'default',$returnid,
						     $this->Lang('prevpage'),
						     $parms));
      }
    if( $page == $numpages )
      {
	$smarty->assign('lastlink',$this->Lang('lastpage'));
	$smarty->assign('nextlink',$this->Lang('nextpage'));
      }
    else
      {
	$parms = $params;
	$parms['page'] = $numpages;
	$smarty->assign('lastlink',$this->CreateLink($id,'default',$returnid,
						     $this->Lang('lastpage'),
						     $parms));
	$parms['page'] = $page + 1;
	$smarty->assign('nextlink',$this->CreateLink($id,'default',$returnid,
						     $this->Lang('nextpage'),
						     $parms));
      }
  }

echo $this->ProcessTemplateFromDatabase('summary_'.$summarytemplate);

#
# EOF
# 
?>