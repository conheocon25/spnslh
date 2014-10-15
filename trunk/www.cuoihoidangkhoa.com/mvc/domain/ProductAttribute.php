<?php
namespace MVC\Domain;
use MVC\Library\Number;
require_once( "mvc/base/domain/DomainObject.php" );

class ProductAttribute extends Object{

    private $Id;
	private $IdProduct;
	private $IdAttribute;	
	private $Value;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id=null, 
		$IdProduct=null, 
		$IdAttribute=null,		
		$Value=null
	)
	{        		
		$this->Id				= $Id;
		$this->IdProduct		= $IdProduct;
		$this->IdAttribute		= $IdAttribute;					
		$this->Value			= $Value;
		
        parent::__construct( $Id );
    }
    function getId( ) {return $this->Id;}
			
	function getIdProduct( ) {return $this->IdProduct;}
    function setIdProduct( $supplier ) {$this->IdProduct = $supplier;$this->markDirty();}
	function getProduct(){
		$mProduct 	= new \MVC\Mapper\Product();
		$Product 	= $mProduct->find( $this->getIdProduct() );
		return $Product;
	}
	
	function getIdAttribute( ) {return $this->IdAttribute;}
    function setIdAttribute( $IdAttribute ) {$this->IdAttribute = $IdAttribute;$this->markDirty();}
	function getAttribute(){
		$mAttribute = new \MVC\Mapper\Attribute();
		$Attribute = $mAttribute->find( $this->IdAttribute );
		return $Attribute;
	}
		    			
	function getValue( ) 		{return $this->Value;}
	function setValue( $Value ) {$this->Value = $Value; $this->markDirty(); }
			
	function toJSON(){
		$json = array(
			'Id' 				=> $this->getId(),	
			'IdProduct'			=> $this->getIdProduct(),
			'IdAttribute'		=> $this->getIdAttribute(),
			'Value'				=> $this->getValue()
		);		
		return json_encode($json);
	}
	
	function setArray( $Data ){        	
		$this->Id				= $Data[0];
		$this->IdProduct		= $Data[1];
		$this->IdAttribute		= $Data[2];
		$this->Value			= $Data[3];
    }
			
	//-------------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); 		return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); 	return $finder->find( $Id );}
}
?>