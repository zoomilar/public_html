<?php
if (!isset($gCms)) exit;
	echo '	<ul class="innermenu clear">';

	require_once("{$_SERVER['DOCUMENT_ROOT']}/lib/smarty/plugins/modifier.weekday.php");
	
  $detect = new Mobile_Detect;
  $isMobile = $detect->isMobile();
  $isTablet = $detect->isTablet();
  $str = $this->GetPreference('urlprefix','Products');
  
  $qtip = "show_qtip2";
  if ($isMobile || $isTablet)
	$qtip = "";
	
	
	$par = $this->smarty->get_template_vars();
	$lang = $this->smarty->get_config_vars();

	$k = $db->getOne("SELECT category_id FROM cms_module_products_product_categories WHERE product_id='{$params['turnyras']}'");
	$query = "SELECT p.*, d.* FROM cms_module_products as p LEFT JOIN cms_module_products_product_categories as k ON p.id=k.product_id LEFT JOIN cms_module_products_fieldvals as d ON p.id = d.product_id WHERE k.category_id = '{$k}' and status ='published' ORDER BY d.value_67 ASC";
	$turnyrai = $db->getArray($query);
	foreach ($turnyrai as $k=>$v){
		$turnyrai[$k]['pavadinimas_pilnas'] = $this->unser($v['value_20'], $par['kalba']);
		$turnyrai[$k]['pavadinimas'] = substr($turnyrai[$k]['pavadinimas_pilnas'], 0, 42);
		$turnyrai[$k]['data'] = $v['value_67'];
		$turnyrai[$k]['url'] = "/{$str}/{$v['id']}/{$lang['turnyrupslid']}/{$v['alias']}.html";	
		$turnyrai[$k]['savdiena'] = smarty_modifier_weekday($v['value_67'], $par['kalba']);	
	
	}

	
	$i=0;$a=0;
	foreach($turnyrai as $entry){
		$i++;
		if ($entry['id'] == $params['turnyras'])
			$a = $i;
	}		
	$kiek = $i;
	
	$i = 0;
	
	if($a != 1){
			$link = "/{$str}/{$turnyrai[$a-2]['id']}/361/{$turnyrai[$a-2]['alias']}.html";	
		echo "<li><a href=\"{$link}\" class='arrbck {$qtip}'  title='{$turnyrai[$a-2]['pavadinimas_pilnas']}' style=''></a></li>";
	}
	

	
	foreach ($turnyrai as $entry){
	$i++;
		$sel = "";
		if ($entry['id'] == $params['turnyras'])
			$sel = " class='selected'";
	
		$d = "";

		
		
		// a 7 ir 8 | i 10 ir 11 |||||| 5 >= -1 && 5 > 6
		
		//7 5 10
		
	 // if (($i <= $a+3 && $i >= $a-3) || ($i <= 7 && $a < 5) || ($i >= $kiek-6 && $a > ($kiek-4)) || ($kiek <=6)){
	  if (($i <= $a+2 && $i >= $a-2) || ($i <= 5 && $a < 4) || ($i >= $kiek-4 && $a > ($kiek-3)) || ($kiek <=5)){
	  //if (($i <= $a+5 && $i >= $a-5) || ($i <= 9 && $a < 7) || ($i >= $kiek-10 && $a > ($kiek-6)) || ($kiek <=8)){
		//echo "{$i}-{$a}({$kiek})|";
		
	
		//echo "$i-$a | ";
	
			}else{
					$d = " style='display: none'";

			}
			
		
			

		echo "
			
                        <li {$sel} {$d}>
                        	<a href='/{$str}/{$entry['id']}/{$lang['turnyrupslid']}/{$entry['alias']}.html' class='innlink {$qtip}'  title='{$entry['pavadinimas_pilnas']}'>{$entry['data']}&nbsp;&nbsp;&nbsp;{$entry['savdiena']}</a>
                        </li>		
		
		";
	
	}
	
	if ($a != $kiek){
			$link = "/{$str}/{$turnyrai[$a]['id']}/{$lang['turnyrupslid']}/{$turnyrai[$a]['alias']}.html";
	
			echo "<li><a href=\"{$link}\" class='arrfwd {$qtip}'  title='{$turnyrai[$a]['pavadinimas_pilnas']}'></a></li>";

	}	

		echo "</ul>";
	
	
?>
