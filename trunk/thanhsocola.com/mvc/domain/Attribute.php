<?php 
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Attribute extends Object{
	//-------------------------------------------------------------------------------
	//DEFINE PROPERTY
	//-------------------------------------------------------------------------------
	private $Id;
	private $IdGAttribute;
	private $Name;
	private $Order;

	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
	function __construct($Id=null, $IdGAttribute=null, $Name=null, $Order=null) {
		$this->Id 				= $Id;
		$this->IdGAttribute		= $IdGAttribute;
		$this->Name 			= $Name;
		$this->Order 			= $Order;
		
		parent::__construct( $Id );
	}
		
	function getId() {return $this->Id;}
	
	function setIdGAttribute($IdGAttribute) {$this->IdGAttribute = $IdGAttribute;$this->markDirty();}
	function getIdGAttribute() 				{return $this->IdGAttribute;}
	
	function setName($Name) {$this->Name = $Name;$this->markDirty();}
	function getName() 		{return $this->Name;}
	
	function setOrder($Order){$this->Order = $Order;$this->markDirty();}
	function getOrder() 	{return $this->Order;}
			
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdGAttribute'	=> $this->getIdGAttribute(),
			'Name'			=> $this->getName(),
			'Order'			=> $this->getOrder()	
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 				= $Data[0];
		$this->IdGAttribute 	= $Data[1];		
		$this->Name 			= $Data[2];		
		$this->Order			= $Data[3];
    }
	
	//-------------------------------------------------------------------------------
	//GET LIST
	//-------------------------------------------------------------------------------		
		
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLView(){
		return "/san-pham/".$this->getCategory()->getKey();
	}
	
	function getURLSetting(){return "/admin/setting/gattribute/".$this->getId();}
	
	//-------------------------------------------------------------------------------
	static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
	static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	//-------------------------------------------------------------------------------
	
}
?>