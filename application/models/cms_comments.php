<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms_comments extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}	
	
	function getAll($id = 0)
	{
		$CI	=&	get_instance();
		if($id == 0)
		{
			$query	=	$CI->mine_db->select('*', 'cms_comments', ' id > '.$id,0);
		}else{
			$query	=	$CI->mine_db->select('*', 'cms_comments', ' id = '.$id,1);
		}
		return $query;
	}
	
	function getLast()
	{
		$CI	=&	get_instance();
		$query	=	$CI->mine_db->select('*', 'cms_comments', ' id > 0 ORDER BY id DESC',1);
		return $query;
	}
	
	function countAll()
	{
		$CI		=&	get_instance();
		$count	=	NULL;
		$query	=	$CI->mine_db->count('id', 'cms_comments');
		if(is_array($query)){$count = 0;}else{$count	= count($query);}
		return $count;
	}
	
}
?>