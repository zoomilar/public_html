<?php
class acBlockType_select_multiple extends acContentBlockBase
{
	function __construct(&$content_obj, $params = array())
	{
		$params['block_type'] = 'select_multiple';
		parent::__construct($content_obj, $params);
		$AC = &ac_utils::get_module('AdvancedContent');
		#$AC->SetAllowedParam(CLEAN_REGEXP.'/.*_AdvancedContentSortableItem_.*/',CLEAN_STRING);
		
		$this->SetProperty('sortable', isset($params['sortable_items']) && ac_utils::IsTrue($params['sortable_items'])); # deprecated
		$this->SetProperty('sortable', isset($params['sortable']) && ac_utils::IsTrue($params['sortable']));
		$this->SetProperty('delimiter', isset($params['delimiter']) ? $params['delimiter'] : '|');
		$this->SetProperty('items', isset($params['items']) ? $params['items'] : '');
		$this->SetProperty('values', isset($params['values']) ? $params['values'] : '');
	}
	
	public function GetInput()
	{
		$selItems = explode($this->GetProperty('delimiter'), $this->GetContent());
		$items    = $this->_get_items_array($selItems);
		
		if(!$this->GetProperty('sortable'))
		{
			$input = '<select name="' . $this->GetProperty('id') . '[]" ' . 
				($this->GetProperty('style') != '' ? 'style="' . $this->GetProperty('style') . ' "' : '') . 
				'multiple="multiple" size="' . ($this->GetProperty('size') ? $this->GetProperty('size') : count($items)) . '">';
				
			foreach($items as $oneItem)
			{
				$input .= '<option value="' . $oneItem['value'] . '"';
				if($oneItem['selected'])
					$input .= ' selected="selected"';
				
				$input .= '>' . $oneItem['label'] . '</option>';
			}
			$input .= '</select>';
		}
		else
		{
			$items = $this->_sort_items($items, $selItems);
			$input = '<div class="sortable_wrapper">';
			foreach($items as $item)
			{
				$input .=
				'<div class="sortable">
					<img class="sortable_handler" src="../modules/AdvancedContent/images/sort.png" />
					<input class="pagecheckbox"' . ($this->GetProperty('style') != ''?' style="' . $this->GetProperty('style') . ' "':'') . ' type="checkbox" value="'.$item['value'].'" name="' . $this->GetProperty('id') . '[]"' . ($item['selected']? ' checked="checked"':'') . ' />
					'.$item['label'].'
				</div>';
			}
			$input .= '</div>';
		}
		return $input;
	}
	
	public function GetHeaderHTML()
	{
		if($this->_header_html_called)
			return;
		
		$this->_header_html_called = true;
		
		return '
<script language="javascript" type="text/javascript">
/* <![CDATA[ */
ac_onload.push(function(){
	(function($){
		$(".sortable_wrapper").sortable({
			items: ".sortable",
			handle: ".sortable_handler",
			axis: "y"
		});
		$(".sortable_handler").disableSelection();
	})(jQuery);
});
/* ]]> */
</script>';
	}
	
	public function FillParams(&$params, $editing = false)
	{
		$blockId = $this->GetProperty('id');
		if(!isset($params[$blockId]) || !is_array($params[$blockId]))
			return;
		
		return implode($this->GetProperty('delimiter'), $params[$blockId]);
	}
	
	/**
	 * Not part of the api
	 */
	private function _get_items_array($selItems = array())
	{
		$AC = &ac_utils::get_module('AdvancedContent');
		$items = array();
		if($this->GetProperty('items') != '')
		{
			foreach(explode($this->GetProperty('delimiter'), $this->GetProperty('items')) as $key => $val)
			{
				$items[$key]['id']    = munge_string_to_url(trim($val));
				$items[$key]['label'] = trim($val);
				if($this->GetProperty('translate_labels'))
					$items[$key]['label'] = $AC->lang($items[$key]['label']);
				
				$items[$key]['value']    = $items[$key]['label'];
				$items[$key]['selected'] = in_array($items[$key]['label'],$selItems);
			}
		}
		if($this->GetProperty('values') != '')
		{
			foreach(explode($this->GetProperty('delimiter'), $this->GetProperty('values')) as $key => $val)
			{
				$items[$key]['value'] = trim($val);
				if($this->GetProperty('translate_values'))
					$items[$key]['value'] = $AC->lang($items[$key]['value']);
				
				$items[$key]['selected'] = in_array($items[$key]['value'],$selItems);
				if(!isset($items[$key]['label']))
					$items[$key]['label'] = $items[$key]['value'];
			}
		}
		return $items;
	}
	
	/**
	 * Not part of the api
	 */
	private function _sort_items($items = array(), $selItems = array())
	{
		$_items = array();
		foreach($selItems as $selKey => $selItem)
		{
			reset($items);
			foreach($items as $itemKey => $item)
			{
				if($item['value'] === $selItem)
				{
					$_items[] = $item;
					unset($items[$itemKey]);
					unset($selItems[$selKey]);
					break;
				}
			}
		}
		$items = array_merge($_items,$items);
		return $items;
	}
}
?>
