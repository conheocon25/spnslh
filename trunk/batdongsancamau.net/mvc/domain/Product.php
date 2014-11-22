<?php
namespace MVC\Domain;
use MVC\Library\Number;
require_once( "mvc/base/domain/DomainObject.php" );

class Product extends Object{

    private $Id;
	private $IdSupplier;
	private $IdCategory;	
	private $IdEstate;	
	private $IdDistrict;	
	private $Name;
	private $DateTime;	
    private $Price;
	private $Address;
	private $Key;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id			= null, 
		$IdSupplier	= null, 
		$IdCategory = null,		
		$IdEstate   = null,
		$IdDistrict = null,
		$Name		= null, 
		$DateTime	= null, 		
		$Price		= null, 		
		$Address	= null,
		$Key		= null)
	{
        		
		$this->Id				= $Id;
		$this->IdSupplier		= $IdSupplier;
		$this->IdCategory		= $IdCategory;
		$this->IdEstate			= $IdEstate;
		$this->IdDistrict		= $IdDistrict;
		$this->Name				= $Name;
		$this->DateTime			= $DateTime;		
		$this->Price			= $Price;
		$this->Address			= $Address;
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
	
	function getIdEstate( ) {return $this->IdEstate;}
    function setIdEstate( $IdEstate ) {$this->IdEstate = $IdEstate;$this->markDirty();}
	function getEstate(){
		$mEstate = new \MVC\Mapper\TypeEstate();
		$Estate = $mEstate->find( $this->IdEstate );
		return $Estate;
	}
	
	function getIdDistrict( ) {return $this->IdDistrict;}
    function setIdDistrict( $IdDistrict ) {$this->IdDistrict = $IdDistrict;$this->markDirty();}
	function getDistrict(){
		$mDistrict 	= new \MVC\Mapper\District();
		$District 	= $mDistrict->find( $this->IdDistrict );
		return $District;
	}
	
    function setName( $Name ) {$this->Name = $Name;$this->markDirty();}
    function getName( ) {return $this->Name;}
	
	function setDateTime( $DateTime ) 	{$this->DateTime = $DateTime; $this->markDirty();}
    function getDateTime( ) 			{return $this->DateTime;}	
	function getDateTimePrint( )		{return date('d/m H:i',strtotime($this->DateTime));}
			
	function setPrice( $Price ) {$this->Price = $Price; $this->markDirty();}
    function getPrice( ) {return $this->Price;}
	function getPricePrint( ) {		
		$num = $this->Price/1000000;
		if ($num == 0)
			return "thỏa thuận";
		else if ($num<1000)
			return $num." triệu";
		return ($num/1000)." tỉ";
	}
	
	function setAddress( $Address ) {$this->Address = $Address; $this->markDirty();}
    function getAddress( ) {return $this->Address;}
			
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
			'IdEstate'			=> $this->getIdEstate(),
			'IdDistrict'		=> $this->getIdDistrict(),
			'Name'				=> $this->getName(),			
			'DateTime'			=> $this->getDateTime(),
			'Price'				=> $this->getPrice(),
			'Address'			=> $this->getAddress(),
			'Key'				=> $this->getKey()
		);		
		return json_encode($json);
	}
	
	function setArray( $Data ){
        	
		$this->Id				= $Data[0];
		$this->IdSupplier		= $Data[1];
		$this->IdCategory		= $Data[2];		
		$this->IdEstate			= $Data[3];		
		$this->IdDistrict		= $Data[4];
		$this->Name				= $Data[5];
		$this->DateTime			= $Data[6];		
		$this->Price			= $Data[7];
		$this->Address			= $Data[8];
		$this->reKey();
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
	
	function getMap(){
		$mProductMap 	= new \MVC\Mapper\ProductMap();
		$IdMap 			= $mProductMap->exist(array($this->getId()));
		if ($IdMap>0){
			$Map = $mProductMap->find($IdMap);
		}else{
			$Map = null;
		}
		return $Map;
	}
	
	function getSamePriceAll(){
		$mProduct = new \MVC\Mapper\Product();
		$ProductAll = $mProduct->findBySamePrice(array($this->getId(), $this->getPrice2() ));
		return $ProductAll;
	}
	
	function getURLView()	 {return "/danh-muc/".$this->getCategory()->getCategory()->getKey()."/".$this->getCategory()->getKey()."/".$this->getKey();}	
	function getURLViewFull(){return "http://batdongsancamau.net/danh-muc/".$this->getCategory()->getCategory()->getKey()."/".$this->getCategory()->getKey()."/".$this->getKey();}
	
	function getURLSetting()		{return "/admin/setting/supplier/".$this->getIdSupplier()."/".$this->getId();}
	function getURLSettingInfo()	{return "/admin/setting/supplier/".$this->getIdSupplier()."/".$this->getId()."/info";}
	function getURLSettingInfoExe()	{return "/admin/setting/supplier/".$this->getIdSupplier()."/".$this->getId()."/info/exe";}
	function getURLSettingImage()	{return "/admin/setting/supplier/".$this->getIdSupplier()."/".$this->getId()."/image";}
	function getURLSettingMap()		{return "/admin/setting/supplier/".$this->getIdSupplier()."/".$this->getId()."/map";}
		
	//-------------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
}

?>