<?php 
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Domain extends Object{
	//-------------------------------------------------------------------------------
	//DEFINE PROPERTY
	//-------------------------------------------------------------------------------
	private $Id;
	private $Name;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
	function __construct($Id=null, $Name=null) {
		$this->Id = $Id;
		$this->Name = $Name;
		parent::__construct( $Id );
	}
		
	function getId() {return $this->Id;}
		
	function setName($Name) {$this->Name = $Name;$this->markDirty();}
	function getName() {return $this->Name;}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'Name'			=> $this->getName()	
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id = $Data[0];	
		$this->Name = $Data[1];
    }
	
	//-------------------------------------------------------------------------------
	//GET LIST
	//-------------------------------------------------------------------------------		
	function getSolveAll(){
		$mSolve = new \MVC\Mapper\Solve();
		$SolveAll = $mSolve->findBy(array($this->getId()));
		return $SolveAll;
	}
	
	function getQuestionAll(){
		$mQuestion 		= new \MVC\Mapper\Question();
		$QuestionAll 	= $mQuestion->findBy(array($this->getId()));
		return $QuestionAll;
	}
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLRecommend()		{return "/tu-van/".$this->getId();}	
	function getURLRecommendExe()	{return "/tu-van/".$this->getId()."/bat-dau";}	
	function getURLRecommendResult(){return "/tu-van/".$this->getId()."/ket-qua";}
	function getURLRecommendNext()	{return "/tu-van/".$this->getId()."/toi";}	
	function getURLRecommendBack()	{return "/tu-van/".$this->getId()."/lui";}
	function getURLRecommendStop()	{return "/tu-van/".$this->getId()."/huy";}
	function getURLRecommendTry()	{return "/tu-van/".$this->getId()."/thu-lai";}
	function getURLRecommendTrace()	{return "/tu-van/".$this->getId()."/theo-vet";}
	function getURLRecommendLike()	{return "/tu-van/".$this->getId()."/thich";}
	function getURLRecommendFeed()	{return "/tu-van/".$this->getId()."/phan-hoi";}
	function getURLRecommendAnswerYes()	{return "/tu-van/".$this->getId()."/tra-loi/yes";}
	function getURLRecommendAnswerNo()	{return "/tu-van/".$this->getId()."/tra-loi/no";}
	
	function getURLSettingQuestion(){
		return "/setting/domain/".$this->getId()."/question";
	}
	
	function getURLSettingSolve(){
		return "/setting/domain/".$this->getId()."/solve";
	}
	
	function getURLSettingPrepare(){
		return "/setting/domain/".$this->getId()."/prepare";
	}
	
	//-------------------------------------------------------------------------------
	static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
	static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	//-------------------------------------------------------------------------------
	
}
?>