<?php 
function tpl_54329517_FCategory__GUSk_UyarAEhU4_ETDjlaw(PHPTAL $tpl, PHPTAL_Context $ctx) {
$_thistpl = $tpl ;
$_translator = $tpl->getTranslator() ;
/* tag "documentElement" from line 1 */ ;
$ctx->setDocType('<!DOCTYPE html>',false) ;
?>

<?php /* tag "html" from line 2 */; ?>
<html>
	<?php /* tag "head" from line 3 */; ?>
<head>
		<?php 
/* tag "div" from line 4 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mFront.xhtml/IncludeMETA', $_thistpl) ;
$ctx->popSlots() ;
?>

		<?php 
/* tag "div" from line 5 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mFront.xhtml/IncludeCSS', $_thistpl) ;
$ctx->popSlots() ;
?>

	</head>	
	<?php /* tag "body" from line 7 */; ?>
<body>		
		<?php /* tag "div" from line 8 */; ?>
<div id="wrapper">
			<?php 
/* tag "div" from line 9 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mFront.xhtml/Header', $_thistpl) ;
$ctx->popSlots() ;
?>

			<?php /* tag "section" from line 10 */; ?>
<section id="content">				
				<?php /* tag "div" from line 11 */; ?>
<div id="category-header">
					<?php /* tag "div" from line 12 */; ?>
<div class="row">
						<?php /* tag "div" from line 13 */; ?>
<div class="container"><?php echo phptal_tostring($ctx->path($ctx->Category2, 'getInfo')); ?>
</div>
					</div>
				</div>
				<?php /* tag "div" from line 16 */; ?>
<div id="category-breadcrumb">
					<?php /* tag "div" from line 17 */; ?>
<div class="container">
						<?php /* tag "ul" from line 18 */; ?>
<ul class="breadcrumb">							
							<?php /* tag "li" from line 19 */; ?>
<li><?php /* tag "a" from line 19 */; ?>
<a href="/">TRANG CHỦ</a></li>
							<?php /* tag "li" from line 20 */; ?>
<li>THỰC ĐƠN</li>
							<?php /* tag "li" from line 21 */; ?>
<li class="active"><?php echo phptal_escape($ctx->Title); ?>
</li>
						</ul>
					</div>
				</div>
				<?php /* tag "div" from line 25 */; ?>
<div class="container">
					<?php /* tag "div" from line 26 */; ?>
<div class="row">
						<?php /* tag "div" from line 27 */; ?>
<div class="col-md-12">
							<?php /* tag "div" from line 28 */; ?>
<div class="row">
								<?php /* tag "div" from line 29 */; ?>
<div class="col-md-9 col-sm-8 col-xs-12 main-content">
									<?php /* tag "div" from line 30 */; ?>
<div class="category-toolbar clearfix">										
										<?php /* tag "div" from line 31 */; ?>
<div class="toolbox-pagination clearfix">
											<?php /* tag "ul" from line 32 */; ?>
<ul class="pagination">
												<?php 
/* tag "li" from line 33 */ ;
$_tmp_1 = $ctx->repeat ;
$_tmp_1->P = new PHPTAL_RepeatController($ctx->path($ctx->PN, 'getPages'))
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_1->P as $ctx->P): ;
if (null !== ($_tmp_2 = (($ctx->P->getId()==$ctx->Page)?'active':''))):  ;
$_tmp_2 = ' class="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<li<?php echo $_tmp_2 ?>
>
													<?php 
/* tag "a" from line 34 */ ;
if (null !== ($_tmp_3 = ($ctx->path($ctx->P, 'getURL')))):  ;
$_tmp_3 = ' href="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<a<?php echo $_tmp_3 ?>
><?php echo phptal_escape($ctx->path($ctx->P, 'getName')); ?>
</a>
												</li><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

											</ul>											
										</div>
									</div>
									<?php /* tag "div" from line 39 */; ?>
<div class="md-margin"></div><!-- .space -->
									<?php /* tag "div" from line 40 */; ?>
<div class="category-item-container">
										<?php /* tag "div" from line 41 */; ?>
<div class="row">
											<?php 
/* tag "div" from line 42 */ ;
$_tmp_3 = $ctx->repeat ;
$_tmp_3->Product = new PHPTAL_RepeatController($ctx->ProductAll)
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_3->Product as $ctx->Product): ;
?>
<div class="col-md-4 col-sm-6 col-xs-12">
												<?php /* tag "div" from line 43 */; ?>
<div class="item">
													<?php /* tag "div" from line 44 */; ?>
<div class="item-image-container">
														<?php /* tag "figure" from line 45 */; ?>
<figure>
															<?php 
/* tag "a" from line 46 */ ;
if ($ctx->path($ctx->Product, 'getInfo')):  ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->Product, 'getURLView')))):  ;
$_tmp_2 = ' href="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a<?php echo $_tmp_2 ?>
>
																<?php 
/* tag "img" from line 47 */ ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->Product, 'getInfo/getImage1')))):  ;
$_tmp_1 = ' src="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<img class="item-image"<?php echo $_tmp_1 ?>
/>
																<?php 
/* tag "img" from line 48 */ ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->Product, 'getInfo/getImage2')))):  ;
$_tmp_1 = ' src="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<img class="item-image-hover"<?php echo $_tmp_1 ?>
/>
															</a><?php endif; ?>

														</figure>
														<?php 
/* tag "div" from line 51 */ ;
if ($ctx->path($ctx->Product, 'getPrice2')):  ;
?>
<div class="item-price-container">
															<?php /* tag "span" from line 52 */; ?>
<span class="item-price"><?php echo phptal_escape($ctx->path($ctx->Product, 'getPrice2Print')); ?>
</span>
														</div><?php endif; ?>
														
													</div>
													<?php /* tag "div" from line 55 */; ?>
