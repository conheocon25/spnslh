<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class CBM extends Object{
    private $Id;
	private $IdCategory;
	private $Name;	
	private $Time;
	private $Info;
	private $MoveStart;
	private $MoveEnd;
	private $Key;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $IdCategory=null, $Name=null, $Time=null, $Info=null, $MoveStart=null,  $MoveEnd=null, $Key=null){
		$this->Id 			= $Id;
		$this->IdCategory 	= $IdCategory;
		$this->Name 		= $Name; 		
		$this->Time 		= $Time;
		$this->Info			= $Info;
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
	
	function setInfo( $Info) {$this->Info = $Info; $this->markDirty();}   
	function getInfo( ) {return $this->Info;}
			
	function setTime( $Time ) {$this->Time = $Time;$this->markDirty();}   
	function getTime( ) {return $this->Time;}	
	
	function setMoveStart( $MoveStart ) {$this->MoveStart = $MoveStart;$this->markDirty();}   
	function getMoveStart( ) {return $this->MoveStart;}
	
	function setMoveEnd( $MoveEnd ) {$this->MoveEnd = $MoveEnd; $this->markDirty();}   
	function getMoveEnd( ) {return $this->MoveEnd;}
	
	function setKey( $Key ){$this->Key = $Key;$this->markDirty();}
	function getKey( ) {return $this->Key;}
	function reKey( ){
		if (!isset($this->Id))
			$Id = time();
		else
			$Id = $this->Id;
			
		$Str = new \MVC\Library\String($this->Name." ".$Id);
		$this->Key = $Str->converturl();		
	}	
	function getInfoReduce(){$S = new \MVC\Library\String($this->Info);return $S->reduceHTML(320);}
	
	function toJSON(){
		$json = array(
			'Id' 		=> $this->getId(),
			'Name'		=> $this->getName(),	
		 	'Time'		=> $this->getTime(),
			'Info'		=> $this->getInfo(),
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
		$this->Info 		= $Data[4];
		$this->MoveStart	= $Data[5];
		$this->MoveEnd		= $Data[6];		
		$this->Key			= $Data[7];
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
	
	function getURLSettingPose(){return "/admin/board/".$this->getIdCategory()."/".$this->getId()."/pose";}
	function getURLSettingPoseExe(){return "/admin/board/".$this->getIdCategory()."/".$this->getId()."/pose/exe";}
	
	function getURLUpdLoad(){	return "admin/board/".$this->getIdCategory()."/".$this->getId()."/upd/load";}
	function getURLUpdExe(){	return "admin/board/".$this->getIdCategory()."/".$this->getId()."/upd/exe";}
	
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	
}
?>