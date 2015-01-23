<?php 
function tpl_5495bea6_FHome__nLJfrDQly7J4UBEmvbYD_w(PHPTAL $tpl, PHPTAL_Context $ctx) {
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
/* tag "tal:block" from line 4 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mFront.xhtml/IncludeMETA', $_thistpl) ;
$ctx->popSlots() ;
?>

		<?php 
/* tag "tal:block" from line 5 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mFront.xhtml/IncludeCSS', $_thistpl) ;
$ctx->popSlots() ;
?>

		<?php 
/* tag "tal:block" from line 6 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mFront.xhtml/IncludeJS', $_thistpl) ;
$ctx->popSlots() ;
?>

		<?php /* tag "script" from line 7 */; ?>
<script>			
			$('.carousel .item:first-child').addClass('active');
			if(/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)){
				window.location ="http://m.batdongsancamau.net";
			}
		</script>
	</head>	
	<?php /* tag "body" from line 14 */; ?>
<body>		
		<?php /* tag "div" from line 15 */; ?>
<div class="container">
			<?php 
/* tag "tal:block" from line 16 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mFront.xhtml/DoubleAds', $_thistpl) ;
$ctx->popSlots() ;
?>

			<?php 
/* tag "tal:block" from line 17 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mFront.xhtml/Header', $_thistpl) ;
$ctx->popSlots() ;
?>

			<?php /* tag "div" from line 18 */; ?>
<div class="row">						
				<?php /* tag "div" from line 19 */; ?>
<div class="col-md-9">
					<?php /* tag "div" from line 20 */; ?>
<div class="row">						
						<?php /* tag "div" from line 21 */; ?>
<div class="col-md-7">
							<?php /* tag "div" from line 22 */; ?>
<div id="carousel-top-news" class="carousel slide" data-ride="carousel">
								<?php /* tag "div" from line 23 */; ?>
<div class="carousel-inner" role="listbox">
									<?php 
/* tag "div" from line 24 */ ;
$_tmp_1 = $ctx->repeat ;
$_tmp_1->PT = new PHPTAL_RepeatController($ctx->PostTopAll)
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_1->PT as $ctx->PT): ;
?>
<div class="item">
										<?php 
/* tag "a" from line 25 */ ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->PT, 'getURLRead')))):  ;
$_tmp_2 = ' href="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a<?php echo $_tmp_2 ?>
>
											<?php 
/* tag "img" from line 26 */ ;
if (null !== ($_tmp_3 = ($ctx->path($ctx->PT, 'getPost/getImage')))):  ;
$_tmp_3 = ' src="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
if (null !== ($_tmp_4 = ($ctx->path($ctx->PT, 'getPost/getTitle')))):  ;
$_tmp_4 = ' alt="'.phptal_escape($_tmp_4).'"' ;
else:  ;
$_tmp_4 = '' ;
endif ;
?>
<img<?php echo $_tmp_3 ?>
<?php echo $_tmp_4 ?>
/>
											<?php /* tag "div" from line 27 */; ?>
<div class="carousel-caption"><?php echo phptal_escape($ctx->path($ctx->PT, 'getPost/getTitle')); ?>
</div>
										</a>
									</div><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

								</div>
								<?php /* tag "a" from line 31 */; ?>
<a class="left carousel-control" href="#carousel-top-news" role="button" data-slide="prev">
									<?php /* tag "span" from line 32 */; ?>
<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
									<?php /* tag "span" from line 33 */; ?>
<span class="sr-only">Previous</span>
								</a>
								<?php /* tag "a" from line 35 */; ?>
<a class="right carousel-control" href="#carousel-top-news" role="button" data-slide="next">
									<?php /* tag "span" from line 36 */; ?>
<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
									<?php /* tag "span" from line 37 */; ?>
<span class="sr-only">Next</span>
								</a>
								<?php /* tag "div" from line 39 */; ?>
<div class="news-title"></div>
							</div>
						</div>
						<?php /* tag "div" from line 42 */; ?>
