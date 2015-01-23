<h3>What Does This Do?</h3>
<p>This module merely provides convenience api's, re-usable forms, and smarty tags for use in other modules.  It is meant solely from which to build other modules. If you are not a programmer you probably won't need to do anything with this module besides adjust some preferences.</p>
<h3 style="color: #f00;">Notes</h3>
<p>Many modules take advantages of the forms that are provided by the CGExtensions module to assist in managing templates.  When they do, the CGExtensions module information is displayed prominently.  However when you submit, or cancel from these forms you will be returned to the original module.</p>
<h3>How Do I Use It</h3>
<p>Well, you start your own module (I suggest starting with the Skeleton module), and then when you need to use an advanced form object from this library, simply make your module dependant upon FormObjects, and then instantiate an object of the appropriate type.  See the code inside the FormObjects directory for usage instructions.</p>
<h3>Smarty Addons</h3>
<p>This module adds a few smarty conveniences for use with other modules. They are listed and described here:</p>
<ul>
<li><u>cge_module_hint - <em>function</em> plugin</u>
<h5>Description:</h5>
<p>This function plugin can be used to provide hints for module behavior if various parameters cannot be specified on the URL.  I.e: In a situation when a site is configured to use pretty urls for SEO purposes it is often impossible to provide additional module parameters like a detailtemplate or sort order on a URL.  This plugin can be used in page templates, GCBs or in a page specific way to give hints as to how modules should behave.</p>
<p><strong>Note:</strong> Any parameters that are specified on the URL will override matching module hints.   i.e:  When using News and a detailtemplate parameter is specified on a News detail url, any detailtemplate hints will have no effect.</p>
<p><strong>Note:</strong> In order to ensure proper behavior, module hints must be created before the {content} tag is executed in the CMSMS page template.  Therefore they should (normally) be created very early in the page template process.  An ideal location for page specifc hints is in the &quot;Smarty data or logic that is specific to this page:&quot; textarea on the editcontent form.</p>
<h5>Example:</h5>
<p>When using the CGBlog module, and pretty urls.  You wish to display blog articles for a specific category on one page, and would like to use a non standard detail template to display the individual articles on a differernt page.  I.e: perhaps on your &quot;Sports&quot; page you are calling CGBlog like: <code>{CGBlog category=sports detailpage=sports_detail}</code>.  However, using pretty urls it is impossible to specify a detailtemplate on the links that will generate the detail views.  The solution is to use the {cge_module_hint} tag on the <u>sports_detail</u> page to provide some hints as to how CGBlog should behave on that page.</p>
<p>When editing the <u>sports_detail</u> page on the options tab, in the textarea entitled &quot;Smarty data or logic that is specific to this page:&quot; you could enter a tag such as: <code>{cge_module_hint module=CGBlog detailtemplate=sports}.  Now when a user clicks on a link from the CGBlog display on your &quot;sports&quot; page he will be directed to the <u>sports_detail</u> page, and the CGBlog detail template entitled &quot;sports&quot; will be used to display the article.</p>
<h5>Usage:</h5>
<p><code>{cge_module_hint module=ModuleName paramname=value ...}</code></p>
<p><strong>Note:</strong> It is possible to specify multiple parameter hints to a single module in one call to this plugin.</p>
<p><strong>Note:</strong> It is possible to call this module multiple times to provide hints to different modules.</p>
</li><br/>

<li><u>cgerror - <em>block</em> plugin</u>
<p>Description: This block plugin uses the error template (configurable from the CGExtensions admin interface) to display an error message.</p>
<p>optional parameters: 'errorclass' = override the default class name in the template.</p>
<p>i.e: <code>{cgerror}This is error text{/cgerror}</code><br/>
    or: <code>{cgerror}{$errortextvar}{/cgerror}</br>
</p>
</li><br/>

<li><u>{cge_isbot [assign=name]}</u> - <em>function</em> plugin
<p>Description: A plugin to detect wether the request is from a robot.<p>
<p>i.e: <code>{cge_isbot assign='isbot'}{if $isbot}&lt;h3&gt;You are a bot&lt;/h3&gt;{/if}</code></p>
</li><br/>

<li><u>{cge_is_smartphone [assign=name]}</u> - <em>function</em> plugin
<p>Description: A plugin to detect wether the request is from a smart phone such as an iphone or android.<p>
<p>i.e: <code>{cge_is_smartphone assign='isbot'}{if $isbot}&lt;h3&gt;I should do some funky mobile styling here.&lt;/h3&gt;{/if}</code></p>
</li><br/>

<li><u>{cge_get_browser [assign=name]}</u> - <em>function</em> plugin
<p>Description: A plugin to return the name of the detected browser.  Returns a short string indicating the browser type.</p>
<p>i.e: <code>{cge_get_browser assign='isbot'}{if $isbot}&lt;h3&gt;I should do some funky mobile styling here.&lt;/h3&gt;{/if}</code></p>
</li><br/>

