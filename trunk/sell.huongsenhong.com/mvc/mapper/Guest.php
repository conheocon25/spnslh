<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class Guest extends Mapper implements \MVC\Domain\GuestFinder{

    function __construct() {
        parent::__construct();
				
		$tblGuest = "tbl_guest";
		
		$selectAllStmt = sprintf("select * from %s ", $tblGuest);
		$selectStmt = sprintf("select *  from %s where id=?", $tblGuest);
		$updateStmt = sprintf("update %s set name=?, picture=?, `order`=?, type=? where id=?", $tblGuest);
		$insertStmt = sprintf("insert into %s ( ip, agent, entry_time, exit_time) values(?, ?, ?, ?)", $tblGuest);
		$deleteStmt = sprintf("delete from %s where exit_time<?", $tblGuest);
		$findByIPStmt = sprintf("select *  from %s where ip=?", $tblGuest);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByIPStmt = self::$PDO->prepare($findByIPStmt);
		
    } 
    function getCollection( array $raw ) {
        return new GuestCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\Guest( 
			$array['id'],
			$array['ip'],
			$array['agent'],
			$array['entry_time'],
			$array['exit_time']
		);
        return $obj;
    }

    protected function targetClass() {        
		return "Guest";
    }

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIP(),
			$object->getAgent(),
			$object->getEntryTime(),
			$object->getExitTime()
		);
		
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIP(),
			$object->getAgent(),
			$object->getEntryTime(),
			$object->getExitTime(),
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }

	protected function doDelete(array $values) {
        return $this->deleteStmt->execute( $values );
    }

    function selectStmt() {
        return $this->selectStmt;
    }
    function selectAllStmt() {
        return $this->selectAllStmt;
    }
	
	function findByIP( $values ){
        $this->findByIPStmt->execute( $values );
        return new GuestCollection( $this->findByIPStmt->fetchAll(), $this);
    }
	
}
?>