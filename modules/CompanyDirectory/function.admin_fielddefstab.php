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
	
$max = $db->GetOne("SELECT max(item_order) as max_item_order FROM ".cms_db_prefix()."module_compdir_fielddefs");
	
$query = "SELECT * FROM ".cms_db_prefix()."module_compdir_fielddefs ORDER BY item_order";
$dbresult = $db->Execute($query);
	
$rowclass = 'row1';
	
while ($dbresult && $row = $dbresult->FetchRow())
  {
    $onerow = new stdClass();
		
    $onerow->id = $row['id'];
    $onerow->name = $this->CreateLink($id, 'editfielddef', $returnid, $row['name'], array('fdid'=>$row['id']));
    $onerow->type = $row['type'];
    $onerow->max_length = $row['max_length'];
    $onerow->item_order = $row['item_order'];
		
    if ($onerow->item_order > 0)
      {
	$onerow->uplink = $this->CreateLink($id, 'movefielddef', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/arrow-u.gif', $this->Lang('up'),'','','systemicon'), array('fdid'=>$row['id'], 'dir'=>'up'));
      }
    else
      {
	$onerow->uplink = '';
      }
    if ($max > $onerow->item_order)
      {
	$onerow->downlink = $this->CreateLink($id, 'movefielddef', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/arrow-d.gif', $this->Lang('down'),'','','systemicon'), array('fdid'=>$row['id'], 'dir'=>'down'));
      }
    else
      {
	$onerow->downlink = '';
      }
	
    $onerow->editlink = $this->CreateLink($id, 'editfielddef', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/edit.gif', $this->Lang('edit'),'','','systemicon'), array('fdid'=>$row['id']));

    $onerow->deletelink = $this->CreateLink($id, 'deletefielddef', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/delete.gif', $this->Lang('delete'),'','','systemicon'), array('fdid'=>$row['id']), $this->Lang('areyousure'));
		
    $entryarray[] = $onerow;

    ($rowclass=="row1"?$rowclass="row2":$rowclass="row1");
  }

$smarty->assign_by_ref('items', $entryarray);
$smarty->assign('itemcount', count($entryarray));
	
$smarty->assign('addlink', $this->CreateLink($id, 'addfielddef', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/newfolder.gif', $this->Lang('addfielddef'),'','','systemicon'), array(), '', false, false, '') .' '. $this->CreateLink($id, 'addfielddef', $returnid, $this->Lang('addfielddef'), array(), '', false, false, 'class="pageoptions"'));
	
$smarty->assign('fielddeftext', $this->Lang('fielddef'));
$smarty->assign('typetext', $this->Lang('type'));
	
#Display template
echo $this->ProcessTemplate('fielddeflist.tpl');
	

#
# EOF
#
?>