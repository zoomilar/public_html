<?php
$lang['friendlyname'] = 'Failai';
$lang['postinstall'] = 'Post Install Message, e.g., Be sure to set "Use Filelistss" permissions to use this module!';
$lang['postuninstall'] = 'Post Uninstall Message, e.g., "Curses! Foiled Again!"';
$lang['really_uninstall'] = 'Really? You\'re sure you want to uninstall this fine module?';
$lang['uninstalled'] = 'Module Uninstalled.';
$lang['installed'] = 'Module version %s installed.';
$lang['prefsupdated'] = 'Module preferences updated.';
$lang['submit'] = 'Save';
$lang['accessdenied'] = 'Access Denied. Please check your permissions.';
$lang['error'] = 'Error!';
$lang['link_view'] = 'View Record';
$lang['edit'] = 'Redaguoti failą';
$lang['title_num_records'] = '%s records found.';
$lang['add_record'] = 'Add a Record';
$lang['added_record'] = 'Added record.';
$lang['updated_record'] = 'Record updated.';
$lang['upgraded'] = 'Module upgraded to version %s.';
$lang['title_allow_add'] = 'Users may add records?';
$lang['title_allow_add_help'] = 'Click here to allow users to add records.';
$lang['title_mod_prefs'] = 'Nustatymai';
$lang['title_general'] = 'Failai';
$lang['title_description'] = 'Description';
$lang['title_explanation'] = 'Long Description';
$lang['title_mod_admin'] = 'Module Admin Panel';
$lang['dash_record_count'] = 'This module handles %s records';
$lang['alert_no_records'] = 'There have not been any records added in the Filelists module!';
$lang['help_filelists_id'] = 'Internally identifier for selecting records';
$lang['help_description'] = 'Internal parameter used to pass description info when creating or editing a record';
$lang['help_explanation'] = 'Internal parameter used to pass explanation info when creating or editing a record';
$lang['help_module_message'] = 'Internally used parameter for passing messages to user';
$lang['event_info_OnFilelistsPreferenceChange'] = 'An event generated when  the preferences to the Filelists Module get changed';
$lang['event_help_OnFilelistsPreferenceChange'] = '<p>An event generated when the preferences to the Filelists Module get changed</p>
<h4>Parameters</h4>
<ul>
<li><em>allow_add</em> - The new setting of the "Allow Add" preference; boolean</li>
</ul> 
';

$lang['moddescription'] = 'Failų modulis.';
$lang['welcome_text'] = '<p>Welcome to the Pedantic Filelists Module admin section. Something else would probably go here
if the module actually did something. Add it to your front-end pages with a {Filelists}</p>';
$lang['changelog'] = '<ul>
<li>Version 1.8, Sep 2010 SjG
<ul>
<li>Added an additional field to database records to make it more interesting.</li>
<li>Implemented PrettyURLs</li>
<li>Updated for CMSMS 1.9 and for inclusion in <em>CMS Developer\'s Cookbook</em></li>
</ul></li>
<li>Version 1.7, Sep 2009 SjG, Cleaned up, and modernized a bit.</li>
<li>Version 1.6, Nov 2008 SjG, added parameter sanitizing for Nuno</li>
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
    <li>corrected filelist file directory structure</li>
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
smarty tag &#123;Filelists}</p>
<p>You would be wiser, however, to use the module as a starting point, and editing the code to do
whatever it is you are wanting to do.</p>
<h3>Support</h3>
<p>This module does not include commercial support. However, there are a number of resources available to help you with it:</p>
<ul>
<li>For the latest version of this module, FAQs, or to file a Bug Report, please visit the Module Forge
<a href="http://dev.cmsmadesimple.org/projects/filelists/">Filelists Page</a>.</li>
<li>Additional discussion of this module may also be found in the <a href="http://forum.cmsmadesimple.org">CMS Made Simple Forums</a>.</li>
<li>The author, SjG, can often be found in the <a href="irc://irc.freenode.net/#cms">CMS IRC Channel</a>.</li>
<li>Lastly, you may have some success emailing the author directly.</li>  
</ul>
<p>As per the GPL, this software is provided as-is. Please read the text
of the license for the full disclaimer.</p>

<h3>Copyright and License</h3>
<p>Copyright &copy; 2010, Samuel Goldstein <a href="mailto:sjg@cmsmodules.com">&lt;sjg@cmsmodules.com&gt;</a>. All Rights Are Reserved.</p>
<p>This module has been released under the <a href="http://www.gnu.org/licenses/licenses.html#GPL">GNU Public License</a>. You must agree to this license before using the module.</p>
';
$lang['prompt_kalbos'] = 'Kalbos';
$lang['prompt_pg_field'] = 'Falių puslapio tėvo ID';
$lang['idtext'] = 'ID';
$lang['filenametext'] = 'Failo pavadinimas';
$lang['datetext'] = 'Įkėlimo data';
$lang['activetext'] = 'Statusas';
$lang['deletedtext'] = 'Įštrintas';
$lang['usertext'] = 'Vartotojas';
$lang['yes'] = 'Taip';
$lang['no'] = 'Ne';
$lang['areyousure_deletefilelist'] = 'Ar tikrai norite visiškai ištrinti šį failą';
$lang['delete'] = 'Ištrinti';
$lang['addfilelist'] = 'Pridėti failą';
$lang['title_filelists_list'] = 'Failų sąrašas';

