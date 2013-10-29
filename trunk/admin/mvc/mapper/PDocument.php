<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class PDocument extends Mapper implements \MVC\Domain\PDocumentFinder{

    function __construct() {
        parent::__construct();
				
		$tblPDocument = "tbl_project_document";		
		$selectAllStmt = sprintf("select * from %s ORDER BY type DESC, date DESC", $tblPDocument);
		$selectStmt = sprintf("select *  from %s where id=?", $tblPDocument);
		$updateStmt = sprintf("update %s set id_project=?, name=?, date=?, url=?, description=?, `key`=? where id=?", $tblPDocument);
		$insertStmt = sprintf("insert into %s ( id_project, name, date, url, description, `key`) values(?, ?, ?, ?, ?, ?)", $tblPDocument);
		$deleteStmt = sprintf("delete from %s where id=?", $tblPDocument);
		$findByStmt = sprintf("select *  from %s where id_project=? ORDER BY date DESC", $tblPDocument);
		$findByPageStmt = sprintf(
			"SELECT 
				*
			FROM 
				%s 
			WHERE id_project=:id_project
			LIMIT :start,:max"
		, $tblPDocument);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByStmt = self::$PDO->prepare($findByStmt);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);
		
    } 
    function getCollection( array $raw ) {return new PDocumentCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\PDocument( 
			$array['id'],
			$array['id_project'],
			$array['name'],
			$array['date'],
			$array['url'],
			$array['description'],
			$array['key']
		);
        return $obj;
    }

    protected function targetClass() { return "PDocument";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdProject(),
			$object->getName(),
			$object->getDate(),
			$object->getURL(),
			$object->getDescription(),
			$object->getKey()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 			
			$object->getIdProject(),
			$object->getName(),
			$object->getDate(),
			$object->getURL(),
			$object->getDescription(),
			$object->getKey(),
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}
    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findBy( $values ){
        $this->findByStmt->execute( $values );
        return new PDocumentCollection( $this->findByStmt->fetchAll(), $this);
    }
	
	function findByPage( $values ) {
		$this->findByPageStmt->bindValue(':id_project', $values[0], \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new PDocumentCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>