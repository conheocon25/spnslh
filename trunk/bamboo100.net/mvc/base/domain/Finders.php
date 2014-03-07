<?php
namespace MVC\Domain;

interface Finder {
    function find( $id );
    function findAll();

    function update( Object $object );
    function insert( Object $obj );
    //function delete();
}

interface CafeFinder  			extends Finder {}
interface PagodaFinder  		extends Finder {}

interface CChessFinder  		extends Finder {}
interface CBookFinder  			extends Finder {}
interface CSetFinder  			extends Finder {}
interface CStepFinder  			extends Finder {}

interface PostFinder  			extends Finder {}
interface UserFinder  			extends Finder {}
interface ConfigFinder 			extends Finder {}
interface GuestFinder 			extends Finder {}

?>