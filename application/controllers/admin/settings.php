<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller {
	
	public $data, $data_		=	NULL;
	
	function __construct()
	{
		parent::__construct();
		$segment_array					=	NULL;
		$this->data						=	$this->common_lib->commonData(1);
		$segment_array					=	$this->common_lib->commonData(2);
		$this->data['segment_setting']	=	$segment_array['segment_array'];
		$this->data['loadPage']			=	'settings.tpl';
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
		if(isset($_POST['editsettings_submit']))
		{
			if($this->input->post()){
				$this->form_validation->set_rules('editsettings_title', 'Website Title', 'trim|required');
				$this->form_validation->set_rules('editsettings_template', 'Website Template', 'trim|required');
				$this->form_validation->set_rules('editsettings_mail', 'Website Mail', 'email|required');
				$this->form_validation->set_rules('editsettings_font', 'Website Font', 'trim|required');
				if($this->form_validation->run() === TRUE)
				{
					$this->cms_settings->editSettings($this->input->post());
					redirect('admin/settings/');  
				}
			}
		}
		$list	=	array();
		//What words will this page translate?
		$this->data['translate']	=	$this->common_lib->getTranslation($this);
		//Send the data to the view.
		$path  = SMARTY_TEMPLATE_DIRECTORY.'templates/';
		$array = array_filter(glob($path.'*'), 'is_dir'); 
		foreach($array as $skin)
		{ 
			$exploded 	= 	explode('/',$skin);
			$list[]		=	end($exploded);
		}
		$this->data['templates']	=	$list;
		$this->data['settings']		=	$this->cms_settings->getLast();
		$this->parser->parse("admin/template.tpl", 	$this->data);
	}
	
	function seo()
	{
		if(isset($_POST['editseo_submit']))
		{
			if($this->input->post()){
				$this->form_validation->set_rules('editseo_description', 'Website Description', 'trim|required');
				$this->form_validation->set_rules('editseo_keywords', 'Website Keywords', 'trim|required');
				$this->form_validation->set_rules('editseo_author', 'Website Author', 'trim|required');
				$this->form_validation->set_rules('editseo_copyright', 'Website Copyright', 'trim|required');
				if($this->form_validation->run() === TRUE)
				{
					$this->cms_settings->editSeo($this->input->post());
					redirect('admin/settings/seo');  
				}
			}
		}
		//What words will this page translate?
		$exploded					=	NULL;
		$this->data['translate']	=	$this->common_lib->getTranslation($this);
		//Send the data to the view.
		$this->data['settings']		=	$this->cms_settings->getLast();
		$exploded					=	explode(" ",$this->data['settings']['setting_revisit']);
		$this->data['robotday']		=	$exploded[0];
		$this->data['lands']		=	$this->cms_lands->getAll();
		$this->parser->parse("admin/template.tpl", 	$this->data);
	}
	
	function plugins()
	{
		//What words will this page translate?
		$this->data['translate']	=	$this->common_lib->getTranslation($this);
		//Send the data to the view.
		$this->data['plugins_inactive']		=	$this->cms_plugins->getInactive();
		$this->data['plugins_active']		=	$this->cms_plugins->getActive();
		$this->parser->parse("admin/template.tpl", 	$this->data);
	}
	
	function backup()
	{
		if(isset($_POST['database_restore']))
		{
			$this->execute_sql_script(SQL_BACKUP_DIRECTORY.$_POST['database_sqlfile']);
		}
		if(isset($_POST['database_backup']))
		{
			//get all of the tables
			$return = "";
			$tables = array();
			$result = mysql_query('SHOW TABLES');
			while($row = mysql_fetch_row($result))
			{
			  $tables[] = $row[0];
			}
			//cycle through
			foreach($tables as $table)
			{
				$result = mysql_query('SELECT * FROM '.$table);
				$num_fields = mysql_num_fields($result);
				
				$return.= 'DROP TABLE IF EXISTS '.$table.';';
				$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
				$return.= "\n\n".$row2[1].";\n\n";
				
				for ($i = 0; $i < $num_fields; $i++) 
				{
					while($row = mysql_fetch_row($result))
					{
						$return.= 'INSERT INTO '.$table.' VALUES(';
						for($j=0; $j<$num_fields; $j++) 
						{
							$row[$j] = addslashes($row[$j]);
							$row[$j] = preg_replace("/\n/","\\n",$row[$j]);
							if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
							if ($j<($num_fields-1)) { $return.= ','; }
						}
						$return.= ");\n";
					}
				}
			$return.="\n\n\n";
			}

			// Alles op het scherm toveren
			$dbFile = SQL_BACKUP_DIRECTORY.date('d-m-Y_His')."backup.sql";
			$fh = fopen($dbFile, 'w');
			fwrite($fh, $return);
			fclose($fh);
		}
		//What words will this page translate?
		$this->data['translate']	=	$this->common_lib->getTranslation($this);
		//Send the data to the view.
		$this->data['dbArray']		=	$this->common_lib->dirlist(SQL_BACKUP_DIRECTORY);
		$this->parser->parse("admin/template.tpl", 	$this->data);
	}
	
	function execute_sql_script($filename)
    {
        $fd = fopen($filename, "r");
    
        $query = "";
        while(!feof ( $fd ))
        {
            $line = fgets($fd, 4096);
			if((strlen($line)-2) > 3)
			{
				if($line[strlen($line)-2] == ";")
				{
					$query .= substr($line, 0, -2);
					mysql_query($query);
					if ( mysql_errno() )
						echo "<font color=\"red\">Error executing query</font><br><pre>$query</pre><br>".mysql_errno().": ".mysql_error()."<br>\n";
					$query = "";
				} else {
					$query .= $line;
				}
			}
			/*echo '---------------->'.$line[strlen($line)-2];
            if ( strstr($line, ";") != false )
            {
                $query .= substr($line, 0, strpos($line, ";"));
                mysql_query($query);
                if ( mysql_errno() )
                    echo "<font color=\"red\">Error executing query</font><br><pre>$query</pre><br>".mysql_errno().": ".mysql_error()."<br>\n";
                $query = "";
            } else
                $query .= $line;*/
        }
    } 
}