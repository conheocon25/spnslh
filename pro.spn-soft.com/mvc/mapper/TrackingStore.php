<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class TrackingStore extends Mapper implements \MVC\Domain\TrackingStoreFinder{

    function __construct() {
        parent::__construct();
				
		$tblTrackingStore = "tbl_tracking_store";
		
		$selectAllStmt 				= sprintf("select * from %s ORDER BY date_start", $tblTrackingStore);
		$selectStmt 				= sprintf("select *  from %s where id=?", $tblTrackingStore);
		$updateStmt 				= sprintf("update %s set date_start=?, date_end=? where id=?", $tblTrackingStore);
		$insertStmt 				= sprintf("insert into %s (id_tracking, id_td, id_resource, count_old, count_import, count_export, price) values(?, ?, ?, ?, ?, ?, ?)", $tblTrackingStore);
		$deleteStmt 				= sprintf("delete from %s where id=?", $tblTrackingStore);
		$deleteByTrackingStmt 		= sprintf("delete from %s where id_tracking=? AND id_td=?", $tblTrackingStore);
		$findByStmt 				= sprintf("select *  from %s where id_tracking=?", $tblTrackingStore);
		$findByDailyStmt			= sprintf("select *  from %s where id_tracking=? AND id_td=?", $tblTrackingStore);
		$findByPreStmt 				= sprintf("select *  from %s where id_td<? AND id_resource=? ORDER BY id_td DESC", $tblTrackingStore);
		$findByCourseStmt 			= sprintf("select *  from %s where id_tracking=? AND id_resource=?", $tblTrackingStore);
		
        $this->selectAllStmt 		= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 			= self::$PDO->prepare($selectStmt);
        $this->updateStmt 			= self::$PDO->prepare($updateStmt);
        $this->insertStmt 			= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 			= self::$PDO->prepare($deleteStmt);
		$this->deleteByTrackingStmt = self::$PDO->prepare($deleteByTrackingStmt);
		$this->findByStmt 			= self::$PDO->prepare($findByStmt);
		$this->findByDailyStmt 		= self::$PDO->prepare($findByDailyStmt);
		$this->findByPreStmt 		= self::$PDO->prepare($findByPreStmt);
		$this->findByCourseStmt 	= self::$PDO->prepare($findByCourseStmt);
    }
    function getCollection( array $raw ) {return new TrackingStoreCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\TrackingStore( 
			$array['id'],
			$array['id_tracking'],
			$array['id_td'],
			$array['id_resource'],
			$array['count_old'],
			$array['count_import'],
			$array['count_export'],
			$array['price']
		);
	    return $obj;
    }
    protected function targetClass(){return "TrackingStore";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdTracking(),
			$object->getIdTD(),
			$object->getIdResource(),
			$object->getCountOld()?$object->getCountOld():0,
			$object->getCountImport()?$object->getCountImport():0,
			$object->getCountExport()?$object->getCountExport():0,
			$object->getPrice()?$object->getPrice():0
		);
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdTracking(),
			$object->getIdTD(),
			$object->getIdResource(),
			$object->getCountOld(),
			$object->getCountImport(),
			$object->getCountExport(),
			$object->getPrice(),
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
        return new TrackingStoreCollection( $this->findByStmt->fetchAll(), $this );
    }
	
	function findByDaily(array $values) {
		$this->findByDailyStmt->execute( $values );
        return new TrackingStoreCollection( $this->findByDailyStmt->fetchAll(), $this );
    }
	
	function findByPre(array $values) {
		$this->findByPreStmt->execute( $values );
        return new TrackingStoreCollection( $this->findByPreStmt->fetchAll(), $this );
    }
	
	function findByCourse(array $values) {
		$this->findByCourseStmt->execute( $values );
        return new TrackingStoreCollection( $this->findByCourseStmt->fetchAll(), $this );
    }	
}
?>