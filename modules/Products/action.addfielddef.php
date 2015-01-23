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

$this->SetCurrentTab('fielddefs');
if (!$this->CheckPermission('Modify Products'))
{
	echo $this->ShowErrors($this->Lang('needpermission', array('Modify Products')));
	return;
}

if (isset($params['cancel']))
{
  $this->RedirectToTab($id);
}

$kalbos = $this->GetPreference('kalbos', 'lt');
$kalbos = explode(',', $kalbos);

$name = '';
if (isset($params['name']))
{
	$name = $params['name'];
}

$prompt = '';
if (isset($params['prompt']))
{
	$prompts = $params['prompt'];
	$prompt = $prompts['lt'];
}

$options = '';
if (isset($params['options']))
{
  $options = $params['options'];
}

$laukeliu_grupes = '';
if (isset($params['laukeliu_grupes']))
{
  $laukeliu_grupes = $params['laukeliu_grupes'];
}

$opt_file = '';
if (isset($params['opt_file'])) {
	$opt_file = $params['opt_file'];
}

$opt_link = '';
if (isset($params['opt_link'])) {
	$opt_link = $params['opt_link'];
}

$type = '';
if (isset($params['type']))
{
	$type = $params['type'];
}

$requ_lang = '';
if( isset($params['requ_lang']) )
  {
    $requ_lang = $params['requ_lang'];
  }  
  
  
$max_length = 255;
if (isset($params['max_length']))
{
  $max_length = (int)$params['max_length'];
}

$public = 1;
if( isset($params['public']) )
  {
    $public = (int)$params['public'];
  }

$userid = get_userid();

if (isset($params['submit']))
{
  if( $type == '' )
    {
      echo $this->ShowErrors($this->Lang('error_nofieldtype'));
    }
  else if ($name == '')
    {
      echo $this->ShowErrors($this->Lang('nonamegiven'));
    }
  else if( !$this->is_alias($name) )
    {
      echo $this->ShowErrors($this->Lang('error_invalid_name'));
    }
  else if( !empty($max_length) && !is_numeric($max_length) )
    {
      echo $this->ShowErrors($this->Lang('notanumber'));
    }
  else if( $type == 'subscription' && $db->GetOne('SELECT id FROM '.cms_db_prefix().'module_products_fielddefs WHERE type = ?',array($type)) )
    {
      echo $this->ShowErrors($this->Lang('error_onesubscriptionfield'));
    }
  else if( $type == 'quantity' && $db->GetOne('SELECT id FROM '.cms_db_prefix().'module_products_fielddefs WHERE type = ?',array($type)) )
    {
      echo $this->ShowErrors($this->Lang('error_onequantityfield'));
    }
  else
    {
		if ($type == "textbox"){
		 if(isset($params["requ_lang"]))
			$optlng = serialize(array('requ_lang'=>$params["requ_lang"]));
		 else
			$optlng = '';
	   }
		
		
		if ($type == "dropdown" || $type == "checkboxgroup"){
		
			$opt = '';		
			$optlng = array();
			
			$sw = sizeof($kalbos);
			$t=0;$f=0;$z=0;
			
			//echo '<pre>';
			//print_r($_POST);
			//print_r($_FILES); 
			
			
			foreach ($options as $k=>$option){
				if ($z==0){			
					$tst = 0;
					for ($i=0; $i<$sw; $i++){
						$nk = $k+$i;
						if (trim($options[$nk]))
							$tst = 1;
					}
				}
				
				if ($tst){
					if ($kalbos[$z] == "lt"){	
						if ($f)
							$addi = "\n";			
						$opt .= $addi."$option";					
						$f++;
					}
					
				$optlng[$t][$kalbos[$z]]=$option;
				}				
				
				$z++;
				
				if ($z == $sw){
					$z=0;		
					$t++;
				}
			}
			//print_r($optlng);
			//die;
			foreach($optlng as $kk => $val) {
				if (isset($_FILES['opt_file']['name'][$kk]) && $_FILES['opt_file']['error'][$kk] == 0) {
					
					$edd = explode('.', $_FILES['opt_file']['name'][$kk]);
					$edd = array_pop($edd);
					
					
					$path = $_SERVER['DOCUMENT_ROOT'].'/uploads/Products/fielddef/';
					umask(0);
					if (!file_exists($path)) {
						mkdir($path, 0777, true);
					}
					
					$filename = $name.'_'.$kk.'.'.$edd;
					move_uploaded_file($_FILES['opt_file']['tmp_name'][$kk], $path.$filename);
					
					$optlng[$kk]['file'] = $filename;
				}
			}
			
			foreach ($opt_link as $kk => $val) {
				$optlng[$kk]['link'] = $val;
			}
			
			
			$optlng = serialize($optlng);
			$options = $opt;
		}
		
		
		
      $max = $db->GetOne('SELECT max(item_order) + 1 FROM ' . cms_db_prefix() . 'module_products_fielddefs');
      if( !$max ) $max = 0;
      $query = 'INSERT INTO '.cms_db_prefix().'module_products_fielddefs (name, prompt, prompts, type, max_length, item_order, create_date, modified_date, public, options, optionslng,requ_lang, `group`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)';
	  
      $parms = array($name, $prompt, serialize($prompts), $type, $max_length, $max, 
		     trim($db->DBTimeStamp(time()), "'"), 
		     trim($db->DBTimeStamp(time()), "'"),
		     $public,$options, $optlng, $requ_lang, $laukeliu_grupes);
      $dbr = $db->Execute($query, $parms );
	 
	  $new_id = $db->Insert_ID();
	  if ($new_id > 0) {
		
		if ($type == 'image' || $type == 'textarea_multi') {
			$tsql = 'LONGTEXT';
		} else {
			$tsql = 'TEXT';
		}
		
		  $query2 = "ALTER TABLE `".cms_db_prefix()."module_products_fieldvals` ADD `value_".$new_id."` ".$tsql." CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL";
		  $db->Execute($query2);
	  }
	  
      if( !$dbr ) {
	echo "DEBUG: result = ".$db->ErrorMsg()."<br/>&nbsp;&nbsp;".$db->sql."<br/>"; die();
      }
      
      $this->RedirectToTab($id);
    }
}

