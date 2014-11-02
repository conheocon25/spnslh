<?php 
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Tag extends Object{
	//-------------------------------------------------------------------------------
	//DEFINE PROPERTY
	//-------------------------------------------------------------------------------
	private $Id;
	private $Name;	
	private $Order;
	private $Position;
	private $Key;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
	function __construct($Id=null, $Name=null, $Order=null, $Position=null, $Key=null) {
		$this->Id 		= $Id;
		$this->Name 	= $Name;
		$this->Order 	= $Order;
		$this->Position = $Position;
		$this->Key 		= $Key;
		parent::__construct( $Id );
	}
		
	function getId() {return $this->Id;}
		
	function setName($Name) {$this->Name = $Name;$this->markDirty();}
	function getName() 		{return $this->Name;}
	
	function setOrder($Order){$this->Order = $Order;$this->markDirty();}
	function getOrder() 	{return $this->Order;}
	
	function setPosition($Position){$this->Position = $Position; $this->markDirty();}
	function getPosition() 	{return $this->Position;}
		
	function setKey($Key)	{$this->Key = $Key;$this->markDirty();}
	function getKey() 		{return $this->Key;}
	function reKey( ) {
		$Str = new \MVC\Library\String($this->Name);
		$this->Key = $Str->converturl();
	}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'Name'			=> $this->getName(),			
			'Order'			=> $this->getOrder(),
			'Position'		=> $this->getPosition(),
			'Key'			=> $this->getKey()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 		= $Data[0];
		$this->Name 	= $Data[1];
		$this->Order	= $Data[2];
		$this->Position	= $Data[3];
		$this->reKey();
    }
	
	//-------------------------------------------------------------------------------
	//GET LIST
	//-------------------------------------------------------------------------------
	function getPostAll(){
		$mPT 	= new \MVC\Mapper\PostTag();
		$PTAll 	= $mPT->findByTag(array($this->getId()));
		return $PTAll;
	}
	
	function getPostTop4(){
		$mPT 	= new \MVC\Mapper\PostTag();
		$PTAll 	= $mPT->findByTagTop4(array($this->getId()));
		return $PTAll;
	}
		
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLView(){return "/bai-viet/".$this->getKey();}
	
	function getURLSetting(){return "/admin/setting/tag/".$this->getId();}
	function getURLSettingPost(){return "/admin/post/".$this->getId();}
	function getURLSettingPostInsLoad()	{return "/admin/post/".$this->getId()."/ins/load";}
	function getURLSettingPostInsExe()	{return "/admin/post/".$this->getId()."/ins/exe";}
	
	//-------------------------------------------------------------------------------
	static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
	static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	//-------------------------------------------------------------------------------
	
}
?>