<?php 
function tpl_5434aa05_ASettingBranch__txfCxSwIAQwWjczYhl9Lqg(PHPTAL $tpl, PHPTAL_Context $ctx) {
$_thistpl = $tpl ;
$_translator = $tpl->getTranslator() ;
/* tag "documentElement" from line 1 */ ;
$ctx->setDocType('<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">',false) ;
?>

<?php /* tag "html" from line 2 */; ?>
<html xmlns="http://www.w3.org/1999/xhtml">
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
	<?php /* tag "body" from line 7 */; ?>
<body onload="load()" onunload="GUnload()">
		<?php 
/* tag "div" from line 8 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/Header', $_thistpl) ;
$ctx->popSlots() ;
?>
		
		<?php 
/* tag "div" from line 9 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/MenuSettingGeneral', $_thistpl) ;
$ctx->popSlots() ;
?>

		<?php /* tag "div" from line 10 */; ?>
<div id="content">
			<?php 
/* tag "div" from line 11 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/ContentHeader', $_thistpl) ;
$ctx->popSlots() ;
?>

			<?php 
/* tag "div" from line 12 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/Locationbar', $_thistpl) ;
$ctx->popSlots() ;
?>

			<?php /* tag "div" from line 13 */; ?>
<div class="row">
				<?php /* tag "div" from line 14 */; ?>
<div class="col-12">
					<?php /* tag "a" from line 15 */; ?>
<a href="#DialogIns" data-toggle="modal" class="btn btn-primary btn-ins">
						<?php /* tag "i" from line 16 */; ?>
<i class="glyphicons-plus"></i> Thêm mới
					</a>
					<?php /* tag "a" from line 18 */; ?>
<a href="#DialogDelSelected" data-toggle="modal" class="btn btn-primary btn-ins">
						<?php /* tag "i" from line 19 */; ?>
<i class="glyphicons-remove_2"></i> Xóa chọn
					</a>
					<?php /* tag "div" from line 21 */; ?>
<div class="widget-box">
						<?php /* tag "div" from line 22 */; ?>
<div class="widget-content nopadding">
							<?php /* tag "table" from line 23 */; ?>
<table class="table table-bordered table-striped table-hover with-check">								
								<?php /* tag "thead" from line 24 */; ?>
<thead>
									<?php /* tag "tr" from line 25 */; ?>
<tr>
										<?php /* tag "th" from line 26 */; ?>
<th width="40"><?php /* tag "input" from line 26 */; ?>
<input type="checkbox" id="title-table-checkbox" name="title-table-checkbox"/></th>
										<?php /* tag "th" from line 27 */; ?>
<th class="left">TÊN</th>
										<?php /* tag "th" from line 28 */; ?>
<th width="40"><?php /* tag "i" from line 28 */; ?>
<i class="glyphicons-edit"></i></th>
										<?php /* tag "th" from line 29 */; ?>
<th width="40"><?php /* tag "i" from line 29 */; ?>
<i class="glyphicons-bin"></i></th>
									</tr>
								</thead>
								<?php /* tag "tbody" from line 32 */; ?>
<tbody>
									<?php 
/* tag "tr" from line 33 */ ;
$_tmp_1 = $ctx->repeat ;
$_tmp_1->Branch = new PHPTAL_RepeatController($ctx->BranchAll1)
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_1->Branch as $ctx->Branch): ;
?>
<tr>
										<?php /* tag "td" from line 34 */; ?>
<td class="center"><?php 
/* tag "input" from line 34 */ ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->Branch, 'getId')))):  ;
$_tmp_2 = ' data-id="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<input class="CheckedDel" type="checkbox"<?php echo $_tmp_2 ?>
/></td>
										<?php /* tag "td" from line 35 */; ?>
<td><?php 
/* tag "a" from line 35 */ ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->Branch, 'getId')))):  ;
$_tmp_2 = ' data-id="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a class="update-item" href="#DialogEdit" data-toggle="modal" data-name="Branch"<?php echo $_tmp_2 ?>
><?php echo phptal_escape($ctx->path($ctx->Branch, 'getName')); ?>
</a></td>
										<?php /* tag "td" from line 36 */; ?>
