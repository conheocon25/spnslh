<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class BranchWarehouse extends Object{

    private $Id;
	private $IdBranch;
	private $IdWarehouse;
		
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id			=null, 
		$IdBranch	=null, 
		$IdWarehouse=null		
	){
        $this->Id 			= $Id;
		$this->IdBranch 	= $IdBranch;
		$this->IdWarehouse 	= $IdWarehouse;
				
        parent::__construct( $Id );
    }
			
    function getId( ) {return $this->Id;}
	
	function setIdBranch( $IdBranch ) 	{$this->IdBranch = $IdBranch;$this->markDirty();}
	function getIdBranch()				{return $this->IdBranch;}
	function getBranch(){
		$mBranch = new \MVC\Mapper\Branch();
		$Branch = $mBranch->find($this->IdBranch);
		return $Branch;
	}
	
	function setIdWarehouse( $IdWarehouse ) {$this->IdWarehouse = $IdWarehouse;$this->markDirty();}
	function getIdWarehouse()				{return $this->IdWarehouse;}
	function getWarehouse(){
		$mWarehouse = new \MVC\Mapper\Warehouse();
		$Warehouse = $mWarehouse->find($this->IdWarehouse);
		return $Warehouse;
	}
	
			
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->IdBranch		= $Data[1];
		$this->IdWarehouse 	= $Data[2];		
    }
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdBranch' 		=> $this->getIdBranch(),
			'IdWarehouse'	=> $this->getIdWarehouse()			
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