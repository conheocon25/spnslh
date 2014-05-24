<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class OrderImportDetail extends Mapper implements \MVC\Domain\OrderImportDetailFinder {

    function __construct() {
        parent::__construct();
		
		$tblResource = "shopc_product";
		$tblOrderImport = "shopc_order_import";
		$tblOrderImportDetail = "shopc_order_import_detail";
		$tblSessionDetail = "shopc_session_detail";
		$tblR2C = "shopc_r2c";
								
		$selectAllStmt = sprintf("select * from %s", $tblOrderImportDetail);
		$selectStmt = sprintf("select * from %s where id=?", $tblOrderImportDetail);
		$updateStmt = sprintf("update %s set count=?, price=? where id=?", $tblOrderImportDetail);
		$insertStmt = sprintf("insert into %s ( idorder, idproduct, count, price ) values( ?, ?, ?, ?)", $tblOrderImportDetail);
		$deleteStmt = sprintf("delete from %s where id=?", $tblOrderImportDetail);
		
		$findTopStmt = sprintf("
							SELECT
								0 as id,
								1 as idorder,
								idproduct,
								sum(`count`) as count,
								price
							FROM 
								%s
							GROUP BY idproduct
							ORDER BY count DESC
							LIMIT 8
		
		", $tblOrderImportDetail);
		
		$evalPriceStmt = sprintf("
			SELECT 
				avg(price) 
			FROM
				%s
			WHERE 	idproduct=?
		", $tblOrderImportDetail);
		
		$trackByCountStmt = sprintf("
			select 
				sum(count)
			from 
				%s S inner join %s SD on S.id = SD.idorder
			where idproduct=? and date >= ? and date <= ?
		", $tblOrderImport, $tblOrderImportDetail);		
		$trackByStmt = sprintf("
							SELECT
								IFNULL(0, ODI.id) as id,
								(?) as idorder,
								P.id as idproduct,
								ODI.count,
								IFNULL(ODI.price, P.price1) as price
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
							ON P.id = ODI.idproduct
		
		", $tblResource, $tblOrderImportDetail);
		
		$trackByExportStmt = sprintf("
			select
				sum(SD.count) as count
			from
				shopc_session S inner join shopc_session_detail SD on S.id = SD.idsession
			where
				SD.idcourse IN(select id_course from shopc_r2c where id_resource=?) AND
				S.datetime >= ? AND S.datetime <= ? 
		", $tblSessionDetail, $tblR2C);
		
		
		$existStmt = sprintf("select id from %s where idorder=? and idproduct=?", $tblOrderImportDetail);
		$EvaluateStmt = sprintf("select sum(count*price) from %s where idorder=?", $tblOrderImportDetail);
						
        $this->selectAllStmt 	= self::$PDO->prepare( $selectAllStmt);                            
        $this->selectStmt 		= self::$PDO->prepare( $selectStmt );
        $this->updateStmt 		= self::$PDO->prepare( $updateStmt );
        $this->insertStmt 		= self::$PDO->prepare( $insertStmt );
		$this->deleteStmt 		= self::$PDO->prepare( $deleteStmt );                            
		$this->trackByStmt 		= self::$PDO->prepare($trackByStmt);
		$this->trackByCountStmt = self::$PDO->prepare($trackByCountStmt);
		$this->trackByExportStmt = self::$PDO->prepare($trackByExportStmt);
		$this->existStmt 		= self::$PDO->prepare($existStmt);
		$this->EvaluateStmt 	= self::$PDO->prepare($EvaluateStmt);
		$this->evalPriceStmt 	= self::$PDO->prepare($evalPriceStmt);
		$this->findTopStmt 		= self::$PDO->prepare($findTopStmt);
		
    } 
    function getCollection( array $raw ) {
        return new OrderImportDetailCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\OrderImportDetail( 
			$array['id'],  
			$array['idorder'], 
			$array['idproduct'], 
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
			$object->getIdProduct(), 
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
	
	function findTop( $values ){
        $this->findTopStmt->execute( $values );
        return new OrderImportDetailCollection( $this->findTopStmt->fetchAll(), $this );
    }
	
	//-------------------------------------------------------
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
	
}
?>