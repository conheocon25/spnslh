<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class CategoryMarket extends Object{

    private $Id;
	private $Name;	
	private $Key;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $Name=null, $Key=null) {
        $this->Id = $Id;		
		$this->Name = $Name;
		$this->Key = $Key;
        parent::__construct( $Id );
    }
    function getId() {return $this->Id;}		
		
    function setName( $Name ) {$this->Name = $Name;$this->markDirty();}   
	function getName( ) {return $this->Name;}
	
	function setKey( $Key ) {$this->Key = $Key;$this->markDirty();}
	function getKey( ) {return $this->Key;}
	function reKey( ) {
		$Str = new \MVC\Library\String($this->Name);
		$this->Key = $Str->converturl();
	}
		
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	function getNews(){
		$mNews = new \MVC\Mapper\NewsMarket();
		$News = $mNews->findByCategory(array($this->getId()));
		return $News;
	}
	function getNewsTop4(){
		$mNews = new \MVC\Mapper\NewsMarket();
		$News = $mNews->findByCategoryTop4(array($this->getId()));
		return $News;
	}
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLRead(){return "/market/".$this->getId();}
	function getURLView(){return "/setting/category/market/".$this->getId();}
	function getURLUpdLoad(){return "/setting/category/market/".$this->getId()."/upd/load";}
	function getURLUpdExe(){return "/setting/category/market/".$this->getId()."/upd/exe";}
	
	function getURLDelLoad(){return "/setting/category/market/".$this->getId()."/del/load";			}
	function getURLDelExe(){return "/setting/category/market/".$this->getId()."/del/exe";}
	
	function getURLDetailInsLoad(){return "/setting/category/market/".$this->getId()."/ins/load";}
	function getURLDetailInsExe(){return "/setting/category/market/".$this->getId()."/ins/exe";}
			
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}	
	
}
?>
