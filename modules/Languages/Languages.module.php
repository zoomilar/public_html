<?php
/**
 *
 *  NOTES FOR THE ASPIRING, UNEXPERIENCED, OR FORGETFUL MODULE DEVELOPER
 *
 * As one of the latter, I put together these notes to help me when I need
 * to start work on a new module. I take this Languages file, delete most of
 * the comments, and customize it to do whatever it is I need done.
 *
 * Keep in mind that the module interface has a huge number of hooks
 * available to control many, many aspects of how CMS Made Simple works.
 * This module does not even begin to scratch the surface, except,
 * perhaps, as an example of a "plug-in" type module. There are
 * many functional hooks for modifying users, groups, content, templates,
 * global content blocks, on insertion, deletion, change, and much, much more.
 * For the definitive list of these functions, look at the base class:
 * 
 * CMS_ROOT/lib/classes/class.module.inc.php
 * 
 * It's good readin', and it tells you everything you need to know. I
 * learn something new every time I look at it.
 * 
 * Furthermore, when this Languages module was started, there was a paucity
 * of documentation on the CMS Made Simple site. This is no longer the
 * case. Automatic API documentation can be found at
 * http://cmsmadesimple.org/apidoc/CMS/CMSModule.html
 *
 * Also, a continuously improving documentation project can be found
 * at http://wiki.cmsmadesimple.org/index.php/Creating_Modules
 * 
 * 1. Directory Structure
 * ----------------------
 * 
 * Underneath this current directory, there are "lang" and "templates"
 * directories. The magic of the CMS module interface system is such
 * that files within those directories are automatically available to
 * your module, particularly when it comes to localization and
 * smarty templates.
 * 
 * 2. Localization
 * ---------------
 * 
 * In the "lang" directory, you can create your language files.
 * Note that the newest structure involves a directory per language,
 * with the default language in the top level, so, for example,
 * if you're writing the module in US English, your US English
 * language files would be in lang/en_US.php, while your
 * Swedish language files would be in lang/ext/sv_SE.php.
 * 
 * Read more about localization at
 * http://wiki.cmsmadesimple.org/index.php/Creating_Modules#Enable_translations_from_the_Translation_Center
 * 
 * For each localized word, create an entry in that file of the form:
 * 
 * $lang['word'] = 'Localized Version of Word';
 * 
 * Now, withing your module, any time you want a localized version of the
 * word, you simply refer to:
 *
 * $this->Lang('word')
 * 
 * Substitution is also possible for your localized phrase. Say you want to
 * include a number in a string. You could then use syntax like:
 * 
 * $lang['number_phrase'] = 'Localized Version has %s numbers.';
 * 
 * and in your code, refer to 
 * 
 * $this->Lang('number_phrase', $number)
 * 
 * where the value of the variable $number will replace the %s in
 * the localized string.
 * 
 * 3. Templates
 * ------------
 * 
 * Smarty is built-in to the module API. Templates are assumed to be in the
 * "templates" directory of the module. See the DisplayAdminPrefs method
 * below (or the file method.admin_prefs.php).
 * 
 * Nowadays its better to create templates in the database so you can give
 * users the ability to modify templates as they wish. Take a look at News
 * module to get picture of how its done.
 * 
 * 4. Admin Icons
 * --------------
 * 
 * If your module has an Admin panel, and you'd like to give it a custom
 * icon, simply create a directory called "images" and place your icon in
 * that directory with the name "icon.gif" This is only guaranteed to work
 * with the default admin theme.
 * 
 * 5. Separation of Files
 * --------------
 * 
 * With the release of CMS Made Simple 0.12 or thereabouts, it became
 * possible to split a lot of the module functionality into separate files, rather
 * than requiring all of the module to be implemented in one big monolithic
 * chunk. This reduces the overall memory footprint of the module, which
 * becomes important for huge modules.
 * 
 * This is described in more detail below in the Separable Methods comment
 * as well as the comment for the DoAction.
 * 
 * Note that you do not have to split your module into multiple files. It's
 * your choice! If your module is small, it's probably not necessary. Then again,
 * good coding (for a noncompiled language, anyway) suggests that you don't
 * include a bunch of extraneous code each time your module loads. In the
 * end, it's your call.
 * 
 * 6. Events / Event Hooks
 * -----------------------
 * 
 * This is an exciting new feature that's been added to the CMS Made Simple
 * core. It allows modules to create events, issue events, and subscribe to
 * events. What this does is enable an unprecedented degree of flexibility
 * and interaction between modules. You'll see elements of this sprinkled
 * throughout this file.
 * 
 * 7. Input parameter sanitizing
 * -----------------------------
 * 
 * Starting from 1.1 version of CMSMS module developers are urged to take closer
 * look of what parameters their module accepts and how they are sanitized.
 * 
 * Few new API functions are introduced, all parameters should be mapped for
 * everything to work smoothly. Use $this->SetParameterType('paramname',TYPE); 
 * to clean your input parameters (possible types are CLEAN_INT, CLEAN_STRING,
 * CLEAN_FLOAT, CLEAN_STRING)
 */


