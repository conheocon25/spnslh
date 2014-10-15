<?php 
function tpl_5430e3e6_ASettingConfig__wFmtOzWy9TSMYj7cXM1dTQ(PHPTAL $tpl, PHPTAL_Context $ctx) {
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
					<?php /* tag "div" from line 15 */; ?>
<div class="widget-box">
						<?php /* tag "div" from line 16 */; ?>
<div class="widget-content nopadding">
							<?php /* tag "div" from line 17 */; ?>
<div class="form-horizontal">
								<?php /* tag "div" from line 18 */; ?>
<div class="modal-body">
									<?php /* tag "div" from line 19 */; ?>
<div class="form-group">
										<?php /* tag "label" from line 20 */; ?>
<label class="control-label">Tên shop</label>
										<?php /* tag "div" from line 21 */; ?>
<div class="controls">
											<?php 
/* tag "input" from line 22 */ ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->ConfigName, 'getValue')))):  ;
$_tmp_1 = ' value="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->ConfigName, 'getId')))):  ;
$_tmp_2 = ' data-id="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<input id="Name2" type="text" class="form-control input-small"<?php echo $_tmp_1 ?>
<?php echo $_tmp_2 ?>
/>
										</div>
									</div>
									<?php /* tag "div" from line 25 */; ?>
<div class="form-group">
										<?php /* tag "label" from line 26 */; ?>
<label class="control-label">Địa chỉ</label>
										<?php /* tag "div" from line 27 */; ?>
<div class="controls">
											<?php 
/* tag "input" from line 28 */ ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->ConfigAddress, 'getValue')))):  ;
$_tmp_1 = ' value="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->ConfigAddress, 'getId')))):  ;
$_tmp_2 = ' data-id="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<input id="Address2" type="text" class="form-control input-small"<?php echo $_tmp_1 ?>
<?php echo $_tmp_2 ?>
/>
										</div>
									</div>
									<?php /* tag "div" from line 31 */; ?>
<div class="form-group">
										<?php /* tag "label" from line 32 */; ?>
<label class="control-label">Khẩu hiệu</label>
										<?php /* tag "div" from line 33 */; ?>
<div class="controls">
											<?php 
/* tag "input" from line 34 */ ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->ConfigSlogan, 'getValue')))):  ;
$_tmp_1 = ' value="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->ConfigSlogan, 'getId')))):  ;
$_tmp_2 = ' data-id="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<input id="Slogan2" type="text" class="form-control input-small"<?php echo $_tmp_1 ?>
<?php echo $_tmp_2 ?>
/>
										</div>
									</div>
									<?php /* tag "div" from line 37 */; ?>
<div class="form-group">
										<?php /* tag "label" from line 38 */; ?>
<label class="control-label">Người liên hệ</label>
										<?php /* tag "div" from line 39 */; ?>
<div class="controls">
											<?php 
/* tag "input" from line 40 */ ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->ConfigContact, 'getValue')))):  ;
$_tmp_1 = ' value="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->ConfigContact, 'getId')))):  ;
$_tmp_2 = ' data-id="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<input id="Contact2" type="text" class="form-control input-small"<?php echo $_tmp_1 ?>
<?php echo $_tmp_2 ?>
/>
										</div>
									</div>
									<?php /* tag "div" from line 43 */; ?>
<div class="form-group">
										<?php /* tag "label" from line 44 */; ?>
<label class="control-label">Nick YahooMessenger</label>
										<?php /* tag "div" from line 45 */; ?>
<div class="controls">
											<?php 
/* tag "input" from line 46 */ ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->ConfigYahooMessenger, 'getValue')))):  ;
$_tmp_1 = ' value="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->ConfigYahooMessenger, 'getId')))):  ;
$_tmp_2 = ' data-id="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<input id="YahooMessenger2" type="text" class="form-control input-small"<?php echo $_tmp_1 ?>
<?php echo $_tmp_2 ?>
/>
										</div>
									</div>
									<?php /* tag "div" from line 49 */; ?>
