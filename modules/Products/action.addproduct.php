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


if (!$this->CheckPermission('Modify Products'))
  {
    echo $this->ShowErrors($this->Lang('needpermission', array('Modify Products')));
    return;
  }

if (isset($params['cancel']))
  {
    $this->RedirectToTab($id);
  }

$product_name = '';
if (isset($params['product_name']))
  {
    $product_name = $params['product_name'];
  }

$price = 0.0;
if (isset($params['price']) )
  {
    $price = (float)$params['price'];
  }
$weight = 0.0;
if (isset($params['weight']) )
  {
    $weight = (float)$params['weight'];
  }
$sku = '';
if (isset($params['sku']) )
  {
    $sku = trim($params['sku']);
  }
$alias = '';
if (isset($params['alias']) )
  {
    $alias = trim($params['alias']);
  }

$details = '';
if (isset($params['details']))
  {
    $details = $params['details'];
  }
  
$compid_tmp = '';
if (isset($params['compid_tmp']))
  {
    $compid_tmp = $params['compid_tmp'];
  }

$status = $this->GetPreference('default_status','published');
if (isset($params['status']))
  {
    $status = $params['status'];
  }

$taxable = $this->GetPreference('default_taxable',1);
if (isset($params['taxable']))
  {
    $taxable = 1;
  }

$userid = get_userid();
$fielddefs = $this->GetFieldDefs(true);

$kalbos = $this->GetPreference('kalbos', 'lt');
$kalbos = explode(',', $kalbos);	
$p_kalbo = $kalbos[0];//pagrindine kalba
$name_field = $this->GetFieldByName($this->GetPreference('pavadinimas_field'));

