<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class ProjectAlbum extends Object{

    private $Id;
	private $IdProject;
	private $Name;
	private $Date;
	private $URL;
	private $Description;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $IdProject=null , $Name=null, $Date=null, $URL=null, $Description=null){
        $this->Id = $Id;
		$this->IdProject = $IdProject;
		$this->Name = $Name;
		$this->Date = $Date;
		$this->URL = $URL;
		$this->Description = $Description;		
						
        parent::__construct( $Id );
    }
    function getId() {
        return $this->Id;
    }
		
    function setIdProject( $IdProject ) {$this->IdProject = $IdProject;$this->markDirty();}   
	function getIdProject( ) {return $this->IdProject;}
	function getProject(){$mProject = new \MVC\Mapper\Project();$Project = $mProject->find($this->getIdProject());return $Project;}
			
	function setDate( $Date ){$this->Date = $Date;$this->markDirty();}   
	function getDate( ) {return $this->Date;}
	function getDatePrint( ){$D = new \MVC\Library\Date($this->Date);return $D->getDateFormat();}
	
	function setDescription( $Description ){$this->Description = $Description;$this->markDirty();}   
	function getDescription( ) {return $this->Description;}
	function getDescriptionReduce( ){$S = new \MVC\Library\String($this->Description);return $S->reduceHTML(350);}
	
	function setName( $Name ){$this->Name = $Name;$this->markDirty();}   
	function getName( ) {return $this->Name;}
	
	function setURL( $URL ){$this->URL = $URL;$this->markDirty();}   
	function getURL( ) {return $this->URL;}
			
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------

	function getURLRead(){return "/project/".$this->getIdProject()."/".$this->getId();}
	
	function getURLUpdLoad(){return "/setting/category/project/".$this->getProject()->getCategory()->getId()."/".$this->getIdProject()."/album/".$this->getId()."/upd/load";}
	function getURLUpdExe(){return "/setting/category/project/".$this->getProject()->getCategory()->getId()."/".$this->getIdProject()."/album/".$this->getId()."/upd/exe";}
	
	function getURLDelLoad(){return "/setting/category/project/".$this->getProject()->getCategory()->getId()."/".$this->getIdProject()."/album/".$this->getId()."/del/load";}
	function getURLDelExe(){return "/setting/category/project/".$this->getProject()->getCategory()->getId()."/".$this->getIdProject()."/album/".$this->getId()."/del/exe";}
			
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	
}
?>