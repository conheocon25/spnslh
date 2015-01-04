<?php 
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class StudentTemp extends Object{
	//-------------------------------------------------------------------------------
	//DEFINE PROPERTY
	//-------------------------------------------------------------------------------
	private $Id;
	private $SurName;
	private $LastName;
	private $Code;
		
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
	function __construct($Id=null, $Code, $SurName=null, $LastName=null) {
		$this->Id 		= $Id;
		$this->Code 	= $Code;
		$this->SurName 	= $SurName;
		$this->LastName = $LastName;
		parent::__construct( $Id );
	}		
	function getId() {return $this->Id;}
		
	function setCode($Code) {$this->Code = $Code;$this->markDirty();}
	function getCode() {return $this->Code;}
	
	function setSurName($SurName) {$this->SurName = $SurName;$this->markDirty();}
	function getSurName() {return $this->SurName;}
	
	function setLastName($LastName) {$this->LastName = $LastName;$this->markDirty();}
	function getLastName() {return $this->LastName;}
				
	//-------------------------------------------------------------------------------
	static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
	static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	//-------------------------------------------------------------------------------
	
}
?>