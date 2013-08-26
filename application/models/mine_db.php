<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mine_db extends CI_Model
{
	public $connection;
	
	function __construct()
	{
		parent::__construct();
	}	
	
	/**
	 *
	 * Nieuwe database connection maken
	 * @param string $dbhost de database host
	 * @param string $dbuser de database user
	 * @param string $dbname de database name
	 *
	 * @return      
	 *
	 */		
	
	function dbNewConnection($dbhost, $dbuser, $dbpass, $dbname)
	{
		$connection = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
		mysql_select_db($dbname);
	}
	
	/**
	 *
	 * Tabel query uitvoeren
	 * @param string $query de database host
	 *
	 * @return array     
	 *
	 */		
	
	function dbQuery($query) {
		//echo $query . '<BR />';
		return mysql_query($query); // or die('<br />Mysql_error: ' . mysql_error());
	}
	
	/**
	 *
	 * Tabel query's aantal uitvoeren
	 * @param string $result de query waarvan de result wordt uitgerekend
	 *
	 * @return int     
	 *
	 */		
	
	function dbNumrows($result) {
		if ($result){
			return mysql_num_rows($result); //or die('Mysql_error' . mysql_error());
		} else {} // return nothing when there is no result!
	}
	
	/**
	 *
	 * array fetchen van de result
	 * @param string $result de result van de query
	 *
	 * @return array     
	 *
	 */		
	
	
	function dbFetchArray($result) {
		//print_r($result);
		if($result){
			return mysql_fetch_array($result); // or die('Mysql_error' . mysql_error());
		}
	}
	
	/**
	 *
	 * return array van de result, fieldnames are case sensitive
	 * @param string $result de result van de query
	 *
	 * @return array     
	 *
	 */		
	
	function dbFetchAssoc($result) {
		return mysql_fetch_assoc($result); //or die('Mysql_error' . mysql_error());
	}
	
	/**
	 *
	 * return array van de result, fieldnames are case sensitive
	 * @param string $result de result van de query
	 *
	 * @return array     
	 *
	 */		
	
	function dbFetchRow($result) {
		return mysql_fetch_row($result);// or die('Mysql_error' . mysql_error());
	}
	
	/**
	 *
	 * close de connectie van de database
	 *
	 * @return boolean     
	 *
	 */		
	
	function dbClose() {
		return mysql_close($connection);
	}
	

	# the almighty $db->get function
	
	/**
	 *
	 * return array van de result, fieldnames are case sensitive
	 * @param string $table de tabel naam
	 * @param string $col de column naam
	 * @param string $val de value
	 * @param string $switch 0 =  return een multi-dimensional array, 1 = single array
	 * @param string $extra extra string toevoegen aan de query
	 * @param string $equals het kan > = < ! zijn
	 *
	 * @return array     
	 *
	 */		
	
	function get($table, $col = '', $val = '', $switch = "0", $extra = '', $equals = "="){
		
		# "extra" val to make the function more versatile 
		if($extra == ''){
			# $col is not mandetory anymore ;-)
			if ($col){
				$query 		= "SELECT * FROM {$table} WHERE {$col} {$equals} '{$val}'";
			} else {
				$query		= "SELECT * FROM {$table}";
			}
		} else {
			$query 		= "SELECT * FROM {$table} WHERE {$col} {$equals} '{$val}' {$extra}";	
		} 
		
		$result		= mysql_query($query);
		//echo $query;
		if ($result) {
			
			# the value "switch" is not required
			switch ($switch) {
				
				# if switch = 0, you get a multi-dimensional array. Comes in handy, when the query has more than 1 result
				default	:
				case "0":
					while ($return = mysql_fetch_array($result)){ 
						# return[0] is most likely to be the primary key and therefor unique
						$array[$return[0]] = $return; 
					};					
					
					# return values
					return $array;
					//return $query;
				break;
				
				# if switch = 1, you get one result in an array. Comes in handy, when you only need one result
				case "1":
					$return = mysql_fetch_array($result);

					# return values
					return $return;
					//return $query;
				break;			
			}
		
		} else {
			return "";
			//return "Query: ".$query;			
		}	
		
	}	
	
	
	// the 'lesser god' $db->query function
	
	
	/**
	 *
	 * return voer de query uit
	 * @param string $query de query
	 * @param string $switch  0 = multi-dimensional array, 1 = single array
	 *
	 * @return array     
	 *
	 */		
	
	
	function query($query, $switch=0)
	{
		//echo $query . '<br />';
		//exit();
		$result		= mysql_query($query);
		$array		= "";
		if ($result) {
			
			# the value "switch" is not required
			switch ($switch) {
				
				# if switch = 0, you get a multi-dimensional array. Comes in handy, when the query has more than 1 result
				default	:
				case "0":
					while ($return = mysql_fetch_array($result)){ 
						# return[0] is most likely to be the primary key and therefor unique
						$array[$return[0]] = $return; 
					};					
					
					# return values
					return $array;
					//return $query;
				break;
				
				# if switch = 1, you get one result in an array. Comes in handy, when you only need one result
				case "1":
					$return = mysql_fetch_array($result);

					# return values
					return $return;
					//return $query;
				break;			
			}
		
		} else {
			//return "";
			return "Query: ".$query;			
		}	
		
	}
	
	# the mighty $db->set function ($db->get's distant nephew)
	
	/**
	 *
	 * set een nieuwe waarde bij een tabel
	 * @param string $tablename naam van de tabel
	 * @param string $values de column namen
	 * @param string $parameters de nieuwe waarden
	 *
	 * @return boolean
	 *
	 */		
	
	
	function set($tablename, $values, $parameters = ''){
		
		if ($parameters == ''){
			$query = "UPDATE {$tablename} SET {$values}";
			//echo $query.'<br/>';
		} else {
			$query = "UPDATE {$tablename} SET {$values} WHERE {$parameters}";	
			//echo $query.'<br/>';		
		}
		$result = mysql_query($query);
		//echo ($query);

		if ($result){
			return true;
		} else {
			if ($_SERVER['SERVER_NAME'] == "localhost"){
				return mysql_error();
				return false;
			} else {
				//echo $query;
				return false;
				//return setError("Er is iets mis gegaan bij het updaten van de database (error found in: database.php db->set)");
				//return setError($query);
			}
		}
	}
	
	# the mighty $db->insert function, $db->set's  twin sister :)
	
	/**
	 *
	 * nieuwe gegeven toevoegen aan een tabel
	 * @param string $tablename naam van de tabel
	 * @param string $values de column namen met de nieuwe gegevens
	 *
	 * @return boolean
	 *
	 */	
	
	function insert($tablename, $values){
		
		$query = "INSERT INTO {$tablename} SET {$values}";
		//echo $query . '<br /><br />##############################################################<br /><br />';
		//exit();
		$result = mysql_query($query);
		if ($result){
			return true;
		} else {
			if ($_SERVER['SERVER_NAME'] == "localhost"){
				return false;
				//return $query;
			} else {
				return false;
			}
		}
	}
	
	
	# the mighty $db->delete function, $db->insert's  twin sister :)
	
	/**
	 *
	 * gegevens van een tabel verwijderen
	 * @param string $tablename naam van de tabel
	 * @param string $values de column namen met de nieuwe gegevens
	 *
	 * @return boolean
	 *
	 */		
	
	function delete($tablename, $values){
		
		$query = "DELETE FROM {$tablename} WHERE {$values}";
		
		$result = mysql_query($query);
		if ($result){
			return true;
		} else {
			if ($_SERVER['SERVER_NAME'] == "localhost"){
				return false;
				//return $query;
			} else {
				return false;
			}
		}
	}	
	
	
	

	# the almighty $db->leftjoin function ($db->get's bigger brother)
	function leftjoin($table1, $table2, $col1, $col2, $col, $val, $switch = "0", $extra = '', $equals = "="){
		
		# "extra" val to make the function more versatile 
		if($extra == ''){
			$query 		= "SELECT * FROM {$table1} LEFT JOIN {$table2} ON ({$table1}.{$col1} = {$table2}.{$col2}) WHERE {$col} {$equals} '{$val}'";
		} else {
			$query 		= "SELECT * FROM {$table1} LEFT JOIN {$table2} ON ({$table1}.{$col1} = {$table2}.{$col2}) WHERE {$col} {$equals} '{$val}' {$extra}";	
		}
		$result		= mysql_query($query);
		//echo $query;
		if ($result) {
			
			# the value "switch" is not required
			switch ($switch) {
				
				# if switch = 0, you get a multi-dimensional array. Comes in handy, when the query has more than 1 result
				default	:
				case "0":
					while ($return = mysql_fetch_array($result)){ 
						# return[0] is most likely to be the primary key and therefor unique
						$array[$return[0]] = $return; 
					};					
					
					# return values
					return $array;
					//return $query;
				break;
				
				# if switch = 1, you get one result in an array. Comes in handy, when you only need one result
				case "1":
					$return = mysql_fetch_array($result);

					# return values
					return $return;
				break;			
			}
		
		} else {
			//return "";
			return "ELSE: ".$query;		
		}	
		
	}
	
	# $db->select() $db->get's cleaner brother;
	function select($cols = "*", $table, $where = '', $switch = 0){
		$array	=	"";
		if ($where == ''){
			$query = "SELECT ".$cols." FROM ".$table;
			//echo $query;
			//echo '<br />';
			//exit();
			
		} else {
			$query = "SELECT ".$cols." FROM ".$table." WHERE ".$where;
			//echo $query;
			//echo '<br />';
			//exit();
		}
   		//echo $query;
		$result		= mysql_query($query);

		if ($result) {
			
			# the value "switch" is not required
			switch ($switch) {
				
				# if switch = 0, you get a multi-dimensional array. Comes in handy, when the query has more than 1 result
				default	:
				case "0":
					while ($return = mysql_fetch_array($result)){ 
						# return[0] is most likely to be the primary key and therefor unique
						$array[$return[0]] = $return; 
					};					
					
					# return values
					//return $query;
					return $array;
				break;
				
				# if switch = 1, you get one result in an array. Comes in handy, when you only need one result
				case "1":
					$return = mysql_fetch_array($result);

					# return values
					return $return;
				break;			
			}
		
		} else {
			//return "no results";
			return $query;		
		}			
		
	}
	
	# $db->count(): counts
	function count($cols = "*", $table, $where = '', $extra = ''){
		
		if ($where == ''){
			$query = "SELECT COUNT(".$extra." ".$cols.") FROM ".$table;
		} else {
			$query = "SELECT COUNT(".$extra." ".$cols.") as ".$cols." FROM ".$table." WHERE ".$where;
		}
		
//		echo $query;
//		exit;

		$result		= mysql_query($query);
		
		if ($result) {
			
			return mysql_fetch_row($result);
			//return $result;
		
		} else {
			//return $query;
			return 0;		
		}			
		
	}	
	
	function lastID() {;
		return(mysql_insert_id());		
	}
	
	
	
	
	
	
	
	
	
	
	
	####BACK UP DATABASE
/* backup the db OR just a table */
function backup_tables($dbname,$tables = '*')
{
	$tablenaam	= ($tables	==	'*'		?	'-Allemaal-'		:	'-' . $tables . '-');
	//get all of the tables
	if($tables == '*')
	{
		$tables = array();
		$result = $this->dbQuery('SHOW TABLES');
		while($row = $this->dbFetchRow($result))
		{
			$tables[] = $row[0];
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	
	//cycle through
	foreach($tables as $table)
	{
		$result = mysql_query('SELECT * FROM '.$table);
		$num_fields = mysql_num_fields($result);
		
		  $return.='SET foreign_key_checks = 0;';
		  
		  $return.=	"\n\n\n";
		  $return.= 'DROP TABLE '.$table.';';
		  
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
					$row[$j] = ereg_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}
	
	$return.='SET foreign_key_checks = 1;';
	
	//save file
	$uploaddir 			= "DatabaseBackUp/";
	if(!file_exists($uploaddir))
	{
		mkdir($uploaddir,0777);	
		$handle = fopen('DatabaseBackUp\db-backup-'.$tablenaam.Date("d-m-Y H.i.s").'-'.(md5(implode(',',$tables))).'.sql','w+');
		if(fwrite($handle,$return))
		{
			setSuccess("De Database met de naam {$dbname} was backed-up");
			fclose($handle);	
			//echo("<meta http-equiv='refresh' content='1;url=admin.php?page=index'>");
		}
		else
		{
			setError("De Database was niet backed up. Probeer nog een keer");
		}
			
	}
	else
	{
		$handle = fopen('DatabaseBackUp\db-backup-'.$tablenaam.Date("d-m-Y H.i.s").'-'.(md5(implode(',',$tables))).'.sql','w+');
		if(fwrite($handle,$return))
		{
			setSuccess("De Database met de naam {$dbname} was backed-up");
			fclose($handle);
			//echo("<meta http-equiv='refresh' content='1;url=admin.php?page=index'>");	
		}
		else
		{
			setError("De Database was niet backed up. Probeer nog een keer");
		}		
	}
}		
	
	
	
}



?>