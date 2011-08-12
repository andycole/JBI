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

$smarty->assign('formstart',$this->CGCreateFormStart($id,'do_importcsv',$returnid,array(),
						     false, 'post', 'multipart/form-data'));
$smarty->assign('formend',$this->CreateFormEnd());

$opts = array();
$opts[0] = $this->Lang('no');
$opts[1] = $this->Lang('yes');
$smarty->assign('yesnoopts',$opts);

$can_lookup = 0;
$cggm = $this->GetModuleInstance('CGGoogleMaps');
if( is_object($cggm) )
  {
    if( method_exists($cggm,'GetCoordsFromAddress') )
      {
	$can_lookup = 1;
      }
  }
$smarty->assign('can_lookup',$can_lookup);

echo $this->ProcessTemplate('importcsv.tpl');

#
# EOF
#
?>