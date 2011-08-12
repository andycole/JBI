<?php

class cge_datastore
{
  private $_expiry;
  private $_last_cleanup;
  private $_cleanup_interval;

  public function __construct($expiry = 3600,$cleanup_interval = '')
  {
    $expiry = max(1,$expiry);

    $this->_expiry = $expiry;
    if( empty($cleanup_interval) )
      {
	$cleanup_interval = $expiry;
      }
    $this->_cleanup_interval = $cleanup_interval;
    $this->_last_cleanup = -1;
  }

  private function _calculate_expiry()
  {
    global $gCms;
    $db =& $gCms->GetDb();
    return $db->DbTimeStamp(time()+$this->_expiry);
  }

  public function remove_expired()
  {
    $now = time();
    if( ($now - $this->_last_cleanup) > $this->_cleanup_interval )
      {
	global $gCms;
	$db =& $gCms->GetDb();
	$query = 'DELETE FROM '.CGEXTENSIONS_TABLE_ASSOCDATA.'
               WHERE expiry < NOW() AND expiry != -1';
	$db->Execute($query);

	$this->_last_cleanup = $now;
      }
  }


  public function erase($key1,$key2 = '',$key3 = '', $key4 = '')
  {
    global $gCms;
    $db =& $gCms->GetDb();
    $query = 'DELETE FROM '.CGEXTENSIONS_TABLE_ASSOCDATA.'
               WHERE key1 = ? AND key2 = ? AND key3 = ? AND key4 = ?';
    $db->Execute($query,array($key1,$key2,$key3,$key4));

    $this->remove_expired();
  }


  public function store($data,$key1,$key2='',$key3='',$key4='')
  {
    if( empty($data) ) return FALSE;
    $exp = $this->_calculate_expiry();

    $this->erase($key1,$key2,$key3,$key4);

    $query = 'INSERT INTO '.CGEXTENSIONS_TABLE_ASSOCDATA."
                (key1,key2,key3,key4,data,expiry,create_date,modified_date)
              VALUES (?,?,?,?,?,$exp,NOW(),NOW())";
    global $gCms;
    $db =& $gCms->GetDb();
    $dbr = $db->Execute($query,array($key1,$key2,$key3,$key4,$data));
    if( !$dbr )
      {
	echo "FATAL: ".$db->sql."<br/>".$db->ErrorMsg().'<br/>'; die();
      }
    $this->remove_expired();
  }
  

  public function get($key1,$key2 = '',$key3 = '', $key4 = '')
  {
    $this->remove_expired();
    $query = 'SELECT data FROM '.CGEXTENSIONS_TABLE_ASSOCDATA.'
               WHERE key1 = ? AND key2 = ? AND key3 = ? AND key4 = ?
                 AND expiry > NOW() ORDER BY modified_date LIMIT 1';
    global $gCms;
    $db =& $gCms->GetDb();
    $tmp = $db->GetOne($query,array($key1,$key2,$key3,$key4));
    if( !$tmp ) return FALSE;
    return $tmp;
  }


  public function listall($key1,$key2 = '',$key3 = '')
  {
    $parms = array();
    $where[] = array();

    $where[] = 'key1 = ?';
    $parms[] = $key1;

    $query = 'SELECT key1,key2,key3,key4 FROM '.CGEXTENSIONS_TABLE_ASSOCDATA;
    if( !empty($key2) )
      {
	$where[] = 'key2 = ?';
	$parms[] = $key2;

	if( !empty($key3) )
	  {
	    $where[] = 'key3 = ?';
	    $parms[] = $key3;
	  }
      }

    if( count($where) )
      {
	$query .= ' WHERE ' + implode(' AND ',$where);
      }
    global $gCms;
    $db =& $gCms->GetDb();
    $data = $db->GetArray($query,$parms);
    if( !$data ) return FALSE;
    return $data;
  }

  
}

?>