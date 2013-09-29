<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Customer extends Object{

    private $Id;
	private $name;
	private $phone;
    private $type;
    private $card;
    private $note;
    private $address;
	private $discount;
	
	/*Hàm khởi tạo và thiết lập các thuộc tính*/
    function __construct( $Id=null, $name=null, $type=null, $card=null, $phone=null, $address=null, $note=null, $discount=null ) {
        $this->Id = $Id;
		$this->name = $name;
		$this->type = $type;
		$this->card = $card;
		$this->phone = $phone;
		$this->address = $address;
		$this->note = $note;
		$this->discount = $discount;
        parent::__construct( $Id );
    }
	
    function getId( ) {
        return $this->Id;
    }
	function getIdPrint( ) {
        return "C".$this->Id;
    }
	
	function getType(){
		return $this->type;
	}
	
    function setType( $type ) {
        $this->type = $type;
        $this->markDirty();
    }
	function getTypePrint(){
		if ($this->type==1)
			return "VIP";
		return "thường";
	}
	
	function getCard(){
		return $this->card;
	}
	
    function setCard( $card ) {
        $this->card = $card;
        $this->markDirty();
    }
	
	function getNote(){
		return $this->note;
	}
	
    function setNote( $note ) {
        $this->note = $note;
        $this->markDirty();
    }
	
	function getName(){
		return $this->name;
	}
	
    function setName( $name ) {
        $this->name = $name;
        $this->markDirty();
    }

	function getPhone(){
		return $this->phone;
	}
	
    function setPhone( $phone ) {
        $this->phone = $phone;
        $this->markDirty();
    }
			
    function setAddress( $address ) {
        $this->address = $address;
        $this->markDirty();
    }
	function getAddress(){
		return $this->address;
	}
		
	function setDiscount( $discount ) {
        $this->discount = $discount;
        $this->markDirty();
    }
	function getDiscount(){
		return $this->discount;
	}
	
	function getSessionAll(){
		$mSession = new	\MVC\Mapper\Session();
		$Sessions = $mSession->findByCustomer(array($this->Id));
		return $Sessions;
	}
	
	function getCollectAll(){
		$mCC = new \MVC\Mapper\CollectCustomer();
		$CollectAll = $mCC->findBy(array($this->getId()));
		return $CollectAll;
	}
	
	//=================================================================================
	function getURLCollect(){
		return "/collect/customer/".$this->getId();
	}
	
	function getURLCollectInsLoad(){
		return "/collect/customer/".$this->getId()."/ins/load";
	}
	function getURLCollectInsExe(){
		return "/collect/customer/".$this->getId()."/ins/exe";
	}
	
	function getURLUpdLoad(){
		return "/setting/customer/".$this->getId()."/upd/load";
	}
	function getURLUpdExe(){		
		return "/setting/customer/".$this->getId()."/upd/exe";
	}
	
	function getURLDelLoad(){		
		return "/setting/customer/"."/".$this->getId()."/del/load";
	}
	function getURLDelExe(){
		return "/setting/customer/"."/".$this->getId()."/del/exe";
	}
	function getURLBarcode(){
		return "/setting/customer/".$this->getId()."/barcode";
	}
	
	function getBarcode(){
		// -------------------------------------------------- //
		//                  PROPERTIES
		// -------------------------------------------------- //
			  
		$fontSize = 10;   // GD1 in px ; GD2 in point
		$marge    = 10;   // between barcode and hri in pixel
		$x        = 125;  // barcode center
		$y        = 125;  // barcode center
		$height   = 150;   // barcode height in 1D ; module size in 2D
		$width    = 3;    // barcode height in 1D ; not use in 2D
		$angle    = 0;   // rotation in degrees : nb : non horizontable barcode might not be usable because of pixelisation
		  
		$code     = $this->getCard(); // barcode, of course ;)
		$type     = 'ean13';
			  
		// -------------------------------------------------- //
		//            ALLOCATE GD RESSOURCE
		// -------------------------------------------------- //
		$im     = imagecreatetruecolor(300, 200);
		$black  = ImageColorAllocate($im,0x00,0x00,0x00);
		$white  = ImageColorAllocate($im,0xff,0xff,0xff);
		$red    = ImageColorAllocate($im,0xff,0x00,0x00);
		$blue   = ImageColorAllocate($im,0x00,0x00,0xff);
		imagefilledrectangle($im, 0, 0, 300, 200, $white);
		  
		// -------------------------------------------------- //
		//                      BARCODE
		// -------------------------------------------------- //
		$data = @\MVC\Library\Barcode::gd($im, $black, $x, $y, $angle, $type, array('code'=>$code), $width, $height);
		return $im;
	}
	
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}	
	
}

?>