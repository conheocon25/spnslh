<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class CStep extends Object{
    private $Id;
	private $IdCSet;
	private $Name;
	private $Content;	
		
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $IdCSet=null , $Name=null, $Content=null){
        $this->Id 		= $Id;
		$this->IdCSet 	= $IdCSet;				
		$this->Name 	= $Name;
		$this->Content 	= $Content;					
        parent::__construct( $Id );
    }
    function getId() {return $this->Id;}	
		
    function setIdCSet( $IdCSet ) {$this->IdCSet = $IdCSet;$this->markDirty();}   
	function getIdCSet( ) {return $this->IdCSet;}
	function getCSet(){$mCS = new \MVC\Mapper\CSet(); $CS = $mCS->find($this->getIdCSet());return $CS;}
			
	function setContent( $Content ){$this->Content = $Content;$this->markDirty();}   
	function getContent( ) {return $this->Content;}
		
	function setName( $Name ){$this->Name = $Name;$this->markDirty();}   
	function getName( ) {return $this->Name;}	
			
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdCSet' 		=> $this->getIdCSet(),
			'Name'			=> $this->getName(),
			'Content'		=> $this->getContent()			
		);		
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->IdCSet 		= $Data[1];
		$this->Name	 		= $Data[2];
		$this->Content	 	= $Data[3];
    }

	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
		
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	
	//-------------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	
}
?>