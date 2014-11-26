<?php 
function tpl_546d64f2_SellingSearchCourse__maHY8AC6XhAPNkazvcxpMQ(PHPTAL $tpl, PHPTAL_Context $ctx) {
$_thistpl = $tpl ;
$_translator = $tpl->getTranslator() ;
/* tag "documentElement" from line 1 */ ;
$ctx->setDocType('<!DOCTYPE html>',false) ;
?>

<?php /* tag "html" from line 2 */; ?>
<html lang="en">	
	<?php /* tag "body" from line 3 */; ?>
<body>
		<?php /* tag "div" from line 4 */; ?>
<div class="widget-box">										
			<?php /* tag "div" from line 5 */; ?>
<div class="widget-content nopadding size-12">
				<?php /* tag "ul" from line 6 */; ?>
<ul class="activity-list">
					<?php 
/* tag "li" from line 7 */ ;
$_tmp_1 = $ctx->repeat ;
$_tmp_1->Course = new PHPTAL_RepeatController($ctx->CourseFAll)
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_1->Course as $ctx->Course): ;
?>
<li>	
						<?php 
/* tag "a" from line 8 */ ;
if (null !== ($_tmp_2 = ($ctx->Course->getName() . ' ' . $ctx->Course->getPrice1Print()))):  ;
$_tmp_2 = ' data-original-title="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a class="course-item tip-left"<?php echo $_tmp_2 ?>
>
							<?php 
/* tag "img" from line 9 */ ;
if (null !== ($_tmp_3 = ($ctx->path($ctx->Course, 'getPicture')))):  ;
$_tmp_3 = ' src="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<img width="32"<?php echo $_tmp_3 ?>
/>
							<?php 
/* tag "strong" from line 10 */ ;
if (null !== ($_tmp_3 = ($ctx->path($ctx->Course, 'getId')))):  ;
$_tmp_3 = ' alt="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
if (null !== ($_tmp_4 = ('plus'))):  ;
$_tmp_4 = ' data-delta="'.phptal_escape($_tmp_4).'"' ;
else:  ;
$_tmp_4 = '' ;
endif ;
?>
<strong class="Course"<?php echo $_tmp_3 ?>
<?php echo $_tmp_4 ?>
><?php echo phptal_escape($ctx->Course->getName() . ' ' . $ctx->Course->getPrice1Print()); ?>
</strong>
						</a>
					</li><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

				</ul>
			</div>
		</div>
		<?php /* tag "script" from line 16 */; ?>
<script>
			//-----------------------------------------------------------------------------------
			//click gọi món
			//-----------------------------------------------------------------------------------
			$('.Course').click(function(e){
				var IdCourse 	= $(this).attr('alt');
				var Delta 		= $(this).attr('data-delta');				
				var IdSession 	= $("#Session").attr('alt');
				URL = "/selling/call/table/"+IdSession+"/"+IdCourse+"/"+Delta;				
				e.stopImmediatePropagation();
				$.ajax({
					type: "POST", 
					async: false,
					url: URL,
					dataType: 'json',
					success: function(data){											
						var IdCustomer = $("#SessionAll").attr('alt');
						$("#SessionAll").load("/selling/load/customer/"+IdCustomer);
						$("#SessionView").load("/selling/load/table/"+IdSession);
					}
				});
			});
		</script>
	</body>
</html><?php 
/* end */ ;

}

?>
<?php /* 
*** DO NOT EDIT THIS FILE ***

Generated by PHPTAL from G:\AppsWeb\cmsA\sell.thanhsocola.com\mvc\templates\SellingSearchCourse.html (edit that file instead) */; ?>