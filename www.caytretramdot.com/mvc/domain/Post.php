<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Post extends Object{
    private $Id;
	private $Title;
	private $Content;	
	private $Time;
	private $Count;
	private $Key;
	private $Viewed;
	private $Liked;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $Title=null, $Content=null, $Author=null, $Time=null, $Count=null, $Key=null, $Viewed=null, $Liked=null){
        $this->Id 			= $Id;
		$this->Title 		= $Title;
		$this->Content 		= $Content;		
		$this->Author 		= $Author;
		$this->Time 		= $Time;		
		$this->Count 		= $Count;
		$this->Key 			= $Key;
		$this->Viewed 		= $Viewed;
		$this->Liked 		= $Liked;
		
        parent::__construct( $Id );
    }
    function setId($Id) {$this->Id = $Id;}
	function getId() 	{return $this->Id;}	
		
	function setContent( $Content ){$this->Content = $Content;$this->markDirty();}   
	function getContent( ) {return $this->Content;}
	
	function setCount( $Count ){$this->Count = $Count;$this->markDirty();}   
	function getCount( ) {return $this->Count;}
	
	function setTime( $Time ){$this->Time = $Time;$this->markDirty();}   
	function getTime( ) {return $this->Time;}
	function getTimePrint( ){		
		$D = new \MVC\Library\Date($this->Time);return $D->getFullDateTimeFormat();
	}
	
	function setAuthor( $Author ){$this->Author = $Author;$this->markDirty();}   
	function getAuthor( ) {return $this->Author;}
	
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
			$first_img = "/data/images/post.jpg";
		}
		return $first_img;
	}
	
	function setKey( $Key ){$this->Key = $Key;$this->markDirty();}
	function getKey( ) {return $this->Key;}
	function reKey( ){
		$Id = time();
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
	function getPTAll(){
		$mPT 	= new \MVC\Mapper\PostTag();	
		$PTAll 	= $mPT->findByPost(array($this->getId()));
		return $PTAll;
	}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'Title'			=> $this->getTitle(),
			'Content'		=> $this->getContent(),
			'Author'		=> $this->getAuthor(),
			'Time'			=> $this->getTime(),
			'Count'			=> $this->getCount(),
			'Key'			=> $this->getKey(),
			'Viewed'		=> $this->getViewed(),
			'Liked'			=> $this->getLiked()
		);				
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->Title		= $Data[1];
		$this->Content 		= \stripslashes($Data[2]);				
		$this->Author		= $Data[3];
		$this->Time 		= $Data[4];
		$this->Count 		= $Data[5];
		$this->Viewed 		= $Data[6];
		$this->Liked 		= $Data[7];
		$this->reKey();
    }
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLRead(){		return "/bai-viet/".$this->getCategory()->getKey()."/".$this->getKey();}
	
	function getURLSettingTag(){return "admin/post/".$this->getId()."/tag";}
	
	function getURLUpdLoad(){	return "admin/post/".$this->getId()."/upd/load";}
	function getURLUpdExe(){	return "admin/post/".$this->getId()."/upd/exe";}		
	
				
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}	
}
?>