<li><u>{cge_isie [assign=name]}</u> - <em>function</em> plugin
<p>Description: A plugin to detect if the current request is made by <em>(eeewww)</em> Internet Exploder.  It returns 0 or 1.</p>
<p>i.e: <code>{cge_isie assign='isbot'}{if $isbot}&lt;h3&gt;I should do some funky mobile styling here.&lt;/h3&gt;{/if}</code></p>
</li><br/>

<li><u>cge_state_options - <em>function</em> plugin</u>
<p>Description: Output a set of &lt;option&gt; tags for states.  The values are US/Canada State/Province abbreviations, the labels are the full length names in english.  This method reads the defined state list as defined in the database.</p>
<p>i.e: <code>&lt;select name="foo"&gt;{cge_state_options selected=&quot;ab&quot;}&lt;/select&gt;</code></p>
</li><br/>

<li><u>cge_country_options - <em>block</em> plugin</u>
<p>Description: Output a set of &lt;options&gt; tags for countries.  The values are approved country codes, the labels are the full length names (in english).  This method reads the country list as defined in the database, and takes into account the priority countries as defined in the CGExtensions admin console.</p>
<p>i.e: <code>&lt;select name=&quot;foo&quot;{cge_country_options selected=&quot;us&quot;}&lt;/select&gt;</code></p>
</li><br/>

<li><u>get_current_url - <em>function</em> plugin</u>
<p>Description: Return the current page url.</p>
<p>Optional Parameters: 'assign' = assign the output to the named smarty variable.</p>
<p>i.e: <code>{get_current_url assign=&quot;cur_url&quot;}{$cur_url}</code></p>
</li><br/>

<li><u>cge_setlist - <em>function</em> plugin</u>
<p>Description: Allows adding items to flat smarty arrays. This plugin returns no output</p>
<p>ParameterS:
  <ul>
    <li>&quot;name&quot; - The name of the smarty array.</li>
    <li>&quot;key&quot; - The array key.<.li>
    <li>&quot;value&quot; - The array value.</li>
  </ul>
</p>
<br/>
<p>i.e: <code>{cge_setlist name='somearray' key='akey' value='avalue'}</code></p>
</li><br/>

<li><u>cge_unsetlist - <em>function</em> plugin</u>
<p>Description: Allows removing items from flat smarty arrays. This plugin returns no output</p>
<p>ParameterS:
  <ul>
    <li>&quot;name&quot; - The name of the smarty array.</li>
    <li>&quot;key&quot; - The array key.<.li>
  </ul>
</p>
<br/>
<p>i.e: <code>{cge_unsetlist name='somearray' key='akey'}</code></p>
</li><br/>

<li><u>cge_yesno_options - <em>function</em> plugin</u>
<p>Description: Output options for a dropdown list that allows selecting two options, &quot;Yes&quot; or &quot;No&quot;.  This plugin will output the &lt;option&gt tags using localized strings for the labels, and integers for the values.</p>
<p>Optional Parameters:
  <ul>
    <li>&quot;prefix&quot; - A prefix to place before the name attribute on the tag.  i.e: prefix=$actionid</li>
    <li>&quot;name&quot; - A name for the select list, if this parameter is specified the system will generate a complete &lt;select&gt; tag.  Otherwise, only &lt;option&gt; tags will be generated.</li>
    <li>&quot;selected&quot; - The value of the currently selected element (either 0 or 1)</li>
    <li>&quot;assign&quot; - Assign the output html code to a newly generated smarty variable.</li>
  </ul>
</p>
<br/>
<p>i.e: <code>{cge_yesno_options prefix=\$actionid name=&quot;send_mail&quot; selected=$send_mail}</code></p>
</li><br/>

<li><u>cge_have_module - <em>function</em> plugin</u>
  <p>Description: Output a boolean (0 or 1) value if a module is installed and ready to use.</p>
  <p>Optional Parameters:
     <ul>
       <li>&quot;m&quot;|&quot;mod&quot;|&quot;module&quot; - Specify the module name</lI>
       <li>&quot;assign&quot; - Assign the output html code to a newly generated smarty variable.</li>
     </ul>
  </p>
<br/>
<p>i.e: <code>{cge_have_module module=&quot;FrontEndUsers&quot assign=&quot;have_feu&quot;}</code></p>
</li><br/>

<li><u>cgimage - <em>function</em> plugin</u>
  <p>Description: Output an image tag, This plugin is typically used in admin templates, as it automatically searches in the admin theme, and in registered icon directories.</p>
  <p>Required Parameters:
    <ul>
      <li>&quot;image&quot; - The filename of the image.  You may specify a filename, or a path relative to the admin theme&quot;s images directory.</li>
    </ul>
  </p>
  <br/>
  <p>Optional Parameters:
    <ul>
      <li>&quot;alt&quot; - Specify alt text for the image.  If not specified, the value of the image parameter will be used.</li>
      <li>&quot;class&quot; - Specify a class for the image tag.</li>
      <li>&quot;width&quot; - Specify an integer width for the image tag.</li>
      <li>&quot;height&quot; - Specify an integer height for the image tag.</li>
      <li>&quot;assign&quot; - Assign the output html code to a newly generated smarty variable.</li>
    </ul>
  </p>
  <br/>
  <p>See also:  CGExtensions->AddImageDir()</p>
  <p>i.e: <code>{cgimage image=&quot;icons/system/newobject.gif&quot;}</code></p>
