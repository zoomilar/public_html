<?php
/**
 * Class definition and methods for AdvancedContent contentblock types.<br />
 * All block types needs to inherit and extend this class!
 *
 * @package AdvancedContent
 * @category CMSModuleContentType
 * @license GPL
 * @author Georg Busch (NaN)
 * @copyright 2010-2013 Georg Busch (NaN)
 * @since 0.9
 * @abstract
 * @access public
 */
abstract class acContentBlockBase
{
	/**
	 * @ignore
	 */
	private $_properties = array('active' => true); // we shouldn't be here if the block is not active
	
	/**
	 * @ignore
	 */
	private $_content = NULL;
	
	/**
	 * @ignore
	 */
	protected $content_obj;
	
	/**
	 * @ignore
	 */
	protected $_header_html_called = false;
	
	/**
	 * Constructor.<br />
     * Required for all subclasses.<br />
     * Should be called from each subclass as the very first.
     * @param object $content_obj - the contentobject this block belongs to
     * @param array $params - the parameters of that contentblock
     */
	function __construct(&$content_obj, $params = array())
	{
		$this->content_obj = $content_obj;
		
		$AC = &ac_utils::get_module('AdvancedContent');
		
		$this->_properties['smarty']           = isset($params['smarty'])        ? $params['smarty']        : false;
		$this->_properties['editor_groups']    = isset($params['editor_groups']) ? $params['editor_groups'] : '';
		$this->_properties['editor_users']     = isset($params['editor_users'])  ? $params['editor_users']  : '';
		
		#deprecated
		$this->_properties['type']             = isset($params['block_type'])    ? $params['block_type']    : '';
		
		$this->_properties['name']             = isset($params['block'])         ? $params['block']         : 'content_en';
		$this->_properties['id']               = isset($params['block_id'])      ? $params['block_id']      : str_replace(array('-','+'), '_', munge_string_to_url($this->_properties['name']));
		$this->_properties['label']            = isset($params['label'])         ? $params['label']         : ucwords($this->_properties['name']);
		$this->_properties['default']          = isset($params['default'])       ? $params['default']       : '';
		$this->_properties['style']            = isset($params['style'])         ? $params['style']         : ''; # deprecated
		$this->_properties['page_tab']         = isset($params['page_tab'])      ? $params['page_tab']      : ( isset($params['tab']) ? $params['tab'] : 'main' );
		$this->_properties['block_tab']        = isset($params['block_tab'])     ? $params['block_tab']     : '';
		$this->_properties['block_group']      = isset($params['block_group'])   ? $params['block_group']   : '';
		$this->_properties['description']      = isset($params['description'])   ? $params['description']   : '';
		
		$this->_properties['translate_labels'] = (isset($params['translate_labels']) && ac_utils::IsTrue($params['translate_labels']));
		$this->_properties['translate_values'] = (isset($params['translate_values']) && ac_utils::IsTrue($params['translate_values']));
		$this->_properties['required']         = (isset($params['required'])         && ac_utils::IsTrue($params['required']));
		$this->_properties['allow_none']       = !(isset($params['allow_none'])      && ac_utils::IsFalse($params['allow_none']));
		$this->_properties['no_collapse']      = (isset($params['no_collapse'])      && ac_utils::IsTrue($params['no_collapse']));
		$this->_properties['collapsible']      = !$this->_properties['no_collapse']  && $this->_properties['type'];
		
		if(!$this->_properties['collapsible'])
			$this->_properties['collapse'] = false;
		else
			$this->_properties['collapse'] = isset($params['collapse']) ? !ac_utils::IsFalse($params['collapse']) : $AC->GetPreference('collapse_block_default', true);
		
		$this->_properties['feu_access'] = isset($params['feu_access']) ? $params['feu_access'] : ''; 
		$this->_properties['feu_action'] = (isset($params['feu_action']) && ac_utils::IsTrue($params['feu_action']));
		$this->_properties['feu_hide']   = (isset($params['feu_hide'])   && ac_utils::IsTrue($params['feu_hide']));
		
		if(!empty($params['assign']))
			$this->_properties['assign'] = str_replace(array('-','+'), '_', munge_string_to_url($params['assign']));
	}
	
	/**
	 * Backwards compatibility
	 * @ignore
	 * @internal
	 * @deprecated
	 */
	public function __call($name, $arguments = array()) 
	{
		$_name = str_replace('Block', '', $name);
		$config = cmsms()->GetConfig();
		if($config['debug'])
			trigger_error('AdvancedContent blocktype method "' . $name . '()" is deprecated! Use "' . $_name . '()" instead.', E_USER_WARNING);
		if(method_exists($this, $_name))
			return $this->$_name(isset($arguments[0]) ? $arguments[0] : NULL, isset($arguments[1]) ? $arguments[1] : NULL, isset($arguments[2]) ? $arguments[2] : NULL);
		return false;
	}
	
	
	/**
	 * Returns the type of a contentblock
	 * @return string
	 */
	public final function Type()
	{
		$class = get_class($this);
		if(strpos($class, "acBlockType_") === false)
			return AC_INVALID_BLOCK_TYPE;
		return substr($class, strlen("acBlockType_"));
	}
	
	/**
	 * Sets the value of a property. If not exists it will be created.
	 * @param string $name - the name of the property
	 * @param string $value - the value of the property
	 */
	public final function SetProperty($name, $value = '')
	{
		$this->_properties[strtolower($name)] = $value;
	}
	
