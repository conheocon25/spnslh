<?php	
	namespace MVC\Base;	
	require_once( "mvc/base/controller/AppController.php");
	
	date_default_timezone_set('Asia/Ho_Chi_Minh');		
	/*--------------------------------------------------------------------------------*/	
	abstract class Registry { 
		abstract protected function get( $key );
		abstract protected function set( $key, $val );
	} 
	
	/*--------------------------------------------------------------------------------*/
	class SessionRegistry extends Registry { 
		private static $instance; 
		
		//Sử dụng App và User lưu trữ như là một  Object trong Session
		private function __construct() { 
			require_once 'mvc/domain/User.php';
			//include 'mvc/domain/App.php';
			session_start();
		}
		
 		static function instance() { 
			if ( ! isset(self::$instance) ) { self::$instance = new self(); } 
				return self::$instance;          
		} 
 
		protected function get( $key ) { 
			if ( isset( $_SESSION[__CLASS__][$key] ) ) { 
				return $_SESSION[__CLASS__][$key]; 
			} 
			return null; 
		}  
		protected function set( $key, $val ) { 
			$_SESSION[__CLASS__][$key] = $val; 
		} 
								
		//Quản lí User
		function setCurrentUser( \MVC\Domain\User $user ) {
			return self::instance()->set('www_123app_current_user', $user);
		}
		function getCurrentUser() {
			return self::instance()->get('www_123app_current_user');
		}
		
		//Quản lí ReportSupplierDate
		function setReportSupplierDateStart( $DateStart ) { 
			self::instance()->set('thanhlongceramic_supplier_date_start', $DateStart); 
		}
		function getReportSupplierDateStart( ){
			return self::instance()->get('thanhlongceramic_supplier_date_start');
		}
		function setReportSupplierDateEnd( $DateEnd ) { 
			self::instance()->set('thanhlongceramic_supplier_date_end', $DateEnd); 
		}
		function getReportSupplierDateEnd( ){
			return self::instance()->get('thanhlongceramic_supplier_date_end');
		}
		
		//Quản lí ReportSellingDate
		function setReportSellingDateStart( $DateStart ) { 
			self::instance()->set('www_123app_selling_date_start', $DateStart); 
		}
		function getReportSellingDateStart( ){
			return self::instance()->get('www_123app_selling_date_start');
		}
		
		//Quản lí OrderExportDate
		function setOrderExportDate( $Date ) { 
			self::instance()->set('vend_order_export_date', $Date); 
		}
		function getOrderExportDate( ){
			return self::instance()->get('vend_order_export_date');
		}
		
		function setReportSellingDateEnd( $DateEnd ) { 
			self::instance()->set('www_123app_selling_date_end', $DateEnd); 
		}
		function getReportSellingDateEnd( ){
			return self::instance()->get('www_123app_selling_date_end');
		}
		function setCurrentCategoryNews( $CurrentCategoryNews ) { 
			self::instance()->set('www_123app_CurrentCategoryNews', $CurrentCategoryNews); 
		}
		function getCurrentCategoryNews( ){
			return self::instance()->get('www_123app_CurrentCategoryNews');
		}
		function setCurrentCaptcha( $CurrentCaptcha ) { 
			self::instance()->set('www_123app_CurrentCaptcha', $CurrentCaptcha); 
		}
		function getCurrentCaptcha( ){
			return self::instance()->get('www_123app_CurrentCaptcha');
		}
	}
	/*--------------------------------------------------------------------------------*/
	class RequestRegistry extends Registry { 
		private $values = array(); 
		private static $instance; 
 
		private function __construct() {} 
		static function instance() { 
			if ( ! isset(self::$instance) ) { self::$instance = new self(); } 
				return self::$instance; 
		} 
 
		protected function get( $key ) { 
			if ( isset( $this->values[$key] ) ) { 
				return $this->values[$key]; 
			} 
			return null; 
		} 
 
		protected function set( $key, $val ) { 
			$this->values[$key] = $val; 
		} 
 
		static function getRequest() { 
			return self::instance()->get('request'); 
		} 
 
		static function setRequest( \MVC\Controller\Request $request ) { 
			return self::instance()->set('request', $request ); 
		}
	}
	
	/*--------------------------------------------------------------------------------*/
	class ApplicationRegistry extends Registry {
		private static $instance;
		private $freezedir = "data";
		private $values = array();
		private $mtimes = array();
		private $base;
		private $user;

		private function __construct() { }

		static function instance() {
			if ( ! isset(self::$instance) ) { self::$instance = new self(); }
			return self::$instance;
		}

		protected function get( $key ) {
			$path = $this->freezedir . DIRECTORY_SEPARATOR . $key;
			if ( file_exists( $path ) ) {
				clearstatcache();
				$mtime=filemtime( $path );
				if ( ! isset($this->mtimes[$key] ) ) { $this->mtimes[$key]=0; }
				if ( $mtime > $this->mtimes[$key] ) {
					$data = file_get_contents( $path );
					$this->mtimes[$key]=$mtime;
					return ($this->values[$key]=unserialize( $data ));
				}
			}
			if ( isset( $this->values[$key] ) ) {
				return $this->values[$key];
			}
			return null;
		}

		protected function set( $key, $val ) {
			$this->values[$key] = $val;
			$path = $this->freezedir . DIRECTORY_SEPARATOR . $key;
			file_put_contents( $path, serialize( $val ) );
			$this->mtimes[$key]=time();
		}
		
		static function setInfo( $info ) {
			return self::instance()->set('info', $info);
		}
		static function getInfo() {
			return self::instance()->get('info');
		}
						
		//---------------------------------------------------------------------
		// Thông tin App của hệ thống
		//---------------------------------------------------------------------
				
		//---------------------------------------------------------------------
		// Thông tin DNS của hệ thống
		//---------------------------------------------------------------------		
		static function getDSN() {
			return self::instance()->get('dsn');
		}
		static function setDSN( $dsn ) {
			return self::instance()->set('dsn', $dsn);
		}
		
		static function setControllerMap( \MVC\Controller\ControllerMap $map  ) {
			self::instance()->set( 'cmap', $map );
		}

		static function getControllerMap() {
			return self::instance()->get( 'cmap' );
		}

		static function appController() {
						
			$obj = self::instance();
			if ( ! isset( $obj->appController ) ) {
				$cmap = $obj->getControllerMap();
				$obj->appController = new \MVC\Controller\AppController( $cmap );
			}
			return $obj->appController;
		}
		
		static function getLimit(){
			
			return false;
		}
	}
	
	/*--------------------------------------------------------------------------------*/
	class MemApplicationRegistry extends Registry {
		private static $instance;
		private $values=array();
		private $id;
		const DSN=1;

		private function __construct() {
			$this->id = @shm_attach(55, 10000, 0600);
			if ( ! $this->id ) {
				throw new Exception("could not access shared memory");
			}
		}

		static function instance() {
			if ( ! isset(self::$instance) ) { self::$instance = new self(); }
			return self::$instance;
		}

		protected function get( $key ) {
			return shm_get_var( $this->id, $key );
		}

		protected function set( $key, $val ) {
			return shm_put_var( $this->id, $key, $val );
		}

		static function getDSN() {
			return self::instance()->get(self::DSN);
		}

		static function setDSN( $dsn ) {
			return self::instance()->set(self::DSN, $dsn);
		}

	}	
?>
