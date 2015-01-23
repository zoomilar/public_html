<?php
# A
$lang['act_cachecleaned'] = 'Cache Cleaned';
$lang['add_row'] = 'Add Row';
$lang['alias'] = 'Alias';
$lang['aliases'] = 'Aliases';
$lang['ask_clear_image_cache'] = 'Are you sure you want to remove ALL files from the image cache?';

# C
$lang['clear_all'] = 'Clear All Files';
$lang['clear_now'] = 'Clear Now';
$lang['cache_path'] = 'Cache Path';

# D
$lang['delete'] = 'Delete';

# E
$lang['embedding'] = 'Embedded Images';
$lang['embedding_mode'] = 'Image Embedding Mode';
$lang['embed_sizelimit'] = 'Embeddable image size limit (kb)';
$lang['embed_types'] = 'Embeddable image type';
$lang['enable_responsive'] = 'Enable Responsive Images';
$lang['error_alias_duplicatename_atrow'] = 'Duplicate alias name specified for alias at row %d';
$lang['error_alias_noname_atrow'] = 'No name specified for alias at row %d';
$lang['error_alias_nooptions_atrow'] = 'No options specified for alias at row %d';
$lang['error_invalid_age'] = 'Age preference invalid... No operation performed';
$lang['error_missingparam'] = 'A required parameter was missing or invalid: %s';
$lang['error_invalidparam'] = 'Invalid parameter in call: %s';
$lang['error_srcnotfound'] = 'Could not find a file at: %s';
$lang['error_remotefile'] = 'Problem retrieving remote file at %s';
$lang['error_unknownfilter'] = 'CGSmartImage - Unknown Filter: %s';

# F
$lang['friendlyname'] = 'Calguys Smart Image Toolkit';

# G
$lang['general'] = 'General';

# H

# I
$lang['info_aliases'] = 'Aliaes can be used via the alias1 through alias5 options on the CGSmartImage tag to combine numerous frequently used options';
$lang['info_croptofit_default_loc'] = 'Specify the default location from which to &quot;crop to fit&quot; this will effect all crop to fit operations unless the location parameter on the filter_croptofit attribute overrides it.  Default location is &quot;center&quot;';
$lang['info_responsive'] = 'If enabled, CGSmartImage will attempt to detect the maximum resolution of the requesting device and automatically rescale the image so that under no circumstances can the output image be too large for the display.  This assists in performance when developing mobile websites.';
$lang['info_responsive_breakpoints'] = '<strong>Experimental:</strong> If specified, and a mobile device is detected the breakpoints will be used to determine the maximum largest edge for the resulting image.  Specify a list of comma separated increasing integers <em>(i.e: 200,400,600,800)</em>. The device capabilties will be used to find the closest matching breakpoint value.  The image will be resized so that its largest edge is at that value without upscaling.  Aspect ratio will be maintained.';
$lang['image_url_hascachedir'] = 'Does the URL above acount for the cache path? ie. (uploads/_CGSmartImage)';
$lang['image_url_prefix'] = 'Image Url Prefix';
$lang['info_cache_age'] = 'Specify the maximum age of a file (in days) before it will be removed and forced to regenerate.  This is useful if you have changed some of the parameters used when generating images, or to control the amount of disk space used.  Entering 0 will disable automatic file deletion';
$lang['info_cache_path'] = 'Cache path for cache images to be stored. Cache path is relative to config reference "root_path".';
$lang['info_embed_mode'] = 'This selection determines how the {smartimg} tag will generate output.  If &quot;none&quot; is selected no image embedding will be performed.  If &quot;smart&quot; is selected then the system will decide based on the image size, type, and the browser that is requesting the image.  Other options include always embedding based on the image size, or the image type.';
$lang['info_embed_sizelimit'] = 'If the embedding option is determied by the image size, specify the maximum size (in kilobytes) for images to be embedded (32 is recommended).';
$lang['info_embed_types'] = 'If the embedding option is determined by the image type, specify the extensions of the files that should be embedded here separated by commas.  This option is not case sensitive';
$lang['info_image_url_hascachedir'] = 'If your CDN is pointing directly at the image cache directory then you may want to turn this option on.';
$lang['info_image_url_prefix'] = 'Specify the URL to prefix to all generated images.  By default this is the uploads URL, however if you have your own CDN (or multiple domains pointing at the same directory) You may want to specify a different name here';

