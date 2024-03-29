<?php
namespace MVC\Domain;

interface AppCollection 			extends \Iterator {function add( Object $App 			);}
interface UserCollection 			extends \Iterator {function add( Object $user 			);}
interface NotifyCollection 			extends \Iterator {function add( Object $notify 		);}
interface DomainCollection 			extends \Iterator {function add( Object $domain 		);}
interface TableCollection 			extends \Iterator {function add( Object $table 			);}
interface TableLogCollection 		extends \Iterator {function add( Object $TableLog 		);}
interface SessionCollection 		extends \Iterator {function add( Object $session 		);}
interface SessionDetailCollection 	extends \Iterator {function add( Object $SessionDetail 	);}
interface SessionDisableCollection 	extends \Iterator {function add( Object $SessionDisable	);}
interface CategoryCollection 		extends \Iterator {function add( Object $Category 		);}
interface CourseCollection 			extends \Iterator {function add( Object $Course 		);}
interface CourseLogCollection 		extends \Iterator {function add( Object $Course_log 	);}
interface CourseDefaultCollection 	extends \Iterator {function add( Object $CourseDefault 	);}
interface SupplierCollection 		extends \Iterator {function add( Object $Supplier 		);}

interface PaidSupplierCollection 	extends \Iterator {function add( Object $PaidSupplier 	);}
interface PaidCustomerCollection 	extends \Iterator {function add( Object $PaidCustomer 	);}
interface PaidPayRollCollection 	extends \Iterator {function add( Object $PaidPayRoll 	);}
interface PaidGeneralCollection 	extends \Iterator {function add( Object $PaidGeneral 	);}
interface PaidEmployeeCollection 	extends \Iterator {function add( Object $PaidEmployee 	);}
interface PayRollCollection 		extends \Iterator {function add( Object $PayRoll 		);}

interface TermPaidCollection 		extends \Iterator {function add( Object $TermPaid 		);}
interface TermCollectCollection 	extends \Iterator {function add( Object $TermCollect 	);}
interface CollectGeneralCollection 	extends \Iterator {function add( Object $CollectGeneral );}
interface CollectCustomerCollection extends \Iterator {function add( Object $CollectCustomer);}

interface ResourceCollection 		extends \Iterator {function add( Object $resource 		);}
interface OrderImportCollection 	extends \Iterator {function add( Object $orderimport 	);}
interface OrderImportDetailCollection extends \Iterator {function add( Object $orderimportdetail );}
interface CustomerCollection 		extends \Iterator {function add( Object $Customer 		);}

interface EmployeeCollection 		extends \Iterator {function add( Object $Employee 		);}
interface UnitCollection 			extends \Iterator {function add( Object $Unit 			);}
interface ConfigCollection 			extends \Iterator {function add( Object $Config 		);}

interface TrackingCollection 		extends \Iterator {function add( Object $Tracking		);}
interface TrackingCustomerCollection 	extends \Iterator {function add( Object $TrackingCustomer);}
interface TrackingSupplierCollection 	extends \Iterator {function add( Object $TrackingSupplier);}
interface TrackingStoreCollection 	extends \Iterator {function add( Object $TrackingStore	);}
interface TrackingCourseCollection 	extends \Iterator {function add( Object $TrackingCourse	);}
interface TrackingDailyCollection 	extends \Iterator {function add( Object $TrackingDaily	);}

interface R2CCollection 			extends \Iterator {function add( Object $R2C			);}
interface PageCollection 			extends \Iterator {function add( Object $Page			);}
interface GuestCollection 			extends \Iterator {function add( Object $Guest			);}
interface PrinterCollection 		extends \Iterator {function add( Object $Printer		);}

?>
