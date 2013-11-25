<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Project extends Mapper implements \MVC\Domain\ProjectFinder{

    function __construct() {
        parent::__construct();
				
		$tblProject = "tbl_project";
		
		$selectAllStmt = sprintf("select * from %s ORDER BY type DESC", $tblProject);
		$selectStmt = sprintf("select *  from %s where id=?", $tblProject);
		$updateStmt = sprintf("update %s set name=?, description=?, type=?, `key`=? where id=?", $tblProject);
		$insertStmt = sprintf("insert into %s ( name, description, type, `key`) values(?, ?, ?, ?)", $tblProject);
		$deleteStmt = sprintf("delete from %s where id=?", $tblProject);
						
		$findByPageStmt = sprintf(
			"SELECT 
				*
			FROM 
				%s 			
			LIMIT :start,:max"
		, $tblProject);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
				
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);

    } 
    function getCollection( array $raw ) {return new ProjectCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\Project( 
			$array['id'],
			$array['name'],
			$array['description'],
			$array['type'],
			$array['key']
		);
        return $obj;
    }

    protected function targetClass() {return "Project";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName(),
			$object->getDescription(),
			$object->getType(),
			$object->getKey()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName(),
			$object->getDescription(),			
			$object->getType(),
			$object->getKey(),
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }

	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}

    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}
				
	function findByPage( $values ) {		
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new ProjectCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>