<h3>{$mod->Lang('importcsv')}</h3>

{$formstart}
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_delimeter')}</p>
  <p class="pageinput">
   <input type="text" name="{$actionid}delimeter" value="{$mod->GetPreference('import_delimeter')}" size="4" maxlength="4"/>
  </p>
</div>

<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_check_duplicates')}</p>
  <p class="pageinput">
    <select name="{$actionid}check_duplicates">
      {html_options options=$yesnoopts selected=$mod->GetPreference('import_checkduplicates')}
    </select>
  </p>
</div>

<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_import_fielddefs')}</p>
  <p class="pageinput">
    <select name="{$actionid}do_fielddefs">
      {html_options options=$yesnoopts selected=$mod->GetPreference('import_fielddefs')}
    </select>
  </p>
</div>

<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_import_fieldvals')}</p>
  <p class="pageinput">
    <select name="{$actionid}do_fieldvals">
      {html_options options=$yesnoopts selected=$mod->GetPreference('import_fieldvals')}
    </select>
  </p>
</div>

<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_import_categorydefs')}</p>
  <p class="pageinput">
    <select name="{$actionid}do_categorydefs">
      {html_options options=$yesnoopts selected=$mod->GetPreference('import_categorydefs')}
    </select>
  </p>
</div>

<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_import_categoryvals')}</p>
  <p class="pageinput">
    <select name="{$actionid}do_categoryvals">
      {html_options options=$yesnoopts selected=$mod->GetPreference('import_categoryvals')}
    </select>
  </p>
</div>

{if $can_lookup}
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_import_lookuplatlong')}</p>
  <p class="pageinput">
    <select name="{$actionid}do_lookup">
      {html_options options=$yesnoopts selected=$mod->GetPreference('import_lookuplatlong')}
    </select>
  </p>
</div>
{/if}

<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_import_csvfile')}</p>
  <p class="pageinput">
    <input type="file" name="{$actionid}csvfile" size="40"/>
  </p>
</div>


<div class="pageoverflow">
  <p class="pagetext">&nbsp;</p>
  <p class="pageinput">
   <input type="submit" name="{$actionid}submit" value="{$mod->Lang('submit')}"/>
   <input type="submit" name="{$actionid}cancel" value="{$mod->Lang('cancel')}"/>
  </p>
</div>
{$formend}