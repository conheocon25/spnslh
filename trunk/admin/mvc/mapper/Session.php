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
		$updateStmt = sprintf("update %s set idtable=?, iduser=?, idcustomer=?, datetime=?, datetimeend=?, note=?, status=?, discount_value=?, discount_percent=?, surtax=?, payment=? where id=?", $tblSession);
		$insertStmt = sprintf("insert into %s (idtable, iduser, idcustomer, datetime, datetimeend, note, status, discount_value, discount_percent, surtax, payment) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", $tblSession);
		$deleteStmt = sprintf("delete from %s where id=?", $tblSession);
			
		$findByTableStmt = sprintf("select * from %s where idtable=?  order by datetime desc", $tblSession);
		$findByTablePageStmt = sprintf("
							SELECT * 
							FROM %s 							 
							WHERE idtable=:idtable
							ORDER BY datetime desc										
							LIMIT :start,:max
				", $tblSession);
		
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

		$findByTracking1Stmt = sprintf(
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
					
		$findLastStmt = sprintf("select * from %s where idtable=? and status<1 order by datetime desc limit 1", $tblSession);
		$findLastAllStmt = sprintf("select * from %s where status<1 order by datetime desc", $tblSession);
		$findNowAllStmt = sprintf("select * from %s where date(datetime) = date(now())", $tblSession);
				
		$this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		
		$this->findByTableStmt 		= self::$PDO->prepare($findByTableStmt);
		$this->findByTablePageStmt 	= self::$PDO->prepare($findByTablePageStmt);
		
		$this->findByTrackingStmt 	= self::$PDO->prepare($findByTrackingStmt);
		$this->findByTracking1Stmt 	= self::$PDO->prepare($findByTracking1Stmt);		
		$this->findLastStmt 		= self::$PDO->prepare($findLastStmt);
		$this->findLastAllStmt 		= self::$PDO->prepare($findLastAllStmt);
		$this->findNowAllStmt 		= self::$PDO->prepare($findNowAllStmt);		
    } 
    function getCollection( array $raw ) {return new SessionCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Session( 
			$array['id'],
			$array['idtable'],			
			$array['iduser'], 
			$array['idcustomer'],
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
	function findLastAll($values ) {
        $this->findLastAllStmt->execute( $values );
        return new SessionCollection( $this->findLastAllStmt->fetchAll(), $this );
    }
	function findNowAll($values ) {
        $this->findNowAllStmt->execute( $values );
        return new SessionCollection( $this->findNowAllStmt->fetchAll(), $this );
    }
	
	function findByTable($values ) {
        $this->findByTableStmt->execute( $values );
        return new SessionCollection( $this->findByTableStmt->fetchAll(), $this );
    }
		
	function findByTracking($values ){
        $this->findByTrackingStmt->execute( $values );
        return new SessionCollection( $this->findByTrackingStmt->fetchAll(), $this );
    }
	
	function findByTracking1($values ){
        $this->findByTracking1Stmt->execute( $values );
        return new SessionCollection( $this->findByTracking1Stmt->fetchAll(), $this );
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