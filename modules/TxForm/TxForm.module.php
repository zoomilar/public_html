<?php

class TxForm extends CMSModule
{
  
  
	public $tempfields;
	public $fielddefs = array();
	public $rfields = array();  
	public $params;
	public $fields;  
	public $merr;  
	public $adb;
	public $module_id;
	
    
	function __construct()
    {
		parent::__construct();
		$this->merr = array();
		$this->adb = $this->GetDb();
		
		//$db = $this->GetDb();
		
		$this->params = array();
		$this->prefix = 'rez_';
		
		define("CL_DATEFORMAT", "Y-m-d");
		define("CL_SHORT_DATEFORMAT", "y-m-d");
		define("DATE_COLUMN", "int(21)");
		define("USERID_COLUMN", "int(30)");
		define("CRMID_COLUMN", "int(31)");
		define("CRMCONTACTID_COLUMN", "int(32)");
		define("COMPANYID_COLUMN", "int(29)");
		define("LANGUAGE_COLUMN", "varchar(6)");
		define("CURRENCY_COLUMN", "int(9)");
		define("COLOR_COLUMN", "int(33)");

		global $langfile;
		require_once dirname(__FILE__).'/classes/class.validation.php';
		//require_once dirname(__FILE__).'/../CMSMailer/CMSMailer.module.php';
		//require_once dirname(__FILE__).'/classes/class.PHPMailer.php';
		require_once dirname(__FILE__).'/classes/class.readlanguage.php';
		$langfile = new readlanguage("./language/lt.conf");
		$langfile = $langfile->readLangfile();		
		$this->smarty->assign("langfile", $langfile);		
    }  
		
	
	



  
  /**
   * GetName()
   * must return the exact class name of the module.
   * If these do not match, bad things happen.
   *
   * This is the name that's shown in the main Modules
   * page in the Admin.
   *
   * If you want to be safe, you can just replace the body
   * of this function with:
   * return get_class($this); 
   * @return string class name
   */
  function GetName()
  {
	include ("dom.php");
    return $pavad;
  }
  
  /**
   * GetFriendlyName()
   * This can return any string, preferably a localized name
   * of the module. This is the name that's shown in the
   * Admin Menus and section pages (if the module has an admin
   * component).
   *   
   * See the note on localization at the top of this file.
   * @return string Friendly name for the module
   */
  function GetFriendlyName()
  {
    return $this->Lang('friendlyname');
  }

  
  /**
   * GetVersion()
   * This can return any string, preferably a number or
   * something that makes sense for designating a version.
   * The CMS will use this to identify whether or not
   * the installed version of the module is current, and
   * the module will use it to figure out how to upgrade
   * itself if requested.	   
   * @return string version number (can be something like 1.4rc1)
   */
  function GetVersion()
  {
    return '1.0';
  }
  
  /**
   * GetHelp()
   * This returns HTML information on the module.
   * Typically, you'll want to include information on how to
   * use the module.
   *
   * See the note on localization at the top of this file.
   * @return string Help for this module
   */
  function GetHelp()
  {
    return $this->Lang('help');
  }
  
  /**
   * GetAuthor()
   * This returns a string that is presented in the Module
   * Admin if you click on the "About" link.
   * @return string Author name
   */
  function GetAuthor()
  {
    return 'texus';
  }

  /**
   * GetAuthorEmail()
   * This returns a string that is presented in the Module
   * Admin if you click on the "About" link. It helps users
   * of your module get in touch with you to send bug reports,
   * questions, cases of beer, and/or large sums of money.
   * @return string Authors email
   */
  function GetAuthorEmail()
  {
    return 'info@texus.lt';
  }
  
  /**
   * GetChangeLog()
   * This returns a string that is presented in the module
   * Admin if you click on the About link. It helps users
   * figure out what's changed between releases.
   * See the note on localization at the top of this file.
   * @return string ChangeLog for this module
   */
  function GetChangeLog()
  {
    return $this->Lang('changelog');
  }
  
