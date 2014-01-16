<?php
namespace MVC\Mapper;
require_once( "mvc/base/domain/Collections.php");
require_once( "mvc/base/mapper/Collection.php");

class AppCollection extends Collection implements \MVC\Domain\AppCollection {function targetClass( ) {return "\MVC\Domain\App";}}
class UserCollection extends Collection implements \MVC\Domain\UserCollection {function targetClass( ) {return "\MVC\Domain\User";}}
class GuestCollection extends Collection implements \MVC\Domain\GuestCollection {function targetClass( ) {return "\MVC\Domain\Guest";}}
class TechnicalCollection extends Collection implements \MVC\Domain\TechnicalCollection {function targetClass( ) {return "\MVC\Domain\Technical";}}
class SolutionCollection extends Collection implements \MVC\Domain\SolutionCollection {function targetClass( ) {return "\MVC\Domain\Solution";}}
class ServiceCollection extends Collection implements \MVC\Domain\ServiceCollection {function targetClass( ) {return "\MVC\Domain\Service";}}
class ProjectCollection extends Collection implements \MVC\Domain\ProjectCollection {function targetClass( ) {return "\MVC\Domain\Project";}}
class CustomerStoryCollection extends Collection implements \MVC\Domain\CustomerStoryCollection {function targetClass( ) {return "\MVC\Domain\CustomerStory";}}

?>
