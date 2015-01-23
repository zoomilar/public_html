<?php
$lang['act_cachecleaned'] = 'Cache opgeschoond';
$lang['add_row'] = 'Rij toevoegen';
$lang['alias'] = 'Alias ';
$lang['aliases'] = 'Aliassen';
$lang['ask_clear_image_cache'] = 'Weet u zeker dat u ALLE bestanden wilt verwijderen uit de afbeeldingen buffer?';
$lang['clear_all'] = 'Schoon alle bestanden op';
$lang['clear_now'] = 'Nu opschonen';
$lang['delete'] = 'Verwijderen';
$lang['embedding'] = 'Ge&euml;mbedde afbeeldingen';
$lang['embedding_mode'] = 'Afbeelding insluitmodus';
$lang['embed_sizelimit'] = 'Insluitbare afbeeldingsgrootte limiet (kb)';
$lang['embed_types'] = 'Insluitbare afbeelding type';
$lang['error_alias_duplicatename_atrow'] = 'Dezelfde aliasnaam opgegeven voor de alias op rij %d';
$lang['error_alias_noname_atrow'] = 'Geen naam opgegeven voor de alias op rij %d';
$lang['error_alias_nooptions_atrow'] = 'Geen opties opgegeven voor de alias op rij %d';
$lang['error_invalid_age'] = 'Leeftijdsinstelling ongeldig... Bewerking niet uitgevoerd';
$lang['error_missingparam'] = 'Een verplichte parameter is niet (correct) ingevuld: %s';
$lang['error_invalidparam'] = 'Ongeldige parameter in oproep: %s';
$lang['error_srcnotfound'] = 'Kan geen bestand vinden in: %s';
$lang['error_remotefile'] = 'Probleem met het ontvangen van een extern bestand in: %s';
$lang['error_unknownfilter'] = 'CGSmartImage - Onbekend Filter: %s';
$lang['friendlyname'] = 'Calguy&#039;s Smart Image Toolkit';
$lang['general'] = 'Algemeen';
$lang['info_aliases'] = 'Aliassen kunnen worden gebruikt met de alias1 tot en met alias5 opties in de CGSmartImage-tag voor verschillende regelmatig gebruikte opties';
$lang['info_croptofit_default_loc'] = 'Specify the default location from which to &quot;crop to fit&quot; this will effect all crop to fit operations unless the location parameter on the filter_croptofit attribute overrides it.  Default location is &quot;center&quot; ';
$lang['image_url_hascachedir'] = 'Is de bovenstaande URL in gebruik voor de cache directory (_CGSmartImage)';
$lang['image_url_prefix'] = 'Afbeelding Url Prefix';
$lang['info_cache_age'] = 'Geef de maximale leeftijd op van een bestand (in dagen) voordat het moet worden verwijderd en opnieuw gegenereerd moet worden  Dit is handig als u sommige parameters heeft gewijzigd voor het genereren van afbeeldingen of om de gebruikte schijfruimte te beheren.  Als u 0 invoert dan zal de automatische bestandsdetectie uit staan.';
$lang['info_embed_mode'] = 'Deze sectie bepaald hoe de {smartimg}-tag een output genereerd. Als &#039;niets&#039; is geselecteerd, dan zal er geen afbeelding ingesloten worden. Als u &#039;slim&#039; selecteert dan zal het systeem het zelf bepalen aan de hand van de afbeeldingsgrootte, type en de browser die de afbeelding afbeelding opvraagt. Andere opties zullen altijd de afbeelding insluiten op basis van de afbeeldingsgrootte en afbeeldingstype.';
$lang['info_embed_sizelimit'] = 'Als de insluitingsoptie bepaalt word door afbeeldingsgrootte, geef van een maximum bestandsgrootte op (in kilobytes) voor afbeeldingen om deze in te sluiten (32 is aanbevolen).';
$lang['info_embed_types'] = 'Als de insluitingsoptie bepaalt word door het afbeeldingstype, geef dan hier de extensies op van bestanden die ingesloten mogen worden, geschieden door comma&#039;s. Deze optie is niet hoofdlettergevoelig.';
$lang['info_image_url_hascachedir'] = 'Als uw CDN direct verwijst naar de afbeeldingscache dan wilt u misschien deze functie inschakelen.';
$lang['info_image_url_prefix'] = 'Specificeer de URL met een prefix voor alle gegenereerde afbeeldingen. Standaard is dit de uploads URL, maar het mag ook uw eigen CDN zijn (of meerdere domeinen die gebruik maken van dezelfde map). U kunt hier een andere naam opgegeven.';
$lang['max_cache_age'] = 'Maximum bestandsleeftijd in cache (dagen)';
$lang['moddescription'] = 'Een slimme afbeeldingstag module voor CMSMS';
$lang['msg_aliases_updated'] = 'Aliassen bijgewerkt';
$lang['msg_cachecleaned'] = 'Cachemap opgeschoond. %d bestanden verwijderd';
$lang['msg_cacheremoved'] = 'Cache verwijderd';
$lang['msg_prefsupdated'] = 'Voorkeuren bijgewerkt';
$lang['none'] = 'Geen';
$lang['options'] = 'Opties';
$lang['param_alias'] = 'Het CGSmartImage adminpaneel staat toe om verschillende commando-aliassen toe te wijzen aan regelmatig gebruikte patronen van regels in een naam. Om deze aliassen te gebruiken gebruik een regel in de volgende vorm: alias##=alias_name. Bijvoorbeeld: alias1=foo, alias2=foo.';
$lang['param_alt'] = 'Voor bij het gebruik van de img-tag moet u hier de waarde voor het alt-attribuut opgegeven.  Opmerking: als u hier geen waarde invoert dan zal deze waarde automatisch berekend worden zodat de meeste img-tags juist zijn.  U kunt deze automatische berekening uitschakelen met de &quot;noauto&quot; parameter';
$lang['param_class'] = 'Wordt gebruikt bij het genereren van een img-tag, staat toe om een of meerdere classes toe te voegen aan de tag.  bijvoorbeeld: class=&quot;fancybox thumbnail&quot;';
$lang['param_filter_blur'] = '(alles) Geef een waarde op voor deze parameter om een blur filter toe te voegen aan de afbeelding';
$lang['param_filter_brightness'] = '(heel getal) Verbeterd de helderheid van de afbeelding met de gehele waarde die wordt opgegeven';
$lang['param_filter_colorize'] = '(r,g,b[,alpha]) - Lijkt op het filter _greyscale maar u kunt hier de kleur en de alphawaarde opgegeven';
$lang['param_filter_contrast'] = '(heel getal) Wijzig het contrast van de afbeelding door de waarde met een heel getal te wijzigen';
$lang['param_filter_crop'] = '(percentage[,h_align,v_align]) - Voer bijsnijden uit op de opgegeven afbeelding. De parameters voor het bijsnijden zijn opgegeven als een kommagescheiden lijst.  De eerste waarde is een geheel percentage van de afbeelding op originele grootte.  Deze tweede en derde (optitionele) parameters zijn: l,c,r (links,gecentreerd,rechts) en t,c,b (top,gecentreerd,beneden) om de locatie op te gegeven vanaf waar er bijgesneden moet worden.  bijvoorbeeld: crop=33,b,r om een knipsel te nemen van 33% vanaf de rechter onderkant van de bronafbeelding';
$lang['param_filter_croptofit'] = '(width,height[,location]) - Perform a croptofit on the image specified. This attempts to rescale the image to the destination size while reatining aspect ratio, then focus on the selected area of the resized image.  Crop to fit parameters are specified as the desired width and height for the destination image along with an (optional) location code.  valid location codes are tl,tc,tr,cl,c,cr,bl,b,br for the 9 relative positions within the image.  If a location is not specified a preference will be used.  The default value is &amp;quot;c&amp;quot; to crop-to-fit from the center of the source image.  At no time will this filter perform any upscaling. ';
$lang['param_filter_edgedetect'] = '(alles) Markeer de randen in de afbeelding';
$lang['param_filter_emboss'] = '(alles) Geef de afbeelding reli&euml;f';
$lang['param_filter_flip'] = '(mode) - Draai de opgegeven afbeelding.  Geef 0 op voor horizontaal, 1 voor verticaal en 2 voor beide richtingen.';
$lang['param_filter_grayscale'] = '(alles) Converteer de afbeelding naar grijswaarden';
$lang['param_filter_meanremoval'] = '(alles) Bedoeld voor een &quot;teken&quot;-effect';
$lang['param_filter_negate'] = '(alles) Ontken de afbeelding';
$lang['param_filter_pixelate'] = '(grootte[,geavanceerd]) Pixelate the image, specify an integer size and an optional boolean (default is false) to enable advanced pixelation';
$lang['param_filter_resize'] = 'type,number[,number] - Perform a resize of the source image.  The resize filter does not perform any upscale checking.  Possible values are: 
<ul>
  <li>p,number - Perform a simple rescale to a certain percentage.  i.e:  resize=p,50 to resize to 50% of the original size.</li>
  <li>w,number - Perform a resize to a specified width (while retaining aspect ratio). i.e: resize=w,80 to create a thumbnail with a maximum width of 80 pixels.</li>
  <li>h,number - Perform a resize to a specified height (while retaining aspect ratio). i.e: resize=h,80 to create a thumbnail with a maximum height of 80 pixels.</li>
  <li>e,number - Perform a resize resizing the largest edge to the specified value (while retaining aspect ratio). i.e: resize=e,100 to create a thumbnail whos largest edge is 100 pixels.
  <li>c,x,y - Perform a resize to a custom size (without retaining aspect ratio).  i.e: filter_resize=c,50,75 to create a thumbnail that is 50x75 pixels.</li>.