<div class="col-md-5 rspdl">
							<?php /* tag "div" from line 43 */; ?>
<div class="list-group list-group-config">
								<?php /* tag "a" from line 44 */; ?>
<a class="list-group-item active"><?php /* tag "center" from line 44 */; ?>
<center>Tin mới cập nhật</center></a>
								<?php 
/* tag "a" from line 45 */ ;
$_tmp_3 = $ctx->repeat ;
$_tmp_3->PT = new PHPTAL_RepeatController($ctx->PostTopAll)
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_3->PT as $ctx->PT): ;
if (null !== ($_tmp_4 = ($ctx->path($ctx->PT, 'getURLRead')))):  ;
$_tmp_4 = ' href="'.phptal_escape($_tmp_4).'"' ;
else:  ;
$_tmp_4 = '' ;
endif ;
?>
<a class="list-group-item"<?php echo $_tmp_4 ?>
><?php echo phptal_escape($ctx->path($ctx->PT, 'getPost/getTitleReduce')); ?>
</a><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

							</div>
						</div>
					</div>
					<?php 
/* tag "div" from line 49 */ ;
$_tmp_2 = $ctx->repeat ;
$_tmp_2->Category = new PHPTAL_RepeatController($ctx->CategoryAll)
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_2->Category as $ctx->Category): ;
?>
<div class="panel panel-default">
						<?php /* tag "div" from line 50 */; ?>
<div class="panel-heading"><?php /* tag "h3" from line 50 */; ?>
<h3 class="panel-title"><?php echo phptal_escape($ctx->path($ctx->Category, 'getName')); ?>
</h3></div>						
						<?php /* tag "div" from line 51 */; ?>
<div class="panel-body">
							<?php 
/* tag "div" from line 52 */ ;
$_tmp_1 = $ctx->repeat ;
$_tmp_1->Product = new PHPTAL_RepeatController($ctx->path($ctx->Category, 'getTopProductAll'))
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_1->Product as $ctx->Product): ;
?>
<div class="media media-config">
								<?php /* tag "div" from line 53 */; ?>
<div class="media-flag">									
									<?php 
/* tag "div" from line 54 */ ;
if ($ctx->Product->isTimeCategory()==0?true:false):  ;
?>
<div class="flag new-flag"></div><?php endif; ?>

									<!--
									<div class="flag hot-flag"/>
									<div class="flag vip-flag"/>
									!-->
								</div>
								<?php /* tag "div" from line 60 */; ?>
<div class="media-tit">
									<?php 
/* tag "a" from line 61 */ ;
if (null !== ($_tmp_4 = ($ctx->path($ctx->Product, 'getURLView')))):  ;
$_tmp_4 = ' href="'.phptal_escape($_tmp_4).'"' ;
else:  ;
$_tmp_4 = '' ;
endif ;
?>
<a<?php echo $_tmp_4 ?>
>
										<?php /* tag "h4" from line 62 */; ?>
<h4><?php echo phptal_escape($ctx->path($ctx->Product, 'getNameReduce')); ?>
</h4>
									</a>
								</div>
								<?php /* tag "div" from line 65 */; ?>
<div class="media-ctn">
									<?php 
/* tag "a" from line 66 */ ;
if (null !== ($_tmp_3 = ($ctx->path($ctx->Product, 'getURLView')))):  ;
$_tmp_3 = ' href="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<a class="media-left"<?php echo $_tmp_3 ?>
>
										<?php 
/* tag "img" from line 67 */ ;
if (null !== ($_tmp_4 = ($ctx->path($ctx->Product, 'getInfo/getImage')))):  ;
$_tmp_4 = ' src="'.phptal_escape($_tmp_4).'"' ;
else:  ;
$_tmp_4 = '' ;
endif ;
if (null !== ($_tmp_5 = ($ctx->path($ctx->Product, 'getName')))):  ;
$_tmp_5 = ' alt="'.phptal_escape($_tmp_5).'"' ;
else:  ;
$_tmp_5 = '' ;
endif ;
?>
<img width="130" class="img-thumbnail"<?php echo $_tmp_4 ?>
<?php echo $_tmp_5 ?>
/>
									</a>
									<?php /* tag "div" from line 69 */; ?>
