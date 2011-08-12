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

function cge_setup_watermarking(&$mod,&$obj)
{
   $txt = $mod->GetPreference('watermark_text');
   $img = $mod->GetPreference('watermark_file');
   if( !empty($img) )
     {
       global $gCms;
       $config =& $gCms->GetConfig();
       $obj->SetWatermarkImage($config['uploads_path'].'/'.$img);
     }
   else if( !empty($txt) )
     {
       $obj->SetWatermarkText($txt);
       $font = $mod->GetPreference('watermark_font');
       $fontpath = cms_join_path(dirname(__FILE__),'fonts',$font);
       $obj->SetFont($fontpath);
       $obj->SetTextSize($mod->GetPreference('watermark_textsize'));
       $obj->SetTextAngle($mod->GetPreference('watermark_textangle'));
       $tmp = $mod->GetPreference('watermark_textcolor');
       $r = hexdec(substr($tmp,1,2)); $g = hexdec(substr($tmp,3,2)); $b = hexdec(substr($tmp,5,2));
       $obj->SetTextColor($r,$g,$b);
       $tmp = $mod->GetPreference('watermark_bgcolor');
       $r = hexdec(substr($tmp,1,2)); $g = hexdec(substr($tmp,3,2)); $b = hexdec(substr($tmp,5,2));
       $obj->SetBackgroundColor($r,$g,$b,$mod->GetPreference('watermark_transparent',1));
     }

   $obj->SetAlignment($mod->GetPreference('watermark_alignment'));
   $obj->SetTranslucency($mod->GetPreference('watermark_translucency',100));
}

function cge_WatermarkImage(&$mod,$srcfile,$destfile)
{
  $obj =& CGExtensions::get_watermark_obj();
  echo "DEBUG3: ".$obj->_text."<br/>";
  return $obj->CreateWatermarkedImage($srcfile,$destfile);
}

#
# EOF
#
?>
