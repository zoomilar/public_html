<?php

function smarty_modifier_select($value, $expected, $text, $onlysel=0,$alttag)
{
  if ($alttag)
	$alttag = "alt='{$alttag}'";

  if (is_array($value)){
	if (in_array($expected, $value))
		$s = " selected";
	else
		$s = "";  
  }else{
	if ($value == "$expected")
		$s = " selected";
	else
		$s = "";
  }	
  if ($onlysel)
	return $s;		
  else	
	return "<option {$alttag} value='{$expected}' {$s}>{$text}</option>";		
}

?>
