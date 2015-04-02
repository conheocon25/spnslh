<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class WarehouseInit extends Mapper implements \MVC\Domain\WarehouseInitFinder {

    function __construct() {
        parent::__construct();
				
        $this->selectAllStmt 	= self::$PDO->prepare("select * from warehouse_init");
        $this->selectStmt 		= self::$PDO->prepare("select * from warehouse_init where id=?");
        $this->updateStmt 		= self::$PDO->prepare("update warehouse_init set id_warehouse=?, id_good=?, value=?  where id=?");
        $this->insertStmt 		= self::$PDO->prepare("insert into warehouse_init (id_warehouse, id_good, value) values(?, ?, ?)");
		$this->deleteStmt 		= self::$PDO->prepare("delete from warehouse_init where id=?");				 
		$this->checkStmt 		= self::$PDO->prepare("select * from warehouse_init where id_warehouse=? AND id_good=?");
		$this->findByStmt 		= self::$PDO->prepare("select * from warehouse_init where id_warehouse=?");
    }
    function getCollection( array $raw ) {return new WarehouseInitCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\WarehouseInit( 
			$array['id'],  
			$array['id_warehouse'],
			$array['id_good'],
			$array['value']
		);
        return $obj;
    }
	
    protected function targetClass() {return "WarehouseInit";}

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdWarehouse(),
			$object->getIdGood(),
			$object->getValue()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdWarehouse(),
			$object->getIdGood(),
			$object->getValue(),
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }
			
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function check( $Param ){
        $this->checkStmt->execute( array( $Param ) );
        $array = $this->checkStmt->fetch( ); 
        $this->checkStmt->closeCursor( );
        if ( ! is_array( $array ) ) { return null; }
        if ( ! isset( $array['id'] ) ) { return null; }
        $object = $this->createObject( $array );
        $object->markClean();
        return $object; 
    }
	
	function findBy($values) {		
        $this->findByStmt->execute( $values );
        return new WarehouseInitCollection( $this->findByStmt->fetchAll(), $this );
    }
}
?>