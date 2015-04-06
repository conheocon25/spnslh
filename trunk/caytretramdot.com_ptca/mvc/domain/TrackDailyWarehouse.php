<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class TrackDailyWarehouse extends Object{

    private $Id;
	private $IdTrack;
	private $IdWarehouse;
	private $Date;
	private $Old;
	private $Import;
	private $Export;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id				= null,
		$IdTrack		= null, 
		$IdWarehouse	= null, 
		$Date			= null, 
		$Old			= null, 
		$Import			= null, 
		$Export			= null
	){
        $this->Id 			= $Id;
		$this->IdTrack 		= $IdTrack;
		$this->IdWarehouse 	= $IdWarehouse;
		$this->Date 		= $Date;
		$this->Old 			= $Old;
		$this->Import 		= $Import;
		$this->Export 		= $Export;
				
        parent::__construct( $Id );
    }

    function setId($Id) {$this->Id =$Id;}
	function getId() 	{return $this->Id;}
		
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
	
	function setOld( $Old ) {$this->Old = $Old;$this->markDirty();}   
	function getOld( ) 		{return $this->Old;}
	function getOldPrint( ) {
		$num = number_format($this->getOld(), 0, ',', ' ');
		return $num;
	}
	
	function setImport( $Import ) {$this->Import = $Import;$this->markDirty();}   
	function getImport( ) {return $this->Import;}
	function getImportPrint( ) {
		$num = number_format($this->getImport(), 0, ',', ' ');
		return $num;
	}
	
	function setExport( $Export ) 	{$this->Export = $Export;$this->markDirty();}   
	function getExport( ) 			{return $this->Export;}
	function getExportPrint( ) {
		$num = number_format($this->getExport(), 0, ',', ' ');
		return $num;
	}
		
	function getNew( ) {
		return ($this->Old + $this->Import - $this->Export);
	}
	function getNewPrint( ) {
		$num = number_format($this->getNew(), 0, ',', ' ');
		return $num;
	}
			
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	function getGoodAll(){
		$mTDWG 	= new \MVC\Mapper\TrackDailyWarehouseGood();
		$TDWAll = $mTDWG->findBy(array($this->getId()));
		return $TDWAll;
	}
		
	function generate(){
		$mTDWG 		= new \MVC\Mapper\TrackDailyWarehouseGood();
		$mGood 		= new \MVC\Mapper\Good();
		$GoodAll 	= $mGood->findAll();
		
		while ($GoodAll->valid()){
			$Good 	= $GoodAll->current();
			$Old 	= 0;
			$Import	= 0;
			$Export	= 0;
			
			$TDWG = new \MVC\Domain\TrackDailyWarehouseGood(
				null,
				$this->getId(),
				$Good->getId(),
				$Old,
				$Import,
				$Export
			);
			$mTDWG->insert($TDWG);
			$GoodAll->next();
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
	
	function getURLReport()		{
		return "/ql-bao-cao/".$this->getIdTrack()."/".($this->getDate())."/kho-hang/".$this->getId();
	}
	
	//-------------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}	
}
?>
