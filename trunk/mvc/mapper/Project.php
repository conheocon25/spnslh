<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class Project extends Mapper implements \MVC\Domain\ProjectFinder {

    function __construct() {
        parent::__construct();
				
		$tblProject = "saigonlandhouse_project";
		
		$selectAllStmt = sprintf("select * from %s ORDER BY type DESC, date DESC", $tblProject);
		$selectStmt = sprintf("select *  from %s where id=?", $tblProject);
		$updateStmt = sprintf("update %s set id_category=?, date=?, content=?, title=?, type=?, url_price=? where id=?", $tblProject);
		$insertStmt = sprintf("insert into %s ( id_category, date, content, title, type, url_price) values(?, ?, ?, ?, ?, ?)", $tblProject);
		$deleteStmt = sprintf("delete from %s where id=?", $tblProject);
		$findVIPStmt = sprintf("select *  from %s where type=1 ORDER BY date DESC", $tblProject);
		$findByStmt = sprintf("select *  from %s where id_category=? ORDER BY type DESC, date DESC", $tblProject);
		$findByLimitStmt = sprintf("select *  from %s where id_category=? ORDER BY type DESC, date DESC limit 10", $tblProject);
		$findByPageStmt = sprintf(
			"SELECT 
				*
			FROM 
				%s 
			WHERE id_category=:id_category
			ORDER BY date desc
			LIMIT :start,:max"
		, $tblProject);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findVIPStmt = self::$PDO->prepare($findVIPStmt);
		$this->findByStmt = self::$PDO->prepare($findByStmt);
		$this->findByLimitStmt = self::$PDO->prepare($findByLimitStmt);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);

    } 
    function getCollection( array $raw ) {return new ProjectCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\Project( 
			$array['id'],
			$array['id_category'],			
			$array['date'],
			$array['content'],
			$array['title'],
			$array['type'],
			$array['url_price']
		);
        return $obj;
    }

    protected function targetClass() {return "Project";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdCategory(),			
			$object->getDate(),
			$object->getContent(),
			$object->getTitle(),
			$object->getType(),
			$object->getURLPrice()
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
			$object->getURLPrice(),
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }

	protected function doDelete(array $values) {
        return $this->deleteStmt->execute( $values );
    }

    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findVIP( $values ){
        $this->findVIPStmt->execute( $values );
        return new ProjectCollection( $this->findVIPStmt->fetchAll(), $this);
    }
	
	function findBy( $values ){
        $this->findByStmt->execute( $values );
        return new ProjectCollection( $this->findByStmt->fetchAll(), $this);
    }
		
	function findByLimit( $values ){
        $this->findByLimitStmt->execute( $values );
        return new ProjectCollection( $this->findByLimitStmt->fetchAll(), $this);
    }
	function findByPage( $values ) {
		$this->findByPageStmt->bindValue(':id_category', (int)($values[0]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new ProjectCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>
