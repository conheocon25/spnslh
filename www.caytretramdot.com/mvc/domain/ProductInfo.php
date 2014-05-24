<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class ProductInfo extends Object{

    private $Id;
	private $IdProduct;
	private $Image1;
	private $Image2;
	private $Info;	
		
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id=null, 
		$IdProduct=null,
		$Image1=null,
		$Image2=null,
		$Info=null
	)
	{        		
		$this->Id				= $Id;
		$this->IdProduct		= $IdProduct;
		$this->Image1			= $Image1;
		$this->Image2			= $Image2;
		$this->Info				= $Info;
				
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
	
	function setImage1( $Image1 ) 	{$this->Image1 = $Image1;$this->markDirty();}
    function getImage1( ) 			{
		if ($this->Image1=="")
			return "/data/images/product1.jpg";
		return $this->Image1;
	}
	
	function setImage2( $Image2 ) 	{$this->Image2 = $Image2; $this->markDirty();}
    function getImage2( ) 			{
		if ($this->Image2=="")
			return "/data/images/product2.jpg";
		return $this->Image2;
	}
	
    function setInfo( $Info ) {$this->Info = $Info;$this->markDirty();}
    function getInfo( ) {return $this->Info;}
				
	function toJSON(){
		$json = array(
			'Id' 				=> $this->getId(),	
			'IdProduct'			=> $this->getIdProduct(),			
			'Image1'			=> $this->getImage1(),
			'Image2'			=> $this->getImage2(),
			'Info'				=> $this->getInfo()			
		);		
		return json_encode($json);
	}
	
	function setArray( $Data ){
        	
		$this->Id				= $Data[0];
		$this->IdProduct		= $Data[1];		
		$this->Image1			= $Data[2];
		$this->Image2			= $Data[3];
		$this->Info				= $Data[4];
    }
	
	function getURLSettingExe(){
		return "/admin/setting/supplier/".$this->getProduct()->getIdSupplier()."/".$this->getIdProduct()."/info/exe";
	}
	
	//-------------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
}

?>