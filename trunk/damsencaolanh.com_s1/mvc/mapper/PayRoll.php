<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class PayRoll extends Mapper implements \MVC\Domain\PayRollFinder{
    function __construct() {
        parent::__construct();
				
		$tblPayRoll = "tbl_pay_roll";
		
		$selectAllStmt = sprintf("select * from %s", $tblPayRoll);
		$selectStmt = sprintf("select * from %s where id=?", $tblPayRoll);
		$updateStmt = sprintf("update %s set id_employee=?, id_tracking=?, absent=?, base_value=?, extra_value=?, punish_value=?, note=? where id=?", $tblPayRoll);
		$insertStmt = sprintf("insert into %s (id_employee, id_tracking, absent, base_value, extra_value, punish_value, note) values(?,?,?,?,?,?,?)", $tblPayRoll);
		$deleteStmt = sprintf("delete from %s where id=?", $tblPayRoll);
		$findByStmt = sprintf("select * from %s where id_employee = ? order by date DESC", $tblPayRoll);				
		$findByTrackingStmt = sprintf("select * from %s where id_tracking = ?", $tblPayRoll);
		$deleteByTrackingStmt = sprintf("delete from %s where id_tracking = ?", $tblPayRoll);
				
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByStmt = self::$PDO->prepare($findByStmt);		
		$this->findByTrackingStmt 	= self::$PDO->prepare($findByTrackingStmt);
		$this->deleteByTrackingStmt = self::$PDO->prepare($deleteByTrackingStmt);
    } 
    function getCollection( array $raw ) {return new PayRollCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\PayRoll( 
			$array['id'],
			$array['id_employee'],
			$array['id_tracking'],
			$array['absent'],
			$array['base_value'],
			$array['extra_value'],
			$array['punish_value'],
			$array['note']
		);		
        return $obj;
    }
    protected function targetClass() {return "PayRoll";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdEmployee(),
			$object->getIdTracking(),
			$object->getAbsent(),
			$object->getBaseValue(),
			$object->getExtraValue(),
			$object->getPunishValue(),
			$object->getNote()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdEmployee(),
			$object->getIdTracking(),
			$object->getAbsent(),
			$object->getBaseValue(),
			$object->getExtraValue(),
			$object->getPunishValue(),
			$object->getNote(),
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }

	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}
    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findBy($values ){
        $this->findByStmt->execute( $values );
        return new PayRollCollection( $this->findByStmt->fetchAll(), $this );
    }
			
	function findByTracking($values ){	
        $this->findByTrackingStmt->execute( $values );
        return new PayRollCollection( $this->findByTrackingStmt->fetchAll(), $this );
    }
	
	function deleteByTracking($values ){	
        $this->deleteByTrackingStmt->execute( $values );
        return true;
    }
		
}
?>