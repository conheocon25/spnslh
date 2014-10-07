<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class Session extends Mapper implements \MVC\Domain\SessionFinder {

    function __construct() {
        parent::__construct();
        $tblSession = "tbl_session";		
		$tblSessionDetail = "tbl_session_detail";
		$tblTable = "tbl_table";
						
		$selectAllStmt = sprintf("select * from %s", $tblSession);
		$selectStmt = sprintf("select * from %s where id=?", $tblSession);
		$updateStmt = sprintf("update %s set idtable=?, iduser=?, idcustomer=?, idemployee=?, datetime=?, datetimeend=?, note=?, status=?, discount_value=?, discount_percent=?, surtax=?, payment=? where id=?", $tblSession);
		$insertStmt = sprintf("insert into %s (idtable, iduser, idcustomer, idemployee, datetime, datetimeend, note, status, discount_value, discount_percent, surtax, payment) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", $tblSession);
		$deleteStmt = sprintf("delete from %s where id=?", $tblSession);
		
		$trackingCountStmt = sprintf(		
							"
							SELECT 
								sum(TIMESTAMPDIFF(HOUR,datetime,datetimeend))
							FROM %s S
							where
								idtable = ? AND S.datetime >= ? AND S.datetime <= ? 							
							"
		, $tblSession, $tblSessionDetail);
		
		$findByTableStmt = sprintf("select * from %s where idtable=?  order by datetime desc", $tblSession);
		$findByTablePageStmt = sprintf("
							SELECT * 
							FROM %s 							 
							WHERE idtable=:idtable
							ORDER BY datetime desc										
							LIMIT :start,:max
				", $tblSession);
		$findByTableTrackingStmt = sprintf(
							"select
								*
							from 
								%s S
							where
								idtable = ? AND
								S.datetime >= ? AND 
								S.datetime <= ?
							order by 
								S.datetime DESC
							"
		, $tblSession);
		
		$findByTrackingStmt = sprintf(
							"select
								*
							from 
								%s S
							where
								S.datetime >= ? AND 
								S.datetime <= ?
							order by 
								S.datetime DESC
							"
		, $tblSession);

		$findByTrackingDomainStmt = sprintf(
							"select
								*
							from 
								%s T inner join  %s S on T.id = S.idtable
							where
								T.iddomain= ? AND date(S.datetime) >= ? AND date(S.datetime) <= ?
							order by
								S.datetime DESC
							"
		, $tblTable, $tblSession);
		$findByTrackingCustomerStmt = sprintf(
							"select
								*
							from 
								%s S
							where
								S.idcustomer = ? AND
								S.datetime >= ? AND 
								S.datetime <= ?
							order by 
								S.datetime DESC
							"
		, $tblSession);
		
		$findByTrackingDebtCustomerStmt = sprintf(
							"select
								*
							from 
								%s S
							where
								S.idcustomer = ? AND
								S.status = 2 AND
								S.datetime >= ? AND 
								S.datetime <= ?
							order by 
								S.datetime DESC
							"
		, $tblSession);
		
		$findByTrackingFullCustomerStmt = sprintf(
							"select
								*
							from 
								%s S
							where
								S.idcustomer = ? AND
								S.status = 1 AND
								S.datetime >= ? AND 
								S.datetime <= ?
							order by 
								S.datetime DESC
							"
		, $tblSession);
		
		$evalTrackingStmt = sprintf(
							"
							select
								date(datetime) as date, sum(SD.count*SD.price) as value
							from 
								%s S inner join %s SD
								on SD.idsession = S.id
							where
								date(datetime) >= ? AND date(datetime)<=?
							group by
								date(datetime)
							"
		, $tblSession, $tblSessionDetail);
		
		$findLastStmt = sprintf("select * from %s where idtable=? and status<1 order by datetime desc limit 1", $tblSession);
				
		$this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		
		$this->trackingCountStmt = self::$PDO->prepare($trackingCountStmt);
		$this->findByTableStmt = self::$PDO->prepare($findByTableStmt);
		$this->findByTablePageStmt = self::$PDO->prepare($findByTablePageStmt);
		$this->findByTableTrackingStmt = self::$PDO->prepare($findByTableTrackingStmt);
		
		$this->findByTrackingStmt = self::$PDO->prepare($findByTrackingStmt);
		$this->findByTrackingDomainStmt = self::$PDO->prepare($findByTrackingDomainStmt);
		$this->findByTrackingCustomerStmt = self::$PDO->prepare($findByTrackingCustomerStmt);
		$this->findByTrackingDebtCustomerStmt = self::$PDO->prepare($findByTrackingDebtCustomerStmt);
		$this->findByTrackingFullCustomerStmt = self::$PDO->prepare($findByTrackingFullCustomerStmt);
		
		$this->evalTrackingStmt = self::$PDO->prepare($evalTrackingStmt);
		$this->findLastStmt = self::$PDO->prepare($findLastStmt);																			
		
    } 
    function getCollection( array $raw ) {
        return new SessionCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Session( 
			$array['id'],
			$array['idtable'],			
			$array['iduser'], 
			$array['idcustomer'],
			$array['idemployee'],
			$array['datetime'], 
			$array['datetimeend'], 
			$array['note'], 
			$array['status'],
			$array['discount_value'],
			$array['discount_percent'],
			$array['surtax'],
			$array['payment']			
		);
        return $obj;
    }
	
    protected function targetClass() {        
		return "Session";
    }

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdTable(),
			$object->getIdUser(),
			$object->getIdCustomer(),
			$object->getIdEmployee(),
			$object->getDateTime(),
			$object->getDateTimeEnd(),
			$object->getNote(),
			$object->getStatus(),
			$object->getDiscountValue(),
			$object->getDiscountPercent(),
			$object->getSurtax(),
			$object->getPayment()			
		);
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdTable(),
			$object->getIdUser(),
			$object->getIdCustomer(),
			$object->getIdEmployee(),
			$object->getDateTime(),
			$object->getDateTimeEnd(),
			$object->getNote(),
			$object->getStatus(),
			$object->getDiscountValue(),
			$object->getDiscountPercent(),
			$object->getSurtax(),
			$object->getPayment(),			
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
	
	function findLast( $values ) {	
        $this->findLastStmt->execute( $values );
        $array = $this->findLastStmt->fetch();
        $this->findLastStmt->closeCursor();
        if ( ! is_array( $array ) ) { return null; }
        if ( ! isset( $array['id'] ) ) { return null; }
        $object = $this->doCreateObject( $array );
        return $object;
    }
		
	function trackingCount( $values ) {	
        $this->trackingCountStmt->execute( $values );
		$result = $this->trackingCountStmt->fetchAll();		
		if (!isset($result) || $result==null)
			return null;
        return $result[0][0];
    }
	
	function findByTable($values ) {	
        $this->findByTableStmt->execute( $values );
        return new SessionCollection( $this->findByTableStmt->fetchAll(), $this );
    }
	function findByTableTracking($values ) {	
        $this->findByTableTrackingStmt->execute( $values );
        return new SessionCollection( $this->findByTableTrackingStmt->fetchAll(), $this );
    }
		
	function findByTracking($values ){		
        $this->findByTrackingStmt->execute( $values );
        return new SessionCollection( $this->findByTrackingStmt->fetchAll(), $this );
    }
	
	function findByTrackingDomain($values ){
        $this->findByTrackingDomainStmt->execute( $values );
        return new SessionCollection( $this->findByTrackingDomainStmt->fetchAll(), $this );
    }	         
	function findByTrackingCustomer($values ){
        $this->findByTrackingCustomerStmt->execute( $values );
        return new SessionCollection( $this->findByTrackingCustomerStmt->fetchAll(), $this );
    }
	
	function findByTrackingDebtCustomer($values ){
        $this->findByTrackingDebtCustomerStmt->execute( $values );
        return new SessionCollection( $this->findByTrackingDebtCustomerStmt->fetchAll(), $this );
    }
	function findByTrackingFullCustomer($values ){
        $this->findByTrackingFullCustomerStmt->execute( $values );
        return new SessionCollection( $this->findByTrackingFullCustomerStmt->fetchAll(), $this );
    }
		
	function evalTracking($values ){
        $this->evalTrackingStmt->execute( $values );
		$result = $this->evalTrackingStmt->fetchAll();
        return $result;
    }
	
	function findByTablePage( $values ) {
		$this->findByTablePageStmt->bindValue(':idtable', $values[0], \PDO::PARAM_INT);
		$this->findByTablePageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByTablePageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);		
		$this->findByTablePageStmt->execute();
        return new SessionCollection( $this->findByTablePageStmt->fetchAll(), $this );
    }
}
?>