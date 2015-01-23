<?PHP


 require_once($config['root_path'].'/lib/filemanager/ImageManager/Classes/GD.php');
 Class gdext extends Image_Transform_Driver_GD {
 

	function resizeANDcrop($new_x, $new_y){

		
		$old_x = $this->img_x;
		$old_y = $this->img_y;
		
		$old_r = $old_x/$old_y;
		$new_r = $new_x/$new_y;
		
		if(($new_x<$old_x) && ($new_y<$old_y))
		{
			if($old_r >= $new_r){
				$this->crop(($old_x - $old_y*$new_r )/2, 0, $old_y*$new_r, $old_y);
				$this->img_x = $old_y*$new_r;
				
			}
			
			elseif ($old_r < $new_r){
				$this->crop(0, ($old_y - $old_x/$new_r )/2, $old_x, $old_x/$new_r);
				$this->img_y = $old_x/$new_r;

			}
			$this->resized = false;
			$this->_resize($new_x, $new_y);
		}
		elseif (($new_x>$old_x) && ($new_y<$old_y)){
			$this->crop(0, ($old_y - $new_y)/2, $old_x, $new_y);
		}
		elseif (($new_x<=$old_x) && ($new_y>=$old_y)){
		
			$this->crop(($old_x - $new_x)/2, 0, $new_x, $old_y);
		}
		
		
	}
	
	function resizeAndCenter($pl, $au, $koef, $clr){
		if (!is_array($clr))
			$clr = explode(",", $clr);
		
		//$fnew = $pra.$addi.$fnam;
		$pred_wd_out = $pl;
		$pred_wd = round($pred_wd_out * $koef,0);
		$pred_hg_out = $au;
		$pred_hg = round($pred_hg_out * $koef,0);


		//$img->load($fupload);
		
		//list($width, $height) = getimagesize($fupload); 
$width = $this->img_x;
$height = $this->img_y;
		if ($width > $pred_wd){
			$r = 1;
			$nw = $pred_wd; 
			$diff = $pred_wd/$width;
			$nh = $diff*$height;
			if ($nh > $pred_hg){
				$nh = $pred_hg;
				$diff2 = $pred_hg/$height;
				$nw = $diff2*$width;
			}
		}elseif ($height > $pred_hg){
			$r = 1;
			$diff = $pred_hg/$height;
			$nh = $pred_hg;
			$nw = $diff*$width;
		}else{
			$r=0;
			$nw = $width;
			$nh = $height;
		}
		
		if ($r){
		//echo $pred_wd_out." - ".$nw." | ".$pred_hg_out." - ".$nh." <br/> ";
			$this->_resize($nw, $nh);
				
		}else{		
			imagealphablending($this->imageHandle, false);
			$color = imagecolorallocatealpha($this->imageHandle, 0, 0, 0, 127);
			imagefill($this->imageHandle, 0, 0, $color);
			imagesavealpha($this->imageHandle, true);	
		
						
		}
			
				

	   /*switch(substr ($fnew,strrpos ($fnew,".")+1)) 
	   { 
		   case 'png': 
		   case 'PNG': 
			   $iTmp = imagecreatefrompng($fnew); 
			   break; 
		   case 'gif': 
		   case 'GIF': 
			   $iTmp = imagecreatefromgif($fnew); 
			   break;                
		   case 'jpeg':            
		   case 'jpg': 
		   case 'JPG': 
		   case 'JPEG': 
			   $iTmp = imagecreatefromjpeg($fnew); 
			   break;                
	   } 			
				*/
		
		$iOut = imagecreatetruecolor("$pred_wd_out","$pred_hg_out") ; 
		$bg = imagecolorallocate($iOut, $clr[0], $clr[1], $clr[2]);
		

		
		imagefill ( $iOut, 0, 0, $bg );
		
		

		$pw = ($pred_wd_out-$nw)/2;
		$ph = ($pred_hg_out-$nh)/2;
		/*
		
				imagealphablending($iTmp, false);
				$color = imagecolorallocatealpha($iTmp, 0, 0, 0, 127);
				imagefill($iTmp, 0, 0, $color);
				imagesavealpha($iTmp, true);		
	*/
		imagecopy($iOut,$this->imageHandle,$pw,$ph,0,0,$nw,$nh); 				
		//imagefilter($iOut, IMG_FILTER_GRAYSCALE);
		//imagefilter($iOut, IMG_FILTER_BRIGHTNESS, 30);
		

		$this->imageHandle = $iOut;
		
		
	}
	
 }


?>