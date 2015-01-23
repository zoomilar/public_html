<ul>
  <li>Version 1.0 - Initial Release</li>
  <li>Version 1.0.1 - Bug fixes.</li>
  <li>Version 1.0.2 - Bug fixes.</li>
  <li>Version 1.0.3 - Bug fixes.</li>
  <li>Version 1.1 - March 2011
    <ul>
      <li>Adds the croptofit filter.</li>
      <li>Adds automatic image resizing.</li>
    </ul>
  </li>
  <li>Version 1.1.1 - March 2011
    <ul>
      <li>Fixes to croptofit.</li>
    </ul>
  </li>
  <li>Version 1.1.1 - May 2011
    <ul>
      <li>Fixes to GIF image handling.</li>
      <li>Add a bit more intelligence into image src handling.</li>
    </ul>
  </li>
  <li>Version 1.1.2 - May 2011
    <ul>
      <li>Many minor bug fixes.</li>
    </ul>
  </li>
  <li>Version 1.2 - May 2011
    <ul>
      <li>Adds rounded image corner support... with transparency.</li>
    </ul>
  </li>
  <li>Version 1.2.1 - May 2011
    <ul>
    <li>Fixes problems with IE7 and embedding (IE7 wont embed, as much as I try to make it).</li>
    <li>Requires new version of CGExtensions that does crude hack for mime type detection on windoze servers.</li>
    </ul>
  </li>
  <li>
  </li>Version 1.3 - May 2011
  <li>
    <ul>
    <li>Adds support for jpeg auto-rotation via EXIF.</li>
    <li>Adds a flip filter.</li>
    <li>Adds command aliases.</li>
    <li>Adds support for multiple src## arguments.</li>
    </ul>
  </li>
  </li>Version 1.3.1 - May 2011
  <li>
    <ul>
    <li>Supress a warning.</li>
    </ul>
  </li>
  </li>Version 1.4 - July 2011
  <li>
    <ul>
    <li>Adds the {cgsi_convert} tag.</li>
    </ul>
  </li>
  </li>Version 1.4.1 - July 2011
  <li>
    <ul>
    <li>Address an issue with the CMS_STYLESHEET global occassionally being set, which results in the notag stuff messing up.</li>
    </ul>
  </li>
  </li>Version 1.4.2 - July 2011
  <li>
    <ul>
    <li>Minor bug fixes.</li>
    </ul>
  </li>
  <li>Version 1.5 - August 2011
    <ul>
    <li>Minor Bug Fixes.</li>
    <li>Fixes issues with cgsi_convert.</li>
    <li>Adds documentation for the title, rel, and id parameters.</li>
    <li>Adds the ability to download images from a remote site, cache them.. and process them.</li>
    </ul>
  </li>
  <li>Version 1.5.1 - September, 2011
    <ul>
      <li>Minor bug fixes.</li>
    </ul>
  </li>
  <li>Version 1.6 - October, 2011
    <ul>
      <li>Adds the ability to specify a crop-to-fit location other than center.</li>
      <li>Adds a preference for the default crop-to-fit location, but changing this will not generate new images... you will need to clear your generated image files.</li>
      <li>crop-to-fit filter now checks for possible upscaling and will not allow it.</li>
      <li>rename the nocache parameter to nobcache to remove conflict with CGExtensions.</li>
      <li>Fixes a bug with multiple class names specified in aliases.</li>
      <li>Fixes a bug in the resize filter.</li>
      <li>Fixes a bug where if nothing happened in an image filter (due to constraints) the system would not safe the file.</li>
      <li>Adds a resizetofit filter.</li>
      <li>Generated files no longer have an extension to prevent inconsistencies in file types.</li>
    </ul>
  </li>
  <li>Version 1.6.1 - November, 2011
    <ul>
      <li>Minor fixes to cgsi_convert.</li>
    </ul>
  </li>
  <li>Version 1.7 - February, 2012
    <ul>
      <li>Adds the ability to check the time of the source image to aide in deciding if the cached image needs to be generated/re-generated.</li>
      <li>Fixes to the resize filter.</li>
      <li>Resample instad of resize by default in the resize filter.</li>
      <li>Create an index.html file in the image directory to prevent browsing.</li>
    </ul>
  </li>
  <li>Version 1.8.1 - February, 2012
    <ul>
      <li>Adds the silent param to hide errors.</li> 
      <li>Adds resize to largest edge to filter_resize.</li>
      <li>Removes lazyloading so that {cgsi_converT} will work.</li>
      <li>some minor fixes.</li>
    </ul>
  </li>
 <li>Version 1.8.4 - May, 2012
    <ul>
      <li>Fixes to cgsi_convert.</li>
      <li>Removes the color parameter from filter_rotate.</li>
      <li>Fixes warnings.</li>
      <li>Code cleanup.</li>
    </ul>
 </li>
 <li>Version 1.9 - May 2012
   <ul>
     <li>Adds responsive image capabilities with web service based mobile device detection.</li>
     <li>Improves path detection.</li>
   </ul>
 </li>
 <li>Version 1.10 - Jan 2013
   <ul>
      <li>Adds reflection filter (thanks to Tapio)... note only works well with jpeg images</li>
   </ul>
 </li>
</ul>
