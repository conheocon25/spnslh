<?php 
function tpl_543cf509_mAdmin__Mms8g3XlZpTuHI9n6IQWGg_StyleTools(PHPTAL $_thistpl, PHPTAL $tpl) {
$tpl = clone $tpl ;
$ctx = $tpl->getContext() ;
$_translator = $tpl->getTranslator() ;
?>
<div id="style-switcher">
		<?php /* tag "i" from line 249 */; ?>
<i class="glyphicon glyphicon-arrow-left"></i>
		<?php /* tag "span" from line 250 */; ?>
<span>Giao diện:</span>
		<?php /* tag "a" from line 251 */; ?>
<a href="/setting/theme/grey" alt="#grey" style="background-color:#555555;border-color:#aaaaaa;cursor:pointer;"></a>
		<?php /* tag "a" from line 252 */; ?>
<a href="/setting/theme/light-blue" alt="#light-blue" style="background-color:#8399b0;cursor:pointer;"></a>
		<?php /* tag "a" from line 253 */; ?>
<a href="/setting/theme/blue" alt="#blue" style="background-color:#2D2F57;cursor:pointer;"></a>
		<?php /* tag "a" from line 254 */; ?>
<a href="/setting/theme/red" alt="#red" style="background-color:#673232;cursor:pointer;"></a>
		<?php /* tag "a" from line 255 */; ?>
<a href="/setting/theme/red-green" alt="#red-green" style="background-image:url('/mvc/templates/theme/cms/img/demo/red-green.png');background-repeat:no-repeat;cursor:pointer;"></a>
	</div><?php 
}

 ?>
<?php 
function tpl_543cf509_mAdmin__Mms8g3XlZpTuHI9n6IQWGg_Footer(PHPTAL $_thistpl, PHPTAL $tpl) {
$tpl = clone $tpl ;
$ctx = $tpl->getContext() ;
$_translator = $tpl->getTranslator() ;
?>
<div class="row">
		<?php /* tag "div" from line 240 */; ?>
<div id="footer" class="col-12" style="text-align:right; padding-right:20px;">
			2009 - 2014 &copy; <?php /* tag "a" from line 241 */; ?>
<a href="http://amthuclangsen.com">SPN Soft - Nhà hàng</a>
		</div>
	</div><?php 
}

 ?>
<?php 
function tpl_543cf509_mAdmin__Mms8g3XlZpTuHI9n6IQWGg_MenuSettingProduct(PHPTAL $_thistpl, PHPTAL $tpl) {
$tpl = clone $tpl ;
$ctx = $tpl->getContext() ;
$_translator = $tpl->getTranslator() ;
?>
<div id="sidebar">				
		<?php 
/* tag "ul" from line 212 */ ;
if (\MVC\Base\SessionRegistry::instance()->getCurrentUser()->isAdmin()):  ;
?>
<ul>									
			<?php 
/* tag "li" from line 213 */ ;
if (null !== ($_tmp_1 = ($ctx->ActiveAdmin=='Manufacturer'?'active':'disable'))):  ;
$_tmp_1 = ' class="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<li<?php echo $_tmp_1 ?>
>
				<?php 
/* tag "a" from line 214 */ ;
if (null !== ($_tmp_2 = ('/admin/setting/manufacturer'))):  ;
$_tmp_2 = ' href="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a<?php echo $_tmp_2 ?>
>
					<?php /* tag "i" from line 215 */; ?>
<i class="glyphicons-truck"></i>NHÀ SẢN XUẤT
				</a>
			</li>
			<?php 
/* tag "li" from line 218 */ ;
if (null !== ($_tmp_3 = ($ctx->ActiveAdmin=='Supplier'?'active':'disable'))):  ;
$_tmp_3 = ' class="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<li<?php echo $_tmp_3 ?>
>
				<?php 
/* tag "a" from line 219 */ ;
if (null !== ($_tmp_2 = ('/admin/setting/supplier'))):  ;
$_tmp_2 = ' href="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a<?php echo $_tmp_2 ?>
>
					<?php /* tag "i" from line 220 */; ?>
<i class="glyphicons-truck"></i>NHÀ CUNG CẤP
				</a>
			</li>
			<?php 
/* tag "li" from line 223 */ ;
if (null !== ($_tmp_1 = ($ctx->ActiveAdmin=='Category'?'active':'disable'))):  ;
$_tmp_1 = ' class="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<li<?php echo $_tmp_1 ?>
>
				<?php 
/* tag "a" from line 224 */ ;
if (null !== ($_tmp_2 = ('/admin/setting/category'))):  ;
$_tmp_2 = ' href="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a<?php echo $_tmp_2 ?>
>
					<?php /* tag "i" from line 225 */; ?>
<i class="glyphicons-truck"></i>DANH MỤC SẢN PHẨM
				</a>
			</li>
			<?php 
/* tag "li" from line 228 */ ;
if (null !== ($_tmp_3 = ($ctx->ActiveAdmin=='GAttribute'?'active':'disable'))):  ;
$_tmp_3 = ' class="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<li<?php echo $_tmp_3 ?>
>
				<?php 
/* tag "a" from line 229 */ ;
if (null !== ($_tmp_2 = ('/admin/setting/gattribute'))):  ;
$_tmp_2 = ' href="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a<?php echo $_tmp_2 ?>
>
					<?php /* tag "i" from line 230 */; ?>
<i class="glyphicons-truck"></i>DANH MỤC MÔ TẢ
				</a>
			</li>			
		</ul><?php endif; ?>

	</div><?php 
}

 ?>