<div class="form-group">
										<?php /* tag "label" from line 50 */; ?>
<label class="control-label">Nick Skype</label>
										<?php /* tag "div" from line 51 */; ?>
<div class="controls">
											<?php 
/* tag "input" from line 52 */ ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->ConfigSkype, 'getValue')))):  ;
$_tmp_1 = ' value="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->ConfigSkype, 'getId')))):  ;
$_tmp_2 = ' data-id="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<input id="Skype2" type="text" class="form-control input-small"<?php echo $_tmp_1 ?>
<?php echo $_tmp_2 ?>
/>
										</div>
									</div>
									<?php /* tag "div" from line 55 */; ?>
<div class="form-group">
										<?php /* tag "label" from line 56 */; ?>
<label class="control-label">Nick GTalk</label>
										<?php /* tag "div" from line 57 */; ?>
<div class="controls">
											<?php 
/* tag "input" from line 58 */ ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->ConfigGTalk, 'getValue')))):  ;
$_tmp_1 = ' value="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->ConfigGTalk, 'getId')))):  ;
$_tmp_2 = ' data-id="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<input id="GTalk2" type="text" class="form-control input-small"<?php echo $_tmp_1 ?>
<?php echo $_tmp_2 ?>
/>
										</div>
									</div>
									<?php /* tag "div" from line 61 */; ?>
<div class="form-group">
										<?php /* tag "label" from line 62 */; ?>
<label class="control-label">Điện thoại 1</label>
										<?php /* tag "div" from line 63 */; ?>
<div class="controls">
											<?php 
/* tag "input" from line 64 */ ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->ConfigPhone1, 'getValue')))):  ;
$_tmp_1 = ' value="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->ConfigPhone1, 'getId')))):  ;
$_tmp_2 = ' data-id="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<input id="Phone12" type="text" class="form-control input-small"<?php echo $_tmp_1 ?>
<?php echo $_tmp_2 ?>
/>
										</div>
									</div>
									<?php /* tag "div" from line 67 */; ?>
<div class="form-group">
										<?php /* tag "label" from line 68 */; ?>
<label class="control-label">Điện thoại 2</label>
										<?php /* tag "div" from line 69 */; ?>
<div class="controls">
											<?php 
/* tag "input" from line 70 */ ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->ConfigPhone2, 'getValue')))):  ;
$_tmp_1 = ' value="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->ConfigPhone2, 'getId')))):  ;
$_tmp_2 = ' data-id="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<input id="Phone22" type="text" class="form-control input-small"<?php echo $_tmp_1 ?>
<?php echo $_tmp_2 ?>
/>
										</div>
									</div>
									<?php /* tag "div" from line 73 */; ?>
<div class="form-group">
										<?php /* tag "label" from line 74 */; ?>
<label class="control-label">Số dòng trên trang</label>
										<?php /* tag "div" from line 75 */; ?>
<div class="controls">
											<?php 
/* tag "input" from line 76 */ ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->ConfigRowPerPage, 'getValue')))):  ;
$_tmp_1 = ' value="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->ConfigRowPerPage, 'getId')))):  ;
$_tmp_2 = ' data-id="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<input id="RowPerPage2" type="text" class="form-control input-small"<?php echo $_tmp_1 ?>
<?php echo $_tmp_2 ?>
/>
										</div>
									</div>
									<?php /* tag "div" from line 79 */; ?>
<div class="form-group">
										<?php /* tag "label" from line 80 */; ?>
<label class="control-label">Số lượt truy cập</label>
										<?php /* tag "div" from line 81 */; ?>
<div class="controls">
											<?php 
/* tag "input" from line 82 */ ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->ConfigGuestVisit, 'getValue')))):  ;
$_tmp_1 = ' value="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->ConfigGuestVisit, 'getId')))):  ;
$_tmp_2 = ' data-id="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<input id="GuestVisit2" type="text" class="form-control input-small"<?php echo $_tmp_1 ?>
<?php echo $_tmp_2 ?>
/>
										</div>
									</div>									
									<?php /* tag "div" from line 85 */; ?>
