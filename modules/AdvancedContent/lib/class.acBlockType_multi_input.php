<?php
class acBlockType_multi_input extends acContentBlockBase
{
	function __construct(&$content_obj, $params = array())
	{
		$params['block_type'] = 'multi_input';
		parent::__construct($content_obj, $params);
		
		$this->SetProperty('inputs', isset($params['inputs']) ? $params['inputs'] : '');
		$this->SetProperty('value_delimiter', isset($params['value_delimiter']) ? $params['value_delimiter'] : '<!-- multi_input_value_delimiter -->');
		$this->SetProperty('input_delimiter', isset($params['input_delimiter']) ? $params['input_delimiter'] : '<!-- multi_input_delimiter -->');
	}
	
	public function GetInput()
	{
		$AC = &ac_utils::get_module('AdvancedContent');
		$multi_input_ids = ac_utils::CleanArray(explode(',', $this->GetProperty('inputs')));
		$input_values    = array();
		$multi_input     = '';
		
		foreach(explode($this->GetProperty('input_delimiter'), $this->GetContent()) as $input_data)
			$input_values[] = explode($this->GetProperty('value_delimiter'),$input_data);
		
		$blockType        = &acContentBlockManager::GetBlockType('multi_input');
		$multiInput_props = $blockType['props'];
		foreach($multi_input_ids as $k1=>$multi_input_id)
		{
			if(isset($multiInput_props[$multi_input_id]))
			{
				if(!isset($multiInput_props[$multi_input_id]['template']))
				{
					$multiInput_props[$multi_input_id]['template'] = $AC->GetTemplate($multiInput_props[$multi_input_id]['tpl_name']);
					acContentBlockManager::SetBlockTypeProperty('multi_input', $multi_input_id, $multiInput_props[$multi_input_id]);
				}
				$inputs = array();
				foreach ($multiInput_props[$multi_input_id]['elements'] as $k2=>$inputBlock)
				{
					if($inputBlock->GetProperty('smarty'))
					{
						foreach($inputBlock->GetProperties() as $propName=>$propValue)
							$inputBlock->SetProperty($propName, ac_utils::DoSmarty($content_obj, $propValue));
					}
					$inputBlock->SetProperty('id', 'multiInput-' . $this->GetProperty('id') . '-' . $multi_input_id . '-' . $k1 . '-' . $k2);
					$inputBlock->SetContent(isset($input_values[$k1][$k2]) ? $input_values[$k1][$k2] : '');
					$inputs[$inputBlock->GetProperty('id')] = $inputBlock;
				}
				$AC->smarty->assign_by_ref('inputs', $inputs);
				#$multi_input .= $AC->ProcessTemplateFromData($multiInput_props[$multi_input_id]['template']);
				$multi_input .= $AC->smarty->fetch('string:' . $multiInput_props[$multi_input_id]['template']);
			}
		}
		return $multi_input;
	}
	
	public function SetBlockTypeProperties()
	{
		if(!ac_utils::is_frontend_request())
		{
			$AC = &ac_utils::get_module('AdvancedContent');
			$multi_input_ids  = ac_utils::CleanArray(explode(',',$this->GetProperty('inputs')));
			$blockType        = &acContentBlockManager::GetBlockType('multi_input');
			$multiInput_props = $blockType['props'];
			
			foreach($multi_input_ids as $k1=>$multi_input_id)
			{
				if(!isset($multiInput_props[$multi_input_id]))
				{
					$multiInput_props = array_merge($multiInput_props, ac_admin_ops::GetMultiInputFull($multi_input_ids));
					if(!isset($multiInput_props[$multi_input_id]))
						continue;
					
					$multiInput_props[$multi_input_id]['template'] = $AC->GetTemplate($multiInput_props[$multi_input_id]['tpl_name']);
					$matches = array();
					$result  = preg_match_all(AC_BLOCK_PATTERN, $multiInput_props[$multi_input_id]['input_fields'], $matches);
					
					if ($result && count($matches[1]) > 0)
					{
						foreach ($matches[1] as $k2=>$wholetag)
						{
							if(!$inputBlock = acContentBlockManager::CreateContentBlock($this->content_obj, acContentBlockManager::GetTagParams($wholetag)))
								continue;
							
							if($inputBlock->Type() == 'multi_input')
								continue; # ToDo: display message?
							
							$multiInput_props[$multi_input_id]['elements'][$k2] = $inputBlock;
						}
					}
				}
			}
			acContentBlockManager::SetBlockTypeProperties('multi_input', $multiInput_props);
		}
	}
	
	public function FillParams(&$params, $editing = false)
	{
		$blockId          = $this->GetProperty('id');
		$multi_inputs     = array();
		$value            = '';
		$blockType        = &acContentBlockManager::GetBlockType('multi_input');
		$multiInput_props = $blockType['props'];
		foreach(ac_utils::CleanArray(explode(',',$this->GetProperty('inputs'))) as $k1=>$multi_input_id)
		{
			$multi_input_values = array();
			foreach($multiInput_props[$multi_input_id]['elements'] as $k2=>$inputBlock)
			{
				if(isset($params['multiInput-' . $blockId . '-' . $multi_input_id . '-' . $k1 . '-' . $k2]))
				{
					$inputBlock->SetProperty('id', 'multiInput-' . $blockId . '-' . $multi_input_id . '-' . $k1 . '-' . $k2);
					$multi_input_values[] = $inputBlock->FillParams($params, $editing);
				}
			}
			$multi_inputs[] = implode($this->GetProperty('value_delimiter'),$multi_input_values);
		}
		if(!ac_utils::IsVarEmpty($multi_inputs))
			$value = implode($this->GetProperty('input_delimiter'), $multi_inputs);
		
		return $value;
	}
}
?>
