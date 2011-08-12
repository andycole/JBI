<?php
$lang['CGFILEUPLOAD_NOFILE'] = 'Nie załadowano kompatybilnego pliku.';
$lang['CGFILEUPLOAD_FILESIZE'] = 'Wielkość załadowanego pliku przekracza dopuszczalną wielkość';
$lang['CGFILEUPLOAD_FILETYPE'] = 'Pliki tego typu nie mogą być załadowane';
$lang['CGFILEUPLOAD_FILEEXISTS'] = 'Plik z taką samą nazwą już istnieje';
$lang['CGFILEUPLOAD_BADDESTDIR'] = 'Katalog docelowy dla ładowanego pliku nie istnieje';
$lang['CGFILEUPLOAD_BADPERMS'] = 'U[rawnienia pliku nie pozwalają na zapis w docelowej lokalizacji';
$lang['CGFILEUPLOAD_MOVEFAILED'] = 'Przeniesienie pliku do docelowej lokalizacji nie powiodło się';
$lang['thumbnail_size'] = 'Rozmiar miniatur';
$lang['image_extensions'] = 'Rozszerzenie plik&oacute;w obrazk&oacute;w';
$lang['group'] = 'Grupa';
$lang['template'] = 'Szablon';
$lang['select_one'] = 'Wybierz jedną opcję';
$lang['priority_countries'] = 'Kreje priorytetowe';
$lang['prompt_edittemplate'] = 'Edytuj szablon';
$lang['prompt_deletetemplate'] = 'Skasuj szablon';
$lang['prompt_templatename'] = 'Nazwa szablonu';
$lang['prompt_template'] = 'Tekst szablonu';
$lang['prompt_name'] = 'Nazwa szablonu';
$lang['prompt_newtemplate'] = 'Nowy szablon';
$lang['prompt_default'] = 'Domyślny';
$lang['yes'] = 'Tak';
$lang['no'] = 'Nie';
$lang['submit'] = 'Zapisz';
$lang['apply'] = 'Zastosuj';
$lang['cancel'] = 'Anuluj';
$lang['edit'] = 'Edytuj';
$lang['areyousure'] = 'Jesteś pewny?';
$lang['resettofactory'] = 'Przywr&oacute;ć ustawienia domyślne';
$lang['error_template'] = 'Szablon błędu';
$lang['error_templatenameexists'] = 'Szablon z taką nazwą już istnieje';
$lang['friendlyname'] = 'Calguys Module Extensions';
$lang['postinstall'] = 'Ten moduł jest gotowy do użycia!';
$lang['postuninstall'] = 'Do zobaczenia wkr&oacute;tce';
$lang['uninstalled'] = 'Moduł został odinstalowany.';
$lang['installed'] = 'Moduł w wersji %s został zainstalowany.';
$lang['prefsupdated'] = 'Ustawienia modułu zostały zaktualizowane.';
$lang['accessdenied'] = 'Dostęp zabroniony. Sprawdź swoje uprawnienia.';
$lang['error'] = 'Błąd!';
$lang['upgraded'] = 'Moduł został zaktualizowany do wersji %s.';
$lang['moddescription'] = 'Ten moduł hest biblioteką klas PHP używaną do budowy zaawansowanych formularzy';
$lang['changelog'] = '<ul>
<li>Version 1.0.0. March 2007.  Initial Release.</li>
<li>Version 1.0.1. April 2007.  Fixes to CreateImageLink</li>
<li>Version 1.0.2. April 2007.  CreateImageLink will now work on the frontend.</li>
<li>Version 1.0.3. September 2007.  Adds apply buttons to new templates.</li>
<li>Version 1.1.   September 2007.  Adds default frontend error handling plugin.</li>
<li>Version 1.2.   November  2007,  Adds more convenience functions</li>
<li>Version 1.3.   November  2007.  Adds even more convenience functions</li>
<li>Version 1.4.   December  2007.  Adds CreateImageDropdown method, methods for state and country dropdowns and a bunch of other things.</li>
<li>Version 1.5.   January   2008.  Fixes to html_entities_decode in utf8</li>
<li>Version 1.6.   February  2008,  Adds the CGFileUploadHandler class</li>
<li>Version 1.6.1.   February  2008,  Minor fix to recursive_change_directory</li>
<li>Version 1.8. February 2008
  <ul>
    <li>Add a bunch more utility and convenience methods</li>
    <li>Move countries and states into a table so that they can be used with joins etc.</li>
    <li>Add the ability to prioritize certain countries by name</li>
    <li>Adds the GetSingleTemplateForm method to make it convenient to edit and restore to default a single template.</li>
    <li>Fixes issues with the cancel button when editing templates.</li>
    <li>Update the license.</li>
    <li>Updates to the file upload capabilities</li>
    <li>The module is automatically exported to smarty</li>
    <li>Add the get_action_id and set_action_id virtual methods that should be overridden by any module derived from CGExtensions.</li>
  </ul>
  </li>
