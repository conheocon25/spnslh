<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class CollectCustomer extends Mapper implements \MVC\Domain\CollectCustomerFinder {

    function __construct() {
        parent::__construct();
				
		$tblCollectCustomer = "tbl_collect_customer";
		
		$selectAllStmt = sprintf("select * from %s", $tblCollectCustomer);
		$selectStmt = sprintf("select * from %s where id=?", $tblCollectCustomer);
		$updateStmt = sprintf("update %s set idcustomer=?, date=?, value=?, note=? where id=?", $tblCollectCustomer);
		$insertStmt = sprintf("insert into %s (idcustomer, date, value, note) values(?,?,?,?)", $tblCollectCustomer);
		$deleteStmt = sprintf("delete from %s where id=?", $tblCollectCustomer);
		$findByStmt = sprintf("select * from %s where idcustomer = ? order by date DESC", $tblCollectCustomer);		
				
		$findByTrackingStmt = sprintf(
			"select
				*
			from 
				%s
			where
				idcustomer=? AND date >= ? AND date <= ?
			order by 
				date DESC
			"
		, $tblCollectCustomer);
		
		$findByTracking1Stmt = sprintf(
			"select
				*
			from 
				%s
			where
				date >= ? AND date <= ?
			order by 
				date DESC
			"
		, $tblCollectCustomer);
		
		$findByPageStmt = sprintf("
							SELECT * 
							FROM %s 							 
							WHERE idcustomer=:idcustomer
							ORDER BY date desc
							LIMIT :start,:max
				", $tblCollectCustomer);
				
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByStmt = self::$PDO->prepare($findByStmt);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);
		$this->findByTrackingStmt = self::$PDO->prepare($findByTrackingStmt);
		$this->findByTracking1Stmt = self::$PDO->prepare($findByTracking1Stmt);
    } 
    function getCollection( array $raw ) {return new CollectCustomerCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\CollectCustomer( 
			$array['id'],
			$array['idcustomer'],
			$array['date'],
			$array['value'],
			$array['note']
		);
        return $obj;
    }

    protected function targetClass() {        
		return "CollectCustomer";
    }

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdCustomer(),
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
			$object->getIdCustomer(),
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
        return new CollectCustomerCollection( $this->findByStmt->fetchAll(), $this );
    }
	
	function findByTracking1($values ){
        $this->findByTracking1Stmt->execute( $values );
        return new CollectCustomerCollection( $this->findByTracking1Stmt->fetchAll(), $this );
    }
	
	function findByTracking($values ){
        $this->findByTrackingStmt->execute( $values );
        return new CollectCustomerCollection( $this->findByTrackingStmt->fetchAll(), $this );
    }
	function findByPage( $values ) {		
		$this->findByPageStmt->bindValue(':idcustomer', $values[0], \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);		
		$this->findByPageStmt->execute();
        return new CollectCustomerCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>