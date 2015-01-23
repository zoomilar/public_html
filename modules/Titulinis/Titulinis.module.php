<?php


class Titulinis extends CMSModule
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
    return '1.6';
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
   * {cms_module module='Titulinis' param1=val param2=val...}
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
   * who have "Use Titulinis" permissions.
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
  

} 



?>
