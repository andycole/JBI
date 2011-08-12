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
$this->SetCurrentTab('fielddefs');

if (!$this->CheckPermission('Modify Company Directory'))
{
	echo $this->ShowErrors($this->Lang('needpermission', array('Modify Company Directory')));
	return;
}

if (isset($params['cancel']))
{
  $this->RedirectToTab($id);
}

$name = '';
if (isset($params['name']))
{
	$name = $params['name'];
}

$type = '';
if (isset($params['type']))
{
	$type = $params['type'];
}

$max_length = 255;
if (isset($params['max_length']))
{
  $max_length = (int)$params['max_length'];
}

$adminonly = 0;
if( isset($params['adminonly']) )
  {
    $adminonly = (int)$params['adminonly'];
  }
$public = 0;
if( isset($params['public']) )
  {
    $public = (int)$params['public'];
  }

$dropdown_data = '';
if( $type == 'dropdown' && isset($params['dropdown_options']) )
  {
    $dropdown_data = trim($params['dropdown_options']);
  }

$userid = get_userid();

$status = '';
if (isset($params['submit']))
{
  if( empty($name) )
    {
      $status = $this->Lang('nonamgiven');
    }
  
  if( empty($status) && $type == 'textbox' && !is_numeric($max_length) )
    {
      $status = $this->Lang('error_nolength');
    }

  if( empty($status) && $type == 'dropdown' && empty($dropdown_data) )
    {
      $status = $this->Lang('error_nodropdownoptions');
    }

  if( empty($status) )
    {
      $max = $db->GetOne('SELECT max(item_order) + 1 FROM ' . cms_db_prefix() . 'module_compdir_fielddefs');
      $query = 'INSERT INTO '.cms_db_prefix().'module_compdir_fielddefs 
                                    (name, type, max_length, item_order, create_date, modified_date, 
                                     admin_only, public, dropdown_data) 
                                  VALUES (?,?,?,?,?,?,?,?,?)';
      $parms = array($name, $type, $max_length, 
		     $max, 
		     trim($db->DBTimeStamp(time()), "'"), 
		     trim($db->DBTimeStamp(time()), "'"),
		     $adminonly, $public,
		     $dropdown_data);
      $db->Execute($query, $parms );

      $this->SetMessage($this->Lang('fielddefadded'));
      $this->RedirectToTab($id);
    }

  echo $this->ShowErrors($status);
}

#Display template
$this->smarty->assign('startform', $this->CreateFormStart($id, 'addfielddef', $returnid));
$this->smarty->assign('endform', $this->CreateFormEnd());
$this->smarty->assign('nametext', $this->Lang('name'));
$this->smarty->assign('typetext', $this->Lang('type'));
$this->smarty->assign('maxlengthtext', $this->Lang('maxlength'));
$this->smarty->assign('inputname', $this->CreateInputText($id, 'name', $name, 30, 255));
$smarty->assign('fieldtypes',$this->GetFieldTypes());
$this->smarty->assign('inputmaxlength', $this->CreateInputText($id, 'max_length', $max_length, 30, 255));
$smarty->assign('useredittext',$this->Lang('admin_only'));
$smarty->assign('userviewtext',$this->Lang('public'));
$smarty->assign('input_useredit',
		$this->CreateInputCheckbox($id, 'adminonly', 1, $adminonly));
$smarty->assign('input_userview',
		$this->CreateInputcheckbox($id, 'public', 1, $public));
$smarty->assign('fldtype',$type);
$smarty->assign('dropdown_data',$dropdown_data);

$this->smarty->assign('hidden', '');
$this->smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', lang('submit')));
$this->smarty->assign('cancel', $this->CreateInputSubmit($id, 'cancel', lang('cancel')));

echo $this->ProcessTemplate('editfielddef.tpl');

?>