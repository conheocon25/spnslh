<?php    
/*
 * PHP QR Code encoder
 *
 * Exemplatory usage
 *
 * PHP QR Code is distributed under LGPL 3
 * Copyright (C) 2010 Dominik Dzienia <deltalab at poczta dot fm>
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 3 of the License, or any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 */
    
    //echo "<h1>PHP QR Code</h1><hr/>";
Namespace MVC\Library;
include "qrlib.php";
class Qrcode { 

	private $PNG_tmp_DIR;
	private $PNG_WEB_DIR;
	private $filename;
	private $errorCorrectionLevel;
	private $matrixPointSize;
	private $level;
	private $size;
	private $data;
	
	function __construct($level, $size, $data, $matrixPointSize) {      
		$this->level = $level;
		$this->size = $size;
		$this->data = $data;
		$this->matrixPointSize = $matrixPointSize;
		$this->errorCorrectionLevel = 'L';		
		$this->PNG_tmp_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'tmp'.DIRECTORY_SEPARATOR;
		$this->PNG_WEB_DIR = 'tmp/';
		$this->filename = $this->PNG_tmp_DIR.'qrcode.png';
    }
   
    function creatQRCodeImage() {   
    //ofcourse we need rights to create tmp dir
		if (!file_exists($this->PNG_tmp_DIR))
			mkdir($this->PNG_tmp_DIR); 
			
		if (isset($this->level) && in_array($this->level, array('L','M','Q','H')))
			$this->errorCorrectionLevel = $this->level;    

		$this->matrixPointSize = 4;
		if (isset($this->size))
			$this->matrixPointSize = min(max((int)$this->size, 1), 10);


		if (isset($this->data)) { 		
			//it's very important!
			if (trim($this->data) == '')
				die('data cannot be empty! <a href="?">back</a>');
				
			// user data
			$this->filename = $this->PNG_tmp_DIR.'qrcode'.md5($this->data.'|'.$this->errorCorrectionLevel.'|'.$this->matrixPointSize).'.png';
			QRcode::png($this->data, $this->filename, $this->errorCorrectionLevel, $this->matrixPointSize, 2);    
			
		}
		else {    
		
			//default data
			//echo 'You can provide data in GET parameter: <a href="?data=like_that">like that</a><hr/>';    
			QRcode::png('PHP QR Code :)', $this->filename, $this->errorCorrectionLevel, $this->matrixPointSize, 2);    
			
		}    
        
		//display generated file
			//echo '<img src="'.$PNG_WEB_DIR.basename($this->filename).'" /><hr/>';     
			
		// benchmark
		QRtools::timeBenchmark();   
	}	
}
    