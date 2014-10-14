<?php 
function tpl_535a7f73_ASettingPresentation__Hd3mUwBc8USbG43JFCncKQ(PHPTAL $tpl, PHPTAL_Context $ctx) {
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
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/MenuSettingPost', $_thistpl) ;
$ctx->popSlots() ;
?>

		<?php /* tag "div" from line 11 */; ?>
<div id="content">
			<?php 
/* tag "div" from line 12 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/ContentHeader', $_thistpl) ;
$ctx->popSlots() ;
?>

			<?php 
/* tag "div" from line 13 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/Locationbar', $_thistpl) ;
$ctx->popSlots() ;
?>

			<?php /* tag "div" from line 14 */; ?>
<div class="row">
				<?php /* tag "div" from line 15 */; ?>
<div class="col-12">
					<?php /* tag "a" from line 16 */; ?>
<a href="#DialogIns" data-toggle="modal" class="btn btn-primary btn-ins">
						<?php /* tag "i" from line 17 */; ?>
<i class="glyphicons-plus"></i> Thêm mới
					</a>
					<?php /* tag "a" from line 19 */; ?>
<a href="#DialogDelSelected" data-toggle="modal" class="btn btn-primary btn-ins">
						<?php /* tag "i" from line 20 */; ?>
<i class="glyphicons-remove_2"></i> Xóa chọn
					</a>
					<?php /* tag "div" from line 22 */; ?>
<div class="widget-box">
						<?php /* tag "div" from line 23 */; ?>
<div class="widget-content nopadding">
							<?php /* tag "table" from line 24 */; ?>
<table class="table table-bordered table-striped table-hover with-check">								
								<?php /* tag "thead" from line 25 */; ?>
<thead>
									<?php /* tag "tr" from line 26 */; ?>
<tr>
										<?php /* tag "th" from line 27 */; ?>
<th width="40"><?php /* tag "input" from line 27 */; ?>
<input type="checkbox" id="title-table-checkbox" name="title-table-checkbox"/></th>
										<?php /* tag "th" from line 28 */; ?>
<th class="left">TÊN</th>
										<?php /* tag "th" from line 29 */; ?>
<th width="60" class="right">T.TỰ</th>
										<?php /* tag "th" from line 30 */; ?>
<th width="120"><?php /* tag "div" from line 30 */; ?>
<div class="text-right">CHI TIẾT</div></th>										
										<?php /* tag "th" from line 31 */; ?>
<th width="40"><?php /* tag "i" from line 31 */; ?>
<i class="glyphicons-bin"></i></th>
									</tr>
								</thead>
								<?php /* tag "tbody" from line 34 */; ?>
<tbody>
									<?php 
/* tag "tr" from line 35 */ ;
$_tmp_1 = $ctx->repeat ;
$_tmp_1->Presentation = new PHPTAL_RepeatController($ctx->PresentationAll)
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_1->Presentation as $ctx->Presentation): ;
?>
<tr>
										<?php /* tag "td" from line 36 */; ?>
<td class="center"><?php 
/* tag "input" from line 36 */ ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->Presentation, 'getId')))):  ;
$_tmp_2 = ' data-id="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<input class="CheckedDel" type="checkbox"<?php echo $_tmp_2 ?>
/></td>
										<?php /* tag "td" from line 37 */; ?>
<td><?php 
/* tag "a" from line 37 */ ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->Presentation, 'getId')))):  ;
$_tmp_2 = ' data-id="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a class="update-item" href="#DialogEdit" data-toggle="modal" data-name="Presentation"<?php echo $_tmp_2 ?>
><?php echo phptal_escape($ctx->path($ctx->Presentation, 'getName')); ?>
</a></td>
										<?php /* tag "td" from line 38 */; ?>
<td class="right"><?php /* tag "span" from line 38 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Presentation, 'getOrder')); ?>
</span></td>
										<?php /* tag "td" from line 39 */; ?>
<td class="right"><?php 
/* tag "a" from line 39 */ ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->Presentation, 'getURLSetting')))):  ;
$_tmp_2 = ' href="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a<?php echo $_tmp_2 ?>
><?php /* tag "span" from line 39 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Presentation, 'getSlideAll/count')); ?>
</span> Slide</a></td>
										<?php /* tag "td" from line 40 */; ?>
