<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Book extends Mapper implements \MVC\Domain\BookFinder{

    function __construct() {
        parent::__construct();
				
		$tblBook 			= "tbl_book";
		
		$selectAllStmt 		= sprintf("select * from %s ORDER BY `order`", $tblBook);
		$selectStmt 		= sprintf("select *  from %s where id=?", $tblBook);
		$updateStmt 		= sprintf("update %s set 
												id_category=?, 
												id_presentation=?, 
												`title`=?, 
												`time`=?, 
												`info`=?, 
												`author`=?, 
												`language`=?, 
												`order`=?, 
												`url`=?, 
												`viewed`=?, 
												`liked`=?, 
												`thumb`=?, 
												`completed`=?, 
												`key`=? 
									where 
										id=?", $tblBook);
		$insertStmt 		= sprintf("insert into %s ( 
												id_category, 
												id_presentation, 
												`title`, 
												`time`, 
												`info`, 
												`author`, 
												`language`, 
												`order`, 
												`url`, 
												`viewed`, 
												`liked`, 
												`thumb`, 
												`completed`, 
												`key`) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", $tblBook);
		$deleteStmt 		= sprintf("delete from %s where id=?", $tblBook);				
		$findByStmt 		= sprintf("select *  from %s where id_category=? ORDER BY `order`", $tblBook);
		$findByKeyStmt 		= sprintf("select *  from %s where `key`=?", $tblBook);

		$findByPageStmt 		= sprintf("SELECT * FROM  %s where id_category=:id_category ORDER BY `order` LIMIT :start,:max", $tblBook);
		$findByRecentPageStmt 	= sprintf("SELECT * FROM  %s where id_category=:id_category ORDER BY `time`  DESC LIMIT :start,:max", $tblBook);
		$findByViewedPageStmt 	= sprintf("SELECT * FROM  %s where id_category=:id_category ORDER BY `viewed` DESC LIMIT :start,:max", $tblBook);
		$findByLikedPageStmt 	= sprintf("SELECT * FROM  %s where id_category=:id_category ORDER BY `liked` DESC LIMIT :start,:max", $tblBook);
				
		$findByRecentStmt 	= sprintf("select *  from %s ORDER BY `time` DESC LIMIT 8", $tblBook);
		$findByViewedStmt 	= sprintf("select *  from %s ORDER BY `viewed` DESC LIMIT 8", $tblBook);
		$findByLikedStmt 	= sprintf("select *  from %s ORDER BY `liked` DESC LIMIT 8", $tblBook);
		$findByRandomStmt 	= sprintf("select *  from %s ORDER BY rand() LIMIT 8", $tblBook);
				
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);
		$this->findByStmt 		= self::$PDO->prepare($findByStmt);
		$this->findByKeyStmt 	= self::$PDO->prepare($findByKeyStmt);
		
		$this->findByPageStmt 	= self::$PDO->prepare($findByPageStmt);
		$this->findByRecentPageStmt = self::$PDO->prepare($findByRecentPageStmt);
		$this->findByViewedPageStmt = self::$PDO->prepare($findByViewedPageStmt);
		$this->findByLikedPageStmt = self::$PDO->prepare($findByLikedPageStmt);
		
		$this->findByRecentStmt 	= self::$PDO->prepare($findByRecentStmt);
		$this->findByViewedStmt 	= self::$PDO->prepare($findByViewedStmt);
		$this->findByLikedStmt 		= self::$PDO->prepare($findByLikedStmt);		
		$this->findByRandomStmt 	= self::$PDO->prepare($findByRandomStmt);
    }
	
    function getCollection( array $raw ) {return new BookCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\Book( 
			$array['id'],
			$array['id_category'],
			$array['id_presentation'],
			$array['title'],
			$array['time'],
			$array['info'],
			$array['author'],
			$array['language'],
			$array['order'],
			$array['url'],
			$array['viewed'],
			$array['liked'],
			$array['thumb'],
			$array['completed'],
			$array['key']
		);
        return $obj;
    }

    protected function targetClass() { return "Book";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdCategory(),
			$object->getIdPresentation(),
			$object->getTitle(),
			$object->getTime(),
			$object->getInfo(),
			$object->getAuthor(),
			$object->getLanguage(),
			$object->getOrder(),
			$object->getURL(),
			$object->getViewed(),
			$object->getLiked(),
			$object->getThumb(),
			$object->getCompleted(),
			$object->getKey()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdCategory(),
			$object->getIdPresentation(),
			$object->getTitle(),
			$object->getTime(),
			$object->getInfo(),
			$object->getAuthor(),
			$object->getLanguage(),
			$object->getOrder(),
			$object->getURL(),
			$object->getViewed(),
			$object->getLiked(),
			$object->getThumb(),
			$object->getCompleted(),
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
        return new BookCollection( $this->findByStmt->fetchAll(), $this);
    }
	
	function findByRecent( $values ){
        $this->findByRecentStmt->execute( $values );
        return new BookCollection( $this->findByRecentStmt->fetchAll(), $this);
    }
	
	function findByViewed( $values ){
        $this->findByViewedStmt->execute( $values );
        return new BookCollection( $this->findByViewedStmt->fetchAll(), $this);
    }
	
	function findByLiked( $values ){
        $this->findByLikedStmt->execute( $values );
        return new BookCollection( $this->findByLikedStmt->fetchAll(), $this);
    }
	
	function findByRandom( $values ){
        $this->findByRandomStmt->execute( $values );
        return new BookCollection( $this->findByRandomStmt->fetchAll(), $this);
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
	
	function findByPage( $values ) {
		$this->findByPageStmt->bindValue(':id_category', $values[0], \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new BookCollection( $this->findByPageStmt->fetchAll(), $this );
    }
	
	function findByRecentPage( $values ) {
		$this->findByRecentPageStmt->bindValue(':id_category', $values[0], \PDO::PARAM_INT);
		$this->findByRecentPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByRecentPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByRecentPageStmt->execute();
        return new BookCollection( $this->findByRecentPageStmt->fetchAll(), $this );
    }
	
	function findByViewedPage( $values ) {
		$this->findByViewedPageStmt->bindValue(':id_category', $values[0], \PDO::PARAM_INT);
		$this->findByViewedPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByViewedPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByViewedPageStmt->execute();
        return new BookCollection( $this->findByViewedPageStmt->fetchAll(), $this );
    }
	
	function findByLikedPage( $values ) {
		$this->findByLikedPageStmt->bindValue(':id_category', $values[0], \PDO::PARAM_INT);
		$this->findByLikedPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByLikedPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByLikedPageStmt->execute();
        return new BookCollection( $this->findByLikedPageStmt->fetchAll(), $this );
    }
	
}
?>