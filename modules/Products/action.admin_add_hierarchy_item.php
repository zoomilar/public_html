<?php
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: Products (c) 2008 by Robert Campbell 
#         (calguy1000@cmsmadesimple.org)
#  An addon module for CMS Made Simple to allow users to create, manage
#  and display products in a variety of ways.
# 
# Version: 1.1.5
#
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2005 by Ted Kulp (wishy@cmsmadesimple.org)
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
if( !isset($gCms) ) exit;
if( !$this->CheckPermission('Modify Products') ) exit;
$this->SetCurrentTab('hierarchy');

if( isset($params['cancel']) )
  {
    // we're cancelling
    $this->RedirectToTab($id);
  }

#
# Defaults
#
$parent = -1;
$name = '';
$name2 = '';
$extra1 = '';
$extra2 = '';
$description = '';
$description2 = '';
$redirect_to = -1;
$show_hier_page = 0;
$image = '';
$image2 = '';
$file = '';
$hierfield = array();
$hierfield2 = array();


$kalbos = $this->GetPreference('kalbos', 'lt');
$kalbos = explode(',', $kalbos);

$allfield_tmp = $this->GetFilterFields();
$allfield = array();
$fk = $kalbos[0];

if (is_array($allfield_tmp) && count($allfield_tmp) > 0) {
	foreach ($allfield_tmp as $val) {
		$allfield[$val['prompt']] = $val['id'];
	}
}

# 
# form actions
#
if( isset($params['submit']) )
  {
	
    if( isset($params['parent']) )
      {
	$parent = (int)$params['parent'];
      }
    $name = serialize($params['name']);
	$name2 = serialize($params['name2']);
    $extra1 = serialize($params['extra1']);
    $extra2 = trim($params['extra2']);
    $description = serialize($params['description']);
	$description2 = serialize($params['description2']);
	$redirect_to = $params['redirect_to'];
	$show_hier_page = $params['show_hier_page'];
	
	$hierfield = $params['hierfield'];
	$hierfield2 = $params['hierfield2'];
	
    $error = 0;
    if( empty($name) )
      {
	$error = 1;
	echo $this->ShowErrors($this->Lang('error_noname'));
      }

    if( !$error )
      {
	$query = 'SELECT id FROM '.cms_db_prefix().'module_products_hierarchy WHERE parent_id = ? AND name = ?';
	$tmp = $db->GetOne($query,array($parent,$name));
	if( $tmp )
	  {
	    $error = 1;
	    echo $this->ShowErrors($this->Lang('error_nameused'));
	  }
      }

    if( !$error )
      {
		
	// Handle file upload
        $attr = 'default';
        if( isset($params['input_watermark']) )
        {
           $attr = $params['input_watermark'];
        }
        $errors = array();
		$destdir = cms_join_path($gCms->config['uploads_path'],$this->GetName(),
				 'hierarchy');
				 
        $res = $this->HandleUploadedImage($id,'file',$destdir,$errors,'',$attr);
		$res2 = $this->HandleUploadedImage($id,'file2',$destdir,$errors,'',$attr);
		$res4 = $this->HandleUploadedFile($id,'file4',$destdir,$errors,'',$attr);
		
        if( $res === FALSE || $res2 === FALSE || $res4 === false) {
			// an error ensued.
			echo $this->ShowErrors($errors);
		}
		else
		{
		
	    $image = $res;
		$image2 = $res2;
		$file = $res4;
		
        if( $res === TRUE ) $image = '';
		if ($res2 === true) $image2 = '';
		if ($res4 === true) $file = '';

	    $query = 'SELECT MAX(item_order)+1 FROM '.cms_db_prefix().'module_products_hierarchy WHERE parent_id = ?';
	    $item_order = $db->GetOne($query,array($parent));
	    if( !$item_order ) $item_order = 1;
		//echo 'zzz'.$show_hier_page.'zzz'; die;
		if (!$show_hier_page) {
			$show_hier_page = 0;
		}
	    $query = 'INSERT INTO '.cms_db_prefix().'module_products_hierarchy
                    (name, parent_id, description, image, extra1, extra2, item_order, name2, description2, image2, redirect_to, file, show_hier_page) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)';
	    $dbr = $db->Execute($query,array($name,$parent,$description,$image,$extra1,$extra2,$item_order, $name2, $description2, $image2, $redirect_to, $file, $show_hier_page));
	    if( !$dbr ) { echo $db->sql.'<br/>'; die( $db->ErrorMsg() ); }
	    $new_id = $db->Insert_ID();
		
	    $this->UpdateHierarchyPositions($kalbos);
		
		$this->UpdateHierFields($new_id, $hierfield, 1);
		$this->UpdateHierFields($new_id, $hierfield2, 2);
		
	    $this->RedirectToTab($id);
	  }
      }
  }

