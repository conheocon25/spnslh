<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class TrackDailyWarehouseGood extends Mapper implements \MVC\Domain\TrackDailyWarehouseGoodFinder{
    function __construct() {
        parent::__construct();				
		$tblTrackDailyWarehouseGood = "track_daily_warehouse_good";
		
		$selectAllStmt 			= sprintf("select * from %s", $tblTrackDailyWarehouseGood);
		$selectStmt 			= sprintf("select *  from %s where id=?", $tblTrackDailyWarehouseGood);
		$updateStmt 			= sprintf("update %s set id_tdw=?, id_good=?, old=?, import=?, export=? where id=?", $tblTrackDailyWarehouseGood);
		$insertStmt 			= sprintf("insert into %s (id_tdw, id_good, old, import, export) values(?, ?, ?, ?, ?)", $tblTrackDailyWarehouseGood);
		$deleteStmt 			= sprintf("delete from %s where id=?", $tblTrackDailyWarehouseGood);
		$findByStmt 			= sprintf("select *  from %s where id_tdw=?", $tblTrackDailyWarehouseGood);
		$findPreStmt 			= sprintf("select *  from %s where id<? AND id_good=? ORDER BY id DESC LIMIT 1", $tblTrackDailyWarehouseGood);
				
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);
		$this->findByStmt 		= self::$PDO->prepare($findByStmt);
		$this->findPreStmt 		= self::$PDO->prepare($findPreStmt);
    }
	
    function getCollection( array $raw ) {return new TrackDailyWarehouseGoodCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\TrackDailyWarehouseGood(
			$array['id'],
			$array['id_tdw'],
			$array['id_good'],
			$array['old'],
			$array['import'],
			$array['export']
		);
	    return $obj;
    }
    protected function targetClass() { return "TrackDailyWarehouseGood";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdTDW(),
			$object->getIdGood(),
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
			$object->getIdTDW(),
			$object->getIdGood(),
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
	
	function findPre( $Param ){
        $this->findPreStmt->execute( $Param );
        $array = $this->findPreStmt->fetch( ); 
        $this->findPreStmt->closeCursor( );
        if ( ! is_array( $array ) ) { return null; }
        if ( ! isset( $array['id'] ) ) { return null; }
        $object = $this->createObject( $array );
        $object->markClean();
        return $object; 
    }

	function findBy(array $values) {
		$this->findByStmt->execute( $values );
        return new TrackDailyWarehouseGoodCollection( $this->findByStmt->fetchAll(), $this );
    }
	
}
?>