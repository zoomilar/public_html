<h3>What does this do?</h3>
<p>This module provides a way to collect, organize, and display information about products and their categories.  This module can stand on its own, or be part of an e-commerce solution if you wish.  The module supports a product existing in more than one category, supports product weight, price, and attribute sets.  Each item in an attribute set can have a price adjustment.  Also a global flag indicates wether the product is 'taxable' or not.</p>
  <p>This module provides multiple custom field definitions, and for the ability to discriminate private from public data.</p>
<h3>Features:</h3>
<ul>
  <li>Numerous Views</li>
    <ul>
      <li>Summary view</li>
      <li>Category List View</li>
      <li>Detail view</li> 
      <li>Hierarchy Drill-down View</li>
    </ul>
  <li>Entirely Database Template Driven</li>
  <p>Numerous templates of each type can be defined, defaults specified for each type, and the template used for each particular view can be specified as a parameter</p>
  <li>Sorting and pagination in the summary view</li>
  <li>Products can exist in multiple categories</li>
  <li>Numerous custom fields can be defined, including images</li>
  <li>Automatic thumbnail creation</li>
  <li>Admin defined fields</li>
  <li>Product attributes (including price adjustment)</li>
  <li>Weight and taxable fields (for use in e-commerce solutions)</li>
  <li>Products can have a status (published or draft) in order to hide products from public display at any time</li>
  <li>Pretty URL Support</li>
  <li><strong>More...</strong></li>
</ul>

<h3>How Do I Use It:</h3>
<ul>
<li>Set preferences</li>
<p>Usually this is just a formality.  You should specify your default weight units, and your default currency symbol for your local environment.</p>
<li>Setup users and permissions</li>
<p>This module uses the 'Modify Templates' permission to allow users to be able to modify the various templates that can be used by this module.  As well, the 'Modify Site Preferences' permission is needed to be able to adjust the modules preferences.  In order to have the ability to modify field definitions, categories, or products, your users will need the 'Modify Products' permission.</p>
<li>(optional) Define one or more categories</li>
<p>This is an optional step, but you will probably want to do this early to prevent having to go back to modify each and every product later.  Adding a category is as simple as clicking on the 'Categories' tab in the Product Managers admin section, and clicking 'Add A Category'.  From there you will be prompted for a category name.</p>
<li>(optional) Define one or more custom fields</li>
<p>This is an optional step.  Custom fields are not needed if this module suits you exactly as it is.  However if you would like to store additional information for each of your products you can create custom fields.  Creating custom fields is similar to creating categories, except that more data is requested.</p>
<p>Currently a number of types of custom fields are available, including: 'textbox','checkbox',and 'textarea', 'dropdown', and 'file'.  Select one of these, give your new field a name, and indicate wether that field should be visible to the public in the various views.  Then hit submit</p>
<li>Create one or more products</li>
<p>You should create one or more products to display in your website content.  Give each product a name, a price (optional) a weight (optional), a status (draft or published), and some information.  Additionally, you can also specify if the product is taxable.</p>
<p>If categories are defined, then a checkbox will appear for each defined category.  You can simply click the checkbox fields for each category that this product should belong to.</p>
<p>If custom fields are defined, then input fields appropriate to the type of custom field will appear and allow you to specify data for each of them.  This data is optional.</p>
<li>Add the appropriate tags into your page templates or page content</li>
<p>This can be as simple as adding the <strong>{Products}</strong> tag into the content area of one of your pages, or into your page template.</p>
<p>If you wish to alter the behaviour of this application from its default, you can do that by adding one or more parameters to the <strong>{Products}</strong> tag.  The complete list of parameters and their behaviour is listed below.  But for example, to display a list of products in a single, existing category, you could use a tag like <code>{Products category='categoryname'}</code></p>
</ul>
<h3>Smarty Plugins</h3>
<p>This module also registers one or more smarty plugins to aide in retrieving various products related information when designing products module templates:</p>
<ul>
  <li>{products_getcategory categoryid='99' [assign='tmp']}
  <p>This plugin allows retrieving all of the information for a specific category id and optionally assigning it to the named smarty variable.  The returned is an object containing all of the information about a category, including its field values.<br/>i.e:. <code>{products_getcategory categoryid=1 assign='tmp'}Category name = {\$tmp->name}</code></p>
  </li>
  <li>{products_hierarchy_breadcrumb hierarchyid='99' [pageid=alias] [delim=' &raquo '][assign='tmp']}
  <p>This plugin allows retrieving the breadcrumb path to a particular hierarchy id and optionally assigning it to the named smarty variable.  This plugin will output zero or more links to hierarchy views with one link for each level in the hierarchy.  To specify a different delimiter use the "delim" argument.  If an empty delimiter is specified, then an array of links will be returned rather than one coninuous html segment.  To specify a different page id forthe links, use the pageid attribute.   If the pageid attribute is not specified, and the hierarchy id preference is set it will be used.  Otherwise the current page id will be used.</p>
  </li>
  <li>{products_hierarchy_parent hierarchyid=99 [assign='tmp']}
  <p>This plugin will return the parent hierarchy id for a given hierarchy id.  If the specified hierarchy id does not exist, then nothing will be returned.  if the specified hierarchy id does not have a parent this plugin will return -1.</p>
  </li>
