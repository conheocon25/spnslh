<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Post extends Object{
    private $Id;
	private $IdCourse;
	private $Title;	
	private $DateTimeCreated;
	private $DateTimeUpdated;
	private $Content;
	private $Key;
		
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $IdCourse=null, $Title=null, $DateTimeCreated=null, $DateTimeUpdated=null, $Content=null, $Key=null){
        $this->Id 				= $Id;
		$this->IdCourse 		= $IdCourse;
		$this->Title 			= $Title;		
		$this->DateTimeCreated 	= $DateTimeCreated;
		$this->DateTimeUpdated 	= $DateTimeUpdated;
		$this->Content 			= $Content;				
		$this->Key 				= $Key;
				
        parent::__construct( $Id );
    }
    function setId($Id) {$this->Id = $Id;}
	function getId() 	{return $this->Id;}	
		
	function setContent( $Content ){$this->Content = $Content;$this->markDirty();}   
	function getContent( ) {return $this->Content;}
	
	function setDateTimeCreated($DateTimeCreated ) {$this->DateTimeCreated = $DateTimeCreated; $this->markDirty();}
	function getDateTimeCreated(){return $this->DateTimeCreated;}
	function getDateTimeCreatedPrint(){
		$t = strtotime($this->DateTimeCreated);		
		return date('d/m/Y H:i',$t);
	}
	
	function setDateTimeUpdated($DateTimeUpdated ) {$this->DateTimeUpdated = $DateTimeUpdated; $this->markDirty();}
	function getDateTimeUpdated(){return $this->DateTimeUpdated;}
	function getDateTimeUpdatedPrint(){
		$t = strtotime($this->DateTimeUpdated);
		return date('d/m/Y H:i',$t);
	}
			
	function setIdCourse( $IdCourse ){$this->IdCourse = $IdCourse;$this->markDirty();}   
	function getIdCourse( ) {return $this->IdCourse;}
	function getCourse( ) {
		$mCourse 	= new \MVC\Mapper\Course();
		$Course 	= $mCourse->find($this->IdCourse);
		return $Course;
	}
	
	function setTitle( $Title ){$this->Title = $Title;$this->markDirty();}   
	function getTitle( ) {return $this->Title;}	
	function getTitleReduce(){$S = new \MVC\Library\String($this->Title);return $S->reduce(14);}
			
	function getImage(){		
		$first_img = '';
		\ob_start();
		\ob_end_clean();
		if(preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $this->Content, $matches)){
			$first_img = $matches[1][0];
		}
		else {
			$first_img = "/mvc/templates/theme/img/post.jpg";
		}
		return $first_img;
	}
	
	function setKey( $Key ){$this->Key = $Key;$this->markDirty();}
	function getKey( ) {return $this->Key;}
	function reKey( ){
		if (!isset($this->Id))
			$Id = time();
		else
			$Id = $this->Id;
			
		$Str = new \MVC\Library\String($this->Title." ".$Id);
		$this->Key = $Str->converturl();		
	}	
	function getContentReduce(){$S = new \MVC\Library\String($this->Content);return $S->reduceHTML(320);}
			
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
				
	function toJSON(){
		$json = array(
			'Id' 				=> $this->getId(),
			'IdCourse'			=> $this->getIdCourse(),
			'Title'				=> $this->getTitle(),			
			'DateTimeCreated'	=> $this->getDateTimeCreated(),
			'DateTimeUpdated'	=> $this->getDateTimeUpdated(),
			'Content'			=> $this->getContent(),
			'Key'				=> $this->getKey()
		);				
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 				= $Data[0];
		$this->IdCourse			= $Data[1];
		$this->Title			= $Data[2];				
		$this->Content 			= \stripslashes($Data[3]);
		$this->reKey();
    }
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLView(){		return "/mon/".$this->getCourse()->getKey()."/bai-viet/".$this->getKey();}
	function getURLViewFull(){	return "http://phatphapungdung.caytretramdot.com/bai-viet/".$this->getCategory()->getKey()."/".$this->getKey();}
			
	function getURLSettingUpd()		{return "/admin/course/".$this->getCourse()->getId()."/post/".$this->getId()."/upd";		}
	function getURLSettingUpdExe()	{return "/admin/course/".$this->getCourse()->getId()."/post/".$this->getId()."/upd/exe";	}
		
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}	
}
?>