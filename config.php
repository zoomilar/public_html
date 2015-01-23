<?php
# CMS Made Simple Configuration File
# Documentation: /doc/CMSMS_config_reference.pdf
#
//$config['debug'] = true;
$config['php_memory_limit'] = '256M';
$config['dbms'] = 'mysqli';
$config['db_hostname'] = 'localhost';
$config['db_username'] = 'w4.texus.lt';
$config['db_password'] = 'KmdrT53Y';
$config['db_name'] = 'alna';
$config['db_prefix'] = 'cms_'; 
$config['timezone'] = 'Europe/Vilnius';
$config['url_rewriting'] = 'mod_rewrite';
$config['page_extension'] = '.html';
$config['root_path'] = $_SERVER['DOCUMENT_ROOT'];
$config['root_url'] = 'http://'.$_SERVER['SERVER_NAME'];
$config['uploads_path'] = $config['root_path'].'/uploads';
$config['use_hierarchy'] = false;


//error_reporting(E_ALL^E_NOTICE);
//ini_set('display_errors', '1');

?>
