<?php 
function tpl_546d64cf_SellingCustomerLoad__InOJs4fauROLMFF2fPhTkw(PHPTAL $tpl, PHPTAL_Context $ctx) {
$_thistpl = $tpl ;
$_translator = $tpl->getTranslator() ;
/* tag "documentElement" from line 1 */ ;
$ctx->setDocType('<!DOCTYPE html>',false) ;
?>

<?php /* tag "html" from line 2 */; ?>
<html lang="en">
	<?php /* tag "body" from line 3 */; ?>
<body>		
		<?php 
/* tag "div" from line 4 */ ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->Customer, 'getId')))):  ;
$_tmp_1 = ' alt="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<div id="SessionAll" class="widget-box"<?php echo $_tmp_1 ?>
>
			<?php /* tag "div" from line 5 */; ?>
<div class="widget-content nopadding">				
				<?php /* tag "table" from line 6 */; ?>
<table class="table table-striped table-hover">
					<?php /* tag "thead" from line 7 */; ?>
<thead>
						<?php /* tag "tr" from line 8 */; ?>
<tr>																	
							<?php /* tag "th" from line 9 */; ?>
<th><?php /* tag "div" from line 9 */; ?>
<div class="text-left">NGÀY</div></th>
							<?php /* tag "th" from line 10 */; ?>
<th><?php /* tag "div" from line 10 */; ?>
<div class="text-right">PHIẾU</div></th>								
						</tr>
					</thead>
					<?php /* tag "tbody" from line 13 */; ?>
<tbody>
						<?php 
/* tag "tr" from line 14 */ ;
$_tmp_2 = $ctx->repeat ;
$_tmp_2->Session = new PHPTAL_RepeatController($ctx->path($ctx->Customer, 'getSessionAll'))
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_2->Session as $ctx->Session): ;
?>
<tr>							
							<?php /* tag "td" from line 15 */; ?>
<td><?php 
/* tag "div" from line 15 */ ;
if (null !== ($_tmp_3 = ($ctx->path($ctx->Session, 'getId')))):  ;
$_tmp_3 = ' alt="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<div style="cursor: pointer" class="SessionView text-left"<?php echo $_tmp_3 ?>
><?php echo phptal_escape($ctx->path($ctx->Session, 'getDateTimePrint')); ?>
</div></td>
							<?php /* tag "td" from line 16 */; ?>
<td><?php 
/* tag "div" from line 16 */ ;
if (null !== ($_tmp_3 = ($ctx->path($ctx->Session, 'getId')))):  ;
$_tmp_3 = ' alt="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<div style="cursor: pointer" class="SessionView text-right"<?php echo $_tmp_3 ?>
><?php /* tag "span" from line 16 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Session, 'getValuePrint')); ?>
</span></div></td>
						</tr><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

					</tbody>
				</table>
				<?php 
/* tag "div" from line 20 */ ;
if (null !== ($_tmp_3 = ($ctx->path($ctx->Customer, 'getId')))):  ;
$_tmp_3 = ' alt="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<div class="btn SessionInsert"<?php echo $_tmp_3 ?>
><?php /* tag "i" from line 20 */; ?>
<i class="glyphicons-circle_plus"></i> thêm mới</div>
			</div>					
		</div>						
        <?php /* tag "script" from line 23 */; ?>
<script>
			$(".SessionView").click(function(){
				var IdSession = $(this).attr('alt');				
				$("#SessionView").load("/selling/load/table/"+IdSession);
			});
			
			//Mặc định lấy click của BÀN đầu tiên
			$('.SessionView:first').click();
			
			$(".SessionInsert").click(function(){
				var IdCustomer = $(this).attr('alt');								
				var Data = [];
				var URL = "/selling/session/insert/"+IdCustomer;												
				$.ajax({
					type: "POST",					
					url: URL,
					success: function(msg){						
						$("#SessionAll").load("/selling/load/customer/"+IdCustomer);
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

Generated by PHPTAL from G:\AppsWeb\cmsA\sell.thanhsocola.com\mvc\templates\SellingCustomerLoad.html (edit that file instead) */; ?>