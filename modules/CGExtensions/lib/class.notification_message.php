<?php

class notification_message 
{
  const PRIORITY_HIGH = 1;
  const PRIORITY_NORMAL = 2;
  const PRIORITY_LOW = 3;

  private static $_keys = array('subject','body','module','priority','to','lat','long','html');
  private $_data = array();

  public function __get($okey)
  {
    $key = strtolower($okey);
    if( !in_array($key,self::$_keys) ) {
      throw new Exception('Attempt to retrieve invalid key '.$okey.' from message object');
    }
    if( isset($this->_data[$key]) ) return $this->_data[$key];
    
    switch($key) {
    case 'priority':
      return self::PRIORITY_NORMAL;

    case 'to':
      return 0;

    case 'html':
      return 0;

    case 'module':
      return -1;
    }
  }

  public function __set($key,$value)
  {
    $key = strtolower($key);
    if( !in_array($key,self::$_keys) ) {
      throw new Exception('Attempt to store invalid data into message object');
    }

    $this->_data[$key] = $value;
  }
} // end of class
