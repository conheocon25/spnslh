<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class UserWarehouse extends Object{

    private $Id;
	private $IdUser;
	private $IdWarehouse;
    private $IdRole;
					
	/*Hàm khởi tạo và thiết lập các thuộc tính*/
    function __construct( 
		$Id=null, 
		$IdUser=null,
		$IdWarehouse=null, 
		$IdRole=null		
	) {
        $this->Id 		= $Id;
		$this->IdUser 	= $IdUser;
		$this->IdWarehouse = $IdWarehouse;
		$this->IdRole 	= $IdRole;
				
        parent::__construct( $Id );
    }
    function getId( ) {return $this->Id;}
	
	function setIdUser( $IdUser ) {$this->IdUser= $IdUser;$this->markDirty();}
	function getIdUser(){return $this->IdUser;}
	function getUser(){
		$mUser 	= new \MVC\Mapper\User();
		$User 	= $mUser->find($this->IdUser);
		return $User;
	}
		
	function setIdWarehouse( $IdWarehouse ) {$this->IdWarehouse = $IdWarehouse;$this->markDirty();}
	function getIdWarehouse(){return $this->IdWarehouse;}
	function getWarehouse(){
		$mWarehouse 	= new \MVC\Mapper\Warehouse();
		$Warehouse 		= $mWarehouse->find($this->IdWarehouse);
		return $Warehouse;
	}
	
    function setIdRole( $IdRole ) {$this->IdRole = $IdRole;$this->markDirty();}
    function getIdRole( ) {return $this->IdRole;}
	function getRole(){
		$mRole 	= new \MVC\Mapper\Role();
		$Role 	= $mRole->find($this->IdRole);
		return $Role;
	}
			
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdUser'		=> $this->getIdUser(),
			'IdWarehouse'	=> $this->getIdWarehouse(),
			'IdRole'		=> $this->getIdRole()			
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->IdUser 		= $Data[1];
		$this->IdWarehouse 	= $Data[2];
		$this->IdRole 		= $Data[3];		
    }
	
	function getURLWarehouse(){return "/kho-hang/".$this->getWarehouse()->getKey();}
					
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
}
?>