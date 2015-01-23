<?php

function smarty_modifier_mkdate($data, $short='', $long='')
{
 if ($data){
	
	if (preg_match("/[\.\-]/", $data))
		return $data;
	
 
 
	if ($short)
		return date(CL_SHORT_DATEFORMAT, $data);
	elseif ($long)
		return date(CL_DATEFORMAT." H:i", $data);
	else	
		return date(CL_DATEFORMAT, $data);
 }else
	return "";
}

/* vim: set expandtab: */

?>
