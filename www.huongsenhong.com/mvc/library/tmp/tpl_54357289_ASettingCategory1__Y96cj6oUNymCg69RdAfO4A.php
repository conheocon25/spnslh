<?php 
function tpl_54357289_ASettingCategory1__Y96cj6oUNymCg69RdAfO4A(PHPTAL $tpl, PHPTAL_Context $ctx) {
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
		
		<?php /* tag "div" from line 10 */; ?>
<div id="sidebar">
			<?php /* tag "ul" from line 11 */; ?>
<ul style="display: block;">
				<?php 
/* tag "li" from line 12 */ ;
$_tmp_1 = $ctx->repeat ;
$_tmp_1->Category1 = new PHPTAL_RepeatController($ctx->CategoryAll)
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_1->Category1 as $ctx->Category1): ;
if (null !== ($_tmp_2 = ($ctx->Category1->getId()==$ctx->Category->getId()?'active':'disable'))):  ;
$_tmp_2 = ' class="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<li<?php echo $_tmp_2 ?>
>
					<?php 
/* tag "a" from line 13 */ ;
if (null !== ($_tmp_3 = ($ctx->path($ctx->Category1, 'getURLSetting')))):  ;
$_tmp_3 = ' href="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<a<?php echo $_tmp_3 ?>
>
						<?php /* tag "i" from line 14 */; ?>
<i class="glyphicons-show_big_thumbnails"></i><?php /* tag "span" from line 14 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Category1, 'getName')); ?>
</span>
					</a>
				</li><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

			</ul>
		</div>
		<?php /* tag "div" from line 19 */; ?>
<div id="content">
			<?php 
/* tag "div" from line 20 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/ContentHeader', $_thistpl) ;
$ctx->popSlots() ;
?>

			<?php 
/* tag "div" from line 21 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/Locationbar', $_thistpl) ;
$ctx->popSlots() ;
?>

			<?php /* tag "div" from line 22 */; ?>
<div class="row">
				<?php /* tag "div" from line 23 */; ?>
<div class="col-12">
					<?php /* tag "a" from line 24 */; ?>
<a href="#DialogIns" data-toggle="modal" class="btn btn-primary btn-ins">
						<?php /* tag "i" from line 25 */; ?>
<i class="glyphicons-plus"></i> Thêm mới
					</a>
					<?php /* tag "a" from line 27 */; ?>
<a href="#DialogDelSelected" data-toggle="modal" class="btn btn-primary btn-ins">
						<?php /* tag "i" from line 28 */; ?>
<i class="glyphicons-remove_2"></i> Xóa chọn
					</a>
					<?php /* tag "div" from line 30 */; ?>
<div class="widget-box">
						<?php /* tag "div" from line 31 */; ?>
<div class="widget-content nopadding">							
							<?php /* tag "table" from line 32 */; ?>
<table class="table table-bordered table-striped table-hover with-check">								
								<?php /* tag "thead" from line 33 */; ?>
<thead>
									<?php /* tag "tr" from line 34 */; ?>
<tr>
										<?php /* tag "th" from line 35 */; ?>
<th width="40"><?php /* tag "input" from line 35 */; ?>
<input type="checkbox" id="title-table-checkbox" name="title-table-checkbox"/></th>
										<?php /* tag "th" from line 36 */; ?>
<th class="left">TÊN</th>
										<?php /* tag "th" from line 37 */; ?>
<th width="80" class="right">THỨ TỰ</th>
										<?php /* tag "th" from line 38 */; ?>
<th width="40"><?php /* tag "i" from line 38 */; ?>
<i class="glyphicons-bin"></i></th>
									</tr>
								</thead>
								<?php /* tag "tbody" from line 41 */; ?>
<tbody>
									<?php 
/* tag "tr" from line 42 */ ;
$_tmp_3 = $ctx->repeat ;
$_tmp_3->Category1 = new PHPTAL_RepeatController($ctx->path($ctx->Category, 'getCategoryAll'))
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_3->Category1 as $ctx->Category1): ;
?>
<tr>
										<?php /* tag "td" from line 43 */; ?>
<td class="center"><?php 
/* tag "input" from line 43 */ ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->Category1, 'getId')))):  ;
$_tmp_2 = ' data-id="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<input class="CheckedDel" type="checkbox"<?php echo $_tmp_2 ?>
/></td>
										<?php /* tag "td" from line 44 */; ?>
<td><?php 
/* tag "a" from line 44 */ ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->Category1, 'getId')))):  ;
$_tmp_1 = ' data-id="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a class="update-item" href="#DialogEdit" data-toggle="modal"<?php echo $_tmp_1 ?>
><?php echo phptal_escape($ctx->path($ctx->Category1, 'getName')); ?>
</a></td>
										<?php /* tag "td" from line 45 */; ?>
