<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Tracking extends Object{
    private $Id;
	private $DateStart;
	private $DateEnd;
			
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $DateStart=null, $DateEnd=null) {$this->Id = $Id; $this->DateStart = $DateStart; $this->DateEnd = $DateEnd; parent::__construct( $Id );}
    
	function getId() {return $this->Id;}	
	function getIdPrint(){return "u" . $this->getId();}	
	function getName(){$Name = 'THÁNG '.\date("m/Y", strtotime($this->getDateStart()));return $Name;}
	
    function setDateStart( $DateStart ) {$this->DateStart = $DateStart;$this->markDirty();}   
	function getDateStart( ) {return $this->DateStart;}	
	function getDateStartPrint( ) {$D = new \MVC\Library\Date($this->DateStart);return $D->getDateFormat();}
	
	function setDateEnd( $DateEnd ) {$this->DateEnd= $DateEnd;$this->markDirty();}   
	function getDateEnd( ) {return $this->DateEnd;}	
	function getDateEndPrint( ) {$D = new \MVC\Library\Date($this->DateEnd);return $D->getDateFormat();}
	
	function toJSON(){
	
		$json = array(
			'Id' 			=> $this->getId(),			
			'DateStart'		=> $this->getDateStart(),
			'DateEnd'		=> $this->getDateEnd()
		);
		return json_encode($json);
	
	}
	
	function setArray( $Data ){
	
        $this->Id 			= $Data[0];
		$this->DateStart 	= $Data[1];
		$this->DateEnd 		= $Data[2];
	
    }
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	
	//-------------------------------------------------------------------------------
	//KHOẢN THU
	//-------------------------------------------------------------------------------
	function getCollectAll($IdTerm){$mCollect = new \MVC\Mapper\CollectGeneral();$CollectAll = $mCollect->findByTracking1(array($IdTerm, $this->getDateStart(), $this->getDateEnd()));return $CollectAll;}
	function getCollectAllValue($IdTerm){$CollectAll = $this->getCollectAll($IdTerm);$Value = 0;while ($CollectAll->valid()){$Collect = $CollectAll->current();$Value += $Collect->getValue();$CollectAll->next();}return $Value;}
	function getCollectAllValuePrint($IdTerm){$N = new \MVC\Library\Number($this->getCollectAllValue($IdTerm));return $N->formatCurrency()." đ";}
	
	function getCollectAllSumValue(){
				
		$mCollect = new \MVC\Mapper\CollectGeneral();
		$CollectAll = $mCollect->findByTracking(array($this->getDateStart(), $this->getDateEnd()));
		
		$Value = 0;
		while ($CollectAll->valid()){
			$Collect = $CollectAll->current();
			$Value += $Collect->getValue();
			$CollectAll->next();
		}
		
		//thu bán hàng
		$Value += $this->getSessionAllValue();
		
		return $Value;
	}
	
	function getCollectAllSumValuePrint(){
		$N = new \MVC\Library\Number( $this->getCollectAllSumValue() );
		return $N->formatCurrency();
	}
	
	//-------------------------------------------------------------------------------
	//KHOẢN CHI
	//-------------------------------------------------------------------------------
	function getPaidAll($IdTerm){$mPaid = new \MVC\Mapper\PaidGeneral();$PaidAll = $mPaid->findByTracking1(array($IdTerm, $this->getDateStart(), $this->getDateEnd()));return $PaidAll;}
	function getPaidAllValue($IdTerm){$PaidAll = $this->getPaidAll($IdTerm);$Value = 0;while ($PaidAll->valid()){$Paid = $PaidAll->current();$Value += $Paid->getValue();$PaidAll->next();}return $Value;}
	function getPaidAllValuePrint($IdTerm){$N = new \MVC\Library\Number($this->getPaidAllValue($IdTerm));return $N->formatCurrency()." đ";}
	function getPaidAllValueStrPrint($IdTerm){$N = new \MVC\Library\Number($this->getPaidAllValue($IdTerm));return $N->readDigit()."đồng";}	
	function getPaidAllSum(){$mPaid = new \MVC\Mapper\PaidGeneral();$PaidAll = $mPaid->findByTracking(array($this->getDateStart(), $this->getDateEnd()));return $PaidAll;}
	
	function getPaidAllSumValue(){
		//Các khoản chi tổng quát
		$PaidAll = $this->getPaidAllSum();
		$Value = 0;
		while ($PaidAll->valid()){
			$Paid = $PaidAll->current();
			$Value += $Paid->getValue();
			$PaidAll->next();
		}
		
		//Các khoản chi lương
		$Value += $this->getPaidPayRollAllValue();
		
		return $Value;
	}
	function getPaidAllSumValuePrint(){$N = new \MVC\Library\Number($this->getPaidAllSumValue());return $N->formatCurrency()." đ";}
	
	//--------------------------------------------------------------------------------	
	//NHẬP HÀNG
	//--------------------------------------------------------------------------------
	function getOrderAll($IdSupplier){$mOrder = new \MVC\Mapper\OrderImport();$OrderAll = $mOrder->findByTracking1(array($IdSupplier, $this->getDateStart(), $this->getDateEnd()));return $OrderAll;}
	function getOrderAllValue($IdSupplier){$OrderAll = $this->getOrderAll($IdSupplier);$Value = 0;while ($OrderAll->valid()){$Order = $OrderAll->current();$Value += $Order->getValue();$OrderAll->next();}return $Value;}
	function getOrderAllValuePrint($IdSupplier){$N = new \MVC\Library\Number($this->getOrderAllValue($IdSupplier));return $N->formatCurrency()." d";}
	function getOrderAllValueStrPrint($IdSupplier){$N = new \MVC\Library\Number($this->getOrderAllValue($IdSupplier));return $N->readDigit()." đồng";}
	
	function getOrderAllSum(){$mOrder = new \MVC\Mapper\OrderImport();$OrderAll = $mOrder->findByTracking(array($this->getDateStart(), $this->getDateEnd()));return $OrderAll;}
	function getOrderAllSumValue(){$OrderAll = $this->getOrderAllSum();$Value = 0;while ($OrderAll->valid()){$Order = $OrderAll->current();$Value += $Order->getValue();$OrderAll->next();}return $Value;}
	function getOrderAllSumValuePrint(){$N = new \MVC\Library\Number($this->getOrderAllSumValue());return $N->formatCurrency()." đ";}
		
	//--------------------------------------------------------------------------------
	//BÁN HÀNG
	//--------------------------------------------------------------------------------
	function getSessionAll(){$mSession = new \MVC\Mapper\Session();$Date1 = \date("Y-m-d", strtotime($this->getDateStart()))." 8:0:0";$Date2 = \date("Y-m-d", strtotime("+1 day", strtotime($this->getDateEnd())))." 7:59:59";$SessionAll = $mSession->findByTracking( array($Date1, $Date2) );return $SessionAll;}	
	function getSessionAllValue(){$SessionAll = $this->getSessionAll();$Value = 0;while ($SessionAll->valid()){$Session = $SessionAll->current();$Value += $Session->getValue();$SessionAll->next();}return $Value;}
	function getSessionAllValuePrint(){$N = new \MVC\Library\Number($this->getSessionAllValue());return $N->formatCurrency()." đ";}
	
	//---------------------------------------------------------------------------------------------
	//TÍNH SỐ DƯ CUỐI CÙNG	
	//---------------------------------------------------------------------------------------------
	function getValue(){
		$Value = 
			$this->getCollectAllSumValue()
			+ $this->getTrackingStoreValue() 
			- $this->getOrderAllSumValue() 
			- $this->getPaidAllSumValue()
			- $this->getEstateRate();
		return $Value;
	}
	
	function getValuePrint(){ $N = new \MVC\Library\Number($this->getValue()); return $N->formatCurrency()." đ";}
	function getValueStrPrint(){ $N = new \MVC\Library\Number($this->getValue()); return $N->readDigit()." đồng";}
	
	//-------------------------------------------------------------------------------------
	//THEO DÕI SỐ TỒN KHO
	//-------------------------------------------------------------------------------------
	function getResourceOld($IdResource){
		$mOD = new \MVC\Mapper\OrderImportDetail();
		$Date1 = "2013-1-1";
		$Date2 = $this->getDateStart()." 7:59:59";
		
		//Tổng Nhập	
		$Count1 = $mOD->trackByCount( array($IdResource, $Date1, $Date2) );
		
		//Tổng Xuất
		$mSD = new \MVC\Mapper\SessionDetail();
		$SDAll = $mSD->trackByExport( array($IdResource, $Date1, $Date2 ) );
		$Count2 = 0;
		while ($SDAll->valid()){
			$SD = $SDAll->current();
			$Count2 += $SD->getCountExchange($IdResource);
			$SDAll->next();
		}
		
		return $Count1 - $Count2;		
	}
	function getResourceOldPrint($IdResource){return \round( $this->getResourceOld($IdResource) ,1 );}	
	function getResourceImport($IdResource){$mOD = new \MVC\Mapper\OrderImportDetail();$Count = $mOD->trackByCount( array($IdResource, $this->getDateStart(), $this->getDateEnd()) );return ($Count?$Count:0);}	
	function getResourceExport($IdResource){
		$mSD = new \MVC\Mapper\SessionDetail();
		$Date1 = \date("Y-m-d", strtotime($this->getDateStart()))." 8:0:0";
		$Date2 = \date("Y-m-d", strtotime("+1 day", strtotime($this->getDateEnd())))." 7:59:59";
		$SDAll = $mSD->trackByExport( array($IdResource, $Date1, $Date2 ) );
		$Count = 0;
		while ($SDAll->valid()){
			$SD = $SDAll->current();
			$Count += $SD->getCountExchange($IdResource);
			$SDAll->next();
		}
		return $Count;
	}
	
	function getResourceRemain($IdResource){$Count0 = $this->getResourceOld($IdResource);$Count1 = $this->getResourceImport($IdResource);$Count2 = $this->getResourceExport($IdResource);return ($Count0 + $Count1 - $Count2);}	
	function getResourceRemainPrint($IdResource){return \round( $this->getResourceRemain($IdResource) ,1 );}
	
	function getResourcePrice($IdResource){$mOD = new \MVC\Mapper\OrderImportDetail();$Count = $mOD->evalPrice( array($IdResource, $this->getDateStart(), $this->getDateEnd()) );return ($Count?$Count:0);	}
	function getResourcePricePrint($IdResource){$N = new \MVC\Library\Number($this->getResourcePrice($IdResource));return $N->formatCurrency();}
	
	function getResourceRemainValue($IdResource){$Count = $this->getResourceRemain($IdResource);$Price = $this->getResourcePrice($IdResource);return $Count*$Price;}	
	function getResourceRemainValuePrint($IdResource){$N = new \MVC\Library\Number( $this->getResourceRemainValue($IdResource) );return $N->formatCurrency();}
	
	function getTrackingStoreValue(){$mTrackingStore = new \MVC\Mapper\TrackingStore();$TrackingStoreAll = $mTrackingStore->findBy(array($this->getId()));$Value = 0;while($TrackingStoreAll->valid()){ $TS = $TrackingStoreAll->current(); $Value += $TS->getCountRemainValue();$TrackingStoreAll->next();}		return $Value;}
	function getTrackingStoreValuePrint(){ $N = new \MVC\Library\Number( $this->getTrackingStoreValue() ); return $N->formatCurrency();}
	
	//-------------------------------------------------------------------------------------
	//THEO DÕI SỐ MÓN ĐÃ GỌI
	//-------------------------------------------------------------------------------------
	function getCountCategory($IdCategory){$mSD = new \MVC\Mapper\SessionDetail();$Count = $mSD->trackByCategory( array($IdCategory, $this->getDateStart(), $this->getDateEnd()) );return $Count;}
	function getCountCategoryPrint($IdCategory){$N = new \MVC\Library\Number($this->getCountCategory($IdCategory));return $N->formatCurrency();}	
	function getCountCourse($IdCourse){$mSD = new \MVC\Mapper\SessionDetail();$Count = $mSD->trackByCount( array($IdCourse, $this->getDateStart(), $this->getDateEnd()) );return $Count;}
	function getCountCoursePrint($IdCourse){$N = new \MVC\Library\Number($this->getCountCourse($IdCourse));return $N->formatCurrency();}
	
	//-------------------------------------------------------------------------------------
	//THEO DÕI CÔNG NỢ KHÁCH HÀNG
	//-------------------------------------------------------------------------------------
	//TÍNH NỢ CŨ
	function getCustomerOldDebt($IdCustomer){
		$mSession = new \MVC\Mapper\Session();
		$mCC = new \MVC\Mapper\CollectCustomer();
		$Date1 = \date("Y-m-d", strtotime("2013-1-1"));
		$Date2 = \date("Y-m-d", strtotime("-1 day", strtotime($this->getDateStart())));		
		
		//Tính phiếu nợ trước đó
		$SessionAll = $mSession->findByTrackingDebtCustomer( array($IdCustomer, $Date1, $Date2) );
		$ValueSessionAll = 0;
		while ($SessionAll->valid()){
			$Session = $SessionAll->current();
			$ValueSessionAll += $Session->getValue();
			$SessionAll->next();
		}
		
		//Tính tiền trả trước đó
		$CollectAll = $mCC->findByTracking( array($IdCustomer, $Date1, $Date2) );				
		$ValueCollectAll = 0;
		while ($CollectAll->valid()){
			$Collect = $CollectAll->current();
			$ValueCollectAll += $Collect->getValue();
			$CollectAll->next();
		}
		
		$Value = $ValueSessionAll - $ValueCollectAll;
		return $Value;
	}
	function getCustomerOldDebtPrint($IdCustomer){$N = new \MVC\Library\Number( $this->getCustomerOldDebt($IdCustomer) );return $N->formatCurrency()." đ";}
	
	//CÁC GIAO DỊCH CỦA KHÁCH HÀNG TRONG KÌ
	function getCustomerSessionAll($IdCustomer){$mSession = new \MVC\Mapper\Session();$Date1 = \date("Y-m-d", strtotime($this->getDateStart()))." 8:0:0";$Date2 = \date("Y-m-d", strtotime("+1 day", strtotime($this->getDateEnd())))." 7:59:59";$SessionAll = $mSession->findByTrackingCustomer( array($IdCustomer, $Date1, $Date2) );return $SessionAll;}
	function getCustomerSessionAllValue($IdCustomer){$SessionAll = $this->getCustomerSessionAll($IdCustomer);$Value = 0;while ($SessionAll->valid()){$Session = $SessionAll->current();$Value += $Session->getValue();$SessionAll->next();}return $Value;}
	function getCustomerSessionAllValuePrint($IdCustomer){$N = new \MVC\Library\Number($this->getCustomerSessionAllValue($IdCustomer));return $N->formatCurrency()." đ";}
	
	//CÁC GIAO DỊCH NỢ CỦA KHÁCH HÀNG TRONG KÌ
	function getCustomerDebtSessionAll($IdCustomer){$mSession = new \MVC\Mapper\Session();$Date1 = \date("Y-m-d", strtotime($this->getDateStart()))." 8:0:0";$Date2 = \date("Y-m-d", strtotime("+1 day", strtotime($this->getDateEnd())))." 7:59:59";$SessionAll = $mSession->findByTrackingDebtCustomer( array($IdCustomer, $Date1, $Date2) );return $SessionAll;}
	function getCustomerDebtSessionAllValue($IdCustomer){$SessionAll = $this->getCustomerDebtSessionAll($IdCustomer);$Value = 0;while ($SessionAll->valid()){$Session = $SessionAll->current();$Value += $Session->getValue();$SessionAll->next();}return $Value;}
	function getCustomerDebtSessionAllValuePrint($IdCustomer){$N = new \MVC\Library\Number($this->getCustomerDebtSessionAllValue($IdCustomer));return $N->formatCurrency()." đ";}
	
	//CÁC GIAO DỊCH THANH TOÁN ĐỦ CỦA KHÁCH HÀNG TRONG KÌ
	function getCustomerFullSessionAll($IdCustomer){$mSession = new \MVC\Mapper\Session();$Date1 = \date("Y-m-d", strtotime($this->getDateStart()))." 8:0:0";$Date2 = \date("Y-m-d", strtotime("+1 day", strtotime($this->getDateEnd())))." 7:59:59";$SessionAll = $mSession->findByTrackingFullCustomer( array($IdCustomer, $Date1, $Date2) );return $SessionAll;}
	function getCustomerFullSessionAllValue($IdCustomer){$SessionAll = $this->getCustomerFullSessionAll($IdCustomer);$Value = 0;while ($SessionAll->valid()){$Session = $SessionAll->current();$Value += $Session->getValue();$SessionAll->next();}return $Value;}
	function getCustomerFullSessionAllValuePrint($IdCustomer){$N = new \MVC\Library\Number($this->getCustomerFullSessionAllValue($IdCustomer));return $N->formatCurrency()." đ";}	
	//CÁC GIAO DỊCH CỦA KHÁCH HÀNG TRONG KÌ
	function getCustomerCollectAll($IdCustomer){$mCC = new \MVC\Mapper\CollectCustomer();$Date1 = \date("Y-m-d", strtotime($this->getDateStart() ));$Date2 = \date("Y-m-d", strtotime($this->getDateEnd()   ));$CollectAll = $mCC->findByTracking( array($IdCustomer, $Date1, $Date2) );return $CollectAll;}
	function getCustomerCollectAllValue($IdCustomer){$CollectAll = $this->getCustomerCollectAll($IdCustomer);$Value = 0;while ($CollectAll->valid()){$Collect = $CollectAll->current();$Value += $Collect->getValue();$CollectAll->next();}return $Value;}
	function getCustomerCollectAllValuePrint($IdCustomer){$N = new \MVC\Library\Number($this->getCustomerCollectAllValue($IdCustomer));return $N->formatCurrency()." đ";}
	//NỢ MỚI
	function getCustomerNewDebt($IdCustomer){return \abs($this->getCustomerOldDebt($IdCustomer)) + $this->getCustomerDebtSessionAllValue($IdCustomer) - $this->getCustomerCollectAllValue($IdCustomer);}
	function getCustomerNewDebtPrint($IdCustomer){$N = new \MVC\Library\Number( $this->getCustomerNewDebt($IdCustomer) );return $N->formatCurrency()." đ";}	
	function getCustomerNewDebtStrPrint($IdCustomer){$N = new \MVC\Library\Number( $this->getCustomerNewDebt($IdCustomer) );return $N->readDigit();}	
	
	//CÁC LIÊN KẾT CỦA CÁC NGÀY TRONG THÁNG
	function getURLDayAll(){
		$Data = array();
		$Date = $this->getDateStart();
		$EndDate = $this->getDateEnd();
		while (strtotime($Date) <= strtotime($EndDate)){
			$Data[] = array(
						\date("d/m", strtotime($Date)),
						"/report/selling/".$Date."/detail",
						"/report/log/".$Date,
						"/payroll/".$this->getId()."/absent/".$Date,
						"/payroll/".$this->getId()."/late/".$Date,
						$Date
					);
			$Date = \date("Y-m-d", strtotime("+1 day", strtotime($Date)));
		}
		return $Data;
	}
	
	//-------------------------------------------------------------------------------
	//LƯƠNG NHÂN VIÊN
	//-------------------------------------------------------------------------------
	function getPaidPayRollAll(){ $mPPR = new \MVC\Mapper\PaidPayRoll(); $PPRAll = $mPPR->findByTracking( array( $this->getDateStart(), $this->getDateEnd() )); return $PPRAll;}	
	//TỔNG LƯƠNG CƠ BẢN
	function getPaidPayRollAllValueBase(){ $PPRAll = $this->getPaidPayRollAll(); $Value = 0; $PPRAll->rewind(); while ( $PPRAll->valid() ){ $PPR = $PPRAll->current(); $Value += $PPR->getValueBase(); $PPRAll->next(); }  return $Value; }
	function getPaidPayRollAllValueBasePrint(){ $N = new \MVC\Library\Number( $this->getPaidPayRollAllValueBase() ); return $N->formatCurrency(); }	
	//TỔNG LƯƠNG PHỤ CẤP
	function getPaidPayRollAllValueSub(){$PPRAll = $this->getPaidPayRollAll();$Value = 0;$PPRAll->rewind();while ( $PPRAll->valid() ){$PPR = $PPRAll->current();$Value += $PPR->getValueSub();$PPRAll->next();}return $Value;}
	function getPaidPayRollAllValueSubPrint(){$N = new \MVC\Library\Number( $this->getPaidPayRollAllValueSub() );return $N->formatCurrency();}	
	//TỔNG LƯƠNG ỨNG TIỀN
	function getPaidPayRollAllValuePre(){$PPRAll = $this->getPaidPayRollAll();$Value = 0;$PPRAll->rewind();while ( $PPRAll->valid() ){$PPR = $PPRAll->current();$Value += $PPR->getValuePre();$PPRAll->next();}return $Value;}
	function getPaidPayRollAllValuePrePrint(){$N = new \MVC\Library\Number( $this->getPaidPayRollAllValuePre() );return $N->formatCurrency();}	
	//TỔNG LƯƠNG THỰC LÃNH
	function getPaidPayRollALlValueReal(){$PPRAll = $this->getPaidPayRollAll();$Value = 0;$PPRAll->rewind();while ( $PPRAll->valid() ){$PPR = $PPRAll->current();$Value += $PPR->getValueReal();$PPRAll->next();}return $Value;}
	function getPaidPayRollAllValueRealPrint(){$N = new \MVC\Library\Number( $this->getPaidPayRollAllValueReal() );return $N->formatCurrency();}
	//TỔNG LƯƠNG
	function getPaidPayRollAllValue(){$Value = $this->getPaidPayRollAllValueBase() + $this->getPaidPayRollAllValueSub();return $Value;}	
	function getPaidPayRollAllValuePrint(){$N = new \MVC\Library\Number( $this->getPaidPayRollAllValue() );return $N->formatCurrency()." đ";}
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLView(){return "/report/".$this->getId();}
	
	function getURLPayRoll(){return "/payroll/".$this->getId();}
	function getURLPayRollEmployee( $Employee ){return "/payroll/".$this->getId()."/".$Employee->getId();}
	
	function getURLCustomer(){return "/report/customer/".$this->getId();}
	function getURLCustomerDetail($IdCustomer){return "/report/customer/".$this->getId()."/".$IdCustomer;}
	function getURLPaidPayRoll(){return "/report/paid/payroll/".$this->getId();}	
	function getURLPaidGeneral(){return "/report/paid/".$this->getId();}
	function getURLPaidDetail($IdTerm){return "/report/paid/".$this->getId()."/".$IdTerm;}
	function getURLCollectDetail($IdTerm){return "/report/collect/".$this->getId()."/".$IdTerm;}
	function getURLCollectGeneral(){return "/report/collect/".$this->getId();}
	function getURLImportGeneral(){return "/report/import/".$this->getId()."/general";}
	function getURLImportDetail($IdSupplier){return "/report/import/".$this->getId()."/".$IdSupplier;}
	function getURLSellingGeneral(){return "/report/selling/".$this->getId()."/general";}
	function getURLSellingDetail(){return "/report/selling/".$this->getId()."/detail";}	
	
	function getURLEvalStore(){return "/report/store/".$this->getId()."/eval";}
	function getURLStore(){return "/report/store/".$this->getId();}
	function getURLCourse(){return "/report/course/".$this->getId();}		
	function getURLGeneral(){return "/report/general/".$this->getId();}		
	function getURLUpdLoad(){return "/report/".$this->getId()."/upd/load";}
	function getURLUpdExe(){return "/report/".$this->getId()."/upd/exe";}	
	function getURLDelLoad(){return "/report/".$this->getId()."/del/load";}
	function getURLDelExe(){return "/report/".$this->getId()."/del/exe";}
	
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
}
?>