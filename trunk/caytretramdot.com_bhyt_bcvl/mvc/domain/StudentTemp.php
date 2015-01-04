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
	private $CodeExt1;
	private $Birthday;
	private $Gender;
	private $IdClass;
		
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
	function __construct($Id=null, $Code, $SurName=null, $LastName=null, $CodeExt1=null, $Birthday=null, $Gender=null, $IdClass=null){
		$this->Id 		= $Id;
		$this->Code 	= $Code;
		$this->SurName 	= $SurName;
		$this->LastName = $LastName;
		$this->CodeExt1	= $CodeExt1;
		$this->Birthday = $Birthday;
		$this->Gender	= $Gender;
		$this->IdClass 	= $IdClass;
	
		parent::__construct( $Id );
	}		
	function getId() {return $this->Id;}
		
	function setCode($Code) {$this->Code = $Code;$this->markDirty();}
	function getCode() {return $this->Code;}
	
	function setSurName($SurName) {$this->SurName = $SurName;$this->markDirty();}
	function getSurName() {return $this->SurName;}
	
	function setLastName($LastName) {$this->LastName = $LastName;$this->markDirty();}
	function getLastName() {return $this->LastName;}
	
	function setCodeExt1($CodeExt1) {$this->CodeExt1 = $CodeExt1;$this->markDirty();}
	function getCodeExt1() {return $this->CodeExt1;}
	
	function setBirthday($Birthday) {$this->Birthday = $Birthday;$this->markDirty();}
	function getBirthday() {return $this->Birthday;}
	
	function setGender($Gender) {$this->Gender = $Gender;$this->markDirty();}
	function getGender() {return $this->Gender;}
	function getGenderPrint(){
		$Arr = array("Nữ", "Nam");
		return $Arr[$this->Gender];
	}
	
	function setIdClass($IdClass) {$this->IdClass = $IdClass;$this->markDirty();}
	function getIdClass() {return $this->IdClass;}
	
	//-------------------------------------------------------------------------------
	static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
	static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	//-------------------------------------------------------------------------------
	
}
?>