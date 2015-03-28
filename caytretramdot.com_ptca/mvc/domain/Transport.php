<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class Transport extends Object{

    private $Id;
	private $IdGroup;
	private $Name;
	private $Code;
	private $Driver;
	private $Quantity;
	private $Note;
	private $Enable;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id			= null, 
		$IdGroup	= null, 
		$Name		= null, 
		$Code		= null, 
		$Driver		= null, 
		$Quantity	= null, 
		$Note		= null, 
		$Enable		= null
	){
        $this->Id 			= $Id;
		$this->IdGroup		= $IdGroup;
		$this->Name 		= $Name;
		$this->Code 		= $Code;
		$this->Driver 		= $Driver;
		$this->Quantity 	= $Quantity;
		$this->Note 		= $Note;
		$this->Enable 		= $Enable;
				
        parent::__construct( $Id );
    }
			
    function getId( ) {return $this->Id;}
	
	function setIdGroup( $IdGroup ) {$this->IdGroup = $IdGroup;$this->markDirty();}
	function getIdGroup(){return $this->IdGroup;}
	function getGroup(){
		$mGroup = new \MVC\Mapper\TransportGroup();
		$Group = $mGroup->find($this->IdGroup);
		return $this->Group;
	}
	
	function setName( $Name ) {$this->Name = $Name;$this->markDirty();}
	function getName(){return $this->Name;}
	
	function setCode( $Code ) {$this->Code = $Code; $this->markDirty();}
	function getCode(){return $this->Code;}
	
	function setDriver( $Driver ) {$this->Driver = $Driver; $this->markDirty();}
	function getDriver(){return $this->Driver;}
	
	function setQuantity( $Quantity ) {$this->Quantity = $Quantity; $this->markDirty();}
	function getQuantity(){return $this->Quantity;}
	
	function setNote( $Note ) {$this->Note = $Note; $this->markDirty();}
	function getNote(){return $this->Note;}
	
	function setEnable( $Enable ) {$this->Enable = $Enable; $this->markDirty();}
	function getEnable(){return $this->Enable;}
	
	function setArray( $Data ){        
		$this->Id 			= $Data[0];
		$this->IdGroup		= $Data[1];
		$this->Name 		= $Data[2];
		$this->Code 		= $Data[3];
		$this->Driver 		= $Data[4];
		$this->Quantity 	= $Data[5];
		$this->Note 		= $Data[6];
		$this->Enable 		= $Data[7];
    }
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdGroup' 		=> $this->getIdGroup(),
			'Name'			=> $this->getName(),
			'Code'			=> $this->getCode(),
			'Driver'		=> $this->getDriver(),
			'Quantity'		=> $this->getQuantity(),
			'Note'			=> $this->getNote(),
			'Enable'		=> $this->getEnable()
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