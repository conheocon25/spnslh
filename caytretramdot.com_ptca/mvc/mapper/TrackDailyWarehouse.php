<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class TrackDailyWarehouse extends Mapper implements \MVC\Domain\TrackDailyWarehouseFinder{
    function __construct() {
        parent::__construct();				
		$tblTrackDailyWarehouse = "track_daily_warehouse";
		
		$selectAllStmt 			= sprintf("select * from %s", $tblTrackDailyWarehouse);
		$selectStmt 			= sprintf("select *  from %s where id=?", $tblTrackDailyWarehouse);
		$updateStmt 			= sprintf("update %s set id_track=?, id_warehouse=?, date=?, old=?, import=?, export=? where id=?", $tblTrackDailyWarehouse);
		$insertStmt 			= sprintf("insert into %s (id_track, id_warehouse, date, old, import, export) values(?, ?, ?, ?, ?, ?)", $tblTrackDailyWarehouse);
		$deleteStmt 			= sprintf("delete from %s where id=?", $tblTrackDailyWarehouse);
		$deleteByTrackStmt 		= sprintf("delete from %s where id_track=?", $tblTrackDailyWarehouse);
		$findByWarehouseStmt 		= sprintf("select *  from %s where id_warehouse=?", $tblTrackDailyWarehouse);
		$findByTrackWarehouseStmt 	= sprintf("select *  from %s where id_track=? AND id_warehouse=?", $tblTrackDailyWarehouse);
				
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);
		$this->deleteByTrackStmt= self::$PDO->prepare($deleteByTrackStmt);
		$this->findByWarehouseStmt = self::$PDO->prepare($findByWarehouseStmt);
		$this->findByTrackWarehouseStmt = self::$PDO->prepare($findByTrackWarehouseStmt);
    }
	
    function getCollection( array $raw ) {return new TrackDailyWarehouseCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\TrackDailyWarehouse(
			$array['id'],
			$array['id_track'],
			$array['id_warehouse'],
			$array['date'],
			$array['old'],
			$array['import'],
			$array['export']
		);
	    return $obj;
    }
    protected function targetClass() { return "TrackDailyWarehouse";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdTrack(),
			$object->getIdWarehouse(),
			$object->getDate(),
			$object->getOld(),
			$object->getImport(),
			$object->getExport()
		);
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdTrack(),
			$object->getIdWarehouse(),
			$object->getDate(),
			$object->getOld(),
			$object->getImport(),
			$object->getExport(),
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }
	
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}
    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}	
	function deleteByTrack(array $values) {return $this->deleteByTrackStmt->execute( $values );}
	
	function findByWarehouse(array $values) {
		$this->findByWarehouseStmt->execute( $values );
        return new TrackDailyWarehouseCollection( $this->findByWarehouseStmt->fetchAll(), $this );
    }
	
	function findByTrackWarehouse(array $values) {
		$this->findByTrackWarehouseStmt->execute( $values );
        return new TrackDailyWarehouseCollection( $this->findByTrackWarehouseStmt->fetchAll(), $this );
    }
}
?>