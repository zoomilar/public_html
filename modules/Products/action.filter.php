<?php

if( !isset($gCms) ) exit;

global $filter_params;

$kalba = $smarty->get_template_vars('kalba');

$hier_a = GetModuleParameters('cntnt01');
$filter_a = GetModuleParameters($id);
$params = array_merge($hier_a, $filter_a, $params);

$kalbos = $this->GetPreference('kalbos', 'lt');
$main_kalba = explode(',', $kalbos);
$main_kalba = $main_kalba[0];

$summarypage = $this->GetPreference('summary_page_field_'.$kalba, $summarypage);


$filters = $this->GetFilters($id, $params['hierarchyid'], $params, $kalba, $main_kalba);


$smarty->assign('filters', $filters);

$parms = array();
$parms['hierarchyid'] = $params['hierarchyid'];
$url = $this->CreatePrettyLink('cntnt01','default',$summarypage,'',$parms,'',true);

$smarty->assign('url_path', $url);
//$smarty->assign('formstart', $this->CreateFormStart($id, 'filter', $returnid, 'get'));
//$smarty->assign('formend', $this->CreateFormEnd());

if (is_array($filter_a) && count($filter_a) > 0) {
	$filter_params = $filter_a;
} else{
	$filter_params = array();
}

if (is_array($filters) && count($filters) > 0) {
	echo $this->ProcessTemplate('frontend/filter.tpl');
}
?>