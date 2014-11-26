<?php 
function tpl_52ed63e4_SettingCategoryCours__d4BfySvicMb_oLGgmMw_Ew(PHPTAL $tpl, PHPTAL_Context $ctx) {
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
		<?php 
/* tag "div" from line 7 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/IncludeCSS', $_thistpl) ;
$ctx->popSlots() ;
?>

	</head>
	
	<?php /* tag "body" from line 10 */; ?>
<body>
		<?php 
/* tag "div" from line 11 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/Header', $_thistpl) ;
$ctx->popSlots() ;
?>

		<?php 
/* tag "div" from line 12 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/StyleTools', $_thistpl) ;
$ctx->popSlots() ;
?>

		<?php /* tag "div" from line 13 */; ?>
<div id="sidebar">			
			<?php /* tag "ul" from line 14 */; ?>
<ul style="display: block;">
				<?php 
/* tag "li" from line 15 */ ;
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
/* tag "a" from line 16 */ ;
if (null !== ($_tmp_3 = ($ctx->path($ctx->Category1, 'getURLCourse')))):  ;
$_tmp_3 = ' href="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<a<?php echo $_tmp_3 ?>
>
						<?php /* tag "i" from line 17 */; ?>
<i class="glyphicons-fast_food"></i><?php /* tag "span" from line 17 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Category1, 'getName')); ?>
</span>							
					</a>
				</li><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

			</ul>
		</div>
		<?php /* tag "div" from line 22 */; ?>
<div id="content">
			<?php 
/* tag "div" from line 23 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/ContentHeader', $_thistpl) ;
$ctx->popSlots() ;
?>

			<?php 
/* tag "div" from line 24 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/Locationbar', $_thistpl) ;
$ctx->popSlots() ;
?>

			<?php 
/* tag "div" from line 25 */ ;
if (null !== ($_tmp_3 = ($ctx->path($ctx->Category, 'getId')))):  ;
$_tmp_3 = ' alt="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<div id="IdCategory" class="row"<?php echo $_tmp_3 ?>
>
				<?php /* tag "div" from line 26 */; ?>
<div class="col-12">
					<?php /* tag "a" from line 27 */; ?>
<a href="#DialogIns" data-toggle="modal" class="btn btn-primary btn-ins">
						<?php /* tag "i" from line 28 */; ?>
<i class="glyphicons-plus"></i> Thêm mới
					</a>
					<?php /* tag "a" from line 30 */; ?>
<a href="#DialogDelSelected" data-toggle="modal" class="btn btn-primary btn-ins">
						<?php /* tag "i" from line 31 */; ?>
<i class="glyphicons-remove_2"></i> Xóa chọn
					</a>
					<?php /* tag "div" from line 33 */; ?>
<div class="widget-box">						
						<?php /* tag "div" from line 34 */; ?>
<div class="widget-content nopadding">														
							<?php /* tag "table" from line 35 */; ?>
<table class="table table-bordered table-striped table-hover">
								<?php /* tag "thead" from line 36 */; ?>
<thead>
									<?php /* tag "tr" from line 37 */; ?>
<tr role="row">
										<?php /* tag "th" from line 38 */; ?>
<th width="40"><?php /* tag "input" from line 38 */; ?>
<input type="checkbox" id="title-table-checkbox" name="title-table-checkbox"/></th>
										<?php /* tag "th" from line 39 */; ?>
<th width="40"></th>
										<?php /* tag "th" from line 40 */; ?>
<th width="40"></th>
										<?php /* tag "th" from line 41 */; ?>
<th><?php /* tag "div" from line 41 */; ?>
<div class="text-left">TÊN</div></th>
										<?php /* tag "th" from line 42 */; ?>
<th width="120"><?php /* tag "div" from line 42 */; ?>
<div class="text-left">ĐƠN VỊ</div></th>
										<?php /* tag "th" from line 43 */; ?>
<th width="120"><?php /* tag "div" from line 43 */; ?>
<div class="text-right">GIÁ BÁN</div></th>
										<?php /* tag "th" from line 44 */; ?>
<th width="64">TỈ LỆ</th>										
										<?php /* tag "th" from line 45 */; ?>
<th width="32"><?php /* tag "i" from line 45 */; ?>
<i class="glyphicons-bin"></i></th>
									</tr>
								</thead>
								<?php /* tag "tbody" from line 48 */; ?>
<tbody role="alert" aria-live="polite" aria-relevant="all">
									<?php 
/* tag "tr" from line 49 */ ;
$_tmp_2 = $ctx->repeat ;
$_tmp_2->Course = new PHPTAL_RepeatController($ctx->CourseAll)
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_2->Course as $ctx->Course): ;
?>
<tr class="gradeA odd">
										<?php /* tag "td" from line 50 */; ?>
