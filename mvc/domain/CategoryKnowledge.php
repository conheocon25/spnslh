<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class CategoryKnowledge extends Object{

    private $Id;
	private $Name;	
	private $Key;	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $Name=null, $Key=null) {
        $this->Id = $Id;		
		$this->Name = $Name;
		$this->Key= $Key;
        parent::__construct( $Id );
    }
    function getId() {
        return $this->Id;
    }		
		
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
	function getNews(){
		$mNews = new \MVC\Mapper\NewsKnowledge();
		$NewsAll = $mNews->findBy(array($this->getId()));
		return $NewsAll;
	}
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLRead(){return "/knowledge/".$this->getId();}
	function getURLTab(){return "#knowledge".$this->getId();}
	function getTabId(){return "knowledge".$this->getId();}
	function getURLView(){return "/setting/category/knowledge/".$this->getId();}
	function getURLUpdLoad(){return "/setting/category/knowledge/".$this->getId()."/upd/load";}
	function getURLUpdExe(){return "/setting/category/knowledge/".$this->getId()."/upd/exe";}
	
	function getURLDelLoad(){return "/setting/category/knowledge/".$this->getId()."/del/load";			}
	function getURLDelExe(){return "/setting/category/knowledge/".$this->getId()."/del/exe";}
	
	function getURLDetailInsLoad(){return "/setting/category/knowledge/".$this->getId()."/ins/load";}
	function getURLDetailInsExe(){return "/setting/category/knowledge/".$this->getId()."/ins/exe";}
	
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}	
	
}
?>