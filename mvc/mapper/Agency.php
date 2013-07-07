<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Agency extends Mapper implements \MVC\Domain\AgencyFinder {

    function __construct() {
        parent::__construct();
				
		$tblAgency = "saigonlandhouse_agency";
		
		$selectAllStmt = sprintf("select * from %s ORDER BY name", $tblAgency);
		$selectStmt = sprintf("select *  from %s where id=?", $tblAgency);
		$updateStmt = sprintf("update %s set name=?, phone=?, email=?, password=?, address=?, active=? where id=?", $tblAgency);
		$insertStmt = sprintf("insert into %s ( name, phone, email, password, address, active) values(?, ?, ?, ?, ?, ?)", $tblAgency);
		$deleteStmt = sprintf("delete from %s where id=?", $tblAgency);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		
    } 
    function getCollection( array $raw ) {
        return new AgencyCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\Agency( 
			$array['id'],
			$array['name'],
			$array['phone'],
			$array['email'],
			$array['password'],
			$array['address'],
			$array['active']
		);
        return $obj;
    }

    protected function targetClass() {        
		return "Agency";
    }

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName(),
			$object->getPhone(),
			$object->getEmail(),
			$object->getPassword(),
			$object->getAddress(),
			$object->getActive()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName(),
			$object->getPhone(),
			$object->getEmail(),
			$object->getPassword(),
			$object->getAddress(),
			$object->getActive(),
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}

    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}	
	
}
?>