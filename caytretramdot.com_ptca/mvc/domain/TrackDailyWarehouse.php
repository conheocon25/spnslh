<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class TrackDailyWarehouse extends Object{

    private $Id;
	private $IdTrack;
	private $IdWarehouse;
	private $Date;
		
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id				= null,
		$IdTrack		= null, 
		$IdWarehouse	= null, 
		$Date			= null		
	){
        $this->Id 			= $Id;
		$this->IdTrack 		= $IdTrack;
		$this->IdWarehouse 	= $IdWarehouse;
		$this->Date 		= $Date;
				
        parent::__construct( $Id );
    }

    function getId() {return $this->Id;}
		
    function setIdTrack( $IdTrack ) 	{$this->IdTrack = $IdTrack;$this->markDirty();}   
	function getIdTrack( ) 				{return $this->IdTrack;}
	function getTrack( ){
		$mTrack 	= new \MVC\Mapper\Track();
		$Track 		= $mTrack->find($this->IdTrack);
		return $Track;
	}
			
	function setIdWarehouse( $IdWarehouse ) {$this->IdWarehouse = $IdWarehouse;$this->markDirty();}   
	function getIdWarehouse( ) {return $this->IdWarehouse;}
	function getWarehouse( ){
		$mWarehouse = new \MVC\Mapper\Warehouse();
		$Warehouse = $mWarehouse->find($this->IdWarehouse);
		return $Warehouse;
	}
		
	function setDate( $Date ) {$this->Date = $Date;$this->markDirty();}   
	function getDate( ) {return $this->Date;}
	function getDatePrint( ) {$D = new \MVC\Library\Date($this->Date);return $D->getDateFormat();}
	function getDateShortPrint( ) {return date('d/m',strtotime($this->Date));}
			
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	function getGoodAll(){
		$mTDWG 	= new \MVC\Mapper\TrackDailyWarehouseGood();
		$TDWAll = $mTDWG->findBy(array($this->getId()));
		return $TDWAll;
	}
		
	function generate(){
		$mTDBCustomer 	= new \MVC\Mapper\TrackDailyWarehouseCustomer();
		$CustomerAll 	= $this->getWarehouse()->getCustomerAll();
		while ($CustomerAll->valid()){
			$Customer = $CustomerAll->current();
			
			$TDBCustomer = new \MVC\Domain\TrackDailyWarehouseCustomer(
				null,
				$this->getId(),
				$Customer->getId(),
				0,
				0,
				0
			);
			$mTDBCustomer->insert($TDBCustomer);
			
			$CustomerAll->next();
		}
	}
			
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLCustomer()		{return "/don-vi/".$this->getWarehouse()->getKey()."/bao-cao/".$this->getIdTrack()."/khach-hang/".$this->getId();}
	function getURLCustomerPrint()	{return "/don-vi/".$this->getWarehouse()->getKey()."/bao-cao/".$this->getIdTrack()."/khach-hang/".$this->getId()."/in";}
	
	function getURLWarehouse()		{return "/kho-hang/".$this->getWarehouse()->getKey()."/bao-cao/".$this->getIdTrack()."/".$this->getId();}
	function getURLWarehouseExe()	{return "/kho-hang/".$this->getWarehouse()->getKey()."/bao-cao/".$this->getIdTrack()."/".$this->getId()."/exe";}
	function getURLWarehousePrint()	{return "/kho-hang/".$this->getWarehouse()->getKey()."/bao-cao/".$this->getIdTrack()."/".$this->getId()."/in";}
	
	//-------------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}	
}
?>
