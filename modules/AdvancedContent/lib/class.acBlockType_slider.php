<?php
class acBlockType_slider extends acContentBlockBase
{
	function __construct(&$content_obj, $params = array())
	{
		$params['block_type'] = 'slider';
		parent::__construct($content_obj, $params);
		$slider_params = array();
		if(isset($params['from']))
			$slider_params['from'] = intval($params['from']);
		
		if(isset($params['to']))
			$slider_params['to'] = intval($params['to']);
		
		if(isset($params['step']))
			$slider_params['step'] = intval($params['step']);
		
		if(isset($params['round']))
			$slider_params['round'] = intval($params['round']);
		
		if(isset($params['heterogeneity']))
			$slider_params['heterogeneity'] = $params['heterogeneity'];
		
		if(isset($params['dimension']))
			$slider_params['dimension'] = "'".$params['dimension']."'" ;
		
		if(isset($params['limits']))
			$slider_params['limits'] = "'".$params['limits']."'";
		
		if(isset($params['scale']))
			$slider_params['scale'] = $params['scale'];
		
		if(isset($params['skin']))
			$slider_params['skin'] = "'".$params['skin']."'";
		
		if(isset($params['calculate']))
			$slider_params['calculate'] = $params['calculate'];
		
		if(isset($params['onstatechange']))
			$slider_params['onstatechange'] = $params['onstatechange'];
		
		if(isset($params['callback']))
			$slider_params['callback'] = $params['callback'];
		
		$this->SetProperty('slider_params',$slider_params);
	}
	
	public function GetInput()
	{
		return '<input id="'.$this->GetProperty('id').'" type="hidden" name="' . $this->GetProperty('id') . '" value="' . ($this->GetContent() ? $this->GetContent() : intval($this->GetContent())) . '" />';
	}
	
	public function GetHeaderHTML()
	{
		if($this->_header_html_called)
			return;
		
		$this->_header_html_called = true;
		
		$config = cmsms()->GetConfig();
		$ret = '
<link rel="stylesheet" media="screen" type="text/css" href="'.$config['root_url'].'/modules/AdvancedContent/css/jslider.css" />
<script language="javascript" type="text/javascript" src="'.$config['root_url'].'/modules/AdvancedContent/js/jquery.jslider.min.js" defer="true"></script>
<script language="javascript" type="text/javascript">
/* <![CDATA[ */
ac_onload.push(function(){
	(function($){';

		foreach(acContentBlockManager::GetBlocksByType('slider') as $block_id)
		{
			$contentBlock = &$this->content_obj->GetContentBlock($block_id);
			$params       = $contentBlock->GetProperty('slider_params');
			$ret .= 'jQuery("#'.$block_id.'").j_slider(';
			if(count($params))
			{
				$ret .= '{';
				$slider_params = array();
				foreach($params as $paramName => $paramValue)
					$slider_params[] = $paramName . ': ' . $paramValue;
				
				$ret .= implode(',',$slider_params) . '}';
			}
			$ret .= ');';
		}

		return $ret . '
	})(jQuery);
});
/* ]]> */
</script>';
	}
}
?>
