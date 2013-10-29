<?php
namespace MVC\Domain;

interface Finder {
    function find( $id );
    function findAll();

    function update( Object $object );
    function insert( Object $obj );
    //function delete();
}
interface ProjectFinder  	extends Finder {}
interface PDocumentFinder  	extends Finder {}
interface PVideoFinder  	extends Finder {}
interface PAlbumFinder  	extends Finder {}
interface PNewsFinder  		extends Finder {}
interface PProductFinder  	extends Finder {}

interface UserFinder  		extends Finder {}
interface UnitFinder 		extends Finder {}
interface ConfigFinder 		extends Finder {}
interface GuestFinder 		extends Finder {}
?>
