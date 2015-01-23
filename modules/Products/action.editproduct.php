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
if (!isset($gCms)) exit;
$this->SetCurrentTab('products');
global $themeObject;
//
// A utility function
//
function get_field_def(&$fielddefs,$id)
{
  foreach( $fielddefs as $onedef )
    {
      if( $onedef->id == $id )
	{
	  return $onedef;
	}
    }
  return false;
}

function products_delete_uploaded_file($dir,$filename)
{
  if( empty($filename) ) return;

  $filename = basename($filename);
  @unlink(cms_join_path($dir,$filename));
  @unlink(cms_join_path($dir,'thumb_'.$filename));
  @unlink(cms_join_path($dir,'preview_'.$filename));
}

if (!$this->CheckPermission('Modify Products'))
  {
    echo $this->ShowErrors($this->Lang('needpermission', array('Modify Products')));
    return;
  }

if (isset($params['cancel']))
  {
    $this->RedirectToTab($id);
  }

$compid = '';
if (isset($params['compid']))
  {
    $compid = $params['compid'];
  }

$product_name = '';
if (isset($params['product_name']))
  {
    $product_name = $params['product_name'];
  }

$price = '';
if (isset($params['price']))
  {
    $price = (float)$params['price'];
  }

$weight = '';
if (isset($params['weight']))
  {
    $weight = (float)$params['weight'];
  }

$sku = '';
if (isset($params['sku']))
  {
    $sku = trim($params['sku']);
  }

$alias = '';
if (isset($params['alias']))
  {
    $alias = trim($params['alias']);
  }

$details = '';
if (isset($params['details']))
  {
    $details = $params['details'];
  }

$taxable = 0;
if (isset($params['taxable']))
  {
    $taxable = 1;
  }

$hierarchy_pos = -1;
if (isset($params['hierarchy']) )
  {
    $hierarchy_pos = (int)$params['hierarchy'];
  }

$status = '';
if (isset($params['status']))
  {
    $status = $params['status'];
  }

$origname = '';
if (isset($params['origname']))
  {
    $origname = $params['origname'];
  }


$fieldarray = array();
$userid = get_userid();
$fielddefs = $this->GetFieldDefsForProduct($compid,true);

$kalbos = $this->GetPreference('kalbos', 'lt');
$kalbos = explode(',', $kalbos);	
$p_kalbo = $kalbos[0];//pagrindine kalba
$name_field = $this->GetFieldByName($this->GetPreference('pavadinimas_field'));

