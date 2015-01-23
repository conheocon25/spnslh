<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Guest extends Object{

    private $Id;
	private $IP;
	private $Agent;
	private $EntryTime;
	private $ExitTime;
		
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $IP=null, $Agent=null , $EntryTime=Null, $ExitTime=Null){$this->Id = $Id;$this->IP = $IP;$this->Agent = $Agent;$this->EntryTime = $EntryTime;$this->ExitTime = $ExitTime;parent::__construct( $Id );}
    function getId(){return $this->Id;}	
	function getIdPrint(){return "c" . $this->getId();}
    function setIP( $IP ) {$this->IP = $IP;$this->markDirty();}
	function getIP( ) {return $this->IP;}
	function setAgent( $Agent ) {$this->Agent = $Agent;$this->markDirty();}
	function getAgent( ) {return $this->Agent;}
	function setEntryTime( $EntryTime ) {$this->EntryTime = $EntryTime;$this->markDirty();}
	function getEntryTime( ) {return $this->EntryTime;}	
	function setExitTime( $ExitTime ) {$this->ExitTime = $ExitTime;$this->markDirty();}   
	function getExitTime( ) {return $this->ExitTime;}
		
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