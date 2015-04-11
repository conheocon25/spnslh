<?php 
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Course extends Object{
	//-------------------------------------------------------------------------------
	//DEFINE PROPERTY
	//-------------------------------------------------------------------------------
	private $Id;
	private $IdCookMethod;
	private $Name;
	private $DateTimeCreated;
	private $DateTimeUpdated;
	private $Rank;
	private $Key;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
	function __construct($Id=null, $IdCookMethod=null, $Name=null, $DateTimeCreated=null, $DateTimeUpdated=null, $Rank=null, $Key=null){
		$this->Id 				= $Id;
		$this->IdCookMethod		= $IdCookMethod;
		$this->Name 			= $Name;
		$this->DateTimeCreated	= $DateTimeCreated;
		$this->DateTimeUpdated	= $DateTimeUpdated;
		$this->Rank 			= $Rank;		
		$this->Key 				= $Key;
		parent::__construct( $Id );
	}
		
	function getId() {return $this->Id;}
	
	function setIdCookMethod($IdCookMethod) {$this->IdCookMethod = $IdCookMethod;$this->markDirty();}
	function getIdCookMethod() 				{return $this->IdCookMethod;}
	function getCookMethod(){
		$mCookMethod 	= new \MVC\Mapper\CookMethod();
		$CookMethod 	= $mCookMethod->find($this->IdCookMethod);
		return $CookMethod;
	}
	
	function setName($Name) {$this->Name = $Name;$this->markDirty();}
	function getName() 		{return $this->Name;}
	
	function setRank($Rank){$this->Rank = $Rank;$this->markDirty();}
	function getRank() 	{return $this->Rank;}
	
	function setDateTimeCreated($DateTimeCreated ) {$this->DateTimeCreated = $DateTimeCreated; $this->markDirty();}
	function getDateTimeCreated(){return $this->DateTimeCreated;}
	function getDateTimeCreatedPrint(){
		$t = strtotime($this->DateTimeCreated);		
		return date('d/m/Y H:i',$t);
	}
	
	function setDateTimeUpdated($DateTimeCreated ) {$this->DateTimeUpdated = $DateTimeUpdated; $this->markDirty();}
	function getDateTimeUpdated(){return $this->DateTimeUpdated;}
	function getDateTimeUpdatedPrint(){
		$t = strtotime($this->DateTimeUpdated);
		return date('d/m/Y H:i',$t);
	}
		
	function setKey($Key)	{$this->Key = $Key;$this->markDirty();}
	function getKey() 		{return $this->Key;}
	function reKey( ) {
		$Str = new \MVC\Library\String($this->Name);
		$this->Key = $Str->converturl();
	}
	
	function toJSON(){
		$json = array(
			'Id' 				=> $this->getId(),
			'IdCookMethod' 		=> $this->getIdCookMethod(),
			'Name'				=> $this->getName(),
			'DateTimeCreated'	=> $this->getDateTimeCreated(),
			'DateTimeUpdated'	=> $this->getDateTimeUpdated(),
			'Rank'				=> $this->getRank(),		
			'Key'				=> $this->getKey()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 				= $Data[0];
		$this->IdCookMethod		= $Data[1];
		$this->Name 			= $Data[2];
		if (!isset($this->DateTimeCreated)){
			$this->DateTimeCreated 	= \date('Y-m-d H:i');
		}		
		$this->DateTimeUpdated 	= \date('Y-m-d H:i');		
		$this->Rank				= $Data[3];
		$this->reKey();
    }
	
	//-------------------------------------------------------------------------------
	//GET LIST
	//-------------------------------------------------------------------------------
	function getVideoAll(){
		$mVideo 	= new \MVC\Mapper\Video();
		$VideoAll 	= $mVideo->findByCourse(array($this->getId()));
		return $VideoAll;
	}
	
	function getPostAll(){
		$mPost 		= new \MVC\Mapper\Post();
		$PostAll 	= $mPost->findBy(array($this->getId()));
		return $PostAll;
	}
			
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLView()			{return "/mon/".$this->getKey();}
	function getURLSettingVideo()	{return "/admin/course/".$this->getId()."/video";}	
	function getURLSettingTrick()	{return "/admin/course/".$this->getId()."/trick";}
	
	function getURLSettingPost()		{return "/admin/course/".$this->getId()."/post";}
	function getURLSettingPostIns()		{return "/admin/course/".$this->getId()."/post/ins";}
	function getURLSettingPostInsExe()	{return "/admin/course/".$this->getId()."/post/ins/exe";}
	
	//-------------------------------------------------------------------------------
	static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
	static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	//-------------------------------------------------------------------------------
	
}
?>