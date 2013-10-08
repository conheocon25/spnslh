<?php
namespace MVC\Mapper;
require_once( "mvc/base/domain/Collections.php");
require_once( "mvc/base/mapper/Collection.php");

class AppCollection extends Collection implements \MVC\Domain\AppCollection {function targetClass( ) {return "\MVC\Domain\App";}}
class CollectGeneralCollection extends Collection implements \MVC\Domain\CollectGeneralCollection{function targetClass( ) {return "\MVC\Domain\CollectGeneral";}}
class CustomerCollection extends Collection implements \MVC\Domain\CustomerCollection {function targetClass( ) {return "\MVC\Domain\Customer";}}
class ConfigCollection extends Collection implements \MVC\Domain\ConfigCollection{function targetClass(){return "\MVC\Domain\Config";}}
class CategoryCollection extends Collection implements \MVC\Domain\CategoryCollection {function targetClass( ) {return "\MVC\Domain\Category";}}	
class CourseCollection extends Collection implements \MVC\Domain\CourseCollection {function targetClass( ) {return "\MVC\Domain\Course";}}
class DomainCollection extends Collection implements \MVC\Domain\DomainCollection {function targetClass( ) {return "\MVC\Domain\Domain";}}	
class EmployeeCollection extends Collection implements \MVC\Domain\EmployeeCollection{function targetClass( ) {return "\MVC\Domain\Employee";}}
class GuestCollection extends Collection implements \MVC\Domain\GuestCollection{function targetClass(){return "\MVC\Domain\Guest";}}
class OrderImportCollection extends Collection implements \MVC\Domain\OrderImportCollection{function targetClass(){return "\MVC\Domain\OrderImport";}}
class OrderImportDetailCollection extends Collection implements \MVC\Domain\OrderImportDetailCollection{function targetClass(){return "\MVC\Domain\OrderImportDetail";}}
class PayRollCollection extends Collection implements \MVC\Domain\PayRollCollection{function targetClass( ) {return "\MVC\Domain\PayRoll";}}
class PaidGeneralCollection extends Collection implements \MVC\Domain\PaidGeneralCollection{function targetClass( ) {return "\MVC\Domain\PaidGeneral";}}
class PageCollection extends Collection implements \MVC\Domain\PageCollection{function targetClass(){return "\MVC\Domain\Page";}}
class TermPaidCollection extends Collection implements \MVC\Domain\TermPaidCollection{function targetClass(){return "\MVC\Domain\TermPaid";}}
class TermCollectCollection extends Collection implements \MVC\Domain\TermCollectCollection{function targetClass(){return "\MVC\Domain\TermCollect";}}
class TrackingCollection extends Collection implements \MVC\Domain\TrackingCollection{function targetClass(){return "\MVC\Domain\Tracking";}}
class TableCollection extends Collection implements \MVC\Domain\TableCollection {function targetClass( ) {return "\MVC\Domain\Table";}}		
class SessionCollection extends Collection implements \MVC\Domain\SessionCollection {function targetClass( ) {return "\MVC\Domain\Session";}}			
class SessionDetailCollection extends Collection implements \MVC\Domain\SessionDetailCollection {function targetClass( ) {return "\MVC\Domain\SessionDetail";}}
class SupplierCollection extends Collection implements \MVC\Domain\SupplierCollection {function targetClass( ) {return "\MVC\Domain\Supplier";}}
class UnitCollection extends Collection implements \MVC\Domain\UnitCollection{function targetClass(){return "\MVC\Domain\Unit";}}
class UserCollection extends Collection implements \MVC\Domain\UserCollection {function targetClass( ) {return "\MVC\Domain\User";}}
class ResourceCollection extends Collection implements \MVC\Domain\ResourceCollection {function targetClass( ) {return "\MVC\Domain\Resource";}}
?>