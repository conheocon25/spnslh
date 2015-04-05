<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class BranchWarehouse extends Mapper implements \MVC\Domain\BranchWarehouseFinder {
    function __construct() {
        parent::__construct();
		
        $this->selectAllStmt 		= self::$PDO->prepare("select * from branch_warehouse");
        $this->updateStmt 			= self::$PDO->prepare("update branch_warehouse set id_branch=?, id_warehouse=? where id=?");
        $this->selectStmt 			= self::$PDO->prepare("select * from branch_warehouse where id=?");
        $this->insertStmt 			= self::$PDO->prepare("insert into branch_warehouse (id_branch, id_warehouse) values(?, ?)");
		$this->deleteStmt 			= self::$PDO->prepare("delete from branch_warehouse where id=?");
		$this->checkStmt 			= self::$PDO->prepare("select * from branch_warehouse where id_branch=? AND id_warehouse=?");
		$this->findByBranchStmt 	= self::$PDO->prepare("SELECT * FROM branch_warehouse WHERE id_branch=?");
		
	}
    function getCollection( array $raw ) {return new BranchWarehouseCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\BranchWarehouse( 
			$array['id'],
			$array['id_branch'],
			$array['id_warehouse']			
		);
        return $obj;
    }
	
    protected function targetClass() {return "BranchWarehouse";}

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdBranch(),
			$object->getIdWarehouse()			
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdBranch(),
			$object->getIdWarehouse(),			
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }
					
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function check( $values ){
		$this->checkStmt->execute( $values );
        $array = $this->checkStmt->fetch();
        $this->checkStmt->closeCursor();
        if ( ! is_array( $array ) ) { return null; }
        if ( ! isset( $array['id'] ) ) { return null; }
        $object = $this->doCreateObject( $array );
        return $object;		
    }
	
	function findByBranch($values){
        $this->findByBranchStmt->execute( $values );
        return new BranchWarehouseCollection( $this->findByBranchStmt->fetchAll(), $this );
    }	
}
?>