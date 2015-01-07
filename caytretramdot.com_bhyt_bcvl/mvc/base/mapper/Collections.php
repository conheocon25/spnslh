<?php
namespace MVC\Mapper;
require_once( "mvc/base/domain/Collections.php");
require_once( "mvc/base/mapper/Collection.php");

class AppCollection 			extends Collection implements \MVC\Domain\AppCollection 			{function targetClass( ) {return "\MVC\Domain\App";}}
class UserCollection 			extends Collection implements \MVC\Domain\UserCollection 			{function targetClass( ) {return "\MVC\Domain\User";}}
class DomainCollection 			extends Collection implements \MVC\Domain\DomainCollection 			{function targetClass( ) {return "\MVC\Domain\Domain";}}	
class TableCollection 			extends Collection implements \MVC\Domain\TableCollection 			{function targetClass( ) {return "\MVC\Domain\Table";}}
class StudentCollection 		extends Collection implements \MVC\Domain\StudentCollection 		{function targetClass( ) {return "\MVC\Domain\Student";}}
class StudentTempCollection 	extends Collection implements \MVC\Domain\StudentTempCollection 	{function targetClass( ) {return "\MVC\Domain\StudentTemp";}}
class ConfigCollection 			extends Collection implements \MVC\Domain\ConfigCollection			{function targetClass( ) {return "\MVC\Domain\Config";}}
class TrackingCollection 		extends Collection implements \MVC\Domain\TrackingCollection		{function targetClass( ) {return "\MVC\Domain\Tracking";}}
class SessionCollection 		extends Collection implements \MVC\Domain\SessionCollection			{function targetClass( ) {return "\MVC\Domain\Session";}}
class PageCollection 			extends Collection implements \MVC\Domain\PageCollection			{function targetClass( ) {return "\MVC\Domain\Page";}}
class GuestCollection 			extends Collection implements \MVC\Domain\GuestCollection			{function targetClass( ) {return "\MVC\Domain\Guest";}}

?>