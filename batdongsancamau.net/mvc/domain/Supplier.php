<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Supplier extends Object{

    private $Id;
	private $Name;
	private $Phone;
    private $Address;
	private $Note;
	private $Picture;
					
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id=null, 
		$Name=null, 
		$Phone=null, 
		$Address=null, 
		$Note=null,
		$Picture=null
	){
        $this->Id 		= $Id;
		$this->Name 	= $Name;
		$this->Phone 	= $Phone;
		$this->Address 	= $Address;
		$this->Note 	= $Note;
		$this->Picture 	= $Picture;
		
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
	
	function setPicture( $Picture ) {$this->Picture = $Picture; $this->markDirty();}
	function getPicture( ){return $this->Picture;}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),			
			'Name'			=> $this->getName(),
			'Phone'			=> $this->getPhone(),
			'Address'		=> $this->getAddress(),
			'Note'			=> $this->getNote(),
			'Picture'		=> $this->getPicture()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 		= $Data[0];
		$this->Name 	= $Data[1];
		$this->Phone 	= $Data[2];
		$this->Address 	= $Data[3];
		$this->Note 	= $Data[4];
		$this->Picture 	= $Data[5];
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
	function getProductAllByCategory($IdCategory){
		$mProduct 	= new \MVC\Mapper\Product();
		$ProductAll = $mProduct->findBySupplierCategory(array($this->getId(), $IdCategory));
		return $ProductAll;
	}
			
	//-------------------------------------------------------------------------------
	//DEFINE URL SETTING.SUPPLIER
	//-------------------------------------------------------------------------------	
	function getURLView()		{return "/nha-moi-gioi/".$this->getId();}
	function getURLSettingProduct(){return "/admin/setting/supplier/".$this->getId();}
		
	function getURLSettingCategory($IdCategory){
		return "/admin/setting/supplier/".$this->getId()."/".$IdCategory."/category";
	}
	
							
	//---------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $id );}
	
}
?>