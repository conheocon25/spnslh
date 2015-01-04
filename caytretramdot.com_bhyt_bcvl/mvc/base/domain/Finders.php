<?php
namespace MVC\Domain;

interface Finder {
    function find( $id );
    function findAll();

    function update( Object $object );
    function insert( Object $obj );
    //function delete();
}

interface AppFinder  			extends Finder {}
interface UserFinder  			extends Finder {}
interface DomainFinder  		extends Finder {}
interface TableFinder  			extends Finder {}
interface StudentTempFinder  	extends Finder {}
interface ConfigFinder 			extends Finder {}
interface TrackingFinder 		extends Finder {}
interface GuestFinder 			extends Finder {}
?>
