<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class TermCollect extends Object{

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
	function getIdPrint(){
        return "c" . $this->getId();
    }	
	
    function setName( $Name ) {
        $this->Name = $Name;
        $this->markDirty();
    }
   
	function getName( ) {
        return $this->Name;
    }
	
	function setType( $Type ) {
        $this->Type = $Type;
        $this->markDirty();
    }
   		
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	function getCollectAll(){
		$mCollectGeneral = new \MVC\Mapper\CollectGeneral();
		$CGAll = $mCollectGeneral->findBy(array($this->getId()));
		return $CGAll;
	}	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLUpdLoad(){	return "/setting/termcollect/".$this->getId()."/upd/load";}
	function getURLUpdExe(){return "/setting/termcollect/".$this->getId()."/upd/exe";}
	
	function getURLDelLoad(){return "/setting/termcollect/".$this->getId()."/del/load";}
	function getURLDelExe(){return "/setting/termcollect/".$this->getId()."/del/exe";}
	
	function getURLCollect(){return "/money/collect/general/".$this->getId();}
	function getURLCollectInsLoad(){return "/money/collect/general/".$this->getId()."/ins/load";}
	function getURLPaidInsExe(){return "/money/collect/general/".$this->getId()."/ins/exe";}
		
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}	
}

?>