<td class="center"><?php 
/* tag "input" from line 50 */ ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->Course, 'getId')))):  ;
$_tmp_1 = ' data-id="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<input class="CheckedDel" type="checkbox"<?php echo $_tmp_1 ?>
/></td>
										<?php /* tag "td" from line 51 */; ?>
<td>
											<?php 
/* tag "i" from line 52 */ ;
if ($ctx->path($ctx->Course, 'getIsDiscount')):  ;
?>
<i class="glyphicons-star"></i><?php endif; ?>

											<?php 
/* tag "i" from line 53 */ ;
if (!($ctx->path($ctx->Course, 'getIsDiscount'))):  ;
?>
<i class="glyphicons-dislikes"></i><?php endif; ?>

										</td>
										<?php /* tag "td" from line 55 */; ?>
<td><?php 
/* tag "i" from line 55 */ ;
if ($ctx->path($ctx->Course, 'getEnable')):  ;
?>
<i class="glyphicons-eye_open"></i><?php endif; ?>
</td>
										<?php /* tag "td" from line 56 */; ?>
<td><?php 
/* tag "a" from line 56 */ ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->Course, 'getId')))):  ;
$_tmp_1 = ' data-id="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a class="update-item" href="#DialogEdit" data-toggle="modal"<?php echo $_tmp_1 ?>
><?php echo phptal_escape($ctx->path($ctx->Course, 'getName')); ?>
</a></td>
										<?php /* tag "td" from line 57 */; ?>
<td><?php /* tag "div" from line 57 */; ?>
<div><?php echo phptal_escape($ctx->path($ctx->Course, 'getUnit')); ?>
</div></td>
										<?php /* tag "td" from line 58 */; ?>
<td align="right"><?php /* tag "div" from line 58 */; ?>
<div><?php echo phptal_escape($ctx->path($ctx->Course, 'getPrice1Print')); ?>
</div></td>
										<?php /* tag "td" from line 59 */; ?>
<td align="center"><?php 
/* tag "a" from line 59 */ ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->Course, 'getURLRecipe')))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a<?php echo $_tmp_1 ?>
><?php /* tag "i" from line 59 */; ?>
<i class="glyphicons-edit"></i></a></td>
										<?php /* tag "td" from line 60 */; ?>
<td class="center"><?php 
/* tag "a" from line 60 */ ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->Course, 'getId')))):  ;
$_tmp_1 = ' data-id="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a class="remove-item" href="#DialogDel" data-toggle="modal"<?php echo $_tmp_1 ?>
><?php /* tag "i" from line 60 */; ?>
<i class="glyphicons-remove_2"></i></a></td>
									</tr><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

								</tbody>
							</table>
						</div>
					</div>
					<?php 
/* tag "div" from line 66 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/PageBar', $_thistpl) ;
$ctx->popSlots() ;
?>
					
					<!-- INSERT DIALOG  -->
					<?php /* tag "div" from line 68 */; ?>
<div id="DialogIns" class="modal fade">
						<?php /* tag "div" from line 69 */; ?>
<div class="modal-dialog">
							<?php /* tag "div" from line 70 */; ?>
<div class="modal-content">
								<?php /* tag "div" from line 71 */; ?>
<div class="modal-header">
									<?php /* tag "h3" from line 72 */; ?>
<h3><?php /* tag "i" from line 72 */; ?>
<i class="glyphicons-fast_food modal-icon"></i>THÊM MÓN</h3>
								</div>
								<?php /* tag "form" from line 74 */; ?>
<form id="FormCourseInsert" action="#" class="form-horizontal" novalidate="novalidate">
									<?php /* tag "div" from line 75 */; ?>
<div class="modal-body">													
										<?php /* tag "div" from line 76 */; ?>
<div class="form-group">
											<?php /* tag "label" from line 77 */; ?>
<label class="control-label">Tên</label>
											<?php /* tag "div" from line 78 */; ?>
