<?php 
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class ExamDetail extends Object{
	//-------------------------------------------------------------------------------
	//DEFINE PROPERTY
	//-------------------------------------------------------------------------------
	private $Id;
	private $IdExam;	
	private $IdQuestion;
	private $Order;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
	function __construct($Id=null, $IdExam=null, $IdQuestion=null, $Order=null){
		$this->Id 			= $Id;
		$this->IdExam 		= $IdExam;
		$this->IdQuestion 	= $IdQuestion;
		$this->Order 		= $Order;
		parent::__construct( $Id );
	}
	function setId($Id) {$this->Id = $Id;}
	function getId() 	{return $this->Id;}
	
	function setIdExam($IdExam) 	{$this->IdExam = $IdExam; $this->markDirty();}
	function getIdExam() 			{return $this->IdExam;}
	function getExam(){
		$mExam 	= new \MVC\Mapper\Exam();
		$Exam 	= $mExam->find($this->IdExam);
		return $Exam;
	}
	
	function setIdQuestion($IdQuestion) {$this->IdQuestion = $IdQuestion;$this->markDirty();}
	function getIdQuestion() 			{return $this->IdQuestion;}
	function getQuestion(){
		$mQuestion 	= new \MVC\Mapper\Question();
		$Question 	= $mQuestion->find($this->IdQuestion);
		return $Question;
	}
	
	function setOrder($Order) 		{$this->Order = $Order; $this->markDirty();}
	function getOrder() 			{return $this->Order;}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdExam'		=> $this->getIdExam(),
			'IdQuestion'	=> $this->getIdQuestion(),						
			'Order'			=> $this->getOrder()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->IdExam 		= $Data[1];		
		$this->IdQuestion 	= $Data[2];					
		$this->Order 		= $Data[3];
    }
			
	//-------------------------------------------------------------------------------
	static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
	static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	//-------------------------------------------------------------------------------
	
}
?>