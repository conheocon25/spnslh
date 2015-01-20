<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Post extends Object{
    private $Id;
	private $IdCategory;
	private $Title;
	private $Content;	
	private $Time;	
	private $Key;
	private $Viewed;
	private $Liked;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $IdCategory, $Title=null, $Content=null, $Time=null, $Key=null, $Viewed=null, $Liked=null){
        $this->Id 			= $Id;
		$this->IdCategory 		= $IdCategory;
		$this->Title 		= $Title;
		$this->Content 		= $Content;				
		$this->Time 		= $Time;				
		$this->Key 			= $Key;
		$this->Viewed 		= $Viewed;
		$this->Liked 		= $Liked;
		
        parent::__construct( $Id );
    }
    function setId($Id) {$this->Id = $Id;}
	function getId() 	{return $this->Id;}	
		
	function setContent( $Content ){$this->Content = $Content;$this->markDirty();}   
	function getContent( ) {return $this->Content;}
			
	function setTime( $Time ){$this->Time = $Time;$this->markDirty();}   
	function getTime( ) {return $this->Time;}
	function getTimePrint( ){		
		$D = new \MVC\Library\Date($this->Time);return $D->getFullDateTimeFormat();
	}
	
	function setIdCategory( $IdCategory ){$this->IdCategory = $IdCategory;$this->markDirty();}   
	function getIdCategory( ) {return $this->IdCategory;}
	function getCategory( ) {
		$mCategory 	= new \MVC\Mapper\CategoryPost();
		$Category 	= $mCategory->find($this->IdCategory);
		return $Category;
	}
	
	function setTitle( $Title ){$this->Title = $Title;$this->markDirty();}   
	function getTitle( ) {return $this->Title;}	
	function getTitleReduce(){$S = new \MVC\Library\String($this->Title);return $S->reduce(45);}
			
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
	
	function setViewed( $Viewed ){$this->Viewed = $Viewed;$this->markDirty();}   
	function getViewed( ) {return $this->Viewed;}
	
	function setLiked( $Liked ){$this->Liked = $Liked; $this->markDirty();}
	function getLiked( ) {return $this->Liked;}
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
				
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdCategory'	=> $this->getIdCategory(),
			'Title'			=> $this->getTitle(),
			'Content'		=> $this->getContent(),			
			'Time'			=> $this->getTime(),			
			'Key'			=> $this->getKey(),
			'Viewed'		=> $this->getViewed(),
			'Liked'			=> $this->getLiked()
		);				
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->IdCategory		= $Data[2];
		$this->Title		= $Data[3];
		$this->Content 		= \stripslashes($Data[4]);
		$this->Time 		= $Data[5];		
		$this->Viewed 		= $Data[6];
		$this->Liked 		= $Data[7];
		$this->reKey();
    }
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLView(){		return "/bai-viet/".$this->getCategory()->getKey()."/".$this->getKey();}
			
	function getURLUpdLoad(){	return "admin/post/".$this->getIdCategory()."/".$this->getId()."/upd/load";}
	function getURLUpdExe(){	return "admin/post/".$this->getIdCategory()."/".$this->getId()."/upd/exe";}
					
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}	
}
?>