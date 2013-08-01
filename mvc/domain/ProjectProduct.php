<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class ProjectProduct extends Object{

    private $Id;
	private $IdProject;
	private $Name;
	private $Date;
	private $Description;
	private $Type;
	private $PriceFrom;
	private $PriceTo;
	private $Key;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $IdProject=null , $Name=null, $Date=null, $Description=null, $Type=null, $PriceFrom=null, $PriceTo=null, $Key=null){
        $this->Id = $Id;
		$this->IdProject = $IdProject;
		$this->Name = $Name;
		$this->Date = $Date;
		$this->Description = $Description;		
		$this->Type = $Type;
		$this->PriceFrom = $PriceFrom;
		$this->PriceTo = $PriceTo;
		$this->Key = $Key;
		
        parent::__construct( $Id );
    }
    function getId() {return $this->Id;}	
		
    function setIdProject( $IdProject ) {$this->IdProject = $IdProject;$this->markDirty();}   
	function getIdProject( ) {return $this->IdProject;}
	function getProject(){$mProject = new \MVC\Mapper\Project();$Project = $mProject->find($this->getIdProject());return $Project;}
			
	function setDate( $Date ){$this->Date = $Date;$this->markDirty();}   
	function getDate( ) {return $this->Date;}
	function getDatePrint( ){$D = new \MVC\Library\Date($this->Date);return $D->getDateFormat();}
	
	function setDescription( $Description ){$this->Description = $Description;$this->markDirty();}   
	function getDescription( ) {return $this->Description;}
	function getDescriptionReduce( ){
		$S = new \MVC\Library\String($this->Description);
		return $S->reduceHTML(350);
    }
	
	function setName( $Name ){$this->Name = $Name;$this->markDirty();}   
	function getName( ) {return $this->Name;}
	
	function setType( $Type ){$this->Type = $Type;$this->markDirty();}   
	function getType( ) {return $this->Type;}
	
	function setPriceFrom( $PriceFrom ){$this->PriceFrom = $PriceFrom;$this->markDirty();
    }   
	function getPriceFrom( ) {return $this->PriceFrom;}
	
	function setPriceTo( $PriceTo ){$this->PriceTo = $PriceTo;$this->markDirty();}   
	function getPriceTo( ) {return $this->PriceTo;}
	
	function getImage(){return "/data/images/house.png";}
	
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
		$mNews = new \MVC\Mapper\NewsProject();
		$NewsAll = $mNews->findBy(array($this->getId()));
		return $NewsAll;
	}
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLRead(){return "/project/".$this->getIdProject()."/".$this->getId();}
	
	function getURLUpdLoad(){return "/setting/category/project/".$this->getIdProduct()."/".$this->getId()."/upd/load";}
	function getURLUpdExe(){return "/setting/category/project/".$this->getIdProduct()."/".$this->getId()."/upd/exe";}
	
	function getURLDelLoad(){return "/setting/category/project/".$this->getIdProduct()."/".$this->getId()."/del/load";}	
	function getURLDelExe(){return "/setting/category/project/".$this->getIdProduct()."/".$this->getId()."/del/exe";}
	
	function getURLNewsView(){return "/setting/category/project/".$this->getIdProduct()."/".$this->getId()."/news";}
	function getURLNewsInsLoad(){return "/setting/category/project/".$this->getIdProduct()."/".$this->getId()."/news/ins/load";}
	function getURLNewsInsExe(){return "/setting/category/project/".$this->getIdProduct()."/".$this->getId()."/news/ins/exe";}
	
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	
}
?>