$lang['title_filename'] = 'Failo pavadinimas';
$lang['title_date'] = 'Pradžios data';
$lang['title_detail'] = 'Produktai';
$lang['title_cooking_course'] = 'Gaminimo eiga';
$lang['title_short_desc'] = 'Trumpas aprašymas';
$lang['title_location'] = 'Puslapių skaičius';
$lang['title_keywords'] = 'Raktiniai žodžiai (atskirti per kablelį)';
$lang['title_active'] = 'Aktyvus';
$lang['title_deleted'] = 'Ištrintas';
$lang['title_user_id'] = 'Vartotojas';
$lang['title_file'] = 'Nuotrauka';
$lang['title_file2'] = 'Failas';
$lang['cancel'] = 'Atšaukti';
$lang['no_filename'] = 'Neįvestas failo pavadinimas';
$lang['multiselect_addall'] = 'Pridėti visus';
$lang['multiselect_remall'] = 'Ištrinti visus';
$lang['multiselect_ieskoti'] = 'Ieškoti';
$lang['title_cat_id'] = 'Kategorijos';
$lang['prenum_subject'] = 'Įkeltas naujas failas';
$lang['new_filelist_text'] = 'Įkeltas naujas failas, jei norite atsisiųsti spauskite žemiau:';
$lang['creator'] = 'Vartotojas:';
$lang['link_title'] = 'Nuoroda';
$lang['download_link_title'] = 'Atsisiųsti';


$lang['no_approved'] = 'Neaktyvus';
$lang['needs_fixing'] = 'Gražintas patikslinti';
$lang['approved'] = 'Aktyvus';
$lang['canceled'] = 'Atmestas';

$lang['title_date_ende'] = 'Pabaigos data';
$lang['title_time_start'] = 'Pradžios laikas';
$lang['title_time_end'] = 'Pabaigos laikas';
$lang['title_needs_registration'] = 'Vartotojai turi registruotis';
$lang['the_names_id'] = 'ID';
$lang['the_names_filelist'] = 'Failo ID';
$lang['the_names_cr_date'] = 'Registracijos data';
$lang['the_names_name'] = 'Vardas, pavardė';
$lang['the_names_email'] = 'Vardas, pavardė';
$lang['the_names_workplace'] = 'Darbovietė';
$lang['the_names_questions'] = 'Klausimai';
$lang['download_reg'] = 'Atsisiųsti užsiregistravusius į failą';
$lang['prompt_admin_email'] = 'Administratoriaus el. paštai. (atskirti per kablelį)';
$lang['admin_subject0'] = 'Sukurtas naujas failas';
$lang['admin_subject1'] = 'Pasikeitė failo informacija';
$lang['admin_filelist_text0'] = 'Vartotojas sukūrė naują failą.';
$lang['admin_filelist_text1'] = 'Vartotojas atnaujino failo informaciją';
$lang['user_subject'] = 'Administratorius atnaujino failo informaciją';
$lang['user_filelist_text'] = 'Administratorius pakeitė reginio informaciją';
$lang['user_status'] = 'Failo statusas:';
$lang['user_admin_msg_title'] = 'Administratoriaus komentaras:';


$lang['user_status_val0'] = 'Neaktyvus';
$lang['user_status_val2'] = 'Gražintas patikslinti';
$lang['user_status_val1'] = 'Aktyvus';
$lang['user_status_val3'] = 'Atmestas';


$lang['title_admin_msg'] = 'Laiškas failo kūrėjui (siunčiamas el. paštu)';
$lang['title_delete_file'] = 'Ištrinti nuotrauką';
$lang['title_delete_file2'] = 'Ištrinti failą';


$lang['title_search_field'] = 'Paieškos tekstas:';
$lang['reset'] = 'Atšaukti';
$lang['none'] = 'Jokios';
$lang['search'] = 'Ieškoti';



$lang['register_subject'] = 'Pasikeitė informacija apie failą';
$lang['register_filelist_text'] = 'Pasikeitė informacija apie failą į kurį jūs esate registravesi';
$lang['link_title_register'] = 'Nuoroda į failą';



$lang['prompt_calendar_mail'] = 'Gmail el. paštas failų kalendoriui';
$lang['prompt_calendar_pass'] = 'Gmail slaptažodis failų kalendoriui';

$lang['title_user_name'] = 'Vartotojo vardas';
$lang['title_user_email'] = 'Vartotojo el. paštas';
$lang['title_user_nr'] = 'Vartotojo telefonas';
$lang['pick_files'] = 'Pasirinkite paveiksliuką';
$lang['pick_files2'] = 'Pasirinkite failą';
$lang['delete_image'] = 'Ar tikrai norite išrinti šį paveikliuką?';
$lang['delete_image2'] = 'Ar tikrai norite išrinti šį failą?';
$lang['admin_filelist_backendlink'] = 'Peržiūrėti';
$lang['title_file_t2'] = 'Failo tipas';
$lang['file_none'] = 'Joks';
$lang['file_pdf'] = 'PDF';
$lang['file_jpg'] = 'JPG';
$lang['file_2d'] = '2D';
$lang['file_3d'] = '3D';
?>
