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

$catid = '';
if (isset($params['catid']))
{
	$catid = $params['catid'];
}

// Get the category details
$query = 'SELECT * FROM '.cms_db_prefix().'module_compdir_categories WHERE id = ?';
$row = $db->GetRow($query, array( $catid));

//Now remove the category
$query = "DELETE FROM ".cms_db_prefix()."module_compdir_categories WHERE id = ?";
$db->Execute($query, array($catid));

//And remove it from any entries
$query = "DELETE FROM module_compdir_company_categories WHERE category_id = ?";
$db->Execute($query, array($catid));

$params = array('tab_message'=> 'categorydeleted', 'active_tab' => 'categories');
$this->Redirect($id, 'defaultadmin', $returnid, $params);

?>