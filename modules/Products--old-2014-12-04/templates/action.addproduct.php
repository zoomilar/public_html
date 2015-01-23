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
//
// A utility function
//
function get_field_def(&$fielddefs,$id)
{
  global $db;
  
  

  if ($id == "cars" || $id == 'models'){
	$ret = new stdClass();
	$ret->type = "cars";	
//	$ret->id = $db->GetOne("SELECT id FROM " . cms_db_prefix() . "module_products_carsdefs WHERE name='".$id."'");

	return $ret;
  }else{
  foreach( $fielddefs as $onedef )
    {
      if( $onedef->id == $id )
	{
	  return $onedef;
	}
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
if (isset($params['customfield']['field-cars']))
  {
    $product_name = $params['customfield']['field-cars'];
  }
  
$product_model = '';
if (isset($params['customfield']['field-models']))
  {
    $product_model = $params['customfield']['field-models'];
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

$status = $this->GetPreference('default_status','published');
if (isset($params['status']))
  {
    $status = $params['status'];
  }

$sinchautoplius = 0;
if (isset($params['sinchautoplius']))
  {
    $sinchautoplius = 1;
  }

$userid = get_userid();
$fielddefs = $this->GetFieldDefs(true);
$cars = $this->GetCars(true);



if (isset($params['submit']))
  {
    $duplicate = '';
    $duplicatesku = '';
    $duplicatealias = '';
    if( !empty($product_name) )
      {
	// check for duplicate name
	/*$query = 'SELECT id FROM '.cms_db_prefix().'module_products
                   WHERE product_name = ?';
	$duplicate = $db->GetOne($query,array($product_name));*/
      }

    // check for empty alias
    if( empty($alias) )
      {
	  $al = $product_name;
	  if ($product_model)
		$al = $al."-".$product_model;		
	  if ($params['customfield']['field-56'])
		$al = $al."-".$params['customfield']['field-56'];
	  if ($params['customfield']['field-53'])
		$al = $al."-".$params['customfield']['field-53'];
	  if ($params['customfield']['field-58'])
		$al = $al."-".$params['customfield']['field-58'];	  	  	  

	  
	$alias = product_ops::generate_alias(strtolower($al));
	
      }

    // check for duplicate alias
    /*if( product_ops::check_alias_used($alias) )
      {
	$duplicatealias = $alias;
      }

    if( !$duplicate && !empty($sku) )
      {
	// check for duplicate sku
	if( product_ops::check_sku_used($sku) )
	  {
	    $duplicatesku = $sku;
	  }
      }
	*/
    if( empty($product_name) )
      {
	echo $this->ShowErrors($this->Lang('nonamegiven'));
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
	$query = 'INSERT INTO '.cms_db_prefix().'module_products (product_name, product_model, price, details, create_date, modified_date, sinchautoplius, status, weight, sku, alias) VALUES (?,?,?,?,?,?,?,?,?,?,?)';
	$dbr = $db->Execute($query, array($product_name, $product_model, $price, $details, trim($db->DBTimeStamp(time()), "'"), trim($db->DBTimeStamp(time()), "'"), $sinchautoplius, $status, $weight, $sku, $alias));
	if( !$dbr ) 
	  {
	    die('ERROR: '.$db->sql.'<br/>'.$db->ErrorMsg());
	  }
	$cid = $db->Insert_ID();

	// insert the prodtohier record
	$query = 'INSERT INTO '.cms_db_prefix().'module_products_prodtohier 
                   (product_id,hierarchy_id)
                   VALUES (?,?)';
	$db->Execute( $query, array( $cid, (int)$params['hierarchy']) );

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
			
			if ($fid == "cars")
			$def = get_field_def($cars,$fid);
			else
		    $def = get_field_def($fielddefs,$fid);
		    if( !$def )
		      {
			die('could not get field def for '.$fid);
			continue;
		      }
			
			
			$c = 0;
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
                        $attr = 'default'; // use default value for wmlocation
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
                        }
			  break;

			  case 'imagegroup':
			  

				foreach ($v as $a=>$im){

						
						
						
                        $attr = 'default'; // use default value for wmlocation
                        if( isset($_REQUEST[$id.'customfield_attr']) && isset($_REQUEST[$id.'customfield_attr'][$k][$a]) )
                          {
                            $attr = $_REQUEST[$id.'customfield_attr'][$k][$a];
                          }
							$destdir = cms_join_path($gCms->config['uploads_path'],$this->GetName(),
					       'product_'.$cid);
						   
                        $res = $this->HandleUploadedImage($id,'customfield',$destdir,$errors,'field-'.$fid,$attr,'',$a);
						if($a===0 && $_FILES["{$id}customfield"]['name']['field-'.$fid][$a]){
								$this->addTextOnImage($destdir.'/'.$res, 'Nr. '.$cid);
								$this->addTextOnImage($destdir.'/akcija'.$res, 'Nr. '.$cid);
								$this->addTextOnImage($destdir.'/thumb3'.$res, 'Nr. '.$cid);
								$this->addTextOnImage($destdir.'/thumb1'.$res, 'Nr. '.$cid,40);
								$this->addTextOnImage($destdir.'/akcijathumb1'.$res, 'Nr. '.$cid,40);
								$this->addTextOnImage($destdir.'/akcijathumb3'.$res,'Nr. '.$cid);
								$this->addTextOnImage($destdir.'/akcija'.$res, 'AKCIJA',25,'akc');
								$this->addTextOnImage($destdir.'/akcijathumb1'.$res, 'AKCIJA',40,'akc');
								$this->addTextOnImage($destdir.'/akcijathumb3'.$res, 'AKCIJA',25,'akc');
						}
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
						
						
	
						
						  $query = 'INSERT INTO '.cms_db_prefix().'module_products_fieldvals (product_id, fielddef_id, value, create_date, modified_date, ord) VALUES (?,?,?,?,?,?)';
						  $db->Execute($query, array($cid, $fid, $res, trim($db->DBTimeStamp(time()), "'"), trim($db->DBTimeStamp(time()), "'"), $a));											
						  
                          $v = '';
                        }
				}	
								
				
				
				
			
			
			  break;
		      case 'subscription':
		      case 'dimensions':
			if( is_array($v) )
			  {
			    $v = serialize($v);
			  }
			break;
			
		      case 'checkboxgroup':
				foreach ($v as $a){
					$a = htmlspecialchars($a);
					$query = 'INSERT INTO '.cms_db_prefix().'module_products_fieldvals (product_id, fielddef_id, value, create_date, modified_date) VALUES (?,?,?,?,?)';
					$db->Execute($query, array($cid, $fid, $a, trim($db->DBTimeStamp(time()), "'"), trim($db->DBTimeStamp(time()), "'")));					
				}
				$v = '';
			  break;

			
		      case 'textarea':
				if( is_array($v) )
				  {
					$v = serialize($v);
				  }
				break;			  
		      case 'checkbox':
		      case 'dropdown':
			  case 'textbox':
			  case 'imagegroup':
			  case 'separator':

			  
		      case 'cars':
			break;

		      default:
			die("unknown type: ".$def->type);
			break;
		      }

		    // commit it.
		    if( !is_null($v) && !empty($v) )
		      {
				if ($k == 'field-56'){
					$v = str_replace(".", "-", $v);	$v = str_replace("/", "-", $v);
				
					$d = explode("-", $v);				
					if (!$d[1])
						$v = $v."-01";
				
					$v = strtotime($v);
				}
				if ($this->CheckPermission("Products_field_".$def->name." Edit")){  
				
					$query = 'INSERT INTO '.cms_db_prefix().'module_products_fieldvals (product_id, fielddef_id, value, create_date, modified_date) VALUES (?,?,?,?,?)';
					$db->Execute($query, array($cid, $fid, $v, trim($db->DBTimeStamp(time()), "'"), trim($db->DBTimeStamp(time()), "'")));
				}	
		      }elseif ($def->required){
			  
				echo $errors = $this->ShowErrors($this->Lang('hasempty')." (".$def->prompt.")");
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
	$module =& $this->GetModuleInstance('Search');
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

	
	$field = new stdClass();
	
	$field->name = "carmakers";
	$field->prompt = $this->Lang('automobilis')."*";
	$field->id = "carmakers";
	$field->type = "cars";
	
	if (!$value){
		$value = "vw";

		$c['pasirinkite']='Pasirinkite';
		
		$copts = $db->GetOne('SELECT options FROM '.cms_db_prefix().'module_products_carsdefs
				   WHERE name = ?', array(vw));	

			   
		$copts =  explode("\n", $copts); 
		
		
		$fvals['Pasirinkite'] = '';
		foreach ($copts as $copt){
			$fvals[$copt] = $copt;
		}
		
		$c = $fvals;
		
	}else
		$c['pasirinkite']='Pasirinkite';

	
	$field->input_box = $this->CreateInputDropdown($id, 'customfield[field-cars]', $cars['carmakers_prompt'], -1, $value, 'id="gamintojas" onchange="loadmodels(this.value)"' );
	$fieldarray[] = $field;
	
	
	
	$field = new stdClass();
	
	$field->name = "carmodels";
	$field->prompt = $this->Lang('modelis')."*";
	$field->id = "carmodels";
	$field->type = "cars";
	

			   	
	
	
	$field->input_box = $this->CreateInputDropdown($id, 'customfield[field-models]', $c, -1, $value, 'id="modelis" ');
	$fieldarray[] = $field;	
	
	


	
	
	
	

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
	$field->paaiskinimas = $fielddef->paaiskinimas;
	$field->required = $fielddef->required;
	$field->prompt = $fielddef->prompt;
	$field->type = $fielddef->type;
	
	
	if ($this->CheckPermission("Products_field_".$def->name." Read") && !$this->CheckPermission("Products_field_".$def->name." Edit"))
		$rm = " disabled";
	else
		$rm='';	
	
	if ($fielddef->required)
		$addi = "req $rm";	
	else
		$addi = $rm;	
	
	
	switch ($fielddef->type)
	  {
	  case 'dimensions':
	    $field->prompt .= '&nbsp;('.product_ops::get_length_units().')';
	    $field->input_box = 
	      $this->Lang('abbr_length').':&nbsp'.
	      $this->CreateInputText($id,'customfield[field-'.$fielddef->id.'][length]',
				     $value,3,3).
	      $this->Lang('abbr_width').':&nbsp'.
	      $this->CreateInputText($id,'customfield[field-'.$fielddef->id.'][width]',
				     $value,3,3).
	      $this->Lang('abbr_height').':&nbsp'.
	      $this->CreateInputText($id,'customfield[field-'.$fielddef->id.'][height]',
				     $value,3,3);
	    break;
	  case 'checkbox':
	    $field->input_box = '<input type="hidden" name="' . $id . 'customfield[field-'.$fielddef->id.']' . '" value="false" />'.$this->CreateInputCheckbox($id, 'customfield[field-'.$fielddef->id.']', 'true', $value == 'true', $rm);
	    break;
	  case 'separator':
		break;
	  case 'textarea':
		$field->input_box = "<table><tr>";
	  
		$kalbos = $this->GetPreference('kalbos', 'lt');
		$kalbos = explode(',', $kalbos);	  
	  
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
	  case 'dropdown':
	    $field->input_box = $this->CreateInputDropdown($id, 'customfield[field-'.$fielddef->id.']', $fielddef->options, -1, $value, $addi );
	    break;		
	  case 'file':
	    $field->input_box = $this->CreateFileUploadInput($id,'customfield[field-'.$fielddef->id.']','',50);
	    $field->hidden = $this->CreateInputHidden($id,'customfield[field-'.$fielddef->id.']','');
	  case 'image':
            if( $this->GetPreference('autowatermark') == 'adjustable' )
              {
                $field->attribute = $this->Lang('watermark_location').'&nbsp;'.
                    $this->CreateInputDropdown($id,'customfield_attr[field-'.$fielddef->id.']',$wmopts,-1,'default',$rm);
              }
	    $field->input_box = $this->CreateFileUploadInput($id,'customfield[field-'.$fielddef->id.']',$rm,50);
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
		
		$checkboxai = unserialize($fielddef->optionslng);
		$z=0;
		
		$field->input_box = '<table><tr>';
		
		foreach($checkboxai as $chkbx){
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
	  
	  case 'imagegroup':
		
            if( $this->GetPreference('autowatermark') == 'adjustable' )
              {
                $field->attribute = $this->Lang('watermark_location').'&nbsp;'.
                    $this->CreateInputDropdown($id,'customfield_attr[field-'.$fielddef->id.']',$wmopts,-1,'default',$rm);
              }
		
		
		$field->input_box = '<table><tr>';
		$kiek = $fielddef->kiekis;
		$z=0;
		for($i=1; $i<=$kiek; $i++){		
			$z++;
		
			
			$zop = ' style="width: 250px"';   
		
			$field->input_box .= "<td style='width: 200px'>".$this->CreateFileUploadInput($id,'customfield[field-'.$fielddef->id.'][]',$rm.$zop,50);
			$field->hidden .= $this->CreateInputHidden($id,'customfield[field-'.$fielddef->id.'][]','')."</td>";						
			
			if ($z == 2){
				$field->input_box .= '</tr><tr>';
				$z=0;
			}					
			
			
		}
		
		$field->input_box .= '</tr></table>';
	  
	  
	  break;	  
	  
	  case 'textbox':
	  default:
	    $field->input_box = $this->CreateInputText($id, 'customfield[field-'.$fielddef->id.']', $value, 30, 255,  $addi, $fielddef->name);
	    break;
	  }
	$fieldarray[] = $field;
      }
  }

$categories = $this->GetCategories();
$catarray = array();

if (count($categories) > 0)
  {
    foreach ($categories as $fielddef)
      {
        $catarray[$fielddef->name] = $fielddef->id;
      }
  }

#Display template
$this->smarty->assign('startform', $this->CreateFormStart($id, 'addproduct', $returnid, 'post', 'multipart/form-data'));
$this->smarty->assign('endform', $this->CreateFormEnd());
$this->smarty->assign('nametext', $this->Lang('name'));
$this->smarty->assign('inputname', $this->CreateInputText($id, 'product_name', $product_name, 30, 255));
$this->smarty->assign('pricetext', $this->Lang('price'));
$this->smarty->assign('inputprice', $this->CreateInputText($id, 'price', $price, 8, 12));
$smarty->assign('currency_symbol',product_ops::get_currency_symbol());
$this->smarty->assign('weighttext', $this->Lang('weight'));
$this->smarty->assign('inputweight', $this->CreateInputText($id, 'weight', $weight, 8, 12));

$this->smarty->assign('inputsku',$this->CreateInputText($id,'sku',$sku,10,25));
$this->smarty->assign('inputalias',$this->CreateInputText($id,'alias',$alias,18,255));
$this->smarty->assign('weightunits',product_ops::get_weight_units());
$this->smarty->assign('detailstext', $this->Lang('details'));
$this->smarty->assign('inputdetails', $this->CreateTextArea(true, $id, $details, 'details', '', '', '', '', '80', '5'));

if( count($catarray) > 0 )
  {
    $smarty->assign('input_categories',
      $this->CreateInputSelectList($id,'categories[]',$catarray));
  }


$smarty->assign('sinchautoplius',
		$this->CreateInputCheckbox($id,'sinchautoplius',1,$sinchautoplius));

$hierarchy_items = $this->BuildHierarchyList();
$smarty->assign('hierarchy_items',$hierarchy_items);
$smarty->assign('hierarchy_pos',isset($params['hierarchy'])?$params['hierarchy']:-1);

$statuses = array($this->Lang('published')=>'published',
		  $this->Lang('reserved')=>'reserved',
		  $this->Lang('rented')=>'rented',
		  $this->Lang('draft')=>'draft',		  
		  $this->Lang('sold')=>'sold',
		  $this->Lang('disabled')=>'disabled');
		  
if ($this->CheckPermission("Products_change_status Use")){		  
$smarty->assign('statustext',$this->Lang('status'));
$smarty->assign('inputstatus',
		$this->CreateInputDropdown($id,'status',
					   $statuses,-1,$status,' style="width: 150px"'));
}else{
$smarty->assign('inputstatus',
		$this->CreateInputHidden($id,'status','draft'));
}
					   
$this->smarty->assign('hidden', '');
$this->smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', lang('submit'), "onclick='javascript:if(checkf()){return true}else{return false}'"));
$this->smarty->assign('cancel', $this->CreateInputSubmit($id, 'cancel', lang('cancel'), "onclick='javascript:history.back(-1); return false;'"));
$this->smarty->assign_by_ref('customfields', $fieldarray);
$this->smarty->assign('customfieldscount', count($fieldarray));

echo $this->ProcessTemplate('editproduct.tpl');

?>
