<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Category extends Mapper implements \MVC\Domain\CategoryFinder {

    function __construct() {
        parent::__construct();			
		$tblCategory = "tbl_category";
		
		$selectAllStmt 			= sprintf("select * from %s ORDER BY name", 						$tblCategory);
		$selectStmt 			= sprintf("select *  from %s where id=?", 							$tblCategory);
		$updateStmt 			= sprintf("update %s set name=?, picture=?, enable=? where id=?", 	$tblCategory);
		$insertStmt 			= sprintf("insert into %s ( name, picture, enable) values(?, ?, ?)",$tblCategory);
		$deleteStmt 			= sprintf("delete from %s where id=?", 								$tblCategory);
		$findByPageStmt 		= sprintf("SELECT * FROM  %s ORDER BY name LIMIT :start,:max", 		$tblCategory);
		$findSellingStmt 		= sprintf("SELECT * FROM  %s WHERE enable=1", 						$tblCategory);
		
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);
		$this->findByPageStmt 	= self::$PDO->prepare($findByPageStmt);
		$this->findSellingStmt 	= self::$PDO->prepare($findSellingStmt);
		
    } 
    function getCollection( array $raw ) {return new CategoryCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\Category( 
			$array['id'], 
			$array['name'],
			$array['picture'],
			$array['enable']
		);
        return $obj;
    }

    protected function targetClass() {return "Category";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName(),
			$object->getPicture(),
			$object->getEnable()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName(),
			$object->getPicture(),
			$object->getEnable(),
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }

	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}	
    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findSelling($values ){
        $this->findSellingStmt->execute( $values );
        return new CourseCollection( $this->findSellingStmt->fetchAll(), $this );
    }
	
	function findByPage( $values ) {
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new CategoryCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>