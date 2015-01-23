<?php
$lang['ask_really_uninstall'] = 'Er du virkelig sikker p&aring; at du vil avinstallere denne modulen';
$lang['attrib_item_description'] = 'Produktattributt visningsmal';
$lang['cart_module'] = 'Handlekurvmodul';
$lang['currency_code'] = 'Valutakode';
$lang['currency_symbol'] = 'Valutasymbol';
$lang['error_invalidaddress'] = 'Opgitt adresse er ugyldig (mangler en eller flere p&aring;krevde felter)?';
$lang['event_desc_CartAdjusted'] = 'Kalles n&aring;r bulk justeringer er gjort i handlevognen, eller en av dets handlekurver';
$lang['event_desc_CartItemAddPre'] = 'Kalles f&oslash;r et element legges til handlevognen';
$lang['event_desc_CartItemAdded'] = 'Kalles n&aring;r et produkt eller en tjeneste er lagt til handlevognen';
$lang['event_desc_OrderCreated'] = 'Kalles etter en ordre f&oslash;rst settes inn i databasen';
$lang['event_desc_OrderDeleted'] = 'Kalles etter at en bestilling er blitt fullstendig fjernet';
$lang['event_desc_OrderUpdated'] = 'Kalles etter en eksisterende ordre er lagret';
$lang['event_help_CartItemAddPre'] = '<p>Sent prior to an item being added to the cart, this event is called after the cart policy is checked, and can be used to alter the item.</p>
<h4>Parameters:</h4>
<ul>
<li>&quot;existing_items&quot; - <em>(read only)</em>  An array of cg_ecomm_cartitem items representing the existing items in the cart.</li>
<li>&quot;cart_item&quot; - <em>(modifiable)</em> A reference (modifiable) to a cg_ecomm_cartitem object representing the item that is proposed to add to the cart.</li>
</ul>';
$lang['event_help_CartAdjusted'] = '<p>Sent when bulk adjustments are done to the cart, or one of its baskets.</p>
<h4>Parameters:</h4>
<ul>
<li>&amp;quot;cart_items&amp;quot; - An hash of baskets, each containing an array of cart item objects and some summary information.</li>
<li>&amp;quot;status&amp;quot; - A status string, indicating wether this is before, or after the items have changed.</li>
<li>&amp;quot;extra&amp;quot; - An additional string that may provide some state information as to when this action was called&#039;;
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
$lang['gateway_policy'] = 'Gateway-politikk';
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
$lang['info_attrib_item_description'] = 'Malen brukes for &aring; vise attributtet rullegardinlister. Mulige variabler er ($currency_symbol), ($weight_units), ($attrib_adjust), ($attrib_text), ($attrib_sku)';
$lang['info_cart_module'] = 'Flere moduler som fungerer som &#039;Handlekurver&#039; kan lastes ned. Hver av dem med ulik atferd. Vennligst velg en av de installerte handlekurvmoduler fra denne listen';
$lang['info_cart_policy'] = 'Handlevognpolitikken er p&aring;virket av egenskapene til betalingsgateway, og bestemmer hvor mange og hva slags gjenstander kan legges til handlevognen(e). Du kan ytterligere begrense handlekurvpolitikken, men kan ikke omg&aring; begrensningene plassert av portalen.';
$lang['info_lineitem_desc_template'] = 'Denne malen brukes til &aring; formatere &eacute;n linje beskrivelse for et handlevognelement. Den samme beskrivelsen brukes til den aktuelle linjen for ordrebehandling.';
$lang['info_overweight_limit'] = 'Vekten som tilsier at et element skal sendes som en egen pakke';
$lang['info_packaging_module'] = 'Velg en modul ansvarlig for &aring; ordne de forskjellige enhetene i en ordre for pakking. Om ingen er valgt, da vil forsendelse(shipping) trolig kalkulere kostnadene uavhengig for hver enhet i ordren.';
$lang['info_payment_module'] = 'Flere moduler som tilf&oslash;rer funksjonalitet for &aring; tillate elektroniske betalinger kan lastes ned. Hver av dem med ulik atferd. Velg en av de installerte betalingsmodulene fra denne listen';
$lang['info_promotions_module'] = 'Flere moduler som tilf&oslash;rer funksjonaliteten ved &aring; tilby kuponger eller ulike former for rabatter kan lastes ned. Hver av dem med ulik atferd. Velg en av de installerte rabattmoduler fra denne listen';
$lang['info_ship_dimensions'] = 'Felt fra Products-modulen som indikerer forsendelsesdimensjonene for dette produktet';
$lang['info_ship_seperately'] = 'Felt fra Products-modulen som indikerere at denne verdien skal sendes som en egen pakke';
$lang['info_shipping_module'] = 'Flere moduler som utf&oslash;rer frakt kostnadsberegningene kan lastes ned. Hver av dem med ulik atferd. Velg en av de installerte fraktmodulene fra denne listen';
$lang['info_supplier_modules'] = 'Leverand&oslash;r moduler er i stand til &aring; kommunisere med handlekurven og svare p&aring; foresp&oslash;rsler fra ordrebehandlingsmoduler. Du kan velge flere leverand&oslash;rmoduler.';
$lang['info_tax_module'] = 'Flere moduler som utf&oslash;rer avgiftsberegning kan lastes ned. Hver av disse med forskjellige virkem&aring;ter. Velg en av de installerte avgiftsmodulene fra denne listen';
$lang['length_units'] = 'Lengde enheter';
$lang['lineitem_desc_template'] = 'Linje varebeskrivelsesmal';
$lang['max_products'] = 'Maksimalt antall produkter i en handlekurv';
$lang['max_services'] = 'Maksimalt antall tjenester i en handlekurv';
$lang['max_subscriptions'] = 'Maksimalt antall abonnement i en handlekurv';
$lang['mixed_subscriptions'] = 'Tillat en blanding av produkter, tjenester og abonnement i en handlekurv?';
$lang['module_description'] = 'En base klasse for alle e-handelsmodulene. Denne verkt&oslash;yet gir ogs&aring; felles preferanser og kontakter for de ulike deler av ehandelsuiten';
$lang['no'] = 'Nei';
$lang['none'] = 'Ingen';
$lang['not_applicable'] = 'Ikke aktuelt';
$lang['packaging_module'] = 'Pakke modul';
$lang['payment_module'] = 'Online betalingsgateway modul';
$lang['postinstall'] = 'CGEcommerceBase modulen er n&aring; installert, kan du n&aring; g&aring; videre til &aring; installere flere komponenter til e-handelsuiten for &aring; fylle de n&oslash;dvendige funksjonalitetene du trenger. S&aring; snart de er installert g&aring;r du til disse modulenes administrasjonspanel og fortsetter konfigurasjonen';
$lang['postuninstall'] = 'Denne modulen og alle tilh&oslash;rende data har blitt fjernet fra CMSMS databasen. Du kan n&aring; trygt &aring; fjerne dens filer';
$lang['promotions_module'] = 'Promotions modul';
$lang['prompt_company'] = 'Firma';
$lang['prompt_firstname'] = 'Fronavn';
$lang['prompt_lastname'] = 'Etternavn';
$lang['prompt_maxweight'] = 'Maks vekt';
$lang['prompt_address1'] = 'Adresselinje 1';
$lang['prompt_address2'] = 'Adresselinje 2';
$lang['prompt_city'] = 'By';
$lang['prompt_state'] = 'Stat / Provins';
$lang['prompt_postal'] = 'Postnummer/ zip-kode';
$lang['prompt_country'] = 'Land';
$lang['prompt_fax'] = 'TElefaks';
$lang['prompt_email'] = 'E-postadresse';
$lang['prompt_phone'] = 'Telefon';
$lang['prompt_overweight_limit'] = 'Overvektsgrense';
$lang['prompt_shipping_boxes'] = 'Forsendelsesbokser';
$lang['prompt_width'] = 'Bredde';
$lang['prompt_height'] = 'H&oslash;yde';
$lang['prompt_length'] = 'Lengde';
$lang['prompt_weight'] = 'Vekt';
$lang['prompt_sorting'] = 'Prioritet';
$lang['prompt_name'] = 'NAvn';
$lang['reset'] = 'Nullstill';
$lang['ship_dimensions_field'] = 'Produktforsendelse dimensjonsfelt';
$lang['ship_seperately_field'] = 'Produkt send-separat felt';
$lang['shipping_module'] = 'Forsendelse moduler';
$lang['supplier_modules'] = 'Leverand&oslash;r moduler';
$lang['submit'] = 'Utf&oslash;r';
$lang['system_policy'] = 'Systempolitikk';
$lang['tab_cart_settings'] = 'Handlekurvinnstillinger';
$lang['tab_general_settings'] = 'Generelle innstillinger';
$lang['tab_myinfo_settings'] = 'Lageradresse';
$lang['tab_packaging_settings'] = 'Pakke innstillinger';
$lang['tab_payment_settings'] = 'Betalingsinnstillinger';
$lang['tab_policy'] = 'Policy ';
$lang['tab_promotion_settings'] = 'Promotion innstillinger';
$lang['tab_shipping_settings'] = 'Forsendelsesinnstillinger';
$lang['tab_supplier_settings'] = 'Leverand&oslash;rinnstillinger';
$lang['tab_tax_settings'] = 'Avgiftsinnstillinger';
$lang['tax_module'] = 'Avgiftskalkuleringsmodul';
$lang['units_centimeters'] = 'Centimeter';
$lang['units_inches'] = 'Tommer';
$lang['unlimited'] = 'Ubegrenset';
$lang['weight_units'] = 'Vektenheter';
$lang['yes'] = 'Ja';
$lang['utmz'] = '156861353.1300226369.3692.81.utmcsr=dev.cmsmadesimple.org|utmccn=(referral)|utmcmd=referral|utmcct=/feature_request/list/6';
$lang['utma'] = '156861353.179052623084110100.1210423577.1302044019.1302118822.3753';
$lang['qca'] = '1210971690-27308073-81952832';
$lang['utmb'] = '156861353';
$lang['utmc'] = '156861353';
?>