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

interface AlbumFinder  			extends Finder {}
interface ImageFinder  			extends Finder {}

interface LinkedFinder  		extends Finder {}

interface FacebookerFinder  	extends Finder {}

interface ConfigFinder 			extends Finder {}
interface GuestFinder 			extends Finder {}

interface BoardFinder 			extends Finder {}
interface BoardDetailFinder 	extends Finder {}

interface CategoryBookFinder 	extends Finder {}
interface BookFinder 			extends Finder {}
interface ChapterFinder 		extends Finder {}

interface CategoryVideoFinder 	extends Finder {}
interface VideoFinder 			extends Finder {}

interface CategoryPostFinder 	extends Finder {}
interface PostFinder 			extends Finder {}

interface PresentationFinder 	extends Finder {}
interface SlideFinder 			extends Finder {}

?>