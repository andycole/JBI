<?php
$lang['CGFILEUPLOAD_NOFILE'] = 'No file uploaded matching the specifications';
$lang['CGFILEUPLOAD_FILESIZE'] = 'Siirrett&auml;v&auml;n tiedoston koko yritt&auml;&auml; sallitun maksimiarvon';
$lang['CGFILEUPLOAD_FILETYPE'] = 'T&auml;t&auml; tyyppi&auml; olevia tiedostoja ei voi siirt&auml;&auml;';
$lang['CGFILEUPLOAD_FILEEXISTS'] = 'Samanniminen tiedosto on jo olemassa';
$lang['CGFILEUPLOAD_BADDESTDIR'] = 'Siirrett&auml;ville tiedostoille m&auml;&auml;ritetty&auml; kohdehakemistoa ei ole olemassa';
$lang['CGFILEUPLOAD_BADPERMS'] = 'Kohdehakemiston tiedosto-oikeudet est&auml;v&auml;t siirretyn tiedoston tallentamisen';
$lang['CGFILEUPLOAD_MOVEFAILED'] = 'Yritys siirt&auml;&auml; tiedosto lopulliseen kohdehakemistoon ep&auml;onnistui.';
$lang['thumbnail_size'] = 'Pienoiskuvien koko';
$lang['image_extensions'] = 'Kuvatiedostojen tiedostop&auml;&auml;tteet';
$lang['group'] = 'Ryhm&auml;';
$lang['template'] = 'Pohja';
$lang['select_one'] = 'Valitse yksi';
$lang['priority_countries'] = 'Priority Countries';
$lang['prompt_edittemplate'] = 'Muokkaa pohjaa';
$lang['prompt_deletetemplate'] = 'Poista pohja';
$lang['prompt_templatename'] = 'Pohjan nimi';
$lang['prompt_template'] = 'Pohjan koodi';
$lang['prompt_name'] = 'Pohjan nimi';
$lang['prompt_newtemplate'] = 'Uusi pohja';
$lang['prompt_default'] = 'Oletus';
$lang['yes'] = 'Kyll&auml;';
$lang['no'] = 'Ei';
$lang['submit'] = 'L&auml;het&auml;';
$lang['apply'] = 'Ota k&auml;ytt&ouml;&ouml;n';
$lang['cancel'] = 'Peru';
$lang['edit'] = 'Muokkaa';
$lang['areyousure'] = 'Oletko varma?';
$lang['resettofactory'] = 'Nollaa oletus pohjaksi';
$lang['error_template'] = 'Virhe pohja';
$lang['error_templatenameexists'] = 'Samalla nimell&auml; on jo olemassa pohja';
$lang['friendlyname'] = 'Calguys Module Extensions';
$lang['postinstall'] = 'Moduli on valmis k&auml;ytett&auml;v&auml;ksi.';
$lang['postuninstall'] = 'N&auml;hd&auml;&auml;n taas';
$lang['uninstalled'] = 'Moduuli poistettu';
$lang['installed'] = 'Moduulin versio %s asennettu.';
$lang['prefsupdated'] = 'Modulin asetukset p&auml;ivitetty.';
$lang['accessdenied'] = 'K&auml;ytt&ouml;oikeusvirhe! Tarkista oikeutesi.';
$lang['error'] = 'Virhe!';
$lang['upgraded'] = 'Moduuli p&auml;ivitetty versioon %s.';
$lang['moddescription'] = 'T&auml;m&auml; moduli on php-koodikirjasto edistynytt&auml; lomakkeiden rakentamista varten';
$lang['changelog'] = '<ul>
<li>Version 1.0.0. March 2007.  Initial Release.</li>
<li>Version 1.0.1. April 2007.  Fixes to CreateImageLink</li>
<li>Version 1.0.2. April 2007.  CreateImageLink will now work on the frontend.</li>
<li>Version 1.0.3. September 2007.  Adds apply buttons to new templates.</li>
<li>Version 1.1.   September 2007.  Adds default frontend error handling plugin.</li>
</ul>';
$lang['help'] = '<h3>What Does This Do?</h3>
<p>This module merely provides convenience api&#039;s and smarty tags for use in other modules.  It is meant solely as a base class and utility class for other modules.</p>
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
<li>For the latest version of this module, FAQs, or to file a Bug Report or buy commercial support, please visit the cms development forge at <a href=&quot;http://dev.cmsmadesimple.org&quot;>dev.cmsmadesimple.org</a>.</li>
<li>Additional discussion of this module may also be found in the <a href=&quot;http://forum.cmsmadesimple.org&quot;>CMS Made Simple Forums</a>.</li>
<li>The author(s), calguy et all can often be found in the <a href=&quot;irc://irc.freenode.net/#cms&quot;>CMS IRC Channel</a>.</li>
<li>Lastly, you may have some success emailing the author(s) directly.</li>  
</ul>
<p>As per the GPL, this software is provided as-is. Please read the text
of the license for the full disclaimer.</p>

<h3>Copyright and License</h3>
<p>Copyright &copy; 2007, Robert Campbell <a href=&quot;mailto:calguy1000@hotmail.com&quot;><calguy1000@hotmail.com></a>. All Rights Are Reserved.</p>
<p>This module has been released under the <a href=&quot;http://www.gnu.org/licenses/licenses.html#GPL&quot;>GNU Public License</a>. You must agree to this license before using the module.</p>
';
$lang['utma'] = '156861353.1959547193.1213865783.1214291689.1214296543.21';
$lang['utmz'] = '156861353.1214056345.10.4.utmccn=(referral)|utmcsr=dev.cmsmadesimple.org|utmcct=/forum/forum.php|utmcmd=referral';
$lang['utmc'] = '156861353';
?>