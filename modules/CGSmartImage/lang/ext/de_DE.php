<?php
$lang['act_cachecleaned'] = 'Zwischenspeicher geleert';
$lang['add_row'] = 'Zeile hinzuf&uuml;gen';
$lang['alias'] = 'Alias ';
$lang['aliases'] = 'Aliase';
$lang['ask_clear_image_cache'] = 'Wollen Sie wirklich ALLE Dateien aus dem Zwischenspeicher entfernen?';
$lang['clear_all'] = 'Alle Dateien l&ouml;schen';
$lang['clear_now'] = 'Jetzt l&ouml;schen';
$lang['delete'] = 'L&ouml;schen';
$lang['embedding'] = 'Eingebettete Bilder';
$lang['embedding_mode'] = 'Bildeinbettungsmodus';
$lang['embed_sizelimit'] = 'Bilder einbetten bis maximal (kb)';
$lang['embed_types'] = 'Bilder des Typs einbetten';
$lang['error_alias_duplicatename_atrow'] = 'Den Alias-Namen, der f&uuml;r Alias in Zeile %d angegeben wurde, duplizieren.';
$lang['error_alias_noname_atrow'] = 'Kein Name f&uuml;r den Alias in Zeile %d angegeben.';
$lang['error_alias_nooptions_atrow'] = 'Keine Optionen f&uuml;r den Alias in Zeile %d angegeben.';
$lang['error_invalid_age'] = 'Alterseinstellung ung&uuml;ltig ... keine Aktion ausgef&uuml;hrt';
$lang['error_invalidparam'] = 'Ung&uuml;ltiger Parameter in %s';
$lang['error_srcnotfound'] = 'Konnte Datei in %s nicht finden';
$lang['error_remotefile'] = 'Es gab ein Problem, die entfernte Datei in %s zu finden.';
$lang['error_unknownfilter'] = 'CGSmartImage &ndash; Unbekannter Filter: %s';
$lang['friendlyname'] = 'Calguys Smart-Image-Werkzeuge';
$lang['general'] = 'Allgemein';
$lang['info_aliases'] = 'Aliaes can be used via the alias1 through alias5 options on the CGSmartImage tag to combine numerous frequently used options';
$lang['info_croptofit_default_loc'] = 'Specify the default location from which to &quot;crop to fit&quot; this will effect all crop to fit operations unless the location parameter on the filter_croptofit attribute overrides it.  Default location is &quot;center&quot;';
$lang['image_url_hascachedir'] = 'Z&auml;hlt die URL oben f&uuml;r das Zwischenspeicher-Verzeichnis (_CGSmartImage)';
$lang['image_url_prefix'] = 'Bild-URL-Pr&auml;fix';
$lang['info_cache_age'] = 'Maximales Alter einer Datei (in Tagen) bevor es entfernt und neu erzeugt wird. N&uuml;tzlich, wenn die Einstellungen ver&auml;ndert wurden oder um die Gr&ouml;&szlig;e des genutzten Speicherplatzes zu kontrollieren.';
$lang['info_embed_mode'] = 'This selection determines how the {smartimg} tag will generate output.  If &quot;none&quot; is selected no image embedding will be performed.  If &quot;smart&quot; is selected then the system will decide based on the image size, type, and the browser that is requesting the image.  Other options include always embedding based on the image size, or the image type.';
$lang['info_embed_sizelimit'] = 'If the embedding option is determied by the image size, specify the maximum size (in kilobytes) for images to be embedded (32 is recommended).';
$lang['info_embed_types'] = 'If the embedding option is determined by the image type, specify the extensions of the files that should be embedded here separated by commas.  This option is not case sensitive';
$lang['info_image_url_hascachedir'] = 'Wenn Ihr CDN direkt auf das Zwischenspeicher-Verzeichnis verweist, k&ouml;nnte diese Option hilfreich sein.';
$lang['info_image_url_prefix'] = 'URL der Bilder. Standardm&auml;&szlig;ig ist dies die Upload-URL. Verwenden Sie ein CDN (oder mehrere Domains, die auf das selbe Verzeichnis verweisen) k&ouml;nnen Sie hier ein eine andere URL festlegen.';
$lang['max_cache_age'] = 'Maximales Alter der Dateien im Zwischenspeicher (Tage)';
$lang['moddescription'] = 'Ein Modul zur schlauen Erzeugung von Bildern f&uuml;r CMS Made Simple';
$lang['msg_aliases_updated'] = 'Aliase aktualisiert';
$lang['msg_cachecleaned'] = 'Zwischenspeicher geleert. %d Dateien entfernt.';
$lang['msg_cacheremoved'] = 'Zwischenspeicher entfernt';
$lang['msg_prefsupdated'] = 'Einstellungen aktualisiert';
$lang['none'] = 'Keiner';
$lang['options'] = 'Optionen';
$lang['param_alias'] = 'The CGSmartImage admin panel allows creating numerous command alias to combine a frequently used pattern of arguments into one name.  To use these aliases use an argument of the form alias##=alias_name i.e:  alias1=foo alias2=foo.';
$lang['param_alt'] = 'Used when creating an img tag, specify the value for the alt attribute.  Note, if this is not specified a value will be automatically calculated for this attribute so that most generated img tags will validate.  You can override this auto calculation with the &quot;noauto&quot; parameter';
$lang['param_class'] = 'Used when creating an img tag, allows specifying one or more classes to include on the tag.  i.e: class=&quot;fancybox thumbnail&quot;';
$lang['param_filter_blur'] = '(irgendwas) Geben Sie einen beliebigen Wert ein f&uuml;r diesen Parameter zum Hinzuf&uuml;gen eines Weichzeichnungsfilter auf das Bild';
$lang['param_filter_brightness'] = '(Ganzzahl) Erh&ouml;hen Sie die Helligkeit des bearbeiteten Bildes durch den angegeben Ganzzahl-Wert';
$lang['param_filter_colorize'] = '(r,g,b[,alpha]) - Wie filter_greyscale, jedoch k&ouml;nnen Sie die Farbe und den Alpha-Wert bestimmen';
$lang['param_filter_contrast'] = '(Ganzzahl) Ver&auml;ndert den Konstrast des Bildes um die angegebene Ganzzahl';
$lang['param_filter_crop'] = '(percent[,h_align,v_align]) - Perform cropping on the image specified. Crop parameeters are specified as a comma separated list of parameters.  The first (required) value is an integer percentage of the original image size.  The optional second and third parameters are one of l,c,r (left,center,right) and t,c,b (top,center,bottom) specifying where the location within the source image to crop from.  i.e: crop=33,b,r to grab a crop of 33% from the bottom right of the source image.';
$lang['param_filter_croptofit'] = '(width,height) - Perform a croptofit on the image specified. This attempts to rescale the image to the destination size while reatining aspect ratio, then focus on the center of the resized image.  Crop to fit parameters are specified as the desired width and height for the destination image.';
$lang['param_filter_edgedetect'] = '(irgendwas) Kanten im Bild hervorheben.';
$lang['param_filter_emboss'] = '(irgendwas) Bild pr&auml;gen';
$lang['param_filter_flip'] = '(mode) - Perform a flip on the specified image.  Specify 0 for horizontal, 1 for vertical, and 2 for flip in both directions.';
$lang['param_filter_grayscale'] = '(anything) Bild in Graustufen umwandeln';
$lang['param_filter_meanremoval'] = '(anything) Versucht einen &quot;gezeichnet&quot;-Effekt';
$lang['param_filter_negate'] = '(anything) Bild ins Negativ umkehren';
$lang['param_filter_pixelate'] = '(size[,advanced]) Pixelate the image, specify an integer size and an optional boolean (default is false) to enable advanced pixelation';
$lang['param_filter_resize'] = 'type,number[,number] - Perform a resize of the source image.  Possible values are:
<ul>
  <li>p,number - Perform a simple rescale to a certain percentage.  i.e:  resize=p,50 to resize to 50% of the original size.</li>
  <li>w,number - Perform a resize to a specified width (while retaining aspect ratio). i.e: resize=w,80 to create a thumbnail with a maximum width of 80 pixels.</li>
  <li>h,number - Perform a resize to a specified height (while retaining aspect ratio). i.e: resize=h,80 to create a thumbnail with a maximum height of 80 pixels.</li>
  <li>c,x,y - Perform a resize to a custom size (without retaining aspect ratio).  i.e: resize=c,50,75 to create a thumbnail that is 50x75 pixels.</li>
