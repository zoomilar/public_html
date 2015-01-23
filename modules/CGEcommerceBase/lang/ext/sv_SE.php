<?php
$lang['ask_really_uninstall'] = '&Auml;r du s&auml;ker p&aring; att du vill avinstallera denna modul?';
$lang['attrib_item_description'] = 'Produktattributs Visa-mall';
$lang['cart_module'] = 'Kundvagnsmodul';
$lang['currency_code'] = 'Valutakod';
$lang['currency_symbol'] = 'Valutasymbol';
$lang['error_invalidaddress'] = 'Adressen som angavs &auml;r ogiltig (saknar en eller flera obligatoriska f&auml;lt?)';
$lang['event_desc_CartAdjusted'] = 'Called when bulk adjustments are done to the cart, or one of its baskets';
$lang['event_desc_CartItemAddPre'] = 'Called prior to an item being added to the cart';
$lang['event_desc_CartItemAdded'] = 'Ska anropas n&auml;r en produkt eller service har lagts till i kundvagnen';
$lang['event_desc_OrderCreated'] = 'Ska anropas efter en har blivit inmatad i databasen';
$lang['event_desc_OrderDeleted'] = 'Ska anropas efter att en order har tagits bort.';
$lang['event_desc_OrderUpdated'] = 'Ska anropas efter en befintlig best&auml;llning har sparats';
$lang['event_help_CartItemAddPre'] = '<p>Sent prior to an item being added to the cart, this event is called after the cart policy is checked, and can be used to alter the item.</p>
<h4>Parameters:</h4>
<ul>
<li>&quot;existing_items&quot; - <em>(read only)</em>  An array of cg_ecomm_cartitem items representing the existing items in the cart.</li>
<li>&quot;cart_item&quot; - <em>(modifiable)</em> A reference (modifiable) to a cg_ecomm_cartitem object representing the item that is proposed to add to the cart.</li>
</ul>';
$lang['event_help_CartAdjusted'] = '<p>Sent when bulk adjustments are done to the cart, or one of its baskets.</p>
<h4>Parameters:</h4>
<ul>
<li>&quot;cart_items&quot; - An hash of baskets, each containing an array of cart item objects and some summary information.</li>
<li>&quot;status&quot; - A status string, indicating wether this is before, or after the items have changed.</li>
<li>&quot;extra&quot; - An additional string that may provide some state information as to when this action was called&#039;;
</ul>';
$lang['event_help_CartItemAdded'] = '<p>Sent when bulk adjustments are done to the cart, or one of its baskets.</p>
<h4>Parameters:</h4>
<ul>
<li>&quot;cart_item&quot; - The single cart item object that was added.</li>
</ul>';
$lang['event_help_OrderCreated'] = '<p>Sent after an order is initially inserted into the database.</p>
<h4>Parameters:</h4>
<ul>
<li>&quot;order_id&quot; - The newly created order id.</li>
</ul>';
$lang['event_help_OrderDeleted'] = '<p>Sent after an order is removed from the database.</p>
<h4>Parameters:</h4>
<ul>
<li>&quot;order_id&quot; - The deleted order id.</li>
</ul>';
$lang['event_help_OrderUpdated'] = '<p>Sent after an order is updated</p>
<h4>Parameters:</h4>
<ul>
<li>&quot;order_id&quot; - The order id.</li>
</ul>';
$lang['friendlyname'] = 'Calguys EcommerceBase';
$lang['gateway_policy'] = 'Gateway Villkor';
$lang['help'] = '<h3>What does this do?</h3>
  <p>This module provides a common base of communications for all ecommerce modules.  It allows specifying which available suppliers you wou would like to use, as well as cart, tax, shipping, and payment gateways.  It also provides a suite of apis for communication of data between the various modules.</p>
