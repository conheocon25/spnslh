<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class TrackingDaily extends Mapper implements \MVC\Domain\TrackingDailyFinder{

    function __construct() {
        parent::__construct();
				
		$tblTrackingDaily = "tbl_tracking_daily";
		
		$selectAllStmt 				= sprintf("select * from %s ORDER BY date", $tblTrackingDaily);
		$selectStmt 				= sprintf("select *  from %s where id=?", $tblTrackingDaily);
		$updateStmt 				= sprintf("update %s set id_tracking=?, `date`=?, collect1=?, collect2=?, collect3=?, paid1=?,  paid2=?, paid3=?, value=? where id=?", $tblTrackingDaily);
		$insertStmt 				= sprintf("insert into %s (id_tracking, `date`, collect1, collect2, collect3, paid1, paid2, paid3, value) values(?, ?, ?, ?, ?, ?, ?, ?, ?)", $tblTrackingDaily);
		$deleteStmt 				= sprintf("delete from %s where id=?", $tblTrackingDaily);
		$deleteByTrackingStmt 		= sprintf("delete from %s where id_tracking=?", $tblTrackingDaily);
		$findByStmt 				= sprintf("select *  from %s where id_tracking=?", $tblTrackingDaily);
		$findByPreStmt 				= sprintf("select *  from %s where id_tracking=? AND `date`<? ORDER BY `date` DESC", $tblTrackingDaily);
		$findByDateStmt 			= sprintf("select *  from %s where `date`=?", $tblTrackingDaily);
		
        $this->selectAllStmt 		= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 			= self::$PDO->prepare($selectStmt);
        $this->updateStmt 			= self::$PDO->prepare($updateStmt);
        $this->insertStmt 			= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 			= self::$PDO->prepare($deleteStmt);
		$this->deleteByTrackingStmt = self::$PDO->prepare($deleteByTrackingStmt);
		$this->findByStmt 			= self::$PDO->prepare($findByStmt);
		$this->findByPreStmt 		= self::$PDO->prepare($findByPreStmt);
		$this->findByDateStmt 		= self::$PDO->prepare($findByDateStmt);
    }
	
    function getCollection( array $raw ) {return new TrackingDailyCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\TrackingDaily(
			$array['id'],
			$array['id_tracking'],
			$array['date'],
			$array['collect1'],
			$array['collect2'],
			$array['collect3'],
			$array['paid1'],
			$array['paid2'],
			$array['paid3'],
			$array['value']	
		);
	    return $obj;
    }
    protected function targetClass() { return "TrackingDaily";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdTracking(),
			$object->getDate(),
			$object->getCollect1(),
			$object->getCollect2(),
			$object->getCollect3(),
			$object->getPaid1(),
			$object->getPaid2(),
			$object->getPaid3(),
			$object->getValue()
		);
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdTracking(),
			$object->getDate(),
			$object->getCollect1(),
			$object->getCollect2(),
			$object->getCollect3(),
			$object->getPaid1(),
			$object->getPaid2(),
			$object->getPaid3(),
			$object->getValue(),
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
        return new TrackingDailyCollection( $this->findByStmt->fetchAll(), $this );
    }
	function findByPre(array $values) {
		$this->findByPreStmt->execute( $values );
        return new TrackingDailyCollection( $this->findByPreStmt->fetchAll(), $this );
    }
	
	function findByDate(array $values) {
		$this->findByDateStmt->execute( $values );
        return new TrackingDailyCollection( $this->findByDateStmt->fetchAll(), $this );
    }
}
?>