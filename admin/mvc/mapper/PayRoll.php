<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class PayRoll extends Mapper implements \MVC\Domain\PayRollFinder{

    function __construct() {
        parent::__construct();
				
		$tblPayRoll = "demo1_pay_roll";
		
		$selectAllStmt = sprintf("select * from %s", $tblPayRoll);
		$selectStmt = sprintf("select * from %s where id=?", $tblPayRoll);
		$updateStmt = sprintf("update %s set idemployee=?, date=?, state=?, extra=?, late=? where id=?", $tblPayRoll);
		$insertStmt = sprintf("insert into %s (idemployee, date, state, extra, late) values(?,?,?,?,?)", $tblPayRoll);
		$deleteStmt = sprintf("delete from %s where id=?", $tblPayRoll);
		$findByStmt = sprintf("select * from %s where idemployee = ? order by date DESC", $tblPayRoll);
				
		$findByTrackingStmt = sprintf(
			"select * from %s
			where
				idemployee = ? AND `date` >= ? AND `date` <= ?
			ORDER BY `date`
			"
		, $tblPayRoll);
		$checkStmt = sprintf("
			select distinct id 
			from %s 
			where idemployee=? and `date`=?
		", $tblPayRoll);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByStmt = self::$PDO->prepare($findByStmt);		
		$this->findByTrackingStmt = self::$PDO->prepare($findByTrackingStmt);
		$this->checkStmt = self::$PDO->prepare($checkStmt);
    } 
    function getCollection( array $raw ) {return new PayRollCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\PayRoll( 
			$array['id'],
			$array['idemployee'],
			$array['date'],
			$array['state'],
			$array['extra'],
			$array['late']
		);
        return $obj;
    }

    protected function targetClass() {        
		return "PayRoll";
    }

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdEmployee(),
			$object->getDate(),
			$object->getState(),
			$object->getExtra(),
			$object->getLate()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdEmployee(),
			$object->getDate(),
			$object->getState(),
			$object->getExtra(),			
			$object->getLate(),
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
		//print_r($values);
        $this->findByTrackingStmt->execute( $values );
        return new PayRollCollection( $this->findByTrackingStmt->fetchAll(), $this );
    }
	
	function check( $values ) {	
        $this->checkStmt->execute( $values );
		$result = $this->checkStmt->fetchAll();		
		if (!isset($result) || $result==null)
			return null;        
        return $result[0][0];
    }
	
}
?>