<?php
namespace MVC\Domain;

interface BranchCollection 				extends \Iterator {function add( Object $Branch );		}

interface UserCollection 				extends \Iterator {function add( Object $User );		}
interface FeedCollection 				extends \Iterator {function add( Object $Feed );		}

interface CategoryCollection 			extends \Iterator {function add( Object $Category );	}
interface Category1Collection 			extends \Iterator {function add( Object $Category1 );	}
interface ProductImageCollection 		extends \Iterator {function add( Object $ProductImage );}
interface ProductAttributeCollection 	extends \Iterator {function add( Object $ProductAttribute );}

interface AttributeCollection 			extends \Iterator {function add( Object $Attribute );	}
interface GAttributeCollection 			extends \Iterator {function add( Object $GAttribute );	}
interface ManufacturerCollection 		extends \Iterator {function add( Object $Manufacturer );}
interface SupplierCollection 			extends \Iterator {function add( Object $supplier );	}
interface ProductCollection 			extends \Iterator {function add( Object $Product );		}
interface ProductInfoCollection 		extends \Iterator {function add( Object $ProductInfo );	}

interface OrderImportCollection 		extends \Iterator {function add( Object $orderimport );	}
interface OrderImportDetailCollection 	extends \Iterator {function add( Object $orderimportdetail );	}
interface OrderExportCollection 		extends \Iterator {function add( Object $orderexport );	}
interface OrderExportDetailCollection 	extends \Iterator {function add( Object $orderexportdetail );	}

interface CustomerCollection 			extends \Iterator {function add( Object $Customer );	}
interface StoryLineCollection 			extends \Iterator {function add( Object $StoryLine );	}

interface TagCollection 				extends \Iterator {function add( Object $Tag );			}
interface PostTagCollection 			extends \Iterator {function add( Object $PostTag );		}

interface EmployeeCollection 			extends \Iterator {function add( Object $Employee );	}
interface ConfigCollection 				extends \Iterator {function add( Object $Config );		}
interface TrackingCollection 			extends \Iterator {function add( Object $Tracking);		}
interface TrackingDailyCollection 		extends \Iterator {function add( Object $TrackingDaily);}
interface PageCollection 				extends \Iterator {function add( Object $Page);			}
interface GuestCollection 				extends \Iterator {function add( Object $Guest);		}
interface PostCollection 				extends \Iterator {function add( Object $Post);			}
interface PresentationCollection 		extends \Iterator {function add( Object $Presentation);	}
interface SlideCollection 				extends \Iterator {function add( Object $Slide);		}

interface SaveCollection 				extends \Iterator {function add( Object $Save);			}
interface SaveProductCollection 		extends \Iterator {function add( Object $SaveProduct);	}

?>