</ul>';
$lang['param_filter_resizetofit'] = '(width,height[,color[,alpha]]) - Perform a resize on the image specified. This attempts to rescale the image to the destination size while reatining aspect ratio, the image is centered in the box specified (either horizontally or vertically depending upon aspect ratio and the destination size, and the image is surrounded by the supplied color.  Colors can be specified by name (see the X11 color names), or by #nnnnnn hexadecimal format, or as rgb values separated by a : i.e:  filter_croptofit=600,400,#ff0000.  The special color value &quot;transparent&quot; can be specified to force the background to be transparent.   An alpha value may be specified between 0 and 127 to specify different degrees of translucency for the background.   At no time will this plugin perform any upscaling. ';
$lang['param_filter_rotate'] = '(angle,color) Geef met een geheel getal de draaihoek op (draaien gaat met de klok mee) om de afbeelding te draaien. Daarnaast moet u een kleur opgegeven waarmee de overige pixels worden opgevuld.  De afbeelding draait om zijn eigen midden.';
$lang['param_filter_roundedcorners'] = '(radius) Specificeer een heel getal voor de straal (in pixels) van de afgeronde hoeken.';
$lang['param_filter_watermark'] = '(alles), Geef een watermerk op (zoals opgegeven in de CGExtentions module) die moet worden toegepast op de afbeelding';
$lang['param_height'] = 'Voor bij het gebruik van de img-tag moet u hier de waarde voor het hoogte-attribuut opgegeven.  Opmerking: als u hier geen waarde invoert dan zal deze waarde automatisch berekent worden zodat de meeste img-tags juist zijn.  U kunt deze automatische berekening uitschakelen met de &quot;noauto&quot; parameter';
$lang['param_id'] = 'Used when creating an img tag, allows specifying an id attribute to include on the tag.  i.e: id=&quot;sometag&quot;';
$lang['param_max_height'] = 'Van toepassing op de {cgsi_convert} tag, deze parameter staat toe om een maximum hoogte op te geven voor geconverteerde afbeeldingen';
$lang['param_max_width'] = 'Van toepassing op de {cgsi_convert} tag, deze parameter staat toe om een maximum hoogte op te geven voor geconverteerde afbeeldingen';
$lang['param_name'] = 'Gebruikt bij het maken van de img tag, benoem een waarde voor de naam attribuut.';
$lang['param_noauto'] = 'Bereken niet automatisch de paramaters voor de img-tag.  Dit kan er mogelijk voor zorgen dat uw site niet juist gevalideerd wordt indien de vereiste parameters (width,height,alt) niet zijn opgegeven';
$lang['param_noautoscale'] = 'indien er een breedte en hoogte parameter is op gegeven, dan zal deze parameter het automatische schalen van de afbeelding uitschakelen.';
$lang['param_nobcache'] = 'Sta niet toe dat de herschaalde afbeelding in de browser gecached wordt (handig voor ontwikkeldoeleinden) Dit voegt een uniek nummer als parameter toe aan de afbeelding.';
$lang['param_noembed'] = 'Deze afbeelding mag niet ingesloten worden. Ongeacht de instellingen in het beheerderspaneel, de URL en de gegenereerde tags zullen de bestanden op de server worden opgeroepen. Er zal geen insluiting plaats vinden.';
$lang['param_notimecheck'] = 'Tijdcontrole voor gebufferde bestanden uitschakelen.';
$lang['param_noremote'] = 'Externe bronnen voor URL&#039;s niet toestaan';
$lang['param_norotate'] = 'Niet proberen om de exif-informatie te lezen van het bestand om vervolgens de afbeelding juist te roteren';
$lang['param_notag'] = 'Geef geen img-tag mee in de output, alleen de URL van de gecachede afbeelding. Dit heeft geen effect wanneer CGSmartImage wordt gebruikt in een stylesheet.';
$lang['param_overwrite'] = 'Schakel alle caching uit en forceer herberekening voor alle filters';
$lang['param_quality'] = 'Specificeer de kwaliteit van de outputafbeelding. U moet een waarde invullen tussen de 0 en 100.';
$lang['param_rel'] = 'Used when building an image tag allows specifying an optional rel attribute (typically used with javascript type albums). i.e: rel=&quot;album&quot;';
$lang['param_silent'] = 'Negeer fouten';
$lang['param_src'] = 'Specify the source for the image processing (if any) or the generated img tag.  Note, this parameter is flexible, and the module will attempt many methods to find the source image file on the web server as follows:
<ul>
  <li>First look to see if the specified src value exists as a file on the filesystem.</li>
  <li>Next, check if the value specified for the src parameter is a URL and begins with the uploads_url (as specified in the config.php)</li>
  <li>Next, check if the value specified for the src parameter is a URL and begins with the root_url (as specified in the config.php)</li>
  <li>Next, check if the value specified for the src parameter is a URL and begins with the ssl_url (as specified in the config.php)</li>
