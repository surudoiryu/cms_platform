<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}	
	
	function getAll()
	{
		$CI		=&	get_instance();
		$query	=	$CI->mine_db->select('*', 'cms');
		return $query;
	}
	
	function getVersion()
	{
		$CI		=&	get_instance();
		$query	=	$CI->mine_db->select('cms_version', 'cms',' cms_version != "" ORDER BY cms_version',1);
		return $query['cms_version'];
	}
	
	function getCode()
	{
		$CI		=&	get_instance();
		$query	=	$CI->mine_db->select('cms_code', 'cms',' cms_version != "" ORDER BY cms_version',1);
		return $query['cms_code'];
	}
	
	function setVersion($version)
	{
		$CI		=&	get_instance();
		$query	=	$CI->mine_db->set('cms',' cms_version = "'.$version.'"');
		return TRUE;
	}
	
}
?>