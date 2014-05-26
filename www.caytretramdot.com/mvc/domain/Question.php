<?php 
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Question extends Object{
	//-------------------------------------------------------------------------------
	//DEFINE PROPERTY
	//-------------------------------------------------------------------------------
	private $Id;
	private $Content;
	private $Type;
	private $DateCreated;	
	private $DateUpdated;
	private $Owner;
	private $Hint;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
	function __construct($Id=null, $Content=null, $Type=null, $DateCreated=null, $DateUpdated=null, $Owner=null, $Hint=null) {
		$this->Id 			= $Id;
		$this->Content 		= $Content;
		$this->Type 		= $Type;
		$this->DateCreated 	= $DateCreated;
		$this->DateUpdated 	= $DateUpdated;
		$this->Owner 		= $Owner;
		$this->Hint 		= $Hint;
		
		parent::__construct( $Id );
	}
	function setId($Id) {$this->Id = $Id;}
	function getId() 	{return $this->Id;}
		
	function setContent($Content) {$this->Content = $Content;$this->markDirty();}
	function getContent() 		{return $this->Content;}
	
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
	
	function setHint($Hint) 	{$this->Hint = $Hint;$this->markDirty();}
	function getHint() 			{return $this->Hint;}
	
	function getDetailAll(){
		$mQD 	= new \MVC\Mapper\QuestionDetail();
		$QDAll 	= $mQD->findBy(array($this->getId()));
		return $QDAll;
	}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'Content'		=> $this->getContent(),
			'Type'			=> $this->getType(),
			'DateCreated'	=> $this->getDateCreated(),
			'DateUpdated'	=> $this->getDateUpdated(),
			'Owner'			=> $this->getOwner(),
			'Hint'			=> $this->getHint()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->Content 		= $Data[1];
		$this->Type 		= $Data[2];
		$this->DateCreated 	= $Data[3];
		$this->DateUpdated 	= $Data[4];
		$this->Owner 		= $Data[5];
		$this->Hint 		= $Data[6];
    }
	
	function getURLUpdLoad(){return "/admin/setting/question/".$this->getId()."/upd/load";}
	function getURLUpdExe(){return "/admin/setting/question/".$this->getId()."/upd/exe";}
	
	//-------------------------------------------------------------------------------
	static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
	static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	//-------------------------------------------------------------------------------
	
}
?>