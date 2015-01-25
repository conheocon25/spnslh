<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class BoardDetail extends Object{

    private $Id;
	private $IdBoard;
	private $Move;	
	private $Name1;	
	private $State1;	
	private $Name2;	
	private $State2;
	private $Note1;
	private $Note2;
		
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $IdBoard=null, $Move=null,  $Name1=null, $State1=null, $Name2=null, $State2=null, $Note1=null, $Note2=null){
		$this->Id 		= $Id;
		$this->IdBoard 	= $IdBoard;
		$this->Move		= $Move; 
		$this->Name1 	= $Name1; 
		$this->State1	= $State1;
		$this->Name2 	= $Name2; 		
		$this->State2	= $State2;
		$this->Note1	= $Note1;
		$this->Note2	= $Note2;
				
		parent::__construct( $Id );
	}
    function getId() {return $this->Id;}	
	
	function setIdBoard( $IdBoard ) {$this->IdBoard = $IdBoard;$this->markDirty();}   
	function getIdBoard( ) {return $this->IdBoard;}
	function getBoard( ) {
		$mBoard 	= new \MVC\Mapper\Board();
		$Board 	= $mBoard->find($this->IdBoard);
		return $Board;
	}
	
	function setMove( $Move ) {$this->Move = $Move;$this->markDirty();}   
	function getMove( ) {return $this->Move;}
	function getMove1( ) {return ($this->Move-1)*2;}
	function getMove2( ) {return ($this->Move-1)*2 + 1;}
	
    function setName1( $Name1 ) {$this->Name1 = $Name1;$this->markDirty();}   
	function getName1( ) {return $this->Name1;}
	
	function setState1( $State1 ) {$this->State1 = $State1;$this->markDirty();}
	function getState1( ) {return $this->State1;}
	
	function setName2( $Name2 ) {$this->Name2 = $Name2;$this->markDirty();}   
	function getName2( ) {return $this->Name2;}
	
	function setState2( $State2 ) {$this->State2 = $State2;$this->markDirty();}
	function getState2( ) {return $this->State2;}
	
	function setNote1( $Note1 ) {$this->Note1 = $Note1;$this->markDirty();}
	function getNote1( ) 		{return $this->Note1;}
	function getNote1Status( ) 	{
		if ($this->Note1=="")
			return "Không";
		return "Có";
	}
	
	function setNote2( $Note2 ) {$this->Note2 = $Note2;$this->markDirty();}
	function getNote2( ) 		{return $this->Note2;}
	function getNote2Status( ) 	{
		if ($this->Note2=="")
			return "Không";
		return "Có";
	}
			
	function toJSON(){
		$json = array(
			'Id' 		=> $this->getId(),
			'IdBoard' 	=> $this->getIdBoard(),
			'Move'		=> $this->getMove(),	
			'Name1'		=> $this->getName1(),	
		 	'State1'	=> $this->getState1(),
			'Name2'		=> $this->getName2(),			 	
			'State2'	=> $this->getState2(),
			'Note1'		=> $this->getNote1(),
			'Note2'		=> $this->getNote2()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 		= $Data[0];
		$this->IdBoard	= $Data[1];
		$this->Move		= $Data[2];
		$this->Name1 	= $Data[3];		
		$this->State1 	= $Data[4];		
		$this->Name2 	= $Data[5];		
		$this->State2 	= $Data[6];
		$this->Note1 	= $Data[7];
		$this->Note2 	= $Data[8];
    }
			
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
				
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLUpdLoad(){
		$Board		= $this->getBoard();
		$Chapter  	= $Board->getChapter();
		$Book 		= $Chapter->getBook();
		$Category	= $Book->getCategory();
		return "/admin/book/".$Category->getId()."/".$Book->getId()."/chapter/".$Chapter->getId()."/board/".$Board->getId()."/detail/".$this->getId()."/upd/load";
	}
	
	function getURLUpdExe(){
		$Board		= $this->getBoard();
		$Chapter  	= $Board->getChapter();
		$Book 		= $Chapter->getBook();
		$Category	= $Book->getCategory();
		return "/admin/book/".$Category->getId()."/".$Book->getId()."/chapter/".$Chapter->getId()."/board/".$Board->getId()."/detail/".$this->getId()."/upd/exe";
	}
		
	//-------------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	
}
?>