<div class="form-group">
										<?php /* tag "label" from line 86 */; ?>
<label class="control-label">Giả lặp phiếu 2 liên</label>
										<?php /* tag "div" from line 87 */; ?>
<div class="controls">											
											<?php 
/* tag "select" from line 88 */ ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->ConfigReceiptVirtualDouble, 'getId')))):  ;
$_tmp_1 = ' data-id="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<select name="ReceiptVirtualDouble2" id="ReceiptVirtualDouble2" style="width:80%;"<?php echo $_tmp_1 ?>
>
												<?php 
/* tag "option" from line 89 */ ;
if ($ctx->ConfigReceiptVirtualDouble->getValue()=='0'?'selected':''):  ;
$_tmp_2 = ' selected="selected"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<option value="0"<?php echo $_tmp_2 ?>
>Tắt</option>
												<?php 
/* tag "option" from line 90 */ ;
if ($ctx->ConfigReceiptVirtualDouble->getValue()=='1'?'selected':''):  ;
$_tmp_2 = ' selected="selected"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<option value="1"<?php echo $_tmp_2 ?>
>Bật</option>
											</select>
										</div>
									</div>
									<?php /* tag "div" from line 94 */; ?>
<div class="form-group">
										<?php /* tag "label" from line 95 */; ?>
<label class="control-label">Thời gian lưu Log</label>
										<?php /* tag "div" from line 96 */; ?>
<div class="controls">											
											<?php 
/* tag "select" from line 97 */ ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->ConfignMonthLog, 'getId')))):  ;
$_tmp_2 = ' data-id="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<select name="nMonthLog2" id="nMonthLog2" style="width:80%;"<?php echo $_tmp_2 ?>
>
												<?php 
/* tag "option" from line 98 */ ;
if ($ctx->ConfigReceiptVirtualDouble->getValue()=='1'?'selected':''):  ;
$_tmp_1 = ' selected="selected"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<option value="1"<?php echo $_tmp_1 ?>
>1 tháng</option>
												<?php 
/* tag "option" from line 99 */ ;
if ($ctx->ConfigReceiptVirtualDouble->getValue()=='2'?'selected':''):  ;
$_tmp_1 = ' selected="selected"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<option value="2"<?php echo $_tmp_1 ?>
>2 tháng</option>
												<?php 
/* tag "option" from line 100 */ ;
if ($ctx->ConfigReceiptVirtualDouble->getValue()=='3'?'selected':''):  ;
$_tmp_1 = ' selected="selected"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<option value="3"<?php echo $_tmp_1 ?>
>3 tháng</option>
											</select>
										</div>
									</div>
									<?php /* tag "div" from line 104 */; ?>
<div class="form-group">
										<?php /* tag "label" from line 105 */; ?>
<label class="control-label">Trang chủ - Presentation</label>
										<?php /* tag "div" from line 106 */; ?>
<div class="controls">											
											<?php 
/* tag "select" from line 107 */ ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->ConfigPHome, 'getId')))):  ;
$_tmp_1 = ' data-id="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<select name="ConfigPHome2" id="ConfigPHome2" style="width:80%;"<?php echo $_tmp_1 ?>
>
												<?php 
/* tag "option" from line 108 */ ;
$_tmp_2 = $ctx->repeat ;
$_tmp_2->Presentation = new PHPTAL_RepeatController($ctx->PresentationAll)
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_2->Presentation as $ctx->Presentation): ;
if (null !== ($_tmp_3 = ($ctx->path($ctx->Presentation, 'getId')))):  ;
$_tmp_3 = ' value="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
if ($ctx->ConfigPHome->getValue()==$ctx->Presentation->getId()?'selected':''):  ;
$_tmp_4 = ' selected="selected"' ;
else:  ;
$_tmp_4 = '' ;
endif ;
?>
<option<?php echo $_tmp_3 ?>
<?php echo $_tmp_4 ?>
>
													<?php /* tag "span" from line 109 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Presentation, 'getName')); ?>
</span>
												</option><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>
												
											</select>
										</div>
									</div>
									<?php /* tag "div" from line 114 */; ?>
