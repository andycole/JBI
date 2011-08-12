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

##################################################
#
# A simple class library to provide key/value storage
# and searching.  and to include builtin caching
#
##################################################

class AssocDataNode
{
  var $_type;
  var $_data;
  var $_extra;

  /////////////////////////////////////////
  // Constructor
  /////////////////////////////////////////
  function AssocDataNode($type,$serialdata)
  {
    $this->_type = $type;
    $this->_data = $serialdata;
  }

  /////////////////////////////////////////
  // Get the data type for this record
  /////////////////////////////////////////
  function GetType()
  {
    return $this->_type;
  }

  /////////////////////////////////////////
  // Set the data type for this record
  /////////////////////////////////////////
  function SetType($type)
  {
    $this->_type = $type;
  }

  /////////////////////////////////////////
  // Set the data for this record
  // May be a serialized object or array
  /////////////////////////////////////////
  function GetData()
  {
    return $this->_data;
  }

  /////////////////////////////////////////
  // Set the data for this record
  // May be a serialized object or array
  /////////////////////////////////////////
  function SetData($data)
  {
    $this->_data = $data;
  }
}; // class



class AssocData
{
  var $_db;
  var $_key1;
  var $_cachesize;
  var $_cache;

  /////////////////////////////////////////
  // Constructor
  /////////////////////////////////////////
  function AssocData(&$db,$key1,$cachesize=100)
  {
    $this->_db =& $db;
    $this->_key1 = $key1;
    $this->_cachesize = $cachesize;
  }


  function _clearcache()
  {
    $this->_cache = array();
  }


  function _setcache($key2,$key3,$key4,$node)
  {
    if( !is_array($this->_cache) )
      {
	$this->_cache = array();
      }
    else
      {
	if( count($this->_cache) >= $this->_cachesize )
	  {
	    // pop an element off the top
	    $this->_cache = array_shift($this->_cache);
	  }
      }

    $key = implode('+++',array($key2,$key3,$key4));
    $this->_cache[$key] = $node;
  }


  function _set($key2,$key3,$key4,$node)
  {
    // call _setcache
    $this->_setcache($key2,$key3,$key4,$node);

    // if exists update
    $now = $this->_db->DbTimeStamp(time());
    $query = 'SELECT id FROM '.CGEXTENSIONS_TABLE_ASSOCDATA.'
               WHERE key1 = ? AND key2 = ? AND key3 = ? AND key4 = ?
               LIMIT 1';
    $id = $this->_db->GetOne($query);
    if( $tmp )
      {
	$query = 'UPDATE '.CGEXTENSIONS_TABLE_ASSOCDATA."
                     SET type = ?, data = ?, modified_date = $now
                   WHERE key1 = ? AND key2 = ? AND key3 = ? AND key4 = ?";
	$this->_db->Execute($query,
			    array($node->type,$node->data,
				  $this->_key1,$key2,$key3,$key4));
      }
    else
      {
	$query = 'INSERT INTO '.CGEXTENSIONS_TABLE_ASSOCDATA."
                    (key1,key2,key3,key4,type,data,create_date,modified_date)
                  VALUES (?,?,?,?,?,?,$now,$now)";
	$this->_db->Execute($query,
			    array($this->_key1,$key2,$key3,$key4,
				  $node->type,$node->data));
      }
  }


  function Set($key2,$value,$key3='',$key4='')
  {
    $key2 = trim($key2);
    $key3 = trim($key3);
    $key4 = trim($key4);
    if( empty($key2) ) return FALSE;
    if( empty($key3) && !empty($key4) ) return FALSE;

    // determine type
    $node = new AssocDataNode;
    if( is_object($value) )
      {
	$node->SetType('object');
	$node->SetData(serialize($value));
      }
    else if( is_array($value) )
      {
	$node->SetType('array');
	$node->SetData(serialize($value));
      }
    else
      {
	$node->SetType('simple');
	$node->SetData($value);
      }

    // call _set
    $this->_set($key2,$key3,$key4,$type,$serialdata);
  }


  function _getcache($key2,$key3,$key4)
  {
    $key = implode('+++',array($key2,$key3,$key4));
    if( !isset($this->_cache[$key]) )
      {
	return FALSE;
      }
    return $this->_cache[$key];
  }


  function _get($key2,$key3,$key4)
  {
    // call _getcache
    $tmp = $this->_getcache($key2,$key3,$key4);
    if( $tmp === FALSE )
      {
	// retreive data from database
	$query = 'SELECT data,type FROM '.CGEXTENSIONS_TABLE_ASSOCDATA.'
                   WHERE key1=? AND key2=? AND key3=? AND key4=?
                   LIMIT 1';
        $row = $db->GetRow($query,
			   array($this->_key1,$key2,$key3,$key4));
	if( !$row )
	  {
	    return FALSE;
	  }
	$tmp = new AssocDataNode($row['type'],$row['data']);

	// update cache
	$this->_setcache($key2,$key3,$key4,$tmp);
      }
    return $tmp;
  }


  function Get($key2,$key3='',$key4='')
  {
    $key2 = trim($key2);
    $key3 = trim($key3);
    $key4 = trim($key4);
    if( empty($key2) ) return FALSE;
    if( empty($key3) && !empty($key4) ) return FALSE;

    // call _get
    $node = $this->_get($key2,$key3,$key4);
    if( $node === FALSE )
      {
	return FALSE;
      }

    // deserialize
    if( $node->GetType() == 'simple' )
      {
	return $node->GetData();
      }
    return unserialize($node->GetData());
  }


  function GetFullNoCache($key2,$key3='',$key4='')
  {
    $key2 = trim($key2);
    $key3 = trim($key3);
    $key4 = trim($key4);
    if( empty($key2) ) return FALSE;
    if( empty($key3) && !empty($key4) ) return FALSE;


    // return an associative array of all data for a particular row
    $query = 'SELECT * FROM '.CGEXTENSIONS_TABLE_ASSOCDATA.'
               WHERE key1 = ? AND key2 = ? AND key3 = ? AND key4 = ?';
    $row = $this->_db->GetRow($query,array($this->_key1,$key2,$key3,$key4));
  }


  function List($key2,$key3='')
  {
    // returns an array associations of all matching keys
    if( empty($key2) ) return FALSE;
    
    $qparms = array();
    $qparms[] = $this->_key1;
    $qparms[] = $key2;
    $query = 'SELECT key1,key2,key3,key4 FROM '.CGEXTENSIONS_TABLE_ASSOCDATA.'
               WHERE key1 = ? AND key2 = ?';
    if( !empty($key3) )
      {
	$query .= ' AND key3 = ?';
	$qparms[] = $key3;
      }
    $results = $this->_db->GetArray($query,$qparms);
    if( !is_array($results) ) return FALSE;
    return $results;
  }


  function Delete($key2,$key3='',$key4='')
  {
    // delete all matching keys 
    $key2 = trim($key2);
    $key3 = trim($key3);
    $key4 = trim($key4);
    if( empty($key2) ) return FALSE;
    if( empty($key3) && !empty($key4) ) return FALSE;

    $this->_clearcache();
    
    $qparms = array();
    $qparms[] = $this->_key1;
    $qparms[] = $key2;
    $query = 'DELETE FROM '.CGEXTENSIONS_TABLE_ASSOCDATA.'
               WHERE key1 = ? AND key2 = ?';
    if( !empty($key3) )
      {
	$query .= ' AND key3 = ?';
	$qparms[] = $key3;
	if( !empty($key4) )
	  {
	    $query .= ' AND key4 = ?';
	    $qparms[] = $key4;
	  }
      }
    return TRUE;
  }
  
} // class

?>