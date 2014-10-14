<?php 
function tpl_54319b99_ASettingSupplierProd__AaJi6qCVEJBLHlIB5gyx3g(PHPTAL $tpl, PHPTAL_Context $ctx) {
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
	<?php /* tag "body" from line 7 */; ?>
<body>
		<?php 
/* tag "div" from line 8 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/Header', $_thistpl) ;
$ctx->popSlots() ;
?>
		
		<?php /* tag "div" from line 9 */; ?>
<div id="sidebar">
			<?php /* tag "ul" from line 10 */; ?>
<ul style="display: block;">				
				<?php 
/* tag "li" from line 11 */ ;
$_tmp_1 = $ctx->repeat ;
$_tmp_1->P1 = new PHPTAL_RepeatController($ctx->path($ctx->Supplier, 'getManufacturerAll'))
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_1->P1 as $ctx->P1): ;
if (null !== ($_tmp_2 = ($ctx->P1->getIdManufacturer()==$ctx->IdManufacturer?'active':''))):  ;
$_tmp_2 = ' class="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<li<?php echo $_tmp_2 ?>
>
					<?php 
/* tag "a" from line 12 */ ;
if (null !== ($_tmp_3 = ($ctx->Supplier->getURLSettingManufacturer($ctx->P1->getIdManufacturer())))):  ;
$_tmp_3 = ' href="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<a<?php echo $_tmp_3 ?>
>
						<?php /* tag "i" from line 13 */; ?>
<i class="glyphicons-truck"></i><?php /* tag "span" from line 13 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->P1, 'getManufacturer/getName')); ?>
</span>
					</a>
				</li><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

			</ul>
		</div>
		<?php /* tag "div" from line 18 */; ?>
<div id="content">
			<?php 
/* tag "div" from line 19 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/ContentHeader', $_thistpl) ;
$ctx->popSlots() ;
?>

			<?php 
/* tag "div" from line 20 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/Locationbar', $_thistpl) ;
$ctx->popSlots() ;
?>

			<?php 
/* tag "div" from line 21 */ ;
if (null !== ($_tmp_3 = ($ctx->path($ctx->Supplier, 'getId')))):  ;
$_tmp_3 = ' alt="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<div id="IdSupplier" class="row"<?php echo $_tmp_3 ?>
>
				<?php /* tag "div" from line 22 */; ?>
<div class="col-12">
					<?php /* tag "a" from line 23 */; ?>
<a href="#DialogIns" data-toggle="modal" class="btn btn-primary btn-ins">
						<?php /* tag "i" from line 24 */; ?>
<i class="glyphicons-plus"></i> Thêm mới
					</a>
					<?php /* tag "a" from line 26 */; ?>
<a href="#DialogDelSelected" data-toggle="modal" class="btn btn-primary btn-ins">
						<?php /* tag "i" from line 27 */; ?>
<i class="glyphicons-remove_2"></i> Xóa chọn
					</a>
					<?php /* tag "div" from line 29 */; ?>
<div class="widget-box">						
						<?php /* tag "div" from line 30 */; ?>
<div class="widget-content nopadding">
							<?php /* tag "table" from line 31 */; ?>
<table class="table table-bordered table-striped table-hover">
								<?php /* tag "thead" from line 32 */; ?>
<thead>
									<?php /* tag "tr" from line 33 */; ?>
<tr>
										<?php /* tag "th" from line 34 */; ?>
<th width="30"><?php /* tag "input" from line 34 */; ?>
<input type="checkbox" id="title-table-checkbox" name="title-table-checkbox"/></th>
										<?php /* tag "th" from line 35 */; ?>
<th width="90" class="left">DANH MỤC</th>
										<?php /* tag "th" from line 36 */; ?>
<th width="200" class="left">TÊN</th>																				
										<?php /* tag "th" from line 37 */; ?>
<th width="90">THÔNG TIN</th>										
										<?php /* tag "th" from line 38 */; ?>
