<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class OrderImport extends Object{

    private $Id;
	private $IdSupplier;
	private $Date;
    private $Description;
			
	/*Hàm khởi tạo và thiết lập các thuộc tính*/
    function __construct( $Id=null, $IdSupplier=null, $Date=null, $Description=null) {
        $this->Id = $Id;
		$this->IdSupplier = $IdSupplier;
		$this->Date = $Date;
		$this->Description = $Description;
        parent::__construct( $Id );
    }
    function getId( ) {return $this->Id;}
    
	function setIdSupplier( $IdSupplier ) {$this->IdSupplier = $IdSupplier;$this->markDirty();}
    function getIdSupplier( ) {return $this->IdSupplier;}
	function getSupplier( ) {	
		$mSupplier = new \MVC\Mapper\Supplier();
		$Supplier = $mSupplier->find($this->IdSupplier);		
        return $Supplier;
    }
	
	function getDate( ) {return $this->Date;}
    function setDate( $Date ) {$this->Date = $Date;$this->markDirty();}
	function getDatePrint( ) {$Date = new \MVC\Library\Date($this->Date); return $Date->getDateFormat();}
			
	function getDescription( ) {return $this->Description;}
	function setDescription( $Description ) {$this->Description = $Description;$this->markDirty();}
	
	function getDetailAll(){		
		$mOID = new \MVC\Mapper\OrderImportDetail();
		$Tracks = $mOID->trackBy(array(
			$this->getId(),
			$this->getIdSupplier(),
			$this->getId()
		));
		
		return $Tracks;
	}
	
	function getValue(){
		$DetailAll = $this->getDetailAll();
		$Count = 0;
		while ($DetailAll->valid()){
			$Count += $DetailAll->current()->getValue();
			$DetailAll->next();
		}
		return $Count;
	}
	
	function getValuePrint(){
		$Value = new \MVC\Library\Number($this->getValue());
		return $Value->formatCurrency()." đ";
	}
	
	function getValueStrPrint(){
		$Value = new \MVC\Library\Number($this->getValue());
		return $Value->readDigit()." đồng";
	}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdSupplier' 	=> $this->getIdSupplier(),
			'Date'			=> $this->getDate(),
			'Description'	=> $this->getDescription()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];	
		$this->IdSupplier 	= $Data[1];	
		$this->Date 		= $Data[2];
		$this->Description 	= $Data[3];
    }
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLPrint(){return "/import/".$this->getIdSupplier()."/".$this->getId()."/print";}	
	function getURLDetail(){return "/import/".$this->getIdSupplier()."/".$this->getId();}
	
	//---------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	
}
?>