</ul>
<h3>The <em>ajax_propval</em> Action</h3>
  <p>The <em>ajax_propval</em> is a special action that is used to return the distinct values of a custom field, or a property via json.  Typically this action is used to perform autocomplete actions, and usually in conjunction with the search action.  This action accepts the parameters: field for the name of the field, and fieldval for indicating a starting value.  None of the parameters can be empty.  Below you will find a simple example of using the ajax_propval action to perform autocomplete for product names in conjunction with the search template.</p>
<pre><code>&lt;script type="text/javascript"&gt;{literal}
$(document).ready(function(){
  var ajax_url = '{/literal}<span style="color: green;">{module_action_link module=Products action=ajax_propval urlonly=1 jsfriendly=1}</span>{literal}';
  ajax_url = ajax_url + <span style="color: red;">'&showtemplate=false'</span>;

  $(<span style="color: blue;">'#productname'</span>).autocomplete({
    source: function(req,add){
      var tmp =  ajax_url+<span style="color: red;">'&cntnt01field=::name::&cntnt01fieldval='</span>+req.term;
      $.getJSON(tmp,function(json){
        if( json.status == 'OK' && json.data.length > 0) {
          add(json.data);
        }
      })
    }    
  });
});
{/literal}&lt;/script&gt;
</code></pre>
<p>As you can see from the above code snippet.. the {module_action_link} plugin from CGSimpleSmarty is used to generate a url that will trigger the ajax_propval action.  After that URL is retrieved, the showtemplate=false parameter is added to the URL.   When setting up the autocomplete plugin, the callback used to fill in the data values for the field uses ajax.  We take the ajax_url already prepared and add the field=::name:: and fieldval=req.term parameters to the URL.  The term is automatically provided by the autocomplete plugin in the req.term variiable.</p>
<p>To use this example, the user would need to ensure that jquery is loaded, along with the jquery ui (including autocomplete), and any required stylesheets.  This could be done either in the page specific metadata field when editing the page containing the search form, or in the page template itself.</p>
<h3>Support</h3>
<p>This module does not include commercial support.  However there are a number of resources available to help you with it:</p>
<ul>
<li>For the latest version of this module, FAQs or to file a bug report, please visit the cms made simple <a href="http://dev.cmsmadesimple.org">Developers Forge</a> and do a search for 'Products'</li>
<li>To obtain commercial support, please send an email to the author at <a href="mailto:calguy1000@cmsmadesimple.org">Robert Campbell</a>.</li>
<li>Additional discussion of this module may also be found in the <a href="http://forum.cmsmadesimple.org">CMS Made Simple Forms.</a></li>
<li>For some questions and limited technical support, the author can often be found in the <a href="irc://irc.freenode.net/#cms">CMS IRC Channel</a>.</li>
</ul>
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
