<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class TrackDailyBranchCustomer extends Mapper implements \MVC\Domain\TrackDailyBranchCustomerFinder{

    function __construct() {
        parent::__construct();
				
		$tblTrackDailyBranchCustomer = "track_daily_branch_customer";
		
		$selectAllStmt 				= sprintf("select * from %s", $tblTrackDailyBranchCustomer);
		$selectStmt 				= sprintf("select *  from %s where id=?", $tblTrackDailyBranchCustomer);
		$updateStmt 				= sprintf("update %s set id_tdb=?, id_customer=?, debt_old=?, sale=?, collect=? where id=?", $tblTrackDailyBranchCustomer);
		$insertStmt 				= sprintf("insert into %s (id_tdb, id_customer, debt_old, sale, collect) values(?, ?, ?, ?, ?)", $tblTrackDailyBranchCustomer);
		$deleteStmt 				= sprintf("delete from %s where id=?", $tblTrackDailyBranchCustomer);
		$deleteByTrackStmt 			= sprintf("delete from %s where id_tdb=?", $tblTrackDailyBranchCustomer);
		$findByStmt 				= sprintf("select *  from %s where id_tdb=?", $tblTrackDailyBranchCustomer);
				
        $this->selectAllStmt 		= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 			= self::$PDO->prepare($selectStmt);
        $this->updateStmt 			= self::$PDO->prepare($updateStmt);
        $this->insertStmt 			= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 			= self::$PDO->prepare($deleteStmt);
		$this->deleteByTrackStmt 	= self::$PDO->prepare($deleteByTrackStmt);
		$this->findByStmt 			= self::$PDO->prepare($findByStmt);		
    }
	
    function getCollection( array $raw ) {return new TrackDailyBranchCustomerCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\TrackDailyBranchCustomer(
			$array['id'],
			$array['id_tdb'],			
			$array['id_customer'],
			$array['debt_old'],
			$array['sale'],
			$array['collect']
		);
	    return $obj;
    }
    protected function targetClass() { return "TrackDailyBranchCustomer";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdTDB(),			
			$object->getIdCustomer(),
			$object->getDebtOld(),
			$object->getSale(),
			$object->getCollect()
		);
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdTDB(),			
			$object->getIdCustomer(),
			$object->getDebtOld(),
			$object->getSale(),
			$object->getCollect(),
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }
	
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}
    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}	
	function deleteByTrack(array $values) {return $this->deleteByTrackStmt->execute( $values );}
	
	function findBy(array $values) {
		$this->findByStmt->execute( $values );
        return new TrackDailyBranchCustomerCollection( $this->findByStmt->fetchAll(), $this );
    }
}
?>