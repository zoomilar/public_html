<?php
$lang['data'] = 'Data';
$lang['applied'] = 'Verwerkt';
$lang['firstpage'] = '<<';
$lang['prevpage'] = '<';
$lang['nextpage'] = '>';
$lang['lastpage'] = '>>';
$lang['page'] = 'Page';
$lang['prompt_allow_changeusername'] = 'Wijzigen gebruikersnaam toestaan';
$lang['info_allow_changeusername'] = 'Indien ingeschakeld is het gebruikers toegestaan om de eigen gebruikersnaam en andere instellingen te wijzigen.';
$lang['template_saved'] = 'Sjabloon opgeslagen';
$lang['template_resetdefaults'] = 'Sjabloon naar standaard terugzetten';
$lang['lbl_settings'] = 'Instellingen';
$lang['lbl_templates'] = 'Sjablonen';
$lang['enable_captcha'] = 'Schakel captcha in voor het loginformulier';
$lang['info_enable_captcha'] = 'Als de gebruiker niet is aangemeld en de modulevoorkeuren staan zo ingesteld dat er dan een loginformulier wordt weergeven, dan kunt u met deze optie aangeven of u wilt dat er een captcha wordt weergegeven. Alleen indien capatcha beschikbaar is.';
$lang['pagetype_unauthorized'] = 'U bent niet bevoegd om de inhoud van deze pagina te zien';
$lang['info_contentpage_grouplist'] = 'Maak een selectie van FEU groepen die toegang mogen hebben tot deze pagina. Als er geen groepen geselecteerd zijn, is elke met FEU ingelogde gebruiker gerechtigd om deze pagina te zien.';
$lang['pagetype_settings'] = 'Beveiligde pagina instellingen';
$lang['pagetype_groups'] = 'Toegestane groepen';
$lang['info_pagetype_groups'] = 'Selecteer de groep(en) die standaard de afgeschermde pagina&#039;s mogen zien. Een editor met de &amp;quot;beheer alle inhoud (manage all content)&amp;quot;  rechten kan dit voor elke pagina opheffen.';
$lang['pagetype_action'] = 'Actie voor niet voldoende rechten';
$lang['info_pagetype_action'] = 'Geef de acties aan voor personen die deze pagina benaderen zonder dat ze voldoende rechten hebben. U kunt ofwel laten doorsturen naar een bepaalde pagina of het login formulier tonen.';
$lang['showloginform'] = 'Toon het Login formulier';
$lang['redirect'] = 'Doorverwijzen naar een pagina';
$lang['pagetype_redirectto'] = 'Doorverwijzen naar';
$lang['info_pagetype_redirectto'] = 'Geef aan naar welke pagina doorgestuurd wordt. Als u hier geen pagina selecteert en de actie staat ingesteld op &amp;quot;doorsturen&amp;quot; zal de gebruiker een bericht getoond worden dat hij geen toegang heeft tot de pagina.';
$lang['permissions'] = 'Rechten';
$lang['feu_protected_page'] = 'Beveiligde inhoud';
$lang['prompt_viewprops'] = 'Selecteer extra eigenschappen om weer te geven';
$lang['view'] = 'Weergeven';
$lang['info_ignore_userid'] = 'Wanneer aangevinkt zal de import routine proberen gebruikers onafhankelijk van de UserID kolom toe te voegen. Wanneer een gebruiker bestaat met dezelfde naam, zal een foutmelding worden weergegeven.';
$lang['ignore_userid'] = 'Sla UserID kolom over bij importeren';
$lang['export_passhash'] = 'Exporteer de wachtwoord hash naar het bestand';
$lang['info_export_passhash'] = 'De wachtwoord hash is enkel nuttig als de wachtwoordversleutelingscode op de importerende hosts identiek is aan degene op de exporterende host';
$lang['error_adjustsalt'] = 'De wachtwoordversleutelingscode kan niet worden aangepast';
$lang['prompt_pwsalt'] = 'Wachtwoordversleuteling';
$lang['info_pwsalt'] = 'FrontEndUsers voegt versleuteling toe aan wachtwoorden. De sleutel wordt gegegeneerd tijdens de installatie. Deze sleutel kan niet worden gewijzigd. De versleutelingscode kan leeg zijn bij oude installaties.';
$lang['advanced_settings'] = 'Uitgebreide instellingen';
$lang['info_sessiontimeout'] = 'Geef het aantal seconden op voordat een inactieve gebruiker automatisch moet worden afgemeld van de website';
$lang['prompt_expireusers_interval'] = 'Interval gebruikersverloop';
$lang['info_expireusers_interval'] = 'Geef een waarde op (in seconden) die aangeeft hoe vaak het systeem moet controleren welke gebruikerssessie zijn verlopen en afgemeld moeten worden. Dit is een optimalisatei om databasequery&#039;s te besparen. Als u dit veld leeg laat of 0 invoert dan zal het worden uitgevoerd bij iedere aanvraag.';
$lang['msg_settingschanged'] = 'Uw instellingen zijn succesvol bijgewerkt';
$lang['forcedlogouttask_desc'] = 'Verplicht gebruikers om af te melden op regelmatige intervallen';
$lang['prompt_forcelogout_times'] = 'Tijd voor gedwongen afmelden';
$lang['info_forcelogout_times'] = 'Geef een lijst met kommagescheiden waarden van tijden op (bijvoorbeeld: HH:MM,HH:MM) waarop gebruiker geforceerd afgemeld worden. Opmerking: dit gebruikt het pseudocron mechanisme en u moet zeker zijn dat de ingevoerde tijden zullen samenvallen met uw &#039;pseudocron granularity&#039; en dat dergelijke aanvragen zullen worden uitgevoerd op uw website om te controleren of de pseudocron is uitgevoerd.';
$lang['prompt_forcelogout_sessionage'] = 'Sluit gebruikers uit die actief zijn geweest in de laatste <em>(minuten)</em>';
$lang['info_forcelogout_sessionage'] = 'Als dit is opgegeven, zullen gebruikers die actief waren in dit aantal moeten niet worden gedwongen om af te melden';
$lang['areyousure_delete'] = 'Weet u zeker dat u deze gebruiker wilt verwijderen %s';
$lang['error_invalidfileextension'] = 'Het ge&uuml;ploade bestand is een niet toegestaan bestandstype';
$lang['postuninstall'] = 'Alle bijbehorende data van de FrontEndUsers module is verwijderd';
$lang['info_ecomm_paidregistration'] = 'Indien ingeschakeld zal deze module samenwerken met de E-commerce suite. De volgende instellingen werken alleen wanneer deze instelling is ingeschakeld.';
$lang['prompt_ecomm_paidregistration'] = 'Volgorde voor sorteren van gebeurtenissen';
$lang['info_paidreg_settings'] = 'De volgende instellingen zijn alleen actief indien er gebruik wordt gemaakt van zelfregistratie en er betaald wordt voor registratie';
$lang['none'] = 'Geen';
$lang['delete_user'] = 'Verwijder gebruiker';
$lang['expire_user'] = 'Verloop gebruiker';
$lang['prompt_action_ordercancelled'] = 'Actie om uit te voeren indien aanmeldingsverzoek is geannuleerd';
$lang['prompt_action_orderdeleted'] = 'Actie om uit te voeren indien aanmeldingsverzoek is verwijderd';
$lang['ecommerce_settings'] = 'E-commerce instellingen';
$lang['securefieldmarker'] = 'Beveiligd Veld marker';
$lang['securefieldcolor'] = 'Beveiligd Veld kleur';
$lang['prompt_encrypt'] = 'Sla deze data beveiligd op in de database';
$lang['error_notsupported'] = 'Deze optie is niet ondersteund in uw huidige configuratie';
$lang['audit_user_created'] = 'Gebruiker automatisch gecre&euml;rd';
$lang['info_auto_create_unknown'] = 'Indien de gebruiker wordt gecontroleerd door een externe authencatiemodule die niet bekend is in FrontEndUsers module moet er dan automatisch een FEU account worden aangemaakt?';
$lang['prompt_auto_create_unknown'] = 'Automatisch onbekende gebruikers aanmaken';
$lang['display_settings'] = 'Weergave instellingen';
$lang['info_std_auth_settings'] = 'De volgende instellingen worden alleen toegepast indien er gebruik wordt gemaakt van de &#039;Ingebouwde authenticatie&#039;.';
$lang['info_support_lostun'] = 'Als u Nee selecteert zal de optie voor de gebruiker om verloren login informatie uitgeschakeld worden, ongeacht andere instellingen';
$lang['info_support_lostpw'] = 'Als u Nee selecteert zal de optie voor de gebruiker om het wachtwoord opnieuw in te stellen, uitgeschakeld worden. Dit ongeacht andere instellingen.';
$lang['prompt_support_lostun'] = 'Sta gebruikers toe hun gebruikersnaam op te vragen';
$lang['prompt_support_lostpw'] = 'Sta gebruikers toe een nieuw wachtwoord aan te vragen';
$lang['auth_settings'] = 'Authencatie instellingen';
$lang['authentication'] = 'Ingebouwde authencatie';
$lang['auth_builtin'] = 'Standaard FEU Authencatie';
$lang['auth_module'] = 'Authencatie Module/Methode';
$lang['info_auth_module'] = 'De FrontendUsers module ondersteund alternatieve authenticatie methodes met verschillende mogelijkheden. Sommige functionaliteit zal niet werken als u geen gebruik maakt van de ingebouwde authenticatie methode.';
$lang['error_user_nonunique_field_value'] = 'De waarde ingevuld voor %s is al in gebruik bij een andere gebruiker';
$lang['unique'] = 'Uniek';
$lang['error_nonunique_field_value'] = 'De waarde ingesteld voor %s (%s) is niet uniek';
$lang['prompt_force_unique'] = 'Deze eigenschap moet uniek zijn ten op zichte van alle gebruikers';
$lang['help_returnlast'] = 'Gebruikt voor de aan- en afmeldformulieren, deze parameter zorgt ervoor dat de gebruiker terugkeert naar de pagina (doormiddel van de URL) waar de gebruiker was voordat de actie werd uitgevoerd. Deze parameter overschrijft alle doorstuur instellingen en de returnto parameter.';
$lang['help_noinline'] = 'Gebruikt voor een van de formulieren. Deze parameter zorgt er voor dat de formulieren niet inline worden geplaatst maar in plaats daarvan resulteert het in een formulier dat het standaard content blok vervangt.';
$lang['title_reset_session'] = 'Loginsessie timeout waatschuwing';
$lang['msg_reset_session'] = 'Uw login sessie is bijna verlopen. Klik op OK om uw activiteit op de website te bevestigen.';
$lang['ok'] = 'OK';
$lang['resetsession_template'] = 'Herstel Sessie Template';
$lang['info_name'] = 'Dit is de veldnaam, deze kan aangeroepen worden in een smarty. Het mag alleen bestaan uit alfanumerieke tekens en underscores.';
$lang['visitors_tab'] = 'Bezoekers';
$lang['feu_groups_prompt'] = 'Selecteer een of meer FEU-groepen die deze pagina mogen zien';
$lang['error_mustselect_group'] = 'Er moet een groep zijn geselecteerd';
$lang['selectone'] = 'Selecteer &eacute;&eacute;n';
$lang['start_year'] = 'Start jaar';
$lang['end_year'] = 'Eind jaar';
$lang['date'] = 'Datum';
$lang['prompt_thumbnail_size'] = 'Miniatuurafmeting';
$lang['OnUpdateGroup'] = 'Gebruikersgroep gewijzigd';
$lang['error_toomanyselected'] = 'Te veel gebruikers geselecteerd voor een bulk operatie... Verlaag het aantal tot 250 of minder.';
$lang['confirm_delete_selected'] = 'Weet u zeker dat u de geselecteerde gebruikers wilt verwijderen?';
$lang['delete_selected'] = 'Verwijder geselecteerden';
$lang['prompt_randomusername'] = 'Genereer willekeurige gebruikersnamen wanneer er nieuwe gebruikers worden aangemaakt';
$lang['months'] = 'maanden';
$lang['prompt_expireage'] = 'Standaard gebruiker verloopperiode';
$lang['notification_settings'] = 'Notificatie instellingen';
$lang['property_settings'] = 'Eigenschap instellingen';
$lang['redirection_settings'] = 'Verwijzingsinstellingen';
$lang['general_settings'] = 'Algemene instellingen';
$lang['session_settings'] = 'Sessie en cookie instellingen';
$lang['field_settings'] = 'Veldinstellingen';
$lang['error_lostun_nonrequired'] = 'De verloren gebruikersnaamflag kan alleen gebruikt worden op vereiste velden';
$lang['prop_textarea_wysiwyg'] = 'Sta het gebruik van WYSIWYG toe voor dit tekstveld';
$lang['info_cookiestoremember'] = '<strong>Opmerking: </strong> Dit gebruikt de mcrypt functie voor codering doeleinden en deze zijn niet gedetecteerd op uw huidige configuratie. Neem alstublieft contact op met uw server beheerder.';
$lang['editing_user'] = 'Aanpassen gebruiker';
$lang['noinline'] = 'Gebruik geen inline formulieren';
$lang['info_lostun'] = 'Klik hier als u uw inloggegevens bent vergeten';
$lang['info_forgotpw'] = 'Klik hier als u uw wachtwoord bent vergeten';
$lang['info_logout'] = 'Klik hier om af te melden';
$lang['info_changesettings'] = 'Klik hier om uw wachtwoord en andere informatie in te stellen';
$lang['viewuser_template'] = 'Geef gebruikerstemplate weer';
$lang['event'] = 'Gebeurtenis';
$lang['feu_event_notification'] = 'FEU Gebeurtenissennotificatie';
$lang['prompt_notification_address'] = 'Notificatie e-mailadres';
$lang['prompt_notification_template'] = 'Notificatie e-mail template';
$lang['prompt_notification_subject'] = 'Notificatie e-mailonderwerp';
$lang['prompt_notifications'] = 'E-mail notificaties';
$lang['OnLogin'] = 'Bij aanmelden';
$lang['OnLogout'] = 'Bij afmelden';
$lang['OnExpireUser'] = 'Bij verloop van sessie';
$lang['OnCreateUser'] = 'Bij het aanmaken van nieuwe gebruiker';
$lang['OnDeleteUser'] = 'Bij het verwijderen van een gebruiker';
$lang['OnUpdateUser'] = 'Wanneer gebruikersinstellingen worden gewijzigd';
$lang['OnCreateGroup'] = 'Wanneer een gebruikersgroep wordt aangemaakt';
$lang['OnDeleteGroup'] = 'Wanneer een gebruikersgroep wordt verwijderd';
$lang['lostunconfirm_premsg'] = 'De verloren login-gegevens functionaliteit is succesvol afgerond. We hebben een unieke gebruikersnaam gevonden die overeenkomt met de gegevens die u hebt opgegeven.';
$lang['your_username_is'] = 'Uw gebruikersnaam is';
$lang['lostunconfirm_postmsg'] = 'We bevelen u aan om deze informatie op een veilige maar wel toegankelijke plaats op te slaan.';
$lang['prompt_after_change_settings'] = 'Pagina ID/Alias om naar door te verwijzen na het wijzigen van instellingen';
$lang['prompt_after_verify_code'] = 'Pagina ID/Alias om naar door te verwijzen na de codeverificatie *';
$lang['lostun_details_template'] = 'Vergeten gebruikersnaam details sjabloon';
$lang['lostun_confirm_template'] = 'Vergeten gebruikersnaam bevestigings sjabloon';
$lang['error_nonuniquematch'] = 'Fout: Meer dan een gebruikersaccount komt overeen met de opgegeven eigenschappen';
$lang['error_cantfinduser'] = 'Fout: Kan geen overeenkomstige gebruiker vinden';
$lang['error_groupnotfound'] = 'Fout: Kan geen groep vinden met de opgegeven naam';
$lang['readonly'] = 'Alleen lezen';
$lang['prompt_usermanipulator'] = 'Gebruiker manipulator klasse';
$lang['admin_logout'] = 'Afgemeld door administrator';
$lang['prompt_loggedinonly'] = 'Laat alleen ingelogde gebruikers zien';
$lang['prompt_logout'] = 'Meld deze gebruiker af';
$lang['user_properties'] = 'Gebruikereigenschappen';
$lang['userhistory'] = 'Gebruikersgeschiedenis';
$lang['export'] = 'Exporteren';
$lang['clear'] = 'Herstellen';
$lang['prompt_exportuserhistory'] = 'Exporteer gebruikersgeschiedenis naar ASCII van minstens';
$lang['prompt_clearuserhistory'] = 'Verwijder gebruikersgeschiedenis van records die minstens';
$lang['title_lostusername'] = 'Accountgegevens vergeten?';
$lang['title_rssexport'] = 'Exporteer groepsdefenitie (en eigenschappen) naar XML';
$lang['title_userhistorymaintenance'] = 'Onderhoud gebruikersgeschiedenis';
$lang['yes'] = 'Ja';
$lang['no'] = 'Nee';
$lang['prompt_of'] = 'Van';
$lang['date_allrecords'] = '** Geen limiet **';
$lang['date_onehourold'] = 'Een uur oud';
$lang['date_sixhourold'] = 'Zes uur oud';
$lang['date_twelvehourold'] = 'Twaalf uur oud';
$lang['date_onedayold'] = 'Een dag oud';
$lang['date_oneweekold'] = 'Een week oud';
$lang['date_twoweeksold'] = 'Twee weken oud';
$lang['date_onemonthold'] = 'Een maand oud';
$lang['date_threemonthsold'] = 'Drie maanden oud';
$lang['date_sixmonthsold'] = 'Zes maanden oud';
$lang['date_oneyearold'] = 'Een jaar oud';
$lang['title_groupsort'] = 'Groeperen en sorteren';
$lang['prompt_recordsfound'] = 'Records die overeenkomen met het volgende criterium';
$lang['sortorder_username_desc'] = 'Aflopend op gebruikersnaam';
$lang['sortorder_username_asc'] = 'Oplopend op gebruikersnaam';
$lang['sortorder_date_desc'] = 'Aflopend op datum';
$lang['sortorder_date_asc'] = 'Oplopend op datum';
$lang['sortorder_action_desc'] = 'Aflopend op gebeurtenistype';
$lang['sortorder_action_asc'] = 'Oplopend op gebeurtenistype';
$lang['sortorder_ipaddress_desc'] = 'Aflopend op IP Adres';
$lang['sortorder_ipaddress_asc'] = 'Oplopend op IP Adres';
$lang['info_nohistorydetected'] = 'Geen geschiedenis gevonden';
$lang['reset'] = 'Herstellen';
$lang['prompt_group_ip'] = 'Sorteren bij IP adres';
$lang['prompt_filter_eventtype'] = 'Gebeurtenistype filter';
$lang['prompt_filter_date'] = 'Alleen gebeurtenissen weergeven die minder zijn dan';
$lang['prompt_pagelimit'] = 'Paginalimiet';
$lang['for'] = 'voor';
$lang['title_userhistory'] = 'Gebruikersgeschiedenisrapport';
$lang['unknown'] = 'Onbekend';
$lang['prompt_ipaddress'] = 'IP Adres';
$lang['prompt_eventtype'] = 'Gebeurtenistype';
$lang['prompt_date'] = 'Datum';
$lang['prompt_return'] = 'Terug';
$lang['import_complete_msg'] = 'Import voltooid';
$lang['prompt_linesprocessed'] = 'Regels uitgevoerd';
$lang['prompt_errors'] = 'Problemen opgetreden';
$lang['prompt_recordsadded'] = 'Records toegevoegd';
$lang['error_nogroupproprelns'] = 'Kan geen eigenschappen vinden voor de groep %s';
$lang['error_noresponsefromserver'] = 'Krijgt geen reactie van de SMTP-server';
$lang['error_importfilenotfound'] = 'Het bestand (%s) kan niet gevonden worden';
$lang['error_importfieldvalue'] = 'Ongeldige waarde voor dropdown of meerkeuze veld %s';
$lang['error_importfieldlength'] = 'Het veld %s overschrijdt de maximum lengte';
$lang['error_importusers'] = 'Import fout (regel %s): %s';
$lang['error_propertydefns'] = 'Kan de eigenschap defenities niet vinden (interne fout)';
$lang['error_problemsettinginfo'] = 'Probleem met het verkrijgen van gebruikersinformatie';
$lang['error_importrequiredfield'] = 'Kan geen kolom vinden die overeenkomt met het vereiste veld %s';
$lang['error_nogroupproperties'] = 'Kan geen eigenschappen vinden voor de gespecificeerde groep';
$lang['error_importfileformat'] = 'Het bestand aangegeven voor de import is niet in het juiste formaat';
$lang['error_couldnotopenfile'] = 'Kan bestand niet openen';
$lang['info_importusersfileformat'] = '<h4>File Format Information </h4>
<p>The input file must be in ASCII format using comma separated values.  Each line in this input file (with the exception of the header line, discussed below) represents one user record.  The order of the fields in each line must be identical.</p>
<h5>Header line</h5>
<ul>
<li>The first line of the file must begin with two pound (\#) characters, and names each of the fields in the file.  The names of these fields is significant.  There are some required field names (see below), and other field names must match the property names associated with the group users are going to be added into.</li>
<li>The import process will fail if the fields in the input file does not match all of the required properties associated with the group that users are being added into</li>
<li>The input file may contain fields representing some of the optional properties in the specified group.</li>
<li>The import process will ignore any fields in the input file that are either not known, or map to properties that are <em>off</em> in the specified user group.</li>
</ul><br/>
<h6><strong>Columnar Data</strong></h5>
<ul>
<li>The <strong>userid</strong> Field - The userid for the user. A value in this field will indicate you are doing an update.  There is a checkbox during the import process to specify that tue userid field can be ignored for the purposes of migrating users from one server to another.</li>
<li>The <strong>username</strong> Field - The desired username.
    <p>This field must exist in the headerline, and in each and every line of the input file. The record will fail if a user with that username already exists in the database.</p></li>
<li>The <strong>password</strong> Field - The password to set for the user.  Optionally, a <strong>passwordhash</strong> field may be included that specifies thee <em>salted</em> MD5 hash of the users password.  If the password field is empty when creating new users the password &amp;quot;changeme&amp;quot; is hardcoded.</li>
<li>The <strong>createdate</strong> Field - todo</li>
<li>The <strong>expires</strong> Field - todo</li>
<li>The <strong>groupname</strong> Field - The groups that you want to have the user be a member of. If all required fields are not filled in the insert/update of the record will fail. See Multiselect Fields below for syntax.</li>
<li>Dropdown/Radio Fields
    <p>The value of dropdown properties in an import file is represented as the string that is shown in the dropdown control in the FrontEndUsers module.</p>
</li>
<li>Multiselect Fields
    <p>Multiselect fields are contained within the ASCII file as a : separated list of strings, where each string represents the text shown in the multiselect list</p>
</li>
<li>Date Fields
    <p>Must be in the format of MM-DD-YYYY</p>
</li>
<li>Image Fields
    <p>Image are fields who&#039;s column name matches a property of type Image.  If this field is a required part of the destination group, then the name specified in these columns must exist in the uploads disrectory of the CMS installation.  If the image does not exist, and the field is required, then the record will fail.</p></li>
</ul>
<h5>Notes</h5>
<p>The import process is subject to the limitations imposed by the host provider, such as memory limitations, processing time, file size upload, and safe mode restrictions.  Any one of these limitations may cause the import to fail. Therefore it is advisable to ensure that import files are smaller in size, and simpler in nature.</p>
<p>Though every effort has been made to ensure that database corruption will not occur, it is advisable to perform a database backup before doing a user import.</p>
<p>The Export data is in the same format as needed for import.</p>
<h5>Example</h5>
<pre>
##username,first_name,last_name,email,city,state,country,zip
user1,test,user,user1@somedomain.com,somewhere,TX,US,12345
</pre>
';
$lang['prompt_importdestgroup'] = 'Importeer gebruikers in deze groep';
$lang['prompt_importfilename'] = 'Invoer CSV-bestand';
$lang['prompt_importxmlfile'] = 'Invoer XML-bestand';
$lang['prompt_exportusers'] = 'Exporteer gebruikers';
$lang['prompt_importusers'] = 'Importeer gebruikers';
$lang['prompt_clear'] = 'Herstel';
$lang['prompt_image_destination_path'] = 'Doelmap voor afbeeldingen';
$lang['error_missing_upload'] = 'Er is een probleem opgetreden met een missende (maar wel vereiste) upload';
$lang['error_bad_xml'] = 'Probleem met het parsen van het gevraagde XML-bestand';
$lang['error_notemptygroup'] = 'Een groep met gebruikers kan niet worden verwijderd';
$lang['error_norepeatedlogins'] = 'Deze gebruiker is reeds ingelogd';
$lang['error_captchamismatch'] = 'De tekst van de afbeelding is niet correct ingevoerd';
$lang['prompt_allow_repeated_logins'] = 'Sta gebruikers toe meer dan een keer aan te melden';
$lang['prompt_allowed_image_extensions'] = 'Bestandstypen die gebruikers mogen uploaden';
$lang['event_help_OnRefreshUser'] = '<h3>OnRefreshUser</h3>
<p>Er wordt een gebeurtenis gegenereerd wanneer een gebruikerssessie wordt vernieuwd.</p>
<h4>Parameters:</h4>
<ul>
  <li><em>id</em> - De gebruikersid</li>
</ul>
';
$lang['event_help_OnDeleteUser'] = '<h3>OnDeleteUser<h3>
<p>An event generated when a user is deleted</p>
<h4>Parameters</h4>
<ul>
<li><em>username</em> - The user name</li>
<li><em>id</em> - The user id</li>
<li><em>props</em> - A hash filled with the properties of the user</li>
</ul> 
';
$lang['event_help_OnCreateUser'] = '<h3>OnCreateUser<h3>
<p>An event generated when a user is created</p>
<h4>Parameters</h4>
<ul>
<li><em>name</em> - The user name</li>
<li><em>id</em> - The user id</li>
</ul> 
';
$lang['event_help_OnUpdateUser'] = '<h3>OnUpdateUser<h3>
<p>An event generated when a user is updated (either by user themself or admin)</p>
<h4>Parameters</h4>
<ul>
<li><em>name</em> - The user name</li>
<li><em>id</em> - The user id</li>
</ul> 
';
$lang['event_help_OnCreateGroup'] = '<h3>OnCreateGroup<h3>
<p>An event generated when a group is created</p>
<h4>Parameters</h4>
<ul>
<li><em>name</em> - The group name</li>
<li><em>description</em> - The group description</li>
<li><em>id</em> - The group id</li>
</ul> 
';
$lang['event_help_OnDeleteGroup'] = '<h3>OnDeleteGroup<h3>
<p>An event generated when a group is deleted</p>
<h4>Parameters</h4>
<ul>
<li><em>name</em> - The group name</li>
<li><em>id</em> - The group id</li>
</ul> 
';
$lang['event_help_OnLogin'] = '<h3>OnLogin<h3>
<p>An event generated when a user logs in</p>
<h4>Parameters</h4>
<ul>
<li><em>id</em> - The id of the logged in user</li>
<li><em>username</em> - The name of the logged in user</li>
<li><em>ip</em> - The ip address of the client</li>
</ul>
';
$lang['event_help_OnLogout'] = '<p>An event generated when a user logs out</p>
<h4>Parameters</h4>
<ul>
<li><em>username</em> - The name of the loggedout user</li>
<li><em>id</em> - The user id</li>
</ul>
';
$lang['event_help_OnExpireUser'] = '<p>An event generated when a user session expires</p>
<h4>Parameters</h4>
<ul>
<li><em>username</em> - The name of the expired user</li>
<li><em>id</em> - The user id of the expired user</li>
</ul>
';
$lang['event_info_OnLogin'] = 'Er is een gebeurtenis gegenereerd toen een gebruiker aanmeldde op het systeem';
$lang['event_info_OnLogout'] = 'Er is een gebeurtenis gegenereerd toen een gebruiker zich afmelde op het systeem';
$lang['event_info_OnExpireUser'] = 'Er is een gebeurtenis gegenereerd toen een gebruikerssessie verliep';
$lang['event_info_OnCreateUser'] = 'Er is een gebeurtenis gegenereerd toen een nieuwe gebruiker is aangemaakt';
$lang['event_info_OnRefreshUser'] = 'Er is een gebeurtenis gegenereerd toen de sessie van de gebruiker werd vernieuwd';
$lang['event_info_OnUpdateUser'] = 'Er is een gebeurtenis gegenereerd toen de gebruikersinformatie is bijgewerkt';
$lang['event_info_OnDeleteUser'] = 'Er is een gebeurtenis gegenereerd toen een gebruikersaccount is verwijderd';
$lang['event_info_OnCreateGroup'] = 'Er is een gebeurtenis gegenereerd toen een gebruikergroep werd aangemaakt';
$lang['event_info_OnUpdateGroup'] = 'Er is een gebeurtenis gegenereerd toen een gebruikersgroep is bijgewerkt';
$lang['event_info_OnDeleteGroup'] = 'Er is een gebeurtenis gegenereerd toen een gebruikergroep is verwijderd';
$lang['backend_group'] = 'Backend groep';
$lang['info_star'] = '* De volgende velden zijn volledige smarty templates.<br/>Evenals reeds bestaande smarty variabelen en plugins, de {$username} en {$group} variabelen zijn beschikbaar.  <em>(De {$group} komt overeen met de eerste gebruikersgroep waar de gebruiker aan toebehoord.)</em>.';
$lang['info_admin_password'] = 'Wijzig dit veld om het wachtwoord van de gebruiker opnieuw in te stellen';
$lang['info_admin_repeatpassword'] = 'Wijzig dit veld om het wachtwoord van de gebruiker opnieuw in te stellen';
$lang['error_username_exists'] = 'Er bestaat al een gebruiker met deze naam';
$lang['nocsvresults'] = 'Geen resultaten terug van de csv export';
$lang['prompt_unfldlen'] = 'Lengte van gebruikersnaamveld';
$lang['prompt_pwfldlen'] = 'Lengte van wachtwoordveld';
$lang['error_invalidpasswordlengths'] = 'Min/Max wachtwoordlengte is ongeldig';
$lang['error_invalidusernamelengths'] = 'Min/Max lengte van gebruikersnaam is ongeldig';
$lang['error_invalidemailaddress'] = 'Ongeldig e-mailadres';
$lang['error_noemailaddress'] = 'We kunnen geen e-mailadres vinden voor dit account';
$lang['error_problemseettinginfo'] = 'Fout tijdens het opslaan van de gebruikersinformatie';
$lang['error_settingproperty'] = 'Fout tijdens het opslaan van de instellingen';
$lang['user_added'] = 'Gebruiker toegevoegd %s = %s';
$lang['user_deleted'] = 'Gebruiker verwijderd uid=%s';
$lang['propertyfilter'] = 'Eigenschap';
$lang['valueregex'] = 'Waarde (reguliere expressie)';
$lang['warning_effectsfieldlength'] = 'Let op: Deze velden hebben invloed op de grootte van de invoervelden voor formulieren. Verlagen van dit getal op een bestaande website wordt niet aangeraden';
$lang['confirm_submitprefs'] = 'Weet u zeker dat u deze module instellingen wilt aanpassen?';
$lang['error_emailalreadyused'] = 'E-mailadres is al ingebruikt';
$lang['prompt_usecookiestoremember'] = 'Gebruik cookies om de logingegevens te onthouden';
$lang['prompt_cookiename'] = 'Naam van de cookie';
$lang['prompt_allow_duplicate_emails'] = 'Sta twee keer hetzelfde e-mailadres toe';
$lang['prompt_username_is_email'] = 'Het e-mailadres is de gebruikersnaam';
$lang['info_cookie_keepalive'] = 'Probeer loginsessies actief te houden door het gebruik van cookies<em>(de cookie wordt opnieuw ingesteld bij activiteit op de website)</em>';
$lang['info_allow_duplicate_emails'] = '(Sta meerdere gebruikers met het zelfde e-mailadres toe)';
$lang['info_username_is_email'] = '(gebruikers e-mailadres is de gebruikersnaam -- gebruik dit niet in combinatie met de optie &quot;Sta twee keer hetzelfde e-mailadres toe&quot;!)';
$lang['prompt_allow_duplicate_reminders'] = 'Sta dubbele &#039;wachtwoord vergeten&#039;-meldingen toe?';
$lang['info_allow_duplicate_reminders'] = '(Sta toe gebruikers een wachtwoord reset aan te vragen, ook als ze de vorige niet hebben benut)';
$lang['prompt_feusers_specific_permissions'] = 'Gebruik FrontEndUser specifieke rechten?';
$lang['info_feusers_specific_permissions'] = '(Normaal zijn de FEU-rechten hetzelfde als de rechten in het administrator gedeelte zoals Gebruiker toevoegen, Groep toevoegen, etc. Als u deze optie selecteert komen er aparte rechten voor het beheer van FEU-gebruikers.)';
$lang['error_missingupload'] = 'Kan het ge&uuml;ploade bestand niet vinden (interne fout)';
$lang['error_problem_upload'] = 'Er was een probleem met het ge&uuml;ploade bestand. Probeer het nog een keer';
$lang['error_missingusername'] = 'U hebt geen gebruikersnaam ingevoerd';
$lang['error_missingemail'] = 'U hebt uw e-mailadres niet ingevoerd';
$lang['error_missingpassword'] = 'U hebt geen wachtwoord ingevoerd';
$lang['frontenduser_logout'] = 'Frontendgebruiker afgemeld';
$lang['frontenduser_loggedin'] = 'Frontendgebruiker aangemeld';
$lang['editprop_infomsg'] = '<font color=&quot;red&quot;><b>WEES VOORZICHTG</b> Wanneer u eigenschappen van een veld die in gebruik is wijzigt dan kan u deze website schade toebrengen! <i>(met name als u veldafmetingen kleiner maakt)</i></font>';
$lang['info_smtpvalidate'] = 'Deze functionaliteit werkt niet op Windows';
$lang['msg_dontcreateusername'] = 'Maak geen veld aan voor de eigenschap gebruikersnaam of wachtwoord. Deze eigenschappen zijn al reeds ingebouwd in de FrontEndUsers module.';
$lang['prompt_exportcsv'] = 'Exporteer gebruikers naar CSV';
$lang['exportcsv'] = 'Exporteer';
$lang['importcsv'] = 'Importeer';
$lang['admin'] = 'Beheer';
$lang['editprop'] = 'Wijzig eigenschap: <em>%s</em>';
$lang['maxlength'] = 'Maximum lengte';
$lang['created'] = 'Aangemaakt';
$lang['sortby'] = 'Sorteren op';
$lang['sort'] = 'Sortering';
$lang['usersingroup'] = 'Gebruikers in de geselecteerde groep(en)';
$lang['userlimit'] = 'Limiteer resulaten naar';
$lang['error_noemailfield'] = 'Kan geen E-mail veld vinden voor deze gebruiker. Neem contact op met uw systeembeheerder.';
$lang['prompt_forgotpw_page'] = 'Pagina ID/Alias voor Wachtwoord Vergeten-formulier';
$lang['prompt_changesettings_page'] = 'Pagina ID/Alias voor Wijzig Instellingen-formulier';
$lang['prompt_login_page'] = 'Pagina ID/Alias om naar te verwijzen na aanmelden *';
$lang['prompt_logout_page'] = 'Pagina ID/Alias om naar te verwijzen na afmelden *';
$lang['sortorder'] = 'Sorteer volgorde';
$lang['prompt_numresetrecord'] = 'Een aantal gebruikers zitten in het proces van het herstellen van vergeten wachtwoorden. Op dit moment is dit aantal:';
$lang['remove1week'] = 'Verwijder alle items van meer dan een week oud';
$lang['remove1month'] = 'Verwijder alle items van meer dan een maand oud';
$lang['removeall'] = 'Verwijdere alle records';
$lang['areyousure'] = 'Weet u het zeker?';
$lang['error_invalidcode'] = 'Er is een ongeldige code ingevoerd, probeer het opnieuw';
$lang['error_tempcodenotfound'] = 'Een tijdelijke code voor uw gebruikersid kon niet worden gevonden in de database';
$lang['forgotpassword_verifytemplate'] = 'Sjabloon gebruikt foor het weergeven van controleformulier';
$lang['forgotpassword_emailtemplate'] = 'Sjabloon gebruikt voor de wachtwoord vergeten e-mail';
$lang['error_resetalreadysent'] = 'U of iemand anders heeft al eerder geprobeerd om een wachtwoord herstel aan te vragen voor dit account. Controleer uw e-mail, wellicht heeft u de e-mail met instructies al reeds ontvangen over hoe u uw wachtwoorden opnieuw kunt instellen.';
$lang['error_dberror'] = 'Database fout';
$lang['message_forgotpwemail'] = 'U ontvangt dit bericht omdat iemand op onze site heeft aangegeven dat u uw wachtwoord ben vergeten. Als dit het geval is, lees dan de onderstaande instructies. Als u geen idee heeft waarom u dit bericht ontvangt, dan kunt u dit bericht zonder problemen verwijderen en bedanken we u voor uw tijd.';
$lang['prompt_code'] = 'Code ';
$lang['message_code'] = 'De volgende code is willekeurig aangemaakt om te controleren of het echt om uw gebruikersaccount gaat. Als u op de onderstaande link klikt dan komt u op de webpagina waar deze code al reeds voor u is ingevoerd. Mocht dat niet het geval zijn, dan is uw code:';
$lang['prompt_link'] = 'Als u op de volgende link klikt komt u op de webpagina waar u de bovenstaande code kunt invoeren en u vervolgens uw wachtwoord opnieuw kunt instellen:';
$lang['lostpassword_emailsubject'] = 'Wachtwoord vergeten';
$lang['error_nomailermodule'] = 'Kan de CMSMailer module niet vinden';
$lang['info_forgotpwmessagesent'] = 'Er is een E-mail verzonden met instructies naar %s over het opnieuw instellen van uw wachtwoord. Bedankt';
$lang['lostpw_message'] = 'U bent uw wachtwoord kwijt of vergeten. Type hier uw gebruikersnaam en als we deze kunnen vinden zullen we een E-mail naar u verzenden met instructies over hoe u uw wachtwoord opnieuw kunt instellen';
$lang['forgotpassword_template'] = 'Vergeten wachtwoord sjabloon';
$lang['lostusername_template'] = 'Vergeten gebruikersnaam sjabloon';
$lang['error_propnotfound'] = 'Eigenschap %s niet gevonden';
$lang['propsfound'] = 'Eigenschappen gevonden';
$lang['addprop'] = 'Eigenschap toevoegen';
$lang['error_requiredfield'] = 'Een verplicht veld (%s) is leeg';
$lang['info_emptypasswordfield'] = 'Voer een nieuw wachtwoord in om uw wachtwoord te veranderen';
$lang['error_notloggedin'] = 'Het ziet er niet naar uit dat u bent aangemeld';
$lang['user_settings'] = 'Instellingen';
$lang['user_registration'] = 'Registratie';
$lang['error_accountexpired'] = 'Dit account is verlopen';
$lang['error_improperemailformat'] = 'Verkeerde E-mail adres opbouw';
$lang['error_invalidexpirydate'] = 'Ongeldige verloopdatum. Dit kan systeemgerelateerd zijn. Probeer een jaar eerder.';
$lang['error_problemsettingproperty'] = 'Fout bij instellen van eigenschap %s voor gebruiker $s';
$lang['error_invalidgroupid'] = 'Ongeldige groep ID %s';
$lang['hiddenfieldmarker'] = 'Verborgen veld markering';
$lang['hiddenfieldcolor'] = 'Verborgen veld kleur';
$lang['hidden'] = 'Verborgen';
$lang['error_duplicatename'] = 'Een eigenschap met deze naam bestaat al reeds';
$lang['error_noproperties'] = 'Geen eigenschappen ingesteld';
$lang['error_norelations'] = 'Er zijn geen eigenschappen geselecteerd voor deze groep. Een groep moet ten minste &eacute;&eacute;n eigenschap hebben.';
$lang['nogroups'] = 'Geen groepen aangemaakt';
$lang['groupsfound'] = 'Groepen gevonden';
$lang['error_onegrouprequired'] = 'Lidmaatschap van minstens een groep is vereist';
$lang['prompt_requireonegroup'] = 'Vereis lidmaatschap van minstens een groep';
$lang['back'] = 'Terug';
$lang['error_missing_required_param'] = '%s is een vereist veld';
$lang['requiredfieldmarker'] = 'Markeer vereiste velden met';
$lang['requiredfieldcolor'] = 'Hilite vereiste velden in';
$lang['next'] = 'Volgende';
$lang['error_groupexists'] = 'Een groep met een naam die reeds bestaat';
$lang['required'] = 'Vereist';
$lang['optional'] = 'Optioneel';
$lang['off'] = 'Uit';
$lang['size'] = 'Grootte';
$lang['sizecomment'] = '<br />(Maximum grootte van elke dementie van de afbeelding in pixels)';
$lang['length'] = 'Lengte';
$lang['lengthcomment'] = '<br />(tekens in de tekstinvoer)';
$lang['seloptions'] = 'Dropdown mogelijkheden, gescheiden door regeleinden. Waarden kunnen los van de tekst met a = teken. Bijvoorbeeld: Vrouw=v';
$lang['radiooptions'] = 'Radio button labels, gescheiden door regeleinden. Waarden kunnen los van de tekst met a = teken. Bijvoorbeeld: Vrouw=v';
$lang['prompt'] = 'Prompt ';
$lang['prompt_type'] = 'Type ';
$lang['type'] = 'Type ';
$lang['fieldstatus'] = 'Veldstatus';
$lang['usedinlostun'] = 'Vraag in Vergeten<br />Gebruikersnaam';
$lang['text'] = 'Tekst';
$lang['checkbox'] = 'Vinkvakje';
$lang['multiselect'] = 'Multi-selectielijst';
$lang['radiobuttons'] = 'Radio Knoppen';
$lang['image'] = 'Afbeelding';
$lang['email'] = 'E-mail adres';
$lang['textarea'] = 'Tekstgebied';
$lang['dropdown'] = 'Dropdown ';
$lang['msg_currentlyloggedinas'] = 'Welkom';
$lang['logout'] = 'Afmelden';
$lang['prompt_newgroupname'] = 'Gebruik deze groepsnaam';
$lang['prompt_changesettings'] = 'Wijzig mijn instellingen';
$lang['error_loginfailed'] = 'Aanmelding mislukt - Ongeldige gebruikersnaam of wachtwoord?';
$lang['login'] = 'Aanmelden';
$lang['prompt_signin_button'] = 'Aanmeldbutton label';
$lang['prompt_username'] = 'Gebruikersnaam';
$lang['prompt_email'] = 'E-mail adres';
$lang['prompt_password'] = 'Wachtwoord';
$lang['prompt_rememberme'] = 'Onthoud mij op deze computer';
$lang['register'] = 'Registreren';
$lang['forgotpw'] = 'Wachtwoord vergeten?';
$lang['lostusername'] = 'Gebruikersnaam vergeten?';
$lang['defaults'] = 'Standaard waarden';
$lang['template'] = 'Sjabloon';
$lang['error_usernotfound'] = 'Kan geen informatie vinden voor deze gebruiker';
$lang['error_usernametaken'] = 'De gebruikersnaam (%s) is al reeds in gebruik';
$lang['prompt_smtpvalidate'] = 'Gebruik SMTP om het e-mailadres te controleren?';
$lang['prompt_minpwlen'] = 'Minimum wachtwoordlengte';
$lang['prompt_maxpwlen'] = 'Maximum wachtwoordlengte';
$lang['prompt_minunlen'] = 'Minimum gebruikersnaamlengte';
$lang['prompt_maxunlen'] = 'Maximum gebruikersnaamlengte';
$lang['prompt_sessiontimeout'] = 'Sessie time-out (seconden)';
$lang['prompt_cookiekeepalive'] = 'Gebruik cookies om loginsessie actief te houden';
$lang['prompt_allowemailreg'] = 'Sta E-mailregistratie toe';
$lang['prompt_dfltgroup'] = 'Standaard groep voor nieuwe gebuikers';
$lang['changesettings_template'] = 'Wijzig instellingentemplate';
$lang['error_passwordmismatch'] = 'Wachtwoorden komen niet overeen';
$lang['error_invalidusername'] = 'Ongeldige gebuikersnaam';
$lang['error_invalidpassword'] = 'Ongeldig wachtwoord';
$lang['edituser'] = 'Wijzig gebruiker';
$lang['valid'] = 'Geldig';
$lang['username'] = 'Gebruikersnaam';
$lang['status'] = 'Status ';
$lang['error_membergroups'] = 'Deze gebruiker is van geen enkele groep lid';
$lang['error_properties'] = 'Geen eigenschappen';
$lang['error_dup_properties'] = 'Poging tot het importeren van dubbele eigenschappen';
$lang['value'] = 'Waarde';
$lang['groups'] = 'Groepen';
$lang['properties'] = 'Eigenschappen';
$lang['propname'] = 'Naam eigenschap';
$lang['propvalue'] = 'Waarde eigenschap';
$lang['add'] = 'Toevoegen';
$lang['history'] = 'Geschiedenis';
$lang['edit'] = 'Aanpassen';
$lang['expires'] = 'Verloopt';
$lang['specify_date'] = 'Specificeer datum';
$lang['12hrs'] = '12 uur';
$lang['24hrs'] = '24 uur';
$lang['48hrs'] = '48 uur';
$lang['1week'] = '1 week';
$lang['2weeks'] = '2 weken';
$lang['1month'] = '1 maand';
$lang['3months'] = '3 maanden';
$lang['6months'] = '6 maanden';
$lang['1year'] = '1 jaar';
$lang['never'] = 'Nooit';
$lang['postinstallmessage'] = 'Module installed sucessfully.<br/>Be sure to set the &quot;Modify FrontEndUser Properties permission.  Additionally, we recommend that you install the Captcha module.  If installed, validation of a captcha image will be required in addition to the username and password to login.  This is intended to prevent brute force attacks.  <strong>Note:</strong> The nocaptcha parameter can be used to disable this functionality even if the Captcha module is installed.&quot;';
$lang['password'] = 'Wachtwoord';
$lang['repeatpassword'] = 'Opnieuw';
$lang['error_groupname_exists'] = 'Er bestaat al een groep met deze naam';
$lang['editgroup'] = 'Wijzig groep';
$lang['submit'] = 'Opslaan';
$lang['cancel'] = 'Annuleren';
$lang['delete'] = 'Verwijderen';
$lang['confirm_editgroup'] = 'Weet u zeker dat dit de juiste instellingen zijn voor deze groep?\nHet uitschakelen van een eigenschap zal geen enkele vermelding van de eigenschappentabel verwijderen van deze groep/gebruiker. Ze zullen alleen niet beschikbaar zijn.';
$lang['areyousure_deletegroup'] = 'Weet u zeker dat u deze groep wilt verwijderen?';
$lang['confirm_delete_prop'] = 'Weet u zeker dat u deze eigenschap volledig wilt verwijderen?\nAls u dat doet dan zullen tevens alle gebruikersgegevens van deze eigenschap ook verwijderd worden.';
$lang['error_insufficientparams'] = 'Ongeldige parameters';
$lang['id'] = 'ID';
$lang['name'] = 'Naam';
$lang['error_cantaddprop'] = 'Probleem bij het toevoegen van eigenschap';
$lang['error_cantaddgroupreln'] = 'Probleem bij het toevoegen van groepsrelatie';
$lang['error_cantaddgroup'] = 'Probleem bij het toevoegen van groep';
$lang['error_cantassignuser'] = 'Probleem bij het toewijzen van groep aan gebruiker';
$lang['error_couldnotdeleteproperty'] = 'Probleem bij het verwijderen van een eigenschap';
$lang['error_couldnotfindemail'] = 'Kan geen E-mail adres vinden';
$lang['error_destinationnotwritable'] = 'Geen schrijfrechten in de doelmap';
$lang['error_invalidparams'] = 'Ongeldige parameters';
$lang['error_nogroups'] = 'Kan geen enkele groep vinden';
$lang['applyfilter'] = 'Toepassen';
$lang['filter'] = 'Filter ';
$lang['userfilter'] = 'Gebruikersnaam reguliere expressie';
$lang['description'] = 'Beschrijving';
$lang['groupname'] = 'Groepssnaam';
$lang['accessdenied'] = 'Geen toegang';
$lang['error'] = 'Fout';
$lang['addgroup'] = 'Voeg groep toe';
$lang['importgroup'] = 'Importeer groep';
$lang['adduser'] = 'Voeg gebruiker toe';
$lang['usersfound'] = 'Gebruikers gevonden die voldoen aan het criterium';
$lang['group'] = 'Groep';
$lang['selectgroup'] = 'Selecteer groep';
$lang['registration_template'] = 'Registratietemplate';
$lang['logout_template'] = 'Afmeldtemplate';
$lang['login_template'] = 'Aanmeldtemplate';
$lang['preferences'] = 'Voorkeuren';
$lang['users'] = 'Gebruikers';
$lang['friendlyname'] = 'Frontend User Beheer';
$lang['moddescription'] = 'Sta gebruikers toe in te loggen op de frontend van uw site';
$lang['defaultfrontpage'] = 'Standaard voorpagina';
$lang['lastaccessedpage'] = 'Laatst bezochte pagina';
$lang['otherpage'] = 'Andere pagina: ';
$lang['captcha_title'] = 'Voer de tekst van de afbeelding in';
$lang['qca'] = 'P0-868941957-1312719560849';
$lang['utma'] = '156861353.1077742063.1332186351.1332186351.1346092988.2';
$lang['utmz'] = '156861353.1332186351.1.1.utmcsr=google|utmccn=(organic)|utmcmd=organic|utmctr=cms made simple';
$lang['utmb'] = '156861353';
$lang['utmc'] = '156861353';
?>