<th width="90">ALBUM</th>
										<?php /* tag "th" from line 39 */; ?>
<th width="30"><?php /* tag "i" from line 39 */; ?>
<i class="glyphicons-bin"></i></th>
									</tr>
								</thead>
								<?php /* tag "tbody" from line 42 */; ?>
<tbody>
									<?php 
/* tag "tr" from line 43 */ ;
$_tmp_2 = $ctx->repeat ;
$_tmp_2->Product = new PHPTAL_RepeatController($ctx->ProductAll1)
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_2->Product as $ctx->Product): ;
?>
<tr>
										<?php /* tag "td" from line 44 */; ?>
<td class="center"><?php 
/* tag "input" from line 44 */ ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->Product, 'getId')))):  ;
$_tmp_1 = ' data-id="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<input class="CheckedDel" type="checkbox"<?php echo $_tmp_1 ?>
/></td>
										<?php /* tag "td" from line 45 */; ?>
<td class="left">
											<?php /* tag "span" from line 46 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Product, 'getCategory/getCategory/getName')); ?>
</span> / 
											<?php /* tag "span" from line 47 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Product, 'getCategory/getName')); ?>
</span>
										</td>
										<?php /* tag "td" from line 49 */; ?>
<td><?php 
/* tag "a" from line 58 */ ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->Product, 'getId')))):  ;
$_tmp_1 = ' id="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
if (null !== ($_tmp_4 = ($ctx->path($ctx->Product, 'getIdCategory')))):  ;
$_tmp_4 = ' idcategory="'.phptal_escape($_tmp_4).'"' ;
else:  ;
$_tmp_4 = '' ;
endif ;
if (null !== ($_tmp_5 = ($ctx->path($ctx->Product, 'getIdManufacturer')))):  ;
$_tmp_5 = ' idmanufacturer="'.phptal_escape($_tmp_5).'"' ;
else:  ;
$_tmp_5 = '' ;
endif ;
if (null !== ($_tmp_6 = ($ctx->path($ctx->Product, 'getName')))):  ;
$_tmp_6 = ' name="'.phptal_escape($_tmp_6).'"' ;
else:  ;
$_tmp_6 = '' ;
endif ;
if (null !== ($_tmp_7 = ($ctx->path($ctx->Product, 'getCode')))):  ;
$_tmp_7 = ' code="'.phptal_escape($_tmp_7).'"' ;
else:  ;
$_tmp_7 = '' ;
endif ;
if (null !== ($_tmp_8 = ($ctx->path($ctx->Product, 'getPrice1')))):  ;
$_tmp_8 = ' price1="'.phptal_escape($_tmp_8).'"' ;
else:  ;
$_tmp_8 = '' ;
endif ;
if (null !== ($_tmp_9 = ($ctx->path($ctx->Product, 'getPrice2')))):  ;
$_tmp_9 = ' price2="'.phptal_escape($_tmp_9).'"' ;
else:  ;
$_tmp_9 = '' ;
endif ;
?>
<a class="update-item" href="#DialogEdit" data-toggle="modal"<?php echo $_tmp_1 ?>
<?php echo $_tmp_4 ?>
<?php echo $_tmp_5 ?>
<?php echo $_tmp_6 ?>
<?php echo $_tmp_7 ?>
<?php echo $_tmp_8 ?>
<?php echo $_tmp_9 ?>
><?php echo phptal_escape($ctx->path($ctx->Product, 'getName')); ?>
</a>
										</td>										
										<?php /* tag "td" from line 60 */; ?>
<td class="center">
											<?php 
/* tag "a" from line 61 */ ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->Product, 'getURLSettingInfo')))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a<?php echo $_tmp_1 ?>
>Cập nhật</a>
										</td>										
										<?php /* tag "td" from line 63 */; ?>
<td class="center">										
											<?php 
