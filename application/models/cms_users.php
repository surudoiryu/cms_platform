<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms_users extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}	
	
	public function getAll($id, $where = '')
	{
		$CI	=&	get_instance();
		if($id == 0)
		{
			$query	=	$CI->mine_db->select('*', 'cms_users', $where, 0);
		}else{
			$query	=	$CI->mine_db->select('*', 'cms_users', $where, 1);
		}
		if(is_array($query))
		{
			return $query;
		}else{
			return NULL;
		}
	}
	
	function editUser($_POST){
		$CI			=	&	get_instance();
		$checked	=	NULL;
		if($_POST['edituser_banned'] == 'on'){$checked = 1;}else{$checked = 0;}
		if(isset($_POST['edituser_password']) && $_POST['edituser_password'] != "")
		{
			$query		=	$CI->mine_db->set("cms_users", "
													user_username = '{$_POST['edituser_username']}',
													user_password = '".md5($_POST['edituser_password'])."',
													user_level = {$_POST['edituser_level']},
													user_firstname = '{$_POST['edituser_firstname']}',
													user_lastname = '{$_POST['edituser_lastname']}',
													user_email = '{$_POST['edituser_email']}',
													user_land = {$_POST['edituser_land']},
													user_banned = {$checked}
												", " id = {$_POST['edituser_id']}
											");
		}else{
			$query		=	$CI->mine_db->set("cms_users", "
													user_username = '{$_POST['edituser_username']}',
													user_level = {$_POST['edituser_level']},
													user_firstname = '{$_POST['edituser_firstname']}',
													user_lastname = '{$_POST['edituser_lastname']}',
													user_email = '{$_POST['edituser_email']}',
													user_land = {$_POST['edituser_land']},
													user_banned = {$checked}
												", " id = {$_POST['edituser_id']}
											");
		}
	}
	
	function createUser($_POST){
		$CI		=&	get_instance();
		$date	=	date('Y-m-d H:i:s');
		$query	=	$CI->mine_db->insert("cms_users", "
													user_username = '{$_POST['createuser_username']}',
													user_password = '".md5($_POST['createuser_password'])."',
													user_level = {$_POST['createuser_level']},
													user_firstname = '{$_POST['createuser_firstname']}',
													user_lastname = '{$_POST['createuser_lastname']}',
													user_email = '{$_POST['createuser_email']}',
													user_land = {$_POST['createuser_land']},
													user_registerdate = '{$date}'
												");
	}
	
	public function getUser($id)
	{
		$CI	=&	get_instance();
		$query	=	$CI->mine_db->select('*', 'cms_users', ' id = '.$id, 1);
		return $query;
	}
	
	public function login($username, $password)
	{
		$CI		=&	get_instance();
		$query	=	$CI->mine_db->select('*', 'cms_users', ' user_username="'.$username.'" AND user_password="'.$password.'" AND user_level = 2 ', 1);
		if(is_array($query))
		{
			$registry	=	array('user_session'	=> array(
				'session_id'=> $CI->session->userdata['session_id'],
				'username' 	=> $username,
				'userlevel'	=> $this->getLevel($username),
				'userid'	=> $this->getID($username)
				));
			$CI->session->set_userdata($registry);
			$this->setOnline($registry['user_session']['userid']);
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	public function logout()
	{
		$CI		=&	get_instance();
		$CI->session->sess_destroy();
		return TRUE;
	}
	
	function getID($username)
	{
		$CI		=&	get_instance();
		$query	=	$CI->mine_db->select('id', 'cms_users', ' user_username="'.$username.'"', 1);
		return $query['id'];
	}
	
	public function getLevel($username)
	{
		$CI		=&	get_instance();
		$query	=	$CI->mine_db->select('user_level', 'cms_users', ' user_username="'.$username.'"', 1);
		return $query['user_level'];
	}
	
	public function getOnline($id)
	{
		$CI		=&	get_instance();
		$query	=	$CI->mine_db->select('user_lastlogindate', 'cms_users', ' id="'.$id.'"', 1);
		$date	=	strtotime($query['user_lastlogindate'].' +5 minutes');
		$newDate=	date("Y-m-d H:i:s", $date);
		if(date('Y-m-d H:i:s') < $newDate)
		{
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	public function setOnline($id)
	{
		$CI		=&	get_instance();
		$query	=	$CI->mine_db->set('cms_users', 'user_lastlogindate = "'.date('Y-m-d H:i:s').'", user_ip = "'.$_SERVER['REMOTE_ADDR'].'"', ' id="'.$id.'"');
	}
}
?>