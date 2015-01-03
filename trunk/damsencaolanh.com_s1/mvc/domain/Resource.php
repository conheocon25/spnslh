<?php
namespace MVC\Domain;
use MVC\Library\Number;
require_once( "mvc/base/domain/DomainObject.php" );

class Resource extends Object{

    private $Id;
	private $IdSupplier;
	private $Name;
    private $Price;
    private $Unit;
	private $Description;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $IdSupplier=null, $Name=null, $Unit=null, $Price=null, $Description=null) {
        $this->Id = $Id;
		$this->IdSupplier = $IdSupplier;
		$this->Name = $Name;
		$this->Price = $Price;
		$this->Unit = $Unit;
		$this->Description = $Description;
        parent::__construct( $Id );
    }
    function getId( ) {return $this->Id;}
			
	function getIdSupplier( ) {return $this->IdSupplier;}
    function setIdSupplier( $supplier ) {$this->IdSupplier = $supplier;$this->markDirty();}
	function getSupplier(){
		$mSupplier = new \MVC\Mapper\Supplier();
		$Supplier = $mSupplier->find( $this->getIdSupplier() );
		return $Supplier;
	}
	
    function setName( $Name ) {$this->Name = $Name;$this->markDirty();}
    function getName( ) {return $this->Name;}
	
	function setPrice( $Price ) {$this->Price = $Price;$this->markDirty();}
    function getPrice( ) {return $this->Price;}
	function getPricePrint( ) {$num = new Number($this->Price);return $num->formatCurrency()." đ";}
	function getPriceAverage(){
		$mOID = new \MVC\Mapper\OrderImportDetail();		
		return $mOID->evalPrice(array($this->getId()));
	}
	
	function setUnit( $Unit ) {$this->Unit = $Unit;$this->markDirty();}
    function getUnit( ) {return $this->Unit;}
		
	function getDescription( ) {return $this->Description;}
	function setDescription( $Description ) {$this->Description = $Description;$this->markDirty(); }
		
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),	
			'IdSupplier'	=> $this->getIdSupplier(),
			'Name'			=> $this->getName(),			
			'Price'			=> $this->getPrice(),
			'Unit'			=> $this->getUnit(),
			'Description'	=> $this->getDescription()
		);		
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->IdSupplier 	= $Data[1];
		$this->Name 		= $Data[2];
		$this->Price 		= $Data[3];
		$this->Unit 		= $Data[4];
		$this->Description 	= $Data[5];
    }
				
	//-------------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
}

?>