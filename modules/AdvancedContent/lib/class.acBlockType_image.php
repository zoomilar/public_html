<?php
class acBlockType_image extends acContentBlockBase
{
	function __construct(&$content_obj, $params = array())
	{
		$params['block_type'] = 'image';
		parent::__construct($content_obj, $params);
		
		$config = cmsms()->GetConfig();
		
		$this->SetProperty('prefix', isset($params['prefix']) ? $params['prefix'] : 'thumb_');
		$this->SetProperty('exclude', !isset($params['exclude']) || ac_utils::IsFalse($params['exclude']));
		$this->SetProperty('dir', cms_join_path($config['uploads_path'], isset($params['dir']) ? $params['dir'] : get_site_preference('contentimage_path')));
		$this->SetProperty('inputname', isset($params['inputname']) ? $params['inputname'] : $this->GetProperty('id'));
		
		$this->SetProperty('urlonly', isset($params['urlonly']) && ac_utils::IsTrue($params['urlonly']));
		$this->SetProperty('class', isset($params['class']) ? $params['class'] : '');
		$this->SetProperty('alt', isset($params['alt']) ? $params['alt'] : '');
		$this->SetProperty('css_id', isset($params['id']) ? $params['id'] : '');
		$this->SetProperty('width', isset($params['width']) ? $params['width'] : '');
		$this->SetProperty('height', isset($params['height']) ? $params['height'] : '');
		$this->SetProperty('title', isset($params['title']) ? $params['title'] : '');
	}
	
	public function GetInput()
	{
		$dropdown = create_file_dropdown(
			$this->GetProperty('inputname'),
			$this->GetProperty('dir'),
			$this->GetContent(),
			'jpg,jpeg,png,gif',
			'',
			$this->GetProperty('allow_none'),
			'',
			$this->GetProperty('prefix'),
			$this->GetProperty('exclude')
		);
		if( $dropdown === false )
			$dropdown = lang('error_retrieving_file_list');
		
		return $dropdown;
	}
	
	public function GetCompiledContent(&$obj)
	{
		$config = cmsms()->GetConfig();
		$img    = ac_utils::CleanURL($config['uploads_url'] . '/' . $this->GetProperty('dir')) . $this->GetContent();
		
		# ToDo: base64 support
		# get width height automatically from file?
		
		if(!$this->GetProperty('urlonly'))
		{
			$img = '<img src="'. $img .
				'" alt="'. $this->GetProperty('alt') .'"' .
				($this->GetProperty('title')  ? ' title="'  . $this->GetProperty('title')  . '"' : '') .
				($this->GetProperty('class')  ? ' class="'  . $this->GetProperty('class')  . '"' : '') .
				($this->GetProperty('css_id') ? ' id="'     . $this->GetProperty('id')     . '"' : '') .
				($this->GetProperty('width')  ? ' width="'  . $this->GetProperty('width')  . '"' : '') .
				($this->GetProperty('height') ? ' height="' . $this->GetProperty('height') . '"' : '') .
				'>'
			;
		}
		
		$this->SetContent($img);
		return parent::GetCompiledContent($obj);
	}
}
?>
