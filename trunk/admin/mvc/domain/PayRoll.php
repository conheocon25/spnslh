<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class PayRoll extends Object{

    private $Id;
	private $IdEmployee;
	private $Date;
    private $State;
	private $Extra;
	private $Late;
				
	//-------------------------------------------------------------------------
	//Hàm khởi tạo và thiết lập các thuộc tính
	//-------------------------------------------------------------------------
    function __construct(
		$Id=null,
		$IdEmployee=null,
		$Date=null,
		$State=0,
		$Extra=0,
		$Late=0
	) {
        $this->Id = $Id;
		$this->IdEmployee = $IdEmployee;
		$this->Date = $Date;
		$this->State = $State;		
		$this->Extra = $Extra;
		$this->Late = $Late;
        parent::__construct( $Id );
    }
    function setId( $Id ) { $this->Id = $Id; $this->markDirty(); }
    function getId( ) { return $this->Id;}
				
    function setIdEmployee( $IdEmployee ) { $this->IdEmployee = $IdEmployee; $this->markDirty();}
    function getIdEmployee( ) { return $this->IdEmployee;}
	function getEmployee( ) { $mEmployee = new \MVC\Mapper\Employee(); $Employee = $mEmployee->find($this->IdEmployee); return $Employee; }
    
	function setState( $State ) { $this->State = $State; $this->markDirty(); }	
	function getState( ) { return $this->State;}
	function getStatePrint( ) { return $this->State==1?'Có':'Không';}
	
	function setExtra( $Extra ) { $this->Extra = $Extra; $this->markDirty(); }
	function getExtra( ) { return $this->Extra;}
	function getExtraPrint( ) { return $this->Extra==1?'Có':'Không';}
	
	function setLate( $Late ) { $this->Late= $Late; $this->markDirty(); }
	function getLate( ) { return $this->Late;}
	function getLatePrint( ) { return $this->Late." phút";}
	
	function setDate( $Date ) {$this->Date = $Date; $this->markDirty(); }
	function getDate( ) { return $this->Date; }
	function getDatePrint( ) { $date = new \DateTime($this->Date); return $date->format('d/m/Y'); }
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdEmployee'	=> $this->getIdEmployee(),
			'Date'			=> $this->getDate(),
			'State'			=> $this->getState(),
			'Extra'			=> $this->getExtra(),
			'Late'			=> $this->getLate()
		);
		return json_encode($json);
	}
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
				
	/*--------------------------------------------------------------------*/	
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
		
}
?>