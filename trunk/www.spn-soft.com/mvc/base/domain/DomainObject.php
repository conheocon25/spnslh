<?php
namespace MVC\Domain;

require_once( "mvc/base/domain/Collections.php" );
require_once( "mvc/base/domain/ObjectWatcher.php" );
require_once( "mvc/base/domain/HelperFactory.php" );
require_once( "mvc/base/Library.php" );

abstract class Object {
    private $id = -1;

    function __construct( $id=null ) {
        if ( is_null( $id ) ) {
            $this->markNew();
        } else {
            $this->id = $id;
        }
    }

    function markNew() {
        ObjectWatcher::addNew( $this );
    }

    function markDeleted() {
        ObjectWatcher::addDelete( $this );
    }

    function markDirty() {
        ObjectWatcher::addDirty( $this );
    }

    function markClean() {
        ObjectWatcher::addClean( $this );
    }


    function getId( ) {
        return $this->id;
    }

    static function getCollection( $type ) {
        return HelperFactory::getCollection( $type ); 
    }
 
    function collection() {
        return self::getCollection( get_class( $this ) );
    }

    function finder() {
        return self::getFinder( get_class( $this ) );
    }

    static function getFinder( $type ) {
        return HelperFactory::getFinder( $type ); 
    }

    function setId( $id ) {
        $this->id = $id;
    }

    function __clone() {
        $this->id = -1;
    }
}
?>