<div class="controls">
												<?php /* tag "input" from line 79 */; ?>
<input id="Name1" name="Name1" type="text" class="form-control input-small"/>
											</div>
										</div>
										<?php /* tag "div" from line 82 */; ?>
<div class="form-group">
											<?php /* tag "label" from line 83 */; ?>
<label class="control-label">Tên ngắn</label>
											<?php /* tag "div" from line 84 */; ?>
<div class="controls">
												<?php /* tag "input" from line 85 */; ?>
<input id="ShortName1" name="ShortName1" type="text" class="form-control input-small"/>
											</div>
										</div>
										<?php /* tag "div" from line 88 */; ?>
<div class="form-group">
											<?php /* tag "label" from line 89 */; ?>
<label class="control-label">Giá bán</label>
											<?php /* tag "div" from line 90 */; ?>
<div class="controls">
												<?php /* tag "input" from line 91 */; ?>
<input id="Price1" name="Price1" type="text" class="form-control input-small"/>
											</div>
										</div>
										<?php /* tag "div" from line 94 */; ?>
<div class="form-group">
											<?php /* tag "label" from line 95 */; ?>
<label class="control-label">Đơn vị</label>
											<?php /* tag "div" from line 96 */; ?>
<div class="controls">
												<?php /* tag "select" from line 97 */; ?>
<select name="Unit1" id="Unit1" style="width:80%;">
													<?php 
/* tag "option" from line 98 */ ;
$_tmp_1 = $ctx->repeat ;
$_tmp_1->Unit = new PHPTAL_RepeatController($ctx->UnitAll)
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_1->Unit as $ctx->Unit): ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->Unit, 'getName')))):  ;
$_tmp_2 = ' value="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<option<?php echo $_tmp_2 ?>
>
														<?php /* tag "span" from line 99 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Unit, 'getName')); ?>
</span>
													</option><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

												</select>
											</div>
										</div>
										<?php /* tag "div" from line 104 */; ?>
<div class="form-group">
											<?php /* tag "label" from line 105 */; ?>
<label class="control-label">Số phút chuẩn bị</label>
											<?php /* tag "div" from line 106 */; ?>
<div class="controls">
												<?php /* tag "input" from line 107 */; ?>
<input id="Prepare1" name="Prepare1" type="text" class="form-control input-small" value="1"/>
											</div>
										</div>
										<?php /* tag "div" from line 110 */; ?>
<div class="form-group">
											<?php /* tag "label" from line 111 */; ?>
<label class="control-label">Giảm giá</label>
											<?php /* tag "div" from line 112 */; ?>
<div class="controls">
												<?php /* tag "select" from line 113 */; ?>
<select name="IsDiscount1" id="IsDiscount1" style="width:80%;">
													<?php /* tag "option" from line 114 */; ?>
<option value="0">Không giảm</option>
													<?php /* tag "option" from line 115 */; ?>
<option value="1">Giảm giá</option>
												</select>
											</div>
										</div>
										<?php /* tag "div" from line 119 */; ?>
<div class="form-group">
											<?php /* tag "label" from line 120 */; ?>
<label class="control-label">Hiển thị</label>
											<?php /* tag "div" from line 121 */; ?>
<div class="controls">
												<?php /* tag "select" from line 122 */; ?>
<select name="Enable1" id="Enable1" style="width:80%;">
													<?php /* tag "option" from line 123 */; ?>
<option value="0">Tắt</option>
													<?php /* tag "option" from line 124 */; ?>
<option value="1">Bật</option>
												</select>
											</div>
										</div>
									</div>
									<?php /* tag "div" from line 129 */; ?>
<div class="modal-footer">										
										<?php /* tag "button" from line 130 */; ?>
<button class="btn btn-primary btn-small" type="submit" value="Validate"><?php /* tag "i" from line 130 */; ?>
<i class="glyphicons-download_alt"></i> Lưu</button>
										<?php /* tag "button" from line 131 */; ?>
<button data-dismiss="modal" class="btn btn-default btn-small"><?php /* tag "i" from line 131 */; ?>
<i class="glyphicons-undo"></i> Hủy</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- END INSERT DIALOG  -->
					
					<!-- DIALOG EDIT	-->
					<?php /* tag "div" from line 140 */; ?>
<div id="DialogEdit" class="modal fade">
						<?php /* tag "div" from line 141 */; ?>
