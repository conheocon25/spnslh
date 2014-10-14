<?php 
function tpl_542ba9fb_ASettingCategory__AWcbLWsjgLMm2I2e8kkKyg(PHPTAL $tpl, PHPTAL_Context $ctx) {
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
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/MenuSettingProduct', $_thistpl) ;
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
<i class="glyphicons-edit"></i></th>
										<?php /* tag "th" from line 32 */; ?>
<th width="40"><?php /* tag "i" from line 32 */; ?>
<i class="glyphicons-bin"></i></th>
									</tr>
								</thead>
								<?php /* tag "tbody" from line 35 */; ?>
<tbody>
									<?php 
/* tag "tr" from line 36 */ ;
$_tmp_1 = $ctx->repeat ;
$_tmp_1->Category = new PHPTAL_RepeatController($ctx->CategoryAll1)
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_1->Category as $ctx->Category): ;
?>
<tr>
										<?php /* tag "td" from line 37 */; ?>
<td class="center"><?php 
/* tag "input" from line 37 */ ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->Category, 'getId')))):  ;
$_tmp_2 = ' data-id="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<input class="CheckedDel" type="checkbox"<?php echo $_tmp_2 ?>
/></td>
										<?php /* tag "td" from line 38 */; ?>
<td><?php 
/* tag "a" from line 38 */ ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->Category, 'getId')))):  ;
$_tmp_2 = ' data-id="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a class="update-item" href="#DialogEdit" data-toggle="modal" data-name="Category"<?php echo $_tmp_2 ?>
><?php echo phptal_escape($ctx->path($ctx->Category, 'getName')); ?>
</a></td>
										<?php /* tag "td" from line 39 */; ?>
<td class="right"><?php /* tag "span" from line 39 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Category, 'getOrder')); ?>
</span></td>
										<?php /* tag "td" from line 40 */; ?>
<td class="right"><?php 
/* tag "a" from line 40 */ ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->Category, 'getURLSetting')))):  ;
$_tmp_2 = ' href="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a<?php echo $_tmp_2 ?>
><?php /* tag "span" from line 40 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Category, 'getCategoryAll/count')); ?>
</span> chi tiết</a></td>
										<?php /* tag "td" from line 41 */; ?>
<td class="center"><?php 
/* tag "a" from line 41 */ ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->Category, 'getId')))):  ;
$_tmp_2 = ' data-id="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a class="update-item" href="#DialogEdit" data-toggle="modal"<?php echo $_tmp_2 ?>
><?php /* tag "i" from line 41 */; ?>
<i class="glyphicon glyphicon-pencil"></i></a></td>
										<?php /* tag "td" from line 42 */; ?>
<td class="center"><?php 
/* tag "a" from line 42 */ ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->Category, 'getId')))):  ;
$_tmp_2 = ' data-id="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a class="remove-item" href="#DialogDel" data-toggle="modal"<?php echo $_tmp_2 ?>
><?php /* tag "i" from line 42 */; ?>
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
/* tag "div" from line 48 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/PageBar', $_thistpl) ;
$ctx->popSlots() ;
?>

					<!-- INSERT DIALOG  -->
					<?php /* tag "div" from line 50 */; ?>
<div id="DialogIns" class="modal fade">
						<?php /* tag "div" from line 51 */; ?>
<div class="modal-dialog">
							<?php /* tag "div" from line 52 */; ?>
<div class="modal-content">
								<?php /* tag "div" from line 53 */; ?>
<div class="modal-header"><?php /* tag "h3" from line 53 */; ?>
<h3><?php /* tag "i" from line 53 */; ?>
<i class="glyphicons-show_big_thumbnails modal-icon"></i>THÊM MỚI DANH MỤC</h3></div>
								<?php /* tag "form" from line 54 */; ?>
<form id="FormCategoryInsert" action="#" class="form-horizontal" novalidate="novalidate">
									<?php /* tag "div" from line 55 */; ?>
<div class="modal-body">
										<?php /* tag "div" from line 56 */; ?>
<div class="control-group">
											<?php /* tag "label" from line 57 */; ?>
<label class="control-label">Tên</label>
											<?php /* tag "div" from line 58 */; ?>
<div class="controls">
												<?php /* tag "input" from line 59 */; ?>
<input id="Name1" name="Name1" type="text" class="form-control input-small"/>
											</div>
										</div>
										<?php /* tag "div" from line 62 */; ?>
<div class="control-group">
											<?php /* tag "label" from line 63 */; ?>
<label class="control-label">Thứ tự</label>
											<?php /* tag "div" from line 64 */; ?>
<div class="controls">
												<?php /* tag "input" from line 65 */; ?>
<input id="Order1" name="Order1" type="text" class="form-control input-small"/>
											</div>
										</div>
									</div>
									<?php /* tag "div" from line 69 */; ?>
<div class="modal-footer">
										<?php /* tag "button" from line 70 */; ?>
<button id="URLInsButton" class="btn btn-primary btn-small"><?php /* tag "i" from line 70 */; ?>
<i class="glyphicons-download_alt"></i> Lưu</button>
										<?php /* tag "button" from line 71 */; ?>
