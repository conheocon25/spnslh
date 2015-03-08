<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class BoardSub extends Object{
    private $Id;
	private $IdBoardParent;
	private $IdBoardMe;
	private $IdBoardDetail;	
					
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------		
    function __construct( 
		$Id=null, 
		$IdBoardParent=null, 
		$IdBoardMe=null, 
		$IdBoardDetail=null
	)
	{		
		$this->Id 				= $Id;
		$this->IdBoardParent 	= $IdBoardParent;
		$this->IdBoardMe 		= $IdBoardMe;
		$this->IdBoardDetail 	= $IdBoardDetail;				
		parent::__construct( $Id );
	}
    function getId() {return $this->Id;}	
	
	function setIdBoardParent( $IdBoardParent ) {$this->IdBoardParent = $IdBoardParent;$this->markDirty();}
	function getIdBoardParent( ) {return $this->IdBoardParent;}
	function getBoardParent( ) {
		$mBoard 	= new \MVC\Mapper\Board();
		$Board 		= $mBoard->find($this->IdBoardParent);
		return $Board;
	}
	
	function setIdBoardMe( $IdBoardMe ) {$this->IdBoardMe = $IdBoardMe; $this->markDirty();}
	function getIdBoardMe(){return $this->IdBoardMe;}
	function getBoardMe( ) {
		$mBoard = new \MVC\Mapper\Board();
		$Board 	= $mBoard->find($this->IdBoardMe);
		return $Board;
	}
	
	function setIdBoardDetail( $IdBoardDetail ) {$this->IdBoardDetail = $IdBoardDetail;$this->markDirty();}
	function getIdBoardDetail( ) {return $this->IdBoardDetail;}
	function getBoardDetail( ) {
		$mBoardDetail 	= new \MVC\Mapper\BoardDetail();
		$BoardDetail 	= $mBoardDetail->find($this->IdBoardDetail);
		return $BoardDetail;
	}
	    
		
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdBoardParent' => $this->getIdBoardParent(),
			'IdBoardMe' 	=> $this->getIdBoardMe(),
			'IdBoardDetail' => $this->getIdBoardDetail()			
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->IdBoardParent= $Data[1];
		$this->IdBoardMe	= $Data[2];
		$this->IdBoardDetail= $Data[3];
    }
			
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------			
	function getURLView(){
		$Chapter  	= $this->getChapter();
		$Book 		= $Chapter->getBook();
		$Category	= $Book->getCategory();
		return "/sach/".$Category->getKey()."/".$Book->getKey()."/".$Chapter->getKey()."/".$this->getKey();
	}
			
	function getURLDetail(){
		$Chapter  	= $this->getChapter();
		$Book 		= $Chapter->getBook();
		$Category	= $Book->getCategory();
		return "/admin/book/".$Category->getId()."/".$Book->getId()."/chapter/".$Chapter->getId()."/board/".$this->getId()."/detail";
	}
	
	function getURLUpdLoad(){
		$Chapter  	= $this->getChapter();
		$Book 		= $Chapter->getBook();
		$Category	= $Book->getCategory();
		return "/admin/book/".$Category->getId()."/".$Book->getId()."/chapter/".$Chapter->getId()."/board/".$this->getId()."/upd/load";
	}
	
	function getURLUpdExe(){
		$Chapter  	= $this->getChapter();
		$Book 		= $Chapter->getBook();
		$Category	= $Book->getCategory();		
		return "/admin/book/".$Category->getId()."/".$Book->getId()."/chapter/".$Chapter->getId()."/board/".$this->getId()."/upd/exe";
	}
	
	function getURLSettingPoseLoad(){
		$Chapter  	= $this->getChapter();
		$Book 		= $Chapter->getBook();
		$Category	= $Book->getCategory();
		return "/admin/book/".$Category->getId()."/".$Book->getId()."/chapter/".$Chapter->getId()."/board/".$this->getId()."/pose/load";
	}
	
	function getURLSettingPoseExe(){
		$Chapter  	= $this->getChapter();
		$Book 		= $Chapter->getBook();
		$Category	= $Book->getCategory();
		return "/admin/book/".$Category->getId()."/".$Book->getId()."/chapter/".$Chapter->getId()."/board/".$this->getId()."/pose/exe";
	}
	
	function getURLSettingStateLoad(){
		$Chapter  	= $this->getChapter();
		$Book 		= $Chapter->getBook();
		$Category	= $Book->getCategory();
		return "/admin/book/".$Category->getId()."/".$Book->getId()."/chapter/".$Chapter->getId()."/board/".$this->getId()."/state/load";
	}
	
	function getURLSettingStateExe(){
		$Chapter  	= $this->getChapter();
		$Book 		= $Chapter->getBook();
		$Category	= $Book->getCategory();
		return "/admin/book/".$Category->getId()."/".$Book->getId()."/chapter/".$Chapter->getId()."/board/".$this->getId()."/state/exe";
	}
		
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	
}
?>