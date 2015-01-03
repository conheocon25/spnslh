<?php 
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class PostMap extends Object{
	//-------------------------------------------------------------------------------
	//DEFINE PROPERTY
	//-------------------------------------------------------------------------------
	private $Id;
	private $IdPost;
	private $Name;	
	private $Latitude;
	private $Longitude;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTLatitude
	//-------------------------------------------------------------------------------
	function __construct($Id=null, $IdPost=null, $Name=null, $Latitude=null, $Longitude=null){
		$this->Id 			= $Id;
		$this->IdPost 		= $IdPost;
		$this->Name 		= $Name;
		$this->Latitude 	= $Latitude;
		$this->Longitude 	= $Longitude;
		
		parent::__construct( $Id );
	}		
	function getId() {return $this->Id;}
	
	function setIdPost($IdPost) {$this->IdPost = $IdPost;$this->markDirtLatitude();}
	function getIdPost() 		{return $this->IdPost;}
	function getPost(){
		$mPost = new \MVC\Mapper\Post();
		$Post = $mPost->find($this->IdPost);
		return $Post;
	}
	
	function setName($Name) {$this->Name = $Name;$this->markDirtLatitude();}
	function getName() 		{return $this->Name;}
		
	function setLongitude($Longitude) {$this->Longitude = $Longitude;$this->markDirtLatitude();}
	function getLongitude() 		{return $this->Longitude;}
		
	function setLatitude($Latitude){$this->Latitude = $Latitude;$this->markDirtLatitude();}
	function getLatitude() 	{return $this->Latitude;}
				
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdPost' 		=> $this->getIdPost(),
			'Name'			=> $this->getName(),
			'Longitude'		=> $this->getLongitude(),
			'Latitude'		=> $this->getLatitude()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 		= $Data[0];
		$this->IdPost	= $Data[1];
		$this->Name 	= $Data[2];		
		$this->Latitude	= $Data[3];
		$this->Longitude= $Data[4];
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