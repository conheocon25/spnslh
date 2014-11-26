<?php 
function tpl_546d5e4a_Selling__bQKUw0dQhzdgHp2y97SyAA(PHPTAL $tpl, PHPTAL_Context $ctx) {
$_thistpl = $tpl ;
$_translator = $tpl->getTranslator() ;
/* tag "documentElement" from line 1 */ ;
$ctx->setDocType('<!DOCTYPE html>',false) ;
?>

<?php /* tag "html" from line 2 */; ?>
<html lang="en">
	<?php /* tag "head" from line 3 */; ?>
<head>
		<?php 
/* tag "div" from line 4 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/IncludeMETA', $_thistpl) ;
$ctx->popSlots() ;
?>

		<?php /* tag "link" from line 5 */; ?>
<link rel="stylesheet" href="/mvc/templates/theme/cms/css/icheck/flat/blue.css"/>
		<?php /* tag "link" from line 6 */; ?>
<link rel="stylesheet" href="/mvc/templates/theme/cms/css/select2.css"/>
		<?php /* tag "link" from line 7 */; ?>
<link rel="stylesheet" href="/mvc/templates/theme/cms/css/bootstrap.min.css"/>
		<?php /* tag "link" from line 8 */; ?>
<link rel="stylesheet" href="/mvc/templates/theme/cms/css/bootstrap-glyphicons.css"/>
		<?php /* tag "link" from line 9 */; ?>
<link rel="stylesheet" href="/mvc/templates/theme/cms/css/glyphicons-regular.css"/>
		<?php /* tag "link" from line 10 */; ?>
<link rel="stylesheet" href="/mvc/templates/theme/cms/css/unicorn.main.css"/>		
		<?php /* tag "link" from line 11 */; ?>
<link rel="stylesheet" href="/mvc/templates/theme/cms/css/custom.css"/>
		<?php /* tag "link" from line 12 */; ?>
<link rel="stylesheet" href="/mvc/templates/theme/cms/css/grid-menu.css"/>		
		<?php /* tag "link" from line 13 */; ?>
<link rel="stylesheet" href="/mvc/templates/theme/cms/css/gritter.css"/>
		<?php 
/* tag "link" from line 14 */ ;
if (null !== ($_tmp_1 = ('/mvc/templates/theme/cms/css/unicorn.' . \MVC\Base\SessionRegistry::instance()->getCurrentTheme() . '.css'))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<link rel="stylesheet" class="skin-color"<?php echo $_tmp_1 ?>
/>
	</head>
	<?php /* tag "body" from line 16 */; ?>
<body>
		<?php 
/* tag "div" from line 17 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/Header', $_thistpl) ;
$ctx->popSlots() ;
?>
		
		<?php /* tag "div" from line 18 */; ?>
<div id="sidebar">
			<?php /* tag "ul" from line 19 */; ?>
<ul>				
				<?php 
/* tag "li" from line 20 */ ;
$_tmp_1 = $ctx->repeat ;
$_tmp_1->Customer = new PHPTAL_RepeatController($ctx->CustomerAll)
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_1->Customer as $ctx->Customer): ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->Customer, 'getId')))):  ;
$_tmp_2 = ' alt="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<li class="Customer"<?php echo $_tmp_2 ?>
>
					<?php /* tag "a" from line 21 */; ?>
<a><?php /* tag "i" from line 21 */; ?>
<i class="glyphicons-show_big_thumbnails"></i><?php /* tag "span" from line 21 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Customer, 'getName')); ?>
</span></a>
				</li><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

			</ul>
		</div>
		<?php /* tag "div" from line 25 */; ?>
<div id="content">
			<?php 
/* tag "div" from line 26 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/ContentHeader', $_thistpl) ;
$ctx->popSlots() ;
?>

			<?php 
/* tag "div" from line 27 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/LocationBar', $_thistpl) ;
$ctx->popSlots() ;
?>

			<?php /* tag "div" from line 28 */; ?>
