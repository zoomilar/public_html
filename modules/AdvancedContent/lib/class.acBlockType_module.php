<?php
class acBlockType_module extends acContentBlockBase
{
	function __construct(&$content_obj, $params = array())
	{
		$params['block_type'] = 'module';
		parent::__construct($content_obj, $params);
		$AC = &ac_utils::get_module('AdvancedContent');
		$this->SetProperty('module', isset($params['module']) ? $params['module'] : '');
		$this->SetProperty('params', $params, $this->GetProperties());
	}
	
	public function GetInput()
	{
		$AC = &ac_utils::get_module('AdvancedContent');
		if($this->GetProperty('module') == '')
			return $AC->lang('error_insufficient_blockparams','module',$this->GetProperty('name'));
		
		if( !$module =& $AC->GetModuleInstance($this->GetProperty('module')))
			return $AC->lang('error_loading_module',$this->GetProperty('module'),$this->GetProperty('name'));
		
		if( !$module->HasCapability('contentblocks') )
			return $AC->lang('error_contentblock_support',$this->GetProperty('module'),$this->GetProperty('name'));
		
		return $module->GetContentBlockInput($this->GetProperty('id'),$this->GetContent(),$this->GetProperty('params'),$this->GetProperty('adding'));
	}
}
?>
