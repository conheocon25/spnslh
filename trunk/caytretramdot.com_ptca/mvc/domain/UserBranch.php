<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class UserBranch extends Object{

    private $Id;
	private $IdUser;
	private $IdBranch;
    private $IdRole;
					
	/*Hàm khởi tạo và thiết lập các thuộc tính*/
    function __construct( 
		$Id=null, 
		$IdUser=null,
		$IdBranch=null, 
		$IdRole=null		
	) {
        $this->Id 		= $Id;
		$this->IdUser 	= $IdUser;
		$this->IdBranch = $IdBranch;
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
		
	function setIdBranch( $IdBranch ) {$this->IdBranch = $IdBranch;$this->markDirty();}
	function getIdBranch(){return $this->IdBranch;}
	function getBranch(){
		$mBranch 	= new \MVC\Mapper\Branch();
		$Branch 	= $mBranch->find($this->IdBranch);
		return $Branch;
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
			'IdBranch'		=> $this->getIdBranch(),
			'IdRole'		=> $this->getIdRole()			
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->IdUser 		= $Data[1];
		$this->IdBranch 	= $Data[2];
		$this->IdRole 		= $Data[3];		
    }
	function getURLBranch(){return "/don-vi/".$this->getBranch()->getKey();}
					
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
}
?>