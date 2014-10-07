<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class TrackingCustomer extends Mapper implements \MVC\Domain\TrackingCustomerFinder{

    function __construct() {
        parent::__construct();
				
		$tblTrackingCustomer = "tbl_tracking_customer";
		
		$selectAllStmt 				= sprintf("select * from %s ORDER BY date_start", $tblTrackingCustomer);
		$selectStmt 				= sprintf("select *  from %s where id=?", $tblTrackingCustomer);
		$updateStmt 				= sprintf("update %s set id_tracking=?, id_customer=?, value_session1=?, value_session2=?, value_collect=? where id=?", $tblTrackingCustomer);
		$insertStmt 				= sprintf("insert into %s (id_tracking, id_customer, value_session1, value_session2, value_collect) values(?, ?, ?, ?, ?)", $tblTrackingCustomer);
		$deleteStmt 				= sprintf("delete from %s where id=?", $tblTrackingCustomer);
		$deleteByTrackingStmt 		= sprintf("delete from %s where id_tracking=? AND id_customer=?", $tblTrackingCustomer);
		$findByStmt 				= sprintf("select id, 0 as id_tracking, id_td, id_course, sum(count) as count, avg(price) as price, sum(value) as value from %s where id_td=? GROUP BY id_course ORDER BY count DESC", $tblTrackingCustomer);
		$findBy1Stmt 				= sprintf("select * from %s where id_tracking=? AND id_customer=? ", $tblTrackingCustomer);
				
		$findByPreStmt 				= sprintf("select *  from %s where id_tracking<? AND id_customer=? ORDER BY id_tracking DESC", $tblTrackingCustomer);
		$findByCourseStmt 			= sprintf("select *  from %s where id_tracking=? AND id_course=?", $tblTrackingCustomer);
		
        $this->selectAllStmt 		= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 			= self::$PDO->prepare($selectStmt);
        $this->updateStmt 			= self::$PDO->prepare($updateStmt);
        $this->insertStmt 			= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 			= self::$PDO->prepare($deleteStmt);
		$this->deleteByTrackingStmt = self::$PDO->prepare($deleteByTrackingStmt);
		$this->findByStmt 			= self::$PDO->prepare($findByStmt);
		$this->findBy1Stmt 			= self::$PDO->prepare($findBy1Stmt);		
		$this->findByPreStmt 		= self::$PDO->prepare($findByPreStmt);
		$this->findByCourseStmt 	= self::$PDO->prepare($findByCourseStmt);
    }
    function getCollection( array $raw ) {return new TrackingCustomerCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\TrackingCustomer( 
			$array['id'],
			$array['id_tracking'],			
			$array['id_customer'],
			$array['value_session1'],
			$array['value_session2'],
			$array['value_collect']
		);
	    return $obj;
    }
    protected function targetClass(){return "TrackingCustomer";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdTracking(),			
			$object->getIdCustomer(),
			$object->getValueSession1(),			
			$object->getValueSession2(),
			$object->getValueCollect()
		);
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdTracking(),
			$object->getIdCustomer(),
			$object->getValueSession1(),
			$object->getValueSession2(),
			$object->getValueCollect(),
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
        return new TrackingCustomerCollection( $this->findByStmt->fetchAll(), $this );
    }
	
	function findBy1(array $values){
		$this->findBy1Stmt->execute( $values );
        return new TrackingCustomerCollection( $this->findBy1Stmt->fetchAll(), $this );
    }
			
	function findByPre(array $values) {
		$this->findByPreStmt->execute( $values );
        return new TrackingCustomerCollection( $this->findByPreStmt->fetchAll(), $this );
    }		
}
?>