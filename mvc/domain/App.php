<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
use MVC\Library\Logger;

class App extends Object{

    private $Id;
	private $Name;
	private $Phone;
	private $Address;
	private $Email;
	private $Banner;
	private $Prefix;	
	private $Alias;	
	private $DateCreated;
	private $DateModified;	
	private $DateActivity;	
	private $Type;
	private $PageView;
	
	/*Hàm khởi tạo và thiết lập các thuộc tính*/
    function __construct( 
		$Id = null,
		$Name = null,
		$Phone = null,
		$Address = null,
		$Email = null,
		$Banner = null,
		$Prefix = null,
		$Alias = null,
		$DateCreated = null,	
		$DateModified = null,	
		$DateActivity = null,	
		$Type = null,
		$PageView = null
	){
        $this->Id = $Id;
		$this->Name = $Name;
		$this->Phone = $Phone;
		$this->Address = $Address;
		$this->Email = $Email;
		$this->Banner = $Banner;
		$this->Prefix = $Prefix;
		$this->Alias = $Alias;
		$this->DateCreated = $DateCreated;
		$this->DateModified = $DateModified;
		$this->DateActivity = $DateActivity;
		$this->Type = $Type;
		$this->PageView = $PageView;
				
		$this->Logger = new Logger("data/log/".$Prefix."log.txt" , Logger::DEBUG );
        parent::__construct( $Id );
    }
	function getLogger() {
        return $this->Logger;
    }
	
	function setId($Id) {
        $this->Id = $Id; 
    }
	
    function getId() {
        return $this->Id;
    } 	
		
    function setName( $Name ) {
        $this->Name = $Name;
        $this->markDirty();
    }   
	function getName( ) {
        return $this->Name;
    }
	
	function setPhone( $Phone) {
        $this->Phone = $Phone;
        $this->markDirty();
    }   
	function getPhone( ) {
        return $this->Phone;
    }
	
	function setAddress( $Address) {
        $this->Address = $Address;
        $this->markDirty();
    }   
	function getAddress( ) {
        return $this->Address;
    }
	
	function setEmail( $Email) {
        $this->Email = $Email;
        $this->markDirty();
    }   
	function getEmail( ) {
        return $this->Email;
    }
	
	function setBanner( $Banner){
        $this->Banner = $Banner;
        $this->markDirty();
    }   
	function getBanner(){
        return $this->Banner;
    }
	
	function setPrefix( $Prefix){
        $this->Prefix = $Prefix;
        $this->markDirty();
    }
	function getPrefix(){
        return $this->Prefix;
    }
	
	function countTables(){
		$mApp = new \MVC\Mapper\App();
		return $mApp->countTables(array($this->Prefix));
	}
	function getSizeDB(){
		$mApp = new \MVC\Mapper\App();
		return $mApp->getSizeDB(array($this->Prefix));
	}
	function getSizeDBPrint(){
		$Value = $this->getSizeDB();
		return round($Value,2)." MB";
	}
	
	function setAlias( $Alias){
        $this->Alias = $Alias;
        $this->markDirty();
    }
	function getAlias(){
        return $this->Alias;
    }
	
	//-----------------------------------------------------------------------
	//Thiết lập ngày tháng của ứng dụng
	//-----------------------------------------------------------------------
	function setDateCreated( $DateCreated){
        $this->DateCreated = $DateCreated;
        $this->markDirty();
    }
	function getDateCreated(){
        return $this->DateCreated;
    }
	function getDateCreatedPrint(){
		$D = new \MVC\Library\Date($this->DateCreated);
        return $D->getDateFormat();
    }
	
	function setDateModified( $DateModified){
        $this->DateModified = $DateModified;
        $this->markDirty();
    }
	function getDateModified(){
        return $this->DateModified;
    }
	function getDateModifiedPrint(){
		$D = new \MVC\Library\Date($this->DateModified);
        return $D->getDateFormat();
    }
	
