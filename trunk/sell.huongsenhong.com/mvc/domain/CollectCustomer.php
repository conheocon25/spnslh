<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class CollectCustomer extends Object{

    private $Id;
	private $IdCustomer;
	private $Date;
    private $Value;
	private $Note;
					
	//-------------------------------------------------------------------------
	//Hàm khởi tạo và thiết lập các thuộc tính
	//-------------------------------------------------------------------------
    function __construct(
		$Id=null,		
		$IdCustomer=null,
		$Date=null,
		$Value=0,
		$Note=null
	) {
        $this->Id = $Id;
		$this->IdCustomer = $IdCustomer;
		$this->Date = $Date;
		$this->Value = $Value;
		$this->Note = $Note;
        parent::__construct( $Id );
    }
    function setId( $Id ) {$this->Id = $Id; $this->markDirty(); }
    function getId( ) {return $this->Id; }
				
    function setIdCustomer( $IdCustomer ) {$this->IdCustomer = $IdCustomer; $this->markDirty();}
    function getIdCustomer( ) {return $this->IdCustomer;}
	function getCustomer( ) {
		$mCustomer = new \MVC\Mapper\Customer();
		$Customer = $mCustomer->find($this->IdCustomer);		
        return $Customer;
    }
    
	function setValue( $Value ) {$this->Value = $Value; $this->markDirty();}	
	function getValue( ) {if (!isset($this->Value)) return 0; return $this->Value; }
	function getValuePrint( ) { 
		$num = number_format($this->Value, 0, ',', '.');
		return $num." đ";
    }	
	function setDate( $Date ) {$this->Date = $Date; $this->markDirty(); }
	function getDate( ) {return $this->Date; }
	function getDatePrint( ) {  $date = new \DateTime($this->Date); return $date->format('d/m/Y');}
	
	function getEmployee(){
		$mEmployee = new \MVC\Mapper\Employee();
		$Employee = $mEmployee->find($this->IdCustomer);
		return $Employee;
    }
	   
	function setNote( $Note ) {$this->Note = $Note; $this->markDirty(); }
	function getNote( ) {
		if (!isset($this->Note))
			return "Click để thêm ghi chú";
        return $this->Note;
    }	
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	public function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdCustomer'	=> $this->getIdCustomer(),
		 	'Date'			=> $this->getDate(),
		 	'Value'			=> $this->getValue(),
		 	'Note'			=> $this->getNote()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->IdCustomer 	= $Data[1];
		$this->Date 		= $Data[2];
		$this->Value 		= $Data[3];
		$this->Note 		= $Data[4];				
    }	
	
	/*--------------------------------------------------------------------*/	
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
		
}
?>