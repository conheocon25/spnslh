<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Video extends Object{
    private $Id;	
	private $Name;
	private $Date;
	private $Note;	
	private $URL;
	private $Key;
	private $Viewed;
	private $Liked;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id=null, 		
		$Name=null, 
		$Date=null,
		$Note=null,
		$URL=null,
		$Key=null,
		$Viewed=null,
		$Liked=null
		)
	{        	
		$this->Id			= $Id;				
		$this->Name			= $Name;
		$this->Date			= $Date;
		$this->Note			= $Note;
		$this->URL			= $URL;
		$this->Key			= $Key;
		$this->Viewed		= $Viewed;
		$this->Liked		= $Liked;
        parent::__construct( $Id );
    }
    function getId( ) {return $this->Id;}
	
    function setName( $Name ) {$this->Name = $Name;$this->markDirty();}
    function getName( ) {return $this->Name;}
	
	function setDate( $Date ) {$this->Date = $Date; $this->markDirty();}
    function getDate( ) {return $this->Date;}
	function getDatePrint( ) {return $this->Date;}
	
	function setNote( $Note ) {$this->Note = $Note; $this->markDirty();}
    function getNote( ) {return $this->Note;}
	
	function getURL( ) {return $this->URL;}
	function setURL( $URL ) {$this->URL = $URL; $this->markDirty(); }
	
	function setKey( $Key ){$this->Key = $Key;$this->markDirty();}
	function getKey( ) {return $this->Key;}
	function reKey( ){
		$Id = time();
		$Str = new \MVC\Library\String($this->Name);
		$this->Key = $Str->converturl();		
	}
	
	function getIdURL( ){list($http, $sym, $addr1, $addr2, $addr3) = explode("/", $this->URL);return $addr3;}
	function getImage(){
		return "http://img.youtube.com/vi/".$this->getIdURL()."/2.jpg";
	}
	
	function getViewed( ) {return $this->Viewed;}
	function setViewed( $Viewed ) {$this->Viewed = $Viewed; $this->markDirty(); }
	
	function getLiked( ) {return $this->Liked;}
	function setLiked( $Liked ) {$this->Liked = $Liked; $this->markDirty(); }
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'Name'			=> $this->getName(),
			'Date'			=> $this->getDate(),
			'Note'			=> $this->getNote(),
			'URL'			=> $this->getURL(),
			'Key'			=> $this->getKey(),
			'Viewed'		=> $this->getViewed(),
			'Liked'			=> $this->getLiked()
		);		
		return json_encode($json);
	}
	
	function setArray( $Data ){
		$this->Id			= $Data[0];
		$this->Name			= $Data[1];
		$this->Date			= $Data[2];
		$this->Note			= $Data[3];
		$this->URL			= $Data[4];
		$this->Viewed		= $Data[5];
		$this->Liked		= $Data[6];
		
		$this->reKey();
    }
	
	function getURLView(){ return "/video/".$this->getKey();}
	//-------------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
}
?>