<?php
namespace MVC\Domain;

interface PostCollection extends \Iterator {function add( Object $Post );}
interface UserCollection extends \Iterator {function add( Object $user );}
interface ConfigCollection extends \Iterator {function add( Object $Config );}
interface PageCollection extends \Iterator {function add( Object $Page);}
interface GuestCollection extends \Iterator {function add( Object $Guest);}
?>
