<?php
function smarty_modifier_tomonth($string, $kalba)
{
if ($kalba == "lt"){
	$m = array('Sau.', 'Vas.', 'Kov.', 'Bal.', 'Geg.', 'Bir.', 'Lie.', 'Rug.', 'Rgs.', 'Spa.', 'Lap.', 'Gru.');
}else{
	$m = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
}		
	


	$month = date("m", strtotime($string));
	$month = $month*1;
	return $m[$month];
}

/* vim: set expandtab: */

?>
