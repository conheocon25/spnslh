<?php 
function tpl_54ae1695_mFront__7L4BsCvJrP6QxKIJAhTdyw_Footer(PHPTAL $_thistpl, PHPTAL $tpl) {
$tpl = clone $tpl ;
$ctx = $tpl->getContext() ;
$_translator = $tpl->getTranslator() ;
?>
<footer>
		<?php /* tag "div" from line 240 */; ?>
<div class="row">
			<?php /* tag "div" from line 241 */; ?>
<div class="col-md-12">
				<?php /* tag "center" from line 242 */; ?>
<center>
					<?php /* tag "p" from line 243 */; ?>
<p><?php /* tag "b" from line 243 */; ?>
<b>&copy; 2015 GIỚI THIỆU VIỆC LÀM . NET</b></p>
					<?php /* tag "p" from line 244 */; ?>
<p>Thành Phố Cần Thơ</p>
					<?php /* tag "p" from line 245 */; ?>
<p>Điện thoại: 0919 153 189</p>
					<?php /* tag "p" from line 246 */; ?>
<p><?php /* tag "b" from line 246 */; ?>
<b><?php echo phptal_escape(\MVC\Library\Statistic::getCountPrint()); ?>
</b> lượt truy cập - <?php /* tag "b" from line 246 */; ?>
<b><?php echo phptal_escape(\MVC\Library\Statistic::getOnlinePrint()); ?>
</b> đang online</p>
					<?php /* tag "p" from line 247 */; ?>
<p style="color:#ddd;"><?php /* tag "i" from line 247 */; ?>
<i>SPN Team- Website duyệt tốt trên trình duyệt <?php /* tag "b" from line 247 */; ?>
<b>Google Chrome</b></i></p>									
				</center>
			</div>
		</div>
	</footer><?php 
}

 ?>
<?php 
function tpl_54ae1695_mFront__7L4BsCvJrP6QxKIJAhTdyw_DoubleAds(PHPTAL $_thistpl, PHPTAL $tpl) {
$tpl = clone $tpl ;
$ctx = $tpl->getContext() ;
$_translator = $tpl->getTranslator() ;
?>

		<?php /* tag "div" from line 228 */; ?>
<div style="padding:0;width:102px;height:452px;position:fixed;left:10px;top:20px;border:1px solid #0090b5;">
			<?php /* tag "a" from line 229 */; ?>
<a href="/"><?php /* tag "img" from line 229 */; ?>
<img src="/mvc/templates/front/img/ads.jpg" width="100%" height="100%"/></a>
		</div>
		<?php /* tag "div" from line 231 */; ?>
<div style="padding:0;width:102px;height:452px;position:fixed;right:10px;top:20px;border:1px solid #0090b5;">
			<?php /* tag "a" from line 232 */; ?>
<a href="/"><?php /* tag "img" from line 232 */; ?>
<img src="/mvc/templates/front/img/ads.jpg" width="100%" height="100%"/></a>
		</div>
	<?php 
}

 ?>
<?php 
function tpl_54ae1695_mFront__7L4BsCvJrP6QxKIJAhTdyw_Breadcrumb(PHPTAL $_thistpl, PHPTAL $tpl) {
$tpl = clone $tpl ;
$ctx = $tpl->getContext() ;
$_translator = $tpl->getTranslator() ;
?>
<ol class="breadcrumb">
		<?php /* tag "li" from line 217 */; ?>
<li><?php /* tag "a" from line 217 */; ?>
<a href="/">TRANG CHỦ</a></li>
		<?php 
/* tag "li" from line 218 */ ;
$_tmp_2 = $ctx->repeat ;
$_tmp_2->Item = new PHPTAL_RepeatController($ctx->Navigation)
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_2->Item as $ctx->Item): ;
?>
<li> 
			<?php 
/* tag "a" from line 219 */ ;
if (null !== ($_tmp_3 = ($ctx->Item[1]))):  ;
$_tmp_3 = ' href="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<a<?php echo $_tmp_3 ?>
><?php echo phptal_escape($ctx->Item[0]); ?>
</a>
		</li><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

		<?php /* tag "li" from line 221 */; ?>
<li class="active"><?php echo phptal_escape($ctx->Title); ?>
</li>
	</ol><?php 
}

 ?>
