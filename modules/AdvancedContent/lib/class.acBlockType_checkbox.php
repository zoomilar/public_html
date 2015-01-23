<?php
class acBlockType_checkbox extends acContentBlockBase
{
	function __construct(&$content_obj, $params = array())
	{
		$params['block_type'] = 'checkbox';
		parent::__construct($content_obj, $params);
		$this->SetProperty('default',intval($this->GetProperty('default')));
	}
	
	public function GetInput()
	{
		return '<input type="hidden" name="'. $this->GetProperty('id') .'" value="0" />
			<input id="'. $this->GetProperty('id') .'" class="pagecheckbox"'. ($this->GetProperty('style') != ''?' style="'. $this->GetProperty('style') .' "':'') . ' type="checkbox" value="1" name="'. $this->GetProperty('id') .'"'. ($this->GetContent() == 1 ? ' checked="checked"':'') .' />';
	}
}
?>
