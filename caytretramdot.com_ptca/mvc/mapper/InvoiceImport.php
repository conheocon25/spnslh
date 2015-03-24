<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class InvoiceImport extends Mapper implements \MVC\Domain\InvoiceImportFinder {

    function __construct() {
        parent::__construct();
		$tblInvoiceImport 		= "invoice_import";
		
        $this->selectAllStmt 	= self::$PDO->prepare("select * from invoice_import");
        $this->selectStmt 		= self::$PDO->prepare("select * from invoice_import where id=?");
        $this->updateStmt 		= self::$PDO->prepare("update invoice_import set id_employee=?, id_supplier=?, datetime_created=?, datetime_updated=?, note=?, state=? where id=?");
        $this->insertStmt 		= self::$PDO->prepare("insert into invoice_import (id_employee, id_supplier, datetime_created, datetime_updated, note, state) values(?, ?, ?, ?, ?, ?)");
		$this->deleteStmt 		= self::$PDO->prepare("delete from invoice_import where id=?");
		$this->findBySupplierStmt		= self::$PDO->prepare("select * from invoice_import where id_supplier=? ORDER BY datetime_created DESC");
		$this->findByEmployeeStmt		= self::$PDO->prepare("select * from invoice_import where id_employee=? ORDER BY datetime_created DESC");
		
		$this->findByTrackDailyStmt		= self::$PDO->prepare("select * from invoice_import where date(datetime_created)=? ORDER BY datetime_created DESC");
						
		$findByPageStmt 		= sprintf("SELECT * FROM  %s LIMIT :start,:max", $tblInvoiceImport);
		$this->findByPageStmt 	= self::$PDO->prepare($findByPageStmt);
		 
    } 
    function getCollection( array $raw ) {return new InvoiceImportCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\InvoiceImport( 
			$array['id'],  
			$array['id_employee'],
			$array['id_supplier'],
			$array['datetime_created'],
			$array['datetime_updated'],
			$array['note'],
			$array['state']
		);
        return $obj;
    }
	
    protected function targetClass() {return "InvoiceImport";}

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdEmployee(),
			$object->getIdSupplier(),
			$object->getDateTimeCreated(),
			$object->getDateTimeUpdated(),
			$object->getNote(),
			$object->getState()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdEmployee(),
			$object->getIdSupplier(),
			$object->getDateTimeCreated(),
			$object->getDateTimeUpdated(),
			$object->getNote(),
			$object->getState(),
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }
			
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
					
	function findByPage( $values ) {
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new InvoiceImportCollection( $this->findByPageStmt->fetchAll(), $this );
    }
	
	function findBySupplier($values) {		
        $this->findBySupplierStmt->execute( $values );
        return new InvoiceImportCollection( $this->findBySupplierStmt->fetchAll(), $this );
    }
		
	function findByEmployee($values) {
        $this->findByEmployeeStmt->execute( $values );
        return new InvoiceImportCollection( $this->findByEmployeeStmt->fetchAll(), $this );
    }
	
	function findByTrackDaily($values) {
        $this->findByTrackDailyStmt->execute( $values );
        return new InvoiceImportCollection( $this->findByTrackDailyStmt->fetchAll(), $this );
    }
	
}
?>