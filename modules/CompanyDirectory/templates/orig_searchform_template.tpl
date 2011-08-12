{* search form template *}
{* valid fields are:
   {$actionid}cd_submit - (string) for a submit button
   {$actionid}cd_cancel - (string) for a cancel button
   {$actionid}cd_country - (string) for a postal code (valid only if the Postcodes module is installed) (use two letter country code)
      (default = US)
   {$actionid}cd_postal - (string) for a postal code (valid only if the Postcodes module is installed)   
      (default = EMPTY)
   {$actionid}cd_radius - (int) for a distance search (valid only if the Postcodes module is installed)   
      (default = 50)
   {$actionid}cd_units  - (string) for a distance search (valid only if the Postcodes module is installed) ("km" or "miles")
      (default = miles)
   {$actionid}cd_name   - (string) for a company name
      (default = EMPTY)
   {$actionid}cd_name_type - (string) controls how the name is used ("exact" or "like")
      (default = exact)
   {$actionid}cd_use_categories[] - (array of integers) to filter on categories.  Use the {$categories} array to build checkboxes.
      (default = EMPTY)
   {$actionid}cd_inline - (int) to specify that the detail links on results should be created inline 
      (default = 0)
*}

<div id="cd_searchform">
{$formstart}

<div class="row">
  <p class="col30">{$mod->Lang('postal_code')}</p>
  <p class="col70">
    <input type="text" name="{$actionid}cd_postal" size="20" maxlength="20"/>
    {* you could also use the {$input_country} variable to display a country dropdown *}
    <input type="hidden" name="{$actionid}cd_country" value="US"/>
  </p>
</div>

<div class="row">
  <p class="col30">{$mod->Lang('radius')}</p>
  <p class="col70">
    <select name="{$actionid}cd_radius">
      <option value="10">10</option>
      <option value="25">25</option>
      <option value="50">50</option>
      <option value="100">100</option>
    </select>
    <input type="hidden" name="{$actionid}cd_units" value="miles"/>
  </p>
</div>

{if isset($categories)}
<div class="row">
  <p class="col30">{$mod->Lang('categories')}</p>
  <p class="col70">
    {capture assign='tmp'}{$actionid}cd_use_categories{/capture}
    {html_checkboxes name=$tmp options=$categories separator='<br/>'}
  </p>
</div>
{/if}

<div class="row">
  <p class="col30"></p>
  <p class="col70">
    <input type="submit" name="{$actionid}cd_submit" value="{$mod->Lang('submit')}"/>
  </p>
</div>
{$formend}
</div>