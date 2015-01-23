<?php



class Filelists extends CMSModule
{
  
	var $db;
	var $_FEU;
	var $_upload_type;
	var $_upload_type2;
	
	function __construct() {
		$this->db = $this->GetDb();
		$this->_FEU = $this->GetModuleInstance('FrontEndUsers');
		$this->_upload_type = 0;
		$this->_upload_type2 = 1;
		parent::__construct();
	}
	
	
  function GetName()
  {
    return 'Filelists';
  }
  
  function GetFriendlyName()
  {
    return $this->Lang('friendlyname');
  }

  
  function GetVersion()
  {
    return '0.9';
  }
  
  
  function GetHelp()
  {
    return $this->Lang('help');
  }
  
  
  function GetAuthor()
  {
    return 'Laurynas|Texus';
  }

  
  function GetAuthorEmail()
  {
    return 'info@texus.lt';
  }
  
  
  function GetChangeLog()
  {
    return $this->Lang('changelog');
  }
  
 
  function IsPluginModule()
  {
    return true;
  }

 
  function HasAdmin()
  {
    return true;
  }

 
  function GetAdminSection()
  {
    return 'content';
  }

  
  function GetAdminDescription()
  {
    return $this->Lang('moddescription');
  }

 
  function VisibleToAdminUser()
  {
    return $this->CheckPermission('Use Filelists');
  }
  
  
  function GetDashboardOutput() 
  {
	/*global $gCms;
	$db = &$gCms->GetDb();

	$rcount = $db->GetOne('select count(*) from '.cms_db_prefix().'module_filelists');
	
    return $this->Lang('dash_record_count',$rcount);*/
  }

  function GetNotificationOutput($priority=2) 
  {
	/*global $gCms;
	$db = &$gCms->GetDb();
	$rcount = $db->GetOne('select count(*) from '.cms_db_prefix().'module_filelists');
    if ($priority < 4 && $rcount == 0 )
      {
	  $ret = new stdClass;
	  $ret->priority = 2;
	  $ret->html=$this->Lang('alert_no_records');
	  return $ret;
      }  */
	return '';
  }

  
  function GetDependencies()
  {
    return array('FrontEndUsers'=>'1.0');
  }

  
  function MinimumCMSVersion()
  {
    return "1.9-beta1";
  }
  

  function MaximumCMSVersion()
  {
    return "2.0";
  }


  function SetParameters()
  {
	
	$this->RegisterModulePlugin();

   
	//$this->RegisterRoute('/filelists\/view\/(?P<filelist_id>[0-9]+)\/(?P<returnid>[0-9]+)$/',array('action'=>'default'));
	//$this->RegisterRoute('/filelists\/edit\/(?P<filelist_id>[0-9]+)\/(?P<returnid>[0-9]+)$/',array('action'=>'add_edit_front'));
	//$this->RegisterRoute('/filelists\/add\/(?P<returnid>[0-9]+)$/',array('action'=>'add_edit'));
	$this->RegisterRoute('/[Rr]eceptai\/edit\/(?P<filelist_id>[0-9]+)\/(?P<returnid>[0-9]+)$/', array('action'=>'add_edit_front'));
	$this->RegisterRoute('/[Rr]eceptai\/delete\/(?P<filelist_id>[0-9]+)\/(?P<returnid>[0-9]+)$/', array('action'=>'delete_front'));
	$this->RegisterRoute('/[Rr]eceptai\/view\/(?P<filelist_id>[0-9]+)\/(?P<returnid>[0-9]+)$/', array('action'=>'view_front'));
   
	
	$gCms = cmsms();
	$contentops = $gCms->GetContentOperations();
	$returnid = $contentops->GetDefaultContent();
	// The previous three lines are to get a returnid; many modules, like News, have a default
	// page in which to display detail views. In that case, the page_id would be used for returnid.
	
	// The next three lines are where we map the URL to our detail page.
	//$parms = array('action'=>'default','filelist_id'=>1,'returnid'=>$returnid);
	//$route = new CmsRoute('this/is/insanely/great/stuff',$this->GetName(),$parms,TRUE);
	//cms_route_manager::register($route);
	
   /*
    * 3. Security
    *
    */
   // Don't allow parameters other than the ones you've explicitly defined
   $this->RestrictUnknownParams();
  
   // syntax for creating a parameter is parameter name, default value, description
   $this->CreateParameter('filelist_id', -1, $this->Lang('help_filelists_id'));
   // filelists_id must be an integer
   $this->SetParameterType('filelist_id',CLEAN_INT);
   
   $this->CreateParameter('filename', '', $this->Lang('help_filename'));
   $this->SetParameterType('filename',CLEAN_STRING);
   
   $this->CreateParameter('location', '', $this->Lang('help_location'));
   $this->SetParameterType('location',CLEAN_STRING);
   
   $this->CreateParameter('location', '', $this->Lang('help_location'));
   $this->SetParameterType('location',CLEAN_STRING);
   
   $this->CreateParameter('location', '', $this->Lang('help_location'));
   $this->SetParameterType('location',CLEAN_STRING);
   
   $this->CreateParameter('user_nr', '', $this->Lang('help_user_nr'));
   $this->SetParameterType('user_nr',CLEAN_STRING);
   
   $this->CreateParameter('user_name', '', $this->Lang('help_user_name'));
   $this->SetParameterType('user_name',CLEAN_STRING);
   
   $this->CreateParameter('user_email', '', $this->Lang('help_user_email'));
   $this->SetParameterType('user_email',CLEAN_STRING);
   
   $this->CreateParameter('detail', '', $this->Lang('help_detail'));
   $this->SetParameterType('detail',CLEAN_STRING);
   
   $this->CreateParameter('cooking_course', '', $this->Lang('help_cooking_course'));
   $this->SetParameterType('cooking_course',CLEAN_STRING);
   
   $this->CreateParameter('short_desc', '', $this->Lang('help_short_desc'));
   $this->SetParameterType('short_desc',CLEAN_STRING);
   
   $this->CreateParameter('keywords', '', $this->Lang('help_keywords'));
   $this->SetParameterType('keywords',CLEAN_STRING);
   
   $this->CreateParameter('submit', '', $this->Lang('help_submit'));
   $this->SetParameterType('submit',CLEAN_STRING);
   
   $this->CreateParameter('active', '', $this->Lang('help_active'));
   $this->SetParameterType('active',CLEAN_INT);
   
   $this->CreateParameter('filelist_id_tmp', '', $this->Lang('help_filelist_id_tmp'));
   $this->SetParameterType('filelist_id_tmp',CLEAN_STRING);
   
   $this->CreateParameter('needs_registration', '', $this->Lang('help_needs_registration'));
   $this->SetParameterType('needs_registration',CLEAN_INT);
   
   $this->CreateParameter('cat_id', '', $this->Lang('help_cat_id'));
   $this->SetParameterType('cat_id',CLEAN_NONE);
   
   $this->CreateParameter('delete_file', '', $this->Lang('help_delete_file'));
   $this->SetParameterType('delete_file',CLEAN_INT);
   
   $this->CreateParameter('delete_file2', '', $this->Lang('help_delete_file2'));
   $this->SetParameterType('delete_file2',CLEAN_INT);
   
   $this->CreateParameter('date', '', $this->Lang('help_date'));
   $this->SetParameterType('date',CLEAN_STRING);
   
   $this->CreateParameter('date_end', '', $this->Lang('help_date_end'));
   $this->SetParameterType('date_end',CLEAN_STRING);
   
   $this->CreateParameter('time_start', '', $this->Lang('help_time_start'));
   $this->SetParameterType('time_start',CLEAN_STRING);
   
   $this->CreateParameter('time_end', '', $this->Lang('help_time_end'));
   $this->SetParameterType('time_end',CLEAN_STRING);
   
   $this->CreateParameter('name', '', $this->Lang('help_name'));
   $this->SetParameterType('name',CLEAN_STRING);
   
   $this->CreateParameter('email', '', $this->Lang('help_email'));
   $this->SetParameterType('email',CLEAN_STRING);
   
   $this->CreateParameter('workplace', '', $this->Lang('help_workplace'));
   $this->SetParameterType('workplace',CLEAN_STRING);
   
   $this->CreateParameter('questions', '', $this->Lang('help_questions'));
   $this->SetParameterType('questions',CLEAN_STRING);

   
   
   // module_message must be a string
   $this->CreateParameter('module_message','',$this->Lang('help_module_message'));
   $this->SetParameterType('module_message',CLEAN_STRING);

   // description must be a string
   $this->CreateParameter('description','',$this->Lang('help_description'));
   $this->SetParameterType('description',CLEAN_STRING);

   // explanation must be a string
   $this->CreateParameter('explanation','',$this->Lang('help_explanation'));
   $this->SetParameterType('explanation',CLEAN_STRING);

   /*
    * 4. Event Handling
    *
   
    Typical example: specify the originator, the event name, and whether or not
    the event is removable (used for one-time events)

    $this->AddEventHandler( 'Core', 'ContentPostRender', true );
    */
  }

