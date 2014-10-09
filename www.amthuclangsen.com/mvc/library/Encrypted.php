<?php
Namespace MVC\Library;
	class Encrypted
	{
		// Thuộc tính				
		private $DNS;		
		private $DBUser;
		private $DBName;
		private $DBPass;
		private $key;
		private $fullpath;
		
		private $ProjectName;		
		//---------------------------------------		
		//Nhóm hàm khởi tạo
		//---------------------------------------
		
		function __construct($ProjectName = "SPN", $DBName = null, $DBUser = null, $DBPass = null )
		{
			$this->key = "1234.spncompanynumberone56987.";
			$this->fullpath = "data/";
			$this->DNS= "mysql:host=localhost;dbname=";
			$this->DBUser=$DBUser;
			$this->DBName= $DBName;
			$this->DBPass= $DBPass;
			$this->ProjectName= $ProjectName;
			//$this->Str_Connection= "mysql:host=localhost;dbname=" . " ". $DBName . " ". $DBUser . " ". $DBPass;
		}
		//---------------------------------------		
		//Nhóm hàm xử lí cho dữ liệu thường
		//---------------------------------------
		function setData($value)
		{
			return $this->Encrypted($value);
		}
		
		function getData($value)
		{
			return $this->Decrypted($value);
		}
		
		 function Encrypted($value)
		{
			$encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($this->key), $value, MCRYPT_MODE_CBC, md5(md5($this->key))));
			return $encrypted;
		}
		
		private function Decrypted($value)
		{
			$decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($this->key), base64_decode($value), MCRYPT_MODE_CBC, md5(md5($this->key))), "\0");
			return $decrypted;
		}
		
		function getDNS()
		{
			return $this->Decrypted($this->DNS);
		}
		
		function getDBName()
		{
			return $this->Decrypted($this->DBName);
		}
		
		function getDBUser()
		{
			return $this->Decrypted($this->DBUser);
		}
		
		function getDBPass()
		{
			return $this->Decrypted($this->DBPass);
		}
		
		function DecryptedC2Script($s,$key){
			$key = base64_decode(urldecode($key));
			$s = urldecode($s);
			$key = str_split(str_pad('', strlen($s), $key));
			$sa = str_split($s);
			foreach($sa as $i=>$v){
			   $t = ord($v)-ord($key[$i]);
			   $sa[$i] = chr( $t < 0 ?($t+256):$t);
			}
			return urldecode(join('', $sa));
		}
		
			
		//---------------------------------------		
		//Nhóm hàm xử lí
		//---------------------------------------
		function encryptData($value)
		{		   
		   $text = $value; 
		   $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB); 
		   $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND); 
		   $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->key, $text, MCRYPT_MODE_ECB, $iv); 
		   return $crypttext; 
		} 
		
		function decryptData($value)
		{	   
		   $crypttext = $value; 
		   $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB); 
		   $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND); 
		   $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->key, $crypttext, MCRYPT_MODE_ECB, $iv); 
		   return trim($decrypttext); 
		} 
		
		function writeStrConnection()
		{	
			$file = fopen($this->fullpath . $this->ProjectName . ".spn", "w");
			fwrite($file, $this->encryptData("mysql:host=localhost;dbname=" . " ". $this->DBName . " ". $this->DBUser . " ". $this->DBPass), 1024);				
			fclose($file);		
		}
		
		function readStrConnection()
		{
			$result = "";
			$file = fopen($this->fullpath . $this->ProjectName . ".spn", "r");			
			$result = fread( $file , 1024 );						
			fclose($file); 
			return $this->decryptData($result);
		}
		
		function writeDNS()
		{	
			$file = fopen($this->fullpath . "DNS","w");
			fwrite($file, $this->encryptData($this->DNS) ,512);				
			fclose($file); 			
		}
		
		function readDNS()
		{
			$result = "";
			$file = fopen($this->fullpath . "DNS","r");			
			$result = fread( $file ,512);						
			fclose($file); 
			return $this->decryptData($result);
		}
		
		function writeDBUser()
		{	
			$file = fopen($this->fullpath . "DBUser","w");
			fwrite($file, $this->encryptData($this->DBUser) ,512);				
			fclose($file); 			
		}
		
		function readDBUser()
		{
			$result = "";
			$file = fopen($this->fullpath . "DBUser","r");			
			$result = fread( $file ,512);						
			fclose($file); 
			return $this->decryptData($result);
		}
		
		function writeDBName()
		{	
			$file = fopen($this->fullpath . "DBName","w");
			fwrite($file, $this->encryptData($this->DBName) ,512);				
			fclose($file); 			
		}
		
		function readDBName()
		{
			$result = "";
			$file = fopen($this->fullpath . "DBName","r");			
			$result = fread( $file ,512);						
			fclose($file); 
			return $this->decryptData($result);
		}
		
		function writeDBPass()
		{	
			$file = fopen($this->fullpath . "DBPass","w");
			fwrite($file, $this->encryptData($this->DBPass) ,512);				
			fclose($file); 			
		}
		
		function readDBPass()
		{
			$result = "";
			$file = fopen($this->fullpath . "DBPass","r");			
			$result = fread( $file ,512);						
			fclose($file); 
			return $this->decryptData($result);
		}
		/////////////////////////////////////////////////////
		// Ghi dữ liệu mã hóa và giãi mã với đường dẫn và data
		/////////////////////////////////////////////////////
		
		function writeValue($filename, $value)
		{	
			$file = fopen($this->fullpath . $filename,"w");
			fwrite($file, $this->encryptData($value) ,512);				
			fclose($file); 			
		}
		function readValue($filename, $value)
		{
			$result = "";
			$file = fopen($this->fullpath . $filename,"r");			
			$result = fread( $file ,512);						
			fclose($file); 
			return $this->decryptData($result);
		}
	}
?>
