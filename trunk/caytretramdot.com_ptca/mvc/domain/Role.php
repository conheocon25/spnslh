<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class Role extends Object{

    private $Id;
	private $Name;
				
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $Name=null){
        $this->Id 			= $Id;
		$this->Name 		= $Name;				
        parent::__construct( $Id );
    }
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->Name 		= $Data[1];
		$this->Code 		= $Data[2];
    }
	
    function getId( ) {return $this->Id;}
			
	function setName( $Name ) {$this->Name = $Name;$this->markDirty();}
	function getName(){return $this->Name;}
		
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'Name'			=> $this->getName()	
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