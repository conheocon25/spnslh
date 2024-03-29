<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Book extends Object{

    private $Id;
	private $IdCategory;
	private $IdPresentation;
	private $Title;
	private $Time;
	private $Info;
	private $Author;
	private $Language;	
	private $Order;
	private $URL;
	private $Viewed;
	private $Liked;
	private $Thumb;
	private $Completed;
	private $Key;
		
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id=null, 
		$IdCategory=null, 
		$IdPresentation=null, 
		$Title=null , 
		$Time=null, 
		$Info=null, 
		$Author=null, 
		$Language=null , 
		$Order=null, 
		$URL=null, 
		$Viewed=null, 
		$Liked=null, 
		$Thumb=null, 
		$Completed=null, 
		$Key=null) 
	{
		$this->Id 				= $Id; 
		$this->IdCategory 		= $IdCategory; 
		$this->IdPresentation 	= $IdPresentation; 
		$this->Title 			= $Title; 
		$this->Time 			= $Time; 
		$this->Info 			= $Info;
		$this->Author 			= $Author; 
		$this->Language 		= $Language; 
		$this->Order 			= $Order;
		$this->URL 				= $URL;
		$this->Viewed 			= $Viewed;
		$this->Liked 			= $Liked;
		$this->Thumb 			= $Thumb;
		$this->Completed 		= $Completed;
		$this->Key 				= $Key;
		
		parent::__construct( $Id );
	}
    function getId() {return $this->Id;}
		
	function setIdCategory( $IdCategory ) {$this->IdCategory = $IdCategory;$this->markDirty();}
	function getIdCategory( ) {return $this->IdCategory;}
	function getCategory( ) {
		$mCategory 	= new \MVC\Mapper\CategoryBook();
		$Category 	= $mCategory->find($this->IdCategory);
		return $Category;
	}
	
	function setIdPresentation( $IdPresentation ) {$this->IdPresentation = $IdPresentation;$this->markDirty();}
	function getIdPresentation( ) {return $this->IdPresentation;}
	function getPresentation(){
		$mPresentation = new \MVC\Mapper\Presentation();		
		if ($this->IdPresentation == 0){
			$PresentationAll 	= $mPresentation->findAll();	
			$Presentation 		= $PresentationAll->current();
		}else{
			$Presentation = $mPresentation->find($this->IdPresentation);
		}				
		return $Presentation;
	}
		
    function setTitle( $Title ) {$this->Title = $Title;$this->markDirty();}   
	function getTitle( ) {return $this->Title;}
	function getTitleReduce( ) {		
		$S = new \MVC\Library\String($this->Title);return $S->reduceHTML(14);
	}
	
	function setTime( $Time ) {$this->Time = $Time;$this->markDirty();}   
	function getTime( ) {return $this->Time;}
	function getTimePrint( ){		
		$D = new \MVC\Library\Date($this->Time);return $D->getFullDateTimeFormat();
	}
	function getTime1(){		
		$current 	= strtotime(date("Y-m-d H:i:s"));
		$date    	= strtotime($this->Time);

		$datediff 	= $current - $date;
		$Delta 		= floor($datediff/(60));
		return $Delta;
	}
	
	function getTimePrint1(){
		$current 	= strtotime(date("Y-m-d H:i:s"));
		$date    	= strtotime($this->Time);		
		
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
			
			$D 		= floor($D/$Arr2[$Index]);
			$Index ++;
		}
		return $Str;
	}
	
	function setInfo( $Info ) {$this->Info = $Info;$this->markDirty();}   
	function getInfo( ) {return $this->Info;}
	
	function setAuthor( $Author ) {$this->Author = $Author;$this->markDirty();}   
	function getAuthor( ) {return $this->Author;}
	
	function setLanguage( $Language ) {$this->Language = $Language; $this->markDirty();}
	function getLanguage( ) {return $this->Language;}
	
	function setURL( $URL ) {$this->URL = $URL;$this->markDirty();}   
	function getURL( ) {return $this->URL;}
	
	function setOrder( $Order ) {$this->Order = $Order;$this->markDirty();}   
	function getOrder( ) {return $this->Order;}
	
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
	
	function setThumb( $Thumb ) {$this->Thumb = $Thumb; $this->markDirty();}   
	function getThumb( ) 		{
		return $this->Thumb;		
	}
	
	function setCompleted( $Completed ) {$this->Completed = $Completed;$this->markDirty();}   
	function getCompleted( ) {return $this->Completed;}
	
	function getCompletedPercent(){		
		return \round($this->Completed/100, 2);
	}
			
	function getCompletedPercentPrint1(){
		$Value = $this->getCompletedPercent();		
		return 'width:'.($Value*100)."%";
	}
	
	function getCompletedPercentPrint2(){
		$Value = $this->getCompletedPercent();		
		return ($Value*100)."%";
	}
	
	function setKey( $Key ){$this->Key = $Key;$this->markDirty();}
	function getKey( ) {return $this->Key;}
	function reKey( ){
		if (!isset($this->Id))
			$Id = time();
		else
			$Id = $this->Id;
			
		$Str = new \MVC\Library\String($this->Title." ".$Id);
		$this->Key = $Str->converturl();		
	}	
	function getInfoReduce(){$S = new \MVC\Library\String($this->Info);return $S->reduceHTML(320);}
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	function getChapterAll(){
		$mChapter 		= new \MVC\Mapper\Chapter();
		$ChapterAll 	= $mChapter->findBy(array($this->getId()));
		return $ChapterAll;
	}
	
	function reCompleted(){
		$ChapterAll = $this->getChapterAll();				
		$Count = 0;
		while($ChapterAll->valid()){
			$Chapter = $ChapterAll->current();
			$Count += $Chapter->getCompleted();
			$ChapterAll->next();
		}
		if ($ChapterAll->count()==0) $this->Completed = 0; 
		else $this->Completed = \round ($Count/$ChapterAll->count(), 2);
	}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdCategory' 	=> $this->getIdCategory(),
			'IdPresentation'=> $this->getIdPresentation(),
			'Title'			=> $this->getTitle(),
			'Time'			=> $this->getTime(),
			'Info'			=> $this->getInfo(),
		 	'Order'			=> $this->getOrder(),
			'URL'			=> $this->getURL(),
			'Viewed'		=> $this->getViewed(),
			'Liked'			=> $this->getLiked(),
			'Thumb'			=> $this->getThumb(),
			'Completed'		=> $this->getCompleted(),
			'Key'			=> $this->getKey()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 				= $Data[0];
		$this->IdCategory		= $Data[1];
		$this->IdPresentation	= $Data[2];
		$this->Title 			= $Data[3];
		$this->Time 			= $Data[4];
		$this->Info 			= $Data[5];
		$this->Order 			= $Data[6];
		$this->URL 				= $Data[7];
		$this->Viewed			= $Data[8];
		$this->Liked			= $Data[9];
		$this->Thumb			= $Data[10];
		$this->Completed		= $Data[11];
		$this->Key 				= $Data[12];
    }
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------	
	function getURLView()		{return "/sach/".$this->getCategory()->getKey()."/".$this->getKey();}
	function getURLViewFull()	{return "http://cotuong.caytretramdot.com/sach/".$this->getCategory()->getKey()."/".$this->getKey();}

	function getURLUpdLoad(){	return "admin/book/".$this->getIdCategory()."/".$this->getId()."/upd/load";}
	function getURLUpdExe(){	return "admin/book/".$this->getIdCategory()."/".$this->getId()."/upd/exe";}
	
	function getURLSettingChapter()			{	return "admin/book/".$this->getIdCategory()."/".$this->getId()."/chapter";}
	function getURLSettingChapterInsLoad()	{	return "admin/book/".$this->getIdCategory()."/".$this->getId()."/chapter/ins/load";}
	function getURLSettingChapterInsExe()	{	return "admin/book/".$this->getIdCategory()."/".$this->getId()."/chapter/ins/exe";}
	
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
}
?>