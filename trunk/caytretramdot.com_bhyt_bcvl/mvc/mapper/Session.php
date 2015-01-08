<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Session extends Mapper implements \MVC\Domain\SessionFinder {
    function __construct(){
        parent::__construct();		
		$tblSession 			= "tbl_session";
		$tblStudent 			= "tbl_student";
						
		$selectAllStmt 			= sprintf("select * from %s", $tblSession);
		$selectStmt 			= sprintf("select * from %s where id=?", $tblSession);
		$updateStmt 			= sprintf("update %s set id_tracking=?, id_student=?, state=?  where id=?", $tblSession);
		$insertStmt 			= sprintf("insert into %s ( id_tracking, id_student, state) values(?, ?, ?)", $tblSession);
		$deleteStmt 			= sprintf("delete from %s where id=?", $tblSession);
		$deleteByTableStmt 		= sprintf("DELETE FROM %s WHERE id_student IN (SELECT id FROM %s WHERE id_class=?)", $tblSession, $tblStudent);
		$deleteByTrackingTableStmt= sprintf("DELETE FROM %s WHERE id_tracking=? AND id_student IN (SELECT id FROM %s WHERE id_class=?)", $tblSession, $tblStudent);
		
		$findByTrackingStmt 	= sprintf("SELECT * FROM %s WHERE id_tracking=?", $tblSession);
		$findByTrackingTableStmt = sprintf("SELECT SE.id, SE.id_tracking, SE.id_student, SE.state FROM %s SE INNER JOIN %s SU ON SE.id_student=SU.id WHERE SE.id_tracking=? AND SU.id_class=?", $tblSession, $tblStudent);
		$findByTrackingTableGenderStmt = sprintf("SELECT SE.id, SE.id_tracking, SE.id_student, SE.state FROM %s SE INNER JOIN %s SU ON SE.id_student=SU.id WHERE SE.id_tracking=? AND SU.id_class=? AND SU.gender=?", $tblSession, $tblStudent);
		$findByTrackingGenderStmt= sprintf("SELECT SE.id, SE.id_tracking, SE.id_student, SE.state FROM %s SE INNER JOIN %s SU ON SE.id_student=SU.id WHERE SE.id_tracking=? AND SU.gender=?", $tblSession, $tblStudent);
						
        $this->selectAllStmt 		= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 			= self::$PDO->prepare($selectStmt);
        $this->updateStmt 			= self::$PDO->prepare($updateStmt);
        $this->insertStmt 			= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 			= self::$PDO->prepare($deleteStmt);
		$this->deleteByTableStmt	= self::$PDO->prepare($deleteByTableStmt);
		$this->deleteByTrackingTableStmt	= self::$PDO->prepare($deleteByTrackingTableStmt);
		$this->findByTrackingStmt 	= self::$PDO->prepare($findByTrackingStmt);
		$this->findByTrackingTableStmt 		= self::$PDO->prepare($findByTrackingTableStmt);
		$this->findByTrackingTableGenderStmt= self::$PDO->prepare($findByTrackingTableGenderStmt);
		$this->findByTrackingGenderStmt 	= self::$PDO->prepare($findByTrackingGenderStmt);
											
    } 
    function getCollection( array $raw ) {return new SessionCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Session( 
			$array['id'],
			$array['id_tracking'],
			$array['id_student'],
			$array['state']
		);
        return $obj;
    }
	
    protected function targetClass() {return "Session";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdTracking(),
			$object->getIdStudent(),
			$object->getState()			
		);
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ){
        $values = array( 
			$object->getIdTracking(),
			$object->getIdStudent(),			
			$object->getState(),
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function deleteByTable($values) {return $this->deleteByTableStmt->execute( $values );}
	function deleteByTrackingTable($values) {return $this->deleteByTrackingTableStmt->execute( $values );}
	
	function findByTracking($values ) {	
        $this->findByTrackingStmt->execute( $values );
        return new SessionCollection( $this->findByTrackingStmt->fetchAll(), $this );
    }
	
	function findByTrackingTable($values ) {	
        $this->findByTrackingTableStmt->execute( $values );
        return new SessionCollection( $this->findByTrackingTableStmt->fetchAll(), $this );
    }
	
	function findByTrackingTableGender($values ) {	
        $this->findByTrackingTableGenderStmt->execute( $values );
        return new SessionCollection( $this->findByTrackingTableGenderStmt->fetchAll(), $this );
    }
	
	function findByTrackingGender($values ) {	
        $this->findByTrackingGenderStmt->execute( $values );
        return new SessionCollection( $this->findByTrackingGenderStmt->fetchAll(), $this );
    }
		
}
?>