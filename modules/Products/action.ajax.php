<?php
if (!isset($gCms)) exit;
$config = $gCms->GetConfig();
$products = $gCms->GetModuleInstance('Products');

switch ($action_x) {
	case "add_compare":
		$products->addCompareProd($_POST['prod_id']);
	break;
	case "check_compare":
		echo $products->countCompareProd();
	break;
	case "remove_compare":
		$products->removeCompareProd($_POST['prod_id']);
	break;
	case "ProductsUpload":
		echo $products->uploadImage($_GET['product_id'], $_GET['field_id']);
	break;
	case "GetProductsFileList":
		$ret = $products->GetProductsFileList($_POST['product_id'], $_POST['field_id']);
		if ($ret == false) {
			echo json_encode(array('status' => false));
		} else {
			echo json_encode(array('status' => true, 'files' => $ret));
		}
	break;
	case "ProductSortImages":
		echo $products->ProductSortImages($_GET['ser'], $_GET['product_id'], $_GET['field_id']);
	break;
	case "DellProductsFile":
		echo $products->DellProductsFile($_POST['file'], $_POST['product_id'], $_POST['field_id']);
	break;
	case "GetHierFields":
		$ret = $products->GetHierFields($_POST['hier_id'], 1);
		if ($ret == false) {
			echo json_encode(array('status' => false));
		} else {
			echo json_encode(array('status' => true, 'field_id' => $ret));
		}
	break;
	
	case "ProductsSortProd":
		$products->orderHierProducts($_GET);
	break;
	
}

?>