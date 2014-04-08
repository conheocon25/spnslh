<?php
namespace MVC\Domain;

interface Finder {
    function find( $id );
    function findAll();

    function update( Object $object );
    function insert( Object $obj );
    //function delete();
}

interface UserFinder  			extends Finder {}
interface DomainFinder  		extends Finder {}
interface SolveFinder  			extends Finder {}
interface CategoryFinder  		extends Finder {}
interface ConfigFinder 			extends Finder {}
interface GuestFinder 			extends Finder {}
?>
