<?php
namespace MVC\Mapper;
require_once( "mvc/base/domain/Collections.php");
require_once( "mvc/base/mapper/Collection.php");

class UserCollection 			extends Collection implements \MVC\Domain\UserCollection 			{function targetClass( ) {return "\MVC\Domain\User";		}}
class TypeAccountCollection 	extends Collection implements \MVC\Domain\TypeAccountCollection 	{function targetClass( ) {return "\MVC\Domain\TypeAccount";	}}
class CategoryCustomerCollection 	extends Collection implements \MVC\Domain\CategoryCustomerCollection 		{function targetClass( ) {return "\MVC\Domain\CategoryCustomer";	}}
class CustomerCollection 			extends Collection implements \MVC\Domain\CustomerCollection 		{function targetClass( ) {return "\MVC\Domain\Customer";	}}
class SupplierCollection 		extends Collection implements \MVC\Domain\SupplierCollection 		{function targetClass( ) {return "\MVC\Domain\Supplier";	}}
class EmployeeCollection 		extends Collection implements \MVC\Domain\EmployeeCollection 		{function targetClass( ) {return "\MVC\Domain\Employee";	}}
class RoomCollection 			extends Collection implements \MVC\Domain\RoomCollection 			{function targetClass( ) {return "\MVC\Domain\Room";		}}
class StoreCollection 			extends Collection implements \MVC\Domain\StoreCollection 			{function targetClass( ) {return "\MVC\Domain\Store";		}}

class ConfigCollection 			extends Collection implements \MVC\Domain\ConfigCollection			{function targetClass(){return "\MVC\Domain\Config";		}}
class PageCollection 			extends Collection implements \MVC\Domain\PageCollection			{function targetClass(){return "\MVC\Domain\Page";			}}
class GuestCollection 			extends Collection implements \MVC\Domain\GuestCollection			{function targetClass(){return "\MVC\Domain\Guest";			}}

?>