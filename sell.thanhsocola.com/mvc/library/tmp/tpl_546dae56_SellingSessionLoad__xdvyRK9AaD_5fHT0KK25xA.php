<?php 
function tpl_546dae56_SellingSessionLoad__xdvyRK9AaD_5fHT0KK25xA(PHPTAL $tpl, PHPTAL_Context $ctx) {
$_thistpl = $tpl ;
$_translator = $tpl->getTranslator() ;
/* tag "documentElement" from line 1 */ ;
$ctx->setDocType('<!DOCTYPE html>',false) ;
?>

<?php /* tag "html" from line 2 */; ?>
<html lang="en">	
	<?php /* tag "body" from line 3 */; ?>
<body>				
		<?php 
/* tag "div" from line 4 */ ;
if ($ctx->Session->getStatus()==0?true:false):  ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->Session, 'getId')))):  ;
$_tmp_1 = ' alt="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<div id="Session" class="widget-box"<?php echo $_tmp_1 ?>
>
			<?php /* tag "div" from line 5 */; ?>
<div class="widget-title">
				<?php /* tag "span" from line 6 */; ?>
<span class="icon"><?php /* tag "i" from line 6 */; ?>
<i class="glyphicon glyphicon-th-list"></i></span>
				<?php /* tag "div" from line 7 */; ?>
<div class="buttons">
					<?php 
/* tag "a" from line 8 */ ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->Session, 'getId')))):  ;
$_tmp_2 = ' data-session-id="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a title="Chỉnh sửa" class="btn SessionUpdate" data-toggle="modal" href="#DialogSession"<?php echo $_tmp_2 ?>
><?php /* tag "i" from line 8 */; ?>
<i class="glyphicons-edit"></i></a>
					<?php 
/* tag "a" from line 9 */ ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->Session, 'getURLPrint')))):  ;
$_tmp_2 = ' alt="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a title="In phiếu" class="Ticket btn"<?php echo $_tmp_2 ?>
><?php /* tag "i" from line 9 */; ?>
<i class="glyphicons-print"></i></a>
				</div>
			</div>
			<?php /* tag "div" from line 12 */; ?>
<div class="widget-content nopadding size-12">
				<?php /* tag "div" from line 13 */; ?>
<div class="invoice-content">
					<?php /* tag "div" from line 14 */; ?>
<div>						
						<?php /* tag "div" from line 15 */; ?>
<div class="invoice-to">
							<?php /* tag "ul" from line 16 */; ?>
<ul>
								<?php /* tag "li" from line 17 */; ?>
<li><?php /* tag "span" from line 17 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Session, 'getUser/getName')); ?>
</span></li>
								<?php /* tag "li" from line 18 */; ?>
<li><?php /* tag "span" from line 18 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Session, 'getStatusPrint')); ?>
</span></li>
							</ul>
						</div>
						<?php /* tag "div" from line 21 */; ?>
<div class="invoice-from">
							<?php /* tag "ul" from line 22 */; ?>
<ul>
								<?php /* tag "li" from line 23 */; ?>
<li><?php /* tag "span" from line 23 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Session, 'getDateTimePrint')); ?>
</span></li>
								<?php /* tag "li" from line 24 */; ?>
<li><?php /* tag "span" from line 24 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Session, 'getCustomer/getName')); ?>
</span></li>
							</ul>
						</div>
					</div>
					<?php /* tag "table" from line 28 */; ?>
<table class="table table-striped table-hover">
						<?php /* tag "thead" from line 29 */; ?>
<thead>
							<?php /* tag "tr" from line 30 */; ?>
<tr>										
								<?php /* tag "th" from line 31 */; ?>
<th width="30">STT</th>
								<?php /* tag "th" from line 32 */; ?>
<th><?php /* tag "div" from line 32 */; ?>
<div class="text-left">TÊN</div></th>
								<?php /* tag "th" from line 33 */; ?>
<th width="30">SL</th>
								<?php /* tag "th" from line 34 */; ?>
<th width="80"><?php /* tag "div" from line 34 */; ?>
<div class="text-right">Đ.GIÁ</div></th>
								<?php /* tag "th" from line 35 */; ?>
