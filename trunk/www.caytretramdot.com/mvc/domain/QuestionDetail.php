<?php 
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class QuestionDetail extends Object{
	//-------------------------------------------------------------------------------
	//DEFINE PROPERTY
	//-------------------------------------------------------------------------------
	private $Id;
	private $IdQuestion;
	private $Content;
	private $Order;
		
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
	function __construct($Id=null, $IdQuestion=null, $Content=null, $Order=null) {
		$this->Id 			= $Id;
		$this->IdQuestion 	= $IdQuestion;
		$this->Content 		= $Content;
		$this->Order 		= $Order;	
		
		parent::__construct( $Id );
	}
		
	function getId() {return $this->Id;}
	
	function setIdQuestion($IdQuestion) {$this->IdQuestion = $IdQuestion;$this->markDirty();}
	function getIdQuestion() 			{return $this->IdQuestion;}
	function getQuestion() 				{
		$mQuestion 	= new \MVC\Mapper\Question();
		$Question 	= $mQuestion->find($IdQuestion); 
		return $Question;
	}
	
	function setContent($Content) {$this->Content = $Content;$this->markDirty();}
	function getContent() 		{return $this->Content;}
	
	function setOrder($Order) 	{$this->Order = $Order;$this->markDirty();}
	function getOrder() 		{return $this->Order;}
			
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdQuestion' 	=> $this->getIdQuestion(),
			'Content'		=> $this->getContent(),			
			'Order'			=> $this->getOrder()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->IdQuestion 	= $Data[1];
		$this->Content 		= $Data[2];
		$this->Order 		= $Data[3];
    }
	
	function getURLUpdLoad(){return "/admin/setting/question/".$this->getIdQuestion()."/".$this->getId()."/upd/load";}
	function getURLUpdExe()	{return "/admin/setting/question/".$this->getIdQuestion()."/".$this->getId()."/upd/exe";}
	
	//-------------------------------------------------------------------------------
	static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
	static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	//-------------------------------------------------------------------------------
	
}
?>