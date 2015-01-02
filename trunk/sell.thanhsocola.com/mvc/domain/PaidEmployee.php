<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class PaidEmployee extends Object{

    private $Id;
	private $IdEmployee;
	private $Date;
    private $Value;	
	private $Note;
					
	//-------------------------------------------------------------------------
	//Hàm khởi tạo và thiết lập các thuộc tính
	//-------------------------------------------------------------------------
    function __construct(
		$Id=null,
		$IdEmployee=null,
		$Date=null,
		$Value=0,		
		$Note=null
	) {
        $this->Id 			= $Id;
		$this->IdEmployee 	= $IdEmployee;
		$this->Date 		= $Date;
		$this->Value 		= $Value;		
		$this->Note 		= $Note;
        parent::__construct( $Id );
    }
    function setId( $Id ) { $this->Id = $Id; $this->markDirty(); }
    function getId( ) { return $this->Id;}
	function getIdPrint( ) { return "SupplierPaid".$this->Id;}
			
    function setIdEmployee( $IdEmployee ) { $this->IdEmployee = $IdEmployee; $this->markDirty();}
    function getIdEmployee( ) { return $this->IdEmployee;}
	function getEmployee( ) { $mEmployee = new \MVC\Mapper\Employee(); $Employee = $mEmployee->find($this->IdEmployee); return $Employee; }
    
	function setValue( $Value ) { $this->Value = $Value; $this->markDirty(); }
	function getValue( ) { return $this->Value;}
	function getValuePrint( ) { $num = number_format($this->Value, 0, ',', '.'); return $num;}
		
	function setDate( $Date ) {$this->Date = $Date; $this->markDirty(); }
	function getDate( ) { return $this->Date; }
	function getDatePrint( ) { $date = new \DateTime($this->Date); return $date->format('d/m/Y'); }
			   
	function setNote( $Note ) {$this->Note = $Note;$this->markDirty();}
	function getNote( ) { return $this->Note;}	
	
	//-------------------------------------------------------------------------------
	//DATA
	//-------------------------------------------------------------------------------
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdEmployee'	=> $this->getIdEmployee(),
			'Date'			=> $this->getDate(),
			'Value'			=> $this->getValue(),			
			'Note'			=> $this->getNote()
		);
		return json_encode($json);				
	}
			
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->IdEmployee 	= $Data[1];
		$this->Date 		= $Data[2];
		$this->Value 		= $Data[3];
		$this->Note 		= $Data[4];
    }
		
	/*--------------------------------------------------------------------*/	
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}		
}
?>