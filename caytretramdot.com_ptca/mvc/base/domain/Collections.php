<?php
namespace MVC\Domain;

interface BranchCollection 				extends \Iterator {function add( Object $Branch );		}
interface BranchGroupCollection 		extends \Iterator {function add( Object $BranchGroup );	}

interface UserCollection 				extends \Iterator {function add( Object $User );		}
interface TypeAccountCollection 		extends \Iterator {function add( Object $TypeAccount);	}
interface UnitCollection 				extends \Iterator {function add( Object $Unit );		}

interface SaleCommandCollection 		extends \Iterator {function add( Object $SaleCommand);		}
interface SaleCommandDetailCollection 	extends \Iterator {function add( Object $SaleCommandDetail);}

interface InvoiceSellCollection 		extends \Iterator {function add( Object $InvoiceSell);	}
interface InvoiceSellDetailCollection 	extends \Iterator {function add( Object $InvoiceSellDetail);	}

interface InvoiceImportCollection 		extends \Iterator {function add( Object $InvoiceImport);		}
interface InvoiceImportDetailCollection extends \Iterator {function add( Object $InvoiceImportDetail);	}

interface GoodGroupCollection 			extends \Iterator {function add( Object $GoodGroup);	}
interface GoodCollection 				extends \Iterator {function add( Object $Good);			}

interface CustomerGroupCollection 		extends \Iterator {function add( Object $CustomerGroup);}
interface CustomerCollection 			extends \Iterator {function add( Object $Customer);		}

interface EmployeeCollection 			extends \Iterator {function add( Object $Employee);		}
interface DepartmentCollection 			extends \Iterator {function add( Object $Department);	}

interface SupplierTypeCollection 		extends \Iterator {function add( Object $SupplierType);	}
interface SupplierCollection 			extends \Iterator {function add( Object $Supplier);		}

interface WarehouseCollection 			extends \Iterator {function add( Object $Warehouse);	}
interface WarehouseGroupCollection 		extends \Iterator {function add( Object $WarehouseGroup);	}

interface TrackCollection 				extends \Iterator {function add( Object $Track);		}
interface TrackDailyCollection 			extends \Iterator {function add( Object $TrackDaily);	}

interface TransportCollection 			extends \Iterator {function add( Object $Transport);		}
interface TransportGroupCollection 		extends \Iterator {function add( Object $TransportGroup);	}

interface PaymentMethodCollection 		extends \Iterator {function add( Object $PaymentMethod);}

interface ConfigCollection 				extends \Iterator {function add( Object $Config );		}
interface PageCollection 				extends \Iterator {function add( Object $Page);			}
interface GuestCollection 				extends \Iterator {function add( Object $Guest);		}

?>