if (isset($params['submit']) || isset($params['apply']))
  {
	
	
	//if (empty($product_name)) {
		$product_name = $_REQUEST[$id.'customfield']['field-'.$name_field['id']][$p_kalbo];
	//}
  
    $duplicate = '';
    $duplicatesku = '';
    $duplicatealias = '';
    $emptysku = '';
    if ($product_name != '')
      {
	$query = 'SELECT id FROM '.cms_db_prefix().'module_products
                   WHERE product_name = ? AND id != ?';
	$duplicate = $db->GetOne($query,array($product_name,$compid));
      }

    if( empty($alias) )
      {
		$alias = product_ops::generate_alias($product_name, $compid);
      }
    else
      {
		$alias = product_ops::generate_alias($alias, $compid);
      }

    // check for duplicate alias
    if( product_ops::check_alias_used($alias,$compid) )
      {
	$duplicatealias = $alias;
      }

    if( empty($sku) && $this->GetPreference('skurequired') )
      {
	$emptysku = 1;
      }

    if( !$duplicate && !empty($sku) )
      {
	// check for duplicate sku
	if( product_ops::check_sku_used($sku,$compid) )
	  {
	    $duplicatesku = $sku;
	  }
      }

    if( $duplicate )
      {
	echo $this->ShowErrors($this->Lang('error_product_nameused'));
      }
    else if( $emptysku )
      {
	echo $this->ShowErrors($this->Lang('error_sku_required'));
      }
    else if( $duplicatealias )
      {
	echo $this->ShowErrors($this->Lang('error_product_aliasused'));
      }
    else if( $duplicatesku )
      {
	echo $this->ShowErrors($this->Lang('error_product_skuused'));
      }
    else if ($product_name == '')
      {
	echo $this->ShowErrors($this->Lang('nonamegiven'));
      }
    else
      {
	  
	  
	  
	// update the original record
	$query = 'UPDATE '.cms_db_prefix().'module_products SET product_name = ?, price = ?, details = ?, modified_date = '.$db->DBTimeStamp(time()).',taxable = ?, status = ?, weight = ?, sku = ?, alias = ? WHERE id = ?';
	$db->Execute($query, array($product_name, $price, $details, 
				   $taxable, $status, $weight, $sku, $alias, $compid));

	// Update the hierarchy stuff
	
	$query = 'DELETE FROM '.cms_db_prefix().'module_products_prodtohier WHERE product_id = ?';
	$db->Execute( $query, array( $compid ) );
	$query = 'INSERT INTO '.cms_db_prefix().'module_products_prodtohier 
                   (product_id,hierarchy_id)
                   VALUES (?,?)';
	$db->Execute( $query, array( $compid, $hierarchy_pos ) );
	
	
	
	/*if ($hierarchy_pos > 0) {
	
		$query = "SELECT hierarchy_id FROM ".cms_db_prefix()."module_products_prodtohier WHERE product_id = ?";
		$hierarchy_id_tmp = $db->GetOne($query, array($compid));
		
		$query = "SELECT IF(!ISNULL(MAX(order_id)), MAX(order_id), 'none') as orde FROM ".cms_db_prefix()."module_products_prodtohier WHERE hierarchy_id = ?";
		$orde = $db->GetOne($query, array($hierarchy_pos));
		
		if ($orde == 'none') {
			$orde = 0;
		} else {
			$orde = intval($orde);
			$orde++;
		}
		
		if ($hierarchy_id_tmp > 0) {
			if ($hierarchy_id_tmp != $hierarchy_pos) {
				
				
				
				$query = 'UPDATE '.cms_db_prefix().'module_products_prodtohier SET hierarchy_id = ?, order_id = ? WHERE product_id = ? LIMIT 1';
				$db->Execute( $query, array($hierarchy_pos, $orde, $compid) );
			}
		} else {
			$query = 'INSERT INTO '.cms_db_prefix().'module_products_prodtohier 
					   (product_id,hierarchy_id,order_id)
					   VALUES (?,?,?)';
			$db->Execute( $query, array( $compid, $hierarchy_pos, $orde) );
		}
		
	} else {
		$query = "DELETE FROM ".cms_db_prefix()."module_products_prodtohier WHERE product_id = ?";
		$db->Execute($query, array($compid));
	}*/
	
	
	// Update custom fields
	$deleted_items = array();
	//$db->Execute('DELETE FROM '.cms_db_prefix().'module_products_fieldvals WHERE product_id = ?', array($compid));

	$destdir = cms_join_path($gCms->config['uploads_path'],$this->GetName(),
				 'product_'.$compid);

	$errors = array();
	if (isset($_REQUEST[$id.'customfield']))
	  {
	    foreach ($_REQUEST[$id.'customfield'] as $k=>$v)
	      {
		// handle file deletions
		if (startswith($k, 'deletefield-')) {

		  // get the field index
		  $fid = substr($k, strlen('deletefield-'));

		  // get the field type
		  $def = get_field_def($fielddefs,$fid);
		  if( !isset($def->value) ) continue;
		  if( !$def )
		    {
		      die('could not get field def for '.$fid);
		    }

		  $destdir = cms_join_path($gCms->config['uploads_path'],$this->GetName(),
					   'product_'.$compid);
		  
		  switch( $def->type )
		    {
		    case 'file':
		    //case 'image':
		      // delete the file
		      products_delete_uploaded_file($destdir,$def->value);
		      $deleted_items[] = $fid;
		      break;
		    }
		}
	      }

	    foreach ($_REQUEST[$id.'customfield'] as $k=>$v)
	      {
		// handle new values (or hidden values)
		if (startswith($k, 'field-')) { // else

		  // get the field index
		  $fid = substr($k, 6);

		  if( in_array($fid,$deleted_items) ) 
		    {
		      $v = null;
		    }

		  // get the field type
		  $def = get_field_def($fielddefs,$fid);
		  if( !$def )
		    {
		      die('could not get field def for '.$fid);
		      continue;
		    }

		  // handle the upload (if any)
		  switch( $def->type )
		    {
		    case 'file':
		      if( isset($def->value))
			{
			  $str = "field-$fid";
			  if( isset($_FILES[$id.'customfield']['name'][$str]) &&
			      isset($_FILES[$id.'customfield']['size'][$str]) &&
			      $_FILES[$id.'customfield']['size'][$str] > 0 )
			    {
			      products_delete_uploaded_file($destdir,$def->value);
			    }
			}
		      $destdir = cms_join_path($gCms->config['uploads_path'],$this->GetName(),
					       'product_'.$compid);
		      cge_dir::mkdirr($destdir);
		      if( !is_dir($destdir) ) die('directory still does not exist');
		      $handler = new cg_fileupload($id,$destdir);
		      $handler->set_accepted_filetypes($this->GetPreference('allowed_filetypes'));
		      $res = $handler->handle_upload('customfield','','field-'.$fid);
		      $err = $handler->get_error();
		      if( !$res && $err != cg_fileupload::NOFILE )
			{
			  $errors[] = sprintf("%s %s: %s",$this->Lang('field'),$def->name,
					      $this->GetUploadErrorMessage($err));
			}
		      else if( !$res && !empty($v) )
			{
			  true;
			}
		      else if( !$res )
			{
			  $v = null;
			}
		      else
			{
			  $v = $res;
			}
		      break;
		      
		    case 'image':/*
		      if( isset($def->value) )
			{
			  $str = "field-$fid";
			  if( isset($_FILES[$id.'customfield']['name'][$str]) &&
			      isset($_FILES[$id.'customfield']['size'][$str]) &&
			      $_FILES[$id.'customfield']['size'][$str] > 0 )
			    {
			      products_delete_uploaded_file($destdir,$def->value);
			    }
			}
                      $attr = 'default'; // use default value for wmlocation
                      if( isset($_REQUEST[$id.'customfield_attr']) && isset($_REQUEST[$id.'customfield_attr'][$k]) )
                        {
                          $attr = $_REQUEST[$id.'customfield_attr'][$k];
                        }
		      $destdir = cms_join_path($gCms->config['uploads_path'],$this->GetName(),
					       'product_'.$compid);
                      $res = $this->HandleUploadedImage($id,'customfield',$destdir,$errors,'field-'.$fid,$attr);
                      if( $res === FALSE )
                      {
			$v = null;
                      }
                      else if( $res === TRUE )
                      {
			true;
                      }
                      else
                      {
			$v = $res;
                      }*/
					  $v = null;
		      break;

		    case 'quantity':
		      $v = (int)$v;
		      $v = max(0,$v);
		      break;
		    
			case 'checkboxgroup':

				/*$db->Execute("DELETE FROM ".cms_db_prefix()."module_products_fieldvals WHERE fielddef_id=? and product_id=?", Array($fid, $compid));
				
				
				
				foreach ($v as $a){
				  if ($a != 'false'){
				  
					$a = htmlspecialchars($a);
					$query = 'INSERT INTO '.cms_db_prefix().'module_products_fieldvals (product_id, fielddef_id, value, create_date, modified_date) VALUES (?,?,?,?,?)';
					$db->Execute($query, array($compid, $fid, $a, trim($db->DBTimeStamp(time()), "'"), trim($db->DBTimeStamp(time()), "'")));					
				  }	
				}
				$v = '-';*/
				$v = serialize($v);
				
			  break;
			
			
		    case 'subscription':
		    case 'dimensions':
		      if( is_array($v) )
			{
			  $v = serialize($v);
			}
		      break;
		      
		    case 'textbox':
		    case 'checkbox':
		    case 'textarea':
			  if (is_array($v)) {
				$v=serialize($v);
				}
			break;
			case 'textarea_multi':
				
				
				if( is_array($v) ) {
					
					foreach ($v as $kal_tmp => $inps_tmp) {
						if (count($inps_tmp['v']) > 1) {
						
							$v_temp = array();
							$t_temp = array();
							
							$cox = 0;
							foreach ($inps_tmp['v'] as $fk => $vk) {
								if ($fk !== 'nm') {
									$v_temp[$cox] = $vk;
									$t_temp[$cox] = $inps_tmp['t'][$fk];
									$cox++;
								} else {
									$v_temp['nm'] = $vk;
									$t_temp['nm'] = $inps_tmp['t'][$fk];
								}
							}
							
							$v[$kal_tmp]['v'] = $v_temp;
							$v[$kal_tmp]['t'] = $t_temp;
						}
					}
					
					$v = serialize($v);
				}
			break;
		    case 'dropdown':
		      break;

		    default:
		      die("unknown type: ".$def->type);
		      break;
		    }

		  if( !is_null($v) && $v !== '' && $def->type != 'image') {		    
		    // commit it if there is a valid value
		    //$query = 'INSERT INTO '.cms_db_prefix().'module_products_fieldvals (product_id, fielddef_id, value, create_date, modified_date) VALUES (?,?,?,?,?)';
		    //$db->Execute($query, array($compid, $fid, $v, trim($db->DBTimeStamp(time()), "'"), trim($db->DBTimeStamp(time()), "'")));
			
			$query = "SELECT * FROM ".cms_db_prefix()."module_products_fieldvals WHERE product_id = ?";
			$res_test = $db->getRow($query, array($compid));
			
			if ($res_test['product_id'] > 0) {
				$query = "UPDATE ".cms_db_prefix()."module_products_fieldvals SET value_".$fid." = ?, modified_date = ? WHERE product_id = ?";
				$db->Execute($query, array($v, trim($db->DBTimeStamp(time()), "'"), $compid));
			} else {
				$query = 'INSERT INTO '.cms_db_prefix().'module_products_fieldvals (product_id, value_'.$fid.', create_date, modified_date) VALUES (?,?,?,?)';
				$db->Execute($query, array($compid, $v, trim($db->DBTimeStamp(time()), "'"), trim($db->DBTimeStamp(time()), "'")));
				//echo $db->sql; die;
			}
			
		  } else if ($def->type != 'image') {
			$query = "SELECT * FROM ".cms_db_prefix()."module_products_fieldvals WHERE product_id = ?";
			$res_test = $db->getRow($query, array($compid));
			
			if ($res_test['product_id'] > 0) {
				$query = "UPDATE ".cms_db_prefix()."module_products_fieldvals SET value_".$fid." = ?, modified_date = ? WHERE product_id = ?";
				$db->Execute($query, array('', trim($db->DBTimeStamp(time()), "'"), $compid));
				
			}
		  }
		}
	      }
	  }

	// Update categories
	$db->Execute('DELETE FROM '.cms_db_prefix().'module_products_product_categories WHERE product_id = ?', array($compid));
	if (isset($params['categories']))
	  {
	    foreach ($params['categories'] as $v)
	      {
	        $query = 'INSERT INTO '.cms_db_prefix().'module_products_product_categories (product_id, category_id, create_date, modified_date) VALUES (?,?,?,?)';
		$db->Execute($query, array($compid, $v, trim($db->DBTimeStamp(time()), "'"), trim($db->DBTimeStamp(time()), "'")));
	      }
	  }
		
	//Update search index
	$module = $this->GetModuleInstance('Search');
	if ($module != FALSE)
	  {
	    $module->DeleteWords($this->GetName(), $compid, 'product');
	    if( $status == 'published' )
	      {
		$module->AddWords($this->GetName(), $compid, 'product', 
				  implode(' ', $this->GetSearchableText($compid) ) );
	      }
	  }

	if( count($errors) )
	  {
	    echo $this->ShowErrors($errors);
            echo $this->ShowErrors($this->Lang('info_fieldproblems'));
            return;
	  }
        else
          {
		  if (isset($params['apply'])){
			unset ($fielddefs);	unset($field); unset($_REQUEST);
			$fielddefs = $this->GetFieldDefsForProduct($compid,true);
			echo $this->ShowMessage($this->Lang('atnaujinta'));
		  }else
  	    $this->RedirectToTab($id);
          }
      }
  }
 else
   {
     $query = 'SELECT * FROM '.cms_db_prefix().'module_products WHERE id = ?';
     $row = $db->GetRow($query, array($compid));

     if ($row)
       {
	 $product_name = $row['product_name'];
	 $price = (float)$row['price'];
	 $weight = (float)$row['weight'];
	 $sku = $row['sku'];
	 $alias = $row['alias'];
	 $details = $row['details'];
	 $origname = $row['product_name'];
	 $taxable = $row['taxable'];
	 $status = $row['status'];

	 $query = 'SELECT hierarchy_id FROM '.cms_db_prefix().'module_products_prodtohier 
                    WHERE product_id = ?';
	 $hierarchy_pos = $db->GetOne($query, array( $compid) );
       }
   }

