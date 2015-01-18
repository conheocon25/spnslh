<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Chess extends Object{
	private $BOARD_WIDTH	= 32;
	private $BOARD_HEIGHT	= 32;
	
	private $PIECE_WIDTH	= 64;
	private	$PIECE_HEIGHT	= 64;
	
    private $Canvas;	
	
	private $ImagePieceAll;		
	private $PositionMap;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------	
    function __construct($Width = null, $StrState = null){
		
		
		$this->BOARD_WIDTH 	= $Width;
		$this->BOARD_HEIGHT = ($this->BOARD_WIDTH/9)*10;
		$this->PIECE_WIDTH	= $this->BOARD_WIDTH/9;
		$this->PIECE_HEIGHT	= $this->BOARD_WIDTH/9;
						
        $this->Canvas 		= imagecreatetruecolor($this->BOARD_WIDTH, $this->BOARD_HEIGHT);
		
		/*
		$this->ImagePieceAll= array(	"RR"=>imagecreatefrompng("data/chess/RRook.png"),
										"RH"=>imagecreatefrompng("data/chess/RHorse.png"),
										"RE"=>imagecreatefrompng("data/chess/RElephant.png"),
										"RA"=>imagecreatefrompng("data/chess/RAssansin.png"),
										"RK"=>imagecreatefrompng("data/chess/RKing.png"),
										"RC"=>imagecreatefrompng("data/chess/RCannon.png"),
										"RP"=>imagecreatefrompng("data/chess/RPawn.png"),
										"BR"=>imagecreatefrompng("data/chess/GRook.png"),
										"BH"=>imagecreatefrompng("data/chess/GHorse.png"),
										"BE"=>imagecreatefrompng("data/chess/GElephant.png"),
										"BA"=>imagecreatefrompng("data/chess/GAssansin.png"),
										"BK"=>imagecreatefrompng("data/chess/GKing.png"),
										"BC"=>imagecreatefrompng("data/chess/GCannon.png"),
										"BP"=>imagecreatefrompng("data/chess/GPawn.png")
		);
		*/
		
		$this->ImagePieceAll= array(	"RR"=>imagecreatefromgif("data/chess/RRook.gif"),
										"RH"=>imagecreatefromgif("data/chess/RHorse.gif"),
										"RE"=>imagecreatefromgif("data/chess/RElephant.gif"),
										"RA"=>imagecreatefromgif("data/chess/RAssansin.gif"),
										"RK"=>imagecreatefromgif("data/chess/RKing.gif"),
										"RC"=>imagecreatefromgif("data/chess/RCannon.gif"),
										"RP"=>imagecreatefromgif("data/chess/RPawn.gif"),
										"BR"=>imagecreatefromgif("data/chess/GRook.gif"),
										"BH"=>imagecreatefromgif("data/chess/GHorse.gif"),
										"BE"=>imagecreatefromgif("data/chess/GElephant.gif"),
										"BA"=>imagecreatefromgif("data/chess/GAssansin.gif"),
										"BK"=>imagecreatefromgif("data/chess/GKing.gif"),
										"BC"=>imagecreatefromgif("data/chess/GCannon.gif"),
										"BP"=>imagecreatefromgif("data/chess/GPawn.gif")
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
					
					$NewImage = imagecreatetruecolor($this->PIECE_WIDTH, $this->PIECE_HEIGHT);
					imagecopyresized($NewImage, $this->ImagePieceAll[$Name], 0, 0, 0, 0, $this->PIECE_WIDTH, $this->PIECE_HEIGHT, 64, 64);
					
					imagecopy(
						$this->Canvas, 
						$NewImage,
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