<div class="modal-dialog">
							<?php /* tag "div" from line 142 */; ?>
<div class="modal-content">
								<?php /* tag "div" from line 143 */; ?>
<div class="modal-header">
									<?php /* tag "h3" from line 144 */; ?>
<h3><?php /* tag "i" from line 144 */; ?>
<i class="glyphicons-fast_food modal-icon"></i>CHỈNH SỬA MÓN</h3>
								</div>
								<?php /* tag "form" from line 146 */; ?>
<form id="FormCourseUpdate" action="#" class="form-horizontal" novalidate="novalidate">
									<?php /* tag "div" from line 147 */; ?>
<div class="form-group">
										<?php /* tag "label" from line 148 */; ?>
<label class="control-label">Tên</label>
										<?php /* tag "div" from line 149 */; ?>
<div class="controls">
											<?php /* tag "input" from line 150 */; ?>
<input id="Name2" name="Name2" type="text" class="form-control input-small"/>
										</div>
									</div>
									<?php /* tag "div" from line 153 */; ?>
<div class="form-group">
										<?php /* tag "label" from line 154 */; ?>
<label class="control-label">Tên ngắn</label>
										<?php /* tag "div" from line 155 */; ?>
<div class="controls">
											<?php /* tag "input" from line 156 */; ?>
<input id="ShortName2" name="ShortName2" type="text" class="form-control input-small"/>
										</div>
									</div>
									<?php /* tag "div" from line 159 */; ?>
<div class="form-group">
										<?php /* tag "label" from line 160 */; ?>
<label class="control-label">Giá bán</label>
										<?php /* tag "div" from line 161 */; ?>
<div class="controls">
											<?php /* tag "input" from line 162 */; ?>
<input id="Price2" name="Price2" type="text" class="form-control input-small"/>
										</div>
									</div>
									<?php /* tag "div" from line 165 */; ?>
<div class="form-group">
										<?php /* tag "label" from line 166 */; ?>
<label class="control-label">Đơn vị</label>
										<?php /* tag "div" from line 167 */; ?>
<div class="controls">
											<?php /* tag "select" from line 168 */; ?>
<select name="Unit2" id="Unit2" style="width:80%;">
												<?php 
/* tag "option" from line 169 */ ;
$_tmp_2 = $ctx->repeat ;
$_tmp_2->Unit = new PHPTAL_RepeatController($ctx->UnitAll)
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_2->Unit as $ctx->Unit): ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->Unit, 'getName')))):  ;
$_tmp_1 = ' value="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<option<?php echo $_tmp_1 ?>
>
													<?php /* tag "span" from line 170 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Unit, 'getName')); ?>
</span>
												</option><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

											</select>
										</div>
									</div>
									<?php /* tag "div" from line 175 */; ?>
<div class="form-group">
										<?php /* tag "label" from line 176 */; ?>
<label class="control-label">Số phút chuẩn bị</label>
										<?php /* tag "div" from line 177 */; ?>
<div class="controls">
											<?php /* tag "input" from line 178 */; ?>
<input id="Prepare2" name="Prepare2" type="text" class="form-control input-small"/>
										</div>
									</div>
									<?php /* tag "div" from line 181 */; ?>
<div class="form-group">
										<?php /* tag "label" from line 182 */; ?>
<label class="control-label">Giảm giá</label>
										<?php /* tag "div" from line 183 */; ?>
<div class="controls">
											<?php /* tag "select" from line 184 */; ?>
<select name="IsDiscount2" id="IsDiscount2" style="width:80%;">
												<?php /* tag "option" from line 185 */; ?>
<option value="0">Không giảm</option>
												<?php /* tag "option" from line 186 */; ?>
<option value="1">Giảm giá</option>
											</select>
										</div>
									</div>
									<?php /* tag "div" from line 190 */; ?>
<div class="form-group">
										<?php /* tag "label" from line 191 */; ?>
<label class="control-label">Hiển thị</label>
										<?php /* tag "div" from line 192 */; ?>
<div class="controls">
											<?php /* tag "select" from line 193 */; ?>
<select name="Enable2" id="Enable2" style="width:80%;">
												<?php /* tag "option" from line 194 */; ?>
<option value="0">Tắt</option>
												<?php /* tag "option" from line 195 */; ?>
<option value="1">Bật</option>
											</select>
										</div>
									</div>
									<?php /* tag "div" from line 199 */; ?>
