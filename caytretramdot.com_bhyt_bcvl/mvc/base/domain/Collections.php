<?php
namespace MVC\Domain;

interface AppCollection 			extends \Iterator {function add( Object $App );}
interface UserCollection 			extends \Iterator {function add( Object $user );}
interface DomainCollection 			extends \Iterator {function add( Object $domain );}
interface TableCollection 			extends \Iterator {function add( Object $table );}
interface StudentCollection 		extends \Iterator {function add( Object $Student);}
interface StudentTempCollection 	extends \Iterator {function add( Object $StudentTemp);}
interface ConfigCollection 			extends \Iterator {function add( Object $Config );}
interface TrackingCollection 		extends \Iterator {function add( Object $Tracking);}
interface PageCollection 			extends \Iterator {function add( Object $Page);}
interface GuestCollection 			extends \Iterator {function add( Object $Guest);}
?>
