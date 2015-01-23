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

/**
 * Image rotation filter class
 * 
 * Allows rotating an image a specified number of degrees.
 *
 * @author Robert Campbell <calguy1000@cmsmadesimple.org>
 * @package CGSmartImage
 */
class CGImage_Rotate_Filter extends CGImageFilterBase
{
  /**
   * The number of degrees to rotate
   *
   * @access private
   * @var integer
   */
  private $_angle = 0;

  public function __construct(/* variable arguments */)
  {
    $args = func_get_args();
    if( is_array($args[0]) && count($args) == 1)
      {
	$args = $args[0];
      }

    if( count($args) != 1 )
      {
	throw new Exception('Invalid arguments specified for '.get_class($this));
      }

    $this->_angle = (int)$args[0] % 360;
  }

  public function transform(CGImageBase $src)
  {
    $angle = $this->_angle % 360;
    if( $angle == 0 ) return $src; // nothing to do.

    $_dest = new CGImageBase($src);

    if( !function_exists('imagerotate') )
      {
	throw new Exception('imagerotate function not found');
      }

    $tcolor = imagecolorat($src['rsrc'],0,$src['height']-1);
    $res = imagerotate($src['rsrc'],$this->_angle * -1,$tcolor);
    if( $res === FALSE )
      {
	throw new Exception('Error applying filter '.IMG_FILTER_COLORIZE);
      }
    imagecolortransparent($res,$tcolor);
    $_dest['rsrc'] = $res;
    $_dest['width'] = imagesx($res);
    $_dest['height'] = imagesy($res);
    return $_dest;
  }
}

#
# EOF
#
?>