<?php 
function tpl_5434cdbc_FHome__c8CCNenakKZDCuvXe9nCFQ(PHPTAL $tpl, PHPTAL_Context $ctx) {
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
<div id="slider-sequence" class="homeslider">
					<?php /* tag "div" from line 12 */; ?>
<div class="sequence-prev"></div>
					<?php /* tag "div" from line 13 */; ?>
<div class="sequence-next"></div>
					<?php /* tag "ul" from line 14 */; ?>
<ul class="sequence-canvas">						
						<?php 
/* tag "li" from line 15 */ ;
$_tmp_1 = $ctx->repeat ;
$_tmp_1->Slide = new PHPTAL_RepeatController($ctx->path($ctx->Presentation1, 'getSlideAll'))
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_1->Slide as $ctx->Slide): ;
if (null !== ($_tmp_2 = ('sequence-slide' . $ctx->repeat->Slide->number))):  ;
$_tmp_2 = ' class="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<li<?php echo $_tmp_2 ?>
>
							<?php /* tag "div" from line 16 */; ?>
<div class="sequencebg">
								<?php 
/* tag "img" from line 17 */ ;
if (null !== ($_tmp_3 = ($ctx->path($ctx->Slide, 'getURL')))):  ;
$_tmp_3 = ' src="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
if (null !== ($_tmp_4 = ('sequence-slide-' . $ctx->repeat->Slide->number))):  ;
$_tmp_4 = ' alt="'.phptal_escape($_tmp_4).'"' ;
else:  ;
$_tmp_4 = '' ;
endif ;
?>
<img class="sequencebg-image"<?php echo $_tmp_3 ?>
<?php echo $_tmp_4 ?>
/>
							</div>
							<?php /* tag "div" from line 19 */; ?>
<div class="sequence-container container"><?php echo phptal_tostring($ctx->path($ctx->Slide, 'getNote')); ?>
</div>
						</li><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

					</ul>
					<?php /* tag "ul" from line 22 */; ?>
<ul class="sequence-pagination">
						<?php 
/* tag "li" from line 23 */ ;
$_tmp_3 = $ctx->repeat ;
$_tmp_3->Slide = new PHPTAL_RepeatController($ctx->path($ctx->Presentation1, 'getSlideAll'))
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_3->Slide as $ctx->Slide): ;
?>
<li><?php echo phptal_escape('Frame ' . $ctx->repeat->Slide->number); ?>
</li><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

					</ul>
				</div>
				<?php /* tag "div" from line 26 */; ?>
<div class="md-margin2x"></div>
				<?php /* tag "div" from line 27 */; ?>
<div class="container">
					<?php /* tag "div" from line 28 */; ?>
<div class="row">
						<?php /* tag "div" from line 29 */; ?>
<div class="col-md-12">
							<?php /* tag "div" from line 30 */; ?>
<div class="row">
								<?php /* tag "div" from line 31 */; ?>
<div class="col-md-9 col-sm-8 col-xs-12 main-content">
									<?php /* tag "header" from line 32 */; ?>
<header class="content-title"><?php /* tag "h2" from line 32 */; ?>
<h2 class="title">MENU MÓN</h2></header>
									<?php /* tag "div" from line 33 */; ?>
<div id="products-tabs-content" class="row tab-content">
										<?php /* tag "div" from line 34 */; ?>
<div class="tab-pane active" id="all">
											<?php 
/* tag "div" from line 35 */ ;
$_tmp_4 = $ctx->repeat ;
$_tmp_4->Product = new PHPTAL_RepeatController($ctx->ProductAll)
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_4->Product as $ctx->Product): ;
?>
<div class="col-md-4 col-sm-6 col-xs-12">
												<?php 
/* tag "div" from line 36 */ ;
if ($ctx->path($ctx->Product, 'getInfo')):  ;
?>
<div class="item">
													<?php /* tag "div" from line 37 */; ?>
<div class="item-image-container">
														<?php /* tag "figure" from line 38 */; ?>
<figure>
															<?php 
/* tag "a" from line 39 */ ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->Product, 'getURLView')))):  ;
$_tmp_2 = ' href="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a<?php echo $_tmp_2 ?>
>
																<?php 
/* tag "img" from line 40 */ ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->Product, 'getInfo/getImage1')))):  ;
$_tmp_1 = ' src="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<img class="item-image"<?php echo $_tmp_1 ?>
/>
																<?php 
/* tag "img" from line 41 */ ;
if (null !== ($_tmp_3 = ($ctx->path($ctx->Product, 'getInfo/getImage2')))):  ;
$_tmp_3 = ' src="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<img class="item-image-hover"<?php echo $_tmp_3 ?>
/>
															</a>
														</figure>
														<?php 
/* tag "div" from line 44 */ ;
if ($ctx->path($ctx->Product, 'getPrice2')):  ;
?>
<div class="item-price-container">
															<?php /* tag "span" from line 45 */; ?>
