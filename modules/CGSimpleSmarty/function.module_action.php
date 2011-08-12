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

//////////
// A simple function to generate a link to a module action
//////////
function module_action_link($params, &$smarty)
{
  global $gCms;
  $mid = 'm1_';

  if( !isset($params['module']) )
    {
      // nothing to do
      return;
    }
  $module = $params['module'];
  unset($params['module']);

  if( !isset($gCms->modules[$module]['object']) )
    {
      // nothing to do
      return;
    }

  $text = $module;
  if( isset($params['text']) )
    {
      $text = trim($params['text']);
      unset($params['text']);
    }

  $confmessage = '';
  if( isset($params['confmessage']) )
    {
      $confmessage = trim($params['confmessage']);
      unset($params['confmessage']);
    }

  $image = '';
  if( isset($params['image']) )
    {
      $image = trim($params['image']);
      unset($params['image']);
    }

  $class = '';
  if( isset($params['class']) )
    {
      $class = trim($params['class']);
      unset($params['class']);
    }

  $action = 'default';
  if( isset($params['action']) )
    {
      $action = $params['action'];
      unset($params['action']);
    }

  if( isset($params['id']) )
    {
      $mid = $params['id'];
      unset($params['id']);
    }

  $imageonly = false;
  if( isset($params['imageonly']) )
    {
      $imageonly = true;
      unset($params['imageonly']);
    }

//   $inline = 0;
//   if( isset($params['inline']) )
//     {
//       $inline = (int)$params['inline'];
//       unset($params['inline']);
//     }

  $pageid = isset($gCms->variables['content_id'])?$gCms->variables['content_id']:'';
  if( isset($params['page']) )
    {
      // convert the page alias to an id
      $manager =& $gCms->GetHierarchyManager();
      $node =& $manager->sureGetNodeByAlias($params['page']);
      if (isset($node))
	{
	  $content =& $node->GetContent();	
	  if (isset($content))
	    {
	      $pageid = $content->Id();
	    }
	}
      else
	{
	  $node =& $manager->sureGetNodeById($params['page']);
	  if (isset($node))
	    {
	      $pageid = $params['detailpage'];
	    }
	}
      unset($params['page']);
    }
//   if( empty($pageid) )
//     {
//       // assume admin action
//       $mid = 'm1_';
//     }

  $urlonly = false;
  if( isset($params['urlonly']) )
    {
      $urlonly = true;
      unset($params['urlonly']);
    }

  $jsfriendly = false;
  if( isset($params['jsfriendly']) )
    {
      $jsfriendly = true;
      unset($params['jsfriendly']);
    }

  $assign = '';
  if( isset($params['assign']) )
    {
      $assign = trim($params['assign']);
      unset($params['assign']);
    }

  $obj =& $gCms->modules[$module]['object'];
  if( !empty($image) && method_exists($obj,'CreateImageLink') && $urlonly == false )
    {
      $output = $obj->CreateImageLink($mid,$action,$pageid,$text,$image,
				      $params,$class,$confmessage,$imageonly);
    }
  else
    {
      $output = $obj->CreateLink($mid,$action,$pageid,$text,$params,$confmessage,$urlonly);
      if( $urlonly && $jsfriendly )
	{
	  $output = str_replace('amp;','',$output);
	}
    }

  if( !empty($assign) )
    {
      $smarty->assign($assign,$output);
      return;
    }

  return $output;
}

# EOF
?>