#
# Build the form
#

$hierarchy_items = $this->BuildHierarchyList();
$smarty->assign('hierarchy_items',$hierarchy_items);
$smarty->assign('parent',$parent);
if (@unserialize($name)) {
	$name = unserialize($name);
}

$nam = "<table><tr>";
  
	$z=0;
	$k='';
	$dno = '';
	foreach ($kalbos as $kalba){
		
		
		if ($z){$dno = " style='display: none'"; $cla = "class='komm'";}else{$cla = "class='komm active'";}
		
		$k .= "<a href='javascript:void(0)' $cla alt='$kalba'>".$this->Lang($kalba)."</a>&nbsp;";
					
		$nam .= "<td $dno class='$kalba hddi'>";
		$nam .= $this->CreateInputText($id,'name['.$kalba.']' , $name[$kalba], '100');
		$nam .= "</td>";
		$z++;
	}	

	$nam .= "</tr></table>";
	$nam = "<br/>".$k."<br/><br/>".$nam;
$smarty->assign('name',$nam);

if (@unserialize($name2)) {
	$name2 = unserialize($name2);
}

$nam = "<table><tr>";
  
	$z=0;
	$k='';
	$dno = '';
	foreach ($kalbos as $kalba){
		
		
		if ($z){$dno = " style='display: none'"; $cla = "class='komm'";}else{$cla = "class='komm active'";}
		
		$k .= "<a href='javascript:void(0)' $cla alt='$kalba'>".$this->Lang($kalba)."</a>&nbsp;";
					
		$nam .= "<td $dno class='$kalba hddi'>";
		$nam .= $this->CreateInputText($id,'name2['.$kalba.']' , $name2[$kalba], '100');
		$nam .= "</td>";
		$z++;
	}	

	$nam .= "</tr></table>";
	$nam = "<br/>".$k."<br/><br/>".$nam;
$smarty->assign('name2',$nam);


if (@unserialize($extra1)) {
	$extra1 = unserialize($extra1);
}

$extra1x = "<table><tr>";
  
	$z=0;
	$k='';
	$dno = '';
	foreach ($kalbos as $kalba){
		
		
		if ($z){$dno = " style='display: none'"; $cla = "class='komm'";}else{$cla = "class='komm active'";}
		
		$k .= "<a href='javascript:void(0)' $cla alt='$kalba'>".$this->Lang($kalba)."</a>&nbsp;";
					
		$extra1x .= "<td $dno class='$kalba hddi'>";
		$extra1x .= $this->CreateInputText($id,'extra1['.$kalba.']' , $extra1[$kalba], '100');
		$extra1x .= "</td>";
		$z++;
	}	

	$extra1x .= "</tr></table>";
	$extra1x = "<br/>".$k."<br/><br/>".$extra1x;
$smarty->assign('extra1',$extra1x);


$smarty->assign('hierfield', $this->CreateInputSelectList($id, 'hierfield[]', $allfield, $hierfield, 20,'', true));
$smarty->assign('hierfield2', $this->CreateInputSelectList($id, 'hierfield2[]', $allfield, $hierfield2, 20,'', true));

//$smarty->assign('extra1',$extra1);
$smarty->assign('extra2',$extra2);