<td class="center"><?php 
/* tag "a" from line 36 */ ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->Branch, 'getId')))):  ;
$_tmp_2 = ' data-id="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a class="update-item" href="#DialogEdit" data-toggle="modal" data-name="Branch"<?php echo $_tmp_2 ?>
><?php /* tag "i" from line 36 */; ?>
<i class="glyphicon glyphicon-pencil"></i></a></td>
										<?php /* tag "td" from line 37 */; ?>
<td class="center"><?php 
/* tag "a" from line 37 */ ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->Branch, 'getId')))):  ;
$_tmp_2 = ' data-id="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a class="remove-item" href="#DialogDel" data-toggle="modal"<?php echo $_tmp_2 ?>
><?php /* tag "i" from line 37 */; ?>
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
/* tag "div" from line 43 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/PageBar', $_thistpl) ;
$ctx->popSlots() ;
?>

					<!-- INSERT DIALOG  -->
					<?php /* tag "div" from line 45 */; ?>
<div id="DialogIns" class="modal fade">
						<?php /* tag "div" from line 46 */; ?>
<div class="modal-dialog">
							<?php /* tag "div" from line 47 */; ?>
<div class="modal-content">
								<?php /* tag "div" from line 48 */; ?>
<div class="modal-header">
									<?php /* tag "h3" from line 49 */; ?>
<h3><?php /* tag "i" from line 49 */; ?>
<i class="glyphicons-tag modal-icon"></i>THÊM MỚI CHI NHÁNH</h3>
								</div>	
								<?php /* tag "div" from line 51 */; ?>
<div id="map" style="width:100%; height:300px"></div>
								<?php /* tag "form" from line 52 */; ?>
<form id="FormBranchInsert" action="#" class="form-horizontal" novalidate="novalidate">
									<?php /* tag "div" from line 53 */; ?>
<div class="modal-body">
										<?php /* tag "div" from line 54 */; ?>
<div class="form-group">
											<?php /* tag "div" from line 55 */; ?>
<div class="control-group">
												<?php /* tag "label" from line 56 */; ?>
<label class="control-label">Tên</label>
												<?php /* tag "div" from line 57 */; ?>
<div class="controls">								
													<?php /* tag "input" from line 58 */; ?>
<input id="Name1" name="Name1" type="text" class="form-control input-small"/>
												</div>
											</div>
											<?php /* tag "div" from line 61 */; ?>
<div class="control-group">
												<?php /* tag "label" from line 62 */; ?>
<label class="control-label">Địa chỉ</label>
												<?php /* tag "div" from line 63 */; ?>
<div class="controls">								
													<?php /* tag "input" from line 64 */; ?>
<input id="Address1" name="Address1" type="text" class="form-control input-small"/>
												</div>
											</div>
											<?php /* tag "div" from line 67 */; ?>
<div class="control-group">
												<?php /* tag "label" from line 68 */; ?>
<label class="control-label">Tọa độ X</label>
												<?php /* tag "div" from line 69 */; ?>
<div class="controls">								
													<?php /* tag "input" from line 70 */; ?>
<input id="X1" name="X1" type="text" class="form-control input-small"/>
												</div>
											</div>
											<?php /* tag "div" from line 73 */; ?>
<div class="control-group">
												<?php /* tag "label" from line 74 */; ?>
<label class="control-label">Tọa độ Y</label>
												<?php /* tag "div" from line 75 */; ?>
<div class="controls">								
													<?php /* tag "input" from line 76 */; ?>
<input id="Y1" name="Y1" type="text" class="form-control input-small"/>
												</div>
											</div>
											<?php /* tag "div" from line 79 */; ?>
<div class="control-group">											
												<?php /* tag "label" from line 80 */; ?>
<label class="control-label">Điện thoại 1</label>
												<?php /* tag "div" from line 81 */; ?>
<div class="controls">
													<?php /* tag "input" from line 82 */; ?>
<input id="Phone11" name="Phone11" type="text" class="form-control input-small"/>
												</div>
											</div>
											<?php /* tag "div" from line 85 */; ?>