<?php 
function tpl_54ae1695_mFront__7L4BsCvJrP6QxKIJAhTdyw_SearchBox(PHPTAL $_thistpl, PHPTAL $tpl) {
$tpl = clone $tpl ;
$ctx = $tpl->getContext() ;
$_translator = $tpl->getTranslator() ;
?>
<div class="panel panel-default">
		<?php /* tag "div" from line 123 */; ?>
<div class="panel-heading"><?php /* tag "h3" from line 123 */; ?>
<h3 class="panel-title">Tìm kiếm</h3></div>
		<?php /* tag "div" from line 124 */; ?>
<div class="panel-body">
			<?php /* tag "form" from line 125 */; ?>
<form id="ProductSearch" action="/tim-kiem" method="POST" role="form">
				<?php /* tag "div" from line 126 */; ?>
<div class="form-group">
					<?php /* tag "select" from line 127 */; ?>
<select name="IdCategory" id="IdCategory" class="form-control">						
						<?php 
/* tag "option" from line 128 */ ;
$_tmp_2 = $ctx->repeat ;
$_tmp_2->Category = new PHPTAL_RepeatController($ctx->CategoryAll1)
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_2->Category as $ctx->Category): ;
if (null !== ($_tmp_3 = ($ctx->path($ctx->Category, 'getId')))):  ;
$_tmp_3 = ' value="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
if ($ctx->Category->getId()==\MVC\Base\SessionRegistry::instance()->getIdCategory()?'selected':''):  ;
$_tmp_1 = ' selected="selected"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<option<?php echo $_tmp_3 ?>
<?php echo $_tmp_1 ?>
>
							<?php /* tag "span" from line 129 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Category, 'getName')); ?>
</span>
						</option><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

					</select>
				</div>
				<?php /* tag "div" from line 133 */; ?>
<div class="form-group">
					<?php /* tag "select" from line 134 */; ?>
<select name="IdEstate" id="IdEstate" class="form-control">
						<?php 
/* tag "option" from line 135 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdEstate()==0?'selected':''):  ;
$_tmp_3 = ' selected="selected"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<option value="0"<?php echo $_tmp_3 ?>
>Tài sản</option>
						<?php 
/* tag "option" from line 136 */ ;
$_tmp_1 = $ctx->repeat ;
$_tmp_1->Estate = new PHPTAL_RepeatController($ctx->EstateAll)
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_1->Estate as $ctx->Estate): ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->Estate, 'getId')))):  ;
$_tmp_2 = ' value="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
if ($ctx->Estate->getId()==\MVC\Base\SessionRegistry::instance()->getIdEstate()?'selected':''):  ;
$_tmp_3 = ' selected="selected"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<option<?php echo $_tmp_2 ?>
<?php echo $_tmp_3 ?>
>
							<?php /* tag "span" from line 137 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Estate, 'getName')); ?>
</span>
						</option><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

					</select>
				</div>
				<?php /* tag "div" from line 141 */; ?>
<div class="form-group">
					<?php /* tag "select" from line 142 */; ?>
<select name="IdDistrict" id="IdDistrict" class="form-control">						
						<?php 
/* tag "option" from line 143 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdDistrict()==0?'selected':''):  ;
$_tmp_2 = ' selected="selected"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<option value="0"<?php echo $_tmp_2 ?>
>Địa điểm</option>
						<?php 
/* tag "option" from line 144 */ ;
$_tmp_3 = $ctx->repeat ;
$_tmp_3->District = new PHPTAL_RepeatController($ctx->path($ctx->Province, 'getDistrictAll'))
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_3->District as $ctx->District): ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->District, 'getId')))):  ;
$_tmp_1 = ' value="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
if ($ctx->District->getId()==\MVC\Base\SessionRegistry::instance()->getIdDistrict()?'selected':''):  ;
$_tmp_2 = ' selected="selected"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<option<?php echo $_tmp_1 ?>
<?php echo $_tmp_2 ?>
>
							<?php /* tag "span" from line 145 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->District, 'getName')); ?>
</span>
						</option><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

					</select>
				</div>
				<?php /* tag "div" from line 149 */; ?>
