<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms_settings extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}	
	
	function getAll()
	{
		$CI	=&	get_instance();
		$query	=	$CI->mine_db->select('*', 'cms_settings');
		return $query;
	}
	
	function getLast()
	{
		$CI		=&	get_instance();
		$query	=	$CI->mine_db->select('*', 'cms_settings',' id > 0 ORDER BY id DESC',1);
		return $query;
	}
	
	function editSettings($_POST)
	{
		$CI				=&	get_instance();
		$lastSettings	=	$CI->mine_db->select('*', 'cms_settings', ' id > 0 ORDER BY id DESC',1);
		$date			=	date('Y-m-d H:i:s');
		$query			=	$CI->mine_db->insert('cms_settings'," 
												setting_title = '".mysql_real_escape_string($_POST['editsettings_title'])."',
												setting_description = '{$lastSettings['setting_description']}',
												setting_keywords = '{$lastSettings['setting_keywords']}',
												setting_author = '{$lastSettings['setting_author']}',
												setting_copyright = '{$lastSettings['setting_copyright']}',
												setting_language = {$lastSettings['setting_language']},
												setting_robots = '{$lastSettings['setting_robots']}',
												setting_revisit = '{$lastSettings['setting_revisit']}',
												setting_titlesort = {$lastSettings['setting_titlesort']},
												setting_email = '".mysql_real_escape_string($_POST['editsettings_mail'])."',
												setting_google = '".mysql_real_escape_string($_POST['editsettings_google'])."',
												setting_template = '{$_POST['editsettings_template']}',
												setting_font = '{$_POST['editsettings_font']}',
												setting_layout = 0,
												setting_enableregister = {$_POST['editsettings_register']},
												setting_enablelogin = {$_POST['editsettings_login']},
												setting_enableresponse = {$_POST['editsettings_response']},
												setting_date = '{$date}'
												");
		return $query;
	}
	
	function editSeo($_POST)
	{
		$CI				=&	get_instance();
		$lastSettings	=	$CI->mine_db->select('*', 'cms_settings', ' id > 0 ORDER BY id DESC',1);
		$date			=	date('Y-m-d H:i:s');
		$query			=	$CI->mine_db->insert('cms_settings'," 
												setting_title = '{$lastSettings['setting_title']}',
												setting_description = '".mysql_real_escape_string($_POST['editseo_description'])."',
												setting_keywords = '".mysql_real_escape_string($_POST['editseo_keywords'])."',
												setting_author = '".mysql_real_escape_string($_POST['editseo_author'])."',
												setting_copyright = '".mysql_real_escape_string($_POST['editseo_copyright'])."',
												setting_language = {$_POST['editseo_language']},
												setting_robots = '{$_POST['editseo_robotsearch']}',
												setting_revisit = '{$_POST['editseo_robotrevisit']}',
												setting_titlesort = {$_POST['editseo_titlesort']},
												setting_email = '{$lastSettings['setting_email']}',
												setting_google = '{$lastSettings['setting_google']}',
												setting_template = '{$lastSettings['setting_template']}',
												setting_font = '{$lastSettings['setting_font']}',
												setting_layout = 0,
												setting_enableregister = {$lastSettings['setting_enableregister']},
												setting_enablelogin = {$lastSettings['setting_enablelogin']},
												setting_enableresponse = {$lastSettings['setting_enableresponse']},
												setting_date = '{$date}'
												");
		return $query;
	}
	
}
?>