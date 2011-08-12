<?php
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: CGExtensions (c) 2008 by Robert Campbell 
#         (calguy1000@cmsmadesimple.org)
#  An addon module for CMS Made Simple to provide useful functions
#  and commonly used gui capabilities to other modules.
# 
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2005 by Ted Kulp (wishy@cmsmadesimple.org)
# This project's homepage is: http://www.cmsmadesimple.org
#
#-------------------------------------------------------------------------
#
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# However, as a special exception to the GPL, this software is distributed
# as an addon module to CMS Made Simple.  You may not use this software
# in any Non GPL version of CMS Made simple, or in any version of CMS
# Made simple that does not indicate clearly and obviously in its admin 
# section that the site was built with CMS Made simple.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
# Or read it online: http://www.gnu.org/licenses/licenses.html#GPL
#
#-------------------------------------------------------------------------
#END_LICENSE
if( !$gCms ) exit();

// if( ! $this->CheckPermission('Modify Templates') )
//   {
//     // todo, permissions message here
//     return;
//   }

$the_action = 'defaultadmin';
if( isset($params['destaction']) )
{
  $the_action = trim($params['destaction']);
}


if( !isset( $params['modname'] ) )
  {
    $params['errors'] = $this->Lang('error_insufficientparams');
    $this->Redirect($id,$the_action,$returnid,$params);
    return;
  }
$module = $this->GetModuleInstance($params['modname']);
if( !$module )
  {
    $params['errors'] = $this->Lang('error_insufficientparams');
    $this->Redirect($id,$the_action,$returnid,$params);
    return;
  }


if( isset( $params['cancel'] ) )
  {
    $module->_current_tab = $this->_current_tab;
    $module->RedirectToTab($id,$this->_current_tab,'',$the_action);
  }


$template = "";
if( isset( $params['template'] ) )
  {
    $template = munge_string_to_url(trim($params['template']));
  }
  
$prefix = "";
if( isset( $params['prefix'] ) )
  {
    $prefix = trim($params['prefix']);
  }

if( !isset( $params['templatecontent'] ) )
  {
    $params['errors'] = $this->Lang('error_insufficientparams');
    $module->Redirect($id,$params['origaction'],'',$params);
    return;
  }

if( $template == "" || $prefix == "" )
  {
    $params['errors'] = $this->Lang('error_insufficientparams');
    $module->Redirect($id,$params['origaction'],'',$params);
    return;
  }


$newtemplate = $prefix . $template;

// check if this template already exists
$txt = trim($module->GetTemplate($newtemplate));
if( $txt != "" )
  {
    $params['errors'] = $this->Lang('error_templatenameexists');
    $this->Redirect($id,$params['origaction'],'',$params);
    return;
  }

// we're ready to set it
$txt = cms_html_entity_decode($params['templatecontent'],ENT_QUOTES,get_encoding());
$module->SetTemplate($newtemplate,$txt);

if( $this->_current_tab != '' )
  {
    $module->_current_tab = $this->_current_tab;
    $module->RedirectToTab($id,'','',$the_action);
    return;
  }
$module->Redirect($id,$the_action);

?>