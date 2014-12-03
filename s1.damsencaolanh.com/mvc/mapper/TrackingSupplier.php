<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class TrackingSupplier extends Mapper implements \MVC\Domain\TrackingSupplierFinder{

    function __construct() {
        parent::__construct();
				
		$tblTrackingSupplier 		= "tbl_tracking_supplier";
		
		$selectAllStmt 				= sprintf("select * from %s ORDER BY date_start", $tblTrackingSupplier);
		$selectStmt 				= sprintf("select *  from %s where id=?", $tblTrackingSupplier);
		$updateStmt 				= sprintf("update %s set id_tracking=?, id_supplier=?, value_import=?, value_paid=? where id=?", $tblTrackingSupplier);
		$insertStmt 				= sprintf("insert into %s (id_tracking, id_supplier, value_import, value_paid) values(?, ?, ?, ?)", $tblTrackingSupplier);
		$deleteStmt 				= sprintf("delete from %s where id=?", $tblTrackingSupplier);
		$deleteByTrackingStmt 		= sprintf("delete from %s where id_tracking=? AND id_supplier=?", $tblTrackingSupplier);
		$findByStmt 				= sprintf("select id, 0 as id_tracking, id_td, id_course, sum(count) as count, avg(price) as price, sum(value) as value from %s where id_td=? GROUP BY id_course ORDER BY count DESC", $tblTrackingSupplier);
		$findBy1Stmt 				= sprintf("select * from %s where id_tracking=? AND id_supplier=? ", $tblTrackingSupplier);
				
		$findByPreStmt 				= sprintf("select *  from %s where id_tracking<? AND id_supplier=? ORDER BY id_tracking DESC", $tblTrackingSupplier);
				
        $this->selectAllStmt 		= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 			= self::$PDO->prepare($selectStmt);
        $this->updateStmt 			= self::$PDO->prepare($updateStmt);
        $this->insertStmt 			= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 			= self::$PDO->prepare($deleteStmt);
		$this->deleteByTrackingStmt = self::$PDO->prepare($deleteByTrackingStmt);
		$this->findByStmt 			= self::$PDO->prepare($findByStmt);
		$this->findBy1Stmt 			= self::$PDO->prepare($findBy1Stmt);		
		$this->findByPreStmt 		= self::$PDO->prepare($findByPreStmt);

    }
    function getCollection( array $raw ) {return new TrackingSupplierCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\TrackingSupplier( 
			$array['id'],
			$array['id_tracking'],			
			$array['id_supplier'],
			$array['value_import'],
			$array['value_paid']
		);
	    return $obj;
    }
    protected function targetClass(){return "TrackingSupplier";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdTracking(),			
			$object->getIdSupplier(),
			$object->getValueImport(),
			$object->getValuePaid()
		);
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdTracking(),
			$object->getIdSupplier(),
			$object->getValueImport(),
			$object->getValuePaid(),
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }
	
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}
    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}	
	function deleteByTracking(array $values) {return $this->deleteByTrackingStmt->execute( $values );}
	
	function findBy(array $values) {
		$this->findByStmt->execute( $values );
        return new TrackingSupplierCollection( $this->findByStmt->fetchAll(), $this );
    }
	
	function findBy1(array $values){
		$this->findBy1Stmt->execute( $values );
        return new TrackingSupplierCollection( $this->findBy1Stmt->fetchAll(), $this );
    }
			
	function findByPre(array $values) {
		$this->findByPreStmt->execute( $values );
        return new TrackingSupplierCollection( $this->findByPreStmt->fetchAll(), $this );
    }		
}
?>