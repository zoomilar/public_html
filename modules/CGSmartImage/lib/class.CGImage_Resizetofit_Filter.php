<?php
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: CGSmartImage (c) 2011 by Robert Campbell (calguy1000@cmsmadesimple.org)
#  
#  An addon module for CMS Made Simple to allow creating image tags in a smart
#  way to optimize performance.
# 
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2005-2010 by Ted Kulp (wishy@cmsmadesimple.org)
# This project's homepage is: http://www.cmsmadesimple.org
#
#-------------------------------------------------------------------------
#
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# However, as a special exception to the GPL, this software is distributed
# as an addon module to CMS Made Simple.  You may not use this software
# in any Non GPL version of CMS Made simple, or in any version of CMS
# Made simple that does not indicate clearly and obviously in its admin 
# section that the site was built with CMS Made simple.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
# Or read it online: http://www.gnu.org/licenses/licenses.html#GPL
#
#-------------------------------------------------------------------------
#END_LICENSE

class CGImage_Resizetofit_Filter extends CGImageFilterBase
{
  private $_dest_w = 0;
  private $_dest_h = 0;
  private $_r;
  private $_g;
  private $_b;
  private $_alpha = 0;
  private $_transparent = 0;
    
  public function __construct($input)
  {
	
    $mod = cms_utils::get_module('CGSmartImage');
    $this->_loc = $mod->GetPreference('croptofit_default_loc','c');
    if( cge_array::is_hash($input) )
      {
		
	if( isset($input['width']) )
	  {
	    $this->_dest_w = (int)$input['width'];
	    $this->_dest_h = (int)$input['height'];
	  }
	else if ( isset($input['w']) )
	  {
	    $this->_dest_w = (int)$input['w'];
	    $this->_dest_h = (int)$input['h'];
	  }
	if( isset($input['color']) && $input['color'] != '')
	  {
	    $input['color'] = strtolower($input['color']);
	    if( $input['color'] != 'transparent' )
	      {
		list($this->_r,$this->_g,$this->_b) = cgsi_utils::color_to_rgb(trim($input['color']));
	      }
	    else
	      {
		$this->_transparent = 1;
	      }
	  }
	if( isset($input['alpha']) )
	  {
	    $this->_alpha = (int)$input['alpha'];
	  }
      }
    else if( is_array($input)  )
      {
	if( count($input) >= 2 )
	  {
	    $this->_dest_w = (int)trim($input[0]);
	    $this->_dest_h = (int)trim($input[1]);
	    if( count($input) >= 3 )
	      {
		if( $input[2] != '' )
		  {
		    $input[2] = strtolower($input[2]);
		    if( $input[2] != 'transparent' )
		      {
			list($this->_r,$this->_g,$this->_b) = cgsi_utils::color_to_rgb(trim($input[2]));
		      }
		    else
		      {
			$this->_transparent = 1;
		      }
		  }
		if( count($input) >= 4 )
		  {
		    if( $input[3] != '' ) $this->_alpha = (int)$input[3];
		  }
	      }
	  }
      }
	
    $this->_dest_w = cgsi_utils::trim_to_device('width',$this->_dest_w);
    $this->_dest_h = cgsi_utils::trim_to_device('height',$this->_dest_h);

    // todo: convert color name into rgb.
    if( $this->_dest_h <= 0 || $this->_dest_w <= 0 || $this->_alpha < 0 || $this->_alpha > 127 )
      {
	throw new Exception('Invalid values specified for Croptofit filter constructor');
      }
  }


