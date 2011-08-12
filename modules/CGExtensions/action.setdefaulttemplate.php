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

$this->CheckPermission('Modify Templates'); //Don't actually care.  Just force a login.

if( !isset($params['destmodule']) )
{
    stack_trace();
    die('<br/>Destination module not set');
}
$module =& $this->GetModuleInstance($params['destmodule']);
if( !is_object($module) )
{
    stack_trace();
    die('<br/>Could not find destination module'); 
}

if( isset($params['resettodefault']) &&
    isset($params['prefname']) &&
    isset($params['filename']) )
  {
    $fn = dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.$module->GetName().DIRECTORY_SEPARATOR.
      'templates'.DIRECTORY_SEPARATOR.$params['filename'];
    if( file_exists( $fn ) )
      {
	$template = @file_get_contents($fn);
	if( isset($params['usetemplate']) )
	  {
	    $module->SetTemplate($params['prefname'],$template);
	  }
	else
	  {
	    $module->SetPreference($params['prefname'],$template);
	  }
      }
  }
 else if( isset($params['submit']) &&
	  isset($params['prefname']) )
   {
     if( isset($params['usetemplate']) )
       {
	 $module->SetTemplate($params['prefname'],$params['input_template']);
       }
     else
       {
	 $module->SetPreference($params['prefname'],$params['input_template']);
       }
   }

$module->SetCurrentTab($this->_current_tab);
$the_action = 'defaultadmin';
if( isset($params['destaction']) )
{
  $the_action = trim($params['destaction']);
}
$module->RedirectToTab($id,'','',$the_action);


// EOF
?>
