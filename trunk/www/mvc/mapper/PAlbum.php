<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class PAlbum extends Mapper implements \MVC\Domain\PAlbumFinder{

    function __construct() {
        parent::__construct();
				
		$tblPAlbum = "tbl_project_album";
		$selectAllStmt = sprintf("select * from %s date DESC", $tblPAlbum);
		$selectStmt = sprintf("select *  from %s where id=?", $tblPAlbum);
		$updateStmt = sprintf("update %s set id_project=?, name=?, date=?, description=?, `key`=? where id=?", $tblPAlbum);
		$insertStmt = sprintf("insert into %s ( id_project, name, date, description, `key`) values(?, ?, ?, ?, ?)", $tblPAlbum);
		$deleteStmt = sprintf("delete from %s where id=?", $tblPAlbum);
		$findByStmt = sprintf("select *  from %s where id_project=? ORDER BY date DESC", $tblPAlbum);
		$findByPageStmt = sprintf(
			"SELECT 
				*
			FROM 
				%s 
			WHERE id_project=:id_project
			LIMIT :start,:max"
		, $tblPAlbum);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByStmt = self::$PDO->prepare($findByStmt);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);
		
    } 
    function getCollection( array $raw ) {return new PAlbumCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\PAlbum( 
			$array['id'],
			$array['id_project'],
			$array['name'],
			$array['date'],			
			$array['description'],
			$array['key']
		);
        return $obj;
    }

    protected function targetClass() { return "PAlbum";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdProject(),
			$object->getName(),
			$object->getDate(),			
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
        return new PAlbumCollection( $this->findByStmt->fetchAll(), $this);
    }
	
	function findByPage( $values ) {
		$this->findByPageStmt->bindValue(':id_project', $values[0], \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new PAlbumCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>