<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public $data, $data_		=	NULL;
	
	function __construct()
	{
		parent::__construct();
		$this->data	=	$this->common_lib->commonData(1);
		$this->data['pages']	=	array('Dashboard','Filemanager','Pages','Settings','Users');
		$this->data['loadPage']	=	'dashboard.tpl';
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
		$this->data['cms_info']		=	$this->getCMSInfo();
		$this->data['ses_info']		=	$this->getSESInfo();
		//Send the data to the view.
		$this->parser->parse("admin/template.tpl", 	$this->data);
	}
	
	
	/**
	*
	* Get the info from your database to view all the info you like to view.
	*
	* @return      Array
	*
	*/		
	
	function getCMSInfo()
	{
		$lastComment	=	(is_array($this->cms_comments->getLast())) ? $this->cms_comments->getLast() : '';
		$bannedUsers	=	($this->cms_users->getAll(0,' user_banned = 1 ') == "") ? 0 : count($this->cms_users->getAll(0,' AND user_banned = 1 '));
		$inactiveUsers	=	($this->cms_users->getAll(0,' user_lastlogindate BETWEEN CURDATE() and DATE_SUB(CURDATE(),INTERVAL 6 MONTH) ') == "") ? 0 : count($this->cms_users->getAll(0,' user_lastlogindate BETWEEN CURDATE() AND DATE_SUB(CURDATE(),INTERVAL 6 MONTH) '));
		$loggedinUsers	=	($this->cms_users->getAll(0,' user_lastlogindate BETWEEN CURDATE() and DATE_SUB(CURDATE(),INTERVAL 5 MINUTE) ') == "") ? 0 : count($this->cms_users->getAll(0,' user_lastlogindate BETWEEN CURDATE() AND DATE_SUB(CURDATE(),INTERVAL 5 MINUTE) '));
		$cmsinfo		=	array(
						'registeredUsers'	=>	count($this->cms_users->getAll(0)),
						'bannedUsers'		=>	$bannedUsers,
						'inactiveUsers'		=>	$inactiveUsers,
						'loggedinUsers'		=>	$loggedinUsers,
						'totalPages'		=>	count($this->cms_content->getAll(0)),
						'totalComments'		=>	$this->cms_comments->countAll(),
						'lastComment'		=>	$lastComment,
						'cmsVersion'		=>	$this->cms->getVersion(),
						'cmsCode'			=>	$this->cms->getCode(),
						);
		return $cmsinfo;
		
	}
	
	/**
	*
	* Get the info from a XML file on our server so you will be updated of the new features.
	*
	* @return      Array
	*
	*/		
	
	function getSESInfo()
	{
		$objDOM = new DOMDocument(); 
		$objDOM->load("http://updates.ungahstudios.com/CMS-NEWS/news.xml");
		$news = $objDOM->getElementsByTagName("news"); 
		$sesinfo['title']	=	"";
		$sesinfo['text']	=	"";
		$sesinfo['date']	=	"";
		foreach($news as $value ) 
		{ 
			$titles = $value->getElementsByTagName("title"); 
			$title  = $titles->item(0)->nodeValue; 
			$sesinfo['title']	.=	$title;

			$dates = $value->getElementsByTagName("date"); 
			$date  = $dates->item(0)->nodeValue; 
			$sesinfo['date']	.=	$date;
			
			$texts = $value->getElementsByTagName("text"); 
			$text  = $texts->item(0)->nodeValue; 
			$sesinfo['text']	.=	$text;

		} 
		return $sesinfo;
	}
}