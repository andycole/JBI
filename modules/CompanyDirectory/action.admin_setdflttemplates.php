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

if( !isset($gCms) ) exit();
if( !$this->CheckPermission('Modify Templates') )
  {
    exit();
  }

if( isset( $params['submit_summarytemplate'] ) )
  {
    $this->SetPreference(COMPANYDIR_PREF_NEWSUMMARY_TEMPLATE,
                         trim($params['input_summarytemplate']));
  }
else if( isset( $params['reset_summarytemplate'] ) )
  {
    $fn = dirname(__FILE__).DIRECTORY_SEPARATOR.
      'templates'.DIRECTORY_SEPARATOR.'orig_summary_template.tpl';
    if( file_exists( $fn ) )
      {
        $template = @file_get_contents($fn);
        $this->SetPreference(COMPANYDIR_PREF_NEWSUMMARY_TEMPLATE,$template);
      }
  }

if( isset( $params['submit_detailtemplate'] ) )
  {
    $this->SetPreference(COMPANYDIR_PREF_NEWDETAIL_TEMPLATE,
                         trim($params['input_detailtemplate']));
  }
else if( isset( $params['reset_detailtemplate'] ) )
  {
    $fn = dirname(__FILE__).DIRECTORY_SEPARATOR.
      'templates'.DIRECTORY_SEPARATOR.'orig_detail_template.tpl';
    if( file_exists( $fn ) )
      {
        $template = @file_get_contents($fn);
        $this->SetPreference(COMPANYDIR_PREF_NEWDETAIL_TEMPLATE,$template);
      }
  }

if( isset( $params['submit_categorylisttemplate'] ) )
  {
    $this->SetPreference(COMPANYDIR_PREF_NEWCATEGORYLIST_TEMPLATE,
                         trim($params['input_categorylisttemplate']));
  }
else if( isset( $params['reset_categorylisttemplate'] ) )
  {
    $fn = dirname(__FILE__).DIRECTORY_SEPARATOR.
      'templates'.DIRECTORY_SEPARATOR.'orig_categorylist_template.tpl';
    if( file_exists( $fn ) )
      {
        $template = @file_get_contents($fn);
        $this->SetPreference(COMPANYDIR_PREF_NEWCATEGORYLIST_TEMPLATE,$template);
      }
  }

if( isset( $params['submit_searchformtemplate'] ) )
  {
    $this->SetPreference(COMPANYDIR_PREF_NEWSEARCHFORM_TEMPLATE,
                         trim($params['input_searchformtemplate']));
  }
else if( isset( $params['reset_searchformtemplate'] ) )
  {
    $fn = dirname(__FILE__).DIRECTORY_SEPARATOR.
      'templates'.DIRECTORY_SEPARATOR.'orig_searchform_template.tpl';
    if( file_exists( $fn ) )
      {
        $template = @file_get_contents($fn);
        $this->SetPreference(COMPANYDIR_PREF_NEWSEARCHFORM_TEMPLATE,$template);
      }
  }

if( isset( $params['submit_frontendformtemplate'] ) )
  {
    $this->SetPreference(COMPANYDIR_PREF_NEWFRONTENDFORM_TEMPLATE,
                         trim($params['input_frontendformtemplate']));
  }
else if( isset( $params['reset_frontendformtemplate'] ) )
  {
    $fn = dirname(__FILE__).DIRECTORY_SEPARATOR.
      'templates'.DIRECTORY_SEPARATOR.'orig_frontendform_template.tpl';
    if( file_exists( $fn ) )
      {
        $template = @file_get_contents($fn);
        $this->SetPreference(COMPANYDIR_PREF_NEWFRONTENDFORM_TEMPLATE,$template);
      }
  }

$this->Redirect($id,'defaultadmin',$returnid,array('active_tab'=>'default_templates'));
// EOF
?>