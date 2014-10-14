<?php 
function tpl_54356a72_FDealer__D9fKocCxQhzhxjVznl4Rgg(PHPTAL $tpl, PHPTAL_Context $ctx) {
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
								<?php /* tag "div" from line 16 */; ?>
<div class="col-md-9 col-sm-8 col-xs-12 main-content">
									<?php /* tag "div" from line 17 */; ?>
<div class="category-toolbar clearfix">										
										<?php /* tag "div" from line 18 */; ?>
<div class="toolbox-pagination clearfix">
											<?php /* tag "ul" from line 19 */; ?>
<ul class="pagination">
												<?php 
/* tag "li" from line 20 */ ;
$_tmp_1 = $ctx->repeat ;
$_tmp_1->P = new PHPTAL_RepeatController($ctx->path($ctx->PN, 'getPages'))
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_1->P as $ctx->P): ;
if (null !== ($_tmp_2 = ($ctx->Page==$ctx->P->getId()?'active':'disable'))):  ;
$_tmp_2 = ' class="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<li<?php echo $_tmp_2 ?>
>
													<?php 
/* tag "a" from line 21 */ ;
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
									<?php /* tag "div" from line 26 */; ?>
<div class="md-margin"></div><!-- .space -->
									<?php /* tag "div" from line 27 */; ?>
<div class="category-item-container category-list-container">
										<?php 
/* tag "div" from line 28 */ ;
$_tmp_3 = $ctx->repeat ;
$_tmp_3->PT = new PHPTAL_RepeatController($ctx->PTAll)
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_3->PT as $ctx->PT): ;
?>
<div class="item item-list clearfix">
											<?php /* tag "div" from line 29 */; ?>
<div class="item-image-container">
												<?php /* tag "figure" from line 30 */; ?>
<figure>
													<?php 
/* tag "a" from line 31 */ ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->PT, 'getURLRead')))):  ;
$_tmp_2 = ' href="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a<?php echo $_tmp_2 ?>
>
														<?php 
/* tag "img" from line 32 */ ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->PT, 'getPost/getImage')))):  ;
$_tmp_1 = ' src="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<img alt="item1" class="item-image"<?php echo $_tmp_1 ?>
/>
														<?php 
/* tag "img" from line 33 */ ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->PT, 'getPost/getImage')))):  ;
$_tmp_1 = ' src="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<img alt="item1  Hover" class="item-image-hover"<?php echo $_tmp_1 ?>
/>
													</a>
												</figure>
											</div>
											<?php /* tag "div" from line 37 */; ?>
<div class="item-meta-container">
												<?php /* tag "h3" from line 38 */; ?>
<h3 class="item-name">
													<?php 
/* tag "a" from line 39 */ ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->PT, 'getURLRead')))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a<?php echo $_tmp_1 ?>
>
														<?php /* tag "span" from line 40 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->PT, 'getPost/getTitle')); ?>
</span>
													</a>
												</h3>
												<?php /* tag "div" from line 43 */; ?>
<div class="ratings-container">
													<?php /* tag "div" from line 44 */; ?>
<div class="ratings">
														<?php /* tag "div" from line 45 */; ?>
<div class="ratings-result" data-result="70"></div>
													</div>
													<?php /* tag "span" from line 47 */; ?>
<span class="ratings-amount">
														1 đánh giá
													</span>
												</div>
												<?php /* tag "p" from line 51 */; ?>
<p><?php echo phptal_tostring($ctx->path($ctx->PT, 'getPost/getContentReduce')); ?>
</p>
											</div>
										</div><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

									</div>
								</div>
								<?php /* tag "aside" from line 56 */; ?>
<aside class="col-md-3 col-sm-4 col-xs-12 sidebar">
									<?php 
/* tag "div" from line 57 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mFront.xhtml/Subscribe', $_thistpl) ;
$ctx->popSlots() ;
?>

									<?php 
/* tag "div" from line 58 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mFront.xhtml/Testmonials', $_thistpl) ;
$ctx->popSlots() ;
?>

									<?php 
/* tag "div" from line 59 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mFront.xhtml/LastestPost', $_thistpl) ;
$ctx->popSlots() ;
?>

								</aside>
							</div>
						</div>
					</div>
				</div>
			</section>
			<?php 
/* tag "div" from line 66 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mFront.xhtml/Footer', $_thistpl) ;
$ctx->popSlots() ;
?>

		</div>
		<?php 
/* tag "div" from line 68 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mFront.xhtml/IncludeJS', $_thistpl) ;
$ctx->popSlots() ;
?>
		
	</body>
</html><?php 
/* end */ ;

}

?>
<?php /* 
*** DO NOT EDIT THIS FILE ***

Generated by PHPTAL from G:\AppsWeb\cmsA\www.amthuclangsen.com\mvc\templates\FDealer.html (edit that file instead) */; ?>