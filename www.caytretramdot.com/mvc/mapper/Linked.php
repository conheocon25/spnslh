<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Linked extends Mapper implements \MVC\Domain\LinkedFinder {

    function __construct() {
        parent::__construct();
		
		$tblLinked = "bamboo100_linked";
						
		$selectAllStmt 	= sprintf("select * from %s order by `order`", $tblLinked);
		$selectStmt 	= sprintf("select * from %s where id=?", $tblLinked);
		$updateStmt 	= sprintf("update %s set name=? where id=?", $tblLinked);
		$insertStmt 	= sprintf("insert into %s ( name) values(?)", $tblLinked);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblLinked);
		$findByPageStmt = sprintf("SELECT * FROM  %s ORDER BY `order` LIMIT :start,:max", $tblLinked);
				
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);
		
    } 
    function getCollection( array $raw ) {return new LinkedCollection( $raw, $this );}
	
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Linked( 
			$array['id'],
			$array['name']
		);
        return $obj;
    }
	
    protected function targetClass() {  return "Linked";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName()			
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName()			
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
        return new LinkedCollection( $this->findByPageStmt->fetchAll(), $this );
    }
	
}
?>