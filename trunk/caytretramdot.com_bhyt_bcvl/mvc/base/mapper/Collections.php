<?php
namespace MVC\Mapper;
require_once( "mvc/base/domain/Collections.php");
require_once( "mvc/base/mapper/Collection.php");

class AppCollection 			extends Collection implements \MVC\Domain\AppCollection 			{function targetClass( ) {return "\MVC\Domain\App";}}
class UserCollection 			extends Collection implements \MVC\Domain\UserCollection 			{function targetClass( ) {return "\MVC\Domain\User";}}
class DomainCollection 			extends Collection implements \MVC\Domain\DomainCollection 			{function targetClass( ) {return "\MVC\Domain\Domain";}}	
class TableCollection 			extends Collection implements \MVC\Domain\TableCollection 			{function targetClass( ) {return "\MVC\Domain\Table";}}		
class NotifyCollection 			extends Collection implements \MVC\Domain\NotifyCollection			{function targetClass(){return "\MVC\Domain\Notify";}}
class ConfigCollection 			extends Collection implements \MVC\Domain\ConfigCollection			{function targetClass(){return "\MVC\Domain\Config";}}
class TrackingCollection 		extends Collection implements \MVC\Domain\TrackingCollection		{function targetClass(){return "\MVC\Domain\Tracking";}}
class PageCollection 			extends Collection implements \MVC\Domain\PageCollection			{function targetClass(){return "\MVC\Domain\Page";}}
class GuestCollection 			extends Collection implements \MVC\Domain\GuestCollection			{function targetClass(){return "\MVC\Domain\Guest";}}

?>