$fieldarray = array();
if (count($fielddefs) > 0)
  {
    $subscribe_opts = array();
    $subscribe_opts[-1] = $this->Lang('none');
    $subscribe_opts['monthly'] = $this->Lang('subscr_monthly');
    $subscribe_opts['quarterly'] = $this->Lang('subscr_quarterly');
    $subscribe_opts['semianually'] = $this->Lang('subscr_semianually');
    $subscribe_opts['yearly'] = $this->Lang('subscr_yearly');
    $subscribe_opts = array_flip($subscribe_opts);

    $expire_opts = array();
    $expire_opts[$this->Lang('none')] = -1;
    $expire_opts[$this->Lang('expire_six_months')] = '6';
    $expire_opts[$this->Lang('expire_one_year')] = '12';
    $expire_opts[$this->Lang('expire_two_year')] = '24';

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

    foreach ($fielddefs as $fielddef)
      {
	$field = new stdClass();

	$value = '';
	if (isset($fielddef->value))
	  {
	    $value = $fielddef->value;
	  }

	if (isset($_REQUEST[$id.'customfield']['field-'.$fielddef->id]))
	  $value = $_REQUEST[$id.'customfield']['field-'.$fielddef->id];

	$field->id = $fielddef->id;
	$field->name = $fielddef->name;
	$field->type = $fielddef->type;
	$field->group = $fielddef->group;
	if( isset($fielddef->value) && !empty($fielddef->value) ) $field->value = $fielddef->value;
	$field->prompt = $fielddef->prompt;
	switch ($fielddef->type)
	  {
	  case 'dimensions':
	    if( !is_array($value) )
	      {
		$value = array('length'=>0,'width'=>0,'height'=>0);
	      }
	    $field->prompt .= '&nbsp;('.product_ops::get_length_units().')';
	    $field->input_box = 
	      $this->Lang('abbr_length').':&nbsp'.
	      $this->CreateInputText($id,'customfield[field-'.$fielddef->id.'][length]',
				     $value['length'],3,3).
	      $this->Lang('abbr_width').':&nbsp'.
	      $this->CreateInputText($id,'customfield[field-'.$fielddef->id.'][width]',
				     $value['width'],3,3).
	      $this->Lang('abbr_height').':&nbsp'.
	      $this->CreateInputText($id,'customfield[field-'.$fielddef->id.'][height]',
				     $value['height'],3,3);
	    break;

	  case 'checkbox':
	    $field->input_box = 
                      '<input type="hidden" name="' . $id . 'customfield[field-'.$fielddef->id.']' . '" value="false" />' . 
                      $this->CreateInputCheckbox($id, 'customfield[field-'.$fielddef->id.']', 'true', $value );
	    break;
	  case 'textarea':
	    //$field->input_box = $this->CreateTextArea(true, $id, $value, 'customfield[field-'.$fielddef->id.']');
	    $field->input_box = "<table><tr>";
	    
		
		$z=0;$k='';
		foreach ($kalbos as $kalba){
			
			
			if ($z){$dno = " style='display: none'"; $cla = "class='komm'";}else{$cla = "class='active komm'";$dno='';}
			
			$k .= "<a href='javascript:void(0)' $cla alt='$kalba'>".$this->Lang($kalba)."</a>&nbsp;";
						
			$inputprompts[$kalba] = $this->CreateInputText($id,"prompt[$kalba]",$prompts[$kalba],20,255);
			$field->input_box .= "<td $dno class='$kalba hddi'>";
			$field->input_box .= $this->CreateTextArea(true, $id, $value[$kalba], 'customfield[field-'.$fielddef->id.']['.$kalba.']', '', '', '', '', '', '', '', '', $rm);
			$field->input_box .= "</td>";
			$z++;
		}	

		$field->input_box .= "</tr></table>";
		$field->input_box = "<br/>".$k."<br/><br/>".$field->input_box;
	    break;
	  case 'textarea_multi':
	    
		$top_tt = "<div class=\"temp_block_".$fielddef->id." multi_block\" style=\"display:none; padding-bottom: 10px; border-bottom: 1px solid #ddd; margin-bottom: 10px;\">";
		
		$field->input_box = "<table style=\"border-spacing: 0;\"><tr>";
		$z=0;$k='';
		foreach ($kalbos as $kalba){
			//$tmpval = $params['customfield']['field-'.$fielddef->id][$kalba]['v']['nm'];
			if ($z){$dno = " style='display: none'"; $cla = "class='komm'";}else{$cla = "class='active komm'";$dno='';}
			
			$k .= "<a href='javascript:void(0)' $cla alt='$kalba'>".$this->Lang($kalba)."</a>&nbsp;";
			$field->input_box .= "<td $dno class='$kalba hddi'>";
			//$val = unserialize($fielddef->value);
			//$val = $fielddef->value;
			
			$field->input_box .= $this->CreateInputText($id,'customfield[field-'.$fielddef->id.']['.$kalba.'][v][nm]','','',60,255);
			$field->input_box  .= "<a href=\"#\" class=\"delete_this_block\">".$this->Lang('textarea_multi_delete_block')."</a></td>";
			$z++;
		}
		
		
		$field->input_box .= "
		<td>
			<a href=\"#".$fielddef->id."\" class=\"block_up\">
				<img src=\"themes/".$themeObject->GetDefaultTheme()."/images/icons/system/arrow-u.gif\" class=\"systemicon\">
			</a>
		</td><td>
			<a href=\"#".$fielddef->id."\" class=\"block_down\">
				<img src=\"themes/".$themeObject->GetDefaultTheme()."/images/icons/system/arrow-d.gif\" class=\"systemicon\">
			</a>
		</td>";
		
		$field->input_box .= "</tr></table>";
		$field->input_box = $k."<br/>".$top_tt.$field->input_box ;	
		
		$field->input_box .= "<table><tr><br/>";
	  
		$z=0;//$k='';
		foreach ($kalbos as $kalba){
			
			
			if ($z){$dno = " style='display: none'"; $cla = "class='komm'";}else{$cla = "class='active komm'";$dno='';}
			
			//$k .= "<a href='javascript:void(0)' $cla alt='$kalba'>".$this->Lang($kalba)."</a>&nbsp;&nbsp;&nbsp;";
			
			$field->input_box .= "<td $dno class='$kalba hddi'>";
			$field->input_box .= $this->CreateTextArea(false, $id, '', 'customfield[field-'.$fielddef->id.']['.$kalba.'][t][nm]', 'test_w_'.$fielddef->id.'[t][nm]', 'test_w_'.$fielddef->id.'_'.$kalba.'[t][nm]', '', '', '', '', '', '', $rm);
			$field->input_box .= "</td>";
			$z++;
		}	

		$field->input_box .= "</tr></table>
		</div>
			
			<div class=\"multi_holder_".$fielddef->id."\">";
			
		
		if (is_array($value[$p_kalbo]['v']) && count($value[$p_kalbo]['v']) > 0) {
			foreach($value[$p_kalbo]['v'] as $v_key => $v_val) {
				if ($v_key !== 'nm') {
					$field->input_box .= "<div class=\"multi_block\" style=\"padding-bottom: 10px; border-bottom: 1px solid #ddd; margin-bottom: 10px;\">";
					/*ppp*/
					
					$field->input_box .= "<table style=\"border-spacing: 0;\"><tr>";
					$z=0;
					foreach ($kalbos as $kalba){
						if ($z){$dno = " style='display: none'"; $cla = "class='komm'";}else{$cla = "class='active komm'";$dno='';}
						
						$field->input_box .= "<td $dno class='$kalba hddi'>";
						
						$field->input_box .= $this->CreateInputText($id,'customfield[field-'.$fielddef->id.']['.$kalba.'][v]['.$v_key.']',$value[$kalba]['v'][$v_key],'',60,255);
						$field->input_box  .= "<a href=\"#\" class=\"delete_this_block\">".$this->Lang('textarea_multi_delete_block')."</a></td>";
						$z++;
					}
					
					$field->input_box .= "
					<td>
						<a href=\"#".$fielddef->id."\" class=\"block_up\">
							<img src=\"themes/".$themeObject->GetDefaultTheme()."/images/icons/system/arrow-u.gif\" class=\"systemicon\">
						</a>
					</td><td>
						<a href=\"#".$fielddef->id."\" class=\"block_down\">
							<img src=\"themes/".$themeObject->GetDefaultTheme()."/images/icons/system/arrow-d.gif\" class=\"systemicon\">
						</a>
					</td>";

					$field->input_box .= "</tr></table>";
					
					$field->input_box .= "<table><tr><br/>";
	  
					$z=0;
					foreach ($kalbos as $kalba){
						
						if ($z){$dno = " style='display: none'"; $cla = "class='komm'";}else{$cla = "class='active komm'";$dno='';}
						
						//$k .= "<a href='javascript:void(0)' $cla alt='$kalba'>".$this->Lang($kalba)."</a>&nbsp;&nbsp;&nbsp;";
						
						$field->input_box .= "<td $dno class='$kalba hddi'>";
						$field->input_box .= $this->CreateTextArea(true, $id, $value[$kalba]['t'][$v_key], 'customfield[field-'.$fielddef->id.']['.$kalba.'][t]['.$v_key.']', 'test_w_'.$fielddef->id.'[t]['.$v_key.']', 'test_w_'.$fielddef->id.'_'.$kalba.'[t]['.$v_key.']', '', '', '', '', '', '', $rm);
						$field->input_box .= "</td>";
						$z++;
					}

					$field->input_box .= "</tr></table>";
					
					/*ppp*/
					$field->input_box .= "</div>";
				}
			}
		}
		
		
		$field->input_box .= "</div>
			<br/>
			<input type=\"button\" class=\"textarea_multi_add \" data-element=\"temp_block_".$fielddef->id."\" value=\"".$this->Lang('textarea_multi_add')."\"/>
			
		";
		//<input type=\"hidden\" name=\"".$id."customfield[field-".$fielddef->id."][ordering]\" id=\"ordering_".$fielddef->id."\" value=\"\" />
		
		break;
	  case 'dropdown':
	    $field->input_box = $this->CreateInputDropdown($id, 'customfield[field-'.$fielddef->id.']',
							   $fielddef->options, -1, $value );
	    break;
	  case 'file':
	    $field->delete = $this->CreateInputCheckbox($id,'customfield[deletefield-'.$fielddef->id.']',
							1,0);
	    $field->input_box = $this->CreateFileUploadInput($id,'customfield[field-'.$fielddef->id.']','',50);
	    $field->hidden = $this->CreateInputHidden($id,'customfield[field-'.$fielddef->id.']',$value);
	    break;
	  case 'image':
	    if ($value) {
	      $destdir = cms_join_path($gCms->config['uploads_path'],$this->GetName(),
				       'product_'.$compid);
	      $url = $gCms->config['uploads_url']."/".$this->GetName()."/product_{$compid}";
	      $fn = cms_join_path($destdir,'thumb_'.$value);
	      if( file_exists($fn) ) $field->image = "{$url}/{$value}";
	      $fn = cms_join_path($destdir,'thumb_'.$value);
	      if( file_exists($fn) ) $field->thumbnail = "{$url}/thumb_{$value}";
	      $fn = cms_join_path($destdir,'preview_'.$value);
	      if( file_exists($fn) ) $field->preview = "{$url}/preview_{$value}";
	    }
            if( $this->GetPreference('autowatermark') == 'adjustable' )
              {
                $field->attribute = $this->Lang('watermark_location').'&nbsp;'.
                    $this->CreateInputDropdown($id,'customfield_attr[field-'.$fielddef->id.']',$wmopts,-1,'default');
              }
	    $field->delete = $this->CreateInputCheckbox($id,'customfield[deletefield-'.$fielddef->id.']',
							1,0);
	    $field->input_box = $this->CreateFileUploadInput($id,'customfield[field-'.$fielddef->id.']','',50);
	    $field->hidden = $this->CreateInputHidden($id,'customfield[field-'.$fielddef->id.']',$value);
	    break;
	  case 'subscription':
	    if( !is_array($value) )
	      {
		$value = array('payperiod'=>-1,'delperiod'=>-1,'expire'=>1);
	      }
	    if( !isset($value['payperiod']) ) $value['payperiod'] = -1;
	    if( !isset($value['delperiod']) ) $value['delperiod'] = -1;
	    if( !isset($value['expire']) ) $value['expire'] = -1;
	    $field->input_box = $this->Lang('subscr_payperiod').':&nbsp;';
	    $field->input_box .= $this->CreateInputDropdown($id,'customfield[field-'.$fielddef->id.'][payperiod]',
							   $subscribe_opts, -1, $value['payperiod']);
	    $field->input_box .= '<br/>'.$this->Lang('subscr_delperiod').':&nbsp;';
	    $field->input_box .= $this->CreateInputDropdown($id,'customfield[field-'.$fielddef->id.'][delperiod]',
							   $subscribe_opts, -1, $value['delperiod']);
	    $field->input_box .= '<br/>'.$this->Lang('subscr_expiry').':&nbsp;';
	    $field->input_box .= $this->CreateInputDropdown($id,'customfield[field-'.$fielddef->id.'][expire]',
							   $expire_opts, -1, $value['expire']);
	    break;
	  case 'checkboxgroup':
		if(@unserialize($fielddef->optionslng)){
			$checkboxai = unserialize($fielddef->optionslng);
		} else {
			$checkboxai = $fielddef->optionslng;
		}
		$z=0;
		
		$empty_fields = $this->GetPreference('empty_fields', '');
		$empty_fields = explode(',', $empty_fields);
		
		
		$field->input_box = '<input type="hidden" name="' . $id . 'customfield[field-'.$fielddef->id.'][]' . '" value="false" /><table><tr>';
		
		if (@unserialize($value)) {
			$value = unserialize($value);
		}
		
		foreach($checkboxai as $chkbx){
			
			if (in_array($chkbx[lt], $empty_fields)) {
				continue;
			}
			
			$z++;		
			
			//
			
			if (!is_array($value))
				$value = array();
			
			if (in_array($chkbx[lt], $value)){
				$val = $chkbx[lt];
			}else{
				$val = '';
			}
			
			
			
			$field->input_box .= "<td style='width: 200px'>".$this->CreateInputCheckbox($id,'customfield[field-'.$fielddef->id.'][]',$chkbx[lt],$val,$rm.' class="chbfi"');
			$field->input_box .= "<span class='chbf'>".$chkbx[lt]."</span></td>";
		
			if ($z == 2){
				$field->input_box .= '</tr><tr>';
				$z=0;
			}
		

		}		
		
		$field->input_box .= '</tr></table>';
		
		//print_r($checkboxai);
	  
	  
	    break;
	  case 'quantity':
	    $field->input_box = $this->CreateInputText($id, 'customfield[field-'.$fielddef->id.']', $value, 4, 4);
	    break;

	  case 'textbox':
	  default:
		unset($options);
		if(@unserialize($fielddef->optionslng)){
			$options = unserialize($fielddef->optionslng);
		} else {
			$options = $fielddef->optionslng;
		}
		if($fielddef->requ_lang == '1'){
			
			$field->requ_lang = $fielddef->requ_lang;
			
			//$kalbos	= array_reverse($kalbos);		
			$field->input_box  = "<table style='border-spacing: 0'><tr>";
			$z=0;$k='';
			foreach ($kalbos as $kalba){
				$tmpval = $params['customfield']['field-'.$fielddef->id][$kalba];
				if ($z){$dno = " style='display: none'"; $cla = "class='komm'";}else{$cla = "class='active komm'";$dno='';}
				
				$k .= "<a href='javascript:void(0)' $cla alt='$kalba'>".$this->Lang($kalba)."</a>&nbsp;";
				$field->input_box .= "<td $dno class='$kalba hddi'>";
				//$val = unserialize($fielddef->value);
				//$val = $fielddef->value;
				
				$field->input_box .= $this->CreateInputText($id,'customfield[field-'.$fielddef->id.']['.$kalba.']',$value[$kalba],$tmpval,60,255);
				$field->input_box  .= "</td>";
				$z++;
			}	

			$field->input_box .= "</tr></table>";
			$field->input_box = $k."<br/>".$field->input_box ;	  
		}
		else{
			$field->input_box = "<div class='fld_{$fielddef->id}'>".$this->CreateInputText($id, 'customfield[field-'.$fielddef->id.']', $value, 30, 255, "$addi", $fielddef->name)."</div>";
		}
	   // $field->input_box = $this->CreateInputText($id, 'customfield[field-'.$fielddef->id.']', $value, 30, 255);
	    break;
	  }

	$fieldarray[] = $field;
      }
  }

