<script type="text/javascript">
/*<![CDATA[*/
function onchange_fldtype(elem)
{ldelim}
  var idx = elem.selectedIndex;
  var val = elem[idx].value;
  
  var ml = document.getElementById('maxlength');
  var opts = document.getElementById('dropdown_options');
  if( val == 'textbox' )
    {ldelim}
      ml.style.display = 'block';
      opts.style.display = 'none';
    {rdelim}
  else if( val == 'dropdown' )
    {ldelim}
      ml.style.display = 'none';
      opts.style.display = 'block';
    {rdelim}
  else
    {ldelim}
      ml.style.display = 'none';
      opts.style.display = 'none';
    {rdelim}
{rdelim}

{literal}
jQuery('#fldtype').ready(function($)
{ 
  var e = document.getElementById('fldtype');
  onchange_fldtype(e);
});
{/literal}
/*]]> */
</script>

{$startform}
<div class="pageoverflow">
  <p class="pagetext">*{$nametext}:</p>
  <p class="pageinput">{$inputname}</p>
</div>

<div class="pageoverflow">
  <p class="pagetext">*{$typetext}:</p>
  <p class="pageinput">
    <select id='fldtype' name="{$actionid}type" onchange="onchange_fldtype(this);">
      {html_options options=$fieldtypes selected=$fldtype}
    </select>
  </p>
</div>

<div id="maxlength" class="pageoverflow">
	<p class="pagetext">*{$maxlengthtext}:</p>
	<p class="pageinput">{$inputmaxlength}</p>
</div>
<div id="dropdown_options" class="pageoverflow" style="display: none;">
  <p class="pagetext">*{$mod->Lang('prompt_dropdown_options')}:</p>
  <p class="pageinput">
    <textarea name="{$actionid}dropdown_options">{$dropdown_data}</textarea>
    <br/>
    {$mod->Lang('info_dropdown_options')}
  </p>
</div>
<div class="pageoverflow">
	<p class="pagetext">*{$useredittext}:</p>
	<p class="pageinput">{$input_useredit}</p>
</div>
<div class="pageoverflow">
	<p class="pagetext">*{$userviewtext}:</p>
	<p class="pageinput">{$input_userview}</p>
</div>
<div class="pageoverflow">
	<p class="pagetext">&nbsp;</p>
	<p class="pageinput">{$hidden}{$submit}{$cancel}</p>
</div>
{$endform}
