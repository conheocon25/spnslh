<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class ProductMap extends Object{

    private $Id;
	private $IdProduct;
	private $Latitude;
	private $Longitude;
			
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id			=null, 
		$IdProduct	=null,	
		$Latitude	=null,
		$Longitude	=null)
	{        		
		$this->Id				= $Id;
		$this->IdProduct		= $IdProduct;		
		$this->Latitude			= $Latitude;
		$this->Longitude		= $Longitude;		
				
        parent::__construct( $Id );
    }
    function getId( ) {return $this->Id;}
			
	function getIdProduct( ) {return $this->IdProduct;}
    function setIdProduct( $IdProduct ) {$this->IdProduct = $IdProduct;$this->markDirty();}
	function getProduct(){
		$mProduct 	= new \MVC\Mapper\Product();
		$Product 	= $mProduct->find( $this->getIdProduct() );
		return $Product;
	}
			
	function setLatitude( $Latitude ) 	{$this->Latitude = $Latitude; $this->markDirty();}
    function getLatitude( ){
		if ($this->Latitude=="")
			return "/data/images/product2.jpg";
		return $this->Latitude;
	}
	
    function setLongitude( $Longitude ) {$this->Longitude = $Longitude;$this->markDirty();}
    function getLongitude( ) {return $this->Longitude;}
		
	function toJSON(){
		$json = array(
			'Id' 				=> $this->getId(),	
			'IdProduct'			=> $this->getIdProduct(),				
			'Latitude'			=> $this->getLatitude(),
			'Longitude'			=> $this->getLongitude()			
		);		
		return json_encode($json);
	}
	
	function setArray( $Data ){        	
		$this->Id				= $Data[0];
		$this->IdProduct		= $Data[1];
		$this->Latitude			= $Data[2];
		$this->Longitude		= $Data[3];
    }
	
	function getURLSettingExe(){return "/admin/setting/supplier/".$this->getProduct()->getIdSupplier()."/".$this->getIdProduct()."/map/exe";}
	
	//-------------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
}

?>