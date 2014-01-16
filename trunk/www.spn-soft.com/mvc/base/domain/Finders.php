<?php
namespace MVC\Domain;

interface Finder {
    function find( $id );
    function findAll();

    function update( Object $obj );
    function insert( Object $obj );
    //function delete();
}

interface AppFinder  extends Finder {}
interface UserFinder  extends Finder {}
interface GuestFinder  extends Finder{}
interface TechnicalFinder  extends Finder {}
interface SolutionFinder  extends Finder {}
interface ServiceFinder  extends Finder {}
interface ProjectFinder  extends Finder {}
interface CustomerStoryFinder  extends Finder {}
?>