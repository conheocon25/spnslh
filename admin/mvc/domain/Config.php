<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Config extends Object{

    private $Id;
	private $Param;
	private $Value;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $Param=null , $Value=Null) {
        $this->Id = $Id;
		$this->Param = $Param;
		$this->Value = $Value;			
        parent::__construct( $Id );
    }
    function getId() {
        return $this->Id;
    }	
	function getIdPrint(){
        return "c" . $this->getId();
    }	
	
    function setParam( $Param ) {
        $this->Param = $Param;
        $this->markDirty();
    }   
	function getParam( ) {
        return $this->Param;
    }
		
	function setValue( $Value ) {
        $this->Value = $Value;
        $this->markDirty();
    }   
	function getValue( ) {
        return $this->Value;
    }
		
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
		
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
		
	function getURLUpdLoad(){
		return "/setting/config/".$this->getId()."/upd/load";
	}
	function getURLUpdExe(){		
		return "/setting/config/".$this->getId()."/upd/exe";
	}
	
	function getURLDelLoad(){
		return "/setting/config/".$this->getId()."/del/load";
	}
	function getURLDelExe(){
		return "/setting/config/".$this->getId()."/del/exe";
	}
		
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	
}
?>