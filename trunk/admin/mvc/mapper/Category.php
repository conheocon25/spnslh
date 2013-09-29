<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class Category extends Mapper implements \MVC\Domain\CategoryFinder {

    function __construct() {
        parent::__construct();
				
		$tblCategory = "demo1_category";
		
		$selectAllStmt = sprintf("select * from %s ORDER BY name", $tblCategory);
		$selectStmt = sprintf("select *  from %s where id=?", $tblCategory);
		$updateStmt = sprintf("update %s set name=?, picture=? where id=?", $tblCategory);
		$insertStmt = sprintf("insert into %s ( name, picture) values(?, ?)", $tblCategory);
		$deleteStmt = sprintf("delete from %s where id=?", $tblCategory);
		$findByPageStmt = sprintf("SELECT * FROM  %s LIMIT :start,:max", $tblCategory);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);
		
    } 
    function getCollection( array $raw ) {
        return new CategoryCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\Category( 
			$array['id'], 
			$array['name'],
			$array['picture'] 
			);
        return $obj;
    }

    protected function targetClass() {        
		return "Category";
    }

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName(),
			$object->getPicture()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName(),
			$object->getPicture(),
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }

	protected function doDelete(array $values) {
        return $this->deleteStmt->execute( $values );
    }
	
    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findByPage( $values ) {
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new CategoryCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>