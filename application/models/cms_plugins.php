<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms_plugins extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}	
	
	function getAll()
	{
		$CI		=&	get_instance();
		$query	=	$CI->mine_db->select('*', 'cms_plugins');
		return $query;
	}
	
	function getActive()
	{
		$CI		=&	get_instance();
		$query	=	$CI->mine_db->select('*', 'cms_plugins',' plugin_status = 1 ORDER BY id DESC');
		return $query;
	}
	
	function getInactive()
	{
		$CI				=&	get_instance();
		$query	=	$CI->mine_db->select('*', 'cms_plugins',' plugin_status = 0 ORDER BY id DESC');
		return $query;
	}
	
}
?>