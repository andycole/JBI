<?php

class cgextensions_tools
{
  var $_module;

  function cgextensions_tools(&$mod)
  {
    $this->_module =& $mod;
  }

  /*
   * A Convenience function to redirect to an admin tab in the
   * defaultadmin action
   *
   * See Also:  SetCurrentTab
   */
  function RedirectToTab( $id, $tab = '', $params = '', $action = '' )
  {
    $parms = array();
    if( is_array( $params ) )
      {
	$parms = $params;
      }
    if( $tab == '' )
      {
	if( $this->_module->_current_tab )
	  {
	    $tab = $this->_module->_current_tab;
	  }
      }
    if( $tab != '' )
      {
	$parms['cg_activetab'] = $tab;
      }
    if( is_array($this->_module->_errormsg) && count($this->_module->_errormsg) )
      {
	$parms['cg_error'] = implode(':err:',$this->_module->_errormsg);
      }
    if( is_array($this->_module->_messages) && count($this->_module->_messages) )
      {
	$parms['cg_message'] = implode(':err:',$this->_module->_messages);
      }

    if( empty($action) ) $action = 'defaultadmin';
    $this->_module->Redirect( $id, $action, '', $parms, true );
  }

  function RedirectToError($returnid,$message,$error=1)
  {
    $mod =& $this->_module->GetModuleInstance('CGExtensions');
    $mod->Redirect( $id, 'showmessage', $returnid, 
		    array('cge_msg' => $message,
			  'cge_error' => (int)$error));
  }

  /*
   * A convenience function for creating an <img> tag.
   */
  function CreateImageTag($image,$alt='',$width='',$height='',$class='',$addtext='')
  {
    $txt = "<img src=\"$image\"";
    if( $alt != '' )
      {
	$txt .= " alt=\"$alt\"";
	$txt .= " title=\"$alt\"";
      }
    if( $width != '' )
      {
	$txt .= " width=\"$width\"";
      }
    if( $height != '' )
      {
	$txt .= " height=\"$height\"";
      }
    if( $class != '' )
      {
	$txt .= " class=\"$class\"";
      }
    if( $addtext != '' )
      {
	$txt .= " $addtext";
      }
    $txt .= " />";
    return $txt;
  }


  /*
   * A convenience function to search for an image in certain preset 
   * directories
   */
  function DisplayImage($image,$alt='',$class='',$width='',$height='')
  {
    global $gCms;
    $config =& $gCms->GetConfig();

    // check image_directories first
    if( isset($this->_module->_image_directories) && 
	!empty($this->_module->_image_directories))
      {
	foreach( $this->_module->_image_directories as $dir )
	  {
	    $url = cms_join_path($dir,$image);
	    $path = cms_join_path($config['root_path'],$url);

	    if( is_readable($path) )
	      {
		if( $this->_module->IsAdminAction() )
		  {
		    $url = cms_join_path('..',$url);
		  }
		return $this->_module->CreateImageTag($url,$alt,$width,$height,$class);
	      }
	  }
      }

    $theme =& $gCms->variables['admintheme'];
    if( is_object($theme) ) 
      {
	// we're in the admin
	$txt = $theme->DisplayImage($image,$alt,$width,$height,$class);
      }
    else
      {
	// frontend
	$txt = $this->CreateImageTag($image,$alt,$width,$height,$class);
      }
    return $txt;
  }


  /*
   * A convenience function for creating a link with an image
   */
  function CreateImageLink($id,$action,$returnid,$contents,$image,
			   $params=array(),$classname='',
			   $warn_message='',$imageonly=true,
			   $inline=false,
			   $addtext='',$targetcontentonly=false,$prettyurl='')
  {
    if( $classname == '' ) $classname = 'systemicon';

    $txt = $this->__CreatePrettyLink($id,$action,$returnid,
				    $this->DisplayImage($image,$contents,$classname), 
				    $params, $warn_message, false, $inline, 
				    $addtext, $targetcontentonly, $prettyurl );
    if( $imageonly !== true )
      {
	$txt .= '&nbsp;';
	$txt .= $this->_module->CreateLink
	  ($id, $action, $returnid,
	   $contents, $params, $warn_message, false, 
	   $inline, $addtext, $targetcontentonly, 
	   $prettyurl );
      }
    return $txt;
  }
  

