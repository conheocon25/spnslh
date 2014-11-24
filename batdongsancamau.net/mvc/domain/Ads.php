<?php 
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Ads extends Object{
	//-------------------------------------------------------------------------------
	//DEFINE PROPERTY
	//-------------------------------------------------------------------------------
	private $Id;
	private $Name;
	private $Position;
	private $Picture;
	private $URL;
	private $Key;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
	function __construct($Id=null, $Name=null, $Position=null, $Picture=null, $URL=null, $Key=null) {
		$this->Id 		= $Id;
		$this->Name 	= $Name;
		$this->Position = $Position;
		$this->Picture 	= $Picture;
		$this->URL 		= $URL;
		$this->Key 		= $Key;
		parent::__construct( $Id );
	}
		
	function getId() {return $this->Id;}
		
	function setName($Name) {$this->Name = $Name;$this->markDirty();}
	function getName() 		{return $this->Name;}
	
	function setPosition($Position)	{$this->Position = $Position;$this->markDirty();}
	function getPosition() 			{return $this->Position;}
	
	function setPicture($Picture)	{$this->Picture = $Picture;$this->markDirty();}
	function getPicture() 			{return $this->Picture;}
	
	function setURL($URL)			{$this->URL = $URL;$this->markDirty();}
	function getURL() 				{return $this->URL;}
	
	function setKey($Key)	{$this->Key = $Key;$this->markDirty();}
	function getKey() 		{return $this->Key;}
	function reKey( ) {
		$Str = new \MVC\Library\String($this->Name);
		$this->Key = $Str->converturl();
	}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'Name'			=> $this->getName(),
			'Position'		=> $this->getPosition(),			
			'Picture'		=> $this->getPicture(),
			'URL'			=> $this->getURL(),
			'Key'			=> $this->getKey()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 		= $Data[0];
		$this->Name 	= $Data[1];
		$this->Position = $Data[2];
		$this->Picture	= $Data[3];
		$this->URL 		= $Data[4];
		$this->reKey();
    }
	
	//-------------------------------------------------------------------------------
	//GET LIST
	//-------------------------------------------------------------------------------		
		
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
		
	//-------------------------------------------------------------------------------
	static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
	static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	//-------------------------------------------------------------------------------
	
}
?>