$allcategories = $this->GetCategories();
$catarray = array();
if (is_array($allcategories)){
foreach( $allcategories as $one )
{
  $catarray[$one->name] = $one->id;
}
$selcategories = $this->GetCategoriesForProduct($compid);
$selcatarray = array();
foreach( $selcategories as $one )
{
  if( !$one->value ) continue;
  $selcatarray[$one->name] = $one->id;
}
}
#Display template
$smarty->assign('startform', $this->CreateFormStart($id, 'editproduct', $returnid, 'post', 'multipart/form-data'));
$smarty->assign('endform', $this->CreateFormEnd());
$smarty->assign('nametext', $this->Lang('name'));
$smarty->assign('inputname', $this->CreateInputText($id, 'product_name', $product_name, 30, 255));
$smarty->assign('pricetext', $this->Lang('price'));
$smarty->assign('currency_symbol',product_ops::get_currency_symbol());
$smarty->assign('inputprice', $this->CreateInputText($id, 'price', sprintf("%.2F",$price), 10, 12));
$smarty->assign('weighttext', $this->Lang('weight'));
$smarty->assign('weightunits',$this->GetPreference('products_weightunits'));
$smarty->assign('inputweight', $this->CreateInputText($id, 'weight', 
							    sprintf("%.2F",$weight), 10, 12));
