<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class CategoryEstate extends Object{

    private $Id;
	private $Name;	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $Name=null) {
        $this->Id = $Id;		
		$this->Name = $Name;
        parent::__construct( $Id );
    }
    function getId() {
        return $this->Id;
    }		
		
    function setName( $Name ) {
        $this->Name = $Name;
        $this->markDirty();
    }   
	function getName( ) {
        return $this->Name;
    }
		
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	function getNews(){
		$mNewsGeneral = new \MVC\Mapper\NewsGeneral();
		$NewsGenerals = $mNewsGeneral->findBy(array($this->getId()));
		return $NewsGenerals;
	}
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLRead(){
		return "/general/".$this->getId();
	}
	function getURLView(){		
		return "/setting/category/estate/".$this->getId();
	}
	function getURLUpdLoad(){		
		return "/setting/category/estate/".$this->getId()."/upd/load";
	}
	function getURLUpdExe(){
		return "/setting/category/estate/".$this->getId()."/upd/exe";
	}
	
	function getURLDelLoad(){
		return "/setting/category/estate/".$this->getId()."/del/load";			
	}
	function getURLDelExe(){
		return "/setting/category/estate/".$this->getId()."/del/exe";
	}
	
	function getURLDetailInsLoad(){		
		return "/setting/category/estate/".$this->getId()."/ins/load";
	}
	function getURLDetailInsExe(){
		return "/setting/category/estate/".$this->getId()."/ins/exe";
	}
			
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}	
	
}
?>
