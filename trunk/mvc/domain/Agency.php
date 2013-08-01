<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Agency extends Object{

    private $Id;
	private $Name;
	private $Phone;
	private $Email;
	private $Password;
	private $Address;
	private $Active;
	private $Key;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $Name=null , $Phone=Null, $Email=Null, $Password=Null, $Address=Null, $Active=Null, $Key=Null) {
        $this->Id = $Id;
		$this->Name = $Name;
		$this->Phone = $Phone;
		$this->Email = $Email;
		$this->Password = $Password;
		$this->Address = $Address;
		$this->Active = $Active;
		$this->Key = $Key;
        parent::__construct( $Id );
    }
    function getId() {return $this->Id;}	
		
    function setName( $Name ) {$this->Name = $Name;$this->markDirty();}
   
	function getName( ) {return $this->Name;}
	
	function setPhone( $Phone ) {$this->Phone = $Phone;$this->markDirty();}   
	function getPhone( ) {return $this->Phone;}
	
	function setEmail( $Email ) {$this->Email = $Email;$this->markDirty();}   
	function getEmail( ){return $this->Email;}
	
	function setAddress( $Address ) {$this->Address = $Address;$this->markDirty();}   
	function getAddress( ){return $this->Address;}
	
	function setPassword( $Password ) {$this->Password = $Password;$this->markDirty();}   
	function getPassword( ){return $this->Password;}
	
	function setActive( $Active ) {$this->Active = $Active;$this->markDirty();}   
	function getActive( ){return $this->Active;}
	
	function setKey( $Key ) {$this->Key = $Key;$this->markDirty();}   
	function getKey( ) {return $this->Key;}
	function reKey( ) {
		$Str = new \MVC\Library\String($this->Name);
		$this->Key = $Str->converturl();
	}
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	function getCategories(){
		$mCategory = new \MVC\Mapper\Category();
		$Categories = $mCategory->findAll();
		return $Categories;
	}
	function getAMs(){
		$mAgencyMarket = new \MVC\Mapper\AgencyMarket();
		$AMs = $mAgencyMarket->findBy( array($this->getId()) );
		return $AMs;
	}
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLRead(){return "/agency/".$this->getId();}
	function getURLView(){return "/setting/agency/".$this->getId();}		
	
	function getURLUpdLoad(){return "/setting/agency/".$this->getId()."/upd/load";}
	function getURLUpdExe(){return "/setting/agency/".$this->getId()."/upd/exe";}
	function getURLUpdExe1(){return "/agency/register/".$this->getId()."/upd/exe";}
	
	function getURLDelLoad(){return "/setting/agency/".$this->getId()."/del/load";			}
	function getURLDelExe(){return "/setting/agency/".$this->getId()."/del/exe";			}
	
	function getURLNewsInsLoad(){return "/setting/agency/".$this->getId()."/ins/load";}
	function getURLNewsInsExe(){return "/setting/agency/".$this->getId()."/ins/exe";}
			
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	
}
?>