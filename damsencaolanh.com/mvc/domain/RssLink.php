<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class RssLink extends Object{

    private $Id;	
	private $IdTag;
	private $Name;
	private $Weburl;
	private $Rssurl;
	private $Type;
	private $Enable;
	private $ClassContentName;
	private $ClassAuthor;
	private $ImgPath;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $IdTag=null,$Name=null, $Weburl=null, $Rssurl=null, $Type=null, $Enable=null, $ClassContentName=null, $ClassAuthor=null, $ImgPath=null){
		$this->Id 			= $Id;		
		$this->IdTag 		= $IdTag; 
		$this->Name 		= $Name; 
		$this->Weburl 		= $Weburl;
		$this->Rssurl		= $Rssurl;
		$this->Type 		= $Type;
		$this->Enable 		= $Enable;
		$this->ClassContentName		= $ClassContentName;
		$this->ClassAuthor 			= $ClassAuthor;
		$this->ImgPath 				= $ImgPath;
		
		parent::__construct( $Id );
	}
    function getId() {return $this->Id;}	
		
    function setIdTag( $IdTag ) {$this->IdTag = $IdTag;$this->markDirty();}   
	function getIdTag( ) {return $this->IdTag;} 
	
	function setName( $Name ) {$this->Name = $Name;$this->markDirty();}   
	function getName( ) {return $this->Name;}
	
	function setWeburl( $Weburl ) {$this->Weburl = $Weburl;$this->markDirty();}   
	function getWeburl( ) {return $this->Weburl;}
	
	
	function setRssurl( $Rssurl ) {$this->Rssurl = $Rssurl;$this->markDirty();}   
	function getRssurl( ) {return $this->Rssurl;}
	
	function setType( $Type ) {$this->Type = $Type;$this->markDirty();}   
	function getType( ) {return $this->Type;}
	
	function setClassContentName( $ClassContentName ) {$this->ClassContentName = $ClassContentName;$this->markDirty();}   
	function getClassContentName( ) {return $this->ClassContentName;}
	
	function setClassAuthor( $ClassAuthor ) {$this->ClassAuthor = $ClassAuthor;$this->markDirty();}   
	function getClassAuthor( ) {return $this->ClassAuthor;}
	
	function setImgPath( $ImgPath ) {$this->ImgPath = $ImgPath;$this->markDirty();}   
	function getImgPath( ) {return $this->ImgPath;}
	
	function getCategoryVideo( ) {
		$mTag = new \MVC\Mapper\Tag();
		$dTag = $mTag->find($this->IdTag);
		return $dTag;
	}
	
	function setEnable( $Enable ) {$this->Enable = $Enable;$this->markDirty();}   
	function getEnable( ) {return $this->Enable;}
	
	function getEnablePrint( ) {
		if ($this->Enable == 1)	return "Áp Dụng";
		else return "Không áp dụng";
	}
	
	
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),			
			'IdTag'			=> $this->IdTag(),
			'Name'			=> $this->getName(),
			'Weburl'		=> $this->getWeburl(),
			'Rssurl' 		=> $this->getRssurl(),
		 	'Type'			=> $this->getType(),
			'Enable'		=> $this->getEnable()			
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->IdTag 		= $Data[1];
		$this->Name 		= $Data[2];
		$this->Weburl 		= $Data[3];
		$this->Rssurl		= $Data[4];
		$this->Type 		= $Data[5];
		$this->Enable	 	= $Data[6];
    }
			
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLView(){return "/rss/".$this->getKey();}
	function getURLGetNewsRss(){return "admin/setting/news/getnewsrss/".$this->getId();}
	function getURLUpdLoad(){return "/admin/setting/rss/".$this->getId()."/upd/load";}	
	function getURLUpdExe()	{return "/admin/setting/rss/".$this->getId()."/upd/exe";}
	//-------------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}	
}
?>