  public function transform(CGImageBase $src)
  {
	global $z_counter;
	$z_counter++;
	//print_r($src); die;
    // prevent any upscaling
    //$this->_dest_w = min($this->_dest_w,$src['width']);
   // $this->_dest_h = min($this->_dest_h,$src['height']);
	
    // quick optimization (nothing to do)
    if( $this->_dest_w == $src['width'] && $this->_dest_h == $src['height'] )
      {
	return $src;
      }

    // create our destination image.
    $_dest = new CGImageBase(array('image/png',$this->_dest_w,$this->_dest_h));
    imagealphablending($_dest['rsrc'], TRUE);

    // fill our image with a color (or transparent)
    $color = '';
    if( $this->_transparent )
      {
	// find a random unused color for transparency.
	$found = 0;
	while( !$found )
	  {
	    $this->_r = rand(0,255);
	    $this->_g = rand(0,255);
	    $this->_b = rand(0,255);
	    if( imagecolorexact($src['rsrc'],$this->_r,$this->_g,$this->_b) != -1 )
	      {
		$found = true;
	      }
	  }

	$color = imagecolorallocatealpha($_dest['rsrc'], $this->_r, $this->_g, $this->_b, 127);
	imagecolortransparent($_dest['rsrc'],$color);
      }
    else
      {
	$color = imagecolorallocatealpha($_dest['rsrc'], $this->_r, $this->_g, $this->_b, $this->_alpha);
      }
    imagefill($_dest['rsrc'], 0, 0, $color);

    if( $this->_dest_w < $this->_dest_h )
      {
	// height is greater... 
	$new_h = $this->_dest_h;
	$new_w = round(($new_h / $src['height']) * $src['width'], 0);
      }
    else
      {
	// width is greater.
	$new_w = $this->_dest_w;
	$new_h = round(($new_w / $src['width']) * $src['height'], 0);
      }
	  
	$real_w = imagesx($src['rsrc']);// mano pataisymai 2013-11-22
	$real_h = imagesy($src['rsrc']);
	
	if ($new_w > $real_w || $new_h > $real_h) {
		if($new_h > $real_h) {
			// height is greater than real height... 
			$old_h = $new_h;
			$old_w = $new_w;
			$new_h = $real_h;
			$new_w = round(($new_h / $old_h) * $old_w, 0);
		} else {
			// width is greater than real height.
			$old_h = $new_h;
			$old_w = $new_w;
			$new_w = $real_w;
			$new_h = round(($new_w / $old_w) * $old_h, 0);
		}
	}
	
	$real_w2 = imagesx($_dest['rsrc']);// mano pataisymai 2013-11-22
	$real_h2 = imagesy($_dest['rsrc']);
	
	if ($new_w > $real_w2 || $new_h > $real_h2) {
		if($new_h > $real_h2) {
			// height is greater than real height... 
			$old_h = $new_h;
			$old_w = $new_w;
			$new_h = $real_h2;
			$new_w = round(($new_h / $old_h) * $old_w, 0);
		} else {
			// width is greater than real height.
			$old_h = $new_h;
			$old_w = $new_w;
			$new_w = $real_w2;
			$new_h = round(($new_w / $old_w) * $old_h, 0);
		}
	}
	
	if ($z_counter == 4) {
		//echo $new_w.''.$new_h.' '.$real_w.' '.$real_h; die;
	
		/*echo .' ';
		echo imagesy($_dest['rsrc']); die;
		$new_w = 30;
		$new_h = 30;*/
		//echo $src['width'].' '.$src['height'].' w '.$new_w.' '.$new_h;
		//die;
	}
    $x0 = (int)(($this->_dest_w - $new_w) / 2);
    $y0 = (int)(($this->_dest_h - $new_h) / 2);

    // resize the big image into the temporary transparent image
    $res = imagecopyresampled($_dest['rsrc'],$src['rsrc'],$x0,$y0,0,0,$new_w,$new_h,$src['width'],$src['height']);
	if ($z_counter == 2) {
		//imagegif($_dest['rsrc'], $_SERVER['DOCUMENT_ROOT'].'/tets/test.gif');
		//echo  $_SERVER['DOCUMENT_ROOT'].'/tets/test.gif';
		//echo $x0.' '.$y0.' x '. $src['width'].' '.$src['height'].' w '.$new_w.' '.$new_h;
		//die;
	}
    if( $res === FALSE )
      {
	throw new Exception('Resizetofit - stage 1 - failed');
      }
    return $_dest;
  }

} // end of class

#
# EOF
#
?>