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
		//---------------------------------------		
		//Nhóm hàm khởi tạo
		//---------------------------------------
		
		function __construct()
		{				
			
			$this->key = "123appspncompanynumberone";
			$this->fullpath = "data/key.dat";
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
		
		private function Encrypted($value)
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
		function SizeFileConfig()
		{			
			$systemcontent[] = $this->encryptData($this->DNS);
			$systemcontent[] = $this->encryptData($this->DBName);
			$systemcontent[] = $this->encryptData($this->DBUser);
			$systemcontent[] = $this->encryptData($this->DBPass);
			for($i=0; $i < sizeof($systemcontent); $i++)
			{
				$systemsize[] = strlen($systemcontent[$i]);
			}
			return $systemsize;
		}
		function writeToFile()
		{			
			$systemcontent[] = $this->encryptData($this->DNS);
			$systemcontent[] = $this->encryptData($this->DBName);
			$systemcontent[] = $this->encryptData($this->DBUser);
			$systemcontent[] = $this->encryptData($this->DBPass);
			for($i=0; $i < sizeof($systemcontent); $i++)
			{
				$systemsize[] = strlen($systemcontent[$i]);
			}
			$file = fopen($this->fullpath,"w");
			for($i=0; $i < sizeof($systemsize); $i++)
			{
				fwrite($file,$systemcontent[$i],$systemsize[$i]);
			}			
			fclose($file); 
			return $systemsize;
		}
		function readFromFile($systemsize)
		{
			$result = "";
			$file = fopen($this->fullpath,"r");
			for($i=0; $i < sizeof($systemsize); $i++)
			{
				$result[] = fread( $file ,$systemsize[$i]);
			}				
			fclose($file); 
			return $result;
		}
	}
?>