if (isset($params['submit']))
  {
	
	
	//if (empty($product_name)) {
		$product_name = $_REQUEST[$id.'customfield']['field-'.$name_field['id']][$p_kalbo];
	//}
	
    $duplicate = '';
    $duplicatesku = '';
    $duplicatealias = '';
    $emptysku = '';
    if( !empty($product_name) )
      {
	// check for duplicate name
	$query = 'SELECT id FROM '.cms_db_prefix().'module_products
                   WHERE product_name = ?';
	$duplicate = $db->GetOne($query,array($product_name));
      }
    // check for empty alias
    if( empty($alias) )
      {
		$alias = product_ops::generate_alias($product_name);
      }
    else
      {
		$alias = product_ops::generate_alias($alias);
      }

    // check for duplicate alias
    if( product_ops::check_alias_used($alias) )
      {
	$duplicatealias = $alias;
      }
		//echo 'zzz'; die;

    if( empty($sku) && $this->GetPreference('skurequired',0) )
      {
	$emptysku = 1;
      }

    if( !$duplicate && !empty($sku) )
      {
	// check for duplicate sku
	if( product_ops::check_sku_used($sku) )
	  {
	    $duplicatesku = $sku;
	  }
      }

    if( empty($product_name) )
      {
	echo $this->ShowErrors($this->Lang('nonamegiven'));
      }
    else if( $emptysku )
      {
	echo $this->ShowErrors($this->Lang('error_sku_required'));
      }
    else if( $duplicate )
      {
	echo $this->ShowErrors($this->Lang('error_product_nameused'));
      }
    else if( $duplicatealias )
      {
	echo $this->ShowErrors($this->Lang('error_product_aliasused'));
      }
    else if( $duplicatesku )
      {
	echo $this->ShowErrors($this->Lang('error_product_skuused'));
      }
    else
      {
	// insert the product record

	
	$query = 'INSERT INTO '.cms_db_prefix().'module_products (product_name, price, details, create_date, modified_date, taxable, status, weight, sku, alias) VALUES (?,?,?,?,?,?,?,?,?,?)';
	$dbr = $db->Execute($query, array($product_name, $price, $details, trim($db->DBTimeStamp(time()), "'"), trim($db->DBTimeStamp(time()), "'"), $taxable, $status, $weight, $sku, $alias));
	
	if( !$dbr ) 
	  {
	    die('ERROR: '.$db->sql.'<br/>'.$db->ErrorMsg());
	  }
	$cid = $db->Insert_ID();
	
	if ($params['hierarchy'] > 0) {
		// insert the prodtohier record
		/*$query = "SELECT IF(!ISNULL(MAX(order_id)), MAX(order_id), 'none') as orde FROM ".cms_db_prefix()."module_products_prodtohier WHERE hierarchy_id = ?";
		$orde = $db->GetOne($query, array((int)$params['hierarchy']));
		
		if ($orde == 'none') {
			$orde = 0;
		} else {
			$orde = intval($orde);
			$orde++;
		}*/
		
		$query = 'INSERT INTO '.cms_db_prefix().'module_products_prodtohier 
					   (product_id,hierarchy_id)
					   VALUES (?,?)';
		$db->Execute( $query, array( $cid, (int)$params['hierarchy']) );
	}
	// Handle custom fields
	$errors = array();
	if (isset($_REQUEST[$id.'customfield']))
	  {
	    foreach ($_REQUEST[$id.'customfield'] as $k=>$v)
	      {
		if (startswith($k, 'field-'))
		  {
		    // get the field index
		    $fid = substr($k, 6);

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
			$destdir = cms_join_path($gCms->config['uploads_path'],$this->GetName(),
						 'product_'.$cid);
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
			else if( !$res )
			  {
			    $v = null;
			  }
			else
			  {
			    $v = $res;
			  }
			break;

		      case 'image':
				
                      /*  $attr = 'default'; // use default value for wmlocation
                        if( isset($_REQUEST[$id.'customfield_attr']) && isset($_REQUEST[$id.'customfield_attr'][$k]) )
                          {
                            $attr = $_REQUEST[$id.'customfield_attr'][$k];
                          }
		        $destdir = cms_join_path($gCms->config['uploads_path'],$this->GetName(),
					       'product_'.$cid);
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
						
				$query_img = "SELECT value FROM ".cms_db_prefix()."module_products_images_temp WHERE product_id = ? AND field_id = ? ORDER BY ordering ASC";
				$images = $db->GetCol($query_img, array($compid_tmp, $fid));
				
				$destdir = cms_join_path($gCms->config['uploads_path'],$this->GetName(), 'product_'.$cid);
				$destdir2 = '/'.cms_join_path('uploads',$this->GetName(), 'product_'.$cid);
				
				umask(0);
				if (!file_exists($destdir.'/')) {
					mkdir($destdir.'/', 0777, true);
				}
				$tmp_img_dir = cms_join_path($gCms->config['uploads_path'],$this->GetName(), 'product_'.$compid_tmp);
				$images_new = array();
				if (isset($images) && count($images) > 0) {
					foreach ($images as $img) {
						$img_tt = explode('/', $img);
						$img_name = array_pop($img_tt);
						rename(str_replace('/uploads', $gCms->config['uploads_path'], $img), $destdir.'/'.$img_name); 
						
						$images_new[] = $destdir2.'/'.$img_name;
						
					}
					if (isset($images_new) && count($images_new) > 0) {
						$v = serialize($images_new);
					} else {
						$v = null;
					}
				} else {
					$v = null;
				}
				
				$query_img = "DELETE FROM ".cms_db_prefix()."module_products_images_temp WHERE product_id = ? AND field_id = ?";
				$db->Execute($query_img, array($compid_tmp, $fid));
				if (file_exists($tmp_img_dir.'/')) {
					rmdir($tmp_img_dir.'/');
				}
			break;

		      case 'quantity':
			$v = (int)$v;
			$v = max(0,$v);
			break;

		      case 'subscription':
		      case 'dimensions':
			if( is_array($v) )
			  {
			    $v = serialize($v);
			  }
			break;
			  case 'checkboxgroup':
				/*foreach ($v as $a){
					$a = htmlspecialchars($a);
					$query = 'INSERT INTO '.cms_db_prefix().'module_products_fieldvals (product_id, fielddef_id, value, create_date, modified_date) VALUES (?,?,?,?,?)';
					$db->Execute($query, array($cid, $fid, $a, trim($db->DBTimeStamp(time()), "'"), trim($db->DBTimeStamp(time()), "'")));					
				}
				$v = '';*/
				$v = serialize($v);
			  break;
			  
			  case 'textbox':
		      case 'checkbox':
			  case 'textarea':
				if( is_array($v) )
				  {
					$v = serialize($v);
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

		    // commit it.
		    if( !is_null($v) && $v !== '' )
		      {
				$query = "SELECT * FROM ".cms_db_prefix()."module_products_fieldvals WHERE product_id = ?";
				$res_test = $db->getRow($query, array($cid));
				if ($res_test['product_id'] > 0) {
					$query = "UPDATE ".cms_db_prefix()."module_products_fieldvals SET value_".$fid." = ?, modified_date = ? WHERE product_id = ?";
					$db->Execute($query, array($v, trim($db->DBTimeStamp(time()), "'"), $cid));
				} else {
					$query = 'INSERT INTO '.cms_db_prefix().'module_products_fieldvals (product_id, value_'.$fid.', create_date, modified_date) VALUES (?,?,?,?)';
					$db->Execute($query, array($cid, $v, trim($db->DBTimeStamp(time()), "'"), trim($db->DBTimeStamp(time()), "'")));
				}
				//$query = 'INSERT INTO '.cms_db_prefix().'module_products_fieldvals (product_id, create_date, modified_date) VALUES (?,?,?,?,?)';
				//$db->Execute($query, array($cid, trim($db->DBTimeStamp(time()), "'"), trim($db->DBTimeStamp(time()), "'")));//$fid//$v
				
		      }
		  }
	      }
	  }

	// handle category stuff
	if (isset($params['categories']))
	  {
	    foreach ($params['categories'] as $v)
	      {
		 $query = 'INSERT INTO '.cms_db_prefix().'module_products_product_categories (product_id, category_id, create_date, modified_date) VALUES (?,?,?,?)';
		 $db->Execute($query, array($cid, $v, trim($db->DBTimeStamp(time()), "'"), trim($db->DBTimeStamp(time()), "'")));
	      }
	  }
		
	//Update search index
	$module = $this->GetModuleInstance('Search');
	if ($module != FALSE)
	  {
	    if( $status == 'published' )
	      {
		$module->AddWords($this->GetName(), $cid, 'product', 
				  implode(' ', $this->GetSearchableText($cid) ));
	      }
	  }

	// if there were errors
	// display them
	// and a return link
	// could use a template here, but fug it for now.
	if( count($errors) )
	  {
	    echo $this->ShowErrors($errors);
            echo $this->ShowErrors($this->Lang('info_fieldproblems'));
            return;
	  }
        else
          {
  	    $this->RedirectToTab($id);
          }
      } // insert the product record
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
	$field->prompt = $fielddef->prompt;
	$field->type = $fielddef->type;
	$field->group = $fielddef->group;
	switch ($fielddef->type)
	  {
	  case 'dimensions':
		//print_r($value);
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
	    $field->input_box = '<input type="hidden" name="' . $id . 'customfield[field-'.$fielddef->id.']' . '" value="false" />'.$this->CreateInputCheckbox($id, 'customfield[field-'.$fielddef->id.']', 'true', $value == 'true');
	    break;
	  case 'textarea':
		
	    //$field->input_box = $this->CreateTextArea(true, $id, $value, 'customfield[field-'.$fielddef->id.']');
		$field->input_box = "<table><tr>";
	  
		$z=0;$k='';
		foreach ($kalbos as $kalba){
			
			
			if ($z){$dno = " style='display: none'"; $cla = "class='komm'";}else{$cla = "class='active komm'";$dno='';}
			
			$k .= "<a href='javascript:void(0)' $cla alt='$kalba'>".$this->Lang($kalba)."</a>&nbsp;&nbsp;&nbsp;";
						
			$inputprompts[$kalba] = $this->CreateInputText($id,"prompt[$kalba]",$prompts[$kalba],20,255);
			$field->input_box .= "<td $dno class='$kalba hddi'>";
			$field->input_box .= $this->CreateTextArea(true, $id, $value[$kalba], 'customfield[field-'.$fielddef->id.']['.$kalba.']', '', '', '', '', '', '', '', '', $rm);
			$field->input_box .= "</td>";
			$z++;
		}	

		$field->input_box .= "</tr></table>";
		$field->input_box = $k."<br/><br/>".$field->input_box;
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
			
			<div class=\"multi_holder_".$fielddef->id."\">
			</div>
			<br/>
			<input type=\"button\" class=\"textarea_multi_add \" data-element=\"temp_block_".$fielddef->id."\" value=\"".$this->Lang('textarea_multi_add')."\"/>
		";
		
		break;
	  case 'dropdown':
	    $field->input_box = $this->CreateInputDropdown($id, 'customfield[field-'.$fielddef->id.']', $fielddef->options, -1, $value );
	    break;
	  case 'file':
	    $field->input_box = $this->CreateFileUploadInput($id,'customfield[field-'.$fielddef->id.']','',50);
	    $field->hidden = $this->CreateInputHidden($id,'customfield[field-'.$fielddef->id.']','');
	  case 'image':
            if( $this->GetPreference('autowatermark') == 'adjustable' )
              {
                $field->attribute = $this->Lang('watermark_location').'&nbsp;'.
                    $this->CreateInputDropdown($id,'customfield_attr[field-'.$fielddef->id.']',$wmopts,-1,'default');
              }
	    $field->input_box = $this->CreateFileUploadInput($id,'customfield[field-'.$fielddef->id.']','',50);
	    $field->hidden = $this->CreateInputHidden($id,'customfield[field-'.$fielddef->id.']','');
	    break;
	  case 'subscription':
	    $field->input_box = $this->Lang('subscr_payperiod').':&nbsp;';
	    $field->input_box .= $this->CreateInputDropdown($id,'customfield[field-'.$fielddef->id.'][payperiod]',
							   $subscribe_opts, -1, $value);
	    $field->input_box .= '<br/>'.$this->Lang('subscr_delperiod').':&nbsp;';
	    $field->input_box .= $this->CreateInputDropdown($id,'customfield[field-'.$fielddef->id.'][delperiod]',
							   $subscribe_opts, -1, $value);
	    $field->input_box .= '<br/>'.$this->Lang('subscr_expiry').':&nbsp;';
	    $field->input_box .= $this->CreateInputDropdown($id,'customfield[field-'.$fielddef->id.'][expire]',
							   $expire_opts, -1, $value);
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
		
		$field->input_box = '<table><tr>';
		
		foreach($checkboxai as $chkbx){
			
			if (in_array($chkbx[lt], $empty_fields)) {
				continue;
			}
			
			$z++;		
			
			$field->input_box .= "<td style='width: 200px'>".$this->CreateInputCheckbox($id,'customfield[field-'.$fielddef->id.'][]',$chkbx[lt],$value,$rm.' class="chbfi"');
			$field->input_box .= "<span class='chbf'>".$chkbx[lt]."</span></td>";
		
			if ($z == 2){
				$field->input_box .= '</tr><tr>';
				$z=0;
			}
		

		}		
		
		$field->input_box .= '</tr></table>';
	  
	  
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
			$field->input_box = $this->CreateInputText($id, 'customfield[field-'.$fielddef->id.']', $value, 30, 255, "$addi", $fielddef->name);
		}
		
	    //$field->input_box = $this->CreateInputText($id, 'customfield[field-'.$fielddef->id.']', $value, 30, 255);
	    break;
	  }
	$fieldarray[] = $field;
      }
  }

