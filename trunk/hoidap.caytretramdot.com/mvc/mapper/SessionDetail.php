<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class SessionDetail extends Mapper implements \MVC\Domain\UserFinder {

    function __construct() {
        parent::__construct();
			
		$tblCourse 			= "tbl_course";
		$tblSession 		= "tbl_session";
		$tblSessionDetail 	= "tbl_session_detail";
		$tblR2C 			= "tbl_r2c";
		
		$selectAllStmt = sprintf("select * from %s", $tblSessionDetail);
		$selectStmt = sprintf("select * from %s where id=?", $tblSessionDetail);
		$updateStmt = sprintf("update %s set idsession=?, idcourse=?, count=?, price=?, `enable`=? where id=?", $tblSessionDetail);
		$insertStmt = sprintf("insert into %s (idsession, idcourse, count, price, `enable`) values(?, ?, ?, ?, ?)", $tblSessionDetail);
		$deleteStmt = sprintf("delete from %s where id=?", $tblSessionDetail);

		$findByTop10Stmt = sprintf("
			SELECT 1 as id, 2 as idsession, idcourse, sum(count) as count, 3 as price, 1 as `enable`
				FROM `tbl_session_detail`
			GROUP BY idcourse
			ORDER BY count DESC
			LIMIT 10
		", $tblSessionDetail);
		
		$findBySession1Stmt = sprintf("select * from %s where idsession=? AND `enable`=1", $tblSessionDetail);
		$findBySession2Stmt = sprintf("select * from %s where idsession=?", $tblSessionDetail);
		$findBySessionStmt = sprintf("
				SELECT
					SD.id,
					idsession,
					idcourse,
					count,
					price,
					N.order,
					SD.enable
				FROM 
					%s SD inner join (
						SELECT 
							COU.id as id,
							CAT.order as `order`
						FROM 
							tbl_category CAT inner join tbl_course COU on CAT.id=COU.idcategory
						ORDER BY CAT.order
					) as N 
					on SD.idcourse = N.id
				WHERE 
					idsession=? AND SD.enable=1
				ORDER BY N.order
		", $tblSessionDetail);
		
		$findBySession3Stmt = sprintf("
				SELECT
					SD.id,
					idsession,
					idcourse,
					count,
					price,
					N.order,
					SD.enable
				FROM 
					%s SD inner join (
						SELECT 
							COU.id as id,
							CAT.order as `order`
						FROM 
							tbl_category CAT inner join tbl_course COU on CAT.id=COU.idcategory
						ORDER BY CAT.order
					) as N 
					on SD.idcourse = N.id
				WHERE 
					idsession=? AND SD.enable=1 AND price>0
				ORDER BY N.order
		", $tblSessionDetail);
		
		$findBySession4Stmt = sprintf("
				SELECT
					SD.id,
					idsession,
					idcourse,
					count,
					price,
					N.order,
					SD.enable
				FROM 
					%s SD inner join (
						SELECT 
							COU.id as id,
							CAT.order as `order`
						FROM 
							tbl_category CAT inner join tbl_course COU on CAT.id=COU.idcategory
						ORDER BY CAT.order
					) as N 
					on SD.idcourse = N.id
				WHERE 
					idsession=? AND SD.enable=1 AND price=0
				ORDER BY N.order
		", $tblSessionDetail);
		
		$findItemStmt = sprintf("select * from %s where idsession=? and idcourse=?", $tblSessionDetail);
		$evaluateStmt = sprintf("select sum(sd.count * price ) from %s sd where idsession=?", $tblSessionDetail);
		
		$checkStmt = sprintf("select distinct id from %s where idsession=? and idcourse=? and enable=1", $tblSessionDetail);
		$trackByCountStmt = sprintf("
			select 
				sum(count*SD.enable)
			from 
				%s S inner join %s SD on S.id = SD.idsession			
			where idcourse=? and date(datetime) >= ? and date(datetime) <= ?
		", $tblSession, $tblSessionDetail);		
		$trackByCount1Stmt = sprintf("
			select 
				sum(count*SD.enable)
			from 
				%s S inner join %s SD on S.id = SD.idsession			
			where idcourse=? and date(datetime) >= ? and date(datetime) <= ? and status=1
		", $tblSession, $tblSessionDetail);
		$trackByCount2Stmt = sprintf("
			select 
				sum(count*SD.enable)
			from 
				%s S inner join %s SD on S.id = SD.idsession			
			where idcourse=? and date(datetime) >= ? and date(datetime) <= ? and status=2
		", $tblSession, $tblSessionDetail);
		
		$trackByCategoryStmt = sprintf("
			select
				sum(count*SD.enable)
			from 
				%s S inner join 
				(%s SD inner join %s C on SD.idcourse = C.id )
				on S.id = SD.idsession
			where
				C.idcategory=? AND date(S.datetime) >=? AND date(S.datetime) <=?
			group by
				C.idcategory
		", $tblSession, $tblSessionDetail, $tblCourse);
		
		$trackByCategoryValueStmt = sprintf("
			select
				sum(count*price*SD.enable)
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
				0 as id, 0 as idsession, idcourse, sum(SD.count*SD.enable) as count, 0 as price
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
		$this->findBySession1Stmt 	= self::$PDO->prepare($findBySession1Stmt);
		$this->findBySession2Stmt 	= self::$PDO->prepare($findBySession2Stmt);
		$this->findBySession3Stmt 	= self::$PDO->prepare($findBySession3Stmt);
		$this->findBySession4Stmt 	= self::$PDO->prepare($findBySession4Stmt);
		
		$this->findByTop10Stmt 		= self::$PDO->prepare($findByTop10Stmt);		
		$this->findItemStmt 		= self::$PDO->prepare($findItemStmt);		
		$this->evaluateStmt 		= self::$PDO->prepare( $evaluateStmt );		
		$this->checkStmt 			= self::$PDO->prepare( $checkStmt);
		$this->trackByCountStmt 	= self::$PDO->prepare( $trackByCountStmt);
		$this->trackByCount1Stmt 	= self::$PDO->prepare( $trackByCount1Stmt);
		$this->trackByCount2Stmt 	= self::$PDO->prepare( $trackByCount2Stmt);
		$this->trackByCategoryStmt 	= self::$PDO->prepare( $trackByCategoryStmt);
		$this->trackByCategoryValueStmt 	= self::$PDO->prepare( $trackByCategoryValueStmt);
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
			$array['price'],
			$array['enable']
		);
        return $obj;
    }
    protected function targetClass() {return "SessionDetail";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdSession(),
			$object->getIdCourse(),
			$object->getCount(),
			$object->getPrice(),
			$object->getEnable()
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
			$object->getEnable(),
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
	
	function findBySession1( $values ){
        $this->findBySession1Stmt->execute( $values );
        return new SessionDetailCollection( $this->findBySession1Stmt->fetchAll(), $this );
    }
	
	function findBySession2( $values ){
        $this->findBySession2Stmt->execute( $values );
        return new SessionDetailCollection( $this->findBySession2Stmt->fetchAll(), $this );
    }
	
	function findBySession3( $values ){
        $this->findBySession3Stmt->execute( $values );
        return new SessionDetailCollection( $this->findBySession3Stmt->fetchAll(), $this );
    }
	
	function findBySession4( $values ){
        $this->findBySession4Stmt->execute( $values );
        return new SessionDetailCollection( $this->findBySession4Stmt->fetchAll(), $this );
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
	
	function trackByCategoryValue( $values ){
        $this->trackByCategoryValueStmt->execute( $values );
		$result = $this->trackByCategoryValueStmt->fetchAll();
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