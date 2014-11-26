<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Printer extends Object{
    private $Id;
	private $Name;
	private $URL;
		
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $Name=null , $URL=Null) {
        $this->Id 			= $Id;
		$this->Name 		= $Name;
		$this->URL 			= $URL;
		
        parent::__construct( $Id );
    }
    function getId() {return $this->Id;}	
			
    function setName( $Name ) {$this->Name = $Name;$this->markDirty();}   
	function getName( ) {return $this->Name;}
		
	function setURL( $URL ) {$this->URL = $URL;$this->markDirty();}   
	function getURL( ) {return $this->URL;}
			
	public function toJSON(){
		$json = array(
			'Id' 		=> $this->getId(),
			'Name' 		=> $this->getName(),			
			'URL' 		=> $this->getURL(),	
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 		= $Data[0];	
		$this->Name 	= $Data[1];
		$this->URL 		= $Data[2];		
    }
	
	function toXML(){
		$S = "
		<object>
			<id>".$this->getId()."</id>
			<name>".$this->getName()."</name>
			<url>".$this->getURL()."</url>
		</object>
		";
		return $S;
	}

	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
		
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------						
		
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	
}
?>