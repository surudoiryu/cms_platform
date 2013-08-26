<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Filemanager extends CI_Controller {
	
	public $data, $data_		=	NULL;
	
	function __construct()
	{
		parent::__construct();
		$this->data	=	$this->common_lib->commonData(1);
		$data		=	$this->common_lib->commonData(2);
		$this->data['segment_files']	=	$data['segment_array'];
		$this->data['loadPage']	=	'filemanager.tpl';
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
		$this->parser->parse("admin/template.tpl", 	$this->data);
	}
	
	function images()
	{
		$this->index();
	}
	
	function text()
	{
		$this->index();
	}
	
	function film()
	{
		$this->index();
	}
	
	function flash()
	{
		$this->index();
	}
	
	function other()
	{
		$this->index();
	}
	
	function upload()
	{
		$this->parser->parse("admin/template.tpl", 	$this->data);
	}

	  function get_files($root_dir, $all_data=array())
	  {
		// only include files with these extensions
		$allow_extensions = array("php", "html", "jpg");
		// make any specific files you wish to be excluded
		$ignore_files = array("");
		$ignore_regex = '/^_/';
		// skip these directories
		$ignore_dirs = array(".", "..", "images", "films", "flash", "text", "other");
		echo $root_dir."<br/>";
		// run through content of root directory
		$dir_content = scandir($root_dir);
		print_r($dir_content);
		foreach($dir_content as $key => $content)
		{
		  $path = $root_dir.'/'.$content;
		  if(is_file($path) && is_readable($path))
		  {
			// skip ignored files
			if(!in_array($content, $ignore_files))
			{
			  if (preg_match($ignore_regex,$content) == 0)
			  {
				$content_chunks = explode(".",$content);
				$ext = $content_chunks[count($content_chunks) - 1];
				// only include files with desired extensions
				//if (in_array($ext, $allow_extensions))
				//{
					// save file name with path
					$all_data[] = $path;   
				//}
			  }
			}
		  }
		  // if content is a directory and readable, add path and name
		  elseif(is_dir($path) && is_readable($path))
		  {
			// skip any ignored dirs
			if(!in_array($content, $ignore_dirs))
			{
			  // recursive callback to open new directory
			  $all_data = get_files($path, $all_data);
			}
		  }
		} // end foreach
		return $all_data;
	  } // end get_files()


}