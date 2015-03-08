<?php 
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class BoardTag extends Object{
	//-------------------------------------------------------------------------------
	//DEFINE PROPERTY
	//-------------------------------------------------------------------------------
	private $Id;
	private $IdBoard;		
	private $IdTag;
		
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
	function __construct($Id=null, $IdBoard=null, $IdTag=null){
		$this->Id 			= $Id;
		$this->IdBoard 		= $IdBoard;		
		$this->IdTag 		= $IdTag;	
		parent::__construct( $Id );
	}
		
	function getId() {return $this->Id;}
		
	function setIdBoard($IdBoard) {$this->IdBoard = $IdBoard;$this->markDirty();}
	function getIdBoard() 		{return $this->IdBoard;}
	function getBoard(){
		$mBoard = new \MVC\Mapper\Board();
		$Board = $mBoard->find($this->IdBoard);
		return $Board;
	}
			
	function setIdTag($IdTag){$this->IdTag = $IdTag; $this->markDirty();}
	function getIdTag() 	{return $this->IdTag;}
	function getTag(){
		$mTag = new \MVC\Mapper\Tag();
		$Tag = $mTag->find($this->IdTag);
		return $Tag;
	}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdBoard'		=> $this->getIdBoard(),
			'IdTag'			=> $this->getIdTag()			
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 		= $Data[0];
		$this->IdBoard 	= $Data[1];
		$this->IdTag	= $Data[2];						
    }
	
	//-------------------------------------------------------------------------------
	//GET LIST
	//-------------------------------------------------------------------------------
			
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLView(){return "/the-bai/".$this->getKey();}	
	function getURLSetting(){return "/admin/setting/tag/".$this->getId();}
		
	//-------------------------------------------------------------------------------
	static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
	static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	//-------------------------------------------------------------------------------
	
}
?>