$categories = $this->GetCategories();
$catarray = array();
if( is_array($categories) && count($categories) ) { 
  foreach ($categories as $fielddef) {
    $catarray[$fielddef->name] = $fielddef->id;
  }
}

#Display template
$smarty->assign('startform', $this->CreateFormStart($id, 'addproduct', $returnid, 'post', 'multipart/form-data'));
$smarty->assign('endform', $this->CreateFormEnd());
$smarty->assign('nametext', $this->Lang('name'));
/*if (!$product_name)
	$product_name = "turnyras_".time();*/
$smarty->assign('inputname', $this->CreateInputText($id, 'product_name', $product_name, 30, 255));
$smarty->assign('pricetext', $this->Lang('price'));
$smarty->assign('inputprice', $this->CreateInputText($id, 'price', $price, 8, 12));
$smarty->assign('currency_symbol',product_ops::get_currency_symbol());
$smarty->assign('weighttext', $this->Lang('weight'));
$smarty->assign('inputweight', $this->CreateInputText($id, 'weight', $weight, 8, 12));

$smarty->assign('inputsku',$this->CreateInputText($id,'sku',$sku,10,25));
$smarty->assign('inputalias',$this->CreateInputText($id,'alias',$alias,40,255));
$smarty->assign('weightunits',product_ops::get_weight_units());
$smarty->assign('detailstext', $this->Lang('details'));
$smarty->assign('inputdetails', $this->CreateTextArea(true, $id, $details, 'details', '', '', '', '', '80', '5'));

