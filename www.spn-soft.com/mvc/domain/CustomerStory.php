<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class CustomerStory extends Object{

    private $Id;
	private $Name;
	private $URlDoc;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $Name=null , $URlDoc=Null) {
        $this->Id = $Id;
		$this->Name = $Name;
		$this->URlDoc = $URlDoc;
        parent::__construct( $Id );
    }
    function getId() {
        return $this->Id;
    }	
	function getIdPrint(){
        return "t" . $this->getId();
    }	
	
    function setName( $Name ) {
        $this->Name = $Name;
        $this->markDirty();
    }
   
	function getName( ) {
        return $this->Name;
    }
	
	function setURlDoc( $URlDoc ) {
        $this->URlDoc = $URlDoc;
        $this->markDirty();
    }
   
	function getURlDoc( ) {
        return $this->URlDoc;
    }
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
		
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLRead(){
		return "/story/".$this->getId();
	}
	
	function getURLUpdLoad(){
		$App = @\MVC\Base\SessionRegistry::getCurrentUser()->getApp()->getAlias();
		return "/".$App."/setting/CustomerStory/".$this->getId()."/upd/load";
	}
	function getURLUpdExe(){
		$App = @\MVC\Base\SessionRegistry::getCurrentUser()->getApp()->getAlias();
		return "/".$App."/setting/CustomerStory/".$this->getId()."/upd/exe";			
	}
	
	function getURLDelLoad(){
		$App = @\MVC\Base\SessionRegistry::getCurrentUser()->getApp()->getAlias();
		return "/".$App."/setting/CustomerStory/".$this->getId()."/del/load";						
	}
	function getURLDelExe(){
		$App = @\MVC\Base\SessionRegistry::getCurrentUser()->getApp()->getAlias();
		return "/".$App."/setting/CustomerStory/".$this->getId()."/del/exe";
	}
					
	function getURLCourse(){
		$App = @\MVC\Base\SessionRegistry::getCurrentUser()->getApp()->getAlias();
		return "/".$App."/setting/CustomerStory#c".$this->getId();
	}
	
	function getURLCourseInsLoad(){
		$App = @\MVC\Base\SessionRegistry::getCurrentUser()->getApp()->getAlias();
		return "/".$App."/setting/CustomerStory/".$this->getId()."/ins/load";
	}
	function getURLCourseInsExe(){
		$App = @\MVC\Base\SessionRegistry::getCurrentUser()->getApp()->getAlias();
		return "/".$App."/setting/CustomerStory/".$this->getId()."/ins/exe";
	}
		
	//--------------------------------------------------------------------------
    static function findAll() {
        $finder = self::getFinder( __CLASS__ ); 
        return $finder->findAll();
    }
    static function find( $Id ) {
        $finder = self::getFinder( __CLASS__ ); 
        return $finder->find( $Id );
    }	
}

?>
