<?php
namespace MVC\Domain;

interface UserCollection 			extends \Iterator {function add( Object $user );}
interface DomainCollection 			extends \Iterator {function add( Object $domain );}
interface SolveCollection 			extends \Iterator {function add( Object $Solve );}
interface QuestionCollection 		extends \Iterator {function add( Object $Question );}
interface ClauseCollection 			extends \Iterator {function add( Object $Clause );}
interface CategoryCollection 		extends \Iterator {function add( Object $Category );	}
interface ConfigCollection 			extends \Iterator {function add( Object $Config );}
interface PageCollection 			extends \Iterator {function add( Object $Page);}
interface GuestCollection 			extends \Iterator {function add( Object $Guest);}
?>