<div class="media-body">
										<?php /* tag "p" from line 70 */; ?>
<p style="text-align:justify"><?php echo phptal_tostring($ctx->path($ctx->Product, 'getInfo/getInfoReduce')); ?>
</p>
										<?php /* tag "div" from line 71 */; ?>
<div class="row media-inf">
											<?php /* tag "div" from line 72 */; ?>
<div class="col-md-10" style="padding-left:0;padding-right:0;">
												Giá: <?php /* tag "span" from line 73 */; ?>
<span style="color:#055699;font-weight:bold;"><?php echo phptal_escape($ctx->path($ctx->Product, 'getPricePrint')); ?>
</span> 
												Diện tích: <?php 
/* tag "span" from line 74 */ ;
if ($ctx->path($ctx->Product, 'getInfo')):  ;
?>
<span style="color:#055699;font-weight:bold;"><?php echo phptal_tostring($ctx->path($ctx->Product, 'getInfo/getInfoEx13Print')); ?>
</span><?php endif; ?>

												Quận/Huyện: <?php /* tag "span" from line 75 */; ?>
<span style="color:#055699;font-weight:bold;"><?php echo phptal_escape($ctx->path($ctx->Product, 'getDistrict/getName')); ?>
</span>, <?php /* tag "span" from line 75 */; ?>
<span style="color:#055699;font-weight:bold;"><?php echo phptal_escape($ctx->path($ctx->Product, 'getDistrict/getProvince/getName')); ?>
</span>
											</div>
											<?php /* tag "div" from line 77 */; ?>
<div class="col-md-2" style="text-align:right;padding-left:0;padding-right:0;">
												<?php /* tag "span" from line 78 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Product, 'getDateTimePrint')); ?>
</span>
											</div>
										</div>
									</div>
								</div>
							</div><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

						</div>
					</div><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>
					
				</div>
				<?php /* tag "div" from line 87 */; ?>
<div class="col-md-3 rspdl">
					<?php 
/* tag "tal:block" from line 88 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mFront.xhtml/SearchBox', $_thistpl) ;
$ctx->popSlots() ;
?>

					<?php 
/* tag "div" from line 89 */ ;
$_tmp_4 = $ctx->repeat ;
$_tmp_4->Ads = new PHPTAL_RepeatController($ctx->AdsAll)
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_4->Ads as $ctx->Ads): ;
?>
<div class="panel">
						<?php 
/* tag "a" from line 90 */ ;
if (null !== ($_tmp_5 = ($ctx->path($ctx->Ads, 'getURL')))):  ;
$_tmp_5 = ' href="'.phptal_escape($_tmp_5).'"' ;
else:  ;
$_tmp_5 = '' ;
endif ;
?>
<a target="blank"<?php echo $_tmp_5 ?>
>
							<?php 
/* tag "img" from line 91 */ ;
if (null !== ($_tmp_3 = ($ctx->path($ctx->Ads, 'getPicture')))):  ;
$_tmp_3 = ' src="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<img class="img-thumbnail" width="100%"<?php echo $_tmp_3 ?>
/>
						</a>
					</div><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

				</div>
			</div>
			<?php 
/* tag "tal:block" from line 96 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mFront.xhtml/Footer', $_thistpl) ;
$ctx->popSlots() ;
?>

			<?php /* tag "script" from line 97 */; ?>
<script>			
				$('.carousel .item:first-child').addClass('active');
			</script>
		</div>		
	</body>
</html><?php 
/* end */ ;

}

?>
<?php /* 
*** DO NOT EDIT THIS FILE ***

Generated by PHPTAL from G:\AppsWeb\cmsA\caytretramdot.com_job\mvc\templates\FHome.html (edit that file instead) */; ?>