<span class="item-price"><?php echo phptal_escape($ctx->path($ctx->Product, 'getPrice2Print')); ?>
</span>
														</div><?php endif; ?>

														<?php /* tag "span" from line 47 */; ?>
<span class="new-rect">HOT</span>
													</div>
													<?php /* tag "div" from line 49 */; ?>
<div class="item-meta-container">
														<?php /* tag "div" from line 50 */; ?>
<div class="ratings-container">
															<?php /* tag "div" from line 51 */; ?>
<div class="ratings">
																<?php /* tag "div" from line 52 */; ?>
<div class="ratings-result" data-result="100"></div>
															</div>
															<?php /* tag "span" from line 54 */; ?>
<span class="ratings-amount">1 đánh giá</span>
														</div>
														<?php /* tag "h3" from line 56 */; ?>
<h3 class="item-name"><?php 
/* tag "a" from line 56 */ ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->Product, 'getURLView')))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a<?php echo $_tmp_1 ?>
><?php echo phptal_escape($ctx->path($ctx->Product, 'getName')); ?>
</a></h3>
														<?php /* tag "div" from line 57 */; ?>
<div class="item-action">
															<?php /* tag "div" from line 58 */; ?>
<div class="item-add-btn">
																<?php 
/* tag "span" from line 65 */ ;
if (null !== ($_tmp_3 = ($ctx->path($ctx->Product, 'getId')))):  ;
$_tmp_3 = ' id="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->Product, 'getName')))):  ;
$_tmp_2 = ' name="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->Product, 'getPrice2')))):  ;
$_tmp_1 = ' price="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
if (null !== ($_tmp_5 = ($ctx->path($ctx->Product, 'getInfo/getImage1')))):  ;
$_tmp_5 = ' image="'.phptal_escape($_tmp_5).'"' ;
else:  ;
$_tmp_5 = '' ;
endif ;
?>
<span class="icon-cart-text" style="cursor:pointer"<?php echo $_tmp_3 ?>
<?php echo $_tmp_2 ?>
<?php echo $_tmp_1 ?>
<?php echo $_tmp_5 ?>
>
																	Chi tiết
																</span>
															</div>															
														</div>
													</div>
												</div><?php endif; ?>

											</div><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

										</div>
									</div>
									
									<?php /* tag "div" from line 76 */; ?>
<div class="purchased-items-container carousel-wrapper">
										<?php /* tag "header" from line 77 */; ?>
<header class="content-title"><?php /* tag "div" from line 77 */; ?>
<div class="title-bg"> <?php /* tag "h2" from line 77 */; ?>
<h2 class="title">ẢNH MỚI NHẤT</h2></div></header>
										<?php /* tag "div" from line 78 */; ?>
<div class="carousel-controls">
											<?php /* tag "div" from line 79 */; ?>
<div id="purchased-items-slider-prev" class="carousel-btn carousel-btn-prev"></div>
											<?php /* tag "div" from line 80 */; ?>
<div id="purchased-items-slider-next" class="carousel-btn carousel-btn-next carousel-space"></div>
										</div>
										<?php /* tag "div" from line 82 */; ?>
<div class="purchased-items-slider owl-carousel">
											<?php 
/* tag "div" from line 83 */ ;
$_tmp_3 = $ctx->repeat ;
$_tmp_3->Album = new PHPTAL_RepeatController($ctx->LastestAlbumAll)
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_3->Album as $ctx->Album): ;
?>
<div class="item">
												<?php /* tag "div" from line 84 */; ?>
<div class="item-image-container">
													<?php /* tag "figure" from line 85 */; ?>
<figure>												
														<?php 
/* tag "a" from line 86 */ ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->Album, 'getURLView')))):  ;
$_tmp_2 = ' href="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a<?php echo $_tmp_2 ?>
>
															<?php 
/* tag "img" from line 87 */ ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->Album, 'getImage')))):  ;
$_tmp_1 = ' src="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<img class="item-image"<?php echo $_tmp_1 ?>
/>
															<?php 
/* tag "img" from line 88 */ ;
if (null !== ($_tmp_5 = ($ctx->path($ctx->Album, 'getImage')))):  ;
$_tmp_5 = ' src="'.phptal_escape($_tmp_5).'"' ;
else:  ;
$_tmp_5 = '' ;
endif ;
?>
<img class="item-image-hover"<?php echo $_tmp_5 ?>
/>
														</a>
													</figure>													
												</div>
												<?php /* tag "div" from line 92 */; ?>
<div class="item-meta-container">													
													<?php /* tag "h3" from line 93 */; ?>