</ul>';
$lang['param_filter_resizetofit'] = '(width,height[,color[,alpha]]) - Perform a resize on the image specified. This attempts to rescale the image to the destination size while reatining aspect ratio, the image is centered in the box specified (either horizontally or vertically depending upon aspect ratio and the destination size, and the image is surrounded by the supplied color.  Colors can be specified by name (see the X11 color names), or by #nnnnnn hexadecimal format, or as rgb values separated by a : i.e:  filter_croptofit=600,400,#ff0000.  The special color value &quot;transparent&quot; can be specified to force the background to be transparent.   An alpha value may be specified between 0 and 127 to specify different degrees of translucency for the background.   At no time will this plugin perform any upscaling.';
$lang['param_filter_rotate'] = '(angle,color) Specify the integer angle (counter clockwise) to rotate the image, and a color to fill the empty pixels with.  The image is rotated about its center.';
$lang['param_filter_roundedcorners'] = '(radius) Specify an integer radius (in pixels) for rounding the corners.';
$lang['param_filter_watermark'] = '(irgendwas) Wasserzeichen (wie in den Einstellungen von CGExtensions definiert) auf das Bild anwenden';
$lang['param_height'] = 'Used when creating an img tag, specify the value for the height attribute.  Note, if this is not specified a value will be automatically calculated for this attribute so that most generated img tags will validate.  You can override this auto calculation with the &quot;noauto&quot; parameter';
$lang['param_id'] = 'Used when creating an img tag, allows specifying an id attribute to include on the tag.  i.e: id=&quot;sometag&quot;';
$lang['param_max_height'] = 'Applicable only to the {cgsi_convert} tag this parameter allows specifying a maximum height for the converted images';
$lang['param_max_width'] = 'Applicable only to the {cgsi_convert} tag this parameter allows specifying a maximum width for the converted images';
$lang['param_name'] = 'Verwendet bei der Erstellung eines img-Tags, geben Sie den Wert f&uuml;r das name Attribut.';
$lang['param_noauto'] = 'Attribute f&uuml;r das img-Tag nicht automatisch berechnet. Dies k&ouml;nnte dazu f&uuml;hren, dass Ihre Seite nicht mehr validiert, wenn verpflichtende Attribute (width, height, alt) nicht angegeben sind.';
$lang['param_noautoscale'] = 'wenn Breite und H&ouml;he Parameter angegeben werden, wird dieser Parameter die automatische Skalierung des Bildes deaktivieren.';
$lang['param_nobcache'] = 'Do not allow the resized image to cache in the browser (useful for development purposes) this adds a unique number as a parameter to the image which will force the browser not to cache the image.';
$lang['param_noembed'] = 'Force the image to not embed.  Regardless of settings in the admin panel, the URL and tag generated will be to a file on the server.  No embedding will be performed';
$lang['param_norotate'] = 'Do not attempt to read exif information from the file and correct image rotation';
$lang['param_notag'] = 'Kein img-Tag ausgeben, nur die URL zum Bild. Kein Effekt, wenn CGSmartImages in einem Stylesheet verwendet wird.';
$lang['param_overwrite'] = 'Zwischenspeicher deaktivieren und Neuberechnung aller Filter erzwingen';
$lang['param_quality'] = 'Qualit&auml;t des Bildes. Ein Wert zwischen 0 und 100. Die Voreinstellung ist 75.';
$lang['param_rel'] = 'Used when building an image tag allows specifying an optional rel attribute (typically used with javascript type albums). i.e: rel=&quot;album&quot;';
$lang['param_src'] = 'Specify the source for the image processing (if any) or the generated img tag.  Note, this parameter is flexible, and the module will attempt many methods to find the source image file on the web server as follows:
<ul>
  <li>First look to see if the specified src value exists as a file on the filesystem.</li>
  <li>Next, check if the value specified for the src parameter is a URL and begins with the uploads_url (as specified in the config.php)</li>
  <li>Next, check if the value specified for the src parameter is a URL and begins with the root_url (as specified in the config.php)</li>
  <li>Next, check if the value specified for the src parameter is a URL and begins with the ssl_url (as specified in the config.php)</li>