  function GetEventDescription ( $eventname )
  {
    return $this->Lang('event_info_'.$eventname );
  }
  
 
  function GetEventHelp ( $eventname )
  {
    return $this->Lang('event_help_'.$eventname );
  }


 
  function InstallPostMessage()
  {
    return $this->Lang('postinstall');
  }

  
  function UninstallPostMessage()
  {
    return $this->Lang('postuninstall');
  }

 
  function UninstallPreMessage()
  {
    return $this->Lang('really_uninstall');
  }
  
  
  function _SetStatus($oid, $status) {
    //...
  }
	
	
	/*function DoAction($name,$id,$params,$returnid=''){
	//debug_display($params);
		global $gCms;
		//$smarty =& $gCms->GetSmarty();
		$this->module_id = $id;
		//$params['id'] = 1;
		$this->params = $params;
		parent::DoAction($name,$id,$params,$returnid);
	}*/

  
	/*
	active - 0 rodomi visus, 1 - rodomi tik aktyvus, 2 - rodomi aktyvus, o pasyvus tik tie kurie priklauso vartotojui
	inc_deleted - itraukti ir istrintus
	cat_id - 0 rodom visus, kitu atveju filtruojam pagal categorija
	user_id - 0 rodom visus, kitu atveju filtruojam pagal musu vartotoja
	
	*/
	private function GetFilelists($active = 1, $inc_deleted = false, $cat_id = 0, $user_id = 0, $search_text = '') {
		
		$q_j = array();
		$q_w = array();
		$q_q = array();
		
		if ($active == 1) {
			$q_w[] = " `A`.`active` = 1 ";
		} else if ($active == 2) {
			$q_w[] = " (`A`.`active` = 1) ";
		}
		if ($inc_deleted == false) {
			$q_w[] = " `A`.`deleted` = 0 ";
		}
		if ($cat_id > 0) {
			$q_j[] = " ".cms_db_prefix()."module_filelists_cats AS B ON B.filelist_id = A.id ";
			$q_w[] = " `B`.`cat_id` = ?";
			$q_q[] = $cat_id;
		}
		if ($user_id > 0) {
			$q_w[] = " `A`.`user_id` = ? ";
			$q_q[] = $user_id;
		}
		if (!empty($search_text)) {
			$q_w[] = " ( `A`.`filename` LIKE ? OR `A`.`detail` LIKE ?  OR `A`.`cooking_course` LIKE ? OR `A`.`short_desc` LIKE ? OR `A`.`keywords` LIKE ? ) ";
			$q_q[] = '%'.$search_text.'%';
			$q_q[] = '%'.$search_text.'%';
			$q_q[] = '%'.$search_text.'%';
			$q_q[] = '%'.$search_text.'%';
			$q_q[] = '%'.$search_text.'%';
		}
		
		$query = "SELECT A.* FROM ".cms_db_prefix()."module_filelists AS A ".((count($q_j) > 0)?" LEFT JOIN ".implode(" LEFT JOIN ", $q_j):'')." ".(count($q_w) > 0?" WHERE ".implode(" AND ", $q_w):"")." ORDER BY id ASC";
		
		$res = $this->db->GetArray($query, $q_q);
		//echo $this->db->sql;
		
		if (is_array($res) && count($res) > 0) {
			foreach($res as $key => $val) {
				
				/*$res[$key]['user'] = $this->_FEU->GetUserInfo($val['user_id'], true);
				if ($res[$key]['user'][0] == true) {
					$res[$key]['user_name'] = $this->_FEU->GetUserPropertyFull('vardas', $val['user_id']);
					$res[$key]['user_surename'] = $this->_FEU->GetUserPropertyFull('pavarde', $val['user_id']);
				}*/
				$res[$key]['files'] = $this->GetFiles($val['id'], 2);
				$res[$key]['files2'] = $this->GetFiles2($val['id'], 2);
			}
			return $res;
		}
		return false;
		
	}
	
	
	/*
	id - dokumento id
	active - rodyti tik aktyvius
	inc_deleted - rodyti ir istrintus
	*/
	private function GetFilelist($id, $active = true, $inc_deleted = false) {
		$q_j = array();
		$q_w = array();
		$q_q = array();
		
		$id = intval($id);
		
		if ($id > 0) {
			
			$q_w[] = " `A`.`id` = ? ";
			$q_q[] = $id;
			
			if ($active == true) {
				$q_w[] = " `A`.`active` = 1 ";
			}
			if ($inc_deleted == false) {
				$q_w[] = " `A`.`deleted` = 0 ";
			}
			
			$query = "SELECT A.* FROM ".cms_db_prefix()."module_filelists AS A ".((count($q_j) > 0)?" LEFT JOIN ".implode(" LEFT JOIN ", $q_j):'')." ".(count($q_w) > 0?" WHERE ".implode(" AND ", $q_w):"")." LIMIT 1";
			
			$res = $this->db->GetRow($query, $q_q);
			
			
			if (is_array($res) && count($res) > 0) {
				
				/*$res['user'] = $this->_FEU->GetUserInfo($res['user_id'], true);
				if ($res['user'][0] == true) {
					$res['user_name'] = $this->_FEU->GetUserPropertyFull('vardas', $res['user_id']);
					$res['user_surename'] = $this->_FEU->GetUserPropertyFull('pavarde', $res['user_id']);
				}*/
				
				$res['files'] = $this->GetFiles($res['id'], 2);
				$res['files2'] = $this->GetFiles2($res['id'], 1);
				
				return $res;
			}
		}
		
		return false;
	}
	
