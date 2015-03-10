<?php
	namespace MVC\Command;	
	use MVC\Library\ReadRss;
	require_once('mvc/library/SimpleHtmlDom.php');	
	class APostPublished extends Command{
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			
			//$IdRss = $request->getProperty('IdRss');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			
			$mRssLink 		= new \MVC\Mapper\RssLink();
			$mPostRss 		= new \MVC\Mapper\PostRss();
			$mPost 			= new \MVC\Mapper\Post();
			$mConfig 		= new \MVC\Mapper\Config();
			$mTag 			= new \MVC\Mapper\Tag();
			$mPostTag 		= new \MVC\Mapper\PostTag();
		
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------	
			
			\ini_set('max_execution_time', 300); //300 seconds = 5 minutes
			
			$dConfig = $mConfig->findByName("AUTO_POST");
			
			$AUTOPost = $dConfig->getValue();
			
			
			$DRssLinkAll = $mRssLink->findAll();
			
			while ($DRssLinkAll->valid())
			{			
					$dRssLink 			= $DRssLinkAll->current();					
					$IdRss 				= $dRssLink->getId();
					$WebUrl 			= $dRssLink->getWeburl();
					$Url 				= $dRssLink->getRssurl();
					
					$ClassAuthor 		= $dRssLink->getClassAuthor();
					$ClassContent 		= $dRssLink->getClassContentName();
					$ImgPath 			= $dRssLink->getImgPath();
									
					$IdTag 				= $dRssLink->getIdTag();
					$IdTypeRss 			= $dRssLink->getType();
					
					$dTagPost = $mTag->find($IdTag);
				
					$todaytime = new \DateTime('NOW');
					$interval = new \DateInterval('P0Y0DT11H0M');	
					$strDatatime = "_" . $todaytime->format('Y-m-d_H_i_s');
					
					$ReadRssXml = new ReadRss($Url);				
					$ReadRssXml->ReadRssXMLByCurl();				
					$chItems = $ReadRssXml->GetItems();
					
					
					//Công thêm 11 tiếng do lệch múi giờ Mỹ - Việt Nam
					$DatePost = $todaytime->add($interval);
					//Số lấy tin trước đó để so sánh
					$intervalSub = new \DateInterval('P0Y02DT0H0M');
					
					$DateEnd = $DatePost->format('Y-m-d') . " 23:59:59";
					
					$DatePost = $DatePost->sub($intervalSub);
					$DateStart = $DatePost->format('Y-m-d') . " 0:0:0";
					
					//echo "Ngày bắt đầu: " . $DateStart . "<br />";
					//echo "Ngày kết thúc: " .$DateEnd. "<br />";
					
					$ListPost = $mPost->findByDateTime(array($DateStart, $DateEnd));
					
					$ListOldPost = array();
					$k=0;		
					while ($ListPost->valid()){
						$dPost = $ListPost->current();
							$OldNew = trim($dPost->getTitle());
							$OldNew = mb_convert_case($OldNew, MB_CASE_LOWER, "UTF-8"); 
							$ListOldPost[$k] = $OldNew;	
							$k=$k +1;
						$ListPost->next();
					}							
								
					$flagIns = false;				
					$i = 0;
					$lengthOld = count($ListOldPost);
					
					if (is_array($chItems) and count($chItems)>0)
					{					
						foreach ($chItems as $key => $item)
						{
							$CurTitle = trim($item['title']);						
							$CurTitle = mb_convert_case($CurTitle, MB_CASE_LOWER, "UTF-8"); 
							
							if ($lengthOld < 0) 
							{
								$lengthOld =0;
							}
								for($l=0; $l < $lengthOld; ++$l) {
										$OldNew = $ListOldPost[$l];															
										if (strcmp($OldNew, $CurTitle) == 0) {
											$flagIns = true;									
											break;
										}								
								}
							
							if ($flagIns == false) {
								
								$curl_Url = trim($item['link']);
								
								$curl_handle=curl_init();
								curl_setopt($curl_handle, CURLOPT_URL, $curl_Url);
								curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
								curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);				
								curl_setopt($curl_handle, CURLOPT_BINARYTRANSFER, true);
								curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, FALSE);				
								//curl_setopt($curl_handle, CURLOPT_USERAGENT, $WebUrl);
								$data = curl_exec($curl_handle);
								curl_close($curl_handle);
								
								$dom = new \DOMDocument();
								@$dom->loadHTML($data);
								
								$dom->saveHTMLFile("data/autopost_". $IdTag . "_" . $strDatatime . "_" . $i . ".html");
								
								$HTML = file_get_html("data/autopost_". $IdTag . "_" . $strDatatime . "_" . $i . ".html");					
									
								$PostAuthor = $HTML->find('.' . $ClassAuthor, 0);										
								$PostContent = $HTML->find('.' . $ClassContent, 0);					
								// Loc Class ko hien thi
																
								if ( $ImgPath == 0) {
									foreach( $PostContent->find('img') as $img){
										if (substr($img->src,0,1) == "/")
											$img->src =  $WebUrl .$img->src; 
									}
								}
								
								$PostContentSlash 	= \stripslashes($PostContent);								
								
								if ($IdTypeRss == 2) {									
									foreach( $PostContent->find('script') as $Script) {
										if (isset($Script)) $Script->src = "";
									}
								}
								
								if (!isset($PostAuthor)) {
									$PostAuthor = "BBT";
								}else {
									$PostAuthor = html_entity_decode($PostAuthor->plaintext, ENT_QUOTES, 'UTF-8');
								}	
								
								$timepost = new \DateTime('NOW');
								$interval = new \DateInterval('P0Y0DT11H0M');													
								//Công thêm 11 tiếng do lệch múi giờ Mỹ - Việt Nam
								$DatePost = $timepost; //->add($interval);
					
								// Thêm tin mới	nếu $AUTOPost = 1 thì ko cần duyệt tin còn $AUTOPost = 0 thì vào PostRss chờ duyệt tin	
								if ($AUTOPost == 1) {
									$Post = new \MVC\Domain\Post(
										null,
										$item['title'],
										$PostContentSlash,
										$PostAuthor,
										$DatePost->format('Y-m-d H:i:s') ,
										1,
										"",
										10,
										0
									);
									$Post->reKey();									
									$mPost->insert($Post);
									
									$idPost = $Post->getId();
									
									$dPostTag = new \MVC\Domain\PostTag(
											null,
											$idPost,
											$IdTag
										);
									$mPostTag->insert($dPostTag);
									
								} else {
									$PostRss = new \MVC\Domain\PostRss(
										null,																			
										$item['title'],
										$PostContentSlash,
										$PostAuthor,
										$DatePost->format('Y-m-d H:i:s') ,
										1,
										"",
										10,
										0
									);
									$PostRss->reKey();
									$mPostRss->insert($PostRss);									
								}
									$i= $i + 1;
									echo "<br /> " . $i . "Đã thêm tin moi: " . $CurTitle . " <br />";
								
								//unset($dom);
								//unset($HTML);								
								//unset($Post);						
								//unset($PostRss);														
								$PostAuthor = "";
								$PostContent = "";														
							}
							$flagIns = false;
						}
							
					}
					
					echo "<br />  Đã thêm ". $i . " của vào Danh mục: " . $dTagPost->getName();
					
				array_map('unlink', glob("data/*.html")); 
				
				$DRssLinkAll->next();				
			}
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			return self::statuses('CMD_OK');			
		}
	}
?>