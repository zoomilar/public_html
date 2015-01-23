<?php
$lang['ask_really_uninstall'] = 'Weet u zeker dat u deze module wilt de&iuml;nstalleren?';
$lang['attrib_item_description'] = 'Product Attributen Display Sjabloon';
$lang['cart_module'] = 'Cart Module ';
$lang['currency_code'] = 'Valuta Code';
$lang['currency_symbol'] = 'Valuta Symbool';
$lang['error_invalidaddress'] = 'Het benoemde adres is niet correct (mogelijk missen er een of meer verplichte velden?)?';
$lang['event_desc_CartAdjusted'] = 'Een tag die wordt aangeroepen wanneer bulk wijzigingen in de winkelwagen zijn uitgevoerd, of aan &eacute;&eacute;n van de mandjes';
$lang['event_desc_CartItemAddPre'] = 'Een tag die wordt aangeroepen voordat een item wordt toegevoegd aan de winkelwagen';
$lang['event_desc_CartItemAdded'] = 'Een tag die wordt aangeroepen wanneer een product of dienst is toegevoegd aan de winkelwagen';
$lang['event_desc_OrderCreated'] = 'Een tag die wordt aangeroepen nadat een order voor het eerst wordt opgenomen in de database';
$lang['event_desc_OrderDeleted'] = 'Een tag die wordt aangeroepen nadat een order wordt verwijderd';
$lang['event_desc_OrderUpdated'] = 'Een tag die wordt aangeroepen nadat een bestaande order wordt opgeslagen';
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
<li>&quot;status&quot; - A status flag, indicating wether this is before, or after the items have changed.</li>
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
$lang['friendlyname'] = 'Calguys Ecommerce Base ';
$lang['gateway_policy'] = 'Gateway Beleid';
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
$lang['info_attrib_item_description'] = 'Sjabloon dat wordt gebruikt voor het weergeven van attribuut dropdowns. Mogelijke waarden zijn: {$currency_symbol},{$weight_units},{$attrib_adjust},{$attrib_text},{$attrib_sku} ';
$lang['info_cart_module'] = 'Er zijn verschillende modules die kunnen worden gebruikt als &quot;Winkelwagentje&quot;. Elk van deze werkt op een eigen manier. Selecteer van de geselecteerde winkelwagentjes uit deze lijst';
$lang['info_cart_policy'] = 'Het winkelwagen beleid wordt be&iuml;nvloed door de mogelijkheden van de betaling gateway, en bepaalt hoeveel en wat voor soort items kunnen worden toegevoegd aan de winkelwagen(s). U kunt het winkelwagenbeleid verder beperken, maar kan niet voorbij aan de beperkingen van de gateway.';
$lang['info_lineitem_desc_template'] = 'Deze template wordt gebruikt voor een &eacute;&eacute;n regel beschrijving voor een cart item. Dezelfde beschrijving wordt gebruikt voor de beschrijving in het orderproces.';
$lang['info_overweight_limit'] = 'Het gewicht waarbij een item moet worden verzonden is zijn eigen verpakking';
$lang['info_packaging_module'] = 'Selecteer een module die verantwoordelijk is voor het beheren van verschillende geselecteerde items van een order voor verpakking. Als er geen wordt geselecteerd dan zullen de verzendkosten worden berekent onafhankelijk van de items in de order.';
$lang['info_payment_module'] = 'Er kunnen verschillende modules worden gedownload die online betalingen kunnen verwerken. Deze werken allemaal op hun eigen manier. Selecteer een van de ge&iuml;nstalleerde betaalmodules van deze lijst';
$lang['info_promotions_module'] = 'Er kunnen verschillende modules worden gedownload die coupons of ander vormen van korting kunnen verwerken. Deze werken allemaal op hun eigen manier. Selecteer een van de ge&iuml;nstalleerde modules van deze lijst';
$lang['info_ship_dimensions'] = 'Veld van de productmodule dat de afmetingen van de verzending bevat voor dit product';
$lang['info_ship_seperately'] = 'Veld van de productmodule dat aangeeft dat deze waarde moet worden verzonden als eigen pakket';
$lang['info_shipping_module'] = 'Er kunnen verschillende modules worden gedownload die de kosten voor verzending kunnen verrekenen. Deze werken allemaal op hun eigen manier. Selecteer een van de ge&iuml;nstalleerde verzendkostenmodules in deze lijst';
$lang['info_supplier_modules'] = 'Aanvullende modules die in staat zijn om samen te werken met het winkelwagentje en aanvragen kan beantwoorden van de ordermodules. U kunt meerdere aanvullende modules selecteren.';
$lang['info_tax_module'] = 'Er kunnen verschillende modules worden gedownload die belasting kunnen verrekenen. Deze werken allemaal op hun eigen manier. Selecteer een van de ge&iuml;nstalleerde belastingmodules van deze lijst';
$lang['length_units'] = 'Lengte eenheid';
$lang['lineitem_desc_template'] = 'Een-regel beschrijving sjabloon';
$lang['max_products'] = 'Maximaal aantal producten in een Cart';
$lang['max_services'] = 'Maximum aantal services in een Cart';
$lang['max_subscriptions'] = 'Maximum aantal inschrijvingen in een Cart';
$lang['mixed_subscriptions'] = 'Sta een mix van producten, services in inschrijvingen toe in een Cart?';
$lang['module_description'] = 'Een basis class voor alle e-commerce modules voor gezamenlijke instellingen die verbinding legt tussen de verschillende onderdelen van de ecommerce suite';
$lang['no'] = 'Nee';
$lang['none'] = 'Geen';
$lang['not_applicable'] = 'Niet toepasbaar';
$lang['packaging_module'] = 'Verpakkingsmodule';
$lang['payment_module'] = 'Online Betaling Gateway Module';
$lang['postinstall'] = 'De CGEcommerceBase module is nu ge&iuml;nstalleerd, u kunt nu verder gaan door meerdere componenten te installeren om de door u vereiste functionaliteit te bieden. Als deze eenmaal ge&iuml;nstalleerd zijn kunt u naar het administratiepaneel terugkeren om de configuratie te voltooien.';
$lang['postuninstall'] = 'Deze module en alle gerelateerde data is verwijderd uit de CMSMS database. U kunt nu veilig de bestanden verwijderen';
$lang['promotions_module'] = 'Promotions Module ';
$lang['prompt_company'] = 'Bedrijf';
$lang['prompt_firstname'] = 'Voornaam';
$lang['prompt_lastname'] = 'Achternaam';
$lang['prompt_maxweight'] = 'Maximaal gewicht';
$lang['prompt_address1'] = 'Adresregel 1';
$lang['prompt_address2'] = 'Adresregel 2';
$lang['prompt_city'] = 'Plaats';
$lang['prompt_state'] = 'Staat / Provincie';
$lang['prompt_postal'] = 'Postcode';
$lang['prompt_country'] = 'Land';
$lang['prompt_fax'] = 'Fax ';
$lang['prompt_email'] = 'E-mail Adres';
$lang['prompt_phone'] = 'Telefoon';
$lang['prompt_overweight_limit'] = 'Overgewicht limiet';
$lang['prompt_shipping_boxes'] = 'Verzenddozen';
$lang['prompt_width'] = 'Breedte';
$lang['prompt_height'] = 'Hoogte';
$lang['prompt_length'] = 'Lengte';
$lang['prompt_weight'] = 'Gewicht';
$lang['prompt_sorting'] = 'Prioriteit';
$lang['prompt_name'] = 'Naam';
$lang['reset'] = 'Herstel';
$lang['ship_dimensions_field'] = 'Productafmetingen veld bij verzending';
$lang['ship_seperately_field'] = 'Product wordt los geleverd veld';
$lang['shipping_module'] = 'Verzendmodule';
$lang['supplier_modules'] = 'Leveranciersmodule';
$lang['submit'] = 'Versturen';
$lang['system_policy'] = 'Systeem beleid';
$lang['tab_cart_settings'] = 'Cart Instellingen';
$lang['tab_general_settings'] = 'Algemene Instellingen';
$lang['tab_myinfo_settings'] = 'Winkel Adres';
$lang['tab_packaging_settings'] = 'Verpakkingsinstellingen';
$lang['tab_payment_settings'] = 'Betalingsinstellingen';
$lang['tab_policy'] = 'Leveringsvoorwaarden';
$lang['tab_promotion_settings'] = 'Promotieinstellingen';
$lang['tab_shipping_settings'] = 'Verzendingsinstellingen';
$lang['tab_supplier_settings'] = 'Verzenderinstellingen';
$lang['tab_tax_settings'] = 'BTW Instellingen';
$lang['tax_module'] = 'BTW Module';
$lang['units_centimeters'] = 'Centimeters ';
$lang['units_inches'] = 'Inches ';
$lang['unlimited'] = 'Ongelimiteerd';
$lang['weight_units'] = 'Gewichteenheid';
$lang['yes'] = 'Ja';
$lang['utma'] = '156861353.695750094.1279138424.1299221116.1299521707.31';
$lang['utmz'] = '156861353.1299521707.31.26.utmccn=(referral)|utmcsr=dev.cmsmadesimple.org|utmcct=/|utmcmd=referral';
$lang['qca'] = 'P0-965023070-1279138424148';
$lang['utmb'] = '156861353';
$lang['utmc'] = '156861353';
?>