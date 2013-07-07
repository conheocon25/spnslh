<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class Province extends Mapper implements \MVC\Domain\ProvinceFinder {

    function __construct() {
        parent::__construct();
				
		$tblProvince = "saigonlandhouse_province";
		
		$selectAllStmt = sprintf("select * from %s ORDER BY `order` DESC", $tblProvince);
		$selectStmt = sprintf("select *  from %s where id=?", $tblProvince);
		$updateStmt = sprintf("update %s set name=? where id=?", $tblProvince);
		$insertStmt = sprintf("insert into %s ( name) values(?)", $tblProvince);
		$deleteStmt = sprintf("delete from %s where id=?", $tblProvince);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		
    } 
    function getCollection( array $raw ) {
        return new ProvinceCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\Province( 
			$array['id'],			
			$array['name'],
			$array['X'],
			$array['Y'],
			$array['order']
		);
        return $obj;
    }

    protected function targetClass() {        
		return "Province";
    }

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

	protected function doDelete(array $values) {
        return $this->deleteStmt->execute( $values );
    }

    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}	
	
}
?>