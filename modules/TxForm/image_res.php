<?php
		$formatas_plotis = 920;
		$formatas_aukstis = 220;
		  
		require_once(dirname(__FILE__).'/../../lib/filemanager/ImageManager/Classes/GD.php');
        $img = new Image_Transform_Driver_GD;
        $img->load($fupload);
		$proportion = $formatas_plotis/$formatas_aukstis;
		$width = $img->img_x;
		$height = $img->img_y;
		
		$kiek_mazes = $width/$formatas_plotis;
		$Xkr = $formatas_plotis;
		$Ykr = $height/$kiek_mazes;
		$k1 = 1;
		if ($Ykr < $formatas_aukstis){
			$Ykr = $formatas_aukstis;
			$kiek_mazes = $height/$formatas_aukstis;
			$Xkr = $width/$kiek_mazes;
			$k1=2;
		}

        $img->_resize($Xkr, $Ykr);
        
		if ($k1 == 1){
		 $img->crop(0 ,($img->img_y-$Ykr) / 2, $formatas_plotis, $formatas_aukstis);
	 	}else{
		 $img->crop(($img->img_x-$Xkr) / 2 ,0, $formatas_plotis, $formatas_aukstis);
	 	}
		
		$img->save($fupload, 'jpeg');
        $img->free();	
        
?>
