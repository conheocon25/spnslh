<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class CategoryNews extends Object{

    private $Id;
	private $Name;
	private $Order;
	private $Key;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $Name=null , $Order=Null, $Key=Null) {$this->Id = $Id;$this->Name = $Name;$this->Order = $Order;$this->Key = $Key;parent::__construct( $Id );}
    function getId() {return $this->Id;}
		
    function setName( $Name ) {$this->Name = $Name;$this->markDirty();}   
	function getName( ) {return $this->Name;}
	
	function setOrder( $Order ) {$this->Order = $Order;$this->markDirty();}   
	function getOrder( ) {return $this->Order;}
	
	function setKey( $Key ) {$this->Key = $Key;$this->markDirty();}   
	function getKey( ) {return $this->Key;}
	function reKey( ) {
		$Str = new \MVC\Library\String($this->Name);
		$this->Key = $Str->converturl();
	}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),			
			'Name'			=> $this->getName(),
			'Order'			=> $this->getOrder(),
			'Key'			=> $this->getKey()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id = $Data[0];
		$this->Name = $Data[1];		
		$this->Order = $Data[2];
		$this->reKey();
    }
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	function getNewsAll(){
		$mNews = new \MVC\Mapper\News();
		$NewsAll = $mNews->findBy(array($this->getId()));
		return $NewsAll;
	}
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	
	function getURLSettingNews(){return "/setting/category-n/".$this->getId()."/news";}
	
	function getURLNewsAutoLoad(){		return "/app/category/news/".$this->getId()."/auto/load";}
	function getURLNewsAutoExe(){		return "/app/category/news/".$this->getId()."/auto/exe";}
	
	function getURLUpdLoad(){			return "/app/category/news/".$this->getId()."/upd/load";}
	function getURLUpdExe(){			return "/app/category/news/".$this->getId()."/upd/exe";}
	
	function getURLProfile(){			return "/app/category/news/".$this->getId()."/profile";}
	function getURLProfileInsLoad(){	return "/app/category/news/".$this->getId()."/profile/ins/load";}
	function getURLProfileInsExe(){		return "/app/category/news/".$this->getId()."/profile/ins/exe";}
	
	function getURLDelLoad(){return "/app/category/news/".$this->getId()."/del/load";}
	function getURLDelExe(){return "/app/category/news/".$this->getId()."/del/exe";}
	
	function getURLNewsInsLoad(){return "/setting/category-n/".$this->getId()."/news/ins-load";}
	function getURLNewsInsExe(){return "/setting/category-n/".$this->getId()."/news/ins-exe";}
	
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
}
?>