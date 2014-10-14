<?php 
function tpl_5432bbfc_FProduct__jVLqkMAYAuntkz5VvKOBDA(PHPTAL $tpl, PHPTAL_Context $ctx) {
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
				<?php 
/* tag "div" from line 11 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mFront.xhtml/LocationBar', $_thistpl) ;
$ctx->popSlots() ;
?>
				
				<?php /* tag "div" from line 12 */; ?>
<div class="container">
					<?php /* tag "div" from line 13 */; ?>
<div class="row">
						<?php /* tag "div" from line 14 */; ?>
<div class="col-md-12">
							<?php /* tag "div" from line 15 */; ?>
<div class="row">
								<?php 
/* tag "div" from line 16 */ ;
if (($ctx->Product->getImageAll()->count() > 0) ? true:false):  ;
?>
<div class="col-md-6 col-sm-12 col-xs-12 product-viewer clearfix">
									<?php /* tag "div" from line 17 */; ?>
<div id="product-image-carousel-container">
										<?php /* tag "ul" from line 18 */; ?>
<ul id="product-carousel" class="celastislide-list">
											<?php /* tag "li" from line 19 */; ?>
<li class="active-slide">
												<?php 
/* tag "a" from line 20 */ ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->Product, 'getImageAll/current/getURL')))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a data-rel="prettyPhoto"<?php echo $_tmp_1 ?>
>
													<?php 
/* tag "img" from line 21 */ ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->Product, 'getImageAll/current/getURL')))):  ;
$_tmp_2 = ' src="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<img alt="Phone photo 1"<?php echo $_tmp_2 ?>
/>
												</a>
											</li>
											<?php 
/* tag "li" from line 24 */ ;
$_tmp_2 = $ctx->repeat ;
$_tmp_2->Image = new PHPTAL_RepeatController($ctx->path($ctx->Product, 'getImageAll'))
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_2->Image as $ctx->Image): ;
?>
<li>
												<?php 
/* tag "a" from line 25 */ ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->Image, 'getURL')))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a data-rel="prettyPhoto"<?php echo $_tmp_1 ?>
>
													<?php 
/* tag "img" from line 26 */ ;
if (null !== ($_tmp_3 = ($ctx->path($ctx->Image, 'getURL')))):  ;
$_tmp_3 = ' src="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<img<?php echo $_tmp_3 ?>
/>
												</a>
											</li><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

										</ul>
									</div>
									<?php /* tag "div" from line 31 */; ?>
<div id="product-image-container">
										<?php /* tag "figure" from line 32 */; ?>
<figure>
											<?php 
/* tag "img" from line 33 */ ;
if (null !== ($_tmp_3 = ($ctx->path($ctx->Product, 'getImageAll/current/getURL')))):  ;
$_tmp_3 = ' src="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->Product, 'getImageAll/current/getURL')))):  ;
$_tmp_1 = ' data-big="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<img alt="Product Big image" id="product-image"<?php echo $_tmp_3 ?>
<?php echo $_tmp_1 ?>
/>
											<?php 
/* tag "figcaption" from line 34 */ ;
if ($ctx->path($ctx->Product, 'getPrice2')):  ;
?>
<figcaption class="item-price-container">
												<?php /* tag "span" from line 35 */; ?>
<span class="item-price" style="font-size:80%"><?php echo phptal_escape($ctx->path($ctx->Product, 'getPrice2Print')); ?>
</span>
											</figcaption><?php endif; ?>

										</figure>
									</div>
								</div><?php endif; ?>

								<?php /* tag "div" from line 40 */; ?>
<div class="col-md-6 col-sm-12 col-xs-12 product">
									<?php /* tag "div" from line 41 */; ?>
<div class="lg-margin visible-sm visible-xs"></div><!-- Space -->
									<?php /* tag "h1" from line 42 */; ?>
<h1 class="product-name"><?php echo phptal_escape($ctx->path($ctx->Product, 'getName')); ?>
</h1>
									<?php /* tag "div" from line 43 */; ?>
<div class="ratings-container">
										<?php /* tag "div" from line 44 */; ?>
<div class="ratings separator">
											<?php /* tag "div" from line 45 */; ?>
<div class="ratings-result" data-result="100"></div>
										</div>
									</div>									
									<?php /* tag "hr" from line 48 */; ?>
<hr/>
									<?php /* tag "div" from line 49 */; ?>
<div class="product-add clearfix">
										<?php /* tag "div" from line 50 */; ?>
<div class="custom-quantity-input">
											<?php /* tag "input" from line 51 */; ?>
<input type="text" name="quantity" value="1"/>
											<?php /* tag "a" from line 52 */; ?>
<a href="#" onclick="return false;" class="quantity-btn quantity-input-up"><?php /* tag "i" from line 52 */; ?>
<i class="fa fa-angle-up"></i></a>
											<?php /* tag "a" from line 53 */; ?>
