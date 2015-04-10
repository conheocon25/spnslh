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

interface ConfigFinder 			extends Finder {}
interface GuestFinder 			extends Finder {}

interface CategoryBuddhaFinder 	extends Finder {}
interface CategoryVideoFinder 	extends Finder {}
interface VideoFinder 			extends Finder {}

interface PresentationFinder 	extends Finder {}
interface SlideFinder 			extends Finder {}

interface CategoryPostFinder 	extends Finder {}
interface PostFinder 			extends Finder {}
interface PostRssFinder 	extends Finder {}
interface RssLinkFinder 	extends Finder {}
?>