	/*
	id - modulio id
	filelist_id - filelisto id
	params - parametrai
	*/
	public function InsertUpdate($id, $filelist_id = 0, $params) {
		$allow = false;
		$send_admin = false;
		$send_user = false;
		
		if (isset($params['admin'])) {
			$admin = $params['admin'];
		} else {
			$admin = false;
		}
		if (check_login(true)) {
			$allow = true;
		} else if ($filelist_id == 0) {
			$allow = true;
		}
		if ($allow === true) {
			
			/*echo '<pre>';
			print_r($params);
			echo '</pre>';
			die;*/
			
			if ($filelist_id > 0) {
				
				$filelist_old = $this->GetFilelist($filelist_id, false, true);
				//print_r($filelist_old); die;
				$query = "UPDATE ".cms_db_prefix()."module_filelists SET filename = ?, `date` = ?, date_end = ?, time_start = ?, time_end = ?, location = ?, detail = ?, cooking_course = ?, short_desc = ?, keywords = ?, active = ?, needs_registration = ?, deleted = ?, user_id = ?, user_name = ?, user_email = ?, user_nr = ?, file2 = ? WHERE id = ?";
				$this->db->Execute($query, array(
					(!empty($params['filename'])?$params['filename']:''),
					((!empty($params['date']) && $params['date']!='0000-00-00')?$params['date']:$filelist_old['date']),
					((!empty($params['date_end']) && $params['date_end']!='0000-00-00')?$params['date_end']:'0000-00-00'),
					((!empty($params['time_start']) && $params['time_start']!='00:00:00')?$params['time_start'].':00':'00:00:00'),
					((!empty($params['time_end']) && $params['time_end']!='00:00:00')?$params['time_end'].':00':'00:00:00'),
					(!empty($params['location'])?$params['location']:''),
					(!empty($params['detail'])?$params['detail']:''),
					(!empty($params['cooking_course'])?$params['cooking_course']:''),
					(!empty($params['short_desc'])?$params['short_desc']:''),
					(!empty($params['keywords'])?$params['keywords']:''),
					(!empty($params['active'])?$params['active']:'0'),
					(!empty($params['needs_registration'])?$params['needs_registration']:'0'),
					(!empty($params['deleted'])?$params['deleted']:'0'),
					(!empty($params['user_id'])?$params['user_id']:''),
					(!empty($params['user_name'])?$params['user_name']:''),
					(!empty($params['user_email'])?$params['user_email']:''),
					(!empty($params['user_nr'])?$params['user_nr']:''),
					(!empty($params['file2'])?$params['file2']:''),
					$filelist_id
				));
				//echo $this->db->sql; die;
				
				
				if ($admin == true) {
					$send_user = true;
				} else if ($admin === false) {
					$send_admin = 1;
				}
				
			} else {
				//print_r($params); die;
				$query = "INSERT INTO ".cms_db_prefix()."module_filelists SET filename = ?, cr_date = NOW(), `date` = ?, date_end = ?, time_start = ?, time_end = ?, location = ?, detail = ?, cooking_course = ?, short_desc = ?, keywords = ?, active = ?, needs_registration = ?, deleted = ?, user_id = ?, user_name = ?, user_email = ?, user_nr = ?, file2 = ?";
				$this->db->Execute($query, array(
					(!empty($params['filename'])?$params['filename']:''),
					((!empty($params['date']) && $params['date']!='0000-00-00')?$params['date']:date('Y-m-d')),
					((!empty($params['date_end']) && $params['date_end']!='0000-00-00')?$params['date_end']:'0000-00-00'),
					((!empty($params['time_start']) && $params['time_start']!='00:00:00')?$params['time_start'].':00':'00:00:00'),
					((!empty($params['time_end']) && $params['time_end']!='00:00:00')?$params['time_end'].':00':'00:00:00'),
					(!empty($params['location'])?$params['location']:''),
					(!empty($params['detail'])?$params['detail']:''),
					(!empty($params['cooking_course'])?$params['cooking_course']:''),
					(!empty($params['short_desc'])?$params['short_desc']:''),
					(!empty($params['keywords'])?$params['keywords']:''),
					(!empty($params['active'])?$params['active']:'0'),
					(!empty($params['needs_registration'])?$params['needs_registration']:'0'),
					(!empty($params['deleted'])?$params['deleted']:'0'),
					(!empty($params['user_id'])?$params['user_id']:''),
					(!empty($params['user_name'])?$params['user_name']:''),
					(!empty($params['user_email'])?$params['user_email']:''),
					(!empty($params['user_nr'])?$params['user_nr']:''),
					(!empty($params['file2'])?$params['file2']:'')
				));
				
				$filelist_id = $this->db->Insert_ID();
				
				$this->AssignImages($filelist_id, $params['filelist_id_tmp']);
				
				
				$this->AddFileSize($filelist_id);
				
				
				if ($admin === false) {
					$send_admin = 2;
				}
				
			}
			
			if ($this->GetFilelist($filelist_id, true, false) === false || $admin == true) {// leidziam keist kategorijas tik jei adminas, arba irasas neaktyvus
				$this->DeleteCats($filelist_id);
				if (isset($params['cat_id'])) {
					$this->AddCats($params['cat_id'], $filelist_id);
				}
			}
			
			/*if ($admin == true) {
				$this->DeleteCats($filelist_id);
				if (isset($params['cat_id'])) {
					$this->AddCats($params['cat_id'], $filelist_id);
				}
			} else {
				$cats_check = $this->GetCats($filelist_id);
				if (count($cats_check) == 0) {
					$this->AddCats($params['cat_id'], $filelist_id);
				}
			}*/
			
			$module = $this->GetModuleInstance('Search');
			if ($module != FALSE) {
				$module->DeleteWords($this->GetName(), $filelist_id, 'Filelist');
				if ($this->GetFilelist($filelist_id, true, false) !== false) {
					$module->AddWords($this->GetName(), $filelist_id, 'Filelist', implode(' ', $this->GetSearchableText($filelist_id) ));
				}
			}
			
			
			
			if ($send_admin != false) {
				if ($send_admin == 1) {
					//$this->InformAdmin($filelist_id, 1);
				} else {
					//$this->InformAdmin($filelist_id);
				}
			} else if ($send_user == true) {
				//$this->InformUser($filelist_id, $params['admin_msg']);
			}
			
			//$this->InformRegistred($filelist_id);
			//$this->SyncGoogle($filelist_id);
			
			
			return $filelist_id;
		}
		return false;
	}
	
	private function AddFileSize($filelist_id) {
		$other_files = $this->GetFiles($filelist_id, 0);
		
		$path = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$this->GetName().'/filelist'.$filelist_id.'/';
		if (is_array($other_files) && count($other_files) > 0) {
			$size = filesize($path.$other_files[0]);
			$text_size = $this->FileSizeConvert($size);
			
			$query = "UPDATE ".cms_db_prefix()."module_filelists SET file_size = ? WHERE id = ?";
			$this->db->Execute($query, array($text_size, $filelist_id));
			return true;
		}
		
		
		return false;
	}
	
	private function AssignImages($filelist_id, $filelist_id_tmp) {
		if ($filelist_id > 0 && !empty($filelist_id_tmp))  {
			
			$path1 = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$this->GetName().'/filelist'.$filelist_id_tmp.'/';
			$path2 = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$this->GetName().'/filelist'.$filelist_id.'/';
			
			rename($path1, $path2);
			
			return false;
		}
		return false;
	
	}
	
