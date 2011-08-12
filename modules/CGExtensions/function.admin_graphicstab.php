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

if (!isset($gCms)) exit();

$smarty->assign('input_text',
     $this->CreateInputText($id,'watermark_text',
                $this->GetPreference('watermark_text',get_site_preference('sitename','CMSMS Site')),50,255));
$opts = array();
for( $i = 1; $i < 72; $i++ )
{
  $opts[$i] = $i;
}
$smarty->assign('input_textsize',
     $this->CreateInputDropdown($id,'watermark_textsize',$opts,-1,
          $this->GetPreference('watermark_textsize',12)));
$smarty->assign('input_textangle',
     $this->CreateInputText($id,'watermark_angle',
	   $this->GetPreference('watermark_textangle','0'),3,3));

// font list
$list = array();
$dir1 = dirname(__FILE__).'/fonts';
$list1 = $this->get_regexp_file_list($dir1,'[Tt][Tt][Ff]$');
foreach( $list1 as $one )
{
  $list[$one] = $dir1.'/'.$one;
}

// todo, make this configurable
$config =& $gCms->GetConfig();
$dir2 = $config['uploads_path'];
$list2 = $this->get_regexp_file_list($dir2,'[Tt][Tt][Ff]$');
if( !empty($list2) )
  {
  foreach( $list2 as $one )
  {
    $list[$one] = $dir2.'/'.$one;
  }
}
$smarty->assign('input_font',
		$this->CreateInputDropdown($id,'watermark_font',$list,-1,
					   $this->GetPreference('watermark_font')));

$smarty->assign('input_textcolor',
		$this->CreateColorDropdown($id,'watermark_textcolor',
					   $this->GetPreference('watermark_textcolor','#00FFFF')));
$smarty->assign('input_bgcolor',
		$this->CreateColorDropdown($id,'watermark_bgcolor',
					   $this->GetPreference('watermark_bgcolor','#FFFFFF')));
$smarty->assign('input_transparent',
		$this->CreateInputYesNoDropdown($id,'watermark_transparent',
						$this->GetPreference('watermark_transparent',1)));
$smarty->assign('input_image',
		$this->CreateFileDropdown($id,'watermark_file',
					  $this->GetPreference('watermark_file'),
                                          '',
					  'jpg,jpeg,png,gif',
                                          '1'));

$nums = array();
for( $i = 100; $i > 0; $i-- )
{
  $nums[$i] = $i;
}
$smarty->assign('input_translucency',
		$this->CreateInputDropdown($id,'watermark_translucency',
					   $nums, -1,
					   $this->GetPreference('watermark_translucency',100)));

$smarty->assign('input_submit',
		$this->CreateInputSubmit($id,'graphical_submit',$this->Lang('submit')));

CGExtensions::_load_graphics();
$aligns = array();
$aligns[$this->Lang('align_ul')] = CGWATERMARK_ALIGN_UL;
$aligns[$this->Lang('align_uc')] = CGWATERMARK_ALIGN_UC;
$aligns[$this->Lang('align_ur')] = CGWATERMARK_ALIGN_UR;
$aligns[$this->Lang('align_ml')] = CGWATERMARK_ALIGN_ML;
$aligns[$this->Lang('align_mc')] = CGWATERMARK_ALIGN_MC;
$aligns[$this->Lang('align_mr')] = CGWATERMARK_ALIGN_MR;
$aligns[$this->Lang('align_ll')] = CGWATERMARK_ALIGN_LL;
$aligns[$this->Lang('align_lc')] = CGWATERMARK_ALIGN_LC;
$aligns[$this->Lang('align_lr')] = CGWATERMARK_ALIGN_LR;
$smarty->assign('input_alignment',
		$this->CreateInputDropdown($id,'watermark_alignment',$aligns,
		   $this->GetPreference('watermark_alignment',
					CGWATERMARK_ALIGN_LL)));
echo $this->ProcessTemplate('admin_graphicstab.tpl');
#
# EOF
#
?>