{foreach from=$categorylist item='obj'}
  <div class="CompanyDirectoryCategory">
  {if isset($obj->count) && $obj->count gt 0}
    <a href="{$obj->summary_url}">{$obj->name}</a>({$obj->count})
  {else}
    {$obj->name} (0)
  {/if}
  </div>
{/foreach}