<?php 
function tpl_543cf509_mAdmin__Mms8g3XlZpTuHI9n6IQWGg_MenuSettingPost(PHPTAL $_thistpl, PHPTAL $tpl) {
$tpl = clone $tpl ;
$ctx = $tpl->getContext() ;
$_translator = $tpl->getTranslator() ;
?>
<div id="sidebar">				
		<?php 
/* tag "ul" from line 187 */ ;
if (\MVC\Base\SessionRegistry::instance()->getCurrentUser()->isAdmin()):  ;
?>
<ul>									
			<?php 
/* tag "li" from line 188 */ ;
if (null !== ($_tmp_1 = ($ctx->ActiveAdmin=='Presentation'?'active':'disable'))):  ;
$_tmp_1 = ' class="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<li<?php echo $_tmp_1 ?>
>
				<?php 
/* tag "a" from line 189 */ ;
if (null !== ($_tmp_2 = ('/admin/setting/presentation'))):  ;
$_tmp_2 = ' href="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a<?php echo $_tmp_2 ?>
>
					<?php /* tag "i" from line 190 */; ?>
<i class="glyphicons-picture"></i>TRÌNH BÀY
				</a>
			</li>
			<?php 
/* tag "li" from line 193 */ ;
if (null !== ($_tmp_3 = ($ctx->ActiveAdmin=='Tag'?'active':'disable'))):  ;
$_tmp_3 = ' class="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<li<?php echo $_tmp_3 ?>
>
				<?php 
/* tag "a" from line 194 */ ;
if (null !== ($_tmp_2 = ('/admin/setting/tag'))):  ;
$_tmp_2 = ' href="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a<?php echo $_tmp_2 ?>
>
					<?php /* tag "i" from line 195 */; ?>
<i class="glyphicons-book"></i>THẺ BÀI
				</a>
			</li>
			<?php 
/* tag "li" from line 198 */ ;
if (null !== ($_tmp_1 = ($ctx->ActiveAdmin=='Post'?'active':'disable'))):  ;
$_tmp_1 = ' class="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<li<?php echo $_tmp_1 ?>
>
				<?php 
/* tag "a" from line 199 */ ;
if (null !== ($_tmp_2 = ('/admin/setting/post'))):  ;
$_tmp_2 = ' href="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a<?php echo $_tmp_2 ?>
>
					<?php /* tag "i" from line 200 */; ?>
<i class="glyphicons-book"></i>BÀI VIẾT
				</a>
			</li>
			<?php 
/* tag "li" from line 203 */ ;
if (null !== ($_tmp_3 = ($ctx->ActiveAdmin=='StoryLine'?'active':'disable'))):  ;
$_tmp_3 = ' class="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<li<?php echo $_tmp_3 ?>
>
				<?php 
/* tag "a" from line 204 */ ;
if (null !== ($_tmp_2 = ('/admin/setting/storyline'))):  ;
$_tmp_2 = ' href="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a<?php echo $_tmp_2 ?>
>
					<?php /* tag "i" from line 205 */; ?>
<i class="glyphicons-book"></i>CÂU CHUYỆN KHÁCH HÀNG
				</a>
			</li>
		</ul><?php endif; ?>

	</div><?php 
}

 ?>
