<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Supplier extends Object{

    private $Id;
	private $Name;
	private $Phone;
    private $Address;
	private $Note;
	private $Debt;
					
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id=null, 
		$Name=null, 
		$Phone=null, 
		$Address=null, 
		$Note=null,
		$Debt=null
	){
        $this->Id 		= $Id;
		$this->Name 	= $Name;
		$this->Phone 	= $Phone;
		$this->Address 	= $Address;
		$this->Note 	= $Note;
		$this->Debt 	= $Debt;
		
        parent::__construct( $Id );
    }
    function getId( ) {return $this->Id;}
		
    function setName( $Name ) {$this->Name = $Name; $this->markDirty();}
    function getName( ) {return $this->Name;}
	
	function getPhone( ) {return $this->Phone;}
    function setPhone( $Phone ) {$this->Phone = $Phone; $this->markDirty();}
	
	function setAddress( $Address ) {$this->Address = $Address; $this->markDirty();}
    function getAddress( ) {return $this->Address;}
	
	function setNote( $Note ) {$this->Note = $Note; $this->markDirty();}
	function getNote( ) {return $this->Note;}
	
	function setDebt( $Debt ) {$this->Debt = $Debt; $this->markDirty();}
	function getDebt( ){return $this->Debt;}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),			
			'Name'			=> $this->getName(),
			'Phone'			=> $this->getPhone(),
			'Address'		=> $this->getAddress(),
			'Note'			=> $this->getNote(),
			'Debt'			=> $this->getDebt()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 		= $Data[0];
		$this->Name 	= $Data[1];
		$this->Phone 	= $Data[2];
		$this->Address 	= $Data[3];
		$this->Note 	= $Data[4];
		$this->Debt 	= $Data[5];
    }
		
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
		
	//Lấy về danh sách các tài nguyên nhà cung cấp có
	function getProductAll() {
		$mProduct 	= new \MVC\Mapper\Product();
		$ProductAll = $mProduct->findBySupplier(array($this->getId()));
		return $ProductAll;
	}
	
	function getProductManufacturer($IdManufacturer) {
		$mProduct 	= new \MVC\Mapper\Product();
		$ProductAll = $mProduct->findBySupplierManufacturer(array($this->getId(), $IdManufacturer));
		return $ProductAll;
	}
			
	//Lấy về danh sách các nhà sản xuất
	function getManufacturerAll() {
		$mProduct 	= new \MVC\Mapper\Product();
		$ProductAll = $mProduct->findManufacturer(array($this->getId()));
		return $ProductAll;
	}
	
	function getProductAllByCategory($IdCategory){
		$mProduct 	= new \MVC\Mapper\Product();
		$ProductAll = $mProduct->findBySupplierCategory(array($this->getId(), $IdCategory));
		return $ProductAll;
	}
	
	//-------------------------------------------------------------------------------
	//DEFINE IMPORT.SUPPLIER
	//-------------------------------------------------------------------------------
	function getURLImport(){return "/admin/import/".$this->getId();}	
	function getURLImportInsLoad(){return "/admin/import/".$this->getId()."/ins/load";}	
	function getURLImportInsExe(){return "/admin/import/".$this->getId()."/ins/exe";}
	
	//-------------------------------------------------------------------------------
	//DEFINE URL SETTING.SUPPLIER
	//-------------------------------------------------------------------------------	
	function getURLProduct(){return "/admin/setting/supplier/".$this->getId();}
	function getURLSettingManufacturer($IdManufacturer){
		return "/admin/setting/supplier/".$this->getId()."/".$IdManufacturer."/manufacturer";
	}
	
	function getURLSettingCategory($IdCategory){
		return "/admin/setting/supplier/".$this->getId()."/".$IdCategory."/category";
	}
	
							
	//---------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $id );}
	
}
?>