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

class CGImage_Roundedcorners_Filter extends CGImageFilterBase
{
  private $_radius;

  public function __construct($input)
  {
    if( cge_array::is_hash($input) )
      {
	if( isset($input['radius']) )
	  {
	    $this->_radius = (int)$input['radius'];
	  }
      }
    else if( is_array($input) )
      {
	if( count($input) == 1 )
	  {
	    $this->_radius = (int)$input[0];
	  }
      }

    if( $this->_radius <= 1 )
      {
	throw new Exception('Invalid values specified for Roundedcorners filter constructor');
      }
  }


  public function transform(CGImageBase $src)
  {
    $width = $src['width'];
    $height = $src['height'];
    $radius = $this->_radius;

    // create the new image 
    $_dest = new CGImageBase(array('image/png',$src['width'],$src['height']));
    //imagealphablending($_dest['rsrc'],TRUE);
    imagecopy($_dest['rsrc'],$src['rsrc'],0,0,0,0,$src['width'],$src['height']);
    //imagesavealpha($_dest['rsrc'],true);

    // find an unsed rgb triplet.
    $found = false; 
    while($found == false) { 
      
      $r = rand(0, 255); 
      $g = rand(0, 255); 
      $b = rand(0, 255); 
      
      if(imagecolorexact($src['rsrc'], $r, $g, $b) != (-1)) {         
        $colorcode = imagecolorallocatealpha($_dest['rsrc'], $r, $g, $b, 127); 
	imagecolortransparent($_dest['rsrc'],$colorcode);
        $found = true;         
      }
    }

    //    include_once(dirname(__FILE__).'/imageSmoothArc_optimized.php');

    // round the corners.
    imagearc($_dest['rsrc'],$radius-1,$radius-1,$radius*2,$radius*2, 180, 270, $colorcode);
    imagefilltoborder($_dest['rsrc'],0,0,$colorcode,$colorcode);
    
    imagearc($_dest['rsrc'], $width-$radius, $radius-1, $radius*2, $radius*2, 270, 0, $colorcode); 
    imagefilltoborder($_dest['rsrc'], $width-1, 0, $colorcode, $colorcode);

    imagearc($_dest['rsrc'], $radius-1, $height-$radius, $radius*2, $radius*2, 90, 180, $colorcode); 
    imagefilltoborder($_dest['rsrc'], 0, $height-1, $colorcode, $colorcode);

    imagearc($_dest['rsrc'], $width-$radius, $height-$radius, $radius*2, $radius*2, 0, 90, $colorcode); 
    imagefilltoborder($_dest['rsrc'], $width-1, $height-1, $colorcode, $colorcode);

    return $_dest;
  }
}

#
# EOF
#
?>