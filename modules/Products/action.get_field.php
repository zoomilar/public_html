<?php


if( !isset($gCms) ) exit;

$config = $gCms->GetConfig();


$field = $this->GetFieldById($params['fieldid']);

$field['optionslng'] = unserialize($field['optionslng']);

$smarty->assign('field', $field['optionslng']);
$smarty->assign('file_location', $config['uploads_url'].'/'.$this->GetName().'/fielddef');

echo $this->ProcessTemplate('frontend/field_1.tpl');
?>