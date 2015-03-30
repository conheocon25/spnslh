<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class UserWarehouse extends Mapper implements \MVC\Domain\UserWarehouseFinder {

    function __construct() {
        parent::__construct();
		$tblUserWarehouse = "user_warehouse";
		
		$selectAllStmt = sprintf("select * from %s", $tblUserWarehouse);
		$selectStmt = sprintf("select * from %s where id=?", $tblUserWarehouse);
		$updateStmt = sprintf("update %s set id_user=?, id_warehouse=?, id_role=? where id=?", $tblUserWarehouse);
		$insertStmt = sprintf("insert into %s (					
					id_user, 
					id_warehouse,
					id_role
				)
				values(?, ?, ?)", $tblUserWarehouse);
		$deleteStmt = sprintf("delete from %s where id=?", $tblUserWarehouse);
		$findByWarehouseStmt= sprintf("select * from %s where id_warehouse=?", $tblUserWarehouse);
		$findByUserStmt 	= sprintf("select * from %s where id_user=?", $tblUserWarehouse);
						
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);		
		$this->findByWarehouseStmt = self::$PDO->prepare($findByWarehouseStmt);		
		$this->findByUserStmt 	= self::$PDO->prepare($findByUserStmt);
    } 
    function getCollection( array $raw ) {
        return new UserWarehouseCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\UserWarehouse( 
			$array['id'],  
			$array['id_user'],
			$array['id_warehouse'],
			$array['id_role']			
		);
        return $obj;
    }
	
    protected function targetClass() { return "UserWarehouse";}

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdUser(),
			$object->getIdWarehouse(),			
			$object->getIdRole()			
		);
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdUser(),
			$object->getIdWarehouse(),			
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
	
	function findByWarehouse( array $values ) {
		$this->findByWarehouseStmt->execute($values);
        return new UserWarehouseCollection( $this->findByWarehouseStmt->fetchAll(), $this );
    }
	
	function findByUser( array $values ) {
		$this->findByUserStmt->execute($values);
        return new UserWarehouseCollection( $this->findByUserStmt->fetchAll(), $this );
    }
}
?>