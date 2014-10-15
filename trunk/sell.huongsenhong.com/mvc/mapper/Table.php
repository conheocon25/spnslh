<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class Table extends Mapper implements \MVC\Domain\UserFinder {

    function __construct() {
        parent::__construct();
				
		$tblTable = "tbl_table";
		$tblSession = "tbl_session";
		$tblSessionDetail = "tbl_session_detail";
				
		$selectAllStmt = sprintf("select * from %s", $tblTable);								
		$selectStmt = sprintf("select * from %s where id=?", $tblTable);
		$updateStmt = sprintf("update %s set iddomain=?, name=?, iduser=?, type=? where id=?", $tblTable);
		$insertStmt = sprintf("insert into %s (iddomain, name, iduser, type) values(?, ?, ?, ?)", $tblTable);
		$deleteStmt = sprintf("delete from %s where id=?", $tblTable);
		$findByDomainStmt = sprintf("select * from %s where iddomain =?", $tblTable);
		$findByTypeStmt = sprintf("select * from %s where type =?", $tblTable);
		
		$findNonGuestStmt = sprintf("
							SELECT
								*	 
							FROM %s T
							WHERE 
								iddomain=? AND
								(
									select S.status
									from %s S
									where T.id = S.idtable
									order by datetime DESC
									LIMIT 1
								) <> 0
		", $tblTable, $tblSession);
		
		$findAllNonGuestStmt = sprintf("
			SELECT
				*	 
			FROM %s T
			WHERE 				
				(
					SELECT count(S.id)
					FROM tbl_session S
					WHERE T.id = S.idtable	
				)=0 OR
				(
					SELECT S1.status
					FROM tbl_session S1
					WHERE T.id = S1.idtable
					order by datetime DESC
					LIMIT 1
				)=1
			ORDER BY iddomain, name
		", $tblTable, $tblSession, $tblSession);
		
		$findGuestStmt = sprintf("
							SELECT
								*	 
							FROM %s T
							WHERE 
								iddomain=? AND
								(
									SELECT S.status
									from %s S
									where T.id = S.idtable
									order by datetime DESC
									LIMIT 1
								) = 0
		", $tblTable, $tblSession);
		
		$findAllGuestStmt = sprintf("
			SELECT
				*	 
			FROM %s T
			WHERE
			T.id <>? AND
			(
				SELECT S.status
				FROM %s S
				WHERE T.id = S.idtable
				GROUP BY S.datetime DESC
				LIMIT 1
			)=0
			ORDER BY iddomain, name
		", $tblTable,  $tblSession);
		$findByPageStmt = sprintf("
							SELECT *
							FROM %s
							WHERE iddomain=:iddomain
							LIMIT :start,:max
				", $tblTable);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
							
		$this->findByDomainStmt = self::$PDO->prepare($findByDomainStmt);
		$this->findByTypeStmt = self::$PDO->prepare($findByTypeStmt);
		$this->findNonGuestStmt = self::$PDO->prepare($findNonGuestStmt);		
		$this->findAllNonGuestStmt = self::$PDO->prepare($findAllNonGuestStmt);
		$this->findGuestStmt = self::$PDO->prepare($findGuestStmt);
		$this->findAllGuestStmt = self::$PDO->prepare($findAllGuestStmt);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);
	
    } 
    function getCollection( array $raw ) {
        return new TableCollection( $raw, $this );
    }

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
	
    protected function targetClass() {        
		return "Table";
    }

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

	protected function doDelete(array $values) {
        return $this->deleteStmt->execute( $values );
    }
	
    function selectStmt() {
        return $this->selectStmt;
    }
	
    function selectAllStmt() {
        return $this->selectAllStmt;
    }
	
	function findByDomain($values ) {	
        $this->findByDomainStmt->execute( $values );
        return new TableCollection( $this->findByDomainStmt->fetchAll(), $this );
    }
	function findByType($values ) {	
        $this->findByTypeStmt->execute( $values );
        return new TableCollection( $this->findByTypeStmt->fetchAll(), $this );
    }
	
	function findNonGuest($values ) {	
        $this->findNonGuestStmt->execute( $values );
        return new TableCollection( $this->findNonGuestStmt->fetchAll(), $this );
    }
	function findAllNonGuest($values ) {	
        $this->findAllNonGuestStmt->execute( $values );
        return new TableCollection( $this->findAllNonGuestStmt->fetchAll(), $this );
    }
	
	function findGuest($values ) {	
        $this->findGuestStmt->execute( $values );
        return new TableCollection( $this->findGuestStmt->fetchAll(), $this );
    }
	function findAllGuest($values ){
        $this->findAllGuestStmt->execute( $values );
        return new TableCollection( $this->findAllGuestStmt->fetchAll(), $this );
    }
	
	function findByPage( $values ) {
		$this->findByPageStmt->bindValue(':iddomain', $values[0], \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);		
		$this->findByPageStmt->execute();
        return new CourseCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>