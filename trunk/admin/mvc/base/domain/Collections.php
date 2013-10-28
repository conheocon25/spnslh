<?php
namespace MVC\Domain;

interface ProjectCollection extends \Iterator {function add( Object $Project );}

interface UserCollection extends \Iterator {function add( Object $user );}
interface UnitCollection extends \Iterator {function add( Object $Unit );}
interface ConfigCollection extends \Iterator {function add( Object $Config );}
interface PageCollection extends \Iterator {function add( Object $Page);}
interface GuestCollection extends \Iterator {function add( Object $Guest);}
?>
