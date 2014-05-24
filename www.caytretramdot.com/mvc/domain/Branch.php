<?php 
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Branch extends Object{
	//-------------------------------------------------------------------------------
	//DEFINE PROPERTY
	//-------------------------------------------------------------------------------
	private $Id;
	private $Name;
	private $Address;
	private $X;
	private $Y;
	private $Phone1;
	private $Phone2;
	private $Email1;
	private $Email2;	
	private $Order;
		
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
	function __construct($Id=null, $Name=null, $Address=null, $X=null, $Y=null, $Phone1=null, $Phone2=null, $Email1=null, $Email2=null, $Order=null) {
		$this->Id 			= $Id;
		$this->Name 		= $Name;
		$this->Address 		= $Address;
		$this->X 			= $X;
		$this->Y 			= $Y;
		$this->Phone1 		= $Phone1;
		$this->Phone2 		= $Phone2;
		$this->Email1 		= $Email1;
		$this->Email2 		= $Email2;
		$this->Order 		= $Order;
		
		parent::__construct( $Id );
	}
		
	function getId() {return $this->Id;}
		
	function setName($Name) {$this->Name = $Name;$this->markDirty();}
	function getName() 		{return $this->Name;}
	
	function setAddress($Address) 	{$this->Address = $Address;$this->markDirty();}
	function getAddress() 			{return $this->Address;}
	
	function setX($X) 				{$this->X = $X;$this->markDirty();}
	function getX() 				{return $this->X;}
	
	function setY($Y) 				{$this->Y = $Y;$this->markDirty();}
	function getY() 				{return $this->Y;}
	
	function setPhone1($Phone1) 	{$this->Phone1 = $Phone1; $this->markDirty();}
	function getPhone1() 			{return $this->Phone1;}
	
	function setPhone2($Phone2) 	{$this->Phone2 = $Phone2; $this->markDirty();}
	function getPhone2() 			{return $this->Phone2;}
	
	function setEmail1($Email1) 	{$this->Email1 = $Email1; $this->markDirty();}
	function getEmail1() 			{return $this->Email1;}
	
	function setEmail2($Email2) 	{$this->Email2 = $Email2; $this->markDirty();}
	function getEmail2() 			{return $this->Email2;}
	
	function setOrder($Order){$this->Order = $Order;$this->markDirty();}
	function getOrder() 	{return $this->Order;}
			
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'Name'			=> $this->getName(),			
			'Address'		=> $this->getAddress(),
			'X'				=> $this->getX(),
			'Y'				=> $this->getY(),
			'Phone1'		=> $this->getPhone1(),
			'Phone2'		=> $this->getPhone2(),
			'Email1'		=> $this->getEmail1(),
			'Email2'		=> $this->getEmail2(),
			'Order'			=> $this->getOrder()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 		= $Data[0];
		$this->Name 	= $Data[1];		
		$this->Address 	= $Data[2];
		$this->X 		= $Data[3];
		$this->Y 		= $Data[4];
		$this->Phone1	= $Data[5];
		$this->Phone2	= $Data[6];
		$this->Email1	= $Data[7];
		$this->Email2	= $Data[8];
		$this->Order	= $Data[9];		
    }
	
	//-------------------------------------------------------------------------------
	//GET LIST
	//-------------------------------------------------------------------------------		
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
		
	//-------------------------------------------------------------------------------
	static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
	static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	//-------------------------------------------------------------------------------
	
}
?>