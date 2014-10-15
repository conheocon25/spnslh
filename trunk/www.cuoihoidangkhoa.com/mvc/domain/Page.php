<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Page extends Object{
    private $Id;
	private $Name;
	private $URL;
    	
	/*Hàm khởi tạo và thiết lập các thuộc tính*/
    function __construct( $Id=null, $Name=null, $URL=null) {
        $this->Id = $Id;
		$this->Name= $Name;
		$this->URL = $URL;
		
        parent::__construct( $Id );
    }
    function getId( ) {
        return $this->Id;
    }	
	
    function setName( $Name) {
        $this->Name = $Name;
        $this->markDirty();
    }
    function getName( ) {
        return $this->Name;
    }
	
	function setURL(){
		$this->URL = $URL;
        $this->markDirty();
	}
	   
	function getURL(){
		return $this->URL;        
	}
			
    static function findAll() {
        $finder = self::getFinder( __CLASS__ ); 
        return $finder->findAll();
    }
    static function find( $Id ) {
        $finder = self::getFinder( __CLASS__ ); 
        return $finder->find( $Id );
    }	
}
?>
