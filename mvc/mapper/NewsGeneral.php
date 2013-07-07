<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class NewsGeneral extends Mapper implements \MVC\Domain\NewsGeneralFinder {

    function __construct() {
        parent::__construct();
				
		$tblNewsGeneral = "saigonlandhouse_news_general";
		
		$selectAllStmt = sprintf("select * from %s ORDER BY type DESC, date DESC", $tblNewsGeneral);
		$selectStmt = sprintf("select *  from %s where id=?", $tblNewsGeneral);
		$updateStmt = sprintf("update %s set id_category=?, date=?, content=?, title=?, type=? where id=?", $tblNewsGeneral);
		$insertStmt = sprintf("insert into %s ( id_category, date, content, title, type) values(?, ?, ?, ?, ?)", $tblNewsGeneral);
		$deleteStmt = sprintf("delete from %s where id=?", $tblNewsGeneral);
		$findByStmt = sprintf("select *  from %s where id_category=? ORDER BY type DESC, date DESC", $tblNewsGeneral);
		$findByCategoryDateStmt = sprintf(
			"select *  
			from %s 
			where id_category=? AND date<=?
			ORDER BY type DESC, date DESC LIMIT 10"
		, $tblNewsGeneral);
			
		$findByCategoryPageStmt = sprintf(
			"SELECT 
				*
			FROM 
				%s 			
			WHERE id_category=:id_category
			ORDER BY date desc			
			LIMIT :start,:max"
		, $tblNewsGeneral);
		
		$findByPageStmt = sprintf(
			"SELECT 
				*
			FROM 
				%s 			
			ORDER BY date desc
			LIMIT :start,:max"
		, $tblNewsGeneral);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByStmt = self::$PDO->prepare($findByStmt);				
		$this->findByCategoryDateStmt = self::$PDO->prepare($findByCategoryDateStmt);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);
		$this->findByCategoryPageStmt = self::$PDO->prepare($findByCategoryPageStmt);
		
    } 
    function getCollection( array $raw ) {
        return new NewsGeneralCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\NewsGeneral( 
			$array['id'],
			$array['id_category'],			
			$array['date'],
			$array['content'],
			$array['title'],
			$array['type']
		);
        return $obj;
    }

    protected function targetClass() {        
		return "NewsGeneral";
    }

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdCategory(),			
			$object->getDate(),
			$object->getContent(),
			$object->getTitle(),
			$object->getType()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdCategory(),			
			$object->getDate(),
			$object->getContent(),
			$object->getTitle(),
			$object->getType(),
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
        return new NewsGeneralCollection( $this->findByStmt->fetchAll(), $this);
    }
	
	function findByCategoryDate( $values ){
        $this->findByCategoryDateStmt->execute( $values );
        return new NewsGeneralCollection( $this->findByCategoryDateStmt->fetchAll(), $this);
    }
	
	function findByPage( $values ) {		
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new NewsGeneralCollection( $this->findByPageStmt->fetchAll(), $this );
    }
	function findByCategoryPage( $values ) {
		$this->findByCategoryPageStmt->bindValue(':id_category', $values[0], \PDO::PARAM_INT);
		$this->findByCategoryPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByCategoryPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByCategoryPageStmt->execute();
        return new NewsGeneralCollection( $this->findByCategoryPageStmt->fetchAll(), $this );
    }
}
?>
