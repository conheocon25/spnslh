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

interface PostFinder 			extends Finder {}
interface ConfigFinder 			extends Finder {}
interface GuestFinder 			extends Finder {}

interface BoardFinder 			extends Finder {}
interface BoardDetailFinder 	extends Finder {}

interface CategoryBookFinder 	extends Finder {}
interface BookFinder 			extends Finder {}
interface CategoryBoardFinder 	extends Finder {}
interface CategoryPostFinder 	extends Finder {}
?>