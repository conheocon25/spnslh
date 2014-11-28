<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class StoryLine extends Object{

    private $Id;
	private $Date;
	private $Name;
	private $Image;
    private $Title;    
    private $Note;
    	
	/*Hàm khởi tạo và thiet lap các thuoc tính*/
    function __construct( $Id=null, $Date=null, $Name=null, $Image=null, $Title=null, $Note=null ) {
        $this->Id 		= $Id;
		$this->Date 	= $Date;	
		$this->Name 	= $Name;
		$this->Image 	= $Image;
		$this->Title 	= $Title;
		$this->Note 	= $Note;
        parent::__construct( $Id );
    }
	function setId( $Id) 		{return $this->Id = $Id;}
    function getId( ) 			{return $this->Id;}
		
	function getDate()			{return $this->Date;}	
	function getDatePrint( ) {$Date = new \MVC\Library\Date($this->Date); return $Date->getDateFormat();}
    function setDate( $Date ) 	{$this->Date = $Date;$this->markDirty();}
			
	function getName(){return \trim($this->Name);}
    function setName( $Name ) {$this->Name = $Name;$this->markDirty();}

	function getImage(){return $this->Image;}
    function setImage( $Image ) {$this->Image = $Image;$this->markDirty();}
			
    function setTitle( $Title ) {$this->Title = $Title;$this->markDirty();}
	function getTitle(){return $this->Title;}
	
	function getNote(){return $this->Note;}	
    function setNote( $Note ) {$this->Note = $Note;$this->markDirty();}
			
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'Date'			=> $this->getDate(),
			'Name'			=> $this->getName(),			
			'Image'			=> $this->getImage(),			
			'Title'			=> $this->getTitle(),
			'Note'			=> $this->getNote()			
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
		$this->Id 		= $Data[0];
		$this->Date 	= $Data[1];
		$this->Name		= $Data[2];
		$this->Image	= $Data[3];
		$this->Title	= $Data[4];		
		$this->Note		= $Data[5];		
    }
	
	//=================================================================================			
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}	
	
}
?>