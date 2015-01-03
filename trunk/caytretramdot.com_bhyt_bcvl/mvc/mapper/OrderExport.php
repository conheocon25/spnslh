<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class OrderExport extends Mapper implements \MVC\Domain\OrderExportFinder {

    function __construct() {
        parent::__construct();
		
		$tblOrderExport = "tbl_order_export";
		$tblOrderExportDetail = "tbl_order_export_detail";
								
		$selectAllStmt = sprintf("select * from %s", $tblOrderExport);
		$selectStmt = sprintf("select * from %s where id=?", $tblOrderExport);
		$updateStmt = sprintf("update %s set idsupplier=?, date=?, description=? where id=?", $tblOrderExport);
		$insertStmt = sprintf("insert into %s ( idsupplier, date, description ) values( ?, ?, ?)", $tblOrderExport);
		$deleteStmt = sprintf("delete from %s where id=?", $tblOrderExport);
		$findByStmt = sprintf("
			select 
				*
			from 
				%s 
			where idsupplier=?
			order by date DESC
		", $tblOrderExport);
				
		$findByTrackingStmt = sprintf("
			select
				*
			from 
				%s
			where
				date >= ? AND date <= ?
			order by 
				date DESC
			"
		, $tblOrderExport);
		
		$findByTracking1Stmt = sprintf("
			select
				*
			from 
				%s
			where
				idsupplier=? AND date >= ? AND date <= ?
			order by 
				date DESC
			"
		, $tblOrderExport);
		
		$findByPageStmt = sprintf("
							SELECT * 
							FROM %s 							 
							WHERE idsupplier=:idsupplier
							ORDER BY date desc
							LIMIT :start,:max
				", $tblOrderExport);
										
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare( $selectStmt );
        $this->updateStmt = self::$PDO->prepare( $updateStmt );
        $this->insertStmt = self::$PDO->prepare( $insertStmt );
		$this->deleteStmt = self::$PDO->prepare( $deleteStmt );
		$this->findByStmt = self::$PDO->prepare( $findByStmt );		
		$this->findByTrackingStmt = self::$PDO->prepare( $findByTrackingStmt );
		$this->findByTracking1Stmt = self::$PDO->prepare( $findByTracking1Stmt );
		$this->findByPageStmt = self::$PDO->prepare( $findByPageStmt );		
    }
	
    function getCollection( array $raw ) {
        return new OrderExportCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\OrderExport( 
			$array['id'],  
			$array['idsupplier'], 
			$array['date'],	
			$array['description']
		);
        return $obj;
    }
	
    protected function targetClass() {        
		return "OrderExport";
    }

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(  
			$object->getIdSupplier(), 
			$object->getDate(),
			$object->getDescription()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdSupplier(), 
			$object->getDate(),
			$object->getDescription(),
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }

	protected function doDelete(array $values) {
        return $this->deleteStmt->execute( $values );
    }
	
	//-------------------------------------------------------
	function findBy(array $values) {
        $this->findByStmt->execute( $values );
        return new OrderExportCollection( $this->findByStmt->fetchAll(), $this );
    }
		
	function findByTracking(array $values){
        $this->findByTrackingStmt->execute( $values );
        return new OrderExportCollection( $this->findByTrackingStmt->fetchAll(), $this );
    }
	
	function findByTracking1(array $values){
        $this->findByTracking1Stmt->execute( $values );
        return new OrderExportCollection( $this->findByTracking1Stmt->fetchAll(), $this );
    }
	
	function findByPage( $values ) {		
		$this->findByPageStmt->bindValue(':idsupplier', $values[0], \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);		
		$this->findByPageStmt->execute();
        return new OrderExportCollection( $this->findByPageStmt->fetchAll(), $this );
    }
	
	//-------------------------------------------------------
    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}
	
}
?>