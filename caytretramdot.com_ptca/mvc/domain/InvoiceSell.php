<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class InvoiceSell extends Object{

    private $Id;
	private $IdUser;
	private $IdCustomer;
	private $IdWarehouse;
	private $IdTransport;
	private $IdBranch;
	private $DateTimeCreated;
	private $DateTimeUpdated;
	private $Note;
	private $State;
			
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id=null, 
		$IdUser=null, 
		$IdCustomer=null,
		$IdWarehouse=null,
		$IdTransport=null,
		$IdBranch=null,
		$DateTimeCreated=null,
		$DateTimeUpdated=null,
		$Note=null,
		$State=null
	){
        $this->Id 				= $Id;
		$this->IdUser 			= $IdUser;
		$this->IdCustomer 		= $IdCustomer;
		$this->IdWarehouse 		= $IdWarehouse;
		$this->IdTransport 		= $IdTransport;
		$this->IdBranch 		= $IdBranch;
		$this->DateTimeCreated 	= $DateTimeCreated;
		$this->DateTimeUpdated 	= $DateTimeUpdated;
		$this->Note 			= $Note;
		$this->State 			= $State;
								
        parent::__construct( $Id );
    }
			
    function getId( ) 		{return $this->Id;}
	function getIdPrint( ) 	{return "HĐ / ".$this->Id;}

	function setIdUser( $IdUser ) {$this->IdUser = $IdUser; $this->markDirty();}
	function getIdUser(){return $this->IdUser;}
	function getUser(){
		$mUser 	= new \MVC\Mapper\User();
		$User 	= $mUser->find($this->IdUser);
		return $User;
	}
	
	function setIdCustomer( $IdCustomer ) {$this->IdCustomer = $IdCustomer; $this->markDirty();}
	function getIdCustomer(){return $this->IdCustomer;}
	function getCustomer(){
		$mCustomer 	= new \MVC\Mapper\Customer();
		$Customer 	= $mCustomer->find($this->IdCustomer);
		return $Customer;
	}
	
	function setIdWarehouse( $IdWarehouse ) {$this->IdWarehouse = $IdWarehouse; $this->markDirty();}
	function getIdWarehouse(){return $this->IdWarehouse;}
	function getWarehouse(){
		$mWarehouse 	= new \MVC\Mapper\Warehouse();
		$Warehouse 		= $mWarehouse->find($this->IdWarehouse);
		return $Warehouse;
	}
	
	function setIdTransport( $IdTransport ) {$this->IdTransport = $IdTransport; $this->markDirty();}
	function getIdTransport(){return $this->IdTransport;}
	function getTransport(){
		$mTransport 	= new \MVC\Mapper\Transport();
		$Transport 		= $mTransport->find($this->IdTransport);
		return $Transport;
	}
	
	function setIdBranch( $IdBranch ) {$this->IdBranch = $IdBranch; $this->markDirty();}
	function getIdBranch(){return $this->IdBranch;}
	function getBranch(){
		$mBranch 	= new \MVC\Mapper\Branch();
		$Branch 	= $mBranch->find($this->IdBranch);
		return $Branch;
	}
	
	function setDateTimeCreated($DateTimeCreated ) {$this->DateTimeCreated = $DateTimeCreated; $this->markDirty();}
	function getDateTimeCreated(){return $this->DateTimeCreated;}
	function getDateTimeCreatedPrint(){
		$t = strtotime($this->DateTimeCreated);		
		return date('d/m/Y H:i',$t);
	}
	function getDateTimeCreatedPrint1(){
		$t = strtotime($this->DateTimeCreated);		
		return date('d/m/Y',$t);
	}
	function getDateTimeCreatedStrPrint(){
		$t = strtotime($this->DateTimeCreated);
		return "Vĩnh Long, ngày ".date('d',$t)." tháng ".date('m',$t)." năm ".date('Y',$t);
	}
	function getDateTimeCreatedStr1Print(){
		$current 	= strtotime(date("Y-m-d H:i:s"));
		$date    	= strtotime($this->DateTimeCreated);		
		
		$Str 		= "";
		$Arr1		= array("giây"	, "phút"	, "giờ"	, "ngày", "tháng"	, "năm");
		$Arr2		= array(60		, 60		, 24	, 30	, 12		, 1);
		$Index		= 0;
		$D 			= $current - $date;
		
		while ($D>0){
			if ($Index>2)
				$Str	= ($D%$Arr2[$Index]). " ". $Arr1[$Index]." hơn";
			else
				$Str	= ($D%$Arr2[$Index]). " ". $Arr1[$Index]." ".$Str;
			
			$D 		= floor($D/$Arr2[$Index]);
			$Index ++;
		}
		return $Str;
	}
	
	function setDateTimeUpdated($DateTimeUpdated ) {$this->DateTimeUpdated = $DateTimeUpdated; $this->markDirty();}
	function getDateTimeUpdated(){return $this->DateTimeUpdated;}
	function getDateTimeUpdatedPrint(){
		$t = strtotime($this->DateTimeUpdated);
		return date('d/m/Y H:i',$t);
	}
	
	function setNote( $Note ) {$this->Note = $Note;$this->markDirty();}
	function getNote(){return $this->Note;}
	
	function setState( $State ){$this->State = $State; $this->markDirty();}
	function getState(){return $this->State;}
	function getStatePrint(){
		if ($this->State == 0){
			return "Đang soạn";
		}else if($this->State == 1){
			return "Xuất hàng";
		}else if ($this->State == 2){
			return "Xong";
		}
		return "Hủy";
	}
	
	function getDetailAll(){
		$mInvoiceSellDetail = new \MVC\Mapper\InvoiceSellDetail();
		$DetailAll  = $mInvoiceSellDetail->findByInvoice(array($this->getId()));
		return $DetailAll;
	}
	function getValue(){
		$DetailAll = $this->getDetailAll();
		$Sum = 0;
		while ($DetailAll->valid()){
			$Detail = $DetailAll->current();
			$Sum 	+= $Detail->getValue();
			$DetailAll->next();
		}
		return $Sum;
	}		
	function getValuePrint( ){
		$num = number_format($this->getValue(), 0, ',', ' ');
		return $num;
	}	
	function getValueStrPrint(){$num = new \MVC\Library\Number($this->getValue());return $num->readDigit()." đồng";}
	
	function getCount(){
		$DetailAll = $this->getDetailAll();
		$Count = 0;
		while ($DetailAll->valid()){
			$Detail = $DetailAll->current();
			$Count 	+= $Detail->getCount();
			$DetailAll->next();
		}
		return $Count;
	}
	function getCountPrint( ){
		$num = number_format($this->getCount(), 0, ',', ' ');
		return $num;
	}
	function getCountStrPrint( ){
		$num = new \MVC\Library\Number($this->getCount());
		return $num->readDigit();
	}
	
	function toJSON(){
		$json = array(
			'Id' 				=> $this->getId(),
			'IdUser'			=> $this->getIdUser(),
			'IdCustomer'		=> $this->getIdCustomer(),
			'IdWarehouse'		=> $this->getIdWarehouse(),
			'IdTransport'		=> $this->getIdTransport(),
			'IdBranch'			=> $this->getIdBranch(),
			'DateTimeCreated'	=> $this->getDateTimeCreated(),
			'DateTimeUpdated'	=> $this->getDateTimeUpdated(),
			'Note'				=> $this->getNote(),
			'State'				=> $this->getState()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 				= $Data[0];
		$this->IdUser 		= $Data[1];
		$this->IdCustomer 		= $Data[2];
		$this->IdWarehouse 		= $Data[3];
		$this->IdTransport 		= $Data[4];
		$this->IdBranch 		= $Data[5];
		$this->DateTimeCreated 	= $Data[6];
		$this->DateTimeUpdated 	= $Data[7];
		$this->Note 			= $Data[8];
		$this->State 			= $Data[9];
    }
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
					
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $id );}
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------			
	function getURLSettingCustomer(){return "/admin/setting/customer/".$this->getId();}
	function getURLBranchLoad()		{return "/don-vi/".$this->getBranch()->getKey()."/ban-hang/".$this->getIdCustomer()."/".$this->getId();}
	function getURLBranchPrint()	{return "/don-vi/".$this->getBranch()->getKey()."/ban-hang/".$this->getIdCustomer()."/".$this->getId()."/in";}
	function getURLBranchCheck()	{return "/don-vi/".$this->getBranch()->getKey()."/ban-hang/".$this->getIdCustomer()."/".$this->getId()."/duyet";}
	function getURLBranchInsExe()	{return "/don-vi/".$this->getBranch()->getKey()."/ban-hang/".$this->getIdCustomer()."/".$this->getId()."/exe";	}
		
	function getURLExportLoad()		{return "/ql-kho-hang/lenh-xuat/".$this->getId();}
	function getURLExportPrint()	{return "/ql-kho-hang/lenh-xuat/".$this->getId()."/print";}
	function getURLExportIntroPrint(){return "/ql-kho-hang/lenh-xuat/".$this->getId()."/gioi-thieu/print";}
}
?>