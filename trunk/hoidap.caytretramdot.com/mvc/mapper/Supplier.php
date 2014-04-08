<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class Supplier extends Mapper implements \MVC\Domain\SupplierFinder {

    function __construct() {
        parent::__construct();
		$tblSupplier = "tbl_supplier";
						
		$selectAllStmt = sprintf("select * from %s ORDER BY name", $tblSupplier);
		$selectStmt = sprintf("select * from %s where id=?", $tblSupplier);
		$updateStmt = sprintf("update %s set name=?, phone=?, address=?, note=?, debt=? where id=?", $tblSupplier);
		$insertStmt = sprintf("insert into %s ( name, phone, address, note, debt ) 
							values( ?, ?, ?, ?, ?)", $tblSupplier);
		$deleteStmt = sprintf("delete from %s where id=?", $tblSupplier);
		$findByPageStmt = sprintf("SELECT * FROM  %s ORDER BY name LIMIT :start,:max", $tblSupplier);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);
		
    } 
    function getCollection( array $raw ) {
        return new SupplierCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Supplier(
			$array['id'],
			$array['name'], 
			$array['phone'],	
			$array['address'],
			$array['note'],
			$array['debt']
		);
        return $obj;
    }
	
    protected function targetClass() {        
		return "Supplier";
    }

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(  
			$object->getName(), 
			$object->getPhone(),	
			$object->getAddress(),	
			$object->getNote(),
			$object->getDebt()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName(), 
			$object->getPhone(),
			$object->getAddress(),
			$object->getNote(),
			$object->getDebt(),
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
        return new SupplierCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>