<div class="item-meta-container">
														<?php /* tag "div" from line 56 */; ?>
<div class="ratings-container">
															<?php /* tag "div" from line 57 */; ?>
<div class="ratings">
																<?php /* tag "div" from line 58 */; ?>
<div class="ratings-result" data-result="100"></div>
															</div>
														</div>
														<?php /* tag "h3" from line 61 */; ?>
<h3 class="item-name"><?php 
/* tag "a" from line 61 */ ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->Product, 'getURLView')))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a<?php echo $_tmp_1 ?>
><?php echo phptal_escape($ctx->path($ctx->Product, 'getName')); ?>
</a></h3>
														<?php /* tag "div" from line 62 */; ?>
<div class="item-action">
															<?php /* tag "div" from line 63 */; ?>
<div class="item-add-btn" style="cursor:pointer">
																<?php 
/* tag "span" from line 70 */ ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->Product, 'getId')))):  ;
$_tmp_2 = ' id="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->Product, 'getName')))):  ;
$_tmp_1 = ' name="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
if (null !== ($_tmp_4 = ($ctx->path($ctx->Product, 'getPrice2')))):  ;
$_tmp_4 = ' price="'.phptal_escape($_tmp_4).'"' ;
else:  ;
$_tmp_4 = '' ;
endif ;
if (null !== ($_tmp_5 = ($ctx->path($ctx->Product, 'getInfo/getImage1')))):  ;
$_tmp_5 = ' image="'.phptal_escape($_tmp_5).'"' ;
else:  ;
$_tmp_5 = '' ;
endif ;
?>
<span class="icon-cart-text"<?php echo $_tmp_2 ?>
<?php echo $_tmp_1 ?>
<?php echo $_tmp_4 ?>
<?php echo $_tmp_5 ?>
> Xem chi tiết</span>
															</div>															
														</div>
													</div>
												</div>
											</div><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

										</div>
									</div>
								</div>
								<?php /* tag "aside" from line 79 */; ?>
<aside class="col-md-3 col-sm-4 col-xs-12 sidebar">
									<?php /* tag "div" from line 80 */; ?>
<div class="widget">
										<?php /* tag "div" from line 81 */; ?>
<div class="panel-group custom-accordion sm-accordion" id="category-filter">
											<?php /* tag "div" from line 82 */; ?>
<div class="panel">
												<?php /* tag "div" from line 83 */; ?>
<div class="accordion-header">
													<?php /* tag "div" from line 84 */; ?>
<div class="accordion-title"><?php /* tag "span" from line 84 */; ?>
<span>Danh mục</span></div><!-- End .accordion-title -->
													<?php /* tag "a" from line 85 */; ?>
<a class="accordion-btn opened" data-toggle="collapse" data-target="#category-list-1"></a>
												</div><!-- End .accordion-header -->
												<?php /* tag "div" from line 87 */; ?>
<div id="category-list-1" class="collapse in">
													<?php /* tag "div" from line 88 */; ?>
<div class="panel-body">
														<?php /* tag "ul" from line 89 */; ?>
<ul class="category-filter-list jscrollpane">
															<?php 
/* tag "li" from line 90 */ ;
$_tmp_2 = $ctx->repeat ;
$_tmp_2->Category2 = new PHPTAL_RepeatController($ctx->path($ctx->Category1, 'getCategoryAll'))
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_2->Category2 as $ctx->Category2): ;
?>
<li>
																<?php 
/* tag "a" from line 91 */ ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->Category2, 'getURLView')))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a<?php echo $_tmp_1 ?>
><?php /* tag "span" from line 91 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Category2, 'getName')); ?>
</span> (<?php /* tag "span" from line 91 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Category2, 'getProductAll/count')); ?>
</span>)</a>
															</li><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

														</ul>
													</div>
												</div>
											</div>
										</div>
									</div>
									<?php 
/* tag "div" from line 99 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mFront.xhtml/Subscribe', $_thistpl) ;
$ctx->popSlots() ;
?>

								</aside>
							</div>
						</div>
					</div>
				</div>
			</section>
			<?php 
/* tag "div" from line 106 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mFront.xhtml/Footer', $_thistpl) ;
$ctx->popSlots() ;
?>

		</div><!-- End #wrapper -->		
		<?php 
/* tag "div" from line 108 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mFront.xhtml/IncludeJS', $_thistpl) ;
$ctx->popSlots() ;
?>

		<?php /* tag "script" from line 109 */; ?>
<script>
			$(function() {								
				$(".icon-cart-text").click(function(){
					var Data 	= [];
					Data[0]		= $(this).attr('id');
					Data[1]		= $(this).attr('name');
					Data[2]		= $(this).attr('price');
					Data[3]		= $(this).attr('image');
					
					var URL = "/gio-hang/them";
					$.ajax({
						type: "POST",
						data: {Data:Data},
						url: URL,
						success: function(msg){
							location.reload();
						}
					});				
				});
				
				$(".icon-like").click(function(){
					var Data 	= [];
					Data[0]		= $(this).attr('id');
					Data[1]		= $(this).attr('name');
					Data[2]		= $(this).attr('price');
					Data[3]		= $(this).attr('image');
					
					var URL = "/danh-dau/them";
					$.ajax({
						type: "POST",
						data: {Data:Data},
						url: URL,
						success: function(msg){
							location.reload();
						}
					});
				
				});
				
			});
		</script>
	</body>
</html><?php 
/* end */ ;

}

?>
<?php /* 
*** DO NOT EDIT THIS FILE ***

Generated by PHPTAL from G:\AppsWeb\cmsA\www.amthuclangsen.com\mvc\templates\FCategory.html (edit that file instead) */; ?>