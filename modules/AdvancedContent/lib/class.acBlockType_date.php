<?php
class acBlockType_date extends acContentBlockBase
{
	function __construct(&$content_obj, $params = array())
	{
		$params['block_type'] = 'date';
		parent::__construct($content_obj, $params);
		
		$showClock = !(isset($params['show_clock']) && ac_utils::IsFalse($params['show_clock']));
		
		$mode = 'calendar';
		if(isset($params['mode']) && strtolower($params['mode']) == 'dropdown')
			$mode = 'dropdown';
		
		$show24h    = !(isset($params['show24h']) && ac_utils::IsFalse($params['show24h']));
		$dateFormat = isset($params['date_format']) ? $params['date_format'] : '%x %X';
		
		$startHour = 0;
		$endHour   = 23;
		if(isset($params['start_hour']))
		{
			if(endswith($params['start_hour'],'pm'))
				$params['start_hour'] = trim(str_ireplace('pm','',$params['start_hour'])) + 12;
			else
				$params['start_hour'] = trim(str_ireplace(array('am','pm'),'',$params['start_hour']));
			
			if($params['start_hour'] > 0 && $params['start_hour'] <= $endHour)
				$startHour = trim($params['start_hour']);
		}
		
		if(isset($params['end_hour']))
		{
			if(endswith($params['end_hour'],'pm'))
				$params['end_hour'] = trim(str_ireplace('pm','',$params['end_hour'])) + 12;
			else
				$params['end_hour'] = trim(str_ireplace(array('am','pm'),'',$params['end_hour']));
			
			if($params['end_hour'] >= 0 && $params['end_hour'] < $endHour)
				$endHour = trim($params['end_hour']);
		}
		
		if($endHour < $startHour)
			$endHour = $startHour;
		
		$startMinute = 0;
		if(isset($params['start_minute']) && $params['start_minute'] > 0 && $params['start_minute'] <= 59)
			$startMinute = trim($params['start_minute']);
		
		$endMinute = 59;
		if(isset($params['end_minute']) && $params['end_minute'] >= 0 && $params['end_minute'] < 59)
			$endMinute = trim($params['end_minute']);
		
		if($endMinute < $startMinute)
			$endMinute = $startMinute;
		
		$startSecond = 0;
		if(isset($params['start_second']) && $params['start_second'] > 0 && $params['start_second'] <= 59)
			$startSecond = trim($params['start_second']);
		
		$endSecond = 59;
		if(isset($params['end_second']) && $params['end_second'] >= 0 && $params['end_second'] < 59)
			$endSecond = trim($params['end_second']);
		
		if($endSecond < $startSecond)
			$endSecond = $startSecond;
		
		$stepHours = 1;
		if(isset($params['step_hours']) && $params['step_hours'] > 0 && $params['step_hours'] <= ($endHour-$startHour))
			$stepHours = trim($params['step_hours']);
		else if(isset($params['step_hours']) && $params['step_hours'] > 0 && $params['step_hours'] >= ($endHour-$startHour))
			$stepHours = $endHour-$startHour;
		
		$stepMinutes = 30;
		if(isset($params['step_minutes']) && $params['step_minutes'] > 0 && $params['step_minutes'] <= ($endMinute-$startMinute))
			$stepMinutes = trim($params['step_minutes']);
		else if(isset($params['step_minutes']) && $params['step_minutes'] > 0 && $params['step_minutes'] >= ($endMinute-$startMinute))
			$stepMinutes = $endMinute-$startMinute;
		
		$stepSeconds = 1;
		if(isset($params['step_seconds']) && $params['step_seconds'] > 0 && $params['step_seconds'] <= ($endSecond-$startSeconds))
			$stepSeconds = trim($params['step_seconds']);
		else if(isset($params['step_seconds']) && $params['step_seconds'] > 0 && $params['step_seconds'] >= ($endSecond-$startSeconds))
			$stepSeconds = $endSecond-$startSeconds;
		
		$this->SetProperty('show24h',$show24h);
		$this->SetProperty('mode',$mode);
		$this->SetProperty('start_hour',$startHour);
		$this->SetProperty('end_hour',$endHour);
		$this->SetProperty('start_minute',$startMinute);
		$this->SetProperty('end_minute',$endMinute);
		$this->SetProperty('start_second',$startSecond);
		$this->SetProperty('end_second',$endSecond);
		$this->SetProperty('step_hours',$stepHours);
		$this->SetProperty('step_minutes',$stepMinutes);
		$this->SetProperty('step_seconds',$stepSeconds);
		$this->SetProperty('show_clock',$showClock);
		$this->SetProperty('date_format',$dateFormat);
	}
	
