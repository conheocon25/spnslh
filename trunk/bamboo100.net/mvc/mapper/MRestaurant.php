<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class MRestaurant extends Mapper implements \MVC\Domain\MRestaurantFinder {

    function __construct() {
        parent::__construct();
		
		$tblMRestaurant = "tbl_mRestaurant";
		$selectAllStmt 	= sprintf("select * from %s", $tblMRestaurant);
		$selectStmt 	= sprintf("select *  from %s where id=?", $tblMRestaurant);
		$updateStmt 	= sprintf("update %s set introduction=?, count=? where id=?"	, $tblMRestaurant);
		$insertStmt 	= sprintf("insert into %s ( introduction, count) values(?, ?)"	, $tblMRestaurant);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblMRestaurant);
										
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);								
		
    } 
    function getCollection( array $raw ) {return new MRestaurantCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\MRestaurant( 
			$array['id'],			
			$array['introduction'],
			$array['count']
		);				
        return $obj;
    }

    protected function targetClass() {return "MRestaurant";}

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIntroduction(),
			$object->getCount()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIntroduction(),
			$object->getCount(),
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}
    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}			
}
?>