	private function InformRegistred($filelist_id) {
		global $gCms;
		$config = $this->GetConfig();
		$filelist = $this->GetFilelist($filelist_id, false);
		if ($filelist != false) {
			
			$cats = $this->GetCats($filelist_id);
			
			$reg_emails = $this->GetRegListArr($filelist_id);

			
			if (is_array($reg_emails) && count($reg_emails) > 0) {
				
				$cmsmailer = $this->GetModuleInstance('CMSMailer');
				
				
				$this->smarty->assign('filelist', $filelist);
				$this->smarty->assign('prenum_subject', $this->Lang("register_subject"));
				$this->smarty->assign('register_filelist_text', $this->Lang("register_filelist_text"));
				$this->smarty->assign('creator', $this->Lang("creator"));
				
				
				foreach ($reg_emails as $sub){
					
					
					$cmsmailer->AddAddress($sub['email']);
					
					$link = '';
					$link2 = '';
					
					$prettyurl = $this->GetFilelistPrettyUrl('view_front', array('returnid' => $cats[0], 'filelist_id' => $filelist['id']));
					$link = $this->CreateLink($id, 'view_front', $cats[0], '', array(), '', true, false, '', false, $prettyurl);
					
					$this->smarty->assign('link', $link);
					$this->smarty->assign('link_title', $this->Lang('link_title_register'));
					$this->smarty->assign('user_status', $this->Lang("user_status"));
					$this->smarty->assign('user_status_val', $this->Lang("user_status_val".$filelist['active']));
					
					
					$msg = $this->ProcessTemplate('mail_registred.tpl');
					
					$cmsmailer->SetBody($msg);
					$cmsmailer->IsHTML(true);
					$cmsmailer->SetSubject($this->Lang("register_subject"));
					
					$r = $cmsmailer->Send();
					
					
					$cmsmailer->reset();
					
				}
				
			}
		
		}
		
		return false;
	}
	
	private function InformAdmin($filelist_id, $update = 0) {
		global $gCms;
		$config = $this->GetConfig();
		$filelist = $this->GetFilelist($filelist_id, false);
		if ($filelist != false) {
			//echo $filelist_id; die;
			
			$admin_emails = $this->GetPreference('admin_email', '');
			
			$admin_emails = explode(',', $admin_emails);
			
			//echo '<pre>';
			//print_r($filelist);
			//die;
			
			if (is_array($admin_emails) && count($admin_emails) > 0) {
				
				$cmsmailer = $this->GetModuleInstance('CMSMailer');
				
				//$hm = $gCms->GetHierarchyManager();
				
				$this->smarty->assign('filelist', $filelist);
				$this->smarty->assign('admin_filelist_backendlink', $this->Lang("admin_filelist_backendlink"));
				$this->smarty->assign('backendlink', $config['root_url'].'/admin/moduleinterface.php?mact='.$this->GetName().',m1_,editfilelist,0&_sx_=from_outside&m1_filelist_id='.$filelist['id']);
				$this->smarty->assign('prenum_subject', $this->Lang("admin_subject".$update));
				$this->smarty->assign('admin_filelist_text', $this->Lang("admin_filelist_text".$update));
				$this->smarty->assign('creator', $this->Lang("creator"));
				
				
				//$this->_FEU->GetUserInfo($filelist['user_id'], true);
				
				foreach ($admin_emails as $sub){
					
					
					$cmsmailer->AddAddress($sub);
					
					$link = '';
					$link2 = '';
					
					
					//$this->smarty->assign('link', $link);
					//$this->smarty->assign('link_title', $this->Lang('link_title'));
					//$this->smarty->assign('download_link_title', $this->Lang('download_link_title'));
					//if (!empty($filelist['file'])) {
					//	$this->smarty->assign('download_link', $config['root_url'].'/download.php?action=FilelistGetFile&id='.$filelist['id']);
					//}
					
					
					$msg = $this->ProcessTemplate('mail_admin.tpl');
					
					$cmsmailer->SetBody($msg);
					$cmsmailer->IsHTML(true);
					$cmsmailer->SetSubject($this->Lang("admin_subject".$update));
					
					$cmsmailer->Send();
					
					$cmsmailer->reset();
					
				}
				
			}
		
		}
		
		return false;
	}
	
	private function InformUser($filelist_id, $admin_msg = '') {
		global $gCms;
		$config = $this->GetConfig();
		$filelist = $this->GetFilelist($filelist_id, false);
		if ($filelist != false) {
			//echo $filelist_id; die;
			
			$cats = $this->GetCats($filelist_id);
			/*
			echo '<pre>';
			print_r($filelist);
			die;
			*/
			if (!empty($filelist['user_email'])) {
				
				$cmsmailer = $this->GetModuleInstance('CMSMailer');
				
				//$hm = $gCms->GetHierarchyManager();
				
				$this->smarty->assign('filelist', $filelist);
				$this->smarty->assign('prenum_subject', $this->Lang("user_subject"));
				$this->smarty->assign('user_filelist_text', $this->Lang("user_filelist_text"));
				$this->smarty->assign('user_status', $this->Lang("user_status"));
				$this->smarty->assign('user_status_val', $this->Lang("user_status_val".$filelist['active']));
				$this->smarty->assign('admin_msg_title', $this->Lang('user_admin_msg_title'));
				$this->smarty->assign('admin_msg', $admin_msg);
				
				
				//$this->_FEU->GetUserInfo($filelist['user_id'], true);
				
				
					
				
				$cmsmailer->AddAddress($filelist['user_email']);
				
				$link = '';
				$link2 = '';
				
				
				$prettyurl = $this->GetFilelistPrettyUrl('view_front', array('returnid' => $cats[0], 'filelist_id' => $filelist['id']));
				$link = $this->CreateLink($id, 'view_front', $cats[0], '', array(), '', true, false, '', false, $prettyurl);
				
				$this->smarty->assign('link', $link);
				$this->smarty->assign('link_title', $this->Lang('link_title'));
				//$this->smarty->assign('download_link_title', $this->Lang('download_link_title'));
				//if (!empty($filelist['file'])) {
				//	$this->smarty->assign('download_link', $config['root_url'].'/download.php?action=FilelistGetFile&id='.$filelist['id']);
				//}
				
				
				$msg = $this->ProcessTemplate('mail_user.tpl');
				
				$cmsmailer->SetBody($msg);
				$cmsmailer->IsHTML(true);
				$cmsmailer->SetSubject($this->Lang("user_subject"));
				
				$cmsmailer->Send();
				
				$cmsmailer->reset();
				
			
				
			}
		
		}
		
		return false;
	}
	