<td class="right"><?php /* tag "span" from line 45 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Category1, 'getOrder')); ?>
</span></td>
										<?php /* tag "td" from line 46 */; ?>
<td class="center"><?php 
/* tag "a" from line 46 */ ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->Category1, 'getId')))):  ;
$_tmp_2 = ' data-id="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a class="remove-item" href="#DialogDel" data-toggle="modal"<?php echo $_tmp_2 ?>
><?php /* tag "i" from line 46 */; ?>
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
					<?php /* tag "div" from line 53 */; ?>
<div id="DialogIns" class="modal fade">
						<?php /* tag "div" from line 54 */; ?>
<div class="modal-dialog">
							<?php /* tag "div" from line 55 */; ?>
<div class="modal-content">
								<?php /* tag "div" from line 56 */; ?>
<div class="modal-header"><?php /* tag "h3" from line 56 */; ?>
<h3><?php /* tag "i" from line 56 */; ?>
<i class="glyphicons-show_big_thumbnails modal-icon"></i>THÊM MỚI DANH MỤC</h3></div>
								<?php /* tag "form" from line 57 */; ?>
<form id="FormCategoryInsert" action="#" class="form-horizontal" novalidate="novalidate">
									<?php /* tag "div" from line 58 */; ?>
<div class="modal-body">
										<?php /* tag "div" from line 59 */; ?>
<div class="control-group">
											<?php /* tag "label" from line 60 */; ?>
<label class="control-label">Tên</label>
											<?php /* tag "div" from line 61 */; ?>
<div class="controls">
												<?php /* tag "input" from line 62 */; ?>
<input id="Name1" name="Name1" type="text" class="form-control input-small"/>
											</div>
										</div>										
										<?php /* tag "div" from line 65 */; ?>
<div class="control-group">
											<?php /* tag "label" from line 66 */; ?>
<label class="control-label">Thứ tự</label>
											<?php /* tag "div" from line 67 */; ?>
<div class="controls">
												<?php /* tag "input" from line 68 */; ?>
<input id="Order1" name="Order1" type="text" class="form-control input-small"/>
											</div>
										</div>
										<?php /* tag "div" from line 71 */; ?>
<div class="control-group">
											<?php /* tag "label" from line 72 */; ?>
<label class="control-label">Thông tin</label>
											<?php /* tag "div" from line 73 */; ?>
<div class="controls">												
												<?php /* tag "textarea" from line 74 */; ?>
<textarea id="Info1" name="Info1" class="form-control input-small" rows="6"></textarea>
											</div>
										</div>
									</div>
									<?php /* tag "div" from line 78 */; ?>
<div class="modal-footer">
										<?php /* tag "button" from line 79 */; ?>
<button id="URLInsButton" class="btn btn-primary btn-small"><?php /* tag "i" from line 79 */; ?>
<i class="glyphicons-download_alt"></i> Lưu</button>
										<?php /* tag "button" from line 80 */; ?>
<button data-dismiss="modal" class="btn btn-default btn-small"><?php /* tag "i" from line 80 */; ?>
<i class="glyphicons-undo"></i> Hủy</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- END INSERT DIALOG  -->
					
					<!-- UPDATE DIALOG  -->
					<?php /* tag "div" from line 89 */; ?>
<div id="DialogEdit" class="modal fade">
						<?php /* tag "div" from line 90 */; ?>
<div class="modal-dialog">
							<?php /* tag "div" from line 91 */; ?>
<div class="modal-content">
								<?php /* tag "div" from line 92 */; ?>
<div class="modal-header"><?php /* tag "h3" from line 92 */; ?>
<h3><?php /* tag "i" from line 92 */; ?>
<i class="glyphicons-show_big_thumbnails modal-icon"></i>CẬP NHẬT DANH MỤC</h3></div>
								<?php /* tag "form" from line 93 */; ?>
<form id="FormCategoryUpdate" action="#" class="form-horizontal" novalidate="novalidate">
									<?php /* tag "div" from line 94 */; ?>
<div class="modal-body">
										<?php /* tag "div" from line 95 */; ?>
<div class="control-group">
											<?php /* tag "label" from line 96 */; ?>
<label class="control-label">Tên</label>
											<?php /* tag "div" from line 97 */; ?>
<div class="controls">
												<?php /* tag "input" from line 98 */; ?>
<input id="Name2" name="Name2" type="text" class="form-control input-small"/>
											</div>
										</div>
										<?php /* tag "div" from line 101 */; ?>
<div class="control-group">
											<?php /* tag "label" from line 102 */; ?>
<label class="control-label">Nhóm thông tin</label>
											<?php /* tag "div" from line 103 */; ?>
<div class="controls">												
												<?php /* tag "select" from line 104 */; ?>
<select name="IdGAttribute2" id="IdGAttribute2" style="width:80%;">
													<?php 
