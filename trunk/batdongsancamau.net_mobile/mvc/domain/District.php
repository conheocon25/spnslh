<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class District extends Object{

    private $Id;
	private $IdProvince;
	private $Name;	
	private $Latitude;
	private $Longitude;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $IdProvince=null, $Name=null, $Latitude=0, $Longitude=0){
		$this->Id 			= $Id;
		$this->IdProvince	= $IdProvince;
		$this->Name 		= $Name; 		
		$this->Latitude 	= $Latitude;
		$this->Longitude 	= $Longitude;
		
		parent::__construct( $Id );
	}
    function getId() {return $this->Id;}	
	
	function setIdProvince( $IdProvince ) {$this->IdProvince = $IdProvince;$this->markDirty();}   
	function getIdProvince( ) {return $this->IdProvince;}
	function getProvince( ) {
		$mProvince = new \MVC\Mapper\Province();
		$Province = $mProvince->find($this->IdProvince);
		return $Province;
	}
	
    function setName( $Name ) {$this->Name = $Name;$this->markDirty();}   
	function getName( ) {return $this->Name;}
			
	function setLatitude( $Latitude ) {$this->Latitude = $Latitude;$this->markDirty();}   
	function getLatitude( ) {return $this->Latitude;}	
	
	function setLongitude( $Longitude ) {$this->Longitude = $Longitude;$this->markDirty();}   
	function getLongitude( ) {return $this->Longitude;}	
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdProvince' 	=> $this->getIdProvince(),
			'Name'			=> $this->getName(),	
		 	'Latitude'		=> $this->getLatitude(),
			'Longitude'		=> $this->getLongitude()			
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 		= $Data[0];
		$this->IdProvince	= $Data[1];
		$this->Name 	= $Data[2];		
		$this->Latitude = $Data[3];		
		$this->Longitude= $Data[4];
    }
			
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	function getPagodaAll(){
		$mPagoda 	= new \MVC\Mapper\Pagoda();
		$PagodaAll 	= $mPagoda->findByDistrict(array($this->getId()));
		return $PagodaAll;
	}	
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------			
	function getURLSettingPagoda(){
		return "/app/province/".$this->getIdProvince()."/".$this->getId();
	}
	
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	
}
?>