<?php 
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Solve extends Object{
	//-------------------------------------------------------------------------------
	//DEFINE PROPERTY
	//-------------------------------------------------------------------------------
	private $Id;
	private $IdDomain;
	private $Name;
	private $Note;
		
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
	function __construct($Id=null, $IdDomain=null, $Name=null, $Note=null) {
		$this->Id 		= $Id;
		$this->IdDomain = $IdDomain;
		$this->Name 	= $Name;
		$this->Note 	= $Note;
		parent::__construct( $Id );
	}
		
	function getId() {return $this->Id;}
	
	function setIdDomain($IdDomain) {$this->IdDomain = $IdDomain; $this->markDirty();}
	function getIdDomain() 			{return $this->IdDomain;}
	
	function setName($Name) {$this->Name = $Name;$this->markDirty();}
	function getName() 		{return $this->Name;}
	
	function setNote($Note) {$this->Note = $Note;$this->markDirty();}
	function getNote() 		{return $this->Note;}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdDomain' 		=> $this->getIdDomain(),
			'Name'			=> $this->getName(),	
			'Note'			=> $this->getNote()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 		= $Data[0];	
		$this->IdDomain = $Data[1];	
		$this->Name 	= $Data[2];
		$this->Note 	= $Data[3];
    }	
	//-------------------------------------------------------------------------------
	//GET LIST
	//-------------------------------------------------------------------------------		
	
			
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
				
	//-------------------------------------------------------------------------------
	static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
	static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	//-------------------------------------------------------------------------------
	
}
?>