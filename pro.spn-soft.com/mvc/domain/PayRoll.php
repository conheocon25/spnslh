<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class PayRoll extends Object{

    private $Id;
	private $IdEmployee;
	private $Date;
    private $Session1;
	private $Session2;
	private $Session3;
	private $Extra;
	private $Late;
		
	//-------------------------------------------------------------------------
	//Hàm khởi tạo và thiết lập các thuộc tính
	//-------------------------------------------------------------------------
    function __construct(
		$Id=null,
		$IdEmployee=null,
		$Date=null,
		$Session1=0,
		$Session2=0,
		$Session3=0,
		$Extra=0,
		$Late=0
	) {
        $this->Id 			= $Id;
		$this->IdEmployee 	= $IdEmployee;
		$this->Date 		= $Date;
		$this->Session1 	= $Session1;
		$this->Session2 	= $Session2;
		$this->Session3 	= $Session3;
		$this->Extra 		= $Extra;
		$this->Late 		= $Late;
		
        parent::__construct( $Id );
    }
    function setId( $Id ) { $this->Id = $Id; $this->markDirty(); }
    function getId( ) { return $this->Id;}
				
    function setIdEmployee( $IdEmployee ) { $this->IdEmployee = $IdEmployee; $this->markDirty();}
    function getIdEmployee( ) 			{ return $this->IdEmployee;}
	function getEmployee( ) 			{ $mEmployee = new \MVC\Mapper\Employee(); $Employee = $mEmployee->find($this->IdEmployee); return $Employee; }
    
	function setSession1( $Session1 ) 	{ $this->Session1 = $Session1; $this->markDirty(); }
	function getSession1( ) 			{ return $this->Session1;}
	function getSession1Print( ) 		{ $N = new \MVC\Library\Number( $this->getSession1() ); return $N->formatCurrency();}
	
	function setSession2( $Session1 ) 	{ $this->Session2 = $Session2; $this->markDirty(); }
	function getSession2( ) 			{ return $this->Session2;}
	function getSession2Print( ) 		{ $N = new \MVC\Library\Number( $this->getSession2() ); return $N->formatCurrency();}
	
	function setSession3( $Session3 ) 	{ $this->Session3 = $Session3; $this->markDirty(); }
	function getSession3( ) 			{ return $this->Session3;}
	function getSession3Print( ) 		{ $N = new \MVC\Library\Number( $this->getSession3() ); return $N->formatCurrency();}
	
	function setExtra( $Extra ) 		{ $this->Extra = $Extra; $this->markDirty();}
	function getExtra( ) 				{ return $this->Extra;}
	function getExtraPrint( ) 			{ $N = new \MVC\Library\Number( $this->getExtra() ); return $N->formatCurrency();}
	
	function setLate( $Late ) 			{ $this->Late= $Late; $this->markDirty(); }
	function getLate( ) 				{ return $this->Late;}
	function getLatePrint( ) 			{ $N = new \MVC\Library\Number( $this->getLate() ); return $N->formatCurrency();}
	
	function setDate( $Date ) 			{$this->Date = $Date; $this->markDirty(); }
	function getDate( ) 				{ return $this->Date; }
	function getDatePrint( ) 			{ $date = new \DateTime($this->Date); return $date->format('d/m/Y'); }
	
	function getValue()					{ return ($this->getSession1() + $this->getSession2() + $this->getSession3() + $this->getExtra() - $this->getLate()  );}
	function getValuePrint( ) 			{ $N = new \MVC\Library\Number( $this->getValue() ); return $N->formatCurrency();}
		
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdEmployee'	=> $this->getIdEmployee(),
			'Date'			=> $this->getDate(),
			'Session1'		=> $this->getSession1(),
			'Session2'		=> $this->getSession2(),
			'Session3'		=> $this->getSession3(),
			'Extra'			=> $this->getExtra(),
			'Late'			=> $this->getLate()
		);		
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->IdEmployee 	= $Data[1];
		$this->Date 		= $Data[2];
		$this->Session1 	= $Data[3];
		$this->Session2 	= $Data[4];
		$this->Session3 	= $Data[5];
		$this->Extra 		= $Data[6];
		$this->Late 		= $Data[7];
    }	
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	
	/*--------------------------------------------------------------------*/	
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
		
}
?>