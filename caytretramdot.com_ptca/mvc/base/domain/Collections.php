<?php
namespace MVC\Domain;

interface UserCollection 				extends \Iterator {function add( Object $User );		}
interface TypeAccountCollection 		extends \Iterator {function add( Object $TypeAccount);	}

interface GoodGroupCollection 			extends \Iterator {function add( Object $GoodGroup);	}
interface GoodCollection 				extends \Iterator {function add( Object $Good);			}

interface CustomerGroupCollection 		extends \Iterator {function add( Object $CustomerGroup);}
interface CustomerCollection 			extends \Iterator {function add( Object $Customer);		}

interface EmployeeCollection 			extends \Iterator {function add( Object $Employee);		}
interface DepartmentCollection 			extends \Iterator {function add( Object $Department);	}

interface SupplierCollection 			extends \Iterator {function add( Object $Supplier);		}
interface WarehouseCollection 			extends \Iterator {function add( Object $Warehouse);	}

interface ConfigCollection 				extends \Iterator {function add( Object $Config );		}
interface PageCollection 				extends \Iterator {function add( Object $Page);			}
interface GuestCollection 				extends \Iterator {function add( Object $Guest);		}

?>