#Display template
$smarty->assign('options',$options);
$smarty->assign('startform', 
		$this->CGCreateFormStart($id, 'addfielddef', $returnid));
$smarty->assign('endform', $this->CreateFormEnd());
$smarty->assign('inputname', $this->CreateInputText($id, 'name', $name, 30, 255));

$inputprompt = array();

foreach ($kalbos as $kalba){
	$inputprompt[$kalba] = $this->CreateInputText($id,"prompt[$kalba]",$prompts[$kalba],20,255);
}	

$smarty->assign("inputprompt",$inputprompt);
$smarty->assign('kalbos', $kalbos);

$laukeliu_grupes_p = $this->GetPreference('laukeliu_grupes', '');
if (!empty($laukeliu_grupes_p)) {
	$laukeliu_grupes_arr = array('' => '');
	$laukeliu_grupes_p = explode(',', $laukeliu_grupes_p);
	foreach ($laukeliu_grupes_p as $val) {
		$laukeliu_grupes_arr[$val] = $val;
	}
	$smarty->assign('input_laukeliu_grupes', $this->CreateInputDropdown($id, 'laukeliu_grupes', $laukeliu_grupes_arr, -1, $laukeliu_grupes ));
	//print_r($laukeliu_grupes_arr);
}

//$smarty->assign('inputprompt',$this->CreateInputText($id,'prompt',$prompt,50,255));
$smarty->assign('showinputtype', true);

$addtext = "onChange='this.form.submit()'";

$smarty->assign('inputtype', $this->GetTypesDropdown($id, 'type', $type, $addtext, true));
$smarty->assign('type',$type);

if( $type == 'textbox' )
  {
    $smarty->assign('inputmaxlength', $this->CreateInputText($id, 'max_length', $max_length, 30, 255));
  }

$smarty->assign('userviewtext',$this->Lang('public'));
$smarty->assign('input_userview',
		$this->CreateInputcheckbox($id, 'public', 1, $public));

$smarty->assign('requ_lang',$this->CreateInputcheckbox($id, 'requ_lang', 1, $params["requ_lang"]));	
		
$smarty->assign('hidden', '');
$smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', lang('submit')));
$smarty->assign('cancel', $this->CreateInputSubmit($id, 'cancel', lang('cancel')));

echo $this->ProcessTemplate('editfielddef.tpl');

?>