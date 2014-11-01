<?php
namespace MVC\Domain;

interface Finder {
    function find( $id );
    function findAll();

    function update( Object $object );
    function insert( Object $obj );
    //function delete();
}

interface AlbumFinder  			extends Finder {}
interface ImageFinder  			extends Finder {}
interface VideoFinder  			extends Finder {}
interface LinkedFinder  		extends Finder {}
interface UserFinder  			extends Finder {}
interface CategoryFinder  		extends Finder {}
interface Category1Finder  		extends Finder {}
interface TagFinder 			extends Finder {}
interface PostTagFinder 		extends Finder {}
interface ConfigFinder 			extends Finder {}
interface GuestFinder 			extends Finder {}
interface PostFinder 			extends Finder {}

?>
