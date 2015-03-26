<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class TrackWarehouse extends Object{
    private $Id;
	private $IdTrack;
	private $IdWarehouse;
	private $IdGood;
	private $Count;
	private $Price;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
			$Id=null,
			$IdTrack=null,
			$IdWarehouse=null, 
			$IdGood=null,
			$Count=null,
			$Price=null
	){
			$this->Id 					= $Id; 
			$this->IdTrack 				= $IdTrack; 
			$this->IdWarehouse 			= $IdWarehouse; 
			$this->IdGood 				= $IdGood;
			$this->Count 				= $Count;
			$this->Price 				= $Price;
			
			parent::__construct( $Id );
	}
    function setId($Id) {return $this->Id = $Id;}
	function getId() 	{return $this->Id;}
	
	function setIdTrack( $IdTrack ) {$this->IdTrack = $IdTrack;$this->markDirty();} 
	function getIdTrack( ) 			{return $this->IdTrack;}
	function getTrack( ) {
		$mTrack = new \MVC\Mapper\Track();
		$Track 	= $mTrack->find($this->IdTrack);
		return $Track;
	}
	
    function setIdWarehouse( $IdWarehouse ) {$this->IdWarehouse = $IdWarehouse;$this->markDirty();}
	function getIdWarehouse( ) {return $this->IdWarehouse;}	
	function getWarehouse( ) {
		$mWarehouse = new \MVC\Mapper\Warehouse();
		$Warehouse = $mWarehouse->find($IdWarehouse);
		return $Warehouse;
	}
	
	function setIdGood( $IdGood ) 	{$this->IdGood= $IdGood;$this->markDirty();}   
	function getIdGood( ) 			{return $this->IdGood;}	
	function getGood( ) {
		$mGood 	= new \MVC\Mapper\Good();
		$Good 	= $mGood->find($this->IdGood);
		return $Good;
	}
	
	function setCount( $Count ) 	{$this->Count = $Count; $this->markDirty();}
	function getCount( ) 			{return $this->Count;}
	function getCountPrint( ) 		{		
		$num = number_format($this->Count, 0, ',', ' ');
		return $num;
	}
	
	function setPrice( $Price ) 	{$this->Price = $Price; $this->markDirty();}
	function getPrice( ) 			{return $this->Price;}	
	function getPricePrint( ) 		{		
		$num = number_format($this->Price, 0, ',', ' ');
		return $num;
	}
	
					
	function toJSON(){
		$json = array(
			'Id' 					=> $this->getId(),			
			'IdTrack'				=> $this->getIdTrack(),
			'IdWarehouse'			=> $this->getIdWarehouse(),
			'IdGood'				=> $this->getIdGood(),
			'Count'					=> $this->getCount(),
			'Price'					=> $this->getPrice()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){        
		$this->Id 				= $Data[0];
		$this->IdTrack 			= $Data[1];		
		$this->IdWarehouse 		= $Data[2];
		$this->IdGood 			= $Data[3];
		$this->Count 			= $Data[4];
		$this->Price			= $Data[5];
    }
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------	
						
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLSetting(){	return "/admin/setting/track/".$this->getId();}
						
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
}
?>