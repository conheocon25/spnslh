<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class Transport extends Object{

    private $Id;
	private $Name;    
	private $Driver;
			
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $Name=null, $Driver=null){
        $this->Id 			= $Id;
		$this->Name 		= $Name;		
		$this->Driver 		= $Driver;		
				
        parent::__construct( $Id );
    }
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->Name 		= $Data[1];
		$this->Driver 		= $Data[2];
    }
	
    function getId( ) {return $this->Id;}
			
	function setName( $Name ) {$this->Name = $Name;$this->markDirty();}
	function getName(){return $this->Name;}
	
	function setDriver( $Driver ) {$this->Driver = $Driver; $this->markDirty();}
	function getDriver(){return $this->Driver;}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'Name'			=> $this->getName(),
			'Driver'		=> $this->getDriver()
		);
		return json_encode($json);
	}
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
					
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $id );}
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------				
}
?>