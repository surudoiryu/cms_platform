<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common_lib
{
	
	public $segment_array;
	public $listarray	=	NULL;

	function commonData($aangepast_segment_array = 1)
	{
		$CI		=& get_instance();
		$CI->lang->load('nl_admin', 'nederlands'); // ('filename', 'directory')
		
		$this->segment_array						=	NULL;
		$this->segment_array						=	array_filter($CI->uri->uri_to_assoc($aangepast_segment_array));
		$template									=	'';
		$fonts										=	substr(($this->getTinyMCE_Fonts().",".$this->getGoogle_Fonts()),0,-1);
		//print_r($CI->session->userdata); echo '<---';
		if(!empty($this->segment_array['admin']) || isset($CI->session->userdata['user_session']))
		{
			$template	=	$this->segment_array['admin'];
			$sessionArr	=	$CI->session->userdata;
			$ses_level	=	$CI->session->userdata['user_session']['userlevel'];
			$ses_id		=	$CI->session->userdata['user_session']['userid'];
			$CI->cms_users->setOnline($ses_id);
			//print_r($CI->session->userdata);exit('hmmm');
			if(empty($ses_level) || empty($ses_id))
			{
				$CI->session->sess_destroy();
				echo '<script type="text/javascript">window.location = "'.WEBSITE_URL_BE.'"</script>';
				exit();
			}
		}
		
		$data = array(
				'base_url' 							=> 	base_url(),
				'base_url_be' 						=> 	WEBSITE_URL_BE,
				'base_url_fe' 						=> 	WEBSITE_URL_FE,
				'styleUrl'	 						=> 	WEBSITE_URL_STYLES,
				'scriptUrl' 						=> 	WEBSITE_URL_SCRIPTS,
				'imagesUrl' 						=> 	WEBSITE_URL_IMAGES,
				'uploadsUrl'						=>	WEBSITE_URL_UPLOADS,
				'templateUrl'						=>	SMARTY_TEMPLATE_DIRECTORY,
				'segment_array'						=> 	$this->segment_array,
				'template'							=>	'pages/'.$template,
				'standardFontsStyles'				=>	$fonts,
				'fontStyles'						=>	'http://fonts.googleapis.com/css?family=Aclonica,http://fonts.googleapis.com/css?family=Michroma,http://fonts.googleapis.com/css?family=Paytone+One',
				'pages'								=>	array('Dashboard','Filemanager','Pages','Settings','Users'),
		  );	
		//$CI->load->helper('lang_translate');
		return $data;		
	}
	
	function getTinyMCE_Fonts()
	{
		// Default fonts for TinyMCE
		$fonts = 'Andale Mono=Andale Mono, Times;';
		$fonts .= 'Arial=Arial, Helvetica, sans-serif;';
		$fonts .= 'Arial Black=Arial Black, Avant Garde;';
		$fonts .= 'Book Antiqua=Book Antiqua, Palatino;';
		$fonts .= 'Comic Sans MS=Comic Sans MS, sans-serif;';
		$fonts .= 'Courier New=Courier New, Courier;';
		$fonts .= 'Georgia=Georgia, Palatino;';
		$fonts .= 'Helvetica=Helvetica;';
		$fonts .= 'Impact=Impact, Chicago;';
		$fonts .= 'Symbol=Symbol;';
		$fonts .= 'Tahoma=Tahoma, Arial, Helvetica, sans-serif;';
		$fonts .= 'Terminal=Terminal, Monaco;';
		$fonts .= 'Times New Roman=Times New Roman, Times;';
		$fonts .= 'Trebuchet MS=Trebuchet MS, Geneva;';
		$fonts .= 'Verdana=Verdana, Geneva;';
		$fonts .= 'Webdings=Webdings;';
		$fonts .= 'Wingdings=Wingdings, Zapf Dingbats';
		return $fonts;
	}
	
	function getGoogle_Fonts($selection = "")
	{
		// Google Web Fonts
		$fonts	=	"";
		$fontsSerialized = file_get_contents('http://phat-reaction.com/googlefonts.php?format=php');
		$fontArray = unserialize($fontsSerialized);
		foreach($fontArray as $key => $value){
			$explValue	=	explode(",",$value['font-family']);
			$fonts		.=	$value['font-name']."=".$value['font-name'] .",". $explValue[1];
		}
		return $fonts;
	}
	
	/**
	*
	* Get the translation for the page
	*
	* @return      Array
	*
	*/		
	
	function getTranslation($obj)
	{
		$translation	=	array(
				'welcome'				=>	label('welcome', $obj),
				'logout'				=>	label('logout', $obj),
				'view_site'				=>	label('view_site', $obj),
				'update_information'	=>	label('update_information', $obj),
				'user_statics'			=>	label('user_statics', $obj),
				'registerd_users'		=>	label('registerd_users', $obj),
				'banned_users'			=>	label('banned_users', $obj),
				'inactive_users'		=>	label('inactive_users', $obj),
				'loggedin_users'		=>	label('loggedin_users', $obj),
				'website_statics'		=>	label('website_statics', $obj),
				'total_pages'			=>	label('total_pages', $obj),
				'total_comments'		=>	label('total_comments', $obj),
				'last_comment'			=>	label('last_comment', $obj),
				'cms_information'		=>	label('cms_information', $obj),
				'cms_version'			=>	label('cms_version', $obj),
				'cms_code'				=>	label('cms_code', $obj),
				);
		return $translation;
	}	

	function printArray($array, $serialized = FALSE)
	{
		if($serialized)
		{
			$array		= unserialize($array);
		}
		if(is_array($array))
		{
			echo("<pre>");
			print_r($array);
			echo("</pre>");
		}
		else
		{
			echo("{$array} is geen array");
		}
	}	
	
		
	
	function isIsset($variabel)
	{
		if(!empty($variabel) || str_len($variabel) > 0)
		{
			return $variabel;
		}
		else
		{
			return "";
		}
	}
		

	function geboorteDatum($geboorteDatum)
	{
		if(!empty($geboorteDatum))
		{
			//jaar-maand-dag
			$gd		=	explode("-", $geboorteDatum);
			$jaar	=	$gd[0];
			$maand	=	$this->getMonthname($gd[1]);
			$dag	=	$gd[2];
			$age	=	($this->GetAge($geboorteDatum)	<	0	?	"n.v.t."	:	$this->GetAge($geboorteDatum));
			if($age	!= "n.v.t.")
			{
				return $dag . " " . $maand . " " . $jaar . " (" . $age . " jaar)";
			}
			else
			{
				return $dag . " " . $maand . " " . $jaar . " (Leeftijd onbekend.)";
			}
		}
		else
		{
			return "Niet gespecificeerd.";
		}
		
	}

	function convertDateToText($lidactiefsinds, $showTime = FALSE)
	{
		if(!empty($lidactiefsinds))
		{
			$lidactiefsinds			= explode("-", $lidactiefsinds);
			$lid_dag 				= ($lidactiefsinds[2] == '00' ? '01' : $lidactiefsinds[2]);
			$lidactiefsinds[1] 		= ($lidactiefsinds[1] == '00' ? '01' : $lidactiefsinds[1]);
			$lid_maand 				=  $this->getMonthname($lidactiefsinds[1]);
			$lid_jaar 				= ($lidactiefsinds[0] == '0000' ? '2007' : $lidactiefsinds[0]);
			
			if(!$showTime)
			{
				return substr($lid_dag,0,2) . " " . $lid_maand . " " . $lid_jaar;
			}
			else
			{
				return substr($lid_dag,0,2) . " " . $lid_maand . " " . $lid_jaar . "<br />(" . substr($lid_dag,3) . ")";
			}
		}
		else
		{
			return "Niet gespecificeerd.";
		}
	}

	//$birthday = yyyy-mm-dd
	function getAge($birthday) 
	{
		list($Y,$m,$d)    = explode("-",$birthday);
		return ( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
	}

	function getMonthname($month)
	{

		switch($month)
		{
			case "1":
				return "januari";
				break;


			case "2":
				return "februari";
				break;

			case "3":
				return "maart";
				break;

			case "4":
				return "april";
				break;

			case "5":
				return "mei";
				break;

			case "6":
				return "juni";
				break;

			case "7":
				return "juli";
				break;

			case "8":
				return "augustus";
				break;

			case "9":
				return "september";
				break;

			case "10":
				return "oktober";
				break;

			case "11":
				return "november";
				break;

			case "12":
				return "december";
				break;
		}//end switch month
	}//end function getmonthname

	function convertToDate($date)
	{

		//jaar-maand-dag
		$gd		=	explode("-", $date);
		$jaar	=	$gd[0];
		$maand	=	getMonthname($gd[1]);
		$dag	=	$gd[2];
		$age	=	(GetAge($date)	<	0	?	"n.v.t."	:	GetAge($date));
		if($age	!= "n.v.t.")
		{
			return $dag . " " . $maand . " " . $jaar . " (" . $age . " Jaar)";
		}
		else
		{
			return $dag . " " . $maand . " " . $jaar;
		}

	}

	function shorten($text, $limit) 
	{
		if (strlen($text) > $limit)
		  {
		  $text = substr($text, 0, $limit-3) .'...';
		  }
		  return $text;
	}

	
	//##################### NOTIFICATIONS SETUP ########################################//
	
	//return string
	function setError($message)
	{
		if(!empty($message))
		{
			$base_url		=	base_url();
			$error 	= "";
			$error	.=	'<table class="table_red hidefromfax hidefromemail hidefromprint" id="messageError" width="100%">';
			$error	.=	'<tr>';
			$error	.=	'<td width="30px"><img class="v_middle" src="'.$base_url.'public/images/icons/error.png" title="Error" /></td>';
			$error	.=	"<td style='vertical-align:middle'>{$message}</td>";
			$error	.=	"</tr>";
			$error	.=	"</table>";
			
			return $error;	
		}
	}

	//return string
	function setSuccess($message)
	{
		if(!empty($message))
		{
			$base_url		=	base_url();
			$success 	= "";
			$success	.=	'<table class="table_green hidefromfax hidefromemail hidefromprint" id="messageSuccess" width="100%">';
			$success	.=	'<tr>';
			$success	.=	'<td width="30px"><img class="v_middle" src="'.$base_url.'public/images/icons/success.gif" title="Success" /></td>';
			$success	.=	"<td style='vertical-align:middle'>{$message}</td>";
			$success	.=	"</tr>";
			$success	.=	"</table>";
			
			return $success;
		}
	}

	//return string
	function setNotification($message)
	{
		if(!empty($message))
		{
			$base_url		=	base_url();
			$notification 	= "";
			$notification	.=	'<table class="table_yellow hidefromfax hidefromemail hidefromprint" id="messageNotification" width="100%">';
			$notification	.=	'<tr>';
			$notification	.=	'<td width="30px"><img class="v_middle" src="'.$base_url.'public/images/icons/notification.gif" title="Notificatie" /></td>';
			$notification	.=	"<td style='vertical-align:middle'>{$message}</td>";
			$notification	.=	"</tr>";
			$notification	.=	"</table>";
			
			return $notification;
		}
	}

	
	//return string
	function setMiniError($boolean = 'false', $text)
	{
		if(!empty($text))
		{
			$base_url		=	base_url();
			switch($boolean)
			{
				case "true":
				
					return "<img class='v_middle' src='{$base_url}public/images/icons/notification.png' alt='Email of Wachtwoord incorrect' title='Email of Wachtwoord incorrect' />&nbsp;<small class='color_red'>{$text}</small>";
					
				break;
				
				case "false":
					
					return "";
					
				break;	
			}
		}	
	}

	
	//example::: 1986-06-24
	//Gebruikt bij werknemer, zzp + werkgever
	function getSplicedBirthday($birthday, $spliceOption = "-", $whatToReturn = "day")
	{
		$birthday	=	explode($spliceOption, $birthday);
		switch($whatToReturn)
		{
			case "year":
				return (!empty($birthday[0]))	?	$birthday[0]	:	date("Y");
			break;
			case "month":
				return (!empty($birthday[1]))	?	$birthday[1]	:	date("m");
			break;		
			case "day":
				return (!empty($birthday[2]))	?	$birthday[2]	:	date("d");
			break;
			default:
				return "-- Specify what you want to return (year, month or day) --";
			break;
		}
		
	}

	//$array is de multidimensional array
	//$valueName is de naam van de key van de second array
	//$default_array is de default waarde dat de array zal krijgen ..voorbeeld: -- Maak een keuze --
	//$keyIsValue (TRUE) is als de key naam hetzelfde moet zijn als de value ..voorbeeld: array('Darrel' => 'Darrel')
	function convertMultiArrayToSingleArray($array, $valueNaam, $default_array = "", $keyIsValue = FALSE)
	{
		$singleArray	=	!empty($default_array) && is_array($default_array)	?	$default_array	:	array();
		
		if(is_array($array))
		{
			foreach($array as $key => $gegevens) 
			{
				if($keyIsValue)
				{
					$singleArray[$gegevens[$valueNaam]] = stripslashes($gegevens[$valueNaam]);
				}
				else
				{
					$singleArray[$key] = stripslashes($gegevens[$valueNaam]);
				}
			}
		
		}
		return $singleArray;
	}
	
	/**
	 *
	 * Get een specifieke provincie
	 *
	 * @param    	string $uriString de complete string na de bezoekte url
	 * @param    	boolean $metLinks  true = wordt een string returned met daarin links eraan gehangt. False = wordt alleen een string returned voor de metaPage
	 * @return      string
	 *
	 */	
	
	function breadCrumps($uriString, $metLinks = TRUE, $controllerOn = TRUE, $functionOn = TRUE, $subPageOn = TRUE)
	{
		$CI 			=& get_instance();
		$uriArray		=	explode('/', $uriString);
		$controller		=	(isset($uriArray[0]))	?	$uriArray[0]			:	'';
		$function		=	(isset($uriArray[1]))	?	$uriArray[1]			:	'';
		$subpage		=	(isset($uriArray[2]))	?	$uriArray[2]			:	'';
		
		$htmlController	=	($controllerOn)	?	ucfirst(str_replace('-',' ',$CI->converter_lib->replaceAll($controller)))	:	'';
		$htmlFunction	=	($functionOn)	?	ucfirst(str_replace('-',' ',$CI->converter_lib->replaceAll($function)))		:	'';
		$htmlSubpage	=	($subPageOn)	?	ucfirst(str_replace('-',' ',$CI->converter_lib->replaceAll($subpage)))		:	'';
		
		$breadCrumps	= "<strong>Je bent hier:</strong> <a href='" . BRANCHE_URL_FE . "'>Home</a>";
		$breadCrumps	.=	(!empty($controller) && empty($function) && empty($subpage))		?	" / <a href='" . BRANCHE_URL . "{$controller}/'>{$htmlController}</a>"	:	'';
		$breadCrumps	.=	(!empty($controller) && !empty($function) && empty($subpage))		?	" / <a href='" . BRANCHE_URL . "{$controller}/'>{$htmlController}</a> / <a href='" . BRANCHE_URL . "{$controller}/{$function}/'>{$htmlFunction}</a>"	:	'';
		$breadCrumps	.=	(!empty($controller) && !empty($function) && !empty($subpage))		?	" / <a href='" . BRANCHE_URL . "{$controller}/'>{$htmlController}</a> / <a href='" . BRANCHE_URL . "{$controller}/{$function}/'>{$htmlFunction}</a> / <a href='" . BRANCHE_URL . "{$controller}/{$function}/{$subpage}/'>{$htmlSubpage}</a>"	:	'';
		
		if($metLinks === FALSE)
		{
			$controller 	= 	(!empty($controller))	?	$controller			:	'index';
			$function		=	(!empty($function))		?	'/' . $function		:	'';
			$subpage		=	(!empty($subpage))		?	'/' . $subpage		:	'';
			
			$metaPage		=	$controller . $function . $subpage;
			
			return $metaPage;
		}
		else if($metLinks  === TRUE)
		{
			return $breadCrumps;
		}
	}
	
	/*
	@param $haystack is string
	@param $needles is array or string
	
	return boolean;
	*/
		function strpos_array($haystack, $needles) 
		{
			if ( is_array($needles) ) 
			{
				foreach ($needles as $str) 
				{
					if ( is_array($str) ) 
					{
						$pos = strpos_array($haystack, $str);
					} 
					else 
					{
						$pos = strpos($haystack, $str);
					}
					if ($pos !== FALSE) 
					{
						return TRUE;
					}
					
				}
			} 
			else 
			{
				return strpos($haystack, $needles);
			}
		}

	function convertArrayToString($SingleDimensional_array, $delimiter)
	{
		$string	=	NULL;
		if(is_array($SingleDimensional_array))
		{
			foreach($SingleDimensional_array as $key => $value)
			{
				$string .= $value . $delimiter;
			}
			return substr($string, 0,-1);
		}
		else
		{
			return $string;
		}	
		
		
	}
	
	function randomDate($startDate,$endDate)
	{
		$days 	= round((strtotime($endDate) - strtotime($startDate)) / (60 * 60 * 24));
		$n 		= rand(0,$days);
		return date("Y-m-d",strtotime("$startDate + $n days"));   
	}	
	
	
	function myUrlEncode($string) 
	{
		$entities = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
		$replacements = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
		return str_replace($entities, $replacements, urlencode($string));
	}
	
	function myUrlDecode($string) 
	{
		$entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
		$replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
		return str_replace($entities, $replacements, urldecode($string));
	}
	
	//wordt voor de SITEMAP gebruiker
	//zoekt in een 3-D array
	function search3DArray($array, $key, $value)
	{
		$results = array();
		
		if(is_array($array))
		{
			foreach($array as $key => $gegevens)
			{
				if ($array[$key] == $value)
				{
					$results[] = $array;
				}
				foreach ($array as $subarray)
				{
					$results = array_merge($results, $this->search3DArray($subarray, $key, $value));
				}
			}
		}
		return $results;
	}	
	
	//BACK-END
	//my own segment_array.
	//wordt gebruikt bij het view van de vacature (als je vanuit de werknemer naar een vacature zoekt)
	function segment_array($windowLocation, $delimiter, $beginnenBij = 2)
	{
		$browserUrl	=	array_slice(explode($delimiter, $windowLocation), ($beginnenBij-1));
		$i 			= 0;
		$retval		=	array();
		$lastval 	= '';
		foreach($browserUrl as $key => $seg)
		{
			if ($i % 2)
			{
				$retval[$lastval] 	= $seg;
			}
			else
			{
				$retval[$seg] 		= FALSE;
				$lastval 			= $seg;
			}

			$i++;
		}
		return $retval;
	}
	
	//frontend
	//om met de body.tpl te kunnen communiceren
	function segment_arrays($windowLocation)
	{
		$segment_array					=	NULL;
		$segment_array					=	explode('/', $windowLocation);
		$segment_array['page']			=	(isset($segment_array[0]))	?	$segment_array[0]	:	'';
		$segment_array['subpage']		=	(isset($segment_array[1]))	?	$segment_array[1]	:	'';
		$segment_array['type']			=	(isset($segment_array[2]))	?	$segment_array[2]	:	'';
		$segment_array['subtype']		=	(isset($segment_array[3]))	?	$segment_array[3]	:	'';

		return $segment_array;
	}

	function dirlist($dir, $reset = true) {
		if($reset)
		{
			$this->listarray	=	NULL;
		}
		foreach(scandir($dir) as $entry)
			if($entry != '.' && $entry != '..')
			{
				$entry  = $dir.'/'.$entry;
				if(is_dir($entry))
				{
					$path = pathinfo($entry);
					//$listarray[$path['basename']] = $this->dirlist($entry);
					$this->dirlist($entry, false);
				}
				else
				{
					$path = pathinfo($entry);
					$this->listarray[] = $path['basename'];
				}
			}
		return($this->listarray);
	}
	
	function fileAttributes($file)
	{
		$explFile	=	explode(".",$file);
		$dimension	=	getimagesize(FILEMANAGER_PATH.'images/'.$file);
		$fileAttributes['name']		=	$explFile[0];
		$fileAttributes['size']		=	$this->FileSize(FILEMANAGER_PATH.'images/'.$file);
		$fileAttributes['updated']	=	date( "d-m-Y H:i:s", filemtime(FILEMANAGER_PATH.'images/'.$file));
		$fileAttributes['type']		=	$explFile[1];
		$fileAttributes['dimension']=	$dimension[0].' x '.$dimension[1];
		return	$fileAttributes;
	}
	
	function FileSize($file, $setup = null)
	{
		$i	=	NULL;
		$FZ = ($file && @is_file($file)) ? filesize($file) : NULL;
		$FS = array("B","kB","MB","GB","TB","PB","EB","ZB","YB");
	   
		if(!$setup && $setup !== 0)
		{
			return number_format($FZ/pow(1024, $I=floor(log($FZ, 1024))), ($i >= 1) ? 2 : 0) . ' ' . $FS[$I];
		} elseif ($setup == 'INT') return number_format($FZ);
		else return number_format($FZ/pow(1024, $setup), ($setup >= 1) ? 2 : 0 ). ' ' . $FS[$setup];
	}
		
	function cmp($a, $b) {
		if ($a == $b) {
			return 0;
		}
		return ($a < $b) ? -1 : 1;
	}

}//end class

?>