/* tag "a" from line 64 */ ;
if (null !== ($_tmp_4 = ($ctx->path($ctx->Product, 'getURLSettingImage')))):  ;
$_tmp_4 = ' href="'.phptal_escape($_tmp_4).'"' ;
else:  ;
$_tmp_4 = '' ;
endif ;
?>
<a<?php echo $_tmp_4 ?>
>Ảnh (<?php /* tag "span" from line 64 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Product, 'getImageAll/count')); ?>
</span>)</a>
										</td>
										<?php /* tag "td" from line 66 */; ?>
<td class="center"><?php 
/* tag "a" from line 66 */ ;
if (null !== ($_tmp_5 = ($ctx->path($ctx->Product, 'getId')))):  ;
$_tmp_5 = ' data-id="'.phptal_escape($_tmp_5).'"' ;
else:  ;
$_tmp_5 = '' ;
endif ;
?>
<a class="remove-item" href="#DialogDel" data-toggle="modal"<?php echo $_tmp_5 ?>
><?php /* tag "i" from line 66 */; ?>
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
/* tag "div" from line 72 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/PageBar', $_thistpl) ;
$ctx->popSlots() ;
?>
					
					<!-- INSERT DIALOG  -->
					<?php /* tag "div" from line 74 */; ?>
<div id="DialogIns" class="modal fade">
						<?php /* tag "div" from line 75 */; ?>
<div class="modal-dialog">
							<?php /* tag "div" from line 76 */; ?>
<div class="modal-content">
								<?php /* tag "div" from line 77 */; ?>
<div class="modal-header"><?php /* tag "h3" from line 77 */; ?>
<h3><?php /* tag "i" from line 77 */; ?>
<i class="glyphicons-truck modal-icon"></i>THÊM SẢN PHẨM</h3></div>
								<?php /* tag "form" from line 78 */; ?>
<form id="FormProductInsert" action="#" class="form-horizontal" novalidate="novalidate">
									<?php /* tag "div" from line 79 */; ?>
<div class="modal-body">													
										<?php /* tag "div" from line 80 */; ?>
<div class="form-group">
											<?php /* tag "label" from line 81 */; ?>
<label class="control-label">Tên</label>
											<?php /* tag "div" from line 82 */; ?>
<div class="controls">
												<?php /* tag "input" from line 83 */; ?>
<input id="Name1" name="Name1" type="text" class="form-control input-small"/>
											</div>
										</div>
										<?php /* tag "div" from line 86 */; ?>
<div class="form-group">
											<?php /* tag "label" from line 87 */; ?>
<label class="control-label">Mã</label>
											<?php /* tag "div" from line 88 */; ?>
<div class="controls">
												<?php /* tag "input" from line 89 */; ?>
<input id="Code1" name="Code1" type="text" class="form-control input-small"/>
											</div>
										</div>
										<?php /* tag "div" from line 92 */; ?>
<div class="form-group">
											<?php /* tag "label" from line 93 */; ?>
<label class="control-label">Danh mục</label>
											<?php /* tag "div" from line 94 */; ?>
<div class="controls">
												<?php /* tag "select" from line 95 */; ?>
<select name="IdCategory1" id="IdCategory1" style="width:80%;">
													<?php 
/* tag "option" from line 96 */ ;
$_tmp_6 = $ctx->repeat ;
$_tmp_6->Category1 = new PHPTAL_RepeatController($ctx->CategoryAll1)
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_6->Category1 as $ctx->Category1): ;
if (null !== ($_tmp_7 = ($ctx->path($ctx->Category1, 'getId')))):  ;
$_tmp_7 = ' value="'.phptal_escape($_tmp_7).'"' ;
else:  ;
$_tmp_7 = '' ;
endif ;
?>
<option<?php echo $_tmp_7 ?>
>
														<?php /* tag "span" from line 97 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Category1, 'getCategory/getName')); ?>
</span> / 
														<?php /* tag "span" from line 98 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Category1, 'getName')); ?>
</span>
													</option><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

												</select>
											</div>
										</div>
										<?php /* tag "div" from line 103 */; ?>
<div class="form-group">
											<?php /* tag "label" from line 104 */; ?>
