<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class ProductImage extends Object{

    private $Id;	
	private $IdProduct;	
	private $Name;	
	private $Date;
	private $URL;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id=null, 
		$IdProduct=null, 		
		$Name=null, 
		$Date=null, 		
		$URL=null)
	{        	
		$this->Id			= $Id;		
		$this->IdProduct	= $IdProduct;	
		$this->Name			= $Name;		
		$this->Date			= $Date;		
		$this->URL			= $URL;
	
        parent::__construct( $Id );
    }
    function getId( ) {return $this->Id;}
		
	function getIdProduct( ) {return $this->IdProduct;}
    function setIdProduct( $IdProduct ) {$this->IdProduct = $IdProduct;$this->markDirty();}
	function getProduct(){
		$mProduct = new \MVC\Mapper\Product();
		$Product = $mProduct->find( $this->IdProduct);
		return $Product;
	}
	
    function setName( $Name ) {$this->Name = $Name;$this->markDirty();}
    function getName( ) {return $this->Name;}
	
	function setDate( $Date ) {$this->Date = $Date; $this->markDirty();}
    function getDate( ) {return $this->Date;}
		
	function getURL( ) {return $this->URL;}
	function setURL( $URL ) {$this->URL = $URL; $this->markDirty(); }
		
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),	
			'IdProduct'	=> $this->getIdProduct(),			
			'Name'			=> $this->getName(),			
			'Date'			=> $this->getDate(),			
			'URL'			=> $this->getURL()
		);		
		return json_encode($json);
	}
	
	function setArray( $Data ){        	
		$this->Id			= $Data[0];
		$this->IdProduct	= $Data[1];		
		$this->Name			= $Data[2];
		$this->Date			= \date("Y-m-d");
		$this->URL			= $Data[4];
    }
		
	//-------------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
}

?>