<div class="form-group">
					<?php /* tag "select" from line 150 */; ?>
<select name="IdDirection" id="IdDirection" class="form-control">						
						<?php 
/* tag "option" from line 151 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdDirection()==0?'selected':''):  ;
$_tmp_1 = ' selected="selected"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<option value="0"<?php echo $_tmp_1 ?>
>Phương hướng</option>
						<?php 
/* tag "option" from line 152 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdDirection()==1?'selected':''):  ;
$_tmp_2 = ' selected="selected"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<option value="1"<?php echo $_tmp_2 ?>
>Đông</option>						
						<?php 
/* tag "option" from line 153 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdDirection()==2?'selected':''):  ;
$_tmp_3 = ' selected="selected"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<option value="2"<?php echo $_tmp_3 ?>
>Tây</option>						
						<?php 
/* tag "option" from line 154 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdDirection()==3?'selected':''):  ;
$_tmp_1 = ' selected="selected"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<option value="3"<?php echo $_tmp_1 ?>
>Nam</option>						
						<?php 
/* tag "option" from line 155 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdDirection()==4?'selected':''):  ;
$_tmp_2 = ' selected="selected"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<option value="4"<?php echo $_tmp_2 ?>
>Bắc</option>						
						<?php 
/* tag "option" from line 156 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdDirection()==5?'selected':''):  ;
$_tmp_3 = ' selected="selected"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<option value="5"<?php echo $_tmp_3 ?>
>Đông Bắc</option>						
						<?php 
/* tag "option" from line 157 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdDirection()==6?'selected':''):  ;
$_tmp_1 = ' selected="selected"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<option value="6"<?php echo $_tmp_1 ?>
>Đông Nam</option>						
						<?php 
/* tag "option" from line 158 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdDirection()==7?'selected':''):  ;
$_tmp_2 = ' selected="selected"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<option value="7"<?php echo $_tmp_2 ?>
>Tây Bắc</option>						
						<?php 
/* tag "option" from line 159 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdDirection()==8?'selected':''):  ;
$_tmp_3 = ' selected="selected"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<option value="8"<?php echo $_tmp_3 ?>
>Tây Nam</option>
					</select>
				</div>
				<?php /* tag "div" from line 162 */; ?>
<div class="form-group">
					<?php /* tag "select" from line 163 */; ?>
<select name="IdPrice" id="IdPrice" class="form-control">						
						<?php 
