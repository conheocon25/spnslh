<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class PayRoll extends Object{

    private $Id;
	private $IdEmployee;
	private $IdTracking;
	private $Absent;
    private $BaseValue;	
	private $ExtraValue;
	private $PunishValue;
	private $Note;
	
	//-------------------------------------------------------------------------
	//Hàm khởi tạo và thiết lập các thuộc tính
	//-------------------------------------------------------------------------
    function __construct(
		$Id			= null,
		$IdEmployee	= null,
		$IdTracking	= null,
		$Absent		= 0,
		$BaseValue	= 0,
		$ExtraValue = 0,
		$PunishValue= 0,
		$Note		= 0
	) {
        $this->Id 			= $Id;
		$this->IdEmployee 	= $IdEmployee;
		$this->IdTracking 	= $IdTracking;
		$this->Absent 		= $Absent;
		$this->BaseValue 	= $BaseValue;
		$this->ExtraValue 	= $ExtraValue;
		$this->PunishValue 	= $PunishValue;
		$this->Note 		= $Note;
		
        parent::__construct( $Id );
    }
    function setId( $Id ) { $this->Id = $Id; $this->markDirty(); }
    function getId( ) { return $this->Id;}
				
    function setIdEmployee( $IdEmployee ) { $this->IdEmployee = $IdEmployee; $this->markDirty();}
    function getIdEmployee( ) 			{ return $this->IdEmployee;}
	function getEmployee( ) 			{ $mEmployee = new \MVC\Mapper\Employee(); $Employee = $mEmployee->find($this->IdEmployee); return $Employee; }
    	
	function setIdTracking( $IdTracking ){ $this->IdTracking = $IdTracking; $this->markDirty(); }
	function getIdTracking( ) 			{ return $this->IdTracking;}
	function getTracking()				{
		$mTracking = new \MVC\Mapper\Tracking();
		$Tracking = $mTracking->find($this->IdTracking);
		return $Tracking;
	}
		
	function setAbsent( $Absent ) 		{ $this->Absent = $Absent; $this->markDirty(); }
	function getAbsent( ) 				{ return $this->Absent;}	
	function getAbsentPrint( ) 			{ $N = new \MVC\Library\Number( $this->getAbsent() ); return $N->formatCurrency();}
	function getAbsentValue( ) 			{ 
		//return $this->getAbsent()*($this->getBaseValue()/$this->getTracking()->getPayRollAll()->count());		
		return $this->getAbsent()*($this->getBaseValue()/$this->getTracking()->getDailyAll()->count());		
	}
	function getAbsentValuePrint( ) 	{ $N = new \MVC\Library\Number( $this->getAbsentValue() ); return $N->formatCurrency();}

	function setBaseValue( $BaseValue )	{ $this->BaseValue = $BaseValue; $this->markDirty();}
	function getBaseValue( ) 			{ return $this->BaseValue;}
	function getBaseValuePrint( ) 		{ $N = new \MVC\Library\Number( $this->getBaseValue() ); return $N->formatCurrency();}
	
	function setExtraValue( $ExtraValue ){ $this->ExtraValue = $ExtraValue; $this->markDirty();}
	function getExtraValue( ) 			{ return $this->ExtraValue;}
	function getExtraValuePrint( ) 		{ $N = new \MVC\Library\Number( $this->getExtraValue() ); return $N->formatCurrency();}
	
	function setPunishValue( $PunishValue ){ $this->PunishValue = $PunishValue; $this->markDirty();}
	function getPunishValue( ) 			{ return $this->PunishValue;}
	function getPunishValuePrint( ) 		{ $N = new \MVC\Library\Number( $this->getPunishValue() ); return $N->formatCurrency();}
	
	function getValue()					{
		$mTrack = new \MVC\Mapper\Tracking();
		$mPE = new \MVC\Mapper\PaidEmployee();
		
		$Track 		= $mTrack->find($this->getIdTracking());
		$PaidAll	= $mPE->findByTracking1(array($this->getIdEmployee(), $Track->getDateStart(), $Track->getDateEnd()));
		
		$PV = 0;
		while ($PaidAll->valid()){
			$Paid = $PaidAll->current();
			$PV += $Paid->getValue();
			$PaidAll->next();
		}
			
		return (
					$this->getBaseValue() + 
					$this->getExtraValue() - 
					$this->getAbsentValue() - 
					$this->getPunishValue() - 
					$PV
		);
	}	
	function getValuePrint( ) 			{ $N = new \MVC\Library\Number( $this->getValue() ); return $N->formatCurrency();}
	
	function setNote( $Note )			{ $this->Note = $Note; $this->markDirty();}
	function getNote( ) 				{ return $this->Note;}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdEmployee'	=> $this->getIdEmployee(),
			'IdTracking'	=> $this->getIdTracking(),
			'Absent'		=> $this->getAbsent(),
			'BaseValue'		=> $this->getBaseValue(),
			'ExtraValue'	=> $this->getExtraValue(),
			'PunishValue'	=> $this->getPunishValue(),
			'Note'			=> $this->getNote()
		);		
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->IdEmployee 	= $Data[1];
		$this->IdTracking 	= $Data[2];
		$this->Absent 		= $Data[3];
		$this->BaseValue 	= $Data[4];
		$this->ExtraValue 	= $Data[5];
		$this->PunishValue 	= $Data[6];
		$this->Note 		= $Data[7];
    }
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLPrint(){return "/payroll/".$this->getIdTracking()."/".$this->getId()."/print";}
	
	/*--------------------------------------------------------------------*/	
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
		
}
?>