<?php 
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Exam extends Object{
	//-------------------------------------------------------------------------------
	//DEFINE PROPERTY
	//-------------------------------------------------------------------------------
	private $Id;
	private $Name;	
	private $DateCreated;
	private $DateUpdated;
	private $Owner;
	private $Time;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
	function __construct($Id=null, $Name=null, $DateCreated=null, $DateUpdated=null, $Owner=null, $Time=null) {
		$this->Id 			= $Id;
		$this->Name 		= $Name;		
		$this->DateCreated 	= $DateCreated;
		$this->DateUpdated 	= $DateUpdated;
		$this->Owner 		= $Owner;		
		$this->Time 		= $Time;
		
		parent::__construct( $Id );
	}
	function setId($Id) {$this->Id = $Id;}
	function getId() 	{return $this->Id;}
		
	function setName($Name) {$this->Name = $Name;$this->markDirty();}
	function getName() 		{return $this->Name;}
	function getNameReduce()	{$S = new \MVC\Library\String($this->Name);return $S->reduceHTML(120);}
	
	function setType($Type) {$this->Type = $Type;$this->markDirty();}
	function getType() 		{return $this->Type;}
	
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
			
	function setTime($Time) 	{$this->Time = $Time;$this->markDirty();}
	function getTime() 			{return $this->Time;}
	
	function getQuestionAll(){
		$mQD 	= new \MVC\Mapper\ExamDetail();
		$QDAll 	= $mQD->findBy(array($this->getId()));
		return $QDAll;
	}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'Name'			=> $this->getName(),			
			'DateCreated'	=> $this->getDateCreated(),
			'DateUpdated'	=> $this->getDateUpdated(),
			'Owner'			=> $this->getOwner(),			
			'Time'			=> $this->getTime()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->Name 		= $Data[1];		
		$this->DateCreated 	= $Data[2];
		$this->DateUpdated 	= $Data[3];
		$this->Owner 		= $Data[4];		
		$this->Time 		= $Data[5];
    }
	
	function getURLSetting(){return "/admin/setting/exam/".$this->getId();}
	function getURLUpdLoad(){return "/admin/setting/exam/".$this->getId()."/upd/load";}
	function getURLUpdExe(){return "/admin/setting/exam/".$this->getId()."/upd/exe";}
	
	//-------------------------------------------------------------------------------
	static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
	static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	//-------------------------------------------------------------------------------
	
}
?>