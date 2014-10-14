<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class ProductInfo extends Mapper implements \MVC\Domain\ProductInfoFinder {

    function __construct() {
        parent::__construct();
		$tblProductInfo = "res_product_info";
						
		$selectAllStmt = sprintf("select * from %s", $tblProductInfo);
		$selectStmt = sprintf("select * from %s where id=?", $tblProductInfo);
		$updateStmt = sprintf("update %s set 
				idproduct=?,
				image1=?,
				image2=?,
				info=? 
			where id=?", $tblProductInfo);
			
		$insertStmt = sprintf("insert into %s ( 
					idproduct, 
					image1, 					
					image2,
					info					
				) 
				values( ?, ?, ?, ?)", $tblProductInfo);
		$deleteStmt = sprintf("delete from %s where id=?", $tblProductInfo);
		$existStmt 	= sprintf("select id from %s where idproduct=? ", $tblProductInfo);
				
        $this->selectAllStmt 		= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 			= self::$PDO->prepare($selectStmt);
        $this->updateStmt 			= self::$PDO->prepare($updateStmt);
        $this->insertStmt 			= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 			= self::$PDO->prepare($deleteStmt);
		$this->existStmt 			= self::$PDO->prepare($existStmt);
    } 
    function getCollection( array $raw ) {return new ProductInfoCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\ProductInfo( 
			$array['id'],
			$array['idproduct'],
			$array['image1'],
			$array['image2'],
			$array['info']						
		);
        return $obj;
    }
	
    protected function targetClass(){return "ProductInfo";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdProduct(),
			$object->getImage1(),
			$object->getImage2(),
			$object->getInfo()					
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ){
        $values = array( 
			$object->getIdProduct(),
			$object->getImage1(),
			$object->getImage2(),
			$object->getInfo(),
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}			
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findBySupplier(array $values) {
        $this->findBySupplierStmt->execute( $values );
        return new ProductInfoCollection( $this->findBySupplierStmt->fetchAll(), $this );
    }
	
	function findByTop(array $values) {
        $this->findByTopStmt->execute( $values );
        return new ProductInfoCollection( $this->findByTopStmt->fetchAll(), $this );
    }
	
	function findByCategory(array $values) {
        $this->findByCategoryStmt->execute( $values );
        return new ProductInfoCollection( $this->findByCategoryStmt->fetchAll(), $this );
    }
	
	function findByPage( $values ){
		$this->findByPageStmt->bindValue(':idsupplier', $values[0], \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);		
		$this->findByPageStmt->execute();
        return new ProductInfoCollection( $this->findByPageStmt->fetchAll(), $this );
    }
	
	function findByCategoryPage( $values ){		
		$this->findByCategoryPageStmt->bindValue(':idcategory', $values[0], \PDO::PARAM_INT);
		$this->findByCategoryPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByCategoryPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByCategoryPageStmt->execute();
        return new ProductInfoCollection( $this->findByCategoryPageStmt->fetchAll(), $this );
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
	
	function findByName( $values ) {
		$this->findByNameStmt->bindValue(':name', $values[0]."%", \PDO::PARAM_STR);
		$this->findByNameStmt->execute();
        return new ProductInfoCollection( $this->findByNameStmt->fetchAll(), $this );
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
}
?>