<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms_content extends CI_Model
{	

	function __construct()
	{
		parent::__construct();
	}	
	
	function getAll($parentpage = 0, $sub = 0, $limit = 0)
	{
		$CI	=&	get_instance();
		if($parentpage == 0)
		{
			$query	=	$CI->mine_db->select('*', 'cms_content', ' content_parent > '.$parentpage, $limit);
		}else{
			if($sub == 0){
				$query	=	$CI->mine_db->select('*', 'cms_content', ' content_parent = '.$parentpage.' AND content_subpage='.$sub.' ', $limit);
			}else{
				$query	=	$CI->mine_db->select('*', 'cms_content LEFT JOIN cms_subpages ON (cms_content.content_parent = cms_subpages.subpage_parent)', ' cms_content.content_parent = '.$parentpage.' AND cms_content.content_subpage='.$sub.' AND cms_subpages.id ='.$sub.' ', $limit);
			}
		}
		return $query;
	}
	
	function editContent($_POST){
		$CI	=&	get_instance();
		$subId	=	(!empty($_POST['editsubpage_id'])) ? $_POST['editsubpage_id'] : 0;
		$query	=	$CI->mine_db->set("cms_content", "
								content_parent = {$_POST['editpage_id']},
								content_subpage = {$subId},
								content_text 	= '".mysql_real_escape_string($_POST['editpage_text'])."',
								content_info 	= '".mysql_real_escape_string($_POST['editpage_info'])."',
								content_author 	= {$_POST['editpage_user']},
								content_date 	= '{$_POST['editpage_date']}'
								", " id = {$_POST['content_id']} 								
							");
							
		return $query;
	}
	
	function createContent($_POST){
		$CI		=&	get_instance();
		$query	=	$CI->mine_db->insert("cms_content", "
								content_parent	= '{$CI->mine_db->lastID()}',
								content_subpage	= '{$_POST['createpage_parent']}',
								content_text 	= '".mysql_real_escape_string($_POST['createpage_text'])."',
								content_info 	= '".mysql_real_escape_string($_POST['createpage_info'])."',
								content_author 	= {$_POST['createpage_user']},
								content_date 	= '{$_POST['createpage_date']}'
							");
		return $query;
	}
}
?>