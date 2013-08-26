<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms_lands extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}	
	
	function getAll()
	{
		$CI		=&	get_instance();
		$query	=	$CI->mine_db->select('*', 'cms_lands');
		return 	$query;
	}
	
	function getName($id)
	{
		$CI		=&	get_instance();
		$query	=	$CI->mine_db->select('*', 'cms_lands', ' id = '.$id, 1);
		return $query['land_name'];
	}
	
	function getFlag($id)
	{
		$CI		=&	get_instance();
		$query	=	$CI->mine_db->select('*', 'cms_lands', ' id = '.$id, 1);
		return (strtolower($query['land_short']).'.gif');
	}
	
}
?>