/* tag "option" from line 164 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdPrice()==0?'selected':''):  ;
$_tmp_1 = ' selected="selected"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<option value="0"<?php echo $_tmp_1 ?>
>Giá</option>
						<?php 
/* tag "option" from line 165 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdPrice()==1?'selected':''):  ;
$_tmp_2 = ' selected="selected"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<option value="1"<?php echo $_tmp_2 ?>
>0 - 1 triệu</option>
						<?php 
/* tag "option" from line 166 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdPrice()==2?'selected':''):  ;
$_tmp_3 = ' selected="selected"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<option value="2"<?php echo $_tmp_3 ?>
>1 - 3 triệu</option>
						<?php 
/* tag "option" from line 167 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdPrice()==3?'selected':''):  ;
$_tmp_1 = ' selected="selected"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<option value="3"<?php echo $_tmp_1 ?>
>3 - 5 triệu</option>
						<?php 
/* tag "option" from line 168 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdPrice()==4?'selected':''):  ;
$_tmp_2 = ' selected="selected"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<option value="4"<?php echo $_tmp_2 ?>
>5 - 10 triệu</option>
						<?php 
/* tag "option" from line 169 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdPrice()==5?'selected':''):  ;
$_tmp_3 = ' selected="selected"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<option value="5"<?php echo $_tmp_3 ?>
>10 - 15 triệu</option>
						<?php 
/* tag "option" from line 170 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdPrice()==6?'selected':''):  ;
$_tmp_1 = ' selected="selected"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<option value="6"<?php echo $_tmp_1 ?>
>20 - 30 triệu</option>
						<?php 
/* tag "option" from line 171 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdPrice()==7?'selected':''):  ;
$_tmp_2 = ' selected="selected"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<option value="7"<?php echo $_tmp_2 ?>
>30 - 40 triệu</option>
						<?php 
/* tag "option" from line 172 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdPrice()==8?'selected':''):  ;
$_tmp_3 = ' selected="selected"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<option value="8"<?php echo $_tmp_3 ?>
>40 - 60 triệu</option>
						<?php 
/* tag "option" from line 173 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdPrice()==9?'selected':''):  ;
$_tmp_1 = ' selected="selected"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<option value="9"<?php echo $_tmp_1 ?>
>60 - 80 triệu</option>
						<?php 
/* tag "option" from line 174 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdPrice()==10?'selected':''):  ;
$_tmp_2 = ' selected="selected"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<option value="10"<?php echo $_tmp_2 ?>
>80 - 100 triệu</option>
						<?php 
/* tag "option" from line 175 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdPrice()==11?'selected':''):  ;
$_tmp_3 = ' selected="selected"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<option value="11"<?php echo $_tmp_3 ?>
>100 - 300 triệu</option>
						<?php 
/* tag "option" from line 176 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdPrice()==12?'selected':''):  ;
$_tmp_1 = ' selected="selected"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<option value="12"<?php echo $_tmp_1 ?>
>300 - 500 triệu</option>
						<?php 
/* tag "option" from line 177 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdPrice()==13?'selected':''):  ;
$_tmp_2 = ' selected="selected"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<option value="13"<?php echo $_tmp_2 ?>
>500 - 800 triệu</option>
						<?php 
/* tag "option" from line 178 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdPrice()==14?'selected':''):  ;
$_tmp_3 = ' selected="selected"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<option value="14"<?php echo $_tmp_3 ?>
>800 - 1 tỷ</option>
						<?php 
/* tag "option" from line 179 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdPrice()==15?'selected':''):  ;
$_tmp_1 = ' selected="selected"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<option value="15"<?php echo $_tmp_1 ?>
>1 - 2 tỷ</option>
						<?php 
/* tag "option" from line 180 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdPrice()==16?'selected':''):  ;
$_tmp_2 = ' selected="selected"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<option value="16"<?php echo $_tmp_2 ?>
>2 - 3 tỷ</option>						
						<?php 
/* tag "option" from line 181 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdPrice()==17?'selected':''):  ;
$_tmp_3 = ' selected="selected"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<option value="17"<?php echo $_tmp_3 ?>
>3 - 4 tỷ</option>
						<?php 
/* tag "option" from line 182 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdPrice()==18?'selected':''):  ;
$_tmp_1 = ' selected="selected"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<option value="18"<?php echo $_tmp_1 ?>
>4 - 5 tỷ</option>
					</select>
				</div>
				<?php /* tag "div" from line 185 */; ?>
<div class="form-group">
					<?php /* tag "select" from line 186 */; ?>
<select name="IdArea" id="IdArea" class="form-control">
						<?php 
