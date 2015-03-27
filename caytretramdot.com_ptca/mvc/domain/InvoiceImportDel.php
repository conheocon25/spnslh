<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class InvoiceImportDel extends Object{

    private $Id;
	private $IdInvoice;
	private $IdEmployee;	
	private $DateTime;	
	private $Note;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id=null, 
		$IdInvoice	=null, 
		$IdEmployee	=null,		
		$DateTime	=null,		
		$Note		=null
	){
        $this->Id 				= $Id;
		$this->IdInvoice 		= $IdInvoice;
		$this->IdEmployee 		= $IdEmployee;
		$this->IdWarehouse 		= $IdWarehouse;
		$this->DateTime 		= $DateTime;
		$this->Note 			= $Note;
										
        parent::__construct( $Id );
    }
			
    function getId( ) {return $this->Id;}
	function getIdPrint( ) {return "NK / ".$this->Id;}

	function setIdInvoice( $IdInvoice ) {$this->IdInvoice = $IdInvoice; $this->markDirty();}
	function getIdInvoice(){return $this->IdInvoice;}
	function getEmployee(){
		$mEmployee 	= new \MVC\Mapper\Employee();
		$Employee 	= $mEmployee->find($this->IdInvoice);
		return $Employee;
	}
	
	function setIdEmployee( $IdEmployee ) {$this->IdEmployee = $IdEmployee; $this->markDirty();}
	function getIdEmployee(){return $this->IdEmployee;}
	function getSupplier(){
		$mSupplier 	= new \MVC\Mapper\Supplier();
		$Supplier 	= $mSupplier->find($this->IdEmployee);
		return $Supplier;
	}
			
	function setDateTime($DateTime ) {$this->DateTime = $DateTime; $this->markDirty();}
	function getDateTime(){return $this->DateTime;}
	function getDateTimePrint(){
		$t = strtotime($this->DateTime);		
		return date('d/m/y H:i',$t);
	}
			
	function setNote( $Note ) {$this->Note = $Note;$this->markDirty();}
	function getNote(){return $this->Note;}
			
	function toJSON(){
		$json = array(
			'Id' 				=> $this->getId(),
			'IdInvoice'			=> $this->getIdInvoice(),
			'IdEmployee'		=> $this->getIdEmployee(),			
			'DateTime'			=> $this->getDateTime(),			
			'Note'				=> $this->getNote()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 				= $Data[0];
		$this->IdInvoice 		= $Data[1];
		$this->IdEmployee 		= $Data[2];
		$this->DateTime 		= $Data[3];		
		$this->Note 			= $Data[4];
    }
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
					
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $id );}
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------				
		
}
?>