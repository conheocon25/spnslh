<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class SupplierInit extends Mapper implements \MVC\Domain\SupplierInitFinder {

    function __construct() {
        parent::__construct();
				
        $this->selectAllStmt 	= self::$PDO->prepare("select * from supplier_init");
        $this->selectStmt 		= self::$PDO->prepare("select * from supplier_init where id=?");
        $this->updateStmt 		= self::$PDO->prepare("update supplier_init set id_supplier=?, debt=?  where id=?");
        $this->insertStmt 		= self::$PDO->prepare("insert into supplier_init (id_supplier, debt) values(?, ?)");
		$this->deleteStmt 		= self::$PDO->prepare("delete from supplier_init where id=?");				 
		$this->checkStmt 		= self::$PDO->prepare("select * from supplier_init where id_supplier=?");
    }
    function getCollection( array $raw ) {return new SupplierInitCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\SupplierInit( 
			$array['id'],  
			$array['id_supplier'],
			$array['debt']
		);
        return $obj;
    }
	
    protected function targetClass() {return "SupplierInit";}

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdSupplier(),
			$object->getDebt()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdSupplier(),
			$object->getDebt(),
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
}
?>