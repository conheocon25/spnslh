<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class SupplierType extends Object{

    private $Id;	
	private $Name;
	private $Code;
    private $Note;    
	private $Enable;
		
    function __construct( 
		$Id=null, 		
		$Name=null, 
		$Code=null, 		
		$Note=null,		
		$Enable=null
	) {
        $this->Id 		= $Id;		
		$this->Name 	= $Name;
		$this->Code 	= $Code;
		$this->Note 	= $Note;		
		$this->Enable	= $Enable;
	
        parent::__construct( $Id );
    }
	function setId( $Id){return $this->Id = $Id;}
    function getId( ) 	{return $this->Id;}
				
	function getName(){return $this->Name;}	
    function setName( $Name ) {$this->Name = $Name;$this->markDirty();}

	function getCode(){return $this->Code;}
    function setCode( $Code ) {$this->Code = $Code;$this->markDirty();}
		
	function setNote( $Note ) {$this->Note = $Note;$this->markDirty();}
	function getNote(){return $this->Note;}
	
	function setEnable( $Enable ) {$this->Enable = $Enable; $this->markDirty();}
	function getEnable(){return $this->Enable;}
	
	function getSupplierAll(){
		$mSupplier 		= new \MVC\Mapper\Supplier();
		$SupplierAll 	= $mSupplier->findByType(array($this->getId()));
		return $SupplierAll;
	}
			
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),	
			'Name'			=> $this->getName(),
			'Code'			=> $this->getCode(),			
			'Note'			=> $this->getNote(),						
			'Enable'		=> $this->getEnable()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
		$this->Id 			= $Data[0];		
		$this->Name 		= $Data[1];
		$this->Code			= $Data[2];		
		$this->Note			= $Data[3];
		$this->Enable		= $Data[4];
    }
					
	//=================================================================================
	function getURLSetting(){return "/admin/setting/supplier/".$this->getId();}
	
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}	
	
}
?>