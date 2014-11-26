<?php 
function tpl_546d67d4_SellingTablePrint__Py9nm50zkvzHTNuf4Yjl6A(PHPTAL $tpl, PHPTAL_Context $ctx) {
$_thistpl = $tpl ;
$_translator = $tpl->getTranslator() ;
/* tag "documentElement" from line 1 */ ;
/* tag "head" from line 1 */ ;
?>
<head>
	<?php /* tag "meta" from line 2 */; ?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<?php /* tag "style" from line 3 */; ?>
<style>
	@media print{
		.header, .hide { visibility: hidden };
		body { font-size: 9px };
		margin: 0mm 0mm 0mm 0mm;
	}	 
	@media screen {
		body { font-size: 9px }
	}
	@media screen, print {
		body { line-height: 1.0 }
	}
	@page  
	{ 
		size: auto;   /* auto is the initial value */ 
		/* this affects the margin in the printer settings */ 
		margin: 0mm 0mm 0mm 0mm;
	}	
	</style>
</head>
<?php /* tag "body" from line 23 */; ?>
<body onload="window.print()">
<?php /* tag "table" from line 24 */; ?>
<table width="100%" cellpadding="1" cellspacing="0" border="0">
	<?php /* tag "tr" from line 25 */; ?>
<tr>
		<?php /* tag "td" from line 26 */; ?>
<td width="100%" align="center" style="font-size:14pt;font-family:Arial; line-height:14pt;padding-top:0px">
			<?php /* tag "B" from line 27 */; ?>
<B>CH THANH SÔCÔLA</B>
		</td>
	</tr>
	<?php /* tag "tr" from line 30 */; ?>
<tr>
		<?php /* tag "td" from line 31 */; ?>
<td width="100%" align="center" style="font-size:9pt;font-family:Arial; line-height:11pt;">
			TP Hồ Chí Minh
		</td>
	</tr>
	<?php /* tag "tr" from line 35 */; ?>
<tr>
		<?php /* tag "td" from line 36 */; ?>
<td width="100%" align="center" style="font-size:10pt;font-family:Arial; line-height:11pt">
			<?php /* tag "B" from line 37 */; ?>
<B>0919 153 189</B>
		</td>
	</tr>
	<?php /* tag "tr" from line 40 */; ?>
<tr>
		<?php /* tag "td" from line 41 */; ?>
<td width="100%" align="center" style="font-size:13pt;font-family:Arial; line-height:14pt">
			<?php /* tag "b" from line 42 */; ?>
<b>PHIẾU TÍNH TIỀN</b>
		</td>
	</tr>
</table>
<?php /* tag "br" from line 46 */; ?>
<br/>
<?php /* tag "table" from line 47 */; ?>
<table width="100%" cellpadding="1" cellspacing="0" border="0" style="font-size:10pt;font-family:Arial; line-height:11pt;padding-top:0px">
	<?php /* tag "tr" from line 48 */; ?>
<tr>
		<?php /* tag "td" from line 49 */; ?>
<td width="55%" align="left">				
			<?php /* tag "span" from line 50 */; ?>
<span><?php echo phptal_escape(mb_strtoupper($ctx->Session->getTable()->getName(),'UTF8')); ?>
</span>				
		</td>
		<?php /* tag "td" from line 52 */; ?>
<td width="45%" align="right">
			<?php /* tag "span" from line 53 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Session, 'getUser/getName')); ?>
</span> / <?php 
/* tag "span" from line 53 */ ;
if ($ctx->path($ctx->Session, 'getEmployee')):  ;
?>
<span><?php echo phptal_escape($ctx->path($ctx->Session, 'getEmployee/getName')); ?>
</span><?php endif; ?>
 <?php 
/* tag "span" from line 53 */ ;
if (!($ctx->path($ctx->Session, 'getEmployee'))):  ;
?>
<span><?php echo '&#039; &#039;'; ?>
</span><?php endif; ?>

		</td>
	</tr>
	<?php /* tag "tr" from line 56 */; ?>
<tr>
		<?php /* tag "td" from line 57 */; ?>
<td width="55%" align="left">				
			
		</td>
		<?php /* tag "td" from line 60 */; ?>
<td width="45%" align="right">
			<?php /* tag "span" from line 61 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Session, 'getDateTimePrint')); ?>
</span>
		</td>
	</tr>
	<?php 
/* tag "tr" from line 64 */ ;
if ($ctx->path($ctx->Session, 'getNote')):  ;
?>
<tr>
		<?php /* tag "td" from line 65 */; ?>
<td width="100%" align="left">
			<?php /* tag "span" from line 66 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Session, 'getNote')); ?>
</span>
		</td>
	</tr><?php endif; ?>

</table>
<?php /* tag "br" from line 70 */; ?>
<br/>
<?php /* tag "table" from line 71 */; ?>
<table width="100%" cellpadding="2" cellspacing="0" border="1" style="font-size:10pt;font-family:Arial; line-height:11pt;padding-bottom:0px">
	<?php /* tag "thead" from line 72 */; ?>
<thead>
		<?php /* tag "tr" from line 73 */; ?>
<tr>
			<?php /* tag "th" from line 74 */; ?>
<th width="42%" align="left"><?php /* tag "b" from line 74 */; ?>
<b>TÊN HÀNG</b></th>
			<?php /* tag "th" from line 75 */; ?>
<th width="11%" align="right"><?php /* tag "b" from line 75 */; ?>
<b>SL</b></th>
			<?php /* tag "th" from line 76 */; ?>
<th width="21%" align="right"><?php /* tag "b" from line 76 */; ?>
<b>Đ.GIÁ</b></th>
			<?php /* tag "th" from line 77 */; ?>
<th width="26%" align="right"><?php /* tag "b" from line 77 */; ?>
<b>T.TIỀN</b></th>
		</tr>
	</thead>
	<?php /* tag "tbody" from line 80 */; ?>
<tbody>
		<?php 
/* tag "tr" from line 81 */ ;
$_tmp_1 = $ctx->repeat ;
$_tmp_1->Detail = new PHPTAL_RepeatController($ctx->path($ctx->Session, 'getDetails3'))
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_1->Detail as $ctx->Detail): ;
?>
<tr>
			<?php /* tag "td" from line 82 */; ?>
