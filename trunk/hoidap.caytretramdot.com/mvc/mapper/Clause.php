<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Clause extends Mapper implements \MVC\Domain\ClauseFinder {

    function __construct() {
        parent::__construct();
		
		$tblClause = "tbl_clause";
						
		$selectAllStmt 	= sprintf("select * from %s", $tblClause);
		$selectStmt 	= sprintf("select * from %s where id=?", $tblClause);
		$updateStmt 	= sprintf("update %s set id_domain=?, id_question=?, state=? where id=?", $tblClause);
		$insertStmt 	= sprintf("insert into %s ( id_domain, id_question, state) values(?,?,?)", $tblClause);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblClause);		
		$findByStmt 	= sprintf("SELECT * FROM  %s WHERE id_domain=?", $tblClause);
		$findByPageStmt = sprintf("SELECT * FROM  %s LIMIT :start,:max", $tblClause);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByStmt = self::$PDO->prepare($findByStmt);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);
									
    } 
    function getCollection( array $raw ) {
        return new ClauseCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Clause( 
			$array['id'],
			$array['id_solve'],
			$array['id_question'],
			$array['state']
		);
        return $obj;
    }
	
    protected function targetClass() {        
		return "Clause";
    }

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdDomain(),
			$object->getid_question(),
			$object->getstate()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdDomain(),
			$object->getid_question(),
			$object->getstate(),
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }

	protected function doDelete(array $values) {
        return $this->deleteStmt->execute( $values );
    }
	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findBy($values ){
        $this->findByStmt->execute( $values );
        return new ClauseCollection( $this->findByStmt->fetchAll(), $this );
    }
	
	function findByPage( $values ) {
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new ClauseCollection( $this->findByPageStmt->fetchAll(), $this );
    }	
}
?>