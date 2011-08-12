{* admin panel template *}
<fieldset>
<legend>{$prompt_template}</legend>
<div class="pageoverflow">
  <p class="pagetext">{$prompt_template}:</p>
  <p class="pageinput">{$input_template}</p>
</div>
<div class="pageoverflow">
  <p class="pagetext">&nbsp;</p>
  <p class="pageinput">{$submit_template}&nbsp;{$reset}</p>
</div>
</fieldset>

<div class="pageoverflow">
  <p class="pagetext">{$prompt_imageextensions}:</p>
  <p class="pageinput">{$input_imageextensions}</p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$prompt_prioritycountries}:</p>
  <p class="pageinput">{$input_prioritycountries}</p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('thumbnail_size')}:</p>
  <p class="pageinput">{$input_thumbnailsize}</p>
</div>
<div class="pageoverflow">
  <p class="pagetext">&nbsp;</p>
  <p class="pageinput">{$submit}</p>
</div>
