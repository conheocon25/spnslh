<?php 
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Test extends Object{
	//-------------------------------------------------------------------------------
	//DEFINE PROPERTY
	//-------------------------------------------------------------------------------
	private $Id;
	private $IdExam;
	private $DateCreated;
	private $DateUpdated;
	private $Owner;
	private $Score;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
	function __construct($Id=null, $IdExam=null, $DateCreated=null, $DateUpdated=null, $Owner=null, $Score=null) {
		$this->Id 			= $Id;
		$this->IdExam 		= $IdExam;		
		$this->DateCreated 	= $DateCreated;
		$this->DateUpdated 	= $DateUpdated;
		$this->Owner 		= $Owner;		
		$this->Score 		= $Score;
		
		parent::__construct( $Id );
	}
	function setId($Id) {$this->Id = $Id;}
	function getId() 	{return $this->Id;}
		
	function setIdExam($IdExam) {$this->IdExam = $IdExam;$this->markDirty();}
	function getIdExam() 		{return $this->IdExam;}
	function getExam(){
		$mExam 	= new \MVC\Mapper\Exam();
		$Exam 	= $mExam->find($this->IdExam);
		return $Exam;
	}
		
	function setDateCreated($DateCreated) 	{$this->DateCreated = $DateCreated;$this->markDirty();}
	function getDateCreated() 				{return $this->DateCreated;}
	function getDateCreatedPrint() 			{
		$DateCreated= date('d/m/Y h:i', \strtotime($this->DateCreated));
		return $DateCreated;
	}
	
	function setDateUpdated($DateUpdated) 	{$this->DateUpdated = $DateUpdated;$this->markDirty();}
	function getDateUpdated() 				{return $this->DateUpdated;}
	function getDateUpdatedPrint() 			{
		$DateUpdated= date('d/m/Y h:i', \strtotime($this->DateUpdated));
		return $DateUpdated;
	}
	
	function setOwner($Owner) 	{$this->Owner = $Owner;$this->markDirty();}
	function getOwner() 		{return $this->Owner;}
			
	function setScore($Score) 	{$this->Score = $Score;$this->markDirty();}
	function getScore( ) 		{return $this->Score;}
	
	function getDetailAll(){
		$mTD 	= new \MVC\Mapper\TestDetail();
		$TDAll 	= $mTD->findBy(array($this->getId()));
		return $TDAll;
	}
			
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdExam'		=> $this->getIdExam(),			
			'DateCreated'	=> $this->getDateCreated(),
			'DateUpdated'	=> $this->getDateUpdated(),
			'Owner'			=> $this->getOwner(),			
			'Score'			=> $this->getScore()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->IdExam 		= $Data[1];		
		$this->DateCreated 	= $Data[2];
		$this->DateUpdated 	= $Data[3];
		$this->Owner 		= $Data[4];		
		$this->Score 		= $Data[5];
    }	
	function getURLSetting(){return "/admin/test/".$this->getId();}
		
	//-------------------------------------------------------------------------------
	static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
	static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	//-------------------------------------------------------------------------------
	
}
?>