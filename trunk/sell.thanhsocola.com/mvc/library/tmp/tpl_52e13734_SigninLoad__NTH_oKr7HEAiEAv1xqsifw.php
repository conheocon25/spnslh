<?php 
function tpl_52e13734_SigninLoad__NTH_oKr7HEAiEAv1xqsifw(PHPTAL $tpl, PHPTAL_Context $ctx) {
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

		<?php /* tag "link" from line 5 */; ?>
<link rel="stylesheet" type="text/css" href="/mvc/templates/theme/cms/css/glyphicons-regular.css"/>
		<?php /* tag "link" from line 6 */; ?>
<link rel="stylesheet" type="text/css" href="/mvc/templates/theme/cms/css/login.bootstrap.css"/>
        <?php /* tag "link" from line 7 */; ?>
<link rel="stylesheet" type="text/css" href="/mvc/templates/theme/cms/css/login.unicorn.css"/>
	</head>
	<?php /* tag "body" from line 9 */; ?>
<body>
		<?php /* tag "div" from line 10 */; ?>
<div id="container">
            <?php /* tag "div" from line 11 */; ?>
<div id="logo">
                <?php /* tag "img" from line 12 */; ?>
<img src="/mvc/templates/theme/cms/img/login.png" alt="logo"/>
            </div>
            <?php /* tag "div" from line 14 */; ?>
<div id="user">
                <?php /* tag "div" from line 15 */; ?>
<div class="avatar">
                    <?php /* tag "div" from line 16 */; ?>
<div class="inner"></div>
                    <?php /* tag "img" from line 17 */; ?>
<img src="/mvc/templates/theme/cms/img/av.jpg"/>
                </div>
                <?php /* tag "div" from line 19 */; ?>
<div class="text">
                    <?php /* tag "h4" from line 20 */; ?>
<h4>Đang xác thực . . . <?php /* tag "p" from line 20 */; ?>
<p class="user_name" style="padding:5px 0;"></p></h4>
                </div>
            </div>
            <?php /* tag "div" from line 23 */; ?>
<div id="loginbox">
				<?php /* tag "form" from line 24 */; ?>
<form id="loginform" action="/signin/exe" method="post" autocomplete="off">
    				<?php /* tag "h4" from line 25 */; ?>
<h4 style="padding:10px 0;">
						ĐĂNG NHẬP
					</h4>
                    <?php /* tag "div" from line 28 */; ?>
<div class="input-group input-sm">
                        <?php /* tag "span" from line 29 */; ?>
<span class="input-group-addon"><?php /* tag "i" from line 29 */; ?>
<i class="glyphicons-user"></i></span>
						<?php /* tag "input" from line 30 */; ?>
<input class="form-control" name="Email" id="username" placeholder="Email" type="text"/>
                    </div>
                    <?php /* tag "div" from line 32 */; ?>
<div class="input-group">
                        <?php /* tag "span" from line 33 */; ?>
<span class="input-group-addon"><?php /* tag "i" from line 33 */; ?>
<i class="glyphicons-unlock"></i></span>
						<?php /* tag "input" from line 34 */; ?>
<input class="form-control" name="Pass" id="password" placeholder="Mật khẩu" type="password"/>
                    </div>
                    <?php /* tag "div" from line 36 */; ?>
<div class="form-actions clearfix">                        
                        <?php /* tag "div" from line 37 */; ?>
<div class="pull-right">
                            <?php /* tag "a" from line 38 */; ?>
<a class="flip-link to-recover grey">Quên mật khẩu?</a>
                        </div>
                        <?php /* tag "button" from line 40 */; ?>
<button class="btn btn-block btn-primary btn-default" value="Đăng nhập" type="submit">
							Đăng nhập <?php /* tag "i" from line 41 */; ?>
<i class="glyphicons-log_in"></i>
						</button>
						<?php /* tag "small" from line 43 */; ?>
<small style="display:block;margin-top:20px;">
							2012 - 2013 &copy; <?php /* tag "a" from line 44 */; ?>
<a href="https://www.spn-soft.com">SPN Group</a>
						</small>
                    </div>					
                </form>
                <?php /* tag "form" from line 48 */; ?>
<form id="recoverform" action="#" autocomplete="off">
    				<?php /* tag "p" from line 49 */; ?>
<p>Nhập email để chúng tôi phục hồi mật khẩu cho bạn</p>
    				<?php /* tag "div" from line 50 */; ?>
<div class="input-group">
                        <?php /* tag "span" from line 51 */; ?>
<span class="input-group-addon"><?php /* tag "i" from line 51 */; ?>
<i class="glyphicons-envelope"></i></span>
						<?php /* tag "input" from line 52 */; ?>
<input class="form-control" placeholder="E-mail address" type="text"/>
                    </div>
                    <?php /* tag "div" from line 54 */; ?>
<div class="form-actions clearfix">
                        <?php /* tag "div" from line 55 */; ?>
<div class="pull-left">
                            <?php /* tag "a" from line 56 */; ?>
<a class="grey flip-link to-login">Đăng nhập</a>
                        </div>
                        <?php /* tag "button" from line 58 */; ?>
<button class="btn btn-block btn-success" value="Phục hồi" type="submit">
							Phục hồi <?php /* tag "i" from line 59 */; ?>
<i class="glyphicons-history"></i>
						</button>
                    </div>
                </form>
            </div>
        </div>
		
		<?php /* tag "script" from line 66 */; ?>
<script type="text/javascript" language="javascript" src="/mvc/templates/theme/cms/js/login.jquery.js"></script> 
        <?php /* tag "script" from line 67 */; ?>
<script type="text/javascript" language="javascript" src="/mvc/templates/theme/cms/js/login.jquery.ui.js"></script>
		<?php /* tag "script" from line 68 */; ?>
<script type="text/javascript" language="javascript" src="/mvc/templates/theme/cms/js/login.unicorn.js"></script>
	</body>
</html><?php 
/* end */ ;

}

?>
<?php /* 
*** DO NOT EDIT THIS FILE ***

Generated by PHPTAL from G:\AppsWeb\cmsA\sell.thanhsocola.com\mvc\templates\SigninLoad.html (edit that file instead) */; ?>