if (@unserialize($description)) {
	$description = unserialize($description);
}

$descriptions = "<table><tr>";
  
	$z=0;
	$k='';
	$dno = '';
	foreach ($kalbos as $kalba){
		
		
		if ($z){$dno = " style='display: none'"; $cla = "class='komm'";}else{$cla = "class='active komm'";}
		
		$k .= "<a href='javascript:void(0)' $cla alt='$kalba'>".$this->Lang($kalba)."</a>&nbsp;";
					
		$descriptions .= "<td $dno class='$kalba hddi'>";
		$descriptions .= $this->CreateTextArea(true, $id, $description[$kalba], 'description['.$kalba.']');
		$descriptions .= "</td>";
		$z++;
	}	

	$descriptions .= "</tr></table>";
	$descriptions = "<br/>".$k."<br/><br/>".$descriptions;
$smarty->assign('description',$descriptions);


if (@unserialize($description2)) {
	$description2 = unserialize($description2);
}

$descriptions = "<table><tr>";
  
	$z=0;
	$k='';
	$dno = '';
	foreach ($kalbos as $kalba){
		
		
		if ($z){$dno = " style='display: none'"; $cla = "class='komm'";}else{$cla = "class='active komm'";}
		
		$k .= "<a href='javascript:void(0)' $cla alt='$kalba'>".$this->Lang($kalba)."</a>&nbsp;";
					
		$descriptions .= "<td $dno class='$kalba hddi'>";
		$descriptions .= $this->CreateTextArea(true, $id, $description2[$kalba], 'description2['.$kalba.']');
		$descriptions .= "</td>";
		$z++;
	}	

	$descriptions .= "</tr></table>";
	$descriptions = "<br/>".$k."<br/><br/>".$descriptions;
$smarty->assign('description2',$descriptions);

//$smarty->assign('description',$description);
$smarty->assign('image',$image);
$smarty->assign('image2',$image2);
$smarty->assign('file',$file);

$hear_array = hierarchy_ops::get_flat_list();

$redirect_to_arr = array($this->lang('none') => -1);
if (is_array($hear_array) && count($hear_array) > 0) {
	foreach ($hear_array as $kk => $vv) {
		$temp_name = explode('.', $vv['hierarchy']);
		$temp_name2 = array_map("intval", $temp_name);
		$temp_name2 = implode('.', $temp_name2);
		$redirect_to_arr[$temp_name2.' - '.$vv['name']['lt']] = $vv['id'];
	}
}

$smarty->assign('redirect_to', $this->CreateInputDropdown($id,'redirect_to',$redirect_to_arr, -1,''));
$smarty->assign('show_hier_page', $this->CreateInputCheckbox($id,'show_hier_page',1, $show_hier_page));


if( $this->GetPreference('autowatermark') == 'adjustable' )
{
  $wmopts = array();
  $wmopts[$this->Lang('none')] = 'none';
  $wmopts[$this->Lang('default')] = 'default';
  $wmopts[$this->Lang('align_ul')] = '0';
  $wmopts[$this->Lang('align_uc')] = '1';
  $wmopts[$this->Lang('align_ur')] = '2';
  $wmopts[$this->Lang('align_ml')] = '3';
  $wmopts[$this->Lang('align_mc')] = '4';
  $wmopts[$this->Lang('align_mr')] = '5';
  $wmopts[$this->Lang('align_ll')] = '6';
  $wmopts[$this->Lang('align_lc')] = '7';
  $wmopts[$this->Lang('align_lr')] = '8';
  $smarty->assign('watermark_location',
    $this->CreateInputDropdown($id,'input_watermark',$wmopts,-1,'default'));
}

$smarty->assign('formstart',
		$this->CGCreateFormStart($id,'admin_add_hierarchy_item',$returnid,
					 $params,false,'post','multipart/form-data'));
$smarty->assign('formend',$this->CreateFormEnd());

echo $this->ProcessTemplate('admin_add_hierarchy_item.tpl');
#
# EOF
#
?>