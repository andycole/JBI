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

class cgSimple
{
  var $_module;

  /////////
  // Constructor
  /////////
  function cgSimple(&$module)
  {
    $this->_module =& $module;
  }

  //////////
  // A function to output the current page url
  //////////
  function self_url($assign='')
  {
    $s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
    $p = strpos($_SERVER['SERVER_PROTOCOL'],'/');
    $protocol = strtolower(substr($_SERVER['SERVER_PROTOCOL'],0,$p)).$s;
    $port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
    $s = $protocol."://".$_SERVER['SERVER_NAME'].$port;

    $txt = $s.$_SERVER['REQUEST_URI'];
    if( !empty($assign) )
      {
	global $gCms;
	$smarty =& $gCms->GetSmarty();
	$smarty->assign($assign,$txt);
	return;
      }
    return $txt;
  }


  //////////
  // A function to test if a CMS Made Simple module is installed
  //////////
  function module_installed($module,$assign = '')
  {
    if( $module == '' ) return 0;
    $module =& $this->_module->GetModuleInstance($module);

    $result = 0;
    if( is_object( $module ) ) $result = 1;

    if( !empty($assign) )
      {
	global $gCms;
	$smarty =& $gCms->GetSmarty();
	$smarty->assign($assign,$result);
	return;
      }
    return $result;
  }

  /////////
  // A function to return the parent page alias of a given page or
  // of the current page
  /////////
  function get_parent_alias($alias = '',$assign = '')
  {
    global $gCms;
    $contentops =& $gCms->GetContentOperations();
    $smarty =& $gCms->GetSmarty();

    if( $alias == '' )
      {
	$alias = $smarty->get_template_vars('page_alias');
      }
    $content =& $contentops->LoadContentFromAlias($alias);
    if( !is_object($content) ) return '';

    $parentid = $content->ParentId();
    if( $parentid <= 0 ) return '';
    $alias = $contentops->GetPageAliasFromId($parentid);

    if( $assign != '' )
      {
	$smarty->assign($assign,$alias);
	return;
      }
    return $alias;
  }

  
  /////////
  // A function to return the topmost parent page alias of a given page or
  // of the current page
  /////////
  function get_root_alias($alias = '',$assign = '')
  {
    global $gCms;
    $contentops =& $gCms->GetContentOperations();
    $smarty =& $gCms->GetSmarty();

    if( $alias == '' )
      {
	$alias = $smarty->get_template_vars('page_alias');
      }
    $id = $contentops->GetPageIDFromAlias($alias);
    
    while( $id > 0 )
      {
	$content =& $contentops->LoadContentFromId($id);
	if( !is_object( $content ) ) return '';
	$alias = $content->Alias();
	$id = $content->ParentId();
      }
    
    if( $assign != '' )
      {
	$smarty->assign($assign,$alias);
	return;
      }
    return $alias;
  }


  /////////
  // A function to return the page title of a given page or
  // of the current page
  /////////
  function get_page_title($alias = '',$assign = '')
  {
    global $gCms;
    $contentops =& $gCms->GetContentOperations();
    $smarty =& $gCms->GetSmarty();

    if( $alias == '' )
      {
	$alias = $smarty->get_template_vars('page_alias');
      }
    $content =& $contentops->LoadContentFromAlias($alias);
    if( !is_object($content) ) return '';

    if( $assign != '' )
      {
	$smarty->assign($assign,$content->Name());
	return;
      }
    return $content->Name();
  }

  
  /////////
  // A function to return the menutext of a given page or
  // of the current page
  /////////
  function get_page_menutext($alias = '',$assign = '')
  {
    global $gCms;
    $contentops =& $gCms->GetContentOperations();
    $smarty =& $gCms->GetSmarty();

    if( $alias == '' )
      {
	$alias = $smarty->get_template_vars('page_alias');
      }
    $content =& $contentops->LoadContentFromAlias($alias);
    if( !is_object($content) ) return '';

    if( $assign != '' )
      {
	$smarty->assign($assign,$content->MenuText());
	return;
      }
    return $content->MenuText();
  }

  
  /////////
  // A function to test if a given (or the current page) has
  // children.
  /////////
  function has_children($alias = '',$assign = '')
  {
    $result = false;
    global $gCms;
    $contentops =& $gCms->GetContentOperations();
    $smarty =& $gCms->GetSmarty();

    if( $alias == '' )
      {
	$alias = $smarty->get_template_vars('page_alias');
      }

    $content =& $contentops->LoadContentFromAlias($alias);
    if( !is_object($content) ) $result = false;
    $result = $content->HasChildren();

    if( $assign != '' )
      {
	$smarty->assign($assign,$result);
	return;
      }
    return $result;
  }


