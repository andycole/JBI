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

$tab = '';
if (isset($params['active_tab']))
{
	$tab = $params['active_tab'];
	$this->SetCurrentTab($tab);
}

#The tabs
echo $this->StartTabHeaders();

if ($this->CheckPermission('Modify Company Directory'))
{
  echo $this->SetTabHeader('companies',$this->Lang('companies'));
  if( $this->GetPreference('collectstats',0) )
    {
      echo $this->SetTabHeader('searches',$this->Lang('searches'));
    }
  echo $this->SetTabHeader('fielddefs',$this->Lang('fielddefs'));
  echo $this->SetTabHeader('categories',$this->Lang('categories'));
}

if ($this->CheckPermission('Modify Templates'))
{
  echo $this->SetTabHeader('summary_template',$this->Lang('summarytemplates'));
  echo $this->SetTabHeader('detail_template',$this->Lang('detailtemplates'));
  echo $this->SetTabHeader('categorylist_template',$this->Lang('categorylisttemplates'));
  echo $this->SetTabHeader('searchform_template',$this->Lang('searchformtemplates'));
  echo $this->SetTabHeader('frontendform_template',$this->Lang('frontendformtemplates'));
  echo $this->SetTabHeader('default_templates',$this->Lang('defaulttemplates'));
}

if ($this->CheckPermission('Modify Site Preferences'))
  {
    echo $this->SetTabHeader('prefs',$this->Lang('preferences'));
  }
echo $this->EndTabHeaders();

#The content of the tabs
echo $this->StartTabContent();
if ($this->CheckPermission('Modify Company Directory'))
{	
	
	echo $this->StartTab('companies', $params);
	include(dirname(__FILE__).'/function.admin_companiestab.php');
	echo $this->EndTab();
	
	if( $this->GetPreference('collectstats',0) )
	  {
	    echo $this->StartTab('searches', $params);
	    include(dirname(__FILE__).'/function.admin_searchestab.php');
	    echo $this->EndTab();
	  }
	
	echo $this->StartTab('fielddefs', $params);
	include(dirname(__FILE__).'/function.admin_fielddefstab.php');
	echo $this->EndTab();
	
		
	echo $this->StartTab('categories', $params);
	
	#Put together a list of current categories...
	$entryarray = array();
	
	$query = "SELECT * FROM ".cms_db_prefix()."module_compdir_categories ORDER BY name";
	$dbresult = $db->Execute($query);
	
	$rowclass = 'row1';
	
	while ($dbresult && $row = $dbresult->FetchRow())
	{
		$onerow = new stdClass();
	
		$onerow->id = $row['id'];
		$onerow->name = $this->CreateLink($id, 'editcategory', $returnid, $row['name'], array('catid'=>$row['id']));
	
		$onerow->editlink = $this->CreateLink($id, 'editcategory', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/edit.gif', $this->Lang('edit'),'','','systemicon'), array('catid'=>$row['id']));

		$onerow->deletelink = $this->CreateLink($id, 'deletecategory', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/delete.gif', $this->Lang('delete'),'','','systemicon'), array('catid'=>$row['id']), $this->Lang('areyousure'));
	
		$onerow->rowclass = $rowclass;

		$entryarray[] = $onerow;
	
		($rowclass=="row1"?$rowclass="row2":$rowclass="row1");
	}
	
	$this->smarty->assign_by_ref('items', $entryarray);
	$this->smarty->assign('itemcount', count($entryarray));
	
	#Setup links
	$this->smarty->assign('addlink', $this->CreateLink($id, 'addcategory', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/newfolder.gif', $this->Lang('addcategory'),'','','systemicon'), array(), '', false, false, '') .' '. $this->CreateLink($id, 'addcategory', $returnid, $this->Lang('addcategory'), array(), '', false, false, 'class="pageoptions"'));
	
	$this->smarty->assign('categorytext', $this->Lang('category'));
	
	#Display template
	echo $this->ProcessTemplate('categorylist.tpl');
	
	echo $this->EndTab();
}

if( $this->CheckPermission( 'Modify Templates' ) )
  {
    include(dirname(__FILE__).'/function.admin_templatestabs.php');
  }

if( $this->CheckPermission('Modify Site Preferences') )
  {
	echo $this->StartTab('prefs',$params);
	include(dirname(__FILE__).'/function.admin_prefstab.php');
	echo $this->EndTab();
  }

echo $this->EndTabContent();

# vim:ts=4 sw=4 noet
?>
