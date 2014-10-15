<?php 
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Manufacturer extends Object{
	//-------------------------------------------------------------------------------
	//DEFINE PROPERTY
	//-------------------------------------------------------------------------------
	private $Id;
	private $Name;	
	private $Image;
	private $Order;
		
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
	function __construct($Id=null, $Name=null, $Image=null, $Order=null) {
		$this->Id 		= $Id;
		$this->Name 	= $Name;
		$this->Image 	= $Image;
		$this->Order 	= $Order;
	
		parent::__construct( $Id );
	}
		
	function getId() {return $this->Id;}
		
	function setName($Name) {$this->Name = $Name;$this->markDirty();}
	function getName() 		{return $this->Name;}
	
	function setImage($Image){$this->Image = $Image;$this->markDirty();}
	function getImage() 	{return $this->Image;}
	
	function setOrder($Order){$this->Order = $Order;$this->markDirty();}
	function getOrder() 	{return $this->Order;}
			
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'Name'			=> $this->getName(),			
			'Image'			=> $this->getImage(),
			'Order'			=> $this->getOrder()	
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 		= $Data[0];
		$this->Name 	= $Data[1];		
		$this->Image 	= $Data[2];
		$this->Order	= $Data[3];		
    }
	
	//-------------------------------------------------------------------------------
	//GET LIST
	//-------------------------------------------------------------------------------		
		
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLView($Category){
		return "#";
	}
			
	//-------------------------------------------------------------------------------
	static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
	static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	//-------------------------------------------------------------------------------
	
}
?>