/* tag "option" from line 187 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdArea()==0?'selected':''):  ;
$_tmp_2 = ' selected="selected"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<option value="0"<?php echo $_tmp_2 ?>
>Diện tích</option>
						<?php 
/* tag "option" from line 188 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdArea()==1?'selected':''):  ;
$_tmp_3 = ' selected="selected"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<option value="1"<?php echo $_tmp_3 ?>
>0 - 30 m2</option>
						<?php 
/* tag "option" from line 189 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdArea()==2?'selected':''):  ;
$_tmp_1 = ' selected="selected"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<option value="2"<?php echo $_tmp_1 ?>
>30 - 50 m2</option>
						<?php 
/* tag "option" from line 190 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdArea()==3?'selected':''):  ;
$_tmp_2 = ' selected="selected"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<option value="3"<?php echo $_tmp_2 ?>
>50 - 70 m2</option>
						<?php 
/* tag "option" from line 191 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdArea()==4?'selected':''):  ;
$_tmp_3 = ' selected="selected"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<option value="4"<?php echo $_tmp_3 ?>
>70 - 100 m2</option>
						<?php 
/* tag "option" from line 192 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdArea()==5?'selected':''):  ;
$_tmp_1 = ' selected="selected"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<option value="5"<?php echo $_tmp_1 ?>
>100 - 150 m2</option>
						<?php 
/* tag "option" from line 193 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdArea()==6?'selected':''):  ;
$_tmp_2 = ' selected="selected"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<option value="6"<?php echo $_tmp_2 ?>
>150 - 200 m2</option>
						<?php 
/* tag "option" from line 194 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdArea()==7?'selected':''):  ;
$_tmp_3 = ' selected="selected"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<option value="7"<?php echo $_tmp_3 ?>
>200 - 250 m2</option>
						<?php 
/* tag "option" from line 195 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdArea()==8?'selected':''):  ;
$_tmp_1 = ' selected="selected"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<option value="8"<?php echo $_tmp_1 ?>
>250 - 300 m2</option>
						<?php 
/* tag "option" from line 196 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdArea()==9?'selected':''):  ;
$_tmp_2 = ' selected="selected"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<option value="9"<?php echo $_tmp_2 ?>
>300 - 350 m2</option>
						<?php 
/* tag "option" from line 197 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdArea()==10?'selected':''):  ;
$_tmp_3 = ' selected="selected"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<option value="10"<?php echo $_tmp_3 ?>
>350 - 400 m2</option>
						<?php 
/* tag "option" from line 198 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdArea()==11?'selected':''):  ;
$_tmp_1 = ' selected="selected"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<option value="11"<?php echo $_tmp_1 ?>
>400 - 600 m2</option>
						<?php 
/* tag "option" from line 199 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdArea()==12?'selected':''):  ;
$_tmp_2 = ' selected="selected"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<option value="12"<?php echo $_tmp_2 ?>
>600 - 800 m2</option>
						<?php 
/* tag "option" from line 200 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdArea()==13?'selected':''):  ;
$_tmp_3 = ' selected="selected"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<option value="13"<?php echo $_tmp_3 ?>
>800 - 1000 m2</option>
						<?php 
/* tag "option" from line 201 */ ;
if (\MVC\Base\SessionRegistry::instance()->getIdArea()==14?'selected':''):  ;
$_tmp_1 = ' selected="selected"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<option value="14"<?php echo $_tmp_1 ?>
>trên 1000 m2</option>
					</select>
				</div>
				<?php /* tag "center" from line 204 */; ?>
<center>
					<?php /* tag "button" from line 205 */; ?>
<button id="URLSearchButton" class="btn btn-primary btn-small"><?php /* tag "i" from line 205 */; ?>
<i class="glyphicons-download_alt"></i>
						<?php /* tag "span" from line 206 */; ?>
<span class="glyphicon glyphicon-search" aria-hidden="true"></span> Tìm
					</button>
				</center>
			</form>
		</div>
	</div><?php 
}

 ?>
<?php 
function tpl_54ae1695_mFront__7L4BsCvJrP6QxKIJAhTdyw_Header(PHPTAL $_thistpl, PHPTAL $tpl) {
$tpl = clone $tpl ;
$ctx = $tpl->getContext() ;
$_translator = $tpl->getTranslator() ;
?>
<div id="header">
		<?php /* tag "div" from line 43 */; ?>
<div class="row" style="margin-top:10px;">
			<?php /* tag "div" from line 44 */; ?>
<div class="col-md-3">
				<?php /* tag "a" from line 45 */; ?>
<a href="/trang-chu">
					<?php /* tag "img" from line 46 */; ?>
<img alt="Brand" src="/mvc/templates/front/img/logo.png" width="100%"/>
				</a>
			</div>
			<?php /* tag "div" from line 49 */; ?>
<div class="col-md-9 rspdl">
				<?php /* tag "img" from line 50 */; ?>
<img alt="Brand" src="/mvc/templates/front/img/banner.jpg" width="100%"/>
				<?php /* tag "div" from line 51 */; ?>
<div class="support">
					Hotline: <?php /* tag "span" from line 52 */; ?>
<span style="color:red"><?php /* tag "span" from line 52 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->ConfigContact, 'getValue')); ?>
</span> - <?php /* tag "span" from line 52 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->ConfigPhone1, 'getValue')); ?>
</span></span> |
					Email: <?php /* tag "span" from line 53 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->ConfigGmail, 'getValue')); ?>
</span>
				</div>
			</div>
		</div>
		<?php /* tag "nav" from line 57 */; ?>
<nav class="navbar navbar-default" role="navigation">
			<?php /* tag "div" from line 58 */; ?>
<div class="container-fluid">
				<?php /* tag "div" from line 59 */; ?>
<div class="navbar-header">
					<?php /* tag "button" from line 60 */; ?>
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<?php /* tag "span" from line 61 */; ?>
<span class="sr-only">Toggle navigation</span>
						<?php /* tag "span" from line 62 */; ?>
<span class="icon-bar"></span>
						<?php /* tag "span" from line 63 */; ?>
<span class="icon-bar"></span>
						<?php /* tag "span" from line 64 */; ?>
<span class="icon-bar"></span>
					</button>
					<?php /* tag "div" from line 66 */; ?>
<div class="navbar-header">
						<?php /* tag "a" from line 67 */; ?>
<a class="navbar-brand" href="/trang-chu">
							<?php /* tag "img" from line 68 */; ?>
<img alt="Brand" src="/mvc/templates/front/img/home.png"/>
						</a>
					</div>
				</div>
				
				<?php /* tag "div" from line 73 */; ?>
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<?php /* tag "ul" from line 74 */; ?>
<ul class="nav navbar-nav">
						<?php 
/* tag "li" from line 75 */ ;
$_tmp_1 = $ctx->repeat ;
$_tmp_1->Category = new PHPTAL_RepeatController($ctx->CategoryAll)
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_1->Category as $ctx->Category): ;
?>
<li class="dropdown">
							<?php 