  /**
   * IsPluginModule()
   * This function returns true or false, depending upon
   * whether users can include the module in a page or
   * template using a smarty tag of the form
   * {cms_module module='TitulinioPav' param1=val param2=val...}
   * 
   * If your module does not get included in pages or
   * templates, return "false" here.
   * @return bool True if this module can be included in page and or template
   */
  function IsPluginModule()
  {
    return true;
  }

  /**
   * HasAdmin()
   * This function returns a boolean value, depending on
   * whether your module adds anything to the Admin area of
   * the site. For the rest of these comments, I'll be calling
   * the admin part of your module the "Admin Panel" for
   * want of a better term.
   * @return bool True if this module has admin area
   */
  function HasAdmin()
  {
    return true;
  }

  /**
   * GetAdminSection()
   * If your module has an Admin Panel, you can specify
   * which Admin Section (or top-level Admin Menu) it shows
   * up in. This method returns a string to specify that
   * section. Valid return values are:
   * 
   * main        - the Main menu tab.
   * content     - the Content menu
   * layout      - the Layout menu
   * usersgroups - the Users and Groups menu
   * extensions  - the Extensions menu (this is the default)
   * siteadmin   - the Site Admin menu
   * viewsite    - the View Site menu tab
   * logout      - the Logout menu tab
   *
   * Note that if you place your module in the main,
   * viewsite, or logout sections, it will show up in the
   * menus, but will not be visible in any top-level
   * section pages.
   * @return string Which admin section this module belongs to
   */
  function GetAdminSection()
  {
    return 'content';
  }

  /**
   * GetAdminDescription()
   * If your module does have an Admin Panel, you
   * can have it return a description string that gets shown
   * in the Admin Section page that contains the module.
   *
   * See the note on localization at the top of this file.
   * @return string Module description
   */
  function GetAdminDescription()
  {
    return $this->Lang('moddescription');
  }

  /**
   * VisibleToAdminUser()
   * If your module does have an Admin Panel, you
   * can control whether or not it's displayed by the boolean
   * that is returned by this method. This is primarily used
   * to hide modules from admins who lack permission to use
   * them.
   * In this case, the module will only be visible to admins
   * who have "Use TitulinioPav" permissions.
   * @return bool True if this module is shown to current user
   */
  function VisibleToAdminUser()
  {
	include ("dom.php");
    return $this->CheckPermission($pavad.' Use');
  }
  
  /**
   * GetDependencies()
   * Your module may need another module to already be installed
   * before you can install it.
   * This method returns a list of those dependencies and
   * minimum version numbers that this module requires.
   *
   * It should return an hash, eg.
   * return array('somemodule'=>'1.0', 'othermodule'=>'1.1');
   * @return hash Hash of other modules this module depends on
   */
  function GetDependencies()
  {
    return array();
  }

  /**
   * MinimumCMSVersion()
   * Your module may require functions or objects from
   * a specific version of CMS Made Simple.
   * Ever since version 0.11, you can specify which minimum
   * CMS MS version is required for your module, which will
   * prevent it from being installed by a version of CMS that
   * can't run it.
   * 
   * This method returns a string representing the
   * minimum version that this module requires.
   * @return string Minimum cms version this module should work on
   */
  function MinimumCMSVersion()
  {
    return "1.0";
  }
  
  /**
   * MaximumCMSVersion()
   * You may want to prevent people from using your module in
   * future versions of CMS Made Simple, especially if you
   * think API features you use may change -- after all, you
   * never really know how the CMS MS API could evolve.
   * 
   * So, to prevent people from flooding you with bug reports
   * when a new version of CMS MS is released, you can simply
   * restrict the version. Then, of course, the onus is on you
   * to release a new version of your module when a new version
   * of the CMS is released...
   * 
   * This method returns a string representing the
   * maximum version that this module supports.
   *
   * It can also be a major pain if you don't have time to
   * update your modules every time a new release of CMSMS comes
   * out, hence this is commented out here.
   */
  
  /*
  function MaximumCMSVersion()
  {
    return "1.5";
  }
  */

