<?php 
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Slide extends Object{
	//-------------------------------------------------------------------------------
	//DEFINE PROPERTY
	//-------------------------------------------------------------------------------
	private $Id;
	private $IdPresentation;
	private $Name;
	private $Order;
	private $Note;
	private $URL;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
	function __construct($Id=null, $IdPresentation=null, $Name=null, $Order=null, $Note=null, $URL=null) {
		$this->Id 		= $Id;
		$this->IdPresentation = $IdPresentation;
		$this->Name 	= $Name;
		$this->Order 	= $Order;
		$this->Note 	= $Note;
		$this->URL 		= $URL;
		parent::__construct( $Id );
	}
		
	function getId() {return $this->Id;}
	
	function setIdPresentation($IdPresentation) {$this->IdPresentation = $IdPresentation;$this->markDirty();}
	function getIdPresentation() 				{return $this->IdPresentation;}
	function getPresentation(){
		$mPresentation = new \MVC\Mapper\Presentation();
		$Presentation = $mPresentation->find($IdPresentation);
		return $Presentation;
	}
	
	function setName($Name) {$this->Name = $Name;$this->markDirty();}
	function getName() 		{return $this->Name;}
	
	function setOrder($Order){$this->Order = $Order;$this->markDirty();}
	function getOrder() 	{return $this->Order;}
	
	function setNote($Note)	{$this->Note = $Note;$this->markDirty();}
	function getNote() 		{return $this->Note;}
	
	function setURL($URL)	{$this->URL = $URL;$this->markDirty();}
	function getURL() 		{return $this->URL;}
		
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdPresentation'=> $this->getIdPresentation(),
			'Name'			=> $this->getName(),			
			'Order'			=> $this->getOrder(),
			'Note'			=> $this->getNote(),
			'URL'			=> $this->getURL()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 				= $Data[0];
		$this->IdPresentation 	= $Data[1];
		$this->Name 			= $Data[2];		
		$this->Order			= $Data[3];
		$this->Note				= $Data[4];
		$this->URL				= $Data[5];
    }
	
	//-------------------------------------------------------------------------------
	//GET LIST
	//-------------------------------------------------------------------------------		
		
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLSettingUpdLoad(){
		return "/admin/presentation/".$this->getIdPresentation()."/".$this->getId()."/upd/load";
	}	
	function getURLSettingUpdExe(){
		return "/admin/presentation/".$this->getIdPresentation()."/".$this->getId()."/upd/exe";
	}
		
	//-------------------------------------------------------------------------------
	static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
	static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	//-------------------------------------------------------------------------------	
}
?>