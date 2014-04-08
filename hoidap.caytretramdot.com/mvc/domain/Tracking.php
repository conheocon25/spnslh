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
    function __construct( 
			$Id=null,
			$DateStart=null, 
			$DateEnd=null			
	){
			$this->Id 					= $Id; 
			$this->DateStart 			= $DateStart; 
			$this->DateEnd 				= $DateEnd;						
									
			parent::__construct( $Id );
	}
    function setId($Id) {return $this->Id = $Id;}
	function getId() {return $this->Id;}
	function getName(){$Name = 'THÁNG '.\date("m/Y", strtotime($this->getDateStart()));return $Name;}
	
    function setDateStart( $DateStart ) {$this->DateStart = $DateStart;$this->markDirty();}   
	function getDateStart( ) {return $this->DateStart;}	
	function getDateStartPrint( ) {$D = new \MVC\Library\Date($this->DateStart);return $D->getDateFormat();}
	
	function setDateEnd( $DateEnd ) {$this->DateEnd= $DateEnd;$this->markDirty();}   
	function getDateEnd( ) {return $this->DateEnd;}	
	function getDateEndPrint( ) {$D = new \MVC\Library\Date($this->DateEnd);return $D->getDateFormat();}
					
	function toJSON(){
		$json = array(
			'Id' 					=> $this->getId(),			
			'DateStart'				=> $this->getDateStart(),
			'DateEnd'				=> $this->getDateEnd()	
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){        
		$this->Id 					= $Data[0];
		$this->DateStart 			= $Data[1];
		$this->DateEnd 				= $Data[2];		
    }
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	function getPayRollAll(){
		$mPayRoll 	= new \MVC\Mapper\PayRoll();
		$PRAll		= $mPayRoll->findByTracking(array($this->getId()));
		return $PRAll;
	}
	
	function getDailyAll(){
		$mTD 	= new \MVC\Mapper\TrackingDaily();
		$TDAll 	= $mTD->findBy(array($this->getId()));
		return $TDAll;
	}
	function generateDaily(){		
		$Date = $this->getDateStart();
		$EndDate = $this->getDateEnd();
		$mTD = new \MVC\Mapper\TrackingDaily();
		
		while (strtotime($Date) <= strtotime($EndDate)){
			$TD = new \MVC\Domain\TrackingDaily(
				null,
				$this->getId(), 
				$Date, 
				0, 
				0, 
				0, 
				0, 
				0,
				"0000-00-00 00:00:00"
			);
			$mTD->insert($TD);
			$Date = \date("Y-m-d", strtotime("+1 day", strtotime($Date)));
		}
	}	
	
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
	
	//-------------------------------------------------------------------------------------
	//THEO DÕI CÔNG NỢ KHÁCH HÀNG
	//-------------------------------------------------------------------------------------
	//TÍNH NỢ CŨ
	function getCustomerOldDebt($IdCustomer){
		$mSession = new \MVC\Mapper\Session();
		$mCC = new \MVC\Mapper\CollectCustomer();
		$Date1 = \date("Y-m-d", strtotime("2013-1-1"));		
		$Date2 = \date("Y-m-d", strtotime($this->getDateStart()))." 7:59:0";
						
		//Tính phiếu nợ trước đó
		$SessionAll = $mSession->findByTrackingDebtCustomer( array($IdCustomer, $Date1, $Date2) );
		$ValueSessionAll = 0;
		while ($SessionAll->valid()){
			$Session = $SessionAll->current();
			if ($Session->getStatus()==2)
				$ValueSessionAll += $Session->getValue();
			$SessionAll->next();
		}
		
		//Tính tiền trả trước đó
		$Date11 = \date("Y-m-d", strtotime("2013-1-1"));
		$Date21 = \date("Y-m-d", strtotime("-1 day", strtotime($this->getDateStart())));
		$CollectAll = $mCC->findByTracking( array($IdCustomer, $Date11, $Date21) );				
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
	
	//CÁC GIAO DỊCH THU TIỀN KHÁCH HÀNG TRONG KÌ
	function getCustomerCollectAll($IdCustomer){$mCC = new \MVC\Mapper\CollectCustomer();$Date1 = \date("Y-m-d", strtotime($this->getDateStart() ));$Date2 = \date("Y-m-d", strtotime($this->getDateEnd()   ));$CollectAll = $mCC->findByTracking( array($IdCustomer, $Date1, $Date2) );return $CollectAll;}
	function getCustomerCollectAllValue($IdCustomer){$CollectAll = $this->getCustomerCollectAll($IdCustomer);$Value = 0;while ($CollectAll->valid()){$Collect = $CollectAll->current();$Value += $Collect->getValue();$CollectAll->next();}return $Value;}
	function getCustomerCollectAllValuePrint($IdCustomer){$N = new \MVC\Library\Number($this->getCustomerCollectAllValue($IdCustomer));return $N->formatCurrency()." đ";}
	
	function getCustomerCollectGeneral(){
		$mCC = new \MVC\Mapper\CollectCustomer();
		$Date1 = \date("Y-m-d", strtotime($this->getDateStart() ));
		$Date2 = \date("Y-m-d", strtotime($this->getDateEnd()   ));
		$CollectAll = $mCC->findByTracking1( array($Date1, $Date2) );
		return $CollectAll;
	}
	
	function getCustomerCollectGeneralValue(){
		$CollectAll = $this->getCustomerCollectGeneral();
		$Value = 0;
		while ($CollectAll->valid()){
			$Collect = $CollectAll->current();
			$Value += $Collect->getValue();
			$CollectAll->next();
		}
		return $Value;
	}
	function getCustomerCollectGeneralValuePrint(){$N = new \MVC\Library\Number( $this->getCustomerCollectGeneralValue() );return $N->formatCurrency()." đ";}	
	
	//NỢ MỚI
	function getCustomerNewDebt($IdCustomer){
		return $this->getCustomerOldDebt($IdCustomer) + $this->getCustomerDebtSessionAllValue($IdCustomer) - $this->getCustomerCollectAllValue($IdCustomer);
	}
	function getCustomerNewDebtPrint($IdCustomer){$N = new \MVC\Library\Number( $this->getCustomerNewDebt($IdCustomer) );return $N->formatCurrency()." đ";}	
	function getCustomerNewDebtStrPrint($IdCustomer){$N = new \MVC\Library\Number( $this->getCustomerNewDebt($IdCustomer) );return $N->readDigit();}
	
	//THỐNG KÊ PHÒNG/PHIẾU/GIỜ
	function getTableSession($IdTable){		
		$Date1 = \date("Y-m-d", strtotime($this->getDateStart()))." 8:0:0";
		$Date2 = \date("Y-m-d", strtotime("+1 day", strtotime($this->getDateEnd())))." 7:59:59";		
		$mSession = new \MVC\Mapper\Session();
		$SessionAll = $mSession->findByTableTracking(array($IdTable,$Date1,$Date2));
		return $SessionAll;
	}
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLView(){			return "/report/".$this->getId();}
	function getURLReportCourse(){	return "/report/".$this->getId()."/course";}
	
	function getURLPayRoll(){return "/payroll/".$this->getId();}	
	function getURLPayRollEmployee( $Employee ){return "/payroll/".$this->getId()."/".$Employee->getId();}
			
	function getURLCustomer(){return "/report/customer/".$this->getId();}
	function getURLCustomerDetail($IdCustomer){return "/report/customer/".$this->getId()."/".$IdCustomer;}
	
	function getURLResource()		{return "/report/resource/".$this->getId();}
	function getURLHours()			{return "/report/hours/".$this->getId();}
	function getURLGeneral()		{return "/report/general/".$this->getId();}
		
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
}
?>