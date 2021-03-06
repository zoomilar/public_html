<?php
$lang['addprop'] = 'Sukurti naują įrašą';
$lang['friendlyname'] = 'Titulinis';
$lang['pavadinimas1'] = 'Antraštė (1 eilutė)';
$lang['pavadinimas2'] = 'Antraštė (2 eilutė)';
$lang['pavadinimas3'] = 'Antraštė (3 eilutė)';


$lang['eiliskumas'] = 'Eiliškumas';
$lang['nerodyti'] = 'Nerodyti';
$lang['pavadinimas'] = 'Pavadinimas';
$lang['paveiksliukas'] = 'Nuotrauka/paveikslas';
$lang['nuoroda'] = 'Nuoroda';
$lang['nuorodatxt'] = 'Mygtuko tekstas';

$lang['wd1'] = '752';
$lang['hg1'] = '406';
$lang['wd'] = '137';
$lang['hg'] = '55';

$lang['tekstas'] = 'Tekstas';
$lang['antraste'] = 'Antraštė';
$lang['ikona'] = 'Ikona';
$lang['imones_veikla'] = 'Įmonės veikla';
$lang['gamyba'] = 'Gamyba';
$lang['tpl_create_success'] = 'šablonas sukurtas.';
$lang['tpl_create_fail'] = 'šablonas nesukurtas. Prašome templates direktorijai nustatyti 777 leidimus.';
$lang['tpl_chmod_fail'] = 'neįmanoma nustatyti 777 leidimus šablonui.';


$lang['change'] = 'Išsaugoti ir tęsti redagavimą';
$lang['rodyti'] = 'Nerodyti';
$lang['kalba'] = 'Kalba';
$lang['kalbos'] = 'Kalbų vėliavėlės';
$lang['atsiliepimai'] = 'Atsiliepimai';
$lang['antraste2'] = 'Tekstas užvedus';
$lang['tipas'] = 'Kliento kategorija';
$lang['dideli'] = 'Didelės įmonės';
$lang['valst'] = 'Valstybinės įmonės';
$lang['visi'] = 'Visos kitos įmonės';

$lang['lt'] = 'Lietuvių';
$lang['en'] = 'Anglų';

$lang['l_a'] = "ą";
$lang['l_c'] = "č";
$lang['l_e'] = "ę";
$lang['l_e1'] = "ė";
$lang['l_i'] = "į";
$lang['l_s'] = "š";
$lang['l_u'] = "ų";
$lang['l_u1'] = "ū";
$lang['l_z'] = "ž";



$lang['postinstall'] = 'Post Install Message, e.g., Be sure to set "Use Zemelapiai" permissions to use this module!';
$lang['postuninstall'] = 'Post Uninstall Message, e.g., "Curses! Foiled Again!"';
$lang['really_uninstall'] = 'Really? You\'re sure you want to uninstall this fine module?';
$lang['uninstalled'] = 'Module Uninstalled.';
$lang['installed'] = 'Module version %s installed.';
$lang['prefsupdated'] = 'Module preferences updated.';
$lang['submit'] = 'Save';
$lang['accessdenied'] = 'Access Denied. Please check your permissions.';
$lang['error'] = 'Error!';
$lang['link_view'] = 'View Record';
$lang['edit'] = 'Edit Record';
$lang['title_num_records'] = '%s records found.';
$lang['add_record'] = 'Add a Record';
$lang['added_record'] = 'Added record.';
$lang['updated_record'] = 'Record updated.';
$lang['upgraded'] = 'Module upgraded to version %s.';
$lang['title_allow_add'] = 'Users may add records?';
$lang['title_allow_add_help'] = 'Click here to allow users to add records.';
$lang['title_description'] = 'Description';
$lang['title_mod_admin'] = 'Module Admin Panel';
$lang['event_info_OnZemelapiaiPreferenceChange'] = 'An event generated when  the preferences to the Zemelapiai Module get changed';
$lang['event_help_OnZemelapiaiPreferenceChange'] = '<p>An event generated when the preferences to the Zemelapiai Module get changed</p>
<h4>Parameters</h4>
<ul>
<li><em>allow_add</em> - The new setting of the "Allow Add" preference; boolean</li>
</ul> 
';

$lang['moddescription'] = 'This module is a Zemelapiai module that does nothing.';
$lang['welcome_text'] = '<p>Welcome to the Pedantic Zemelapiai Module admin section. Something else would probably go here if the module actually did something. Add it to your front-end pages with a {cms_module module=\'Zemelapiai\'}</p>';
$lang['changelog'] = '<ul>
<li>Version 1.5, July 2007 SjG
<ul>
   <li>Added actual database app.</li>
   <li>Made Admin tabbed for interest.</li>
   <li>Updated Minimum and Maximum CMS versions.</li>
</ul>
</li>
<li>Version 1.4, June 2006 (calguy1000). 
  <ul>
    <li>Replaced DisplayAdminNav with a single tab</li>
    <li>Replaced call to DoAction with a Redirect</li>
    <li>Changed minimum cms version to 1.0-svn</li>
  </ul>
</li>
<li>Version 1.3. June 2006 (sjg). 
  <ul>
    <li>Split out install, upgrade, and uninstall methods</li>
    <li>Added Events</li>
    <li>Added references to pretty urls and route registration</li>
    <li>corrected language file directory structure</li>
    <li>added more comments</li>
  </ul>
</li>
<li>Version 1.2. 29 December 2005. Fixes to bugs pointed out by Patrick Loschmidt. Updates to be correct for CMS Made Simple versions 0.11.x.</li>
<li>Version 1.1. 11 September 2005. Cleaned up references that caused problems for PHP 4.4.x or 5.0.5.</li>
<li>Version 1.0. 6 August 2005. Initial Release.</li></ul>';
$lang['help'] = '<h3>What Does This Do?</h3>
<p>Nothing. It\'s designed to be a starting point for you to develop your own modules.</p>
<h3>How Do I Use It</h3>
<p>Well, you could actually install it by placing the module in a page or template using the
smarty tag &#123;cms_module module=\'Zemelapiai\'}</p>
<p>You would be wiser, however, to use the module as a starting point, and editing the code to do
whatever it is you are wanting to do.</p>
<h3>Support</h3>
<p>This module does not include commercial support. However, there are a number of resources available to help you with it:</p>
<ul>
<li>For the latest version of this module, FAQs, or to file a Bug Report, please visit the Module Forge
<a href="http://dev.cmsmadesimple.org/projects/Zemelapiai/">Zemelapiai Page</a>.</li>
<li>Additional discussion of this module may also be found in the <a href="http://forum.cmsmadesimple.org">CMS Made Simple Forums</a>.</li>
<li>The author, SjG, can often be found in the <a href="irc://irc.freenode.net/#cms">CMS IRC Channel</a>.</li>
<li>Lastly, you may have some success emailing the author directly.</li>  
</ul>
<p>As per the GPL, this software is provided as-is. Please read the text
of the license for the full disclaimer.</p>

<h3>Copyright and License</h3>
<p>Copyright &copy; 2008, Samuel Goldstein <a href="mailto:sjg@cmsmodules.com">&lt;sjg@cmsmodules.com&gt;</a>. All Rights Are Reserved.</p>
<p>This module has been released under the <a href="http://www.gnu.org/licenses/licenses.html#GPL">GNU Public License</a>. You must agree to this license before using the module.</p>
';

?>
