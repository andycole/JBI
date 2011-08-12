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

function process_field($txt)
{
  $txt = trim($txt);
  $txt = str_replace("\r\n","\n",$txt);
  $txt = str_replace("\r","\n",$txt);
  $txt = str_replace("\n",'^^',$txt);
  if( strstr($txt,' ') !== FALSE )
    {
      $txt = '"'.$txt.'"';
    }
  return $txt;
}

$delim = '|';

$query = 'SELECT * FROM '.cms_db_prefix().'module_compdir_fielddefs ORDER BY item_order ASC';
$fielddefs = $db->GetArray($query);

// 1. Build the header line
$header = '#COMPANY=C'.$delim;

// 1.1 Get the companies header.
$query = "SELECT * FROM ".cms_db_prefix()."module_compdir_companies ORDER BY company_name LIMIT 1";
$row = $db->GetRow($query);
unset($row['create_date']);
unset($row['modified_date']);
unset($row['id']);
unset($row['owner_id']);
unset($row['picture_location']);
unset($row['logo_location']);
$company_fields = array_keys($row);
$header .= implode($delim,$company_fields);

// 1.1.1 Get the field definition names
if( $fielddefs && is_array($fielddefs) )
  {
    foreach( $fielddefs as $one )
      {
	if( strstr($one['name'],' ') !== FALSE )
	  {
	    $header .= 'FIELD:"'.trim($one['name']).'"'.$delim;
	  }
	else
	  {
	    $header .= 'FIELD:'.trim($one['name']).$delim;
	  }
      }
    die('got here');
    $header = substr($header,0,-1*strlen($delim));
  }

// 1.1.2 Get the category names
$query = 'SELECT name FROM '.cms_db_prefix().'module_compdir_categories ORDER BY name ASC'; 
$names = $db->GetArray($query);
if( $names && is_array($names) )
  {
    $header .= $delim;
    foreach( $names as $one )
      {
	if( strstr($one['name'],' ') !== FALSE )
	  {
	    $header .= 'CAT:"'.trim($one['name']).'"'.$delim;
	  }
	else
	  {
	    $header .= 'CAT:'.trim($one['name']).$delim;
	  }
      }
    $header = substr($header,0,-1*strlen($delim));
  }

// 1.2 Get the field definition header
$query = 'SELECT * FROM '.cms_db_prefix().'module_compdir_fielddefs ORDER BY item_order LIMIT 1';
$row = $db->GetRow($query);
if( $row )
  {
    unset($row['id']);
    unset($row['item_order']);
    unset($row['create_date']);
    unset($row['modified_date']);
    $fielddef_fields = array_keys($row);
    $header .= "\n#FIELDDEF=F".$delim.implode($delim,$fielddef_fields)."\n";
    //$header = substr($header,0,-1*strlen($delim))."\n";
  }

// 1.3 Get the categories definition header
$header .= "\n#CATEGORY=T".$delim."name\n";

// 2 begin output.
$csv_output = $header."\n";

// 2.1 output the field definitions
foreach( $fielddefs as $row )
  {
    $line = 'F'.$delim;
    foreach( $fielddef_fields as $fn )
      {
	$data = process_field($row[$fn]);
	$line .= $data.$delim;
      }
    $line = substr($line,0,-1*strlen($delim))."\n";
    $csv_output .= $line;
  }
echo '<pre>'; print_r( $fielddefs ); echo '</pre><br/>';

// 2.2 output the categories
$csv_output .= "\n";
$query = 'SELECT * FROM '.cms_db_prefix().'module_compdir_categories ORDER BY name ASC';
$dbr = $db->Execute($query);
while( $dbr && $row = $dbr->FetchRow() )
  {
    $line = 'T'.$delim;
    $txt = process_field($row['name']);
    $line .= $txt.$delim;
    $line = substr($line,0,-1*strlen($delim))."\n";
    $csv_output .= $line;
  }

// 2.3 output the companies.
$csv_output .= "\n";
$query = "SELECT * FROM ".cms_db_prefix()."module_compdir_companies ORDER BY company_name";
$fquery = 'SELECT A.id,A.name,B.value 
             FROM '.cms_db_prefix().'module_compdir_fielddefs A
             LEFT JOIN '.cms_db_prefix().'module_compdir_fieldvals B
               ON A.id = B.fielddef_id
            WHERE B.company_id = ?';
$cquery = 'SELECT company_id,name 
             FROM (SELECT * FROM '.cms_db_prefix().'module_compdir_company_categories WHERE company_id = ?) AS sub 
            RIGHT JOIN '.cms_db_prefix().'module_compdir_categories AS c ON c.id = sub.category_id
            ORDER BY name ASC';

$dbresult = $db->Execute($query);
while ($dbresult && $row = $dbresult->FetchRow())
{
  // 2.1.1 output company fields.
  $line = 'C'.$delim;
  foreach( $company_fields as $fn )
    {
      $line .= process_field($row[$fn]).$delim;
    }

  // 2.1.2 now output this companies fields.
  $tmp1 = $db->GetArray($fquery,array($row['id']));
  $tmp2 = $this->array_to_hash( $tmp1, 'name' );
  foreach( $fielddefs as $one_def )
    {
      $name = $one_def['name'];
      $val = '';
      if( isset($tmp2[$name]) )
	{
	  $val = $tmp2[$name]['value'];
	}
      echo "DEBUG: $name = $val<br/>";
      $line .= process_field($val).$delim;
    }
  
  // 2.1.3 now output this companies categories
  $tmp = $db->GetArray($cquery,array($row['id']));
  foreach( $tmp as $one )
    {
      $val = 0;
      if( $one['company_id'] > 0 )
	$val = 1;
      $line .= $val.$delim;
    }
  
  $line = substr($line,0,-1*strlen($delim))."\n";
  $csv_output .= $line;
}


//Hack to make sure all of the CMS buffers are off
$handlers = ob_list_handlers(); 
for ($cnt = 0; $cnt < sizeof($handlers); $cnt++) { ob_end_clean(); }

//Then force the output normally and exit so we don't get a footer
header("Content-disposition: attachment; filename=company_directory." . date("Y-m-d") . ".csv");
header("Content-type: text/csv");
print $csv_output;

exit;

?>