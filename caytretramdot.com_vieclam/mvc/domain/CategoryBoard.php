<?php 
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class CategoryBoard extends Object{
	//-------------------------------------------------------------------------------
	//DEFINE PROPERTY
	//-------------------------------------------------------------------------------
	private $Id;
	private $Name;	
	private $Order;	
	private $Key;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
	function __construct($Id=null, $Name=null, $Order=null, $Key=null){
		$this->Id 			= $Id;
		$this->Name 		= $Name;
		$this->Order 		= $Order;		
		$this->Key 			= $Key;
		parent::__construct( $Id );
	}
		
	function getId() {return $this->Id;}
		
	function setName($Name) {$this->Name = $Name;$this->markDirty();}
	function getName() 		{return $this->Name;}
	
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
			'Order'			=> $this->getOrder(),		
			'Key'			=> $this->getKey()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 		= $Data[0];
		$this->Name 	= $Data[1];
		$this->Order	= $Data[2];				
		$this->reKey();
    }
	
	//-------------------------------------------------------------------------------
	//GET LIST
	//-------------------------------------------------------------------------------
	function getBoardAll(){
		$mBoard		= new \MVC\Mapper\Board();
		$BoardAll 	= $mBoard->findBy(array($this->getId()));
		return $BoardAll;
	}
		
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLView(){return "/van-co/".$this->getKey();}	
	function getURLSetting(){return "/admin/board/".$this->getId();}
	function getURLSettingBoardInsLoad(){return "/admin/board/".$this->getId()."/ins/load"	;}
	function getURLSettingBoardInsExe()	{return "/admin/board/".$this->getId()."/ins/exe"	;}
		
	//-------------------------------------------------------------------------------
	static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
	static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	//-------------------------------------------------------------------------------
	
}
?>