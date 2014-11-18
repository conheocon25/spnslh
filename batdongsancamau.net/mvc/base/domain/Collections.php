<?php
namespace MVC\Domain;

interface UserCollection 				extends \Iterator {function add( Object $User );		}
interface FeedCollection 				extends \Iterator {function add( Object $Feed );		}

interface CategoryCollection 			extends \Iterator {function add( Object $Category );	}
interface Category1Collection 			extends \Iterator {function add( Object $Category1 );	}

interface SupplierCollection 			extends \Iterator {function add( Object $supplier );	}
interface ProductCollection 			extends \Iterator {function add( Object $Product );		}
interface ProductInfoCollection 		extends \Iterator {function add( Object $ProductInfo );	}
interface ProductImageCollection 		extends \Iterator {function add( Object $ProductImage );}
interface ProductMapCollection 			extends \Iterator {function add( Object $ProductMap);	}

interface StoryLineCollection 			extends \Iterator {function add( Object $StoryLine );	}

interface TagCollection 				extends \Iterator {function add( Object $Tag );			}
interface PostTagCollection 			extends \Iterator {function add( Object $PostTag );		}

interface ConfigCollection 				extends \Iterator {function add( Object $Config );		}
interface PageCollection 				extends \Iterator {function add( Object $Page);			}
interface GuestCollection 				extends \Iterator {function add( Object $Guest);		}
interface PostCollection 				extends \Iterator {function add( Object $Post);			}

interface ProvinceCollection 			extends \Iterator {function add( Object $Province);		}
interface DistrictCollection 			extends \Iterator {function add( Object $District);		}

?>