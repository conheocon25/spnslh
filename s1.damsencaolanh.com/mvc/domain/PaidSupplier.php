<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class PaidSupplier extends Object{

    private $Id;
	private $IdSupplier;
	private $Date;
    private $Value;
	private $Note;
	
	private $Supplier;
			
	//-------------------------------------------------------------------------
	//Hàm khởi tạo và thiết lập các thuộc tính
	//-------------------------------------------------------------------------
    function __construct(
		$Id=null,		
		$IdSupplier=null,
		$Date=null,
		$Value=0,
		$Note=null
	) {
        $this->Id = $Id;
		$this->IdSupplier = $IdSupplier;
		$this->Date = $Date;
		$this->Value = $Value;
		$this->Note = $Note;
        parent::__construct( $Id );
    }
    function setId( $Id ) 	{$this->Id = $Id; $this->markDirty(); }
    function getId( ) 		{return $this->Id;}
				
    function setIdSupplier( $IdSupplier ) 	{$this->IdSupplier = $IdSupplier; $this->markDirty(); }
    function getIdSupplier( ) 				{return $this->IdSupplier;}
	function getSupplier( ) {		
		$mSupplier = new \MVC\Mapper\Supplier();
		$Supplier = $mSupplier->find($this->IdSupplier);		
        return $Supplier;
    }
    
	function setValue( $Value ) {
        $this->Value = $Value;
        $this->markDirty();
    }	
	function getValue( ) {
		if (!isset($this->Value))
			return 0;
        return $this->Value;
    }
	function getValuePrint( ) {        
		$num = number_format($this->Value, 0, ',', '.');
		return $num." đ";
    }
	
	function setDate( $Date ) 	{$this->Date = $Date; $this->markDirty(); }
	function getDate( ) 		{return $this->Date;}
	function getDatePrint( ) 	{$date = new \DateTime($this->Date); return $date->format('d/m/Y'); }
			   
	function setNote( $Note ) 	{$this->Note = $Note;$this->markDirty();}
	function getNote( ) 		{return $this->Note;}	
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdSupplier'	=> $this->getIdSupplier(),
			'Date'			=> $this->getDate(),
			'Value'			=> $this->getValue(),			
			'Note'			=> $this->getNote()
		);
		return json_encode($json);				
	}
			
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->IdSupplier 	= $Data[1];
		$this->Date 		= $Data[2];
		$this->Value 		= $Data[3];
		$this->Note 		= $Data[4];
    }
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
		
	/*--------------------------------------------------------------------*/	
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
		
}
?>