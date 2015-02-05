<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class Post extends Mapper implements \MVC\Domain\PostFinder {
    function __construct() {
        parent::__construct();				
		$tblPost = "tbl_post";
		
		$selectAllStmt 	= sprintf("select * from %s", $tblPost);
		$selectStmt 	= sprintf("select *  from %s where id=?", $tblPost);
		$updateStmt 	= sprintf("update %s set id_category=?, title=?, content=?, `time`=?, `key`=?, `viewed`=?, `liked`=? where id=?", $tblPost);
		$insertStmt 	= sprintf("insert into %s ( id_category, title, content, `time`, `key`, `viewed`, `liked`) values(?, ?, ?, ?, ?, ?, ?)", $tblPost);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblPost);
		$findByKeyStmt 	= sprintf("select *  from %s where `key`=?", $tblPost);

		$findByStmt 		= sprintf("select *  from %s where id_category=:id_category order by `time` DESC", $tblPost);
		$findByPageStmt 	= sprintf("select *  from %s where id_category=:id_category order by `time` DESC LIMIT :start,:max", $tblPost);
		$findByLastestStmt 	= sprintf("select *  from %s order by `time` DESC LIMIT 6", $tblPost);
		$findByPopularStmt 	= sprintf("select *  from %s order by `viewed` DESC LIMIT 6", $tblPost);
		
		$searchByTitleStmt 		= sprintf("select *  from %s where `title` like :title", $tblPost);
		$searchByTitlePageStmt 	= sprintf("select *  from %s where `title` like :title LIMIT :start,:max", $tblPost);

		$findByDateTimeStmt = sprintf(
			"select *  
			from %s 
			where `time` >= ? AND `time` <= ?"
		, $tblPost);
		
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);
		$this->findByKeyStmt 	= self::$PDO->prepare($findByKeyStmt);
		
		$this->findByStmt 			= self::$PDO->prepare($findByStmt);
		$this->findByLastestStmt 	= self::$PDO->prepare($findByLastestStmt);
		$this->findByPopularStmt 	= self::$PDO->prepare($findByPopularStmt);
		$this->findByPageStmt 		= self::$PDO->prepare($findByPageStmt);
		$this->searchByTitleStmt 	= self::$PDO->prepare($searchByTitleStmt);
		$this->searchByTitlePageStmt= self::$PDO->prepare($searchByTitlePageStmt);
		$this->findByDateTimeStmt 	= self::$PDO->prepare($findByDateTimeStmt);
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
	
	function findByLastest( $values ){
        $this->findByLastestStmt->execute( $values );
        return new PostCollection( $this->findByLastestStmt->fetchAll(), $this);
    }
	
	function findByPopular( $values ){
        $this->findByPopularStmt->execute( $values );
        return new PostCollection( $this->findByPopularStmt->fetchAll(), $this);
    }
	
	function findByPage( $values ) {		
		$this->findByPageStmt->bindValue(':id_category', $values[0], \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new PostCollection( $this->findByPageStmt->fetchAll(), $this );
    }
	
	function findByDateTime( $values ) {		
		$this->findByDateTimeStmt->execute($values);
        return new PostCollection( $this->findByDateTimeStmt->fetchAll(), $this );
    }
}
?>