<label class="control-label">Nhà sản xuất</label>
											<?php /* tag "div" from line 105 */; ?>
<div class="controls">
												<?php /* tag "select" from line 106 */; ?>
<select name="IdManufacturer1" id="IdManufacturer1" style="width:80%;">
													<?php 
/* tag "option" from line 107 */ ;
$_tmp_8 = $ctx->repeat ;
$_tmp_8->Manufacturer = new PHPTAL_RepeatController($ctx->ManufacturerAll)
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_8->Manufacturer as $ctx->Manufacturer): ;
if (null !== ($_tmp_9 = ($ctx->path($ctx->Manufacturer, 'getId')))):  ;
$_tmp_9 = ' value="'.phptal_escape($_tmp_9).'"' ;
else:  ;
$_tmp_9 = '' ;
endif ;
?>
<option<?php echo $_tmp_9 ?>
>
														<?php /* tag "span" from line 108 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Manufacturer, 'getName')); ?>
</span>
													</option><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

												</select>
											</div>
										</div>										
										<?php /* tag "div" from line 113 */; ?>
<div class="form-group">
											<?php /* tag "label" from line 114 */; ?>
<label class="control-label">Giá nhập</label>
											<?php /* tag "div" from line 115 */; ?>
<div class="controls">
												<?php /* tag "input" from line 116 */; ?>
<input id="Price11" name="Price11" type="text" class="form-control input-small"/>
											</div>
										</div>
										<?php /* tag "div" from line 119 */; ?>
<div class="form-group">
											<?php /* tag "label" from line 120 */; ?>
<label class="control-label">Giá bán</label>
											<?php /* tag "div" from line 121 */; ?>
<div class="controls">
												<?php /* tag "input" from line 122 */; ?>
<input id="Price21" name="Price21" type="text" class="form-control input-small"/>
											</div>
										</div>										
									</div>
									<?php /* tag "div" from line 126 */; ?>
<div class="modal-footer">
										<?php /* tag "button" from line 127 */; ?>
<button id="URLInsButton" class="btn btn-primary btn-small"><?php /* tag "i" from line 127 */; ?>
<i class="glyphicons-download_alt"></i> Lưu</button>
										<?php /* tag "button" from line 128 */; ?>
<button data-dismiss="modal" class="btn btn-default btn-small"><?php /* tag "i" from line 128 */; ?>
<i class="glyphicons-undo"></i> Hủy</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- END INSERT DIALOG  -->
					
					<!-- DIALOG EDIT	-->
					<?php /* tag "div" from line 137 */; ?>
<div id="DialogEdit" class="modal fade">
						<?php /* tag "div" from line 138 */; ?>
<div class="modal-dialog">
							<?php /* tag "div" from line 139 */; ?>
<div class="modal-content">
								<?php /* tag "div" from line 140 */; ?>
<div class="modal-header">
									<?php /* tag "h3" from line 141 */; ?>
<h3><?php /* tag "i" from line 141 */; ?>
<i class="glyphicons-truck modal-icon"></i>CHỈNH SỬA SẢN PHẨM</h3>
								</div>
								<?php /* tag "form" from line 143 */; ?>
<form id="FormProductUpdate" action="#" class="form-horizontal" novalidate="novalidate">
										<?php /* tag "div" from line 144 */; ?>
<div class="form-group">
											<?php /* tag "label" from line 145 */; ?>
<label class="control-label">Tên</label>
											<?php /* tag "div" from line 146 */; ?>
<div class="controls">
												<?php /* tag "input" from line 147 */; ?>
<input id="Name2" name="Name2" type="text" class="form-control input-small"/>
											</div>
										</div>
										<?php /* tag "div" from line 150 */; ?>
<div class="form-group">
											<?php /* tag "label" from line 151 */; ?>
<label class="control-label">Mã</label>
											<?php /* tag "div" from line 152 */; ?>
<div class="controls">
												<?php /* tag "input" from line 153 */; ?>