<?php 
function tpl_543cf509_mAdmin__Mms8g3XlZpTuHI9n6IQWGg_MenuSettingGeneral(PHPTAL $_thistpl, PHPTAL $tpl) {
$tpl = clone $tpl ;
$ctx = $tpl->getContext() ;
$_translator = $tpl->getTranslator() ;
?>
<div id="sidebar">				
		<?php 
/* tag "ul" from line 167 */ ;
if (\MVC\Base\SessionRegistry::instance()->getCurrentUser()->isAdmin()):  ;
?>
<ul>									
			<?php 
/* tag "li" from line 168 */ ;
if (null !== ($_tmp_3 = ($ctx->ActiveAdmin=='Branch'?'active':'disable'))):  ;
$_tmp_3 = ' class="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<li<?php echo $_tmp_3 ?>
>
				<?php 
/* tag "a" from line 169 */ ;
if (null !== ($_tmp_2 = ('/admin/setting/branch'))):  ;
$_tmp_2 = ' href="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a<?php echo $_tmp_2 ?>
>
					<?php /* tag "i" from line 170 */; ?>
<i class="glyphicons-group"></i>CHI NHÁNH
				</a>
			</li>
			<?php 
/* tag "li" from line 173 */ ;
if (null !== ($_tmp_1 = ($ctx->ActiveAdmin=='User'?'active':'disable'))):  ;
$_tmp_1 = ' class="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<li<?php echo $_tmp_1 ?>
>
				<?php 
/* tag "a" from line 174 */ ;
if (null !== ($_tmp_2 = ('/admin/setting/user'))):  ;
$_tmp_2 = ' href="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a<?php echo $_tmp_2 ?>
>
					<?php /* tag "i" from line 175 */; ?>
<i class="glyphicons-group"></i>NGƯỜI DÙNG 
				</a>
			</li>			
			<?php 
/* tag "li" from line 178 */ ;
if (null !== ($_tmp_3 = ($ctx->ActiveAdmin=='Config'?'active':'disable'))):  ;
$_tmp_3 = ' class="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<li<?php echo $_tmp_3 ?>
>
				<?php 
/* tag "a" from line 179 */ ;
if (null !== ($_tmp_2 = ('/admin/setting/config'))):  ;
$_tmp_2 = ' href="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a<?php echo $_tmp_2 ?>
>
					<?php /* tag "i" from line 180 */; ?>
<i class="glyphicons-cogwheel"></i>CẤU HÌNH
				</a>
			</li>
		</ul><?php endif; ?>

	</div><?php 
}

 ?>