if( count($catarray) > 0 )
  {
    $n = count($catarray)/4;
    $n = min($n,20);
    $n = max($n,5);
    $smarty->assign('input_categories',
		    $this->CreateInputSelectList($id,'categories[]',$catarray,array(),$n));
  }

$smarty->assign('taxabletext',$this->Lang('taxable'));
$smarty->assign('inputtaxable',
		$this->CreateInputCheckbox($id,'taxable',1,$taxable));

$hierarchy_items = $this->BuildHierarchyList();
$smarty->assign('hierarchy_items',$hierarchy_items);
$smarty->assign('hierarchy_pos',isset($params['hierarchy'])?$params['hierarchy']:-1);

$statuses = array($this->Lang('published')=>'published',
		  $this->Lang('draft')=>'draft',
		  $this->Lang('disabled')=>'disabled');
$smarty->assign('statustext',$this->Lang('status'));
$smarty->assign('inputstatus',
		$this->CreateInputDropdown($id,'status',
					   $statuses,-1,$status));
$smarty->assign('hidden', '');
$smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', lang('submit')));
$smarty->assign('cancel', $this->CreateInputSubmit($id, 'cancel', lang('cancel')));
$smarty->assign_by_ref('customfields', $fieldarray);
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

if (empty($compid_tmp)) {
	$compid_tmp = md5(time().rand(0, 9999));
}
$smarty->assign('compid_tmp', $compid_tmp);
$smarty->assign('compid_h_tmp', $this->CreateInputHidden($id, 'compid_tmp', $compid_tmp));

echo $this->ProcessTemplate('editproduct.tpl');

?>