<div class="form-group">
										<?php /* tag "label" from line 115 */; ?>
<label class="control-label">Trang giới thiệu - Post</label>
										<?php /* tag "div" from line 116 */; ?>
<div class="controls">											
											<?php 
/* tag "select" from line 117 */ ;
if (null !== ($_tmp_3 = ($ctx->path($ctx->ConfigIntroduction, 'getId')))):  ;
$_tmp_3 = ' data-id="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<select name="ConfigIntroduction2" id="ConfigIntroduction2" style="width:80%;"<?php echo $_tmp_3 ?>
>
												<?php 
/* tag "option" from line 118 */ ;
$_tmp_4 = $ctx->repeat ;
$_tmp_4->PT = new PHPTAL_RepeatController($ctx->path($ctx->Tag, 'getPostAll'))
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_4->PT as $ctx->PT): ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->PT, 'getPost/getId')))):  ;
$_tmp_2 = ' value="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
if ($ctx->ConfigIntroduction->getValue()==$ctx->PT->getPost()->getId()?'selected':''):  ;
$_tmp_1 = ' selected="selected"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<option<?php echo $_tmp_2 ?>
<?php echo $_tmp_1 ?>
>
													<?php /* tag "span" from line 119 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->PT, 'getPost/getTitle')); ?>
</span>
												</option><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

											</select>
										</div>
									</div>
									<?php /* tag "div" from line 124 */; ?>
<div class="form-group">
										<?php /* tag "label" from line 125 */; ?>
<label class="control-label">Trang FAQ</label>
										<?php /* tag "div" from line 126 */; ?>
<div class="controls">											
											<?php 
/* tag "select" from line 127 */ ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->ConfigFAQ, 'getId')))):  ;
$_tmp_2 = ' data-id="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<select name="ConfigFAQ2" id="ConfigFAQ2" style="width:80%;"<?php echo $_tmp_2 ?>
>
												<?php 
/* tag "option" from line 128 */ ;
$_tmp_1 = $ctx->repeat ;
$_tmp_1->PT = new PHPTAL_RepeatController($ctx->path($ctx->Tag, 'getPostAll'))
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_1->PT as $ctx->PT): ;
if (null !== ($_tmp_4 = ($ctx->path($ctx->PT, 'getPost/getId')))):  ;
$_tmp_4 = ' value="'.phptal_escape($_tmp_4).'"' ;
else:  ;
$_tmp_4 = '' ;
endif ;
if ($ctx->ConfigFAQ->getValue()==$ctx->PT->getPost()->getId()?'selected':''):  ;
$_tmp_3 = ' selected="selected"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<option<?php echo $_tmp_4 ?>
<?php echo $_tmp_3 ?>
>
													<?php /* tag "span" from line 129 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->PT, 'getPost/getTitle')); ?>
</span>
												</option><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

											</select>
										</div>
									</div>
									<?php /* tag "div" from line 134 */; ?>
<div class="form-group">
										<?php /* tag "label" from line 135 */; ?>
<label class="control-label">Trang Điều khoản</label>
										<?php /* tag "div" from line 136 */; ?>
<div class="controls">											
											<?php 
/* tag "select" from line 137 */ ;
if (null !== ($_tmp_4 = ($ctx->path($ctx->ConfigPolicy, 'getId')))):  ;
$_tmp_4 = ' data-id="'.phptal_escape($_tmp_4).'"' ;
else:  ;
$_tmp_4 = '' ;
endif ;
?>
<select name="ConfigPolicy2" id="ConfigPolicy2" style="width:80%;"<?php echo $_tmp_4 ?>
>
												<?php 
