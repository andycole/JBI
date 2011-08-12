<div class="CompanyDirectoryItem">

Name: {$entry->company_name}<br />

{if $entry->address ne ''}
Address: {$entry->address}<br />
{/if}

{if $entry->telephone ne ''}
Telephone: {$entry->telephone}<br />
{/if}

{if $entry->fax ne ''}
Fax: {$entry->fax}
{/if}

{if $entry->contact_email ne ''}
Contact Email: <a href="mailto:{$entry->contact_email}">{$entry->contact_email}</a><br />
{/if}

{if $entry->website ne ''}
Website: <a href="{$entry->website}">{$entry->website}</a><br />
{/if}

{if $entry->details ne ''}
Details:<br />
{$entry->details}<br />
{/if}

{if $entry->picture_location ne ''}
Picture: <img src="{$entry->picture_path}" /><br />
{/if}

{if $entry->logo_location ne ''}
Logo: <img src="{$entry->logo_path}" /><br />
{/if}

{if $customfieldscount gt 0}
	{foreach from=$customfields item=customfield}
		{$customfield->name}: {$customfield->value}<br />
	{/foreach}
{/if}

{if $categorytext ne ''}
Categories: {$categorytext}<br />
{/if}

</div>
