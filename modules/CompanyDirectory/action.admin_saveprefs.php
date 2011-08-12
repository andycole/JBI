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

if( !isset( $gCms ) ) return;

if( !$this->CheckPermission('Modify Site Preferences') )
  {
    return;
  }

if( !isset( $params['submit'] ) )
  {
    $this->Redirect( $id, 'defaultadmin', $returnid, array('active_tab'=>'prefs'));
  }

if( isset($params['detailpage']) )
  {
    $this->SetPreference('detailpage',$params['detailpage']);
  }

if( isset($params['sortorder']) )
  {
    $this->SetPreference('sortorder',$params['sortorder']);
  }

if( isset($params['sortby']) )
  {
    $this->SetPreference('sortby',$params['sortby']);
  }

$this->SetPreference('collectstats',$params['input_collectstats']);

$this->Redirect( $id, 'defaultadmin', $returnid, array('active_tab'=>'prefs'));

// EOF
?>