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

$thetemplate = 'categorylist_'.$this->GetPreference(COMPANYDIR_PREF_DFLTCATEGORYLIST_TEMPLATE);
if( isset($params['categorylisttemplate'] ) )
  {
    $thetemplate = 'categorylist_'.$params['categorylisttemplate'];
  }

// $detailpage = '';
// if (isset($params['detailpage']))
//   {
//     $manager =& $gCms->GetHierarchyManager();
//     $node =& $manager->sureGetNodeByAlias($params['detailpage']);
//     if (isset($node))
//       {
// 		$content =& $node->GetContent();	
// 		if (isset($content))
// 		  {
// 			$detailpage = $content->Id();
// 		  }
//       }
//     else
//       {
// 		$node =& $manager->sureGetNodeById($params['detailpage']);
// 		if (isset($node))
// 		  {
// 			$detailpage = $params['detailpage'];
// 		  }
//       }
//   }

$query = '';
if( isset($params['showall']) )
  {
//     $query = 'SELECT a.*,count(b.company_id) as count 
//               FROM '.cms_db_prefix().'module_compdir_categories a 
//               LEFT OUTER JOIN '.cms_db_prefix().'module_compdir_company_categories b 
//               ON a.id = b.category_id 
//               GROUP BY b.category_id 
//               ORDER BY a.name';
    $query = 'SELECT a.*, bb.count 
              FROM '.cms_db_prefix().'module_compdir_categories a 
              LEFT OUTER JOIN 
               (SELECT a.category_id,count(b.id) AS count 
                FROM '.cms_db_prefix().'module_compdir_company_categories a 
                LEFT OUTER JOIN '.cms_db_prefix().'module_compdir_companies b ON a.company_id = b.id 
                 WHERE b.status = \'published\' 
                GROUP by a.category_id) bb 
              ON a.id = bb.category_id';
  }
else
  {
    $query = "SELECT b.*,count(company_id) AS count 
              FROM ".cms_db_prefix()."module_compdir_company_categories a, 
                    ".cms_db_prefix()."module_compdir_categories b
              WHERE b.id = a.category_id 
              GROUP BY b.id
              ORDER BY b.name";
  }
$dbresult = $db->Execute( $query );

$results = array();
$urlfmt = "companies/bycategory/%d/".($detailpage!=''?$detailpage:$returnid);
// if( isset( $params['detailtemplate'] ) )
//   {
//     $urlfmt .= '/d,'.$params['detailtemplate'];
//   }

while( $dbresult && $row = $dbresult->FetchRow() )
  {
    $obj = new StdClass();
    foreach( $row as $k => $v )
      {
	$obj->$k = $v;
      }
    if( is_null($obj->count) ) $obj->count = 0;
    $prettyurl = sprintf($urlfmt,$row['id']);
    $params['categoryid']=$row['id'];
    $obj->summary_url = $this->CreateLink($id,'default',($detailpage!=''?$detailpage:$returnid),
					  '',$params,
					  '',true,true,'',true,$prettyurl);
    $results[] = $obj;
  }

$smarty->assign('categorylist',$results);
$dbresult->Close();

echo $this->ProcessTemplateFromDatabase($thetemplate);
// EOF
?>
