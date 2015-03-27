<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class InvoiceImport extends Object{

    private $Id;
	private $IdEmployee;
	private $IdSupplier;
	private $IdWarehouse;
	private $DateTimeCreated;
	private $DateTimeUpdated;
	private $Note;
	private $State;
	private $Enable;

	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id=null, 
		$IdEmployee=null, 
		$IdSupplier=null,
		$IdWarehouse=null,
		$DateTimeCreated=null,
		$DateTimeUpdated=null,
		$Note=null,
		$State=null,
		$Enable=null
	){
        $this->Id 				= $Id;
		$this->IdEmployee 		= $IdEmployee;
		$this->IdSupplier 		= $IdSupplier;
		$this->IdWarehouse 		= $IdWarehouse;
		$this->DateTimeCreated 	= $DateTimeCreated;
		$this->DateTimeUpdated 	= $DateTimeUpdated;
		$this->Note 			= $Note;
		$this->State 			= $State;
		$this->Enable 			= $Enable;
								
        parent::__construct( $Id );
    }
	
	function setArray( $Data ){
        $this->Id 				= $Data[0];
		$this->IdEmployee 		= $Data[1];
		$this->IdSupplier 		= $Data[2];
		$this->IdWarehouse 		= $Data[3];
		$this->DateTimeCreated 	= $Data[4];
		$this->DateTimeUpdated 	= $Data[5];
		$this->Note 			= $Data[6];
		$this->State 			= $Data[7];
		$this->Enable 			= $Data[8];
    }
	
    function getId( ) {return $this->Id;}
	function getIdPrint( ) {return "NK / ".$this->Id;}

	function setIdEmployee( $IdEmployee ) {$this->IdEmployee = $IdEmployee; $this->markDirty();}
	function getIdEmployee(){return $this->IdEmployee;}
	function getEmployee(){
		$mEmployee 	= new \MVC\Mapper\Employee();
		$Employee 	= $mEmployee->find($this->IdEmployee);
		return $Employee;
	}
	
	function setIdSupplier( $IdSupplier ) {$this->IdSupplier = $IdSupplier; $this->markDirty();}
	function getIdSupplier(){return $this->IdSupplier;}
	function getSupplier(){
		$mSupplier 	= new \MVC\Mapper\Supplier();
		$Supplier 	= $mSupplier->find($this->IdSupplier);
		return $Supplier;
	}
	
	function setIdWarehouse( $IdWarehouse ) {$this->IdWarehouse = $IdWarehouse; $this->markDirty();}
	function getIdWarehouse(){return $this->IdWarehouse;}
	function getWarehouse(){
		$mWarehouse 	= new \MVC\Mapper\Warehouse();
		$Warehouse 		= $mWarehouse->find($this->IdWarehouse);
		return $Warehouse;
	}
	
	function setDateTimeCreated($DateTimeCreated ) {$this->DateTimeCreated = $DateTimeCreated; $this->markDirty();}
	function getDateTimeCreated(){return $this->DateTimeCreated;}
	function getDateTimeCreatedPrint(){
		$t = strtotime($this->DateTimeCreated);		
		return date('d/m/y H:i',$t);
	}
	function getDateTimeCreatedStrPrint(){
		$t = strtotime($this->DateTimeCreated);				
		return "Vĩnh Long, ngày ".date('d',$t)." tháng ".date('m',$t)." năm ".date('Y',$t);
	}
	
	function setDateTimeUpdated($DateTimeUpdated ) {$this->DateTimeUpdated = $DateTimeUpdated; $this->markDirty();}
	function getDateTimeUpdated(){return $this->DateTimeUpdated;}
	function getDateTimeUpdatedPrint(){
		$t = strtotime($this->DateTimeUpdated);
		return date('d/m/y H:i',$t);
	}
	
	function setNote( $Note ) {$this->Note = $Note;$this->markDirty();}
	function getNote(){return $this->Note;}
	
	function setEnable( $Enable ) {$this->Enable = $Enable;$this->markDirty();}
	function getEnable(){return $this->Enable;}
	
	function setState( $State ){$this->State = $State; $this->markDirty();}
	function getState(){return $this->State;}
	function getStatePrint(){
		if ($this->State == 0){
			return "Chờ duyệt";
		}
		return "Duyệt xong";
	}
	
	function getDetailAll(){
		$mInvoiceImportDetail = new \MVC\Mapper\InvoiceImportDetail();
		$DetailAll  = $mInvoiceImportDetail->findByInvoice(array($this->getId()));
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
			'IdSupplier'		=> $this->getIdSupplier(),
			'IdWarehouse'		=> $this->getIdWarehouse(),
			'DateTimeCreated'	=> $this->getDateTimeCreated(),
			'DateTimeUpdated'	=> $this->getDateTimeUpdated(),
			'Note'				=> $this->getNote(),
			'State'				=> $this->getState(),
			'Enable'			=> $this->getEnable()
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
	function getURLDetail()	{return "/ql-kho-hang/lenh-nhap/".$this->getIdSupplier()."/".$this->getId();}
	function getURLPrint()	{return "/ql-kho-hang/lenh-nhap/".$this->getIdSupplier()."/".$this->getId()."/print";}
	
	
}
?>