<th width="80"><?php /* tag "div" from line 35 */; ?>
<div class="text-right">T.TIỀN</div></th>									
								<?php /* tag "th" from line 36 */; ?>
<th width="30"><?php /* tag "i" from line 36 */; ?>
<i class="glyphicons-bin"></i></th>									
							</tr>
						</thead>
						<?php /* tag "tbody" from line 39 */; ?>
<tbody>
							<?php 
/* tag "tr" from line 40 */ ;
$_tmp_2 = $ctx->repeat ;
$_tmp_2->Detail = new PHPTAL_RepeatController($ctx->path($ctx->Session, 'getDetails1'))
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_2->Detail as $ctx->Detail): ;
?>
<tr>
								<?php /* tag "td" from line 41 */; ?>
<td><?php /* tag "div" from line 41 */; ?>
<div class="text-center"><?php echo phptal_escape($ctx->path($ctx->repeat, 'Detail/number')); ?>
</div></td>
								<?php /* tag "td" from line 42 */; ?>
<td><?php 
/* tag "a" from line 49 */ ;
if (null !== ($_tmp_3 = ($ctx->path($ctx->Detail, 'getId')))):  ;
$_tmp_3 = ' id="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
if (null !== ($_tmp_4 = ($ctx->path($ctx->Detail, 'getIdCourse')))):  ;
$_tmp_4 = ' idcourse="'.phptal_escape($_tmp_4).'"' ;
else:  ;
$_tmp_4 = '' ;
endif ;
if (null !== ($_tmp_5 = ($ctx->path($ctx->Detail, 'getCourse/getName')))):  ;
$_tmp_5 = ' name="'.phptal_escape($_tmp_5).'"' ;
else:  ;
$_tmp_5 = '' ;
endif ;
if (null !== ($_tmp_6 = ($ctx->path($ctx->Detail, 'getCount')))):  ;
$_tmp_6 = ' count="'.phptal_escape($_tmp_6).'"' ;
else:  ;
$_tmp_6 = '' ;
endif ;
if (null !== ($_tmp_7 = ($ctx->path($ctx->Detail, 'getPrice')))):  ;
$_tmp_7 = ' price="'.phptal_escape($_tmp_7).'"' ;
else:  ;
$_tmp_7 = '' ;
endif ;
?>
<a class="update-item" href="#DialogEdit" data-toggle="modal"<?php echo $_tmp_3 ?>
<?php echo $_tmp_4 ?>
<?php echo $_tmp_5 ?>
<?php echo $_tmp_6 ?>
<?php echo $_tmp_7 ?>
><?php echo phptal_escape($ctx->path($ctx->Detail, 'getCourse/getName')); ?>
</a>
								</td>
								<?php /* tag "td" from line 51 */; ?>
<td><?php /* tag "div" from line 51 */; ?>
<div class="text-center"><?php echo phptal_escape($ctx->path($ctx->Detail, 'getCountPrint')); ?>
</div></td>
								<?php /* tag "td" from line 52 */; ?>
<td><?php /* tag "div" from line 52 */; ?>
<div class="text-right"><?php echo phptal_escape($ctx->path($ctx->Detail, 'getPricePrint')); ?>
</div></td>
								<?php /* tag "td" from line 53 */; ?>
<td><?php /* tag "div" from line 53 */; ?>
<div class="text-right"><?php echo phptal_escape($ctx->path($ctx->Detail, 'getValuePrint')); ?>
</div></td>									
								<?php /* tag "td" from line 54 */; ?>
<td class="center"><?php 
/* tag "a" from line 54 */ ;
if (null !== ($_tmp_3 = ($ctx->path($ctx->Detail, 'getId')))):  ;
$_tmp_3 = ' data-id="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<a class="remove-item" href="#DialogDel" data-toggle="modal"<?php echo $_tmp_3 ?>
><?php /* tag "i" from line 54 */; ?>
<i class="glyphicons-remove_2"></i></a></td>
							</tr><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

						</tbody>
					</table>
					<?php /* tag "table" from line 58 */; ?>
