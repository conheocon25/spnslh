<?php
namespace MVC\Domain;
require_once( "mvc/base/Registry.php" );

class ObjectWatcher {
    private $all = array();
    private $dirty = array();
    private $new = array();
    private $delete = array();
    private static $instance;

    private function __construct() { }

    static function instance() {
        if ( ! self::$instance ) {
            self::$instance = new ObjectWatcher();
        }
        return self::$instance;
    }
 
    function globalKey( Object $obj ) {
        $key = get_class( $obj ).".".$obj->getId();
        return $key;
    }
  
    static function add( Object $obj ) {
        $inst = self::instance();
        $inst->all[$inst->globalKey( $obj )] = $obj;
    }

    static function exists( $classname, $id ) {
        $inst = self::instance();
        $key = "$classname.$id";
        if ( isset( $inst->all[$key] ) ) {
            return $inst->all[$key];
        }
        return null;
    }
 
    static function addDelete( Object $obj ) {
        $self = self::instance();
        $self->delete[$self->globalKey( $obj )] = $obj;
    }


    static function addDirty( Object $obj ) {
        $inst = self::instance();
        if ( ! in_array( $obj, $inst->new, true ) ) {
            $inst->dirty[$inst->globalKey( $obj )] = $obj;
        }
    }

    static function addNew( Object $obj ) {
        $inst = self::instance();
        // we don't yet have an id
        $inst->new[] = $obj;
    }

    static function addClean(Object $obj ) {
        $self = self::instance();
        unset( $self->delete[$self->globalKey( $obj )] );
        unset( $self->dirty[$self->globalKey( $obj )] );
        if ( in_array( $obj, $self->new, true ) ) {
            $pruned=array();
            foreach ( $self->new as $newobj ) {
                if ( ! ( $newobj === $obj) ) { 
                    $pruned[]=$newobj;
                }
            }  
            $self->new = $pruned;
        }
    }

    function performOperations() {
        foreach ( $this->dirty as $key=>$obj ) {
            $obj->finder()->update( $obj );
        }
        foreach ( $this->new as $key=>$obj ) {
            $obj->finder()->insert( $obj );
        }
        $this->dirty = array();
        $this->new = array();
    } 

/*
    function __destruct() {
        $this->performOperations();
    }
*/
}