/* tag "a" from line 76 */ ;
if (null !== ($_tmp_2 = ($ctx->Active=='Product'?'active':'?'))):  ;
$_tmp_2 = ' class="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a href="#"<?php echo $_tmp_2 ?>
 data-toggle="dropdown" role="button" aria-expanded="false">
								<?php /* tag "span" from line 77 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Category, 'getName')); ?>
</span> <?php /* tag "span" from line 77 */; ?>
<span class="caret"></span>
							</a>
							<?php /* tag "ul" from line 79 */; ?>
<ul class="dropdown-menu" role="menu">
								<?php 
/* tag "li" from line 80 */ ;
$_tmp_2 = $ctx->repeat ;
$_tmp_2->Category1 = new PHPTAL_RepeatController($ctx->path($ctx->Category, 'getCategoryAll'))
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_2->Category1 as $ctx->Category1): ;
?>
<li>												
									<?php 
/* tag "a" from line 81 */ ;
if (null !== ($_tmp_3 = ($ctx->path($ctx->Category1, 'getURLView')))):  ;
$_tmp_3 = ' href="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<a<?php echo $_tmp_3 ?>
>
										<?php /* tag "span" from line 82 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Category1, 'getName')); ?>
</span>
									</a>
								</li><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

							</ul>
						</li><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

						<?php /* tag "li" from line 87 */; ?>
<li class="dropdown">
							<?php 
/* tag "a" from line 88 */ ;
if (null !== ($_tmp_3 = ($ctx->Active=='News'?'active':'?'))):  ;
$_tmp_3 = ' class="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<a href="#"<?php echo $_tmp_3 ?>
 data-toggle="dropdown" role="button" aria-expanded="false">Tin tức <?php /* tag "span" from line 88 */; ?>
<span class="caret"></span></a>
							<?php /* tag "ul" from line 89 */; ?>
<ul class="dropdown-menu" role="menu">
								<?php 
/* tag "li" from line 90 */ ;
$_tmp_2 = $ctx->repeat ;
$_tmp_2->Tag = new PHPTAL_RepeatController($ctx->TagAll)
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_2->Tag as $ctx->Tag): ;
?>
<li>
									<?php 
/* tag "a" from line 91 */ ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->Tag, 'getURLView')))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a<?php echo $_tmp_1 ?>
>
										<?php /* tag "span" from line 92 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Tag, 'getName')); ?>
</span>
									</a>
								</li><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

							</ul>
						</li>
						<?php /* tag "li" from line 97 */; ?>
<li class="dropdown">
							<?php 
/* tag "a" from line 98 */ ;
if (null !== ($_tmp_3 = ($ctx->Active=='Price'?'active':'?'))):  ;
$_tmp_3 = ' class="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<a href="#"<?php echo $_tmp_3 ?>
 data-toggle="dropdown" role="button" aria-expanded="false">Bảng giá <?php /* tag "span" from line 98 */; ?>