  /**
   * SetParameters()
   * This function enables you to 
   * 1) create mappings for your module when using "Pretty Urls".
   * 2) impose security by controlling incoming parameters
   *
   * Pretty URLS:
   * Typically, modules create internal links that have
   * big ugly strings along the lines of:
   * index.php?mact=ModName,cntnt01,actionName,0&cntnt01param1=1&cntnt01param2=2&cntnt01returnid=3
   *
   * You might prefer these to look like:
   * /ModuleFunction/2/3
   *
   * To do this, you have to register routes and map
   * your parameters in a way that the API will be able
   * to understand.
   *
   * Also note that any calls to CreateLink will need to
   * be updated to pass the pretty url parameter.
   *
   * Security:
   * By using the RestrictUnknownParams function, your module will not
   * receive any parameters other than the ones you declare here.
   * Furthermore, the parameters your module does receive will be filtered
   * according to the rules you set here.
   */ 

  function SetParameters()
  {
  	$this->RegisterModulePlugin();
	$this->RestrictUnknownParams();
	$str = '/'.$this->GetPreference('urlprefix','TxForm');
	
	//$this->RegisterRoute($str.'\/(?P<pid>[0-9]+)\/(registracija.*)$/', array('action'=>'defaulhht'));
		$this->RegisterRoute($str.'\/(?P<pid>[0-9]+)\/(?P<form>[0-9]+)\/(registracija.*)$/',array('action'=>'default', 'returnid'=>'766'));
	//$this->RegisterModulePlugin();
	$this->SetParameterType(CLEAN_REGEXP.'/'.$this->prefix.'.*/',CLEAN_STRING);
						
  }

  /**
   * GetEventDescription()
   * If your module can create events, you will need
   * to provide the API with documentation of what
   * that event does. This method wraps up a simple
   * return of the localized description.
   * @param string Eventname
   * @return string Description for event 
   */
   
   	function DoAction($name,$id,$params,$returnid=''){
	//debug_display($params);
		global $gCms;
		//$smarty =& $gCms->GetSmarty();
		$this->module_id = $id;
		//$params['id'] = 1;
		$this->params = $params;
		parent::DoAction($name,$id,$params,$returnid);
	}
  function GetEventDescription ( $eventname )
  {
    return $this->Lang('event_info_'.$eventname );
  }
  
  /**
   * GetEventHelp()
   * If your module can create events, you will need
   * to provide the API with documentation of how to
   * use the event. This method wraps up a simple
   * return of the localized description.
   * @param string Eventname
   * @return string Help for event
   */
  function GetEventHelp ( $eventname )
  {
    return $this->Lang('event_help_'.$eventname );
  }

  /**
   * InstallPostMessage()
   * After installation, there may be things you want to
   * communicate to your admin. This function returns a
   * string which will be displayed.
   * 
   * See the note on localization at the top of this file.
   * @return string Message to be shown after installation
   */
  function InstallPostMessage()
  {
    return $this->Lang('postinstall');
  }

  /**
   * UninstallPostMessage()
   * After removing a module, there may be things you want to
   * communicate to your admin. This function returns a
   * string which will be displayed.
   *
   * See the note on localization at the top of this file.
   * @return string Message to be shown after uninstallation
   */
  function UninstallPostMessage()
  {
    return $this->Lang('postuninstall');
  }

  /**
   * UninstallPreMessage()
   * This allows you to display a message along with a Yes/No dialog box. If the user responds
   * in the affirmative to your message, the uninstall will proceed. If they respond in the
   * negative, the uninstall will be canceled. Thus, your message should be of the form
   * "All module data will be deleted. Are you sure you want to uninstall this module?"
   *
   * If you don't want the dialog, have this method return a FALSE, which will cause the
   * module to uninstall immediately if the user clicks the "uninstall" link.
   * @return string Message to be shown before uninstallation
   */
  function UninstallPreMessage()
  {
    return $this->Lang('really_uninstall');
  }
  
  

  
  
