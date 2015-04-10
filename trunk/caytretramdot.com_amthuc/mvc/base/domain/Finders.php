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

interface ConfigFinder 			extends Finder {}
interface GuestFinder 			extends Finder {}

interface CourseFinder 			extends Finder {}
interface CookMethodFinder 		extends Finder {}

interface VideoFinder 			extends Finder {}
interface PostFinder 			extends Finder {}

?>