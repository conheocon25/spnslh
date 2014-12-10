<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Manufacturer extends Mapper implements \MVC\Domain\ManufacturerFinder {

    function __construct() {
        parent::__construct();
		
		$tblManufacturer = "tbl_manufacturer";
						
		$selectAllStmt 	= sprintf("select * from %s order by `order`", $tblManufacturer);
		$selectStmt 	= sprintf("select * from %s where id=?", $tblManufacturer);
		$updateStmt 	= sprintf("update %s set name=?, image=?, `order`=? where id=?", $tblManufacturer);
		$insertStmt 	= sprintf("insert into %s ( name, image, `order`) values(?, ?, ?)", $tblManufacturer);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblManufacturer);
		$findByPageStmt = sprintf("SELECT * FROM  %s ORDER BY `order` LIMIT :start,:max", $tblManufacturer);
		$findByKeyStmt 	= sprintf("select *  from %s where `key`=?", $tblManufacturer);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);
		$this->findByKeyStmt = self::$PDO->prepare($findByKeyStmt);							
    } 
    function getCollection( array $raw ) {return new ManufacturerCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Manufacturer( 
			$array['id'],
			$array['name'],
			$array['image'],
			$array['order']
		);
        return $obj;
    }
	
    protected function targetClass() {  return "Manufacturer";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName(),
			$object->getImage(),
			$object->getOrder()			
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName(),
			$object->getImage(),
			$object->getOrder(),			
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
	
	function findByKey( $values ) {	
		$this->findByKeyStmt->execute( array($values) );
        $array = $this->findByKeyStmt->fetch();
        $this->findByKeyStmt->closeCursor();
        if ( ! is_array( $array ) ) { return null; }
        if ( ! isset( $array['id'] ) ) { return null; }
        $object = $this->doCreateObject( $array );
        return $object;		
    }
}
?>