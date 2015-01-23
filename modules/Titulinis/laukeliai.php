<?php

//print_r(array_keys($props[0]));

$a = new StdClass();
$t = new StdClass();
$d = new StdClass();
$f = new StdClass();
$r = new StdClass();

$nal[id]=1;
$nal[del]=1;
$nal[userid]=1;

function makeLangFields($th, $what, $id, $vardas, $prop, $kalbos){


	$ret = "";
	  if (sizeof($kalbos)>1 && $vardas != "kategorija"){	
	   $ret = "<table style='border-spacing: 0'><tr>";
	   $z = 0; $k='';	
       $prop = unserialize($prop); 
	   $dno = '';
	    foreach ($kalbos as $kalba){
		 //$tmpval = $prop[$kalba];
		 if ($z){$dno = " style='display: none'"; $cla = "class='komm'";}else{$cla = "class='active komm'";$dno='';}
		 $k .= "<a href='javascript:void(0)' $cla alt='$kalba'>".$th->Lang($kalba)."</a>&nbsp;";
		 $ret .= "<td $dno class='$kalba hddi'>";
		 
		 if ($what == "Text")
			$ret .= $th->CreateInputText($id,$vardas.'['.$kalba.']',$prop[$kalba],120,255);
		 elseif ($what == "TextArea")
			$ret .= $th->CreateTextArea(true, $id,$prop[$kalba],$vardas.'['.$kalba.']',$prop[$kalba], '', '', '',30, 10, '');
		 
		 $ret  .= "</td>";
		 $z++;		 
	    }
		 $ret .= "</tr></table>";
		 $ret = $k."(jei kita kalba nebus įvesta, naudos LT kalbą) <br/>".$ret ;				
	   }else{	 
	    if ($what == "Text")
	     $ret = $th->CreateInputText($id, $vardas, $prop, 120, 255);
		elseif ($what == "TextArea") 
	     $ret = $th->CreateTextArea(true, $id, $prop, $vardas, $prop, '', '', '',30, 10, '');  
	   } 
	return $ret; 
	
}


foreach ($props[0] as $vardas=>$prop) {
 if (!$nal[$vardas]){
	 //echo $propt[$vardas]."-".$propl[$vardas]." ";
  
  $t->$vardas = $this->Lang($vardas); 
  $r->$vardas = $prop;
  
  //echo $propt[$vardas].' '.$vardas.'<br/>';
 // echo $propl[$vardas].' '.$vardas.'<br/>';
 // echo "{$vardas} - {}";
  switch ($propt[$vardas]){
  
  case 252:
   $a->$vardas = makeLangFields($this, "TextArea", $id, $vardas, $prop, $kalbos);    
   break;
  case 3:
  case 1:
   if($propl[$vardas] == 1){
	   $a->$vardas = $this->CreateInputCheckbox($id, $vardas, '1', $prop);
   }else{
	   $a->$vardas = $this->CreateInputText($id, $vardas, $prop, 120, 255);
   }
   break;
  default: 
	  if($propl[$vardas] == 732){
	   $a->$vardas = $this->CreateFileUploadInput($id, $vardas);
	   $d->$vardas = $this->CreateInputCheckbox($id, "d_".$vardas, '1');
	   $f->$vardas = $prop;
	  }elseif($propl[$vardas]==597){
		$opts[$this->lang('dideli')]="dideli";
		$opts[$this->lang('valst')]="valst";
		$opts[$this->lang('visi')]="visi";
		$sel = $prop;
		if (!$sel)
			$sel = "visi";
		
		$sel = array($sel);
	  
		$a->$vardas = $this->CreateInputSelectList($id, $vardas, $opts, $sel, 1, '', false);
	  }else{
	   if ($vardas == "kategorija"){($prop)?$prop:$prop=$_GET['m1_kat'];}	
		
	   $a->$vardas = $a->$vardas = makeLangFields($this, "Text", $id, $vardas, $prop, $kalbos);    
	  }
   break;
  
 }
  
 }
}

$this->smarty->assign('f', $f);
$this->smarty->assign('d', $d);
$this->smarty->assign('a', $a);
$this->smarty->assign('t', $t);
$this->smarty->assign('r', $r);
$this->smarty->assign('props', $props[0]);


/*
$kalba = "<select name='m1_kalba'><option $selelt>Lt</option><option $seleen>En</option></select>";
$this->smarty->assign('kalba', "$kalba");
$this->smarty->assign('kalba_t', $this->lang('kalba'));

$this->smarty->assign('rodyti', $this->lang('rodyti'));
$this->smarty->assign('rod', "<input type='checkbox' name='m1_rod' $rod>");

$this->smarty->assign('antraste_tvs_t', $this->lang('antr_tvs'));
$this->smarty->assign('antraste_tvs', $this->CreateInputText($id, 'antraste_tvs', $antraste_tvs, 120, 40));

$this->smarty->assign('antraste_t', $this->lang('antr'));
$this->smarty->assign('antraste', $this->CreateInputText($id, 'antraste', $antraste, 120, 40));

$this->smarty->assign('aprasymas_t', $this->lang('aprasymas'));
$this->smarty->assign('aprasymas', $this->CreateTextArea(true, $id, $aprasymas, 'aprasymas', $aprasymas, 
'', '', '',30, 5, ''));


$pasirinkimai_q = mysql_query("SELECT * FROM ".cms_db_prefix()."prisijungimai");
$pasirinkimai[Pasirinkite]="0";

while ($pasirinkimas = mysql_fetch_array($pasirinkimai_q)){
	 $pasirinkimai[$pasirinkimas['pavadinimas']]=$pasirinkimas['id'];

	 
}


$this->smarty->assign('tipas_t', $this->lang('tipas'));
$this->smarty->assign('tipas', $this->CreateInputDropdown($id, 'tipas', $pasirinkimai, '', $tipas));

$this->smarty->assign('zoom_t', $this->lang('zoom'));

for ($i=1; $i<=19; $i++){
	$s_zoom[$i] = $i; 
}	

$this->smarty->assign('zoom', $this->CreateInputDropdown($id, 'zoom', $s_zoom, '', $zoom));

$this->smarty->assign('zoom_wt', $this->lang('zoom_w'));
$this->smarty->assign('zoom_w', $this->CreateInputDropdown($id, 'zoom_w', $s_zoom, '', $zoom_w));

$this->smarty->assign('longitude_t', $this->lang('longitude'));
$this->smarty->assign('longitude', $this->CreateInputText($id, 'longitude', $longitude, 120, 40));

$this->smarty->assign('latitude_t', $this->lang('latitude'));
$this->smarty->assign('latitude', $this->CreateInputText($id, 'latitude', $latitude, 120, 40));



$this->smarty->assign('mygt', lang('mygt'));
*/
$this->smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', lang('submit')));
$this->smarty->assign('conf', $this->CreateInputSubmit($id, 'confirm', lang('confirm')));
$this->smarty->assign('cancel', $this->CreateInputSubmit($id, 'cancel', lang('cancel')));

?>