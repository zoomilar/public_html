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

$query = "SELECT B.id AS prod_id, A.order_id, B.product_name FROM ".cms_db_prefix()."module_products_prodtohier AS A LEFT JOIN ".cms_db_prefix()."module_products AS B ON B.id = A.product_id WHERE A.hierarchy_id = ? GROUP BY A.product_id ORDER BY A.order_id ASC";

$res = $db->GetArray($query, array($hierarchy_id));

if (is_array($res) && count($res) > 0) {
	$smarty->assign('product_count',count($res));
	$smarty->assign('products',$res);
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