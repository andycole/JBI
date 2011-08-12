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

$name = '';
if (isset($params['name']))
{
	$name = $params['name'];
}

$userid = get_userid();

if (isset($params['submit']))
{
	if ($name != '')
	{
		$query = 'INSERT INTO '.cms_db_prefix().'module_compdir_categories (name, create_date, modified_date) VALUES (?,?,?)';
		$db->Execute($query, array($name, trim($db->DBTimeStamp(time()), "'"), trim($db->DBTimeStamp(time()), "'")));

		$params = array('tab_message'=> 'categoryadded', 'active_tab' => 'categories');
		$this->Redirect($id, 'defaultadmin', $returnid, $params);
	}
	else
	{
		echo $this->ShowErrors($this->Lang('nonamegiven'));
	}
}

#Display template
$this->smarty->assign('startform', $this->CreateFormStart($id, 'addcategory', $returnid));
$this->smarty->assign('endform', $this->CreateFormEnd());
$this->smarty->assign('nametext', $this->Lang('name'));
$this->smarty->assign('inputname', $this->CreateInputText($id, 'name', $name, 30, 255));
$this->smarty->assign('hidden', '');
$this->smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', lang('submit')));
$this->smarty->assign('cancel', $this->CreateInputSubmit($id, 'cancel', lang('cancel')));
$cggm =& $this->GetModuleInstance('CGGoogleMaps');
if( $cggm )
  {
    if( method_exists($cggm,'GetCoordsFromAddress') )
      {
	$smarty->assign('can_geocode',1);
      }
  }

echo $this->ProcessTemplate('editcategory.tpl');

?>