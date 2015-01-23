<?php
$lang['ask_really_uninstall'] = 'Etes-vous s&ucirc;r(e) de vouloir d&eacute;sinstaller ce module ?';
$lang['attrib_item_description'] = 'Gabarit d&#039;affichage des attributs produit ';
$lang['cart_module'] = 'Module de Panier ';
$lang['currency_code'] = 'Code devise ';
$lang['currency_symbol'] = 'Symbole de devise ';
$lang['error_invalidaddress'] = 'L&#039;adresse fournie est invalide (tous le champs sont-ils compl&eacute;t&eacute;s ?';
$lang['event_desc_CartAdjusted'] = 'Appel&eacute; lorsque des ajustements par lot sont effectu&eacute;s sur le panier, ou un de ses ';
$lang['event_desc_CartItemAddPre'] = 'Appel&eacute; juste avant qu&#039;un item soit ajout&eacute; au panier';
$lang['event_desc_CartItemAdded'] = 'Appel&eacute; quand un produit unique ou service est ajout&eacute; au panier';
$lang['event_desc_OrderCreated'] = 'Appel&eacute; apr&egrave;s l&#039;insertion d&#039;une nouvelle commande dans la base de donn&eacute;es';
$lang['event_desc_OrderDeleted'] = 'Appel&eacute; apr&egrave;s la suppression compl&egrave;te d&#039;une commande';
$lang['event_desc_OrderUpdated'] = 'Appel&eacute; apr&egrave;s l&#039;enregistrement d&#039;une commande existante';
$lang['event_help_CartItemAddPre'] = '<p>Sent prior to an item being added to the cart, this event is called after the cart policy is checked, and can be used to alter the item.</p>
<h4>Parameters:</h4>
<ul>
<li>&quot;existing_items&quot; - <em>(read only)</em>  An array of cg_ecomm_cartitem items representing the existing items in the cart.</li>
<li>&quot;cart_item&quot; - <em>(modifiable)</em> A reference (modifiable) to a cg_ecomm_cartitem object representing the item that is proposed to add to the cart.</li>
</ul>';
$lang['event_help_CartAdjusted'] = '<p>Sent when bulk adjustments are done to the cart, or one of its baskets.</p>
<h4>Param&egrave;tres :</h4>
<ul>
<li>&quot;cart_items&quot; - An hash of baskets, each containing an array of cart item objects and some summary information.</li>
<li>&quot;status&quot; - A status flag, indicating wether this is before, or after the items have changed.</li>
</ul>';
$lang['event_help_CartItemAdded'] = '<p>Sent when bulk adjustments are done to the cart, or one of its baskets.</p>
<h4>Param&egrave;tres :</h4>
<ul>
<li>&quot;cart_item&quot; - The single cart item object that was added.</li>
</ul>';
$lang['event_help_OrderCreated'] = '<p>Envoy&eacute;s apr&egrave;s l&#039;insertion d&#039;une commande dans la base de donn&eacute;es.</p>
<h4>Param&egrave;tres :</h4>
<ul>
<li>&quot;order_id&quot; - ID de la nouvelle commande cr&eacute;&eacute;e.</li>
</ul>';
$lang['event_help_OrderDeleted'] = '<p>Envoy&eacute;s apr&egrave;s la suppression d&#039;une commande de la base de donn&eacute;es.</p>
<h4>Param&egrave;tres :</h4>
<ul>
<li>&quot;order_id&quot; - ID de la commande supprim&eacute;e.</li>
</ul>';
$lang['event_help_OrderUpdated'] = '<p>Envoy&eacute;s apr&egrave;s la mise &agrave; jour d&#039;une commande de la base de donn&eacute;es.</p>
<h4>Param&egrave;tres :</h4>
<ul>
<li>&quot;order_id&quot; - ID de la commande mise &agrave; jour.</li>
</ul>';
$lang['friendlyname'] = 'Configuration E-Commerce';
$lang['gateway_policy'] = 'Politique du processus de paiement';
$lang['help'] = '<h3>Que fait ce module ?</h3>
  <p>Ce module fournit une base de communication entre les diff&eacute;rents modules e-commerce. It allows specifying which available suppliers you wou would like to use, as well as cart, tax, shipping, and payment gateways.  It also provides a suite of apis for communication of data between the various modules.</p>
