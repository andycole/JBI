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

if( !isset($gCms) ) return;

global $gCms;
$contentops =& $gCms->GetContentOperations();
$sortorder = $this->GetPreference('sortorder','asc');
$sortby = $this->GetPreference('sortby','company_name');

$smarty->assign('startform',
		$this->CreateFormStart($id,'admin_saveprefs',$returnid));
$smarty->assign('endform',
		$this->CreateFormEnd());
$smarty->assign('submit',
		$this->CreateInputSubmit($id,'submit',$this->Lang('submit')));

$smarty->assign('prompt_detailpage',$this->Lang('prompt_detailpage'));
$smarty->assign('input_detailpage',
		$contentops->CreateHierarchyDropdown('',$this->GetPreference('detailpage'),$id.'detailpage'));

$sortorders = array($this->Lang('ascending')=>'asc',
		    $this->Lang('descending')=>'desc');
$smarty->assign('prompt_summarysortorder',$this->Lang('prompt_summarysortorder'));
$smarty->assign('input_summarysortorder',
		$this->CreateInputDropdown($id,'sortorder',$sortorders,-1,$sortorder));

$sortings = array($this->Lang('companyname')=>'company_name',
		  $this->Lang('address')=>'address',
		  $this->Lang('telephone')=>'telephone',
		  $this->Lang('fax')=>'fax',
		  $this->Lang('contactemail')=>'contact_email',
		  $this->Lang('website')=>'website',
		  $this->Lang('createddate')=>'create_date',
		  $this->Lang('modifieddate')=>'modified_date',
		  $this->Lang('random')=>'random');
$smarty->assign('prompt_summarysorting',$this->Lang('prompt_summarysorting'));
$smarty->assign('input_summarysorting',
		$this->CreateInputDropdown($id,'sortby',$sortings,-1,$sortby));

$smarty->assign('input_collectstats',
		$this->CreateInputYesNoDropdown($id,'input_collectstats',
						$this->GetPreference('collectstats',0)));

echo $this->ProcessTemplate('prefs.tpl');

// EOF
?>