<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Ads extends Object{

    private $Id;
	private $IdCategory;
	private $Name;
	private $Date;
	private $Content;
	private $Logo;
	private $Key;
		
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 	$Id=null, 
							$IdCategory=Null,
							$Name=Null, 							
							$Date=Null, 
							$Content=null, 							
							$Logo=null,
							$Key=null)
	{
        $this->Id = $Id;				
		$this->IdCategory = $IdCategory;
		$this->Name = $Name;
		$this->Date = $Date;
		$this->Content = $Content;
		$this->Logo = $Logo;
		$this->Key = $Key;
		
        parent::__construct( $Id );
    }
	function setId($Id) {
        $this->Id = $Id;
    }	
    function getId() {return $this->Id;}	

	function setIdCategory( $IdCategory ) {$this->IdCategory= $IdCategory;$this->markDirty();}   
	function getIdCategory( ) {return $this->IdCategory;}
	
	function setName( $Name ) {$this->Name= $Name;$this->markDirty();}   
	function getName( ) {return $this->Name;}
	
	function setDate( $Date ){$this->Date = $Date;$this->markDirty();}   
	function getDate( ) {return $this->Date;}
	function getDatePrint( ){$D = new \MVC\Library\Date($this->Date);return $D->getDateFormat();}
	
	function setContent( $Content ){$this->Content = $Content;$this->markDirty();}   
	function getContent( ) {return $this->Content;}
	
	function setLogo( $Logo ){$this->Logo = $Logo;$this->markDirty();}   
	function getLogo( ) {return $this->Logo;}
	
	function setKey( $Key ) {$this->Key = $Key;$this->markDirty();}
	function getKey( ) {return $this->Key;}
	function reKey( ) {
		$Str = new \MVC\Library\String($this->Name);
		$this->Key = $Str->converturl();
	}
		
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
		
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLRead(){return "/ads/".$this->getIdCategory()."/".$this->getId();}	
	function getURLUpdLoad(){return "/setting/category/ads/".$this->getIdCategory()."/".$this->getId()."/upd/load";}
	function getURLUpdExe(){return "/setting/category/ads/".$this->getIdCategory()."/".$this->getId()."/upd/exe";}	
	function getURLDelLoad(){return "/setting/category/ads/".$this->getIdCategory()."/".$this->getId()."/del/load";}	
	function getURLDelExe(){return "/setting/category/ads/".$this->getIdCategory()."/".$this->getId()."/del/exe";}
			
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	
}
?>