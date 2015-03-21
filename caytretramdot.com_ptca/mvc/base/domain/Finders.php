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
interface TypeAccountFinder  	extends Finder {}

interface InvoiceSellFinder  		extends Finder {}
interface InvoiceSellDetailFinder  	extends Finder {}

interface GoodGroupFinder  		extends Finder {}
interface GoodFinder  			extends Finder {}

interface CustomerGroupFinder  	extends Finder {}
interface CustomerFinder  		extends Finder {}

interface EmployeeFinder  		extends Finder {}
interface DepartmentFinder  	extends Finder {}

interface SupplierFinder  		extends Finder {}
interface WarehouseFinder  		extends Finder {}

interface ConfigFinder 			extends Finder {}
interface GuestFinder 			extends Finder {}

?>