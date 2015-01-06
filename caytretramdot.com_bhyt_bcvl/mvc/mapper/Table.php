<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Table extends Mapper implements \MVC\Domain\UserFinder{

    function __construct() {
        parent::__construct();
				
		$tblTable 			= "tbl_table";
		$tblSession 		= "tbl_session";
		$tblSessionDetail 	= "tbl_session_detail";
				
		$selectAllStmt 		= sprintf("SELECT * from %s order by name", $tblTable);								
		$selectStmt 		= sprintf("SELECT * from %s where id=?", $tblTable);
		$updateStmt 		= sprintf("update %s set iddomain=?, name=?, iduser=?, type=? where id=?", $tblTable);
		$insertStmt 		= sprintf("insert into %s (iddomain, name, iduser, type) values(?, ?, ?, ?)", $tblTable);
		$deleteStmt 		= sprintf("delete from %s where id=?", $tblTable);
		$findByDomainStmt 	= sprintf("SELECT * FROM %s WHERE iddomain =? ORDER BY NAME", $tblTable);
		$findByNameStmt 	= sprintf("SELECT * FROM %s WHERE name =?", $tblTable);
		$findByPageStmt 	= sprintf("SELECT * FROM %s WHERE iddomain=:iddomain ORDER BY NAME LIMIT :start,:max", $tblTable);
		
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);		
		$this->findByNameStmt 	= self::$PDO->prepare($findByNameStmt);
		$this->findByDomainStmt = self::$PDO->prepare($findByDomainStmt);
		$this->findByPageStmt 	= self::$PDO->prepare($findByPageStmt);
	
    } 
    function getCollection( array $raw ) {return new TableCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Table( 
			$array['id'],
			$array['iddomain'],				
			$array['name'],
			$array['iduser'],
			$array['type']
		);
        return $obj;
    }	
    protected function targetClass() {return "Table";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdDomain(),
			$object->getName(),
			$object->getIdUser(),
			$object->getType()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdDomain(),
			$object->getName(),
			$object->getIdUser(),
			$object->getType(),
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }

	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findByName($values ) {	
        $this->findByNameStmt->execute( $values );
        return new TableCollection( $this->findByNameStmt->fetchAll(), $this );
    }
	
	function findByDomain($values ) {	
        $this->findByDomainStmt->execute( $values );
        return new TableCollection( $this->findByDomainStmt->fetchAll(), $this );
    }
				
	function findByPage( $values ) {
		$this->findByPageStmt->bindValue(':iddomain', $values[0], \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);		
		$this->findByPageStmt->execute();
        return new TableCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>