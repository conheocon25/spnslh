<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class NewsProject extends Mapper implements \MVC\Domain\NewsProjectFinder {

    function __construct() {
        parent::__construct();
				
		$tblNewsProject = "saigonlandhouse_news_project";
		
		$selectAllStmt = sprintf("select * from %s ORDER BY type DESC, date DESC", $tblNewsProject);
		$selectStmt = sprintf("select *  from %s where id=?", $tblNewsProject);
		$updateStmt = sprintf("update %s set id_project=?, date=?, content=?, title=?, type=? where id=?", $tblNewsProject);
		$insertStmt = sprintf("insert into %s ( id_project, date, content, title, type) values(?, ?, ?, ?, ?)", $tblNewsProject);
		$deleteStmt = sprintf("delete from %s where id=?", $tblNewsProject);
		$findByStmt = sprintf("select *  from %s where id_project=? ORDER BY type DESC, date DESC", $tblNewsProject);
		$findByProjectDateStmt = sprintf(
			"select *  
			from %s 
			where id_project=? AND date<=?
			ORDER BY type DESC, date DESC LIMIT 10"
		, $tblNewsProject);
			
		$findByProjectPageStmt = sprintf(
			"SELECT 
				*
			FROM 
				%s 			
			WHERE id_project=:id_project
			ORDER BY date desc			
			LIMIT :start,:max"
		, $tblNewsProject);
		
		$findByPageStmt = sprintf(
			"SELECT 
				*
			FROM 
				%s 			
			ORDER BY date desc
			LIMIT :start,:max"
		, $tblNewsProject);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByStmt = self::$PDO->prepare($findByStmt);				
		$this->findByProjectDateStmt = self::$PDO->prepare($findByProjectDateStmt);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);
		$this->findByProjectPageStmt = self::$PDO->prepare($findByProjectPageStmt);
		
    } 
    function getCollection( array $raw ) {
        return new NewsProjectCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\NewsProject( 
			$array['id'],
			$array['id_project'],			
			$array['date'],
			$array['content'],
			$array['title'],
			$array['type']
		);
        return $obj;
    }

    protected function targetClass() {        
		return "NewsProject";
    }

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdProject(),			
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
			$object->getIdProject(),			
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
        return new NewsProjectCollection( $this->findByStmt->fetchAll(), $this);
    }
	
	function findByCategoryDate( $values ){
        $this->findByProjectDateStmt->execute( $values );
        return new NewsProjectCollection( $this->findByProjectDateStmt->fetchAll(), $this);
    }
	
	function findByPage( $values ) {		
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new NewsProjectCollection( $this->findByPageStmt->fetchAll(), $this );
    }
	function findByCategoryPage( $values ) {
		$this->findByProjectPageStmt->bindValue(':id_project', $values[0], \PDO::PARAM_INT);
		$this->findByProjectPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByProjectPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByProjectPageStmt->execute();
        return new NewsProjectCollection( $this->findByProjectPageStmt->fetchAll(), $this );
    }
}
?>
