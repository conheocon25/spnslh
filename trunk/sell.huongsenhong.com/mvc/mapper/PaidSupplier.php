<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class PaidSupplier extends Mapper implements \MVC\Domain\PaidSupplierFinder {

    function __construct() {
        parent::__construct();
				
		$tblPaidSupplier = "tbl_paid_supplier";
		
		$selectAllStmt = sprintf("select * from %s", $tblPaidSupplier);
		$selectStmt = sprintf("select * from %s where id=?", $tblPaidSupplier);
		$updateStmt = sprintf("update %s set idsupplier=?, date=?, value=?, note=? where id=?", $tblPaidSupplier);
		$insertStmt = sprintf("insert into %s (idsupplier, date, value, note) values(?,?,?,?)", $tblPaidSupplier);
		$deleteStmt = sprintf("delete from %s where id=?", $tblPaidSupplier);
		$findByStmt = sprintf("select * from %s where idsupplier = ? order by date DESC", $tblPaidSupplier);
		$findByTop10Stmt = sprintf("select * from %s where idsupplier = ? order by date DESC LIMIT 10", $tblPaidSupplier);
		
		$findByTrackingStmt = sprintf(
			"select
				*
			from 
				%s
			where
				date >= ? AND date <= ?
			order by 
				date DESC
			"
		, $tblPaidSupplier);
		$findByTracking1Stmt = sprintf(
			"select
				*
			from 
				%s
			where
				idsupplier=? AND date >= ? AND date <= ?
			order by 
				date DESC
			"
		, $tblPaidSupplier);
		$findByPageStmt = sprintf("
							SELECT * 
							FROM %s 							 
							WHERE idsupplier=:idsupplier
							ORDER BY date desc
							LIMIT :start,:max
				", $tblPaidSupplier);
				
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByStmt = self::$PDO->prepare($findByStmt);
		$this->findByTop10Stmt = self::$PDO->prepare($findByTop10Stmt);
		$this->findByTrackingStmt = self::$PDO->prepare($findByTrackingStmt);
		$this->findByTracking1Stmt = self::$PDO->prepare($findByTracking1Stmt);		
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);
    } 
    function getCollection( array $raw ) {
        return new PaidSupplierCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\PaidSupplier( 
			$array['id'],
			$array['idsupplier'],
			$array['date'],
			$array['value'],
			$array['note']
		);
        return $obj;
    }

    protected function targetClass() {        
		return "PaidSupplier";
    }

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdSupplier(),
			$object->getDate(),
			$object->getValue(),
			$object->getNote()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdSupplier(),
			$object->getDate(),
			$object->getValue(),
			$object->getNote(),
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
	
	function findBy($values ){
        $this->findByStmt->execute( $values );
        return new PaidSupplierCollection( $this->findByStmt->fetchAll(), $this );
    }
	
	function findByTop10($values ){
        $this->findByTop10Stmt->execute( $values );
        return new PaidSupplierCollection( $this->findByTop10Stmt->fetchAll(), $this );
    }
	
	function findByTracking($values ){
        $this->findByTrackingStmt->execute( $values );
        return new PaidSupplierCollection( $this->findByTrackingStmt->fetchAll(), $this );
    }
	
	function findByTracking1($values ){
        $this->findByTracking1Stmt->execute( $values );
        return new PaidSupplierCollection( $this->findByTracking1Stmt->fetchAll(), $this );
    }
	
	function findByPage( $values ) {		
		$this->findByPageStmt->bindValue(':idsupplier', $values[0], \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);		
		$this->findByPageStmt->execute();
        return new PaidSupplierCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>