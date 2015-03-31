<?php
namespace MVC\Mapper;
require_once( "mvc/base/domain/Collections.php");
require_once( "mvc/base/mapper/Collection.php");

class UserCollection 			extends Collection implements \MVC\Domain\UserCollection 			{function targetClass( ) {return "\MVC\Domain\User";		}}
class UserBranchCollection 		extends Collection implements \MVC\Domain\UserBranchCollection 		{function targetClass( ) {return "\MVC\Domain\UserBranch";	}}
class UserWarehouseCollection 	extends Collection implements \MVC\Domain\UserWarehouseCollection 	{function targetClass( ) {return "\MVC\Domain\UserWarehouse";}}
class RoleCollection 			extends Collection implements \MVC\Domain\RoleCollection 			{function targetClass( ) {return "\MVC\Domain\Role";		}}

class UnitCollection 			extends Collection implements \MVC\Domain\UnitCollection 			{function targetClass( ) {return "\MVC\Domain\Unit";		}}

class BranchCollection 				extends Collection implements \MVC\Domain\BranchCollection 			{function targetClass( ) {return "\MVC\Domain\Branch";		}}
class BranchGroupCollection 		extends Collection implements \MVC\Domain\BranchGroupCollection 	{function targetClass( ) {return "\MVC\Domain\BranchGroup";	}}
class BranchQuotaCollection 		extends Collection implements \MVC\Domain\BranchQuotaCollection 	{function targetClass( ) {return "\MVC\Domain\BranchQuota";	}}

class SaleCommandCollection 		extends Collection implements \MVC\Domain\SaleCommandCollection			{function targetClass( ) {return "\MVC\Domain\SaleCommand";			}}
class SaleCommandDetailCollection 	extends Collection implements \MVC\Domain\SaleCommandDetailCollection	{function targetClass( ) {return "\MVC\Domain\SaleCommandDetail";	}}

class InvoiceSellCollection 		extends Collection implements \MVC\Domain\InvoiceSellCollection			{function targetClass( ) {return "\MVC\Domain\InvoiceSell";	}}
class InvoiceSellDetailCollection 	extends Collection implements \MVC\Domain\InvoiceSellDetailCollection	{function targetClass( ) {return "\MVC\Domain\InvoiceSellDetail";	}}

class InvoiceImportCollection 		extends Collection implements \MVC\Domain\InvoiceImportCollection		{function targetClass( ) {return "\MVC\Domain\InvoiceImport";		}}
class InvoiceImportDetailCollection extends Collection implements \MVC\Domain\InvoiceImportDetailCollection	{function targetClass( ) {return "\MVC\Domain\InvoiceImportDetail";	}}

class GoodGroupCollection 		extends Collection implements \MVC\Domain\GoodGroupCollection		{function targetClass( ) {return "\MVC\Domain\GoodGroup";	}}
class GoodCollection 			extends Collection implements \MVC\Domain\GoodCollection			{function targetClass( ) {return "\MVC\Domain\Good";		}}

class CustomerGroupCollection 	extends Collection implements \MVC\Domain\CustomerGroupCollection	{function targetClass( ) {return "\MVC\Domain\CustomerGroup";	}}
class CustomerCollection 		extends Collection implements \MVC\Domain\CustomerCollection 		{function targetClass( ) {return "\MVC\Domain\Customer";		}}
class CustomerCollectCollection extends Collection implements \MVC\Domain\CustomerCollectCollection {function targetClass( ) {return "\MVC\Domain\CustomerCollect";	}}

class EmployeeCollection 		extends Collection implements \MVC\Domain\EmployeeCollection 		{function targetClass( ) {return "\MVC\Domain\Employee";	}}
class DepartmentCollection 		extends Collection implements \MVC\Domain\DepartmentCollection 		{function targetClass( ) {return "\MVC\Domain\Department";	}}

class SupplierTypeCollection 	extends Collection implements \MVC\Domain\SupplierTypeCollection 	{function targetClass( ) {return "\MVC\Domain\SupplierType";}}
class SupplierCollection 		extends Collection implements \MVC\Domain\SupplierCollection 		{function targetClass( ) {return "\MVC\Domain\Supplier";	}}

class WarehouseCollection 		extends Collection implements \MVC\Domain\WarehouseCollection 		{function targetClass( ) {return "\MVC\Domain\Warehouse";	}}
class WarehouseGroupCollection 	extends Collection implements \MVC\Domain\WarehouseGroupCollection 	{function targetClass( ) {return "\MVC\Domain\WarehouseGroup";	}}

class TrackCollection 			extends Collection implements \MVC\Domain\TrackCollection 			{function targetClass( ) {return "\MVC\Domain\Track";		}}
class TrackDailyCollection 		extends Collection implements \MVC\Domain\TrackDailyCollection 		{function targetClass( ) {return "\MVC\Domain\TrackDaily";	}}
class TrackDailyBranchCollection 			extends Collection implements \MVC\Domain\TrackDailyBranchCollection 		{function targetClass( ) {return "\MVC\Domain\TrackDailyBranch";		}}
class TrackDailyBranchCustomerCollection 	extends Collection implements \MVC\Domain\TrackDailyBranchCustomerCollection{function targetClass( ) {return "\MVC\Domain\TrackDailyBranchCustomer";}}

class TransportCollection 		extends Collection implements \MVC\Domain\TransportCollection 		{function targetClass( ) {return "\MVC\Domain\Transport";	}}
class TransportGroupCollection 	extends Collection implements \MVC\Domain\TransportGroupCollection 	{function targetClass( ) {return "\MVC\Domain\TransportGroup";	}}

class PaymentMethodCollection 	extends Collection implements \MVC\Domain\PaymentMethodCollection 	{function targetClass( ) {return "\MVC\Domain\PaymentMethod";}}

class ConfigCollection 			extends Collection implements \MVC\Domain\ConfigCollection			{function targetClass(){return "\MVC\Domain\Config";		}}
class PageCollection 			extends Collection implements \MVC\Domain\PageCollection			{function targetClass(){return "\MVC\Domain\Page";			}}
class GuestCollection 			extends Collection implements \MVC\Domain\GuestCollection			{function targetClass(){return "\MVC\Domain\Guest";			}}

?>