<?php
namespace MVC\Mapper;
require_once( "mvc/base/domain/Collections.php");
require_once( "mvc/base/mapper/Collection.php");

class AppCollection 			extends Collection implements \MVC\Domain\AppCollection 			{function targetClass( ) {return "\MVC\Domain\App";}}
class UserCollection 			extends Collection implements \MVC\Domain\UserCollection 			{function targetClass( ) {return "\MVC\Domain\User";}}
class DomainCollection 			extends Collection implements \MVC\Domain\DomainCollection 			{function targetClass( ) {return "\MVC\Domain\Domain";}}	
class TableCollection 			extends Collection implements \MVC\Domain\TableCollection 			{function targetClass( ) {return "\MVC\Domain\Table";}}		
class TableLogCollection 		extends Collection implements \MVC\Domain\TableLogCollection 		{function targetClass( ) {return "\MVC\Domain\TableLog";}}
class SessionCollection 		extends Collection implements \MVC\Domain\SessionCollection 		{function targetClass( ) {return "\MVC\Domain\Session";}}			
class SessionDetailCollection 	extends Collection implements \MVC\Domain\SessionDetailCollection 	{function targetClass( ) {return "\MVC\Domain\SessionDetail";}}
class CategoryCollection 		extends Collection implements \MVC\Domain\CategoryCollection 		{function targetClass( ) {return "\MVC\Domain\Category";}}	
class CourseCollection 			extends Collection implements \MVC\Domain\CourseCollection 			{function targetClass( ) {return "\MVC\Domain\Course";}}
class CourseLogCollection 		extends Collection implements \MVC\Domain\CourseLogCollection 		{function targetClass( ) {return "\MVC\Domain\CourseLog";}}
class SupplierCollection 		extends Collection implements \MVC\Domain\SupplierCollection 		{function targetClass( ) {return "\MVC\Domain\Supplier";}}

class PaidSupplierCollection 	extends Collection implements \MVC\Domain\PaidSupplierCollection 	{function targetClass( ) {return "\MVC\Domain\PaidSupplier";}}
class PaidPayRollCollection 	extends Collection implements \MVC\Domain\PaidPayRollCollection		{function targetClass( ) {return "\MVC\Domain\PaidPayRoll";}}
class PaidGeneralCollection 	extends Collection implements \MVC\Domain\PaidGeneralCollection		{function targetClass( ) {return "\MVC\Domain\PaidGeneral";}}
class PaidEmployeeCollection 	extends Collection implements \MVC\Domain\PaidEmployeeCollection	{function targetClass( ) {return "\MVC\Domain\PaidEmployee";}}
class PayRollCollection 		extends Collection implements \MVC\Domain\PayRollCollection			{function targetClass( ) {return "\MVC\Domain\PayRoll";}}

class TermPaidCollection 		extends Collection implements \MVC\Domain\TermPaidCollection		{function targetClass(){return "\MVC\Domain\TermPaid";}}
class TermCollectCollection 	extends Collection implements \MVC\Domain\TermCollectCollection		{function targetClass(){return "\MVC\Domain\TermCollect";}}
class CollectGeneralCollection 	extends Collection implements \MVC\Domain\CollectGeneralCollection	{function targetClass( ) {return "\MVC\Domain\CollectGeneral";}}
class CollectCustomerCollection extends Collection implements \MVC\Domain\CollectCustomerCollection {function targetClass( ) {return "\MVC\Domain\CollectCustomer";}}

class ResourceCollection 		extends Collection implements \MVC\Domain\ResourceCollection 		{function targetClass( ) {return "\MVC\Domain\Resource";}}
class OrderImportCollection 	extends Collection implements \MVC\Domain\OrderImportCollection 	{function targetClass( ) {return "\MVC\Domain\OrderImport";}}
class OrderImportDetailCollection extends Collection implements \MVC\Domain\OrderImportDetailCollection {function targetClass( ) {return "\MVC\Domain\OrderImportDetail";}}
class CustomerCollection 		extends Collection implements \MVC\Domain\CustomerCollection 		{function targetClass( ) {return "\MVC\Domain\Customer";}}
class EmployeeCollection 		extends Collection implements \MVC\Domain\EmployeeCollection		{function targetClass( ) {return "\MVC\Domain\Employee";}}

class UnitCollection 			extends Collection implements \MVC\Domain\UnitCollection			{function targetClass(){return "\MVC\Domain\Unit";}}
class NotifyCollection 			extends Collection implements \MVC\Domain\NotifyCollection			{function targetClass(){return "\MVC\Domain\Notify";}}
class ConfigCollection 			extends Collection implements \MVC\Domain\ConfigCollection			{function targetClass(){return "\MVC\Domain\Config";}}

class TrackingCollection 		extends Collection implements \MVC\Domain\TrackingCollection		{function targetClass(){return "\MVC\Domain\Tracking";}}
class TrackingCustomerCollection extends Collection implements \MVC\Domain\TrackingCustomerCollection	{function targetClass(){return "\MVC\Domain\TrackingCustomer";}}
class TrackingStoreCollection 	extends Collection implements \MVC\Domain\TrackingStoreCollection	{function targetClass(){return "\MVC\Domain\TrackingStore";}}
class TrackingCourseCollection 	extends Collection implements \MVC\Domain\TrackingCourseCollection	{function targetClass(){return "\MVC\Domain\TrackingCourse";}}
class TrackingDailyCollection 	extends Collection implements \MVC\Domain\TrackingDailyCollection	{function targetClass(){return "\MVC\Domain\TrackingDaily";}}

class R2CCollection 			extends Collection implements \MVC\Domain\R2CCollection				{function targetClass(){return "\MVC\Domain\R2C";}}
class PageCollection 			extends Collection implements \MVC\Domain\PageCollection			{function targetClass(){return "\MVC\Domain\Page";}}
class GuestCollection 			extends Collection implements \MVC\Domain\GuestCollection			{function targetClass(){return "\MVC\Domain\Guest";}}

?>