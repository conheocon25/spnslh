<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class SupplierInit extends Object{

    private $Id;
	private $IdSupplier;
	private $Debt;
			
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $IdSupplier=null, $Debt=null){
        $this->Id 			= $Id;	
		$this->IdSupplier 	= $IdSupplier;
		$this->Debt 		= $Debt;
				
        parent::__construct( $Id );
    }
	function setId( $Id) {$this->Id = $Id;}
    function getId( ) {return $this->Id;}
			
	function setIdSupplier( $IdSupplier ) {$this->IdSupplier = $IdSupplier;$this->markDirty();}
	function getIdSupplier(){return $this->IdSupplier;}
	function getSupplier(){
		$mSupplier = new \MVC\Mapper\Supplier();
		$Supplier = $mSupplier->find($this->IdSupplier);
		return $Supplier;
	}
	
	function setDebt( $Debt ) {$this->Debt = $Debt;$this->markDirty();}
	function getDebt(){return $this->Debt;}	
	function getDebtPrint( ){
		$num = number_format($this->getDebt(), 0, ',', ' ');
		return $num;
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];		
		$this->IdSupplier 	= $Data[1];
		$this->Debt 		= $Data[2];
    }
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),			
			'IdSupplier'	=> $this->getIdSupplier(),
			'Debt'			=> $this->getDebt()
		);
		return json_encode($json);
	}
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	function getURLExe(){
		return "/ql-thiet-lap/nha-cung-cap/".$this->getSupplier()->getIdGroup()."/".$this->getId()."/exe";
	}
	
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $id );}
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	
}
?>