<table width="100%">
						<?php /* tag "tr" from line 59 */; ?>
<tr><?php /* tag "td" from line 59 */; ?>
<td><?php echo phptal_escape($ctx->path($ctx->Session, 'getNote')); ?>
</td></tr>
						<?php /* tag "tr" from line 60 */; ?>
<tr>
							<?php /* tag "td" from line 61 */; ?>
<td style="text-align:right;">GIẢM GIÁ %:</td>
							<?php /* tag "td" from line 62 */; ?>
<td style="color:#5476A6;text-align:right;"><?php echo phptal_escape($ctx->path($ctx->Session, 'getDiscountPercent')); ?>
</td>
							<?php /* tag "th" from line 63 */; ?>
<th width="36"></th>
						</tr>
						<?php /* tag "tr" from line 65 */; ?>
<tr>
							<?php /* tag "td" from line 66 */; ?>
<td style="text-align:right;">GIẢM GIÁ $:</td>
							<?php /* tag "td" from line 67 */; ?>
<td style="color:#5476A6;text-align:right;"><?php echo phptal_escape($ctx->path($ctx->Session, 'getDiscountValuePrint')); ?>
</td>
							<?php /* tag "th" from line 68 */; ?>
<th width="36"></th>
						</tr>
						<?php /* tag "tr" from line 70 */; ?>
<tr>
							<?php /* tag "td" from line 71 */; ?>
<td style="text-align:right;">TỔNG CỘNG:</td>
							<?php /* tag "td" from line 72 */; ?>
<td style="color:#5476A6;text-align:right;"><?php echo phptal_escape($ctx->path($ctx->Session, 'getValuePrint')); ?>
</td>
							<?php /* tag "th" from line 73 */; ?>
<th width="36"></th>
						</tr>
					</table>
				</div>
			</div>
		</div><?php endif; ?>

		
		<?php 
/* tag "div" from line 80 */ ;
if ($ctx->Session->getStatus()!=0?true:false):  ;
if (null !== ($_tmp_4 = ($ctx->path($ctx->Session, 'getId')))):  ;
$_tmp_4 = ' alt="'.phptal_escape($_tmp_4).'"' ;
else:  ;
$_tmp_4 = '' ;
endif ;
?>
<div id="Session" class="widget-box"<?php echo $_tmp_4 ?>
>
			<?php /* tag "div" from line 81 */; ?>
<div class="widget-title">
				<?php /* tag "span" from line 82 */; ?>
<span class="icon"><?php /* tag "i" from line 82 */; ?>
<i class="glyphicon glyphicon-th-list"></i></span>
				<?php /* tag "div" from line 83 */; ?>
<div class="buttons">					
					<?php 
/* tag "a" from line 84 */ ;
if (null !== ($_tmp_5 = ($ctx->path($ctx->Session, 'getURLPrint')))):  ;
$_tmp_5 = ' alt="'.phptal_escape($_tmp_5).'"' ;
else:  ;
$_tmp_5 = '' ;
endif ;
?>
<a title="In phiếu" class="Ticket btn"<?php echo $_tmp_5 ?>
><?php /* tag "i" from line 84 */; ?>
<i class="glyphicons-print"></i></a>
				</div>
			</div>
			<?php /* tag "div" from line 87 */; ?>
<div class="widget-content nopadding size-12">
				<?php /* tag "div" from line 88 */; ?>
<div class="invoice-content">
					<?php /* tag "div" from line 89 */; ?>
<div>						
						<?php /* tag "div" from line 90 */; ?>
<div class="invoice-to">
							<?php /* tag "ul" from line 91 */; ?>
<ul>
								<?php /* tag "li" from line 92 */; ?>
<li><?php /* tag "span" from line 92 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Session, 'getUser/getName')); ?>
</span></li>
								<?php /* tag "li" from line 93 */; ?>
<li><?php /* tag "span" from line 93 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Session, 'getStatusPrint')); ?>
</span></li>
							</ul>
						</div>
						<?php /* tag "div" from line 96 */; ?>
