<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Project extends Object{

    private $Id;
	private $Name;
	private $URLDoc;
	private $URLPic;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $Name=null , $URLDoc=Null, $URLPic=Null) {
        $this->Id = $Id;
		$this->Name = $Name;
		$this->URLDoc = $URLDoc;
		$this->URLPic = $URLPic;
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
	
	function setURLDoc( $URLDoc ) {
        $this->URLDoc = $URLDoc;
        $this->markDirty();
    }   
	function getURLDoc( ) {
        return $this->URLDoc;
    }
	
	function setURLPic( $URLPic ) {
        $this->URLPic = $URLPic;
        $this->markDirty();
    }   
	function getURLPic( ) {
        return $this->URLPic;
    }
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
		
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLRead(){		
		return "/project/".$this->getId();
	}
	
	function getURLUpdLoad(){		
		return "/".$App."/setting/Service/".$this->getId()."/upd/load";
	}
	function getURLUpdExe(){
		$App = @\MVC\Base\SessionRegistry::getCurrentUser()->getApp()->getAlias();
		return "/".$App."/setting/Service/".$this->getId()."/upd/exe";			
	}
	
	function getURLDelLoad(){
		$App = @\MVC\Base\SessionRegistry::getCurrentUser()->getApp()->getAlias();
		return "/".$App."/setting/Service/".$this->getId()."/del/load";						
	}
	function getURLDelExe(){
		$App = @\MVC\Base\SessionRegistry::getCurrentUser()->getApp()->getAlias();
		return "/".$App."/setting/Service/".$this->getId()."/del/exe";
	}
					
	function getURLCourse(){
		$App = @\MVC\Base\SessionRegistry::getCurrentUser()->getApp()->getAlias();
		return "/".$App."/setting/Service#c".$this->getId();
	}
	
	function getURLCourseInsLoad(){
		$App = @\MVC\Base\SessionRegistry::getCurrentUser()->getApp()->getAlias();
		return "/".$App."/setting/Service/".$this->getId()."/ins/load";
	}
	function getURLCourseInsExe(){
		$App = @\MVC\Base\SessionRegistry::getCurrentUser()->getApp()->getAlias();
		return "/".$App."/setting/Service/".$this->getId()."/ins/exe";
	}
		
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}	
	
}

?>
