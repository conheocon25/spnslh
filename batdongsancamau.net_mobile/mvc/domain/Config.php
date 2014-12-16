<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Config extends Object{
    private $Id;
	private $Param;
	private $Value;
			
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $Param=null , $Value=Null) {
        $this->Id = $Id;
		$this->Param = $Param;
		$this->Value = $Value;			
        parent::__construct( $Id );
    }
    function getId() {return $this->Id;}	
		
    function setParam( $Param ) {$this->Param = $Param;$this->markDirty();}
	function getParam( ) {return $this->Param;}
		
	function setValue( $Value ) {$this->Value = $Value;$this->markDirty();}   
	function getValue( ) {return $this->Value;}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'Param'			=> $this->getParam(),		 	
		 	'Value'			=> $this->getValue()		 	
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id = $Data[0];
		$this->Param = $Data[1];		
		$this->Value = $Data[2];
    }
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
		
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------			
			
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	
}
?>