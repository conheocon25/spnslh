<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Supplier extends Object{

    private $Id;
	private $Name;
	private $Phone;
    private $Address;
	private $Note;
	private $Debt;
					
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id=null, 
		$Name=null, 
		$Phone=null, 
		$Address=null, 
		$Note=null,
		$Debt=null
	){
        $this->Id 		= $Id;
		$this->Name 	= $Name;
		$this->Phone 	= $Phone;
		$this->Address 	= $Address;
		$this->Note 	= $Note;
		$this->Debt 	= $Debt;
		
        parent::__construct( $Id );
    }
    function getId( ) {return $this->Id;}
		
    function setName( $Name ) {$this->Name = $Name; $this->markDirty();}
    function getName( ) {return $this->Name;}
	
	function getPhone( ) {return $this->Phone;}
    function setPhone( $Phone ) {$this->Phone = $Phone; $this->markDirty();}
	
	function setAddress( $Address ) {$this->Address = $Address; $this->markDirty();}
    function getAddress( ) {return $this->Address;}
	
	function setNote( $Note ) {$this->Note = $Note; $this->markDirty();}
	function getNote( ) {return $this->Note;}
	
	function setDebt( $Debt ) {$this->Debt = $Debt; $this->markDirty();}
	function getDebt( ){return $this->Debt;}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),			
			'Name'			=> $this->getName(),
			'Phone'			=> $this->getPhone(),
			'Address'		=> $this->getAddress(),
			'Note'			=> $this->getNote(),
			'Debt'			=> $this->getDebt()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 		= $Data[0];
		$this->Name 	= $Data[1];
		$this->Phone 	= $Data[2];
		$this->Address 	= $Data[3];
		$this->Note 	= $Data[4];
		$this->Debt 	= $Data[5];
    }
		
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	
	//Lấy về danh sách trả tiền	
	function getPaidAll(){		
		$mSP = new \MVC\Mapper\PaidSupplier();
		$PaidAll = $mSP->findBy(array($this->getId()));
		
		return $PaidAll;
	}
	function getPaidsTracking(){
		if (!isset($this->PaidsTracking)){
			$Session = \MVC\Base\SessionRegistry::instance();
			$DateStart = $Session->getReportSupplierDateStart();
			$DateEnd = $Session->getReportSupplierDateEnd();

			$mPaid = new \MVC\Mapper\PaidSupplier();
			$this->PaidsTracking = $mPaid->findByTracking1( array($this->getId(), $DateStart, $DateEnd) );
		}
		return $this->PaidsTracking;
	}
	function getPaidsTrackingValue(){
		$Paids = $this->getPaidsTracking();
		$Sum = 0;
		$Paids->rewind();
		while ($Paids->valid()){
			$Sum += $Paids->current()->getValue();
			$Paids->next();
		}
		return $Sum;
	}
	function getPaidsTrackingValuePrint(){
		$Value = $this->getPaidsTrackingValue();
		$N = new \MVC\Library\Number($Value);
		return $N->formatCurrency()." đ";
	}
	
			
	//Lấy về danh sách các đơn hàng
	function getOrderAll(){
		$mOrderImport = new \MVC\Mapper\OrderImport();
		$OrderAll = $mOrderImport->findBy(array($this->getId()));
		return $OrderAll;
	}
		
	function getOrdersTracking(){
		if (!isset($this->OrdersTracking)){
			$Session = \MVC\Base\SessionRegistry::instance();
			$DateStart = $Session->getReportSupplierDateStart();
			$DateEnd = $Session->getReportSupplierDateEnd();

			$mOrder = new \MVC\Mapper\OrderImport();
			$this->OrdersTracking = $mOrder->findByTracking1( array($this->getId(), $DateStart, $DateEnd) );
		}
		return $this->OrdersTracking;
	}
	
	function getOrdersTrackingValue(){
		$Orders = $this->getOrdersTracking();
		$Sum = 0;
		$Orders->rewind();
		while ($Orders->valid()){
			$Sum += $Orders->current()->getValue();
			$Orders->next();
		}
		return $Sum;
	}
	function getOrdersTrackingValuePrint(){
		$Value = $this->getOrdersTrackingValue();
		$N = new \MVC\Library\Number($Value);
		return $N->formatCurrency()." đ";
	}
	
	//Lấy về danh sách các tài nguyên nhà cung cấp có
	function getProductAll() {
		$mProduct 	= new \MVC\Mapper\Product();
		$ProductAll = $mProduct->findBySupplier(array($this->getId()));
		return $ProductAll;
	}
	
	function getProductManufacturer($IdManufacturer) {
		$mProduct 	= new \MVC\Mapper\Product();
		$ProductAll = $mProduct->findBySupplierManufacturer(array($this->getId(), $IdManufacturer));
		return $ProductAll;
	}
	
	//Lấy về danh sách các nhà sản xuất
	function getManufacturerAll() {
		$mProduct 	= new \MVC\Mapper\Product();
		$ProductAll = $mProduct->findManufacturer(array($this->getId()));
		return $ProductAll;
	}
	
	//-------------------------------------------------------------------------------
	//DEFINE IMPORT.SUPPLIER
	//-------------------------------------------------------------------------------
	function getURLImport(){return "/admin/import/".$this->getId();}	
	function getURLImportInsLoad(){return "/admin/import/".$this->getId()."/ins/load";}	
	function getURLImportInsExe(){return "/admin/import/".$this->getId()."/ins/exe";}
	
	//-------------------------------------------------------------------------------
	//DEFINE URL SETTING.SUPPLIER
	//-------------------------------------------------------------------------------	
	function getURLProduct(){return "/admin/setting/supplier/".$this->getId();}
	function getURLSettingManufacturer($IdManufacturer){
		return "/admin/setting/supplier/".$this->getId()."/".$IdManufacturer."/manufacturer";
	}
	
		
	//-------------------------------------------------------------------------------
	//DEFINE URL PAID.SUPPLIER
	//-------------------------------------------------------------------------------	
	function getURLPaid(){return "/admin/paid/supplier/".$this->getId();}
	function getURLPaidInsLoad(){return "/admin/paid/supplier/".$this->getId()."/ins/load";}
	function getURLPaidInsExe(){return "/admin/paid/supplier/".$this->getId()."/ins/exe";}
							
	//---------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $id );}
	
}
?>