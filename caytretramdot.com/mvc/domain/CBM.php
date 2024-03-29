<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class CBM extends Object{

    private $Id;
	private $Name;	
	private $Time;
	private $MoveStart;
	private $MoveEnd;
	private $Key;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $Name=null, $Time=0, $MoveStart=null,  $MoveEnd=null, $Key=0){
		$this->Id 		= $Id;
		$this->Name 	= $Name; 		
		$this->Time 	= $Time;
		$this->MoveStart= $MoveStart;
		$this->MoveEnd	= $MoveEnd;
		$this->Key 		= $Key;
		
		parent::__construct( $Id );
	}
    function getId() {return $this->Id;}	
		
    function setName( $Name ) {$this->Name = $Name;$this->markDirty();}   
	function getName( ) {return $this->Name;}
			
	function setTime( $Time ) {$this->Time = $Time;$this->markDirty();}   
	function getTime( ) {return $this->Time;}	
	
	function setMoveStart( $MoveStart ) {$this->MoveStart = $MoveStart;$this->markDirty();}   
	function getMoveStart( ) {return $this->MoveStart;}
	
	function setMoveEnd( $MoveEnd ) {$this->MoveEnd = $MoveEnd; $this->markDirty();}   
	function getMoveEnd( ) {return $this->MoveEnd;}
	
	function setKey( $Key ) {$this->Key = $Key;$this->markDirty();}   
	function getKey( ) {return $this->Key;}	
	
	function toJSON(){
		$json = array(
			'Id' 		=> $this->getId(),
			'Name'		=> $this->getName(),	
		 	'Time'		=> $this->getTime(),
			'MoveStart'	=> $this->getMoveStart(),
			'MoveEnd'	=> $this->getMoveEnd(),
			'Key'		=> $this->getKey()			
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 		= $Data[0];
		$this->Name 	= $Data[1];		
		$this->Time 	= $Data[2];
		$this->MoveStart= $Data[3];
		$this->MoveEnd	= $Data[4];		
		$this->Key		= $Data[5];
    }
			
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	function getDetailAll(){
		$mCBMDetail = new \MVC\Mapper\CBMDetail();
		$DetailAll = $mCBMDetail->findBy(array($this->getId()));
		return $DetailAll;
	}
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------			
	function getURLView(){return "/tien-ich/co-tuong/van/".$this->getKey();}
	
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	
}
?>