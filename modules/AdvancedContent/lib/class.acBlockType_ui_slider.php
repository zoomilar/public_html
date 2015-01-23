<?php
class acBlockType_ui_slider extends acContentBlockBase
{
	function __construct(&$content_obj, $params = array())
	{
		$params['block_type'] = 'ui_slider';
		parent::__construct($content_obj, $params);
		$slider_params = array();
		
		if(isset($params['min']))
			$slider_params['min'] = intval($params['min']);
		
		if(isset($params['max']))
			$slider_params['max'] = intval($params['max']);
		
		if(isset($params['orientation']))
			$slider_params['orientation'] = $params['orientation'];
		
		if(isset($params['range']))
			$slider_params['range'] = ac_utils::IsTrue($params['range']) ? true : $params['range'];
		
		if(isset($params['step']))
			$slider_params['step'] = intval($params['step']);
		
		$this->SetProperty('slider_params',$slider_params);
		$this->SetProperty('unit',isset($params['unit']) ? $params['unit'] : '');
	}
	
	public function GetInput()
	{
		$slider_params = $this->GetProperty('slider_params');
		$diff = (isset($slider_params['max']) ? $slider_params['max'] : 10) - (isset($slider_params['min']) ? $slider_params['min'] : 0);
		$total_steps = ceil($diff / (isset($slider_params['step']) && $slider_params['step'] > 0 ? $slider_params['step'] : 1));
		$width = $total_steps >= 100 ? '100%' : $total_steps.'%';
		$ret = '
<div id="'. $this->GetProperty('id') .'_display">';

		if(isset($slider_params['range']))
		{
			$_values = explode(',',$this->GetContent());
			if($slider_params['range'] === true || $slider_params['range'] === false)
			{
				if(count($_values) < 2)
				{
					$value_min = isset($slider_params['min']) ? $slider_params['min'] : 0;
					$value_max = intval($_values[0]);
				}
				else
				{
					$value_min = intval($_values[0]);
					$value_max = intval($_values[1]);
				}
			}
			else if($slider_params['range'] == 'min')
			{
				$value_min = isset($slider_params['min']) ? $slider_params['min'] : 0;
				$value_max = count($_values) < 2 ? $_values[0] : $_values[1];
			}
			else if($slider_params['range'] == 'max')
			{
				$value_min = count($_values) < 2 ? $_values[0] : $_values[1];
				$value_max = isset($slider_params['max']) ? $slider_params['max'] : 10;
			}
			if(isset($slider_params['max']) && $slider_params['max'] < $value_max)
				$value_max = $slider_params['max'];
			
			if(isset($slider_params['min']) && $slider_params['min'] > $value_min)
				$value_min = $slider_params['min'];
			
			$ret .= $value_min . ' - ' . $value_max;
		}
		else
			$ret .= intval($this->GetContent());
		
		$ret .= ' ' . $this->GetProperty('unit') . 
'</div><br />
<div id="'.$this->GetProperty('id').'_slider" style="margin:0.6em;'.(!isset($slider_params['orientation']) || $slider_params['orientation'] == 'horizontal' ? 'width:'.$width : '' ). '"></div>
<input id="'.$this->GetProperty('id').'" type="hidden" name="' . $this->GetProperty('id') . '" value="' . ($this->GetContent() ? $this->GetContent() : intval($this->GetContent())) . '" />';
		
		return $ret;
	}
	
	public function GetHeaderHTML()
	{
		if($this->_header_html_called)
			return;
		
		$this->_header_html_called = true;
		
		$ret = '
<script language="javascript" type="text/javascript">
/* <![CDATA[ */
ac_onload.push(function(){
	(function($){';

		foreach(acContentBlockManager::GetBlocksByType('ui_slider') as $block_id)
		{
			$contentBlock  = &$this->content_obj->GetContentBlock($block_id);
			$slider_params = $contentBlock->GetProperty('slider_params');
			$ret .= '
		$("#'.$block_id.'_slider").slider({
			slide: function( event, ui ) {';
		
			if(isset($slider_params['range']))
			{
				$ret .= '
				$("#'. $block_id .'").val( ui.values );
				$("#'. $block_id .'_display").html( ui.values[0] + \' - \' + ui.values[1] + " '. $contentBlock->GetProperty('unit') .'");';
			
			}
			else
			{
				$ret .= '
				$("#'. $block_id .'").val( ui.value );
				$("#'. $block_id .'_display").html( ui.value + " '. $contentBlock->GetProperty('unit') .'");';
			
			}
			
			$ret .= '
			},';
			
			if(isset($slider_params['range']))
			{
				$_values = explode(',', $contentBlock->GetContent());
				if($slider_params['range'] === true || $slider_params['range'] === false)
				{
					if(count($_values) < 2)
					{
						$value_min = isset($slider_params['min']) ? $slider_params['min'] : 0;
						$value_max = intval($_values[0]);
					}
					else
					{
						$value_min = intval($_values[0]);
						$value_max = intval($_values[1]);
					}
				}
				else if($slider_params['range'] == 'min')
				{
					$value_min = isset($slider_params['min']) ? $slider_params['min'] : 0;
					$value_max = count($_values) < 2 ? $_values[0] : $_values[1];
				}
				else if($slider_params['range'] == 'max')
				{
					$value_min = count($_values) < 2 ? $_values[0] : $_values[1];
					$value_max = isset($slider_params['max']) ? $slider_params['max'] : 10;
				}
				if(isset($slider_params['max']) && $slider_params['max'] < $value_max)
					$value_max = $slider_params['max'];
				
				if(isset($slider_params['min']) && $slider_params['min'] > $value_min)
					$value_min = $slider_params['min'];
				
				$ret .= 'values: [' . $value_min . ',' . $value_max . ']';
			}
			else
				$ret .= 'value: ' . intval($contentBlock->GetContent());
			
			if(count($slider_params))
			{
				$ret .= ',';
				$slider_settings = array();
				foreach($slider_params as $paramName => $paramValue)
				{
					if(is_bool($paramValue))
						$slider_settings[] = $paramName . ': ' . ($paramValue ? 'true' : 'false');
					else
						$slider_settings[] = $paramName . ': ' . (is_numeric($paramValue) ? $paramValue : '"' . $paramValue . '"');
				}
				$ret .= implode(',',$slider_settings);
			}
			$ret .= '
		});';
			
		}
		
		return $ret . '
	})(jQuery);
});
/* ]]> */
</script>';

	}
}
?>
