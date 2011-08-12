{if isset($catformstart)}
{$catformstart}
{$catdropdown}{$catbutton}
{$catformend}
{/if}

{if isset($messages)}
<div class="CompanyDirectoryMessage">
 <ul>
   {foreach from=$messages item='one'}
     <li>{$one}</li>
   {/foreach}
 </ul>
</div>
{/if}

{if isset($errors)}
<div class="CompanyDirectoryError">
 <ul>
   {foreach from=$errors item='one'}
     <li>{$one}</li>
   {/foreach}
 </ul>
</div>
{/if}

{if isset($items)}
  <div>
  {$firstlink}&nbsp;{$prevlink}&nbsp;&nbsp;{$pagetext} {$curpage} {$oftext} {$pagecount}&nbsp;&nbsp;{$nextlink}&nbsp;{$lastlink}
  </div>

  {foreach from=$items item=entry}
  <div class="CompanyDirectoryItem">
  Name: <a href="{$entry->detail_url}">{$entry->company_name}</a><br />

  {if $entry->address ne ''}
  Address: {$entry->address}<br />
  {/if}

  {if $entry->website ne ''}
  Website: <a href="{$entry->website}">{$entry->website}</a>
  {/if}

  </div>
  {/foreach}
{/if}