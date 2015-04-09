<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class TrackingSupplierDaily extends Mapper implements \MVC\Domain\TrackingSupplierDailyFinder{

    function __construct() {
        parent::__construct();
				
		$tblTrackingSupplierDaily = "tbl_tracking_supplier_daily";
		
		$selectAllStmt 				= sprintf("select * from %s ORDER BY date", $tblTrackingSupplierDaily);
		$selectStmt 				= sprintf("select *  from %s where id=?", $tblTrackingSupplierDaily);
		$updateStmt 				= sprintf("update %s set id_supplier=?, `date`=?, ticket_import=?, ticket_import_back=?, value_import=?, value_import_back=? where id=?", $tblTrackingSupplierDaily);
		$insertStmt 				= sprintf("insert into %s (id_supplier, `date`, ticket_import, ticket_import_back, value_import, value_import_back) values(?, ?, ?, ?, ?, ?)", $tblTrackingSupplierDaily);
		$deleteStmt 				= sprintf("delete from %s where id=?", $tblTrackingSupplierDaily);
		$deleteByDateStmt 			= sprintf("delete from %s where `date`=?", $tblTrackingSupplierDaily);
		$findByStmt 				= sprintf("select *  from %s where id_td=?", $tblTrackingSupplierDaily);
				
        $this->selectAllStmt 		= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 			= self::$PDO->prepare($selectStmt);
        $this->updateStmt 			= self::$PDO->prepare($updateStmt);
        $this->insertStmt 			= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 			= self::$PDO->prepare($deleteStmt);
		$this->deleteByDateStmt 	= self::$PDO->prepare($deleteByDateStmt);
		$this->findByStmt 			= self::$PDO->prepare($findByStmt);
    }
	
    function getCollection( array $raw ) {return new TrackingSupplierDailyCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\TrackingSupplierDaily(
			$array['id'],
			$array['id_td'],
			$array['id_supplier'],			
			$array['value_import'],
			$array['value_paid'],
			$array['value_old']			
		);
	    return $obj;
    }
    protected function targetClass() { return "TrackingSupplierDaily";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 			
			$object->getIdTD(),
			$object->getIdSupplier(),
			$object->getValueImport(),
			$object->getValuePaid(),
			$object->getValueOld()
		);
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdTD(),
			$object->getIdSupplier(),
			$object->getValueImport(),
			$object->getValuePaid(),
			$object->getValueOld(),
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }
	
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}
    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}	
	function deleteByDate(array $values) {return $this->deleteByDateStmt->execute( $values );}
	
	function findBy(array $values) {
		$this->findByStmt->execute( $values );
        return new TrackingSupplierDailyCollection( $this->findByStmt->fetchAll(), $this );
    }
	
}
?>