	function save(){
		global $userid;

		if ($this->tempfields['entity_id'] != ''){
			$existing = $this->adb->GetOne("SELECT ID FROM {$this->params['table']} WHERE ID=?", array($this->tempfields['entity_id']));						
		}		

		
		$this->fields = $this->matchfields($this->params['table'], $this->tempfields);

		if ($existing != ''){
			$this->updatequery($this->params['table'], $this->fields, "ID", $this->tempfields['entity_id']);

			if ($this->params['assignable']){
				$this->adb->Execute("DELETE FROM {$this->params['table']}_assigned WHERE {$this->params['assignable']}=?", array($this->tempfields['entity_id']));
			}
		}else{		
		  if(in_array('userid', $this->rfields))
			$this->fields['userid'] = $userid;			

			$this->tempfields['entity_id'] = $this->insertquery($this->params['table'], $this->fields);				
		}
		if ($this->params['assignable']){
			$assid = ($this->tempfields['entity_id']) ? $this->tempfields['entity_id'] : $this->newid;
			foreach ($this->tempfields['priskirta'] as $user){
				$this->adb->Execute("INSERT INTO {$this->params['table']}_assigned (`user`,`{$this->params['assignable']}`) VALUES(?,?)", array($user,$assid));
			}			
		}			
		
	}

	 function load(){
		if ($this->params['id'] != ''){
			$q = $this->adb->getRow("SELECT * FROM {$this->params['table']} WHERE ID=?", array($this->params['id']));
			if($this->params['assignable']){
				$q['userid'] = $this->adb->getOne("SELECT user FROM {$this->params['table']}_assigned WHERE {$this->params['assignable']}=?", array($this->params['id']));
			}
			$ret = $this->prepareValOut($this->params['table'], $q);		
		}

		$this->fields = $ret;
	}

	function updatequery($table, $fields, $idcol, $idval){		
		$querybase = "";
		foreach($fields as $key=>$field){
			$fields[$key] = $this->prepareval($key, $field);
			if ($fields[$key] == "skipthisonce"){
				unset($fields[$key]);
			}else{			
				$querybase .= ", `{$key}`=? ";
			}	
		}
		$querybase = substr($querybase, 2);
		
		$query = "UPDATE {$table} SET {$querybase} WHERE {$idcol}={$idval}";
		
		$this->adb->Execute($query, $fields);
		$this->merr("Update {$table}");
	}
	
	function insertquery($table, $fields){		
		global $sequence_suffix;		
		$querybase = ""; $questionmark = "";
		
		if ($this->params['hasorder']){
			$fields['order'] = $this->adb->getOne("SELECT max(`order`)+1 FROM {$table} WHERE {$this->params['parent']}=?", array($this->params['hasorder']));
			$this->merr("Get order");
		}	

		// jei ne auto_incrementas eisim ieskoti sequence lenteles
		if (is_array($this->fielddefs['ID']) && $this->fielddefs['ID']['Extra'] != 'auto_increment'){			
			$is_present = $this->adb->getOne("show tables like '{$this->params['table']}_{$sequence_suffix}'");
			if ($is_present){
				$this->adb->Execute("LOCK TABLE {$this->params['table']}_{$sequence_suffix} WRITE");				
				$eil = $this->adb->getOne("SELECT {$sequence_suffix} FROM {$this->params['table']}_{$sequence_suffix}")+1;				
				$this->adb->Execute("UPDATE {$this->params['table']}_{$sequence_suffix} SET {$sequence_suffix}=?", array($eil));
				$this->adb->Execute("UNLOCK TABLES");
				$fields['ID'] = $eil;
			}else{ // laikykim kad entity_id yra tai ko mums reikia (skirta, kai naudojam papildanciasias lenteles)
				$fields['ID'] = $this->tempfields['entity_id'];
			}
		}
					

		foreach($fields as $key=>$field){
			$fields[$key] = $this->prepareval($key, $field);		
			
			$querybase .= ",`{$key}`";
			$questionmark .= ",?";
			if ($field == "")
				$fields[$key] = "";
		}
			
		
		$querybase = substr($querybase, 1);
		$questionmark = substr($questionmark, 1);
		
		$query = "INSERT INTO {$table} ({$querybase}) VALUES({$questionmark})";
		$this->adb->Execute($query, $fields);
		
		$this->merr("Insert {$table}");
		$this->newid = $this->adb->Insert_ID();
		if (!$this->newid)
			$this->newid = $fields['ID'];
		return $this->newid;
	}	

