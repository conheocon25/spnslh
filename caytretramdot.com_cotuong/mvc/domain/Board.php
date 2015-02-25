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
	private $Viewed;
	private $Liked;
	private $Sub;
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
		$Viewed=null, 
		$Liked=null, 
		$Sub=null, 
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
		$this->Viewed		= $Viewed;
		$this->Liked		= $Liked;
		$this->Sub			= $Sub;
		$this->Key 			= $Key;
		
		parent::__construct( $Id );
	}
	function setId($Id) {$this->Id = $Id;}
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
		$S = new \MVC\Library\String($this->Name);return $S->reduceHTML(14);
	}
	
	function getThumb( ){return "/data/chess/150/BoardThumb.jpg";}
	
	function setState( $State ) {$this->State = $State;$this->markDirty();}   
	function getState( ){		
		return $this->State;			
	}
	
	function setInfo( $Info) {$this->Info = $Info; $this->markDirty();}   
	function getInfo( ) {return $this->Info;}
			
	function setTime( $Time ) {$this->Time = $Time;$this->markDirty();}   
	function getTime( ) {return $this->Time;}
	function getTimePrint1(){
		$current 	= strtotime(date("Y-m-d H:i:s"));
		$date    	= strtotime($this->Time);
		if ($this->Time=="0000-00-00 00:00:00"){
			$date = strtotime(date("Y-m-d H:i:s"));
		}
		
		$Str 		= "";
		$Arr1		= array("giây"	, "phút"	, "giờ"	, "ngày", "tháng"	, "năm");
		$Arr2		= array(60		, 60		, 24	, 30	, 12		, 1);
		$Index		= 0;
		$D 			= $current - $date;
		
		while ($D>0){
			if ($Index>2)
				$Str	= ($D%$Arr2[$Index]). " ". $Arr1[$Index]." hơn";
			else
				$Str	= ($D%$Arr2[$Index]). " ". $Arr1[$Index]." ".$Str;
			
			//if ($Arr2[$Index]==0) $D = -1;			
			$D 		= floor($D/$Arr2[$Index]);
			$Index ++;
		}
		return $Str;
	}
	
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
		if ($this->Round>0) return "Xanh đi trước";
		return "Đỏ đi trước";
	}
	
	//Kết quả: Đỏ thắng - hòa - thua !?
	function setResult( $Result ) {$this->Result = $Result; $this->markDirty();}   
	function getResult( ) {return $this->Result;}
	function getResultPrint( ) {
		if ($this->Result==0) return "Hòa";
		else if ($this->Result<0) return "Đỏ thắng";
		return "Đỏ thua";				
	}
	
	function setViewed( $Viewed ) 	{$this->Viewed = $Viewed; $this->markDirty();}   
	function getViewed( ) 			{return $this->Viewed;}
	function getViewedPrint( ){
		$N= new \MVC\Library\Number($this->Viewed);
		return $N->formatCurrency();
	}
	
	function setLiked( $Liked ) 	{$this->Liked = $Liked; $this->markDirty();}   
	function getLiked( ) 			{return $this->Liked;}
	function getLikedPrint( ){		
		$N= new \MVC\Library\Number($this->Liked);
		return $N->formatCurrency();
	}
	
	function setSub( $Sub ){$this->Sub = $Sub;$this->markDirty();}
	function getSub( ) {return $this->Sub;}
	
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
			'Viewed'	=> $this->getViewed(),
			'Liked'		=> $this->getLiked(),
			'Sub'		=> $this->getSub(),
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
		$this->Viewed		= $Data[11];
		$this->Liked		= $Data[12];
		$this->Sub			= $Data[13];
		$this->Key			= $Data[14];
    }
			
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	function getParent(){
		$mBoardSub 	= new \MVC\Mapper\BoardSub();
		$SubAll = $mBoardSub->findByMe(array($this->getId()));
		return $SubAll->current()->getBoardParent();
	}
		
	function getRelatedAll(){
		$mBoard 	= new \MVC\Mapper\Board();
		$BoardAll 	= $mBoard->findByRelated(array($this->getIdChapter(), $this->getId(), $this->getId(), $this->getId()));
		return $BoardAll;
	}
	
	function getDetailAll(){
		$mBoardDetail = new \MVC\Mapper\BoardDetail();
		$DetailAll = $mBoardDetail->findBy(array($this->getId()));
		return $DetailAll;
	}
	
	function getBTAll(){
		$mBoardTag 	= new \MVC\Mapper\BoardTag();
		$BTAll 		= $mBoardTag->findByBoard(array($this->getId()));
		return $BTAll;
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
	
	function getURLShare(){
		$Chapter  	= $this->getChapter();
		$Book 		= $Chapter->getBook();
		$Category	= $Book->getCategory();
		return "http://cotuong.caytretramdot.com/sach/".$Category->getKey()."/".$Book->getKey()."/".$Chapter->getKey()."/".$this->getKey();
	}
	
	function getURLDetail(){
		$Chapter  	= $this->getChapter();
		$Book 		= $Chapter->getBook();
		$Category	= $Book->getCategory();
		return "/admin/book/".$Category->getId()."/".$Book->getId()."/chapter/".$Chapter->getId()."/board/".$this->getId()."/detail";
	}
	
	function getURLTag(){
		$Chapter  	= $this->getChapter();
		$Book 		= $Chapter->getBook();
		$Category	= $Book->getCategory();
		return "/admin/book/".$Category->getId()."/".$Book->getId()."/chapter/".$Chapter->getId()."/board/".$this->getId()."/detail/tag";
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
	
	function getURLSettingPreExe(){
		$Chapter  	= $this->getChapter();
		$Book 		= $Chapter->getBook();
		$Category	= $Book->getCategory();
		return "/admin/book/".$Category->getId()."/".$Book->getId()."/chapter/".$Chapter->getId()."/board/".$this->getId()."/pre/exe";
	}
		
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	
}
?>