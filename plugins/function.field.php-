<?php
/*

	{field type="text" name="title" divider="td:leftc:rightc"}
	{field type="textarea" name="textw" rows="5" class="area" divider="td:leftc:rightc"}
	{field type="select" name="priority" pre="priority" options=$statuses divider="td:leftc:rightc"}		
	{field type="kalend" name="end" now="1" divider="td:leftc:rightc"}
	{field type="checkbox" name="primintisms" divider="td:leftc:rightc"}


	Author Texus, UAB "Sales Partners".  www.texus.lt

	Formuoja formos laukelius.
	Params:
	type: text,input,select,checkbox,textarea,kalend,hidden,button,submit
	name: lauko pavadinimas
	fieldadd: papildomas atributas pvz rows="4"	
	value: neivedus - ima $fields masyva is template ir iesko pagal lauko name, ivedus - toki ir isveda
	label: neivedus - ima f+laukopavadinimas, 0 - neisves jokio, ivedus - custom
	labeladd: priedas prie label pabaigos	
	style: field'o custom style
	class: field'o custom class, kitu atveju lygi field'o tipo
	lclass: label custom class
	onclick: onclick attribute
	lng: priedas prie kalbines konstantos pavadinimo. Jei nera, default f 
	required: ar privalomas
	readonly: tik nuskaito
	onchange: ...
	
	
	
	divider: tag'as kuriuo atskiriam label nuo field; pvz: div, div:class1:class2 -> per dvitaskius atskiriama klase pries label, klase pries field
	divideradd: antram tagui papildomas atributas	
	row: parent tagas, pvz div:row -> <div class="row">LAUKAS</div>
	fieldouter: informacija aplink fielda. Exploadina aplink <FIELD>
	
	greitam saugojimui
		savelink: action'as kuriuo saugom
		entry_id: iraso ID 
	
	text specifiniai atributai:
		suggestion: padaro suggestion lista nurodytoje lenteleje. Lentele:stulpelis:susijes_stulpelis1,susijes_stulpelis2... (susijes stulpelis - kokius stulpelius dar uzpildys)
		suggestionparent: koki stulpeli nuimti i parent.parentname -> lentele:sub'e esantis stulpelis-parent lenteles stulpelis:parent stulpelio pavadinimas suggestionparent="standartai_groups:grupe-ID:name"
		popupsuggestion: koki actiona atidaryti, kad rodytu popup lentele su suggestionu pasirinkimais. Pvz.: popupsuggestion="standartai,listinone". Kalbine konstanta - rinktisissaraso
		suggestionshow: kiek stulpeliu rodyti is eiles skaiciuojant
		suggestiondepends: kuri laukeli laikyti kaip parenta ir pagal ji siaurinti reiksmes
		defval: default reiksme jei nera kitokios
	
	textarea specifiniai atributai:	
		nowysiwyg: 1 - br'us pakeicia i n
		rows: textarea rows atributas
		cols: textarea rows atributas
		
	kalend specifiniai atributai:	
		date_short, date_long: specifiniai parametrai mkdate modifieriui	
		now: sugeneruoti dabartine data jei tuscia
	
	select ir multiselect specifiniai atributai:
		options: select options array  arba reiksmes per kableli - tada key ir value bus tas pats
		selected: default selected option kai nera value
		pre: kai naudojamas predefined masyvas, nurodoma is kur imti	
		arr: jei options listas masyvinis, tai value_dimensija:text_dimensija:selected_dimensija (pvz arr="ID:name") . Selected dimensija 1 arba 0. Jei nurodomas langfile - iesko tarp langfile
		first: pirma select reiksme
		firstval: pirmo select value
		mas: ar masyvinis
		narrow: rodyti tik nurodytus elementus key:value, pvz padalinys:2 (cia tinka kai masyvas yra multidimensinis ir reikia )
	button specifiniai:
		confirm: delete
		popup: atidaro pasirinkimo langa
		

*/

