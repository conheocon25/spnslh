<?php 
function tpl_546d5d10_SellingCustomerLoad__InOJs4fauROLMFF2fPhTkw(PHPTAL $tpl, PHPTAL_Context $ctx) {
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
<div id="SessionAll" class="widget-box">			
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
$_tmp_1 = $ctx->repeat ;
$_tmp_1->Session = new PHPTAL_RepeatController($ctx->path($ctx->Customer, 'getSessionAll'))
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_1->Session as $ctx->Session): ;
?>
<tr>							
							<?php /* tag "td" from line 15 */; ?>
<td><?php 
/* tag "div" from line 15 */ ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->Session, 'getId')))):  ;
$_tmp_2 = ' alt="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<div style="cursor: pointer" class="SessionView text-left"<?php echo $_tmp_2 ?>
><?php echo phptal_escape($ctx->path($ctx->Session, 'getDateTimePrint')); ?>
</div></td>
							<?php /* tag "td" from line 16 */; ?>
<td><?php 
/* tag "div" from line 16 */ ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->Session, 'getId')))):  ;
$_tmp_2 = ' alt="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<div style="cursor: pointer" class="SessionView text-right"<?php echo $_tmp_2 ?>
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
if (null !== ($_tmp_2 = ($ctx->path($ctx->Customer, 'getId')))):  ;
$_tmp_2 = ' alt="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<div class="btn SessionInsert"<?php echo $_tmp_2 ?>
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
				alert(IdCustomer);
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