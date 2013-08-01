<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class CategoryProject extends Object{

    private $Id;
	private $Name;	
	private $Key;	
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $Name=null, $Key=null){
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
	function getProjects(){
		$mProject = new \MVC\Mapper\Project();
		$Projects = $mProject->findBy(array($this->getId()));
		return $Projects;
	}
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLRead(){return "/project/".$this->getId();}
	function getURLView(){return "/setting/category/project/".$this->getId();}
	function getURLUpdLoad(){return "/setting/category/project/".$this->getId()."/upd/load";}
	function getURLUpdExe(){return "/setting/category/project/".$this->getId()."/upd/exe";}
	
	function getURLDelLoad(){return "/setting/category/project/".$this->getId()."/del/load";}
	function getURLDelExe(){return "/setting/category/project/".$this->getId()."/del/exe";}
	
	function getURLDetailInsLoad(){return "/setting/category/project/".$this->getId()."/ins/load";}
	function getURLDetailInsExe(){return "/setting/category/project/".$this->getId()."/ins/exe";}
			
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	
}
?>