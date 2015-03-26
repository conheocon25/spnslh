<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class TrackWarehouse extends Mapper implements \MVC\Domain\TrackWarehouseFinder{

    function __construct() {
        parent::__construct();
				
		$tblTrackWarehouse = "track_warehouse";
		
		$selectAllStmt 		= sprintf("select * from %s ORDER BY date_start", $tblTrackWarehouse);
		$selectStmt 		= sprintf("select *  from %s where id=?", $tblTrackWarehouse);
		$updateStmt 		= sprintf("update %s set date_start=?,date_end=? where id=?", $tblTrackWarehouse);
		$insertStmt 		= sprintf("insert into %s (date_start,date_end) values(?, ?)", $tblTrackWarehouse);
		$deleteStmt 		= sprintf("delete from %s where id=?", $tblTrackWarehouse);
		$findByNearestStmt 	= sprintf("select * from %s where date_start<? ORDER BY date_start DESC LIMIT 1 ", $tblTrackWarehouse);
		$existStmt 			= sprintf("select * from %s where date_start>=? AND date_end<=?", $tblTrackWarehouse);
		$findByPageStmt 	= sprintf("SELECT * FROM  %s LIMIT :start,:max", $tblTrackWarehouse);
				
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);
		$this->existStmt  		= self::$PDO->prepare($existStmt);
		$this->findByNearestStmt = self::$PDO->prepare($findByNearestStmt);
		$this->findByPageStmt 	= self::$PDO->prepare($findByPageStmt);		
		
    } 
    function getCollection( array $raw ) {return new TrackWarehouseCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\TrackWarehouse( 
			$array['id'],
			$array['id_track'],
			$array['id_warehouse'],
			$array['id_good'],
			$array['count'],
			$array['price']
		);
        return $obj;
    }

    protected function targetClass() {return "TrackWarehouse";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getDateStart(), 
			$object->getDateEnd()			
		);
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getDateStart(), 
			$object->getDateEnd(),			
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}
    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findByNearest($values) {
        $this->findByNearestStmt->execute( $values );
        return new TrackWarehouseCollection( $this->findByNearestStmt->fetchAll(), $this );
    }
		
	function exist( $values ){
        $this->existStmt->execute( $values );
		$result = $this->existStmt->fetchAll();		
		if (!isset($result) || $result==null)
			return null;
        return $result[0][0];
    }
	
	function findByPage( $values ) {
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new SupplierCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>