<div class="invoice-from">
							<?php /* tag "ul" from line 97 */; ?>
<ul>
								<?php /* tag "li" from line 98 */; ?>
<li><?php /* tag "span" from line 98 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Session, 'getDateTimePrint')); ?>
</span></li>
								<?php /* tag "li" from line 99 */; ?>
<li><?php /* tag "span" from line 99 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Session, 'getCustomer/getName')); ?>
</span></li>
							</ul>
						</div>
					</div>
					<?php /* tag "table" from line 103 */; ?>
<table class="table table-striped table-hover">
						<?php /* tag "thead" from line 104 */; ?>
<thead>
							<?php /* tag "tr" from line 105 */; ?>
<tr>										
								<?php /* tag "th" from line 106 */; ?>
<th width="30">STT</th>
								<?php /* tag "th" from line 107 */; ?>
<th><?php /* tag "div" from line 107 */; ?>
<div class="text-left">TÊN</div></th>
								<?php /* tag "th" from line 108 */; ?>
<th width="30">SL</th>
								<?php /* tag "th" from line 109 */; ?>
<th width="80"><?php /* tag "div" from line 109 */; ?>
<div class="text-right">Đ.GIÁ</div></th>
								<?php /* tag "th" from line 110 */; ?>
<th width="80"><?php /* tag "div" from line 110 */; ?>
<div class="text-right">T.TIỀN</div></th>																	
							</tr>
						</thead>
						<?php /* tag "tbody" from line 113 */; ?>
<tbody>
							<?php 
/* tag "tr" from line 114 */ ;
$_tmp_6 = $ctx->repeat ;
$_tmp_6->Detail = new PHPTAL_RepeatController($ctx->path($ctx->Session, 'getDetails1'))
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_6->Detail as $ctx->Detail): ;
?>
<tr>
								<?php /* tag "td" from line 115 */; ?>
<td><?php /* tag "div" from line 115 */; ?>
<div class="text-center"><?php echo phptal_escape($ctx->path($ctx->repeat, 'Detail/number')); ?>
</div></td>
								<?php /* tag "td" from line 116 */; ?>
<td><?php /* tag "span" from line 116 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Detail, 'getCourse/getName')); ?>
</span></td>
								<?php /* tag "td" from line 117 */; ?>
<td><?php /* tag "div" from line 117 */; ?>
<div class="text-center"><?php echo phptal_escape($ctx->path($ctx->Detail, 'getCountPrint')); ?>
</div></td>
								<?php /* tag "td" from line 118 */; ?>
<td><?php /* tag "div" from line 118 */; ?>
<div class="text-right"><?php echo phptal_escape($ctx->path($ctx->Detail, 'getPricePrint')); ?>
</div></td>
								<?php /* tag "td" from line 119 */; ?>
<td><?php /* tag "div" from line 119 */; ?>
<div class="text-right"><?php echo phptal_escape($ctx->path($ctx->Detail, 'getValuePrint')); ?>
</div></td>																	
							</tr><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

						</tbody>
					</table>
					<?php /* tag "table" from line 123 */; ?>
<table width="100%">
						<?php /* tag "tr" from line 124 */; ?>
<tr><?php /* tag "td" from line 124 */; ?>
<td><?php echo phptal_escape($ctx->path($ctx->Session, 'getNote')); ?>
</td></tr>
						<?php /* tag "tr" from line 125 */; ?>
<tr>
							<?php /* tag "td" from line 126 */; ?>
<td style="text-align:right;">GIẢM GIÁ %:</td>
							<?php /* tag "td" from line 127 */; ?>
<td style="color:#5476A6;text-align:right;"><?php echo phptal_escape($ctx->path($ctx->Session, 'getDiscountPercent')); ?>
</td>							
						</tr>
						<?php /* tag "tr" from line 129 */; ?>
<tr>
							<?php /* tag "td" from line 130 */; ?>
<td style="text-align:right;">GIẢM GIÁ $:</td>
							<?php /* tag "td" from line 131 */; ?>
