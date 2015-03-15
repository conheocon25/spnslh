<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Tracking extends Mapper implements \MVC\Domain\TrackingFinder{

    function __construct() {
        parent::__construct();
				
		$tblTracking = "tbl_tracking";
		
		$selectAllStmt = sprintf("select * from %s ORDER BY date_start", $tblTracking);
		$selectStmt = sprintf("select *  from %s where id=?", $tblTracking);
		$updateStmt = sprintf("update %s set 
			date_start=?,
			date_end=?,
			collect1=?,
			collect2=?,
			collect3=?,
			paid1=?,
			paid2=?,
			paid3=?,
			value=?
		where id=?", $tblTracking);
		
		$insertStmt = sprintf("insert into %s (
			date_start,
			date_end,
			collect1,
			collect2,
			collect3,
			paid1,
			paid2,
			paid3,
			value
		) values(?, ?, ?, ?, ?, ?, ?, ?, ?)", $tblTracking);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblTracking);
		$findPreStmt 	= sprintf("select * from %s where date_start<? ORDER BY date_start DESC", $tblTracking);
		$existStmt 		= sprintf("select * from %s where date_start>=? AND date_end<=?", $tblTracking);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->existStmt  = self::$PDO->prepare($existStmt);
		$this->findPreStmt = self::$PDO->prepare($findPreStmt);
    } 
    function getCollection( array $raw ) {
        return new TrackingCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\Tracking( 
			$array['id'],
			$array['date_start'],
			$array['date_end'],
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

    protected function targetClass() {return "Tracking";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getDateStart(), 
			$object->getDateEnd(),
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
			$object->getDateStart(), 
			$object->getDateEnd(),
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
	
	function findPre($values) {
        $this->findPreStmt->execute( $values );
        return new TrackingCollection( $this->findPreStmt->fetchAll(), $this );
    }
		
	function exist( $values ){
        $this->existStmt->execute( $values );
		$result = $this->existStmt->fetchAll();		
		if (!isset($result) || $result==null)
			return null;
        return $result[0][0];
    }
}
?>