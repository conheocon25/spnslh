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
interface UserTagFinder  		extends Finder {}
interface TagFinder 			extends Finder {}
interface LinkedFinder  		extends Finder {}
interface PostFinder 			extends Finder {}
interface PostTagFinder 		extends Finder {}
interface PostLinkedFinder 		extends Finder {}
interface PostMapFinder 		extends Finder {}
interface ConfigFinder 			extends Finder {}
interface GuestFinder 			extends Finder {}
interface ProvinceFinder 		extends Finder {}
interface DistrictFinder 		extends Finder {}

interface CBMFinder 			extends Finder {}
interface CBMDetailFinder 		extends Finder {}
interface CategoryBookFinder 	extends Finder {}
interface BookFinder 			extends Finder {}
interface CategoryBoardFinder 	extends Finder {}
?>