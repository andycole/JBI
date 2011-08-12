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

$entryarray = array();

$query = "SELECT * FROM ".cms_db_prefix()."module_compdir_companies ORDER BY company_name";
$dbresult = $db->Execute($query);

$rowclass = 'row1';

while ($dbresult && $row = $dbresult->FetchRow())
  {
    $onerow = new stdClass();
    
    $onerow->id = $row['id'];
    $onerow->company_name = $this->CreateLink($id, 'editcompany', $returnid, $row['company_name'], array('compid'=>$row['id']));
    $onerow->address = $row['address'];
    $onerow->telephone = $row['telephone'];
    $onerow->fax = $row['fax'];
    $onerow->contact_email = $row['contact_email'];
    $onerow->website = $row['website'];
    $onerow->details = $row['details'];
    $onerow->picture_location = $row['picture_location'];
    
    $onerow->editlink = $this->CreateLink($id, 'editcompany', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/edit.gif', $this->Lang('edit'),'','','systemicon'), array('compid'=>$row['id']));
    
    $onerow->deletelink = $this->CreateLink($id, 'deletecompany', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/delete.gif', $this->Lang('delete'),'','','systemicon'), array('compid'=>$row['id']), $this->Lang('areyousure'));
    
    $entryarray[] = $onerow;
    
    ($rowclass=="row1"?$rowclass="row2":$rowclass="row1");
  }

$smarty->assign_by_ref('items', $entryarray);
$smarty->assign('itemcount', count($entryarray));
$smarty->assign('addlink', $this->CreateLink($id, 'addcompany', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/newfolder.gif', $this->Lang('addcompany'),'','','systemicon'), array(), '', false, false, '') .' '. $this->CreateLink($id, 'addcompany', $returnid, $this->Lang('addcompany'), array(), '', false, false, 'class="pageoptions"'));
if( count($entryarray) )
  {
    $smarty->assign('exportcsv', $this->CreateImageLink($id,'exportcsv',$returnid,$this->Lang('exportcsv'),'icons/system/export.gif',array(),'','',false));
  }
$smarty->assign('importcsv', $this->CreateImageLink($id,'importcsv',$returnid,$this->Lang('importcsv'),'icons/system/import.gif',array(),'','',false));
$smarty->assign('importkml', $this->CreateImageLink($id,'importkml',$returnid,$this->Lang('importkml'),'icons/system/import.gif',array(),'','',false));
$smarty->assign('idtext',$this->Lang('id'));
$smarty->assign('companytext', $this->Lang('company'));
$smarty->assign('websitetext', $this->Lang('website'));

#Display template
echo $this->ProcessTemplate('companylist.tpl');

#
# EOF
#
?>