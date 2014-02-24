<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class CStep extends Object{
    private $Id;
	private $IdCSet;
	private $Name1;
	private $Content1;	
	private $Name2;
	private $Content2;	
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $IdCSet=null , $Name1=null, $Content1=null, $Name2=null, $Content2=null){
        $this->Id 		= $Id;
		$this->IdCSet 	= $IdCSet;				
		$this->Name1 	= $Name1;
		$this->Content1	= $Content1;
		$this->Name2 	= $Name2;
		$this->Content2	= $Content2;
        parent::__construct( $Id );
    }
    function getId() {return $this->Id;}	
		
    function setIdCSet( $IdCSet ) {$this->IdCSet = $IdCSet;$this->markDirty();}   
	function getIdCSet( ) {return $this->IdCSet;}
	function getCSet(){$mCS = new \MVC\Mapper\CSet(); $CS = $mCS->find($this->getIdCSet());return $CS;}
				
	function setName1( $Name1 ){$this->Name1 = $Name1; $this->markDirty();}   
	function getName1( ) {return $this->Name1;}	
	function setContent1( $Content1 ){$this->Content1 = $Content1;$this->markDirty();}
	function getContent1( ) {return $this->Content1;}
	
	function setName2( $Name2 ){$this->Name2 = $Name2; $this->markDirty();}   
	function getName2( ) {return $this->Name2;}	
	function setContent2( $Content2 ){$this->Content2 = $Content2;$this->markDirty();}
	function getContent2( ) {return $this->Content2;}
			
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdCSet' 		=> $this->getIdCSet(),
			'Name1'			=> $this->getName1(),
			'Content1'		=> $this->getContent1(),
			'Name2'			=> $this->getName2(),
			'Content2'		=> $this->getContent2()
		);		
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->IdCSet 		= $Data[1];
		$this->Name1		= $Data[2];
		$this->Content1	 	= $Data[3];
		$this->Name2		= $Data[4];
		$this->Content2	 	= $Data[5];
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