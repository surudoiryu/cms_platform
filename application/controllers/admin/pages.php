<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {
	
	public $data, $data_		=	NULL;
	
	function __construct()
	{
		parent::__construct();
		$this->data	=	$this->common_lib->commonData(1);
		$this->data['pages']	=	array('Dashboard','Filemanager','Pages','Settings','Users');
		$this->data['translate']=	$this->common_lib->getTranslation($this);
		$this->data['loadPage']	=	'pages.tpl';
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
		$this->data['webPages']		=	$this->cms_pages->getAll();
		$this->data['subpages']		=	$this->cms_subpages->getAll();
		$this->data['userLevels']	=	$this->cms_userlevels->getAll();
		$this->parser->parse("admin/template.tpl", 	$this->data);
	}
	
	function editpage()
	{
		if($this->input->post()){
			if( ! $this->input->post('editsubpage_name')){
				$this->form_validation->set_rules('editpage_name', 'Pagina naam', 'trim|required');
			}else{
				$this->form_validation->set_rules('editsubpage_name', 'Pagina naam', 'trim|required');
			}
			$this->form_validation->set_rules('editpage_parent', 'Onderdeel van', 'trim|required');
			$this->form_validation->set_rules('editpage_text', 'Inhoud', 'required');
			$this->form_validation->set_rules('editpage_info', 'Informatie', 'trim|required');
			$this->form_validation->set_rules('editpage_restriction', 'Pagina toegang', 'trim|required');
			$this->form_validation->set_rules('editpage_menu', 'Menu positie', 'trim|required');
			if($this->form_validation->run() === TRUE)
			{
				if( ! $this->input->post('editsubpage_name')){
					$this->cms_pages->editPage($this->input->post());
				}else{
					echo $this->cms_subpages->editSubpage($this->input->post());
				}
				$this->cms_content->editContent($this->input->post());
				redirect('admin/pages/');  
			}
		}
		$segment_array			=	$this->data['segment_array'];
		$subpage			=	(isset($segment_array['subpage'])) ? $segment_array['subpage'] : 0;
		$this->data['webPages']		=	$this->cms_pages->getAll($segment_array['editpage'],1);
		$this->data['allPages']		=	$this->cms_pages->getAll();
		$this->data['subPage']		=	(is_array($this->cms_subpages->getAll($segment_array['editpage']))) ? $this->cms_subpages->getAll($segment_array['editpage']) : 0 ;
		$this->data['webContent']	=	$this->cms_content->getAll($segment_array['editpage'],$subpage,1);
		$this->data['userLevels']	=	$this->cms_userlevels->getAll();
		$this->data['date']		=	date('Y-m-d H:i:s');
		$this->parser->parse("admin/template.tpl", 	$this->data);
	}
	
	function createpage()
	{
		if($this->input->post()){
			$this->form_validation->set_rules('createpage_name', 'Pagina naam', 'trim|required');
			$this->form_validation->set_rules('createpage_parent', 'Onderdeel van', 'trim|required');
			$this->form_validation->set_rules('createpage_text', 'Inhoud', 'required');
			$this->form_validation->set_rules('createpage_info', 'Informatie', 'trim|required');
			$this->form_validation->set_rules('createpage_restriction', 'Pagina toegang', 'trim|required');
			$this->form_validation->set_rules('createpage_menu', 'Menu positie', 'trim|required');
			if($this->form_validation->run() === TRUE)
			{
				$this->cms_pages->createPage($this->input->post());
				if($this->input->post('createpage_parent') > 0)
				{
					$this->cms_subpages->createSubpage($this->input->post());
				}
				$this->cms_content->createContent($this->input->post());
				redirect('admin/pages/');  
			}
		}
		$this->data['webPages']		=	$this->cms_pages->getAll();
		$this->data['allPages']		=	$this->cms_pages->getAll();
		$this->data['userLevels']	=	$this->cms_userlevels->getAll();
		$this->data['date']		=	date('Y-m-d H:i:s');
		$this->parser->parse("admin/template.tpl", 	$this->data);
	}
}