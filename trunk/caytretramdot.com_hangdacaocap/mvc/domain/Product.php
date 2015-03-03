<?php
namespace MVC\Domain;
use MVC\Library\Number;
require_once( "mvc/base/domain/DomainObject.php" );

class Product extends Object{

    private $Id;
	private $IdSupplier;
	private $IdCategory;
	private $IdManufacturer;	
	private $Name;
	private $Code;
    private $Price1;
	private $Price2;
	private $Key;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id=null, 
		$IdSupplier=null, 
		$IdCategory=null,
		$IdManufacturer=null,
		$Name=null, 
		$Code=null, 
		$Price1=null, 
		$Price2=null, 		
		$Key=null
	)
	{
        		
		$this->Id				= $Id;
		$this->IdSupplier		= $IdSupplier;
		$this->IdCategory		= $IdCategory;	
		$this->IdManufacturer	= $IdManufacturer;	
		$this->Name				= $Name;
		$this->Code				= $Code;
		$this->Price1			= $Price1;
		$this->Price2			= $Price2;		
		$this->Key				= $Key;
		
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
	
	function getIdCategory( ) {return $this->IdCategory;}
    function setIdCategory( $IdCategory ) {$this->IdCategory = $IdCategory;$this->markDirty();}
	function getCategory(){
		$mCategory = new \MVC\Mapper\Category1();
		$Category = $mCategory->find( $this->IdCategory );
		return $Category;
	}
	
	function getIdManufacturer( ) {return $this->IdManufacturer;}
    function setIdManufacturer( $IdManufacturer ) {$this->IdManufacturer = $IdManufacturer; $this->markDirty();}
	function getManufacturer(){
		$mManufacturer = new \MVC\Mapper\Manufacturer();
		$Manufacturer = $mManufacturer->find( $this->IdManufacturer );
		return $Manufacturer;
	}
	
	function getTopSameManufacturer(){
		$mProduct 	= new \MVC\Mapper\Product();
		$ProductAll = $mProduct->findByManufacturerTop( array($this->IdManufacturer) );
		return $ProductAll;
	}
	
    function setName( $Name ) {$this->Name = $Name;$this->markDirty();}
    function getName( ) {return $this->Name;}
	
	function setCode( $Code ) {$this->Code = $Code;$this->markDirty();}
    function getCode( ) {return $this->Code;}
	
	function setPrice1( $Price1 ) {$this->Price1 = $Price1; $this->markDirty();}
    function getPrice1( ) {return $this->Price1;}
	function getPrice1Print( ) {$num = new Number($this->Price1);return $num->formatCurrency();}
		
	function setPrice2( $Price2 ) {$this->Price2 = $Price2; $this->markDirty();}
    function getPrice2( ) {return $this->Price2;}
	function getPrice2Print( ) {$num = new Number($this->Price2);return $num->formatCurrency();}
			
	function getKey( ) 		{return $this->Key;}
	function setKey( $Key ) {$this->Key = $Key; $this->markDirty(); }
	function reKey( ) {
		$Id = time();
		$Str = new \MVC\Library\String($this->Name." ".$Id);
		$this->Key = $Str->converturl();
	}
		
	function toJSON(){
		$json = array(
			'Id' 				=> $this->getId(),	
			'IdSupplier'		=> $this->getIdSupplier(),
			'IdCategory'		=> $this->getIdCategory(),
			'IdManufacturer'	=> $this->getIdManufacturer(),
			'Name'				=> $this->getName(),			
			'Code'				=> $this->getCode(),
			'Price1'			=> $this->getPrice1(),
			'Price2'			=> $this->getPrice2(),			
			'Key'				=> $this->getKey()
		);		
		return json_encode($json);
	}
	
	function setArray( $Data ){
        	
		$this->Id				= $Data[0];
		$this->IdSupplier		= $Data[1];
		$this->IdCategory		= $Data[2];
		$this->IdManufacturer	= $Data[3];
		$this->Name				= $Data[4];
		$this->Code				= $Data[5];
		$this->Price1			= $Data[6];
		$this->Price2			= $Data[7];
		$this->reKey();
    }
	
	function getAttributeAll(){
		$mProductAttribute = new \MVC\Mapper\ProductAttribute();
		$AttributeAll = $mProductAttribute->findBy(array($this->getId()));
		return $AttributeAll;
	}
	
	function getImageAll(){
		$mProductImage = new \MVC\Mapper\ProductImage();
		$ImageAll = $mProductImage->findBy(array($this->getId()));
		return $ImageAll;
	}
	
	function getInfo(){
		$mProductInfo 	= new \MVC\Mapper\ProductInfo();
		$IdInfo 		= $mProductInfo->exist(array($this->getId()));
		if ($IdInfo>0){
			$Info = $mProductInfo->find($IdInfo);
		}else{
			$Info = null;
		}
		return $Info;
	}
	
	function getSamePriceAll(){
		$mProduct = new \MVC\Mapper\Product();
		$ProductAll = $mProduct->findBySamePrice(array($this->getId(), $this->getPrice2() ));
		return $ProductAll;
	}
	
	function getURLView(){
		return "/thuc-don/".$this->getCategory()->getCategory()->getKey()."/".$this->getCategory()->getKey()."/".$this->getKey();
	}
	
	function getURLViewFull(){
		return "http://huongsenhong.com/san-pham/".$this->getCategory()->getCategory()->getKey()."/".$this->getCategory()->getKey()."/".$this->getKey();
	}
	
	function getURLSettingImage(){
		return "/admin/setting/supplier/".$this->getIdSupplier()."/".$this->getId()."/image";
	}
	function getURLSettingInfo(){
		return "/admin/setting/supplier/".$this->getIdSupplier()."/".$this->getId()."/info";
	}
	function getURLSettingInfoExe(){
		return "/admin/setting/supplier/".$this->getIdSupplier()."/".$this->getId()."/info/exe";
	}	
	function getURLSettingAttribute(){
		return "/admin/setting/supplier/".$this->getIdSupplier()."/".$this->getId()."/attribute";
	}
	function getURLSettingAttributeExe(){
		return "/admin/setting/supplier/".$this->getIdSupplier()."/".$this->getId()."/attribute/exe";
	}
	
	//-------------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
}

?>