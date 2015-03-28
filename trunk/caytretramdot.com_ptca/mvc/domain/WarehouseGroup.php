<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class WarehouseGroup extends Object{

    private $Id;
	private $Name;
	private $Code;
			
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $Name=null, $Code=null){
        $this->Id 			= $Id;
		$this->Name 		= $Name;
		$this->Code 		= $Code;		
				
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
	
	function setCode( $Code ) {$this->Code = $Code;$this->markDirty();}
	function getCode(){return $this->Code;}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'Name'			=> $this->getName(),
			'Code'			=> $this->getCode()
		);
		return json_encode($json);
	}
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	function getWarehouseAll(){
		$mWarehouse 	= new \MVC\Mapper\Warehouse();
		$WarehouseAll 	= $mWarehouse->findByGroup(array($this->getId()));
		return $WarehouseAll;
	}
				
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $id );}
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------			
	function getURLSetting(){return "/ql-thiet-lap/kho-hang/".$this->getId();}
}
?>