<td class="center"><?php 
/* tag "a" from line 40 */ ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->Presentation, 'getId')))):  ;
$_tmp_2 = ' data-id="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a class="remove-item" href="#DialogDel" data-toggle="modal"<?php echo $_tmp_2 ?>
><?php /* tag "i" from line 40 */; ?>
<i class="glyphicon glyphicon-remove"></i></a></td>
									</tr><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

								</tbody>								
							</table>
						</div>
					</div>					
					<!-- INSERT DIALOG  -->
					<?php /* tag "div" from line 47 */; ?>
<div id="DialogIns" class="modal fade">
						<?php /* tag "div" from line 48 */; ?>
<div class="modal-dialog">
							<?php /* tag "div" from line 49 */; ?>
<div class="modal-content">
								<?php /* tag "div" from line 50 */; ?>
<div class="modal-header"><?php /* tag "h3" from line 50 */; ?>
<h3><?php /* tag "i" from line 50 */; ?>
<i class="glyphicons-show_big_thumbnails modal-icon"></i>THÊM MỚI TRÌNH BÀY</h3></div>
								<?php /* tag "form" from line 51 */; ?>
<form id="FormPresentationInsert" action="#" class="form-horizontal" novalidate="novalidate">
									<?php /* tag "div" from line 52 */; ?>
<div class="modal-body">
										<?php /* tag "div" from line 53 */; ?>
<div class="control-group">
											<?php /* tag "label" from line 54 */; ?>
<label class="control-label">Tên</label>
											<?php /* tag "div" from line 55 */; ?>
<div class="controls">
												<?php /* tag "input" from line 56 */; ?>
<input id="Name1" name="Name1" type="text" class="form-control input-small"/>
											</div>
										</div>
										<?php /* tag "div" from line 59 */; ?>
<div class="control-group">
											<?php /* tag "label" from line 60 */; ?>
<label class="control-label">Thứ tự</label>
											<?php /* tag "div" from line 61 */; ?>
<div class="controls">
												<?php /* tag "input" from line 62 */; ?>
<input id="Order1" name="Order1" type="text" class="form-control input-small"/>
											</div>
										</div>
									</div>
									<?php /* tag "div" from line 66 */; ?>
<div class="modal-footer">
										<?php /* tag "button" from line 67 */; ?>
<button id="URLInsButton" class="btn btn-primary btn-small"><?php /* tag "i" from line 67 */; ?>
<i class="glyphicons-download_alt"></i> Lưu</button>
										<?php /* tag "button" from line 68 */; ?>
<button data-dismiss="modal" class="btn btn-default btn-small"><?php /* tag "i" from line 68 */; ?>
<i class="glyphicons-undo"></i> Hủy</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- END INSERT DIALOG  -->
					
					<!-- UPDATE DIALOG  -->
					<?php /* tag "div" from line 77 */; ?>
<div id="DialogEdit" class="modal fade">
						<?php /* tag "div" from line 78 */; ?>
<div class="modal-dialog">
							<?php /* tag "div" from line 79 */; ?>
<div class="modal-content">
								<?php /* tag "div" from line 80 */; ?>
<div class="modal-header"><?php /* tag "h3" from line 80 */; ?>
<h3><?php /* tag "i" from line 80 */; ?>
<i class="glyphicons-show_big_thumbnails modal-icon"></i>CẬP NHẬT TRÌNH BÀY</h3></div>
								<?php /* tag "form" from line 81 */; ?>
<form id="FormPresentationUpdate" action="#" class="form-horizontal" novalidate="novalidate">
									<?php /* tag "div" from line 82 */; ?>
<div class="modal-body">
										<?php /* tag "div" from line 83 */; ?>
<div class="control-group">
											<?php /* tag "label" from line 84 */; ?>
<label class="control-label">Tên</label>
											<?php /* tag "div" from line 85 */; ?>
<div class="controls">
												<?php /* tag "input" from line 86 */; ?>
<input id="Name2" name="Name2" type="text" class="form-control input-small"/>
											</div>
										</div>
										<?php /* tag "div" from line 89 */; ?>
<div class="control-group">
											<?php /* tag "label" from line 90 */; ?>
<label class="control-label">Thứ tự</label>
											<?php /* tag "div" from line 91 */; ?>
<div class="controls">
												<?php /* tag "input" from line 92 */; ?>
<input id="Order2" name="Order2" type="text" class="form-control input-small"/>
											</div>
										</div>
									</div>
									<?php /* tag "div" from line 96 */; ?>
<div class="modal-footer">
										<?php /* tag "button" from line 97 */; ?>
