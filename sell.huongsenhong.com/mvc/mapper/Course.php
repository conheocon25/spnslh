<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Course extends Mapper implements \MVC\Domain\CourseFinder {

    function __construct() {
        parent::__construct();
		$tblCourse = "tbl_course";
		$tblSessionDetail = "tbl_session_detail";
		
		$selectAllStmt = sprintf("select * from %s ORDER BY name", $tblCourse);
		$selectStmt = sprintf("select * from %s where id=?", $tblCourse);
		$updateStmt = sprintf("update %s set idcategory=?, name=?, shortname=?, unit=?, price1=?, price2=?, price3=?, price4=?, picture=?, prepare=?, is_discount=?, enable=? where id=?", $tblCourse);
		$insertStmt = sprintf("insert into %s (idcategory, name, shortname, unit, price1, price2, price3, price4, picture, prepare, is_discount, enable) 
							values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", $tblCourse);
		$deleteStmt = sprintf("delete from %s where id=?", $tblCourse);
		$findByPageStmt = sprintf("
							SELECT *
							FROM %s
							WHERE idcategory=:idcategory
							LIMIT :start,:max
				", $tblCourse);
				
		$findByCategoryStmt = sprintf("select * from %s where idcategory=? ORDER BY name", $tblCourse);
		$findTop20Stmt = sprintf("SELECT
								C.id, 
								C.idcategory, 
								C.name, 
								C.shortname, 
								C.unit, 
								C.price1, 
								C.price2, 
								C.price3, 
								C.price4,
								C.picture, 
								sum(SD.count) as count,
								C.prepare,
								C.is_discount
							FROM 
								 %s C LEFT JOIN %s SD
								 ON C.id = SD.idcourse
							GROUP BY C.id
							ORDER BY count DESC
							LIMIT 20
							" , $tblCourse, $tblSessionDetail);
		$findByNameStmt = sprintf("select * from %s where name like :name ORDER BY name LIMIT 12", $tblCourse);
		
		$this->selectAllStmt 		= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 			= self::$PDO->prepare($selectStmt);
        $this->updateStmt 			= self::$PDO->prepare($updateStmt);
        $this->insertStmt 			= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 			= self::$PDO->prepare($deleteStmt);		
		$this->findByCategoryStmt 	= self::$PDO->prepare($findByCategoryStmt);		
		$this->findTop20Stmt 		= self::$PDO->prepare($findTop20Stmt);
		$this->findByPageStmt 		= self::$PDO->prepare($findByPageStmt);
		$this->findByNameStmt 		= self::$PDO->prepare($findByNameStmt);
        
    } 
    function getCollection( array $raw ) {return new CourseCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\Course( 
			$array['id'],
			$array['idcategory'],
			$array['name'],
			$array['shortname'],
			$array['unit'],
			$array['price1'],
			$array['price2'],
			$array['price3'],
			$array['price4'],
			$array['picture'],
			$array['prepare'],
			$array['is_discount'],
			$array['enable']
		);
        return $obj;
    }
    protected function targetClass() {return "Course";}
    protected function doInsert( \MVC\Domain\Object $object ){
        $values = array( 
			$object->getIdCategory(),
			$object->getName(),
			$object->getShortName(),
			$object->getUnit(),
			$object->getPrice1(),
			$object->getPrice2(),
			$object->getPrice3(),
			$object->getPrice4(),
			$object->getPicture(),
			$object->getPrepare(),
			$object->getIsDiscount(),
			$object->getEnable()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
	    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdCategory(),
			$object->getName(),
			$object->getShortName(),
			$object->getUnit(),
			$object->getPrice1(),
			$object->getPrice2(),
			$object->getPrice3(),
			$object->getPrice4(),
			$object->getPicture(),
			$object->getPrepare(),
			$object->getIsDiscount(),
			$object->getEnable(),
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }

	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}	
	function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findByCategory( $values ) {
        $this->findByCategoryStmt->execute( $values );
		return new CourseCollection( $this->findByCategoryStmt->fetchAll(), $this );
    }	
	function findTop20($values ){
        $this->findTop20Stmt->execute( $values );
        return new CourseCollection( $this->findTop20Stmt->fetchAll(), $this );
    }
	
	function findByPage( $values ) {		
		$this->findByPageStmt->bindValue(':idcategory', $values[0], \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);		
		$this->findByPageStmt->execute();
        return new CourseCollection( $this->findByPageStmt->fetchAll(), $this );
    }
	
	function findByName( $values ) {		
		$this->findByNameStmt->bindValue(':name', $values[0]."%", \PDO::PARAM_STR);
		$this->findByNameStmt->execute();
        return new CourseCollection( $this->findByNameStmt->fetchAll(), $this );
    }	
}
?>