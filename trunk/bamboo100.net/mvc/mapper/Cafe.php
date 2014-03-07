<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class Cafe extends Mapper implements \MVC\Domain\CafeFinder {

    function __construct() {
        parent::__construct();
		
		$tblCafe 		= "tbl_cafe";		
		$selectAllStmt 	= sprintf("select * from %s", $tblCafe);
		$selectStmt 	= sprintf("select *  from %s where id=?", $tblCafe);
		$updateStmt 	= sprintf("update %s set introduction=?, count=? where id=?"	, $tblCafe);
		$insertStmt 	= sprintf("insert into %s ( introduction, count) values(?, ?)"	, $tblCafe);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblCafe);
										
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);								
		
    } 
    function getCollection( array $raw ) {return new CafeCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\Cafe( 
			$array['id'],			
			$array['introduction'],
			$array['count']
		);				
        return $obj;
    }

    protected function targetClass() {return "Cafe";}

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