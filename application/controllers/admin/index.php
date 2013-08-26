<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {
	
	public $data, $data_		=	NULL;
	
	function __construct()
	{
		parent::__construct();
		$this->data	=	$this->common_lib->commonData(1);
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
		$this->data['translate']	=	$this->common_lib->getTranslation($this);
		$user	=	$this->session->userdata('user_session');
		if(empty($user['username']))
		{
			if($this->input->post())
			{
				$username	=	$this->input->post('username');
				$password	=	md5($this->input->post('password'));
				if($this->cms_users->login($username, $password))
				{
					if($this->input->post('keep_username')){
						setcookie('username',	"{$this->input->post('username')}", time()+604800); //604800 Is een week aan seconden
					}else{
						setcookie('username', "", time()-3600);
					}
		
					if($this->input->post('keep_password')){
						setcookie('password', "{$this->input->post('password')}", time()+604800); //604800 Is een week aan seconden
					}else{
						setcookie('password', "", time()-3600);
					}
					//print_r($this->session->userdata);
					
					redirect("admin/dashboard/");
				}else{
					$this->data['message']	=	'Inloggen is mislukt.';
					$this->parser->parse("admin/login.tpl", 	$this->data);
				}
			}else{
				//$this->data['message']	=	'Voer uw gegevens in';
				$this->parser->parse("admin/login.tpl", 	$this->data);
			}
		}else{
			echo '<script type="text/javascript">window.location = "'.WEBSITE_URL_BE.'dashboard/"</script>';
		}
	}
}//end class