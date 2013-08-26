<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Updater_lib
{
	
	public 	$segment_array;
	public	$updated        	=   NULL;
	public	$updateFiles        =   NULL;
	public	$updateDir    		=   'application/updates/';
	public	$updateLocation    	=   '/';
	public	$updateFound		=	'';
	private	$updateHost			=	'http://updates.ungahstudios.com/CMS-UPDATE-PACKAGES/';
	

	function checkUpdate()
	{
		$CI						=& get_instance();
		$this->segment_array	=	NULL;
		$this->segment_array	=	array_filter($CI->uri->uri_to_assoc(1));
		
		ini_set('max_execution_time',60);
		$output	=	$this->getUpdateVersion();
		$data = array(
				'cms_version' 			=> 	''.$this->getCmsVersion(),
				'update_version'		=> 	''.$this->updateFound,
				'update_link'			=> 	'',
				'update_downloaded'		=>	FALSE,
				'update_text'			=>	$output,
		  );	
		return $data;		
	}
	
	function getUpdateVersion(){
		$getVersions 		= 	$this->getLatestVersion();
		$report				=	NULL;
		$notFound			=	FALSE;

		if ($getVersions != '' && $this->segment_array['admin'] == 'update'){
			//If we managed to access that file, then lets break up those release versions into an array.
			$versionList = explode("|", $getVersions);  	
			foreach ($versionList as $aV){
				if ( floatval($aV) > floatval($this->getCmsVersion())) {
					$this->updateFiles	=	FALSE;
					$report	.= '<p>Update gevonden: v'.$aV.'</p>';
					//Download The File If We Do Not Have It
					if(!is_file($this->updateDir.'CMS-'.$aV.'.zip')){
						$report	.=	'<p>Downloaden begonnen van een nieuwe update.</p>';
						$newUpdate = file_get_contents($this->updateHost.'CMS-'.$aV.'.zip');
						
						if(!$newUpdate){
							$report	.= '<p style="font-weight:bold;">Update pakket is niet gevonden. Neem contact op met UngahStudios.com als dit probleem zich blijft voor doen.</p>';
							$notFound = TRUE;
						}
						
						if(!$notFound){
							if(!is_dir($this->updateDir)){
								mkdir($this->updateDir);
							}
							
							$dlHandler = fopen($this->updateDir.'CMS-'.$aV.'.zip', 'w');
							if(!fwrite($dlHandler, $newUpdate)){
								$report	.=	'<p style="font-weight:bold;">Kan de update niet downloaden er is iets mis gegaan. Neem contact op met UngahStudios.com als dit probleem zich blijft voor doen.</p>'; 
							}
							
							fclose($dlHandler);
							$report	.=	'<p>Update '.$aV.' gedownload en opgeslagen</p>';
							//return $report;
						}
					}else{
						$report	.=	'<p style="font-weight:bold;">Update '.$aV.' is gedownload.</p><p>Installeren van de update:</p>'; 
							$report	.= $this->startUpdate($aV);
						//return $report;						
					}
					
				}
			}
		}else{
			if($getVersions != ''){
				$this->updateFound	=	'Er is een nieuwe update gevonden: Versie '.substr($getVersions,-4);
				$this->updateFiles	=	TRUE;
			}else{
				$report				.=	'<p>&raquo; Er is geen nieuwe update gevonden.</p>';
				$this->updateFiles	=	FALSE;				
			}
		}
		
		return $report;
	}
	
	function getLatestVersion(){
		$CI			=&	get_instance();
		$params 	= 	array();
		$level 		= 	array();
		$updates	=	"";
		$xml_file 	= 	$this->updateHost . "updates.xml"; 
		
		if (!$data = implode('', file($xml_file))) {
			die('Er is iets mis gegaan! Neem contact op met UngahStudios.com als dit probleem zich blijft voor doen.');
		}
		
		$xml_parser = 	xml_parser_create(); 
		xml_parser_set_option($xml_parser, XML_OPTION_CASE_FOLDING, 0);
		xml_parser_set_option($xml_parser, XML_OPTION_SKIP_WHITE, 1);
		xml_parse_into_struct($xml_parser, $data, $values, $index);
		xml_parser_free($xml_parser);
		
		foreach ($values as $element) {	
			switch($element['type']) {
				case 'open' :
					if (array_key_exists('attributes', $element)) {
						list($level[$element['level']], $extra) = array_values($element['attributes']);
					}
					else { $level[$element['level']] = $element['tag']; }
					break;
	 
				case 'complete' :
					$start = 1;
					$exec = '$params';
					while($start < $element['level']) {
							$exec .= '[$level['.$start.']]';
							$start++;
					}
					$exec .= '[$element[\'tag\']] = $element[\'value\'];';			
					eval($exec);
					break;
			}
		}
		foreach($params['updates'] as $key => $value){
			$updates	.=	$value['version'] . '|';
		}
		return $updates;
		
	}
	
	function getCmsVersion(){
		$CI			=&	get_instance();
		$version	=	$CI->cms->getVersion();
		return $version;
	}
	
	function setCmsVersion($version){
		$CI	=&	get_instance();
		$CI->cms->setVersion($version);
	}

	function startUpdate($aV){
		$updateLog	=	'';
		$zipHandle 	= 	zip_open($this->updateDir.'CMS-'.$aV.'.zip');
		$updateLog	.= 	'<ul>';
		while ($aF = zip_read($zipHandle) )	{
			$thisFileName = zip_entry_name($aF);
			$thisFileDir = dirname($thisFileName);
					  
			//Continue if its not a file
			if ( substr($thisFileName,-1,1) == '/'){ 
				continue;
			}
	   
			//Make the directory if we need to...
			if ( !is_dir ( WEBSITE_URL_FE . '/'.$thisFileDir )){
					mkdir ( WEBSITE_URL_FE . '/'.$thisFileDir );
				 //$updateLog	.= '<li>Created Directory '.$thisFileDir.'</li>';
			}
					  
			//Overwrite the file
			if ( !is_dir( WEBSITE_URL_FE . '/'.$thisFileName)){
				$updateLog	.= '<li>'.$thisFileName.'...........';
				$contents = zip_entry_read($aF, zip_entry_filesize($aF));
				$contents = str_replace("\\r\\n", "\\n", $contents);
				$updateThis = '';
						  
				//If we need to run commands, then do it.
				if ( $thisFileName == 'upgrade.php' ){
					$upgradeExec = fopen ('upgrade.php','w');
					fwrite($upgradeExec, $contents);
					fclose($upgradeExec);
					include ('upgrade.php');
					unlink('upgrade.php');
					$updateLog	.=	' UITGEVOERD</li>';
				}else{
					$updateThis = fopen($this->updateLocation.$thisFileName, 'w');
					fwrite($updateThis, $contents);
					fclose($updateThis);
					unset($contents);
					$updateLog	.=	' GEUPDATE</li>';
				}
			}
		}
		$updateLog	.= 	'</ul>';
		$this->updated 	= 	TRUE;
		$this->setCmsVersion($aV);
		return $updateLog;
	}
	
}