<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class TrackDaily extends Mapper implements \MVC\Domain\TrackDailyFinder{

    function __construct() {
        parent::__construct();
				
		$tblTrackDaily 			= "track_daily";
		
		$selectAllStmt 			= sprintf("select * from %s ORDER BY date", $tblTrackDaily);
		$selectStmt 			= sprintf("select *  from %s where id=?", $tblTrackDaily);
		$updateStmt 			= sprintf("update %s set id_track=?, `date`=? where id=?", $tblTrackDaily);
		$insertStmt 			= sprintf("insert into %s (id_track, `date`) values(?, ?)", $tblTrackDaily);
		$deleteStmt 			= sprintf("delete from %s where id=?", $tblTrackDaily);
		$deleteByTrackStmt 		= sprintf("delete from %s where id_track=?", $tblTrackDaily);
		$findByStmt 			= sprintf("select *  from %s where id_track=?", $tblTrackDaily);
		$findByPreStmt 			= sprintf("select *  from %s where id_track=? AND `date`<? ORDER BY `date` DESC", $tblTrackDaily);
		$findByDateStmt 		= sprintf("select *  from %s where `date`=?", $tblTrackDaily);
		
        $this->selectAllStmt 		= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 			= self::$PDO->prepare($selectStmt);
        $this->updateStmt 			= self::$PDO->prepare($updateStmt);
        $this->insertStmt 			= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 			= self::$PDO->prepare($deleteStmt);
		$this->deleteByTrackStmt 	= self::$PDO->prepare($deleteByTrackStmt);
		$this->findByStmt 			= self::$PDO->prepare($findByStmt);
		$this->findByPreStmt 		= self::$PDO->prepare($findByPreStmt);
		$this->findByDateStmt 		= self::$PDO->prepare($findByDateStmt);
    }
	
    function getCollection( array $raw ) {return new TrackDailyCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\TrackDaily(
			$array['id'],
			$array['id_track'],
			$array['date']
		);
	    return $obj;
    }
    protected function targetClass() { return "TrackDaily";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdTrack(),
			$object->getDate()			
		);
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdTrack(),
			$object->getDate(),			
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
        return new TrackDailyCollection( $this->findByStmt->fetchAll(), $this );
    }
	function findByPre(array $values) {
		$this->findByPreStmt->execute( $values );
        return new TrackDailyCollection( $this->findByPreStmt->fetchAll(), $this );
    }
	
	function findByDate(array $values) {
		$this->findByDateStmt->execute( $values );
        return new TrackDailyCollection( $this->findByDateStmt->fetchAll(), $this );
    }
}
?>