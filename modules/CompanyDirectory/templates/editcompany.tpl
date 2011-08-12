{*
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
*}

<script type="text/javascript">
var actionid = '{$actionid}';
var ajaxurl  = '{module_action_link module='CGGoogleMaps' action='getgeocode' urlonly=1}' + '&suppressoutput=false';
{literal}
function geocode_lookup()
{
  if( typeof jQuery == 'undefined') 
  {
    return false;
  }

  // 1.  Get the address
  var $tmp = document.getElementsByName(actionid+'address');
  var $address = $tmp[0].value;

  // 2.  do the ajax request
  var url = ajaxurl.replace(/amp;/g,'');
  var lat = 0;
  var long = 0;
  jQuery.post(url, 'm1_address='+$address,
	function(data) { 
          if( data.status == 'success' ) {
            lat = data.lat; long=data.lon;
         
            var latfield = document.getElementsByName(actionid+'latitude')[0];
            var longfield = document.getElementsByName(actionid+'longitude')[0];	
	    latfield.value = lat;
	    longfield.value = long;
          }
	}, "json" );

  // 3.  parse the result
  // 4.  populate fields.

  return false;
}

{/literal}
</script>

{$startform}
{if isset($compid)}
	<div class="pageoverflow">
		<p class="pagetext">{$idtext}:</p>
		<p class="pageinput">{$compid}</p>
	</div>
{/if}
	<div class="pageoverflow">
		<p class="pagetext">*{$nametext}:</p>
		<p class="pageinput">{$inputname}</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext">{$addresstext}:</p>
		<p class="pageinput">{$inputaddress}&nbsp;
                  {if isset($can_geocode)}
                  <input type="submit" name="{$actionid}lookup" value="{$mod->Lang('lookup')}" onclick="geocode_lookup(); return false;"/>
                  {/if}
                </p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext">{$mod->Lang('latitude')}:</p>
		<p class="pageinput">{$inputlatitude}</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext">{$mod->Lang('longitude')}:</p>
		<p class="pageinput">{$inputlongitude}</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext">{$telephonetext}:</p>
		<p class="pageinput">{$inputtelephone}</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext">{$faxtext}:</p>
		<p class="pageinput">{$inputfax}</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext">{$emailtext}:</p>
		<p class="pageinput">{$inputemail}</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext">{$websitetext}:</p>
		<p class="pageinput">{$inputwebsite}</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext">{$statustext}:</p>
		<p class="pageinput">{$inputstatus}</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext">{$detailstext}:</p>
		<p class="pageinput">{$inputdetails}</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext">{$imagetext}:</p>
		<p class="pageinput">{$imageupload} {if $imagecurrent ne ''}{$currentimagetext}: {$imagecurrent}{$imagecurrenthidden}{/if}</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext">{$logotext}:</p>
		<p class="pageinput">{$logoupload} {if $logocurrent ne ''}{$currentlogotext}: {$logocurrent}{$logocurrenthidden}{/if}</p>
	</div>
	{if $customfieldscount gt 0}
		{foreach from=$customfields item=customfield}
			<div class="pageoverflow">
				<p class="pagetext">{$customfield->name}:</p>
				<p class="pageinput">{$customfield->input_box}</p>
			</div>
		{/foreach}
	{/if}
	{if $categoriescount gt 0}
		{foreach from=$categories item=category}
			<div class="pageoverflow">
				<p class="pagetext">{$category->name}:</p>
				<p class="pageinput">{$category->checkbox}</p>
			</div>
		{/foreach}
	{/if}
	<div class="pageoverflow">
		<p class="pagetext">&nbsp;</p>
		<p class="pageinput">{$hidden}{$submit}{$cancel}</p>
	</div>
{$endform}