<div class="modal-footer">
										<?php /* tag "button" from line 200 */; ?>
<button id="URLUpdButton" class="btn btn-primary btn-small" type="submit" value="Validate"><?php /* tag "i" from line 200 */; ?>
<i class="glyphicons-download_alt"></i> Lưu</button>
										<?php /* tag "button" from line 201 */; ?>
<button data-dismiss="modal" class="btn btn-default btn-small"><?php /* tag "i" from line 201 */; ?>
<i class="glyphicons-undo"></i> Hủy</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- END DIALOG EDIT -->
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
			$('#URLDelSelectedButton').click(function(){
				var count = 0;
				var Data = [];
				var URL = "/object/del/Course/0";
				
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
			//Delete 1 COURSE			
			//-----------------------------------------------------------------------------------
			$('.remove-item').click(function(){
				$('#URLDelButton').attr('alt', $(this).attr('data-id'));
			});
			//Khi người dùng Click vào nút URLDelButton thì tiến  hành gọi Ajax xóa tự động
			$('#URLDelButton').click(function(){			
				var URL = "/object/del/Course/" + $(this).attr('alt');
				$.ajax({
					type: "POST",
					url: URL,
					success: function(msg){
						location.reload();
					}
				});
			});
						
			//-----------------------------------------------------------------------------------
			//Insert 1 RESOURCE			
			$("#FormCourseInsert").validate({
				rules:{
					Name1:{
						minlength: 2,
						required:true
					},
					ShortName1:{
						minlength: 2,
						required:true
					},
					Price1:{
						number:true,
						required:true,
						min:0,
						max:10000000
					},
					Prepare1:{
						number:true,
						required:true,
						min:0,
						max:120
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
					Data[1] = $('#IdCategory').attr('alt');				
					Data[2] = $('#Name1').val();
					Data[3] = $('#ShortName1').val();
					Data[4] = $('#Unit1').val();
					Data[5] = $('#Price1').val();
					Data[6] = $('#Price1').val();
					Data[7] = $('#Price1').val();
					Data[8] = $('#Price1').val();
					Data[9] = "";
					Data[10] = $('#Prepare1').val();
					Data[11] = $('#IsDiscount1').val();
					Data[12] = $('#Enable1').val();
					
					var URL = "/object/ins/Course";
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
			//Load 1 COURSE
			//-----------------------------------------------------------------------------------
			$('.update-item').click(function(){
				//Load dữ liệu JSON về
				var url = "/object/load/Course/" + $(this).attr('data-id');
				
				//Load dữ liệu JSON lên FORM
				$.getJSON(url, function(data){
					$('#URLUpdButton').attr('alt'	, data.Id);
					$('#Name2').attr('value'		, data.Name);
					$('#ShortName2').attr('value'	, data.ShortName);
					$('#Unit2').select2('val'		, data.Unit);
					$('#Price2').attr('value'		, data.Price1);
					$('#Prepare2').attr('value'		, data.Prepare);
					$('#IsDiscount2').select2('val'	, data.IsDiscount);
					$('#Enable2').select2('val'		, data.Enable);
				});
			});
			
			//-----------------------------------------------------------------------------------
			//Update 1 RESOURCE
			//-----------------------------------------------------------------------------------
			$("#FormCourseUpdate").validate({
				rules:{
					Name2:{
						minlength: 2,
						required:true
					},
					ShortName2:{
						minlength: 2,
						required:true
					},
					Price2:{
						number:true,
						required:true,
						min:0,
						max:10000000
					},
					Prepare2:{
						number:true,
						required:true,
						min:0,
						max:120
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
					Data[1] = $('#IdCategory').attr('alt');				
					Data[2] = $('#Name2').val();
					Data[3] = $('#ShortName2').val();
					Data[4] = $('#Unit2').val();
					Data[5] = $('#Price2').val();
					Data[6] = $('#Price2').val();
					Data[7] = $('#Price2').val();
					Data[8] = $('#Price2').val();
					Data[9] = "";
					Data[10] = $('#Prepare2').val();
					Data[11] = $('#IsDiscount2').val();
					Data[12] = $('#Enable2').val();
					
					var URL = "/object/upd/Course";
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

Generated by PHPTAL from G:\AppsWeb\cmsA\sell.thanhsocola.com\mvc\templates\SettingCategoryCourse.html (edit that file instead) */; ?>