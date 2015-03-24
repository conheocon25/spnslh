<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class InvoiceImportDetail extends Object{

    private $Id;
	private $IdInvoice;
	private $IdGood;	
	private $Count;
	private $Price;
			
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id=null, 
		$IdInvoice=null, 
		$IdGood=null,		
		$Count=null,
		$Price=null
	){
        $this->Id 			= $Id;
		$this->IdInvoice 	= $IdInvoice;
		$this->IdGood 		= $IdGood;		
		$this->Count 		= $Count;
		$this->Price 		= $Price;
								
        parent::__construct( $Id );
    }
	
	function setArray( $Data ){
        $this->Id 				= $Data[0];
		$this->IdInvoice 		= $Data[1];
		$this->IdGood 			= $Data[2];		
		$this->Count 			= $Data[3];
		$this->Price 			= $Data[4];
    }
	
    function getId( ) {return $this->Id;}

	function setIdInvoice( $IdInvoice ) {$this->IdInvoice = $IdInvoice; $this->markDirty();}
	function getIdInvoice(){return $this->IdInvoice;}
	function getInvoice(){
		$mInvoice 	= new \MVC\Mapper\InvoiceSell();
		$Invoice 	= $mInvoice->find($this->IdInvoice);
		return $Invoice;
	}
	
	function setIdGood( $IdGood ) {$this->IdGood = $IdGood; $this->markDirty();}
	function getIdGood(){return $this->IdGood;}
	function getGood(){
		$mGood 	= new \MVC\Mapper\Good();
		$Good 	= $mGood->find($this->IdGood);
		return $Good;
	}
			
	function setCount( $Count ) {$this->Count = $Count;$this->markDirty();}
	function getCount(){return $this->Count;}
	function getCountPrint( ){
		$num = number_format($this->getCount(), 0, ',', ' ');
		return $num;
	}
	
	function setPrice( $Price ){$this->Price = $Price; $this->markDirty();}
	function getPrice(){return $this->Price;}	
	function getPricePrint( ){
		$num = number_format($this->getPrice(), 0, ',', ' ');
		return $num;
	}
	
	function getValue(){return $this->Count*$this->Price;}
	function getValuePrint( ){
		$num = number_format($this->getValue(), 0, ',', ' ');
		return $num;
	}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdInvoice'		=> $this->getIdInvoice(),
			'IdGood'		=> $this->getIdGood(),			
			'Count'			=> $this->getCount(),
			'Price'			=> $this->getPrice()
		);
		return json_encode($json);
	}
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
					
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $id );}
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------				
	
}
?>