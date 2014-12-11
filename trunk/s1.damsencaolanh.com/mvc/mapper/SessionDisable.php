<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class SessionDisable extends Mapper implements \MVC\Domain\SessionDisableFinder {
    function __construct() {
        parent::__construct();
        $tblSessionDisable 		= "tbl_session_disable";
								
		$selectAllStmt 			= sprintf("select * from %s order by id desc", $tblSessionDisable);
		$selectStmt 			= sprintf("select * from %s where id=?", $tblSessionDisable);
		$updateStmt 			= sprintf("update %s set idsession=?, note=? where id=?", $tblSessionDisable);
		$insertStmt 			= sprintf("insert into %s (idsession, note) values(?, ?)", $tblSessionDisable);
		$deleteStmt 			= sprintf("delete from %s where id=?", $tblSessionDisable);
						
		$this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);
		
    }	
    function getCollection( array $raw ) {return new SessionDisableCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\SessionDisable( 
			$array['id'],
			$array['idsession'],
			$array['note']
		);
        return $obj;
    }
	
    protected function targetClass() {return "SessionDisable";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdSession(),			
			$object->getNote()
		);
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdSession(),			
			$object->getNote(),			
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}
	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
					
}
?>