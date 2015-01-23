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

class CGSmartImage_ClearCacheTask implements CmsRegularTask
{
  public function get_name() 
  {
    return get_class($this);
  }


  public function get_description()
  {
    $mod = cms_utils::get_module('CGSmartImage');
    return $mod->Lang('clearcachetask_description');
  }


  public function test($time = '')
  {
    $mod = cms_utils::get_module('CGSmartImage');
    $age = (int)$mod->GetPreference('cache_age');
    if( $age <= 0 ) return FALSE;

    // we only attempt to clear cached files once per day
    if( !$time ) $time = time();
    $last_execute = $mod->GetPreference('clearcache_lastrun');
    if( ($time - 24*60*60 ) >= $last_execute )
    {
      return TRUE;
    }
    return FALSE;
  }


  public function execute($time = '')
  {
    if( !$time ) $time = time();

    try
      {
	// clear cached files.
	$mod = cms_utils::get_module('CGSmartImage');
	$n_removed = $mod->clear_cached_files();
	$mod->Audit('',$mod->Lang('act_cachecleaned'),$mod->Lang('msg_cachecleaned',$n_removed));
	return TRUE;
      }
    catch( Exception $e )
      {
	return FALSE;
      }
  }


  public function on_success($time = '')
  {
    if( !$time ) $time = time();
    $mod = cms_utils::get_module('CGSmartImage');
    $mod->SetPreference('clearcache_lastrun',$time);
  }

  
  public function on_failure($time = '')
  {
    // nothing here.
  }


  public function get_cached_image_url($destname)
  {
    $destname = basename($destname);

    $config = cmsms()->GetConfig();
    $dest_url = $this->GetPreference('image_url_prefix',$config['uploads_url']);
    if( !endswith($dest_url, '/') ) $desturl .= '/';
    if( !$this->GetPreference('image_url_hascachedir',0) )
      {
	$dest_url .= '_'.$this->GetName().'/';
      }
    $dest_url .= $destname;
    return $dest_url;
  }
} // end of class

#
# EOF
#
?>