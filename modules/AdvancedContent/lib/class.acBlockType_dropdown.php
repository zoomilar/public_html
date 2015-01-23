<?php
class acBlockType_dropdown extends acContentBlockBase
{
	function __construct(&$content_obj, $params = array())
	{
		$params['block_type'] = 'dropdown';
		parent::__construct($content_obj, $params);
		
		$this->SetProperty('delimiter', isset($params['delimiter']) ? $params['delimiter'] : '|');
		$this->SetProperty('items', isset($params['items']) ? $params['items'] : '');
		$this->SetProperty('values', isset($params['values']) ? $params['values'] : '');
	}
	
	public function GetInput()
	{
		$AC = &ac_utils::get_module('AdvancedContent');
		$items = array();
		if($this->GetProperty('items') != '')
		{
			foreach(explode($this->GetProperty('delimiter'), $this->GetProperty('items')) as $key => $val)
			{
				$items[$key]['label'] = trim($val);
				if($this->GetProperty('translate_labels'))
					$items[$key]['label'] = $AC->lang($items[$key]['label']);
				
				$items[$key]['value']    = $items[$key]['label'];
				$items[$key]['selected'] = (trim($this->GetContent()) === $items[$key]['value']);
			}
		}
		if($this->GetProperty('values') != '')
		{
			foreach(explode($this->GetProperty('delimiter'), $this->GetProperty('values')) as $key => $val)
			{
				$items[$key]['value'] = trim($val);
				if($this->GetProperty('translate_values'))
					$items[$key]['value'] = $AC->lang($items[$key]['value']);
				
				$items[$key]['selected'] = (trim($this->GetContent()) === $items[$key]['value']);
				
				if(!isset($items[$key]['label']))
					$items[$key]['label'] = $items[$key]['value'];
			}
		}
		
		$input = '<select name="' . $this->GetProperty('id') . '" ' . ($this->GetProperty('style') != ''?'style="' . $this->GetProperty('style') . ' "':'') . ' >';
		foreach($items as $item)
		{
			$input .= '<option value="' . $item['value'] . '"';
			if($item['selected'])
				$input .= ' selected="selected"';
			
			$input .= '>' . $item['label'] . '</option>';
		}
		$input .= '</select>';
		return $input;
	}
}
?>
