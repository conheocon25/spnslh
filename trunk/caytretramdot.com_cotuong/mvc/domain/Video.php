<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Video extends Object{

    private $Id;
	private $IdCategory;
	private $Title;	
	private $Info;
	private $Time;
	private $IdYouTube;
	private $Viewed;
	private $Liked;
	private $Key;
		
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id			=null, 
		$IdCategory	=null, 
		$Title		=null , 		
		$Info		=null, 
		$Time		=null, 
		$IdYouTube	=null, 				
		$Viewed		=null, 		
		$Liked		=null,
		$Key		=null)
	{
		$this->Id 			= $Id;
		$this->IdCategory 	= $IdCategory;
		$this->Title 		= $Title; 
		$this->Info 		= $Info;
		$this->Time 		= $Time;
		$this->IdYouTube	= $IdYouTube;
		$this->Liked		= $Liked;
		$this->Viewed		= $Viewed;
		$this->Key 			= $Key;
		
		parent::__construct( $Id );
	}
    function getId() {return $this->Id;}
		
	function setIdCategory( $IdCategory ) {$this->IdCategory = $IdCategory;$this->markDirty();}
	function getIdCategory( ) {return $this->IdCategory;}
	function getCategory( ) {
		$mCategory	= new \MVC\Mapper\CategoryVideo();
		$Category= $mCategory->find($this->IdCategory);
		return $Category;
	}
	
    function setTitle( $Title ) {$this->Title = $Title;$this->markDirty();}   
	function getTitle( ) {return $this->Title;}
	function getTitleReduce( ) {		
		$S = new \MVC\Library\String($this->Title);return $S->reduceHTML(14);
	}
			
	function setInfo( $Info ) {$this->Info = $Info;$this->markDirty();}   
	function getInfo( ) {return $this->Info;}
	function getInfoReduce(){
		$S = new \MVC\Library\String($this->Info);
		return $S->reduceHTML(320);
	}
	
	function setTime( $Time ){$this->Time = $Time;$this->markDirty();}   
	function getTime( ) {return $this->Time;}
	function getTimePrint( ){		
		$D = new \MVC\Library\Date($this->Time);return $D->getFullDateTimeFormat();
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
	
	function setIdYouTube( $IdYouTube ) {$this->IdYouTube = $IdYouTube;$this->markDirty();}   
	function getIdYouTube( ) 			{return $this->IdYouTube;}
	function getYoutubeEmbeded()		{return "http://www.youtube.com/embed/".$this->getIdYouTube();}
	function getImage( ){
		return "http://img.youtube.com/vi/".$this->IdYouTube."/2.jpg";
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
		
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------	
	function getBoardAll(){
		$mBoard 	= new \MVC\Mapper\Board();
		$BoardAll 	= $mBoard->findBy(array($this->getId()));
		return $BoardAll;
	}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdCategory' 	=> $this->getIdCategory(),
			'Title'			=> $this->getTitle(),
			'Info'			=> $this->getInfo(),
			'Time'			=> $this->getTime(),
			'Viewed'		=> $this->getViewed(),
			'Liked'			=> $this->getLiked(),
			'Key'			=> $this->getKey()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->IdCategory	= $Data[1];
		$this->Title 		= $Data[2];		
		$this->Info 		= $Data[3];
		$this->Time 		= $Data[4];		
		$this->Viewed 		= $Data[5];		
		$this->Liked		= $Data[6];		
		$this->Key 			= $Data[7];
    }
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------	
	function getURLView(){		
		$Category 	= $this->getCategory();
		return "/video/".$Category->getKey()."/".$this->getKey();
	}
	
	function getURLUpdLoad()		{return "/admin/video/".$this->getCategory()->getId()."/".$this->getId()."/upd/load";	}
	function getURLUpdExe()			{return "/admin/video/".$this->getCategory()->getId()."/".$this->getId()."/upd/exe";	}
	
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
}
?>