/* tag "option" from line 138 */ ;
$_tmp_3 = $ctx->repeat ;
$_tmp_3->PT = new PHPTAL_RepeatController($ctx->path($ctx->Tag, 'getPostAll'))
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_3->PT as $ctx->PT): ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->PT, 'getPost/getId')))):  ;
$_tmp_1 = ' value="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
if ($ctx->ConfigPolicy->getValue()==$ctx->PT->getPost()->getId()?'selected':''):  ;
$_tmp_2 = ' selected="selected"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<option<?php echo $_tmp_1 ?>
<?php echo $_tmp_2 ?>
>
													<?php /* tag "span" from line 139 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->PT, 'getPost/getTitle')); ?>
</span>
												</option><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

											</select>
										</div>
									</div>
								</div>
								<?php /* tag "div" from line 145 */; ?>
<div class="modal-footer">
									<?php /* tag "button" from line 146 */; ?>
<button id="URLUpdButton" class="btn btn-primary btn-small" type="submit"><?php /* tag "i" from line 146 */; ?>
<i class="glyphicons-download_alt"></i> Lưu</button>
								</div>
							</div>
						</div>
					</div>					
				</div>
			</div>
		</div>
		<?php 
/* tag "div" from line 154 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/Footer', $_thistpl) ;
$ctx->popSlots() ;
?>

		<?php 
/* tag "div" from line 155 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/IncludeJS', $_thistpl) ;
$ctx->popSlots() ;
?>

		<?php /* tag "script" from line 156 */; ?>