<button id="URLUpdButton" class="btn btn-primary btn-small" type="submit"><?php /* tag "i" from line 97 */; ?>
<i class="glyphicons-download_alt"></i> Lưu</button>
										<?php /* tag "button" from line 98 */; ?>
<button data-dismiss="modal" class="btn btn-default btn-small"><?php /* tag "i" from line 98 */; ?>
<i class="glyphicons-undo"></i> Hủy</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- END UPDATE DIALOG  -->
					<?php 
/* tag "div" from line 105 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mDialog.xhtml/DialogDel', $_thistpl) ;
$ctx->popSlots() ;
?>

					<?php 
/* tag "div" from line 106 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mDialog.xhtml/DialogDelSelected', $_thistpl) ;
$ctx->popSlots() ;
?>

				</div>
			</div>
		</div>
		<?php 
/* tag "div" from line 110 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/Footer', $_thistpl) ;
$ctx->popSlots() ;
?>

		<?php 
/* tag "div" from line 111 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/IncludeJS', $_thistpl) ;
$ctx->popSlots() ;
?>

		<?php /* tag "script" from line 112 */; ?>
<script type="text/javascript">
		/*<![CDATA[*/
			$('#URLDelSelectedButton').click(function(){
				var count = 0;
				var Data = [];
				var URL = "/object/del/Presentation/0";
				
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
				var URL = "/object/del/Presentation/" + $(this).attr('alt');
				$.ajax({
					type: "POST",					
					url: URL,
					success: function(msg){
						location.reload();
					}
				});
			});
		
			//-----------------------------------------------------------------------------------
			//Insert 1 Presentation			
			$("#FormPresentationInsert").validate({
				rules:{
					Name1:{
						minlength: 2,
						required:true
					}
				},
				errorClass: "help-inline",
				errorElement: "span",
				highlight:function(element, errorClass, validClass) {
					$(element).parents('.form-group').addClass('has-error');
				},
				unhighlight: function(element, errorClass, validClass) {
					$(element).parents('.form-group').removeClass('has-error');
					$(element).parents('.form-group').addClass('has-success');
				},
				submitHandler: function (form) {					
					var Data = [];
					Data[0] = 'null';					
					Data[1] = $('#Name1').val();
					Data[2] = $('#Order1').val();
					
					var URL = "/object/ins/Presentation";
					$.ajax({
						type: "POST",
						data: {Data:Data},
						url: URL,
						success: function(msg){
							location.reload();
						}
					});
					return false;
				}
			});
			$("#DialogIns").on('show.bs.modal', function(event){
				window.setTimeout(
					function(){$(event.currentTarget).find('input#Name1').first().focus()},
					0500
				);
			});
			
			//-----------------------------------------------------------------------------------
			//Load 1 Presentation
			//-----------------------------------------------------------------------------------
			$('.update-item').click(function(){
				//Load dữ liệu JSON về
				var url = "/object/load/Presentation/" + $(this).attr('data-id');
				
				//Load dữ liệu JSON lên FORM
				$.getJSON(url, function(data){
					$('#URLUpdButton').attr('alt', data.Id);
					$('#Name2').attr('value', data.Name);
					$('#Order2').attr('value', data.Order);
				});
			});
			
			//-----------------------------------------------------------------------------------
			//Update 1 Presentation
			//-----------------------------------------------------------------------------------
			$("#FormPresentationUpdate").validate({
				rules:{
					Name2:{
						minlength: 2,
						required:true
					}
				},
				errorClass: "help-inline",
				errorElement: "span",
				highlight:function(element, errorClass, validClass) {
					$(element).parents('.form-group').addClass('has-error');
				},
				unhighlight: function(element, errorClass, validClass) {
					$(element).parents('.form-group').removeClass('has-error');
					$(element).parents('.form-group').addClass('has-success');
				},
				submitHandler: function (form) {					
					var Data = [];
					Data[0] = $('#URLUpdButton').attr('alt');					
					Data[1] = $('#Name2').val();
					Data[2] = $('#Order2').val();
																		
					var URL = "/object/upd/Presentation";
					$.ajax({
						type: "POST",
						data: {Data:Data},
						url: URL,
						success: function(msg){
							location.reload();
						}
					});		
					return false;
				}
			});
			$("#DialogEdit").on('show.bs.modal', function(event){
				window.setTimeout(
					function(){$(event.currentTarget).find('input#Name2').first().focus()},
					0500
				);
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

Generated by PHPTAL from G:\AppsWeb\cmsA\www.amthuclangsen.com\mvc\templates\ASettingPresentation.html (edit that file instead) */; ?>