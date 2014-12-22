<?php 
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Category1 extends Object{
	//-------------------------------------------------------------------------------
	//DEFINE PROPERTY
	//-------------------------------------------------------------------------------
	private $Id;
	private $IdCategory;
	private $IdPresentation;
	private $Name;	
	private $Order;
	private $Key;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
	function __construct($Id=null, $IdCategory=null, $IdPresentation=null, $Name=null, $Order=null, $Key=null){
		$this->Id 				= $Id;
		$this->IdCategory 		= $IdCategory;		
		$this->IdPresentation 	= $IdPresentation;
		$this->Name 			= $Name;		
		$this->Order 			= $Order;
		$this->Key 				= $Key;
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
	
	function setIdPresentation($IdPresentation) {$this->IdPresentation = $IdPresentation;$this->markDirty();}
	function getIdPresentation() 			{return $this->IdPresentation;}
	function getPresentation(){
		$mPresentation = new \MVC\Mapper\Presentation();
		$Presentation = $mPresentation->find($this->IdPresentation);
		return $Presentation;
	}
	
	function setName($Name) {$this->Name = $Name;$this->markDirty();}
	function getName() 		{return $this->Name;}
			
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
			'IdPresentation'=> $this->getIdPresentation(),
			'Name'			=> $this->getName(),			
			'Order'			=> $this->getOrder(),
			'Key'			=> $this->getKey()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 				= $Data[0];
		$this->IdCategory 		= $Data[1];
		$this->IdPresentation 	= $Data[2];
		$this->Name 			= $Data[3];		
		$this->Order			= $Data[4];
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
			
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLSettting(){return "admin/setting/category1/".$this->getId();}
		
	function getURLView(){
		return "/thuc-don/".$this->getCategory()->getKey()."/".$this->getKey();
	}
					
	//-------------------------------------------------------------------------------
	static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
	static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	//-------------------------------------------------------------------------------
	
}
?>