<script type="text/javascript">
		/*<![CDATA[*/									
			//-----------------------------------------------------------------------------------
			//Update 1 UNIT
			//-----------------------------------------------------------------------------------															
			$('#URLUpdButton').click(function(){
				var Data1 = [];
				var Data2 = [];
				var Data3 = [];
				var Data4 = [];
				var Data5 = [];
				var Data6 = [];
				var Data7 = [];
				var Data8 = [];
				var Data9 = [];
				var Data10 = [];
				var Data11 = [];
				var Data12 = [];
				var Data13 = [];
				var Data14 = [];
				var Data15 = [];
				var Data16 = [];
				
				Data1[0] = $('#RowPerPage2').attr('data-id');
				Data1[1] = "ROW_PER_PAGE";
				Data1[2] = $('#RowPerPage2').val();
				
				var URL = "/object/upd/Config";
				$.ajax({
					type: "POST",
					data: {Data:Data1},
					url: URL,
					success: function(msg){}
				});
				
				Data2[0] = $('#GuestVisit2').attr('data-id');
				Data2[1] = "GUEST_VISIT";
				Data2[2] = $('#GuestVisit2').val();			
				$.ajax({
					type: "POST",
					data: {Data:Data2},
					url: URL,
					success: function(msg){}
				});
								
				//Cập nhật bật/tắt in 2 liên
				Data3[0] = $('#ReceiptVirtualDouble2').attr('data-id');
				Data3[1] = "RECEIPT_VIRTUAL_DOUBLE";
				Data3[2] = $('#ReceiptVirtualDouble2').val();				
				$.ajax({
					type: "POST",
					data: {Data:Data3},
					url: URL,
					success: function(msg){}
				});
				
				//Cập nhật tên quán
				Data4[0] = $('#Name2').attr('data-id');
				Data4[1] = "NAME";
				Data4[2] = $('#Name2').val();
				$.ajax({
					type: "POST",
					data: {Data:Data4},
					url: URL,
					success: function(msg){}
				});
				
				//Cập nhật địa chỉ
				Data5[0] = $('#Address2').attr('data-id');
				Data5[1] = "ADDRESS";
				Data5[2] = $('#Address2').val();
				$.ajax({
					type: "POST",
					data: {Data:Data5},
					url: URL,
					success: function(msg){}
				});
				
				//Cập nhật điện thoại
				Data6[0] = $('#Phone12').attr('data-id');
				Data6[1] = "PHONE1";
				Data6[2] = $('#Phone12').val();
				$.ajax({
					type: "POST",
					data: {Data:Data6},
					url: URL,
					success: function(msg){}
				});
				
				//Cập nhật KHẨU HIỆU
				Data7[0] = $('#Slogan2').attr('data-id');
				Data7[1] = "SLOGAN";
				Data7[2] = $('#Slogan2').val();
				$.ajax({
					type: "POST",
					data: {Data:Data7},
					url: URL,
					success: function(msg){}
				});
				
				//Cập nhật Bài viết giới thiệu
				Data8[0] = $('#ConfigIntroduction2').attr('data-id');
				Data8[1] = "POST_INTRODUCTION";
				Data8[2] = $('#ConfigIntroduction2').val();
				$.ajax({
					type: "POST",
					data: {Data:Data8},
					url: URL,
					success: function(msg){}
				});
				
				//Cập nhật Bài 
				Data9[0] = $('#ConfigFAQ2').attr('data-id');
				Data9[1] = "POST_FAQ";
				Data9[2] = $('#ConfigFAQ2').val();
				$.ajax({
					type: "POST",
					data: {Data:Data9},
					url: URL,
					success: function(msg){}
				});
				
				//Cập nhật Bài 
				Data10[0] = $('#ConfigPolicy2').attr('data-id');
				Data10[1] = "POST_POLICY";
				Data10[2] = $('#ConfigPolicy2').val();
				$.ajax({
					type: "POST",
					data: {Data:Data10},
					url: URL,
					success: function(msg){}
				});
				
				//Cập nhật Trình bày
				Data11[0] = $('#ConfigPHome2').attr('data-id');
				Data11[1] = "PRESENTATION_HOME";
				Data11[2] = $('#ConfigPHome2').val();				
				$.ajax({
					type: "POST",
					data: {Data:Data11},
					url: URL,
					success: function(msg){}
				});
				
				//Cập nhật tên người liên hệ
				Data12[0] = $('#Contact2').attr('data-id');
				Data12[1] = "CONTACT_NAME";
				Data12[2] = $('#Contact2').val();
				$.ajax({
					type: "POST",
					data: {Data:Data12},
					url: URL,
					success: function(msg){}
				});
				
				//Cập nhật nick Yahoo Messenger
				Data13[0] = $('#YahooMessenger2').attr('data-id');
				Data13[1] = "CONTACT_YAHOOMESSENGER";
				Data13[2] = $('#YahooMessenger2').val();
				$.ajax({
					type: "POST",
					data: {Data:Data13},
					url: URL,
					success: function(msg){}
				});
				
				//Cập nhật nick Skype
				Data14[0] = $('#Skype2').attr('data-id');
				Data14[1] = "CONTACT_SKYPE";
				Data14[2] = $('#Skype2').val();
				$.ajax({
					type: "POST",
					data: {Data:Data14},
					url: URL,
					success: function(msg){}
				});
				
				//Cập nhật nick GTalk
				Data15[0] = $('#GTalk2').attr('data-id');
				Data15[1] = "CONTACT_GTALK";
				Data15[2] = $('#GTalk2').val();
				$.ajax({
					type: "POST",
					data: {Data:Data15},
					url: URL,
					success: function(msg){}
				});
				
				//Cập nhật điện thoại
				Data16[0] = $('#Phone22').attr('data-id');
				Data16[1] = "PHONE2";
				Data16[2] = $('#Phone22').val();
				$.ajax({
					type: "POST",
					data: {Data:Data16},
					url: URL,
					success: function(msg){}
				});
				
				//hiển thị thông báo
				$.gritter.add({
					title		:'Thông báo',
					class_name	:'gritter-green',
					text		:'Đã cập nhật xong',
					time		:5000,
					sticky		: false
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

Generated by PHPTAL from G:\AppsWeb\cmsA\www.huongsenhong.com\mvc\templates\ASettingConfig.html (edit that file instead) */; ?>