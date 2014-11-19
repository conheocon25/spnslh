<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class ProductMap extends Mapper implements \MVC\Domain\ProductMapFinder {

    function __construct() {
        parent::__construct();
		$tblProductMap = "tbl_product_map";
						
		$selectAllStmt 			= sprintf("select * from %s", $tblProductMap);
		$selectStmt 			= sprintf("select * from %s where id=?", $tblProductMap);
		$updateStmt 			= sprintf("update %s set idproduct=?, iddistrict=?, latitude=?, longitude=?, address=? where id=?", $tblProductMap);
		$insertStmt 			= sprintf("insert into %s ( idproduct, iddistrict, latitude, longitude, address) values( ?, ?, ?, ?, ?)", $tblProductMap);
		$deleteStmt 			= sprintf("delete from %s where id=?", 				$tblProductMap);
		$findByStmt 			= sprintf("select * from %s where idproduct=?", 	$tblProductMap);
		$existStmt 				= sprintf("select id from %s where idproduct=? ", 	$tblProductMap);
		
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);
		$this->findByStmt 		= self::$PDO->prepare($findByStmt);
		$this->existStmt 		= self::$PDO->prepare($existStmt);
    }
	
    function getCollection( array $raw ) {return new ProductMapCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\ProductMap( 
			$array['id'],
			$array['idproduct'],			
			$array['iddistrict'],						
			$array['latitude'],
			$array['longitude'],
			$array['address']
		);
        return $obj;
    }
	
    protected function targetClass(){return "ProductMap";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdProduct(),
			$object->getIdDistrict(),	
			$object->getLatitude(),
			$object->getLongitude(),
			$object->getAddress()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ){
        $values = array( 
			$object->getIdProduct(),
			$object->getIdDistrict(),	
			$object->getLatitude(),
			$object->getLongitude(),
			$object->getAddress(),
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}			
    function selectStmt() 		{return $this->selectStmt;}
    function selectAllStmt() 	{return $this->selectAllStmt;}
	
	function findBy(array $values) {
        $this->findByStmt->execute( $values );
        return new ProductMapCollection( $this->findByStmt->fetchAll(), $this );
    }
	
	function exist($values) {
		$this->existStmt->execute($values);
		$result = $this->existStmt->fetchAll();
		if($result != null) {
			return $result[0][0];
		} else {
			return -1;			
		}
    }	
}
?>