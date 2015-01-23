<?php
#-------------------------------------------------------------------------
# Module: Zemelapiai - a pedantic "starting point" module
# Version: 1.5, SjG
# Method: Install
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2008 by Ted Kulp (wishy@cmsmadesimple.org)
# This project's homepage is: http://www.cmsmadesimple.org
# The module's homepage is: http://dev.cmsmadesimple.org/projects/Zemelapiai/
#
#-------------------------------------------------------------------------

/**
 * For separated methods, you'll always want to start with the following
 * line which check to make sure that method was called from the module
 * API, and that everything's safe to continue:
 */ 
if (!isset($gCms)) exit;
include ('dom.php');

/** 
 * After this, the code is identical to the code that would otherwise be
 * wrapped in the Install() method in the module body.
 */

$db =& $gCms->GetDb();

// mysql-specific, but ignored by other database
$taboptarray = array( 'mysql' => 'TYPE=MyISAM' );

$dict = NewDataDictionary( $db );

// table schema description
$flds = "
         id INT NOT NULL AUTO_INCREMENT,
         userid I(255),
         formid C(255),
         formname C(255),
         formalias C(255),
         formtpl C(255)
";

if (!mysql_num_rows(mysql_query("SELECT * FROM ".cms_db_prefix().$lentele))){			
// create it. This should do error checking, but I'm a lazy sod.
$sqlarray = $dict->CreateTableSQL( cms_db_prefix().$lentele,
				   $flds, 
				   $taboptarray);
$dict->ExecuteSQLArray($sqlarray);

$query1 = "ALTER TABLE  ".cms_db_prefix().$lentele." ADD UNIQUE (id)";
$query2 = "ALTER TABLE  ".cms_db_prefix().$lentele." CHANGE  `id`  `id` INT  NOT NULL AUTO_INCREMENT";
$db->Execute($query1);
$db->Execute($query2);


  $db->Execute($query);
}


// create a permission
$this->CreatePermission($pavad.' Use', $pavad.' Use');
$this->CreatePermission($pavad.' Edit', $pavad.' Edit');
$this->CreatePermission($pavad.' More', $pavad.' More');
$this->CreatePermission($pavad.' Add', $pavad.' Add');
$this->CreatePermission($pavad.' Special', $pavad.' Special');
$this->CreatePermission($pavad.' Delete', $pavad.' Delete');

// create a preference
$this->SetPreference("allow_add", true);

// register an event that the Zemelapiai will issue. Other modules
// or user tags will be able to subscribe to this event, and trigger
// other actions when it gets called.
//$this->CreateEvent( 'OnZemelapiaiPreferenceChange' );

// put mention into the admin log
$this->Audit( 0, 
	      $this->Lang('friendlyname'), 
	      $this->Lang('installed', $this->GetVersion()) );

	      
?>