  /*
   * An overridable function for creating a pretty link
   */
  function __CreatePrettyLink($id, $action, $returnid='', $contents='', 
			      $params=array(), $warn_message='', 
			      $onlyhref=false, $inline=false, $addtext='', 
			      $targetcontentonly=false, $prettyurl='')
  {
    global $gCms;
    $config =& $gCms->GetConfig();

    $pretty = false;
    if( $config['assume_mod_rewrite'] === true ||
	$config['internal_pretty_urls'] === true )
      {
	$pretty = true;
      }

    $method_exists = method_exists($this->_module,'CreatePrettyLink');
    if( $pretty && ($returnid != '') && $method_exists )
      {
	// pretty urls are configured, we're not in an admin action
	// and the CreatePrettyLink method has been found.
	return $this->_module->CreatePrettyLink($id,$action,$returnid,
						$contents,$params,
						$warn_message,
						$onlyhref,$inline,$addtext,
						$targetcontentonly,$prettyurl);
      }
    else
      {
	return $this->_module->CreateLink($id,$action,$returnid,$contents,$params,$warn_message,
				 $onlyhref,$inline,$addtext,$targetcontentonly,$prettyurl);
      }
  }


  function TransformImage($srcSpec, $destSpec, $size = '')
  {
    require_once(dirname(__FILE__).'/../../lib/filemanager/ImageManager/Classes/Transform.php');

    global $gCms;
    $config =& $gCms->GetConfig();
    if( $size == '' )
      {
	$cge =& $this->_module->GetModuleInstance('CGExtensions');
	$size = $cge->GetPreference('thumbnailsize');
      }

    $it = new Image_Transform;
    $img = $it->factory($config['image_manipulation_prog']);
    $img->load($srcSpec);
    if ($img->img_x < $img->img_y)
      {
	$long_axis = $img->img_y;
      }
    else
      {
	$long_axis = $img->img_x;
      }
     
    if ($long_axis > $size)
      {
	$img->scaleByLength($size);
	$img->save($destSpec, 'jpeg');
      }
    else
      {
	$img->save($destSpec, 'jpeg');
      }
    $img->free();
  }

  /*
   * Part of the multiple database template functionality,
   * This function returns a list of templates for the current module
   * that all start with the specified prefix.
   */
  function ListTemplatesWithPrefix($prefix = '',$trim = false)
  {
    $templates = $this->_module->ListTemplates();
    if( $prefix == '' ) return $templates;

    $items = array();
    foreach( $templates as $onename )
      {
	if( preg_match('/^'.$prefix.'/',$onename) )
	  {
	    if( $trim )
	      {
		$items[] = substr($onename,strlen($prefix));
	      }
	    else
	      {
		$items[] = $onename;
	      }
	  }
      }
    return $items;
  }


  /*
   * Perform an HTTP POST
   */
  function http_post($URL,$data,$referer = '')
  {
    require_once(dirname(__FILE__).'/lib/http/class.http.php');
    
    $http = new Http;
    $http->setMethod('POST');
    $http->setParams($data);
    return $http->execute($URL);
  }


  /*
   * Part of the multiple database template functionality,
   * This function generates a dropdown list to allow selecting
   * a template from the modules template list, 
   */
  function CreateTemplateDropdown($id,$name,$prefix = '',$selectedvalue = -1,
				  $addtext = '')
  {
    $templates = $this->ListTemplatesWithPrefix($prefix);
    $items = array();
    foreach( $templates as $onename )
      {
	$tmp = substr($onename,strlen($prefix));
	$items[$tmp] = $onename;
      }
    
    return $this->_module->CreateInputDropdown($id,$name,$items,-1,$selectedvalue,$addtext);
  }


