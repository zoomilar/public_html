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
if( !isset($params['hierarchy_id']) )
  {
    $this->SetError($this->Lang('error_missingparam'));
    $this->RedirectToTab($id);
  }
$hierarchy_id = (int)$params['hierarchy_id'];

if( isset($params['cancel']) )
  {
    // we're cancelling
    $this->RedirectToTab($id);
  }

$kalbos = $this->GetPreference('kalbos', 'lt');
$kalbos = explode(',', $kalbos);
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
$hierfield = array();
$hierfield2 = array();
$destdir = cms_join_path($gCms->config['uploads_path'],$this->GetName(),
			 'hierarchy');


#
# Get the values from the database
#
$query = 'SELECT * FROM '.cms_db_prefix().'module_products_hierarchy
           WHERE id = ?';
$row = $db->GetRow( $query, array( $hierarchy_id) );
$parent = $row['parent_id'];
$name = unserialize($row['name']);
$name2 = unserialize($row['name2']);
$extra1 = unserialize($row['extra1']);
$extra2 = $row['extra2'];
$image = $row['image'];
$image2 = $row['image2'];
$description = unserialize($row['description']);
$description2 = unserialize($row['description2']);
$redirect_to = $row['redirect_to'];
$show_hier_page = $row['show_hier_page'];
$file = $row['file'];


$hierfield = $this->GetHierFields($hierarchy_id, 1);
$hierfield2 = $this->GetHierFields($hierarchy_id, 2);
$allfield_tmp = $this->GetFilterFields();
$allfield = array();
$fk = $kalbos[0];

if (is_array($allfield_tmp) && count($allfield_tmp) > 0) {
	foreach ($allfield_tmp as $val) {
		$allfield[$val['prompt']] = $val['id'];
	}
}

#
# Form Action
if( isset($params['submit']) ) {
	
    $error = 0;
    $name = serialize($params['name']);
	$name2 = serialize($params['name2']);
    $extra1 = serialize($params['extra1']);
    $extra2 = trim($params['extra2']);
    $parent = (int)$params['parent'];
    $description = serialize($params['description']);
	$description2 = serialize($params['description2']);
	$redirect_to = $params['redirect_to'];
	$show_hier_page = $params['show_hier_page'];
	
	$hierfield = $params['hierfield'];
	$hierfield2 = $params['hierfield2'];
	
	/*echo '<pre>';
	print_r($hierfield2);
	echo '</pre>';
	die;*/
	
    if( $parent == $params['hierarchy_id'] ) {
		$error = 1;
		echo $this->ShowErrors($this->Lang('error_invalidparent'));
    }

    if( !$error && empty($name) ) {
		$error = 1;
		echo $this->ShowErrors($this->Lang('error_noname'));
    }

    if( !$error ) {
		//echo $parent;
		$query = 'SELECT id FROM '.cms_db_prefix().'module_products_hierarchy WHERE parent_id = ? AND name = ? AND id != ?';
		$tmp = $db->GetOne($query,array($parent,$name,$hierarchy_id));
		//echo $db->sql;
		if( $tmp ) {
			$error = 1;
			echo $this->ShowErrors($this->Lang('error_nameused'));
		}
    }

    if( !$error ) {
		// handle image delete first
		if( isset($params['deleteimg']) ) {
			$srcname = cms_join_path($destdir,$image);
			$destname = cms_join_path($destdir,'thumb_'.$image);
			$previewname = cms_join_path($destdir,'preview_'.$image);
			@unlink($srcname);
			@unlink($destname);
			@unlink($previewname);
			$image = '';
		}
		
		if( isset($params['deleteimg2']) ) {
			$srcname = cms_join_path($destdir,$image2);
			$destname = cms_join_path($destdir,'thumb_'.$image2);
			$previewname = cms_join_path($destdir,'preview_'.$image2);
			@unlink($srcname);
			@unlink($destname);
			@unlink($previewname);
			$image2 = '';
		}
		
		if( isset($params['deletefile']) ) {
			$srcname = cms_join_path($destdir,$file);
			$destname = cms_join_path($destdir,'thumb_'.$file);
			$previewname = cms_join_path($destdir,'preview_'.$file);
			@unlink($srcname);
			@unlink($destname);
			@unlink($previewname);
			$file = '';
		}

		// Handle file upload
		$attr = 'default';
		if( isset($params['input_watermark']) ) {
			$attr = $params['input_watermark'];
		}
		$errors = array();
		//echo $destdir; die;
		$res = $this->HandleUploadedImage($id,'file',$destdir,$errors,'',$attr,true);
		$res2 = $this->HandleUploadedImage($id,'file2',$destdir,$errors,'',$attr,true);
		$res4 = $this->HandleUploadedFile($id,'file4',$destdir,$errors,'',$attr,true);
		
		if( $res === FALSE || $res2 === FALSE || $res4 == false) {
			 echo $this->ShowErrors($errors);
		} else {
			if( $res != cg_fileupload::NOFILE ){
				// image upload succeeded
				$image = $res;
				if( $res === TRUE ) $image = '';
			}
			if( $res2 != cg_fileupload::NOFILE ){
				// image upload succeeded
				$image2 = $res2;
				if( $res2 === TRUE ) $image2 = '';
			}
			if( $res4 != cg_fileupload::NOFILE ){
				// image upload succeeded
				$file = $res4;
				if( $res4 === TRUE ) $file = '';
			}
			
			if (!$show_hier_page) {
				$show_hier_page = 0;
			}
			$query = 'UPDATE '.cms_db_prefix().'module_products_hierarchy
						  SET name = ?, image = ?, parent_id = ?, description = ?,
							  extra1 = ?, extra2 = ?, name2 = ?, description2 = ?, image2 = ?, redirect_to = ?, file = ?, show_hier_page = ?  
						  WHERE id = ?';
			$db->Execute($query,array($name,$image,$parent,$description,$extra1,$extra2,$name2,$description2,$image2, $redirect_to, $file, $show_hier_page, $hierarchy_id));
			
			$this->UpdateHierarchyPositions($kalbos);
			
			$this->UpdateHierFields($hierarchy_id, $hierfield, 1);
			$this->UpdateHierFields($hierarchy_id, $hierfield2, 2);
			
			$this->RedirectToTab($id);
		}
    }
}