  /*---------------------------------------------------------
   Return an array containing the page ids of all of the specified page's
   children.
   ---------------------------------------------------------*/
  function get_children($alias = '',$showall = false,$assign = '')
  {
    global $gCms;
    $contentops =& $gCms->GetContentOperations();
    $db =& $gCms->GetDb();
    $smarty =& $gCms->GetSmarty();

    if( $alias == '' )
      {
	$alias = $smarty->get_template_vars('page_alias');
      }

    $content =& $contentops->LoadContentFromAlias($alias);
    if( !is_object($content) ) $result = false;

    $query = "SELECT content_alias as alias, content_id as id, content_name as title, 
                     menu_text as menutext, show_in_menu
                FROM ".cms_db_prefix()."content 
              WHERE parent_id = ?";
    if( !$showall )
      {
	$query .= ' AND active = 1';
      }
    $query .= ' ORDER BY hierarchy';

    $dbr = $db->Execute($query,array($content->Id()));
    if( !$dbr ) return false;
    $results = array();
    while( $dbr && $row = $dbr->FetchRow() )
      {
	$results[] = $row;
      }
    if( !count($results) ) return false;

    if( !empty($assign) )
      {
	$smarty->assign($assign,$results);
	return;
      }

    return $results;
  }

  /*---------------------------------------------------------
   Return a module's version
   ---------------------------------------------------------*/
  function module_version($name, $assign = '')
  {
    global $gCms;
    $out = '';
    if( !empty($name) )
      {
	if( isset( $gCms->modules[$name] ) )
	  {
	    $obj =& $gCms->modules[$name]['object'];
	    $out = $obj->GetVersion();
	  }
      }

    if( $assign != '' )
      {
	$smarty =& $gCms->GetSmarty();
	$smarty->assign($assign,$out);
	return;
      }
    return $out;
  }

  
  //////////
  // Get page content from a content block
  //////////
  function get_page_content($alias,$block = '',$assign = '')
  {
    $result = false;
    global $gCms;
    $contentops =& $gCms->GetContentOperations();
    $smarty =& $gCms->GetSmarty();

    if( $block == '' ) $block = 'content_en';

    if( $alias != '' )
      {
	$content =& $contentops->LoadContentFromAlias($alias);
	if( is_object($content) ) 
	  {
	    $result = $content->GetPropertyValue($block);
	  }
      }

    if( $assign != '' )
      {
	$smarty->assign(trim($assign),$result);
	return;
      }
    return $result;
  }


  ////////////////////
  // Get prev sibling
  ////////////////////
  function get_sibling($dir,$assign = '',$alias = '')
  {
    global $gCms;
    $db =& $gCms->GetDb();
    $smarty =& $gCms->GetSmarty();
    $contentops =& $gCms->GetContentOperations();

    if( empty($alias) )
      {
	$alias = $smarty->get_template_vars('page_alias');
      }
    $content =& $contentops->LoadContentFromAlias($alias);
    if( !is_object($content) ) return false;
    
    // get the last item out of the hierarchy
    // and rebuild
    $query = 'SELECT content_alias FROM '.cms_db_prefix().'content
               WHERE parent_id = ? 
                 AND item_order %s ?
                 AND active = 1
               ORDER BY item_order %s
               LIMIT 1';

    switch(strtolower($dir))
      {
      case '-1':
      case 'prev':
	$thechar = '<';
	$order = 'DESC';
	break;

      default:
	$thechar = '>';
	$order = 'ASC';
	break;
      }

    $res = $db->GetOne(sprintf($query,$thechar,$order),
		       array($content->mParentId,$content->mItemOrder));
    if( !empty($assign) )
      {
	$smarty->assign(trim($assign),$res);
	return;
      }
    return $res;
  }

  //////////
  // Get a file listing for a specified directory
  //////////
  function get_file_listing($dir,$excludeprefix='',$assign = '')
  {
    global $gCms;
    $smarty =& $gCms->GetSmarty();
    $config =& $gCms->GetConfig();

    $fileprefix = '';
    if( !empty($excludeprefix) )
      {
	$fileprefix = $excludeprefix;
      }
    if( startswith($dir,'/') ) return;
    $dir = cms_join_path($config['uploads_path'],$dir);
    $list = get_matching_files($dir,'',true,true,$fileprefix,1);
    if( !empty($assign) )
      {
	$smarty->assign(trim($assign),$list);
	return;
      }
    return $list;
  }
};

// EOF
?>