$smarty->assign('inputsku',$this->CreateInputText($id,'sku',$sku,10,25));
$smarty->assign('inputalias',$this->CreateInputText($id,'alias',$alias,40,255));
$smarty->assign('detailstext', $this->Lang('details'));
$smarty->assign('inputdetails', $this->CreateTextArea(true, $id, $details, 'details', '', '', '', '', '80', '5'));

if( count($catarray) > 0 ) {
  $n = count($catarray)/4;
  $n = min($n,20);
  $n = max($n,5);
$smarty->assign('input_categories',
		$this->CreateInputSelectList($id,'categories[]',$catarray,$selcatarray,$n));;
 }

$smarty->assign('taxabletext',$this->Lang('taxable'));
$smarty->assign('inputtaxable',
		$this->CreateInputCheckbox($id,'taxable',1,$taxable));

$hierarchy_items = $this->BuildHierarchyList();
$smarty->assign('hierarchy_items',$hierarchy_items);
$smarty->assign('hierarchy_pos',$hierarchy_pos);

$statuses = array($this->Lang('published')=>'published',
		  $this->Lang('draft')=>'draft',
		  $this->Lang('disabled')=>'disabled');
$smarty->assign('statustext',$this->Lang('status'));
$smarty->assign('inputstatus',
		$this->CreateInputDropdown($id,'status',
					   $statuses,-1,$status));

