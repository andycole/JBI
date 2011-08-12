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

define('CGFILEUPLOAD_NOFILE','CGFILEUPLOAD_NOFILE');
define('CGFILEUPLOAD_FILESIZE','CGFILEUPLOAD_FILESIZE');
define('CGFILEUPLOAD_FILETYPE','CGFILEUPLOAD_FILETYPE');
define('CGFILEUPLOAD_FILEEXISTS','CGFILEUPLOAD_FILEEXISTS');
define('CGFILEUPLOAD_BADDESTDIR','CGFILEUPLOAD_BADDESTDIR');
define('CGFILEUPLOAD_BADPERMS','CGFILEUPLOAD_BADPERMS');
define('CGFILEUPLOAD_MOVEFAILED','CGFILEUPLOAD_MOVEFAILED');

class CGFileUploadHandler
{
  var $_maxfilesize;
  var $_error;
  var $_prefix;
  var $_destdir;
  var $_filetypes;
  var $_allow_overwrite;
  var $_destname;
  var $_files;


  function CGFileUploadHandler($prefix,$destdir)
  {
    $this->_error = false;
    $this->_allow_overwrite = false;
    $this->_prefix = $prefix;
    $this->_destdir = $destdir;
    $this->_files = $_FILES;

    global $gCms;
    $config =& $gCms->GetConfig();
    $this->_maxfilesize = $config['max_upload_size'];

  }


  function SetAcceptedFiletypes($filetypes)
  {
    if( is_array( $filetypes ) )
      {
	$this->_filetypes = $filetypes;
      }
    else
      {
	if( empty($filetypes) )
	  {
	    $this->_filetypes = false;
	  }
	else
	  {
	    $this->_filetypes = explode(',',$filetypes);
	  }
      }
  }


  function SetMaxFileSizeKb($size)
  {
    $this->_maxfilesize = $size * 1024;
  }


  function AllowOverwrite($flag = true)
  {
    $this->_allow_overwrite = $flag;
  }


  function GetError()
  {
    return $this->_error;
  }


  function GetDestinationFilename()
  {
    return $this->_destname;
  }


  function HandleUploadedFile($name,$destfilename='',$subfield = false)
  {
    $fldname = $this->_prefix.$name;
    if( !isset($this->_files) || !isset($this->_files[$fldname]) )
      {
	$this->_error = CGFILEUPLOAD_NOFILE;
	return false;
      }

    $file = '';
    if( empty($subfield) )
      {
	if( !is_array($this->_files[$fldname]) || !isset($this->_files[$fldname]['name']) ||
	empty($this->_files[$fldname]['name']) )
	  {
	    // there's nothing to handle
	    $this->_error = CGFILEUPLOAD_NOFILE;
	    return false;
	  }
	else
	  {
	    $file = $this->_files[$fldname];
	  }
      }
    else
      {
	// the files are an array, so each element is an array
	// we gotta build $file from the $_FILES one step at a time
	$tmp = array();
	foreach( $this->_files[$fldname] as $key => $value )
	  {
	    if( isset($value[$subfield]) )
	      {
		$tmp[$key] = $value[$subfield];
	      }
	  }
	$file = $tmp;

	if( !is_array($file) || 
	    !isset($file['name']) || 
	    empty($file['name']) )
	  {
	    $this->_error = CGFILEUPLOAD_NOFILE;
	    return false;
	  }
      }

    // Normalize the file variables
    if (!isset ($file['type']))
      $file['type'] = '';
    if (!isset ($file['size']))
      $file['size'] = '';
    if (!isset ($file['tmp_name']))
      $file['tmp_name'] = '';
    $file['name'] =
      preg_replace('/[^a-zA-Z0-9\.\$\%\'\`\-\@\{\}\~\!\#\(\)\&\_\^]/', '',
		   str_replace(array(' ', '%20'),array ('_', '_'),$file['name']));

    // Check the file size
    if( ($this->_maxfilesize > 0) && 
	($file['size'] > $this->_maxfilesize) )
      {
	$this->_error = CGFILEUPLOAD_FILESIZE;
	return false;
      }

    // Check the file extension
    if( is_array($this->_filetypes) && count($this->_filetypes) )
      {
	$extension = strrchr($file['name'],".");
	$found = false;
	foreach( $this->_filetypes as $type )
	  {
	    if( ".".strtolower($type) == strtolower($extension) )
	      {
		$found = true;
		break;
	      }
	  }
	if( count($this->_filetypes) && $found === false )
	  {
	    $this->_error = CGFILEUPLOAD_FILETYPE;
	    return false;
	  }
      }

    // check the destination directory
    if( !is_dir($this->_destdir) )
      {
	$this->_error = CGFILEUPLOAD_BADDESTDIR;
	return false;
      }

    if( !is_writable($this->_destdir) )
      {
	$this->_error = CGFILEUPLOAD_BADPERMS;
	return false;
      }

    $tmp = substr($file['name'],0,strlen($file['name'])-strlen($extension)-1);
    $newname = $file['name'];
    if( !empty($destfilename) )
      {
	$newname = $destfilename.$extension;
      }
    $destname = cms_join_path($this->_destdir,$newname);
    if( file_exists($destname) )
      {
	if( !$this->_allow_overwrite )
	  {
	    $this->_error = CGFILEUPLOAD_FILEEXISTS;
	    return false;
	  }
	else if( !is_writable($destname) )
	  {
	    $this->_error = CGFILEUPLOAD_BADPERMS;
	    return false;
	  }
      }

    // And Attempt the copy
    $this->_destname = $destname;
    $res = cms_move_uploaded_file( $file['tmp_name'], $destname );
    if( !$res )
      {
	$this->_error = CGFILEUPLOAD_MOVEFAILED;
	return false;
      }

    return $newname;
  }

  function SetFiles(&$newfiles)
  {
    $this->_files = $newfiles;
  }

} // end of class

#
# EOF
#
?>