<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class TrackingCourse extends Mapper implements \MVC\Domain\TrackingCourseFinder{

    function __construct() {
        parent::__construct();
				
		$tblTrackingCourse = "tbl_tracking_course";
		
		$selectAllStmt 				= sprintf("select * from %s ORDER BY date_start", $tblTrackingCourse);
		$selectStmt 				= sprintf("select *  from %s where id=?", $tblTrackingCourse);
		$updateStmt 				= sprintf("update %s set date_start=?, date_end=? where id=?", $tblTrackingCourse);
		$insertStmt 				= sprintf("insert into %s (id_tracking, id_td, id_course, count, price, value) values(?, ?, ?, ?, ?, ?)", $tblTrackingCourse);
		$deleteStmt 				= sprintf("delete from %s where id=?", $tblTrackingCourse);
		$deleteByTrackingStmt 		= sprintf("delete from %s where id_tracking=? AND id_td=?", $tblTrackingCourse);
		$findByStmt 				= sprintf("select id, 0 as id_tracking, id_td, id_course, sum(count) as count, avg(price) as price, sum(value) as value from %s where id_td=? GROUP BY id_course ORDER BY count DESC", $tblTrackingCourse);
		$findBy1Stmt 				= sprintf("select id, id_tracking, 0 as id_td, id_course, sum(count) as count, avg(price) as price, sum(value) as value from %s where id_tracking=? GROUP BY id_course ORDER BY count DESC", $tblTrackingCourse);
		
		$findByDailyStmt			= sprintf("select *  from %s where id_tracking=? AND id_td=? ORDER BY count DESC", $tblTrackingCourse);
		$findByPreStmt 				= sprintf("select *  from %s where id_tracking<? AND id_course=? ORDER BY id_tracking DESC", $tblTrackingCourse);
		$findByCourseStmt 			= sprintf("select *  from %s where id_tracking=? AND id_course=?", $tblTrackingCourse);
		
        $this->selectAllStmt 		= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 			= self::$PDO->prepare($selectStmt);
        $this->updateStmt 			= self::$PDO->prepare($updateStmt);
        $this->insertStmt 			= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 			= self::$PDO->prepare($deleteStmt);
		$this->deleteByTrackingStmt = self::$PDO->prepare($deleteByTrackingStmt);
		$this->findByStmt 			= self::$PDO->prepare($findByStmt);
		$this->findBy1Stmt 			= self::$PDO->prepare($findBy1Stmt);
		$this->findByDailyStmt 		= self::$PDO->prepare($findByDailyStmt);
		$this->findByPreStmt 		= self::$PDO->prepare($findByPreStmt);
		$this->findByCourseStmt 	= self::$PDO->prepare($findByCourseStmt);
    }
    function getCollection( array $raw ) {return new TrackingCourseCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\TrackingCourse( 
			$array['id'],
			$array['id_tracking'],
			$array['id_td'],
			$array['id_course'],
			$array['count'],			
			$array['price'],
			$array['value']
		);
	    return $obj;
    }
    protected function targetClass(){return "TrackingCourse";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdTracking(),
			$object->getIdTD(),
			$object->getIdCourse(),
			$object->getCount(),			
			$object->getPrice(),
			$object->getValue()
		);
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdTracking(),
			$object->getIdTD(),
			$object->getIdCourse(),
			$object->getCount(),			
			$object->getPrice(),
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
        return new TrackingCourseCollection( $this->findByStmt->fetchAll(), $this );
    }
	
	function findBy1(array $values) {
		$this->findBy1Stmt->execute( $values );
        return new TrackingCourseCollection( $this->findBy1Stmt->fetchAll(), $this );
    }
	
	function findByDaily(array $values) {
		$this->findByDailyStmt->execute( $values );
        return new TrackingCourseCollection( $this->findByDailyStmt->fetchAll(), $this );
    }
	
	function findByPre(array $values) {
		$this->findByPreStmt->execute( $values );
        return new TrackingCourseCollection( $this->findByPreStmt->fetchAll(), $this );
    }
	
	function findByCourse(array $values) {
		$this->findByCourseStmt->execute( $values );
        return new TrackingCourseCollection( $this->findByCourseStmt->fetchAll(), $this );
    }	
}
?>