#
# Build the form
#
$hierarchy_items = $this->BuildHierarchyList();

//echo $current_db_parent.'zzz';

foreach ($hierarchy_items as $key => $val) {
	if ($val == $hierarchy_id) {
		unset($hierarchy_items[$key]);
	}
}

$smarty->assign('hierarchy_id',$hierarchy_id);
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


//$smarty->assign('name',$name);
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


$smarty->assign('hierfield', $this->CreateInputSelectListSortible($id, 'hierfield[]', $allfield, $hierfield, 20,'', true));
$smarty->assign('hierfield2', $this->CreateInputSelectListSortible($id, 'hierfield2[]', $allfield, $hierfield2, 20,'', true));

//$smarty->assign('extra1',$extra1);
$smarty->assign('extra2',$extra2);
$smarty->assign('image',$image);
$smarty->assign('image2',$image2);
$smarty->assign('file',$file);
$image_url = $gCms->config['uploads_url'].'/'.$this->GetName()."/hierarchy/$image";
$smarty->assign('image_url',$image_url);
$image_url2 = $gCms->config['uploads_url'].'/'.$this->GetName()."/hierarchy/$image2";
$smarty->assign('image_url2',$image_url2);
$file_url = $gCms->config['uploads_url'].'/'.$this->GetName()."/hierarchy/$file";
$smarty->assign('file_url',$file_url);

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

$hear_array = hierarchy_ops::get_flat_list();

$redirect_to_arr = array($this->lang('none') => -1);
foreach ($hear_array as $kk => $vv) {
	$temp_name = explode('.', $vv['hierarchy']);
	$temp_name2 = array_map("intval", $temp_name);
	$temp_name2 = implode('.', $temp_name2);
	$redirect_to_arr[$temp_name2.' - '.$vv['name']['lt']] = $vv['id'];
}

$smarty->assign('redirect_to', $this->CreateInputDropdown($id,'redirect_to',$redirect_to_arr, -1,$redirect_to));
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
		$this->CGCreateFormStart($id,'admin_edit_hierarchy_item',$returnid,
					 $params,'false','post','multipart/form-data'));
$smarty->assign('formend',$this->CreateFormEnd());

echo $this->ProcessTemplate('admin_add_hierarchy_item.tpl');


#
# EOF
#
?>