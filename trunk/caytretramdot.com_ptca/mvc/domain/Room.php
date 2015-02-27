<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Room extends Object{

    private $Id;
	private $Name;    
				
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $Name=null, $Note=null){
        $this->Id 			= $Id;
		$this->Name 		= $Name;		
			
        parent::__construct( $Id );
    }
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->Name 		= $Data[1];			
    }
	
    function getId( ) {return $this->Id;}
			
	function setName( $Name ) 	{$this->Name = $Name;$this->markDirty();}
	function getName()			{return $this->Name;}
		
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
	function getEmployeeAll(){
		$mEmployee 		= new \MVC\Mapper\Employee();
		$EmployeeAll 	= $mEmployee->findByRoom(array($this->getId()));
		return $EmployeeAll;
	}
				
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------			
	function getURLSettingEmployee(){return "/admin/setting/room/".$this->getId();}
	
	static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $id );}
}
?>