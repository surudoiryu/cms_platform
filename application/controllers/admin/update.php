<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Update extends CI_Controller {
	
	public $data, $data_		=	NULL;
	
	function __construct()
	{
		parent::__construct();
		$this->data	=	$this->common_lib->commonData(1);
		$this->data['update']	=	$this->updater_lib->checkUpdate();
		$this->data['loadPage']	=	'updater.tpl';
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
		//Send the data to the view.
		$this->parser->parse("admin/template.tpl", 	$this->data);
	}
}
?>