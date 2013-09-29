<?
Namespace MVC\Library;
Class Captcha {
	private $SecurityCode;
	private $width;
	private $height;
	
	function __construct($width = 150, $height = 30) {      
		$this->width = $width;
		$this->height = $height;
    }
	
	function createSecurityCode() 
	{
		$md5_hash = md5(rand(0,999)); 		
		$this->SecurityCode = substr($md5_hash, 15, 5);  
	}
	function getSecurityCode() 
	{
		return $this->SecurityCode;
	}
	
	function createImage($path) 
	{ 		
		//$_SESSION["spn_code_captcha"] = $security_code;
		//$width = 150; 
		//$height = 30;  

		//Create the image resource 
		$image = ImageCreate($this->width, $this->height);  

		//We are making three colors, white, black and gray 
		$white = ImageColorAllocate($image, 255, 255, 255); 
		$black = ImageColorAllocate($image, 0, 0, 0); 
		$grey = ImageColorAllocate($image, 204, 204, 204); 

		//Make the background black 
		ImageFill($image, 0, 0, $black); 	
		//Add randomly generated string in white to the image
		ImageString($image, $this->height/3, $this->width/3, 7, $this->SecurityCode, $white); 

		//Throw in some lines to make it a little bit harder for any bots to break 
		ImageRectangle($image,0,0, $this->width-1, $this->height-1,$grey); 
		imageline($image, 0,  $this->height/2,  $this->width,  $this->height/2, $grey); 
		imageline($image,  $this->width/2, 0,  $this->width/2,  $this->height,  $grey); 
	 
		//Tell the browser what kind of file is come in 
		//header("Content-Type: image/jpeg"); 
		
		//Output the newly created image in jpeg format 
		//ImageJpeg($image,"captcha.jpg"); 
		//imagejpeg($image, 'mvc\templates\theme\base\images\captcha.jpg');		
		//imagepng($image, $path.'\captcha.png'); 		
		imagepng($image, 'captcha.jpg'); 		
		//Free up resources
		ImageDestroy($image); 		
	} 
}
?>