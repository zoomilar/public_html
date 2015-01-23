<?php
function smarty_modifier_gav($string)
{
	$string = explode(" ", $string);
	return "{$string[0]} \ {$string[1]}";
}

/* vim: set expandtab: */

?>