</ul>
It is also possible to split the src parameter into multiple arguments, which is useful for example when the path to the file, and the filename are stored in separate smarty variables.   You can specify the src as src1=\$the_path src2=\$the_filename.  The system will automatically add a / in between each argument.  There is no limit to the number of src parameters.';
$lang['param_style'] = 'Gebruikt bij het maken van de img tag, gebruikt voor een alternatieve styling.  bijv.: style=&quot;border: 1px solid black;&quot;';
$lang['param_title'] = 'Geef het optionele titel attribuut op voor de img-tag.  bijvoorbeeld: title=&quot;Dit is een tooltip&quot;';
$lang['param_width'] = 'Voor bij het gebruik van de img-tag moet u hier de waarde voor het breedte-attribuut opgegeven.  Opmerking: als u hier geen waarde invoert dan zal deze waarde automatisch berekent worden zodat de meeste img-tags juist zijn.  U kunt deze automatische berekening uitschakelen met de &quot;noauto&quot; parameter';
$lang['postinstall'] = 'Module ge&iuml;nstalleerd';
$lang['postuninstall'] = 'Alle met deze module geassocieerde data is verwijderd';
$lang['prompt_croptofit_default_loc'] = 'Standaard plaats voor &quot;crop to fit&quot;';
$lang['prompt_embed_sizelimit'] = 'Gebaseerd op afbeeldingsgrootte';
$lang['prompt_embed_smartlimited'] = 'Slimme modus, maar limiteer afbeeldingsgrootte';
$lang['prompt_embed_type'] = 'Gebaseerd op afbeeldingstype';
$lang['prompt_loc_bottomleft'] = 'Beneden Links (bl)';
$lang['prompt_loc_bottomcenter'] = 'Beneden Centreer (bc)';
$lang['prompt_loc_bottomright'] = 'Beneden Rechts (br)';
$lang['prompt_loc_centerleft'] = 'Centreer Links (cl)';
$lang['prompt_loc_center'] = 'Centreer (c)';
$lang['prompt_loc_centerright'] = 'Centreer Rechts (cl)';
$lang['prompt_loc_topleft'] = 'Top Links (tl)';
$lang['prompt_loc_topcenter'] = 'Top Centreer (tc)';
$lang['prompt_loc_topright'] = 'Top Rechts (tr)';
$lang['resizing'] = 'Herschalen';
$lang['smart'] = 'Slim';
$lang['submit'] = 'Opslaan';
$lang['utma'] = '156861353.1455215922.1337446241.1337446241.1337446241.1';
$lang['utmz'] = '156861353.1337446241.1.1.utmccn=(referral)|utmcsr=wiki.cmsmadesimple.org|utmcct=/index.php/Main_Page|utmcmd=referral';
$lang['utmb'] = '156861353';
$lang['utmc'] = '156861353';
?>