<div class="control-group">											
												<?php /* tag "label" from line 86 */; ?>
<label class="control-label">Điện thoại 2</label>
												<?php /* tag "div" from line 87 */; ?>
<div class="controls">
													<?php /* tag "input" from line 88 */; ?>
<input id="Phone21" name="Phone21" type="text" class="form-control input-small"/>
												</div>
											</div>
											<?php /* tag "div" from line 91 */; ?>
<div class="control-group">											
												<?php /* tag "label" from line 92 */; ?>
<label class="control-label">Email 1</label>
												<?php /* tag "div" from line 93 */; ?>
<div class="controls">
													<?php /* tag "input" from line 94 */; ?>
<input id="Email11" name="Email11" type="text" class="form-control input-small"/>
												</div>
											</div>
											<?php /* tag "div" from line 97 */; ?>
<div class="control-group">											
												<?php /* tag "label" from line 98 */; ?>
<label class="control-label">Email 2</label>
												<?php /* tag "div" from line 99 */; ?>
<div class="controls">
													<?php /* tag "input" from line 100 */; ?>
<input id="Email21" name="Email21" type="text" class="form-control input-small"/>
												</div>
											</div>
											<?php /* tag "div" from line 103 */; ?>
<div class="control-group">
												<?php /* tag "label" from line 104 */; ?>
<label class="control-label">Thứ tự</label>
												<?php /* tag "div" from line 105 */; ?>
<div class="controls">
													<?php /* tag "input" from line 106 */; ?>
<input id="Order1" name="Order1" type="text" class="form-control input-small"/>
												</div>
											</div>
											<?php /* tag "div" from line 109 */; ?>
<div class="control-group">
												<?php /* tag "label" from line 110 */; ?>
<label class="control-label">Logo</label>
												<?php /* tag "div" from line 111 */; ?>
<div class="controls">
													<?php /* tag "input" from line 112 */; ?>
<input id="Logo1" name="Logo1" type="text" class="form-control input-small"/>
												</div>
											</div>
										</div>
									</div>
									<?php /* tag "div" from line 117 */; ?>
<div class="modal-footer">
										<?php /* tag "button" from line 118 */; ?>
<button class="btn btn-primary btn-small" id="URLInsButton"><?php /* tag "i" from line 118 */; ?>
<i class="glyphicons-download_alt"></i> Lưu</button>
										<?php /* tag "button" from line 119 */; ?>
<button data-dismiss="modal" class="btn btn-default btn-small"><?php /* tag "i" from line 119 */; ?>
<i class="glyphicons-undo"></i> Hủy</button>
									</div>
								</form>
							</div>
						</div>
					</div>									
					<!-- END INSERT DIALOG  -->
					
					<!-- UPDATE DIALOG  -->
					<?php /* tag "div" from line 128 */; ?>
<div id="DialogEdit" class="modal fade">
						<?php /* tag "div" from line 129 */; ?>
<div class="modal-dialog">
							<?php /* tag "div" from line 130 */; ?>
<div class="modal-content">
								<?php /* tag "div" from line 131 */; ?>
<div class="modal-header">
									<?php /* tag "h3" from line 132 */; ?>
<h3><?php /* tag "i" from line 132 */; ?>
<i class="glyphicons-tag modal-icon"></i>CẬP NHẬT CHI NHÁNH</h3>
								</div>								
								<?php /* tag "form" from line 134 */; ?>
<form id="FormBranchUpdate" action="#" class="form-horizontal" novalidate="novalidate">
									<?php /* tag "div" from line 135 */; ?>
<div class="modal-body">
										<?php /* tag "div" from line 136 */; ?>
<div class="form-group">
											<?php /* tag "div" from line 137 */; ?>
<div class="control-group">
												<?php /* tag "label" from line 138 */; ?>
<label class="control-label">Tên</label>
												<?php /* tag "div" from line 139 */; ?>
<div class="controls">								
													<?php /* tag "input" from line 140 */; ?>
