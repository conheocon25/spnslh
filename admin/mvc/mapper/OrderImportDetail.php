<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class OrderImportDetail extends Mapper implements \MVC\Domain\OrderImportDetailFinder {

    function __construct() {
        parent::__construct();
		
		$tblResource = "tbl_resource";
		$tblOrderImport = "tbl_order_import";
		$tblOrderImportDetail = "tbl_order_import_detail";
												
		$selectAllStmt = sprintf("select * from %s", $tblOrderImportDetail);
		$selectStmt = sprintf("select * from %s where id=?", $tblOrderImportDetail);
		$updateStmt = sprintf("update %s set count=?, price=? where id=?", $tblOrderImportDetail);
		$insertStmt = sprintf("insert into %s ( idorder, idresource, count, price ) values( ?, ?, ?, ?)", $tblOrderImportDetail);
		$deleteStmt = sprintf("delete from %s where id=?", $tblOrderImportDetail);
		
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
		$existStmt = sprintf("select id from %s where idorder=? and idresource=?", $tblOrderImportDetail);
								
        $this->selectAllStmt = self::$PDO->prepare( $selectAllStmt);                            
        $this->selectStmt = self::$PDO->prepare( $selectStmt );
        $this->updateStmt = self::$PDO->prepare( $updateStmt );
        $this->insertStmt = self::$PDO->prepare( $insertStmt );
		$this->deleteStmt = self::$PDO->prepare( $deleteStmt );                            
		$this->trackByStmt = self::$PDO->prepare($trackByStmt);
		$this->existStmt = self::$PDO->prepare($existStmt);
    } 
    function getCollection( array $raw ) {return new OrderImportDetailCollection( $raw, $this );}
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
	
    protected function targetClass() {  return "OrderImportDetail";}
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
			
	//-------------------------------------------------------
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
	
}
?>