<?php 
function tpl_543cf509_mAdmin__Mms8g3XlZpTuHI9n6IQWGg_MenuSetting(PHPTAL $_thistpl, PHPTAL $tpl) {
$tpl = clone $tpl ;
$ctx = $tpl->getContext() ;
$_translator = $tpl->getTranslator() ;
?>
<div id="sidebar">				
		<?php 
/* tag "ul" from line 127 */ ;
if (\MVC\Base\SessionRegistry::instance()->getCurrentUser()->isAdmin()):  ;
?>
<ul>
			<?php 
/* tag "li" from line 128 */ ;
if (null !== ($_tmp_1 = ($ctx->ActiveAdmin=='Presentation'?'active':'disable'))):  ;
$_tmp_1 = ' class="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<li<?php echo $_tmp_1 ?>
>
				<?php 
/* tag "a" from line 129 */ ;
if (null !== ($_tmp_2 = ('/admin/setting/presentation'))):  ;
$_tmp_2 = ' href="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a<?php echo $_tmp_2 ?>
>
					<?php /* tag "i" from line 130 */; ?>
<i class="glyphicons-picture"></i>TRÌNH BÀY
				</a>
			</li>
			<?php 
/* tag "li" from line 133 */ ;
if (null !== ($_tmp_3 = ($ctx->ActiveAdmin=='Tag'?'active':'disable'))):  ;
$_tmp_3 = ' class="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<li<?php echo $_tmp_3 ?>
>
				<?php 
/* tag "a" from line 134 */ ;
if (null !== ($_tmp_2 = ('/admin/setting/tag'))):  ;
$_tmp_2 = ' href="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a<?php echo $_tmp_2 ?>
>
					<?php /* tag "i" from line 135 */; ?>
<i class="glyphicons-book"></i>THẺ BÀI
				</a>
			</li>
			<?php 
/* tag "li" from line 138 */ ;
if (null !== ($_tmp_1 = ($ctx->ActiveAdmin=='Post'?'active':'disable'))):  ;
$_tmp_1 = ' class="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<li<?php echo $_tmp_1 ?>
>
				<?php 
/* tag "a" from line 139 */ ;
if (null !== ($_tmp_2 = ('/admin/setting/post'))):  ;
$_tmp_2 = ' href="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a<?php echo $_tmp_2 ?>
>
					<?php /* tag "i" from line 140 */; ?>
<i class="glyphicons-book"></i>BÀI VIẾT
				</a>
			</li>
			<?php 
/* tag "li" from line 143 */ ;
if (null !== ($_tmp_3 = ($ctx->ActiveAdmin=='Supplier'?'active':'disable'))):  ;
$_tmp_3 = ' class="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<li<?php echo $_tmp_3 ?>
>
				<?php 
/* tag "a" from line 144 */ ;
if (null !== ($_tmp_2 = ('/admin/setting/supplier'))):  ;
$_tmp_2 = ' href="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a<?php echo $_tmp_2 ?>
>
					<?php /* tag "i" from line 145 */; ?>
<i class="glyphicons-truck"></i>NHÀ CUNG CẤP
				</a>
			</li>
			<?php 
/* tag "li" from line 148 */ ;
if (null !== ($_tmp_1 = ($ctx->ActiveAdmin=='Category'?'active':'disable'))):  ;
$_tmp_1 = ' class="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<li<?php echo $_tmp_1 ?>
>
				<?php 
/* tag "a" from line 149 */ ;
if (null !== ($_tmp_2 = ('/admin/setting/category'))):  ;
$_tmp_2 = ' href="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a<?php echo $_tmp_2 ?>
>
					<?php /* tag "i" from line 150 */; ?>
<i class="glyphicons-truck"></i>DANH MỤC SẢN PHẨM
				</a>
			</li>
			<?php 
/* tag "li" from line 153 */ ;
if (null !== ($_tmp_3 = ($ctx->ActiveAdmin=='User'?'active':'disable'))):  ;
$_tmp_3 = ' class="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<li<?php echo $_tmp_3 ?>
>
				<?php 
/* tag "a" from line 154 */ ;
if (null !== ($_tmp_2 = ('/admin/setting/user'))):  ;
$_tmp_2 = ' href="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a<?php echo $_tmp_2 ?>
>
					<?php /* tag "i" from line 155 */; ?>
<i class="glyphicons-group"></i>NGƯỜI DÙNG 
				</a>
			</li>
			<?php 
/* tag "li" from line 158 */ ;
if (null !== ($_tmp_1 = ($ctx->ActiveAdmin=='Config'?'active':'disable'))):  ;
$_tmp_1 = ' class="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<li<?php echo $_tmp_1 ?>
>
				<?php 
/* tag "a" from line 159 */ ;
if (null !== ($_tmp_2 = ('/admin/setting/config'))):  ;
$_tmp_2 = ' href="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a<?php echo $_tmp_2 ?>
>
					<?php /* tag "i" from line 160 */; ?>
<i class="glyphicons-cogwheel"></i>CẤU HÌNH
				</a>
			</li>
		</ul><?php endif; ?>
	
	</div><?php 
}

 ?>
