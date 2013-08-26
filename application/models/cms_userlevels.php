<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms_userlevels extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}	
	
	function getAll($level = 0, $limit = 0)
	{
		$CI	=&	get_instance();
		if($level == 0)
		{
			$query	=	$CI->mine_db->select('*', 'cms_userlevels');
		}else{
			$query	=	$CI->mine_db->select('*', 'cms_userlevels', 'level='.$level, $limit);
		}
		return $query;
	}
}
?>