</ul>';
$lang['param_style'] = 'Used when creating an img tag, allows specifying alternate styles for the tag.  i.e: style=&quot;border: 1px solid black;&quot;';
$lang['param_title'] = 'Titel-Attribut f&uuml;r das img-Tag (optional), z. B. <code>title=&quot;Dies ist der Tooltip&quot;</code>';
$lang['param_width'] = 'Used when creating an img tag, specify the value for the width attribute.  Note, if this is not specified a value will be automatically calculated for this attribute so that most generated img tags will validate.  You can override this auto calculation with the &quot;noauto&quot; parameter';
$lang['postinstall'] = 'Modul wurde installiert';
$lang['postuninstall'] = 'Alle Daten dieses Moduls wurden entfernt.';
$lang['prompt_croptofit_default_loc'] = 'Standardbereich f&uuml;r &bdquo;Beschneiden und Anpassen&ldquo;';
$lang['prompt_embed_sizelimit'] = 'Basierend auf Bildgr&ouml;&szlig;e';
$lang['prompt_embed_smartlimited'] = 'Smart-Modus, aber Bildgr&ouml;&szlig;e beschr&auml;nken';
$lang['prompt_embed_type'] = 'Bildtyp-basierend';
$lang['prompt_loc_bottomleft'] = 'unten links';
$lang['prompt_loc_bottomcenter'] = 'unten mittig';
$lang['prompt_loc_bottomright'] = 'unten rechts';
$lang['prompt_loc_centerleft'] = 'mittig links';
$lang['prompt_loc_center'] = 'mittig';
$lang['prompt_loc_centerright'] = 'mittig rechts';
$lang['prompt_loc_topleft'] = 'oben links';
$lang['prompt_loc_topcenter'] = 'oben mittig';
$lang['prompt_loc_topright'] = 'oben rechts';
$lang['resizing'] = 'Gr&ouml;&szlig;en&auml;nderung';
$lang['smart'] = 'automatisch';
$lang['submit'] = 'Absenden';
$lang['utma'] = '156861353.1723163456.1323809801.1323809801.1323809801.1';
$lang['utmz'] = '156861353.1323809801.1.1.utmccn=(direct)|utmcsr=(direct)|utmcmd=(none)';
$lang['utmc'] = '156861353';
$lang['utmb'] = '156861353';
?>