<td style="color:#5476A6;text-align:right;"><?php echo phptal_escape($ctx->path($ctx->Session, 'getDiscountValuePrint')); ?>
</td>							
						</tr>
						<?php /* tag "tr" from line 133 */; ?>
<tr>
							<?php /* tag "td" from line 134 */; ?>
<td style="text-align:right;">TỔNG CỘNG:</td>
							<?php /* tag "td" from line 135 */; ?>
<td style="color:#5476A6;text-align:right;"><?php echo phptal_escape($ctx->path($ctx->Session, 'getValuePrint')); ?>
</td>							
						</tr>
					</table>
				</div>
			</div>
		</div><?php endif; ?>

		
		<!-- DIALOG EDIT	-->
		<?php /* tag "div" from line 143 */; ?>
<div id="DialogEdit" class="modal fade">
			<?php /* tag "div" from line 144 */; ?>
<div class="modal-dialog">
				<?php /* tag "div" from line 145 */; ?>
<div class="modal-content">
					<?php /* tag "div" from line 146 */; ?>
<div class="modal-header">
						<?php /* tag "h3" from line 147 */; ?>
<h3><?php /* tag "i" from line 147 */; ?>
<i class="glyphicons-fast_food modal-icon"></i>CẬP NHẬT SẢN PHẨM</h3>
					</div>								
					<?php /* tag "form" from line 149 */; ?>
<form id="FormSDUpdate" action="#" class="form-horizontal" novalidate="novalidate">
						<?php /* tag "div" from line 150 */; ?>
<div class="form-group">
							<?php /* tag "label" from line 151 */; ?>
<label class="control-label">Id</label>
							<?php /* tag "div" from line 152 */; ?>
<div class="controls"><?php /* tag "input" from line 152 */; ?>
<input readonly="readonly" id="IdCourse1" name="IdCourse1" type="text" class="form-control input-small"/></div>
						</div>
						<?php /* tag "div" from line 154 */; ?>
<div class="form-group">
							<?php /* tag "label" from line 155 */; ?>
<label class="control-label">Tên</label>
							<?php /* tag "div" from line 156 */; ?>
<div class="controls"><?php /* tag "input" from line 156 */; ?>
<input readonly="readonly" id="Name1" name="Name1" type="text" class="form-control input-small"/></div>
						</div>
						<?php /* tag "div" from line 158 */; ?>
<div class="form-group">
							<?php /* tag "label" from line 159 */; ?>
<label class="control-label">Số lượng</label>
							<?php /* tag "div" from line 160 */; ?>
<div class="controls"><?php /* tag "input" from line 160 */; ?>
<input id="Count1" name="Count1" type="text" class="form-control input-small"/></div>
						</div>
						<?php /* tag "div" from line 162 */; ?>
<div class="form-group">
							<?php /* tag "label" from line 163 */; ?>
<label class="control-label">Đơn giá</label>
							<?php /* tag "div" from line 164 */; ?>
<div class="controls"><?php /* tag "input" from line 164 */; ?>
<input id="Price1" name="Price1" type="text" class="form-control input-small"/></div>
						</div>									
						<?php /* tag "div" from line 166 */; ?>
<div class="form-actions">										
							<?php /* tag "button" from line 167 */; ?>
<button id="URLUpdButton" class="btn btn-primary btn-small" type="submit" value="Validate"><?php /* tag "i" from line 167 */; ?>
<i class="glyphicons-download_alt"></i> Lưu</button>
							<?php /* tag "button" from line 168 */; ?>
<button data-dismiss="modal" class="btn btn-default btn-small"><?php /* tag "i" from line 168 */; ?>
<i class="glyphicons-undo"></i> Hủy</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- END DIALOG EDIT -->
																					
		<!-- DIALOG SESSION EDIT	-->
		<?php /* tag "div" from line 177 */; ?>
<div id="DialogSession" class="modal fade">
			<?php /* tag "div" from line 178 */; ?>
<div class="modal-dialog">
				<?php /* tag "div" from line 179 */; ?>
<div class="modal-content">
					<?php /* tag "div" from line 180 */; ?>
