<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Save extends Mapper implements \MVC\Domain\SaveFinder {

    function __construct() {
        parent::__construct();
		
		$tblSave = "shopc_save";
						
		$selectAllStmt 	= sprintf("select * from %s order by `date1`", $tblSave);
		$selectStmt 	= sprintf("select * from %s where id=?", $tblSave);
		$updateStmt 	= sprintf("update %s set name=?, `date1`=?, `date2`=?, `key`=? where id=?", $tblSave);
		$insertStmt 	= sprintf("insert into %s ( name, `date1`, `date2`, `key`) values(?, ?, ?, ?)", $tblSave);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblSave);
		$findByPageStmt = sprintf("SELECT * FROM  %s LIMIT :start,:max", $tblSave);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);
									
    } 
    function getCollection( array $raw ) {return new SaveCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Save( 
			$array['id'],
			$array['name'],
			$array['date1'],
			$array['date2'],
			$array['key']
		);
        return $obj;
    }
	
    protected function targetClass() {  return "Save";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName(),
			$object->getDate1(),
			$object->getDate2(),
			$object->getKey()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName(),
			$object->getDate1(),
			$object->getDate2(),
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