<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class News extends Mapper implements \MVC\Domain\NewsFinder {

    function __construct() {
        parent::__construct();
				
		$tblNews = "tbl_news";
		
		$selectAllStmt = sprintf("select * from %s ORDER BY type DESC, date DESC", $tblNews);
		$selectStmt = sprintf("select *  from %s where id=?", $tblNews);
		$updateStmt = sprintf("update %s set id_category=?, author=?, date=?, content=?, title=?, type=?, `key`=? where id=?", $tblNews);
		$insertStmt = sprintf("insert into %s ( id_category, author, date, content, title, type, `key`) values(?, ?, ?, ?, ?, ?, ?)", $tblNews);
		$deleteStmt = sprintf("delete from %s where id=?", $tblNews);
		$findByStmt = sprintf("select *  from %s where id_category=? ORDER BY type DESC, date DESC", $tblNews);		
		$findByKeyStmt = sprintf("select *  from %s where `key`=?", $tblNews);
		$findByLimitStmt = sprintf("select *  from %s where id_category=? ORDER BY type DESC, date DESC limit 5", $tblNews);
		$findByLimit1Stmt = sprintf("select *  from %s where id_category=? ORDER BY type DESC, date DESC limit 6", $tblNews);
		$findByLimit2Stmt = sprintf("select *  from %s where id_category=? ORDER BY type DESC, date DESC limit 12", $tblNews);
		
		$findByCategoryDateStmt = sprintf(
			"select *  
			from %s 
			where id_category=? AND date<=?
			ORDER BY type DESC, date DESC LIMIT 10"
		, $tblNews);
			
		$findByCategoryPageStmt = sprintf(
			"SELECT 
				*
			FROM 
				%s 			
			WHERE id_category=:id_category
			ORDER BY date desc			
			LIMIT :start,:max"
		, $tblNews);
		
		$findByPageStmt = sprintf("SELECT * FROM  %s ORDER BY date desc LIMIT :start,:max" , $tblNews);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByStmt = self::$PDO->prepare($findByStmt);
		$this->findByKeyStmt = self::$PDO->prepare($findByKeyStmt);
		$this->findByLimitStmt = self::$PDO->prepare($findByLimitStmt);
		$this->findByLimit1Stmt = self::$PDO->prepare($findByLimit1Stmt);
		$this->findByLimit2Stmt = self::$PDO->prepare($findByLimit2Stmt);
		
		$this->findByCategoryDateStmt = self::$PDO->prepare($findByCategoryDateStmt);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);
		$this->findByCategoryPageStmt = self::$PDO->prepare($findByCategoryPageStmt);

    } 
    function getCollection( array $raw ) {
        return new NewsCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\News( 
			$array['id'],
			$array['id_category'],
			$array['author'],
			$array['date'],
			$array['content'],
			$array['title'],
			$array['type'],
			$array['key']
		);
        return $obj;
    }

    protected function targetClass() {        
		return "News";
    }

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdCategory(),
			$object->getAuthor(),
			$object->getDate(),
			$object->getContent(),
			$object->getTitle(),
			$object->getType(),
			$object->getKey()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdCategory(),
			$object->getAuthor(),
			$object->getDate(),
			$object->getContent(),
			$object->getTitle(),
			$object->getType(),
			$object->getKey(),
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }

	protected function doDelete(array $values) {
        return $this->deleteStmt->execute( $values );
    }

    function selectStmt() {
        return $this->selectStmt;
    }
    function selectAllStmt() {
        return $this->selectAllStmt;
    }
	
	function findBy( $values ){
        $this->findByStmt->execute( $values );
        return new NewsCollection( $this->findByStmt->fetchAll(), $this);
    }
		
	function findByLimit( $values ){
        $this->findByLimitStmt->execute( $values );
        return new NewsCollection( $this->findByLimitStmt->fetchAll(), $this);
    }
	function findByLimit1( $values ){
        $this->findByLimit1Stmt->execute( $values );
        return new NewsCollection( $this->findByLimit1Stmt->fetchAll(), $this);
    }
	function findByLimit2( $values ){
        $this->findByLimit2Stmt->execute( $values );
        return new NewsCollection( $this->findByLimit2Stmt->fetchAll(), $this);
    }
	
	function findByCategoryDate( $values ){
        $this->findByCategoryDateStmt->execute( $values );
        return new NewsCollection( $this->findByCategoryDateStmt->fetchAll(), $this);
    }
	
	function findByPage( $values ) {		
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new NewsCollection( $this->findByPageStmt->fetchAll(), $this );
    }
	function findByCategoryPage( $values ) {
		$this->findByCategoryPageStmt->bindValue(':id_category', $values[0], \PDO::PARAM_INT);
		$this->findByCategoryPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByCategoryPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByCategoryPageStmt->execute();
        return new NewsCollection( $this->findByCategoryPageStmt->fetchAll(), $this );
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
}
?>