<?php
namespace MVC\Mapper;
require_once( "mvc/base/domain/Collections.php");
require_once( "mvc/base/mapper/Collection.php");

class UserCollection 			extends Collection implements \MVC\Domain\UserCollection 			{function targetClass( ) {return "\MVC\Domain\User";		}}
class TypeAccountCollection 	extends Collection implements \MVC\Domain\TypeAccountCollection 	{function targetClass( ) {return "\MVC\Domain\TypeAccount";	}}

class GoodGroupCollection 		extends Collection implements \MVC\Domain\GoodGroupCollection		{function targetClass( ) {return "\MVC\Domain\GoodGroup";	}}
class GoodCollection 			extends Collection implements \MVC\Domain\GoodCollection			{function targetClass( ) {return "\MVC\Domain\Good";		}}

class CustomerGroupCollection 	extends Collection implements \MVC\Domain\CustomerGroupCollection	{function targetClass( ) {return "\MVC\Domain\CustomerGroup";	}}
class CustomerCollection 		extends Collection implements \MVC\Domain\CustomerCollection 		{function targetClass( ) {return "\MVC\Domain\Customer";		}}

class EmployeeCollection 		extends Collection implements \MVC\Domain\EmployeeCollection 		{function targetClass( ) {return "\MVC\Domain\Employee";	}}
class DepartmentCollection 		extends Collection implements \MVC\Domain\DepartmentCollection 		{function targetClass( ) {return "\MVC\Domain\Department";	}}

class SupplierCollection 		extends Collection implements \MVC\Domain\SupplierCollection 		{function targetClass( ) {return "\MVC\Domain\Supplier";	}}
class WarehouseCollection 		extends Collection implements \MVC\Domain\WarehouseCollection 		{function targetClass( ) {return "\MVC\Domain\Warehouse";	}}

class ConfigCollection 			extends Collection implements \MVC\Domain\ConfigCollection			{function targetClass(){return "\MVC\Domain\Config";		}}
class PageCollection 			extends Collection implements \MVC\Domain\PageCollection			{function targetClass(){return "\MVC\Domain\Page";			}}
class GuestCollection 			extends Collection implements \MVC\Domain\GuestCollection			{function targetClass(){return "\MVC\Domain\Guest";			}}

?>