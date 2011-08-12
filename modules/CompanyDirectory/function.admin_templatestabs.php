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

if( $this->CheckPermission( 'Modify Templates' ) )
{
  echo $this->StartTab('summary_template', $params);
  {
    echo $this->ShowTemplateList($id,$returnid,'summary_',
				 COMPANYDIR_PREF_NEWSUMMARY_TEMPLATE,
				 'summary_template',
				 COMPANYDIR_PREF_DFLTSUMMARY_TEMPLATE,
				 $this->Lang('summarytemplate_addedit'));
  }
  echo $this->EndTab();
	

  echo $this->StartTab('detail_template', $params);
  {
    echo $this->ShowTemplateList($id,$returnid,'detail_',
				 COMPANYDIR_PREF_NEWDETAIL_TEMPLATE,
				 'detail_template',
				 COMPANYDIR_PREF_DFLTDETAIL_TEMPLATE,
				 $this->Lang('detailtemplate_addedit'));
  }
  echo $this->EndTab();


  echo $this->StartTab('categorylist_template', $params);
  {
    echo $this->ShowTemplateList($id,$returnid,'categorylist_',
				 COMPANYDIR_PREF_NEWCATEGORYLIST_TEMPLATE,
				 'categorylist_template',
				 COMPANYDIR_PREF_DFLTCATEGORYLIST_TEMPLATE,
				 $this->Lang('categorylisttemplate_addedit'));
  }
  echo $this->EndTab();


  echo $this->StartTab('searchform_template', $params);
  {
    echo $this->ShowTemplateList($id,$returnid,'searchform_',
				 COMPANYDIR_PREF_NEWSEARCHFORM_TEMPLATE,
				 'searchform_template',
				 COMPANYDIR_PREF_DFLTSEARCHFORM_TEMPLATE,
				 $this->Lang('searchformtemplate_addedit'));
  }
  echo $this->EndTab();


  echo $this->StartTab('frontendform_template', $params);
  {
    echo $this->ShowTemplateList($id,$returnid,'frontendform_',
				 COMPANYDIR_PREF_NEWFRONTENDFORM_TEMPLATE,
				 'frontendform_template',
				 COMPANYDIR_PREF_DFLTFRONTENDFORM_TEMPLATE,
				 $this->Lang('frontendformtemplate_addedit'));
  }
  echo $this->EndTab();

    
  echo $this->StartTab('default_templates');
  {
    $input_summarytemplate =
      $this->GetPreference(COMPANYDIR_PREF_NEWSUMMARY_TEMPLATE);
    $input_detailtemplate =
      $this->GetPreference(COMPANYDIR_PREF_NEWDETAIL_TEMPLATE);
    $input_categorylisttemplate =
      $this->GetPreference(COMPANYDIR_PREF_NEWCATEGORYLIST_TEMPLATE);
    $input_searchformtemplate =
      $this->GetPreference(COMPANYDIR_PREF_NEWSEARCHFORM_TEMPLATE);
    $input_frontendformtemplate =
      $this->GetPreference(COMPANYDIR_PREF_NEWFRONTENDFORM_TEMPLATE);

    $smarty->assign('info_dflt_template',
		    $this->Lang('default_template_notice'));

    $smarty->assign('formstart',
		    $this->CreateFormStart($id,'admin_setdflttemplates',
					   $returnid));
    $smarty->assign('formend',
		    $this->CreateFormEnd());

    $smarty->assign('legend_summarytemplate',
		    $this->Lang('title_summary_dflttemplate'));
    $smarty->assign('prompt_summarytemplate',
		    $this->Lang('prompt_template'));
    $smarty->assign('input_summarytemplate',
		    $this->CreateTextArea(false,$id,$input_summarytemplate,
					  'input_summarytemplate'));
    $smarty->assign('submit_summarytemplate',
		    $this->CreateInputSubmit($id,'submit_summarytemplate',
					     $this->Lang('submit')));
    $smarty->assign('reset_summarytemplate',
		    $this->CreateInputSubmit($id,'reset_summarytemplate',
					     $this->Lang('resettofactory')));

    $smarty->assign('legend_detailtemplate',
		    $this->Lang('title_detail_dflttemplate'));
    $smarty->assign('prompt_detailtemplate',
		    $this->Lang('prompt_template'));
    $smarty->assign('input_detailtemplate',
		    $this->CreateTextArea(false,$id,$input_detailtemplate,
					  'input_detailtemplate'));
    $smarty->assign('submit_detailtemplate',
		    $this->CreateInputSubmit($id,'submit_detailtemplate',
					     $this->Lang('submit')));
    $smarty->assign('reset_detailtemplate',
		    $this->CreateInputSubmit($id,'reset_detailtemplate',
					     $this->Lang('resettofactory')));
    
    $smarty->assign('legend_categorylisttemplate',
		    $this->Lang('title_categorylist_dflttemplate'));
    $smarty->assign('prompt_categorylisttemplate',
		    $this->Lang('prompt_template'));
    $smarty->assign('input_categorylisttemplate',
		    $this->CreateTextArea(false,$id,$input_categorylisttemplate,
					  'input_categorylisttemplate'));
    $smarty->assign('submit_categorylisttemplate',
		    $this->CreateInputSubmit($id,'submit_categorylisttemplate',
					     $this->Lang('submit')));
    $smarty->assign('reset_categorylisttemplate',
		    $this->CreateInputSubmit($id,'reset_categorylisttemplate',
					     $this->Lang('resettofactory')));

    $smarty->assign('legend_searchformtemplate',
		    $this->Lang('title_searchform_dflttemplate'));
    $smarty->assign('prompt_searchformtemplate',
		    $this->Lang('prompt_template'));
    $smarty->assign('input_searchformtemplate',
		    $this->CreateTextArea(false,$id,$input_searchformtemplate,
					  'input_searchformtemplate'));
    $smarty->assign('submit_searchformtemplate',
		    $this->CreateInputSubmit($id,'submit_searchformtemplate',
					     $this->Lang('submit')));
    $smarty->assign('reset_searchformtemplate',
		    $this->CreateInputSubmit($id,'reset_searchformtemplate',
					     $this->Lang('resettofactory')));
    
    $smarty->assign('legend_frontendformtemplate',
		    $this->Lang('title_frontendform_dflttemplate'));
    $smarty->assign('prompt_frontendformtemplate',
		    $this->Lang('prompt_template'));
    $smarty->assign('input_frontendformtemplate',
		    $this->CreateTextArea(false,$id,$input_frontendformtemplate,
					  'input_frontendformtemplate'));
    $smarty->assign('submit_frontendformtemplate',
		    $this->CreateInputSubmit($id,'submit_frontendformtemplate',
					     $this->Lang('submit')));
    $smarty->assign('reset_frontendformtemplate',
		    $this->CreateInputSubmit($id,'reset_frontendformtemplate',
					     $this->Lang('resettofactory')));
    
    echo $this->ProcessTemplate('dflt_templates.tpl');
  }
  echo $this->EndTab();

}

// EOF
?>