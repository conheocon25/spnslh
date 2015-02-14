<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Chapter extends Mapper implements \MVC\Domain\ChapterFinder{

    function __construct() {
        parent::__construct();				
		$tblChapter 		= "tbl_chapter";
		
		$selectAllStmt 		= sprintf("select * from %s ORDER BY `order`", $tblChapter);
		$selectStmt 		= sprintf("select *  from %s where id=?", $tblChapter);
		$updateStmt 		= sprintf("update %s set 
										id_book=?, 
										`title`=?, 												
										`info`=?, 												
										`completed`=?, 												
										`key`=? 
									where 
										id=?", $tblChapter);
		$insertStmt 		= sprintf("insert into %s ( 
										id_book, 
										`title`, 
										`info`, 
										`completed`, 
										`key`) values(?, ?, ?, ?, ?)", $tblChapter);
		$deleteStmt 		= sprintf("delete from %s where id=?", $tblChapter);				
		$findByStmt 		= sprintf("select *  from %s where id_book=? ORDER BY `title`", $tblChapter);
		$findByKeyStmt 		= sprintf("select *  from %s where `key`=?", $tblChapter);
		$findByPageStmt 	= sprintf("SELECT * FROM  %s where id_category=:id_category ORDER BY `order` LIMIT :start,:max", $tblChapter);
				
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);
		$this->findByStmt 		= self::$PDO->prepare($findByStmt);
		$this->findByKeyStmt 	= self::$PDO->prepare($findByKeyStmt);
		$this->findByPageStmt 	= self::$PDO->prepare($findByPageStmt);
		
    } 
    function getCollection( array $raw ) {return new ChapterCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\Chapter( 
			$array['id'],
			$array['id_book'],
			$array['title'],
			$array['info'],
			$array['completed'],
			$array['key']
		);
        return $obj;
    }

    protected function targetClass() { return "Chapter";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdBook(),
			$object->getTitle(),
			$object->getInfo(),
			$object->getCompleted(),
			$object->getKey()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdBook(),
			$object->getTitle(),			
			$object->getInfo(),
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
        return new ChapterCollection( $this->findByStmt->fetchAll(), $this);
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
        return new ChapterCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>