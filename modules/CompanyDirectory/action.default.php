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

$inline = false;
$detailpage = '';
if( isset($params['inline']) && $params['inline'] != 0 )
  {
    $inline = true;
  }
if (isset($params['detailpage']))
  {
    $manager =& $gCms->GetHierarchyManager();
    $node =& $manager->sureGetNodeByAlias($params['detailpage']);
    if (isset($node))
      {
		$content =& $node->GetContent();	
		if (isset($content))
		  {
			$detailpage = $content->Id();
		  }
      }
    else
      {
		$node =& $manager->sureGetNodeById($params['detailpage']);
		if (isset($node))
		  {
			$detailpage = $params['detailpage'];
		  }
      }
    if( $detailpage != '' )
      {
	$params['cd_origpage'] = $returnid;
	$inline = false;
      }
  }

$thetemplate = 'summary_'.$this->GetPreference(COMPANYDIR_PREF_DFLTSUMMARY_TEMPLATE);
if( isset($params['summarytemplate'] ) )
  {
    $thetemplate = 'summary_'.$params['summarytemplate'];
  }


$sortorder = $this->GetPreference('sortorder','asc');
if( isset( $params['sortorder'] ) )
  {
	switch( $params['sortorder'] )
	  {
	  case 'asc':
	  case 'desc':
		$sortorder = $params['sortorder'];
	  }
  }

$sortby = $this->GetPreference('sortby','company_name');
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

$limit = 100000;
if( isset($params['pagelimit']) )
  {
    $limit = (int)$params['pagelimit'];
  }

$page = 1;
if( isset($params['page']) )
  {
    $page = (int)$params['page'];
    if( $page < 1 ) $page = 1;
  }
$startelement = ($page-1)*$limit;

$category = '';
$inputcat = '';
if( isset( $params['category'] ) )
  {
    $category = trim($params['category']);
  }
else
  {
    if (isset($params['categoryid']))
      {
	$categoryid = $params['categoryid'];
      }
  }

//
// Build the pretty urls
//
$urlfmt = 'companies/%d/'.($detailpage!=''?$detailpage:$returnid);
if( isset( $params['detailtemplate'] ) )
  {
	$urlfmt .= '/d,'.$params['detailtemplate'];
  }



//
// Build the queries
//
$entryarray = array();
$paramarray = array();
$where = array();
$query = "SELECT c.* FROM ".cms_db_prefix()."module_compdir_companies c";
$query2 = "SELECT count(*) as count FROM ".cms_db_prefix()."module_compdir_companies c";
$where[] = 'c.status = \'published\'';
if ( isset($categoryid) && $categoryid != '')
{
  $str = " INNER JOIN ".cms_db_prefix()."module_compdir_company_categories cc ON cc.company_id = c.id";
  $query .= $str;
  $query2 .= $str;
  $where[] = 'cc.category_id = ?';
  $paramarray[] = $categoryid;
}
else if( isset($category) && $category != '' )
{
  $str = " INNER JOIN ".cms_db_prefix()."module_compdir_company_categories cc ON cc.company_id = c.id";
  $query .= $str;
  $query2 .= $str;
  $str = " INNER JOIN ".cms_db_prefix()."module_compdir_categories cs ON cs.id = cc.category_id";
  $query .= $str;
  $query2 .= $str;

  $arr1 = explode(',',$category);
  $arr2 = array();
  foreach( $arr1 as $xx )
	{
	  $arr2[] = "'".$xx."'";
	}
  $txt = implode(',',$arr2);
  $where[] = 'cs.name IN ('.$txt.')';
}
$query = $query . ' WHERE ' . implode(' AND ',$where );
$query2 = $query2 . ' WHERE ' . implode(' AND ',$where );
$query .= " ORDER BY ".$sortby." ".$sortorder;

// Execute the Queries
$count = $db->GetOne($query2,$paramarray);
if( !$count ) return;
$dbresult = $db->SelectLimit($query, $limit, $startelement, $paramarray);
if( !$dbresult )
  {
    echo 'FATAL ERROR<br/>';
    echo $db->ErrorMsg().'<br/>';
    echo $db->sql;
    return;
  }

// Determine the number of pages
$npages = intval($count / $limit);
if( $count % $limit != 0 ) $npages++;

// build the object list
global $gCms;
$config =& $gCms->GetConfig();

$idlist = array();
while ($dbresult && ($row = $dbresult->FetchRow()))
{
  if( in_array($row['id'],$idlist) ) continue;

  $prettyurl = sprintf($urlfmt,$row['id']);

  $onerow = new stdClass();
  
  $onerow->id = $row['id'];
  $onerow->company_name = $row['company_name'];

  $params['companyid'] = $row['id'];

  $onerow->detail_url = $this->CreateLink($id,'details',($detailpage!=''?$detailpage:$returnid),'',
					  $params,
					  '',true,$inline,'',false,$prettyurl);

  $onerow->company_name_link = $this->CreateLink($id, 'details', $returnid, 
						 $row['company_name'], 
						 $params);
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
		$field->type = $fielddef->type;
		$field->id = $fielddef->id;
		$field->name = $fielddef->name;
		$field->value = $fielddef->value;
		$fieldarray[$field->id] = $field;
		$onerow->customfieldsbyname[$fielddef->name] = $fielddef->value;
	    }
	    $onerow->customfields = $fieldarray;
	}

  $idlist[] = $row['id'];
  $entryarray[] = $onerow;
}

$smarty->assign('items', $entryarray);
$smarty->assign('itemcount', count($entryarray));
$smarty->assign('pagetext',$this->Lang('page'));
$smarty->assign('oftext',$this->Lang('of'));
$smarty->assign('pagecount',$npages);
$smarty->assign('curpage',$page);
if( $page == 1 )
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
if( $page == $npages )
  {
    $smarty->assign('lastlink',$this->Lang('lastpage'));
    $smarty->assign('nextlink',$this->Lang('nextpage'));
  }
else
  {
    $parms = $params;
    $parms['page'] = $npages;
    $smarty->assign('lastlink',$this->CreateLink($id,'default',$returnid,
						  $this->Lang('lastpage'),
						  $parms));
    $parms['page'] = $page + 1;
    $smarty->assign('nextlink',$this->CreateLink($id,'default',$returnid,
						  $this->Lang('nextpage'),
						  $parms));
  }

if( isset( $params['selectcategory'] ) )
  {
	$query = "SELECT id, name FROM ".cms_db_prefix()."module_compdir_categories ORDER BY name ASC";
	$dbresult = $db->Execute($query);
	$catarray = array($this->Lang('selectone') => '');
	while ($dbresult && $row = $dbresult->FetchRow())
	  {
		$catarray[$row['name']] = $row['id'];
	  }
	$smarty->assign('catformstart', $this->CreateFrontendFormStart($id, $returnid));
	$smarty->assign('catdropdown', $this->CreateInputDropdown($id, 'categoryid', $catarray, -1, $categoryid, ''));
	$smarty->assign('catbutton', $this->CreateInputSubmit($id, 'inputsubmit', $this->Lang('submit')));
	$smarty->assign('catformend', $this->CreateFormEnd());
  }


echo $this->ProcessTemplateFromDatabase($thetemplate);


?>