# M
$lang['max_cache_age'] = 'Maximum Cache File Age (days)';
$lang['moddescription'] = 'A smart image tag generation module for CMSMS';
$lang['msg_aliases_updated'] = 'Aliases Updated';
$lang['msg_cachecleaned'] = 'Cache directory cleaned. %d files removed';
$lang['msg_cacheremoved'] = 'Cache Removed';
$lang['msg_prefsupdated'] = 'Preferences Updated';

# N
$lang['none'] = 'None';

# O
$lang['options'] = 'Options';

# P
$lang['param_alias'] = 'The CGSmartImage admin panel allows creating numerous command alias to combine a frequently used pattern of arguments into one name.  To use these aliases use an argument of the form alias##=alias_name i.e:  alias1=foo alias2=foo.';
$lang['param_alt'] = 'Used when creating an img tag, specify the value for the alt attribute.  Note, if this is not specified a value will be automatically calculated for this attribute so that most generated img tags will validate.  You can override this auto calculation with the &quot;noauto&quot; parameter';
$lang['param_class'] = 'Used when creating an img tag, allows specifying one or more classes to include on the tag.  i.e: class="fancybox,thumbnail"';
$lang['param_filter_blur'] = '(anything) Specify any value for this parameter to add a blur filter to the image';
$lang['param_filter_brightness'] = '(integer) Incrase the brightness of the processed image by the integer value specified';
$lang['param_filter_colorize'] = '(r,g,b[,alpha]) - Like filter_grayscale however you can specify the color and alpha value';
$lang['param_filter_contrast'] = '(integer) Change the contrast of the image by the integer value specified';
$lang['param_filter_crop'] = '(percent[,h_align,v_align]) - Perform cropping on the image specified. Crop parameeters are specified as a comma separated list of parameters.  The first (required) value is an integer percentage of the original image size.  The optional second and third parameters are one of l,c,r (left,center,right) and t,c,b (top,center,bottom) specifying where the location within the source image to crop from.  i.e: crop=33,b,r to grab a crop of 33% from the bottom right of the source image.';
$lang['param_filter_croptofit'] = '(width,height[,location[,upscale]]) - Perform a croptofit on the image specified. This attempts to rescale the image to the destination size while reatining aspect ratio, then focus on the selected area of the resized image.  Crop to fit parameters are specified as the desired width and height for the destination image along with an (optional) location code, and upscale flag.  valid location codes are tl,tc,tr,cl,c,cr,bl,b,br for the 9 relative positions within the image.  If a location is not specified a preference will be used.  The default value is &quot;c&quot; to crop-to-fit from the center of the source image.  By default upscaling is disabled on this filter.';
$lang['param_filter_edgedetect'] = '(anything) Hilight the edges in the image';
$lang['param_filter_emboss'] = '(anything) Emboss the image';
$lang['param_filter_flip'] = '(mode) - Perform a flip on the specified image.  Specify 0 for horizontal, 1 for vertical, and 2 for flip in both directions.';
$lang['param_filter_grayscale'] = '(anything) Convert the image to grayscale';
$lang['param_filter_meanremoval'] = '(anything) Attempt to achieve a &quot;sketchy&quot; effect';
$lang['param_filter_negate'] = '(anything) Negate the image';
$lang['param_filter_pixelate'] = '(size[,advanced]) Pixelate the image, specify an integer size and an optional boolean (default is false) to enable advanced pixelation';
$lang['param_filter_reflect'] = '([reflection_height[,reflection_opacity[,divider_height]]]), Creates reflection of image, currently working only with jpg,jpeg images against white background.';
$lang['param_filter_resize'] = 'type,number[,number[,upscale]] - Perform a resize of the source image.  By default, the resize filter allows upscaling.  Possible values are:
<ul>
  <li>p,number - Perform a simple rescale to a certain percentage.  i.e:  resize=p,50 to resize to 50% of the original size.</li>
  <li>p,number,0 - Perform a simple rescale to a certain percentage.  i.e:  resize=p,50 to resize to 50% of the original size. Do not allow upscaling</li>
  <li>w,number - Perform a resize to a specified width (while retaining aspect ratio). i.e: resize=w,80 to create a thumbnail with a maximum width of 80 pixels.</li>
  <li>w,number,0 - Perform a resize to a specified width (while retaining aspect ratio). i.e: resize=w,80 to create a thumbnail with a maximum width of 80 pixels. Do not allow upscaling</li>
  <li>h,number - Perform a resize to a specified height (while retaining aspect ratio). i.e: resize=h,80 to create a thumbnail with a maximum height of 80 pixels.</li>
  <li>h,number,0 - Perform a resize to a specified height (while retaining aspect ratio). i.e: resize=h,80 to create a thumbnail with a maximum height of 80 pixels. Do not allow upscaling</li>
  <li>e,number - Perform a resize resizing the largest edge to the specified value (while retaining aspect ratio). i.e: resize=e,100 to create a thumbnail whos largest edge is 100 pixels.</li>
  <li>e,number,0 - Perform a resize resizing the largest edge to the specified value (while retaining aspect ratio). i.e: resize=e,100 to create a thumbnail whos largest edge is 100 pixels.  Do not allow upscaling.</li>
  <li>c,x,y - Perform a resize to a custom size (without retaining aspect ratio).  i.e: filter_resize=c,50,75 to create a thumbnail that is 50x75 pixels.</li>.
  <li>c,x,y,0 - Perform a resize to a custom size (without retaining aspect ratio).  i.e: filter_resize=c,50,75 to create a thumbnail that is 50x75 pixels. Do not allow upscaling.</li>.
