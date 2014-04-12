<?php 
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Clause extends Object{
	//-------------------------------------------------------------------------------
	//DEFINE PROPERTY
	//-------------------------------------------------------------------------------
	private $Id;
	private $IdSolve;
	private $IdQuestion;
	private $State;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
	function __construct($Id=null, $IdSolve=null, $IdQuestion=null, $State=null) {
		$this->Id 		= $Id;
		$this->IdSolve = $IdSolve;
		$this->IdQuestion 	= $IdQuestion;
		$this->State 	= $State;
		parent::__construct( $Id );
	}
		
	function getId() {return $this->Id;}
	
	function setIdSolve($IdSolve) 	{$this->IdSolve = $IdSolve; $this->markDirty();}
	function getIdSolve() 			{return $this->IdSolve;}
	function getSolve() 			{
		$mSolve = new \MVC\Mapper\Solve();
		$Solve = $mSolve->find($this->getIdSolve());
		return $Solve;
	}
	
	function setIdQuestion($IdQuestion) {$this->IdQuestion = $IdQuestion;$this->markDirty();}
	function getIdQuestion() 		{return $this->IdQuestion;}
	function getQuestion() 			{
		$mQuestion 	= new \MVC\Mapper\Question();
		$Question 	= $mQuestion->find($this->getIdQuestion());
		return $Question;
	}
	
	function setState($State) 		{$this->State = $State;$this->markDirty();}
	function getState() 			{return $this->State;}
	function getStatePrint() 		{
		if ($this->State==1)
			return "";			
		return "!";
	}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdSolve' 		=> $this->getIdSolve(),
			'IdQuestion'	=> $this->getIdQuestion(),
			'State'			=> $this->getState()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];	
		$this->IdSolve 		= $Data[1];	
		$this->IdQuestion 	= $Data[2];
		$this->State 		= $Data[3];
    }	
	//-------------------------------------------------------------------------------
	//GET LIST
	//-------------------------------------------------------------------------------		
	
			
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
				
	//-------------------------------------------------------------------------------
	static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
	static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	//-------------------------------------------------------------------------------
	
}
?>