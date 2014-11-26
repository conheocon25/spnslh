<?php 
function tpl_533fbcef_Setting__JbiaxejErbswXVd7HMil8A(PHPTAL $tpl, PHPTAL_Context $ctx) {
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
<link rel="stylesheet" href="/mvc/templates/theme/cms/css/bootstrap.min.css"/>
		<?php /* tag "link" from line 7 */; ?>
<link rel="stylesheet" href="/mvc/templates/theme/cms/css/bootstrap-glyphicons.css"/>
		<?php /* tag "link" from line 8 */; ?>
<link rel="stylesheet" href="/mvc/templates/theme/cms/css/glyphicons-regular.css"/>
		<?php /* tag "link" from line 9 */; ?>
<link rel="stylesheet" href="/mvc/templates/theme/cms/css/unicorn.main.css"/>		
		<?php 
/* tag "link" from line 10 */ ;
if (null !== ($_tmp_1 = ('/mvc/templates/theme/cms/css/unicorn.' . \MVC\Base\SessionRegistry::instance()->getCurrentTheme() . '.css'))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<link rel="stylesheet" class="skin-color"<?php echo $_tmp_1 ?>
/>		
	</head>
	
	<?php /* tag "body" from line 13 */; ?>
<body data-menu-position="closed">
		<?php 
/* tag "div" from line 14 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/Header', $_thistpl) ;
$ctx->popSlots() ;
?>
		
		<?php 
/* tag "div" from line 15 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/MenuApp', $_thistpl) ;
$ctx->popSlots() ;
?>

		<?php /* tag "div" from line 16 */; ?>
<div id="content">
			<?php 
/* tag "div" from line 17 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/ContentHeader', $_thistpl) ;
$ctx->popSlots() ;
?>

			<?php 
/* tag "div" from line 18 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/LocationBar', $_thistpl) ;
$ctx->popSlots() ;
?>

			<?php /* tag "div" from line 19 */; ?>
<div class="container-fluid">
				<?php /* tag "div" from line 20 */; ?>
<div class="row">
					<?php /* tag "div" from line 21 */; ?>
<div class="col-12">
						<?php /* tag "div" from line 22 */; ?>
<div class="widget-box">
							<?php 
/* tag "div" from line 23 */ ;
if (\MVC\Base\SessionRegistry::instance()->getCurrentUser()->isAdmin()):  ;
?>
<div class="widget-content nopadding">
								<?php /* tag "table" from line 24 */; ?>
<table class="table table-bordered table-striped table-hover">
									<?php /* tag "thead" from line 25 */; ?>
<thead>
										<?php /* tag "tr" from line 26 */; ?>
<tr>
											<?php /* tag "th" from line 27 */; ?>
<th width="40"><?php /* tag "i" from line 27 */; ?>
<i class="glyphicons-cogwheels"></i></th>
											<?php /* tag "th" from line 28 */; ?>
<th><?php /* tag "div" from line 28 */; ?>
<div class="text-left">THIẾT LẬP</div></th>
										</tr>
									</thead>
									<?php /* tag "tbody" from line 31 */; ?>
<tbody>
										<?php /* tag "tr" from line 32 */; ?>
<tr>
											<?php /* tag "td" from line 33 */; ?>
<td align="center"><?php /* tag "a" from line 33 */; ?>
<a href="/setting/customer"><?php /* tag "i" from line 33 */; ?>
<i class="glyphicons-cogwheel"></i></a></td>
											<?php /* tag "td" from line 34 */; ?>
<td><?php 
/* tag "a" from line 34 */ ;
if (null !== ($_tmp_1 = ('/setting/customer'))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a<?php echo $_tmp_1 ?>
>KHÁCH HÀNG</a></td>
										</tr>
										<?php /* tag "tr" from line 36 */; ?>
<tr>
											<?php /* tag "td" from line 37 */; ?>
<td align="center"><?php /* tag "a" from line 37 */; ?>
<a href="/setting/category"><?php /* tag "i" from line 37 */; ?>
<i class="glyphicons-cogwheel"></i></a></td>
											<?php /* tag "td" from line 38 */; ?>
<td><?php 
/* tag "a" from line 38 */ ;
if (null !== ($_tmp_1 = ('/setting/category'))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a<?php echo $_tmp_1 ?>
>DANH MỤC MÓN</a></td>
										</tr>
										<?php /* tag "tr" from line 40 */; ?>
<tr>
											<?php /* tag "td" from line 41 */; ?>
<td align="center"><?php /* tag "a" from line 41 */; ?>
<a href="/setting/supplier"><?php /* tag "i" from line 41 */; ?>
<i class="glyphicons-cogwheel"></i></a></td>
											<?php /* tag "td" from line 42 */; ?>
<td><?php 
/* tag "a" from line 42 */ ;
if (null !== ($_tmp_1 = ('/setting/supplier'))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a<?php echo $_tmp_1 ?>
>NHÀ CUNG CẤP</a></td>
										</tr>
										<?php /* tag "tr" from line 44 */; ?>
<tr>
											<?php /* tag "td" from line 45 */; ?>
<td align="center"><?php /* tag "a" from line 45 */; ?>
<a href="/setting/domain"><?php /* tag "i" from line 45 */; ?>
<i class="glyphicons-cogwheel"></i></a></td>
											<?php /* tag "td" from line 46 */; ?>
<td><?php 
/* tag "a" from line 46 */ ;
if (null !== ($_tmp_1 = ('/setting/domain'))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a<?php echo $_tmp_1 ?>
>KHU VỰC</a></td>
										</tr>
										<?php /* tag "tr" from line 48 */; ?>
<tr>
											<?php /* tag "td" from line 49 */; ?>
<td align="center"><?php /* tag "a" from line 49 */; ?>
<a href="/setting/user"><?php /* tag "i" from line 49 */; ?>
<i class="glyphicons-cogwheel"></i></a></td>
											<?php /* tag "td" from line 50 */; ?>
<td><?php 
/* tag "a" from line 50 */ ;
if (null !== ($_tmp_1 = ('/setting/user'))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a<?php echo $_tmp_1 ?>
>NGƯỜI DÙNG</a></td>
										</tr>									
										<?php /* tag "tr" from line 52 */; ?>
<tr>
											<?php /* tag "td" from line 53 */; ?>
<td align="center"><?php /* tag "a" from line 53 */; ?>
<a href="/setting/unit"><?php /* tag "i" from line 53 */; ?>
<i class="glyphicons-cogwheel"></i></a></td>
											<?php /* tag "td" from line 54 */; ?>
<td><?php 
/* tag "a" from line 54 */ ;
if (null !== ($_tmp_1 = ('/setting/unit'))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a<?php echo $_tmp_1 ?>
>ĐƠN VỊ TÍNH</a></td>
										</tr>
										<?php /* tag "tr" from line 56 */; ?>
<tr>
											<?php /* tag "td" from line 57 */; ?>
<td align="center"><?php /* tag "a" from line 57 */; ?>
<a href="/setting/employee"><?php /* tag "i" from line 57 */; ?>
<i class="glyphicons-cogwheel"></i></a></td>
											<?php /* tag "td" from line 58 */; ?>
<td><?php 
/* tag "a" from line 58 */ ;
if (null !== ($_tmp_1 = ('/setting/employee'))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a<?php echo $_tmp_1 ?>
>NHÂN VIÊN</a></td>
										</tr>
										<?php /* tag "tr" from line 60 */; ?>
<tr>
											<?php /* tag "td" from line 61 */; ?>
<td align="center"><?php /* tag "a" from line 61 */; ?>
<a href="/setting/termpaid"><?php /* tag "i" from line 61 */; ?>
<i class="glyphicons-cogwheel"></i></a></td>
											<?php /* tag "td" from line 62 */; ?>
<td><?php 
/* tag "a" from line 62 */ ;
if (null !== ($_tmp_1 = ('/setting/termpaid'))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a<?php echo $_tmp_1 ?>
>DANH MỤC THU</a></td>
										</tr>
										<?php /* tag "tr" from line 64 */; ?>
<tr>
											<?php /* tag "td" from line 65 */; ?>
<td align="center"><?php /* tag "a" from line 65 */; ?>
<a href="/setting/termcollect"><?php /* tag "i" from line 65 */; ?>
<i class="glyphicons-cogwheel"></i></a></td>
											<?php /* tag "td" from line 66 */; ?>
<td><?php 
/* tag "a" from line 66 */ ;
if (null !== ($_tmp_1 = ('/setting/termcollect'))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a<?php echo $_tmp_1 ?>
>DANH MỤC CHI</a></td>
										</tr>
										<?php /* tag "tr" from line 68 */; ?>
<tr>
											<?php /* tag "td" from line 69 */; ?>
<td align="center"><?php /* tag "a" from line 69 */; ?>
<a href="/setting/config"><?php /* tag "i" from line 69 */; ?>
<i class="glyphicons-cogwheel"></i></a></td>
											<?php /* tag "td" from line 70 */; ?>
<td><?php 
/* tag "a" from line 70 */ ;
if (null !== ($_tmp_1 = ('/setting/config'))):  ;
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
							</div><?php endif; ?>

							<?php 
/* tag "div" from line 75 */ ;
if (\MVC\Base\SessionRegistry::instance()->getCurrentUser()->isManager()):  ;
?>
<div class="widget-content nopadding">
								<?php /* tag "table" from line 76 */; ?>
<table class="table table-bordered table-striped table-hover">
									<?php /* tag "thead" from line 77 */; ?>
<thead>
										<?php /* tag "tr" from line 78 */; ?>
<tr>
											<?php /* tag "th" from line 79 */; ?>
<th width="40"><?php /* tag "i" from line 79 */; ?>
<i class="glyphicons-cogwheels"></i></th>
											<?php /* tag "th" from line 80 */; ?>
<th><?php /* tag "div" from line 80 */; ?>
<div class="text-left">THIẾT LẬP</div></th>
										</tr>
									</thead>
									<?php /* tag "tbody" from line 83 */; ?>
<tbody>
										<?php /* tag "tr" from line 84 */; ?>
<tr>
											<?php /* tag "td" from line 85 */; ?>
<td align="center"><?php /* tag "a" from line 85 */; ?>
<a href="/setting/customer"><?php /* tag "i" from line 85 */; ?>
<i class="glyphicons-cogwheel"></i></a></td>
											<?php /* tag "td" from line 86 */; ?>
<td><?php 
/* tag "a" from line 86 */ ;
if (null !== ($_tmp_1 = ('/setting/customer'))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a<?php echo $_tmp_1 ?>
>KHÁCH HÀNG</a></td>
										</tr>
										<?php /* tag "tr" from line 88 */; ?>
<tr>
											<?php /* tag "td" from line 89 */; ?>
<td align="center"><?php /* tag "a" from line 89 */; ?>
<a href="/setting/category"><?php /* tag "i" from line 89 */; ?>
<i class="glyphicons-cogwheel"></i></a></td>
											<?php /* tag "td" from line 90 */; ?>
<td><?php 
/* tag "a" from line 90 */ ;
if (null !== ($_tmp_1 = ('/setting/category'))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a<?php echo $_tmp_1 ?>
>DANH MỤC MÓN</a></td>
										</tr>
										<?php /* tag "tr" from line 92 */; ?>
<tr>
											<?php /* tag "td" from line 93 */; ?>
<td align="center"><?php /* tag "a" from line 93 */; ?>
<a href="/setting/supplier"><?php /* tag "i" from line 93 */; ?>
<i class="glyphicons-cogwheel"></i></a></td>
											<?php /* tag "td" from line 94 */; ?>
<td><?php 
/* tag "a" from line 94 */ ;
if (null !== ($_tmp_1 = ('/setting/supplier'))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a<?php echo $_tmp_1 ?>
>NHÀ CUNG CẤP</a></td>
										</tr>
										<?php /* tag "tr" from line 96 */; ?>
<tr>
											<?php /* tag "td" from line 97 */; ?>
<td align="center"><?php /* tag "a" from line 97 */; ?>
<a href="/setting/domain"><?php /* tag "i" from line 97 */; ?>
<i class="glyphicons-cogwheel"></i></a></td>
											<?php /* tag "td" from line 98 */; ?>
<td><?php 
/* tag "a" from line 98 */ ;
if (null !== ($_tmp_1 = ('/setting/domain'))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a<?php echo $_tmp_1 ?>
>KHU VỰC</a></td>
										</tr>										
										<?php /* tag "tr" from line 100 */; ?>
<tr>
											<?php /* tag "td" from line 101 */; ?>
<td align="center"><?php /* tag "a" from line 101 */; ?>
<a href="/setting/unit"><?php /* tag "i" from line 101 */; ?>
<i class="glyphicons-cogwheel"></i></a></td>
											<?php /* tag "td" from line 102 */; ?>
<td><?php 
/* tag "a" from line 102 */ ;
if (null !== ($_tmp_1 = ('/setting/unit'))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a<?php echo $_tmp_1 ?>
>ĐƠN VỊ TÍNH</a></td>
										</tr>										
									</tbody>
								</table>
							</div><?php endif; ?>

						</div>
					</div>					
				</div>
			</div>
		</div>
		<?php 
/* tag "div" from line 112 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/Footer', $_thistpl) ;
$ctx->popSlots() ;
?>
		
		<?php /* tag "script" from line 113 */; ?>
<script src="/mvc/templates/theme/cms/js/jquery.min.js"></script>
	</body>
</html><?php 
/* end */ ;

}

?>
<?php /* 
*** DO NOT EDIT THIS FILE ***

Generated by PHPTAL from G:\AppsWeb\cmsA\sell.thanhsocola.com\mvc\templates\Setting.html (edit that file instead) */; ?>