	private function SendPrenum($filelist_id) {
		/*global $gCms;
		$config = $this->GetConfig();
		$filelist = $this->GetFilelist($filelist_id);
		
		if ($filelist != false && $filelist['prenum_sent'] == 0) {
			
			$cats = $this->GetCats($filelist_id);
			
			$subscribers = $this->GetSubscribers($cats);
			
			//echo '<pre>';
			//print_r($filelist);
			//die;
			
			if (is_array($subscribers) && count($subscribers) > 0) {
				
				$cmsmailer = $this->GetModuleInstance('CMSMailer');
				//echo 'zzz'; die;
				$hm = $gCms->GetHierarchyManager();
				
				$this->smarty->assign('filelist', $filelist);
				$this->smarty->assign('prenum_subject', $this->Lang("prenum_subject"));
				$this->smarty->assign('new_filelist_text', $this->Lang("new_filelist_text"));
				$this->smarty->assign('creator', $this->Lang("creator"));
				
				
				foreach ($subscribers as $key => $sub){
					if ($sub['info'][0] == 1 && $key != $filelist['user_id']) {
						
						$cmsmailer->AddAddress($sub['info'][1]['username']);
						
						$link = '';
						$link2 = '';
						
						$node = $hm->sureGetNodeById($sub['cats'][0]);
						if($node) {
							$content_obj =& $node->getContent();
							if ($content_obj) {
								$link = $content_obj->GetURL();
							}
						}
						
						$this->smarty->assign('link', $link);
						$this->smarty->assign('link_title', $this->Lang('link_title'));
						$this->smarty->assign('download_link_title', $this->Lang('download_link_title'));
						if (!empty($filelist['file'])) {
							$this->smarty->assign('download_link', $config['root_url'].'/download.php?action=FilelistGetFile&id='.$filelist['id']);
						}
						
						
						$msg = $this->ProcessTemplate('mail_prenum.tpl');
						
						$cmsmailer->SetBody($msg);
						$cmsmailer->IsHTML(true);
						$cmsmailer->SetSubject($this->Lang("prenum_subject"));
						
						$cmsmailer->Send();
						
						$cmsmailer->reset();
					}
				}
				
			}
			
			$query = "UPDATE ".cms_db_prefix()."module_filelists SET prenum_sent = 1 WHERE id = ? ";
			$this->db->Execute($query, array($filelist_id));
		
		}
		
		return false;*/
		
		//gal nebus????
	}
	
	private function GetSubscribers($cats) {
		/*if (is_array($cats) && count($cats) > 0) {
			
			$query = "SELECT user_id, cat_id FROM ".cms_db_prefix()."module_filelists_prenum WHERE cat_id = ".implode(' OR cat_id = ', $cats)."";
			$user_ids = $this->db->GetArray($query);
			
			$subscribers = array();
			//echo $this->db->sql; die;
			if (is_array($user_ids) && count($user_ids) > 0) {
				foreach ($user_ids as $val) {
					if (isset($subscribers[$val['user_id']])) {
						$subscribers[$val['user_id']]['cats'][] = $val['cat_id'];
					} else {
						$subscribers[$val['user_id']] = array(
							'cats' => array($val['cat_id']),
							'info' => $this->_FEU->GetUserInfo($val['user_id'], true)
						);
						
							
					}
				}
			}
			if (count($subscribers) > 0) {
				return $subscribers;
			}
		}
		return false;*/
	}
	
	private function GetContents($par_id, &$pages, $level, $admin = false, $full = false) {
		$par_id = intval($par_id);
		if ($par_id > 0) {
			
			if ($admin == false) {
				$uid = $this->_FEU->LoggedInId();
				$groups = $this->_FEU->GetMemberGroupsArray($uid);
			}
			
			$sql_add = " A.parent_id = ? AND A.`type` != 'sectionheader' AND A.`type` != 'pagelink' ";
			if ($level == 0) {
				$sql_add = " (A.content_id = ?) ";
			}
			
			$query = "SELECT A.content_id, A.content_name, A.menu_text, A.parent_id, B.prop_name AS prop_name,B.content AS prop_content FROM ".cms_db_prefix()."content AS A LEFT JOIN ".cms_db_prefix()."content_props AS B ON (B.content_id = A.content_id AND B.prop_name = '__feu_date__') WHERE ".$sql_add." AND A.active = 1";
			
			
			$arr = $this->db->GetArray($query, array($par_id));
			
			//echo $this->db->sql;
			if (is_array($arr) && count($arr) > 0) {
				foreach ($arr as $val) {
					$allow = false;
					if ($admin == false) {
						if ($val['prop_name'] == '__feu_date__') {
							if ($uid > 0) {
								//viesi
								
								if (!empty($val['prop_content'])) {
									
									$rules = unserialize($val['prop_content']);
									$rules = $rules['groups'];
									foreach ($groups as $val2) {
										if (in_array($val2['groupid'], $rules)) {
											$allow = true;
											break;
										}
									}
								} else {
									$allow = true;
								}
							}
						} else {
							$allow = true;
						}
					} else {
						$allow = true;
					}
					if ($allow == true) {
						if ($full == false) {
							foreach ($pages as $k => $v) {
								if ($v == $val['parent_id']) {
									unset($pages[$k]);
								}
							}
						}
						$pages[str_repeat(' - ', $level).(!empty($val['menu_text'])?$val['menu_text']:$val['content_name'])] = $val['content_id'];
						//print_r($pages);
						//echo '<br/>';
						$this->GetContents($val['content_id'], $pages, $level+1, $admin, $full);
						
					}
				}
				return true;
			}
		}
		return false;
	}
	
	private function DeleteFilelist($filelist_id, $admin = false) {
		
		$filelist_id = intval($filelist_id);
		if ($filelist_id > 0) {
			if ($admin == true) {
				
				$query = "DELETE FROM ".cms_db_prefix()."module_filelists WHERE id = ? LIMIT 1";
				$this->db->Execute($query, array($filelist_id));
				
				$this->DeleteCats($filelist_id);
				
				$path = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$this->GetName().'/filelist'.$filelist_id.'/';
				
				$files = glob($path.'*');
				if (is_array($files) && count($files) > 0) {
					foreach($files as $file) {  
						if(is_file($file)) {
							unlink($file); 
						}
					}
				}
				
				
			} else if ($this->isOwner($filelist_id)) {
				$query = "UPDATE ".cms_db_prefix()."module_filelists SET deleted = 1 WHERE id = ? LIMIT 1";
				$this->db->Execute($query, array($filelist_id));
				return true;
			}
		}
		return false;
	}
	
	private function GetSearchableText($filelist_id) {
		$filelist = $this->GetFilelist($filelist_id, true, false);
		
		if ($filelist !== false) {
			$results = array();
			$results[] = $filelist['filename'];
			$results[] = $filelist['short_desc'];
			$results[] = $filelist['keywords'];
			//print_r($results); die;
			return $results;
		}
		return array();
	}
	
	//publics:
	
	public function SearchResult($returnid, $filelist_id, $attr = '') {
		global $gCms;
		//$smarty = cmsms()->GetSmarty();
		//$kalba = $this->smarty->get_template_vars('kalba');
		
		//$additiona = $this->GetFieldDefsForProduct($productid);
		//$ret = product_ops::get_search_result($returnid,$productid,$attr, $kalba);
		//$ret[3] = $additiona;
		
		
		$query = "SELECT A.filename, B.cat_id FROM ".cms_db_prefix()."module_filelists AS A LEFT JOIN ".cms_db_prefix()."module_filelists_cats AS B ON B.filelist_id = A.id WHERE A.id = ? AND A.active = 1 AND A.deleted = 0 LIMIT 1";
		$r = $this->db->GetRow($query, array($filelist_id));
		
		$ret = array();
			//echo $this->db->sql;
		if (is_array($r) && count($r) > 0) {
			$ret[0] = $this->GetFriendlyName();
			$ret[1] = $r['filename'];
			
			$hm = $gCms->GetHierarchyManager();
			$node = $hm->sureGetNodeById($r['cat_id']);
			if($node) {
				$content_obj =& $node->getContent();
				if ($content_obj) {
					$ret[2] = $content_obj->GetURL();
				}
			}
		}
		//$ret[2] = $this->();//$contentobj->GetURL()
		
		return $ret;
	}
	
