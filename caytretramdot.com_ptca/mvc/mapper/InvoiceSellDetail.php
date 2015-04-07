<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class InvoiceSellDetail extends Mapper implements \MVC\Domain\UserFinder {

    function __construct() {
        parent::__construct();
					
		$tblInvoiceSell 		= "invoice_sell";
		$tblInvoiceSellDetail 	= "invoice_sell_detail";
				
		$selectAllStmt = sprintf("select * from %s", $tblInvoiceSellDetail);
		$selectStmt = sprintf("select * from %s where id=?", $tblInvoiceSellDetail);
		$updateStmt = sprintf("update %s set id_invoice=?, id_good=?, count=?, price=?  where id=?", $tblInvoiceSellDetail);
		$insertStmt = sprintf("insert into %s (id_invoice, id_good, count, price) values(?, ?, ?, ?)", $tblInvoiceSellDetail);
		$deleteStmt = sprintf("delete from %s where id=?", $tblInvoiceSellDetail);
				
		$findByInvoiceStmt = sprintf("select * from %s where id_invoice=?", $tblInvoiceSellDetail);
						
		$checkStmt = sprintf("
			select distinct id 
			from 
				%s 
			where 
				id_invoice=? and 
				id_good=? and 				
		", $tblInvoiceSellDetail);
		
		$findByDateGoodStmt = sprintf("
			SELECT 
				*
			FROM
				invoice_sell S INNER JOIN invoice_sell_detail SD
			ON S.id = SD.id_invoice
			WHERE
				S.state>=1 AND
				date(datetime_created)=? AND id_good=?
			", $tblInvoiceSellDetail);
		
		/*
        * Gán chuỗi vừa được xử lí cho các Statement của PDO
		* luôn đảm bảo các tiền tố được truyền đi đúng
        */
        $this->selectAllStmt 		= self::$PDO->prepare( $selectAllStmt);
        $this->selectStmt 			= self::$PDO->prepare( $selectStmt );
        $this->updateStmt 			= self::$PDO->prepare( $updateStmt );
        $this->insertStmt 			= self::$PDO->prepare( $insertStmt );
		$this->deleteStmt 			= self::$PDO->prepare( $deleteStmt );
                            
		$this->findByInvoiceStmt 	= self::$PDO->prepare($findByInvoiceStmt);
		$this->findByDateGoodStmt 	= self::$PDO->prepare($findByDateGoodStmt);
		$this->checkStmt 			= self::$PDO->prepare( $checkStmt);		
		
    } 
    function getCollection( array $raw ) {return new InvoiceSellDetailCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\InvoiceSellDetail( 
			$array['id'],
			$array['id_invoice'],
			$array['id_good'], 
			$array['count'], 			
			$array['price']			
		);
        return $obj;
    }
    protected function targetClass() {return "InvoiceSellDetail";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdInvoice(),
			$object->getIdGood(),
			$object->getCount(),
			$object->getPrice()			
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdInvoice(),
			$object->getIdGood(),
			$object->getCount(),
			$object->getPrice(),
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}
    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findByInvoice( $values ) {	
        $this->findByInvoiceStmt->execute( $values );
        return new InvoiceSellDetailCollection( $this->findByInvoiceStmt->fetchAll(), $this );
    }
	
	function findByDateGood( $values ) {	
        $this->findByDateGoodStmt->execute( $values );
        return new InvoiceSellDetailCollection( $this->findByDateGoodStmt->fetchAll(), $this );
    }
		
	function check( $values ) {	
        $this->checkStmt->execute( $values );
		$result = $this->checkStmt->fetchAll();		
		if (!isset($result) || $result==null)
			return null;        
        return $result[0][0];
    }	
}
?>