<?php 
function tpl_543cf509_mAdmin__Mms8g3XlZpTuHI9n6IQWGg_MenuApp(PHPTAL $_thistpl, PHPTAL $tpl) {
$tpl = clone $tpl ;
$ctx = $tpl->getContext() ;
$_translator = $tpl->getTranslator() ;
?>
<div id="sidebar">
		<?php 
/* tag "ul" from line 116 */ ;
if (\MVC\Base\SessionRegistry::instance()->getCurrentUser()->isAdmin()):  ;
?>
<ul>						
			<?php 
/* tag "li" from line 117 */ ;
if (null !== ($_tmp_3 = ($ctx->ActiveAdmin=='Setting'?'active':'disable'))):  ;
$_tmp_3 = ' class="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<li<?php echo $_tmp_3 ?>
>
				<?php 
/* tag "a" from line 118 */ ;
if (null !== ($_tmp_2 = ('/admin/setting'))):  ;
$_tmp_2 = ' href="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a<?php echo $_tmp_2 ?>
><?php /* tag "i" from line 118 */; ?>
<i class="glyphicons-cogwheels"></i>THIẾT LẬP</a>
			</li>
		</ul><?php endif; ?>

	</div><?php 
}

 ?>
<?php 
function tpl_543cf509_mAdmin__Mms8g3XlZpTuHI9n6IQWGg_PageBar(PHPTAL $_thistpl, PHPTAL $tpl) {
$tpl = clone $tpl ;
$ctx = $tpl->getContext() ;
$_translator = $tpl->getTranslator() ;
?>
<ul class="pagination alternate pull-right page-bar">
		<?php 
/* tag "li" from line 107 */ ;
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
/* tag "a" from line 108 */ ;
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

	</ul><?php 
}

 ?>
<?php 
function tpl_543cf509_mAdmin__Mms8g3XlZpTuHI9n6IQWGg_ContentHeader(PHPTAL $_thistpl, PHPTAL $tpl) {
$tpl = clone $tpl ;
$ctx = $tpl->getContext() ;
$_translator = $tpl->getTranslator() ;
?>
<div id="content-header">
		<?php /* tag "h1" from line 100 */; ?>
<h1>HỆ THỐNG QUẢN LÝ <?php /* tag "span" from line 100 */; ?>
<span><?php 
$ctx->noThrow(true) ;
if (!phptal_isempty($_tmp_2 = $ctx->path($ctx->ConfigName, 'getValue', true))):  ;
?>
<?php 
echo phptal_escape($_tmp_2) ;
else:  ;
?>
<?php 
echo 'cửa hàng' ;
endif ;
$ctx->noThrow(false) ;
?>
</span></h1>
	</div><?php 
}

 ?>
<?php 
function tpl_543cf509_mAdmin__Mms8g3XlZpTuHI9n6IQWGg_LocationBar(PHPTAL $_thistpl, PHPTAL $tpl) {
$tpl = clone $tpl ;
$ctx = $tpl->getContext() ;
$_translator = $tpl->getTranslator() ;
?>
<div id="breadcrumb">
		<?php /* tag "a" from line 91 */; ?>
<a class="tip-bottom" title="" href="/admin" data-original-title="Về ứng dụng"><?php /* tag "i" from line 91 */; ?>
<i class="glyphicons-shop"></i> HỆ THỐNG</a>
		<?php 
/* tag "a" from line 92 */ ;
$_tmp_1 = $ctx->repeat ;
$_tmp_1->Item = new PHPTAL_RepeatController($ctx->Navigation)
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_1->Item as $ctx->Item): ;
if (null !== ($_tmp_2 = ($ctx->Item[1]))):  ;
$_tmp_2 = ' href="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a data-original-title="Về trang này" class="tip-bottom"<?php echo $_tmp_2 ?>
><?php echo phptal_escape($ctx->Item[0]); ?>
</a><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

		<?php /* tag "a" from line 93 */; ?>
