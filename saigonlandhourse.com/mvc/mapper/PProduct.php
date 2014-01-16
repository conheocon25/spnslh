<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class PProduct extends Mapper implements \MVC\Domain\PProductFinder{

    function __construct() {
        parent::__construct();
				
		$tblPProduct = "tbl_project_product";
		$selectAllStmt = sprintf("select * from %s date DESC", $tblPProduct);
		$selectStmt = sprintf("select *  from %s where id=?", $tblPProduct);
		$updateStmt = sprintf("update %s set id_project=?, name=?, date=?, description=?, `key`=? where id=?", $tblPProduct);
		$insertStmt = sprintf("insert into %s ( id_project, name, date, description, `key`) values(?, ?, ?, ?, ?)", $tblPProduct);
		$deleteStmt = sprintf("delete from %s where id=?", $tblPProduct);
		$findByStmt = sprintf("select *  from %s where id_project=? ORDER BY date DESC", $tblPProduct);
		$findByPageStmt = sprintf(
			"SELECT 
				*
			FROM 
				%s 
			WHERE id_project=:id_project
			LIMIT :start,:max"
		, $tblPProduct);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByStmt = self::$PDO->prepare($findByStmt);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);
		
    } 
    function getCollection( array $raw ) {return new PProductCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\PProduct( 
			$array['id'],
			$array['id_project'],
			$array['name'],
			$array['date'],			
			$array['description'],
			$array['key']
		);
        return $obj;
    }

    protected function targetClass() { return "PProduct";}
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
        return new PProductCollection( $this->findByStmt->fetchAll(), $this);
    }
	
	function findByPage( $values ) {
		$this->findByPageStmt->bindValue(':id_project', $values[0], \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new PProductCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>