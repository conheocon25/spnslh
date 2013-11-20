<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class News extends Mapper implements \MVC\Domain\NewsFinder{

    function __construct() {
        parent::__construct();
				
		$tblNews = "tbl_news";
		$selectAllStmt = sprintf("select * from %s date DESC", $tblNews);
		$selectStmt = sprintf("select *  from %s where id=?", $tblNews);
		$updateStmt = sprintf("update %s set id_category=?, name=?, date=?, description=?, `key`=? where id=?", $tblNews);
		$insertStmt = sprintf("insert into %s ( id_category, name, date, description, `key`) values(?, ?, ?, ?, ?)", $tblNews);
		$deleteStmt = sprintf("delete from %s where id=?", $tblNews);
		$findByStmt = sprintf("select *  from %s where id_category=? ORDER BY date DESC", $tblNews);
		$findByPageStmt = sprintf(
			"SELECT 
				*
			FROM 
				%s 
			WHERE id_category=:id_category
			LIMIT :start,:max"
		, $tblNews);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByStmt = self::$PDO->prepare($findByStmt);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);
		
    } 
    function getCollection( array $raw ) {return new NewsCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\News( 
			$array['id'],
			$array['id_category'],
			$array['name'],
			$array['date'],			
			$array['description'],
			$array['key']
		);
        return $obj;
    }

    protected function targetClass() { return "News";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdCategory(),
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
			$object->getIdCategory(),
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
        return new NewsCollection( $this->findByStmt->fetchAll(), $this);
    }
	
	function findByPage( $values ) {
		$this->findByPageStmt->bindValue(':id_category', $values[0], \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new NewsCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>