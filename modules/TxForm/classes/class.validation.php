<?php

class validation {
	
	public $holder;
	
	/**
	 * Required
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	function required($str)
	{
		$str = str_replace("_", "", $str);
		if ( ! is_array($str))
		{
			return (trim($str) == '') ? FALSE : TRUE;
		}
		else
		{
			return ( ! empty($str));
		}
	}
	
	function personalcode($str)
	{
		return ((strlen($str) == 11) && is_numeric($str)) ? TRUE : FALSE;
	}
	
	
	// --------------------------------------------------------------------
	
	/**
	 * Match one field to another
	 *
	 * @access	public
	 * @param	string
	 * @param	field
	 * @return	bool
	 */
	function matches($str, $field)
	{
		if ( ! isset($_POST[$field]))
		{
			return FALSE;
		}
		
		return ($str !== $_POST[$field]) ? FALSE : TRUE;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Minimum Length
	 *
	 * @access	public
	 * @param	string
	 * @param	value
	 * @return	bool
	 */	
	function min_length($str, $val)
	{
		if (preg_match("/[^0-9]/", $val))
		{
			return FALSE;
		}

		if (function_exists('mb_strlen'))
		{
			return (mb_strlen($str) < $val) ? FALSE : TRUE;		
		}

		return (strlen($str) < $val) ? FALSE : TRUE;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Max Length
	 *
	 * @access	public
	 * @param	string
	 * @param	value
	 * @return	bool
	 */	
	function max_length($str, $val)
	{
		if (preg_match("/[^0-9]/", $val))
		{
			return FALSE;
		}
		
		if (function_exists('mb_strlen'))
		{
			return (mb_strlen($str) > $val) ? FALSE : TRUE;		
		}

		return (strlen($str) > $val) ? FALSE : TRUE;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Exact Length
	 *
	 * @access	public
	 * @param	string
	 * @param	value
	 * @return	bool
	 */	
	function exact_length($str, $val)
	{
		if (preg_match("/[^0-9]/", $val))
		{
			return FALSE;
		}
	
		if (function_exists('mb_strlen'))
		{
			return (mb_strlen($str) != $val) ? FALSE : TRUE;		
		}

		return (strlen($str) != $val) ? FALSE : TRUE;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Valid Email
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */	
	function valid_email($str)
	{
		return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
	}

	// --------------------------------------------------------------------
	
	/**
	 * Valid Emails
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */	
	function valid_emails($str)
	{
		if (strpos($str, ',') === FALSE)
		{
			return $this->valid_email(trim($str));
		}
		
		foreach(explode(',', $str) as $email)
		{
			if (trim($email) != '' && $this->valid_email(trim($email)) === FALSE)
			{
				return FALSE;
			}
		}
		
		return TRUE;
	}

	// --------------------------------------------------------------------
	
	/**
	 * Validate IP Address
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	function valid_ip($ip)
	{
		return $this->CI->input->valid_ip($ip);
	}

	// --------------------------------------------------------------------
	
	/**
	 * Alpha
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */		
	function alpha($str)
	{
		return ( ! preg_match("/^([a-ząčęėįšųūžĄČĘĖĮŠŠŲŪŽ])+$/i", $str)) ? FALSE : TRUE;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Alpha-numeric
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */	
	function alpha_numeric($str)
	{
		return ( ! preg_match("/^([a-z0-9])+$/i", $str)) ? FALSE : TRUE;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Alpha-numeric with underscores and dashes
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */	
	function alpha_dash($str)
	{
		return ( ! preg_match("/^([-a-z0-9_-])+$/i", $str)) ? FALSE : TRUE;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Numeric
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */	
	function numeric($str)
	{
		return (bool)preg_match( '/^[\-+]?[0-9]*\.?[0-9]+$/', $str);

	}

	// --------------------------------------------------------------------

	/**
	 * Is Numeric
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
  	function is_numeric($str)
	{
		return ( ! is_numeric($str)) ? FALSE : TRUE;
	} 

	// --------------------------------------------------------------------
	
	/**
	 * Integer
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */	
	function integer($str)
	{
		return (bool)preg_match( '/^[\-+]?[0-9]+$/', $str);
	}

	// --------------------------------------------------------------------

	/**
	 * Is a Natural number  (0,1,2,3, etc.)
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	function is_natural($str)
	{   
   		return (bool)preg_match( '/^[0-9]+$/', $str);
	}

	// --------------------------------------------------------------------

	/**
	 * Is a Natural number, but not a zero  (1,2,3, etc.)
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	function is_natural_no_zero($str)
	{   
		if ( ! preg_match( '/^[0-9]+$/', $str))
		{
			return FALSE;
		}
	
		if ($str == 0)
		{
			return FALSE;
		}

		return TRUE;
	}

	// --------------------------------------------------------------------
	
	/**
	 * Valid Base64
	 *
	 * Tests a string for characters outside of the Base64 alphabet
	 * as defined by RFC 2045 http://www.faqs.org/rfcs/rfc2045
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	function valid_base64($str)
	{
		return (bool) ! preg_match('/[^a-zA-Z0-9\/\+=]/', $str);
	}

	// --------------------------------------------------------------------
	
	/**
	 * Set Select
	 *
	 * Enables pull-down lists to be set to the value the user
	 * selected in the event of an error
	 *
	 * @access	public
	 * @param	string
	 * @param	string
	 * @return	string
	 */	
	function set_select($field = '', $value = '')
	{
		if ($field == '' OR $value == '' OR  ! isset($_POST[$field]))
		{
			return '';
		}
			
		if ($_POST[$field] == $value)
		{
			return ' selected="selected"';
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Set Radio
	 *
	 * Enables radio buttons to be set to the value the user
	 * selected in the event of an error
	 *
	 * @access	public
	 * @param	string
	 * @param	string
	 * @return	string
	 */	
	function set_radio($field = '', $value = '')
	{
		if ($field == '' OR $value == '' OR  ! isset($_POST[$field]))
		{
			return '';
		}
			
		if ($_POST[$field] == $value)
		{
			return ' checked="checked"';
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Set Checkbox
	 *
	 * Enables checkboxes to be set to the value the user
	 * selected in the event of an error
	 *
	 * @access	public
	 * @param	string
	 * @param	string
	 * @return	string
	 */	
	function set_checkbox($field = '', $value = '')
	{
		if ($field == '' OR $value == '' OR  ! isset($_POST[$field]))
		{
			return '';
		}
			
		if ($_POST[$field] == $value)
		{
			return ' checked="checked"';
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Prep data for form
	 *
	 * This function allows HTML to be safely shown in a form.
	 * Special characters are converted.
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	function prep_for_form($data = '')
	{
		if (is_array($data))
		{
			foreach ($data as $key => $val)
			{
				$data[$key] = $this->prep_for_form($val);
			}
			
			return $data;
		}
		
		if ($this->_safe_form_data == FALSE OR $data == '')
		{
			return $data;
		}

		return str_replace(array("'", '"', '<', '>'), array("&#39;", "&quot;", '&lt;', '&gt;'), stripslashes($data));
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Prep URL
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */	
	function prep_url($str = '')
	{
		if ($str == 'http://' OR $str == '')
		{
			$_POST[$this->_current_field] = '';
			return;
		}
		
		if (substr($str, 0, 7) != 'http://' && substr($str, 0, 8) != 'https://')
		{
			$str = 'http://'.$str;
		}
		
		$_POST[$this->_current_field] = $str;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Strip Image Tags
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */	
	function strip_image_tags($str)
	{
		$_POST[$this->_current_field] = $this->CI->input->strip_image_tags($str);
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * XSS Clean
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */	
	function xss_clean($str)
	{
		$_POST[$this->_current_field] = $this->CI->input->xss_clean($str);
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Convert PHP tags to entities
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */	
	function encode_php_tags($str)
	{
		$_POST[$this->_current_field] = str_replace(array('<?php', '<?PHP', '<?', '?>'),  array('&lt;?php', '&lt;?PHP', '&lt;?', '?&gt;'), $str);
	}

	function checkNesteDuplicate($post, $table){	
		
		//isimtis
		if($post['data'] == '2011-08-13' && $post['adresas'] == '30' && $post['kvitas']=='01/0069')
			return false;
		elseif($post['data'] == '2011-08-14' && $post['adresas'] == '50' && $post['kvitas']=='02/7228')
			return false;
		global $gCms;
		$db = $gCms->db;
		$table = mysql_real_escape_string($table);	
		if ($post['kvitas'])
			$r = $db->getOne("SELECT id FROM {$table} WHERE data='{$post['data']}' and adresas='{$post['adresas']}' and kvitas='{$post['kvitas']}'");

		//	
		
			
		if ($r) 
			return true;
		else	
			return false;
	}	
	
	function checkNesteDates($data){
		
		if(preg_match('/\_/', $data) || !$data)
			return true;
	
		$dti = explode("-", $data);
		$dti[0] = str_replace('_','',$dti[0]);
		$dti[1] = str_replace('_','',$dti[1]);
		$dti[2] = str_replace('_','',$dti[2]);
		if(@checkdate($dti[1],$dti[2],$dti[0])){
			$pradzia = '2011-07-05';
			$pabaiga = '2011-08-31';
			$today = date('Y-m-d');
			$pradzia = explode("-", $pradzia);
			$pabaiga = explode("-", $pabaiga);
			$today = explode("-", $today);
			$pradzia=gregoriantojd($pradzia[1], $pradzia[2], $pradzia[0]);
			$pabaiga=gregoriantojd($pabaiga[1], $pabaiga[2], $pabaiga[0]);
			$today=gregoriantojd($today[1], $today[2], $today[0]);
			$kvito_data = gregoriantojd($dti[1], $dti[2], $dti[0]);
			if( (int)($pabaiga - $kvito_data) < 0 || (int)($kvito_data - $pradzia) < 0 || (int)($today - $kvito_data) < 0 ){
				return true;    
			}
				
		}	
		return false;
	}
	
	function checkNestePhone($tel){
		if(preg_match('/\_/', $tel) || !$tel || strlen($tel) < 11){
			return false;
		}else{
			return true;
		}	
	}
	
	function checkNesteCard($card){
		$card = str_replace("_", "", $card);
		$card = strlen($card);	
		
		if ($card<16 && $card>1){
			return false;
		}else{
			return true;
		}	
	}	
	
	function checkNesteKvitas($kvitas){
	
		$kvitas = str_replace("_", "", $kvitas);
		$kvitas = explode("/", $kvitas);
		$p1 = $kvitas[0];
		$p2 = $kvitas[1];
				
		if (strlen($p1) == 2 && strlen($p2) == 4){
			return true;
		}else{
			return false;
		}	

	}		
	
	function checkNesteUser($kortele, $table){
		global $gCms;
		$db = $gCms->db;
		$table = mysql_real_escape_string($table);	
		$kortele2 = str_replace("_", "", $kortele);
		$kortele3 = str_replace("_", " ", $kortele);
		$kortele4 = str_replace(" ", "", $kortele);		
		//kortele IN ('{$kortele}','{$kortele2}','{$kortele3}','{$kortele4}')
		//$r = $db->getRow("SELECT * FROM {$table} WHERE kortele='{$kortele}' or kortele='{$kortele2}' or kortele='{$kortele3}' or kortele='{$kortele4}' ORDER BY irasyta ASC");
		$r = $db->getRow("SELECT * FROM {$table} WHERE kortele IN ('{$kortele}','{$kortele2}','{$kortele3}','{$kortele4}') ORDER BY irasyta ASC");
		$this->holder = $r;
			
		if ($r) 
			return $r;
		else	
			return false;
	}	

	function checkNesteCardHolder($post){
		$kortele2 = str_replace("_", "", $post['kortele']);
		$kortele3 = str_replace("_", " ", $post['kortele']);
		$kortele4 = str_replace(" ", "", $post['kortele']);
		
		
		//if ($post['kortele'] == $this->holder['kortele'] || $kortele2 == $this->holder['kortele'] || $kortele3 == $this->holder['kortele'] || $kortele4 == $this->holder['kortele'])
		if (in_array($this->holder['kortele'], array($post['kortele'],$kortele2,$kortele3,$kortele4)))
			$t1 = 1;
		
		if ($post['telefonas'] == $this->holder['telefonas'])
			$t2 = 1;
		
	
		if ($t1 && $t2){
			return true;
		}else{
			return false;
		}
	}
	function checkTelefonas($telefonas){
		$telefonas = str_replace("_", "", $telefonas);
		if ($telefonas != "370" && strlen($telefonas) == 11)
			return true;
		else
			return false;
	}

	function checkIfCard($post, $table){
		global $gCms;
		$db = $gCms->db;	  
		if ($this->checkTelefonas($post['telefonas'])){			
			error_reporting(1);
			$ret = $db->getAll("SELECT kortele FROM {$table} WHERE `kortele` NOT IN('___________________','') and `telefonas`=? GROUP BY kortele ORDER BY irasyta DESC", array($post['telefonas']));			
			foreach ($ret as $r){
				$rtest = str_replace("_", "", $r['kortele']);
				if (strlen($rtest) == 16){
					$kortele = $r['kortele'];
					break;
				}	
			}
			return $kortele;			
		}
	}
	

}
// END Validation Class