	public function UnSubScribe($cat_id) {
		/*$cat_id = intval($cat_id);
		$uid = $this->_FEU->LoggedInId();
		
		if ($uid > 0 && $cat_id > 0) {
			if ($this->IsSubscribed($cat_id)) {
				$query = "DELETE FROM ".cms_db_prefix()."module_filelists_prenum WHERE user_id = ? AND cat_id = ?";
				$this->db->Execute($query, array($uid, $cat_id));
				return 0;
			} else {
				$query = "INSERT INTO ".cms_db_prefix()."module_filelists_prenum SET user_id = ?, cat_id = ?";
				$this->db->Execute($query, array($uid, $cat_id));
				return 1;
			}
		}
		return false;*/
	}
	
	public function IsSubscribed($cat_id) {
		/*$cat_id = intval($cat_id);
		$uid = $this->_FEU->LoggedInId();
		
		if ($uid > 0 && $cat_id > 0) {
			$query = "SELECT id FROM ".cms_db_prefix()."module_filelists_prenum WHERE user_id = ? AND cat_id = ?";
			$id = $this->db->GetOne($query, array($uid, $cat_id));
			
			if ($id > 0) {
				return true;
				
			}
		}
		
		return false;*/
	}
	
	public function GetCats($filelist_id) {
		if ($filelist_id > 0) {
			$query = "SELECT cat_id FROM ".cms_db_prefix()."module_filelists_cats WHERE filelist_id = ?";
			$res = $this->db->GetCol($query, array($filelist_id));
			if (is_array($res) && count($res) > 0) {
				//print_r($res)
				return $res;
			}
		}
		return array();
	}
	
	public function DeleteCats($filelist_id) {
		$filelist_id = intval($filelist_id);
		if ($filelist_id > 0) {
			$query = "DELETE FROM ".cms_db_prefix()."module_filelists_cats WHERE filelist_id = ?";
			$this->db->Execute($query, array($filelist_id));
			return true;
		}
		return false;
	}
	
	public function AddCats($cat_id, $filelist_id) {
		$filelist_id = intval($filelist_id);
		if (is_array($cat_id) && count($cat_id) > 0 && $filelist_id > 0) {
			foreach ($cat_id as $c_id) {
				$query = "INSERT INTO ".cms_db_prefix()."module_filelists_cats SET filelist_id = ?, cat_id = ?";
				$this->db->Execute($query, array($filelist_id, $c_id));
			}
			return true;
		}
		return false;
	}		
	
	public function GetContentsAdmin($par_id, &$pages){
		return $this->GetContents($par_id, $pages, 0, true);
	}
	
	public function GetContentsFront($par_id, &$pages) {
		return $this->GetContents($par_id, $pages, 0);
	}
	
	public function GetFilelistsAdmin($params = array()){
		if (count($params) > 0) {
			return $this->GetFilelists(0, true, ($params['cat_id'] > 0?$params['cat_id']:0), ($params['user_id'] > 0?$params['user_id']:0), (!empty($params['search_field'])?$params['search_field']:''));
		} else {
			return $this->GetFilelists(0, true);
		}
	}
	public function GetFilelistsFrontEnd($cat_id){
		return $this->GetFilelists(2, false, $cat_id);
	}
	public function GetMyFilelists(){
		$uid = $this->_FEU->LoggedInId();
		if ($uid > 0) {
			return $this->GetFilelists(2, false, 0, $uid);
		}
		return false;
	}
	public function GetFilelistAdmin($id) {
		return $this->GetFilelist($id, false, true);
	}
	
	public function GetFilelistFrontEnd($id) {
		return $this->GetFilelist($id, false, false);
	}
	
	public function DeleteFilelistFront($id) {
		return $this->DeleteFilelist($id);
	}
	
	public function DeleteFilelistAdmin($id) {
		return $this->DeleteFilelist($id, true);
	}
	
	public function IsDestination($kalba) {
		global $contentobj;
		$par_arr = $this->GetPreference('pg_field_'.$kalba, '');
		
		if (strpos($par_arr, ',') !== false) {
			$par_arr = explode(',', $par_arr);
		} else {
			$par_arr = array($par_arr);
		}
		
		$current_id = $contentobj->mId;
		//echo 'zzz'; die;
		$pages = array();
		
		if (is_array($par_arr) && count($par_arr) > 0) {
			foreach ($par_arr as $par_id) {
				$this->GetContents($par_id, $pages, 0);
				if (in_array($current_id, $pages)) {
					return true;
				}
			}
		}
		return false;
	}
	
	public function isOwner($filelist_id) {
		$filelist_id = intval($filelist_id);
		if ($filelist_id) {
			$query = "SELECT user_id FROM ".cms_db_prefix()."module_filelists WHERE id = ?";
			$uid = $this->db->GetOne($query, array($filelist_id));
			if ($this->_FEU->LoggedInId() > 0 && $this->_FEU->LoggedInId() == $uid) {
				return true;
			}
		}
		return false;
	}
	
	public function GetFiles($filelist_id, $full = 1) {
		global $gCms;
		$config = $this->GetConfig();
		
		if (!empty($filelist_id)) {
			
			$path = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$this->GetName().'/filelist'.$filelist_id.'/';
			$path2 = $config['uploads_url'].'/'.$this->GetName().'/filelist'.$filelist_id.'/';
			if (file_exists($path)) {
				if ($handle = opendir($path)) {
					$ret = array();
					while (false !== ($entry = readdir($handle))) {
						if ($entry != "." && $entry != "..") {
							$entry_a = explode('_', $entry);
							$ord = $entry_a[0];
							if ($full == 1) {
								$this->smarty->assign('image', $path2.$entry);
								$img = $this->ProcessTemplate('admin_image.tpl');
								$ret[$ord] = array('full' => $path2.$entry, 'img' => $img, 'ordering' => $ord);
							} else if ($full == 2) {
								$ret[$ord] = array('full' => $path2.$entry);
							} else {
								$ret[$ord] = $entry;
							}
						}
					}
					if (count($ret) > 0) {
						ksort($ret);
						return $ret;
					}
					closedir($handle);
				}
			}
		}
		return false;
		
	}
	
	public function GetFiles2($filelist_id, $full = 1) {
		global $gCms;
		$config = $this->GetConfig();
		
		//echo $filelist_id.'zzz';
		if (!empty($filelist_id)) {
			
			$path = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$this->GetName().'/filelist2_'.$filelist_id.'/';
			$path2 = $config['uploads_url'].'/'.$this->GetName().'/filelist2_'.$filelist_id.'/';
			if (file_exists($path)) {
				if ($handle = opendir($path)) {
					
					$ret = array();
					while (false !== ($entry = readdir($handle))) {
						if ($entry != "." && $entry != "..") {
							//
							$entry_a = explode('_', $entry);
							$ord = $entry_a[0];
							if ($full == 1) {
								$this->smarty->assign('image', $path2.$entry);
								$this->smarty->assign('image_name', $entry);
								$img = $this->ProcessTemplate('admin_image2.tpl');
								$ret[$ord] = array('full' => $path2.$entry, 'img' => $img, 'ordering' => $ord, 'name' => $entry, 'root_name' => $path.$entry);
							} else if ($full == 2) {
								$ret[$ord] = array('full' => $path2.$entry, 'name' => $entry);
							} else {
								
								$ret[$ord] = $entry;
							}
						}
					}
					if (count($ret) > 0) {
						ksort($ret);
						return $ret;
					}
					closedir($handle);
				}
			}
		}
		return false;
		
	}
	
