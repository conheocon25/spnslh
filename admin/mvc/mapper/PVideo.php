<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class PVideo extends Mapper implements \MVC\Domain\PVideoFinder{

    function __construct() {
        parent::__construct();
				
		$tblPVideo = "tbl_project_video";		
		$selectAllStmt = sprintf("select * from %s date DESC", $tblPVideo);
		$selectStmt = sprintf("select *  from %s where id=?", $tblPVideo);
		$updateStmt = sprintf("update %s set id_project=?, name=?, date=?, url=?, description=?, `key`=? where id=?", $tblPVideo);
		$insertStmt = sprintf("insert into %s ( id_project, name, date, url, description, `key`) values(?, ?, ?, ?, ?, ?)", $tblPVideo);
		$deleteStmt = sprintf("delete from %s where id=?", $tblPVideo);
		$findByStmt = sprintf("select *  from %s where id_project=? ORDER BY date DESC", $tblPVideo);
		$findByPageStmt = sprintf(
			"SELECT 
				*
			FROM 
				%s 
			WHERE id_project=:id_project
			LIMIT :start,:max"
		, $tblPVideo);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByStmt = self::$PDO->prepare($findByStmt);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);
		
    } 
    function getCollection( array $raw ) {return new PVideoCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\PVideo( 
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

    protected function targetClass() { return "PVideo";}
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
        return new PVideoCollection( $this->findByStmt->fetchAll(), $this);
    }
	
	function findByPage( $values ) {
		$this->findByPageStmt->bindValue(':id_project', $values[0], \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new PVideoCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>