<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Presentation extends Mapper implements \MVC\Domain\PresentationFinder {

    function __construct() {
        parent::__construct();
		
		$tblPresentation = "shopc_presentation";
						
		$selectAllStmt 	= sprintf("select * from %s order by `order`", $tblPresentation);
		$selectStmt 	= sprintf("select * from %s where id=?", $tblPresentation);
		$updateStmt 	= sprintf("update %s set name=?, `order`=?, `key`=? where id=?", $tblPresentation);
		$insertStmt 	= sprintf("insert into %s ( name, `order`, `key`) values(?, ?, ?)", $tblPresentation);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblPresentation);
		$findByPageStmt = sprintf("SELECT * FROM  %s LIMIT :start,:max", $tblPresentation);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);
									
    } 
    function getCollection( array $raw ) {return new PresentationCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Presentation( 
			$array['id'],
			$array['name'],
			$array['order'],
			$array['key']
		);
        return $obj;
    }
	
    protected function targetClass() {  return "Presentation";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName(),
			$object->getOrder(),
			$object->getKey()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName(),
			$object->getOrder(),
			$object->getKey(),
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
        return new EmployeeCollection( $this->findByPageStmt->fetchAll(), $this );
    }	
}
?>