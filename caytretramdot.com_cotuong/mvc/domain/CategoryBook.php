<?php 
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class CategoryBook extends Object{
	//-------------------------------------------------------------------------------
	//DEFINE PROPERTY
	//-------------------------------------------------------------------------------
	private $Id;
	private $IdPresentation;
	private $Name;	
	private $Order;	
	private $Key;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
	function __construct($Id=null, $IdPresentation=null, $Name=null, $Order=null, $Key=null){
		$this->Id 				= $Id;
		$this->IdPresentation 	= $IdPresentation;
		$this->Name 			= $Name;
		$this->Order 			= $Order;		
		$this->Key 				= $Key;
		parent::__construct( $Id );
	}
		
	function getId() {return $this->Id;}

	function setIdPresentation($IdPresentation) {$this->IdPresentation = $IdPresentation;$this->markDirty();}
	function getIdPresentation() 				{return $this->IdPresentation;}	
	function getPresentation(){
		$mPresentation = new \MVC\Mapper\Presentation();		
		if ($this->IdPresentation == 0){
			$PresentationAll 	= $mPresentation->findAll();	
			$Presentation 		= $PresentationAll->current();
		}else{
			$Presentation = $mPresentation->find($this->IdPresentation);
		}				
		return $Presentation;
	}
	
	
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
			'IdPresentation'=> $this->getIdPresentation(),
			'Name'			=> $this->getName(),			
			'Order'			=> $this->getOrder(),		
			'Key'			=> $this->getKey()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 				= $Data[0];
		$this->IdPresentation 	= $Data[1];
		$this->Name 			= $Data[2];
		$this->Order			= $Data[3];
		$this->reKey();
    }
	
	//-------------------------------------------------------------------------------
	//GET LIST
	//-------------------------------------------------------------------------------
	function getBookAll(){
		$mBook 		= new \MVC\Mapper\Book();
		$BookAll 	= $mBook->findBy(array($this->getId()));
		return $BookAll;
	}
		
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLView(){return "/sach/".$this->getKey();}
	
	function getURLSetting(){return "/admin/book/".$this->getId();}	
	function getURLSettingBookInsLoad()	{return "/admin/book/".$this->getId()."/ins/load";}
	function getURLSettingBookInsExe()	{return "/admin/book/".$this->getId()."/ins/exe";}
	
	//-------------------------------------------------------------------------------
	static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
	static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	//-------------------------------------------------------------------------------
	
}
?>