<input id="Code2" name="Code2" type="text" class="form-control input-small"/>
											</div>
										</div>
										<?php /* tag "div" from line 156 */; ?>
<div class="form-group">
											<?php /* tag "label" from line 157 */; ?>
<label class="control-label">Danh mục</label>
											<?php /* tag "div" from line 158 */; ?>
<div class="controls">
												<?php /* tag "select" from line 159 */; ?>
<select name="IdCategory2" id="IdCategory2" style="width:80%;">
													<?php 
/* tag "option" from line 160 */ ;
$_tmp_1 = $ctx->repeat ;
$_tmp_1->Category1 = new PHPTAL_RepeatController($ctx->CategoryAll1)
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_1->Category1 as $ctx->Category1): ;
if (null !== ($_tmp_4 = ($ctx->path($ctx->Category1, 'getId')))):  ;
$_tmp_4 = ' value="'.phptal_escape($_tmp_4).'"' ;
else:  ;
$_tmp_4 = '' ;
endif ;
?>
<option<?php echo $_tmp_4 ?>
>
														<?php /* tag "span" from line 161 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Category1, 'getCategory/getName')); ?>
</span> / 
														<?php /* tag "span" from line 162 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Category1, 'getName')); ?>
</span>
													</option><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

												</select>
											</div>
										</div>
										<?php /* tag "div" from line 167 */; ?>
<div class="form-group">
											<?php /* tag "label" from line 168 */; ?>
<label class="control-label">Nhà sản xuất</label>
											<?php /* tag "div" from line 169 */; ?>
<div class="controls">
												<?php /* tag "select" from line 170 */; ?>
<select name="IdManufacturer2" id="IdManufacturer2" style="width:80%;">
													<?php 
/* tag "option" from line 171 */ ;
$_tmp_5 = $ctx->repeat ;
$_tmp_5->Manufacturer = new PHPTAL_RepeatController($ctx->ManufacturerAll)
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_5->Manufacturer as $ctx->Manufacturer): ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->Manufacturer, 'getId')))):  ;
$_tmp_2 = ' value="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<option<?php echo $_tmp_2 ?>
>
														<?php /* tag "span" from line 172 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Manufacturer, 'getName')); ?>
</span>
													</option><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

												</select>
											</div>
										</div>
										<?php /* tag "div" from line 177 */; ?>
<div class="form-group">
											<?php /* tag "label" from line 178 */; ?>
<label class="control-label">Giá nhập</label>
											<?php /* tag "div" from line 179 */; ?>
<div class="controls">
												<?php /* tag "input" from line 180 */; ?>
<input id="Price12" name="Price12" type="text" class="form-control input-small"/>
											</div>
										</div>
										<?php /* tag "div" from line 183 */; ?>
<div class="form-group">
											<?php /* tag "label" from line 184 */; ?>
<label class="control-label">Giá bán</label>
											<?php /* tag "div" from line 185 */; ?>
<div class="controls">
												<?php /* tag "input" from line 186 */; ?>
<input id="Price22" name="Price22" type="text" class="form-control input-small"/>
											</div>
										</div>										
									<?php /* tag "div" from line 189 */; ?>
<div class="modal-footer">
										<?php /* tag "button" from line 190 */; ?>
<button id="URLUpdButton" class="btn btn-primary btn-small"><?php /* tag "i" from line 190 */; ?>
<i class="glyphicons-download_alt"></i> Lưu</button>
										<?php /* tag "button" from line 191 */; ?>
<button data-dismiss="modal" class="btn btn-default btn-small"><?php /* tag "i" from line 191 */; ?>
<i class="glyphicons-undo"></i> Hủy</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- END DIALOG EDIT -->
					<?php 
