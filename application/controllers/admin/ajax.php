<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {
	
	public $data, $data_		=	NULL;
	
	function __construct()
	{
		parent::__construct();
		//$this->data	=	$this->common_lib->commonData(1);
	}	
	
	function deleteFile()
	{
		$data		=	$this->input->post();
		$directories= array('films','flash','images','other','text');
		$mapname 	= 'public/uploads/';
		$currentName= $data['deleteFile'];
		foreach($directories as $directory)
		{
			$file	= $mapname . $directory . '/' . $currentName;
			if (file_exists($file)) {
				unlink($file);
			}
		}
	}
	
	function editFile()
	{
		$data		= $this->input->post();
		$changeName	= $data['renameFile'];
		$currentName= $data['editFile'];
		$directories= array('films','flash','images','other','text');
		$mapname 	= 'public/uploads/';
		foreach($directories as $directory)
		{
			$file	= $mapname . $directory . '/' . $currentName;
			if (file_exists($file)) {
				$newFile	= $mapname . $directory . '/' . $changeName;
				//echo "The file $currentName exists in $directory";
				rename($file, $newFile);
			}
		}
	}
	
	function updatePages()
	{
		$data	=	$this->input->post();
		if(is_array($data)){
			foreach ($data as $position => $item)
			{ 
				$sub	=	strpos($item, '-');
				if($sub > 0){
					//Do nothing yet, this is for subpages.
				}else{
					//echo 'set '.$item.' op plaats: '.$position.'<br/>';
					$query	=	$this->mine_db->set("cms_pages","page_weight = {$position}", "id = {$item}");
				}
			} 
		}
	}
	
	function deletePages()
	{
		$data		=	$this->input->post();
		if(is_array($data)){
			$id		=	$data['deletePage'];
			$query	=	$this->mine_db->delete("cms_pages", "id = {$id}"); 
		}
	}
	
	function getuser()
	{
		$status	=	NULL;
		$data	=	$this->input->post();
		$user	=	$this->cms_users->getUser($data['user']);
		if($this->cms_users->getOnline($user['id']))
		{
			$status	=	"status_online.gif";
		}else{
			$status	=	"status_offline.gif";
		}
		$return	=	"<div class='personResult'>
					<table style='font-size:12px; padding:10px;'>
					<tr><td style='height:20px;'><img src='".WEBSITE_URL_IMAGES.'icons/flags/'.$this->cms_lands->getFlag($user['user_land'])."' style='margin-right:5px;' alt='".$this->cms_lands->getName($user['user_land'])."'/>{$user['user_username']}</td><td style='text-align:right;'><img src='".WEBSITE_URL_IMAGES."icons/{$status}'</td></tr>
					<tr><td style='height:20px;'>Naam:</td><td style='text-align:right;'>{$user['user_firstname']} {$user['user_lastname']}</td></tr>
					<tr><td style='height:20px;'>Email:</td><td style='text-align:right;'><a href='mailto:{$user['user_email']}'>{$user['user_email']}</a></td></tr>
					<tr><td style='height:20px;'>Geregistreerd:</td><td style='text-align:right;'>{$user['user_registerdate']}</td></tr>
					<tr><td style='height:20px;'>Laatst aangemeld:</td><td style='text-align:right;'>{$user['user_lastlogindate']}</td></tr>
					<tr><td style='height:20px;'>IP adres:</td><td style='text-align:right;'>{$user['user_ip']}</td></tr>
					</table>
					</div>";
		echo $return;
		
	}
	
	function deleteUsers()
	{
		$data		=	$this->input->post();
		if(is_array($data)){
			$id		=	$data['deleteUser'];
			$query	=	$this->mine_db->delete("cms_users", "id = {$id}");			
		}
	}

	function swfupload()
	{
		if (isset($_POST["PHPSESSID"])) {
			session_id($_POST["PHPSESSID"]);
		}
		session_start();
		$images		=	array('jpg','jpeg','gif','png','bmp');
		$films		=	array('avi','mpeg');
		$flash		=	array('swf');
		$texts		=	array('doc','txt','pdf','docx');
		$uploadDir	=	NULL;
		
		if (!isset($_FILES["Filedata"]) || !is_uploaded_file($_FILES["Filedata"]["tmp_name"]) || $_FILES["Filedata"]["error"] != 0) {
			header("HTTP/1.1 500 Internal Server Error");
			echo "invalid upload";
			exit(0);
		}
		
		if (is_uploaded_file($_FILES['Filedata']['tmp_name'])) {
			foreach($_FILES as $upload) {
				$expl = explode(".",$upload["name"]);
				if(in_array(strtolower(end($expl)),$images)){
					echo '++++++++++++IMAGE+++++++++++++++';
					$uploadDir	=	"images";
				}elseif(in_array(strtolower(end($expl)),$films)){
					echo '++++++++++++FILM+++++++++++++++';
					$uploadDir	=	"films";
				}elseif(in_array(strtolower(end($expl)),$flash)){
					echo '++++++++++++FLASH+++++++++++++++';
					$uploadDir	=	"flash";
				}elseif(in_array(strtolower(end($expl)),$texts)){
					echo '++++++++++++TEXT+++++++++++++++';
					$uploadDir	=	"text";
				}else{
					echo '++++++++++++OTHER+++++++++++++++';
					$uploadDir	=	"other";
				}
				if(move_uploaded_file($upload['tmp_name'], 'public/uploads/' . $uploadDir . "/" . $upload["name"])){
					echo 'uploaded file.';
				}	
			}
		}
	}
}
?>