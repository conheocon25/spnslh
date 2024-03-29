<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Course extends Mapper implements \MVC\Domain\CourseFinder{

    function __construct() {
        parent::__construct();
		
		$tblCourse 		= "tbl_course";
						
		$selectAllStmt 	= sprintf("select * from %s order by `rank`", $tblCourse);
		$selectStmt 	= sprintf("select * from %s where id=?", $tblCourse);
		$updateStmt 	= sprintf("update %s set id_cook_method=?, name=?, datetime_created=?, datetime_updated=?, `rank`=?, `key`=? where id=?", $tblCourse);
		$insertStmt 	= sprintf("insert into %s ( id_cook_method, name, datetime_created, datetime_updated, `rank`, `key`) values(?, ?, ?, ?, ?, ?)", $tblCourse);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblCourse);
		$findByPageStmt = sprintf("SELECT * FROM  %s ORDER BY `order`, name	LIMIT :start,:max", $tblCourse);
		$findByKeyStmt 	= sprintf("select *  from %s where `key`=?", $tblCourse);		
				
        $this->selectAllStmt 		= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 			= self::$PDO->prepare($selectStmt);
        $this->updateStmt 			= self::$PDO->prepare($updateStmt);
        $this->insertStmt 			= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 			= self::$PDO->prepare($deleteStmt);
		$this->findByPageStmt 		= self::$PDO->prepare($findByPageStmt);
		$this->findByKeyStmt 		= self::$PDO->prepare($findByKeyStmt);							
		
		
    } 
    function getCollection( array $raw ) {return new CourseCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Course( 
			$array['id'],
			$array['id_cook_method'],
			$array['name'],
			$array['datetime_created'],
			$array['datetime_updated'],
			$array['rank'],			
			$array['key']
		);
        return $obj;
    }
	
    protected function targetClass() {  return "Course";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdCookMethod(),
			$object->getName(),
			$object->getDateTimeCreated(),
			$object->getDateTimeUpdated(),
			$object->getRank(),
			$object->getKey()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdCookMethod(),
			$object->getName(),
			$object->getDateTimeCreated(),
			$object->getDateTimeUpdated(),
			$object->getRank(),
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
        return new CourseCollection( $this->findByPageStmt->fetchAll(), $this );
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