  function _DisplayTemplateList( &$module, $id, $returnid, $prefix, 
				 $defaulttemplatepref, 
				 $active_tab, $defaultprefname,
				 $title, $info = '',$destaction = 'defaultadmin')
  {
    // we're gonna allow multiple templates here
    // but we're gonna prefix them all with something
    global $gCms;
    $smarty =& $gCms->GetSmarty();
    
    $falseimage1 = $gCms->variables['admintheme']->DisplayImage('icons/system/false.gif','make default','','','systemicon');
    $trueimage1 = $gCms->variables['admintheme']->DisplayImage('icons/system/true.gif','default','','','systemicon');
    $alltemplates = $module->ListTemplates();
    $rowarray = array();
    $rowclass = 'row1';

    foreach( $alltemplates as $onetemplate )
      {
	if( !preg_match("/^$prefix/", $onetemplate ) )
	  {
	    continue;
	  }
	
	$tmp = substr($onetemplate,strlen($prefix));
	$row = new StdClass();
	$row->name = $this->_module->CreateLink( $id, 'edittemplate', $returnid,
						 $tmp, array('template' => $tmp,
							     'destaction' => $destaction,
							     'cg_activetab' => $active_tab,
							     'title'=>$title,
							     'info'=>$info,
							     'prefix'=>$prefix,
							     'modname'=>$module->GetName(),
							     'moddesc'=>$module->GetFriendlyName(),
							     'mode'=>'edit'));
	$row->rowclass = $rowclass;

	$default = ($module->GetPreference($defaultprefname) == $tmp) ? true : false;
	if( $default )
	  {
	    $row->default = $trueimage1;
	  }
	else
	  {
	    $row->default = $this->_module->CreateLink( $id, 'makedefaulttemplate', $returnid,
					       $falseimage1,
					       array('template'=>$tmp,
						     'destaction'=>$destaction,
						     'defaultprefname'=>$defaultprefname,
						     'modname'=>$module->GetName(),
						     'cg_activetab' => $active_tab));
	  }

	$row->editlink = $this->_module->CreateImageLink( $id,'edittemplate',$returnid,
						 $this->_module->Lang('prompt_edittemplate'),
						 'icons/system/edit.gif',
						 array ('template' => $tmp,
							'destaction'=>$destaction,
							'cg_activetab' => $active_tab,
							'prefix'=>$prefix,
							'title'=>$title,
							'info'=>$info,
							'modname'=>$module->GetName(),
							'moddesc'=>$module->GetFriendlyName(),
							'mode'=>'edit'));
	
	if( $default )
	  {
	    $row->deletelink = '&nbsp;';
	  }
	else
	  {
	    $row->deletelink = $this->_module->CreateImageLink( $id, 'deletetemplate', $returnid,
						       $this->_module->Lang('prompt_deletetemplate'),
						       'icons/system/delete.gif',
						       array ('template' => $onetemplate,
							      'modname'=>$module->GetName(),
							      'destaction'=>$destaction,
							      'cg_activetab' => $active_tab),
						       '',
						       $this->_module->Lang('areyousure'));
	  }
	
	array_push ($rowarray, $row);
	($rowclass == "row1" ? $rowclass = "row2" : $rowclass = "row1");
      }
    
    $smarty->assign('parent_module_name',$module->GetFriendlyName());
    $smarty->assign('items', $rowarray );
    $smarty->assign('nameprompt', $this->_module->Lang('prompt_name'));
    $smarty->assign('defaultprompt', $this->_module->Lang('prompt_default'));
    $smarty->assign('newtemplatelink',
			  $this->_module->CreateImageLink( $id, 'edittemplate', $returnid,
						  $this->_module->Lang('prompt_newtemplate'),
						  'icons/system/newobject.gif',
						  array('prefix' => $prefix,
							'destaction' => $destaction,
							'cg_activetab' => $active_tab,
							'modname' => $module->GetName(),
							'moddesc'=>$module->GetFriendlyName(),
							'title'=>$title,
							'info'=>$info,
							'mode' => 'add',
							'defaulttemplatepref' => $defaulttemplatepref
							),'','',false));
    $smarty->assign($this->_module->CreateFormEnd());
    return $this->_module->ProcessTemplate('listtemplates.tpl');
  }
}

?>
