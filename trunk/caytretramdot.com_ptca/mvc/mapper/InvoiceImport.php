<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class InvoiceImport extends Mapper implements \MVC\Domain\InvoiceImportFinder {

    function __construct() {
        parent::__construct();
				
        $this->selectAllStmt 		= self::$PDO->prepare("select * from invoice_import");
        $this->selectStmt 			= self::$PDO->prepare("select * from invoice_import where id=?");
        $this->updateStmt 			= self::$PDO->prepare("update invoice_import set id_user=?, id_supplier=?, id_warehouse=?, datetime_created=?, datetime_updated=?, note=?, state=?, enable=? where id=?");
        $this->insertStmt 			= self::$PDO->prepare("insert into invoice_import (id_user, id_supplier, id_warehouse, datetime_created, datetime_updated, note, state, `enable`) values(?, ?, ?, ?, ?, ?, ?, ?)");
		$this->deleteStmt 			= self::$PDO->prepare("delete from invoice_import where id=?");
		$this->findBySupplierStmt			= self::$PDO->prepare("select * from invoice_import where id_supplier=? ORDER BY datetime_created DESC");
		$this->findByWarehouseSupplierStmt	= self::$PDO->prepare("select * from invoice_import where id_warehouse=? AND id_supplier=? ORDER BY datetime_created DESC");		
										 
    } 
    function getCollection( array $raw ) {return new InvoiceImportCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\InvoiceImport( 
			$array['id'],  
			$array['id_user'],
			$array['id_supplier'],
			$array['id_warehouse'],
			$array['datetime_created'],
			$array['datetime_updated'],
			$array['note'],
			$array['state'],
			$array['enable']
		);
        return $obj;
    }
	
    protected function targetClass() {return "InvoiceImport";}

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdUser(),
			$object->getIdSupplier(),
			$object->getIdWarehouse(),
			$object->getDateTimeCreated(),
			$object->getDateTimeUpdated(),
			$object->getNote(),
			$object->getState(),
			$object->getEnable()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdUser(),
			$object->getIdSupplier(),
			$object->getIdWarehouse(),
			$object->getDateTimeCreated(),
			$object->getDateTimeUpdated(),
			$object->getNote(),
			$object->getState(),
			$object->getEnable(),
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }
			
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
				
		
	function findBySupplier($values) {		
        $this->findBySupplierStmt->execute( $values );
        return new InvoiceImportCollection( $this->findBySupplierStmt->fetchAll(), $this );
    }
		
	function findByWarehouseSupplier($values) {
        $this->findByWarehouseSupplierStmt->execute( $values );
        return new InvoiceImportCollection( $this->findByWarehouseSupplierStmt->fetchAll(), $this );
    }
	
}
?>