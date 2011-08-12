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

class cge_array
{
  /**
   * A functon to test if an array element exists
   * and if it does not, add the value specified.
   * @returns array
   */
  static public function insert_unique($arr,$val)
  {
    if( !in_array($str,$arr) )
      {
	$arr[] = $str;
      }
    return $arr;
  }


  /***
   * A method to test if an array element exists by testing
   * a subset of it's key
   *
   * @param array  The array to test
   * @param string The substring expression to test for
   * @returns bool
   */
  static public function key_exists_substr($arr,$expr)
  {
    $keys = array_keys( $arr );
    foreach( $keys as $k )
      {
	if( strstr( $k, $expr ) ) return true;
      }
    return false;
  }


  /**
   * Test if an array key exists, given a regular expression
   *
   * @param array  The array to search
   * @param string The regular expression to use in the search
   * @returns FALSE or actual key name.
   */
  static public function find_key_regexp($arr,$expr)
  {
    $keys = array_keys( $arr );
    foreach( $keys as $k )
      {
	if( preg_match( $expr, $k ) ) return $k;
      }
    return FALSE;
  }


  /**
   * Merge two arrays of hashes based on certain keys
   *
   * @param array array1  The primary array
   * @param array array2  The array to be merged
   * @param string key1   The key field in the first array
   * @param string key2   The key field in the second array
   */
  static public function merge_by_keys($arr1,$arr2,$key1 = 'name',$key2 = 'name')
  {
    if( !is_array( $arr1 ) || !is_array( $arr2 ) )
      {
	return;
      }

    $xxresult = array();
    foreach( $arr1 as $a1 )
      {
	$key1val = $a1[$key1];
	$found = false;
	foreach( $arr2 as $a2 )
	  {
	    if( $a2[$key2] == $key1val )
	      {
		// found an item to merge
		$xxresult[] = array_merge($a1,$a2);
		$found = true;
		break;
	      }
	  }

	if( !$found )
	  {
	    $xxresult[] = $a1;
	  }
      }

    return $xxresult;
  }

  /*
   * re-arrange an array of arrays into a hash of arrays
   * by a specified key.
   */
  static public function to_hash($input,$key)
  {
    $tmp = array();
    if( is_array($input) )
      {
	foreach( $input as $one )
	  {
	    if( !isset($one[$key]) ) continue;
	    $tmp[$one[$key]] = $one;
	  }
      }
    return $tmp;
  }

  /*
   * Extract one field from an array of hashes into a flat array
   */
  public static function extract_field($input,$key)
  {
    $tmp = array();
    foreach( $input as $one )
      {
	if( !isset($one[$key]) ) continue;
	$tmp[] = $one[$key];
      }
    return $tmp;
  }

  /*
   * Compare two hashes by the key 'sort_key'
   * This function is useful for sorting arrays.
   */
  static public function compare_elements_by_sortorder_key( $e1, $e2, $key = 'sort_key' )
  {
    if( $e1[$key] < $e2[$key] )
      {
	return -1;
      }
    else if( $e1[$key] > $e2[$key] )
      {
	return 1;
      }
    return 0;
  }


  /**
   * Sort array of hashes by key
   **/
  static public function hashsort(&$input,$key,$is_string = false,$casecompare = false)
  {
    $fn1 = 'if($a[__KEY__] == $b[__KEY__]) return 0; if($a[__KEY__] < $b[__KEY__]) return -1; return 1;';
    $fn2 = 'return strcmp($a[__KEY__],$b[__KEY__]);';
    $fn3 = 'return strcasecmp($a[__KEY__],$b[__KEY__]);';

    $fn = $fn1;
    if( $is_string )
      {
	if( $casecompare )
	  {
	    $fn = $fn3;
	  }
	else
	  {
	    $fn = $fn2;
	  }
      }
    $key = "'".$key."'";
    $t1 = str_replace('__KEY__',$key,$fn);
    $tmp = create_function('$a,$b',$t1);
    return usort($input,$tmp);
  }


  /**
   * Sort array of hashes by key in reverse order
   */
  static public function hashrsort(&$input,$key,$is_string = false,$casecompare = false)
  {
    $tmp = self::hashsort($input,$key,$is_string,$casecompare);
    if( $tmp )
      {
	$tmp2 = array_reverse($input);
	$input = $tmp2;
      }
  }


  /*
   * Explode an array into a hash
   * useful for separating params on a URL into a hash
   *
   * @param input string
   * @param inner_glue string (separates name from value)
   * @param outer_glue string (separates each variable/value combination)
   */
  function explode_with_key($str, $inglue='=', $outglue='&')
  {
    $ret = array();
    $a1 = split($outglue,$str);
    foreach( $a1 as $a2 )
      {
	list( $k, $v ) = split( $inglue, $a2 );
	$ret[ $k ] = $v;
      }
    return $ret;
  }

  /*
   * Given an array and a value, return the index of that value
   *
   * @param data array
   * @param value mixed
   * @returns index or FALSE
   */
  function find_index( $data, $value )
  {
    $i = 0;
    foreach( $data as $k=>$v )
      {
	if( $v == $value )
	  {
	    return $i;
	  }
	$i++;
      }
    return FALSE;
  }


  /*
   * Implode a hash into an array
   * suitable for forming a URL string with multiple key/value pairs
   *
   * @param hash input hash
   * @param string inner glue
   * @param string outer glue
   * @returns string;
   */
  function implode_with_key($assoc, $inglue = '=', $outglue = '&')
  {
    $return = null;
    foreach ($assoc as $tk => $tv) $return .= $outglue.$tk.$inglue.$tv;
    return substr($return,strlen($outglue));
  }

  /***
   * Convert a hash into a stdclass object
   *
   * @param hash input array
   * @returns stdclass object.
   */
  static public function &to_object($array)
  {
    $obj = new StdClass();
    foreach( $array as $key => $value )
      {
	$obj->$key = $value;
      }
    return $obj;
  }

  /**
   * Prepend a key/value pair to a hash
   *
   * @param hash input array
   * @param string key
   * @param mixed value
   * @returns hash
   */
  static public function hash_prepend($input,$key,$value)
  {
    $tmp = array();
    $tmp[$key] = $value;
    foreach( $input as $key => $value )
      {
	$tmp[$key] = $value;
      }
    return $tmp;
  }
} // class

#
# EOF
#
?>