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

$catid = '';
if (isset($params['catid']))
{
	$catid = $params['catid'];
}

$name = '';
if (isset($params['name']))
{
	$name = $params['name'];
}

$origname = '';
if (isset($params['origname']))
{
	$origname = $params['origname'];
}

if (isset($params['submit']))
{
	if ($name != '')
	{
		$query = 'UPDATE '.cms_db_prefix().'module_compdir_categories SET name = ?, modified_date = '.$db->DBTimeStamp(time()).' WHERE id = ?';
		$db->Execute($query, array($name, $catid));
						
		$params = array('tab_message'=> 'categoryupdated', 'active_tab' => 'categories');
		$this->Redirect($id, 'defaultadmin', $returnid, $params);			
	}
	else
	{
		echo $this->ShowErrors($this->Lang('nonamegiven'));
	}
}
else
{
	$query = 'SELECT * FROM '.cms_db_prefix().'module_compdir_categories WHERE id = ?';
	$row = $db->GetRow($query, array($catid));

	if ($row)
	{
		$name = $row['name'];
		$origname = $row['name'];
	}
}

#Display template
$this->smarty->assign('startform', $this->CreateFormStart($id, 'editcategory', $returnid));
$this->smarty->assign('endform', $this->CreateFormEnd());
$this->smarty->assign('nametext', $this->Lang('name'));
$this->smarty->assign('inputname', $this->CreateInputText($id, 'name', $name, 20, 255));
$this->smarty->assign('hidden', 
		      $this->CreateInputHidden($id, 'catid', $catid).
		      $this->CreateInputHidden($id, 'origname', $origname));
$this->smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', lang('submit')));
$this->smarty->assign('cancel', $this->CreateInputSubmit($id, 'cancel', lang('cancel')));

echo $this->ProcessTemplate('editcategory.tpl');
?>
