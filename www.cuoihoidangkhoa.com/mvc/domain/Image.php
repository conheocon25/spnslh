<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Image extends Object{
    private $Id;
	private $IdAlbum;
	private $Name;
	private $Date;
	private $URL;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id=null, 
		$IdAlbum=null, 		
		$Name=null, 
		$Date=null, 		
		$URL=null)
	{        	
		$this->Id			= $Id;		
		$this->IdAlbum		= $IdAlbum;
		$this->Name			= $Name;
		$this->Date			= $Date;		
		$this->URL			= $URL;
	
        parent::__construct( $Id );
    }
    function getId( ) {return $this->Id;}
		
	function getIdAlbum( ) {return $this->IdAlbum;}
    function setIdAlbum( $IdAlbum ) {$this->IdAlbum = $IdAlbum;$this->markDirty();}
	function getAlbum(){
		$mAlbum = new \MVC\Mapper\Album();
		$Album 	= $mAlbum->find( $this->IdAlbum);
		return $Album;
	}
	
    function setName( $Name ) {$this->Name = $Name;$this->markDirty();}
    function getName( ) {return $this->Name;}
	
	function setDate( $Date ) {$this->Date = $Date; $this->markDirty();}
    function getDate( ) {return $this->Date;}
		
	function getURL( ) {return $this->URL;}
	function setURL( $URL ) {$this->URL = $URL; $this->markDirty(); }
		
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),	
			'IdAlbum'		=> $this->getIdAlbum(),
			'Name'			=> $this->getName(),			
			'Date'			=> $this->getDate(),			
			'URL'			=> $this->getURL()
		);		
		return json_encode($json);
	}
	
	function setArray( $Data ){
		$this->Id			= $Data[0];
		$this->IdAlbum		= $Data[1];
		$this->Name			= $Data[2];
		$this->Date			= $Data[3];
		$this->URL			= $Data[4];
    }
		
	//-------------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
}

?>