	/**
	 * Returns the value of a property.
	 * @param string $name - the name of the property
	 * @param string $default - the default value of the property if not exists
	 * @return mixed - usually this will be a string
	 */
	public final function GetProperty($name, $default = '')
	{
		$name = strtolower($name);
		if(isset($this->_properties[$name]))
			return $this->_properties[$name];
		
		return $default;
	}
	
	/**
	 * Returns all valid properties of that block.
	 * @return array - array(propname => propvalue)
	 */
	public final function GetProperties()
	{
		return $this->_properties;
	}
	
	/**
	 * Defines additional properties of the blocktype that affects all blocks of this type 
	 * and needs to be stored "outside" the block.
	 * @return array - array(propname => propvalue)
	 * @abstract
	 */
	public function SetBlockTypeProperties() {}
	
	/**
	 * Gets the html output of the block in backend.<br />
	 * This method is required and needs to be overwritten.
	 * @return string
	 * @abstract
	 */
	public function GetInput() {}
	
	/**
	 * Gets the html that needs to be inserted in the head section for all blocks of this type when editing a page.<br />
	 * Can be useful to add css or js.<br/>
	 * Will be called only once for each block type.
	 * @return string
	 */
	public function GetHeaderHTML()
	{
		$this->_header_html_called = true;
	}
	
	/**
	 * Displays the help text for this blocktype.<br />
	 * Helptext will be displayed in modulehelp.
	 * @return string
	 * @abstract
	 */
	public function GetHelp() {}
	
	/**
	 * Displays the changelog text for this blocktype.<br />
	 * Changelog will be displayed in modules changelog.
	 * @return string
	 * @abstract
	 */
	public function GetChangeLog() {}
	
	/**
     * Function for the subclass to parse out data for it's parameters.<br />
     * Needs to be overwritten if the blocktype provides a special kind of data that needs to be processed before storing it.
     * @param array &$params - the parameters that are passed when the form is submitted
     * @param bool $editing - a flag to determine if the page is created or edited
     * @return string
     * @ToDo this seems to cause issues on import in TMS
     */
	public function FillParams(&$params, $editing = false)
	{
		return isset($params[$this->_properties['id']]) ? $params[$this->_properties['id']] : '';
	}
	
	/**
     * @deprecated
     * @see GetCompiledContent()
     */
	public function Show()
	{
		return $this->GetContent();
	}
	
	/**
     * Function for the subclass to validate its data.
     * @return bool
     */
	public function Validate()
	{
		return $this->GetContent(); #???
	}
	
	/**
     * Function for the subclass to perform the blocks compiled output in frontend.<br />
     * Needs to be overwritten if the blocktype provides a special kind of data that needs to be processed before compiling it in frontend.
     * @param $obj
     * @return string
     * @since 0.9.4
     */
	public function GetCompiledContent(&$obj)
	{
		$id         = '';
		$modulename = '';
		$action     = '';
		$inline     = false;
		if (isset($_REQUEST['module']))
			$modulename = $_REQUEST['module'];
		
		if (isset($_REQUEST['id']))
			$id = $_REQUEST['id'];
		elseif (isset($_REQUEST['mact']))
		{
			$ary        = explode(',', cms_htmlentities($_REQUEST['mact']), 4);
			$modulename = (isset($ary[0])?$ary[0]:'');
			$id         = (isset($ary[1])?$ary[1]:'');
			$action     = (isset($ary[2])?$ary[2]:'');
			$inline     = (isset($ary[3]) && $ary[3] == 1?true:false);
		}
		
		if (isset($_REQUEST[$id.'action']))
			$action = $_REQUEST[$id.'action'];
		else if (isset($_REQUEST['action']))
			$action = $_REQUEST['action'];
		
		if ($this->_properties['id'] == 'content_en' && ($id == 'cntnt01' || $id == '_preview_' || ($id != '' && $inline == false)))
		{
			$module =& ac_utils::get_module($modulename);
			if(is_object($module) && $module->IsPluginModule())
			{
				@ob_start();
				
				$params  = GetModuleParameters($id);
				$returnid = isset($params['returnid']) ? $params['returnid'] : $this->content_obj->Id();
				
				echo $module->DoActionBase($action, $id, $params, $returnid);
				
				$output = @ob_get_contents();
				@ob_end_clean();
			}
		}
		else
		{
			if(version_compare(CMS_VERSION, '1.11') < 0)
				$smarty = &$obj; # backward compatibility
			else
				$smarty = &$obj->smarty;
			
			$oldvalue        = $smarty->caching;
			$smarty->caching = false;
			
			if($id == '_preview_' || $id == '') 
				$output = $smarty->fetch('string:' . $this->GetContent());
			else 
				$output = $smarty->fetch(str_replace(' ', '_', 'content:' . $this->_properties['id']), '|' . $this->_properties['id'], $this->content_obj->Id() . $this->_properties['id']);
			
			$smarty->caching = $oldvalue;
			
			if($output == '' && !$this->_properties['allow_none'])
				$output = $this->_properties['default'];
		}
		if(!empty($this->_properties['assign']))
		{
			$smarty->assign($this->_properties['assign'], $output);
			return '';
		}
		return trim($output);
	}
	
	/**
     * Function to get the blocks raw content.
     * @return string
     * @since 0.9.4
     */
	public final function GetContent()
	{
		return $this->_content !== NULL ? $this->_content : $this->content_obj->GetPropertyValue($this->_properties['id']);
	}
	
	/**
     * Function to set the content of a block temporary on runtime to a certain value.
     * @return string
     * @since 0.9.4
     */
	protected final function SetContent($value)
	{
		$this->_content = $value;
	}
}
?>