<input id="Name2" name="Name2" type="text" class="form-control input-small"/>
												</div>
											</div>
											<?php /* tag "div" from line 143 */; ?>
<div class="control-group">
												<?php /* tag "label" from line 144 */; ?>
<label class="control-label">Địa chỉ</label>
												<?php /* tag "div" from line 145 */; ?>
<div class="controls">								
													<?php /* tag "input" from line 146 */; ?>
<input id="Address2" name="Address2" type="text" class="form-control input-small"/>
												</div>
											</div>
											<?php /* tag "div" from line 149 */; ?>
<div class="control-group">
												<?php /* tag "label" from line 150 */; ?>
<label class="control-label">Tọa độ X</label>
												<?php /* tag "div" from line 151 */; ?>
<div class="controls">								
													<?php /* tag "input" from line 152 */; ?>
<input id="X2" name="X2" type="text" class="form-control input-small"/>
												</div>
											</div>
											<?php /* tag "div" from line 155 */; ?>
<div class="control-group">
												<?php /* tag "label" from line 156 */; ?>
<label class="control-label">Tọa độ Y</label>
												<?php /* tag "div" from line 157 */; ?>
<div class="controls">								
													<?php /* tag "input" from line 158 */; ?>
<input id="Y2" name="Y2" type="text" class="form-control input-small"/>
												</div>
											</div>
											<?php /* tag "div" from line 161 */; ?>
<div class="control-group">											
												<?php /* tag "label" from line 162 */; ?>
<label class="control-label">Điện thoại 1</label>
												<?php /* tag "div" from line 163 */; ?>
<div class="controls">
													<?php /* tag "input" from line 164 */; ?>
<input id="Phone12" name="Phone12" type="text" class="form-control input-small"/>
												</div>
											</div>
											<?php /* tag "div" from line 167 */; ?>
<div class="control-group">											
												<?php /* tag "label" from line 168 */; ?>
<label class="control-label">Điện thoại 2</label>
												<?php /* tag "div" from line 169 */; ?>
<div class="controls">
													<?php /* tag "input" from line 170 */; ?>
<input id="Phone22" name="Phone22" type="text" class="form-control input-small"/>
												</div>
											</div>
											<?php /* tag "div" from line 173 */; ?>
<div class="control-group">											
												<?php /* tag "label" from line 174 */; ?>
<label class="control-label">Email 1</label>
												<?php /* tag "div" from line 175 */; ?>
<div class="controls">
													<?php /* tag "input" from line 176 */; ?>
<input id="Email12" name="Email12" type="text" class="form-control input-small"/>
												</div>
											</div>
											<?php /* tag "div" from line 179 */; ?>
<div class="control-group">											
												<?php /* tag "label" from line 180 */; ?>
<label class="control-label">Email 2</label>
												<?php /* tag "div" from line 181 */; ?>
<div class="controls">
													<?php /* tag "input" from line 182 */; ?>
<input id="Email22" name="Email22" type="text" class="form-control input-small"/>
												</div>
											</div>
											<?php /* tag "div" from line 185 */; ?>
<div class="control-group">											
												<?php /* tag "label" from line 186 */; ?>
<label class="control-label">Thứ tự</label>
												<?php /* tag "div" from line 187 */; ?>
<div class="controls">
													<?php /* tag "input" from line 188 */; ?>
<input id="Order2" name="Order2" type="text" class="form-control input-small"/>
												</div>
											</div>
											<?php /* tag "div" from line 191 */; ?>
<div class="control-group">
												<?php /* tag "label" from line 192 */; ?>
<label class="control-label">Logo</label>
												<?php /* tag "div" from line 193 */; ?>
<div class="controls">
													<?php /* tag "input" from line 194 */; ?>
<input id="Logo2" name="Logo2" type="text" class="form-control input-small"/>
												</div>
											</div>
										</div>
									</div>									
									<?php /* tag "div" from line 199 */; ?>
<div class="modal-footer">
										<?php /* tag "button" from line 200 */; ?>
<button class="btn btn-primary btn-small" id="URLUpdButton"><?php /* tag "i" from line 200 */; ?>
<i class="glyphicons-download_alt"></i> Lưu</button>
										<?php /* tag "button" from line 201 */; ?>