<div class="modal-header"><?php /* tag "h3" from line 180 */; ?>
<h3><?php /* tag "i" from line 180 */; ?>
<i class="glyphicons-edit modal-icon"></i>CẬP NHẬT GIAO DỊCH</h3></div>
					<?php /* tag "div" from line 181 */; ?>
<div class="form-horizontal">
						<?php /* tag "div" from line 182 */; ?>
<div class="form-group">
							<?php /* tag "label" from line 183 */; ?>
<label class="control-label">Bắt đầu</label>
							<?php /* tag "div" from line 184 */; ?>
<div class="controls">
								<?php /* tag "input" from line 185 */; ?>
<input id="DateTime1" name="DateTime1" type="text" class="form-control input-small" data-date-format="yyyy-mm-dd hh:ii"/>
							</div>
						</div>
						<?php /* tag "div" from line 188 */; ?>
<div class="form-group">
							<?php /* tag "label" from line 189 */; ?>
<label class="control-label">Kết thúc</label>
							<?php /* tag "div" from line 190 */; ?>
<div class="controls">
								<?php /* tag "input" from line 191 */; ?>
<input id="DateTimeEnd1" name="DateTimeEnd1" type="text" class="form-control input-small" data-date-format="yyyy-mm-dd hh:ii"/>
							</div>
						</div>
						<?php /* tag "div" from line 194 */; ?>
<div class="form-group">
							<?php /* tag "label" from line 195 */; ?>
<label class="control-label">Nhân viên</label>
							<?php /* tag "div" from line 196 */; ?>
<div class="controls">
								<?php /* tag "select" from line 197 */; ?>
<select name="IdEmployee1" id="IdEmployee1" style="width:80%;" class="form-control">
									<?php 
/* tag "option" from line 198 */ ;
$_tmp_7 = $ctx->repeat ;
$_tmp_7->Employee = new PHPTAL_RepeatController($ctx->EmployeeAll)
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_7->Employee as $ctx->Employee): ;
if (null !== ($_tmp_3 = ($ctx->path($ctx->Employee, 'getId')))):  ;
$_tmp_3 = ' value="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
if ($ctx->Session->getIdEmployee()==$ctx->Employee->getId()?true:false):  ;
$_tmp_2 = ' selected="selected"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<option<?php echo $_tmp_3 ?>
<?php echo $_tmp_2 ?>
>
										<?php /* tag "span" from line 199 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Employee, 'getName')); ?>
</span>
									</option><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

								</select>
							</div>
						</div>
						<?php /* tag "div" from line 204 */; ?>
<div class="form-group">
							<?php /* tag "label" from line 205 */; ?>
<label class="control-label">Tính tiền</label>
							<?php /* tag "div" from line 206 */; ?>
<div class="controls">
								<?php /* tag "select" from line 207 */; ?>
<select name="Status1" id="Status1" style="width:80%;" class="form-control">
									<?php 
/* tag "option" from line 208 */ ;
if ($ctx->Session->getStatus()==0?'true':false):  ;
$_tmp_1 = ' selected="selected"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<option value="0"<?php echo $_tmp_1 ?>
>Đặt hàng</option>
									<?php 
/* tag "option" from line 209 */ ;
if ($ctx->Session->getStatus()==1?'true':false):  ;
$_tmp_5 = ' selected="selected"' ;
else:  ;
$_tmp_5 = '' ;
endif ;
?>
<option value="1"<?php echo $_tmp_5 ?>
>Thanh toán đủ</option>
									<?php 
/* tag "option" from line 210 */ ;
if ($ctx->Session->getStatus()==2?'true':false):  ;
$_tmp_6 = ' selected="selected"' ;
else:  ;
$_tmp_6 = '' ;
endif ;
?>
<option value="2"<?php echo $_tmp_6 ?>
>Nợ phiếu</option>
								</select>
							</div>
						</div>									
						<?php /* tag "div" from line 214 */; ?>
<div class="form-group">
							<?php /* tag "label" from line 215 */; ?>
<label class="control-label">Giảm giá %</label>
							<?php /* tag "div" from line 216 */; ?>