<div class="row">
				<?php /* tag "div" from line 29 */; ?>
<div class="col-3"><?php /* tag "div" from line 29 */; ?>
<div id="SessionAll"></div></div>
				<?php /* tag "div" from line 30 */; ?>
<div class="col-5"><?php /* tag "div" from line 30 */; ?>
<div id="SessionView"></div></div>
				<?php /* tag "div" from line 31 */; ?>
<div class="col-4">
					<?php /* tag "div" from line 32 */; ?>
<div class="widget-box">
						<?php /* tag "div" from line 33 */; ?>
<div class="controls">
							<?php /* tag "input" from line 34 */; ?>
<input id="SearchName" type="text" placeholder="Nhập tìm sản phẩm ..." style="width:75%;"/>
							<?php /* tag "a" from line 35 */; ?>
<a class="btn RemoveCourseSearch"><?php /* tag "i" from line 35 */; ?>
<i class="glyphicons-circle_remove"></i></a>
						</div>
					</div>
					<?php /* tag "div" from line 38 */; ?>
<div id="CourseF"></div>					
				</div>
			</div>			
		</div>
		<!-- END INSERT DIALOG  -->
		<?php 
/* tag "div" from line 43 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/Footer', $_thistpl) ;
$ctx->popSlots() ;
?>
		
		<?php /* tag "script" from line 44 */; ?>
<script src="/mvc/templates/theme/cms/js/jquery.min.js"></script>
		<?php /* tag "script" from line 45 */; ?>
<script src="/mvc/templates/theme/cms/js/jquery-ui.custom.js"></script>
		<?php /* tag "script" from line 46 */; ?>
<script src="/mvc/templates/theme/cms/js/bootstrap.min.js"></script>
		<?php /* tag "script" from line 47 */; ?>
<script src="/mvc/templates/theme/cms/js/unicorn.js"></script>
		<?php /* tag "script" from line 48 */; ?>
<script src="/mvc/templates/theme/cms/js/jquery.jpanelmenu.min.js"></script>
		<?php /* tag "script" from line 49 */; ?>
<script src="/mvc/templates/theme/cms/js/jquery.icheck.min.js"></script>
		<?php /* tag "script" from line 50 */; ?>
<script src="/mvc/templates/theme/cms/js/select2.min.js"></script>		
        <?php /* tag "script" from line 51 */; ?>
<script src="/mvc/templates/theme/cms/js/jquery.masonry.min.js"></script>
		<?php /* tag "script" from line 52 */; ?>
<script src="/mvc/templates/theme/cms/js/jquery.validate.js"></script>
						
        <?php /* tag "script" from line 54 */; ?>
<script>						
			//NẠP DANH SÁCH GIAO DỊCH VỚI KHÁCH HÀNG
			$('.Customer').click(function(){				
				var IdCustomer = $(this).attr('alt');				
				$("#SessionAll").load("/selling/load/customer/"+IdCustomer);
				$(this).toggleClass('active').siblings().removeClass('active');
				$("#SearchName").focus();
			});
			$('.Customer:first').click();
												
			//---------------------------------------------------------------------------
			//Xử lí search tên			
			$('#SearchName').keyup(function(e){
				var Name 		= $(this).val();										
				$("#CourseF").load("/selling/search/course", { Name: Name });
			});
			
			//-----------------------------------------------------------------------------------
			//CALL COURSE
			$(".RemoveCourseSearch").click(function(){$("#CourseF").html("");});
									
			//Mặc định vào ô tìm kiếm
			$("#SearchName").focus();
			
        </script>
	</body>
</html><?php 
/* end */ ;

}

?>
<?php /* 
*** DO NOT EDIT THIS FILE ***

Generated by PHPTAL from G:\AppsWeb\cmsA\sell.thanhsocola.com\mvc\templates\Selling.html (edit that file instead) */; ?>