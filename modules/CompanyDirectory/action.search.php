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
$inline = 0;
$resultpage = $returnid;
$thetemplate = $this->GetPreference(COMPANYDIR_PREF_DFLTSEARCHFORM_TEMPLATE);

#
# Get parameters
#
if( isset($params['inline']) && $params['inline'] != 0 )
  {
    $inline = 1;
    unset($params['inline']);
  }
if( isset($params['resultpage']) )
  {
    $tmp = $this->resolve_alias_or_id($params['resultpage']);
    if( $tmp )
      {
	$resultpage = $tmp;
	$inline = 0;
      }
    unset($params['resultpage']);
  }
if( isset($params['searchformtemplate']) )
  {
    $thetemplate = trim($params['searchformtemplate']);
    unset($params['searchformtemplate']);
  }

#
# Give everything to smarty
#
$tmp = $this->GetCategories();
if( is_array($tmp) )
  {
    $categories = array();
    foreach( $tmp as $one )
      {
	$categories[$one->id] = $one->name;
      }
    $smarty->assign('categories',$categories);
  }
$params['cd_origpage'] = $returnid;
$smarty->assign('formstart',
		$this->CGCreateFormStart($id,'do_search',$resultpage,$params,$inline));
$smarty->assign('formend',$this->CreateFormEnd());
$smarty->assign('input_country',$this->CreateInputCountryDropdown($id,'cd_country'));


#
# Process the template
#
echo $this->ProcessTemplateFromDatabase('searchform_'.$thetemplate);


#
# EOF
#
?>