<?php
class acBlockType_colorpicker extends acContentBlockBase
{
	function __construct(&$content_obj, $params = array())
	{
		$params['block_type'] = 'colorpicker';
		parent::__construct($content_obj, $params);
	}
	
	public function GetInput()
	{
		return '# <input id="'. $this->GetProperty('id') .'" type="text"'. ($this->GetProperty('style') != ''?'style="'. $this->GetProperty('style') .' "' : '') .' maxlength="6" size="7" name="'. $this->GetProperty('id') .'" value="'. htmlspecialchars($this->GetContent()) .'" />';
	}
	
	public function GetHeaderHTML()
	{
		if($this->_header_html_called)
			return;
		
		$this->_header_html_called = true;
		
		$config = cmsms()->GetConfig();
		$ret = '
<link rel=stylesheet href="'.$config['root_url'].'/modules/AdvancedContent/css/jpicker.css" type="text/css" />
<script language="javascript" type="text/javascript" src="'.$config['root_url'].'/modules/AdvancedContent/js/jquery.jpicker.min.js" defer="true"></script>
<script language="javascript" type="text/javascript">
/* <![CDATA[ */
ac_onload.push(function(){
	(function($){
		$.fn.jPicker.defaults.images.clientPath="'.$config['root_url'].'/modules/AdvancedContent/images/jpicker/";';
		foreach(acContentBlockManager::GetBlocksByType('colorpicker') as $block_id)
			$ret .= '$("#'. $block_id .'").jPicker();';
		
		return $ret . '
		
	})(jQuery);
});
/* ]]> */
</script>';
	}
}
?>
