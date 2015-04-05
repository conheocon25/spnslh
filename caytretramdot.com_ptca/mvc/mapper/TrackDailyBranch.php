<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class TrackDailyBranch extends Mapper implements \MVC\Domain\TrackDailyBranchFinder{

    function __construct() {
        parent::__construct();
				
		$tblTrackDailyBranch 	= "track_daily_branch";
		
		$selectAllStmt 			= sprintf("select * from %s", $tblTrackDailyBranch);
		$selectStmt 			= sprintf("select *  from %s where id=?", $tblTrackDailyBranch);
		$updateStmt 			= sprintf("update %s set id_track=?, id_branch=?, date=?, debt_old=?, sale=?, collect=? where id=?", $tblTrackDailyBranch);
		$insertStmt 			= sprintf("insert into %s (id_track, id_branch, date, debt_old, sale, collect) values(?, ?, ?, ?, ?, ?)", $tblTrackDailyBranch);
		$deleteStmt 			= sprintf("delete from %s where id=?", $tblTrackDailyBranch);
		$deleteByTrackStmt 		= sprintf("delete from %s where id_track=?", $tblTrackDailyBranch);
		
		$findByDateStmt 		= sprintf("select *  from %s where date=?", $tblTrackDailyBranch);
		$findByBranchStmt 		= sprintf("select *  from %s where id_branch=?", $tblTrackDailyBranch);
		$findByTrackBranchStmt 	= sprintf("select *  from %s where id_track=? AND id_branch=?", $tblTrackDailyBranch);
				
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);
		
		$this->deleteByTrackStmt= self::$PDO->prepare($deleteByTrackStmt);
		$this->findByDateStmt 		= self::$PDO->prepare($findByDateStmt);
		$this->findByBranchStmt 	= self::$PDO->prepare($findByBranchStmt);
		$this->findByTrackBranchStmt = self::$PDO->prepare($findByTrackBranchStmt);
    }
	
    function getCollection( array $raw ) {return new TrackDailyBranchCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\TrackDailyBranch(
			$array['id'],
			$array['id_track'],
			$array['id_branch'],
			$array['date'],
			$array['debt_old'],
			$array['sale'],
			$array['collect']
		);
	    return $obj;
    }
    protected function targetClass() { return "TrackDailyBranch";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdTrack(),
			$object->getIdBranch(),
			$object->getDate(),
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
			$object->getIdTrack(),
			$object->getIdBranch(),
			$object->getDate(),
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
	
	function findByDate(array $values) {
		$this->findByDateStmt->execute( $values );
        return new TrackDailyBranchCollection( $this->findByDateStmt->fetchAll(), $this );
    }
	
	function findByBranch(array $values) {
		$this->findByBranchStmt->execute( $values );
        return new TrackDailyBranchCollection( $this->findByBranchStmt->fetchAll(), $this );
    }
	
	function findByTrackBranch(array $values) {
		$this->findByTrackBranchStmt->execute( $values );
        return new TrackDailyBranchCollection( $this->findByTrackBranchStmt->fetchAll(), $this );
    }
}
?>