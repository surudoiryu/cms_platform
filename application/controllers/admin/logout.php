<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {
	
	public $data, $data_		=	NULL;
	
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$this->session->sess_destroy();
		echo '<script type="text/javascript">window.location = "'.WEBSITE_URL_BE.'"</script>';
	}
}
?>