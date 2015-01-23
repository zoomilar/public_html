<?php
#-------------------------------------------------------------------------
# Module: Zemelapiai - a pedantic "starting point" module
# Version: 1.3, SjG
# Method: Uninstall
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2005 by Ted Kulp (wishy@cmsmadesimple.org)
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
include ("dom.php");

/** 
 * After this, the code is identical to the code that would otherwise be
 * wrapped in the Uninstall() method in the module body.
 */

$db =& $gCms->GetDb();

// remove the database table
$dict = NewDataDictionary( $db );
$sqlarray = $dict->DropTableSQL( cms_db_prefix().$lentele );
$dict->ExecuteSQLArray($sqlarray);

// remove the permissions
$this->RemovePermission($pavad.' Use', $pavad.' Use');
$this->RemovePermission($pavad.' Edit', $pavad.' Edit');
$this->RemovePermission($pavad.' More', $pavad.' More');
$this->RemovePermission($pavad.' Add', $pavad.' Add');
$this->RemovePermission($pavad.' Special', $pavad.' Special');
$this->RemovePermission($pavad.' Delete', $pavad.' Delete');

// remove the preference
$this->RemovePreference("allow_add");

// put mention into the admin log
$this->Audit( 0, $this->Lang('friendlyname'), $this->Lang('uninstalled'));

?>