<h3 class="item-name"><?php 
/* tag "a" from line 93 */ ;
if (null !== ($_tmp_4 = ($ctx->path($ctx->Album, 'getURLView')))):  ;
$_tmp_4 = ' href="'.phptal_escape($_tmp_4).'"' ;
else:  ;
$_tmp_4 = '' ;
endif ;
?>
<a<?php echo $_tmp_4 ?>
><?php echo phptal_escape($ctx->path($ctx->Album, 'getName')); ?>
</a></h3>													
												</div>
											</div><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

										</div>
									</div>
									
									<?php /* tag "div" from line 99 */; ?>
<div class="purchased-items-container carousel-wrapper">
										<?php /* tag "header" from line 100 */; ?>
<header class="content-title"><?php /* tag "div" from line 100 */; ?>
<div class="title-bg"> <?php /* tag "h2" from line 100 */; ?>
<h2 class="title">VIDEO MỚI NHẤT</h2></div></header>
										<?php /* tag "div" from line 101 */; ?>
<div class="carousel-controls">
											<?php /* tag "div" from line 102 */; ?>
<div id="purchased-items-slider-prev" class="carousel-btn carousel-btn-prev"></div>
											<?php /* tag "div" from line 103 */; ?>
<div id="purchased-items-slider-next" class="carousel-btn carousel-btn-next carousel-space"></div>
										</div>
										<?php /* tag "div" from line 105 */; ?>
<div class="purchased-items-slider owl-carousel">
											<?php 
/* tag "div" from line 106 */ ;
$_tmp_1 = $ctx->repeat ;
$_tmp_1->Video = new PHPTAL_RepeatController($ctx->LastestVideoAll)
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_1->Video as $ctx->Video): ;
?>
<div class="item">
												<?php /* tag "div" from line 107 */; ?>
<div class="item-image-container">
													<?php /* tag "figure" from line 108 */; ?>
<figure>												
														<?php 
/* tag "a" from line 109 */ ;
if (null !== ($_tmp_5 = ($ctx->path($ctx->Video, 'getURLView')))):  ;
$_tmp_5 = ' href="'.phptal_escape($_tmp_5).'"' ;
else:  ;
$_tmp_5 = '' ;
endif ;
?>
<a<?php echo $_tmp_5 ?>
>
															<?php 
/* tag "img" from line 110 */ ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->Video, 'getImage')))):  ;
$_tmp_2 = ' src="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<img class="item-image"<?php echo $_tmp_2 ?>
/>
															<?php 
/* tag "img" from line 111 */ ;
if (null !== ($_tmp_4 = ($ctx->path($ctx->Video, 'getImage')))):  ;
$_tmp_4 = ' src="'.phptal_escape($_tmp_4).'"' ;
else:  ;
$_tmp_4 = '' ;
endif ;
?>
<img class="item-image-hover"<?php echo $_tmp_4 ?>
/>
														</a>
													</figure>													
												</div>
												<?php /* tag "div" from line 115 */; ?>
<div class="item-meta-container">													
													<?php /* tag "h3" from line 116 */; ?>
<h3 class="item-name"><?php 
/* tag "a" from line 116 */ ;
if (null !== ($_tmp_3 = ($ctx->path($ctx->Video, 'getURLView')))):  ;
$_tmp_3 = ' href="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<a<?php echo $_tmp_3 ?>
><?php echo phptal_escape($ctx->path($ctx->Video, 'getName')); ?>
</a></h3>
												</div>
											</div><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

										</div>
									</div>									
								</div>

								<?php /* tag "div" from line 123 */; ?>
<div class="col-md-3 col-sm-4 col-xs-12 sidebar">
									<?php 
/* tag "div" from line 124 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mFront.xhtml/Subscribe', $_thistpl) ;
$ctx->popSlots() ;
?>

									<?php 
/* tag "div" from line 125 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mFront.xhtml/Testmonials', $_thistpl) ;
$ctx->popSlots() ;
?>

									<?php 
/* tag "div" from line 126 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mFront.xhtml/LastestPost', $_thistpl) ;
$ctx->popSlots() ;
?>

								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<?php 
/* tag "div" from line 133 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mFront.xhtml/Footer', $_thistpl) ;
$ctx->popSlots() ;
?>

		</div><!-- End #wrapper -->		
		<?php 
/* tag "div" from line 135 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mFront.xhtml/IncludeJS', $_thistpl) ;
$ctx->popSlots() ;
?>

		<?php /* tag "script" from line 136 */; ?>
<script>
			$(function() {
				// Sequence.js Slider Plugin
				var options = {
					nextButton: true,
					prevButton: true,
					pagination:true,
					autoPlay: true,
					autoPlayDelay: 8500,
					pauseOnHover: true,
					preloader: true,
					theme: 'slide',
					speed: 700,
					animateStartingFrameIn: true
				},
				homeSlider = $('#slider-sequence').sequence(options).data("sequence");
				
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

Generated by PHPTAL from G:\AppsWeb\cmsA\www.amthuclangsen.com\mvc\templates\FHome.html (edit that file instead) */; ?>