<a href="#" onclick="return false;" class="quantity-btn quantity-input-down"><?php /* tag "i" from line 53 */; ?>
<i class="fa fa-angle-down"></i></a>
										</div>
										<?php 
/* tag "button" from line 61 */ ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->Product, 'getId')))):  ;
$_tmp_2 = ' id="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
if (null !== ($_tmp_3 = ($ctx->path($ctx->Product, 'getName')))):  ;
$_tmp_3 = ' name="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->Product, 'getPrice2')))):  ;
$_tmp_1 = ' price="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
if (null !== ($_tmp_4 = ($ctx->path($ctx->Product, 'getInfo/getImage1')))):  ;
$_tmp_4 = ' image="'.phptal_escape($_tmp_4).'"' ;
else:  ;
$_tmp_4 = '' ;
endif ;
?>
<button class="btn btn-custom-2 icon-cart-text"<?php echo $_tmp_2 ?>
<?php echo $_tmp_3 ?>
<?php echo $_tmp_1 ?>
<?php echo $_tmp_4 ?>
>
											THÊM VÀO GIỎ
										</button>
									</div><!-- .product-add -->
									<?php /* tag "div" from line 65 */; ?>
<div class="md-margin"></div><!-- Space -->
									<?php /* tag "div" from line 66 */; ?>
<div class="product-extra clearfix">
										<?php /* tag "div" from line 67 */; ?>
<div class="product-extra-box-container clearfix">
											<?php /* tag "div" from line 68 */; ?>
<div class="item-action-inner">
												<?php /* tag "a" from line 69 */; ?>
<a href="#" class="icon-button icon-like">Ưa thích</a>
												<?php /* tag "a" from line 70 */; ?>
<a href="#" class="icon-button icon-compare">Thanh toán</a>
											</div><!-- End .item-action-inner -->
										</div>
										<?php /* tag "div" from line 73 */; ?>
<div class="md-margin visible-xs"></div>
										<?php /* tag "div" from line 74 */; ?>
<div class="share-button-group">																				
											<?php 
/* tag "div" from line 75 */ ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->Product, 'getURLViewFull')))):  ;
$_tmp_2 = ' data-href="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<div class="fb-share-button" data-type="button_count"<?php echo $_tmp_2 ?>
></div>
										</div>
									</div>
								</div><!-- End .col-md-6 -->
							</div><!-- End .row -->
							<?php /* tag "div" from line 80 */; ?>
<div class="lg-margin2x"></div><!-- End .space -->
							<?php /* tag "div" from line 81 */; ?>
<div class="row">
								<?php /* tag "div" from line 82 */; ?>
<div class="col-md-12 col-sm-12 col-xs-12">
									<?php /* tag "div" from line 83 */; ?>
<div class="tab-container left product-detail-tab clearfix">
										<?php /* tag "ul" from line 84 */; ?>
<ul class="nav-tabs">
											<?php /* tag "li" from line 85 */; ?>
<li class="active"><?php /* tag "a" from line 85 */; ?>
<a href="#overview" data-toggle="tab">Giới thiệu</a></li>											
											<?php /* tag "li" from line 86 */; ?>
<li><?php /* tag "a" from line 86 */; ?>
<a href="#facebook" data-toggle="tab">Đánh giá</a></li>
										</ul>
										<?php /* tag "div" from line 88 */; ?>
<div class="tab-content clearfix">
											<?php /* tag "div" from line 89 */; ?>
<div class="tab-pane active" id="overview">
												<?php /* tag "p" from line 90 */; ?>
<p><?php echo phptal_tostring($ctx->path($ctx->Product, 'getInfo/getInfo')); ?>
</p>
											</div>
											<?php /* tag "div" from line 92 */; ?>
<div class="tab-pane" id="facebook">
												<?php 
/* tag "div" from line 97 */ ;
if (null !== ($_tmp_3 = ($ctx->path($ctx->Product, 'getURLViewFull')))):  ;
$_tmp_3 = ' data-href="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<div class="fb-comments" data-width="780px" data-numposts="12" data-colorscheme="light"<?php echo $_tmp_3 ?>
>
												</div>
											</div>
										</div>
									</div>
									<?php /* tag "div" from line 102 */; ?>
<div class="lg-margin visible-xs"></div>
								</div>
								<?php /* tag "div" from line 104 */; ?>
<div class="lg-margin2x visible-sm visible-xs"></div>
							</div>							
							<?php /* tag "div" from line 106 */; ?>
<div class="lg-margin2x"></div>
							<?php /* tag "div" from line 107 */; ?>
<div class="purchased-items-container carousel-wrapper">
								<?php /* tag "header" from line 108 */; ?>
<header class="content-title">
									<?php /* tag "div" from line 109 */; ?>
<div class="title-bg"> <?php /* tag "h2" from line 109 */; ?>
<h2 class="title">Món cùng mục</h2></div>
								</header>
								<?php /* tag "div" from line 111 */; ?>
<div class="carousel-controls">
									<?php /* tag "div" from line 112 */; ?>