<li>Version 1.8. May 2008
  <ul>
    <li>Minor change and addition to RedirectToTab</li>
  </ul>
</ul>';
$lang['help'] = '<h3>What Does This Do?</h3>
<p>This module merely provides convenience api&#039;s, re-usable forms, and smarty tags for use in other modules.  It is meant solely from which to build other modules. If you are not a programmer you probably won&#039;t need to do anything with this module besides adjust some preferences.</p>
<h3 style=&quot;color: #f00;&quot;>Notes</h3>
<p>Many modules take advantages of the forms that are provided by the CGExtensions module to assist in managing templates.  When they do, the CGExtensions module information is displayed prominently.  However when you submit, or cancel from these forms you will be returned to the original module.</p>
<h3>How Do I Use It</h3>
<p>Well, you start your own module (I suggest starting with the Skeleton module), and then when you need to use an advanced form object from this library, simply make your module dependant upon FormObjects, and then instantiate an object of the appropriate type.  See the code inside the FormObjects directory for usage instructions.</p>
<h3>Smarty Addons</h3>
<p>This module adds a few smarty conveniences for use with other modules. They are listed and described here:</p>
<ul>
<li>cgerror - <em>block</em> plugin
<p>i.e: <code>{cgerror}This is error text{/cgerror}</code><br/>
    or: <code>{cgerror}{$errortextvar}{/cgerror}</br>
</p>
<p>optional parameters: &#039;errorclass&#039; = override the default class name in the template.
</p>
<p>Description: This block plugin uses the error template (configurable from the CGExtensions admin interface) to display an error message.</p>
</ul>
<h3>Support</h3>
<p>This module does not include commercial support. However, there are a number of resources available to help you with it:</p>
<ul>
<li>For the latest version of this module, FAQs, or to file a Bug Report or buy commercial support, please visit the cms development forge at <a href="http://dev.cmsmadesimple.org">dev.cmsmadesimple.org</a>.</li>
<li>Additional discussion of this module may also be found in the <a href="http://forum.cmsmadesimple.org">CMS Made Simple Forums</a>.</li>
<li>The author(s), calguy et all can often be found in the <a href="irc://irc.freenode.net/#cms">CMS IRC Channel</a>.</li>
<li>Lastly, you may have some success emailing the author(s) directly.</li>  
</ul>
<p>As per the GPL, this software is provided as-is. Please read the text
of the license for the full disclaimer.</p>

<h3>Copyright and License</h3>
<p>Copyright &copy; 2008, Robert Campbel <a href="mailto:calguy1000@cmsmadesimple.org"><calguy1000@cmsmadesimple.org></a>. All Rights Are Reserved.</p>
<p>This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.</p>
<p>However, as a special exception to the GPL, this software is distributed
as an addon module to CMS Made Simple.  You may not use this software
in any Non GPL version of CMS Made simple, or in any version of CMS
Made simple that does not indicate clearly and obviously in its admin 
section that the site was built with CMS Made simple.</p>
<p>This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
Or read it <a href="http://www.gnu.org/licenses/licenses.html#GPL">online</a></p>
';
$lang['utma'] = '156861353.2359145497878676500.1213200278.1219266170.1219268858.94';
$lang['utmz'] = '156861353.1219266170.93.18.utmccn=(referral)|utmcsr=dev.cmsmadesimple.org|utmcct=/softwaremap/trove_list.php|utmcmd=referral';
$lang['utmb'] = '156861353.4.10.1219268858';
$lang['utmc'] = '156861353';
?>