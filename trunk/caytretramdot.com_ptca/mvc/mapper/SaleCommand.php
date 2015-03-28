<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class SaleCommand extends Mapper implements \MVC\Domain\SaleCommandFinder {

    function __construct() {
        parent::__construct();
		$tblSaleCommand 		= "sale_command";
		
        $this->selectAllStmt 	= self::$PDO->prepare("select * from sale_command");
        $this->selectStmt 		= self::$PDO->prepare("select * from sale_command where id=?");
        $this->updateStmt 		= self::$PDO->prepare("update sale_command set id_employee=?, id_customer=?, id_branch=?, datetime=?, note=?, state=? where id=?");
        $this->insertStmt 		= self::$PDO->prepare("insert into sale_command (id_employee, id_customer, id_branch, datetime, note, state) values(?, ?, ?, ?, ?, ?)");
		$this->deleteStmt 		= self::$PDO->prepare("delete from sale_command where id=?");
		
		$this->findByStateStmt			= self::$PDO->prepare("select * from sale_command where state=? ORDER BY datetime DESC");
		$this->findByCustomerStmt		= self::$PDO->prepare("select * from sale_command where id_customer=? ORDER BY datetime DESC");
		$this->findByCustomerTop12Stmt	= self::$PDO->prepare("select * from sale_command where id_customer=? ORDER BY datetime DESC LIMIT 12");						
		$this->findByEmployeeStmt		= self::$PDO->prepare("select * from sale_command where id_employee=? ORDER BY datetime DESC");
						
		$findByPageStmt 		= sprintf("SELECT * FROM  %s LIMIT :start,:max", $tblSaleCommand);
		$this->findByPageStmt 	= self::$PDO->prepare($findByPageStmt);
		 
    } 
    function getCollection( array $raw ) {return new SaleCommandCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\SaleCommand( 
			$array['id'],
			$array['id_employee'],
			$array['id_customer'],
			$array['id_branch'],
			$array['datetime'],
			$array['note'],
			$array['state']
		);
        return $obj;
    }
	
    protected function targetClass() {return "SaleCommand";}

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdEmployee(),
			$object->getIdCustomer(),			
			$object->getIdBranch(),
			$object->getDateTime(),			
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
			$object->getIdBranch(),
			$object->getDateTime(),			
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
        return new SaleCommandCollection( $this->findByPageStmt->fetchAll(), $this );
    }
	
	function findByState($values){
        $this->findByStateStmt->execute( $values );
        return new SaleCommandCollection( $this->findByStateStmt->fetchAll(), $this );
    }
	
	function findByCustomer($values) {		
        $this->findByCustomerStmt->execute( $values );
        return new SaleCommandCollection( $this->findByCustomerStmt->fetchAll(), $this );
    }
	
	function findByCustomerTop12($values) {		
        $this->findByCustomerTop12Stmt->execute( $values );
        return new SaleCommandCollection( $this->findByCustomerTop12Stmt->fetchAll(), $this );
    }
	
	function findByEmployee($values) {
        $this->findByEmployeeStmt->execute( $values );
        return new SaleCommandCollection( $this->findByEmployeeStmt->fetchAll(), $this );
    }		
	
}
?>