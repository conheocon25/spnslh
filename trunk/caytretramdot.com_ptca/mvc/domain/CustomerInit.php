<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class CustomerInit extends Object{

    private $Id;
	private $IdCustomer;
	private $Debt;
			
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $IdCustomer=null, $Debt=null){
        $this->Id 			= $Id;	
		$this->IdCustomer 	= $IdCustomer;
		$this->Debt 		= $Debt;
				
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
	
	function setDebt( $Debt ) {$this->Debt = $Debt;$this->markDirty();}
	function getDebt(){return $this->Debt;}	
	function getDebtPrint( ){
		$num = number_format($this->getDebt(), 0, ',', ' ');
		return $num;
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];		
		$this->IdCustomer 	= $Data[1];
		$this->Debt 		= $Data[2];
    }
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),			
			'IdCustomer'	=> $this->getIdCustomer(),
			'Debt'			=> $this->getDebt()
		);
		return json_encode($json);
	}
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	function getURLExe(){
		return "/ql-thiet-lap/khach-hang/".$this->getIdBranch()."/".$this->getId()."/exe";			
	}
	
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $id );}
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	
}
?>