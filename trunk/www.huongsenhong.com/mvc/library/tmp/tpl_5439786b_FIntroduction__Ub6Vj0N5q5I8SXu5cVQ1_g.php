<?php 
function tpl_5439786b_FIntroduction__Ub6Vj0N5q5I8SXu5cVQ1_g(PHPTAL $tpl, PHPTAL_Context $ctx) {
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
<div class="xs-margin"></div>
							<?php /* tag "div" from line 16 */; ?>
<div class="row">
								<?php /* tag "div" from line 17 */; ?>
<div class="col-md-9 col-sm-8 col-xs-12 articles-container single-post">
									<?php /* tag "article" from line 18 */; ?>
<article class="article">
										<?php /* tag "div" from line 19 */; ?>
<div class="article-meta-date"><?php echo phptal_escape($ctx->path($ctx->Post, 'getTimePrint')); ?>
</div>
										<?php /* tag "h2" from line 20 */; ?>
<h2><?php echo phptal_escape(mb_strtoupper($ctx->Post->getTitle(),'UTF8')); ?>
</h2>
										<?php /* tag "div" from line 21 */; ?>
<div class="article-meta-container clearfix">
											<?php /* tag "div" from line 22 */; ?>
<div class="article-meta-more">
												<?php /* tag "a" from line 23 */; ?>
<a href="#"><?php /* tag "span" from line 23 */; ?>
<span class="separator"><?php /* tag "i" from line 23 */; ?>
<i class="fa fa-user"></i></span> <?php /* tag "span" from line 23 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Post, 'getAuthor')); ?>
</span></a>
												<?php /* tag "div" from line 24 */; ?>
<div class="share-button-group">										
													<?php 
/* tag "div" from line 25 */ ;
if (null !== ($_tmp_1 = ('http://amthuclangsen.com/gioi-thieu'))):  ;
$_tmp_1 = ' data-href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<div class="fb-share-button" data-type="button_count"<?php echo $_tmp_1 ?>
></div>
												</div>
											</div>
											<?php /* tag "div" from line 28 */; ?>
<div class="article-meta-view">
												<?php /* tag "span" from line 29 */; ?>
<span class="separator"><?php /* tag "i" from line 29 */; ?>
<i class="fa fa-eye "></i></span><?php /* tag "span" from line 29 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Post, 'getViewed')); ?>
</span>
												<?php 
/* tag "a" from line 30 */ ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->Post, 'getId')))):  ;
$_tmp_1 = ' data-id="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a class="Liked Post"<?php echo $_tmp_1 ?>
>
													<?php /* tag "span" from line 31 */; ?>
<span class="separator"><?php /* tag "i" from line 31 */; ?>
<i class="fa fa-heart"></i></span><?php /* tag "span" from line 31 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Post, 'getLiked')); ?>
</span>
												</a>
											</div>
										</div>
										<?php /* tag "div" from line 35 */; ?>
<div class="article-content-container"><?php echo phptal_tostring($ctx->path($ctx->Post, 'getContent')); ?>
</div>
									</article>									
								</div>
								<?php /* tag "aside" from line 38 */; ?>
<aside class="col-md-3 col-sm-4 col-xs-12 sidebar">									
									<?php 
/* tag "div" from line 39 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mFront.xhtml/Subscribe', $_thistpl) ;
$ctx->popSlots() ;
?>

									<?php 
/* tag "div" from line 40 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mFront.xhtml/Testmonials', $_thistpl) ;
$ctx->popSlots() ;
?>

									<?php 
/* tag "div" from line 41 */ ;
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
/* tag "div" from line 48 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mFront.xhtml/Footer', $_thistpl) ;
$ctx->popSlots() ;
?>

		</div>
		<?php 
/* tag "div" from line 50 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mFront.xhtml/IncludeJS', $_thistpl) ;
$ctx->popSlots() ;
?>

		<?php /* tag "script" from line 51 */; ?>
<script type="text/javascript">
		/*<![CDATA[*/
			$('.Liked').click(function(){
				var Data = [];								
				var Id 	= $(this).attr('data-id');
								
				var URL = "/object/liked/Post/"+Id;
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
		<?php /* tag "script" from line 70 */; ?>
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

Generated by PHPTAL from G:\AppsWeb\cmsA\www.huongsenhong.com\mvc\templates\FIntroduction.html (edit that file instead) */; ?>