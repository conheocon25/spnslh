<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class OrderImport extends Object{

    private $Id;
	private $IdSupplier;
	private $Date;
	private $Discount;
    private $Description;
			
	/*Hàm khởi tạo và thiết lập các thuộc tính*/
    function __construct( $Id=null, $IdSupplier=null, $Date=null, $Discount=null, $Description=null) {
        $this->Id 			= $Id;
		$this->IdSupplier 	= $IdSupplier;
		$this->Date 		= $Date;
		$this->Discount 	= $Discount;
		$this->Description 	= $Description;
        parent::__construct( $Id );
    }
    function getId( ) {return $this->Id;}
    
	function setIdSupplier( $IdSupplier ) {$this->IdSupplier = $IdSupplier;$this->markDirty();}
    function getIdSupplier( ) {return $this->IdSupplier;}
	function getSupplier( ) {	
		$mSupplier = new \MVC\Mapper\Supplier();
		$Supplier = $mSupplier->find($this->IdSupplier);		
        return $Supplier;
    }
	
	function getDate( ) {return $this->Date;}
    function setDate( $Date ) {$this->Date = $Date;$this->markDirty();}
	function getDatePrint( ) {$Date = new \MVC\Library\Date($this->Date); return $Date->getDateFormat();}
	
	function getDiscount( ) {return $this->Discount;}
	function setDiscount( $Discount ) {$this->Discount = $Discount;$this->markDirty();}
	function getDiscountPrint( ) {return $this->Discount."%";}
	
	function getDescription( ) {return $this->Description;}
	function setDescription( $Description ) {$this->Description = $Description;$this->markDirty();}
	
	function getDetailAll(){		
		$mOID = new \MVC\Mapper\OrderImportDetail();
		$Tracks = $mOID->trackBy(array(
			$this->getId(),
			$this->getIdSupplier(),
			$this->getId()
		));
		
		return $Tracks;
	}
	
	function getValueBase(){
		$DetailAll = $this->getDetailAll();
		$Count = 0;
		while ($DetailAll->valid()){
			$Count += $DetailAll->current()->getValue();
			$DetailAll->next();
		}
		return $Count;
	}
	function getValueBasePrint(){
		$Value = new \MVC\Library\Number($this->getValueBase());
		return $Value->formatCurrency()." đ";
	}
	
	
	function getValue(){
		$DetailAll = $this->getDetailAll();
		$Count = 0;
		while ($DetailAll->valid()){
			$Count += $DetailAll->current()->getValue();
			$DetailAll->next();
		}
		return ($Count*(100-$this->Discount))/100;
	}
	
	function getValuePrint(){
		$Value = new \MVC\Library\Number($this->getValue());
		return $Value->formatCurrency()." đ";
	}
	
	function getValueStrPrint(){
		$Value = new \MVC\Library\Number($this->getValue());
		return $Value->readDigit()." đồng";
	}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdSupplier' 	=> $this->getIdSupplier(),
			'Date'			=> $this->getDate(),
			'Discount'		=> $this->getDiscount(),
			'Description'	=> $this->getDescription()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];	
		$this->IdSupplier 	= $Data[1];	
		$this->Date 		= $Data[2];
		$this->Discount		= $Data[3];
		$this->Description 	= $Data[4];
    }
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLPrint(){return "/import/".$this->getIdSupplier()."/".$this->getId()."/print";}	
	function getURLDetail(){return "/import/".$this->getIdSupplier()."/".$this->getId();}
	
	//---------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	
}
?>