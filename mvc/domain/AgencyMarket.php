<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class AgencyMarket extends Object{

    private $Id;
	private $IdAgency;
	private $IdMarket;
	private $Permission;
			
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $IdAgency=null , $IdMarket=Null, $Permission=Null) {
        $this->Id = $Id;
		$this->IdAgency = $IdAgency;
		$this->IdMarket = $IdMarket;
		$this->Permission = $Permission;
		
        parent::__construct( $Id );
    }
    function getId() {
        return $this->Id;
    }	
		
    function setIdAgency( $IdAgency ) {
        $this->IdAgency = $IdAgency;
        $this->markDirty();
    }   
	function getIdAgency( ){
        return $this->IdAgency;
    }
	function getAgency( ) {
		$mAgency = new \MVC\Mapper\Agency();
		$Agency = $mAgency->find($this->IdAgency);
        return $Agency;
    }
	
	function setIdMarket( $IdMarket ) {
        $this->IdMarket = $IdMarket;
        $this->markDirty();
    }   
	function getIdMarket( ) {
        return $this->IdMarket;
    }
	function getNews( ) {
		$mNewsMarket = new \MVC\Mapper\NewsMarket();
		$News = $mNewsMarket->find($this->IdMarket);
        return $News;
    }
	
	function setPermission( $Permission ) {
        $this->Permission = $Permission;
        $this->markDirty();
    }   
	function getPermission( ) {
        return $this->Permission;
    }
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	function getAMs(){
		$mCategory = new \MVC\Mapper\Category();
		$Categories = $mCategory->findAll();
		return $Categories;
	}
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLRead(){
		return "/agency/".$this->getId();
	}
	function getURLView(){		
		return "/setting/agency/".$this->getIdAgency()."/".$this->getId();
	}
	
	function getURLUpdLoad(){
		return "/setting/agency/".$this->getIdAgency()."/".$this->getId()."/upd/load";		
	}
	function getURLUpdExe(){
		return "/setting/agency/".$this->getIdAgency()."/".$this->getId()."/upd/exe";
	}
	
	function getURLDelLoad(){
		return "/setting/agency/".$this->getIdAgency()."/".$this->getId()."/del/load";
	}
	function getURLDelExe(){
		return "/setting/agency/".$this->getIdAgency()."/".$this->getId()."/del/exe";
	}
	
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}	
	
}
?>
