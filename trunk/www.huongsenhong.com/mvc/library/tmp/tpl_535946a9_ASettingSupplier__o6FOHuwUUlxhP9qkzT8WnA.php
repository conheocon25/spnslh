<?php 
function tpl_535946a9_ASettingSupplier__o6FOHuwUUlxhP9qkzT8WnA(PHPTAL $tpl, PHPTAL_Context $ctx) {
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
<th width="120" class="left">ĐIỆN THOẠI</th>
										<?php /* tag "th" from line 30 */; ?>
<th class="left">ĐỊA CHỈ</th>
										<?php /* tag "th" from line 31 */; ?>
<th class="right" width="100">MÓN</th>
										<?php /* tag "th" from line 32 */; ?>
<th width="40"><?php /* tag "i" from line 32 */; ?>
<i class="glyphicons-edit"></i></th>
										<?php /* tag "th" from line 33 */; ?>
<th width="40"><?php /* tag "i" from line 33 */; ?>
<i class="glyphicons-bin"></i></th>
									</tr>
								</thead>
								<?php /* tag "tbody" from line 36 */; ?>
<tbody>
									<?php 
/* tag "tr" from line 37 */ ;
$_tmp_1 = $ctx->repeat ;
$_tmp_1->Supplier = new PHPTAL_RepeatController($ctx->SupplierAll1)
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_1->Supplier as $ctx->Supplier): ;
?>
<tr>
										<?php /* tag "td" from line 38 */; ?>
<td class="center"><?php 
/* tag "input" from line 38 */ ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->Supplier, 'getId')))):  ;
$_tmp_2 = ' data-id="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<input class="CheckedDel" type="checkbox"<?php echo $_tmp_2 ?>
/></td>
										<?php /* tag "td" from line 39 */; ?>
<td><?php 
/* tag "a" from line 39 */ ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->Supplier, 'getId')))):  ;
$_tmp_2 = ' data-id="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a class="update-item" href="#DialogEdit" data-toggle="modal"<?php echo $_tmp_2 ?>
><?php echo phptal_escape($ctx->path($ctx->Supplier, 'getName')); ?>
</a></td>
										<?php /* tag "td" from line 40 */; ?>
<td><?php /* tag "span" from line 40 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Supplier, 'getPhone')); ?>
</span></td>
										<?php /* tag "td" from line 41 */; ?>
<td><?php /* tag "span" from line 41 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Supplier, 'getAddress')); ?>
</span></td>
										<?php /* tag "td" from line 42 */; ?>
<td class="right"><?php 
/* tag "a" from line 42 */ ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->Supplier, 'getURLProduct')))):  ;
$_tmp_2 = ' href="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a<?php echo $_tmp_2 ?>
> <?php /* tag "span" from line 42 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Supplier, 'getProductAll/count')); ?>
</span> món</a></td>
										<?php /* tag "td" from line 43 */; ?>
<td class="center">
											<?php 
/* tag "a" from line 44 */ ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->Supplier, 'getId')))):  ;
$_tmp_2 = ' data-id="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a class="update-item" href="#DialogEdit" data-toggle="modal"<?php echo $_tmp_2 ?>
>
												<?php /* tag "i" from line 45 */; ?>
<i class="glyphicon glyphicon-pencil"></i>
											</a>
										</td>
										<?php /* tag "td" from line 48 */; ?>
<td class="center">
											<?php 
/* tag "a" from line 49 */ ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->Supplier, 'getId')))):  ;
$_tmp_2 = ' data-id="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a class="remove-item" href="#DialogDel" data-toggle="modal"<?php echo $_tmp_2 ?>
>
												<?php /* tag "i" from line 50 */; ?>
<i class="glyphicon glyphicon-remove"></i>
											</a>
										</td>
									</tr><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

								</tbody>
							</table>
						</div>
					</div>
					<?php 
/* tag "div" from line 58 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/PageBar', $_thistpl) ;
$ctx->popSlots() ;
?>

					<!-- INSERT DIALOG  -->
					<?php /* tag "div" from line 60 */; ?>
<div id="DialogIns" class="modal fade">
						<?php /* tag "div" from line 61 */; ?>
<div class="modal-dialog">
							<?php /* tag "div" from line 62 */; ?>
<div class="modal-content">
								<?php /* tag "div" from line 63 */; ?>
<div class="modal-header"><?php /* tag "h3" from line 63 */; ?>
<h3><?php /* tag "i" from line 63 */; ?>
<i class="glyphicons-truck modal-icon"></i>THÊM NHÀ CUNG CẤP</h3></div>								
								<?php /* tag "form" from line 64 */; ?>
<form id="FormSupplierInsert" action="#" class="form-horizontal" novalidate="novalidate">
									<?php /* tag "div" from line 65 */; ?>