	public function uploadImage($filelist_id) {
		if (!empty($filelist_id)) {
			$path = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$this->GetName().'/filelist'.$filelist_id.'/';
			
			if ($this->_upload_type == 0) {
				$other_files = $this->GetFiles($filelist_id, 0);
				
				if (is_array($other_files) && count($other_files) > 0) {
					foreach ($other_files as $vv) {
						$this->DellFilelistFile($path.$vv, $filelist_id);
					}
				}
			}
			
			if (is_array($_FILES['file']) && count($_FILES['file']) > 0 && $_FILES['file']['error'] == 0 && $_FILES['file']['size'] > 0) {
				
				$other_files = $this->GetFiles($filelist_id, 0);
				if (is_array($other_files)) {
					$nr = count($other_files);
				} else {
					$nr = 0;
				}
				$m = explode('.', $_FILES['file']['name']);
				$ext = array_pop($m);
				$file_name_r = implode('.', $m);
				$file_name_r = $nr.'_'.time().'_'.munge_string_to_url($file_name_r, true).'.'.$ext;
				
				//echo $file_name_r; die;
				
				
				if (!file_exists($path)) {
					umask(0);
					mkdir($path, 0777, true);
				}
				
				$u = move_uploaded_file($_FILES[$id.'file']['tmp_name'], $path.$file_name_r);
				if ($u == true) {
					return true;
				}
			}
		}
		return false;
	}
	
	public function uploadImage2($filelist_id) {
		if (!empty($filelist_id)) {
			$path = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$this->GetName().'/filelist2_'.$filelist_id.'/';
			
			if ($this->_upload_type2 == 0) {
				$other_files = $this->GetFiles2($filelist_id, 0);
				
				if (is_array($other_files) && count($other_files) > 0) {
					foreach ($other_files as $vv) {
						$this->DellFilelistFile2($path.$vv, $filelist_id);
					}
				}
			}
			
			if (is_array($_FILES['file']) && count($_FILES['file']) > 0 && $_FILES['file']['error'] == 0 && $_FILES['file']['size'] > 0) {
				
				$other_files = $this->GetFiles2($filelist_id, 0);
				if (is_array($other_files)) {
					$nr = count($other_files);
				} else {
					$nr = 0;
				}
				$m = explode('.', $_FILES['file']['name']);
				$ext = array_pop($m);
				$file_name_r = implode('.', $m);
				$file_name_r = $nr.'_'.time().'_'.munge_string_to_url($file_name_r, true).'.'.$ext;
				
				//echo $file_name_r; die;
				
				
				if (!file_exists($path)) {
					umask(0);
					mkdir($path, 0777, true);
				}
				
				$u = move_uploaded_file($_FILES[$id.'file']['tmp_name'], $path.$file_name_r);
				if ($u == true) {
					return true;
				}
			}
		}
		return false;
	}
	
	public function FilelistSortImages($ser, $filelist_id) {
		if (!empty($filelist_id) && is_array($ser) && count($ser) > 0) {
			$path = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$this->GetName().'/filelist'.$filelist_id.'/';
			
			$all_files = $this->GetFiles($filelist_id, 0);
			
			if (is_array($all_files) && count($all_files) > 0) {
				foreach ($all_files as $key => $val) {
					$val_new = 't'.$val;
					
					rename($path.$val, $path.$val_new);
					
				}
				
				foreach ($ser as $key => $val) {
					if (isset($all_files[$val])) {
						$exp = explode('_', $all_files[$val]);
						$exp[0] = $key;
						$new_name = implode('_', $exp);
						
						rename($path.'t'.$all_files[$val], $path.$new_name);
					}
				}
				
				return true;
				
			}
			
		}
		return false;
	}
	
	
	public function FilelistSortImages2($ser, $filelist_id) {
		if (!empty($filelist_id) && is_array($ser) && count($ser) > 0) {
			$path = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$this->GetName().'/filelist2_'.$filelist_id.'/';
			
			$all_files = $this->GetFiles2($filelist_id, 0);
			
			if (is_array($all_files) && count($all_files) > 0) {
				foreach ($all_files as $key => $val) {
					$val_new = 't'.$val;
					
					rename($path.$val, $path.$val_new);
					
				}
				
				foreach ($ser as $key => $val) {
					if (isset($all_files[$val])) {
						$exp = explode('_', $all_files[$val]);
						$exp[0] = $key;
						$new_name = implode('_', $exp);
						
						rename($path.'t'.$all_files[$val], $path.$new_name);
					}
				}
				
				return true;
				
			}
			
		}
		return false;
	}
	
	public function DellFilelistFile($file, $filelist_id) {
		$config = $this->GetConfig();
		
		$filelist = $this->GetFilelist($filelist_id, false, true);
		$allow = false;
		if (is_array($filelist)) {
			//tik adminui
			if (check_login(true)) {
				$allow = true;
			}
		} else {
			$allow = true;
		}
		
		if ($allow == true && !empty($file)) {
			$file = str_replace($config['uploads_url'], $config['uploads_path'] , $file);
			
			@unlink($file);
			return true;
		}
		return false;
	}
	
	public function DellFilelistFile2($file, $filelist_id) {
		$config = $this->GetConfig();
		
		$filelist = $this->GetFilelist($filelist_id, false, true);
		$allow = false;
		if (is_array($filelist)) {
			//tik adminui
			if (check_login(true)) {
				$allow = true;
			}
		} else {
			$allow = true;
		}
		
		if ($allow == true && !empty($file)) {
			$file = str_replace($config['uploads_url'], $config['uploads_path'] , $file);
			
			@unlink($file);
			
			$all_files = $this->GetFiles2($filelist_id, 0);
			
			$path = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$this->GetName().'/filelist2_'.$filelist_id.'/';
			
			if (is_array($all_files) && count($all_files) > 0) {
				foreach ($all_files as $key => $val) {
					$val_new = 't'.$val;
					
					rename($path.$val, $path.$val_new);
					
				}
				$count = 0;
				foreach ($all_files as $key => $val) {
					
					$exp = explode('_', $val);
					$exp[0] = $count;
					$new_name = implode('_', $exp);
					
					rename($path.'t'.$val, $path.$new_name);
					$count++;
				}
			}
			
			return true;
		}
		return false;
	}
	
	public function GetFile($filelist_id, $file) {
		global $gCms;
	
		$filelist_id = intval($filelist_id);
		
		if ($filelist_id > 0) {
			//$filelist = $this->GetFilelist($filelist_id);
			//files2
			/*echo '<pre>';
			print_r($filelist);
			echo '</pre>';
			die;*/
			
			$path = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$this->GetName().'/filelist2_'.$filelist_id.'/';
			
			if (isset($file) && !empty($file)) {
				header('Content-Type: application/octet-stream');
				header("Content-Transfer-Encoding: Binary"); 
				header("Content-disposition: attachment; filename=\"" . $file . "\""); 
				readfile($path.$file); // do the double-download-dance (dirty but worky)
				exit;
			}
			
		}
		return false;
	}
	
	public function GetFilelistPrettyUrl($act, $addi = array()) {
		if ($act != '') {
			switch ($act) {
				case "add_edit_front":
					return 'Receptai/edit/'.(isset($addi['filelist_id'])?$addi['filelist_id']:'0').'/'.(isset($addi['returnid'])?$addi['returnid']:'0');
				break;
				case "view_front":
					return 'Receptai/view/'.(isset($addi['filelist_id'])?$addi['filelist_id']:'0').'/'.(isset($addi['returnid'])?$addi['returnid']:'0');
				break;
				case "delete_front":
					return 'Receptai/delete/'.(isset($addi['filelist_id'])?$addi['filelist_id']:'0').'/'.(isset($addi['returnid'])?$addi['returnid']:'0');
				break;
			}
		}
		return '';
	}
	
