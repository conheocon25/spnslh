<?php 
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Linked extends Object{
	//-------------------------------------------------------------------------------
	//DEFINE PROPERTY
	//-------------------------------------------------------------------------------
	private $Id;
	private $Name;
	private $Logo;
	private $Website;
	private $Note;
	private $Order;
	private $Key;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
	function __construct($Id=null, $Name=null, $Logo=null, $Website=null, $Note=null, $Order=null, $Key=null) {
		$this->Id 		= $Id;
		$this->Name 	= $Name;
		$this->Logo 	= $Logo;
		$this->Website 	= $Website;
		$this->Note 	= $Note;
		$this->Order 	= $Order;
		$this->Key 		= $Key;
		parent::__construct( $Id );
	}
		
	function getId() {return $this->Id;}
		
	function setName($Name) {$this->Name = $Name;$this->markDirty();}
	function getName() 		{return $this->Name;}
	
	function setLogo($Logo) {$this->Logo = $Logo;$this->markDirty();}
	function getLogo() 		{return $this->Logo;}
	
	function setWebsite($Website) 	{$this->Website = $Website;$this->markDirty();}
	function getWebsite() 			{return $this->Website;}
	
	function setNote($Note) 	{$this->Note = $Note;$this->markDirty();}
	function getNote() 			{return $this->Note;}
	
	function setOrder($Order){$this->Order = $Order;$this->markDirty();}
	function getOrder() 	{return $this->Order;}
	
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
			'Logo'			=> $this->getLogo(),
			'Website'		=> $this->getWebsite(),
			'Note'			=> $this->getNote(),
			'Order'			=> $this->getOrder(),
			'Key'			=> $this->getKey()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 		= $Data[0];
		$this->Name 	= $Data[1];
		$this->Logo 	= $Data[2];		
		$this->Website 	= $Data[3];
		$this->Note 	= $Data[4];
		$this->Order	= $Data[5];
		$this->reKey();
    }
	
	//-------------------------------------------------------------------------------
	//GET LIST
	//-------------------------------------------------------------------------------		
		
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLView(){
		return "/lien-ket/".$this->getKey();
	}
	
	function getURLSetting(){return "/admin/setting/linked/".$this->getId();}
	
	//-------------------------------------------------------------------------------
	static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
	static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	//-------------------------------------------------------------------------------
	
}
?>