<?php 
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class TypeAccount extends Object{
	//-------------------------------------------------------------------------------
	//DEFINE PROPERTY
	//-------------------------------------------------------------------------------
	private $Id;
	private $IdParent;
	private $Code;
	private $Name;		
	private $Key;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
	function __construct($Id=null, $IdParent=null, $Code=null, $Name=null, $Key=null){
		$this->Id 				= $Id;		
		$this->IdParent 		= $IdParent;
		$this->Code 			= $Code;
		$this->Name 			= $Name;		
		$this->Key 				= $Key;
		parent::__construct( $Id );
	}
		
	function getId() {return $this->Id;}

	function setIdParent($IdParent) {$this->IdParent = $IdParent; $this->markDirty();}
	function getIdParent() 			{return $this->IdParent;}
	function getParent(){
		$mTypeAccount 	= new \MVC\Mapper\TypeAccount();				
		$TypeAccount 	= $mTypeAccount->find($this->IdParent);
		return $TypeAccount;
	}
	
	
	function setName($Name) {$this->Name = $Name;$this->markDirty();}
	function getName() 		{return $this->Name;}
	
	function setCode($Code)	{$this->Code = $Code;$this->markDirty();}
	function getCode() 		{return $this->Code;}
	
	function setKey($Key)	{$this->Key = $Key;$this->markDirty();}
	function getKey() 		{return $this->Key;}
	function reKey( ) {
		$Str = new \MVC\Library\String($this->Name);
		$this->Key = $Str->converturl();
	}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdParent'		=> $this->getIdParent(),
			'Name'			=> $this->getName(),			
			'Code'			=> $this->getCode(),
			'Key'			=> $this->getKey()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 				= $Data[0];
		$this->IdParent 		= $Data[1];		
		$this->Code				= $Data[2];
		$this->Name 			= $Data[3];
		$this->reKey();
    }
	
	//-------------------------------------------------------------------------------
	//GET LIST
	//-------------------------------------------------------------------------------
	function getChildAll(){
		$mTypeAccount 	= new \MVC\Mapper\TypeAccount();
		$TypeAccountAll = $mTypeAccount->findByParent(array($this->getId()));
		return $TypeAccountAll;
	}
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------		
	function getURLSettingTypeAccount(){return "/admin/setting/type/account/".$this->getId();}
		
	//-------------------------------------------------------------------------------
	static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
	static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	//-------------------------------------------------------------------------------
	
}
?>