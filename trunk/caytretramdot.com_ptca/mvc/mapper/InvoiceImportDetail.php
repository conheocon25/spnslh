<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class InvoiceImportDetail extends Mapper implements \MVC\Domain\UserFinder {

    function __construct() {
        parent::__construct();
					
		$tblInvoiceImport 			= "invoice_import";
		$tblInvoiceImportDetail 	= "invoice_import_detail";
				
		$selectAllStmt = sprintf("select * from %s", $tblInvoiceImportDetail);
		$selectStmt = sprintf("select * from %s where id=?", $tblInvoiceImportDetail);
		$updateStmt = sprintf("update %s set id_invoice=?, id_good=?, count=?, price=?  where id=?", $tblInvoiceImportDetail);
		$insertStmt = sprintf("insert into %s (id_invoice, id_good, count, price) values(?, ?, ?, ?)", $tblInvoiceImportDetail);
		$deleteStmt = sprintf("delete from %s where id=?", $tblInvoiceImportDetail);
				
		$findByInvoiceStmt = sprintf("select * from %s where id_invoice=?", $tblInvoiceImportDetail);
						
		$checkStmt = sprintf("
			select 
				distinct id 
			from 
				%s 
			where 
				id_invoice=? and 
				id_good=? and 				
		", $tblInvoiceImportDetail);
				
		/*
        * Gán chuỗi vừa được xử lí cho các Statement của PDO
		* luôn đảm bảo các tiền tố được truyền đi đúng
        */
        $this->selectAllStmt = self::$PDO->prepare( $selectAllStmt);
        $this->selectStmt = self::$PDO->prepare( $selectStmt );
        $this->updateStmt = self::$PDO->prepare( $updateStmt );
        $this->insertStmt = self::$PDO->prepare( $insertStmt );
		$this->deleteStmt = self::$PDO->prepare( $deleteStmt );
                            
		$this->findByInvoiceStmt 	= self::$PDO->prepare($findByInvoiceStmt);						
		$this->checkStmt 			= self::$PDO->prepare( $checkStmt);		
		
    } 
    function getCollection( array $raw ) {return new InvoiceImportDetailCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\InvoiceImportDetail( 
			$array['id'],
			$array['id_invoice'],
			$array['id_good'], 
			$array['count'], 			
			$array['price']			
		);
        return $obj;
    }
    protected function targetClass() {return "InvoiceImportDetail";}
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
        return new InvoiceImportDetailCollection( $this->findByInvoiceStmt->fetchAll(), $this );
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