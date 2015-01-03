<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class TrackingDaily extends Object{

    private $Id;
	private $IdTracking;
	private $Date;
	private $Selling;
	private $SellingDebt;
	private $Import;
	private $Export;
	private $Store;
	private $Paid;
	private $Collect;	
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id			= null,
		$IdTracking	= null, 
		$Date		= null, 
		$Selling	= null, 
		$SellingDebt= null, 
		$Import		= null, 
		$Export		= null,
		$Store		= null,
		$Paid		= null,
		$Collect	= null		
	) {
        $this->Id 			= $Id;
		$this->IdTracking 	= $IdTracking;
		$this->Date 		= $Date;
		$this->Selling 		= $Selling;
		$this->SellingDebt 	= $SellingDebt;
		$this->Import 		= $Import;
		$this->Export 		= $Export;
		$this->Store 		= $Store;
		$this->Paid 		= $Paid;
		$this->Collect 		= $Collect;		
		
        parent::__construct( $Id );
    }

    function getId() {return $this->Id;}	
		
    function setIdTracking( $IdTracking ) {$this->IdTracking = $IdTracking;$this->markDirty();}   
	function getIdTracking( ) {return $this->IdTracking;}
	
	function setIdResource( $IdResource ) {$this->IdResource = $IdResource;$this->markDirty();}   
	function getIdResource( ) {return $this->IdResource;}
	function getResource(){ $mResource = new \MVC\Mapper\Resource(); $Resource = $mResource->find( $this->getIdResource() ); return $Resource;}
	
	function setDate( $Date ) {$this->Date = $Date;$this->markDirty();}   
	function getDate( ) {return $this->Date;}
	function getDatePrint( ) {$D = new \MVC\Library\Date($this->Date);return $D->getDateFormat();}
	function getDateShortPrint( ) {return date('d/m',strtotime($this->Date));}
	
	function setSelling( $Selling ) {$this->Selling = $Selling; $this->markDirty();}   
	function getSelling( ) {return $this->Selling;}
	function getSellingPrint( ){$N = new \MVC\Library\Number($this->Selling);return $N->formatCurrency();}
	
	function setImport( $Import ) {$this->Import = $Import;$this->markDirty();}   
	function getImport( ) {return $this->Import;}
	function getImportPrint( ) {$N = new \MVC\Library\Number($this->Import);return $N->formatCurrency();}
	
	function setExport( $Export ) {$this->Export = $Export;$this->markDirty();}   
	function getExport( ) {return $this->Export;}
	function getExportPrint( ) {$N = new \MVC\Library\Number($this->Export);return $N->formatCurrency();}
	
	function setStore( $Store ) {$this->Store = $Store;$this->markDirty();}   
	function getStore( ) {return $this->Store;}
	function getStorePrint( ) {$N = new \MVC\Library\Number($this->Store);return $N->formatCurrency();}
	
	function setPaid( $Paid ) {$this->Paid = $Paid; $this->markDirty();}   
	function getPaid( ) {return $this->Paid;}
	function getPaidPrint( ) {$N = new \MVC\Library\Number($this->Paid);return $N->formatCurrency();}
	
	function setCollect( $Collect ) {$this->Collect = $Collect; $this->markDirty();}
	function getCollect( ) {return $this->Collect;}
	function getCollectPrint( ) {$N = new \MVC\Library\Number($this->Collect);return $N->formatCurrency();}
	
	function getValueCash(){
		$mTD 		= new \MVC\Mapper\TrackingDaily();
		$TDPreAll 	= $mTD->findByPre(array($this->getIdTracking(), $this->getDate()));
		if ($TDPreAll->count()==0){ $OldValue 	= 0;}
		else{ $OldValue 	= $TDPreAll->current()->getValueCash();}
		
		$NewValue  	= 	$OldValue + 
						$this->getSellingCash() + 							
						$this->getCollect();
						
		return $NewValue;
	}
	function getValueCashPrint( ) {$N = new \MVC\Library\Number($this->getValueCash());return $N->formatCurrency();}
	
	function getValueDebt(){
		$mTD 		= new \MVC\Mapper\TrackingDaily();
		$TDPreAll 	= $mTD->findByPre(array($this->getIdTracking(), $this->getDate()));
		if ($TDPreAll->count()==0){$OldValue 	= 0;}
		else{$OldValue 	= $TDPreAll->current()->getValueDebt();}
		
		$NewValue  	= 	$OldValue +
						$this->getSellingDebt() +
						$this->getStore() -
						$this->getImport() -
						$this->getPaid();
						
		return $NewValue;
	}
	function getValueDebtPrint( ) {$N = new \MVC\Library\Number($this->getValueDebt()); return $N->formatCurrency();}
	
	function setTime1( $Time1 ) {$this->Time1 = $Time1; $this->markDirty();}
	function getTime1( ) {return $this->Time1;}
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	/*
	function getImportCount($IdResource){
		$mOD = new \MVC\Mapper\OrderImportDetail();
		$Count = $mOD->trackByCount( array($IdResource, $this->getDate(), $this->getDate()) );
		return $Count;
	}
	function getExportCount($IdResource){
		$mOD = new \MVC\Mapper\OrderExportDetail();
		$Count = $mOD->trackByCount( array($IdResource, $this->getDate(), $this->getDate()) );
		return $Count;
	}
	*/
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLReport()			{return "/report/".$this->getIdTracking()."/".$this->getId();}
	function getURLReportSelling()	{return "/report/".$this->getIdTracking()."/".$this->getId()."/selling";}
	function getURLReportStore()	{return "/report/".$this->getIdTracking()."/".$this->getId()."/store";}
	function getURLReportImport()	{return "/report/".$this->getIdTracking()."/".$this->getId()."/import";}
	function getURLReportExport()	{return "/report/".$this->getIdTracking()."/".$this->getId()."/export";}
	function getURLReportPaid()		{return "/report/".$this->getIdTracking()."/".$this->getId()."/paid";}
	function getURLReportCollect()	{return "/report/".$this->getIdTracking()."/".$this->getId()."/collect";}	
	function getURLReportCustomer()	{return "/report/".$this->getIdTracking()."/".$this->getId()."/customer";}
	function getURLReportSupplier()	{return "/report/".$this->getIdTracking()."/".$this->getId()."/supplier";}
		
	function getURLReportCustomerDetail($IdCustomer){
		return "/report/".$this->getIdTracking()."/".$this->getId()."/customer/".$IdCustomer;
	}	
	
	function getURLReportSupplierDetail($IdSupplier){
		return "/report/".$this->getIdTracking()."/".$this->getId()."/supplier/".$IdSupplier;
	}
	
	//-------------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}	
}
?>