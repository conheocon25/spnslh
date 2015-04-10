<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class PostRss extends Mapper implements \MVC\Domain\PostRssFinder {
    function __construct() {
        parent::__construct();				
		$tblPostRss = "tbl_post_rss";
		
		$selectAllStmt 	= sprintf("select * from %s", $tblPostRss);
		$selectStmt 	= sprintf("select *  from %s where id=?", $tblPostRss);
		$updateStmt 	= sprintf("update %s set id_category=?, title=?, content=?, `time`=?, `key`=?, `viewed`=?, `liked`=? where id=?", $tblPostRss);
		$insertStmt 	= sprintf("insert into %s ( id_category, title, content, `time`, `key`, `viewed`, `liked`) values(?, ?, ?, ?, ?, ?, ?)", $tblPostRss);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblPostRss);
		$findByKeyStmt 	= sprintf("select *  from %s where `key`=?", $tblPostRss);

		$findByStmt 		= sprintf("select *  from %s where id_category=:id_category", $tblPostRss);
		$findByPageStmt 	= sprintf("select *  from %s where id_category=:id_category LIMIT :start,:max", $tblPostRss);
		
		$searchByTitleStmt 		= sprintf("select *  from %s where `title` like :title", $tblPostRss);
		$searchByTitlePageStmt 	= sprintf("select *  from %s where `title` like :title LIMIT :start,:max", $tblPostRss);
				
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);
		$this->findByKeyStmt 	= self::$PDO->prepare($findByKeyStmt);
		
		$this->findByStmt 		= self::$PDO->prepare($findByStmt);
		$this->findByPageStmt 	= self::$PDO->prepare($findByPageStmt);
		$this->searchByTitleStmt 		= self::$PDO->prepare($searchByTitleStmt);
		$this->searchByTitlePageStmt 	= self::$PDO->prepare($searchByTitlePageStmt);

    } 
    function getCollection( array $raw ) {return new PostCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\Post( 
			$array['id'],
			$array['id_category'],
			$array['title'],
			$array['content'],			
			$array['time'],
			$array['key'],
			$array['viewed'],
			$array['liked']
		);
        return $obj;
    }

    protected function targetClass() {return "Post";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 			
			$object->getIdCategory(),
			$object->getTitle(),
			$object->getContent(),			
			$object->getTime(),			
			$object->getKey(),
			$object->getViewed(),
			$object->getLiked()
		);
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdCategory(),
			$object->getTitle(),
			$object->getContent(),			
			$object->getTime(),			
			$object->getKey(),
			$object->getViewed(),
			$object->getLiked(),
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }

	protected function doDelete(array $values) {
        return $this->deleteStmt->execute( $values );
    }

    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}
		
	function findByKey( $values ) {	
		$this->findByKeyStmt->execute( array($values) );
        $array = $this->findByKeyStmt->fetch();
        $this->findByKeyStmt->closeCursor();
        if ( ! is_array( $array ) ) { return null; }
        if ( ! isset( $array['id'] ) ) { return null; }
        $object = $this->doCreateObject( $array );
        return $object;		
    }
	
	function searchByTitle( $values ) {		
		$this->searchByTitleStmt->bindValue(':title', 	"%".$values[0]."%", \PDO::PARAM_STR);
		$this->searchByTitleStmt->execute();
        return new PostCollection( $this->searchByTitleStmt->fetchAll(), $this );
    }
	
	function searchByTitlePage( $values ) {
		
		$this->searchByTitlePageStmt->bindValue(':title', "%".$values[0]."%", \PDO::PARAM_STR);
		$this->searchByTitlePageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->searchByTitlePageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->searchByTitlePageStmt->execute();
        return new PostCollection( $this->searchByTitlePageStmt->fetchAll(), $this );
    }
	
	function findBy( $values ) {		
		$this->findByStmt->bindValue(':id_category', 	$values[0], \PDO::PARAM_INT);
		$this->findByStmt->execute();
        return new PostCollection( $this->findByStmt->fetchAll(), $this );
    }
	
	function findByPage( $values ) {		
		$this->findByPageStmt->bindValue(':id_category', $values[0], \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new PostCollection( $this->findByPageStmt->fetchAll(), $this );
    }

}
?>