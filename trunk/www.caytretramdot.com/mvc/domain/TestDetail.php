<?php 
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class TestDetail extends Object{
	//-------------------------------------------------------------------------------
	//DEFINE PROPERTY
	//-------------------------------------------------------------------------------
	private $Id;
	private $IdTest;
	private $IdQuestion;
	private $Answer;
		
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
	function __construct($Id=null, $IdTest=null, $IdQuestion=null, $Answer=null){
		$this->Id 			= $Id;
		$this->IdTest 		= $IdTest;		
		$this->IdQuestion 	= $IdQuestion;
		$this->Answer 		= $Answer;
				
		parent::__construct( $Id );
	}
	function setId($Id) {$this->Id = $Id;}
	function getId() 	{return $this->Id;}
		
	function setIdTest($IdTest) {$this->IdTest = $IdTest;$this->markDirty();}
	function getIdTest() 		{return $this->IdTest;}
	function getExam(){
		$mExam 	= new \MVC\Mapper\Exam();
		$Exam 	= $mExam->find($this->IdTest);
		return $Exam;
	}
		
	function setIdQuestion($IdQuestion) 	{$this->IdQuestion = $IdQuestion;$this->markDirty();}
	function getIdQuestion() 				{return $this->IdQuestion;}
	function getIdQuestionPrint() 			{
		$IdQuestion= date('d/m/Y h:i', \strtotime($this->IdQuestion));
		return $IdQuestion;
	}
	
	function setAnswer($Answer) 	{$this->Answer = $Answer;$this->markDirty();}
	function getAnswer() 				{return $this->Answer;}
	function getAnswerPrint() 			{
		$Answer= date('d/m/Y h:i', \strtotime($this->Answer));
		return $Answer;
	}
					
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdTest'		=> $this->getIdTest(),			
			'IdQuestion'	=> $this->getIdQuestion(),
			'Answer'		=> $this->getAnswer()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->IdTest 		= $Data[1];		
		$this->IdQuestion 	= $Data[2];
		$this->Answer 		= $Data[3];		
    }
	function getURLSetting(){return "/test/".$this->getId();}
		
	//-------------------------------------------------------------------------------
	static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
	static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	//-------------------------------------------------------------------------------
	
}
?>