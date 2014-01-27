<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class SessionDetail extends Mapper implements \MVC\Domain\UserFinder {

    function __construct() {
        parent::__construct();
			
		$tblCourse = "tbl_course";
		$tblSession = "tbl_session";
		$tblSessionDetail = "tbl_session_detail";
		$tblR2C = "tbl_r2c";
		
		$selectAllStmt = sprintf("select * from %s", $tblSessionDetail);
		$selectStmt = sprintf("select * from %s where id=?", $tblSessionDetail);
		$updateStmt = sprintf("update %s set idsession=?, idcourse=?, count=?, price=? where id=?", $tblSessionDetail);
		$insertStmt = sprintf("insert into %s (idsession, idcourse, count, price) values(?, ?, ?, ?)", $tblSessionDetail);		
		$deleteStmt = sprintf("delete from %s where id=?", $tblSessionDetail);

		$findByTop10Stmt = sprintf("
			SELECT 1 as id, 2 as idsession, idcourse, sum(count) as count, 3 as price 
				FROM `tbl_session_detail`
			GROUP BY idcourse
			ORDER BY count DESC
			LIMIT 10
		", $tblSessionDetail);
		
		$findBySessionStmt = sprintf("select * from %s where idsession=?", $tblSessionDetail);
		$findItemStmt = sprintf("select * from %s where idsession=? and idcourse=?", $tblSessionDetail);
		$evaluateStmt = sprintf("select sum(sd.count * price ) from %s sd where idsession=?", $tblSessionDetail);
		
		$checkStmt = sprintf("select distinct id from %s where idsession=? and idcourse=?", $tblSessionDetail);		
		$trackByCountStmt = sprintf("
			select 
				sum(count)
			from 
				%s S inner join %s SD on S.id = SD.idsession			
			where idcourse=? and date(datetime) >= ? and date(datetime) <= ?
		", $tblSession, $tblSessionDetail);		
		$trackByCount1Stmt = sprintf("
			select 
				sum(count)
			from 
				%s S inner join %s SD on S.id = SD.idsession			
			where idcourse=? and date(datetime) >= ? and date(datetime) <= ? and status=1
		", $tblSession, $tblSessionDetail);
		$trackByCount2Stmt = sprintf("
			select 
				sum(count)
			from 
				%s S inner join %s SD on S.id = SD.idsession			
			where idcourse=? and date(datetime) >= ? and date(datetime) <= ? and status=2
		", $tblSession, $tblSessionDetail);
		
		$trackByCategoryStmt = sprintf("
			select				
				sum(count)
			from 
				%s S inner join 
				(%s SD inner join %s C on SD.idcourse = C.id )
				on S.id = SD.idsession
			where
				C.idcategory=? AND date(S.datetime) >=? AND date(S.datetime) <=?
			group by
				C.idcategory
		", $tblSession, $tblSessionDetail, $tblCourse);
		
		
		$trackByExportStmt = sprintf("
			select			
				0 as id, 
				SD.idsession, 
				SD.idcourse, 
				SD.count as count, 
				SD.price as price
			from
				%s S inner join %s SD on S.id = SD.idsession
			where
				SD.idcourse IN(select id_course from %s where id_resource=?) AND
				S.datetime >= ? AND S.datetime <= ? 
		", $tblSession, $tblSessionDetail, $tblR2C);
		
						
		$trackByCourseStmt = sprintf("
			SELECT
				0 as id, 0 as idsession, idcourse, sum(SD.count) as count, 0 as price
			FROM
				%s S INNER JOIN %s SD
				ON S.id = SD.idsession
			WHERE
				date(datetime) >= ? AND date(datetime) <= ?
			GROUP BY
				idcourse
			ORDER BY
				count DESC
			LIMIT 10
		", $tblSession, $tblSessionDetail);
		
		/*
        * Gán chuỗi vừa được xử lí cho các Statement của PDO
		* luôn đảm bảo các tiền tố được truyền đi đúng
        */
        $this->selectAllStmt = self::$PDO->prepare( $selectAllStmt);
        $this->selectStmt = self::$PDO->prepare( $selectStmt );
        $this->updateStmt = self::$PDO->prepare( $updateStmt );
        $this->insertStmt = self::$PDO->prepare( $insertStmt );
		$this->deleteStmt = self::$PDO->prepare( $deleteStmt );
                            
		$this->findBySessionStmt 	= self::$PDO->prepare($findBySessionStmt);		
		$this->findByTop10Stmt 		= self::$PDO->prepare($findByTop10Stmt);		
		$this->findItemStmt 		= self::$PDO->prepare($findItemStmt);		
		$this->evaluateStmt 		= self::$PDO->prepare( $evaluateStmt );		
		$this->checkStmt 			= self::$PDO->prepare( $checkStmt);
		$this->trackByCountStmt 	= self::$PDO->prepare( $trackByCountStmt);
		$this->trackByCount1Stmt 	= self::$PDO->prepare( $trackByCount1Stmt);
		$this->trackByCount2Stmt 	= self::$PDO->prepare( $trackByCount2Stmt);
		$this->trackByCategoryStmt 	= self::$PDO->prepare( $trackByCategoryStmt);
		$this->trackByCourseStmt 	= self::$PDO->prepare( $trackByCourseStmt);
		$this->trackByExportStmt 	= self::$PDO->prepare( $trackByExportStmt);
		
    } 
    function getCollection( array $raw ) {return new SessionDetailCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\SessionDetail( 
			$array['id'],
			$array['idsession'],
			$array['idcourse'], 
			$array['count'], 			
			$array['price']
		);
        return $obj;
    }
    protected function targetClass() {return "SessionDetail";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdSession(),
			$object->getIdCourse(),
			$object->getCount(),
			$object->getPrice()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdSession(),
			$object->getIdCourse(),
			$object->getCount(),
			$object->getPrice(),
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}
    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findBySession( $values ) {	
        $this->findBySessionStmt->execute( $values );
        return new SessionDetailCollection( $this->findBySessionStmt->fetchAll(), $this );
    }
	function findByTop10( $values ) {	
        $this->findByTop10Stmt->execute( $values );
        return new SessionDetailCollection( $this->findByTop10Stmt->fetchAll(), $this );
    }
	
	function check( $values ) {	
        $this->checkStmt->execute( $values );
		$result = $this->checkStmt->fetchAll();		
		if (!isset($result) || $result==null)
			return null;        
        return $result[0][0];
    }
			
	function evaluate( $values ) {	
        $this->evaluateStmt->execute( $values );
		$result = $this->evaluateStmt->fetchAll();
        return $result[0][0];
    }
	
	function trackByCount( $values ){
        $this->trackByCountStmt->execute( $values );
		$result = $this->trackByCountStmt->fetchAll();		
		if (!isset($result) || $result==null)
			return null;
        return $result[0][0];
    }
	
	function trackByCount1( $values ){
        $this->trackByCount1Stmt->execute( $values );
		$result = $this->trackByCount1Stmt->fetchAll();		
		if (!isset($result) || $result==null)
			return null;
        return $result[0][0];
    }
	
	function trackByCount2( $values ){
        $this->trackByCount2Stmt->execute( $values );
		$result = $this->trackByCount2Stmt->fetchAll();		
		if (!isset($result) || $result==null)
			return null;
        return $result[0][0];
    }
	
	function trackByCategory( $values ){
        $this->trackByCategoryStmt->execute( $values );
		$result = $this->trackByCategoryStmt->fetchAll();		
		if (!isset($result) || $result==null)
			return null;
        return $result[0][0];
    }
	
	function trackByCourse( $values ) {	
        $this->trackByCourseStmt->execute( $values );
        return new SessionDetailCollection( $this->trackByCourseStmt->fetchAll(), $this );
    }
	
	function trackByExport( $values ) {	
        $this->trackByExportStmt->execute( $values );
        return new SessionDetailCollection( $this->trackByExportStmt->fetchAll(), $this );
    }
	
	function findItem( $values ) {	
        $this->findItemStmt->execute( $values );
        $array = $this->findItemStmt->fetch();
        $this->findItemStmt->closeCursor();
        if ( ! is_array( $array ) ) { return null; }
        if ( ! isset( $array['id'] ) ) { return null; }
        $object = $this->doCreateObject( $array );
        return $object;
    }
}
?>