<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Chapter extends Object{

    private $Id;
	private $IdBook;
	private $Title;	
	private $Info;
	private $Completed;
	private $Key;
		
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id			=null, 
		$IdBook		=null, 
		$Title		=null , 		
		$Info		=null, 		
		$Completed	=null, 
		$Key		=null)
	{
		$this->Id 			= $Id;
		$this->IdBook 		= $IdBook;
		$this->Title 		= $Title; 
		$this->Info 		= $Info;
		$this->Completed 	= $Completed;
		$this->Key 			= $Key;
		
		parent::__construct( $Id );
	}
    function getId() {return $this->Id;}
		
	function setIdBook( $IdBook ) {$this->IdBook = $IdBook;$this->markDirty();}
	function getIdBook( ) {return $this->IdBook;}
	function getBook( ) {
		$mBook 	= new \MVC\Mapper\Book();
		$Book 	= $mBook->find($this->IdBook);
		return $Book;
	}
	
    function setTitle( $Title ) {$this->Title = $Title;$this->markDirty();}   
	function getTitle( ) {return $this->Title;}
	function getTitleReduce( ) {		
		$S = new \MVC\Library\String($this->Title);return $S->reduceHTML(14);
	}
			
	function setInfo( $Info ) {$this->Info = $Info;$this->markDirty();}   
	function getInfo( ) {return $this->Info;}
	
	function setCompleted( $Completed ) {$this->Completed = $Completed;$this->markDirty();}   
	function getCompleted( ) {return $this->Completed;}
	
	function getCompletedPercent(){		
		return \round($this->Completed/100, 2);
	}
			
	function getCompletedPercentPrint1(){
		$Value = $this->getCompletedPercent();		
		return 'width:'.($Value*100)."%";
	}
	
	function getCompletedPercentPrint2(){
		$Value = $this->getCompletedPercent();		
		return ($Value*100)."%";
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
	function getInfoReduce(){$S = new \MVC\Library\String($this->Info);return $S->reduceHTML(320);}
	
	function getThumb( ){return "/data/chess/150/chapter.png";}
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------	
	function getBoardAll(){
		$mBoard 	= new \MVC\Mapper\Board();
		$BoardAll 	= $mBoard->findBy(array($this->getId()));
		return $BoardAll;
	}
		
	function reCompleted(){
		$BoardAll = $this->getBoardAll();
		$Count = 0;
		while ($BoardAll->valid()){
			$Board = $BoardAll->current();
			if ($Board->getDetailAll()->count()>0)
				$Count ++;
			$BoardAll->next();
		}
		if ($BoardAll->count()==0) return 0;		
		$this->Completed = round(($Count/$BoardAll->count())*100,0);
	}
		
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdBook' 		=> $this->getIdBook(),
			'Title'			=> $this->getTitle(),
			'Info'			=> $this->getInfo(),
			'Completed'		=> $this->getCompleted(),
			'Key'			=> $this->getKey()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->IdBook		= $Data[1];
		$this->Title 		= $Data[2];		
		$this->Info 		= $Data[3];		
		$this->Completed 	= $Data[4];		
		$this->Key 			= $Data[5];
    }
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------	
	function getURLView(){
		$Book 		= $this->getBook();
		$Category 	= $Book->getCategory();
		return "/sach/".$Category->getKey()."/".$Book->getKey()."/".$this->getKey();
	}
	
	function getURLSettingBoard()			{return "/admin/book/".$this->getBook()->getCategory()->getId()."/".$this->getIdBook()."/chapter/".$this->getId()."/board";		}
	function getURLSettingBoardInsLoad()	{return "/admin/book/".$this->getBook()->getCategory()->getId()."/".$this->getIdBook()."/chapter/".$this->getId()."/board/ins/load";	}
	function getURLSettingBoardInsExe()		{return "/admin/book/".$this->getBook()->getCategory()->getId()."/".$this->getIdBook()."/chapter/".$this->getId()."/board/ins/exe";	}
	
	function getURLUpdLoad()		{return "/admin/book/".$this->getBook()->getCategory()->getId()."/".$this->getIdBook()."/chapter/".$this->getId()."/upd/load";	}
	function getURLUpdExe()			{return "/admin/book/".$this->getBook()->getCategory()->getId()."/".$this->getIdBook()."/chapter/".$this->getId()."/upd/exe";	}
	
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
}
?>