/* tag "div" from line 198 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mDialog.xhtml/DialogDel', $_thistpl) ;
$ctx->popSlots() ;
?>

					<?php 
/* tag "div" from line 199 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mDialog.xhtml/DialogDelSelected', $_thistpl) ;
$ctx->popSlots() ;
?>

					
				</div>
			</div>
		</div>		
		<?php 
/* tag "div" from line 204 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/Footer', $_thistpl) ;
$ctx->popSlots() ;
?>

		<?php 
/* tag "div" from line 205 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/IncludeJS', $_thistpl) ;
$ctx->popSlots() ;
?>

		<?php /* tag "script" from line 206 */; ?>
<script type="text/javascript">
		/*<![CDATA[*/
															
			$('#URLDelSelectedButton').click(function(){
				var count = 0;
				var Data = [];
				var URL = "/object/del/Product/0";
				
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
				var URL = "/object/del/Product/" + $(this).attr('alt');
				$.ajax({
					type: "POST",
					url: URL,
					success: function(msg){
						location.reload();
					}
				});
			});
		
						
			//-----------------------------------------------------------------------------------
			//Insert 1 Product			
			$("#FormProductInsert").validate({
				rules:{
					Name1:{
						minlength: 2,
						required:true
					},
					Price1:{						
						required:true,
						number:true,
						min:0
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
					Data[1] = $('#IdSupplier').attr('alt');
					Data[2] = $('#IdCategory1').val();
					Data[3] = $('#IdManufacturer1').val();
					Data[4] = $('#Name1').val();
					Data[5] = $('#Code1').val();
					Data[6] = $('#Price11').val();
					Data[7] = $('#Price21').val();
					var URL = "/object/ins/Product";
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
				$('#IdManufacturer1').select2('val', $('#IdManufacturer').attr('alt') );
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
				var url = "/object/load/Product/" + $(this).attr('data-id');
				
				$('#URLUpdButton').attr('alt', 	$(this).attr('id')	);
				$('#Name2').attr('value', 		$(this).attr('name'));
				$('#IdCategory2').select2('val', $(this).attr('idcategory'));
				$('#IdManufacturer2').select2('val', $(this).attr('idmanufacturer'));				
				$('#Code2').attr('value', 		$(this).attr('code'));
				$('#Price12').attr('value', 	$(this).attr('price1'));
				$('#Price22').attr('value', 	$(this).attr('price2'));
			});
			
			//-----------------------------------------------------------------------------------
			//Update 1 Product
			//-----------------------------------------------------------------------------------
			$("#FormProductUpdate").validate({
				rules:{
					Name2:{
						minlength: 2,
						required:true
					},
					Price2:{						
						required:true,
						number:true,
						min:0
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
					Data[1] = $('#IdSupplier').attr('alt');
					Data[2] = $('#IdCategory2').val();
					Data[3] = $('#IdManufacturer2').val();
					Data[4] = $('#Name2').val();
					Data[5] = $('#Code2').val();
					Data[6] = $('#Price12').val();
					Data[7] = $('#Price22').val();
					
					var URL = "/object/upd/Product";
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
		<?php 
/* tag "div" from line 375 */ ;
if (null !== ($_tmp_7 = ($ctx->path($ctx->Supplier, 'getId')))):  ;
$_tmp_7 = ' alt="'.phptal_escape($_tmp_7).'"' ;
else:  ;
$_tmp_7 = '' ;
endif ;
?>
<div id="IdSupplier"<?php echo $_tmp_7 ?>
></div>
		<?php 
/* tag "div" from line 376 */ ;
if (null !== ($_tmp_6 = ($ctx->IdManufacturer))):  ;
$_tmp_6 = ' alt="'.phptal_escape($_tmp_6).'"' ;
else:  ;
$_tmp_6 = '' ;
endif ;
?>
<div id="IdManufacturer"<?php echo $_tmp_6 ?>
></div>
	</body>
</html><?php 
/* end */ ;

}

?>
<?php /* 
*** DO NOT EDIT THIS FILE ***

Generated by PHPTAL from G:\AppsWeb\cmsA\www.amthuclangsen.com\mvc\templates\ASettingSupplierProduct.html (edit that file instead) */; ?>