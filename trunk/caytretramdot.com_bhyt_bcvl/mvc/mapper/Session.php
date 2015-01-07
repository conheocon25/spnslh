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
		$findByTableStmt 		= sprintf("SELECT SE.id, SE.id_tracking, SE.id_student, SE.state FROM %s SE INNER JOIN %s SU ON SE.id_student=SU.id WHERE SU.id_class=?", $tblSession, $tblStudent);
		$findByPageStmt 		= sprintf("SELECT * FROM  %s LIMIT :start,:max", $tblSession);
				
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);
		$this->deleteByTableStmt= self::$PDO->prepare($deleteByTableStmt);
		$this->findByTableStmt 	= self::$PDO->prepare($findByTableStmt);
		$this->findByPageStmt 	= self::$PDO->prepare($findByPageStmt);
									
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
	
	function findByTable($values ) {	
        $this->findByTableStmt->execute( $values );
        return new SessionCollection( $this->findByTableStmt->fetchAll(), $this );
    }
	
	function findByPage( $values ){
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new SessionCollection( $this->findByPageStmt->fetchAll(), $this );
    }	
}
?>