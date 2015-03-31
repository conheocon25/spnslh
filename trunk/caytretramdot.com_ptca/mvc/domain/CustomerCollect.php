<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class CustomerCollect extends Object{

    private $Id;
	private $IdCustomer;
	private $DateTime;
	private $Value;
	private $Note;
			
    function __construct( 
		$Id				=null,
		$IdCustomer		=null,
		$DateTime		=null,
		$Value			=null,
		$Note			=null		
	) {
        $this->Id 			= $Id;
		$this->IdCustomer 	= $IdCustomer;
		$this->DateTime		= $DateTime;
		$this->Value 		= $Value;
		$this->Note 		= $Note;
		
        parent::__construct( $Id );
    }
	function setId( $Id){return $this->Id = $Id;}
    function getId( ) 	{return $this->Id;}
	
	function setIdCustomer( $IdCustomer) {return $this->IdCustomer= $IdCustomer;}
    function getIdCustomer( ) {return $this->IdCustomer;}
	function getCustomer(){
		$mCustomer = new \MVC\Mapper\Customer();
		$Customer = $mCustomer->find($this->IdCustomer);
		return $Customer;
	}
	
	function setDateTime( $DateTime) 	{return $this->DateTime = $DateTime;}
    function getDateTime( ) 			{return $this->DateTime;}
	function getDateTimePrint(){
		$t = strtotime($this->DateTime);		
		return date('d/m/y H:i',$t);
	}
	
	function getValue(){return $this->Value;}	
    function setValue( $Value ) {$this->Value = $Value;$this->markDirty();}
	function getValuePrint( ){
		$num = number_format($this->getValue(), 0, ',', ' ');
		return $num;
	}
	
	function setNote( $Note ) {$this->Note = $Note; $this->markDirty();}
	function getNote(){return $this->Note;}
					
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdCustomer' 	=> $this->getIdCustomer(),
			'DateTime' 		=> $this->getDateTime(),
			'Value'			=> $this->getValue(),
			'Note'			=> $this->getNote()			
		);
		return json_enNote($json);
	}
	
	function setArray( $Data ){				
		$this->Id 			= $Data[0];
		$this->IdCustomer 	= $Data[1];
		$this->DateTime		= $Data[2];
		$this->Value 		= $Data[3];
		$this->Note 		= $Data[4];		
    }
							
	//=================================================================================	
	
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}	
	
}
?>