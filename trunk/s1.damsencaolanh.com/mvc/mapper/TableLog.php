<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class TableLog extends Mapper implements \MVC\Domain\UserFinder {

    function __construct() {
        parent::__construct();
				
		$tblTableLog = "tbl_table_log";
						
		$selectAllStmt = sprintf("select * from %s", $tblTableLog);
		$selectStmt = sprintf("select * from %s where id=?", $tblTableLog);
		$updateStmt = sprintf("update %s set iduser=?, idtable=?, `datetime`=?, note=? where id=?", $tblTableLog);
		$insertStmt = sprintf("insert into %s (iduser, idtable, `datetime`, note) values(?, ?, ?, ?)", $tblTableLog);
		$deleteStmt = sprintf("delete from %s where id=?", $tblTableLog);
		$findByStmt = sprintf("select * from %s where idtable =? AND date(datetime)=? ORDER BY datetime", $tblTableLog);
		$findByPageStmt = sprintf("SELECT *  FROM %s WHERE idtable=:idtable ORDER BY datetime desc LIMIT :start,:max", $tblTableLog);
				
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);							
		$this->findByStmt = self::$PDO->prepare($findByStmt);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);
		
    } 
    function getCollection( array $raw ) {
        return new TableLogCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\TableLog( 
			$array['id'],
			$array['iduser'],
			$array['idtable'],
			$array['datetime'],
			$array['note']			
		);
        return $obj;
    }
	
    protected function targetClass() {        
		return "TableLog";
    }

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdUser(),
			$object->getIdTable(),
			$object->getDateTime(),
			$object->getNote()			
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdUser(),
			$object->getIdTable(),
			$object->getDateTime(),
			$object->getNote(),
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }

	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findBy($values ) {	
        $this->findByStmt->execute( $values );
        return new TableLogCollection( $this->findByStmt->fetchAll(), $this );
    }
	
	function findByPage( $values ) {
		$this->findByPageStmt->bindValue(':idtable', $values[0], \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);		
		$this->findByPageStmt->execute();
        return new TableLogCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>