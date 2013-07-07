<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class ProjectVideo extends Mapper implements \MVC\Domain\ProjectVideoFinder{

    function __construct() {
        parent::__construct();
				
		$tblProjectVideo = "saigonlandhouse_project_video";
		
		$selectAllStmt = sprintf("select * from %s ORDER BY type DESC, date DESC", $tblProjectVideo);
		$selectStmt = sprintf("select *  from %s where id=?", $tblProjectVideo);
		$updateStmt = sprintf("update %s set id_project=?, date=?, content=?, title=?, type=? where id=?", $tblProjectVideo);
		$insertStmt = sprintf("insert into %s ( id_project, date, content, title, type) values(?, ?, ?, ?, ?)", $tblProjectVideo);
		$deleteStmt = sprintf("delete from %s where id=?", $tblProjectVideo);
		$findByStmt = sprintf("select *  from %s where id_project=? ORDER BY date DESC", $tblProjectVideo);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByStmt = self::$PDO->prepare($findByStmt);
		
    } 
    function getCollection( array $raw ) {
        return new ProjectVideoCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\ProjectVideo( 
			$array['id'],
			$array['id_project'],
			$array['name'],
			$array['date'],
			$array['url'],
			$array['description']
		);
        return $obj;
    }

    protected function targetClass() {        
		return "ProjectVideo";
    }

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdProject(),
			$object->getName(),
			$object->getDate(),
			$object->getURL(),
			$object->getDescription()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 			
			$object->getIdProject(),
			$object->getName(),
			$object->getDate(),
			$object->getURL(),
			$object->getDescription(),
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
        return new ProjectVideoCollection( $this->findByStmt->fetchAll(), $this);
    }
	
}
?>
