<?php
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: CGSimpleSmarty (c) 2008 by Robert Campbell 
#         (calguy1000@cmsmadesimple.org)
#  An addon module for CMS Made Simple that provides simple smarty
#  methods and functions to ease developing CMS Made simple powered
#  websites.
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

$fn = cms_join_path(dirname(__FILE__),'function.module_action.php');
require_once($fn);
$fn = cms_join_path(dirname(__FILE__),'function.repeat.php');
require_once($fn);
$fn = cms_join_path(dirname(__FILE__),'function.session_put.php');
require_once($fn);

class CGSimpleSmarty extends CMSModule
{
  function CGSimpleSmarty()
  {
    $fn = cms_join_path(dirname(__FILE__),'class.cgsimple.php');
    require_once($fn);

    global $gCms;
    $smarty =& $gCms->GetSmarty();
    $obj = new cgSimple($this);
    $smarty->assign('cgsimple',$obj);

    $smarty->register_function('module_action_link','module_action_link');
    $smarty->register_function('cgrepeat','smarty_function_cgrepeat');
    $smarty->register_function('session_put','smarty_function_session_put');
    $smarty->register_function('session_erase','smarty_function_session_erase');
  }

  /*---------------------------------------------------------
   GetName()
   ---------------------------------------------------------*/
  function GetName()
  {
    return 'CGSimpleSmarty';
  }
  
  /*---------------------------------------------------------
   GetFriendlyName()
   ---------------------------------------------------------*/
  function GetFriendlyName()
  {
    return $this->Lang('friendlyname');
  }
  
  
  /*---------------------------------------------------------
   GetVersion()
   ---------------------------------------------------------*/
  function GetVersion()
  {
    return '1.4.3';
  }

  
  /*---------------------------------------------------------
   MinimumCMSVersion()
   ---------------------------------------------------------*/
  function MinimumCMSVersion()
  {
    return '1.6';
  }


  /*---------------------------------------------------------
   GetHelp()
   ---------------------------------------------------------*/
  function GetHelp()
  {
    return $this->Lang('help');
  }
  

  /*---------------------------------------------------------
   GetAuthor()
   This returns a string that is presented in the Module
   Admin if you click on the "About" link.
   ---------------------------------------------------------*/
  function GetAuthor()
  {
    return 'calguy1000';
  }
  

  /*---------------------------------------------------------
   GetAuthorEmail()
   This returns a string that is presented in the Module
   Admin if you click on the "About" link. It helps users
   of your module get in touch with you to send bug reports,
   questions, cases of beer, and/or large sums of money.
   ---------------------------------------------------------*/
  function GetAuthorEmail()
  {
    return 'rob@techcom.dyndns.org';
  }
  

  /*---------------------------------------------------------
   GetChangeLog()
   ---------------------------------------------------------*/
  function GetChangeLog()
  {
    return @file_get_contents(dirname(__FILE__).'/changelog.html.inc');
  }


  /*---------------------------------------------------------
   IsPluginModule()
   ---------------------------------------------------------*/
  function IsPluginModule()
  {
    return false; // I think
  }


  /*---------------------------------------------------------
   GetAdminDescription()
   ---------------------------------------------------------*/
  function GetAdminDescription()
  {
    return $this->Lang('moddescription');
  }
  

  /*---------------------------------------------------------
   HasAdmin()
   ---------------------------------------------------------*/
  function HasAdmin()
  {
    return false;
  }
  

  /*---------------------------------------------------------
   HandlesEvents()
   ---------------------------------------------------------*/
  function HandlesEvents ()
  {
    return false;
  }

  /*---------------------------------------------------------
   Install()
   ---------------------------------------------------------*/
  function Install()
  {
    //$this->AddEventHandler( 'Search', 'SearchItemAdded', false );
  }

  
  /*---------------------------------------------------------
   InstallPostMessage()
   ---------------------------------------------------------*/
  function InstallPostMessage()
  {
    return $this->Lang('postinstall');
  }

  
  /*---------------------------------------------------------
   UninstallPostMessage()
   ---------------------------------------------------------*/
  function UninstallPostMessage()
  {
    return $this->Lang('postuninstall');
  }

}

?>