	function preparevalOut($table='', $valArray){
		if ($table)
			$this->getTableDetails($table);
		
				
		foreach ($valArray as $k=>$val){
		
			switch ($this->fielddefs[$k]['Type']){
			
				case DATE_COLUMN:
					$valArray["{$k}_orig"] = $val;			
					if ($val)
						$valArray[$k] = date(CL_DATEFORMAT, $val);					
					else
						$valArray[$k] = "";				
				break;
				case USERID_COLUMN:
					if (!$this->users)
						$this->getUserList();
						
					$valArray["{$k}_data"] = $this->users[$val];					
				
				break;
				case COMPANYID_COLUMN:
					if (!$this->companies)
						$this->getCompanyList();
						
					$valArray["{$k}_data"] = $this->companies[$val];									
				break;
				case CRMID_COLUMN:				
					if (!$this->clients)
						$this->getClientList();
						
					$valArray["{$k}_data"] = $this->clients[$val];				
				break;
				case CRMCONTACTID_COLUMN:										
					$valArray["{$k}_data"] = $this->adb->getRow("SELECT kontaktinisasmuo, id, cid FROM crm_contacts WHERE id=?", array($val));				
				break;		
				case LANGUAGE_COLUMN:								
					$this->getLanguages();					
					$valArray["{$k}_data"] = $this->kalbos[$val];
				break;		
				case CURRENCY_COLUMN:								
					$this->getCurrencies();					
					$valArray["{$k}_data"] = $this->valiutos[$val];
				break;		
				case COLOR_COLUMN:			
					$this->getSpalvos();
					$valArray["{$k}_data"] = $this->spalvos[$val];				
				break;					
				default:
					if($k == 'userid__'){
						if (!$this->users)
							$this->getUserList();
							
						$valArray["{$k}_data"] = $this->users[$val];						
					}else{
						if ($this->is_serialized($val)){

							$tempval = @unserialize($val);
							if (is_array($tempval)){
							  foreach ($tempval as $tk=>$tmp){
								if(is_array($tmp)){						
								  foreach($tmp as $t=>$tm){
									$tempval[$tk][$t] = ($this->is_serialized($tm))?unserialize($tm):$tm;
								  }	
								}else
									$tempval[$tk] = ($this->is_serialized($tmp))?unserialize($tmp):$tmp;
							  }
							
							}  
							$valArray["{$k}_serialized"] = $val;
							$val = $tempval;
							
						}else{		
							$val = stripslashes($val);
						}
						$valArray[$k] = $val;
					}
				
				break;				
			}
		}	
		
		return $valArray;		
	}
	
	function prepareval($key, $val){
			if ($this->fielddefs[$key]['Type'] == DATE_COLUMN){				
				$val = strtotime($val);		
			}	
			if ($this->fielddefs[$key]['Type'] == "varchar(251)"){			
			  if($val){
				$val = sha1($val);		
			  }else{
				$val = "skipthisonce";
			  }
			}
			if(is_array($val))
				$val = serialize($val);
			return $val;	
	}

    function whereArr($where)
    {
		if (!is_array($where))
			return '';
		
		$ret = '';
		foreach	($where as $wh){
			$ret .= " and {$wh}";
		}
		$ret = substr($ret, 4);	
		$ret = "WHERE {$ret}";
	
        return $ret;
    }	
	
	function getTableDetails($table){
		if ($table){
			//$tq =  $this->adb->Execute("SELECT column_name as field, data_type as type, character_maximum_length as length, column_type as ctype  FROM information_schema.columns as t WHERE t.table_schema = schema() and t.table_name = ? ORDER BY ordinal_position ASC", array($table));
			$tq =  $this->adb->Execute("SHOW columns from {$table}");
			$this->rfields = array();
			$this->fielddefs = array();

			while($tq && ($tr = $tq->FetchRow())){	
				$this->rfields[]=$tr['Field'];
				$this->fielddefs[$tr['Field']]=$tr;
			}				
			
		}else
			return array();
	}

