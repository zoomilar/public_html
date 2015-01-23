<?PHP

if (!isset($gCms)) exit;
$db = $gCms->getDb();

$tvars = $this->smarty->get_template_vars();
$lang = $this->smarty->get_config_vars();
$str = $this->GetPreference('urlprefix','Products');

$lim = 6;
if ($params['detailtemplate'] == "dropdown")
	$lim = 3;

$operand = ">="; $sort = "ASC";
if ($params['turnyras'] == 'ivykes'){
	$operand = "<"; $sort = "DESC";
}	
	

	
	
$query = "SELECT * FROM cms_module_products as a LEFT JOIN cms_module_products_fieldvals as b ON a.id = b.product_id WHERE b.value_67 {$operand} '".date('Y-m-d')."' and a.status ='published' ORDER BY b.value_67 {$sort} LIMIT 0,{$lim} ";

$arr = $db->getArray($query);

$ret = array();
foreach ($arr as $k=>$v){
	$v['data'] = $v['value_67'];
	$tmp = explode("-", $v['data']);
	$v['pavadinimas_pilnas'] = $this->unser($v['value_20'], $tvars['kalba']); 
	$v['pavadinimas'] = substr($v['pavadinimas_pilnas'], 0, 42);
	$v['datash'] = "{$tmp[1]}-{$tmp[2]}";
	$tmp2 = date("w", strtotime($v['data']));
	//$v['savd'] = $tmp;
	$v['savd'] = $lang["diena{$tmp2}"];
	$v['id'] = $v['id'];
	
	$v['url'] = "/{$str}/{$v['id']}/{$lang['turnyrupslid']}/{$v['alias']}.html";
	if ($tmp[0] == date("Y")){
	$ret[] = $v;
	}
	
}
//	$ret .= "<p><a href='{$v['url']}'>{$v['data']}&nbsp;&nbsp;&nbsp;{$v['pavadinimas']}</a></p>";
//$ret = substr($ret, 0,-5);
$this->smarty->assign("items", $ret);

//echo $ret;

//$params  = GetModuleParameters('Products');



echo $this->ProcessTemplate("frontend/{$params['detailtemplate']}.tpl");

?>