</ul>';
$lang['param_filter_resizetofit'] = '(width,height[,color[,alpha]]) - Perform a resize on the image specified. This attempts to rescale the image to the destination size while reatining aspect ratio, the image is centered in the box specified (either horizontally or vertically depending upon aspect ratio and the destination size, and the image is surrounded by the supplied color.  Colors can be specified by name (see the X11 color names), or by #nnnnnn hexadecimal format, or as rgb values separated by a : i.e:  filter_croptofit=600,400,#ff0000.  The special color value &quot;transparent&quot; can be specified to force the background to be transparent.   An alpha value may be specified between 0 and 127 to specify different degrees of translucency for the background.   At no time will this plugin perform any upscaling.';
$lang['param_filter_rotate'] = '(angle) Specify the integer angle (counter clockwise) to rotate the image, The image is rotated about its center.';
$lang['param_filter_roundedcorners'] = '(radius) Specify an integer radius (in pixels) for rounding the corners.';
$lang['param_filter_watermark'] = '(anything), Specify that the watermark (as specified in the CGExtensions admin panel) should be applied to the image';
$lang['param_height'] = 'Used when creating an img tag, specify the value for the height attribute.  Note, if this is not specified a value will be automatically calculated for this attribute so that most generated img tags will validate.  You can override this auto calculation with the &quot;noauto&quot; parameter.  This parameter will also be used in conjunction with the &quot;width&quot; parameter to perform a final resizing or croptofit filter (unless the &quot;noautoscale&quot; parameter is also supplied)';
$lang['param_id'] = 'Used when creating an img tag, allows specifying an id attribute to include on the tag.  i.e: id="sometag"';
$lang['param_max_height'] = 'This parameter allows specifying a maximum height for the converted images.';
$lang['param_max_width'] = 'This parameter allows specifying a maximum width for the converted images.';
$lang['param_name'] = 'Used when creating an img tag, specify the value for the name attribute.';
$lang['param_noauto'] = 'Do not automatically calcualte parameters for the img tag.  This may cause your site to fail validation if some required parameters (width,height,alt) are not specified';
$lang['param_noautoscale'] = 'If width and height parameters are specified, this parameter will disable automatic scaling of the image.  This parameter will be disabled for mobile browsers';
$lang['param_nobcache'] = 'Do not allow the resized image to cache in the browser (useful for development purposes) this adds a unique number as a parameter to the image which will force the browser not to cache the image.';
$lang['param_nobreakpoints'] = '<strong>Experimental:</strong> For responsive image handling, disable breakpoints and force regular resize handling for images on mobile browsers.';
$lang['param_noembed'] = 'Force the image to not embed.  Regardless of settings in the admin panel, the URL and tag generated will be to a file on the server.  No embedding will be performed';
$lang['param_notimecheck'] = 'Disable time checking of cached files.';
$lang['param_noremote'] = 'Do not allow retrieving sources from remote URLS';
$lang['param_noresponsive'] = 'Do not perform responsive image resizing';
$lang['param_norotate'] = 'Do not attempt to read exif information from the file and correct image rotation';
$lang['param_notag'] = 'Do not output an img tag, only the url to the cached image.  This has no effect when CGSmartImage is used from within a stylesheet.';
$lang['param_overwrite'] = 'Disable all caching and force re-calculation of all filters';
$lang['param_quality'] = 'Specify the quality of the output image.  A value between 0 and 100.  The default value if not specified is 75.';
$lang['param_rel'] = 'Used when building an image tag allows specifying an optional rel attribute (typically used with javascript type albums). i.e: rel="album"';
$lang['param_silent'] = 'Silently ignore errors';
$lang['param_src'] = 'Specify the source for the image processing (if any) or the generated img tag.  Note, this parameter is flexible, and the module will attempt many methods to find the source image file on the web server as follows:
<ul>
  <li>First look to see if the specified src value exists as a file on the filesystem.</li>
  <li>Next, check if the value specified for the src parameter is a URL and begins with the uploads_url (as specified in the config.php)</li>
  <li>Next, check if the value specified for the src parameter is a URL and begins with the root_url (as specified in the config.php)</li>
  <li>Next, check if the value specified for the src parameter is a URL and begins with the ssl_url (as specified in the config.php)</li>