<div class="modal-body">
										<?php /* tag "div" from line 66 */; ?>
<div class="form-group">
											<?php /* tag "label" from line 67 */; ?>
<label class="control-label">Tên</label>
											<?php /* tag "div" from line 68 */; ?>
<div class="controls">
												<?php /* tag "input" from line 69 */; ?>
<input id="Name1" name="Name1" type="text" class="form-control input-small"/>
											</div>
										</div>
										<?php /* tag "div" from line 72 */; ?>
<div class="form-group">
											<?php /* tag "label" from line 73 */; ?>
<label class="control-label">Điện thoại</label>
											<?php /* tag "div" from line 74 */; ?>
<div class="controls">
												<?php /* tag "input" from line 75 */; ?>
<input id="Phone1" name="Phone1" type="text" class="form-control input-small"/>
											</div>
										</div>
										<?php /* tag "div" from line 78 */; ?>
<div class="form-group">
											<?php /* tag "label" from line 79 */; ?>
<label class="control-label">Địa chỉ</label>
											<?php /* tag "div" from line 80 */; ?>
<div class="controls">
												<?php /* tag "input" from line 81 */; ?>
<input id="Address1" name="Address1" type="text" class="form-control input-small"/>
											</div>
										</div>
										<?php /* tag "div" from line 84 */; ?>
<div class="form-group">
											<?php /* tag "label" from line 85 */; ?>
<label class="control-label">Ghi chú</label>
											<?php /* tag "div" from line 86 */; ?>
<div class="controls">
												<?php /* tag "input" from line 87 */; ?>
<input id="Note1" name="Note1" type="text" class="form-control input-small"/>
											</div>
										</div>
										<?php /* tag "div" from line 90 */; ?>
<div class="form-group">
											<?php /* tag "label" from line 91 */; ?>
<label class="control-label">Nợ đầu kì</label>
											<?php /* tag "div" from line 92 */; ?>
<div class="controls">
												<?php /* tag "input" from line 93 */; ?>
<input id="Debt1" name="Debt1" type="text" class="form-control input-small"/>
											</div>
										</div>
									</div>
									<?php /* tag "div" from line 97 */; ?>
<div class="modal-footer">
										<?php /* tag "button" from line 98 */; ?>
<button id="URLInsButton" class="btn btn-primary btn-small" type="submit" value="Validate"><?php /* tag "i" from line 98 */; ?>
<i class="glyphicons-download_alt"></i> Lưu</button>
										<?php /* tag "button" from line 99 */; ?>
<button data-dismiss="modal" class="btn btn-default btn-small"><?php /* tag "i" from line 99 */; ?>
<i class="glyphicons-undo"></i> Hủy</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- END INSERT DIALOG  -->
					
					<!-- UPDATE DIALOG  -->
					<?php /* tag "div" from line 108 */; ?>
<div id="DialogEdit" class="modal fade">
						<?php /* tag "div" from line 109 */; ?>
<div class="modal-dialog">
							<?php /* tag "div" from line 110 */; ?>
<div class="modal-content">
								<?php /* tag "div" from line 111 */; ?>
<div class="modal-header"><?php /* tag "h3" from line 111 */; ?>
<h3><?php /* tag "i" from line 111 */; ?>
<i class="glyphicons-truck modal-icon"></i>CẬP NHẬT NHÀ CUNG CẤP</h3></div>
								<?php /* tag "form" from line 112 */; ?>
<form id="FormSupplierUpdate" action="#" class="form-horizontal" novalidate="novalidate">
									<?php /* tag "div" from line 113 */; ?>
<div class="form-group">
										<?php /* tag "label" from line 114 */; ?>
<label class="control-label">Tên</label>
										<?php /* tag "div" from line 115 */; ?>
<div class="controls">
											<?php /* tag "input" from line 116 */; ?>
<input id="Name2" name="Name2" type="text" class="form-control input-small"/>
										</div>
									</div>
									<?php /* tag "div" from line 119 */; ?>
<div class="form-group">
										<?php /* tag "label" from line 120 */; ?>
<label class="control-label">Điện thoại</label>
										<?php /* tag "div" from line 121 */; ?>
<div class="controls">
											<?php /* tag "input" from line 122 */; ?>
<input id="Phone2" name="Phone2" type="text" class="form-control input-small"/>
										</div>
									</div>
									<?php /* tag "div" from line 125 */; ?>
<div class="form-group">
										<?php /* tag "label" from line 126 */; ?>
<label class="control-label">Địa chỉ</label>
										<?php /* tag "div" from line 127 */; ?>
<div class="controls">
											<?php /* tag "input" from line 128 */; ?>
