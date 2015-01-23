<?php

if( !isset($gCms) ) exit;
if( !$this->CheckPermission('Modify Products') ) exit;
$this->SetCurrentTab('hierarchy');
if( !isset($params['hierarchy_id']) ) {
	$this->SetError($this->Lang('error_missingparam'));
	$this->RedirectToTab($id);
}

$kalbos = $this->GetPreference('kalbos', 'lt');
$kalbos = explode(',', $kalbos);
$kalba = $kalbos[0];

$hierarchy_id = (int)$params['hierarchy_id'];

if( isset($params['cancel']) ) {
    $this->RedirectToTab($id);
}

$query = "SELECT name FROM ".cms_db_prefix()."module_products_hierarchy WHERE id = ? ";
$hierarchy_name = $db->GetOne($query, array($hierarchy_id));
$hierarchy_name = unserialize($hierarchy_name);
$hierarchy_name = $hierarchy_name[$kalba];

/*
$query = "SELECT B.id AS prod_id, A.order_id, B.product_name FROM ".cms_db_prefix()."module_products_prodtohier AS A LEFT JOIN ".cms_db_prefix()."module_products AS B ON B.id = A.product_id WHERE A.hierarchy_id = ? GROUP BY A.product_id ORDER BY A.order_id ASC";


$res = $db->GetArray($query, array($hierarchy_id));*/

$query = "SELECT A.product_id, B.product_name FROM ".cms_db_prefix()."module_products_prodtohier AS A LEFT JOIN ".cms_db_prefix()."module_products AS B ON B.id = A.product_id WHERE hierarchy_id = ? GROUP BY A.product_id";
$res_p = $db->GetArray($query, array($hierarchy_id));


if (!(count($res_p) > 0)) {
	
	$query1 = "SELECT name FROM ".cms_db_prefix()."module_products_hierarchy WHERE id = ?";
	$name_arr = $db->GetOne($query1, array($hierarchy_id));
	$name_arr = unserialize($name_arr);
	$name = $name_arr['lt'];
	
	$query2 = "SELECT B.product_id, C.product_name FROM ".cms_db_prefix()."module_products_hierarchy AS A LEFT JOIN ".cms_db_prefix()."module_products_prodtohier AS B ON B.hierarchy_id = A.id LEFT JOIN ".cms_db_prefix()."module_products AS C ON C.id = B.product_id WHERE long_name LIKE '%".$name." | %' AND !ISNULL(B.product_id) GROUP BY B.product_id";
	
	$res_p = $db->GetArray($query2);
	
	//echo $db->sql;
	
}

$simple_result = array();

if (is_array($res_p) && count($res_p) > 0) {
	
	$query3 = "SELECT * FROM ".cms_db_prefix()."module_products_hierordering WHERE hier_id = ? ORDER BY order_id ASC";
	$result = $db->GetArray($query3, array($hierarchy_id));
	
	$prods_simple = array();
	foreach ($res_p as $val) {
		$prods_simple[$val['product_id']] = $val['product_name'];
	}
	
	
	if (is_array($result) && count($result) > 0) {
		foreach ($result as $val) {
			if (isset($prods_simple[$val['product_id']])) {
				$simple_result[] = array(
					'prod_id' => $val['product_id'],
					'product_name' => $prods_simple[$val['product_id']]
				);
				
				unset($prods_simple[$val['product_id']]);
			}
		}
	}
	
	
	
	if (is_array($prods_simple) && count($prods_simple) > 0) {
		foreach ($prods_simple as $key => $val) {
			$simple_result[] = array(
				'prod_id' => $key,
				'product_name' => $val
			);
		}
	}
	
}



if (is_array($simple_result) && count($simple_result) > 0) {
	$smarty->assign('product_count',count($simple_result));
	$smarty->assign('products',$simple_result);
} else {
	$smarty->assign('product_count',0);
}
$smarty->assign('formstart',
		$this->CGCreateFormStart($id,'admin_order_hierarchy_products',$returnid,
					 $params,'false','post','multipart/form-data'));
$smarty->assign('formend',$this->CreateFormEnd());
$smarty->assign('mod',$this);
$smarty->assign('actionid',$id);
$smarty->assign('hierarchy_id',$hierarchy_id);
$smarty->assign('hierarchy_name',$hierarchy_name);

echo $this->ProcessTemplate('admin_order_hierarchy_products.tpl');
?>