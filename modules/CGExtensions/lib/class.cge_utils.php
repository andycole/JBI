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

class cge_utils
{
  private static function &_get_cge()
  {
    global $gCms;
    $cge =& $gCms->modules['CGExtensions']['object'];
    return $cge;
  }

  public static function db_time($unixtime,$trim = true)
  {
    global $gCms;
    $db =& $gCms->GetDb();
    $tmp = $db->DbTimeStamp($unixtime);
    if( $trim )
      {
	$tmp = trim($tmp,"'");
      }
    return $tmp;
  }

  public static function unix_time($string)
  {
    // snarfed from smarty.
    $string = trim($string);
    $time = '';
    if(empty($string)) {
      // use "now":
      $time = time();

    } elseif (preg_match('/^\d{14}$/', $string)) {
      // it is mysql timestamp format of YYYYMMDDHHMMSS?
      $time = mktime(substr($string, 8, 2),substr($string, 10, 2),substr($string, 12, 2),
		     substr($string, 4, 2),substr($string, 6, 2),substr($string, 0, 4));

    } elseif (preg_match("/(\d{4})-(\d{2})-(\d{2})\s(\d{2}):(\d{2}):(\d{2})/", $string, $dt)) {
      $time = mktime($dt[4],$dt[5],$dt[6],$dt[2],$dt[3],$dt[1]);
    } elseif (is_numeric($string)) {
      // it is a numeric string, we handle it as timestamp
      $time = (int)$string;

    } else {
      // strtotime should handle it
      $time = strtotime($string);
      if ($time == -1 || $time === false) {
	// strtotime() was not able to parse $string, use "now":
	// but try one more thing
	list($p1,$p2) = explode(' ',$string,2);
	
	global $gCms;
	$db =& $gCms->GetDb();
	$time = $db->UnixTimeStamp($string);
	if( !$time )
	  {
	    $time = time();
	  }
      }
    }

    return $time;
  }

  public static function get_image_extensions()
  {
    $cge =& self::_get_cge();
    return $cge->GetPreference('imageextensions');
  }


} // class

#
# EOF
#
?>