<button data-dismiss="modal" class="btn btn-default btn-small"><?php /* tag "i" from line 201 */; ?>
<i class="glyphicons-undo"></i> Hủy</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- END UPDATE DIALOG  -->
					<?php 
/* tag "div" from line 208 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mDialog.xhtml/DialogDel', $_thistpl) ;
$ctx->popSlots() ;
?>

					<?php 
/* tag "div" from line 209 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mDialog.xhtml/DialogDelSelected', $_thistpl) ;
$ctx->popSlots() ;
?>

					
				</div>
			</div>
		</div>
		<?php 
/* tag "div" from line 214 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/Footer', $_thistpl) ;
$ctx->popSlots() ;
?>

		<?php 
/* tag "div" from line 215 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/IncludeJS', $_thistpl) ;
$ctx->popSlots() ;
?>
		
		<?php /* tag "script" from line 216 */; ?>
<script type="text/javascript">
		/*<![CDATA[*/
			$(function() {				
				//SetNewMap();
			});
			
			$('#URLDelSelectedButton').click(function(){
				var count = 0;
				var Data = [];
				var URL = "/object/del/Branch/0";
				
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
			//Delete 1 Branch			
			//-----------------------------------------------------------------------------------
			$('.remove-item').click(function(){
				$('#URLDelButton').attr('alt', $(this).attr('data-id'));
			});
			//Khi người dùng Click vào nút URLDelButton thì tiến  hành gọi Ajax xóa tự động
			$('#URLDelButton').click(function(){			
				var URL = "/object/del/Branch/" + $(this).attr('alt');
				$.ajax({
					type: "POST",					
					url: URL,
					success: function(msg){
						location.reload();
					}
				});
			});
		
			//-----------------------------------------------------------------------------------
			//Insert 1 Branch			
			$("#FormBranchInsert").validate({
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
					Data[2] = $('#Address1').val();
					Data[3] = $('#X1').val();
					Data[4] = $('#Y1').val();
					Data[5] = $('#Phone11').val();
					Data[6] = $('#Phone21').val();
					Data[7] = $('#Email11').val();
					Data[8] = $('#Email21').val();
					Data[9] = $('#Order1').val();
					Data[10] = $('#Logo1').val();
					
					var URL = "/object/ins/Branch";
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
			//Load 1 Branch
			//-----------------------------------------------------------------------------------
			$('.update-item').click(function(){
				//Load dữ liệu JSON về
				var url = "/object/load/Branch/" + $(this).attr('data-id');
				
				//Load dữ liệu JSON lên FORM
				$.getJSON(url, function(data){
					$('#URLUpdButton').attr('alt', 	data.Id);
					$('#Name2').attr('value', 		data.Name);
					$('#Address2').attr('value', 	data.Address);
					$('#X2').attr('value', 			data.X);
					$('#Y2').attr('value', 			data.Y);
					$('#Phone12').attr('value', 	data.Phone1);
					$('#Phone22').attr('value', 	data.Phone2);
					$('#Email12').attr('value', 	data.Email1);
					$('#Email22').attr('value', 	data.Email2);
					$('#Order2').attr('value', 		data.Order);
					$('#Logo2').attr('value', 		data.Logo);
				});
			});
			
			//-----------------------------------------------------------------------------------
			//Update 1 Branch
			//-----------------------------------------------------------------------------------			
			$("#FormBranchUpdate").validate({
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
					Data[2] = $('#Address2').val();
					Data[3] = $('#X2').val();
					Data[4] = $('#Y2').val();
					Data[5] = $('#Phone12').val();
					Data[6] = $('#Phone22').val();
					Data[7] = $('#Email12').val();
					Data[8] = $('#Email22').val();
					Data[9] = $('#Order2').val();
					Data[10] = $('#Logo2').val();
																		
					var URL = "/object/upd/Branch";
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

Generated by PHPTAL from G:\AppsWeb\cmsA\www.huongsenhong.com\mvc\templates\ASettingBranch.html (edit that file instead) */; ?>