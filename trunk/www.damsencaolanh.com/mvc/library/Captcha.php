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
	
	function createNewSecurityCode() 
	{
		$md5_hash = md5(rand(0,999)); 		
		$this->SecurityCode = substr($md5_hash, 15, 5);  
	}
	function getSecurityCode() 
	{		 
		return $this->SecurityCode;		
	}
	
	function createImage() 
	{ 		
		//$_SESSION["spn_code_captcha"] = $security_code;
		//$width = 150; 
		//$height = 30; 	
		$md5_hash = md5(rand(0,999));
		
		$this->SecurityCode = substr($md5_hash, 15, 5);
		//Create the image resource 
		//$image = ImageCreate($this->width, $this->height);  
		$image = imagecreatetruecolor(140, 30);
		//We are making three colors, white, black and gray 
		$white = ImageColorAllocate($image, 255, 255, 255); 
		$black = ImageColorAllocate($image, 0, 0, 0); 
		$red = ImageColorAllocate($image, 255, 0, 0); 
		$yellow = ImageColorAllocate($image, 250, 248, 204); 
		$grey = ImageColorAllocate($image, 204, 204, 204); 
		
		
		
		//Make the background black 
		//ImageFill($image, 0, 0, 709, 150, $white); 	
		imagefilledrectangle($image, 0,0, 709, 99, $yellow);
		//Add randomly generated string in white to the image
		ImageString($image, 5 ,5, 5, $this->SecurityCode, $red); 
		//imagestring ($im, $font, $x, $y, $string, $textColor);
		//Throw in some lines to make it a little bit harder for any bots to break 
		ImageRectangle($image,0,0, $this->width-1, $this->height-1, $yellow); 
		//imageline($image, 0,  $this->height/2,  $this->width,  $this->height/2, $grey); 
		//imageline($image,  $this->width/2, 0,  $this->width/2,  $this->height,  $grey); 
	  
		//ImageJpeg($image,"captcha.jpg"); 		
		//imagepng($image, $path.'/captcha.png'); 		
		imagepng($image, 'data/captcha.jpg'); 		
		//Free up resources
		ImageDestroy($image); 		
	} 
}
?>