<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class CategoryAds extends Object{

    private $Id;
	private $Name;	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $Name=null) {
        $this->Id = $Id;		
		$this->Name = $Name;
        parent::__construct( $Id );
    }
    function getId() {return $this->Id;}		
		
    function setName( $Name ) {$this->Name = $Name;$this->markDirty();}   
	function getName( ) {return $this->Name;}
		
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	function getAdsAll(){
		$mAds = new \MVC\Mapper\Ads();
		$AdsAll = $mAds->findBy(array($this->getId()));
		return $AdsAll;
	}
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLRead(){return "/ads/".$this->getId();}		
	function getURLView(){return "/setting/category/ads/".$this->getId();}
	function getURLUpdLoad(){return "/setting/category/ads/".$this->getId()."/upd/load";}
	function getURLUpdExe(){return "/setting/category/ads/".$this->getId()."/upd/exe";}
	
	function getURLDelLoad(){return "/setting/category/ads/".$this->getId()."/del/load";}
	function getURLDelExe(){return "/setting/category/ads/".$this->getId()."/del/exe";}
	
	function getURLDetailInsLoad(){return "/setting/category/ads/".$this->getId()."/ins/load";}
	function getURLDetailInsExe(){return "/setting/category/ads/".$this->getId()."/ins/exe";}
			
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}	
	
}
?>
