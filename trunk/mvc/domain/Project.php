<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Project extends Object{

    private $Id;
	private $IdCategory;
	private $Date;
	private $Content;
	private $Title;
	private $Type;
	private $URLPrice;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $IdCategory=null , $Date=Null, $Content=null, $Title=null, $Type=null, $URLPrice=null){
        $this->Id = $Id;
		$this->IdCategory = $IdCategory;
		$this->Date = $Date;
		$this->Content = $Content;
		$this->Title = $Title;
		$this->Type = $Type;
		$this->URLPrice = $URLPrice;
		
        parent::__construct( $Id );
    }
    function getId() {return $this->Id;}	
		
    function setIdCategory( $IdCategory ) {$this->IdCategory = $IdCategory;$this->markDirty();}   
	function getIdCategory( ) {return $this->IdCategory;}
	function getCategory(){$mCategory = new \MVC\Mapper\CategoryProject();$Category = $mCategory->find($this->getIdCategory());return $Category;}
			
	function setDate( $Date ){$this->Date = $Date;$this->markDirty();}   
	function getDate( ) {return $this->Date;}
	function getDatePrint( ){$D = new \MVC\Library\Date($this->Date);return $D->getDateFormat();}
	
	function setContent( $Content ){$this->Content = $Content;$this->markDirty();}   
	function getContent( ) {return $this->Content;}
	function getContentReduce( ){$S = new \MVC\Library\String($this->Content);return $S->reduceHTML(350);}
	
	function setTitle( $Title ){$this->Title = $Title;$this->markDirty();}   
	function getTitle( ) {return $this->Title;}
	
	function setType( $Type ){$this->Type = $Type;$this->markDirty();}   
	function getType( ) {return $this->Type;}
	function isVIP(){if ($this->Type == 1)return true;return false;}
	
	function getImage(){		
		$first_img = '';
		\ob_start();
		\ob_end_clean();
		if(preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $this->Content, $matches)){
			$first_img = $matches[1][0];
		}
		else {
			$first_img = "/data/images/no_image.png";
		}
		return $first_img;
	}
	
	function setURLPrice( $URLPrice ){$this->URLPrice = $URLPrice;$this->markDirty();}   
	function getURLPrice( ) {return $this->URLPrice;}
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	function getNews(){
		$mNews = new \MVC\Mapper\NewsProject();
		$NewsAll = $mNews->findBy(array($this->getId()));
		return $NewsAll;
	}
	
	function getDocs(){
		$mDoc = new \MVC\Mapper\ProjectDoc();
		$DocAll = $mDoc->findBy(array($this->getId()));
		return $DocAll;
	}
	
	function getAlbums(){
		$mAlbum = new \MVC\Mapper\ProjectAlbum();
		$AlbumAll = $mAlbum->findBy(array($this->getId()));
		return $AlbumAll;
	}
	function getVideos(){
		$mVideo = new \MVC\Mapper\ProjectVideo();
		$VideoAll = $mVideo->findBy(array($this->getId()));
		return $VideoAll;
	}
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLRead(){return "/project/".$this->getIdCategory()."/".$this->getId();}
	
	function getURLUpdLoad(){return "/setting/category/project/".$this->getIdCategory()."/".$this->getId()."/upd/load";}
	function getURLUpdExe(){return "/setting/category/project/".$this->getIdCategory()."/".$this->getId()."/upd/exe";}
	
	function getURLDelLoad(){return "/setting/category/project/".$this->getIdCategory()."/".$this->getId()."/del/load";}	
	function getURLDelExe(){return "/setting/category/project/".$this->getIdCategory()."/".$this->getId()."/del/exe";}
	
	function getURLNewsView(){return "/setting/category/project/".$this->getIdCategory()."/".$this->getId()."/news";}
	function getURLNewsInsLoad(){return "/setting/category/project/".$this->getIdCategory()."/".$this->getId()."/news/ins/load";}
	function getURLNewsInsExe(){return "/setting/category/project/".$this->getIdCategory()."/".$this->getId()."/news/ins/exe";}
	
	function getURLAlbumSetting(){return "/setting/category/project/".$this->getIdCategory()."/".$this->getId()."/album";}
	function getURLAlbumSettingInsLoad(){return "/setting/category/project/".$this->getIdCategory()."/".$this->getId()."/album/ins/load";}
	function getURLAlbumSettingInsExe(){return "/setting/category/project/".$this->getIdCategory()."/".$this->getId()."/album/ins/exe";}
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	
}
?>