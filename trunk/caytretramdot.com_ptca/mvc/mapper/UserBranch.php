<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class UserBranch extends Mapper implements \MVC\Domain\UserBranchFinder {

    function __construct() {
        parent::__construct();
		$tblUserBranch = "user_branch";
		
		$selectAllStmt = sprintf("select * from %s", $tblUserBranch);
		$selectStmt = sprintf("select * from %s where id=?", $tblUserBranch);
		$updateStmt = sprintf("update %s set id_user=?, id_branch=?, id_role=? where id=?", $tblUserBranch);
		$insertStmt = sprintf("insert into %s (					
					id_user, 
					id_branch,
					id_role
				)
				values(?, ?, ?)", $tblUserBranch);
		$deleteStmt = sprintf("delete from %s where id=?", $tblUserBranch);
		$findByBranchStmt 	= sprintf("select * from %s where id_branch=?", $tblUserBranch);
		$findByUserStmt 	= sprintf("select * from %s where id_user=?", $tblUserBranch);
						
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);		
		$this->findByBranchStmt = self::$PDO->prepare($findByBranchStmt);		
		$this->findByUserStmt 	= self::$PDO->prepare($findByUserStmt);
    } 
    function getCollection( array $raw ) {
        return new UserBranchCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\UserBranch( 
			$array['id'],  
			$array['id_user'],
			$array['id_branch'],
			$array['id_role']			
		);
        return $obj;
    }
	
    protected function targetClass() { return "UserBranch";}

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdUser(),
			$object->getIdBranch(),			
			$object->getIdRole()			
		);
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdUser(),
			$object->getIdBranch(),			
			$object->getIdRole(),
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }
	
	protected function doDelete(array $values) {
        return $this->deleteStmt->execute( $values );
    }
	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}	
	
	function findByBranch( array $values ) {
		$this->findByBranchStmt->execute($values);
        return new UserBranchCollection( $this->findByBranchStmt->fetchAll(), $this );
    }
	
	function findByUser( array $values ) {
		$this->findByUserStmt->execute($values);
        return new UserBranchCollection( $this->findByUserStmt->fetchAll(), $this );
    }
}
?>