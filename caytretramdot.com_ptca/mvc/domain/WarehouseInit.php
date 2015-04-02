<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class WarehouseInit extends Object{

    private $Id;
	private $IdWarehouse;
	private $IdGood;
	private $Value;
			
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $IdWarehouse=null, $IdGood=null,  $Value=null){
        $this->Id 			= $Id;	
		$this->IdWarehouse 	= $IdWarehouse;
		$this->IdGood 		= $IdGood;
		$this->Value 		= $Value;
				
        parent::__construct( $Id );
    }
	function setId( $Id) {$this->Id = $Id;}
    function getId( ) {return $this->Id;}
			
	function setIdWarehouse( $IdWarehouse ) {$this->IdWarehouse = $IdWarehouse;$this->markDirty();}
	function getIdWarehouse(){return $this->IdWarehouse;}
	function getWarehouse(){
		$mWarehouse = new \MVC\Mapper\Warehouse();
		$Warehouse = $mWarehouse->find($this->IdWarehouse);
		return $Warehouse;
	}
	
	function setIdGood( $IdGood ) 	{$this->IdGood = $IdGood;$this->markDirty();}
	function getIdGood()			{return $this->IdGood;}
	function getGood(){
		$mGood 	= new \MVC\Mapper\Good();
		$Good 	= $mGood->find($this->IdGood);
		return $Good;
	}
	
	function setValue( $Value ) {$this->Value = $Value;$this->markDirty();}
	function getValue(){return $this->Value;}	
	function getValuePrint( ){
		$num = number_format($this->getValue(), 0, ',', ' ');
		return $num;
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];		
		$this->IdWarehouse 	= $Data[1];
		$this->IdGood 		= $Data[2];
		$this->Value 		= $Data[3];
    }
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),			
			'IdWarehouse'	=> $this->getIdWarehouse(),
			'IdGood'		=> $this->getIdGood(),
			'Value'			=> $this->getValue()
		);
		return json_encode($json);
	}
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	function getURLExe(){
		return "/ql-thiet-lap/nha-cung-cap/".$this->getWarehouse()->getIdGroup()."/".$this->getId()."/exe";
	}
	
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $id );}
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	
}
?>