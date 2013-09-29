<?php
Namespace MVC\Library;
class DBStatus {
	
	private $DBHost;//Dia chi Database Server
	private $DBName;//Tên DB 
	private $DBUsername;//User truy cap DB
	private $DBPassword;//Pass truy cap db
	private $DBConnection;//db connection
	private $ListTableName;
	function __construct( $DBHost, $DBName, $DBUsername, $DBPassword) {        		
		$this->DBHost = $DBHost;        
		$this->DBName = $DBName; 
		$this->DBUsername = $DBUsername; 
		$this->DBPassword = $DBPassword; 
		$this->ListTableName = null;
		$this->DBConnection = null;
    }
	function connect()
	{
		if($this->DBConnection == null)
		{
			$this->DBConnection = mysql_connect($this->DBHost, $this->DBUsername, $this->DBPassword );
			mysql_set_charset('utf8',$this->DBConnection); 
			mysql_select_db($this->DBName,$this->DBConnection);
		}		
	}
	function getNameTables($HeadTable) {
		//get all of the tables
		if($this->ListTableName == null)
		{
			if($HeadTable != null) {
				$lenght = strlen($HeadTable);
				$this->ListTableName = array();
				$result = mysql_query('SHOW TABLES');
				while($row = mysql_fetch_row($result)) {
					$temp = substr($row[0], 0, $lenght);
					if ($temp == $HeadTable) {				
						$this->ListTableName[] = $row[0];
					}			
				}
				return $this->ListTableName;
			}
			else 
			{
				//$ListTableName = is_array($ListTableName) ? $ListTableName : explode(',',$ListTableName);
				return null;
			}
		}
		else
		{
			return $this->ListTableName;
		}
	}
	function getScriptBackup() {
		//cycle through
		if ($this->ListTableName != null)
		{
			foreach($this->ListTableName as $TableName) {
				//echo $TableName;
				$result = mysql_query('SELECT * FROM '.$TableName);
				
				$num_fields = mysql_num_fields($result);		
				$sqlscirptDB .= 'DROP TABLE IF EXISTS '.$TableName.';';
				$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$TableName));
				$sqlscirptDB .= "\n\n".$row2[1].";\n\n";
					 
				for ($i=0; $i<$num_fields; $i++) {
					while($row = mysql_fetch_row($result)) {
						$sqlscirptDB.= 'INSERT INTO '.$TableName.' VALUES (';
						for($j=0; $j<$num_fields; $j++) {
							$row[$j] = addslashes($row[$j]);

							//$row[$j] = ereg_replace("\n","\\n",$row[$j]);
							if (isset($row[$j])) {
								$sqlscirptDB .= '"'.$row[$j].'"' ;
							}
							else {
								$sqlscirptDB .= '""';
							}
							if ($j<($num_fields-1)) { 
								$sqlscirptDB .= ','; 
							}
						}
						$sqlscirptDB .= ");\n";
					}
				}
				$sqlscirptDB .= "\n\n\n";			
			}		
			return $sqlscirptDB;
		}
		else
		{
			return null;
		}
	}
	function runScriptRestore($SQLScriptFile) 
	{			
		$SQLScript = explode(";", $SQLScriptFile);
		$count = count($SQLScript);
		if ($count > 0)
		{
			for ($i=0; $i < $count ; $i++)
			{
				mysql_query($SQLScript[$i]);
			}
			return true;
		}
		else
		{
			return false;
		}
	}
	
}
?>