<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class TrackingSupplier extends Mapper implements \MVC\Domain\TrackingSupplierFinder{

    function __construct() {
        parent::__construct();				
		$tblTrackingSupplier 		= "tbl_tracking_supplier";
		
		$selectAllStmt 				= sprintf("select * from %s", $tblTrackingSupplier);
		$selectStmt 				= sprintf("select *  from %s where id=?", $tblTrackingSupplier);
		$updateStmt 				= sprintf("update %s set id_tracking=?, id_supplier=?, value_import=?, value_paid=?, value_old=?, value=?, value_global=?, count=?, count_global=? where id=?", $tblTrackingSupplier);
		$insertStmt 				= sprintf("insert into %s (id_tracking, id_supplier, value_import, value_paid, value_old, value, value_global, count, count_global) values(?, ?, ?, ?, ?, ?, ?, ?, ?)", $tblTrackingSupplier);
		$deleteStmt 				= sprintf("delete from %s where id=?", $tblTrackingSupplier);
		$deleteByTrackingStmt 		= sprintf("delete from %s where id_tracking=?", $tblTrackingSupplier);
		
		$findByStmt 				= sprintf("select * from %s where id_tracking=? AND id_supplier=? ", $tblTrackingSupplier);
		$findByTrackingStmt 		= sprintf("select * from %s where id_tracking=?", $tblTrackingSupplier);
				
		$findByPreStmt 				= sprintf("select *  from %s where id_tracking<? AND id_supplier=? ORDER BY id_tracking DESC", $tblTrackingSupplier);
		$findByNextStmt 			= sprintf("select *  from %s where id_tracking>? AND id_supplier=? ORDER BY id_tracking", $tblTrackingSupplier);
		
        $this->selectAllStmt 		= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 			= self::$PDO->prepare($selectStmt);
        $this->updateStmt 			= self::$PDO->prepare($updateStmt);
        $this->insertStmt 			= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 			= self::$PDO->prepare($deleteStmt);
		$this->deleteByTrackingStmt = self::$PDO->prepare($deleteByTrackingStmt);		
		$this->findByStmt 			= self::$PDO->prepare($findByStmt);
		$this->findByTrackingStmt 	= self::$PDO->prepare($findByTrackingStmt);
		$this->findByPreStmt 		= self::$PDO->prepare($findByPreStmt);
		$this->findByNextStmt 		= self::$PDO->prepare($findByNextStmt);

    }
    function getCollection( array $raw ) {return new TrackingSupplierCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\TrackingSupplier( 
			$array['id'],
			$array['id_tracking'],			
			$array['id_supplier'],
			$array['value_import'],
			$array['value_paid'],			
			$array['value_old'],
			$array['value'],
			$array['value_global'],
			$array['count'],
			$array['count_global']
		);
	    return $obj;
    }
    protected function targetClass(){return "TrackingSupplier";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdTracking(),			
			$object->getIdSupplier(),
			$object->getValueImport(),						
			$object->getValuePaid(),
			$object->getValueOld(),
			$object->getValue(),
			$object->getValueGlobal(),
			$object->getCount(),
			$object->getCountGlobal()
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
			$object->getValueOld(),
			$object->getValue(),
			$object->getValueGlobal(),
			$object->getCount(),
			$object->getCountGlobal(),
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
		
	function findByTracking(array $values){
		$this->findByTrackingStmt->execute( $values );
        return new TrackingSupplierCollection( $this->findByTrackingStmt->fetchAll(), $this );
    }
	
	function findByPre(array $values) {
		$this->findByPreStmt->execute( $values );
        return new TrackingSupplierCollection( $this->findByPreStmt->fetchAll(), $this );
    }
	
	function findByNext(array $values) {
		$this->findByNextStmt->execute( $values );
        return new TrackingSupplierCollection( $this->findByNextStmt->fetchAll(), $this );
    }	
}
?>