	function setDateActivity( $DateActivity){
        $this->DateActivity = $DateActivity;
        $this->markDirty();
    }
	function increaseDateActivity($Value=0){
		$D = new \DateTime($DateActivity);
		$D->add(new \DateInterval('P7D'));
		$this->DateActivity = $D->format('Y-m-d H:i:s');
        $this->markDirty();
    }
	function getDateActivity(){
        return $this->DateActivity;
    }
	function getDateActivityPrint(){
		$D = new \MVC\Library\Date($this->DateActivity);
        return $D->getDateFormat();
    }
		
	function remainPercentUpdated(){
		$D1 = strtotime($this->DateActivity);
		$D2 = strtotime(date("Y-m-d H:i:s"));
		if ($D1 < $D2)
			return 0;
		$Delta = $D1 - $D2;
		
		return (round($Delta/3600,1));
	}
	
	//-----------------------------------------------------------------------
	function setType( $Type){
        $this->Type = $Type;
        $this->markDirty();
    }
	function getType(){
        return $this->Type;
    }
	
	function setPageView( $PageView){
        $this->PageView = $PageView;
        $this->markDirty();
    }
	function setPageViewPlus(){
        $this->PageView += 1;
        $this->markDirty();
    }
	function getPageView(){
        return $this->PageView;
    }
	function getPageViewPrint(){
		$N = new \MVC\Library\Number($this->PageView);		
        return $N->formatCurrency();
    }
	
	//---------------------------------------------------------------------
	//Danh sách các URL chính
	//---------------------------------------------------------------------
	function getURLApp(){
		return "/".$this->Alias;
	}
	
	function getURLSetting(){
		return "/".$this->Alias."/setting";
	}
	function getURLReport(){
		return "/".$this->Alias."/report";
	}
	function getURLPaid(){
		return "/".$this->Alias."/paid";
	}
	function getURLImport(){
		return "/".$this->Alias."/import";
	}
	function getURLSelling(){
		return "/".$this->Alias."/selling";
	}
	
	function getURLSignin(){		
		return "/".$this->Alias."/signin";
	}	
	function getURLSignout(){
		return "/".$this->Alias."/signout";
	}
	
	//---------------------------------------------------------------------
	//Danh sách các URL Selling	
	//---------------------------------------------------------------------
	function getURLSellingCustom1(){
		return "/".$this->Alias."/selling#custom1";
	}
	function getURLSellingCustom2(){
		return "/".$this->Alias."/selling#custom2";
	}
	
	//---------------------------------------------------------------------
	//Danh sách các URL Paid	
	//---------------------------------------------------------------------
	function getURLPaidOther(){
		return "/".$this->Alias."/paid#other";
	}
	function getURLPaidSupplier(){
		return "/".$this->Alias."/paid#supplier";
	}
	function getURLPaidEmployee(){
		return "/".$this->Alias."/paid#employee";
	}
		
	//---------------------------------------------------------------------
	//Danh sách các URL Setting.Info
	//---------------------------------------------------------------------		
	function getURLSettingInfo(){
		return "/".$this->Alias."/setting#info";
	}
	function getURLSettingInfoPasswdLoad(){
		return "/".$this->Alias."/setting/info/passwd/load";
	}
	function getURLSettingInfoPasswdExe(){
		return "/".$this->Alias."/setting/info/passwd/exe";
	}
	function getURLSettingInfoUpdLoad(){
		return "/".$this->Alias."/setting/info/upd/load";
	}
	function getURLSettingInfoUpdExe(){
		return "/".$this->Alias."/setting/info/upd/exe";
	}
	
	//---------------------------------------------------------------------
	//URL của đơn vị tính
	//---------------------------------------------------------------------
	function getURLSettingUnit(){
		return "/".$this->Alias."/setting#unit";
	}
	function getURLSettingUnitInsLoad(){
		return "/".$this->Alias."/setting/unit/ins/load";
	}
	function getURLSettingUnitInsExe(){
		return "/".$this->Alias."/setting/unit/ins/exe";
	}
	
