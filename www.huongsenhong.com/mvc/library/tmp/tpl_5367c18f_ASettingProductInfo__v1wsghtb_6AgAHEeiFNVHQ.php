<?php 
function tpl_5367c18f_ASettingProductInfo__v1wsghtb_6AgAHEeiFNVHQ(PHPTAL $tpl, PHPTAL_Context $ctx) {
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
<body>
		<?php 
/* tag "div" from line 9 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/Header', $_thistpl) ;
$ctx->popSlots() ;
?>
		
		<?php /* tag "div" from line 10 */; ?>
<div id="content">
			<?php 
/* tag "div" from line 11 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/ContentHeader', $_thistpl) ;
$ctx->popSlots() ;
?>

			<?php 
/* tag "div" from line 12 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/Locationbar', $_thistpl) ;
$ctx->popSlots() ;
?>

			<?php /* tag "div" from line 13 */; ?>
<div class="row">
				<?php /* tag "div" from line 14 */; ?>
<div class="col-12">					
					<?php /* tag "div" from line 15 */; ?>
<div class="widget-box">
						<?php /* tag "div" from line 16 */; ?>
<div class="widget-content nopadding">
							<?php 
/* tag "form" from line 17 */ ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->PI, 'getURLSettingExe')))):  ;
$_tmp_1 = ' action="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<form class="form-horizontal" method="post"<?php echo $_tmp_1 ?>
>
								<?php /* tag "div" from line 18 */; ?>
<div class="control-group">
									<?php /* tag "label" from line 19 */; ?>
<label class="control-label" for="Image1">Ảnh 1</label>
									<?php /* tag "div" from line 20 */; ?>
<div class="controls">
										<?php 
/* tag "input" from line 21 */ ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->PI, 'getImage1')))):  ;
$_tmp_2 = ' value="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<input type="text" id="Image1" name="Image1"<?php echo $_tmp_2 ?>
/>
									</div>
								</div>
								<?php /* tag "div" from line 24 */; ?>
<div class="control-group">
									<?php /* tag "label" from line 25 */; ?>
<label class="control-label" for="Image2">Ảnh 2</label>
									<?php /* tag "div" from line 26 */; ?>
<div class="controls">
										<?php 
/* tag "input" from line 27 */ ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->PI, 'getImage2')))):  ;
$_tmp_2 = ' value="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<input type="text" id="Image2" name="Image2"<?php echo $_tmp_2 ?>
/>
									</div>
								</div>
								<?php /* tag "div" from line 30 */; ?>
<div class="control-group">
									<?php /* tag "label" from line 31 */; ?>
<label class="control-label" for="Info">Thông tin</label>
									<?php /* tag "div" from line 32 */; ?>
<div class="controls">
										<?php /* tag "textarea" from line 33 */; ?>
<textarea id="Info" class="ckeditor" name="Info"><?php echo phptal_escape($ctx->path($ctx->PI, 'getInfo')); ?>
</textarea>
									</div>
								</div>
								<?php /* tag "div" from line 36 */; ?>
<div class="form-actions">
									<?php /* tag "button" from line 37 */; ?>
<button type="submit" class="btn btn-success" value="submit-value">Lưu</button>
								</div>
							</form>
						</div>
					</div>										
				</div>
			</div>
		</div>
		<?php 
/* tag "div" from line 45 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/Footer', $_thistpl) ;
$ctx->popSlots() ;
?>

		<?php 
/* tag "div" from line 46 */ ;
$ctx->pushSlots() ;
$tpl->_executeMacroOfTemplate('mAdmin.xhtml/IncludeJS', $_thistpl) ;
$ctx->popSlots() ;
?>

		<?php /* tag "script" from line 47 */; ?>
<script type="text/javascript" language="javascript" src="/mvc/templates/back/ckeditor/ckeditor.js"></script>
		<?php /* tag "script" from line 48 */; ?>
<script type="text/javascript">
		/*<![CDATA[*/
			/* ---------------------------------------------------------------------------- */
			/* SET TODAY FOR DATEPICKER														*/
			/* ---------------------------------------------------------------------------- */
			//THIẾT LẬP NGÀY GIỜ GIAO DỊCH
			$('#Time').datetimepicker({
				language:  'vi',
				weekStart: 1,
				todayBtn:  1,
				autoclose: 1,
				todayHighlight: 1,
				startView: 2,
				forceParse: 0,
				showMeridian: 1
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

Generated by PHPTAL from G:\AppsWeb\cmsA\www.amthuclangsen.com\mvc\templates\ASettingProductInfo.html (edit that file instead) */; ?>