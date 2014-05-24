<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class OrderExport extends Object{

    private $Id;
	private $IdCustomer;
	private $Date;
    private $Note;
			
	/*Hàm khởi tạo và thiết lập các thuộc tính*/
    function __construct( $Id=null, $IdCustomer=null, $Date=null, $Note=null){
        $this->Id = $Id;
		$this->IdCustomer = $IdCustomer;
		$this->Date = $Date;
		$this->Note = $Note;
        parent::__construct( $Id );
    }
    function getId( ) 		{return $this->Id;}
	function setId( $Id ) 	{return $this->Id = $Id;}
    
	function setIdCustomer( $IdCustomer ) {$this->IdCustomer = $IdCustomer;$this->markDirty();}
    function getIdCustomer( ) {return $this->IdCustomer;}
	function getCustomer( ) {	
		$mCustomer 	= new \MVC\Mapper\Customer();
		$Customer 	= $mCustomer->find($this->IdCustomer);		
        return $Customer;
    }
	
	function getDate( ) {return $this->Date;}
    function setDate( $Date ) {$this->Date = $Date;$this->markDirty();}
	function getDatePrint( ) {$Date = new \MVC\Library\Date($this->Date); return $Date->getDateFormat();}
			
	function getNote( ) {return $this->Note;}
	function setNote( $Note ) {$this->Note = $Note;$this->markDirty();}
	
	function getDetailAll(){		
		$mOD = new \MVC\Mapper\OrderExportDetail();
		$ODAll = $mOD->findBy(array(
			$this->getId()
		));
		
		return $ODAll;
	}
	
	function getValue(){
		$DetailAll = $this->getDetailAll();
		$Count = 0;
		while ($DetailAll->valid()){
			$Count += $DetailAll->current()->getValue();
			$DetailAll->next();
		}
		return $Count;
	}
	
	function getValuePrint(){
		$Value = new \MVC\Library\Number($this->getValue());
		return $Value->formatCurrency()." đ";
	}
	
	function getValueStrPrint(){
		$Value = new \MVC\Library\Number($this->getValue());
		return $Value->readDigit()." đồng";
	}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdCustomer' 	=> $this->getIdSupplier(),
			'Date'			=> $this->getDate(),
			'Note'	=> $this->getNote()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];	
		$this->IdCustomer 	= $Data[1];	
		$this->Date 		= $Data[2];
		$this->Note 		= $Data[3];
    }
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLPrint(){return 	"/admin/selling/session/".$this->getId()."/print";}
	function getURLDetail(){return 	"/admin/export/".$this->getIdCustomer()."/".$this->getId();}
	
	//---------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	
}
?>