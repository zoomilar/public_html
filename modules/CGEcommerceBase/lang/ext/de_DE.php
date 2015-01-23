<?php
$lang['ask_really_uninstall'] = 'Wollen Sie wirklich dieses Modul deinstallieren?';
$lang['attrib_item_description'] = 'Template f&uuml;r Produkt-Attribut-Anzeige';
$lang['cart_module'] = 'Warenkorb-Modul';
$lang['currency_code'] = 'W&auml;hrungsschl&uuml;ssel';
$lang['currency_symbol'] = 'W&auml;hrungssymbol';
$lang['error_invalidaddress'] = 'Die angegebene Adresse ist ung&uuml;ltig. Eines oder mehrere ben&ouml;tigte Felder fehlen.';
$lang['event_desc_CartAdjusted'] = 'Wird aufgerufen, wenn Massen&auml;nderungen am Warenkorb vorgenommen werden';
$lang['event_desc_CartItemAddPre'] = 'Wird aufgerufen wenn ein Artikel in den Warenkorb gelegt wird';
$lang['event_desc_CartItemAdded'] = 'Wird aufgerufen, wenn dem Warenkorb ein Produkt oder eine Dienstleistung hinzugef&uuml;gt wird';
$lang['event_desc_OrderCreated'] = 'Wird aufgerufen, wenn eine Bestellung erstmalig in die Datenbank eingef&uuml;gt wird';
$lang['event_desc_OrderDeleted'] = 'Wird aufgerufen, nachdem eine Bestellung komplett entfernt wurde';
$lang['event_desc_OrderUpdated'] = 'Wird aufgerufen, nachdem eine Bestellung gespeichert wurde';
$lang['event_help_CartItemAddPre'] = '<p>Sent prior to an item being added to the cart, this event is called after the cart policy is checked, and can be used to alter the item.</p>
<h4>Parameter:</h4>
<ul>
<li>&quot;existing_items&quot; - <em>(read only)</em>  An array of cg_ecomm_cartitem items representing the existing items in the cart.</li>
<li>&quot;cart_item&quot; - <em>(modifiable)</em> A reference (modifiable) to a cg_ecomm_cartitem object representing the item that is proposed to add to the cart.</li>
</ul>';
$lang['event_help_CartAdjusted'] = '<p>Sent when bulk adjustments are done to the cart, or one of its baskets.</p>
<h4>Parameters:</h4>
<ul>
<li>&quot;cart_items&quot; - An hash of baskets, each containing an array of cart item objects and some summary information.</li>
<li>&quot;status&quot; - A status flag, indicating wether this is before, or after the items have changed.</li>
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
$lang['friendlyname'] = 'E-commerce-Basismodul';
$lang['gateway_policy'] = 'Gateway-Regeln';
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
   <p>Any other arguments passed to this tag are passed to the appropriate module, for example for specifying a different template you may want to add an &amp;quot;addtocarttemplate=foo&amp;quot; argument.</p>
  </li>
  <li><span style=&quot;color: blue;&quot;>{cgecomm_erasecart}</span>
    <p>This tag empties all information from the currently selected cart, and sets the visitors basket back to a completely empty state.</p>
  </li>
  <li><span style=&quot;color: blue;&quot;>{cgecomm_company_address [assign=&#039;string&#039;]}</span>
   <p>This tag retrieves the company address from the database, and assigns it to the named smarty variable.</p>
  </li>
  <li><span style=&quot;color: blue;&quot;>{cgecomm_currency_code [assign=string]}</span> - Returns the currently set currency code.</li>
  <li><span style=&quot;color: blue;&quot;>{cgecomm_currency_symbol [assign=string]}</span> - Returns the currently set currency symbol.</li>
  <li><span style=&quot;color: blue;&quot;>{cgecomm_weight_units [assign=string]}</span> - Returns the currently set weight units.</li>
  <li><span style=&quot;color: blue;&quot;>{cgecomm_weight_units [assign=string]}</span> - Returns the currently set weight units.</li>
  <li><span style=&quot;color: blue;&quot;>{cgecomm_length_units [assign=string]}</span> - Returns the currently set length units.</li>
  <li><span style=&quot;color: blue;&quot;>{cgecomm_cartitem_exists [source=string] [product=integer|sku=string] [extra=mixed] assign=string]}</span> - Returns the currently set weight units.
    <p>Returns either 0 or 1 depending on if the item (identified by either the prouct id, or sku exists in the cart.</p>
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
<p>Copyright &amp;copy; 2008, Robert Campbel <a href="mailto:calguy1000@cmsmadesimple.org">&amp;lt;calguy1000@cmsmadesimple.org&amp;gt;</a>. All Rights Are Reserved.</p>
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
$lang['info_attrib_item_description'] = 'Das Temlate zur Anzeige von Attribut-Listenmen&uuml;s. M&ouml;gliche Variablen sind {$currency_symbol},{$weight_units},{$attrib_adjust},{$attrib_text},{$attrib_sku}';
$lang['info_cart_module'] = 'Zahlreiche Module, die als &quot;Warenk&ouml;rbe&quot; funktionieren, k&ouml;nnen heruntergeladen werden. Jedes von denen mit unterschiedlichen Verhaltensweisen. Bitte w&auml;hlen Sie eines der installierten Warenkorb-Module aus dieser Liste';
$lang['info_cart_policy'] = 'The cart policy is influenced by the capabilities of the payment gateway, and determines how many, and what type of items may be added tot he cart(s).  You ma8y further restrict the cart policy, but cannot bypass the restrictions placed by the gateway.';
$lang['info_lineitem_desc_template'] = 'This template is used to format the single line description for a cart item.  This same description is used for the line item in order processing.';
$lang['info_overweight_limit'] = 'Das Gewicht, ab dem ein Produkt in einem eigenen Paket geliefert werden soll';
$lang['info_packaging_module'] = 'Select a module responsible for arranging the various items selected in an order for packaging.  If none is selected, then the shipping maycalculate costs independantly on each order item.';
$lang['info_payment_module'] = 'Numerous modules that perform the functionality of allowing online payments may be downloaded.  Each of them with different behaviours.  Please select one of the installed cart modules from this list';
$lang['info_promotions_module'] = 'Numerous modules that perform the functionality of providing coupons or various forms of discounts may be downloaded.  Each of them with different behaviours.  Please select one of the installed cart modules from this list';
$lang['info_ship_dimensions'] = 'Field from the Products module that indicates the shippable dimensions for this product';
$lang['info_ship_seperately'] = 'Field from the Products module which indicates that this value should be shipped as its own package';
$lang['info_shipping_module'] = 'Numerous modules that perform shipping cost calculations may be downloaded.  Each of them with different behaviours.  Please select one of the installed cart modules from this list';
$lang['info_supplier_modules'] = 'Supplier modules are capable of interacting with the cart and answering requests from order processing modules.  You may select multiple supplier modules.';
$lang['info_tax_module'] = 'Numerous modules that perform tax calculation may be downloaded.  Each of these with different behaviours.  Please select one of the installed tax modules from this list';
$lang['length_units'] = 'L&auml;ngeneinheiten';
$lang['lineitem_desc_template'] = 'Template f&uuml;r die Einzelposten-Beschreibung';
$lang['max_products'] = 'maximale Anzahl an Produkten im Warenkorb';
$lang['max_services'] = 'maximale Anzahl an Dienstleistungen im Warenkorb';
$lang['max_subscriptions'] = 'maximale Anzahl an Abonnements im Warenkorb';
$lang['mixed_subscriptions'] = 'Soll eine Mischung aus Produkten, Dienstleistungen und Abonnements in einem Warenkorb erlaubt sein?';
$lang['module_description'] = 'A base class for all e-commerce modules this utiility also provides common preferences and connectors for the various portions of the ecommerce suite';
$lang['no'] = 'Nein';
$lang['none'] = 'Nichts ausgew&auml;hlt';
$lang['not_applicable'] = 'Nicht anwendbar';
$lang['packaging_module'] = 'Versandverpackungs-Modul';
$lang['payment_module'] = 'Schnittstellenmodul f&uuml;r Online-Bezahlungen';
$lang['postinstall'] = 'Das CGEcommerceBase Modul wurde installiert. Installieren Sie jetzt weitere E-Commerce Module, um die von Ihnen ben&ouml;tigten Funktionen zu erhalten. Nachdem Sie die Module installiert haben, rufen Sie diese Einstellungsseite wieder auf, um die Konfiguration zu vervollst&auml;ndigen.';
$lang['postuninstall'] = 'Dieses Modul und alle zugeh&ouml;rigen Daten wurden aus der Datenbank entfernt. Sie k&ouml;nnen jetzt die verbliebenen Dateien l&ouml;schen.';
$lang['promotions_module'] = 'Werbemodul';
$lang['prompt_company'] = 'Firma';
$lang['prompt_firstname'] = 'Vorname';
$lang['prompt_lastname'] = 'Nachname';
$lang['prompt_maxweight'] = 'Maximalgewicht';
$lang['prompt_address1'] = 'Adresszeile 1';
$lang['prompt_address2'] = 'Adresszeile 2';
$lang['prompt_city'] = 'Stadt';
$lang['prompt_state'] = 'Bundesstaat/Provinz/Kanton';
$lang['prompt_postal'] = 'Postleitzahl';
$lang['prompt_country'] = 'Land';
$lang['prompt_fax'] = 'Fax ';
$lang['prompt_email'] = 'Email-Adresse';
$lang['prompt_phone'] = 'Telefon';
$lang['prompt_overweight_limit'] = '&Uuml;bergewichtsbeschr&auml;nkung';
$lang['prompt_shipping_boxes'] = 'Liefer-Boxen';
$lang['prompt_width'] = 'Breite';
$lang['prompt_height'] = 'H&ouml;he';
$lang['prompt_length'] = 'L&auml;nge';
$lang['prompt_weight'] = 'Gewicht';
$lang['prompt_sorting'] = 'Priorit&auml;t';
$lang['prompt_name'] = 'Name ';
$lang['reset'] = 'Zur&uuml;cksetzen';
$lang['ship_dimensions_field'] = 'Produkte Versand-Ma&szlig;e-Feld';
$lang['ship_seperately_field'] = 'Produkte separates Versand-Feld';
$lang['shipping_module'] = 'Versandmodul';
$lang['supplier_modules'] = 'Versorgungsmodule';
$lang['submit'] = 'Absenden';
$lang['system_policy'] = 'Systemrichtlinie';
$lang['tab_cart_settings'] = 'Warenkorbeinstellungen';
$lang['tab_general_settings'] = 'Allgemeine Einstellungen';
$lang['tab_myinfo_settings'] = 'Gesch&auml;ftsadresse';
$lang['tab_packaging_settings'] = 'Verpackungs-Einstellungen';
$lang['tab_payment_settings'] = 'Zahlungseinstellungen';
$lang['tab_policy'] = 'Richtlinie';
$lang['tab_promotion_settings'] = 'Werbungseinstellungen';
$lang['tab_shipping_settings'] = 'Versandeinstellungen';
$lang['tab_supplier_settings'] = 'Versorgungsmoduleinstellungen';
$lang['tab_tax_settings'] = 'Steuereinstellungen';
$lang['tax_module'] = 'Steuerberechnungsmodul';
$lang['units_centimeters'] = 'Zentimeter';
$lang['units_inches'] = 'Zoll';
$lang['unlimited'] = 'Unbegrenzt';
$lang['weight_units'] = 'Gewichtseinheiten';
$lang['yes'] = 'Ja';
$lang['utma'] = '156861353.1395374940.1321679974.1321679974.1321679974.1';
$lang['utmz'] = '156861353.1321679974.1.1.utmccn=(direct)|utmcsr=(direct)|utmcmd=(none)';
$lang['utmc'] = '156861353';
$lang['utmb'] = '156861353';
?>