<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class InvoiceSell extends Mapper implements \MVC\Domain\InvoiceSellFinder {

    function __construct() {
        parent::__construct();
		$tblInvoiceSell 		= "invoice_sell";
		
        $this->selectAllStmt 	= self::$PDO->prepare("select * from invoice_sell");
        $this->selectStmt 		= self::$PDO->prepare("select * from invoice_sell where id=?");
        $this->updateStmt 		= self::$PDO->prepare("update invoice_sell set id_employee=?, id_customer=?, id_warehouse=?, id_transport=?, id_branch=?, datetime_created=?, datetime_updated=?, note=?, state=? where id=?");
        $this->insertStmt 		= self::$PDO->prepare("insert into invoice_sell (id_employee, id_customer, id_warehouse, id_transport, id_branch, datetime_created, datetime_updated, note, state) values(?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$this->deleteStmt 		= self::$PDO->prepare("delete from invoice_sell where id=?");
		
		$this->findByStateStmt			= self::$PDO->prepare("select * from invoice_sell where state=? ORDER BY datetime_created DESC");
		$this->findByCustomerStmt		= self::$PDO->prepare("select * from invoice_sell where id_customer=? ORDER BY datetime_created DESC");
		$this->findByCustomerTop12Stmt	= self::$PDO->prepare("select * from invoice_sell where id_customer=? ORDER BY datetime_created DESC LIMIT 12");						
		$this->findByEmployeeStmt		= self::$PDO->prepare("select * from invoice_sell where id_employee=? ORDER BY datetime_created DESC");
		
		$this->findByTrackDailyStmt		= self::$PDO->prepare("select * from invoice_sell where date(datetime_created)=? ORDER BY datetime_created DESC");
						
		$findByPageStmt 		= sprintf("SELECT * FROM  %s LIMIT :start,:max", $tblInvoiceSell);
		$this->findByPageStmt 	= self::$PDO->prepare($findByPageStmt);
		 
    } 
    function getCollection( array $raw ) {return new InvoiceSellCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\InvoiceSell( 
			$array['id'],  
			$array['id_employee'],
			$array['id_customer'],
			$array['id_warehouse'],
			$array['id_transport'],
			$array['id_branch'],
			$array['datetime_created'],
			$array['datetime_updated'],
			$array['note'],
			$array['state']
		);
        return $obj;
    }
	
    protected function targetClass() {return "InvoiceSell";}

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdEmployee(),
			$object->getIdCustomer(),
			$object->getIdWarehouse(),
			$object->getIdTransport(),
			$object->getIdBranch(),
			$object->getDateTimeCreated(),
			$object->getDateTimeUpdated(),
			$object->getNote(),
			$object->getState()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdEmployee(),
			$object->getIdCustomer(),
			$object->getIdWarehouse(),
			$object->getIdTransport(),
			$object->getIdBranch(),
			$object->getDateTimeCreated(),
			$object->getDateTimeUpdated(),
			$object->getNote(),
			$object->getState(),
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }
			
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
					
	function findByPage( $values ) {
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new InvoiceSellCollection( $this->findByPageStmt->fetchAll(), $this );
    }
	
	function findByState($values) {		
        $this->findByStateStmt->execute( $values );
        return new InvoiceSellCollection( $this->findByStateStmt->fetchAll(), $this );
    }
	
	function findByCustomer($values) {		
        $this->findByCustomerStmt->execute( $values );
        return new InvoiceSellCollection( $this->findByCustomerStmt->fetchAll(), $this );
    }
	
	function findByCustomerTop12($values) {		
        $this->findByCustomerTop12Stmt->execute( $values );
        return new InvoiceSellCollection( $this->findByCustomerTop12Stmt->fetchAll(), $this );
    }
	
	function findByEmployee($values) {
        $this->findByEmployeeStmt->execute( $values );
        return new InvoiceSellCollection( $this->findByEmployeeStmt->fetchAll(), $this );
    }
	
	function findByTrackDaily($values) {
        $this->findByTrackDailyStmt->execute( $values );
        return new InvoiceSellCollection( $this->findByTrackDailyStmt->fetchAll(), $this );
    }
	
}
?>