<div class="controls">
								<?php /* tag "input" from line 217 */; ?>
<input id="DiscountPercent1" name="DiscountPercent1" type="text" class="form-control input-small"/>
							</div>
						</div>
						<?php /* tag "div" from line 220 */; ?>
<div class="form-group">
							<?php /* tag "label" from line 221 */; ?>
<label class="control-label">Giảm giá tiền</label>
							<?php /* tag "div" from line 222 */; ?>
<div class="controls">
								<?php /* tag "input" from line 223 */; ?>
<input id="DiscountValue1" name="DiscountValue1" type="text" class="form-control input-small"/>
							</div>
						</div>
						<?php /* tag "div" from line 226 */; ?>
<div class="form-group">
							<?php /* tag "label" from line 227 */; ?>
<label class="control-label">Ghi chú</label>
							<?php /* tag "div" from line 228 */; ?>
<div class="controls">
								<?php /* tag "input" from line 229 */; ?>
<input id="Note1" name="Note1" type="text" class="form-control input-small"/>
							</div>
						</div>
						<?php /* tag "div" from line 232 */; ?>
<div class="form-actions">
							<?php /* tag "button" from line 233 */; ?>
<button id="URLSessionUpdButton" class="btn btn-primary btn-small"><?php /* tag "i" from line 233 */; ?>
<i class="glyphicons-download_alt"></i> Lưu</button>
							<?php /* tag "button" from line 234 */; ?>
<button data-dismiss="modal" class="btn btn-default btn-small"><?php /* tag "i" from line 234 */; ?>
<i class="glyphicons-undo"></i> Hủy</button>
						</div>
						<?php /* tag "div" from line 236 */; ?>
<div id="IdUser1"></div>
						<?php /* tag "div" from line 237 */; ?>
<div id="IdCustomer1"></div>
						<?php /* tag "div" from line 238 */; ?>
<div id="IdTable1"></div>
						<?php /* tag "div" from line 239 */; ?>
<div id="Surtax1"></div>
						<?php /* tag "div" from line 240 */; ?>
<div id="Payment1"></div>
					</div>
				</div>
			</div>
		</div>
		<!-- END DIALOG EDIT -->
		<?php 
/* tag "div" from line 246 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mDialog.xhtml/DialogDel', $_thistpl) ;
$ctx->popSlots() ;
?>

		
        <?php /* tag "script" from line 248 */; ?>
