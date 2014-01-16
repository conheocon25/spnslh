<?php
namespace MVC\Mapper;
use MVC\Library\Encrypted;
require_once("mvc/base/Registry.php");
require_once("mvc/base/Exceptions.php");
require_once("mvc/base/domain/Finders.php");
require_once("mvc/domain.php" );
date_default_timezone_set('Asia/Ho_Chi_Minh');		
//error_reporting ('E_ALL | E_STRICT');

//Default Value: E_ALL & ~E_NOTICE
//Development Value: E_ALL | E_STRICT
//Production Value: E_ALL & ~E_DEPRECATED
//error_reporting ('E_ALL & ~E_DEPRECATED');

abstract class Mapper implements \MVC\Domain\Finder {
    protected static $PDO;
    function __construct() { 
        if ( ! isset(self::$PDO) ) { 
            
			$dsn = "mysql:host=localhost;";
			$dbname = "dbname=spnsoft_system";			
			$user = "spnsoft_userdb";
			$pass = "admin068198";
			
            if ( is_null( $dsn ) ) {
                throw new \MVC\Base\AppException( "No DSN" );
            }
            self::$PDO = new \PDO( $dsn . $dbname, $user, $pass, array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", \PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true) );
            self::$PDO->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			
        }
    }

    private function getFromMap( $id ) {
        return \MVC\Domain\ObjectWatcher::exists
                ( $this->targetClass(), $id );
    }

    private function addToMap( \MVC\Domain\Object $obj ) {
        return \MVC\Domain\ObjectWatcher::add( $obj );
    }
				
    function find( $id ) {
        $old = $this->getFromMap( $id );
        if ( $old ) { return $old; }
        $this->selectstmt()->execute( array( $id ) );
        $array = $this->selectstmt()->fetch( ); 
        $this->selectstmt()->closeCursor( );
        if ( ! is_array( $array ) ) { return null; }
        if ( ! isset( $array['id'] ) ) { return null; }
        $object = $this->createObject( $array );
        $object->markClean();
        return $object; 
    }

    function findAll( ) {		
        $this->selectAllStmt()->execute( array() );
        return $this->getCollection( $this->selectAllStmt()->fetchAll( \PDO::FETCH_ASSOC ) );
    }
 
    function createObject( $array ) {
        $old = $this->getFromMap( $array['id']);
        if ( $old ) { return $old; }
        $obj = $this->doCreateObject( $array );
        $this->addToMap( $obj );
        $obj->markClean();
        return $obj;
    }

    function insert( \MVC\Domain\Object $obj ) {
        $this->doInsert( $obj );
        $this->addToMap( $obj );
        $obj->markClean();
    }
	function update( \MVC\Domain\Object $obj ) {
        $this->doUpdate( $obj );
        $this->addToMap( $obj );
        $obj->markClean();
    }
	function delete( array $obj ) {
        $this->doDelete( $obj ); 		
    }
    protected abstract function getCollection( array $raw );
    protected abstract function doCreateObject( array $array );
    protected abstract function doInsert( \MVC\Domain\Object $object );
	protected abstract function doUpdate( \MVC\Domain\Object $object );
	protected abstract function doDelete( array $value );
    protected abstract function targetClass();
    protected abstract function selectStmt( );	
    protected abstract function selectAllStmt( ); 
	
}
?>