<td width="42%" align="left"><?php echo phptal_escape($ctx->path($ctx->Detail, 'getCourse/getName')); ?>
</td>
			<?php /* tag "td" from line 83 */; ?>
<td width="11%" align="right"><?php echo phptal_escape($ctx->path($ctx->Detail, 'getCount')); ?>
</td>
			<?php /* tag "td" from line 84 */; ?>
<td width="21%" align="right"><?php echo phptal_escape($ctx->path($ctx->Detail, 'getPricePrint')); ?>
</td>
			<?php /* tag "td" from line 85 */; ?>
<td width="26%" align="right"><?php /* tag "span" from line 85 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Detail, 'getValuePrint')); ?>
</span></td>
		</tr><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

	</tbody>
</table>	
<?php /* tag "table" from line 89 */; ?>
<table width="100%" cellpadding="2" cellspacing="0" border="0" style="font-size:12pt;font-family:Arial; line-height:12pt;padding-bottom:2px;">
	<?php /* tag "tbody" from line 90 */; ?>
<tbody>
		<?php 
/* tag "tr" from line 91 */ ;
if ($ctx->path($ctx->Session, 'getDiscountPercent')):  ;
?>
<tr>
			<?php /* tag "td" from line 92 */; ?>
<td align="right" colspan="5" width="100%">
				GIẢM GIÁ: <?php /* tag "b" from line 93 */; ?>
<b><?php echo phptal_escape($ctx->path($ctx->Session, 'getDiscountPercentPrint')); ?>
</b>
			</td>
		</tr><?php endif; ?>

		<?php 
/* tag "tr" from line 96 */ ;
if ($ctx->path($ctx->Session, 'getDiscountValue')):  ;
?>
<tr>
			<?php /* tag "td" from line 97 */; ?>
<td align="right" colspan="5" width="100%">
				GIẢM GIÁ: <?php /* tag "b" from line 98 */; ?>
<b><?php echo phptal_escape($ctx->path($ctx->Session, 'getDiscountValuePrint')); ?>
</b>
			</td>
		</tr><?php endif; ?>

		<?php /* tag "tr" from line 101 */; ?>
<tr>
			<?php /* tag "td" from line 102 */; ?>
<td align="right" colspan="5" width="100%">
				TỔNG TIỀN: <?php /* tag "b" from line 103 */; ?>
<b><?php echo phptal_escape($ctx->path($ctx->Session, 'getValuePrint')); ?>
</b>
			</td>
		</tr>
		<?php /* tag "tr" from line 106 */; ?>
<tr>
			<?php /* tag "td" from line 107 */; ?>
<td align="right" colspan="5" width="100%">
				<?php /* tag "p" from line 108 */; ?>
<p style="font-size:10pt;font-family:Arial; line-height:10pt;">( <?php /* tag "span" from line 108 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Session, 'getValueStrPrint')); ?>
</span> )</p>
			</td>
		</tr>
		<?php /* tag "tr" from line 111 */; ?>
<tr><?php /* tag "td" from line 111 */; ?>
<td></td></tr>
		<?php /* tag "tr" from line 112 */; ?>
<tr>
			<?php /* tag "td" from line 113 */; ?>
<td align="center" colspan="5" width="100%">				
				<?php /* tag "B" from line 114 */; ?>
<B style="font-size:12pt;font-family:Arial; line-height:12pt;">CÁM ƠN QUÍ KHÁCH. HẸN GẶP LẠI !</B>
			</td>
		</tr>
	</tbody>
</table>
</body><?php 
/* end */ ;

}

?>
<?php /* 
*** DO NOT EDIT THIS FILE ***

Generated by PHPTAL from G:\AppsWeb\cmsA\sell.thanhsocola.com\mvc\templates\SellingTablePrint.html (edit that file instead) */; ?>