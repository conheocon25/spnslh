<?php
namespace MVC\Domain;

interface BranchCollection 				extends \Iterator {function add( Object $Branch );		}
interface BranchGroupCollection 		extends \Iterator {function add( Object $BranchGroup );	}
interface BranchQuotaCollection 		extends \Iterator {function add( Object $BranchQuota );	}
interface BranchWarehouseCollection 	extends \Iterator {function add( Object $BranchWarehouse );	}

interface UserCollection 				extends \Iterator {function add( Object $User );		}
interface UserBranchCollection 			extends \Iterator {function add( Object $UserBranch);	}
interface UserWarehouseCollection 		extends \Iterator {function add( Object $UserWarehouse);}

interface RoleCollection 				extends \Iterator {function add( Object $Role);			}
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
interface CustomerCollectCollection		extends \Iterator {function add( Object $CustomerCollect);	}
interface CustomerInitCollection 		extends \Iterator {function add( Object $CustomerInit);		}

interface EmployeeCollection 			extends \Iterator {function add( Object $Employee);		}
interface DepartmentCollection 			extends \Iterator {function add( Object $Department);	}

interface SupplierTypeCollection 		extends \Iterator {function add( Object $SupplierType);	}
interface SupplierCollection 			extends \Iterator {function add( Object $Supplier);		}

interface WarehouseCollection 			extends \Iterator {function add( Object $Warehouse);	}
interface WarehouseGroupCollection 		extends \Iterator {function add( Object $WarehouseGroup);	}

interface TrackCollection 				extends \Iterator {function add( Object $Track);		}
interface TrackDailyCollection 			extends \Iterator {function add( Object $TrackDaily);	}
interface TrackDailyBranchCollection 	extends \Iterator {function add( Object $TrackDailyBranch);	}
interface TrackDailyBranchCustomerCollection 	extends \Iterator {function add( Object $TrackDailyBranchCustomer);	}

interface TransportCollection 			extends \Iterator {function add( Object $Transport);		}
interface TransportGroupCollection 		extends \Iterator {function add( Object $TransportGroup);	}

interface PaymentMethodCollection 		extends \Iterator {function add( Object $PaymentMethod);}

interface ConfigCollection 				extends \Iterator {function add( Object $Config );		}
interface PageCollection 				extends \Iterator {function add( Object $Page);			}
interface GuestCollection 				extends \Iterator {function add( Object $Guest);		}

?>