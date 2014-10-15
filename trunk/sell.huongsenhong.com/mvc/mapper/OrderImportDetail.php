<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class OrderImportDetail extends Mapper implements \MVC\Domain\OrderImportDetailFinder {

    function __construct() {
        parent::__construct();
		
		$tblResource = "tbl_resource";
		$tblOrderImport = "tbl_order_import";
		$tblOrderImportDetail = "tbl_order_import_detail";
		$tblSessionDetail = "tbl_session_detail";
		$tblR2C = "tbl_r2c";
								
		$selectAllStmt = sprintf("select * from %s", $tblOrderImportDetail);
		$selectStmt = sprintf("select * from %s where id=?", $tblOrderImportDetail);
		$updateStmt = sprintf("update %s set count=?, price=? where id=?", $tblOrderImportDetail);
		$insertStmt = sprintf("insert into %s ( idorder, idresource, count, price ) values( ?, ?, ?, ?)", $tblOrderImportDetail);
		$deleteStmt = sprintf("delete from %s where id=?", $tblOrderImportDetail);
		
		$evalPriceStmt = sprintf("
			SELECT 
				avg(price) 
			FROM
				%s
			WHERE 	idresource=?
		", $tblOrderImportDetail);
		
		$trackByCountStmt = sprintf("
			select 
				sum(count)
			from 
				%s S inner join %s SD on S.id = SD.idorder
			where idresource=? and date >= ? and date <= ?
		", $tblOrderImport, $tblOrderImportDetail);		
		$trackByStmt = sprintf("
							SELECT
								IFNULL(0, ODI.id) as id,
								(?) as idorder,
								P.id as idresource,
								ODI.count,
								IFNULL(ODI.price, P.price) as price
							FROM 
							(
								SELECT *
								FROM %s
								WHERE idsupplier = ?
							) P LEFT JOIN
							(
								SELECT *
								FROM %s
								WHERE idorder = ?
							) ODI
							ON P.id = ODI.idresource
		
		", $tblResource, $tblOrderImportDetail);
		
		$trackByExportStmt = sprintf("
			select
				sum(SD.count) as count
			from
				tbl_session S inner join tbl_session_detail SD on S.id = SD.idsession
			where
				SD.idcourse IN(select id_course from tbl_r2c where id_resource=?) AND
				S.datetime >= ? AND S.datetime <= ? 
		", $tblSessionDetail, $tblR2C);
		
		
		$existStmt = sprintf("select id from %s where idorder=? and idresource=?", $tblOrderImportDetail);
		$EvaluateStmt = sprintf("select sum(count*price) from %s where idorder=?", $tblOrderImportDetail);
						
        $this->selectAllStmt = self::$PDO->prepare( $selectAllStmt);                            
        $this->selectStmt = self::$PDO->prepare( $selectStmt );
        $this->updateStmt = self::$PDO->prepare( $updateStmt );
        $this->insertStmt = self::$PDO->prepare( $insertStmt );
		$this->deleteStmt = self::$PDO->prepare( $deleteStmt );                            
		$this->trackByStmt = self::$PDO->prepare($trackByStmt);
		$this->trackByCountStmt = self::$PDO->prepare($trackByCountStmt);
		$this->trackByExportStmt = self::$PDO->prepare($trackByExportStmt);
		$this->existStmt = self::$PDO->prepare($existStmt);
		$this->EvaluateStmt = self::$PDO->prepare($EvaluateStmt);
		$this->evalPriceStmt = self::$PDO->prepare($evalPriceStmt);		
		
    } 
    function getCollection( array $raw ) {
        return new OrderImportDetailCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\OrderImportDetail( 
			$array['id'],  
			$array['idorder'], 
			$array['idresource'], 
			$array['count'],	
			$array['price']
		);
        return $obj;
    }
	
    protected function targetClass() {        
		return "OrderImportDetail";
    }

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(  
			$object->getIdOrder(), 
			$object->getIdResource(), 
			$object->getCount(),
			$object->getPrice()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate(\MVC\Domain\Object $object ) {
        $values = array( 
			$object->getCount(),
			$object->getPrice(),
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }

	protected function doDelete(array $values) {
        return $this->deleteStmt->execute( $values );
    }
	
	//-------------------------------------------------------
	function trackBy( $values ) {		
        $this->trackByStmt->execute( $values );
        return new OrderImportDetailCollection( $this->trackByStmt->fetchAll(), $this );
    }
	
	function trackByCount( $values ) {
        $this->trackByCountStmt->execute( $values );
		$result = $this->trackByCountStmt->fetchAll();		
		if (!isset($result) || $result==null)
			return 0;
        return $result[0][0];
    }
	
	function trackByExport( $values ) {
        $this->trackByExportStmt->execute( $values );
		$result1 = $this->trackByExportStmt->fetchAll();
		
		$this->trackByExportStmt->execute( $values );
		$result2 = $this->trackByExportStmt->fetchAll();
		
		if (!isset($result) || $result==null)
			return 0;
        return $result1[0][0]/$result2[0][0];
    }
	
	function exist($values) {
		$this->existStmt->execute($values);
		$result = $this->existStmt->fetchAll();
		if($result != null) {
			return $result[0][0];
		} else {
			return -1;			
		}
    }
	
	function Evaluate($values) {
		$this->EvaluateStmt->execute($values);
		$result = $this->EvaluateStmt->fetchAll();
		if($result == null) {
			return 0;
		} else {
			return $result[0][0];
		}
    }
	
	function evalPrice( $values ) {
        $this->evalPriceStmt->execute( $values );
		$result = $this->evalPriceStmt->fetchAll();		
		if (!isset($result) || $result==null)
			return 0;
        return $result[0][0];
    }
	
	//-------------------------------------------------------
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
	
}
?>