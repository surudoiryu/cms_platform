<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms_subpages extends CI_Model
{
	public $connection;
	
	function __construct()
	{
		parent::__construct();
	}	
	
	function getAll($id = 0)
	{
		$CI	=&	get_instance();
		if($id == 0)
		{
			$query	=	$CI->mine_db->select('*', 'cms_subpages ORDER BY subpage_weight ASC');
		}else{
			$query	=	$CI->mine_db->select('*', 'cms_subpages', 'suppage_parent='.$id.' ORDER BY subpage_weight ASC');
		}
		return $query;
	}
	
	function getIdByName($name)
	{
	
		$CI	=&	get_instance();
		//$name	=	str_replace("-"," ", $name);
		$query	=	$CI->mine_db->select('*', 'cms_subpages', 'subpage_link="'.$name.'"',1);
		return $query;
	}
	
	function getByName($name = '')
	{
		$CI	=&	get_instance();
		if($name == '')
		{
			$need	=	$CI->mine_db->select('*', 'cms_pages', ' page_link = "home"',1);
			$query	=	$CI->mine_db->select('*', 'cms_subpages', 'subpage_parent='.$need['id'].' ORDER BY subpage_weight ASC' );
		}else{
			$need	=	$CI->mine_db->select('*', 'cms_pages', ' page_link = "'.$name.'"',1);
			$query	=	$CI->mine_db->select('*', 'cms_subpages', 'subpage_parent='.$need['id']. ' ORDER BY subpage_weight ASC ' );
		}
		return $query;
	}
	
	function editSubpage($_POST){
		$CI	=&	get_instance();
		$link	=	strtolower($_POST['editsubpage_name']);
		$link	=	str_replace(" ","-",$link);
		$query	=	$CI->mine_db->set("cms_subpages", "
									subpage_parent = {$_POST['editpage_parent']},
									subpage_name = '{$_POST['editsubpage_name']}',
									subpage_link = '{$link}',
									subpage_restriction = {$_POST['editpage_restriction']},
									subpage_menu = {$_POST['editpage_menu']}
									", " id = {$_POST['editsubpage_id']} 
								");
	}
	
	function createSubpage($_POST){
		$CI	=&	get_instance();
		$link	=	strtolower($_POST['createpage_name']);
		$link	=	str_replace(" ","-",$link);
		$query	=	$CI->mine_db->insert("cms_subpages", "
									subpage_parent 		= '{$_POST['createpage_parent']}',
									subpage_name		= '{$_POST['createpage_name']}',
									subpage_link 		= '{$link}',
									subpage_restriction	= {$_POST['createpage_restriction']},
									subpage_menu 		= {$_POST['createpage_menu']},
									subpage_weight 		= 0
								");
	}
	
}
?>