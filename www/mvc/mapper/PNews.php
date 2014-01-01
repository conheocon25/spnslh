<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class PNews extends Mapper implements \MVC\Domain\PNewsFinder{

    function __construct() {
        parent::__construct();
				
		$tblPNews = "tbl_project_news";
		$selectAllStmt = sprintf("select * from %s ORDER BY date DESC", $tblPNews);
		$selectStmt = sprintf("select *  from %s where id=?", $tblPNews);
		$updateStmt = sprintf("update %s set id_project=?, name=?, date=?, description=?, `key`=? where id=?", $tblPNews);
		$insertStmt = sprintf("insert into %s ( id_project, name, date, description, `key`) values(?, ?, ?, ?, ?)", $tblPNews);
		$deleteStmt = sprintf("delete from %s where id=?", $tblPNews);
		$findByStmt = sprintf("select *  from %s where id_project=? ORDER BY date DESC", $tblPNews);
		$findByPageStmt = sprintf(
			"SELECT 
				*
			FROM 
				%s 
			WHERE id_project=:id_project
			LIMIT :start,:max"
		, $tblPNews);
		$findByKeyStmt = sprintf("select *  from %s where `key`=?", $tblPNews);
		$getFirstStmt = sprintf("select * from %s ORDER BY date DESC LIMIT 1", $tblPNews);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByStmt = self::$PDO->prepare($findByStmt);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);
		$this->findByKeyStmt = self::$PDO->prepare($findByKeyStmt);
		$this->getFirstStmt = self::$PDO->prepare($getFirstStmt);
		
    } 
    function getCollection( array $raw ) {return new PNewsCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\PNews( 
			$array['id'],
			$array['id_project'],
			$array['name'],
			$array['date'],			
			$array['description'],
			$array['key']
		);
        return $obj;
    }

    protected function targetClass() { return "PNews";}
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
        return new PNewsCollection( $this->findByStmt->fetchAll(), $this);
    }
	
	function findByKey( $values ) {	
		$this->findByKeyStmt->execute( array($values) );
        $array = $this->findByKeyStmt->fetch();
        $this->findByKeyStmt->closeCursor();
        if ( ! is_array( $array ) ) { return null; }
        if ( ! isset( $array['id'] ) ) { return null; }
        $object = $this->doCreateObject( $array );
        return $object;		
    }
	
	function getFirst(){
        $this->getFirstStmt->execute();
        $array = $this->getFirstStmt->fetch();
        $this->getFirstStmt->closeCursor();
        if ( ! is_array( $array ) ) { return null; }
        if ( ! isset( $array['id'] ) ) { return null; }
        $object = $this->doCreateObject( $array );
        return $object;
    }
	
	function findByPage( $values ) {
		$this->findByPageStmt->bindValue(':id_project', $values[0], \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new PNewsCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>