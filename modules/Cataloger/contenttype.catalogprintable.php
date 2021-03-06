<?php
#-------------------------------------------------------------------------
# Module: Cataloger - build a catalog or portfolio of stuff
# Version: 0.12
#
# Copyright (c) 2012, Fernando Morgado (JoMorg) jomorg.morg@gmail.com
# Copyright (c) 2006, Samuel Goldstein <sjg@cmsmodules.com>
# For Information, Support, Bug Reports, etc, please visit the
# CMS Made Simple Forge at http://dev.cmsmadesimple.org
#
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2006 by Ted Kulp (wishy@cmsmadesimple.org)
# This project's homepage is: http://www.cmsmadesimple.org
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
require_once(dirname(__FILE__).'/contenttype.catalogitem.php');

class CatalogPrintable extends CMSModuleContentType
#class CatalogPrintable extends Content
{
  var $attrs;

  function ModuleName()
  {
    return 'Cataloger';
  }

  function IsCopyable()
  {
  return true;
  }

	
  function SetProperties()
  {
 	 parent::SetProperties();
  	$this->getUserAttributes();
    foreach ($this->attrs as $thisAttr)
      {
	  $this->AddExtraProperty($thisAttr->attr);
      }

    $this->AddExtraProperty('sort_order');
    $this->AddExtraProperty('sub_template');
    $this->AddExtraProperty('fieldlist');
		
#Turn on preview
    $this->mPreview = true;

#Turn off caching
    $this->mCachable = false;
  }

  function getUserAttributes()
  {
	#$module = $this->GetModuleInstance('Cataloger');
    $module = cms_utils::get_module('Cataloger');
	$vars = $module->getUserAttributes('catalog_print_attrs');
	$this->attrs = &$vars['catalog_print_attrs'];
  }

  function &getAttrs()
    {
      $this->getUserAttributes();
      return $this->attrs;
    }

  function GetCreationDate()
  {
    return $this->mCreationDate;
  }
	
  function GetModifiedDate()
  {
    return $this->mModifiedDate;
  }

  function TabNames()
  {
    return array(lang('main'), lang('options'), $this->lang('Owner'));
  }

  function EditAsArray($adding = false, $tab = 0, $showadmin=false)
  {
    $gCms = cmsms();
    $config = $gCms->GetConfig();
    $db = $gCms->GetDb();
    $wysiwyg = (strlen(get_preference(get_userid(), 'wysiwyg')) > 0);
    $ret = array();
    $stylesheet = '';
    if ($this->TemplateId() > 0)
      {
	$stylesheet = '../stylesheet.php?templateid='.$this->TemplateId();
      }
    else
      {
	$templateops = $gCms->GetTemplateOperations();
	$defaulttemplate = $templateoperations->LoadDefaultTemplate();
	if (isset($defaulttemplate))
	  {
	    $this->mTemplateId = $defaulttemplate->id;
	    $stylesheet = '../stylesheet.php?templateid='.$this->TemplateId();
	  }
      }

    if ($tab == 0)
      {
        $query = "SELECT id, title FROM ".
	  cms_db_prefix()."module_catalog_template WHERE type_id=3 ORDER by title";
        $subTemplates = array();
        $dbresult = $db->Execute($query);

	$templateops = $gCms->GetTemplateOperations();
        while ($dbresult !== false && $row = $dbresult->FetchRow())
	  {
	    $subTemplates[$row['title']]=$row['id'];
	  }		
   $ret[] = $this->display_single_element('title', $adding);
   $ret[] = $this->display_single_element('menutext', $adding);
   $ret[] = $this->display_single_element('parent', $adding);

	array_push($ret,array($this->Lang('namepage').' '.lang('template'),$templateops->TemplateDropdown('template_id', $this->mTemplateId)));
	$module = $this->GetModuleInstance();
	
	array_push($ret,array($this->Lang('Sub').' '.lang('template'),$module->CreateInputDropdown('', 'sub_template', $subTemplates, -1, $this->GetPropertyValue('sub_template'))));
        
	$this->getUserAttributes();
    foreach ($this->attrs as $thisAttr)
       {
		$ret[] = $module->attributeInput($this, $thisAttr, $wysiwyg, $stylesheet);
		}
    }
    if ($tab == 1)
      {
	$so = $this->GetPropertyValue('sort_order');
	if ($so == '')
	  {
	    $so = get_site_preference('Cataloger_mapi_pref_printable_sort_order', 'natural');
	  }

	$module = $this->GetModuleInstance();
	array_push($ret,array($this->Lang('title_global_item_sort_order2'),$module->CreateInputDropdown('', 'sort_order',
									   array($this->Lang('natural_order')=>'natural', $this->Lang('alpha_order')=>'alpha'), -1, $so)));

   $item = new CatalogItem();
	$itemAttrs = $item->getAttrs();
	$attrPick = '';
	$selAttrs = explode(',',$this->GetPropertyValue('fieldlist'));

	foreach ($itemAttrs as $thisAttr)
	  {
	    $attrPick .= '<input type="checkbox" name="fieldlist[]" value="'.$thisAttr->attr.'" ';
	    if (in_array($thisAttr->attr,$selAttrs))
	      {
		$attrPick .= ' checked="checked"';
	      }
	    $attrPick .= ' />&nbsp;'.$thisAttr->attr.'<br />';
	  }
	array_push($ret,array($this->Lang('which_attributes'),$attrPick));
      }
    if ($tab == 2)
      {        
        global $CMS_VERSION;
        $ret[] = $this->display_single_element('active', $adding);
        $ret[] = $this->display_single_element('showinmenu', $adding);
        $ret[] = $this->display_single_element('secure', $adding);
        $ret[] = $this->display_single_element('alias', $adding);

        if (version_compare($CMS_VERSION, '1.9-beta1') > -1)
           {
           $ret[] = $this->display_single_element('page_url', $adding);
           }

        $ret[] = array(lang('metadata').':', create_textarea(false, $this->Metadata(), 'metadata', 'pagesmalltextarea', 'metadata', '', '', '80', '6'));
        $ret[] = $this->display_single_element('titleattribute', $adding);
        $ret[] = $this->display_single_element('tabindex', $adding);
        $ret[] = $this->display_single_element('accesskey', $adding);
        $ret[] = $this->display_single_element('owner', $adding);
        $ret[] = $this->display_single_element('additionaleditors', $adding);
      }
    return $ret;
  }

  function FillParams($params,$editing = true)
  {
    $gCms = cmsms();
    $config = $gCms->GetConfig();
    $db = $gCms->GetDb();
    $this->mCachable = false;

    if (isset($params))
      {
	$parameters = array('sub_template', 'sort_order');

	foreach ($parameters as $oneparam)
	  {
	    if (isset($params[$oneparam]))
	      {
		$this->SetPropertyValue($oneparam, $params[$oneparam]);
	      }
	  }
			
	$this->getUserAttributes();
	foreach ($this->attrs as $thisAttr)
	  {
	    if (isset($params[$thisAttr->safe]))
	      {
			$this->SetPropertyValue($thisAttr->attr, $params[$thisAttr->safe]);
	      }
	  }

	if (isset($params['title']))
	  {
	    $this->mName = $params['title'];
	  }
	if (isset($params['menutext']))
	  {
	    $this->mMenuText = $params['menutext'];
	  }
	if (isset($params['template_id']))
	  {
	    $this->mTemplateId = $params['template_id'];
	  }
	if (isset($params['alias']))
	  {
	    $this->SetAlias($params['alias']);
	  }
	else
	  {
	    $this->SetAlias('');
	  }
	if (isset($params['parent_id']))
	  {
	    if ($this->mParentId != $params['parent_id'])
	      {
		$this->mHierarchy = '';
		$this->mItemOrder = -1;
	      }
	    $this->mParentId = $params['parent_id'];
	  }
	if (isset($params['active']))
	  {
	    $this->mActive = true;
	  }
	else
	  {
	    $this->mActive = false;
	  }
	if (isset($params['showinmenu']))
	  {
	    $this->mShowInMenu = true;
	  }
	else
	  {
	    $this->mShowInMenu = false;
	  }
	  
			if (isset($params['metadata']))
				$this->mMetadata = $params['metadata'];
			if (isset($params['accesskey']))
				$this->mAccessKey = $params['accesskey'];
			if (isset($params['titleattribute']))
				$this->mTitleAttribute = $params['titleattribute'];
			if (isset($params['tabindex']))
				$this->mTabIndex = $params['tabindex'];
				
    $this->mCachable = false;

	if (isset($params['fieldlist']))
	  {
	    if (! is_array($params['fieldlist']))
	      {
		    $params['fieldlist'] = array($params['fieldlist']);
	      }

	    $this->SetPropertyValue('fieldlist', implode(',',$params['fieldlist']));
	  }
      }
		parent::FillParams($params);
	}


  function PopulateParams(&$params)
  {
    $gCms = cmsms();
    $config = $gCms->GetConfig();
    $db = $gCms->GetDb();

    $parameters = array('sub_template', 'sort_order','fieldlist');
    foreach ($parameters as $oneparam)
      {
	$tmp = $this->GetPropertyValue($oneparam);
	if (isset($tmp) && ! empty($tmp))
	  {
	    $params[$oneparam] = $tmp;
	  }
      }
		
   $this->getUserAttributes();
   $safeattrlist = array();

	foreach ($this->attrs as $thisAttr)
		{
		$tmp = $this->GetPropertyValue($thisAttr->attr);
		if (isset($tmp) && $tmp!='')
	  		{
	    	$params[$thisAttr->safe] = $tmp;
			if (isset($thisAttr->alias) && $thisAttr->alias!='')
				{
				$params[$thisAttr->alias] = $tmp;
				}
			$thisSafeAttr = array();
			$thisSafeAttr['name']=ucfirst($thisAttr->attr);
			$thisSafeAttr['key']='{$'.$thisAttr->safe.'}';
			if ($thisAttr->alias != '')
				{
				$thisSafeAttr['aliaskey'] = '{$'.$thisAttr->alias.'}';
				}
			array_push($safeattrlist,$thisSafeAttr);
	      	}
		else
			{
			$params[$thisAttr->safe] = '';
			$params[$thisAttr->alias] = '';			
			}
	  }
    $params['title'] = $this->mName;
    $params['menutext'] = $this->mMenuText;
    $params['template_id'] = $this->mTemplateId;
    $params['alias'] = $this->mAlias;
    $params['parent_id'] = $this->mParentId;
    $params['active'] = $this->mActive;
    $params['showinmenu']=$this->mShowInMenu;
    $params['attrlist'] = $safeattrlist;
  }



  function Show($param = '')
  {
    if ($param == 'content_en')
    {
        $params = array();

        $this->PopulateParams($params);
        $pf = new Cataloger();

        @ob_start();
        $pf->DoAction('defaultprintable', 'catalogmodule', $params);
        $text = @ob_get_contents();
        @ob_end_clean();
        return '{literal}'.$text.'{/literal}';
    }
  }

  function FriendlyName()
  {
    return $this->Lang('catalog_printable');
  }

  protected function Update()
  {
    parent::Update();
    if( ($this->mOldAlias != $this->Alias()) && $this->mOldAlias && $this->Alias() )
      {
	cms_utils::get_module('Cataloger')->renameImages($this->mOldAlias,$this->Alias());
      }
  }

  protected function Insert()
  {
    parent::Insert();
    if( ($this->mOldAlias != $this->Alias()) && $this->mOldAlias && $this->Alias() )
      {
	cms_utils::get_module('Cataloger')->renameImages($this->mOldAlias,$this->Alias());
      }
  }
   
   //   New Methods to cope with API functions (JoMorg)
   
   /*Adds a new property*/
   function AddProperty($propName)
   {
       $this->AddExtraProperty($propName);    
   }
   
   function UpdatePropertyName($propName, $propNewName)
   {
       $tempValue = '';
       if ($this->is_known_property($propName))
       {
            $tempValue = $this->GetPropertyValue($propName);
            $this->RemoveProperty($propName,false);   
       }
       $this->AddExtraProperty($propName);
       $this->SetPropertyValue($propNewName, $tempValue);  
   }   
   
   function DeleteProperty($propName)
   {
        $this->RemoveProperty($propName,false);       
   }
}

# vim:ts=4 sw=4 noet
?>
