<?php		
	namespace MVC\Command;	
	class SettingInitExe extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
									
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mStudentTemp = new \MVC\Mapper\StudentTemp();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			\ini_set('max_execution_time', 300); //300 seconds = 5 minutes

			//Xóa hết dữ liệu cũ
			$mStudentTemp->deleteAll(array());
						
			//Tải lên dữ liệu mới từ file Excel
			$DataExcel = new \Spreadsheet_Excel_Reader("data/src/hocsinh.xls",true);
			
			$DEI = 2;
			
			$StrCode = $DataExcel->val($DEI,'A');
			while ($StrCode !=""){
			
				$StrCode 		= $DataExcel->val($DEI,'A');
				$StrSurName 	= $DataExcel->val($DEI,'B');
				$StrLastName 	= $DataExcel->val($DEI,'C');
				$StrCodeExt1 	= $DataExcel->val($DEI,'D');
				$StrBirthday 	= $DataExcel->val($DEI,'E');
				$StrGender 		= $DataExcel->val($DEI,'F');
				$CA				= explode(" ", $DataExcel->val($DEI,'G'));
				$StrClass 		= \end($CA);
																
				if ($StrSurName !=""){
					$StudentTemp = new \MVC\Domain\StudentTemp(
						null,
						$StrCode,
						$StrSurName,
						$StrLastName,
						$StrCodeExt1,
						$StrBirthday,
						$StrGender,
						$StrClass
					);								
					$mStudentTemp->insert($StudentTemp);
				}				
				$DEI++;
			}			
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
									
			return self::statuses('CMD_DEFAULT');
		}
	}
?>