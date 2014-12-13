<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class CourseDefault extends Mapper implements \MVC\Domain\CourseDefaultFinder{

    function __construct() {
        parent::__construct();
		
		$tblCourseDefault 	= "tbl_course_default";	
				
		$selectAllStmt 	= sprintf("SELECT * FROM %s", $tblCourseDefault);				
		$selectStmt 	= sprintf("select * from %s where id=?", $tblCourseDefault);
		$updateStmt 	= sprintf("update %s set id_course=?, `count`=? where id=?", $tblCourseDefault);
		$insertStmt 	= sprintf("insert into %s (id_course, count) values(?, ?)", $tblCourseDefault);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblCourseDefault);
		
		$this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);						
    }
    function getCollection( array $raw ) {return new CourseDefaultCollection( $raw, $this );}
    protected function doCreateObject( array $array ){
        $obj = new \MVC\Domain\CourseDefault( 
			$array['id'],	
			$array['id_course'],
			$array['count']			
		);
        return $obj;
    }
    protected function targetClass() { return "CourseLog";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 			
			$object->getIdCourse(),
			$object->getCount()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
	    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array(			
			$object->getIdCourse(),
			$object->getCount(),			
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}
	function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}			
}
?>