<h3>Features:</h3>
<p>This module provides no plugin interface of its own (with the exception of the tag that can be used to add items to the cart.... see below.</p>
<h3>How Do I Use It:</h3>
<p>After installation of all of the desired ecommerce modules you should enter the CGEcommerceBase admin panel and configure the various options.</p>
<h3>Smarty Tags</h3>
<ul>
  <li><span style=&quot;color: blue;&quot;>{cgecomm_form_addtocart source=Products produc=$num}</span>
   <p>This tag uses the currently selected cart module and displays a form to allow the user to add an item to the cart.<br/>Parameters:</p>
   <ul>
    <li>source - specify the name of the source module.  This module must be selected as a supplier in the CGEcommerceBase admin panel.</li>
    <li>product - specify the unique <em>(integer)</em> identifier of the product within the source module.</li>
   </ul>  
   <p>Any other arguments passed to this tag are passed to the appropriate module, for example for specifying a different template you may want to add an &quot;addtocarttemplate=foo&quot; argument.</p>
  </li>
  <li><span style=&quot;color: blue;&quot;>{cgecomm_erasecart}</span>
    <p>This tag empties all information from the currently selected cart, and sets the visitors basket back to a completely empty state.</p>
  </li>
  <li><span style=&quot;color: blue;&quot;>{cgecomm_company_address assign=&#039;foo&#039;}</span>
   <p>This tag retrieves the company address from the database, and assigns it to the named smarty variable.</p>
  </li>
</ul>
<h3>Support</h3>
<p>This module does not include commercial support.  However there are a number of resources available to help you with it:</p>
<ul>
<li>For the latest version of this module, FAQs or to file a bug report, please visit the cms made simple <a href="http://dev.cmsmadesimple.org">Developers Forge</a> and do a search for &#039;Products&#039;</li>
<li>To obtain commercial support, please send an email to the author at <a href="mailto:calguy1000@cmsmadesimple.org">Robert Campbell</a>.</li>
<li>Additional discussion of this module may also be found in the <a href="http://forum.cmsmadesimple.org">CMS Made Simple Forms.</a></li>
<li>For some questions and limited technical support, the author can often be found in the <a href="irc://irc.freenode.net/#cms">CMS IRC Channel</a>.</li>
</ul>
<h3>Copyright and License</h3>
<p>Copyright &copy; 2008, Robert Campbel <a href="mailto:calguy1000@cmsmadesimple.org"><calguy1000@cmsmadesimple.org></a>. All Rights Are Reserved.</p>
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
Or read it <a href="http://www.gnu.org/licenses/licenses.html#GPL">online</a></p>';
$lang['info_attrib_item_description'] = 'Mallen anv&auml;nds f&ouml;r att visa attribut dropdowns. M&ouml;jliga variabler &auml;r ($CURRENCY_SYMBOL), ($weight_units), ($attrib_adjust), ($attrib_text), ($attrib_sku)';
$lang['info_cart_module'] = 'Ett stort antal moduler som fungerar som &quot;Kundvagnar&quot; kan laddas ner. Var och en av dem med olika beteenden. V&auml;lj en av de installerade kundvagns moduler fr&aring;n den h&auml;r listan';
$lang['info_cart_policy'] = 'The cart policy is influenced by the capabilities of the payment gateway, and determines how many, and what type of items may be added to he cart(s).  You may further restrict the cart policy, but cannot bypass the restrictions placed by the gateway.';
$lang['info_lineitem_desc_template'] = 'This template is used to format the single line description for a cart item.  This same description is used for the line item in order processing.';
$lang['info_overweight_limit'] = 'The weight at which an item should be shipped in its own package';
$lang['info_packaging_module'] = 'Select a module responsible for arranging the various items selected in an order for packaging.  If none is selected, then the shipping maycalculate costs independantly on each order item.';
$lang['info_payment_module'] = 'Numerous modules that perform the functionality of allowing online payments may be downloaded.  Each of them with different behaviours.  Please select one of the installed payment modules from this list';
$lang['info_promotions_module'] = 'Numerous modules that perform the functionality of providing coupons or various forms of discounts may be downloaded.  Each of them with different behaviours.  Please select one of the installed promotions modules from this list';
$lang['info_ship_dimensions'] = 'Field from the Products module that indicates the shippable dimensions for this product';
$lang['info_ship_seperately'] = 'Field from the Products module which indicates that this value should be shipped as its own package';
$lang['info_shipping_module'] = 'Numerous modules that perform shipping cost calculations may be downloaded.  Each of them with different behaviours.  Please select one of the installed  modules from this list';
$lang['info_supplier_modules'] = 'Supplier modules are capable of interacting with the cart and answering requests from order processing modules.  You may select multiple supplier modules.';
$lang['info_tax_module'] = 'Numerous modules that perform tax calculation may be downloaded.  Each of these with different behaviours.  Please select one of the installed tax modules from this list';
$lang['length_units'] = 'L&auml;ngd m&aring;tt';
$lang['lineitem_desc_template'] = 'Line Item Description Template';
$lang['max_products'] = 'Maximalt antal produkter i en varukorg';
$lang['max_services'] = 'Maximalt antal tj&auml;nster i en varukorg';
$lang['max_subscriptions'] = 'Maximalt antal abonnemang i en varukorg';
$lang['mixed_subscriptions'] = 'Till&aring;t en blandning av produkter, tj&auml;nster och abonnemang i en vagn?';
$lang['module_description'] = 'A base class for all e-commerce modules this utility also provides common preferences and connectors for the various portions of the ecommerce suite';
$lang['no'] = 'Nej';
$lang['none'] = 'Ingen';
$lang['not_applicable'] = 'Ej till&auml;mpligt';
$lang['packaging_module'] = 'Packaging Module';
$lang['payment_module'] = 'Online PaymentGateway Modul';
$lang['postinstall'] = 'The CGEcommerceBase module is now installed, you may now proceed to install more components to the ecommerce suite to fill out your required functionality.  Once they are installed return to this modules administration panel to continue the configuration';
$lang['postuninstall'] = 'Denna modul och all tillh&ouml;rande data har tagits bort fr&aring;n CMSMS databasen. Du kan nu ta bort filerna';
$lang['promotions_module'] = 'Promotions Modul';
$lang['prompt_company'] = 'F&ouml;retag';
$lang['prompt_firstname'] = 'F&ouml;rnamn';
$lang['prompt_lastname'] = 'Efternamn';
$lang['prompt_maxweight'] = 'Maxvikt';
$lang['prompt_address1'] = 'Adress 1';
$lang['prompt_address2'] = 'Adress 2';
$lang['prompt_city'] = 'Stad';
$lang['prompt_state'] = 'Landskap';
$lang['prompt_postal'] = 'Postnr';
$lang['prompt_country'] = 'Land';
$lang['prompt_fax'] = 'Fax nr';
$lang['prompt_email'] = 'Email Adress';
$lang['prompt_phone'] = 'Telefon';
$lang['prompt_overweight_limit'] = 'Gr&auml;nsv&auml;rde f&ouml;r &ouml;vervikt';
$lang['prompt_shipping_boxes'] = 'Fraktl&aring;dor';
$lang['prompt_width'] = 'Bredd';
$lang['prompt_height'] = 'H&ouml;jd';
$lang['prompt_length'] = 'L&auml;ngd';
$lang['prompt_weight'] = 'Vikt';
$lang['prompt_sorting'] = 'Prioritet';
$lang['prompt_name'] = 'Namn';
$lang['reset'] = '&Aring;terst&auml;ll';
$lang['ship_dimensions_field'] = 'Products Ship Dimensions Field';
$lang['ship_seperately_field'] = 'Products Ship Seperately Field';
$lang['shipping_module'] = 'Fraktmodul';
$lang['supplier_modules'] = 'Leverant&ouml;rsmoduler';
$lang['submit'] = 'Spara';
$lang['system_policy'] = 'K&ouml;pvillkor';
$lang['tab_cart_settings'] = 'Kundvagns inst&auml;llningar';
$lang['tab_general_settings'] = 'Allm&auml;nna inst&auml;llningar';
$lang['tab_myinfo_settings'] = 'Butikens adress';
$lang['tab_packaging_settings'] = 'Packaging Settings';
$lang['tab_payment_settings'] = 'Betalningsinst&auml;llningar';
$lang['tab_policy'] = 'Villkor';
$lang['tab_promotion_settings'] = 'Promotion inst&auml;llningar';
$lang['tab_shipping_settings'] = 'Fraktinst&auml;llningar';
$lang['tab_supplier_settings'] = 'Leverant&ouml;rsinst&auml;llningar';
$lang['tab_tax_settings'] = 'Merv&auml;rdeskatts inst&auml;llningar';
$lang['tax_module'] = 'Skatteber&auml;kningsmodul';
$lang['units_centimeters'] = 'Centimeter';
$lang['units_inches'] = 'Tum';
$lang['unlimited'] = 'Obegr&auml;nsat';
$lang['weight_units'] = 'Vikt enheter';
$lang['yes'] = 'Ja';
$lang['utma'] = '156861353.1779670065.1310491113.1310491113.1310491113.1';
$lang['utmz'] = '156861353.1310491113.1.1.utmcsr=feedburner|utmccn=Feed: cmsmadesimple/blog (CMS Made Simple)|utmcmd=feed';
$lang['qca'] = 'P0-1529175659-1310081076901';
$lang['utmb'] = '156861353.3.10.1310491113';
$lang['utmc'] = '156861353';
?>