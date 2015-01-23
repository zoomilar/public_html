<?php
function smarty_modifier_rndimg($string)
{
	global $config;

	
    $path = $config['root_path']."/uploads/".$string;

    // Open the folder 
    $dir_handle = @opendir($path) or die("Unable to open $path"); 	
	
	$img = array();
	while (false !== ($file = readdir($dir_handle))) {
              if(strlen($file)>1 && $file != ".."){
				$img[] = "{$string}{$file}";
			  }

    } 
	
	
	$viso = sizeof($img)-1;
	

	$im = rand(0,$viso);
	return $img[$im];

}

/* vim: set expandtab: */

?>
