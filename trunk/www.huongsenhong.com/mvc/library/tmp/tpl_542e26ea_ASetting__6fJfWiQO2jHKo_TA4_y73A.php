<?php 
function tpl_542e26ea_ASetting__6fJfWiQO2jHKo_TA4_y73A(PHPTAL $tpl, PHPTAL_Context $ctx) {
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
<body data-menu-position="closed">
		<?php 
/* tag "div" from line 9 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/Header', $_thistpl) ;
$ctx->popSlots() ;
?>
		
		<?php 
/* tag "div" from line 10 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/MenuApp', $_thistpl) ;
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
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/LocationBar', $_thistpl) ;
$ctx->popSlots() ;
?>

			<?php /* tag "div" from line 14 */; ?>
<div class="container-fluid">
				<?php /* tag "div" from line 15 */; ?>
<div class="row">
					<?php /* tag "div" from line 16 */; ?>
<div class="col-12">
						<?php /* tag "div" from line 17 */; ?>
<div class="widget-box">
							<?php /* tag "div" from line 18 */; ?>
<div class="widget-content nopadding">
								<?php /* tag "table" from line 19 */; ?>
<table class="table table-bordered table-striped table-hover">
									<?php /* tag "thead" from line 20 */; ?>
<thead>
										<?php /* tag "tr" from line 21 */; ?>
<tr>
											<?php /* tag "th" from line 22 */; ?>
<th width="40"><?php /* tag "i" from line 22 */; ?>
<i class="glyphicons-cogwheels"></i></th>
											<?php /* tag "th" from line 23 */; ?>
<th><?php /* tag "div" from line 23 */; ?>
<div class="text-left">THIẾT LẬP NỘI DUNG</div></th>
										</tr>
									</thead>
									<?php /* tag "tbody" from line 26 */; ?>
<tbody>
										<?php /* tag "tr" from line 27 */; ?>
<tr>
											<?php /* tag "td" from line 28 */; ?>
<td align="center"><?php /* tag "a" from line 28 */; ?>
<a href="/admin/setting/presentation"><?php /* tag "i" from line 28 */; ?>
<i class="glyphicons-cogwheel"></i></a></td>
											<?php /* tag "td" from line 29 */; ?>
<td><?php 
/* tag "a" from line 29 */ ;
if (null !== ($_tmp_1 = ('/admin/setting/presentation'))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a<?php echo $_tmp_1 ?>
>TRÌNH BÀY</a></td>
										</tr>
										<?php /* tag "tr" from line 31 */; ?>
<tr>
											<?php /* tag "td" from line 32 */; ?>
<td align="center"><?php /* tag "a" from line 32 */; ?>
<a href="/admin/setting/tag"><?php /* tag "i" from line 32 */; ?>
<i class="glyphicons-cogwheel"></i></a></td>
											<?php /* tag "td" from line 33 */; ?>
<td><?php 
/* tag "a" from line 33 */ ;
if (null !== ($_tmp_1 = ('/admin/setting/tag'))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a<?php echo $_tmp_1 ?>
>THẺ BÀI</a></td>
										</tr>
										<?php /* tag "tr" from line 35 */; ?>
<tr>
											<?php /* tag "td" from line 36 */; ?>
<td align="center"><?php /* tag "a" from line 36 */; ?>
<a href="/admin/setting/post"><?php /* tag "i" from line 36 */; ?>
<i class="glyphicons-cogwheel"></i></a></td>
											<?php /* tag "td" from line 37 */; ?>
<td><?php 
/* tag "a" from line 37 */ ;
if (null !== ($_tmp_1 = ('/admin/setting/post'))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a<?php echo $_tmp_1 ?>
>BÀI VIẾT</a></td>
										</tr>
										<?php /* tag "tr" from line 39 */; ?>
<tr>
											<?php /* tag "td" from line 40 */; ?>
<td align="center"><?php /* tag "a" from line 40 */; ?>
<a href="/admin/setting/storyline"><?php /* tag "i" from line 40 */; ?>
<i class="glyphicons-cogwheel"></i></a></td>
											<?php /* tag "td" from line 41 */; ?>
<td><?php 
/* tag "a" from line 41 */ ;
if (null !== ($_tmp_1 = ('/admin/setting/storyline'))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a<?php echo $_tmp_1 ?>
>CÂU CHUYỆN KHÁCH HÀNG</a></td>
										</tr>
									</tbody>
								</table>
								<?php /* tag "table" from line 45 */; ?>
<table class="table table-bordered table-striped table-hover">
									<?php /* tag "thead" from line 46 */; ?>
<thead>
										<?php /* tag "tr" from line 47 */; ?>
<tr>
											<?php /* tag "th" from line 48 */; ?>
<th width="40"><?php /* tag "i" from line 48 */; ?>
<i class="glyphicons-cogwheels"></i></th>
											<?php /* tag "th" from line 49 */; ?>
<th><?php /* tag "div" from line 49 */; ?>
<div class="text-left">THIẾT LẬP MEDIA</div></th>
										</tr>
									</thead>
									<?php /* tag "tbody" from line 52 */; ?>
<tbody>
										<?php /* tag "tr" from line 53 */; ?>
<tr>
											<?php /* tag "td" from line 54 */; ?>
<td align="center"><?php /* tag "a" from line 54 */; ?>
<a href="/admin/setting/album"><?php /* tag "i" from line 54 */; ?>
<i class="glyphicons-cogwheel"></i></a></td>
											<?php /* tag "td" from line 55 */; ?>
<td><?php 
/* tag "a" from line 55 */ ;
if (null !== ($_tmp_1 = ('/admin/setting/album'))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a<?php echo $_tmp_1 ?>
>ALBUM ẢNH</a></td>
										</tr>
										<?php /* tag "tr" from line 57 */; ?>
<tr>
											<?php /* tag "td" from line 58 */; ?>
<td align="center"><?php /* tag "a" from line 58 */; ?>
<a href="/admin/setting/video"><?php /* tag "i" from line 58 */; ?>
<i class="glyphicons-cogwheel"></i></a></td>
											<?php /* tag "td" from line 59 */; ?>
<td><?php 
/* tag "a" from line 59 */ ;
if (null !== ($_tmp_1 = ('/admin/setting/video'))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a<?php echo $_tmp_1 ?>
>VIDEO</a></td>
										</tr>										
									</tbody>
								</table>								
								<?php /* tag "table" from line 63 */; ?>
<table class="table table-bordered table-striped table-hover">
									<?php /* tag "thead" from line 64 */; ?>
<thead>
										<?php /* tag "tr" from line 65 */; ?>
<tr>
											<?php /* tag "th" from line 66 */; ?>
<th width="40"><?php /* tag "i" from line 66 */; ?>
<i class="glyphicons-cogwheels"></i></th>
											<?php /* tag "th" from line 67 */; ?>
<th><?php /* tag "div" from line 67 */; ?>
<div class="text-left">THIẾT LẬP MENU</div></th>
										</tr>
									</thead>
									<?php /* tag "tbody" from line 70 */; ?>
<tbody>										
										<?php /* tag "tr" from line 71 */; ?>
<tr>
											<?php /* tag "td" from line 72 */; ?>
<td align="center"><?php /* tag "a" from line 72 */; ?>
<a href="/admin/setting/manufacturer"><?php /* tag "i" from line 72 */; ?>
<i class="glyphicons-cogwheel"></i></a></td>
											<?php /* tag "td" from line 73 */; ?>
<td><?php 
/* tag "a" from line 73 */ ;
if (null !== ($_tmp_1 = ('/admin/setting/manufacturer'))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a<?php echo $_tmp_1 ?>
>NHÀ SẢN XUẤT</a></td>
										</tr>
										<?php /* tag "tr" from line 75 */; ?>
<tr>
											<?php /* tag "td" from line 76 */; ?>
<td align="center"><?php /* tag "a" from line 76 */; ?>
<a href="/admin/setting/supplier"><?php /* tag "i" from line 76 */; ?>
<i class="glyphicons-cogwheel"></i></a></td>
											<?php /* tag "td" from line 77 */; ?>
<td><?php 
/* tag "a" from line 77 */ ;
if (null !== ($_tmp_1 = ('/admin/setting/supplier'))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a<?php echo $_tmp_1 ?>
>NHÀ CUNG CẤP</a></td>
										</tr>
										<?php /* tag "tr" from line 79 */; ?>
<tr>
											<?php /* tag "td" from line 80 */; ?>
<td align="center"><?php /* tag "a" from line 80 */; ?>
<a href="/admin/setting/gattribute"><?php /* tag "i" from line 80 */; ?>
<i class="glyphicons-cogwheel"></i></a></td>
											<?php /* tag "td" from line 81 */; ?>
<td><?php 
/* tag "a" from line 81 */ ;
if (null !== ($_tmp_1 = ('/admin/setting/gattribute'))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a<?php echo $_tmp_1 ?>
>MÔ TẢ</a></td>
										</tr>
										<?php /* tag "tr" from line 83 */; ?>
<tr>
											<?php /* tag "td" from line 84 */; ?>
<td align="center"><?php /* tag "a" from line 84 */; ?>
<a href="/admin/setting/category"><?php /* tag "i" from line 84 */; ?>
<i class="glyphicons-cogwheel"></i></a></td>
											<?php /* tag "td" from line 85 */; ?>
<td><?php 
/* tag "a" from line 85 */ ;
if (null !== ($_tmp_1 = ('/admin/setting/category'))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a<?php echo $_tmp_1 ?>
>DANH MỤC</a></td>
										</tr>
									</tbody>
								</table>
								<?php /* tag "table" from line 89 */; ?>
<table class="table table-bordered table-striped table-hover">
									<?php /* tag "thead" from line 90 */; ?>
<thead>
										<?php /* tag "tr" from line 91 */; ?>
<tr>
											<?php /* tag "th" from line 92 */; ?>
<th width="40"><?php /* tag "i" from line 92 */; ?>
<i class="glyphicons-cogwheels"></i></th>
											<?php /* tag "th" from line 93 */; ?>
<th><?php /* tag "div" from line 93 */; ?>
<div class="text-left">THIẾT LẬP TỔNG QUÁT</div></th>
										</tr>
									</thead>
									<?php /* tag "tbody" from line 96 */; ?>
<tbody>
										<?php /* tag "tr" from line 97 */; ?>
<tr>
											<?php /* tag "td" from line 98 */; ?>
<td align="center"><?php /* tag "a" from line 98 */; ?>
<a href="/admin/setting/branch"><?php /* tag "i" from line 98 */; ?>
<i class="glyphicons-cogwheel"></i></a></td>
											<?php /* tag "td" from line 99 */; ?>
<td><?php 
/* tag "a" from line 99 */ ;
if (null !== ($_tmp_1 = ('/admin/setting/branch'))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a<?php echo $_tmp_1 ?>
>CHI NHÁNH</a></td>
										</tr>
										<?php /* tag "tr" from line 101 */; ?>
<tr>
											<?php /* tag "td" from line 102 */; ?>
<td align="center"><?php /* tag "a" from line 102 */; ?>
<a href="/admin/setting/user"><?php /* tag "i" from line 102 */; ?>
<i class="glyphicons-cogwheel"></i></a></td>
											<?php /* tag "td" from line 103 */; ?>
<td><?php 
/* tag "a" from line 103 */ ;
if (null !== ($_tmp_1 = ('/admin/setting/user'))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a<?php echo $_tmp_1 ?>
>NGƯỜI DÙNG</a></td>
										</tr>																			
										<?php /* tag "tr" from line 105 */; ?>
<tr>
											<?php /* tag "td" from line 106 */; ?>
<td align="center"><?php /* tag "a" from line 106 */; ?>
<a href="/admin/setting/employee"><?php /* tag "i" from line 106 */; ?>
<i class="glyphicons-cogwheel"></i></a></td>
											<?php /* tag "td" from line 107 */; ?>
<td><?php 
/* tag "a" from line 107 */ ;
if (null !== ($_tmp_1 = ('/admin/setting/employee'))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a<?php echo $_tmp_1 ?>
>NHÂN VIÊN</a></td>
										</tr>										
										<?php /* tag "tr" from line 109 */; ?>
<tr>
											<?php /* tag "td" from line 110 */; ?>
<td align="center"><?php /* tag "a" from line 110 */; ?>
<a href="/admin/setting/config"><?php /* tag "i" from line 110 */; ?>
<i class="glyphicons-cogwheel"></i></a></td>
											<?php /* tag "td" from line 111 */; ?>
<td><?php 
/* tag "a" from line 111 */ ;
if (null !== ($_tmp_1 = ('/admin/setting/config'))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a<?php echo $_tmp_1 ?>
>CẤU HÌNH</a></td>
										</tr>
									</tbody>
								</table>																
							</div>
						</div>
					</div>					
				</div>
			</div>
		</div>
		<?php 
/* tag "div" from line 121 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/Footer', $_thistpl) ;
$ctx->popSlots() ;
?>

		<?php 
/* tag "div" from line 122 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/IncludeJS', $_thistpl) ;
$ctx->popSlots() ;
?>

	</body>
</html><?php 
/* end */ ;

}

?>
<?php /* 
*** DO NOT EDIT THIS FILE ***

Generated by PHPTAL from G:\AppsWeb\cmsA\www.amthuclangsen.com\mvc\templates\ASetting.html (edit that file instead) */; ?>