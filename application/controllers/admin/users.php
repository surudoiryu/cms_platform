<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
	
	public $data, $data_		=	NULL;
	
	function __construct()
	{
		parent::__construct();
		$this->data	=	$this->common_lib->commonData(1);
		$data		=	$this->common_lib->commonData(2);
		$this->data['segment_user']	=	$data['segment_array'];
		$this->data['loadPage']	=	'users.tpl';
	}
	
	/**
	*
	* *****
	*
	* @return      page
	*
	*/		
	
	function index()
	{
		//What words will this page translate?
		$this->data['translate']	=	$this->common_lib->getTranslation($this);
		$this->data['allUsers']		=	$this->cms_users->getAll(0);
		$this->data['bannedUsers']	=	$this->cms_users->getAll(0,' user_banned = 1 ');
		$this->data['inactiveUsers']=	$this->cms_users->getAll(0,' user_lastlogindate BETWEEN CURDATE() and DATE_SUB(CURDATE(),INTERVAL 6 MONTH) ');
		$this->data['loggedinUsers']=	$this->cms_users->getAll(0,' user_lastlogindate BETWEEN CURDATE() and DATE_SUB(CURDATE(),INTERVAL 5 MINUTE) ');
		$this->data['allLands']		=	$this->cms_lands->getAll();
		$this->data['userLevels']	=	$this->cms_userlevels->getAll();
		//Send the data to the view.
		$this->parser->parse("admin/template.tpl", 	$this->data);
	}
	
	function blocked()
	{
		//What words will this page translate?
		$this->data['translate']	=	$this->common_lib->getTranslation($this);
		$this->data['allUsers']		=	$this->cms_users->getAll(0);
		$this->data['bannedUsers']	=	$this->cms_users->getAll(0,' user_banned = 1 ');
		$this->data['inactiveUsers']=	$this->cms_users->getAll(0,' user_lastlogindate BETWEEN CURDATE() and DATE_SUB(CURDATE(),INTERVAL 6 MONTH) ');
		$this->data['loggedinUsers']=	$this->cms_users->getAll(0,' user_lastlogindate BETWEEN CURDATE() and DATE_SUB(CURDATE(),INTERVAL 5 MINUTE) ');
		$this->data['allLands']		=	$this->cms_lands->getAll();
		$this->data['userLevels']	=	$this->cms_userlevels->getAll();
		//Send the data to the view.
		$this->parser->parse("admin/template.tpl", 	$this->data);
	}
	
	function inactive()
	{
		//What words will this page translate?
		$this->data['translate']	=	$this->common_lib->getTranslation($this);
		$this->data['allUsers']		=	$this->cms_users->getAll(0);
		$this->data['bannedUsers']	=	$this->cms_users->getAll(0,' user_banned = 1 ');
		$this->data['inactiveUsers']=	$this->cms_users->getAll(0,' user_lastlogindate BETWEEN CURDATE() and DATE_SUB(CURDATE(),INTERVAL 6 MONTH) ');
		$this->data['loggedinUsers']=	$this->cms_users->getAll(0,' user_lastlogindate BETWEEN CURDATE() and DATE_SUB(CURDATE(),INTERVAL 5 MINUTE) ');
		$this->data['allLands']		=	$this->cms_lands->getAll();
		$this->data['userLevels']	=	$this->cms_userlevels->getAll();
		//Send the data to the view.
		$this->parser->parse("admin/template.tpl", 	$this->data);
	}
	
	function loggedin()
	{
		//What words will this page translate?
		$this->data['translate']	=	$this->common_lib->getTranslation($this);
		$this->data['allUsers']		=	$this->cms_users->getAll(0);
		$this->data['bannedUsers']	=	$this->cms_users->getAll(0,' user_banned = 1 ');
		$this->data['inactiveUsers']=	$this->cms_users->getAll(0,' user_lastlogindate BETWEEN CURDATE() and DATE_SUB(CURDATE(),INTERVAL 6 MONTH) ');
		$this->data['loggedinUsers']=	$this->cms_users->getAll(0,' user_lastlogindate BETWEEN CURDATE() and DATE_SUB(CURDATE(),INTERVAL 5 MINUTE) ');
		$this->data['allLands']		=	$this->cms_lands->getAll();
		$this->data['userLevels']	=	$this->cms_userlevels->getAll();
		//Send the data to the view.
		$this->parser->parse("admin/template.tpl", 	$this->data);
	}
	
	function edituser()
	{
		if($this->input->post()){
			$this->form_validation->set_rules('edituser_firstname', 'Pagina naam', 'trim|required');
			$this->form_validation->set_rules('edituser_lastname', 'Onderdeel van', 'trim|required');
			$this->form_validation->set_rules('edituser_email', 'Inhoud', 'email|required');
			$this->form_validation->set_rules('edituser_level', 'Informatie', 'trim|required');
			if($this->form_validation->run() === TRUE)
			{
				$this->cms_users->editUser($this->input->post());
				redirect('admin/users/');  
			}
		}
		$segment_array				=	$this->data['segment_array'];
		//What words will this page translate?
		$this->data['translate']	=	$this->common_lib->getTranslation($this);
		$this->data['users']		=	$this->cms_users->getUser($segment_array['edituser']);
		$this->data['allLands']		=	$this->cms_lands->getAll();
		$this->data['userLevels']	=	$this->cms_userlevels->getAll();
		//Send the data to the view.
		$this->parser->parse("admin/template.tpl", 	$this->data);
	}
	
	function createuser()
	{
		if($this->input->post()){
			$this->form_validation->set_rules('createuser_firstname', 'Pagina naam', 'trim|required');
			$this->form_validation->set_rules('createuser_lastname', 'Onderdeel van', 'trim|required');
			$this->form_validation->set_rules('createuser_email', 'Inhoud', 'email|required');
			$this->form_validation->set_rules('createuser_level', 'Informatie', 'trim|required');
			if($this->form_validation->run() === TRUE)
			{
				$this->cms_users->createUser($this->input->post());
				redirect('admin/users/');  
			}
		}
		//What words will this page translate?
		$this->data['translate']	=	$this->common_lib->getTranslation($this);
		$this->data['allLands']		=	$this->cms_lands->getAll();
		$this->data['userLevels']	=	$this->cms_userlevels->getAll();
		//Send the data to the view.
		$this->parser->parse("admin/template.tpl", 	$this->data);
	}
}