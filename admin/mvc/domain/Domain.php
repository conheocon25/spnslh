<?php 
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Domain extends Object{
	//-------------------------------------------------------------------------------
	//DEFINE PROPERTY
	//-------------------------------------------------------------------------------
	private $Id;
	private $Name;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
	function __construct($Id=null, $Name=null) {
		$this->Id = $Id;
		$this->Name = $Name;
		parent::__construct( $Id );
	}
		
	function getId() {return $this->Id;}
		
	function setName($Name) {$this->Name = $Name;$this->markDirty();}
	function getName() {return $this->Name;}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'Name'			=> $this->getName()	
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id = $Data[0];	
		$this->Name = $Data[1];
    }
	
	//-------------------------------------------------------------------------------
	//GET LIST
	//-------------------------------------------------------------------------------		
	function getTableAll(){		
		$mTable = new \MVC\Mapper\Table();
		$TableAll = $mTable->findByDomain(array($this->getId()));		
		return $TableAll;
	}
			
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLUpdLoad(){	return "/setting/domain/".$this->getId()."/upd/load";}
	function getURLUpdExe(){	return "/setting/domain/".$this->getId()."/upd/exe";}
	
	function getURLDelLoad(){	return "/setting/domain/".$this->getId()."/del/load";}
	function getURLDelExe(){	return "/setting/domain/".$this->getId()."/del/exe";}
					
	function getURLTable(){		return "/setting/domain/".$this->getId();}
	function getURLTableInsLoad(){return "/setting/domain/".$this->getId()."/ins/load";}
	function getURLTableInsExe(){return "/setting/domain/".$this->getId()."/ins/exe";}
	
	function getURLSelling(){return "/selling/".$this->getId();}
			
	//-------------------------------------------------------------------------------
	static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
	static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	//-------------------------------------------------------------------------------
	
}
?>