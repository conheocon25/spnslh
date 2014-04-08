<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Category extends Object{
    private $Id;
	private $Name;
	private $Picture;
	private $Enable;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $Name=null , $Picture=Null, $Enable=Null) {
        $this->Id 			= $Id;
		$this->Name 		= $Name;
		$this->Picture 		= $Picture;
		$this->Enable 		= $Enable;
        parent::__construct( $Id );
    }
    function getId() {return $this->Id;}	
    function getIdString() {return 'Category'.$this->Id;}	
			
    function setName( $Name ) {$this->Name = $Name;$this->markDirty();}   
	function getName( ) {return $this->Name;}
	function getNameReduce(){
		$S = new \MVC\Library\String($this->Name);
		return $S->reduce(28);
	}
	
	function setPicture( $Picture ) {$this->Picture = $Picture;$this->markDirty();}   
	function getPicture( ) {return $this->Picture;}
	
	function setEnable( $Enable ) {$this->Enable = $Enable; $this->markDirty();}
	function getEnable( ) {return $this->Enable;}
	
	public function toJSON(){
		$json = array(
			'Id' 		=> $this->getId(),
			'Name' 		=> $this->getName(),			
			'Picture' 	=> $this->getPicture(),
			'Enable' 	=> $this->getEnable()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 		= $Data[0];	
		$this->Name 	= $Data[1];
		$this->Picture 	= $Data[2];
		$this->Enable 	= $Data[3];
    }

	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	function getCourseSelling(){
		$mCourse = new \MVC\Mapper\Course();
		$CourseAll = $mCourse->findSelling(array($this->getId()));
		return $CourseAll;
	}
	
	function getCourseAll(){
		$mCourse = new \MVC\Mapper\Course();
		$CourseAll = $mCourse->findByCategory(array($this->getId()));
		return $CourseAll;
	}
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------						
	function getURLCourse(){return "/setting/category/".$this->getId();}
	
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	
}
?>