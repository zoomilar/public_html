<?php
/**
 * NOT PART OF THE MODULE API
 * 
 * This is an example of a simple method to save Admin
 * prefs.
 */

/**
 * For separated methods, you'll always want to start with the following
 * line which check to make sure that method was called from the module
 * API, and that everything's safe to continue:
 */ 
if (!isset($gCms)) exit;

/** 
 * For separated methods, you won't be able to do permission checks in
 * the DoAction method, so you'll need to do them as needed in your
 * method:
 */ 
if (! $this->CheckPermission('Set Filelists Prefs')) {
  return $this->DisplayErrorPage($id, $params, $returnid,$this->Lang('accessdenied'));
}
	
/**
 * After this, the code is identical to the code that would otherwise be
 * wrapped in the DisplayAdminPrefs() method in the module body.
 */



// set our preference
//$this->SetPreference('allow_add', isset($params['allow_add'])?$params['allow_add']:'0');

$this->SetPreference('kalbos', trim($params['kalbos']));

$lng_for_cur = $params['kalbos'];
$lng_for_cur = explode(',', $lng_for_cur);
if (is_array($lng_for_cur) && count($lng_for_cur) > 0) {
	foreach($lng_for_cur as $val) {
		$this->SetPreference('pg_field_'.$val, trim($params['pg_field_'.$val]));
	}
}

$this->SetPreference('admin_email', trim($params['admin_email']));
$this->SetPreference('calendar_mail', trim($params['calendar_mail']));
$this->SetPreference('calendar_pass', trim($params['calendar_pass']));


// send an event to any subscribing user tags or modules
$parms = array();
$parms['allow_add'] = (isset($params['allow_add'])?true:false);
$this->SendEvent('OnFilelistsPreferenceChange',$parms);

// write to the admin log
$this->Audit( 0, $this->Lang('friendlyname'), $this->Lang('prefsupdated') );

// set the active tab, and a message to display
$params = array('tab_message'=> 'prefsupdated', 'active_tab' => 'prefs');

// redirect back to default admin page
$this->Redirect($id, 'defaultadmin', $returnid, $params);
?>