	function matchfields($table, $fields){
	
		$this->getTableDetails($table);
			
		foreach ($fields as $key=>$field){
			if (!in_array($key, $this->rfields)){
				unset($fields[$key]);
			}
		}
		
		return $fields;	
	}	
	
function print_a($what){
	if (in_array($_SERVER['REMOTE_ADDR'], explode(',', '82.135.244.184,84.240.30.70')))
		echo str_replace("Array","<font color='red'><b>Array</b></font>",nl2br(str_replace(" "," &nbsp; ",print_r($what,true))));
}


/**
 * @param		string	$value	Value to test for serialized form
 * @param		mixed	$result	Result of unserialize() of the $value
 * @return		boolean			True if $value is serialized data, otherwise false
 */
function is_serialized($value, &$result = null)
{
	// Bit of a give away this one
	if (!is_string($value))
	{
		return false;
	}

	// Serialized false, return true. unserialize() returns false on an
	// invalid string or it could return false if the string is serialized
	// false, eliminate that possibility.
	if ($value === 'b:0;')
	{
		$result = false;
		return true;
	}

	$length	= strlen($value);
	$end	= '';

	switch ($value[0])
	{
		case 's':
			if ($value[$length - 2] !== '"')
			{
				return false;
			}
		case 'b':
		case 'i':
		case 'd':
			// This looks odd but it is quicker than isset()ing
			$end .= ';';
		case 'a':
		case 'O':
			$end .= '}';

			if ($value[1] !== ':')
			{
				return false;
			}

			switch ($value[2])
			{
				case 0:
				case 1:
				case 2:
				case 3:
				case 4:
				case 5:
				case 6:
				case 7:
				case 8:
				case 9:
				break;

				default:
					return false;
			}
		case 'N':
			$end .= ';';

			if ($value[$length - 1] !== $end[0])
			{
				return false;
			}
		break;

		default:
			return false;
	}

	if (($result = @unserialize($value)) === false)
	{
		$result = null;
		return false;
	}
	return true;
}	
  
   
  
	function merr($wh){
		//$err = mysql_error();
		$err = $this->adb->ErrorMsg();
		if ($err)
			$this->merr[] = "{$wh}: {$err}";
	}  
	
	function prepare_input($data) {
		if (!empty($data)) {
			if (is_array($data))
			{
				$prefix_len = strlen($this->prefix);
				foreach ($data as $k=>$v){
					$t = 0;
					$k1 = $k;
					if(substr($k, 0, $prefix_len)== $this->prefix) {
						$k1 =  substr($k,$prefix_len);
						$t = 1;
						}
					if (is_array($v))
						foreach ($v as $k2 => $v2)
							//$data[$k1][$k2]=$this->adb->qstr(trim(strip_tags($v2)));
							$data[$k1][$k2]=addslashes(trim(strip_tags($v2)));
					else
						$data[$k1]=addslashes(trim(strip_tags($v)));
					if($t) unset($data[$k]);
				}
			}
			else { 
				$data=addslashes(trim(strip_tags($data)));
				
			}
			return $data;
		} else return $data;
	}	
  
	function SuppressAdminOutput(&$request)
   {
      if (strpos($_SERVER['QUERY_STRING'],'download_export') !== false)
         {
         return true;
         }
      return false;
   }  
  