<a class="current"><?php echo phptal_escape($ctx->Title); ?>
</a>
	</div><?php 
}

 ?>
<?php 
function tpl_543cf509_mAdmin__Mms8g3XlZpTuHI9n6IQWGg_Header(PHPTAL $_thistpl, PHPTAL $tpl) {
$tpl = clone $tpl ;
$ctx = $tpl->getContext() ;
$_translator = $tpl->getTranslator() ;
?>
<div>
		<?php /* tag "div" from line 67 */; ?>
<div id="header">
			<?php /* tag "h1" from line 68 */; ?>
<h1><?php /* tag "a" from line 68 */; ?>
<a>Nhà hàng </a></h1>
			<?php /* tag "a" from line 69 */; ?>
<a id="menu-trigger" href="#"><?php /* tag "i" from line 69 */; ?>
<i class="glyphicon glyphicon-align-justify"></i></a>	
		</div>
		<?php /* tag "div" from line 71 */; ?>
<div id="user-nav">			
            <?php /* tag "ul" from line 72 */; ?>
<ul class="btn-group">
				<?php /* tag "li" from line 73 */; ?>
<li class="btn">
					<?php /* tag "a" from line 74 */; ?>
<a class="tip-bottom" data-original-title="Click để đăng nhập" href="/signin/load">
						<?php /* tag "i" from line 75 */; ?>
<i class="glyphicons-imac" style="margin-top:-5px;margin-right:5px;"></i> <?php /* tag "span" from line 75 */; ?>
<span><?php echo phptal_escape(\MVC\Library\Statistic::getIPPrint()); ?>
</span>
					</a>
				</li>
                <?php /* tag "li" from line 78 */; ?>
<li class="btn">
					<?php /* tag "a" from line 79 */; ?>
<a class="tip-bottom" data-original-title="Click để đăng xuất" href="/signout/exe">
						<?php /* tag "i" from line 80 */; ?>
<i class="glyphicon glyphicon-user"></i> <?php 
/* tag "span" from line 80 */ ;
if (\MVC\Base\SessionRegistry::instance()->getCurrentUser()):  ;
?>
<span class="text"><?php echo phptal_escape(\MVC\Base\SessionRegistry::instance()->getCurrentUser()->getEmail()); ?>
</span><?php endif; ?>

					</a>
				</li>
            </ul>
        </div>
	</div><?php 
}

 ?>
<?php 
function tpl_543cf509_mAdmin__Mms8g3XlZpTuHI9n6IQWGg_IncludeJS(PHPTAL $_thistpl, PHPTAL $tpl) {
$tpl = clone $tpl ;
$ctx = $tpl->getContext() ;
$_translator = $tpl->getTranslator() ;
?>
<span>						
		<?php /* tag "script" from line 45 */; ?>
<script src="/mvc/templates/theme/cms/js/jquery.min.js"></script>
		<?php /* tag "script" from line 46 */; ?>
<script src="/mvc/templates/theme/cms/js/jquery-ui.custom.js"></script>
		<?php /* tag "script" from line 47 */; ?>
<script src="/mvc/templates/theme/cms/js/bootstrap.min.js"></script>
		<?php /* tag "script" from line 48 */; ?>
<script src="/mvc/templates/theme/cms/js/unicorn.js"></script>
		<?php /* tag "script" from line 49 */; ?>
<script src="/mvc/templates/theme/cms/js/jquery.jpanelmenu.min.js"></script>
		<?php /* tag "script" from line 50 */; ?>
<script src="/mvc/templates/theme/cms/js/jquery.icheck.min.js"></script>
		<?php /* tag "script" from line 51 */; ?>
<script src="/mvc/templates/theme/cms/js/select2.min.js"></script>
		<?php /* tag "script" from line 52 */; ?>
<script src="/mvc/templates/theme/cms/js/jquery.dataTables.min.js"></script>
		<?php /* tag "script" from line 53 */; ?>
<script src="/mvc/templates/theme/cms/js/unicorn.tables.js"></script>
		<?php /* tag "script" from line 54 */; ?>
<script src="/mvc/templates/theme/cms/js/jquery.gritter.min.js"></script>
		<?php /* tag "script" from line 55 */; ?>
<script src="/mvc/templates/theme/cms/js/bootstrap-datepicker.js"></script>
		<?php /* tag "script" from line 56 */; ?>
<script src="/mvc/templates/theme/cms/js/bootstrap-datepicker.vi.js"></script>				                                   
        <?php /* tag "script" from line 57 */; ?>
<script src="/mvc/templates/theme/cms/js/jquery.masonry.min.js"></script>
		<?php /* tag "script" from line 58 */; ?>
<script src="/mvc/templates/theme/cms/js/bootstrap-datetimepicker.js"></script>
		<?php /* tag "script" from line 59 */; ?>
<script src="/mvc/templates/theme/cms/js/bootstrap-datetimepicker.vi.js"></script>
		<?php /* tag "script" from line 60 */; ?>
<script src="/mvc/templates/theme/cms/js/jquery.validate.js"></script>		
	</span><?php 
}

 ?>