$smarty->assign('idtext',$this->Lang('id'));
$smarty->assign('compid',$compid);
$smarty->assign('hidden', 
		$this->CreateInputHidden($id, 'compid', $compid).
		$this->CreateInputHidden($id, 'origname', $origname));
$smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', lang('submit')));
$smarty->assign('apply', $this->CreateInputSubmit($id, 'apply', lang('apply')));
$smarty->assign('cancel', $this->CreateInputSubmit($id, 'cancel', lang('cancel')));
$smarty->assign('customfields', $fieldarray);
$smarty->assign('customfieldscount', count($fieldarray));

$smarty->assign('starttabheaders',$this->StartTabHeaders());
$smarty->assign('tabheader_main',$this->SetTabHeader('main',$this->Lang('product_info')));
$smarty->assign('tabheader_fields',$this->SetTabHeader('fields',$this->Lang('fields')));
$smarty->assign('tabheader_advanced',$this->SetTabHeader('advanced',$this->Lang('advanced')));
$smarty->assign('endtabheaders',$this->EndTabHeaders());
$smarty->assign('starttabcontent',$this->StartTabContent());
$smarty->assign('tab_main',$this->StartTab('main'));
$smarty->assign('tab_fields',$this->StartTab('fields'));
$smarty->assign('tab_advanced',$this->StartTab('advanced'));
$smarty->assign('endtab',$this->EndTab());
$smarty->assign('endtabcontent',$this->EndTabContent());

$smarty->assign('product_name_field', $id.'customfield[field-'.$name_field['id'].']['.$p_kalbo.']');

echo $this->ProcessTemplate('editproduct.tpl');

?>
