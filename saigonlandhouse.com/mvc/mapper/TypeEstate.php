<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class TypeEstate extends Mapper implements \MVC\Domain\TypeEstateFinder {

    function __construct(){
        parent::__construct();
		
		$tblTypeEstate = "tbl_type_estate";					
		$selectAllStmt 	= sprintf("select * from %s", $tblTypeEstate);
		$selectStmt 	= sprintf("select * from %s where id=?", $tblTypeEstate);
		$updateStmt 	= sprintf("update %s set name=? where id=?", $tblTypeEstate);
		$insertStmt 	= sprintf("insert into %s ( name) values(?)", $tblTypeEstate);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblTypeEstate);
		$findByPageStmt = sprintf("SELECT * FROM  %s LIMIT :start,:max", $tblTypeEstate);
				
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);		
    } 
    function getCollection( array $raw ) {return new TypeEstateCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\TypeEstate( 
			$array['id'],
			$array['name']			
		);
        return $obj;
    }
	
    protected function targetClass() {  return "TypeEstate";}
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
			$object->getName(),			
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
        return new TypeEstateCollection( $this->findByPageStmt->fetchAll(), $this );
    }		
}
?>