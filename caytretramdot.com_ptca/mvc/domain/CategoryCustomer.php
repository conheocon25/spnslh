<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class CategoryCustomer extends Object{

    private $Id;
	private $Name;    
	private $Note;
			
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $Name=null, $Note=null){
        $this->Id 			= $Id;
		$this->Name 		= $Name;		
		$this->Note 		= $Note;
		
        parent::__construct( $Id );
    }
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->Name 		= $Data[1];		
		$this->Note 		= $Data[2];
    }
	
    function getId( ) {return $this->Id;}
			
	function setName( $Name ) {$this->Name = $Name;$this->markDirty();}
	function getName(){return $this->Name;}
		
	function setNote( $Note ) {$this->Note = $Note;$this->markDirty();}
	function getNote( ) {return $this->Note;}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'Name'			=> $this->getName(),			
			'Note'			=> $this->getNote()
		);
		return json_encode($json);
	}
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	function getCustomerAll(){
		$mCustomer = new \MVC\Mapper\Customer();
		$CustomerAll = $mCustomer->findByCategory(array($this->getId()));
		return $CustomerAll;
	}
				
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $id );}
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------			
	function getURLSettingCustomer(){return "/admin/setting/customer/".$this->getId();}
}
?>