</li>
<li><u>rfc_date - <em>modifier</em> plugin</u>
<p>Description: Format a supplied time in an RFC consistent manner.  This modifier is particularly useful when generating RSS feeds.</p>
<p>i.e: <code>{$smarty.now|rfc_date}</code></p>
</li><br/>

<li><u>jsmin - <em>block</em> plugin</u>
  <p>Description: Pass content through the javascript minifier.</p>
  <p>Note: You must specify the approprate {literal},{/literal},{ldelim|, and {rdelim} inside the block to allow smarty to process or ignore the code.</p>
  <p>i.e:  <code>{jsmin}&lt;script type="text/javascript"&gt;// alot of javascript code here&lt;/script&gt;{/jsmin}</code></p>
</li><br/>

<li><u>cge_textarea - <em>block</em> plugin</u>
  <p>Description: Create a text area tag, with optional support for wysiwyg editor.  This tag is typically used in admin templates to create text areas.</p>
  <p>Required Parameters:
    <ul>
      <li>&quot;prefix&quot; - A string to prefix the textarea element name.  i.e: {$actionid}</li>
      <li>&quot;name&quot; - The element name.</li>
    </ul>
  </p>
  <br/>
  <p>Optional Parameters:
    <ul>
      <li>&quot;wysiwyg&quot; - An integer value to indicate wether a wysiwyg should be applied (the actual wysiwyg that is used depends on CMSMS site preferrences and user preferences.</li>
      <li>&quot;content&quot; - The content for the text area.</li>
      <li>&quot;class&quot; - An optional class to supply to the text area tag.</li>
      <li>&quot;assign&quot; - Assign the output html code to a newly generated smarty variable.</li>
    </ul>
  </p>
  <br/>
  <p>i.e: <code>{cge_textarea prefix=$actionid name=&quot;description&quot; content=$description wysiwyg=1}</code></p>
</li><br/>

<li><u>cge_str_to_assoc - <em>function</em> plugin</u>
  <p>Description: Convert url parameter type string to an associative array.</p>
  <p>Required Parameters:
    <ul>
      <li>&quot;input&quot; - The input string</li>
    </ul>
  </p>
  <br/>
  <p>Optional Parameters:
    <ul>
      <li>&quot;delim1&quot; - Delimiter for separating the string into a list of variables.  Defaults to &quot;,&quot;</li>
      <li>&quot;delim2&quot; - Delimiter for separating variable into a variable name and value.  Defaults to &quot;=&quot;</li>
      <li>&quot;assign&quot; - Assign the output html code to a newly generated smarty variable.</li>
    </ul>
  </p>
  <br/>
  <p>i.e: <code>{cge_str_to_assoc input=&quot;var1=val1,var2=val2,var3=val3&quot; assign=&quot;tmp&quot;}</code></p>
</li><br/>

<li><u>cge_wysiwyg - <em>function</em> plugin</u>
  <p>Description: display a wysiwyg text area. This parameter will take in mind the currently logged in users selected wysiwyg (or none).  As well as the selected frontend wysiwyg.</p>
  <p>Required Parameters:
    <ul>
      <li>&quot;name&quot; - A name for the textarea field.</li>
    </ul>
  </p>
  <br/>
  <p>Optional Parameters:
    <ul>
      <li>&quot;prefix&quot; - A prefix for the text area name.</li>
      <li>&quot;value&quot;  - An existing value for the text area.</li>
      <li>&quot;rows&quot;   - An optional number of rows for the text area (stylesheets may override this)</li>
      <li>&quot;cols&quot;   - An optional number of columns for the text area (stylesheets may override this)</li>
      <li>&quot;assign&quot; - Assign the output html code to a newly generated smarty variable.</li>
    </ul>
  </p>
</li><br/>

<li><u>cge_cache - <em>block</em> plugin</u>
  <p>Description: Cache html outout between start and end blocks for performance. By default content between the start and end tags is cached to files in the tmp/cache directory for a period of five minutes.  Later versions of this plugin will allow extending the cache lifetime.</p>
  <p><strong>Note:</strong> This is not technically a block plugin, but does behave like one.</p>
  <p><strong>Note:</strong> This is an advanced plugin that can dramatically improve the average performance of your (primarily static) website, though it should be used with caution as using it incorrectly can cause strange behaviour on your site.  This functionality works best when wrapped around smarty tags that query the database and generate static html content.  This plugin should not be used around dynamic functionality or forms.</p>
  <p><strong>Note:</strong> This plugin utilizes file locking to prevent race conditions.  This may present problems on different platforms.  Use this plugin with caution.</p>
  <pp>i.e: <code>{cge_cache}{Products}{/cge_cache}</code></p>
</li>
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
<p>Copyright &copy; 2008, Robert Campbel <a href="mailto:calguy1000@cmsmadesimple.org">&lt;calguy1000@cmsmadesimple.org&gt;</a>. All Rights Are Reserved.</p>
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