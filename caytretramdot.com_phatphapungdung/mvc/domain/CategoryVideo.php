<?php 
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class CategoryVideo extends Object{
	//-------------------------------------------------------------------------------
	//DEFINE PROPERTY
	//-------------------------------------------------------------------------------
	private $Id;
	private $IdCategory;
	private $Name;	
	private $Image;	
	private $Order;
	private $Key;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
	function __construct($Id=null, $IdCategory=null, $Name=null, $Image=null, $Order=null, $Key=null){
		$this->Id 			= $Id;
		$this->IdCategory 	= $IdCategory;
		$this->Name 		= $Name;
		$this->Image 		= $Image;
		$this->Order 		= $Order;		
		$this->Key 			= $Key;
		parent::__construct( $Id );
	}
		
	function getId() {return $this->Id;}
	
	function setIdCategory($IdCategory) {$this->IdCategory = $IdCategory;$this->markDirty();}
	function getIdCategory() 			{return $this->IdCategory;}
	function getCategory(){
		$mCategoryBuddha 	= new \MVC\Mapper\CategoryBuddha();
		$Category 			= $mCategoryBuddha->find($this->IdCategory);
		return $Category;
	}
		
	function setName($Name) {$this->Name = $Name;$this->markDirty();}
	function getName() 		{return $this->Name;}
	
	function setImage($Image) {$this->Image = $Image;$this->markDirty();}
	function getImage(){
		if ($this->Image=="")
			return "/data/image/bg/movies_folder.png";
		return $this->Image;
	}
	
	function setOrder($Order){$this->Order = $Order;$this->markDirty();}
	function getOrder() 	{return $this->Order;}
					
	function setKey($Key)	{$this->Key = $Key;$this->markDirty();}
	function getKey() 		{return $this->Key;}
	function reKey( ) {
		$Str = new \MVC\Library\String($this->Name);
		$this->Key = $Str->converturl();
	}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdCategory' 	=> $this->getIdCategory(),
			'Name'			=> $this->getName(),
			'Image'			=> $this->getImage(),
			'Order'			=> $this->getOrder(),		
			'Key'			=> $this->getKey()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->IdCategory 	= $Data[1];
		$this->Name 		= $Data[2];
		$this->Image 		= $Data[3];
		$this->Order		= $Data[4];
		$this->reKey();
    }
	
	//-------------------------------------------------------------------------------
	//GET LIST
	//-------------------------------------------------------------------------------
	function getVideoAll(){
		$mVideo		= new \MVC\Mapper\Video();
		$VideoAll 	= $mVideo->findBy(array($this->getId()));
		return $VideoAll;
	}
		
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLView()	{return "/video/".$this->getCategory()->getKey()."/".$this->getKey();}	
	function getURLSetting(){return "/admin/video/".$this->getId();}
	function getURLSettingVideoInsLoad(){return "/admin/video/".$this->getId()."/ins/load"	;}
	function getURLSettingVideoInsExe()	{return "/admin/video/".$this->getId()."/ins/exe"	;}
		
	//-------------------------------------------------------------------------------
	static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
	static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	//-------------------------------------------------------------------------------
	
}
?>