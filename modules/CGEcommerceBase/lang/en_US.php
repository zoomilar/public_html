<?php
#A
$lang['ask_really_uninstall'] = 'Are you really sure that you want to uninstall this module';
$lang['attrib_item_description'] = 'Product Attribute Display Template';

#B


#C
$lang['cart_module'] = 'Cart Module';
$lang['currency_code'] = 'Currency Code';
$lang['currency_symbol'] = 'Currency Symbol';

#D


#E
$lang['error_invalidaddress'] = 'Address specified is invalid (missing one or more required fields?';
$lang['event_desc_CartAdjusted'] = 'Called when bulk adjustments are done to the cart, or one of its baskets';
$lang['event_desc_CartItemAddPre'] = 'Called prior to an item being added to the cart';
$lang['event_desc_CartItemAdded'] = 'Called when a single product or service is added to the cart';
$lang['event_desc_OrderCreated'] = 'Called after an order is initially inserted into the database';
$lang['event_desc_OrderDeleted'] = 'Called after an order has been completely removed';
$lang['event_desc_OrderUpdated'] = 'Called after an existing order has been saved';
$lang['event_help_CartItemAddPre'] = <<<EOT
<p>Sent prior to an item being added to the cart, this event is called after the cart policy is checked, and can be used to alter the item.</p>
<h4>Parameters:</h4>
<ul>
<li>&quot;existing_items&quot; - <em>(read only)</em>  An array of cg_ecomm_cartitem items representing the existing items in the cart.</li>
<li>&quot;cart_item&quot; - <em>(modifiable)</em> A reference (modifiable) to a cg_ecomm_cartitem object representing the item that is proposed to add to the cart.</li>
</ul>
EOT;
$lang['event_help_CartAdjusted'] = <<<EOT
<p>Sent when bulk adjustments are done to the cart, or one of its baskets.</p>
<h4>Parameters:</h4>
<ul>
<li>&quot;cart_items&quot; - An hash of baskets, each containing an array of cart item objects and some summary information.</li>
<li>&quot;status&quot; - A status string, indicating wether this is before, or after the items have changed.</li>
<li>&quot;extra&quot; - An additional string that may provide some state information as to when this action was called';
</ul>
EOT;
$lang['event_help_CartItemAdded'] = <<<EOT
<p>Sent when bulk adjustments are done to the cart, or one of its baskets.</p>
<h4>Parameters:</h4>
<ul>
<li>&quot;cart_item&quot; - The single cart item object that was added.</li>
</ul>
EOT;
$lang['event_help_OrderCreated'] = <<<EOT
<p>Sent after an order is initially inserted into the database.</p>
<h4>Parameters:</h4>
<ul>
<li>&quot;order_id&quot; - The newly created order id.</li>
</ul>
EOT;
$lang['event_help_OrderDeleted'] = <<<EOT
<p>Sent after an order is removed from the database.</p>
<h4>Parameters:</h4>
<ul>
<li>&quot;order_id&quot; - The deleted order id.</li>
</ul>
EOT;
$lang['event_help_OrderUpdated'] = <<<EOT
<p>Sent after an order is updated</p>
<h4>Parameters:</h4>
<ul>
<li>&quot;order_id&quot; - The order id.</li>
</ul>
EOT;

#F
$lang['friendlyname'] = 'Calguys Ecommerce Base';

#G
$lang['gateway_policy'] = 'Gateway Policy';

#H
$lang['help'] = <<<EOT
<h3>What does this do?</h3>
  <p>This module provides a common base of communications for all ecommerce modules.  It allows specifying which available suppliers you wou would like to use, as well as cart, tax, shipping, and payment gateways.  It also provides a suite of apis for communication of data between the various modules.</p>
