<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Board extends Object{
    private $Id;
	private $IdChapter;
	private $Name;	
	private $Time;
	private $Info;
	private $MoveStart;
	private $MoveEnd;
	private $Key;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $IdChapter=null, $Name=null, $Time=null, $Info=null, $MoveStart=null,  $MoveEnd=null, $Key=null){
		$this->Id 			= $Id;
		$this->IdChapter 	= $IdChapter;
		$this->Name 		= $Name; 		
		$this->Time 		= $Time;
		$this->Info			= $Info;
		$this->MoveStart	= $MoveStart;
		$this->MoveEnd		= $MoveEnd;
		$this->Key 			= $Key;
		
		parent::__construct( $Id );
	}
    function getId() {return $this->Id;}	
	
	function setIdChapter( $IdChapter ) {$this->IdChapter = $IdChapter;$this->markDirty();}   
	function getIdChapter( ) {return $this->IdChapter;}
	function getChapter( ) {
		$mChapter 	= new \MVC\Mapper\Chapter();
		$Chapter 	= $mChapter->find($this->IdChapter);
		return $Chapter;
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
			'IdChapter' => $this->getIdChapter(),
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
		$this->IdChapter 	= $Data[1];
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
		$mBoardDetail = new \MVC\Mapper\BoardDetail();
		$DetailAll = $mBoardDetail->findBy(array($this->getId()));
		return $DetailAll;
	}
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------			
	function getURLView(){return "/van-co/".$this->getCategory()->getKey()."/".$this->getKey();}
			
	function getURLUpdLoad(){
		$Chapter  	= $this->getChapter();
		$Book 		= $Chapter->getBook();
		$Category	= $Book->getCategory();
		return "/admin/book/".$Category->getId()."/".$Book->getId()."/chapter/".$Chapter->getId()."/board/".$this->getId()."/upd/load";
	}
	
	function getURLUpdExe(){
		$Chapter  	= $this->getChapter();
		$Book 		= $Chapter->getBook();
		$Category	= $Book->getCategory();		
		return "/admin/book/".$Category->getId()."/".$Book->getId()."/chapter/".$Chapter->getId()."/board/".$this->getId()."/upd/exe";
	}
	
	function getURLSettingPoseLoad(){
		$Chapter  	= $this->getChapter();
		$Book 		= $Chapter->getBook();
		$Category	= $Book->getCategory();
		return "/admin/book/".$Category->getId()."/".$Book->getId()."/chapter/".$Chapter->getId()."/board/".$this->getId()."/pose/load";
	}
	
	function getURLSettingPoseExe(){
		$Chapter  	= $this->getChapter();
		$Book 		= $Chapter->getBook();
		$Category	= $Book->getCategory();
		return "/admin/book/".$Category->getId()."/".$Book->getId()."/chapter/".$Chapter->getId()."/board/".$this->getId()."/pose/exe";
	}
	
		
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	
}
?>