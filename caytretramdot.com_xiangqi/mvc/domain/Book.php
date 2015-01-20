<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Book extends Object{

    private $Id;
	private $IdCategory;
	private $Name;	
	private $Author;
	private $Language;	
	private $Order;
	private $URL;
		
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $IdCategory=null, $Name=null , $Author=null, $Language=null , $Order=Null, $URL=Null) {$this->Id = $Id; $this->IdCategory = $IdCategory; $this->Name = $Name; $this->Author = $Author; $this->Language = $Language; $this->Order = $Order;$this->URL = $URL;parent::__construct( $Id );}
    function getId() {return $this->Id;}
	function getIdPrint(){return "c" . $this->getId();}
	
	function setIdCategory( $IdCategory ) {$this->IdCategory = $IdCategory;$this->markDirty();}
	function getIdCategory( ) {return $this->IdCategory;}
	
    function setName( $Name ) {$this->Name = $Name;$this->markDirty();}   
	function getName( ) {return $this->Name;}
	
	function setAuthor( $Author ) {$this->Author = $Author;$this->markDirty();}   
	function getAuthor( ) {return $this->Author;}
	
	function setLanguage( $Language ) {$this->Language = $Language; $this->markDirty();}
	function getLanguage( ) {return $this->Language;}
	
	function setURL( $URL ) {$this->URL = $URL;$this->markDirty();}   
	function getURL( ) {return $this->URL;}
	
	function setOrder( $Order ) {$this->Order = $Order;$this->markDirty();}   
	function getOrder( ) {return $this->Order;}
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdCategory' 	=> $this->getIdCategory(),
			'Name'			=> $this->getName(),		 	
		 	'Order'			=> $this->getOrder(),
			'URL'			=> $this->getURL()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->IdCategory	= $Data[1];
		$this->Name 		= $Data[2];
		$this->Order 		= $Data[3];
		$this->URL 			= $Data[4];
    }
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLRead(){return "/van-ban/".$this->getkey();}
	function getURLView(){return "/download/ebook/".$this->getCategory()->getKey()."/";}

			
	function getURLNewsInsLoad(){return "/app/Book/".$this->getId()."/ins/load";}
	function getURLNewsInsExe(){return "/app/Book/".$this->getId()."/ins/exe";}
	
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
}
?>