<h3>Features:</h3>
<p>This module provides no plugin interface of its own (with the exception of the tag that can be used to add items to the cart.... see below.</p>
<h3>How Do I Use It:</h3>
<p>After installation of all of the desired ecommerce modules you should enter the CGEcommerceBase admin panel and configure the various options.</p>
<h3>Smarty Tags</h3>
<ul>
  <li><span style=&quot;color: blue;&quot;>{cgecomm_form_addtocart source=Products produc=$num}</span>
   <p>This tag uses the currently selected cart module and displays a form to allow the user to add an item to the cart.<br/>Param&egrave;tres :</p>
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
$lang['info_attrib_item_description'] = 'Ce gabarit est utilis&eacute; pour l&#039;affichage des listes d&eacute;roulantes d&#039;attributs de produits. Les variables sont {$currency_symbol},{$weight_units},{$attrib_adjust},{$attrib_text},{$attrib_sku}.<br>
Astuce : pour afficher le prix total de l&#039;article (prix de base + prix de l&#039;attribut, utilisez : {$entry->price+$attrib_adjust}';
$lang['info_cart_module'] = 'Diff&eacute;rents modules de e-paniers d&#039;achats peuvent &ecirc;tre install&eacute;s, chacun disposant de son propre fonctionnement. Merci de s&eacute;lectionner l&#039;un des modules e-panier install&eacute; dans cette liste';
$lang['info_cart_policy'] = 'La politique panier est influenc&eacute;e par les capacit&eacute;s de la passerelle de paiement, et d&eacute;termine le nombre et le type d&#039;articles pouvant &ecirc;tre ajout&eacute;s dans le(s) panier(s). Vous pouvez restreindre encore davantage la politique de panier, mais vous ne pouvez pas contourner les restrictions impos&eacute;es par la passerelle de paiement.';
$lang['info_lineitem_desc_template'] = 'Ce gabarit est utilis&eacute; pour formater la description en un seule ligne pour un &eacute;l&eacute;ment de panier. Cette description est &eacute;galement utilis&eacute;e pour la ligne de chaque article dans le traitement des commandes en ligne.';
$lang['info_overweight_limit'] = 'Le poids d&#039;un article qui doit &ecirc;tre envoy&eacute; dans son propre paquet/colis';
$lang['info_packaging_module'] = 'S&eacute;lectionnez un module de colisage. Si aucun module n&#039;est s&eacute;lectionn&eacute;, alors le syst&egrave;me calculera le co&ucirc;t en fonction de chaque produit de la commande.';
$lang['info_payment_module'] = 'Diff&eacute;rents modules de paiement en ligne peuvent &ecirc;tre install&eacute;s, chacun avec des fonctions diff&eacute;rentes. Merci de s&eacute;lectionner l&#039;un de ces modules dans cette liste.';
$lang['info_promotions_module'] = 'Diff&eacute;rents modules de bons de r&eacute;duction/promotions peuvent &ecirc;tre install&eacute;s. Ils proposent chacun leurs propres fonctions de bons de r&eacute;duction ou autres formes de promotions. Merci de s&eacute;lectionner le module &agrave; utiliser pour la boutique dans cette liste.';
$lang['info_ship_dimensions'] = 'Champ du module Products indiquant les dimensions de ce produit livrable';
$lang['info_ship_seperately'] = 'Champ du module Products indiquant que cette valeur devrait &ecirc;tre livr&eacute; en tant que son propre paquet/colis';
$lang['info_shipping_module'] = 'Il est possible de t&eacute;l&eacute;charger de nombreux modules de calcul de frais d&#039;exp&eacute;dition, chacun d&#039;eux ayant un comportement diff&eacute;rent. Veuillez s&eacute;lectionner un des modules install&eacute;s dans cette liste.';
$lang['info_supplier_modules'] = 'Des modules fournisseurs sont capables d&#039;interagir avec le panier pour r&eacute;pondre aux demandes de modules de traitement des commandes. Vous pouvez s&eacute;lectionner plusieurs modules le fournisseur.';
$lang['info_tax_module'] = 'De nombreux modules effectuant le calcul des taxes peuvent &ecirc;tre t&eacute;l&eacute;charg&eacute;s. Chacun d&#039;eux a des comportements diff&eacute;rents. Merci de s&eacute;lectionner un des modules de calcul des taxes install&eacute; &agrave; partir de cette liste';
$lang['length_units'] = 'Unit&eacute; de longueur ';
$lang['lineitem_desc_template'] = 'Gabarit de description d&#039;une ligne produit ';
$lang['max_products'] = 'Nombre max. de produits dans un seul panier ';
$lang['max_services'] = 'Nombre max. de services dans un seul panier ';
$lang['max_subscriptions'] = 'Nombre max. d&#039;abonnements dans un seul panier ';
$lang['mixed_subscriptions'] = 'Autoriser le m&eacute;lange de produits, services et abonnements dans le m&ecirc;me panier ';
$lang['module_description'] = 'Base pour tous les modules E-commerce, ce module fournit &eacute;galement des pr&eacute;f&eacute;rences globales et des connecteurs entre les modules E-commerce CMSMS.';
$lang['no'] = 'Non';
$lang['none'] = 'Aucun';
$lang['not_applicable'] = 'Non applicable';
$lang['packaging_module'] = 'Module de packaging';
$lang['payment_module'] = 'Module de paiement en ligne ';
$lang['postinstall'] = 'Le module CGEcommerceBase est maintenant install&eacute;, vous pouvez maintenant proc&eacute;der &agrave; l&#039;installation de plusieurs composants de la suite e-commerce afin de remplir vos fonctions n&eacute;cessaires. D&eacute;s l&#039;installation termin&eacute;e de ces composants retournez au panneau d&#039;administration des modules pour poursuivre la configuration';
$lang['postuninstall'] = 'Ce module ainsi que les donn&eacute;es associ&eacute;es ont &eacute;t&eacute; supprim&eacute;s de la base de donn&eacute;es de CMSMS. Vous pouvez &agrave; pr&eacute;sent supprimer ses fichiers.';
$lang['promotions_module'] = 'Module de promos / bons de r&eacute;duction';
$lang['prompt_company'] = 'Entreprise ';
$lang['prompt_firstname'] = 'Pr&eacute;nom ';
$lang['prompt_lastname'] = 'Nom ';
$lang['prompt_maxweight'] = 'Poids max';
$lang['prompt_address1'] = 'Adresse Ligne 1 ';
$lang['prompt_address2'] = 'Adresse Ligne 2 ';
$lang['prompt_city'] = 'Ville ';
$lang['prompt_state'] = 'Etat / Province ';
$lang['prompt_postal'] = 'Code Postal ';
$lang['prompt_country'] = 'Pays ';
$lang['prompt_fax'] = 'Fax ';
$lang['prompt_email'] = 'Courriel ';
$lang['prompt_phone'] = 'T&eacute;l&eacute;phone ';
$lang['prompt_overweight_limit'] = 'Limite de poids';
$lang['prompt_shipping_boxes'] = 'Colis d&#039;exp&eacute;dition ';
$lang['prompt_width'] = 'Largeur';
$lang['prompt_height'] = 'Hauteur';
$lang['prompt_length'] = 'Longueur';
$lang['prompt_weight'] = 'Poids';
$lang['prompt_sorting'] = 'Priorit&eacute;';
$lang['prompt_name'] = 'Nom';
$lang['reset'] = 'R&eacute;initialiser';
$lang['ship_dimensions_field'] = 'Champ de dimensions d&#039;envoi des produits';
$lang['ship_seperately_field'] = 'Champ d&#039;envoi s&eacute;par&eacute; des produits';
$lang['shipping_module'] = 'Modules d&#039;exp&eacute;dition ';
$lang['supplier_modules'] = 'Modules fournisseurs ';
$lang['submit'] = 'Soumettre';
$lang['system_policy'] = 'Politique syst&egrave;me';
$lang['tab_cart_settings'] = 'Param&egrave;tres panier';
$lang['tab_general_settings'] = 'Param&egrave;tres g&eacute;n&eacute;raux';
$lang['tab_myinfo_settings'] = 'Adresse du magasin';
$lang['tab_packaging_settings'] = 'Param&egrave;tres packaging';
$lang['tab_payment_settings'] = 'Param&egrave;tres de paiement';
$lang['tab_policy'] = 'Politique';
$lang['tab_promotion_settings'] = 'Param&egrave;tres des promotions';
$lang['tab_shipping_settings'] = 'Param&egrave;tres d&#039;exp&eacute;dition';
$lang['tab_supplier_settings'] = 'Param&egrave;tres fournisseur';
$lang['tab_tax_settings'] = 'R&eacute;glage des taxes';
$lang['tax_module'] = 'Module de calcul de taxes ';
$lang['units_centimeters'] = 'Centim&egrave;tres';
$lang['units_inches'] = 'Pouces';
$lang['unlimited'] = 'Illimit&eacute;';
$lang['weight_units'] = 'Unit&eacute;s de poids ';
$lang['yes'] = 'Oui';
$lang['utmz'] = '156861353.1307179134.1.1.utmccn=(direct)|utmcsr=(direct)|utmcmd=(none)';
$lang['qca'] = 'P0-993338197-1307181248649';
$lang['utma'] = '156861353.1313943015.1307179134.1307183425.1307285281.3';
$lang['utmc'] = '156861353';
$lang['utmb'] = '156861353';
?>