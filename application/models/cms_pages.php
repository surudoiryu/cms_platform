<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms_pages extends CI_Model
{
	public $connection;
	
	function __construct()
	{
		parent::__construct();
	}	
	
	function getAll($id = 0, $limit = 0)
	{
		$CI	=&	get_instance();
		if($id == 0)
		{
			$query	=	$CI->mine_db->select('*', 'cms_pages ORDER BY page_weight ASC');
		}else{
			$query	=	$CI->mine_db->select('*', 'cms_pages', 'id='.$id.' ORDER BY page_weight ASC ', $limit);
		}
		return $query;
	}
	
	function getByName($name = '')
	{
		$CI	=&	get_instance();
		if($name == '')
		{
			$query	=	$CI->mine_db->select('*', 'cms_pages', ' page_link = "home"',1);
		}else{
			$query	=	$CI->mine_db->select('*', 'cms_pages', ' page_link = "'.$name.'"',1);
		}
		return $query;
	}
	
	function editPage($_POST){
		$CI		=&	get_instance();
		$link	=	strtolower($_POST['editpage_name']);
		$link	=	str_replace(" ","-",$link);
		$query	=	$CI->mine_db->set("cms_pages", "
								page_name = '{$_POST['editpage_name']}',
								page_link = '{$link}',
								page_restriction = {$_POST['editpage_restriction']},
								page_menu = {$_POST['editpage_menu']}
								", " id = {$_POST['editpage_id']} 
							");
	}
	
	function createPage($_POST){
		$CI		=&	get_instance();
		$link	=	strtolower($_POST['createpage_name']);
		$link	=	str_replace(" ","-",$link);
		$weight = 	$CI->mine_db->select('*', 'cms_pages', ' page_weight > 0 ORDER BY page_weight DESC', 1);
		$weight =	($weight['page_weight'] + 1);
		$query	=	$CI->mine_db->insert("cms_pages", "
													page_name = '{$_POST['createpage_name']}',
													page_link = '{$link}',
													page_weight = {$weight},
													page_restriction = {$_POST['createpage_restriction']},
													page_menu = {$_POST['createpage_menu']}
												");
	}
	
}
?>