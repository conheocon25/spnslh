<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Contact extends Object{

    private $Id;
	private $Name;
	private $PicURL;
	private $Website;
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $Name=null, $PicURL=null, $Website=null) {
        $this->Id = $Id;		
		$this->Name = $Name;
		$this->PicURL = $PicURL;
		$this->Website = $Website;
		
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
	
	function setPicURL( $PicURL ) {
        $this->PicURL = $PicURL;
        $this->markDirty();
    }   
	function getPicURL( ) {
        return $this->PicURL;
    }
	
	function setWebsite( $Website ) {
        $this->Website = $Website;
        $this->markDirty();
    }   
	function getWebsite( ) {
        return $this->Website;
    }
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
		
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------		
	function getURLUpdLoad(){
		return "/setting/contact/".$this->getId()."/upd/load";
	}
	function getURLUpdExe(){
		return "/setting/contact/".$this->getId()."/upd/exe";
	}
	
	function getURLDelLoad(){
		return "/setting/contact/".$this->getId()."/del/load";			
	}
	function getURLDelExe(){
		return "/setting/contact/".$this->getId()."/del/exe";
	}
	
	function getURLDetailInsLoad(){		
		return "/setting/contact/".$this->getId()."/ins/load";
	}
	function getURLDetailInsExe(){
		return "/setting/contact/".$this->getId()."/ins/exe";
	}
			
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	
}
?>

