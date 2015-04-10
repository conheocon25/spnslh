<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Video extends Mapper implements \MVC\Domain\VideoFinder{
    function __construct() {
        parent::__construct();				
		$tblVideo 			= "tbl_video";
		
		$selectAllStmt 		= sprintf("select * from %s ORDER BY `order`", $tblVideo);
		$selectStmt 		= sprintf("select *  from %s where id=?", $tblVideo);
		$updateStmt 		= sprintf("update %s set 
										id_course=?, 
										`name`=?, 																						
										`datetime_created`=?,
										`datetime_updated`=?,
										`id_youtube`=?,
										`note`=? 
									where 
										id=?", $tblVideo);
		$insertStmt 		= sprintf("insert into %s ( 
										id_course, 
										`name`, 										
										`datetime_created`, 
										`datetime_updated`, 
										`id_youtube`, 										
										`note`) values(?, ?, ?, ?, ?, ?)", $tblVideo);
		$deleteStmt 		= sprintf("delete from %s where id=?", $tblVideo);				
		$findByCourseStmt 	= sprintf("select *  from %s where id_course=?", $tblVideo);
		$findByKeyStmt 		= sprintf("select *  from %s where `key`=?", $tblVideo);
		
		$findByPageStmt 			= sprintf("SELECT * FROM  %s where id_course=:id_course ORDER BY `viewed` DESC, 'liked' DESC LIMIT :start,:max", $tblVideo);
		$findByOrderNamePageStmt 	= sprintf("SELECT * FROM  %s where id_course=:id_course ORDER BY `title` LIMIT :start,:max", $tblVideo);
		$findByOrderViewedPageStmt 	= sprintf("SELECT * FROM  %s where id_course=:id_course ORDER BY `viewed` DESC  LIMIT :start,:max", $tblVideo);
		$findByOrderLikedPageStmt 	= sprintf("SELECT * FROM  %s where id_course=:id_course ORDER BY `liked` DESC LIMIT :start,:max", $tblVideo);
		
		$findByLastestStmt 	= sprintf("			
			SELECT * 
				FROM `tbl_video` 
				WHERE 
					id_course IN (SELECT id FROM tbl_category_video CV WHERE CV.id_buddha=?)
				ORDER BY
					`time`	DESC
				LIMIT 12	
		", $tblVideo);
		
		$findByPopularStmt 	= sprintf("			
			SELECT * 
			FROM `tbl_video` 
			WHERE 
				id_course IN (SELECT id FROM tbl_category_video CV WHERE CV.id_buddha=?)
			ORDER BY
				`viewed` DESC, `liked` DESC
			LIMIT 12	
		", $tblVideo);
				
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);
		$this->findByCourseStmt 		= self::$PDO->prepare($findByCourseStmt);
		$this->findByKeyStmt 	= self::$PDO->prepare($findByKeyStmt);
		$this->findByPageStmt 	= self::$PDO->prepare($findByPageStmt);
		$this->findByOrderNamePageStmt 		= self::$PDO->prepare($findByOrderNamePageStmt);
		$this->findByOrderViewedPageStmt 	= self::$PDO->prepare($findByOrderViewedPageStmt);
		$this->findByOrderLikedPageStmt 	= self::$PDO->prepare($findByOrderLikedPageStmt);
		$this->findByLastestStmt 	= self::$PDO->prepare($findByLastestStmt);
		$this->findByPopularStmt 	= self::$PDO->prepare($findByPopularStmt);
		
    } 
    function getCollection( array $raw ) {return new VideoCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\Video( 
			$array['id'],
			$array['id_course'],
			$array['name'],			
			$array['datetime_created'],
			$array['datetime_updated'],
			$array['id_youtube'],			
			$array['note']
		);
        return $obj;
    }

    protected function targetClass() { return "Video";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdCourse(),
			$object->getName(),			
			$object->getDateTimeCreated(),
			$object->getDateTimeUpdated(),
			$object->getIdYouTube(),
			$object->getNote()
		); 
		print_r($values);
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdCourse(),
			$object->getName(),			
			$object->getDateTimeCreated(),
			$object->getDateTimeUpdated(),
			$object->getIdYouTube(),
			$object->getNote(),
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}
    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findByCourse( $values ){
        $this->findByCourseStmt->execute( $values );
        return new VideoCollection( $this->findByCourseStmt->fetchAll(), $this);
    }
	
	function findByLastest( $values ){
        $this->findByLastestStmt->execute( $values );
        return new VideoCollection( $this->findByLastestStmt->fetchAll(), $this);
    }
	
	function findByPopular( $values ){
        $this->findByPopularStmt->execute( $values );
        return new VideoCollection( $this->findByPopularStmt->fetchAll(), $this);
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
		$this->findByPageStmt->bindValue(':id_course', $values[0], \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new VideoCollection( $this->findByPageStmt->fetchAll(), $this );
    }		
}
?>