<?php

class readlanguage {
	public $path="";
	
	function __construct($path=''){
		$this->path=$path;
		
	}
	
	
	
	function readLangfile()
	{
	
	
	
		if(!file_exists($this->path))
			return;
	
		$langfile = file($this->path);
		$langkeys = array();
		$langvalues = array();
		foreach($langfile as $lang)
		{
			if (strstr($lang, "="))
			{
				$slang = explode("=", $lang);
				array_push($langkeys, trim($slang[0]));
				array_push($langvalues, trim($slang[1]));
			}
		}
		$langfile = array_combine($langkeys, $langvalues);
		if (!empty($langfile))
		{
			return $langfile;
		}
		else
		{
			return false;
		}
	}

}
