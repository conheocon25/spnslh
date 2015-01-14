<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Chess extends Object{
	private $BOARD_WIDTH	= 32;
	private $BOARD_HEIGHT	= 32;
	
	private $PIECE_WIDTH	= 32;
	private	$PIECE_HEIGHT	= 32;
	
    private $Canvas;	
	
	private $ImagePieceAll;		
	private $PositionMap;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------	
    function __construct($Width = null, $Height = null, $StrState = null){
		$this->BOARD_WIDTH 	= $Width;
		$this->BOARD_HEIGHT = ($this->BOARD_WIDTH/9)*10;
		$this->PIECE_WIDTH	= $this->BOARD_WIDTH/9;
		$this->PIECE_HEIGHT	= $this->BOARD_WIDTH/9;
		
        $this->Canvas 		= imagecreatetruecolor($this->BOARD_WIDTH, $this->BOARD_HEIGHT);
		
		$this->ImagePieceAll= array(	"RR"=>imagecreatefromgif("data/chess/rrook.gif"),
										"RH"=>imagecreatefromgif("data/chess/rhorse.gif"),
										"RE"=>imagecreatefromgif("data/chess/relephant.gif"),
										"RA"=>imagecreatefromgif("data/chess/rassansin.gif"),
										"RK"=>imagecreatefromgif("data/chess/rking.gif"),
										"RC"=>imagecreatefromgif("data/chess/rcannon.gif"),
										"RP"=>imagecreatefromgif("data/chess/rpawn.gif"),
										"BR"=>imagecreatefromgif("data/chess/brook.gif"),
										"BH"=>imagecreatefromgif("data/chess/bhorse.gif"),
										"BE"=>imagecreatefromgif("data/chess/belephant.gif"),
										"BA"=>imagecreatefromgif("data/chess/bassansin.gif"),
										"BK"=>imagecreatefromgif("data/chess/bking.gif"),
										"BC"=>imagecreatefromgif("data/chess/bcannon.gif"),
										"BP"=>imagecreatefromgif("data/chess/bpawn.gif")
		);
		
		//Phân tích trạng thái hiện tại bàn cờ		
		if ($StrState !=null){			
			$ArrState = explode(" ", $StrState);			
			
			if (count($ArrState)==90){				
				for ($i = 0; $i<10; $i++){
					$D = array();
					for ($j = 0; $j<9; $j++){
						$D[]= $ArrState[$i*9+$j];
					}					
					$this->PositionMap[]= $D;					
				}
			}			
			else{
				$this->PositionMap = array(
					array("BR", "BH", "BE", "BA", "BK", "BA", "BE", "BH", "BR"),
					array("0", "0", "0", "0", "0", "0", "0", "0", "0"),
					array("0", "BC", "0", "0", "0", "0", "0", "BC", "0"),
					array("BP", "0", "BP", "0", "BP", "0", "BP", "0", "BP"),
					array("0", "0", "0", "0", "0", "0", "0", "0", "0"),
					array("0", "0", "0", "0", "0", "0", "0", "0", "0"),
					array("RP", "0", "RP", "0", "RP", "0", "RP", "0", "RP"),
					array("0", "RC", "0", "0", "0", "0", "0", "RC", "0"),
					array("0", "0", "0", "0", "0", "0", "0", "0", "0"),
					array("RR", "RH", "RE", "RA", "RK", "RA", "RE", "RH", "RR")
				);
			}			
		}else{
			$this->PositionMap = array(
					array("BR", "BH", "BE", "BA", "BK", "BA", "BE", "BH", "BR"),
					array("0", "0", "0", "0", "0", "0", "0", "0", "0"),
					array("0", "BC", "0", "0", "0", "0", "0", "BC", "0"),
					array("BP", "0", "BP", "0", "BP", "0", "BP", "0", "BP"),
					array("0", "0", "0", "0", "0", "0", "0", "0", "0"),
					array("0", "0", "0", "0", "0", "0", "0", "0", "0"),
					array("RP", "0", "RP", "0", "RP", "0", "RP", "0", "RP"),
					array("0", "RC", "0", "0", "0", "0", "0", "RC", "0"),
					array("0", "0", "0", "0", "0", "0", "0", "0", "0"),
					array("RR", "RH", "RE", "RA", "RK", "RA", "RE", "RH", "RR")
			);
		}
    }
    
	function draw(){		
		
		$BGC = imagecolorallocate ($this->Canvas, 255, 255, 255);
		
		//Vẽ 72 ô bàn cờ
		$XStart = $this->PIECE_WIDTH/2;
		$YStart = $this->PIECE_HEIGHT/2;
		
		for ($i = 0; $i<8; $i++){			
			for ($j = 0; $j<9; $j++){
				imagerectangle(
					$this->Canvas, 
					$XStart + $i*$this->PIECE_WIDTH, 
					$YStart + $j*$this->PIECE_HEIGHT, 
					$XStart + ($i+1)*$this->PIECE_WIDTH, 
					$YStart + ($j+1)*$this->PIECE_HEIGHT, 
					$BGC);
			}
		}
		
		//Vẽ 2 cung Tướng
		imageline( $this->Canvas, $XStart + 3*$this->PIECE_WIDTH, $YStart + 0*$this->PIECE_HEIGHT, $XStart + 5*$this->PIECE_WIDTH, $YStart + 2*$this->PIECE_HEIGHT, $BGC);
		imageline( $this->Canvas, $XStart + 3*$this->PIECE_WIDTH, $YStart + 2*$this->PIECE_HEIGHT, $XStart + 5*$this->PIECE_WIDTH, $YStart + 0*$this->PIECE_HEIGHT, $BGC);
		
		imageline( $this->Canvas, $XStart + 3*$this->PIECE_WIDTH, $YStart + 7*$this->PIECE_HEIGHT, $XStart + 5*$this->PIECE_WIDTH, $YStart + 9*$this->PIECE_HEIGHT, $BGC);
		imageline( $this->Canvas, $XStart + 3*$this->PIECE_WIDTH, $YStart + 9*$this->PIECE_HEIGHT, $XStart + 5*$this->PIECE_WIDTH, $YStart + 7*$this->PIECE_HEIGHT, $BGC);
		
		//Vẽ hà
		imageline( $this->Canvas, $XStart + 0*$this->PIECE_WIDTH, $YStart + 4*$this->PIECE_HEIGHT, $XStart + 1*$this->PIECE_WIDTH, $YStart + 5*$this->PIECE_HEIGHT, $BGC);
		imageline( $this->Canvas, $XStart + 0*$this->PIECE_WIDTH, $YStart + 5*$this->PIECE_HEIGHT, $XStart + 1*$this->PIECE_WIDTH, $YStart + 4*$this->PIECE_HEIGHT, $BGC);
		
		imageline( $this->Canvas, $XStart + 1*$this->PIECE_WIDTH, $YStart + 4*$this->PIECE_HEIGHT, $XStart + 2*$this->PIECE_WIDTH, $YStart + 5*$this->PIECE_HEIGHT, $BGC);
		imageline( $this->Canvas, $XStart + 1*$this->PIECE_WIDTH, $YStart + 5*$this->PIECE_HEIGHT, $XStart + 2*$this->PIECE_WIDTH, $YStart + 4*$this->PIECE_HEIGHT, $BGC);
		
		imageline( $this->Canvas, $XStart + 2*$this->PIECE_WIDTH, $YStart + 4*$this->PIECE_HEIGHT, $XStart + 3*$this->PIECE_WIDTH, $YStart + 5*$this->PIECE_HEIGHT, $BGC);
		imageline( $this->Canvas, $XStart + 2*$this->PIECE_WIDTH, $YStart + 5*$this->PIECE_HEIGHT, $XStart + 3*$this->PIECE_WIDTH, $YStart + 4*$this->PIECE_HEIGHT, $BGC);
		
		imageline( $this->Canvas, $XStart + 3*$this->PIECE_WIDTH, $YStart + 4*$this->PIECE_HEIGHT, $XStart + 4*$this->PIECE_WIDTH, $YStart + 5*$this->PIECE_HEIGHT, $BGC);
		imageline( $this->Canvas, $XStart + 3*$this->PIECE_WIDTH, $YStart + 5*$this->PIECE_HEIGHT, $XStart + 4*$this->PIECE_WIDTH, $YStart + 4*$this->PIECE_HEIGHT, $BGC);
		
		imageline( $this->Canvas, $XStart + 4*$this->PIECE_WIDTH, $YStart + 4*$this->PIECE_HEIGHT, $XStart + 5*$this->PIECE_WIDTH, $YStart + 5*$this->PIECE_HEIGHT, $BGC);
		imageline( $this->Canvas, $XStart + 4*$this->PIECE_WIDTH, $YStart + 5*$this->PIECE_HEIGHT, $XStart + 5*$this->PIECE_WIDTH, $YStart + 4*$this->PIECE_HEIGHT, $BGC);
		
		imageline( $this->Canvas, $XStart + 5*$this->PIECE_WIDTH, $YStart + 4*$this->PIECE_HEIGHT, $XStart + 6*$this->PIECE_WIDTH, $YStart + 5*$this->PIECE_HEIGHT, $BGC);
		imageline( $this->Canvas, $XStart + 5*$this->PIECE_WIDTH, $YStart + 5*$this->PIECE_HEIGHT, $XStart + 6*$this->PIECE_WIDTH, $YStart + 4*$this->PIECE_HEIGHT, $BGC);
		
		imageline( $this->Canvas, $XStart + 6*$this->PIECE_WIDTH, $YStart + 4*$this->PIECE_HEIGHT, $XStart + 7*$this->PIECE_WIDTH, $YStart + 5*$this->PIECE_HEIGHT, $BGC);
		imageline( $this->Canvas, $XStart + 6*$this->PIECE_WIDTH, $YStart + 5*$this->PIECE_HEIGHT, $XStart + 7*$this->PIECE_WIDTH, $YStart + 4*$this->PIECE_HEIGHT, $BGC);
		
		imageline( $this->Canvas, $XStart + 7*$this->PIECE_WIDTH, $YStart + 4*$this->PIECE_HEIGHT, $XStart + 8*$this->PIECE_WIDTH, $YStart + 5*$this->PIECE_HEIGHT, $BGC);
		imageline( $this->Canvas, $XStart + 7*$this->PIECE_WIDTH, $YStart + 5*$this->PIECE_HEIGHT, $XStart + 8*$this->PIECE_WIDTH, $YStart + 4*$this->PIECE_HEIGHT, $BGC);
		
		//Nạp hình các quân cờ
		for ($i=0; $i<10; $i++){
			for ($j=0;$j<9; $j++){
				$Name = $this->PositionMap[$i][$j];
				if ($Name != "0"){
					imagecopy(
						$this->Canvas, 
						$this->ImagePieceAll[$Name],
						$j*$this->PIECE_WIDTH,
						$i*$this->PIECE_HEIGHT, 
						0, 0, $this->PIECE_WIDTH, $this->PIECE_HEIGHT);
				}
			}
		}
		//Vẽ tiêu đề
		
		
		//Xuất ảnh ra
		header('Content-Type: image/jpeg');
		imagejpeg($this->Canvas);
		imagedestroy($this->Canvas);
	}
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	
	//-------------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
}
?>