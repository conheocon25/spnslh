<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class District extends Mapper implements \MVC\Domain\DistrictFinder {

    function __construct() {
        parent::__construct();
				
		$tblDistrict = "saigonlandhouse_district";
		
		$selectAllStmt = sprintf("select * from %s ORDER BY name", $tblDistrict);
		$selectStmt = sprintf("select *  from %s where id=?", $tblDistrict);
		$updateStmt = sprintf("update %s set name=? where id=?", $tblDistrict);
		$insertStmt = sprintf("insert into %s ( name) values(?)", $tblDistrict);
		$deleteStmt = sprintf("delete from %s where id=?", $tblDistrict);
		$findByStmt = sprintf("select *  from %s where id_province=?", $tblDistrict);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByStmt = self::$PDO->prepare($findByStmt);
		
    } 
    function getCollection( array $raw ) {
        return new DistrictCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\District( 
			$array['id'],
			$array['id_province'],
			$array['name'],
			$array['X'],
			$array['Y']
		);
        return $obj;
    }

    protected function targetClass() {        
		return "District";
    }

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdProvince(),
			$object->getName(),
			$object->getX(),
			$object->getY()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdProvince(),
			$object->getName(),
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }

	protected function doDelete(array $values) {
        return $this->deleteStmt->execute( $values );
    }
	
	function findBy( $values ){
        $this->findByStmt->execute( $values );
        return new DistrictCollection( $this->findByStmt->fetchAll(), $this);
    }
	
    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}	
	
}
?>