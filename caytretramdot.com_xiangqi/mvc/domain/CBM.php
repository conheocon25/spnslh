<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class CBM extends Object{

    private $Id;
	private $IdCategory;
	private $Name;
	private $Time;
	private $MoveStart;
	private $MoveEnd;
	private $Key;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $IdCategory=null, $Name=null, $Time=0, $MoveStart=null,  $MoveEnd=null, $Key=0){
		$this->Id 			= $Id;
		$this->IdCategory 	= $IdCategory;
		$this->Name 		= $Name; 		
		$this->Time 		= $Time;
		$this->MoveStart	= $MoveStart;
		$this->MoveEnd		= $MoveEnd;
		$this->Key 			= $Key;
		
		parent::__construct( $Id );
	}
    function getId() {return $this->Id;}	
	
	function setIdCategory( $IdCategory ) {$this->IdCategory = $IdCategory;$this->markDirty();}   
	function getIdCategory( ) {return $this->IdCategory;}
	function getCategory( ) {
		$mCategoryBoard = new \MVC\Mapper\CategoryBoard();
		$Category = $mCategoryBoard->find($this->IdCategory);
		return $Category;
	}
	
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
        $this->Id 			= $Data[0];
		$this->IdCategory 	= $Data[1];
		$this->Name 		= $Data[2];		
		$this->Time 		= $Data[3];
		$this->MoveStart	= $Data[4];
		$this->MoveEnd		= $Data[5];		
		$this->Key			= $Data[6];
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
	function getURLView(){return "/van-co/".$this->getCategory()->getKey()."/".$this->getKey();}
	function getURLSetting(){return "/admin/board/".$this->getIdCategory()."/".$this->getId();}
	function getURLSettingComposeExe(){return "/admin/board/".$this->getIdCategory()."/".$this->getId()."/compose/exe";}
	
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	
}
?>