function smarty_function_field($params, &$smarty)
{
	global $langfile;
	$modifiers = "mkdate,select,br2nl";

	$rfnm = $fnm = $params['prefix'].$params['name'];	
	
	$tfnm = explode('[', $fnm);
	if ($tfnm[1])
		$fnm = substr($tfnm[1], 0,-1);
	
	
	if(isset($params['prefix'])){
		$fnm = substr($fnm,strlen($params['prefix']));
	}

	
	if ($params['mas'] || $params['type']=='multiselect')
	  $rfnm .= '[]';	
	
	if (isset($params['value']))
		$fields[$fnm] = $params['value'];
	else
		$fields = $smarty->get_template_vars('fields');
	
	
				
	if(isset($params['lng']))			
		$fnmf = "{$params['lng']}{$fnm}";
	else
		$fnmf = "f{$fnm}";
	
	if(in_array($params['type'], array("submit", "button", "buttonlink","buttonopenframe")) && !$fnm){
		$params['label'] = 0;
	}else{		
		$langlabel = ($langfile[$fnmf])? $langfile[$fnmf] : "-- {$fnmf} --";
	}	
	
	$label = ($params['label']) ? $params['label'] : $langlabel;
	if ($params['labeladd'])
		$label .= $params['labeladd'];	
	

	
	if ($params['required'])
		$label .= "*";
		
	if ($params['lclass'])
		$lclass = " class='{$params['lclass']}'";
		
	
	$label = ($params['label'] != "0") ? "<label for='{$fnm}'{$lclass}>{$label}</label>" : "";	
	
	
	$value = $fields[$fnm];		
	/*if(isset($params['prefix'])){
		$vapref = substr($fnm,strlen($params['prefix']));
		$value = $fields[$vapref];		
	}*/	
	if (!$value) $value = $params['defval'];
	
	$fieldadd = ($params['fieldadd']) ? " ".$params['fieldadd'] : "";
	if (!isset($params['class']) && $params['type'] == "select")
		$params['class'] = "fselect";
		
	$class = (isset($params['class'])) ? $params['class'] : $params['type'];
	if ($params['popup'])
		$class .= ' xpopup';
	
	
	if ($params['savelink']){
		$params['savelink'] = urlprefi.$params['savelink'];
		$class .= " xchange";
		$prm .= ",u:'{$params['savelink']}', entity_id:'{$params['entity_id']}'";
	}	
	
	if ($params['subselect']){
		$tmp = explode("|", $params['subselect']);

		$prm .= ",u:'ajax,loadSelect', s:'{$tmp[0]}', t:'{$tmp[1]}'";
		
		if ($params['arr'])
			$prm .= ",arr: '{$params['arr']}'";
		else
			$prm .= ",arr: 'ID:pavadinimas'";		
			
		if ($params['serlang'])
			$prm .= ",serlang: '{$params['serlang']}'";	
		else
			$prm .= ",serlang: 'en'";	

		
	}
	
	if ($params['suggestion']){
		$class .= " xsuggest";
		$prm .= ",u: '".urlprefi."ajax,suggestion', p:'{$params['suggestion']}'";

		if ($params['suggestionparent'])
			$prm .= ", pp:'{$params['suggestionparent']}'";
			
		if ($params['suggestiondepends'])	
			$prm .= ", sd:'{$params['suggestiondepends']}'";

		if ($params['distinct'])	
			$prm .= ", ds:'1'";			
			
		if ($params['suggestionshow'])
			$prm .= ", k:'{$params['suggestionshow']}'";			
		
		
		$fieldadd .= " autocomplete='off'";
	}
	
	if ($params['confirm']){
		$params['onclick'] = "if(!confirm('".$langfile['confirmdel']."')) return false";
	}
	
	
	//if ($params['required']) 		$fieldadd .= " required='1'";
	if ($params['subselect'])	
		$params['onchange'] .= " jQuery.loadSelect(jQuery(this))";
		
	
	$fieldadd .= ($params['onblur']) ? " onblur=\"if(this.value=='') this.value='".$params['value']."'\"" : "";
	$fieldadd .= ($params['onfocus']) ? " onfocus=\"this.value=''\"" : "";
	$fieldadd .= ($params['params']) ? " params=\"{$params['params']}\"" : "";
	$fieldadd .= ($params['rows']) ? " rows=\"{$params['rows']}\"" : "";
	$fieldadd .= ($params['cols']) ? " cols=\"{$params['cols']}\"" : "";
	$fieldadd .= ($params['onclick']) ? " onclick=\"{$params['onclick']}\"" : "";
	$fieldadd .= ($params['style']) ? " style='{$params['style']}'" : "";
	$fieldadd .= ($params['readonly']) ? " readonly='1'" : "";
	$fieldadd .= ($params['onchange']) ? " onchange=\"{$params['onchange']}\"" : "";
	$fieldadd .= ($params['popup']) ? " params=\"{k: 'popupsuggestion', 't':'', w:'800'}\"" : "";
	if ($prm){
		$prm = substr($prm, 1);
		$fieldadd .= " params=\"{".$prm."}\"";
	}
	
		$modifiers = explode(',',$modifiers);	
		foreach ($modifiers as $modifier){
			require_once("modifier.{$modifier}.php");
		}	
	
	 if($params['multilang']){
		
				global $obj, $locale;			
				$kalbos = $obj->getLanguages();
				
				$field .= "<div class='rcol'>";
				foreach($kalbos as $tmpk){
					$lngk = $tmpk['val'];
					$kalba = $tmpk['name'];
					
					if($locale == $lngk){
						$actadd = "active";
					}else{
						$actadd = "";
					}

						$field .= "<a alt='{$kalba}' class='chst lang {$actadd} stblu lang{$lngk}' href=\"javascript:chln('{$lngk}')\"><span class='sleft'>{$kalba}</span><span class='sright'>&nbsp;</span></a> ";
				}
				$field .= "<br/>";		
	 }	
	
	switch ($params['type']){
		case "input":
		case "text":
		case "kalend":
		case "password":
			if ($params['type'] == "kalend"){
				if ($params['now'] && !$value)
					$value = time();
			
				$value = smarty_modifier_mkdate($value, $params['date_short'], $params['date_long']);
				if ($class != "kalend")
					$class .= " kalend";
				
				$class .= " text";
			}
			$ftyp = ($params['type'] == "password")? 'password' : 'text';
			
			if ($params['multilang']){
				foreach($kalbos as $lngk=>$kalba){
					if($locale != $lngk){
						$actadd = "style='display: none'";
					}else{
						$actadd = "";
					}

						$field .= "<input type='{$ftyp}' id='{$fnm}' class='{$class} f{$lngk} lngf' name='{$rfnm}[{$lngk}]' id='{$rfnm}{$lngk}' value='{$value[$lngk]}' {$actadd} {$fieldadd}/>";
				}				
				

				$field .= "</div>";	  
			}else{	
				$field = "<input  type='{$ftyp}' name='{$rfnm}' id='{$fnm}' value='{$value}' class='{$class}'{$fieldadd}/>";
			}	
		break;
		case "file":
			$field = "<input  type='{$params['type']}' name='{$rfnm}' id='{$fnm}' class='{$class}'{$fieldadd}/>";
		break;
		case "checkbox":
			$checked = ($fields[$fnm]) ? " checked" : "";
			$field = "<input type='hidden' name='{$fnm}' value='0'/>
			<input type='checkbox' name='{$rfnm}' id='{$fnm}' value='1' class='{$class}'{$checked}{$fieldadd}/>";
			if($params['label_left']) $field .= $params['label_left'];
		break;
		case "radio":
			$checked = ($fields[$fnm]) ? " checked" : "";
			$field = "
			<input type='radio' name='{$rfnm}' id='{$fnm}' value='{$value}' class='{$class}'{$checked}{$fieldadd}/>";
			if($params['label_left']) $field .= $params['label_left'];
		break;			
		case "textarea":		
			if ($params['multilang']){
				foreach($kalbos as $lngk=>$kalba){
					if($locale != $lngk){
						$actadd = "style='display: none'";
					}else{
						$actadd = "";
					}

					$field .= "<textarea name='{$rfnm}[{$lngk}]' id='{$rfnm}{$lngk}' class='{$class} f{$lngk} lngf'{$fieldadd}{$actadd}>{$value[$lngk]}</textarea>";
				}				
				

				$field .= "</div>";	  
			}else{			
				if ($params['nowysiwyg'])
					$value = smarty_modifier_br2nl($value);
				if(is_array($value)) $value = implode('\n',$value);		
				
				$field = "<textarea name='{$rfnm}' id='{$fnm}' class='{$class}'{$fieldadd}>{$value}</textarea>";
			}	
		break;
		case "select":	
		case "multiselect":	
		
		  if($params['id'])
			$fnm = $params['id'];
		
		
		  if ($params['type'] == "multiselect")
			$field = "<select name='{$rfnm}' multiple='multiple' id='{$fnm}' class='{$class}'{$fieldadd}>";
		  else
			$field = "<select name='{$rfnm}' id='{$fnm}' class='{$class}'{$fieldadd}>";
			
			
			if ($params['first']){
				if (!isset($params['firstval']))
					$params['firstval'] = $params['first'];
				$field .= "<option value='{$params['firstval']}'>{$params['first']}</option>";
			}
			
			if ($params['pre']){
				$params['selected'] = $params['options'][$params['pre']."def"];
				$params['options'] = $params['options'][$params['pre']];				
			}	
				  
			$field .= "";
				if (!is_array($params['options'])){
					$params['options'] = explode(',', $params['options']);
					foreach($params['options'] as $k=>$option){					
						unset($params['options'][$k]);
						$option = ($langfile[$option]) ? $langfile[$option] : $option;
						$params['options'][$option] = $option;
					}
				}
				if ($params['arr']){
					$params['arr'] = explode(":", $params['arr']);
					
					$value_dim = $params['arr'][0];					
					$text_dim = $params['arr'][1];					
					$sel_dim = $params['arr'][2];					
					
					if (!$text_dim)
						$text_dim = $value_dim;
				}
			
				
				if ($params['narrow']){
					$salygos = explode(":", $params['narrow']);
				}
				
				
					if($value=='')
						$value = $params['selected'];			
			
				foreach($params['options'] as $k=>$option){
		
					if($params['alttag'])
						$alttag = $option[$params['alttag']];
				
				
				  if(!$salygos[1] || ($option[$salygos[0]] == $salygos[1])){
				
					if($value=='' && $option[$sel_dim])
						$value = $option[$value_dim];		


					if ($value_dim){					
						if ($value_dim == "langfile"){
							$k = $option;
							$option = $langfile[$option];							
						}else{
							$k = $option[$value_dim];
							$option = $option[$text_dim];
						}	
					}
					
					if ($params['serlang'])
						$option = $option[$params['serlang']];
				
		
					
				
					$field .= smarty_modifier_select($value,$k,$option,'',$alttag);
				 }	
				}
				
				
			$field .= "</select>";
		break;	
		case "radio":
			foreach($params['options'][$params['pre']] as $k=>$option){	
		
			  if ($value = '')
				$value = $params['options'][$params['pre']."def"];
			
			  $checked = str_replace('selected', 'checked', smarty_modifier_select($value,$k,$option,1));
			  
			  $field .= "<input type='radio' name='{$rfnm}' id='{$fnm}' class='{$class}' {$fieldadd} value='{$k}'{$checked}/> {$option}";
			}			
		break;
		case "submit":
		case "button":
			$field = "<input type='{$params['type']}' name='{$rfnm}' id='{$fnm}' value='{$value}' class='{$class}'{$fieldadd}/>";
		break;
		case "buttonlink":
			if ($params['popup'])
				$lkclass = " class='xpopup' ";	
				
			if ($params['inclass'])	
				$lkclass = " class='{$params['inclass']}'";
			
			$href = ($params['href']) ? $params['href'] : "javascript:;";			
			$field = "<div class='button but {$class}'><span class='center'><a href='{$href}'{$lkclass}{$fieldadd}>{$value}</a></span><span class='right'>&nbsp;</span></div>";
		break;		
		case "buttonopenframe":		
			$href = ($params['href']) ? $params['href'] : "javascript:;";
			if (!$params['onlylink'])
				$field = "<div class='button hdg' id='accb' {$class}><span class='center'>";
			
			$field .= "<a id='clc' class='add fra' title='{$params['title']}'  href='{$href}'  onclick='return false' alt='calcdiv'>{$value}</a>";
			
			if (!$params['onlylink'])
				$field .= "</span><span class='right'>&nbsp;</span></div>";
		break;		
		case "hidden":
			$label = '';
			$field = "<input type='{$params['type']}' name='{$rfnm}' id='{$fnm}' value='{$value}'{$fieldadd}/>";
		break;		
	}
	
	
	if ($params['popupsuggestion']){
		if($params['suggestiondepends']){
			$prma = ", sd:'{$params['suggestiondepends']}'";
		}	
		$field .= "<div class='row'><a class='rinktis' href='".urlprefi."{$params['popupsuggestion']}' params=\"{k: 'popupsuggestion', t:'', w:'800'{$prma}}\">{$langfile['rinktisissaraso']}</a></div>";
	}	
	
	if ($params['fieldouter']){
		$fieldouter = explode("<FIELD>", $params['fieldouter']);
		$field = "{$fieldouter[0]}{$field}{$fieldouter[1]}";
	}
	
	if ($params['divider']){
		$divider = explode(':', $params['divider']);
		$divclass1 = ($divider[1]) ? " class='{$divider[1]}'" : "";
		$divclass2 = ($divider[2]) ? " class='{$divider[2]}'" : "";
		$divideradd = ($params['divideradd']) ? " ".$params['divideradd'] : "";
		$ret = "<{$divider[0]}{$divclass1}>{$label}</{$divider[0]}><{$divider[0]}{$divclass2}{$divideradd}>{$field}</{$divider[0]}>";	
	}else{
		$ret = "{$label}{$field}";
	}
	
	if ($params['row']){
		$row = explode(':', $params['row']);
		$class = ($row[1]) ? " class='{$row[1]}'" : "";
		$ret = "<{$row[0]}{$class}>{$ret}</{$row[0]}>";
	}
	
	return $ret;
}	
?>
