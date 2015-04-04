<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class CustomerPrice extends Object{

    private $Id;
	private $IdCustomer;
	private $DateTime;
	private $Note;
		
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $IdCustomer=null, $DateTime=null, $Note=null){
        $this->Id 			= $Id;	
		$this->IdCustomer 	= $IdCustomer;
		$this->DateTime 	= $DateTime;
		$this->Note 		= $Note;
				
        parent::__construct( $Id );
    }
	function setId( $Id) {$this->Id = $Id;}
    function getId( ) {return $this->Id;}
			
	function setIdCustomer( $IdCustomer ) {$this->IdCustomer = $IdCustomer;$this->markDirty();}
	function getIdCustomer(){return $this->IdCustomer;}
	function getCustomer(){
		$mCustomer = new \MVC\Mapper\Customer();
		$Customer = $mCustomer->find($this->IdCustomer);
		return $Customer;
	}
	
	function setDateTime( $DateTime ) {$this->DateTime = $DateTime;$this->markDirty();}
	function getDateTime(){return $this->DateTime;}	
	function getDateTimePrint(){
		$t = strtotime($this->DateTime);		
		return date('d/m/y H:i',$t);
	}
	
	function setNote( $Note ) 	{$this->Note = $Note;$this->markDirty();}
	function getNote()			{return $this->Note;}	
			
	function setArray( $Data ){
        $this->Id 			= $Data[0];		
		$this->IdCustomer 	= $Data[1];
		$this->DateTime 	= $Data[2];
		$this->Note 		= $Data[3];		
    }
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),			
			'IdCustomer'	=> $this->getIdCustomer(),
			'DateTime'		=> $this->getDateTime(),
			'Note'			=> $this->getNote()
		);
		return json_encode($json);
	}
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	function getDetailAll(){
		$mCPD 	= new \MVC\Mapper\CustomerPriceDetail();
		$CPDAll = $mCPD->findBy(array($this->getId()));
		return $CPDAll;
	}
		
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $id );}
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLDetail(){return "/ql-ban-hang/gia-ban/".$this->getCustomer()->getIdBranch()."/".$this->getIdCustomer()."/".$this->getId();}
	
}
?>