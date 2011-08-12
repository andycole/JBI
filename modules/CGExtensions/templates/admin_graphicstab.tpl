<fieldset>
  <legend><strong>{$mod->Lang('watermarking')}:</strong></legend>
  <p class="pageoverflow">{$mod->Lang('info_watermarks')}</p>
  <table class="pagetable">
    <thead>
      <tr>
        <th>{$mod->Lang('text_watermarks')}</th>
        <th>{$mod->Lang('graphic_watermarks')}</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>
          <div class="pageoverflow">
            <p class="pagetext">{$mod->Lang('watermark_text')}</p>
            <p class="pageinput">{$input_text}</p>
          </div>
          <div class="pageoverflow">
            <p class="pagetext">{$mod->Lang('text_color')}</p>
            <p class="pageinput">{$input_textcolor}</p>
          </div>
          <div class="pageoverflow">
            <p class="pagetext">{$mod->Lang('background_color')}</p>
            <p class="pageinput">{$input_bgcolor}</p>
          </div>
          <div class="pageoverflow">
            <p class="pagetext">{$mod->Lang('use_transparency')}</p>
            <p class="pageinput">{$input_transparent}</p>
          </div>
          <div class="pageoverflow">
            <p class="pagetext">{$mod->Lang('font')}</p>
            <p class="pageinput">{$input_font}</p>
          </div>
          <div class="pageoverflow">
            <p class="pagetext">{$mod->Lang('font_size')}</p>
            <p class="pageinput">{$input_textsize}</p>
          </div>
          <div class="pageoverflow">
            <p class="pagetext">{$mod->Lang('text_angle')}</p>
            <p class="pageinput">{$input_textangle}</p>
          </div>
          <div class="pageoverflow">
            <p class="pagetext">{$mod->Lang('translucency')}</p>
            <p class="pageinput">{$input_translucency}</p>
          </div> 
        </td>
        <td>
          <div class="pageoverflow">
            <p class="pagetext">{$mod->Lang('image')}</p>
            <p class="pageinput">{$input_image}</p>
          </div> 
        </td>
      </tr>
    </tbody>
  </table>

  <div class="pageoverflow">
    <p class="pagetext">{$mod->Lang('watermark_alignment')}</p>
    <p class="pageinput">{$input_alignment}</p>
  </div> 

</fieldset>
<div class="pageoverflow">
  <p class="pagetext">&nbsp;</p>
  <p class="pageinput">{$input_submit}</p>
</div> 
