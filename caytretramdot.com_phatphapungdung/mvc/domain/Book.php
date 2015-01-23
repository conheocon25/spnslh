<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Book extends Object{

    private $Id;
	private $IdCategory;
	private $Title;
	private $Time;
	private $Info;
	private $Author;
	private $Language;
	private $Order;
	private $URL;
	private $Viewed;
	private $Thumb;
	private $Key;
		
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id=null, 
		$IdCategory=null, 
		$Title=null , 
		$Time=null, 
		$Info=null, 
		$Author=null, 
		$Language=null , 
		$Order=null, 
		$URL=null, 
		$Viewed=null, 
		$Thumb=null, 
		$Key=null) 
	{
		$this->Id 			= $Id; 
		$this->IdCategory 	= $IdCategory; 
		$this->Title 		= $Title; 
		$this->Time 		= $Time; 
		$this->Info 		= $Info;
		$this->Author 		= $Author; 
		$this->Language 	= $Language; 
		$this->Order 		= $Order;
		$this->URL 			= $URL;
		$this->Viewed 		= $Viewed;
		$this->Thumb 		= $Thumb;
		$this->Key 			= $Key;
		
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
	
    function setTitle( $Title ) {$this->Title = $Title;$this->markDirty();}   
	function getTitle( ) {return $this->Title;}
	function getTitleReduce( ) {		
		$S = new \MVC\Library\String($this->Title);return $S->reduceHTML(32);
	}
	
	function setTime( $Time ) {$this->Time = $Time;$this->markDirty();}   
	function getTime( ) {return $this->Time;}
	function getTimePrint( ){		
		$D = new \MVC\Library\Date($this->Time);return $D->getFullDateTimeFormat();
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
	
	function setViewed( $Viewed ) {$this->Viewed = $Viewed; $this->markDirty();}   		
	function getViewed( ) {return $this->Viewed;}
	
	function setThumb( $Thumb ) {$this->Thumb = $Thumb; $this->markDirty();}   
	function getThumb( ) 		{
		if ($this->Thumb=="") return "/data/chess/bg/book.png";
		return $this->Thumb;
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
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdCategory' 	=> $this->getIdCategory(),
			'Title'			=> $this->getTitle(),
			'Time'			=> $this->getTime(),
			'Info'			=> $this->getInfo(),
		 	'Order'			=> $this->getOrder(),
			'URL'			=> $this->getURL(),
			'Viewed'		=> $this->getViewed(),
			'Thumb'			=> $this->getThumb(),
			'Key'			=> $this->getKey()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->IdCategory	= $Data[1];
		$this->Title 		= $Data[2];
		$this->Time 		= $Data[3];
		$this->Info 		= $Data[4];
		$this->Order 		= $Data[5];
		$this->URL 			= $Data[6];
		$this->Viewed		= $Data[7];
		$this->Thumb		= $Data[8];
		$this->Key 			= $Data[9];
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