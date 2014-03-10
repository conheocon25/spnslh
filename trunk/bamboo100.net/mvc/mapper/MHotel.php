<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class MHotel extends Mapper implements \MVC\Domain\MHotelFinder {

    function __construct() {
        parent::__construct();
		
		$tblMHotel 		= "tbl_mhotel";
		$selectAllStmt 	= sprintf("select * from %s", $tblMHotel);
		$selectStmt 	= sprintf("select *  from %s where id=?", $tblMHotel);
		$updateStmt 	= sprintf("update %s set introduction=?, count=? where id=?"	, $tblMHotel);
		$insertStmt 	= sprintf("insert into %s ( introduction, count) values(?, ?)"	, $tblMHotel);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblMHotel);
										
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);								
		
    } 
    function getCollection( array $raw ) {return new MHotelCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\MHotel( 
			$array['id'],			
			$array['introduction'],
			$array['count']
		);				
        return $obj;
    }

    protected function targetClass() {return "MHotel";}

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