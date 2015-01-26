<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Board extends Object{
    private $Id;
	private $IdChapter;
	private $Name;
	private $State;
	private $Time;
	private $Info;
	private $MoveInit;	
	private $MoveStart;
	private $MoveEnd;
	private $Round;
	private $Result;
	private $Key;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------		
    function __construct( 
		$Id=null, 
		$IdChapter=null, 
		$Name=null, 
		$State=null, 
		$Time=null, 
		$Info=null, 
		$MoveInit=null,  
		$MoveStart=null, 
		$MoveEnd=null, 
		$Round=null, 
		$Result=null, 
		$Key=null)
	{
		
		$this->Id 			= $Id;
		$this->IdChapter 	= $IdChapter;
		$this->Name 		= $Name;
		$this->State 		= $State; 
		$this->Time 		= $Time;
		$this->Info			= $Info;
		$this->MoveInit		= $MoveInit;
		$this->MoveStart	= $MoveStart;
		$this->MoveEnd		= $MoveEnd;
		$this->Result		= $Result;
		$this->Round		= $Round;
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
	
    function setName( $Name ) 	{$this->Name = $Name;$this->markDirty();}   
	function getName( ) 		{return $this->Name;}
	function getNameReduce( ) {		
		$S = new \MVC\Library\String($this->Name);return $S->reduceHTML(32);
	}
	
	function setState( $State ) {$this->State = $State;$this->markDirty();}   
	function getState( ) 		{return $this->State;}
	
	function setInfo( $Info) {$this->Info = $Info; $this->markDirty();}   
	function getInfo( ) {return $this->Info;}
			
	function setTime( $Time ) {$this->Time = $Time;$this->markDirty();}   
	function getTime( ) {return $this->Time;}	
	
	function setMoveInit( $MoveInit ) {$this->MoveInit = $MoveInit;$this->markDirty();}   
	function getMoveInit( ) {return $this->MoveInit;}
	
	function setMoveStart( $MoveStart ) {$this->MoveStart = $MoveStart;$this->markDirty();}   
	function getMoveStart( ) {return $this->MoveStart;}
	
	function setMoveEnd( $MoveEnd ) {$this->MoveEnd = $MoveEnd; $this->markDirty();}   
	function getMoveEnd( ) {return $this->MoveEnd;}
	
	//Xanh hay Đỏ đi trước !?
	function setRound( $Round ) {$this->Round = $Round; $this->markDirty();}   
	function getRound( ) {return $this->Round;}
	function getRoundPrint( ){
		if ($this->Round>0) return "Đỏ đi trước";
		return "Xanh đi trước";
	}
	
	//Kết quả: Đỏ thắng - hòa - thua !?
	function setResult( $Result ) {$this->Result = $Result; $this->markDirty();}   
	function getResult( ) {return $this->Result;}
	function getResultPrint( ) {
		if ($this->Result==0) return "Hòa";
		else if ($this->Result<0) return "Đỏ thắng";
		return "Đỏ thua";				
	}
	
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
			'State'		=> $this->getState(),
		 	'Time'		=> $this->getTime(),
			'Info'		=> $this->getInfo(),
			'MoveInit'	=> $this->getMoveInit(),
			'MoveStart'	=> $this->getMoveStart(),
			'MoveEnd'	=> $this->getMoveEnd(),
			'Round'		=> $this->getRound(),
			'Result'	=> $this->getResult(),
			'Key'		=> $this->getKey()			
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->IdChapter 	= $Data[1];
		$this->Name 		= $Data[2];		
		$this->State 		= $Data[3];
		$this->Time 		= $Data[4];
		$this->Info 		= $Data[5];
		$this->MoveInit		= $Data[6];
		$this->MoveStart	= $Data[7];
		$this->MoveEnd		= $Data[8];		
		$this->Round		= $Data[9];
		$this->Result		= $Data[10];
		$this->Key			= $Data[11];
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
	function getURLView(){
		$Chapter  	= $this->getChapter();
		$Book 		= $Chapter->getBook();
		$Category	= $Book->getCategory();
		return "/sach/".$Category->getKey()."/".$Book->getKey()."/".$Chapter->getKey()."/".$this->getKey();
	}
	
	function getURLDetail(){
		$Chapter  	= $this->getChapter();
		$Book 		= $Chapter->getBook();
		$Category	= $Book->getCategory();
		return "/admin/book/".$Category->getId()."/".$Book->getId()."/chapter/".$Chapter->getId()."/board/".$this->getId()."/detail";
	}
	
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
	
	function getURLSettingStateLoad(){
		$Chapter  	= $this->getChapter();
		$Book 		= $Chapter->getBook();
		$Category	= $Book->getCategory();
		return "/admin/book/".$Category->getId()."/".$Book->getId()."/chapter/".$Chapter->getId()."/board/".$this->getId()."/state/load";
	}
	
	function getURLSettingStateExe(){
		$Chapter  	= $this->getChapter();
		$Book 		= $Chapter->getBook();
		$Category	= $Book->getCategory();
		return "/admin/book/".$Category->getId()."/".$Book->getId()."/chapter/".$Chapter->getId()."/board/".$this->getId()."/state/exe";
	}
		
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	
}
?>