<script type="text/javascript">
		/*<![CDATA[*/			
									
			//-----------------------------------------------------------------------------------
			//Delete 1 DETAIL			
			//-----------------------------------------------------------------------------------
			$('.remove-item').click(function(){$('#URLDelButton').attr('alt', $(this).attr('data-id'));});
			$('#URLDelButton').click(function(e){
				var URL = "/object/del/SessionDetail/" + $(this).attr('alt');
				$("#DialogDel").modal('hide');
				$.ajax({
					type: "POST",
					url: URL,
					success: function(msg){						
						var IdCustomer = $("#CustomerCurrent").attr('alt');						
						$("#SessionAll").load("/selling/load/customer/"+IdCustomer);
						$("#SessionView").load("/selling/session/load/" + $('#Session').attr('alt'));
					}
				});
			});
								
			//-----------------------------------------------------------------------------------
			//Update 1 SESSION
			//-----------------------------------------------------------------------------------
			$('.SessionUpdate').click(function(e){
				//Load dữ liệu JSON về
				var url = "/object/load/Session/" + $(this).attr('data-session-id');
				
				//Load dữ liệu JSON lên FORM
				$.getJSON(url, function(data){					
					$('#URLSessionUpdButton').attr('alt', data.Id);
					$('#DateTime1').attr('value'		, data.DateTime);
					$('#DateTimeEnd1').attr('value'		, data.DateTimeEnd);
					$('#DiscountPercent1').attr('value'	, data.DiscountPercent);
					$('#DiscountValue1').attr('value'	, data.DiscountValue);
					$('#CustomerName').attr('value'		, data.CustomerName);					
					$('#Note1').attr('value'			, data.Note);
					
					$('#IdUser1').attr('alt'			, data.IdUser);
					$('#IdCustomer1').attr('alt'		, data.IdCustomer);
					$('#IdTable1').attr('alt'			, data.IdTable);
					$('#Surtax1').attr('alt'			, data.Surtax);
					$('#Payment1').attr('alt'			, data.Payment);
				});
			});
			
			$("#URLSessionUpdButton").click(function(){				
				var Data = [];
				Data[0] 	= $('#URLSessionUpdButton').attr('alt');
				Data[1] 	= $('#IdTable1').attr('alt');
				Data[2] 	= $('#IdUser1').attr('alt');				
				Data[3] 	= $('#IdCustomer1').attr('alt');				
				Data[4] 	= $('#IdEmployee1').val();
				Data[5] 	= $('#DateTime1').val();
				Data[6] 	= $('#DateTimeEnd1').val();
				Data[7] 	= $('#Note1').val();
				Data[8] 	= $('#Status1').val();
				Data[9] 	= $('#DiscountValue1').val();
				Data[10] 	= $('#DiscountPercent1').val();
				Data[11] 	= $('#Surtax1').val();
				Data[12] 	= "0";
				$("#DialogSession").modal('hide');
									
				var URL = "/object/upd/Session";
				$.ajax({
					type: "POST",
					data: {Data:Data},
					url: URL,
					success: function(msg){
						$("#SessionView").load("/selling/session/load/" + $('#Session').attr('alt'));
					}
				});
			});
									
			//-----------------------------------------------------------------------------------
			//Load 1 SESSION DETAIL
			//-----------------------------------------------------------------------------------
			$('.update-item').click(function(){
				$('#URLUpdButton').attr('alt', 	$(this).attr('Id')			);
				$('#IdCourse1').attr('value', 	$(this).attr('idcourse')	);
				$('#Name1').attr('value', 		$(this).attr('name')		);
				$('#Count1').attr('value', 		$(this).attr('count')		);
				$('#Price1').attr('value', 		$(this).attr('price')		);				
			});
												
			//-----------------------------------------------------------------------------------
			//Update 1 SESSION DETAIL
			//-----------------------------------------------------------------------------------
			$("#FormSDUpdate").validate({
				rules:{
					Count1:{
						min: 0,
						required:true
					},
					Price1:{
						min: 0,
						required:true
					}
				},
				errorClass: "help-inline",
				errorElement: "span",
				highlight:function(element, errorClass, validClass) {
					$(element).parents('.form-group').addClass('has-error');
				},
				unhighlight: function(element, errorClass, validClass){
					$(element).parents('.form-group').removeClass('has-error');
					$(element).parents('.form-group').addClass('has-success');
				},
				submitHandler: function (form) {										
					var Data = [];
					Data[0] = $('#URLUpdButton').attr('alt');
					Data[1] = $('#Session').attr('alt');
					Data[2] = $('#IdCourse1').val();
					Data[3] = $('#Count1').val();
					Data[4] = $('#Price1').val();
										
					$("#DialogEdit").modal('hide');
										
					var URL = "/object/upd/SessionDetail";
					$.ajax({
						type: "POST",
						data: {Data:Data},
						url: URL,
						success: function(msg){
							var IdCustomer = $("#CustomerCurrent").attr('alt');							
							$("#SessionAll").load("/selling/load/customer/"+IdCustomer);
							$("#SessionView").load("/selling/session/load/" + $('#Session').attr('alt'));
						}
					});
					return false;
				}
			});
			$("#DialogEdit").on('show.bs.modal', function(event){
				window.setTimeout(function(){
				$(event.currentTarget).find('input#Count1').first().focus()
				}, 0500);
			});
			
			$(".Ticket").click(function(){
				var url = $(this).attr('alt');
				var thePopup = window.open( url, "In Phiếu", "menubar=0,location=0,height=700,width=700" );
				thePopup.print();
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

Generated by PHPTAL from G:\AppsWeb\cmsA\sell.thanhsocola.com\mvc\templates\SellingSessionLoad.html (edit that file instead) */; ?>