</ul>
It is also possible to split the src parameter into multiple arguments, which is useful for example when the path to the file, and the filename are stored in separate smarty variables.   You can specify the src as src1=\$the_path src2=\$the_filename.  The system will automatically add a / in between each argument.  There is no limit to the number of src parameters.';
$lang['param_style'] = 'Used when creating an img tag, allows specifying alternate styles for the tag.  i.e: style="border: 1px solid black;"';
$lang['param_title'] = 'Specify an optional title attribute for the img tag.  i.e: title="This is the tooltip"';
$lang['param_width'] = 'Used when creating an img tag, specify the value for the width attribute.   Note, if this is not specified a value will be automatically calculated for this attribute so that most generated img tags will validate.  You can override this auto calculation with the &quot;noauto&quot; parameter.  This parameter will also be used in conjunction with the &quot;height&quot; parameter to perform a final resizing or croptofit filter (unless the &quot;noautoscale&quot; parameter is also supplied)';

$lang['postinstall'] = 'Module installed';
$lang['postuninstall'] = 'All data associated with this module has been removed';
$lang['prompt_croptofit_default_loc'] = 'Default location from which to &quot;crop to fit&quot;';
$lang['prompt_embed_sizelimit'] = 'Based on image size';
$lang['prompt_embed_smartlimited'] = 'Smart mode but limit image size';
$lang['prompt_embed_type'] = 'Based on image type';
$lang['prompt_loc_bottomleft'] = 'Bottom Left (bl)';
$lang['prompt_loc_bottomcenter'] = 'Bottom Center (bc)';
$lang['prompt_loc_bottomright'] = 'Bottom Right (br)';
$lang['prompt_loc_centerleft'] = 'Center Left (cl)';
$lang['prompt_loc_center'] = 'Center (c)';
$lang['prompt_loc_centerright'] = 'Center Right (cl)';
$lang['prompt_loc_topleft'] = 'Top Left (tl)';
$lang['prompt_loc_topcenter'] = 'Top Center (tc)';
$lang['prompt_loc_topright'] = 'Top Right (tr)';

# R
$lang['resizing'] = 'Resizing';
$lang['responsive'] = 'Responsiveness';
$lang['responsive_breakpoints'] = 'Specify responsive image maximum edge breakpoints';

# S
$lang['smart'] = 'Smart';
$lang['submit'] = 'Submit';

?>
