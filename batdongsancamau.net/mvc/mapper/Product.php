<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class Product extends Mapper implements \MVC\Domain\ProductFinder {

    function __construct() {
        parent::__construct();
		$tblProduct 	= "tbl_product";
						
		$selectAllStmt 	= sprintf("select * from %s", $tblProduct);
		$selectStmt 	= sprintf("select * from %s where id=?", $tblProduct);
		$updateStmt 	= sprintf("update %s set idsupplier=?, idcategory=?, name=?, `datetime`=?, code=?, price1=?,price2=?,`key`=? where id=?", $tblProduct);			
		$insertStmt 	= sprintf("insert into %s ( idsupplier, idcategory, name, `datetime`,code, price1,price2,`key`) values( ?, ?, ?, ?, ?, ?, ?, ?)", $tblProduct);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblProduct);
		
		$findBySupplierStmt 		= sprintf("select * from %s where idsupplier=?  order by `datetime` DESC", $tblProduct);
		$findBySupplierPageStmt 	= sprintf("SELECT * FROM %s WHERE idsupplier=:idsupplier ORDER BY `datetime` DESC LIMIT :start,:max", $tblProduct);
		
		$findBySupplierCategoryStmt = sprintf("select * from %s where idsupplier=? AND idcategory=? order by id DESC", $tblProduct);
		$findByTopStmt 				= sprintf("select * from %s order by id DESC LIMIT 9", $tblProduct);									
		
		$findByCategoryStmt 		= sprintf("select * from %s where idcategory=? order by idcategory, name", $tblProduct);
		$findByCategoryPageStmt 	= sprintf("SELECT * FROM %s WHERE idcategory=:idcategory ORDER BY name LIMIT :start,:max", $tblProduct);
				
		$findByPageStmt 	= sprintf("SELECT * FROM %s WHERE idsupplier=:idsupplier ORDER BY id DESC LIMIT :start,:max", $tblProduct);		
		$findByPage1Stmt 	= sprintf("SELECT * FROM %s WHERE 	idsupplier=:idsupplier AND idcategory=:idcategory ORDER BY id DESC LIMIT :start,:max", $tblProduct);				
		$findByKeyStmt 		= sprintf("select *  from %s where `key`=?", $tblProduct);
				
		$findByNameStmt 	= sprintf("select * from %s where name like :name ORDER BY name", $tblProduct);
		$findByNamePageStmt = sprintf("select * from %s where name like :name ORDER BY name LIMIT :start,:max", $tblProduct);
		
		//----------------------------------------------------------------------------------------		
        $this->selectAllStmt 		= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 			= self::$PDO->prepare($selectStmt);
        $this->updateStmt 			= self::$PDO->prepare($updateStmt);
        $this->insertStmt 			= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 			= self::$PDO->prepare($deleteStmt);
						
		$this->findByTopStmt 						= self::$PDO->prepare($findByTopStmt);				
		
		$this->findBySupplierStmt 					= self::$PDO->prepare($findBySupplierStmt);
		$this->findBySupplierPageStmt 				= self::$PDO->prepare($findBySupplierPageStmt);
								
		$this->findByPageStmt 						= self::$PDO->prepare($findByPageStmt);
		$this->findByPage1Stmt 						= self::$PDO->prepare($findByPage1Stmt);
		$this->findByKeyStmt 						= self::$PDO->prepare($findByKeyStmt);
				
		$this->findByCategoryStmt 					= self::$PDO->prepare($findByCategoryStmt);
		$this->findByCategoryPageStmt 				= self::$PDO->prepare($findByCategoryPageStmt);
		
		$this->findBySupplierCategoryStmt 			= self::$PDO->prepare($findBySupplierCategoryStmt);
		
		$this->findByNameStmt 						= self::$PDO->prepare($findByNameStmt);
		$this->findByNamePageStmt 					= self::$PDO->prepare($findByNamePageStmt);
    } 
    function getCollection( array $raw ) {return new ProductCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Product( 
			$array['id'],
			$array['idsupplier'],
			$array['idcategory'],			
			$array['name'],
			$array['datetime'],				
			$array['code'],	
			$array['price1'],	
			$array['price2'],			
			$array['key']
		);
        return $obj;
    }
	
    protected function targetClass(){return "Product";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdSupplier(),
			$object->getIdCategory(),			
			$object->getName(),
			$object->getDateTime(),
			$object->getCode(),
			$object->getPrice1(),
			$object->getPrice2(),
			$object->getKey()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ){
        $values = array( 
			$object->getIdSupplier(),
			$object->getIdCategory(),			
			$object->getName(),
			$object->getDateTime(),
			$object->getCode(),
			$object->getPrice1(),
			$object->getPrice2(),
			$object->getKey(),
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}			
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findBySupplier(array $values) {
        $this->findBySupplierStmt->execute( $values );
        return new ProductCollection( $this->findBySupplierStmt->fetchAll(), $this );
    }
	function findBySupplierPage( $values ){
		$this->findBySupplierPageStmt->bindValue(':idsupplier', $values[0], \PDO::PARAM_INT);
		$this->findBySupplierPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findBySupplierPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findBySupplierPageStmt->execute();
        return new ProductCollection( $this->findBySupplierPageStmt->fetchAll(), $this );
    }
	
	function findBySupplierCategory(array $values) {
        $this->findBySupplierCategoryStmt->execute( $values );
        return new ProductCollection( $this->findBySupplierCategoryStmt->fetchAll(), $this );
    }
	
	function findByTop(array $values) {
        $this->findByTopStmt->execute( $values );
        return new ProductCollection( $this->findByTopStmt->fetchAll(), $this );
    }
		
	
	function findByPage( $values ){
		$this->findByPageStmt->bindValue(':idsupplier', $values[0], \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);		
		$this->findByPageStmt->execute();
        return new ProductCollection( $this->findByPageStmt->fetchAll(), $this );
    }
	
	function findByPage1( $values ){		
		$this->findByPage1Stmt->bindValue(':idsupplier', $values[0], \PDO::PARAM_INT);
		$this->findByPage1Stmt->bindValue(':idcategory', $values[1], \PDO::PARAM_INT);
		$this->findByPage1Stmt->bindValue(':start', ((int)($values[2])-1)*(int)($values[3]), \PDO::PARAM_INT);
		$this->findByPage1Stmt->bindValue(':max', (int)($values[3]), \PDO::PARAM_INT);		
		$this->findByPage1Stmt->execute();
        return new ProductCollection( $this->findByPage1Stmt->fetchAll(), $this );
    }
	
	function findByCategory(array $values) {
        $this->findByCategoryStmt->execute( $values );
        return new ProductCollection( $this->findByCategoryStmt->fetchAll(), $this );
    }
	
	function findByCategoryPage( $values ){		
		$this->findByCategoryPageStmt->bindValue(':idcategory', $values[0], \PDO::PARAM_INT);
		$this->findByCategoryPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByCategoryPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByCategoryPageStmt->execute();
        return new ProductCollection( $this->findByCategoryPageStmt->fetchAll(), $this );
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
				
	//TÌM CÁC SẢN PHẨM KHUYẾN MÃI					
	function findByName( $values ){
		$this->findByNameStmt->bindValue(':name', $values[0]."%", \PDO::PARAM_STR);
		$this->findByNameStmt->execute();
        return new ProductCollection( $this->findByNameStmt->fetchAll(), $this );
    }
	
	function findByNamePage( $values ){		
		$this->findByNamePageStmt->bindValue(':name', $values[0]."%", \PDO::PARAM_STR);		
		$this->findByNamePageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByNamePageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByNamePageStmt->execute();
        return new ProductCollection( $this->findByNamePageStmt->fetchAll(), $this );
    }
	
}
?>