<?php 
function tpl_543cf509_mAdmin__Mms8g3XlZpTuHI9n6IQWGg_IncludeCSS(PHPTAL $_thistpl, PHPTAL $tpl) {
$tpl = clone $tpl ;
$ctx = $tpl->getContext() ;
$_translator = $tpl->getTranslator() ;
?>
<span>	
		<?php /* tag "link" from line 26 */; ?>
<link rel="stylesheet" href="/mvc/templates/theme/cms/css/icheck/flat/blue.css"/>
		<?php /* tag "link" from line 27 */; ?>
<link rel="stylesheet" href="/mvc/templates/theme/cms/css/select2.css"/>
		<?php /* tag "link" from line 28 */; ?>
<link rel="stylesheet" href="/mvc/templates/theme/cms/css/bootstrap.min.css"/>
		<?php /* tag "link" from line 29 */; ?>
<link rel="stylesheet" href="/mvc/templates/theme/cms/css/bootstrap-glyphicons.css"/>
		<?php /* tag "link" from line 30 */; ?>
<link rel="stylesheet" href="/mvc/templates/theme/cms/css/glyphicons-regular.css"/>
		<?php /* tag "link" from line 31 */; ?>
<link rel="stylesheet" href="/mvc/templates/theme/cms/css/jquery-ui.css"/>
		<?php /* tag "link" from line 32 */; ?>
<link rel="stylesheet" href="/mvc/templates/theme/cms/css/unicorn.main.css"/>
		<?php /* tag "link" from line 33 */; ?>
<link rel="stylesheet" href="/mvc/templates/theme/cms/css/datepicker.css"/>
		<?php /* tag "link" from line 34 */; ?>
<link rel="stylesheet" href="/mvc/templates/theme/cms/css/datetimepicker.css"/>
		<?php /* tag "link" from line 35 */; ?>
<link rel="stylesheet" href="/mvc/templates/theme/cms/css/custom.css"/>
		<?php /* tag "link" from line 36 */; ?>
<link rel="stylesheet" href="/mvc/templates/theme/cms/css/grid-menu.css"/>
		<?php /* tag "link" from line 37 */; ?>
<link rel="stylesheet" href="/mvc/templates/theme/cms/css/jquery.gritter.css"/>
		<?php 
/* tag "link" from line 38 */ ;
if (null !== ($_tmp_1 = ('/mvc/templates/theme/cms/css/unicorn.' . \MVC\Base\SessionRegistry::instance()->getCurrentTheme() . '.css'))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<link rel="stylesheet" class="skin-color"<?php echo $_tmp_1 ?>
/>										
	</span><?php 
}

 ?>
<?php 
function tpl_543cf509_mAdmin__Mms8g3XlZpTuHI9n6IQWGg_IncludeMETA(PHPTAL $_thistpl, PHPTAL $tpl) {
$tpl = clone $tpl ;
$ctx = $tpl->getContext() ;
$_translator = $tpl->getTranslator() ;
?>
<span>
		<?php /* tag "title" from line 7 */; ?>
<title><?php echo 'Hệ thống quản lý nhà hàng'; ?>
</title>
		<?php /* tag "base" from line 8 */; ?>
<base href="http://huongsenhong.com"/>
		<?php /* tag "meta" from line 9 */; ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<?php /* tag "meta" from line 10 */; ?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<?php /* tag "meta" from line 11 */; ?>
<meta http-equiv="Pragma" content="no-cache"/>
		<?php /* tag "meta" from line 12 */; ?>
<meta http-equiv="Expires" content="-1"/>
		<?php /* tag "meta" from line 13 */; ?>
<meta http-equiv="Cache-Control" content="no-cache"/>
		<?php /* tag "meta" from line 14 */; ?>
<meta name="keywords" content="Hệ thống quản lý nhà hàng"/>
		<?php /* tag "meta" from line 15 */; ?>
<meta name="description" content="Hệ thống quản lý nhà hàng"/>
		<?php /* tag "meta" from line 16 */; ?>
<meta name="page-topic" content="Hệ thống quản lý nhà hàng"/>
		<?php /* tag "meta" from line 17 */; ?>
<meta name="Abstract" content="Hệ thống quản lý nhà hàng"/>
		<?php /* tag "meta" from line 18 */; ?>
<meta name="classification" content="Hệ thống quản lý nhà hàng"/>
		<?php /* tag "link" from line 19 */; ?>
<link rel="shortcut icon" type="image/png" href="/data/images/icon.ico"/>
	</span><?php 
}

 ?>
<?php 
function tpl_543cf509_mAdmin__Mms8g3XlZpTuHI9n6IQWGg(PHPTAL $tpl, PHPTAL_Context $ctx) {
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
	<?php /* tag "span" from line 6 */; ?>

	
	<!-- ======================================================================== -->
	<!-- CASCADING STYLE SHEETS INCLUDE											  -->
	<!-- ======================================================================== -->
	<?php /* tag "span" from line 25 */; ?>

	
	<!-- ======================================================================== -->
	<!-- JAVASCRIPT INCLUDE														  -->
	<!-- ======================================================================== -->
	<?php /* tag "span" from line 44 */; ?>

	
	<!-- ======================================================================== -->
	<!-- HEADER																	  -->
	<!-- ======================================================================== -->
	<?php /* tag "div" from line 66 */; ?>


	<!-- ======================================================================== -->
	<!-- LOCATION BAR															  -->
	<!-- ======================================================================== -->
	<?php /* tag "div" from line 90 */; ?>

	
	<!-- ======================================================================== -->
	<!-- CONTENT HEADER															  -->
	<!-- ======================================================================== -->	
	<?php /* tag "div" from line 99 */; ?>

	
	<!-- ======================================================================== -->
	<!-- PAGE BAR																  -->
	<!-- ======================================================================== -->
	<?php /* tag "ul" from line 106 */; ?>

	
	<!-- ======================================================================== -->
	<!-- MENU.APP															  	  -->
	<!-- ======================================================================== -->
	<?php /* tag "div" from line 115 */; ?>

	
	<!-- ======================================================================== -->
	<!-- MENU.SETTING															  -->
	<!-- ======================================================================== -->
	<?php /* tag "div" from line 126 */; ?>

	
	<?php /* tag "div" from line 166 */; ?>

	
	<?php /* tag "div" from line 186 */; ?>

	
	<?php /* tag "div" from line 211 */; ?>

	
	<!-- ======================================================================== -->
	<!-- FOOTER																	  -->
	<!-- ======================================================================== -->
	<?php /* tag "div" from line 239 */; ?>

	
	<!-- ======================================================================== -->
	<!-- STYLE SWITCHER															  -->
	<!-- ======================================================================== -->
	<?php /* tag "div" from line 248 */; ?>


</body>
</html><?php 
/* end */ ;

}

?>
<?php /* 
*** DO NOT EDIT THIS FILE ***

Generated by PHPTAL from G:\AppsWeb\cmsA\www.huongsenhong.com\mvc\templates\mAdmin.xhtml (edit that file instead) */; ?>