<span class="caret"></span></a>
							<?php /* tag "ul" from line 99 */; ?>
<ul class="dropdown-menu" role="menu">
								<?php /* tag "li" from line 100 */; ?>
<li><?php 
/* tag "a" from line 100 */ ;
if (null !== ($_tmp_1 = ('/bang-gia/gia-dat'))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a<?php echo $_tmp_1 ?>
>Bảng giá đất</a></li>
								<?php /* tag "li" from line 101 */; ?>
<li><?php 
/* tag "a" from line 101 */ ;
if (null !== ($_tmp_2 = ('/bang-gia/gia-nha'))):  ;
$_tmp_2 = ' href="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a<?php echo $_tmp_2 ?>
>Bảng giá nhà</a></li>
							</ul>
						</li>
						<?php /* tag "li" from line 104 */; ?>
<li class="dropdown">
							<?php 
/* tag "a" from line 105 */ ;
if (null !== ($_tmp_3 = ($ctx->Active=='Contact'?'active':'?'))):  ;
$_tmp_3 = ' class="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<a href="#"<?php echo $_tmp_3 ?>
 data-toggle="dropdown" role="button" aria-expanded="false">Liên hệ <?php /* tag "span" from line 105 */; ?>
<span class="caret"></span></a>
							<?php /* tag "ul" from line 106 */; ?>
<ul class="dropdown-menu" role="menu">											
								<?php /* tag "li" from line 107 */; ?>
<li><?php 
/* tag "a" from line 107 */ ;
if (null !== ($_tmp_1 = ('/lien-he/dang-ki-mua'))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a<?php echo $_tmp_1 ?>
>Đăng ký mua</a></li>
								<?php /* tag "li" from line 108 */; ?>
<li><?php 
/* tag "a" from line 108 */ ;
if (null !== ($_tmp_2 = ('/lien-he/dang-ki-ban'))):  ;
$_tmp_2 = ' href="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a<?php echo $_tmp_2 ?>
>Đăng ký bán</a></li>
								<?php /* tag "li" from line 109 */; ?>
<li><?php 
/* tag "a" from line 109 */ ;
if (null !== ($_tmp_3 = ('/lien-he/nha-tu-van'))):  ;
$_tmp_3 = ' href="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<a<?php echo $_tmp_3 ?>
>Nhà tư vấn</a></li>
								<?php /* tag "li" from line 110 */; ?>
<li><?php 
/* tag "a" from line 110 */ ;
if (null !== ($_tmp_1 = ('/lien-he/gia-dich-vu'))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a<?php echo $_tmp_1 ?>
>Giá đăng</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</div><?php 
}

 ?>
<?php 
function tpl_54ae1695_mFront__7L4BsCvJrP6QxKIJAhTdyw_IncludeJS(PHPTAL $_thistpl, PHPTAL $tpl) {
$tpl = clone $tpl ;
$ctx = $tpl->getContext() ;
$_translator = $tpl->getTranslator() ;
?>
						
		<?php /* tag "script" from line 35 */; ?>
<script type="text/javascript" src="/mvc/templates/front/js/jquery-1.11.0.min.js"></script>
		<?php /* tag "script" from line 36 */; ?>
<script type="text/javascript" src="/mvc/templates/front/js/bootstrap.min.js"></script>
	<?php 
}

 ?>
<?php 
function tpl_54ae1695_mFront__7L4BsCvJrP6QxKIJAhTdyw_IncludeCSS(PHPTAL $_thistpl, PHPTAL $tpl) {
$tpl = clone $tpl ;
$ctx = $tpl->getContext() ;
$_translator = $tpl->getTranslator() ;
?>
	
		<?php /* tag "link" from line 27 */; ?>
<link rel="stylesheet" type="text/css" href="/mvc/templates/front/css/bootstrap.min.css"/>
		<?php /* tag "link" from line 28 */; ?>
<link rel="stylesheet" type="text/css" href="/mvc/templates/front/css/bootstrap.config.css"/>
	<?php 
}

 ?>
<?php 
function tpl_54ae1695_mFront__7L4BsCvJrP6QxKIJAhTdyw_IncludeMETA(PHPTAL $_thistpl, PHPTAL $tpl) {
$tpl = clone $tpl ;
$ctx = $tpl->getContext() ;
$_translator = $tpl->getTranslator() ;
?>

		<?php /* tag "link" from line 7 */; ?>
<link rel="shortcut icon" type="image/x-icon" href="/mvc/templates/front/img/ficon.ico"/>
		<?php /* tag "link" from line 8 */; ?>
<link rel="shortcut icon" type="image/ico" href="/mvc/templates/front/img/ficon.ico"/>
		<?php /* tag "title" from line 9 */; ?>
<title><?php echo 'Website Giới thiệu việc làm'; ?>
</title>
		<?php /* tag "base" from line 10 */; ?>
<base href="http://job.caytretramdot.com"/>
		<?php /* tag "meta" from line 11 */; ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<?php /* tag "meta" from line 12 */; ?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<?php /* tag "meta" from line 13 */; ?>
<meta http-equiv="Pragma" content="no-cache"/>
		<?php /* tag "meta" from line 14 */; ?>
<meta http-equiv="Expires" content="-1"/>
		<?php /* tag "meta" from line 15 */; ?>
<meta http-equiv="Cache-Control" content="no-cache"/>
		<?php /* tag "meta" from line 16 */; ?>
<meta name="keywords" content="Website Giới thiệu việc làm"/>
		<?php /* tag "meta" from line 17 */; ?>
<meta name="description" content="Website Giới thiệu việc làm"/>
		<?php /* tag "meta" from line 18 */; ?>
<meta name="page-topic" content="Website Giới thiệu việc làm"/>
		<?php /* tag "meta" from line 19 */; ?>
<meta name="Abstract" content="Website Giới thiệu việc làm"/>
		<?php /* tag "meta" from line 20 */; ?>
<meta name="classification" content="Website Giới thiệu việc làm"/>
	<?php 
}

 ?>
<?php 
function tpl_54ae1695_mFront__7L4BsCvJrP6QxKIJAhTdyw(PHPTAL $tpl, PHPTAL_Context $ctx) {
$_thistpl = $tpl ;
$_translator = $tpl->getTranslator() ;
/* tag "documentElement" from line 1 */ ;
/* tag "html" from line 1 */ ;
?>
<html lang="en" xml:lang="en">
<?php /* tag "body" from line 2 */; ?>
<body>
	<!-- ======================================================================== -->
	<!-- META TAG INCLUDE														  -->
	<!-- ======================================================================== -->
	<?php /* tag "tal:block" from line 6 */; ?>

	
	<!-- ======================================================================== -->
	<!-- CASCADING STYLE SHEETS INCLUDE											  -->
	<!-- ======================================================================== -->
	<?php /* tag "tal:block" from line 26 */; ?>

	
	<!-- ======================================================================== -->
	<!-- JAVASCRIPT INCLUDE														  -->
	<!-- ======================================================================== -->
	<?php /* tag "tal:block" from line 34 */; ?>

	
	<!-- ======================================================================== -->
	<!-- HEADER																	  -->
	<!-- ======================================================================== -->
	<?php /* tag "div" from line 42 */; ?>

	
	<!-- ======================================================================== -->
	<!-- SEARCH BOX																  -->
	<!-- ======================================================================== -->
	<?php /* tag "div" from line 122 */; ?>


	<!-- ======================================================================== -->
	<!-- BREADCRUMB																  -->
	<!-- ======================================================================== -->
	<?php /* tag "ol" from line 216 */; ?>

	
	<!-- ======================================================================== -->
	<!-- BREADCRUMB																  -->
	<!-- ======================================================================== -->
	<?php /* tag "tal:block" from line 227 */; ?>


	<!-- ======================================================================== -->
	<!-- FOOTER																	  -->
	<!-- ======================================================================== -->	
	<?php /* tag "footer" from line 239 */; ?>


</body>
</html><?php 
/* end */ ;

}

?>
<?php /* 
*** DO NOT EDIT THIS FILE ***

Generated by PHPTAL from G:\AppsWeb\cmsA\caytretramdot.com_job\mvc\templates\mFront.xhtml (edit that file instead) */; ?>