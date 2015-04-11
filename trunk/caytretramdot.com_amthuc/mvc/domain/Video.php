<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Video extends Object{

    private $Id;
	private $IdCourse;
	private $Name;
	private $DateTimeCreated;
	private $DateTimeUpdated;
	private $IdYouTube;
	private $Note;
			
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id				=null, 
		$IdCourse		=null, 
		$Name			=null,
		$DateTimeCreated=null, 
		$DateTimeUpdated=null, 
		$IdYouTube		=null,		 	
		$Note			=null)
	{
		$this->Id 				= $Id;
		$this->IdCourse 		= $IdCourse;
		$this->Name 			= $Name; 		
		$this->DateTimeCreated 	= $DateTimeCreated;
		$this->DateTimeUpdated 	= $DateTimeUpdated;
		$this->IdYouTube		= $IdYouTube;
		$this->Note 			= $Note;
		
		parent::__construct( $Id );
	}
    function getId() {return $this->Id;}
		
	function setIdCourse( $IdCourse ) {$this->IdCourse = $IdCourse;$this->markDirty();}
	function getIdCourse( ) {return $this->IdCourse;}
	function getCourse( ) {
		$mCourse	= new \MVC\Mapper\Course();
		$Course		= $mCourse->find($this->IdCourse);
		return $Course;
	}
	
    function setName( $Name ) {$this->Name = $Name;$this->markDirty();}   
	function getName( ) {return $this->Name;}
	function getNameReduce( ) {		
		$S = new \MVC\Library\String($this->Name);return $S->reduceHTML(14);
	}
	
	function setDateTimeCreated($DateTimeCreated ) {$this->DateTimeCreated = $DateTimeCreated; $this->markDirty();}
	function getDateTimeCreated(){return $this->DateTimeCreated;}
	function getDateTimeCreatedPrint(){
		$t = strtotime($this->DateTimeCreated);		
		return date('d/m/Y H:i',$t);
	}
	
	function setDateTimeUpdated($DateTimeCreated ) {$this->DateTimeUpdated = $DateTimeUpdated; $this->markDirty();}
	function getDateTimeUpdated(){return $this->DateTimeUpdated;}
	function getDateTimeUpdatedPrint(){
		$t = strtotime($this->DateTimeUpdated);
		return date('d/m/Y H:i',$t);
	}
	
	function setIdYouTube( $IdYouTube ) {$this->IdYouTube = $IdYouTube;$this->markDirty();}   
	function getIdYouTube( ) 			{return $this->IdYouTube;}
	function getYoutubeEmbeded()		{return "http://www.youtube.com/embed/".$this->getIdYouTube();}
	function getImage( ){		
		$url = "http://img.youtube.com/vi/".$this->IdYouTube."/2.jpg";		
		return $url;
	}
	
	function setNote( $Note ) 		{$this->Note = $Note; $this->markDirty();}   
	function getNote( ) 			{return $this->Note;}
			
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------	
		
	function toJSON(){
		$json = array(
			'Id' 				=> $this->getId(),
			'IdCourse' 			=> $this->getIdCourse(),
			'Name'				=> $this->getName(),
			'DateTimeCreated'	=> $this->getDateTimeCreated(),
			'DateTimeUpdated'	=> $this->getDateTimeUpdated(),			
			'IdYouTube'			=> $this->getIdYouTube(),
			'Note'				=> $this->getNote()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 				= $Data[0];
		$this->IdCourse			= $Data[1];
		$this->Name 			= $Data[2];
		$this->IdYouTube		= $Data[3];
		$this->Note 			= $Data[4];
		if (!isset($this->DateTimeCreated)){
			$this->DateTimeCreated 	= \date('Y-m-d H:i');
		}		
		$this->DateTimeUpdated 	= \date('Y-m-d H:i');
				
    }
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLView()			{return "/mon/".$this->getCourse()->getKey()."/video/".$this->getId();}

	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
}
?>