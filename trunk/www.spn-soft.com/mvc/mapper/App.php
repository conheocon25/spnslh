<?php
namespace MVC\Mapper;
use MVC\Library\Encrypted;
require_once( "mvc/base/Mapper.php" );
class App extends Mapper implements \MVC\Domain\AppFinder {

    function __construct() {
        parent::__construct();
        $this->selectAllStmt = self::$PDO->prepare( 
                            "select * from thanhlongceramic_app");
        $this->selectStmt = self::$PDO->prepare( 
                            "select * from thanhlongceramic_app where id=?");
		$this->findByStmt = self::$PDO->prepare( 
                            "select * from thanhlongceramic_app where alias=?");
		
		$this->notSignedStmt = self::$PDO->prepare("
							SELECT * 
							FROM `thanhlongceramic_app` 
							WHERE 
								id NOT IN ( 
									SELECT id_app FROM cfa_user_app
									where id_user=?
								)
							");
							
        $this->updateStmt = self::$PDO->prepare( 
                            "update thanhlongceramic_app set 
								name=?, 
								phone=?, 
								address=?, 
								email=?, 
								banner=?, 
								prefix=?, 
								alias=?, 
								date_created=?, 
								date_modified=?, 
								date_activity=?, 
								type=?,
								page_view=?
							where id=?
						");
        $this->insertStmt = self::$PDO->prepare( 
                            "insert into thanhlongceramic_app ( name, phone, address, email, banner, prefix, app, datecreate, dateupdate, dateactivity, type) values(?,?,?,?,?,?,?,?,?,?,?)");
		$this->deleteStmt = self::$PDO->prepare( 
                            "delete from thanhlongceramic_app where id=?");
		$this->checkStmt = self::$PDO->prepare( 
                            "select distinct id from thanhlongceramic_app where app=?");			
		$this->checkEmailStmt = self::$PDO->prepare( 
                            "select distinct id from thanhlongceramic_app where email=?");									
		
    } 
    function getCollection( array $raw ) {
        return new AppCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ){
        $obj = new \MVC\Domain\App(
			$array['id'],
			$array['name'],
			$array['phone'],
			$array['address'],
			$array['email'],
			$array['banner'],
			$array['prefix'],
			$array['alias'],
			$array['date_created'],
			$array['date_modified'],
			$array['date_activity'],
			$array['type'],
			$array['page_view']
		);
        return $obj;
    }

    protected function targetClass() {        
		return "App";
    }
	
	function findBy( $values ) {	
        $this->findByStmt->execute( $values );
        return new AppCollection( $this->findByStmt->fetchAll(), $this );
    }
	
	function notSigned( $values ) {	
        $this->notSignedStmt->execute( $values );
        return new AppCollection( $this->notSignedStmt->fetchAll(), $this );
    }
	
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getName(),
			$object->getPhone(),
			$object->getAddress(),
			$object->getEmail(),
			$object->getBanner(),
			$object->getPrefix(),
			$object->getAlias(),
			$object->getDateCreated(),
			$object->getDateModified(),
			$object->getDateActivity(),
			$object->getType()			
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
		
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName(),
			$object->getPhone(),
			$object->getAddress(),
			$object->getEmail(),
			$object->getBanner(),
			$object->getPrefix(),
			$object->getAlias(),
			$object->getDateCreated(),
			$object->getDateModified(),
			$object->getDateActivity(),
			$object->getType(),
			$object->getPageView(),
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }

	protected function doDelete(array $values) {
        return $this->deleteStmt->execute( $values );
    }

    function selectStmt() {
        return $this->selectStmt;
    }
    function selectAllStmt() {
        return $this->selectAllStmt;
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