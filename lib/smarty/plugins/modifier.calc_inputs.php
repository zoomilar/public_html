<?php
function smarty_modifier_calc_inputs($arr, $num, $selected, $skaiciuoti)
{

	$st = '';
	if ($num == $selected)
		$st = "style='display:block'";
		
	$fields = $arr[$num];	
	$kiek = sizeof($fields);
	
	$sep = $kiek/3;
	$sep = ceil($sep);
	
	$ret = "";
	
	$ret .= "
		<li class='typ_{$num}' {$st}>
			<table>
				<tr><td style='vertical-align: top'>
	";	
	$i=0;
	foreach ($fields as $v){
		if ($i == $sep){
			$i = 0;
			$ret .= "</td><td style='vertical-align: top'>";
		}
		$i++;
		$ret .= "<div>{$v}</div>";
	}
		
	
	$ret .= "
		</td>
		</tr>
		</table>
		<a href='javascript:void(0)' class='xsubmit'>{$skaiciuoti}</a>
		</li>
	";


    return $ret;
}


?>