<div id="purchased-items-slider-prev" class="carousel-btn carousel-btn-prev"></div>
									<?php /* tag "div" from line 113 */; ?>
<div id="purchased-items-slider-next" class="carousel-btn carousel-btn-next carousel-space"></div>
								</div><!-- End .carousel-controllers -->
								<?php /* tag "div" from line 115 */; ?>
<div class="purchased-items-slider owl-carousel">
									<?php 
/* tag "div" from line 116 */ ;
$_tmp_1 = $ctx->repeat ;
$_tmp_1->P1 = new PHPTAL_RepeatController($ctx->path($ctx->Category1, 'getProductAll'))
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_1->P1 as $ctx->P1): ;
?>
<div class="item">
										<?php /* tag "div" from line 117 */; ?>
<div class="item-image-container">
											<?php /* tag "figure" from line 118 */; ?>
<figure>												
												<?php 
/* tag "a" from line 119 */ ;
if (null !== ($_tmp_4 = ($ctx->path($ctx->P1, 'getURLView')))):  ;
$_tmp_4 = ' href="'.phptal_escape($_tmp_4).'"' ;
else:  ;
$_tmp_4 = '' ;
endif ;
?>
<a<?php echo $_tmp_4 ?>
>
													<?php 
/* tag "img" from line 120 */ ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->P1, 'getInfo/getImage1')))):  ;
$_tmp_2 = ' src="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<img class="item-image"<?php echo $_tmp_2 ?>
/>
													<?php 
/* tag "img" from line 121 */ ;
if (null !== ($_tmp_3 = ($ctx->path($ctx->P1, 'getInfo/getImage2')))):  ;
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
/* tag "div" from line 124 */ ;
if ($ctx->path($ctx->P1, 'getPrice2')):  ;
?>
<div class="item-price-container">
												<?php /* tag "span" from line 125 */; ?>
<span class="item-price"><?php echo phptal_escape($ctx->path($ctx->P1, 'getPrice2Print')); ?>
</span>
											</div><?php endif; ?>
											
										</div>
										<?php /* tag "div" from line 128 */; ?>
<div class="item-meta-container">
											<?php /* tag "div" from line 129 */; ?>
<div class="ratings-container">
												<?php /* tag "div" from line 130 */; ?>
<div class="ratings">
													<?php /* tag "div" from line 131 */; ?>
<div class="ratings-result" data-result="100"></div>
												</div>												
											</div>
											<?php /* tag "h3" from line 134 */; ?>
<h3 class="item-name"><?php /* tag "a" from line 134 */; ?>
<a href="product.html"><?php echo phptal_escape($ctx->path($ctx->P1, 'getName')); ?>
</a></h3>
											<?php /* tag "div" from line 135 */; ?>
<div class="item-action">
												<?php 
/* tag "a" from line 136 */ ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->P1, 'getURLView')))):  ;
$_tmp_2 = ' href="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a class="item-add-btn"<?php echo $_tmp_2 ?>
>
													<?php /* tag "span" from line 137 */; ?>
<span class="icon-cart-text">Xem chi tiết</span>
												</a>												
											</div>
										</div>
									</div><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<?php 
/* tag "div" from line 148 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mFront.xhtml/Footer', $_thistpl) ;
$ctx->popSlots() ;
?>

		</div>
		<?php 
/* tag "div" from line 150 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mFront.xhtml/IncludeJS', $_thistpl) ;
$ctx->popSlots() ;
?>

		<?php /* tag "script" from line 151 */; ?>
<script>
			$(function() {
				var carouselContainer = $('#product-carousel'),
					productImg =  $('#product-image');
				carouselContainer.elastislide({
					orientation : 'vertical',
					minItems : 4
				});
				productImg.mlens({
					imgSrc: $("#product-image").attr("data-big"),         
					lensShape: "square",
					lensSize: 150,
					borderSize: 4,
					borderColor: "#999",
					borderRadius: 0
				});
				var oldImg = productImg.attr('src');
				carouselContainer.find('li').on('mouseover', function() {
					var newImg = $(this).find('a').attr('href');
					productImg.attr({'src': newImg, 'data-big': newImg}).trigger('imagechanged');
				});
				productImg.on('imagechanged', function() {
					productImg.mlens("update", 0 ,{
						imgSrc: productImg.attr("data-big"),
						lensShape: "square",
						lensSize: 150,
						borderSize: 4,
						borderColor: "#999"
					});
				});
				
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

			});
		</script>
		<?php /* tag "script" from line 202 */; ?>
<script>/*<![CDATA[*/(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1&appId=525611617524479";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		/*]]>*/</script>
	</body>
</html><?php 
/* end */ ;

}

?>
<?php /* 
*** DO NOT EDIT THIS FILE ***

Generated by PHPTAL from G:\AppsWeb\cmsA\www.amthuclangsen.com\mvc\templates\FProduct.html (edit that file instead) */; ?>