	public function GetInput()
	{
		if(!$this->GetContent())
			$this->SetContent(time());
		
		setlocale(LC_ALL, get_preference(get_userid(), 'default_cms_language'));
		
		$date = strftime('%x', intval($this->GetContent()));
		$time = '0:0';
		if($this->GetProperty('show_clock'))
			$time = strftime('%H:%M', intval($this->GetContent()));
		
		$_tmp        = ac_utils::CleanArray(explode(':',$time));
		$timeSeconds = (($_tmp[0] * 3600) + ($_tmp[1] * 60));
		$dateSeconds = $this->GetContent() - $timeSeconds;
		
		$dateInput = '<input id="'.$this->GetProperty('id').'_AdvancedContentDatePickerDisplay" type="text" value="' . $date . '" />
			<input id="'.$this->GetProperty('id').'_AdvancedContentDate" type="hidden" name="'.$this->GetProperty('id').'[date]" value="'. ($dateSeconds  * 1000) . '" />';
			
		$suffix    = '';
		$timeInput = '';
		if($this->GetProperty('show_clock'))
		{
			$timeInput = '&nbsp;&nbsp;-&nbsp;&nbsp;<select name="'.$this->GetProperty('id').'[time]">';
			$_i        = 0;
			for($i=$this->GetProperty('start_hour'); $i<=$this->GetProperty('end_hour'); $i += $this->GetProperty('step_hours'))
			{
				if($i<12 && !$this->GetProperty('show24h'))
					$suffix = ' am';
				else if(!$this->GetProperty('show24h'))
					$suffix = ' pm';
				
				for($j=$this->GetProperty('start_minute'); $j<=$this->GetProperty('end_minute'); $j += $this->GetProperty('step_minutes'))
				{
					$value = ($i*3600) + ($j*60);
					if(($this->GetProperty('end_hour') < 23 && $value <= ($this->GetProperty('end_hour') * 3600)) || $this->GetProperty('end_hour') == 23)
						$timeInput .= '<option value="'. $value .'"'. ($value == $timeSeconds ? ' selected="selected"':'') .'>'. ($i<10?'0'.$i:(!$this->GetProperty('show24h') && $i>12?$i-12:$i)) .':'. ($j<10?'0'.$j:$j) . $suffix . '</option>';
				}
				$j = $this->GetProperty('start_minute');
			}
			$timeInput .= '</select>';
		}
		return $dateInput.$timeInput;
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
		foreach(acContentBlockManager::GetBlocksByType('date') as $block_id)
		{
			$contentBlock = &$this->content_obj->GetContentBlock($block_id);
			if($contentBlock->GetProperty('mode') == 'calendar')
			{
				$ret .= '
		$("#'. $block_id .'_AdvancedContentDatePickerDisplay").datepicker({
			numberOfMonths: 3,
			showButtonPanel: true,
			showOn: "button",
			buttonImage: "../modules/AdvancedContent/images/calendar.png",
			altField: "#'. $block_id .'_AdvancedContentDate",
			altFormat: "@",
			buttonImageOnly: true
		});';
			}
		}
		return $ret . '
	})(jQuery);
});
/* ]]> */
</script>';
	}
	
	public function FillParams(&$params, $editing = false)
	{
		$blockId = $this->GetProperty('id');
		if(!isset($params[$blockId]) || $this->GetProperty('mode') != 'calendar')
			return;
		
		$value = (isset($params[$blockId]['time']) ? $params[$blockId]['time'] : 0) + ($params[$blockId]['date']  / 1000);
		return $value;
	}
	
	#ToDo: test this
	public function GetCompiledContent(&$obj)
	{
		if($this->GetProperty('date_format') != '')
			$this->SetContent(strftime($this->GetProperty('date_format'), intval($this->GetContent())));
		
		return parent::GetCompiledContent($obj);
	}
}
?>
