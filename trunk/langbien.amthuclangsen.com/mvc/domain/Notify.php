<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Notify extends Object{
    private $Id;
	private $Title;
	private $Type;
	private $Message;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $Title=null , $Type=null, $Message=null) {
        $this->Id 		= $Id;
		$this->Title 	= $Title;
		$this->Type 	= $Type;
		$this->Message 	= $Message;
        parent::__construct( $Id );
    }
    function getId() {return $this->Id;}	
    			
    function setTitle( $Title ) {$this->Title = $Title;$this->markDirty();}   
	function getTitle( ) {return $this->Title;}
	
	function setType( $Type ) {$this->Type = $Type;$this->markDirty();}   
	function getType( ) {return $this->Type;}
	
	function setMessage( $Message ) {$this->Message = $Message; $this->markDirty();}   
	function getMessage( ) {return $this->Message;}
	
	public function toJSON(){
		$json = array(
			'Id' 		=> $this->getId(),
			'Title' 	=> $this->getTitle(),			
			'Type' 		=> $this->getType(),
			'Message' 	=> $this->getMessage()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 		= $Data[0];
		$this->Title 	= $Data[1];
		$this->Type 	= $Data[2];
		$this->Message	= $Data[3];
    }

	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
		
	//-------------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	
}
?>