<h3>Features:</h3>
<p>This module provides no plugin interface of its own (with the exception of the tag that can be used to add items to the cart.... see below.</p>
<h3>How Do I Use It:</h3>
<p>After installation of all of the desired ecommerce modules you should enter the CGEcommerceBase admin panel and configure the various options.</p>
<h3>Smarty Tags</h3>
<ul>
  <li><span style="color: blue;">{cgecomm_form_addtocart source=Products produc=\$num}</span>
   <p>This tag uses the currently selected cart module and displays a form to allow the user to add an item to the cart.<br/>Parameters:</p>
   <ul>
    <li>source - specify the name of the source module.  This module must be selected as a supplier in the CGEcommerceBase admin panel.</li>
    <li>product - specify the unique <em>(integer)</em> identifier of the product within the source module.</li>
   </ul>  
   <p>Any other arguments passed to this tag are passed to the appropriate module, for example for specifying a different template you may want to add an &quot;addtocarttemplate=foo&quot; argument.</p>
  </li>
  <li><span style="color: blue;">{cgecomm_erasecart}</span>
    <p>This tag empties all information from the currently selected cart, and sets the visitors basket back to a completely empty state.</p>
  </li>
  <li><span style="color: blue;">{cgecomm_company_address [assign='string']}</span>
   <p>This tag retrieves the company address from the database, and assigns it to the named smarty variable.</p>
  </li>
  <li><span style="color: blue;">{cgecomm_currency_code [assign=string]}</span> - Returns the currently set currency code.</li>
  <li><span style="color: blue;">{cgecomm_currency_symbol [assign=string]}</span> - Returns the currently set currency symbol.</li>
  <li><span style="color: blue;">{cgecomm_weight_units [assign=string]}</span> - Returns the currently set weight units.</li>
  <li><span style="color: blue;">{cgecomm_weight_units [assign=string]}</span> - Returns the currently set weight units.</li>
  <li><span style="color: blue;">{cgecomm_length_units [assign=string]}</span> - Returns the currently set length units.</li>
  <li><span style="color: blue;">{cgecomm_cartitem_exists [source=string] [product=integer|sku=string] [extra=mixed] assign=string]}</span> - Returns the currently set weight units.
    <p>Returns either 0 or 1 depending on if the item (identified by either the prouct id, or sku exists in the cart.</p>
  </li>
  
</ul>
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
EOT;

#I
$lang['info_attrib_item_description'] = 'The template used for displaying attribute dropdowns.  Possible variables are {$currency_symbol},{$weight_units},{$attrib_adjust},{$attrib_text},{$attrib_sku}';
$lang['info_cart_module'] = 'Numerous modules that act as &quot;Shopping Carts&quot; may be downloaded.  Each of them with different behaviours.  Please select one of the installed cart modules from this list';
$lang['info_cart_policy'] = 'The cart policy is influenced by the capabilities of the payment gateway, and determines how many, and what type of items may be added to he cart(s).  You may further restrict the cart policy, but cannot bypass the restrictions placed by the gateway.';
$lang['info_lineitem_desc_template'] = 'This template is used to format the single line description for a cart item.  This same description is used for the line item in order processing.';
$lang['info_overweight_limit'] = 'The weight at which an item should be shipped in its own package';
$lang['info_packaging_module'] = 'Select a module responsible for arranging the various items selected in an order for packaging.  If none is selected, then the shipping maycalculate costs independantly on each order item.';
$lang['info_payment_module'] = 'Numerous modules that perform the functionality of allowing online payments may be downloaded.  Each of them with different behaviours.  Please select one of the installed payment modules from this list';
$lang['info_promotions_module'] = 'Numerous modules that perform the functionality of providing coupons or various forms of discounts may be downloaded.  Each of them with different behaviours.  Please select one of the installed promotions modules from this list';
$lang['info_ship_dimensions'] = 'Field (of type dimensions) from the Products module that indicates the shippable dimensions for this product';
$lang['info_ship_seperately'] = 'Field (of type checkbox) from the Products module which indicates that this value should be shipped as its own package';
$lang['info_shipping_module'] = 'Numerous modules that perform shipping cost calculations may be downloaded.  Each of them with different behaviours.  Please select one of the installed  modules from this list';
$lang['info_supplier_modules'] = 'Supplier modules are capable of interacting with the cart and answering requests from order processing modules.  You may select multiple supplier modules.';
$lang['info_tax_module'] = 'Numerous modules that perform tax calculation may be downloaded.  Each of these with different behaviours.  Please select one of the installed tax modules from this list';
$lang['info_tax_shipping'] = 'In some locations shipping may not be taxable.  Use this option to ensure that no shipping costs are taxed';

#J


#K


#L
$lang['length_units'] = 'Length Units';
$lang['lineitem_desc_template'] = 'Line Item Description Template';


#M
$lang['max_products'] = 'Maximum Number of Products in one Cart';
$lang['max_services'] = 'Maximum Number of Services in one Cart';
$lang['max_subscriptions'] = 'Maximum Number of Subscriptions in one Cart';
$lang['mixed_subscriptions'] = 'Allow a mixture of products, services and subscriptions in one cart?';
$lang['module_description'] = 'A base class for all e-commerce modules this utility also provides common preferences and connectors for the various portions of the ecommerce suite';

#N
$lang['no'] = 'No';
$lang['none'] = 'None';
$lang['not_applicable'] = 'Not Applicable';

#O


#P
$lang['packaging_module'] = 'Packaging Module';
$lang['payment_module'] = 'Online Payment Gateway Module';
$lang['postinstall'] = 'The CGEcommerceBase module is now installed, you may now proceed to install more components to the ecommerce suite to fill out your required functionality.  Once they are installed return to this modules administration panel to continue the configuration';
$lang['postuninstall'] = 'This module and all associated data have been removed from the CMSMS database.  You are now safe to remove its files';
$lang['promotions_module'] = 'Promotions Module';
$lang['prompt_company'] = 'Company';
$lang['prompt_firstname'] = 'First Name';
$lang['prompt_lastname'] = 'Last Name';
$lang['prompt_maxweight'] = 'Max Weight';
$lang['prompt_address1'] = 'Address Line 1';
$lang['prompt_address2'] = 'Address Line 2';
$lang['prompt_city'] = 'City';
$lang['prompt_state'] = 'State / Province';
$lang['prompt_postal'] = 'Postal / Zip Code';
$lang['prompt_country'] = 'Country';
$lang['prompt_fax'] = 'Fax';
$lang['prompt_email'] = 'Email Address';
$lang['prompt_phone'] = 'Phone';
$lang['prompt_overweight_limit'] = 'Overweight Limit';
$lang['prompt_shipping_boxes'] = 'Shipping Boxes';
$lang['prompt_width'] = 'Width';
$lang['prompt_height'] = 'Height';
$lang['prompt_length'] = 'Length';
$lang['prompt_weight'] = 'Weight';
$lang['prompt_sorting'] = 'Priority';
$lang['prompt_name'] = 'Name';


#Q


#R
$lang['reset'] = 'Reset';


#S
$lang['ship_dimensions_field'] = 'Products Ship Dimensions Field';
$lang['ship_seperately_field'] = 'Products Ship Seperately Field';
$lang['shipping_module'] = 'Shipping Module';
$lang['supplier_modules'] = 'Supplier Modules';
$lang['submit'] = 'Submit';
$lang['system_policy'] = 'System Policy';

#T
$lang['tab_cart_settings'] = 'Cart Settings';
$lang['tab_general_settings'] = 'General Settings';
$lang['tab_myinfo_settings'] = 'Store Address';
$lang['tab_packaging_settings'] = 'Packaging Settings';
$lang['tab_payment_settings'] = 'Payment Settings';
							$lang['tab_policy'] = 'Policy';
$lang['tab_promotion_settings'] = 'Promotion Settings';
$lang['tab_shipping_settings'] = 'Shipping Settings';
$lang['tab_supplier_settings'] = 'Supplier Settings';
$lang['tab_tax_settings'] = 'Tax Settings';
$lang['tax_module'] = 'Tax Calculation Module';
$lang['tax_shipping'] = 'Tax shipping calculations';

#U
$lang['units_centimeters'] = 'Centimeters';
$lang['units_inches'] = 'Inches';
$lang['unlimited'] = 'Unlimited';

#V


#W
$lang['weight_units'] = 'Weight Units';

#X


#Y
$lang['yes'] = 'Yes';

#Z


?>
