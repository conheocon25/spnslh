<?php
namespace MVC\Domain;

interface AppCollection extends \Iterator {function add( Object $App );}
interface UserCollection extends \Iterator {function add( Object $user );}
interface DomainCollection extends \Iterator {function add( Object $domain );}
interface TableCollection extends \Iterator {function add( Object $table );}
interface SessionCollection extends \Iterator {function add( Object $session );	}
interface SessionDetailCollection extends \Iterator {function add( Object $SessionDetail );	}
interface CategoryCollection extends \Iterator {function add( Object $category );	}
interface CourseCollection extends \Iterator {function add( Object $course );	}
interface PayRollCollection extends \Iterator {function add( Object $PayRoll );}
interface PaidGeneralCollection extends \Iterator {function add( Object $PaidGeneral );}
interface TermPaidCollection extends \Iterator {function add( Object $TermPaid );}
interface TermCollectCollection extends \Iterator {function add( Object $TermCollect );}
interface CollectGeneralCollection extends \Iterator {function add( Object $CollectGeneral );}
interface CustomerCollection extends \Iterator {function add( Object $Customer );}
interface EmployeeCollection extends \Iterator {function add( Object $Employee );}
interface UnitCollection extends \Iterator {function add( Object $Unit );}
interface ConfigCollection extends \Iterator {function add( Object $Config );}
interface TrackingCollection extends \Iterator {function add( Object $Tracking);}
interface PageCollection extends \Iterator {function add( Object $Page);}
interface GuestCollection extends \Iterator {function add( Object $Guest);}
?>
