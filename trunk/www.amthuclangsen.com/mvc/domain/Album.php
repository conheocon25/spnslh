<?php 
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Album extends Object{
	//-------------------------------------------------------------------------------
	//DEFINE PROPERTY
	//-------------------------------------------------------------------------------
	private $Id;
	private $Date;
	private $Name;
	private $Note;
	private $Order;
	private $Key;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
	function __construct($Id=null, $Date=null, $Name=null, $Note=null, $Order=null, $Key=null){
		$this->Id 		= $Id;
		$this->Date 	= $Date;
		$this->Name 	= $Name;
		$this->Note 	= $Note;
		$this->Order 	= $Order;
		$this->Key 		= $Key;
		parent::__construct( $Id );
	}
		
	function getId() {return $this->Id;}
		
	function setName($Name) {$this->Name = $Name;$this->markDirty();}
	function getName() 		{return $this->Name;}
	
	function setDate($Date) {$this->Date = $Date;$this->markDirty();}
	function getDate() 		{return $this->Date;}
	function getDatePrint() {return $this->Date;}
	
	function setNote($Note) {$this->Note = $Note;$this->markDirty();}
	function getNote() 		{return $this->Note;}
	
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
			'Date'			=> $this->getDate(),
			'Name'			=> $this->getName(),
			'Note'			=> $this->getNote(),
			'Order'			=> $this->getOrder(),
			'Key'			=> $this->getKey()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 		= $Data[0];
		$this->Date 	= $Data[1];
		$this->Name 	= $Data[2];
		$this->Note 	= $Data[3];
		$this->Order	= $Data[4];
		$this->reKey();
    }
	
	//-------------------------------------------------------------------------------
	//GET LIST
	//-------------------------------------------------------------------------------		
	function getImageAll(){
		$mImage 	= new \MVC\Mapper\Image();
		$ImageAll 	= $mImage->findBy(array($this->getId()));
		return $ImageAll;
	}
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLView(){return "/hinh-anh/".$this->getKey();}	
	function getURLSetting(){return "/admin/setting/album/".$this->getId();}
	
	//-------------------------------------------------------------------------------
	static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
	static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	//-------------------------------------------------------------------------------
}
?>