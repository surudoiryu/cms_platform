<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ungahbrowser extends CI_Controller {
	
	public $data, $data_		=	NULL;
	
	function __construct()
	{
		parent::__construct();
		$this->data						=	$this->common_lib->commonData(1);
		$segment_array					=	$this->common_lib->commonData(2);
		$this->data['segment_setting']	=	$segment_array['segment_array'];
	}	
	
	
	function index(){
		//show all
		$this->data['filter']	=	'images';
		$this->showBrowser();
	}
	
	function image(){
		//show images
		$this->data['filter']	=	'images';
		$this->showBrowser();
	}
	
	function media(){
		//show media
		$this->data['filter']	=	'all';
		$this->showBrowser();
	}
	
	function file(){
		//show media
		$this->data['filter']	=	'all';
		$this->showBrowser();
	}
	
	/**
	 *
	 * *****
	 *
	 * @return      page
	 *
	 */	
	function showBrowser()
	{
		$this->data['translate']	=	$this->common_lib->getTranslation($this);
		//print_r($this->data);
		//Send the data to the view.
		$this->data['imageFiles']	=	$this->common_lib->dirlist(FILEMANAGER_PATH.'images/');
		$this->data['filmFiles']	=	$this->common_lib->dirlist(FILEMANAGER_PATH.'films/');
		$this->data['flashFiles']	=	$this->common_lib->dirlist(FILEMANAGER_PATH.'flash/');
		$this->data['textFiles']	=	$this->common_lib->dirlist(FILEMANAGER_PATH.'text/');
		$this->data['otherFiles']	=	$this->common_lib->dirlist(FILEMANAGER_PATH.'other/');
		$this->data['allFiles']		=	$this->common_lib->dirlist(FILEMANAGER_PATH);
		$session			=	(is_array($this->input->post())) ? array('ses_view' => key($this->input->post())) : array('ses_view' => '');
		if(is_array($this->input->post()))
		{
			$this->session->set_userdata($session);
		}
		$this->data['view']			=	$this->session->userdata('ses_view');
		$this->parser->parse("admin/ungahbrowser.tpl", 	$this->data);
	}
}//end class