<?php 
function tpl_535a9372_ASettingSlide__NNrx4sejwT0_myW48s8Y1g(PHPTAL $tpl, PHPTAL_Context $ctx) {
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

		<?php 
/* tag "div" from line 5 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/IncludeCSS', $_thistpl) ;
$ctx->popSlots() ;
?>

	</head>
	
	<?php /* tag "body" from line 8 */; ?>
<body>
		<?php 
/* tag "div" from line 9 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/Header', $_thistpl) ;
$ctx->popSlots() ;
?>

		<?php 
/* tag "div" from line 10 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/StyleTools', $_thistpl) ;
$ctx->popSlots() ;
?>

		<?php /* tag "div" from line 11 */; ?>
<div id="sidebar">
			<?php /* tag "ul" from line 12 */; ?>
<ul style="display: block;">
				<?php 
/* tag "li" from line 13 */ ;
$_tmp_1 = $ctx->repeat ;
$_tmp_1->Presentation1 = new PHPTAL_RepeatController($ctx->PresentationAll)
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_1->Presentation1 as $ctx->Presentation1): ;
if (null !== ($_tmp_2 = ($ctx->Presentation1->getId()==$ctx->Presentation->getId()?'active':'disable'))):  ;
$_tmp_2 = ' class="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<li<?php echo $_tmp_2 ?>
>
					<?php 
/* tag "a" from line 14 */ ;
if (null !== ($_tmp_3 = ($ctx->path($ctx->Presentation1, 'getURLSetting')))):  ;
$_tmp_3 = ' href="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<a<?php echo $_tmp_3 ?>
>
						<?php /* tag "i" from line 15 */; ?>
<i class="glyphicons-show_big_thumbnails"></i><?php /* tag "span" from line 15 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Presentation1, 'getName')); ?>
</span>
					</a>
				</li><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

			</ul>
		</div>
		<?php /* tag "div" from line 20 */; ?>
<div id="content">
			<?php 
/* tag "div" from line 21 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/ContentHeader', $_thistpl) ;
$ctx->popSlots() ;
?>

			<?php 
/* tag "div" from line 22 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/Locationbar', $_thistpl) ;
$ctx->popSlots() ;
?>

			<?php /* tag "div" from line 23 */; ?>
<div class="row">
				<?php /* tag "div" from line 24 */; ?>
<div class="col-12">
					<?php 
/* tag "a" from line 25 */ ;
if (null !== ($_tmp_3 = ($ctx->path($ctx->Presentation, 'getURLSettingSlideInsLoad')))):  ;
$_tmp_3 = ' href="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<a class="btn btn-primary btn-ins"<?php echo $_tmp_3 ?>
>
						<?php /* tag "i" from line 26 */; ?>
<i class="glyphicons-plus"></i> Thêm mới
					</a>
					<?php /* tag "a" from line 28 */; ?>
<a href="#DialogDelSelected" data-toggle="modal" class="btn btn-primary btn-ins">
						<?php /* tag "i" from line 29 */; ?>
<i class="glyphicons-remove_2"></i> Xóa chọn
					</a>
					<?php /* tag "div" from line 31 */; ?>
<div class="widget-box">
						<?php /* tag "div" from line 32 */; ?>
<div class="widget-content nopadding">
							<?php /* tag "table" from line 33 */; ?>
<table class="table table-bordered table-striped table-hover with-check">								
								<?php /* tag "thead" from line 34 */; ?>
<thead>
									<?php /* tag "tr" from line 35 */; ?>
<tr>
										<?php /* tag "th" from line 36 */; ?>
<th width="40"><?php /* tag "input" from line 36 */; ?>
<input type="checkbox" id="title-table-checkbox" name="title-table-checkbox"/></th>
										<?php /* tag "th" from line 37 */; ?>
<th class="left">TÊN</th>
										<?php /* tag "th" from line 38 */; ?>
<th width="60" class="right">T.TỰ</th>										
										<?php /* tag "th" from line 39 */; ?>
<th width="40"><?php /* tag "i" from line 39 */; ?>
<i class="glyphicons-bin"></i></th>
									</tr>
								</thead>
								<?php /* tag "tbody" from line 42 */; ?>
