<?php
include_once('include.php');
global $gCms;
global $langfile;
$db = $gCms->GetDb();

if (isset($_POST['action'])) {
	$action_x = $_POST['action'];
} else {
	$action_x = $_GET['action'];
}

switch ($action_x) {
	case "add_compare":
	case "check_compare":
	case "remove_compare":
	case "ProductsSortProd":
		include('modules/Products/action.ajax.php');
	break;
	
	case "add_to_cart":
	case "get_cart":
	case "get_cart_view":
	case "change_cart":
		include('modules/Cart/action.ajax.php');
	break;
	
	case "ProductsUpload":
	case "GetProductsFileList":
	case "ProductSortImages":
	case "DellProductsFile":
	case "GetHierFields":
		include('modules/Products/action.ajax.php');
	break;
	case "GetFilelistFileList":
	case "FilelistUpload":
	case "FilelistSortImages":
	case "DellFilelistFile":
	case "GetFilelistFileList2":
	case "FilelistUpload2":
	case "FilelistSortImages2":
	case "DellFilelistFile2":
		include('modules/Filelists/action.ajax.php');
	break;
}

?>