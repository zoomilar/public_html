<?php
/**
 * @package AdvancedContent
 * @category CMSModuleContentType
 * @license GPL
 * @author Georg Busch (NaN)
 * @copyright 2010-2013 Georg Busch (NaN)
 * @since 0.9.4
 * @internal
 * @access private
 */
final class acBlockTypePlaceholder extends acContentBlockBase
{
	function __construct(&$content_obj, $params = array())
	{
		parent::__construct($content_obj, $params);
		
		$AC = &ac_utils::get_module('AdvancedContent');
		
		$this->SetProperty('no_collapse', true);
		$this->SetProperty('collapsible', false);
		$this->SetProperty('collapse', false);
		
		if($this->content_obj->IsKnownProperty($this->GetProperty('id')))
			$this->SetProperty('error_message', $AC->lang('error_basicattrib', $this->GetProperty('name')));
		else
			$this->SetProperty('error_message', $AC->lang('invalid_block', $this->GetProperty('name'), $this->Type()));
		
		$this->SetContent('');
	}
}
?>
