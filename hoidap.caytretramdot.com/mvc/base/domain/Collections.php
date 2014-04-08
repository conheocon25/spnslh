<?php
namespace MVC\Domain;

interface UserCollection 			extends \Iterator {function add( Object $user );}
interface DomainCollection 			extends \Iterator {function add( Object $domain );}
interface SolveCollection 			extends \Iterator {function add( Object $Solve );}
interface CategoryCollection 		extends \Iterator {function add( Object $category );	}
interface ConfigCollection 			extends \Iterator {function add( Object $Config );}
interface PageCollection 			extends \Iterator {function add( Object $Page);}
interface GuestCollection 			extends \Iterator {function add( Object $Guest);}
?>
