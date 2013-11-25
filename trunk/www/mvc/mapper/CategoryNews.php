<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class CategoryNews extends Mapper implements \MVC\Domain\CategoryNewsFinder{

    function __construct() {
        parent::__construct();
				
		$tblCategoryNews = "tbl_category_news";
		
		$selectAllStmt = sprintf("select * from %s ORDER BY `order`", $tblCategoryNews);
		$selectStmt = sprintf("select *  from %s where id=?", $tblCategoryNews);
		$updateStmt = sprintf("update %s set name=?, `order`=?, `key`=? where id=?", $tblCategoryNews);
		$insertStmt = sprintf("insert into %s (name, `order`, `key`) values(?, ?, ?)", $tblCategoryNews);
		$deleteStmt = sprintf("delete from %s where id=?", $tblCategoryNews);
		$findByPageStmt = sprintf("SELECT * FROM  %s ORDER BY `order` LIMIT :start,:max", $tblCategoryNews);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);
    } 
    function getCollection( array $raw ) {
        return new CategoryNewsCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\CategoryNews( 
			$array['id'],
			$array['name'],
			$array['order'],
			$array['key']
		);
        return $obj;
    }

    protected function targetClass() {        
		return "CategoryNews";
    }

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getName(),
			$object->getOrder(),
			$object->getKey()
		);
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName(),
			$object->getOrder(),
			$object->getKey(),
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }

	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}

    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findByPage( $values ) {		
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new CategoryNewsCollection( $this->findByPageStmt->fetchAll(), $this );
    }
	
}
?>