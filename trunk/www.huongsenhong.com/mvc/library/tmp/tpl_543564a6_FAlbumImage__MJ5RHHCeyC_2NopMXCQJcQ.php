<?php 
function tpl_543564a6_FAlbumImage__MJ5RHHCeyC_2NopMXCQJcQ(PHPTAL $tpl, PHPTAL_Context $ctx) {
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
<div class="md-margin">
										<?php /* tag "span" from line 18 */; ?>
<span>											
											<?php 
/* tag "a" from line 19 */ ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->Album, 'getId')))):  ;
$_tmp_1 = ' data-id="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a class="Liked Album"<?php echo $_tmp_1 ?>
>
												<?php /* tag "span" from line 20 */; ?>
<span id="LikedView"><?php echo phptal_escape($ctx->path($ctx->Album, 'getLiked')); ?>
</span> Like
											</a>
											<?php /* tag "span" from line 22 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Album, 'getViewed')); ?>
</span> Xem
										</span>
									</div>
									<?php /* tag "div" from line 25 */; ?>
<div class="category-item-container category-list-container">
										<?php 
/* tag "div" from line 26 */ ;
$_tmp_1 = $ctx->repeat ;
$_tmp_1->Image = new PHPTAL_RepeatController($ctx->path($ctx->Album, 'getImageAll'))
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_1->Image as $ctx->Image): ;
?>
<div class="item item-list clearfix">
											<?php /* tag "div" from line 27 */; ?>
<div class="item-image-container">
												<?php /* tag "figure" from line 28 */; ?>
<figure>
													<?php 
/* tag "a" from line 29 */ ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->Album, 'getURLView')))):  ;
$_tmp_2 = ' href="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a<?php echo $_tmp_2 ?>
>
														<?php 
/* tag "img" from line 30 */ ;
if (null !== ($_tmp_3 = ($ctx->path($ctx->Image, 'getURL')))):  ;
$_tmp_3 = ' src="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<img alt="item1" class="item-image"<?php echo $_tmp_3 ?>
/>
														<?php 
/* tag "img" from line 31 */ ;
if (null !== ($_tmp_3 = ($ctx->path($ctx->Image, 'getURL')))):  ;
$_tmp_3 = ' src="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<img alt="item1  Hover" class="item-image-hover"<?php echo $_tmp_3 ?>
/>
													</a>
												</figure>
											</div>
											<?php /* tag "div" from line 35 */; ?>
<div class="item-meta-container">
												<?php /* tag "h3" from line 36 */; ?>
<h3 class="item-name">
													<?php 
/* tag "a" from line 37 */ ;
if (null !== ($_tmp_3 = ($ctx->path($ctx->Album, 'getURLView')))):  ;
$_tmp_3 = ' href="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<a<?php echo $_tmp_3 ?>
>
														<?php /* tag "span" from line 38 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Image, 'getName')); ?>
</span>
													</a>
												</h3>												
												<?php /* tag "p" from line 41 */; ?>
<p><?php echo phptal_tostring($ctx->path($ctx->Image, 'getName')); ?>
</p>
											</div>
										</div><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

									</div>
								</div>
								<?php /* tag "aside" from line 46 */; ?>
<aside class="col-md-3 col-sm-4 col-xs-12 sidebar">
									<?php 
/* tag "div" from line 47 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mFront.xhtml/Subscribe', $_thistpl) ;
$ctx->popSlots() ;
?>

									<?php 
/* tag "div" from line 48 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mFront.xhtml/Testmonials', $_thistpl) ;
$ctx->popSlots() ;
?>

									<?php 
/* tag "div" from line 49 */ ;
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
/* tag "div" from line 56 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mFront.xhtml/Footer', $_thistpl) ;
$ctx->popSlots() ;
?>

		</div>
		<?php 
/* tag "div" from line 58 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mFront.xhtml/IncludeJS', $_thistpl) ;
$ctx->popSlots() ;
?>

		<?php /* tag "script" from line 59 */; ?>
<script type="text/javascript">
		/*<![CDATA[*/
			$('.Liked').click(function(){
				var Data = [];								
				var Id 	= $(this).attr('data-id');
								
				var URL = "/object/liked/Album/"+Id;
				$.ajax({
					type: "POST",
					data: {Data:Data},
					url: URL,
					success: function(msg){
						location.reload();						
					}
				});
				return false;
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

Generated by PHPTAL from G:\AppsWeb\cmsA\www.huongsenhong.com\mvc\templates\FAlbumImage.html (edit that file instead) */; ?>