#-------------------------------------------------------------------------
# Module: Languages - a pedantic "starting point" module
# Version: 1.8, SjG
#
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2010 by Ted Kulp (wishy@cmsmadesimple.org)
# This project's homepage is: http://www.cmsmadesimple.org
# The module's homepage is: http://dev.cmsmadesimple.org/projects/languages/
#
#-------------------------------------------------------------------------
#
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
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


#-------------------------------------------------------------------------
/**
 * Your initial Class declaration. This file's name must
 * be "[class's name].module.php", or, in this case,
 * Languages.module.php
 */ 


/**
 * Languages example class
 *
 * @author Your Name
 * @since 1.0
 * @version $Revision: 3827 $
 * @modifiedby $LastChangedBy: wishy $
 * @lastmodified $Date: 2007-03-12 11:56:16 +0200 (Mon, 12 Mar 2007) $
 * @license GPL
 **/
class Languages extends CMSModule
{
  
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
    return 'Languages';
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
    return '1.8';
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
    return 'SjG';
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
    return 'sjg@cmsmodules.com';
  }
  
  /**
   * GetChangeLog()
   * This returns a string that is presented in the module
   * Admin if you click on the About link. It helps users
   * figure out what's changed between releases.
   * See the note on localization at the top of this file.
   *
   * If your changelog gets really big, you might replace
   * this with an "include" rather than keep it in the Lang
   * file. But then, you'd lose the ability to translate
   * your changelog.
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
   * {Languages param1=val...}
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
    return 'extensions';
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
   * who have "Use Languages" permissions.
   * @return bool True if this module is shown to current user
   */
  function VisibleToAdminUser()
  {
    return $this->CheckPermission('Use Languages');
  }
  
  /**
   * GetDashboardOutput()
   * A capability of modules that is not currently supported in CMSMS 1.6.x
   * is to output notices to the initial Dashboard page of the Admin area.
   * You could use this to post any kind of notification.
   *
   * This example posts the number of database records that
   * have been added via the module.
   *
   * @return string dashboard output
   */
  function GetDashboardOutput() 
  {
	global $gCms;
	$db = &$gCms->GetDb();

	$rcount = $db->GetOne('select count(*) from '.cms_db_prefix().'module_languages');
	
    return $this->Lang('dash_record_count',$rcount);
  }

  /**
   * In the Admin Area, there are notices which can be displayed to the admin user.
   * These tend to be for high-priority notices, like version upgrades, security issues,
   * un-configured modules, etc.
   * These notices are assigned a priority from 1 to 3, with 1 being the highest.
   * (priority filtering is not yet supported, but will be).
   * Notices should be used very sparingly, as if there are too many alerts, the user
   * will stop paying attention.
   * That being said, this example will post an alert until someone adds a records
   * using the Languages Module.
   * 
   * @returns a stdClass object with two properties.... priority (1->3)... and
   * html, which indicates the text to display for the Notification.
   */
  function GetNotificationOutput($priority=2) 
  {
	global $gCms;
	$db = &$gCms->GetDb();
	$rcount = $db->GetOne('select count(*) from '.cms_db_prefix().'module_languages');
    if ($priority < 4 && $rcount == 0 )
      {
	  $ret = new stdClass;
	  $ret->priority = 2;
	  $ret->html=$this->Lang('alert_no_records');
	  return $ret;
      }  
	return '';
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
    return "1.9-beta1";
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
  

  function MaximumCMSVersion()
  {
    return "2.0";
  }

  /**
   * SetParameters()
   * This function serves as a module initialization area.
   * Specifically, it enables you to:
   * 1) Simplify your module's tag (if you're writing a plug-in module)
   * 2) Create mappings for your module when using "Pretty Urls".
   * 3) Impose security by controlling incoming parameters
   * 4) Register the events your module handles 
   *
   * 1. Simply module tag:
   * Simple!
   * Calling RegisterModulePlugin allows you to use the tag {Languages} in your
   * template or page; otherwise, you would have to use the more cumbersome
   * tag {cms_module module='Languages'}
   *
   * 2. Pretty URLS:
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
   * 3. Security:
   * By using the RestrictUnknownParams function, your module will not
   * receive any parameters other than the ones you declare here.
   * Furthermore, the parameters your module does receive will be filtered
   * according to the rules you set here.
   *
   * 4. Event Handling
   * If your module generates events, you register that fact in your install method
   * (see method.install.php for an example of this). However, if your module will
   * handle/process/consume events generated by the Core or other modules, you
   * can register that in this method.
   * 
   */ 

  function SetParameters()
  {
   /*
    * 1. Simply module tag
    * This next line allows you to use the tag {Languages} in your template or page; otherwise,
    * you would have to use the more cumbersome tag {cms_module module='Languages'}
    */
  $this->RegisterModulePlugin();

   /*
    * 2. Pretty URLS
    *

    For example:
    $this->RegisterRoute('/languages\/add\/(?P<languages_id>[0-9]+)\/(?P<returnid>[0-9]+)$/',
		 array('action'=>'default'));

    now, any url that looks like:
    /languages/view/3/5
    would call the default action, with:
    $params['languages_id'] set to 3
    and $returnid set to 5

	Be sure to take a look in action.default.php, where the links are created for viewing, editing, and adding
	records. You'll see that the CreateFrontendLink takes all the parameters to create a link for non-pretty
	URLs, but also takes a string parameter which is a fully-assembled Pretty URL. Just registering the routes
	is not enough; you module's links need to create the URLs on their side as well.
    */
	$this->RegisterRoute('/languages\/view\/(?P<languages_id>[0-9]+)\/(?P<returnid>[0-9]+)$/',array('action'=>'default'));
	$this->RegisterRoute('/languages\/edit\/(?P<languages_id>[0-9]+)\/(?P<returnid>[0-9]+)$/',array('action'=>'add_edit'));
	$this->RegisterRoute('/languages\/add\/(?P<returnid>[0-9]+)$/',array('action'=>'add_edit'));

   /*
	* 2a. Custom URLs for Specific Content
	*

	As of CMSMS 1.9, you can create a specific URL and map it to whatever you want. Say you knew that the
	record with languages_id = 1 was going to be a special record, and you wanted to associate it with the URL:

	http://yoursite.com/this/is/insanely/great/stuff 

	To do this, you'd register a route with the correct paramters using the CMS Route Manager:
	*/
	
	$gCms = cmsms();
	$contentops = $gCms->GetContentOperations();
	$returnid = $contentops->GetDefaultContent();
	// The previous three lines are to get a returnid; many modules, like News, have a default
	// page in which to display detail views. In that case, the page_id would be used for returnid.
	
	// The next three lines are where we map the URL to our detail page.
	$parms = array('action'=>'default','languages_id'=>1,'returnid'=>$returnid);
	$route = new CmsRoute('this/is/insanely/great/stuff',$this->GetName(),$parms,TRUE);
	cms_route_manager::register($route);
	
   /*
    * 3. Security
    *
    */
   // Don't allow parameters other than the ones you've explicitly defined
   $this->RestrictUnknownParams();
  
   // syntax for creating a parameter is parameter name, default value, description
   $this->CreateParameter('languages_id', -1, $this->Lang('help_languages_id'));
   // languages_id must be an integer
   $this->SetParameterType('languages_id',CLEAN_INT);

   // module_message must be a string
   $this->CreateParameter('module_message','',$this->Lang('help_module_message'));
   $this->SetParameterType('module_message',CLEAN_STRING);

   // description must be a string
   $this->CreateParameter('description','',$this->Lang('help_description'));
   $this->SetParameterType('description',CLEAN_STRING);

   // explanation must be a string
   $this->CreateParameter('explanation','',$this->Lang('help_explanation'));
   $this->SetParameterType('explanation',CLEAN_STRING);
   
   $this->CreateParameter('lang','',$this->Lang('lang'));
   $this->SetParameterType('lang',CLEAN_STRING);

   /*
    * 4. Event Handling
    *
   
    Typical example: specify the originator, the event name, and whether or not
    the event is removable (used for one-time events)

    $this->AddEventHandler( 'Core', 'ContentPostRender', true );
    */
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
   * DoEvent()
   * If your module receives/handles/processes events generated
   * by the core or by other modules, you will need to provide
   * this method to do whatever it is you're going to do.
   * Other than the event details, the parameters passed to your
   * method depend entirely on the event originator. You can
   * see what those parameters are by clicking on the Information
   * button for the event in the Admin > Extensions > Event Manager
   *
   * @param string originator where the event originated, e.g. "Core",
   * "News", etc.
   * @param string eventname the name of the event
   * @param mixed params the parameters passed by the event initiator

    function DoEvent( $originator, $eventname, &$params )
	{
	if ($originator == 'Core' && $eventname == 'ContentPostRender')
		{
		// stupid example -- lowercases entire output
		$params['content'] = strtolower($params['content']);
		}
	}
   */

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
  
  /**
   * Your methods here
   * 
   * This would be a good place to define some general methods for your module
   * 
   * Its a good practice to have underscore in front of your own methods
   */
  function _SetStatus($oid, $status) {
    //...
  }

  /**
   * DoAction($action, $id, $params, $returnid)
   * This is the main function that gets called if your module
   * is a plug-in type module.
   * 
   * In general, you'll want to call various different
   * methods, depending upon the requested "action."
   *   
   * There are two built-in actions: "default" which gets
   * called if the module is accessed from a page or template,
   * and "defaultadmin" which gets called from the Admin
   * panel.
   *   
   * The Action can be overridden by passing a different
   * action either in your tag, e.g.,
   * {cms_module module='Languages' action='something'}
   * or by passing it in a link create by the CreateLink
   * method. 
   *
   * Similar to the Separable Methods described above,
   * you can actually remove all of the actions into separate
   * files as well. When the module API calls your module
   * with an action, it checks first to see if the DoAction method
   * exists. If it does, it gets used normally. If it doesn't exists,
   * the file corresponding to that method gets loaded and called.
   * 
   * For example, the default method would either be accessed
   * via the DoAction method being called with an action of 'default', or,
   * if no DoAction method exists in the module, the API would
   * execute the file named "action.default.php" in this module
   * directory.
   * 
   * As with the other Separable Methods above, I'm leaving
   * the methods in this main file, but commenting them out,
   * and doing the implementation in the separate files.
   * 
   * You can implement your module either way, 
   */
  /** 
   * commented out, all needed actions are defined in seperate
   * files
  function DoAction($action, $id, $params, $returnid=-1)
  {
    switch ($action) {
    case 'default':
      {
	// this is the plug-in side, i.e., non-Admin
	$this->DisplayModuleOutput($action, $id, $params);
	break;
      }
    case 'defaultadmin':
      {
	// only let people access module preferences if they have permission
	if ($this->CheckPermission('Use Languages'))
	  {
	    $this->DisplayAdminPanel($id, $params, $returnid);
	  }
	else
	  {
	    $this->DisplayErrorPage($id, $params, $returnid,
				    $this->Lang('accessdenied'));
	  }
	break;
      }
    case 'save_admin_prefs':
      {
	// only let people save module preferences if they have permission
	
	if ($this->CheckPermission('Use Languages'))
	  {
	    $this->SaveAdminPrefs($id, $params, $returnid);
	  }
	break;
      }
    }
  }
  */
	
	
	function RefreshLangFields() {
		global $gCms;
		$db = &$gCms->GetDb();
		
		$language_list = $this->GetPreference('launguage_list');
		if (!empty($language_list)) {
			$langs_temp = explode(',', $language_list);
			if (count($langs_temp) > 0) {
				
				$query = "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='".$db->database."' AND `TABLE_NAME` = '".cms_db_prefix()."module_languages_vars' AND `COLUMN_NAME` LIKE 'value_%'";
				
				$fields = $db->GetArray($query);
				
				$existing = array();
				if (is_array($fields) && count($fields) > 0) {
					foreach ($fields as $key => $val) {
						$existing[] = $val['COLUMN_NAME'];
					}
				}
				
				foreach ($langs_temp as $val) {
					if (!in_array($val, $existing)) {
						$query = "ALTER TABLE  `".cms_db_prefix()."module_languages_vars` ADD  `value_".$val."` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ;";
						$db->Execute($query);
					}
				}
				
				
			}
		}
	}
	
	function GetNamesAndFields() {
		
		$fields_to_show = array();
		$names_to_show = array();
		
		$language_list = $this->GetPreference('launguage_list');
		$main_language = $this->GetPreference('main_language','lt');

		if (!empty($language_list)) {
			$langs_temp = explode(',', $language_list);
			if (count($langs_temp) > 0) {
				$fields_to_show[$main_language] = 'value_'.$main_language;
				$names_to_show[$main_language] = strtoupper($main_language);
				foreach ($langs_temp as $key => $val) {
					$fields_to_show[$val] = 'value_'.$val;
					$names_to_show[$val] = strtoupper($val);
				}
			}
			
		}
		
		return array($fields_to_show, $names_to_show);
	}
	
	function default_values() {
		global $gCms;
		$db = &$gCms->GetDb();
		
		require_once("standartiniai_vertimai.php");
			
		foreach ($val as $k=>$v){
			foreach($v as $k1=>$v1){
				$tmp = ""; $tmp2 = '' ;
				if (file_exists($gCms->config['root_path'].'/tmp/languages/'.$k1.'.conf')){
					$tmp = "value_{$k1}='{$v1}'";
					$tmp2 = "value_{$k1} = ''";
					
					$db->Execute("UPDATE ".cms_db_prefix()."module_languages_vars SET {$tmp} WHERE system_name='{$k}' and {$tmp2}");
				}
			}
		}	
	}
	
	function refreshFiles() {
		global $gCms;
		$db = &$gCms->GetDb();
		
		$tables = array(
			0 => array(
				'table_name' => cms_db_prefix().'module_templates',
				'mod_field' => 'module_name',
				'temp_name_field' => 'template_name',
				'temp_content_field' => 'content',
				'name' => $this->Lang('module_templates')
			),
			1 => array(
				'table_name' => cms_db_prefix().'templates',
				'mod_field' => '',
				'temp_name_field' => 'template_name',
				'temp_content_field' => 'template_content',
				'name' => $this->Lang('templates')
			)
		);
		
		$lang_vars = array();
		
		foreach ($tables as $k1 => $val) {
		  
			$query = "SELECT * FROM ".$val['table_name']."";
			$result = $db->GetArray($query);
			foreach ($result as $k => $v) {
				if ($db->getOne("SELECT active FROM ".cms_db_prefix()."modules WHERE module_name='{$v['module_name']}'") || $k1){
				
				$fts = $v[$val['temp_content_field']];
				while (($start = strpos($fts, '{#')) !== false) {
					$end = strpos($fts, '#}', $start);
					
					$the_name = substr($fts, $start+2, ($end - $start - 2));
					$sys_anme = array('value' => $the_name, 'title' => $val['name'].' '.(!empty($val['mod_field'])?$v[$val['mod_field']].' ':'').$v[$val['temp_name_field']]);
					if (substr($sys_anme['value'], 0, 1) != '$') {
						if (isset($lang_vars[$the_name])) {
							$lang_vars[$the_name]['title'] .= "\n".$sys_anme['title'];
						} else {
							$lang_vars[$the_name] = $sys_anme;
						}
					}
					//echo $start.' '.$end.' '.substr($fts, $start+2, ($end - $start - 2)).'<br/>';
					$fts = substr($fts, $end+2);
				}
				
				$fts = $v[$val['temp_content_field']];
				while (($start = strpos($fts, '{$smarty.config.')) !== false) {
					$end = strpos($fts, '}', $start);
					
					$the_name = substr($fts, $start+16, ($end - $start - 16));
					$sys_anme = array('value' => $the_name, 'title' => $val['name'].' '.(!empty($val['mod_field'])?$v[$val['mod_field']].' ':'').$v[$val['temp_name_field']]);
					
					if (substr($sys_anme['value'], 0, 1) != '$') {
						if (isset($lang_vars[$the_name])) {
							$lang_vars[$the_name]['title'] .= "\n".$sys_anme['title'];
						} else {
							$lang_vars[$the_name] = $sys_anme;
						}
					}
					
					$fts = substr($fts, $end+1);
				}
			}
		 }
		}
		
		/**nuskaitymas is moduliu**/
		
		$query = "SELECT * FROM ".cms_db_prefix()."modules WHERE active = 1";
		$mods = $db->GetArray($query);
		if ($mods > 0) {
			
			foreach ($mods as $kk => $vv) {
				
				$destdir = $_SERVER['DOCUMENT_ROOT'].'/modules/'.$vv['module_name'].'/templates';
				$count_img = 0;
				
				if ($handle = opendir($destdir)) {
					
					while (false !== ($entry = readdir($handle))) {
						//echo "$entry\n";
						if (!empty($entry) && $entry != '.' && $entry != '..') {
							//echo $destdir.'/'.$entry;
							$fts_t = file_get_contents($destdir.'/'.$entry);
							
							
							$fts = $fts_t;
							while (($start = strpos($fts, '{#')) !== false) {
								$end = strpos($fts, '#}', $start);
								
								$the_name = substr($fts, $start+2, ($end - $start - 2));
								$sys_anme = array('value' => $the_name, 'title' => $vv['module_name'].' '.$entry);
								if (substr($sys_anme['value'], 0, 1) != '$') {
									if (isset($lang_vars[$the_name])) {
										$lang_vars[$the_name]['title'] .= "\n".$sys_anme['title'];
									} else {
										$lang_vars[$the_name] = $sys_anme;
									}
								}
								//echo $start.' '.$end.' '.substr($fts, $start+2, ($end - $start - 2)).'<br/>';
								$fts = substr($fts, $end+2);
							}
							
							$fts = $fts_t;
							while (($start = strpos($fts, '{$smarty.config.')) !== false) {
								$end = strpos($fts, '}', $start);
								
								$the_name = substr($fts, $start+16, ($end - $start - 16));
								$sys_anme = array('value' => $the_name, 'title' => $vv['module_name'].' '.$entry);
								
								if (substr($sys_anme['value'], 0, 1) != '$') {
									if (isset($lang_vars[$the_name])) {
										$lang_vars[$the_name]['title'] .= "\n".$sys_anme['title'];
									} else {
										$lang_vars[$the_name] = $sys_anme;
									}
								}
								
								$fts = substr($fts, $end+1);
							}
							
						}
					}
					
					closedir($handle);
				}
				
			}
			/*echo '<pre>';
			print_r($lang_vars);
			die;*/
		}
		//die;
		/***/
		if (count($lang_vars) > 0) {
			foreach ($lang_vars as $key => $val) {
				$query = "SELECT id FROM ".cms_db_prefix()."module_languages_vars WHERE system_name = ?";
				$one_id = $db->GetOne($query, array($val['value']));
				
				if ($one_id > 0) {
					$query = "UPDATE ".cms_db_prefix()."module_languages_vars SET files = ?, up_date = NOW() WHERE id = ?";
					$db->Execute($query, array($val['title'], $one_id));
				} else {
					$query = "INSERT INTO ".cms_db_prefix()."module_languages_vars SET system_name = ?, files = ?, cr_date = NOW()";
					$db->Execute($query, array($val['value'], $val['title']));
				}
			}
			
		}
		
		$this->populateLang();
	}
	
	function readConfigFile() {
		global $gCms;
		$db = &$gCms->GetDb();
		
		$language_list = $this->GetPreference('launguage_list');
		
		$language_arr = explode(',', $language_list);
		
		
		foreach ($language_arr as $key => $val) {
			$path = $gCms->config['root_path'].'/languages/'.$val.'.conf';
			
			if(is_file($path)){
				$this->smarty->config_load($path);
				$langfile = $this->smarty->get_config_vars();
				
				foreach ($langfile as $kk => $vv) {
					$query = "SELECT id FROM ".cms_db_prefix()."module_languages_vars WHERE system_name = ?";
					$one_id = $db->GetOne($query, array($kk));
					
					if ($one_id > 0) {
						$query = "UPDATE ".cms_db_prefix()."module_languages_vars SET value_".$val." = ?, up_date = NOW() WHERE id = ?";
						$db->Execute($query, array($vv, $one_id));
					} else {
						$query = "INSERT INTO ".cms_db_prefix()."module_languages_vars SET system_name = ?, value_".$val." = ?, cr_date = NOW()";
						$db->Execute($query, array($kk, $vv));
					}
				}
			}
		}
		
		$this->populateLang();
	}
	
	function populateLang() {
		global $gCms;
		$db = &$gCms->GetDb();
		
		$language_list = $this->GetPreference('launguage_list');
		
		$language_arr = explode(',', $language_list);
		
		if (count($language_arr) > 0) {
		
			foreach ($language_arr as $key => $val) {
			
				$query = "SELECT system_name, value_".$val." as t_value FROM ".cms_db_prefix()."module_languages_vars";
				
				$result = $db->GetArray($query, array());
				
				$lang_content = '';
				
				if (is_array($result) > 0 && count($result) > 0) {
					foreach ($result as $kk => $vv) {
						if (!empty($vv['t_value'])) {
							$lang_content .= $vv['system_name'].' = '.$vv['t_value']."\n";
						}
					}
				}
				
				$destdir = $_SERVER['DOCUMENT_ROOT'].'/tmp/languages';
				$file = $val.'.conf';
				
				if (!file_exists($destdir)) {
					mkdir($destdir, 0777);
				}
				
				
				$fp = fopen($destdir.'/'.$file, 'w');
				
				fwrite($fp, $lang_content);
				fclose($fp);
				
			}
		
		}
		
	}
} //end class
?>
