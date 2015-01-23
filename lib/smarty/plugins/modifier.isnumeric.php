<?php
function smarty_modifier_isnumeric($string)
{
if(preg_match ("/^([0-9]+)$/", $params)) 
{ 
$ret = 1; 
} else { 
$params = str_replace('.','',$params); 
$params = str_replace(',','',$params); 
$params = str_replace('-','',$params); 
$params = str_replace(' ','',$params); 
if(preg_match ("/^([0-9]+)$/", $params)) 
{ 
$ret = 1; 
} else { 
$ret = 0; 
} 
} 
return $ret; 
}

/* vim: set expandtab: */

?>