<button data-dismiss="modal" class="btn btn-default btn-small"><?php /* tag "i" from line 71 */; ?>
<i class="glyphicons-undo"></i> Hủy</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- END INSERT DIALOG  -->
					
					<!-- UPDATE DIALOG  -->
					<?php /* tag "div" from line 80 */; ?>
<div id="DialogEdit" class="modal fade">
						<?php /* tag "div" from line 81 */; ?>
<div class="modal-dialog">
							<?php /* tag "div" from line 82 */; ?>
<div class="modal-content">
								<?php /* tag "div" from line 83 */; ?>
<div class="modal-header"><?php /* tag "h3" from line 83 */; ?>
<h3><?php /* tag "i" from line 83 */; ?>
<i class="glyphicons-show_big_thumbnails modal-icon"></i>CẬP NHẬT DANH MỤC</h3></div>
								<?php /* tag "form" from line 84 */; ?>
<form id="FormCategoryUpdate" action="#" class="form-horizontal" novalidate="novalidate">
									<?php /* tag "div" from line 85 */; ?>
<div class="modal-body">
										<?php /* tag "div" from line 86 */; ?>
<div class="control-group">
											<?php /* tag "label" from line 87 */; ?>
<label class="control-label">Tên</label>
											<?php /* tag "div" from line 88 */; ?>
<div class="controls">
												<?php /* tag "input" from line 89 */; ?>
<input id="Name2" name="Name2" type="text" class="form-control input-small"/>
											</div>
										</div>
										<?php /* tag "div" from line 92 */; ?>
<div class="control-group">
											<?php /* tag "label" from line 93 */; ?>
<label class="control-label">Thứ tự</label>
											<?php /* tag "div" from line 94 */; ?>
<div class="controls">
												<?php /* tag "input" from line 95 */; ?>
<input id="Order2" name="Order2" type="text" class="form-control input-small"/>
											</div>
										</div>
									</div>
									<?php /* tag "div" from line 99 */; ?>
<div class="modal-footer">
										<?php /* tag "button" from line 100 */; ?>
<button id="URLUpdButton" class="btn btn-primary btn-small" type="submit"><?php /* tag "i" from line 100 */; ?>
<i class="glyphicons-download_alt"></i> Lưu</button>
										<?php /* tag "button" from line 101 */; ?>
<button data-dismiss="modal" class="btn btn-default btn-small"><?php /* tag "i" from line 101 */; ?>
<i class="glyphicons-undo"></i> Hủy</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- END UPDATE DIALOG  -->
					<?php 
/* tag "div" from line 108 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mDialog.xhtml/DialogDel', $_thistpl) ;
$ctx->popSlots() ;
?>

					<?php 
/* tag "div" from line 109 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mDialog.xhtml/DialogDelSelected', $_thistpl) ;
$ctx->popSlots() ;
?>

				</div>
			</div>
		</div>
		<?php 
/* tag "div" from line 113 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/Footer', $_thistpl) ;
$ctx->popSlots() ;
?>

		<?php 
/* tag "div" from line 114 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/IncludeJS', $_thistpl) ;
$ctx->popSlots() ;
?>

		<?php /* tag "script" from line 115 */; ?>
<script type="text/javascript">
		/*<![CDATA[*/
			$('#URLDelSelectedButton').click(function(){
				var count = 0;
				var Data = [];
				var URL = "/object/del/Category/0";
				
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
						//location.reload();
					}
				});
			});
			
			//-----------------------------------------------------------------------------------
			//Delete 1 Category			
			//-----------------------------------------------------------------------------------
			$('.remove-item').click(function(){
				$('#URLDelButton').attr('alt', $(this).attr('data-id'));
			});
			//Khi người dùng Click vào nút URLDelButton thì tiến  hành gọi Ajax xóa tự động
			$('#URLDelButton').click(function(){			
				var URL = "/object/del/Category/" + $(this).attr('alt');
				$.ajax({
					type: "POST",					
					url: URL,
					success: function(msg){
						location.reload();
					}
				});
			});
		
			//-----------------------------------------------------------------------------------
			//Insert 1 Category			
			$("#FormCategoryInsert").validate({
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
					
					var URL = "/object/ins/Category";
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
			//Load 1 Category
			//-----------------------------------------------------------------------------------
			$('.update-item').click(function(){
				//Load dữ liệu JSON về
				var url = "/object/load/Category/" + $(this).attr('data-id');
				
				//Load dữ liệu JSON lên FORM
				$.getJSON(url, function(data){
					$('#URLUpdButton').attr('alt', data.Id);
					$('#Name2').attr('value', data.Name);
					$('#Order2').attr('value', data.Order);
				});
			});
			
			//-----------------------------------------------------------------------------------
			//Update 1 Category
			//-----------------------------------------------------------------------------------
			$("#FormCategoryUpdate").validate({
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
																		
					var URL = "/object/upd/Category";
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

Generated by PHPTAL from G:\AppsWeb\cmsA\www.amthuclangsen.com\mvc\templates\ASettingCategory.html (edit that file instead) */; ?>