	public function RegisterUser($params) {
		$filelist_id = intval($params['filelist_id']);
		
		if ($filelist_id > 0) {
			$query = "INSERT INTO ".cms_db_prefix()."module_filelists_registration SET name = ?, cr_date = NOW(), email = ?, workplace = ?, questions = ?, filelist_id = ?";
			$this->db->Execute($query, array($params['name'], $params['email'], $params['workplace'], $params['questions'], $params['filelist_id']));
			//echo $this->db->sql; die;
			return true;
		}
		return false;
	}
	
	public function HasRegistredUsers($filelist_id) {
		$filelist_id = intval($filelist_id);
		$query = "SELECT COUNT(id) AS cnt FROM ".cms_db_prefix()."module_filelists_registration WHERE filelist_id = ? GROUP BY filelist_id";
		$cnt = $this->db->GetOne($query, array($filelist_id));
		
		if ($cnt > 0) {
			return $cnt;
		}
		return false;
	}
	
	public function GetRegListArr($filelist_id) {
		global $gCms;
		
		$filelist_id = intval($filelist_id);
		
		if ($filelist_id > 0) {
			$query = "SELECT * FROM ".cms_db_prefix()."module_filelists_registration WHERE filelist_id = ? ORDER BY id";
			$list = $this->db->GetArray($query, array($filelist_id));
			
			if (is_array($list) && count($list) > 0) {
				return $list;
			}
		}
		return false;
	}
	
	public function GetRegList($filelist_id) {
		/*global $gCms;
	
		$filelist_id = intval($filelist_id);
		
		if ($filelist_id > 0) {
			
			$allow = false;
			if (check_login(true)) {
				$allow = true;
			} else if ($this->_FEU->LoggedInId() > 0) {
				$filelist = $this->GetFilelist($filelist_id);
				if ($filelist['user_id'] == $this->_FEU->LoggedInId()) {
					$allow = true;
				}
			}
			
			$query = "SELECT * FROM ".cms_db_prefix()."module_filelists_registration WHERE filelist_id = ? ORDER BY id";
			$list = $this->db->GetArray($query, array($filelist_id));
			if (is_array($list) && count($list) > 0) {
				
				$delimiter = ";";

				@ob_clean();
				@ob_clean();
				header('Pragma: public');
				header('Expires: 0');
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				header('Cache-Control: private',false);
				header('Content-Description: File Transfer');
				header('Content-Type: text/csv; charset=UTF-8');
				header('Content-Disposition: attachment; filename=export.csv');
				
				
				echo $this->Lang('the_names_id').$delimiter;
				echo $this->Lang('the_names_filelist').$delimiter;
				echo $this->Lang('the_names_cr_date').$delimiter;
				echo $this->Lang('the_names_name').$delimiter;
				echo $this->Lang('the_names_email').$delimiter;
				echo $this->Lang('the_names_workplace').$delimiter;
				echo $this->Lang('the_names_questions').$delimiter;
					
				echo "\n";
				
				foreach($list as $item){
					foreach($item as $rx){
						echo $rx.$delimiter;
					}
					echo "\n";
				}
				
				exit;
			}
			
			
		}*/
		return false;
	}
	
	public function SyncGoogle($filelist_id) {
		/*$filelist_id = intval($filelist_id);
		//error_reporting(E_ALL);
		//ini_set('display_errors', '1');

		if ($filelist_id > 0) {
			
			$filelist = $this->GetFilelist($filelist_id, true);
			
			
			
			if ($filelist !== false) {
			
				
				$params['mailuser'] = $this->GetPreference('calendar_mail', '');
				$params['mailpass'] = $this->GetPreference('calendar_pass', '');
					
					
				if ($params['mailuser'] && $params['mailpass']){
					

					require_once 'Zend/Loader.php';
					
					Zend_Loader::loadClass('Zend_Gdata');
					Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
					Zend_Loader::loadClass('Zend_Gdata_Calendar');
					Zend_Loader::loadClass('Zend_Http_Client');

					$gcal = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;
					$user = $params['mailuser'];
					$pass = $params['mailpass'];

					try {
						set_error_handler("suppress_all_errors", E_ALL); 
						trigger_error("test", E_ERROR); 				

						$client = @Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $gcal);
						$gcal = new Zend_Gdata_Calendar($client);		
						$login_error = 0;
					} catch (Exception $e) {
						//echo "login_error";
						$login_error = 1;
					}	  


					if (!$login_error)	{
						
						if($filelist['google_id']){
							$query = $gcal->newEventQuery();
							$query->setUser('default');
							$query->setVisibility('private');
							$query->setProjection('full');
							$query = $gcal->getCalendarEventEntry($filelist['google_id']);		
							$query->title = $gcal->newTitle($filelist['filename']);
						}else{
							$query = $gcal->newEventEntry();

							$query->title = $gcal->newTitle($filelist['filename']);
						}

						$query->where = array($gcal->newWhere($filelist['location']));
						$query->content =	$gcal->newContent($filelist['detail']);

						$dtz = new DateTimeZone('Europe/Vilnius');
						$time_in_sofia = new DateTime('now', $dtz);
						$offs = $dtz->getOffset( $time_in_sofia )/3600;	  

						$tzOffset = "+0{$offs}";

						$when = $gcal->newWhen();
						//2004-02-12T15:19:21+00:00
						$when->startTime = "{$filelist['date']}T{$filelist['time_start']}.000{$tzOffset}:00";
						$when->endTime = "{$filelist['date_end']}T{$filelist['time_end']}.000{$tzOffset}:00";
						$query->when = array($when);

						
						if($filelist['google_id']){
							$query->save();
						}else{						
							$newEvent = $gcal->insertEvent($query);
							
							$query = "UPDATE ".cms_db_prefix()."module_filelists SET google_id = ? WHERE id = ? LIMIT 1";
							$this->db->Execute($query, array($newEvent->id->text, $filelist['id']));
						}
						
						return true;
					  
					}
				}
			}
		}*/
		return false;
	}
	
	public function FileSizeConvert($bytes) {
		$bytes = floatval($bytes);
			$arBytes = array(
				0 => array(
					"UNIT" => "TB",
					"VALUE" => pow(1024, 4)
				),
				1 => array(
					"UNIT" => "GB",
					"VALUE" => pow(1024, 3)
				),
				2 => array(
					"UNIT" => "MB",
					"VALUE" => pow(1024, 2)
				),
				3 => array(
					"UNIT" => "KB",
					"VALUE" => 1024
				),
				4 => array(
					"UNIT" => "B",
					"VALUE" => 1
				),
			);

		foreach($arBytes as $arItem) {
			if($bytes >= $arItem["VALUE"]) {
				$result = $bytes / $arItem["VALUE"];
				$result = str_replace(".", "," , strval(round($result, 2)))." ".$arItem["UNIT"];
				break;
			}
		}
		return $result;
	}
	
	public function GetFileTypes() {
		$query = "SELECT file2 FROM ".cms_db_prefix()."module_filelists GROUP BY file2";
		$col = $this->db->GetCol($query);
		if (is_array($col) && count($col)) {
			return $col;
		}
		return false;
	}
	
} //end class
?>