	//---------------------------------------------------------------------
	//URL của khu vực
	//---------------------------------------------------------------------
	function getURLSettingDomain(){
		return "/".$this->Alias."/setting#domain";
	}
	function getURLSettingDomainInsLoad(){
		return "/".$this->Alias."/setting/domain/ins/load";
	}
	function getURLSettingDomainInsExe(){
		return "/".$this->Alias."/setting/domain/ins/exe";
	}
	
	//---------------------------------------------------------------------
	//URL của danh mục món
	//---------------------------------------------------------------------
	function getURLSettingCategory(){
		return "/".$this->Alias."/setting#category";
	}
	function getURLSettingCategoryInsLoad(){
		return "/".$this->Alias."/setting/category/ins/load";
	}
	function getURLSettingCategoryInsExe(){
		return "/".$this->Alias."/setting/category/ins/exe";
	}
	
	//---------------------------------------------------------------------
	//URL của nhà cung cấp
	//---------------------------------------------------------------------
	function getURLSettingSupplier(){
		return "/".$this->Alias."/setting#supplier";
	}
	function getURLSettingSupplierInsLoad(){
		return "/".$this->Alias."/setting/supplier/ins/load";
	}
	function getURLSettingSupplierInsExe(){
		return "/".$this->Alias."/setting/supplier/ins/exe";
	}
	
	//---------------------------------------------------------------------		
	//URL của nhân viên
	//---------------------------------------------------------------------
	function getURLSettingEmployee(){
		return "/".$this->Alias."/setting#employee";
	}
	function getURLSettingEmployeeInsLoad(){
		return "/".$this->Alias."/setting/employee/ins/load";
	}
	function getURLSettingEmployeeInsExe(){
		return "/".$this->Alias."/setting/employee/ins/exe";
	}
	
	//---------------------------------------------------------------------		
	//URL của nhân viên
	//---------------------------------------------------------------------
	function getURLSettingTerm(){
		return "/".$this->Alias."/setting#term";
	}
	function getURLSettingTermInsLoad(){
		return "/".$this->Alias."/setting/term/ins/load";
	}
	function getURLSettingTermInsExe(){
		return "/".$this->Alias."/setting/term/ins/exe";
	}
	
	//---------------------------------------------------------------------			
	//Danh sách các URL Reports	
	//---------------------------------------------------------------------
	function getURLReportSelling(){
		return "/".$this->Alias."/report#selling";
	}
	function getURLReportSellingToday(){
		return "/".$this->Alias."/report/selling/today";
	}
	function getURLReportSellingYesterday(){
		return "/".$this->Alias."/report/selling/yesterday";
	}
	function getURLReportSellingThisWeek(){
		return "/".$this->Alias."/report/selling/thisweek";
	}
	function getURLReportSellingThisMonth(){
		return "/".$this->Alias."/report/selling/thismonth";
	}
	function getURLReportSellingCustom(){
		return "/".$this->Alias."/report/selling/custom";
	}
	
	function getURLReportSupplier(){
		return "/".$this->Alias."/report#supplier";
	}
	function getURLReportSupplierThisMonth(){
		return "/".$this->Alias."/report/supplier/thismonth";
	}
	function getURLReportSupplierCustom(){
		return "/".$this->Alias."/report/supplier/custom";
	}
	
	function getURLReportEmployee(){
		return "/".$this->Alias."/report#employee";
	}
	function getURLReportEmployeeThisMonth(){
		return "/".$this->Alias."/report/employee/thismonth";
	}
	function getURLReportEmployeeCustom(){
		return "/".$this->Alias."/report/employee/custom";
	}
	
	function getURLReportOther(){
		return "/".$this->Alias."/report#other";
	}
	function getURLReportOtherThisMonth(){
		return "/".$this->Alias."/report/other/thismonth";
	}
	function getURLReportOtherCustom(){
		return "/".$this->Alias."/report/other/custom";
	}
	
	//---------------------------------------------------------------------
    static function findAll() {
        $finder = self::getFinder( __CLASS__ ); 
        return $finder->findAll();
    }
	
    static function find( $Id ) {
        $finder = self::getFinder( __CLASS__ ); 
        return $finder->find( $Id );
    }
	
}
?>