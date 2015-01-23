<?php
class acBlockType_text extends acContentBlockBase
{
	function __construct(&$content_obj, $params = array())
	{
		$params['block_type'] = 'text';
		parent::__construct($content_obj, $params);
		
		$size        = isset($params['size']) ? intval($params['size']) : '';
		$maxlength   = isset($params['maxlength']) ? $params['maxlength'] : '';
		$usewysiwyg  = (!isset($params['usewysiwyg']) || !ac_utils::IsFalse($params['usewysiwyg'])) && ((!isset($params['wysiwyg']) || !ac_utils::IsFalse($params['wysiwyg'])));
		$rows        = isset($params['rows']) ? $params['rows'] : '';
		$cols        = isset($params['cols']) ? $params['cols'] : '';
		$auto_resize = !isset($params['auto_resize']) || !ac_utils::IsFalse($params['auto_resize']);
		$oneline     = isset($params['oneline']) && ac_utils::IsTrue($params['oneline']);
		
		$this->SetProperty('size', $size);
		$this->SetProperty('usewysiwyg', $usewysiwyg );
		$this->SetProperty('oneline', $oneline );
		$this->SetProperty('maxlength', $maxlength );
		$this->SetProperty('rows', $rows );
		$this->SetProperty('cols', $cols );
		$this->SetProperty('auto_resize', $auto_resize);
	}
	
	public function GetInput()
	{
		if($this->content_obj->GetPropertyValue('disable_wysiwyg'))
			$this->SetProperty('usewysiwyg',false);
		
		if (!$this->GetProperty('oneline'))
			return create_textarea(
				$this->GetProperty('usewysiwyg'), 
				$this->GetContent(), 
				$this->GetProperty('id'), 
				($this->GetProperty('auto_resize') ? 'AdvancedContent_textarea' : ''), 
				$this->GetProperty('id'), 
				'', 
				$this->content_obj->GetStylesheet(), 
				$this->GetProperty('cols') ? $this->GetProperty('cols') : 80, 
				$this->GetProperty('rows') ? $this->GetProperty('rows') : 15, 
				'', '', 
				($this->GetProperty('cols') || $this->GetProperty('rows') ? 
					('style="' . 
						($this->GetProperty('cols') ? 'width:auto;' : '') . 
						($this->GetProperty('rows') ? 'height:auto;' : '') . 
					'"') : ''
				)
			);
		else
			return '<input id="'.$this->GetProperty('id').'" type="text"' . 
				($this->GetProperty('style') != '' ? 
					'style="' . $this->GetProperty('style') . ' "' : '') . 
				($this->GetProperty('maxlength') != '' ? 
					' maxlength="' . $this->GetProperty('maxlength') . ' "' : '') . 
				($this->GetProperty('size') != '' ? 
					' size="' . $this->GetProperty('size') . ' "' : '') . 
				' name="' . $this->GetProperty('id') . 
				'" value="' . htmlspecialchars($this->GetContent()) . '" />';
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
		$("textarea.AdvancedContent_textarea").autoResize({
			animate:false,
			extraSpace: 0,
			limit:jQuery(window).height()
		}).keydown();
	})(jQuery);
});
/* ]]> */
</script>';
	}
	
}
?>
