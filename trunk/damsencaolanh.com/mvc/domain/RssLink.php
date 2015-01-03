<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class RssLink extends Object{

    private $Id;	
	private $IdCategory;
	private $Name;
	private $Weburl;
	private $Rssurl;
	private $Type;
	private $Enable;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $IdCategory=null,$Name=null, $Weburl=null, $Rssurl=null, $Type=null, $Enable=null){
		$this->Id 			= $Id;		
		$this->IdCategory 	= $IdCategory; 
		$this->Name 		= $Name; 
		$this->Weburl 		= $Weburl;
		$this->Rssurl		= $Rssurl;
		$this->Type 		= $Type;
		$this->Enable 		= $Enable;
		
		parent::__construct( $Id );
	}
    function getId() {return $this->Id;}	
		
    function setIdCategory( $IdCategory ) {$this->IdCategory = $IdCategory;$this->markDirty();}   
	function getIdCategory( ) {return $this->IdCategory;} 
	
	function setName( $Name ) {$this->Name = $Name;$this->markDirty();}   
	function getName( ) {return $this->Name;}
	
	function setWeburl( $Weburl ) {$this->Weburl = $Weburl;$this->markDirty();}   
	function getWeburl( ) {return $this->Weburl;}
	
	
	function setRssurl( $Rssurl ) {$this->Rssurl = $Rssurl;$this->markDirty();}   
	function getRssurl( ) {return $this->Rssurl;}
	
	function setType( $Type ) {$this->Type = $Type;$this->markDirty();}   
	function getType( ) {return $this->Type;}
	
	function getCategoryVideo( ) {
		$mCategoryNews = new \MVC\Mapper\CategoryNews();
		$dCategoryVideo = $mCategoryNews->find($this->IdCategory);
		return $dCategoryVideo;
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
			'IdCategory'	=> $this->IdCategory(),
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
		$this->IdCategory 	= $Data[1];
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
	function getURLGetNewsRss(){return "app/news/getnewsrss/".$this->getId();}
	function getURLUpdLoad(){return "/app/rss/".$this->getId()."/upd/load";}	
	function getURLUpdExe()	{return "/app/rss/".$this->getId()."/upd/exe";}
	//-------------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}	
}
?>