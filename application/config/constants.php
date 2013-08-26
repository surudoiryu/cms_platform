<?php  //if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

//////////////////////GLOBAL DEFINES///////////////////
define("__URL__", "http://www.sintenpietenclubzeist.com/", true);
define("WEBSITE_URL_BE", __URL__ . "admin/", true);
define("WEBSITE_URL_FE", __URL__, true);
define("WEBSITE_URL_IMAGES", __URL__ . "public/images/", true);
define("WEBSITE_URL_STYLES", __URL__ . "public/styles/", true);
define("WEBSITE_URL_SCRIPTS", __URL__ . "public/scripts/", true);
define("WEBSITE_URL_UPLOADS", __URL__ . "public/uploads/", true);

///////////////////////////////////////////////////////

if (defined('BASEPATH'))
{
	define("SQL_BACKUP_DIRECTORY", 			APPPATH."mysql/", TRUE);
	define("FILEMANAGER_PATH", 				"public/uploads/", true);
	define('SMARTY_TEMPLATE_DIRECTORY',		APPPATH."views/", TRUE);
	define('SMARTY_COMPILE_DIRECTORY',		APPPATH."cache/smarty/compiled", TRUE);
	define('SMARTY_CACHE_DIRECTORY',		APPPATH."cache/smarty/cached", TRUE);
	define('SMARTY_CONFIG_DIRECTORY',		APPPATH."third_party/Smarty/configs", TRUE);
	define('SMARTY_TEMPLATE_EXT'			,"php", TRUE);
	define('SMARTY_ERROR_REPORTING'			,E_ERROR, TRUE);
}

/* End of file constants.php */
/* Location: ./application/config/constants.php */