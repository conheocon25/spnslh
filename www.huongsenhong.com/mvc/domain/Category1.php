<?php 
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Category1 extends Object{
	//-------------------------------------------------------------------------------
	//DEFINE PROPERTY
	//-------------------------------------------------------------------------------
	private $Id;
	private $IdCategory;
	private $IdGAttribute;
	private $Name;
	private $Info;
	private $Order;
	private $Key;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
	function __construct($Id=null, $IdCategory=null, $IdGAttribute=null, $Name=null, $Info=null, $Order=null, $Key=null){
		$this->Id 			= $Id;
		$this->IdCategory 	= $IdCategory;
		$this->IdGAttribute = $IdGAttribute;
		$this->Name 		= $Name;
		$this->Info 		= $Info;
		$this->Order 		= $Order;
		$this->Key 			= $Key;
		parent::__construct( $Id );
	}
		
	function getId() {return $this->Id;}

	function setIdCategory($IdCategory) {$this->IdCategory = $IdCategory;$this->markDirty();}
	function getIdCategory() 			{return $this->IdCategory;}
	function getCategory(){
		$mCategory = new \MVC\Mapper\Category();
		$Category = $mCategory->find($this->IdCategory);
		return $Category;
	}
	
	function setIdGAttribute($IdGAttribute) {$this->IdGAttribute = $IdGAttribute;$this->markDirty();}
	function getIdGAttribute() 			{return $this->IdGAttribute;}
	function getGAttribute(){
		$mGAttribute = new \MVC\Mapper\GAttribute();
		$GAttribute = $mGAttribute->find($this->IdGAttribute);
		return $GAttribute;
	}
	
	function setName($Name) {$this->Name = $Name;$this->markDirty();}
	function getName() 		{return $this->Name;}
	
	function setInfo($Info) {$this->Info = $Info;$this->markDirty();}
	function getInfo() 		{return $this->Info;}
	
	function setOrder($Order){$this->Order = $Order;$this->markDirty();}
	function getOrder() 	{return $this->Order;}
	
	function setKey($Key)	{$this->Key = $Key; $this->markDirty();}
	function getKey() 		{return $this->Key;}
	function reKey( ) {
		$Str = new \MVC\Library\String($this->Name);
		$this->Key = $Str->converturl();
	}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdCategory' 	=> $this->getIdCategory(),
			'IdGAttribute' 	=> $this->getIdGAttribute(),
			'Name'			=> $this->getName(),
			'Info'			=> $this->getInfo(),
			'Order'			=> $this->getOrder(),
			'Key'			=> $this->getKey()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->IdCategory 	= $Data[1];
		$this->IdGAttribute	= $Data[2];
		$this->Name 		= $Data[3];
		$this->Info 		= $Data[4];
		$this->Order		= $Data[5];
		$this->reKey();
    }
	
	//-------------------------------------------------------------------------------
	//GET LIST
	//-------------------------------------------------------------------------------		
	function getProductAll(){
		$mProduct = new \MVC\Mapper\Product();
		$ProductAll = $mProduct->findByCategory(array($this->getId()));	
		return $ProductAll;
	}
	
	function getProductManufacturerAll($IdManufacturer){
		$mProduct = new \MVC\Mapper\Product();
		$ProductAll = $mProduct->findByCategoryManufacturer(array($this->getId(), $IdManufacturer));	
		return $ProductAll;
	}
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLSettting(){return "admin/setting/category1/".$this->getId();}
		
	function getURLView(){
		return "/san-pham/".$this->getCategory()->getKey()."/".$this->getKey();
	}
	
	function getURLViewSave(){
		return "/khuyen-mai/".$this->getKey();
	}
	
	function getURLViewManufacturer($IdManufacturer){
		return "/san-pham/".$this->getCategory()->getKey()."/".$this->getKey()."/".$IdManufacturer."/m";
	}
	
	//-------------------------------------------------------------------------------
	static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
	static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	//-------------------------------------------------------------------------------
	
}
?>