/* tag "option" from line 105 */ ;
$_tmp_1 = $ctx->repeat ;
$_tmp_1->GAttribute = new PHPTAL_RepeatController($ctx->GAttributeAll)
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_1->GAttribute as $ctx->GAttribute): ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->GAttribute, 'getId')))):  ;
$_tmp_2 = ' value="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<option<?php echo $_tmp_2 ?>
>
														<?php /* tag "span" from line 106 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->GAttribute, 'getName')); ?>
</span>
													</option><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

												</select>
											</div>
										</div>
										<?php /* tag "div" from line 111 */; ?>
<div class="control-group">
											<?php /* tag "label" from line 112 */; ?>
<label class="control-label">Thứ tự</label>
											<?php /* tag "div" from line 113 */; ?>
<div class="controls">
												<?php /* tag "input" from line 114 */; ?>
<input id="Order2" name="Order2" type="text" class="form-control input-small"/>
											</div>
										</div>
										<?php /* tag "div" from line 117 */; ?>
<div class="control-group">
											<?php /* tag "label" from line 118 */; ?>
<label class="control-label">Thông tin</label>
											<?php /* tag "div" from line 119 */; ?>
<div class="controls">												
												<?php /* tag "textarea" from line 120 */; ?>
<textarea id="Info2" name="Info2" class="form-control input-small" rows="6"></textarea>
											</div>
										</div>
									</div>
									<?php /* tag "div" from line 124 */; ?>
<div class="modal-footer">
										<?php /* tag "button" from line 125 */; ?>
<button id="URLUpdButton" class="btn btn-primary btn-small" type="submit"><?php /* tag "i" from line 125 */; ?>
<i class="glyphicons-download_alt"></i> Lưu</button>
										<?php /* tag "button" from line 126 */; ?>
<button data-dismiss="modal" class="btn btn-default btn-small"><?php /* tag "i" from line 126 */; ?>
<i class="glyphicons-undo"></i> Hủy</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- END UPDATE DIALOG  -->
					<?php 
/* tag "div" from line 133 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mDialog.xhtml/DialogDel', $_thistpl) ;
$ctx->popSlots() ;
?>

					<?php 
/* tag "div" from line 134 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mDialog.xhtml/DialogDelSelected', $_thistpl) ;
$ctx->popSlots() ;
?>

				</div>
			</div>
		</div>
		<?php 
/* tag "div" from line 138 */ ;
if (null !== ($_tmp_3 = ($ctx->path($ctx->Category, 'getId')))):  ;
$_tmp_3 = ' alt="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<div id="CurrentCategory"<?php echo $_tmp_3 ?>
></div>
		
		<?php 
/* tag "div" from line 140 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/Footer', $_thistpl) ;
$ctx->popSlots() ;
?>

		<?php 
/* tag "div" from line 141 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/IncludeJS', $_thistpl) ;
$ctx->popSlots() ;
?>

		<?php /* tag "script" from line 142 */; ?>
<script type="text/javascript">
		/*<![CDATA[*/
			$('#URLDelSelectedButton').click(function(){
				var count = 0;
				var Data = [];
				var URL = "/object/del/Category1/0";
				
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
			//Delete 1 Category			
			//-----------------------------------------------------------------------------------
			$('.remove-item').click(function(){
				$('#URLDelButton').attr('alt', $(this).attr('data-id'));
			});
			//Khi người dùng Click vào nút URLDelButton thì tiến  hành gọi Ajax xóa tự động
			$('#URLDelButton').click(function(){			
				var URL = "/object/del/Category1/" + $(this).attr('alt');
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
					Data[1] = $('#CurrentCategory').attr('alt');
					Data[2] = $('#CurrentCategory').attr('alt');
					Data[3] = $('#Name1').val();
					Data[4] = $('#Info1').val();
					Data[5] = $('#Order1').val();
					
					var URL = "/object/ins/Category1";
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
				var url = "/object/load/Category1/" + $(this).attr('data-id');
				
				//Load dữ liệu JSON lên FORM
				$.getJSON(url, function(data){
					$('#URLUpdButton').attr('alt', 		data.Id);
					$('#IdGAttribute2').select2('val', 	data.IdGAttribute);
					$('#Name2').attr('value', 			data.Name);
					$('#Info2').val( 					data.Info);
					$('#Order2').attr('value', 			data.Order);
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
					Data[1] = $('#CurrentCategory').attr('alt');
					Data[2] = $('#IdGAttribute2').val();
					Data[3] = $('#Name2').val();
					Data[4] = $('#Info2').val();
					Data[5] = $('#Order2').val();
																		
					var URL = "/object/upd/Category1";
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

Generated by PHPTAL from G:\AppsWeb\cmsA\www.amthuclangsen.com\mvc\templates\ASettingCategory1.html (edit that file instead) */; ?>