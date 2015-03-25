<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class InvoiceSell extends Object{

    private $Id;
	private $IdEmployee;
	private $IdCustomer;
	private $DateTimeCreated;
	private $DateTimeUpdated;
	private $Note;
	private $State;
			
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id=null, 
		$IdEmployee=null, 
		$IdCustomer=null,
		$DateTimeCreated=null,
		$DateTimeUpdated=null,
		$Note=null,
		$State=null
	){
        $this->Id 				= $Id;
		$this->IdEmployee 		= $IdEmployee;
		$this->IdCustomer 		= $IdCustomer;
		$this->DateTimeCreated 	= $DateTimeCreated;
		$this->DateTimeUpdated 	= $DateTimeUpdated;
		$this->Note 			= $Note;
		$this->State 			= $State;
								
        parent::__construct( $Id );
    }
	
	function setArray( $Data ){
        $this->Id 				= $Data[0];
		$this->IdEmployee 		= $Data[1];
		$this->IdCustomer 		= $Data[2];
		$this->DateTimeCreated 	= $Data[3];
		$this->DateTimeUpdated 	= $Data[4];
		$this->Note 			= $Data[5];
		$this->State 			= $Data[6];
    }
	
    function getId( ) {return $this->Id;}

	function setIdEmployee( $IdEmployee ) {$this->IdEmployee = $IdEmployee; $this->markDirty();}
	function getIdEmployee(){return $this->IdEmployee;}
	function getEmployee(){
		$mEmployee 	= new \MVC\Mapper\Employee();
		$Employee 	= $mEmployee->find($this->IdEmployee);
		return $Employee;
	}
	
	function setIdCustomer( $IdCustomer ) {$this->IdCustomer = $IdCustomer; $this->markDirty();}
	function getIdCustomer(){return $this->IdCustomer;}
	function getCustomer(){
		$mCustomer 	= new \MVC\Mapper\Customer();
		$Customer 	= $mCustomer->find($this->IdCustomer);
		return $Customer;
	}
	
	function setDateTimeCreated($DateTimeCreated ) {$this->DateTimeCreated = $DateTimeCreated; $this->markDirty();}
	function getDateTimeCreated(){return $this->DateTimeCreated;}
	function getDateTimeCreatedPrint(){
		$t = strtotime($this->DateTimeCreated);		
		return date('d/m/y H:i',$t);
	}
	
	function setDateTimeUpdated($DateTimeUpdated ) {$this->DateTimeUpdated = $DateTimeUpdated; $this->markDirty();}
	function getDateTimeUpdated(){return $this->DateTimeUpdated;}
	function getDateTimeUpdatedPrint(){
		$t = strtotime($this->DateTimeUpdated);
		return date('d/m/y H:i',$t);
	}
	
	function setNote( $Note ) {$this->Note = $Note;$this->markDirty();}
	function getNote(){return $this->Note;}
	
	function setState( $State ){$this->State = $State; $this->markDirty();}
	function getState(){return $this->State;}
	function getStatePrint(){
		if ($this->State == 0){
			return "Chờ duyệt";
		}
		return "Duyệt xong";
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
	
	function toJSON(){
		$json = array(
			'Id' 				=> $this->getId(),
			'IdEmployee'		=> $this->getIdEmployee(),
			'IdCustomer'		=> $this->getIdCustomer(),
			'DateTimeCreated'	=> $this->getDateTimeCreated(),
			'DateTimeUpdated'	=> $this->getDateTimeUpdated(),
			'Note'				=> $this->getNote(),
			'State'				=> $this->getState()
		);
		return json_encode($json);
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
	function getURLLoad(){return "/ql-ban-hang/khach-hang/".$this->getIdCustomer()."/".$this->getId();}
	function getURLPrint(){return "/ql-ban-hang/khach-hang/".$this->getIdCustomer()."/".$this->getId()."/print";}
	
	function getURLExportLoad()	{return "/ql-kho-hang/lenh-xuat/".$this->getId();}
	function getURLExportPrint(){return "/ql-kho-hang/lenh-xuat/".$this->getId()."/print";}
}
?>