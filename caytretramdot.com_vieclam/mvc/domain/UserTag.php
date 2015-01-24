<?php 
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class UserTag extends Object{
	//-------------------------------------------------------------------------------
	//DEFINE PROPERTY
	//-------------------------------------------------------------------------------
	private $Id;
	private $IdUser;	
	private $IdTag;
	private $PostCount;
		
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
	function __construct($Id=null, $IdUser=null, $IdTag=null, $PostCount=null) {
		$this->Id 			= $Id;
		$this->IdUser 		= $IdUser;
		$this->IdTag 		= $IdTag;
		$this->PostCount 	= $PostCount;
		
		parent::__construct( $Id );
	}
		
	function getId() {return $this->Id;}
		
	function setIdUser($IdUser) {$this->IdUser = $IdUser;$this->markDirty();}
	function getIdUser() 		{return $this->IdUser;}
	function getUser(){
		$mUser = new \MVC\Mapper\User();
		$User = $mUser->find($this->IdUser);
		return $User;
	}
	
	function setIdTag($IdTag){$this->IdTag = $IdTag;$this->markDirty();}
	function getIdTag() 	{return $this->IdTag;}
	function getTag(){
		$mTag 	= new \MVC\Mapper\Tag();
		$Tag 	= $mTag->find($this->IdTag);
		return $Tag;
	}
	
	function setPostCount($PostCount){$this->PostCount = $PostCount; $this->markDirty();}
	function getPostCount() 	{return $this->PostCount;}
	
	function rePostCount(){
		$UTAll = $this->getUser()->getUTAll();
		$this->PostCount = $UTAll->count();
	}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdUser'		=> $this->getIdUser(),
			'IdTag'			=> $this->getIdTag(),
			'PostCount'		=> $this->getPostCount()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 		= $Data[0];
		$this->IdUser 	= $Data[1];
		$this->IdTag	= $Data[2];		
		$this->rePostCount();		
    }
	
	//-------------------------------------------------------------------------------
	//GET LIST
	//-------------------------------------------------------------------------------
			
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------		
	function getURLView(){return "/nguoi-dung/".$this->getIdUser()."/".$this->getIdTag();}
	
	function getURLSetting(){return "/admin/tag/".$this->getId();}
	function getURLSettingPost(){return "/admin/post/".$this->getId();}
		
	//-------------------------------------------------------------------------------
	static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
	static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	//-------------------------------------------------------------------------------
}
?>