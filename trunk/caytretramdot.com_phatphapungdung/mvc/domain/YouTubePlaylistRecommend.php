<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class YouTubePlaylistRecommend extends Object{

    private $Id;
	private $IdBook;
	private $Name;
	private $IdPlaylist;
			
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id=null,
		$IdBook=null,
		$Name=null,
		$IdPlaylist=null)
	{
		$this->Id 			= $Id; 
		$this->IdBook 		= $IdBook; 
		$this->Name 		= $Name; 
		$this->IdPlaylist 	= $IdPlaylist;
				
		parent::__construct( $Id );
	}
    function getId() {return $this->Id;}
		
	function setIdBook( $IdBook ) {$this->IdBook = $IdBook;$this->markDirty();}
	function getIdBook( ) {return $this->IdBook;}
	function getBook( ) {
		$mBook 	= new \MVC\Mapper\Book();
		$Book 	= $mBook->find($this->IdBook);
		return $Book;
	}
	
    function setName( $Name ) {$this->Name = $Name;$this->markDirty();}   
	function getName( ) {return $this->Name;}
	function getNameReduce( ) {		
		$S = new \MVC\Library\String($this->Name);return $S->reduceHTML(32);
	}
	
	function setIdPlaylist( $IdPlaylist ) {$this->IdPlaylist = $IdPlaylist;$this->markDirty();}   
	function getIdPlaylist( ) {return $this->IdPlaylist;}
			
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
		
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdBook' 		=> $this->getIdBook(),
			'Name'			=> $this->getName(),
			'IdPlaylist'	=> $this->getIdPlaylist()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->IdBook		= $Data[1];
		$this->Name 		= $Data[2];
		$this->IdPlaylist 	= $Data[3];
    }
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
			
	//-------------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
}
?>