   function GetDegalines(){
	return array(
		"1"=>"Vilnius, Erfurto g. 41",
		"2"=>"Vilnius, Geležinio Vilko g. 63",
		"3"=>"Vilnius, S. Stanevičiaus g. 3",
		"4"=>"Vilnius, Žirmunų g. 68B",
		"5"=>"Vilnius, Rygos g. 2",
		"6"=>"Vilnius, Savanorių pr. 220A",
		"7"=>"Vilnius, Parodų g. 1A",
		"8"=>"Vilnius,  Kauno g. 26",
		"9"=>"Vilnius, Savanorių pr. 187",
		"10"=>"Vilnius, Savanorių pr. 16",
		"11"=>"Vilnius, Molėtų pl. 8",
		"12"=>"Vilnius, P. Lukšio g. 22",
		"13"=>"Vilnius, Žirmunų g. 54C",
		"14"=>"Vilnius, Subačiaus g. 64",
		"15"=>"Vilnius,  Jasinskio g. 14",
		"16"=>"Vilnius,  Dariaus ir Girėno g. 17",
		"17"=>"Vilnius,  Architektų g. 130",
		"18"=>"Vilnius, Justiniškių g. 14B",
		"19"=>"Vilnius, Laisvės pr. 125A",
		"20"=>"Vilnius,  Buivydiškių g. 5",
		"21"=>"Vilnius, Geležinio Vilko g. 37A",
		"22"=>"Kaunas, Pramonės pr. 6A",
		"23"=>"Kaunas, Jonavos g. 110",
		"24"=>"Kaunas, Veiverių g. 132D",
		"25"=>"Kaunas, Žemaičių pl. 26",
		"26"=>"Kaunas, R. Kalantos g. 27",
		"27"=>"Kaunas, Ateities pl. 50B",
		"28"=>"Kaunas, Taikos pr. 80A",
		"29"=>"Kaunas, Birželio 23-iosios g. 23A",
		"30"=>"Kaunas, Islandijos pl. 191E",
		"31"=>"Kaunas, Raudondvario pl. 103",
		"32"=>"Kaunas, Kuršių g. 1",
		"33"=>"Klaipėda, Šilutės pl. 113",
		"34"=>"Klaipėda, Šilutės pl. 30",
		"35"=>"Klaipėda, Taikos pr. 60 / Dubysos g. 20",
		"36"=>"Klaipėda, Minijos g. 119 / Baltijos pr. 30",
		"37"=>"Klaipėda, Artojo g. 2",
		"38"=>"Klaipėda, Smiltelės g. 17",
		"39"=>"Klaipėda, Šilutės pl. 5",
		"40"=>"Šiauliai, Gegužių g. 28",
		"41"=>"Šiauliai, Tilžės g. 72",
		"42"=>"Šiauliai, Dubijos g. 18A",
		"43"=>"Panevėžys, Klaipėdos g. 81",
		"44"=>"Panevėžys, Ramygalos g. 145B",
		"45"=>"Panevėžys, Klaipėdos g. 66",
		"46"=>"Pasvalio r., Raubonių k.",
		"47"=>"Panevėžys, Margirio g. 1B",
		"48"=>"Panevėžys, Klaipėdos g. 144B",
		"49"=>"Alytus, Santaikos g. 34A",
		"50"=>"Marijampolė, Stoties g. 4C",
		"51"=>"Kalvarijos sav. Salaperaugio k., Liubavo sen.",
		"52"=>"Kalvarijos sav. N. Valios k., Sangrūdos pst.",
		"53"=>"Mažeikiai, M. Daukšos g. 29/Žemaitijos g. 69",
		"54"=>"Šilalės r., Katyčių k.",
		"55"=>"Kėdainiai, J. Basanavičiaus g. 91E",
		"56"=>"Ukmergė, Kauno g. 45B",
		"57"=>"Utena, J. Basanavičiaus g. 129"
		);
   }
   
   function getMactPar(){
$params['request'] = $_REQUEST;
$mact_params = explode(',',$params['request']['mact']);
if(is_array($mact_params)){
$params['module'] = $mact_params['0'];
$params['mact'] = $mact_params['1'];
$params['action'] = $mact_params['2'];
$params['inline'] = $mact_params['3'];
}
$prefix_len = strlen($params['mact']);
foreach($params['request'] as $key=>$row){
$row_name = substr($key,$prefix_len,strlen($key));
if(substr($key, 0, $prefix_len)== $params['mact']){
$params['mact_params'][$row_name]=$row;
}
}
$params['cookie'] = $_COOKIE;
return $params;
}

function getMactAllParams($action){
$params = $this->getMactPar();
if($params['module'] == $this->GetName() && $params['action'] == $action) return $params['mact_params'];
return '';

}

  
} 



?>