<tbody>
									<?php 
/* tag "tr" from line 43 */ ;
$_tmp_2 = $ctx->repeat ;
$_tmp_2->Slide = new PHPTAL_RepeatController($ctx->path($ctx->Presentation, 'getSlideAll'))
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_2->Slide as $ctx->Slide): ;
?>
<tr>
										<?php /* tag "td" from line 44 */; ?>
<td class="center"><?php 
/* tag "input" from line 44 */ ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->Slide, 'getId')))):  ;
$_tmp_1 = ' data-id="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<input class="CheckedDel" type="checkbox"<?php echo $_tmp_1 ?>
/></td>
										<?php /* tag "td" from line 45 */; ?>
<td><?php 
/* tag "a" from line 45 */ ;
if (null !== ($_tmp_3 = ($ctx->path($ctx->Slide, 'getURLSettingUpdLoad')))):  ;
$_tmp_3 = ' href="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<a<?php echo $_tmp_3 ?>
><?php echo phptal_escape($ctx->path($ctx->Slide, 'getName')); ?>
</a></td>
										<?php /* tag "td" from line 46 */; ?>
<td class="right"><?php /* tag "span" from line 46 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Slide, 'getOrder')); ?>
</span></td>
										<?php /* tag "td" from line 47 */; ?>
<td class="center"><?php 
/* tag "a" from line 47 */ ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->Slide, 'getId')))):  ;
$_tmp_1 = ' data-id="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a class="remove-item" href="#DialogDel" data-toggle="modal"<?php echo $_tmp_1 ?>
><?php /* tag "i" from line 47 */; ?>
<i class="glyphicon glyphicon-remove"></i></a></td>
									</tr><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

								</tbody>								
							</table>
						</div>
					</div>					
															
					<?php 
/* tag "div" from line 54 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mDialog.xhtml/DialogDel', $_thistpl) ;
$ctx->popSlots() ;
?>

					<?php 
/* tag "div" from line 55 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mDialog.xhtml/DialogDelSelected', $_thistpl) ;
$ctx->popSlots() ;
?>

				</div>
			</div>
		</div>
		<?php 
/* tag "div" from line 59 */ ;
if (null !== ($_tmp_3 = ($ctx->path($ctx->Presentation, 'getId')))):  ;
$_tmp_3 = ' alt="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<div id="PresentationCurrent"<?php echo $_tmp_3 ?>
></div>
		<?php 
/* tag "div" from line 60 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/Footer', $_thistpl) ;
$ctx->popSlots() ;
?>

		<?php 
/* tag "div" from line 61 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/IncludeJS', $_thistpl) ;
$ctx->popSlots() ;
?>

		<?php /* tag "script" from line 62 */; ?>
<script type="text/javascript">
		/*<![CDATA[*/
			$('#URLDelSelectedButton').click(function(){
				var count = 0;
				var Data = [];
				var URL = "/object/del/Slide/0";
				
				$(".CheckedDel").each(function( i, obj){
					if ( $(this).is(':checked')==true ){
						count += 1;
						Data[count] = $(this).attr('data-id');
					}
				});
				
				$.ajax({
					type: "POST",
					data: {ListId:Data},
					url: URL,
					success: function(msg){
						location.reload();
					}
				});
			});
			
			//-----------------------------------------------------------------------------------
			//Delete 1 Presentation			
			//-----------------------------------------------------------------------------------
			$('.remove-item').click(function(){
				$('#URLDelButton').attr('alt', $(this).attr('data-id'));
			});
			//Khi người dùng Click vào nút URLDelButton thì tiến  hành gọi Ajax xóa tự động
			$('#URLDelButton').click(function(){			
				var URL = "/object/del/Slide/" + $(this).attr('alt');
				$.ajax({
					type: "POST",					
					url: URL,
					success: function(msg){
						location.reload();
					}
				});
			});
				
		/*]]>*/
		</script>
	</body>
</html><?php 
/* end */ ;

}

?>
<?php /* 
*** DO NOT EDIT THIS FILE ***

Generated by PHPTAL from G:\AppsWeb\cmsA\www.amthuclangsen.com\mvc\templates\ASettingSlide.html (edit that file instead) */; ?>