<input id="Address2" name="Address2" type="text" class="form-control input-small"/>
										</div>
									</div>
									<?php /* tag "div" from line 131 */; ?>
<div class="form-group">
										<?php /* tag "label" from line 132 */; ?>
<label class="control-label">Ghi chú</label>
										<?php /* tag "div" from line 133 */; ?>
<div class="controls">
											<?php /* tag "input" from line 134 */; ?>
<input id="Note2" name="Note2" type="text" class="form-control input-small"/>
										</div>
									</div>
									<?php /* tag "div" from line 137 */; ?>
<div class="form-group">
										<?php /* tag "label" from line 138 */; ?>
<label class="control-label">Nợ đầu kì</label>
										<?php /* tag "div" from line 139 */; ?>
<div class="controls">
											<?php /* tag "input" from line 140 */; ?>
<input id="Debt2" name="Debt2" type="text" class="form-control input-small"/>
										</div>
									</div>									
									<?php /* tag "div" from line 143 */; ?>
<div class="modal-footer">
										<?php /* tag "button" from line 144 */; ?>
<button id="URLUpdButton" class="btn btn-primary btn-small" type="submit"><?php /* tag "i" from line 144 */; ?>
<i class="glyphicons-download_alt"></i> Lưu</button>
										<?php /* tag "button" from line 145 */; ?>
<button data-dismiss="modal" class="btn btn-default btn-small"><?php /* tag "i" from line 145 */; ?>
<i class="glyphicons-undo"></i> Hủy</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- END UPDATE DIALOG  -->
					<?php 
/* tag "div" from line 152 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mDialog.xhtml/DialogDel', $_thistpl) ;
$ctx->popSlots() ;
?>

					<?php 
/* tag "div" from line 153 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mDialog.xhtml/DialogDelSelected', $_thistpl) ;
$ctx->popSlots() ;
?>

				</div>
			</div>
		</div>
		<?php 
/* tag "div" from line 157 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/Footer', $_thistpl) ;
$ctx->popSlots() ;
?>

		<?php 
/* tag "div" from line 158 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/IncludeJS', $_thistpl) ;
$ctx->popSlots() ;
?>

		<?php /* tag "script" from line 159 */; ?>
<script type="text/javascript">
		/*<![CDATA[*/
			$('#URLDelSelectedButton').click(function(){
				var count = 0;
				var Data = [];
				var URL = "/object/del/Supplier/0";
				
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
			//Delete 1 CATEGORY			
			//-----------------------------------------------------------------------------------
			$('.remove-item').click(function(){
				$('#URLDelButton').attr('alt', $(this).attr('data-id'));
			});
			//Khi người dùng Click vào nút URLDelButton thì tiến  hành gọi Ajax xóa tự động
			$('#URLDelButton').click(function(){
				var URL = "/object/del/Supplier/" + $(this).attr('alt');
				$.ajax({
					type: "POST",					
					url: URL,
					success: function(msg){
						location.reload();
					}
				});
			});
		
			//-----------------------------------------------------------------------------------
			//Insert 1 SUPPLIER
			$("#FormSupplierInsert").validate({
				rules:{
					Name1:{
						minlength: 4,
						required:true
					},
					Debt1:{						
						required:true,
						number:true
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
					Data[2] = $('#Phone1').val();
					Data[3] = $('#Address1').val();
					Data[4] = $('#Note1').val();
					Data[5] = $('#Debt1').val();
					
					var URL = "/object/ins/Supplier";
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
			//Load 1 CATEGORY
			//-----------------------------------------------------------------------------------
			$('.update-item').click(function(){
				//Load dữ liệu JSON về
				var url = "/object/load/Supplier/" + $(this).attr('data-id');
				
				//Load dữ liệu JSON lên FORM
				$.getJSON(url, function(data){
					$('#URLUpdButton').attr('alt', data.Id);
					$('#Name2').attr('value', data.Name);
					$('#Phone2').attr('value', data.Phone);
					$('#Address2').attr('value', data.Address);
					$('#Note2').attr('value', data.Note);
					$('#Debt2').attr('value', data.Debt);
				});
			});
			
			//-----------------------------------------------------------------------------------
			//Update 1 CATEGORY
			//-----------------------------------------------------------------------------------
			$("#FormSupplierUpdate").validate({
				rules:{
					Name2:{
						minlength: 4,
						required:true
					},
					Debt2:{
						required:true,
						number:true
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
					Data[2] = $('#Phone2').val();
					Data[3] = $('#Address2').val();
					Data[4] = $('#Note2').val();
					Data[5] = $('#Debt2').val();
					
					var URL = "/object/upd/Supplier";
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

Generated by PHPTAL from G:\AppsWeb\cmsA\www.amthuclangsen.com\mvc\templates\ASettingSupplier.html (edit that file instead) */; ?>