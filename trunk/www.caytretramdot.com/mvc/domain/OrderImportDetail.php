<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class OrderImportDetail extends Object{
    private $Id;
	private $IdOrder;
	private $IdProduct;
	private $Count;
    private $Price;
		
	/*Hàm khởi tạo và thiết lập các thuộc tính*/
    function __construct( $Id=null, $IdOrder=null, $IdProduct=null, $Count=null, $Price=null) {
        $this->Id = $Id;
		$this->IdOrder = $IdOrder;
		$this->IdProduct = $IdProduct;
		$this->Count = $Count;
		$this->Price = $Price;
        parent::__construct( $Id );
    }
    function getId( ) {return $this->Id;}	

    function setIdOrder( $IdOrder ) {$this->IdOrder = $IdOrder;$this->markDirty();}
    function getIdOrder( ) {return $this->IdOrder;}
	function getOrder( ){		
		$mOrder = new \MVC\Mapper\OrderImport();
		$Order = $mOrder->find($this->getIdOrder());		
        return $Order;
    }
		
	function setIdProduct( $IdProduct ) {$this->IdProduct = $IdProduct;$this->markDirty();}
    function getIdProduct( ) {return $this->IdProduct;}
	function getProduct( ){		
		$mProduct = new \MVC\Mapper\Product();
		$Product = $mProduct->find($this->getIdProduct());
        return $Product;
    }
		
	function getCount( ) {return $this->Count;}
    function setCount( $Count ) {$this->Count = $Count;$this->markDirty();}
	function getCountPrint( ) {
		if (!isset($this->Count)){
			return 0;
		}
        return $this->Count;
    }

	function getPrice( ) {return $this->Price;}
	function setPrice( $Price ) {$this->Price = $Price;$this->markDirty();}
	function getPricePrint( ) {$N = new \MVC\Library\Number($this->Price);return $N->formatCurrency();}

	function getValue( ) {return $this->Count*$this->Price;}
	function getValuePrint( ) {$N = new \MVC\Library\Number($this->getValue());return $N->formatCurrency()." đ";}

	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdOrder' 		=> $this->getIdOrder(),
			'IdProduct'	=> $this->getIdProduct(),
			'Count'			=> $this->getCount(),
			'Price'			=> $this->getPrice()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){        
		$this->Id 			= $Data[0];
		$this->IdOrder 		= $Data[1];	
		$this->IdProduct 	= $Data[2];	
		$this->Count 		= $Data[3];	
		$this->Price 		= $Data[4];	
    }	
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------	
	function getURLUpdLoad(){
		$Order = $this->getOrder();		
		return "/import/".$Order->getSupplier()->getId()."/".$this->getIdOrder()."/".$this->getIdProduct()."/upd/load";
	}
	function getURLUpdExe(){
		return "/import/".$Order->getSupplier()->getId()."/".$this->getIdOrder()."/".$this->getIdProduct()."/upd/exe";
	}
	
	//---------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	
}

?>
