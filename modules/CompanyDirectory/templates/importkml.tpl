<h3>{$mod->Lang('import_kml')}</h3>

{if isset($finished)}
<div class="pageoverflow">
  <p type="pagetext">{$mod->Lang('prompt_numimported')}</p>
  <p type="pageinput">{$imported}</p>
</div>
{if isset($errorcount)}
<div class="pageoverflow">
  <p type="pagetext">{$mod->Lang('prompt_numerrors')}</p>
  <p type="pageinput">{$errorcount}</p>
</div>
<div class="pageoverflow">
  <p type="pagetext">{$mod->Lang('prompt_errors')}</p>
  <p type="pageinput">
    {'<br/>'|explode:$errors}
  </p>
</div>
{/if}
<div class="hr"></div>
{/if}

{$formstart}
<div class="pageoverflow">
  <p type="pagetext">{$mod->Lang('prompt_kmlfile')}</p>
  <p type="pageinput">
    <input type="file" name="{$actionid}kmlfile" size="50"/>
  </p>
</div>

<div class="pageoverflow">
  <p type="pagetext">{$mod->Lang('prompt_ignore_address')}</p>
  <p type="pageinput">
    <input type="checkbox" name="{$actionid}ignore_address" value="1"/>
  </p>
</div>

{if $can_do_lookups == 1}
<div class="pageoverflow">
  <p type="pagetext">{$mod->Lang('prompt_convert_address')}</p>
  <p type="pageinput">
    <input type="checkbox" name="{$actionid}do_convert_address" value="1"/>
  </p>
</div>
{/if}

<div class="pageoverflow">
  <p type="pagetext">{$mod->Lang('prompt_duplicate_name')}</p>
  <p type="pageinput">
    <input type="checkbox" name="{$actionid}check_duplicate_name" value="1"/>
  </p>
</div>

<div class="pageoverflow">
  <p type="pagetext">{$mod->Lang('prompt_status')}</p>
  <p type="pageinput">{$inputstatus}</p>
</div>

<div class="pageoverflow">
  <p type="pagetext"></p>
  <p type="pageinput">
    <input type="submit" name="{$actionid}submit" value="{$mod->Lang('submit')}"/>
    <input type="submit" name="{$actionid}cancel" value="{$mod->Lang('cancel')}"/>
  </p>
</div>
{$formend}