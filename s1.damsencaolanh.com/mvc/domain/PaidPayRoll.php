<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class PaidPayRoll extends Object{

    private $Id;
	private $IdEmployee;
	private $Date;
    private $ValueBase;
	private $ValueSub;
	private $ValuePre;
	private $Note;
					
	//-------------------------------------------------------------------------
	//Hàm khởi tạo và thiết lập các thuộc tính
	//-------------------------------------------------------------------------
    function __construct(
		$Id=null,
		$IdEmployee=null,
		$Date=null,
		$ValueBase=0,
		$ValueSub=0,
		$ValuePre=0,
		$Note=null
	) {
        $this->Id = $Id;
		$this->IdEmployee = $IdEmployee;
		$this->Date = $Date;
		$this->ValueBase = $ValueBase;
		$this->ValueSub = $ValueSub;
		$this->ValuePre = $ValuePre;
		$this->Note = $Note;
        parent::__construct( $Id );
    }
    function setId( $Id ) { $this->Id = $Id; $this->markDirty(); }
    function getId( ) { return $this->Id;}
	function getIdPrint( ) { return "SupplierPaid".$this->Id;}
			
    function setIdEmployee( $IdEmployee ) { $this->IdEmployee = $IdEmployee; $this->markDirty();}
    function getIdEmployee( ) { return $this->IdEmployee;}
	function getEmployee( ) { $mEmployee = new \MVC\Mapper\Employee(); $Employee = $mEmployee->find($this->IdEmployee); return $Employee; }
    
	function setValueBase( $ValueBase ) { $this->ValueBase = $ValueBase; $this->markDirty(); }	
	function getValueBase( ) { return $this->ValueBase;}
	function getValueBasePrint( ) { $num = number_format($this->ValueBase, 0, ',', '.'); return $num." đ";}

	function setValueSub( $ValueSub ) { $this->ValueSub = $ValueSub; $this->markDirty(); }	
	function getValueSub( ) { return $this->ValueSub;}
	function getValueSubPrint( ) { $num = number_format($this->ValueSub, 0, ',', '.'); return $num." đ";}
	
	function setValuePre( $ValuePre ) { $this->ValuePre = $ValuePre; $this->markDirty(); }	
	function getValuePre( ) { return $this->ValuePre;}
	function getValuePrePrint( ) { $num = number_format($this->ValuePre, 0, ',', '.'); return $num." đ";}
	
	function setDate( $Date ) {$this->Date = $Date; $this->markDirty(); }
	function getDate( ) { return $this->Date; }
	function getDatePrint( ) { $date = new \DateTime($this->Date); return $date->format('d/m/Y'); }
			   
	function setNote( $Note ) {$this->Note = $Note;$this->markDirty();}
	function getNote( ) { return $this->Note;}	
		
	function getValueReal( ) { return $this->ValueBase + $this->ValueSub - $this->ValuePre;}
	function getValueRealPrint( ) { $num = number_format($this->getValueReal(), 0, ',', '.'); return $num." đ";}
	
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdTerm'		=> $this->getIdEmployee(),
			'Date'			=> $this->getDate(),
			'ValueBase'		=> $this->getValueBase(),
			'ValueSub'		=> $this->getValueSub(),
			'ValuePre'		=> $this->getValuePre(),
			'Note'			=> $this->getNote()
		);
		return json_encode($json);				
	}
			
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->IdEmployee 	= $Data[1];
		$this->Date 		= $Data[2];
		$this->ValueBase 	= $Data[3];
		$this->ValueSub 	= $Data[4];
		$this->ValuePre 	= $Data[5];
		$this->Note 		= $Data[6];
    }
	
	/*--------------------------------------------------------------------*/	
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}		
}
?>