<?php 
function tpl_543e37e1_mFront__QFFtSQlAAKfcf2fV8yq2Gg_AdsService(PHPTAL $_thistpl, PHPTAL $tpl) {
$tpl = clone $tpl ;
$ctx = $tpl->getContext() ;
$_translator = $tpl->getTranslator() ;
?>
<div class="widget banner-slider-container">
		<?php /* tag "div" from line 573 */; ?>
<div class="banner-slider flexslider">
			<?php /* tag "ul" from line 574 */; ?>
<ul class="banner-slider-list clearfix">
				<?php 
/* tag "li" from line 575 */ ;
$_tmp_3 = $ctx->repeat ;
$_tmp_3->Slide = new PHPTAL_RepeatController($ctx->path($ctx->Presentation2, 'getSlideAll'))
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_3->Slide as $ctx->Slide): ;
?>
<li>
					<?php 
/* tag "a" from line 576 */ ;
if (null !== ($_tmp_4 = ($ctx->path($ctx->Slide, 'getURL')))):  ;
$_tmp_4 = ' href="'.phptal_escape($_tmp_4).'"' ;
else:  ;
$_tmp_4 = '' ;
endif ;
?>
<a<?php echo $_tmp_4 ?>
>
						<?php /* tag "span" from line 577 */; ?>
<span><?php echo phptal_tostring($ctx->path($ctx->Slide, 'getNote')); ?>
</span>
					</a>
				</li><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

			</ul>
		</div>
	</div><?php 
}

 ?>
<?php 
function tpl_543e37e1_mFront__QFFtSQlAAKfcf2fV8yq2Gg_OptionPanel(PHPTAL $_thistpl, PHPTAL $tpl) {
$tpl = clone $tpl ;
$ctx = $tpl->getContext() ;
$_translator = $tpl->getTranslator() ;
?>
<div id="option-panel">
		<?php /* tag "div" from line 344 */; ?>
<div id="option-panel-wrapper">
			<?php /* tag "div" from line 345 */; ?>
<div id="option-panel-btn"></div><!-- End #option-panel-btn -->
			<?php /* tag "div" from line 346 */; ?>
<div id="option-panel-container">
				<?php /* tag "ul" from line 347 */; ?>
<ul id="option-panel-tabs-container" class="clearfix">
					<?php /* tag "li" from line 348 */; ?>
<li class="active"><?php /* tag "a" from line 348 */; ?>
<a href="#panel-layout" data-toggle="tab" data-panel-title="Layout"></a></li>
					<?php /* tag "li" from line 349 */; ?>
<li><?php /* tag "a" from line 349 */; ?>
<a href="#panel-home" data-toggle="tab" data-panel-title="Background Settings"></a></li>
					<?php /* tag "li" from line 350 */; ?>
<li><?php /* tag "a" from line 350 */; ?>
<a href="#panel-color" data-toggle="tab" data-panel-title="Color Settings"></a></li>
					<?php /* tag "li" from line 351 */; ?>
<li><?php /* tag "a" from line 351 */; ?>
<a href="#panel-font" data-toggle="tab" data-panel-title="Font Settings"></a></li>
					<?php /* tag "li" from line 352 */; ?>
<li><?php /* tag "a" from line 352 */; ?>
<a id="option-close" href="#"></a></li>
				</ul>
				<?php /* tag "div" from line 354 */; ?>
<div id="option-panel-title" class="clearfix">
					<?php /* tag "span" from line 355 */; ?>
<span>Layout</span>
					<?php /* tag "a" from line 356 */; ?>
<a href="#" id="option-panel-reset">Reset</a>
				</div>
				<?php /* tag "div" from line 358 */; ?>
<div id="option-panel-content" class="tab-content">
					<?php /* tag "div" from line 359 */; ?>
<div class="tab-pane fade in active" id="panel-layout">
						<?php /* tag "div" from line 360 */; ?>
<div id="panel-option-layout" class="panel-group custom-accordion sm-accordion">
							<?php /* tag "div" from line 361 */; ?>
<div class="panel">
								<?php /* tag "div" from line 362 */; ?>
<div class="accordion-header">
									<?php /* tag "div" from line 363 */; ?>
<div class="accordion-title"><?php /* tag "span" from line 363 */; ?>
<span>Layout</span></div><!-- End .accordion-title -->
									<?php /* tag "a" from line 364 */; ?>
<a class="accordion-btn opened" data-toggle="collapse" data-target="#document-layout" data-parent="#panel-option-layout"></a>
								</div><!-- End .accordion-header -->

								<?php /* tag "div" from line 367 */; ?>
<div id="document-layout" class="collapse in">
									<?php /* tag "div" from line 368 */; ?>
<div class="panel-body">
										<?php /* tag "ul" from line 369 */; ?>
<ul class="layout-style-list clearfix">
											<?php /* tag "li" from line 370 */; ?>
<li data-layout="fullwidth">
												<?php /* tag "img" from line 371 */; ?>
<img src="/mvc/templates/front/images/panel/fullwidth.png" alt="Fullwidth"/>
												<?php /* tag "p" from line 372 */; ?>
<p>Fullwidth</p>
											</li>
											<?php /* tag "li" from line 374 */; ?>
<li data-layout="boxed">
												<?php /* tag "img" from line 375 */; ?>
<img src="/mvc/templates/front/images/panel/boxed.png" alt="Boxed"/>
												<?php /* tag "p" from line 376 */; ?>
<p>Boxed</p>
											</li>
										</ul>
									</div><!-- End .panel-body -->
								</div><!-- #collapse -->
							</div><!-- End .panel -->
						</div><!-- .panel-group -->
					</div><!-- End .tab-pane -->
					<?php /* tag "div" from line 384 */; ?>
<div class="tab-pane fade" id="panel-home">
						<?php /* tag "div" from line 385 */; ?>
<div id="panel-home-accordion" class="panel-group custom-accordion sm-accordion">
							<?php /* tag "div" from line 386 */; ?>
<div class="panel">
								<?php /* tag "div" from line 387 */; ?>
<div class="accordion-header">
									<?php /* tag "div" from line 388 */; ?>
<div class="accordion-title"><?php /* tag "span" from line 388 */; ?>
<span>Basic Color</span></div><!-- End .accordion-title -->
									<?php /* tag "a" from line 389 */; ?>
<a class="accordion-btn opened" data-toggle="collapse" data-target="#body-background-color" data-parent="#panel-home-accordion"></a>
								</div><!-- End .accordion-header -->

								<?php /* tag "div" from line 392 */; ?>
<div id="body-background-color" class="collapse in">
									<?php /* tag "div" from line 393 */; ?>
<div class="panel-body">
										<?php /* tag "div" from line 394 */; ?>
<div id="panel-color-picker">
										</div><!-- End #panel-color-picker -->
									</div><!-- End .panel-body -->
								</div><!-- #collapse -->
							</div><!-- End .panel -->
							<?php /* tag "div" from line 399 */; ?>
<div class="panel">
								<?php /* tag "div" from line 400 */; ?>
<div class="accordion-header">
									<?php /* tag "div" from line 401 */; ?>
<div class="accordion-title"><?php /* tag "span" from line 401 */; ?>
<span>Patterns</span></div><!-- End .accordion-title -->
									<?php /* tag "a" from line 402 */; ?>
<a class="accordion-btn" data-toggle="collapse" data-target="#body-background-pattern" data-parent="#panel-home-accordion"></a>
								</div><!-- End .accordion-header -->
								<?php /* tag "div" from line 404 */; ?>
<div id="body-background-pattern" class="collapse">
									<?php /* tag "div" from line 405 */; ?>
<div class="panel-body">
										<?php /* tag "ul" from line 406 */; ?>
<ul class="clearfix pattern-box-list">
											<?php /* tag "li" from line 407 */; ?>
<li><?php /* tag "img" from line 407 */; ?>
<img data-src="/mvc/templates/front/images/patterns/pattern1.png" src="/mvc/templates/front/images/patterns/pattern1.png" alt="pattern 1"/></li>
											<?php /* tag "li" from line 408 */; ?>
<li><?php /* tag "img" from line 408 */; ?>
<img data-src="/mvc/templates/front/images/patterns/pattern2.png" src="/mvc/templates/front/images/patterns/pattern2.png" alt="pattern 2"/></li>
											<?php /* tag "li" from line 409 */; ?>
<li><?php /* tag "img" from line 409 */; ?>
<img data-src="/mvc/templates/front/images/patterns/pattern3.png" src="/mvc/templates/front/images/patterns/pattern3.png" alt="pattern 3"/></li>
											<?php /* tag "li" from line 410 */; ?>
<li><?php /* tag "img" from line 410 */; ?>
<img data-src="/mvc/templates/front/images/patterns/pattern4.png" src="/mvc/templates/front/images/patterns/pattern4.png" alt="pattern 4"/></li>
											<?php /* tag "li" from line 411 */; ?>
<li><?php /* tag "img" from line 411 */; ?>
<img data-src="/mvc/templates/front/images/patterns/pattern5.png" src="/mvc/templates/front/images/patterns/pattern5.png" alt="pattern 5"/></li>
											<?php /* tag "li" from line 412 */; ?>
<li><?php /* tag "img" from line 412 */; ?>
<img data-src="/mvc/templates/front/images/patterns/pattern6.png" src="/mvc/templates/front/images/patterns/pattern6.png" alt="pattern 6"/></li>
											<?php /* tag "li" from line 413 */; ?>
<li><?php /* tag "img" from line 413 */; ?>
<img data-src="/mvc/templates/front/images/patterns/pattern7.png" src="/mvc/templates/front/images/patterns/pattern7.png" alt="pattern 7"/></li>
											<?php /* tag "li" from line 414 */; ?>
<li><?php /* tag "img" from line 414 */; ?>
<img data-src="/mvc/templates/front/images/patterns/pattern8.png" src="/mvc/templates/front/images/patterns/pattern8.png" alt="pattern 8"/></li>
											<?php /* tag "li" from line 415 */; ?>
<li><?php /* tag "img" from line 415 */; ?>
<img data-src="/mvc/templates/front/images/patterns/pattern9.png" src="/mvc/templates/front/images/patterns/pattern9.png" alt="pattern 9"/></li>
											<?php /* tag "li" from line 416 */; ?>
<li><?php /* tag "img" from line 416 */; ?>
<img data-src="/mvc/templates/front/images/patterns/pattern10.png" src="/mvc/templates/front/images/patterns/pattern10.png" alt="pattern 10"/></li>
											<?php /* tag "li" from line 417 */; ?>
<li><?php /* tag "img" from line 417 */; ?>
<img data-src="/mvc/templates/front/images/patterns/pattern11.png" src="/mvc/templates/front/images/patterns/pattern11.png" alt="pattern 11"/></li>
											<?php /* tag "li" from line 418 */; ?>
<li><?php /* tag "img" from line 418 */; ?>
<img data-src="/mvc/templates/front/images/patterns/pattern12.png" src="/mvc/templates/front/images/patterns/pattern12.png" alt="pattern 12"/></li>
											<?php /* tag "li" from line 419 */; ?>
<li><?php /* tag "img" from line 419 */; ?>
<img data-src="/mvc/templates/front/images/patterns/pattern13.png" src="/mvc/templates/front/images/patterns/pattern13.png" alt="pattern 13"/></li>
											<?php /* tag "li" from line 420 */; ?>
<li><?php /* tag "img" from line 420 */; ?>
<img data-src="/mvc/templates/front/images/patterns/pattern14.png" src="/mvc/templates/front/images/patterns/pattern14.png" alt="pattern 14"/></li>
											<?php /* tag "li" from line 421 */; ?>
<li><?php /* tag "img" from line 421 */; ?>
<img data-src="/mvc/templates/front/images/patterns/pattern15.png" src="/mvc/templates/front/images/patterns/pattern15.png" alt="pattern 15"/></li>
											<?php /* tag "li" from line 422 */; ?>
<li><?php /* tag "img" from line 422 */; ?>
<img data-src="/mvc/templates/front/images/patterns/pattern16.png" src="/mvc/templates/front/images/patterns/pattern16.png" alt="pattern 16"/></li>
											<?php /* tag "li" from line 423 */; ?>
<li><?php /* tag "img" from line 423 */; ?>
<img data-src="/mvc/templates/front/images/patterns/pattern17.png" src="/mvc/templates/front/images/patterns/pattern17.png" alt="pattern 17"/></li>
											<?php /* tag "li" from line 424 */; ?>
<li><?php /* tag "img" from line 424 */; ?>
<img data-src="/mvc/templates/front/images/patterns/pattern18.png" src="/mvc/templates/front/images/patterns/pattern18.png" alt="pattern 18"/></li>
											<?php /* tag "li" from line 425 */; ?>
<li><?php /* tag "img" from line 425 */; ?>
<img data-src="/mvc/templates/front/images/patterns/pattern19.png" src="/mvc/templates/front/images/patterns/pattern19.png" alt="pattern 19"/></li>
											<?php /* tag "li" from line 426 */; ?>
<li><?php /* tag "img" from line 426 */; ?>
<img data-src="/mvc/templates/front/images/patterns/pattern20.png" src="/mvc/templates/front/images/patterns/pattern20.png" alt="pattern 20"/></li>
											<?php /* tag "li" from line 427 */; ?>
<li><?php /* tag "img" from line 427 */; ?>
<img data-src="/mvc/templates/front/images/patterns/pattern21.png" src="/mvc/templates/front/images/patterns/pattern21.png" alt="pattern 21"/></li>
											<?php /* tag "li" from line 428 */; ?>
<li><?php /* tag "img" from line 428 */; ?>
<img data-src="/mvc/templates/front/images/patterns/pattern22.png" src="/mvc/templates/front/images/patterns/pattern22.png" alt="pattern 22"/></li>
											<?php /* tag "li" from line 429 */; ?>
<li><?php /* tag "img" from line 429 */; ?>
<img data-src="/mvc/templates/front/images/patterns/pattern23.png" src="/mvc/templates/front/images/patterns/pattern23.png" alt="pattern 23"/></li>
											<?php /* tag "li" from line 430 */; ?>
<li><?php /* tag "img" from line 430 */; ?>
<img data-src="/mvc/templates/front/images/patterns/pattern24.png" src="/mvc/templates/front/images/patterns/pattern24.png" alt="pattern 24"/></li>
											<?php /* tag "li" from line 431 */; ?>
<li><?php /* tag "img" from line 431 */; ?>
<img data-src="/mvc/templates/front/images/patterns/pattern25.png" src="/mvc/templates/front/images/patterns/pattern25.png" alt="pattern 25"/></li>
											<?php /* tag "li" from line 432 */; ?>
<li><?php /* tag "img" from line 432 */; ?>
<img data-src="/mvc/templates/front/images/patterns/pattern26.png" src="/mvc/templates/front/images/patterns/pattern26.png" alt="pattern 26"/></li>
											<?php /* tag "li" from line 433 */; ?>
<li><?php /* tag "img" from line 433 */; ?>
<img data-src="/mvc/templates/front/images/patterns/pattern27.png" src="/mvc/templates/front/images/patterns/pattern27.png" alt="pattern 27"/></li>
											<?php /* tag "li" from line 434 */; ?>
<li><?php /* tag "img" from line 434 */; ?>
<img data-src="/mvc/templates/front/images/patterns/pattern28.png" src="/mvc/templates/front/images/patterns/pattern28.png" alt="pattern 28"/></li>
											<?php /* tag "li" from line 435 */; ?>
<li><?php /* tag "img" from line 435 */; ?>
<img data-src="/mvc/templates/front/images/patterns/pattern29.png" src="/mvc/templates/front/images/patterns/pattern29.png" alt="pattern 29"/></li>
											<?php /* tag "li" from line 436 */; ?>
<li><?php /* tag "img" from line 436 */; ?>
<img data-src="/mvc/templates/front/images/patterns/pattern30.png" src="/mvc/templates/front/images/patterns/pattern30.png" alt="pattern 30"/></li>
										</ul>
									</div><!-- End .panel-body -->
								</div><!-- #collapse -->
							</div><!-- End .panel -->
						</div><!-- .panel-group -->
					</div><!-- End .tab-pane -->
					<?php /* tag "div" from line 443 */; ?>
<div class="tab-pane fade" id="panel-color">
						<?php /* tag "div" from line 444 */; ?>
<div id="panel-color-accordion" class="panel-group custom-accordion sm-accordion">
							<?php /* tag "div" from line 445 */; ?>
<div class="panel">
								<?php /* tag "div" from line 446 */; ?>
<div class="accordion-header">
									<?php /* tag "div" from line 447 */; ?>
<div class="accordion-title"><?php /* tag "span" from line 447 */; ?>
<span>Green Mode</span></div><!-- End .accordion-title -->
									<?php /* tag "a" from line 448 */; ?>
<a class="accordion-btn opened" data-toggle="collapse" data-target="#color-mode" data-parent="#panel-color-accordion"></a>
								</div><!-- End .accordion-header -->
								<?php /* tag "ul" from line 450 */; ?>
<ul class="colorbox-list clearfix collapse in" id="color-mode">
									<?php /* tag "li" from line 451 */; ?>
<li>
										<?php /* tag "div" from line 452 */; ?>
<div class="color-box first-color">
											<?php /* tag "span" from line 453 */; ?>
<span></span>
										</div>
										<?php /* tag "p" from line 455 */; ?>
<p>First Color</p>
									</li>
									<?php /* tag "li" from line 457 */; ?>
<li>
										<?php /* tag "div" from line 458 */; ?>
<div class="color-box second-color">
											<?php /* tag "span" from line 459 */; ?>
<span></span>
										</div>
										<?php /* tag "p" from line 461 */; ?>
<p>Second Color</p>
									</li>
									<?php /* tag "li" from line 463 */; ?>
<li>
										<?php /* tag "div" from line 464 */; ?>
<div class="color-box third-color">
											<?php /* tag "span" from line 465 */; ?>
<span></span>
										</div>
										<?php /* tag "p" from line 467 */; ?>
<p>Third Color</p>
									</li>
									<?php /* tag "li" from line 469 */; ?>
<li>
										<?php /* tag "div" from line 470 */; ?>
<div class="color-box fourth-color">
											<?php /* tag "span" from line 471 */; ?>
<span></span>
										</div>
										<?php /* tag "p" from line 473 */; ?>
<p>Fourth Color</p>
									</li>
								</ul>
							</div><!-- .panel -->
						</div><!-- #panel-color-accordion -->
					</div><!-- End .tab-pane -->
					<?php /* tag "div" from line 479 */; ?>
<div class="tab-pane fade" id="panel-font">
						<?php /* tag "div" from line 480 */; ?>
<div id="panel-font-accordion" class="panel-group custom-accordion sm-accordion">
							<?php /* tag "div" from line 481 */; ?>
<div class="panel">
								<?php /* tag "div" from line 482 */; ?>
<div class="accordion-header">
									<?php /* tag "div" from line 483 */; ?>
<div class="accordion-title"><?php /* tag "span" from line 483 */; ?>
<span>First Font</span></div><!-- End .accordion-title -->
									<?php /* tag "a" from line 484 */; ?>
<a class="accordion-btn opened" data-toggle="collapse" data-target="#first-font-container" data-parent="#panel-font-accordion"></a>
								</div><!-- End .accordion-header -->
								<?php /* tag "div" from line 486 */; ?>
<div class="collapse in" id="first-font-container">
									<?php /* tag "select" from line 487 */; ?>
<select class="form-control" name="first-font" id="first-font">
										<?php /* tag "option" from line 488 */; ?>
<option value="Arial">Arial</option>
										<?php /* tag "option" from line 489 */; ?>
<option value="Open Sans">Open Sans</option>
										<?php /* tag "option" from line 490 */; ?>
<option value="PT Sans">PT Sans</option>
										<?php /* tag "option" from line 491 */; ?>
<option value="Lato">Lato</option>
										<?php /* tag "option" from line 492 */; ?>
<option value="Roboto">Roboto</option>
										<?php /* tag "option" from line 493 */; ?>
<option value="Droid Sans">Droid Sans</option>
										<?php /* tag "option" from line 494 */; ?>
<option value="Ubuntu">Ubuntu</option>
										<?php /* tag "option" from line 495 */; ?>
<option value="Arvo">Arvo</option>
										<?php /* tag "option" from line 496 */; ?>
<option value="Droid Serif">Ubuntu</option>
										<?php /* tag "option" from line 497 */; ?>
<option value="Nunito">Nunito</option>
									</select>
								</div><!-- End #first-font-container -->
							</div><!-- .panel -->
							<?php /* tag "div" from line 501 */; ?>
<div class="panel">
								<?php /* tag "div" from line 502 */; ?>
<div class="accordion-header">
									<?php /* tag "div" from line 503 */; ?>
<div class="accordion-title"><?php /* tag "span" from line 503 */; ?>
<span>Second Font</span></div><!-- End .accordion-title -->
									<?php /* tag "a" from line 504 */; ?>
<a class="accordion-btn" data-toggle="collapse" data-target="#second-font-container" data-parent="#panel-font-accordion"></a>
								</div><!-- End .accordion-header -->
								<?php /* tag "div" from line 506 */; ?>
<div class="collapse" id="second-font-container">
									<?php /* tag "select" from line 507 */; ?>
<select class="form-control" name="second-font" id="second-font">
										<?php /* tag "option" from line 508 */; ?>
<option value="Oswald">Oswald</option>
										<?php /* tag "option" from line 509 */; ?>
<option value="Gudea">Gudea</option>
										<?php /* tag "option" from line 510 */; ?>
<option value="Open Sans">Open Sans</option>
										<?php /* tag "option" from line 511 */; ?>
<option value="PT Sans">PT Sans</option>
										<?php /* tag "option" from line 512 */; ?>
<option value="Lato">Lato</option>
										<?php /* tag "option" from line 513 */; ?>
<option value="Roboto">Roboto</option>
										<?php /* tag "option" from line 514 */; ?>
<option value="Droid Sans">Droid Sans</option>
										<?php /* tag "option" from line 515 */; ?>
<option value="Ubuntu">Ubuntu</option>
										<?php /* tag "option" from line 516 */; ?>
<option value="Arvo">Arvo</option>
										<?php /* tag "option" from line 517 */; ?>
<option value="Droid Serif">Droid Serif</option>
										<?php /* tag "option" from line 518 */; ?>
<option value="Nunito">Nunito</option>
									</select>
								</div><!-- End #second-font-container -->
							</div><!-- .panel -->
							<?php /* tag "div" from line 522 */; ?>
<div class="panel">
								<?php /* tag "div" from line 523 */; ?>
<div class="accordion-header">
									<?php /* tag "div" from line 524 */; ?>
<div class="accordion-title"><?php /* tag "span" from line 524 */; ?>
<span>Third Font</span></div><!-- End .accordion-title -->
									<?php /* tag "a" from line 525 */; ?>
<a class="accordion-btn" data-toggle="collapse" data-target="#third-font-container" data-parent="#panel-font-accordion"></a>
								</div><!-- End .accordion-header -->
								<?php /* tag "div" from line 527 */; ?>
<div class="collapse" id="third-font-container">
									<?php /* tag "select" from line 528 */; ?>
<select class="form-control" name="third-font" id="third-font">
										<?php /* tag "option" from line 529 */; ?>
<option value="PT Sans">PT Sans</option>
										<?php /* tag "option" from line 530 */; ?>
<option value="Gudea">Gudea</option>
										<?php /* tag "option" from line 531 */; ?>
<option value="Open Sans">Open Sans</option>
										<?php /* tag "option" from line 532 */; ?>
<option value="Lato">Lato</option>
										<?php /* tag "option" from line 533 */; ?>
<option value="Roboto">Roboto</option>
										<?php /* tag "option" from line 534 */; ?>
<option value="Droid Sans">Droid Sans</option>
										<?php /* tag "option" from line 535 */; ?>
<option value="Ubuntu">Ubuntu</option>
										<?php /* tag "option" from line 536 */; ?>
<option value="Arvo">Arvo</option>
										<?php /* tag "option" from line 537 */; ?>
<option value="Droid Serif">Droid Serif</option>
										<?php /* tag "option" from line 538 */; ?>
<option value="Nunito">Nunito</option>
									</select>
								</div><!-- End #third-font-container -->
							</div><!-- .panel -->
							<?php /* tag "div" from line 542 */; ?>
<div class="panel">
								<?php /* tag "div" from line 543 */; ?>
<div class="accordion-header">
									<?php /* tag "div" from line 544 */; ?>
<div class="accordion-title"><?php /* tag "span" from line 544 */; ?>
<span>Fourth Font</span></div><!-- End .accordion-title -->
									<?php /* tag "a" from line 545 */; ?>
<a class="accordion-btn" data-toggle="collapse" data-target="#fourth-font-container" data-parent="#panel-font-accordion"></a>
								</div><!-- End .accordion-header -->
								<?php /* tag "div" from line 547 */; ?>
<div class="collapse" id="fourth-font-container">
									<?php /* tag "select" from line 548 */; ?>
<select class="form-control" name="fourth-font" id="fourth-font">
										<?php /* tag "option" from line 549 */; ?>
<option value="Gudea">Gudea</option>
										<?php /* tag "option" from line 550 */; ?>
<option value="Open Sans">Open Sans</option>
										<?php /* tag "option" from line 551 */; ?>
<option value="PT Sans">PT Sans</option>
										<?php /* tag "option" from line 552 */; ?>
<option value="Lato">Lato</option>
										<?php /* tag "option" from line 553 */; ?>
<option value="Roboto">Roboto</option>
										<?php /* tag "option" from line 554 */; ?>
<option value="Droid Sans">Droid Sans</option>
										<?php /* tag "option" from line 555 */; ?>
<option value="Ubuntu">Ubuntu</option>
										<?php /* tag "option" from line 556 */; ?>
<option value="Arvo">Arvo</option>
										<?php /* tag "option" from line 557 */; ?>
<option value="Droid Serif">Droid Serif</option>
										<?php /* tag "option" from line 558 */; ?>
<option value="Nunito">Nunito</option>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div><?php 
}

 ?>
<?php 
function tpl_543e37e1_mFront__QFFtSQlAAKfcf2fV8yq2Gg_Footer(PHPTAL $_thistpl, PHPTAL $tpl) {
$tpl = clone $tpl ;
$ctx = $tpl->getContext() ;
$_translator = $tpl->getTranslator() ;
?>
<footer id="footer">
		<?php /* tag "div" from line 290 */; ?>
<div id="inner-footer">
			<?php /* tag "div" from line 291 */; ?>
<div class="container">
				<?php /* tag "div" from line 292 */; ?>
<div class="row">
					<?php /* tag "div" from line 293 */; ?>
<div class="col-md-4 col-sm-4 col-xs-12 widget">
						<?php /* tag "h3" from line 294 */; ?>
<h3>Khu Ẩm Thực Sinh Thái Hương Sen Hồng</h3>
						<?php /* tag "ul" from line 295 */; ?>
<ul class="contact-list">							
							<?php /* tag "li" from line 296 */; ?>
<li>Tiếp đón quí khách tất cả các ngày trong tuần</li>
							<?php /* tag "li" from line 297 */; ?>
<li>Giờ mở cửa: 8.00 Sáng - 22.00 Tối</li>
						</ul>
					</div>
					<?php /* tag "div" from line 300 */; ?>
<div class="col-md-5 col-sm-4 col-xs-12 widget">
						<?php /* tag "h3" from line 301 */; ?>
<h3>Trong cùng hệ thống</h3>
						<?php /* tag "ul" from line 302 */; ?>
<ul class="links">
							<?php 
/* tag "li" from line 303 */ ;
$_tmp_1 = $ctx->repeat ;
$_tmp_1->Branch = new PHPTAL_RepeatController($ctx->BranchAll)
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_1->Branch as $ctx->Branch): ;
?>
<li>
								<?php /* tag "span" from line 304 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Branch, 'getName')); ?>
</span>: <?php /* tag "span" from line 304 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Branch, 'getAddress')); ?>
</span>
							</li><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

						</ul>
					</div>					
					<?php /* tag "div" from line 308 */; ?>
<div class="col-md-3 col-sm-12 col-xs-12 widget">
						<?php /* tag "h3" from line 309 */; ?>
<h3>FACEBOOK</h3>
						<?php /* tag "div" from line 310 */; ?>
<div class="facebook-likebox">
							<?php /* tag "iframe" from line 311 */; ?>
<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fhuongsenhong&amp;width&amp;height=258&amp;colorscheme=dark&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:258px;" allowTransparency="true"></iframe>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php /* tag "div" from line 317 */; ?>
<div id="footer-bottom">
			<?php /* tag "div" from line 318 */; ?>
<div class="container">
				<?php /* tag "div" from line 319 */; ?>
<div class="row">
					<?php /* tag "div" from line 320 */; ?>
<div class="col-md-7 col-sm-7 col-xs-12 footer-social-links-container">
						<?php /* tag "ul" from line 321 */; ?>
<ul class="social-links clearfix">
							<?php /* tag "li" from line 322 */; ?>
<li><?php /* tag "a" from line 322 */; ?>
<a href="https://facebook.com/huongsenhong" class="social-icon icon-facebook"></a></li>
							<?php /* tag "li" from line 323 */; ?>
<li><?php /* tag "a" from line 323 */; ?>
<a href="/hinh-anh" class="social-icon icon-flickr"></a></li>
							<?php /* tag "li" from line 324 */; ?>
<li><?php /* tag "a" from line 324 */; ?>
<a href="/video" class="social-icon icon-delicious"></a></li>
							<?php /* tag "li" from line 325 */; ?>
<li><?php /* tag "a" from line 325 */; ?>
<a href="/lien-he" class="social-icon icon-email"></a></li>
						</ul>
					</div>
					<?php /* tag "div" from line 328 */; ?>
<div class="col-md-5 col-sm-5 col-xs-12 footer-text-container">
						<?php /* tag "p" from line 329 */; ?>
<p>&copy; 2014, SPN Soft&trade;</p>					
					</div>
				</div>
				<?php /* tag "div" from line 332 */; ?>
<div class="row">
					<?php /* tag "div" from line 333 */; ?>
<div class="footer-text-container text-center">Website duyệt tốt trên <?php /* tag "B" from line 333 */; ?>
<B>Tablet</B>, <?php /* tag "B" from line 333 */; ?>
<B>SmartPhone</B> và tốt nhất trên trình duyệt <?php /* tag "B" from line 333 */; ?>
<B>Google Chrome</B></div>
				</div>
			</div>
		</div>
		<?php /* tag "a" from line 337 */; ?>
<a href="#" id="scroll-top" title="Scroll to Top"><?php /* tag "i" from line 337 */; ?>
<i class="fa fa-angle-up"></i></a>
	</footer><?php 
}

 ?>
<?php 
function tpl_543e37e1_mFront__QFFtSQlAAKfcf2fV8yq2Gg_LastestPost(PHPTAL $_thistpl, PHPTAL $tpl) {
$tpl = clone $tpl ;
$ctx = $tpl->getContext() ;
$_translator = $tpl->getTranslator() ;
?>
<div class="widget latest-posts">
		<?php /* tag "h3" from line 261 */; ?>
<h3>Tin mới nhất</h3>
		<?php /* tag "div" from line 262 */; ?>
<div class="latest-posts-slider flexslider sidebarslider">
			<?php /* tag "ul" from line 263 */; ?>
<ul class="latest-posts-list clearfix">
				<?php 
/* tag "li" from line 264 */ ;
$_tmp_2 = $ctx->repeat ;
$_tmp_2->PT = new PHPTAL_RepeatController($ctx->LastestPostAll)
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_2->PT as $ctx->PT): ;
?>
<li>
					<?php 
/* tag "a" from line 265 */ ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->PT, 'getURLRead')))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a<?php echo $_tmp_1 ?>
>
						<?php /* tag "figure" from line 266 */; ?>
<figure class="latest-posts-media-container">
							<?php 
/* tag "img" from line 267 */ ;
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
						</figure>
					</a>
					<?php /* tag "h4" from line 270 */; ?>
<h4><?php 
/* tag "a" from line 270 */ ;
if (null !== ($_tmp_3 = ($ctx->path($ctx->PT, 'getURLRead')))):  ;
$_tmp_3 = ' href="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<a<?php echo $_tmp_3 ?>
><?php echo phptal_escape($ctx->path($ctx->PT, 'getPost/getTitle')); ?>
</a></h4>
					<?php /* tag "p" from line 271 */; ?>
<p><?php echo phptal_tostring($ctx->path($ctx->PT, 'getPost/getContentReduce')); ?>
</p>
					
					<?php /* tag "div" from line 273 */; ?>
<div class="latest-posts-meta-container clearfix">
						<?php /* tag "div" from line 274 */; ?>
<div class="pull-left">
							<?php 
/* tag "a" from line 275 */ ;
if (null !== ($_tmp_4 = ($ctx->path($ctx->PT, 'getURLRead')))):  ;
$_tmp_4 = ' href="'.phptal_escape($_tmp_4).'"' ;
else:  ;
$_tmp_4 = '' ;
endif ;
?>
<a<?php echo $_tmp_4 ?>
>Chi tiết...</a>
						</div>
						<?php /* tag "div" from line 277 */; ?>
<div class="pull-right">
							<?php /* tag "span" from line 278 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->PT, 'getPost/getTimePrint')); ?>
</span>
						</div>
					</div>
				</li><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

			</ul>
		</div>
	</div><?php 
}

 ?>
<?php 
function tpl_543e37e1_mFront__QFFtSQlAAKfcf2fV8yq2Gg_Testmonials(PHPTAL $_thistpl, PHPTAL $tpl) {
$tpl = clone $tpl ;
$ctx = $tpl->getContext() ;
$_translator = $tpl->getTranslator() ;
?>
<div class="widget testimonials">
		<?php /* tag "h3" from line 237 */; ?>
<h3>Đánh giá</h3>
		<?php /* tag "div" from line 238 */; ?>
<div class="testimonials-slider flexslider sidebarslider">
			<?php /* tag "ul" from line 239 */; ?>
<ul class="testimonials-list clearfix">
				<?php 
/* tag "li" from line 240 */ ;
$_tmp_3 = $ctx->repeat ;
$_tmp_3->StoryLine = new PHPTAL_RepeatController($ctx->StoryLineAll)
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_3->StoryLine as $ctx->StoryLine): ;
?>
<li>
					<?php /* tag "div" from line 241 */; ?>
<div class="testimonial-details">
						<?php /* tag "header" from line 242 */; ?>
<header><?php echo phptal_escape($ctx->path($ctx->StoryLine, 'getTitle')); ?>
</header>														
						<?php /* tag "span" from line 243 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->StoryLine, 'getNote')); ?>
</span>														
					</div><!-- End .testimonial-details -->
					<?php /* tag "figure" from line 245 */; ?>
<figure class="clearfix">
						<?php 
/* tag "img" from line 246 */ ;
if (null !== ($_tmp_1 = ($ctx->path($ctx->StoryLine, 'getImage')))):  ;
$_tmp_1 = ' src="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<img<?php echo $_tmp_1 ?>
/>
						<?php /* tag "figcaption" from line 247 */; ?>
<figcaption>
							<?php /* tag "a" from line 248 */; ?>
<a href="#"><?php /* tag "span" from line 248 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->StoryLine, 'getName')); ?>
</span></a>
							<?php /* tag "span" from line 249 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->StoryLine, 'getDatePrint')); ?>
</span>
						</figcaption>
					</figure>
				</li><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>
												
			</ul>
		</div>
	</div><?php 
}

 ?>
<?php 
function tpl_543e37e1_mFront__QFFtSQlAAKfcf2fV8yq2Gg_Subscribe(PHPTAL $_thistpl, PHPTAL $tpl) {
$tpl = clone $tpl ;
$ctx = $tpl->getContext() ;
$_translator = $tpl->getTranslator() ;
?>
<div class="widget subscribe">
		<?php /* tag "p" from line 224 */; ?>
<p>Nhận thông tin và các chương trình khuyến mãi hấp dẫn</p>
		<?php /* tag "form" from line 225 */; ?>
<form action="/nhan-thong-tin" id="subscribe-form" method="post">
			<?php /* tag "div" from line 226 */; ?>
<div class="form-group">
				<?php /* tag "input" from line 227 */; ?>
<input type="email" class="form-control" id="Email" name="Email" placeholder="Email của bạn là gì?"/>
			</div>
			<?php /* tag "input" from line 229 */; ?>
<input type="submit" value="ĐĂNG KÝ" class="btn btn-custom"/>
		</form>
	</div><?php 
}

 ?>
<?php 
function tpl_543e37e1_mFront__QFFtSQlAAKfcf2fV8yq2Gg_LocationBar(PHPTAL $_thistpl, PHPTAL $tpl) {
$tpl = clone $tpl ;
$ctx = $tpl->getContext() ;
$_translator = $tpl->getTranslator() ;
?>
<div id="breadcrumb-container">
		<?php /* tag "div" from line 209 */; ?>
<div class="container">
			<?php /* tag "ul" from line 210 */; ?>
<ul class="breadcrumb">
				<?php /* tag "li" from line 211 */; ?>
<li><?php /* tag "a" from line 211 */; ?>
<a href="/">TRANG CHỦ</a></li>
				<?php 
/* tag "li" from line 212 */ ;
$_tmp_2 = $ctx->repeat ;
$_tmp_2->Item = new PHPTAL_RepeatController($ctx->Navigation)
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_2->Item as $ctx->Item): ;
?>
<li> 
					<?php 
/* tag "a" from line 213 */ ;
if (null !== ($_tmp_1 = ($ctx->Item[1]))):  ;
$_tmp_1 = ' href="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a<?php echo $_tmp_1 ?>
><?php echo phptal_escape($ctx->Item[0]); ?>
</a>
				</li><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

				<?php /* tag "li" from line 215 */; ?>
<li class="active"><?php echo phptal_escape($ctx->Title); ?>
</li>
			</ul>
		</div>		
	</div><?php 
}

 ?>
<?php 
function tpl_543e37e1_mFront__QFFtSQlAAKfcf2fV8yq2Gg_Menu(PHPTAL $_thistpl, PHPTAL $tpl) {
$tpl = clone $tpl ;
$ctx = $tpl->getContext() ;
$_translator = $tpl->getTranslator() ;
?>
<div class="row-fluid">
		<?php /* tag "div" from line 174 */; ?>
<div class="span12 nav-menus">
			<?php /* tag "ul" from line 175 */; ?>
<ul class="nav nav-pills">
				<?php 
/* tag "li" from line 176 */ ;
if (null !== ($_tmp_2 = ($ctx->Active=='Home'?'active':''))):  ;
$_tmp_2 = ' class="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<li<?php echo $_tmp_2 ?>
>
					<?php /* tag "a" from line 177 */; ?>
<a href="/trang-chu">Trang chủ</a>
				</li>
				<?php 
/* tag "li" from line 179 */ ;
if (null !== ($_tmp_1 = ($ctx->Active=='Introduction'?'active':''))):  ;
$_tmp_1 = ' class="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<li<?php echo $_tmp_1 ?>
>
					<?php /* tag "a" from line 180 */; ?>
<a href="/gioi-thieu">Giới thiệu</a>
				</li>
				<?php /* tag "li" from line 182 */; ?>
<li class="dropdown">
					<?php /* tag "a" from line 183 */; ?>
<a href="#" data-toggle="dropdown" class="dropdown-toggle"> Tin tức <?php /* tag "b" from line 183 */; ?>
<b class="caret"></b></a>					
					<?php /* tag "ul" from line 184 */; ?>
<ul class="dropdown-menu">							
						<?php 
/* tag "li" from line 185 */ ;
$_tmp_3 = $ctx->repeat ;
$_tmp_3->Tag = new PHPTAL_RepeatController($ctx->TagAll)
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_3->Tag as $ctx->Tag): ;
?>
<li>
							<?php 
/* tag "a" from line 186 */ ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->Tag, 'getURLView')))):  ;
$_tmp_2 = ' href="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a<?php echo $_tmp_2 ?>
><?php echo phptal_escape($ctx->path($ctx->Tag, 'getName')); ?>
</a>
						</li><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

					</ul>					
				</li>
				<?php 
/* tag "li" from line 190 */ ;
$_tmp_1 = $ctx->repeat ;
$_tmp_1->Category = new PHPTAL_RepeatController($ctx->CategoryAll)
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_1->Category as $ctx->Category): ;
?>
<li class="dropdown">
					<?php /* tag "a" from line 191 */; ?>
<a href="#" data-toggle="dropdown" class="dropdown-toggle"> <?php /* tag "span" from line 191 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Category, 'getName')); ?>
</span> <?php /* tag "b" from line 191 */; ?>
<b class="caret"></b></a>
					<?php /* tag "ul" from line 192 */; ?>
<ul class="dropdown-menu">							
						<?php 
/* tag "li" from line 193 */ ;
$_tmp_2 = $ctx->repeat ;
$_tmp_2->Category1 = new PHPTAL_RepeatController($ctx->path($ctx->Category, 'getCategoryAll'))
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_2->Category1 as $ctx->Category1): ;
?>
<li>
							<?php 
/* tag "a" from line 194 */ ;
if (null !== ($_tmp_3 = ($ctx->path($ctx->Category1, 'getURLView')))):  ;
$_tmp_3 = ' href="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<a<?php echo $_tmp_3 ?>
><?php echo phptal_escape($ctx->path($ctx->Category1, 'getName')); ?>
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

				<?php 
/* tag "li" from line 198 */ ;
if (null !== ($_tmp_3 = ($ctx->Active=='Contact'?'active':''))):  ;
$_tmp_3 = ' class="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<li<?php echo $_tmp_3 ?>
>
					<?php /* tag "a" from line 199 */; ?>
<a href="/lien-he">Liên hệ</a>
				</li>
			</ul>
		</div>
	</div><?php 
}

 ?>
<?php 
function tpl_543e37e1_mFront__QFFtSQlAAKfcf2fV8yq2Gg_PageTitle(PHPTAL $_thistpl, PHPTAL $tpl) {
$tpl = clone $tpl ;
$ctx = $tpl->getContext() ;
$_translator = $tpl->getTranslator() ;
?>
<div class="row-fluid">
		<?php /* tag "div" from line 155 */; ?>
<div class="span12 logo">
			<?php /* tag "div" from line 156 */; ?>
<div class="row-fluid">
				<?php /* tag "div" from line 157 */; ?>
<div class="span3">
					<?php /* tag "img" from line 158 */; ?>
<img src="/mvc/templates/front/img/logo_guest.png" width="100%"/>
				</div>
				<?php /* tag "div" from line 160 */; ?>
<div class="span9">
					<?php /* tag "div" from line 161 */; ?>
<div style="margin-left:-10px;">
						<?php /* tag "h1" from line 162 */; ?>
<h1><?php /* tag "a" from line 162 */; ?>
<a href="/trang-chu"><?php echo phptal_escape($ctx->path($ctx->ConfigName, 'getValue')); ?>
</a></h1>
						<?php /* tag "p" from line 163 */; ?>
<p><?php echo phptal_escape($ctx->path($ctx->ConfigSlogan, 'getValue')); ?>
</p>
					</div>
				</div>
			</div>
		</div>
	</div><?php 
}

 ?>
<?php 
function tpl_543e37e1_mFront__QFFtSQlAAKfcf2fV8yq2Gg_Header(PHPTAL $_thistpl, PHPTAL $tpl) {
$tpl = clone $tpl ;
$ctx = $tpl->getContext() ;
$_translator = $tpl->getTranslator() ;
?>
<header id="header">
		<?php /* tag "div" from line 65 */; ?>
<div id="header-top">
			<?php /* tag "div" from line 66 */; ?>
<div class="container">
				<?php /* tag "div" from line 67 */; ?>
<div class="row">
					<?php /* tag "div" from line 68 */; ?>
<div class="col-md-12">						
						<?php /* tag "marquee" from line 69 */; ?>
<marquee scrolldelay="2" scrollamount="2" behavior="scroll" direction="left" style="padding:5px;">Khu Ẩm Thực Sinh Thái Hương Sen Hồng Đồng Tháp xin kính chào quý khách! Với các món ăn đa dạng và phong phú, chất lượng cao và giá phải chăng cùng phong cách phục vụ chuyên nghiệp, chu đáo, chúng tôi hứa hẹn sẽ là điểm đến tham quan, ăn uổng giải trí lý tưởng cho mọi gia đình</marquee>
					</div>
				</div>
			</div>
		</div>
		<?php /* tag "div" from line 74 */; ?>
<div id="inner-header">
			<?php /* tag "div" from line 75 */; ?>
<div class="container">
				<?php /* tag "div" from line 76 */; ?>
<div class="row">
					<?php /* tag "div" from line 77 */; ?>
<div class="col-md-5 col-sm-5 col-xs-12 logo-container">
						<?php /* tag "h1" from line 78 */; ?>
<h1 class="logo clearfix">
							<?php /* tag "span" from line 79 */; ?>
<span>Khu Ẩm Thực Sinh Thái Hương Sen Hồng</span>
							<?php /* tag "a" from line 80 */; ?>
<a href="/" title="Khu Ẩm Thực Sinh Thái Hương Sen Hồng"><?php /* tag "img" from line 80 */; ?>
<img src="/mvc/templates/front/images/logo.png" alt="Khu Ẩm Thực Sinh Thái Hương Sen Hồng" width="313" height="100"/></a>
						</h1>
					</div>
					<?php /* tag "div" from line 83 */; ?>
<div class="col-md-7 col-sm-7 col-xs-12 header-inner-right">
						<?php /* tag "div" from line 84 */; ?>
<div class="header-box contact-infos pull-right">
							<?php /* tag "ul" from line 85 */; ?>
<ul>
								<?php /* tag "li" from line 86 */; ?>
<li><?php /* tag "span" from line 86 */; ?>
<span class="header-box-icon header-box-icon-email"></span><?php /* tag "h4" from line 86 */; ?>
<h4><?php echo phptal_escape($ctx->path($ctx->ConfigGmail, 'getValue')); ?>
</h4></li>
								<?php /* tag "li" from line 87 */; ?>
<li><?php /* tag "span" from line 87 */; ?>
<span class="header-box-icon header-box-icon-skype"></span><?php /* tag "h4" from line 87 */; ?>
<h4><?php echo phptal_escape($ctx->path($ctx->ConfigSkype, 'getValue')); ?>
</h4></li>
							</ul>
						</div>
						<?php /* tag "div" from line 90 */; ?>
<div class="header-box contact-phones pull-right clearfix">
							<?php /* tag "span" from line 91 */; ?>
<span class="header-box-icon header-box-icon-earphones"></span>
							<?php /* tag "ul" from line 92 */; ?>
<ul class="pull-left">
								<?php /* tag "li" from line 93 */; ?>
<li><?php /* tag "h4" from line 93 */; ?>
<h4><?php echo phptal_escape($ctx->path($ctx->ConfigPhone1, 'getValue')); ?>
</h4></li>
								<?php /* tag "li" from line 94 */; ?>
<li><?php /* tag "h4" from line 94 */; ?>
<h4><?php echo phptal_escape($ctx->path($ctx->ConfigPhone2, 'getValue')); ?>
</h4></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<?php /* tag "div" from line 100 */; ?>
<div id="main-nav-container">
				<?php /* tag "div" from line 101 */; ?>
<div class="container">
					<?php /* tag "div" from line 102 */; ?>
<div class="row">
						<?php /* tag "div" from line 103 */; ?>
<div class="col-md-12 clearfix">
							<?php /* tag "nav" from line 104 */; ?>
<nav id="main-nav">
								<?php /* tag "div" from line 105 */; ?>
<div id="responsive-nav">
									<?php /* tag "div" from line 106 */; ?>
<div id="responsive-nav-button">
										Menu <?php /* tag "span" from line 107 */; ?>
<span id="responsive-nav-button-icon"></span>
									</div>
								</div>
								<?php /* tag "ul" from line 110 */; ?>
<ul class="menu clearfix">
									<?php /* tag "li" from line 111 */; ?>
<li><?php 
/* tag "a" from line 111 */ ;
if (null !== ($_tmp_1 = ($ctx->Active=='Home'?'active':'?'))):  ;
$_tmp_1 = ' class="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a href="/trang-chu"<?php echo $_tmp_1 ?>
>TRANG CHỦ</a></li>
									<?php /* tag "li" from line 112 */; ?>
<li><?php 
/* tag "a" from line 112 */ ;
if (null !== ($_tmp_1 = ($ctx->Active=='Introduction'?'active':'?'))):  ;
$_tmp_1 = ' class="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a href="/gioi-thieu"<?php echo $_tmp_1 ?>
>GIỚI THIỆU</a></li>
									<?php /* tag "li" from line 113 */; ?>
<li>
										<?php 
/* tag "a" from line 114 */ ;
if (null !== ($_tmp_1 = ($ctx->Active=='News'?'active':'?'))):  ;
$_tmp_1 = ' class="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a href="JavaScript:;"<?php echo $_tmp_1 ?>
>TIN TỨC</a>
										<?php /* tag "ul" from line 115 */; ?>
<ul>
											<?php 
/* tag "li" from line 116 */ ;
$_tmp_1 = $ctx->repeat ;
$_tmp_1->Tag = new PHPTAL_RepeatController($ctx->TagAll)
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_1->Tag as $ctx->Tag): ;
?>
<li>
												<?php 
/* tag "a" from line 117 */ ;
if (null !== ($_tmp_2 = ($ctx->path($ctx->Tag, 'getURLView')))):  ;
$_tmp_2 = ' href="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a<?php echo $_tmp_2 ?>
>
													<?php /* tag "span" from line 118 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Tag, 'getName')); ?>
</span>
												</a>
											</li><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

										</ul>
									</li>
									<?php /* tag "li" from line 123 */; ?>
<li class="mega-menu-container">
										<?php 
/* tag "a" from line 124 */ ;
if (null !== ($_tmp_2 = ($ctx->Active=='Menu'?'active':'?'))):  ;
$_tmp_2 = ' class="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a href="JavaScript:;"<?php echo $_tmp_2 ?>
>THỰC ĐƠN</a>
										<?php /* tag "div" from line 125 */; ?>
<div class="mega-menu clearfix">
											<?php 
/* tag "div" from line 126 */ ;
$_tmp_1 = $ctx->repeat ;
$_tmp_1->Category = new PHPTAL_RepeatController($ctx->CategoryAll)
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_1->Category as $ctx->Category): ;
?>
<div class="col-5">
												<?php /* tag "a" from line 127 */; ?>
<a href="JavaScript:;" class="mega-menu-title"><?php echo phptal_escape($ctx->path($ctx->Category, 'getName')); ?>
</a>
												<?php /* tag "ul" from line 128 */; ?>
<ul class="mega-menu-list clearfix">
													<?php 
/* tag "li" from line 129 */ ;
$_tmp_2 = $ctx->repeat ;
$_tmp_2->Category1 = new PHPTAL_RepeatController($ctx->path($ctx->Category, 'getCategoryAll'))
 ;
$ctx = $tpl->pushContext() ;
foreach ($_tmp_2->Category1 as $ctx->Category1): ;
?>
<li>
														<?php 
/* tag "a" from line 130 */ ;
if (null !== ($_tmp_3 = ($ctx->path($ctx->Category1, 'getURLView')))):  ;
$_tmp_3 = ' href="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<a<?php echo $_tmp_3 ?>
>
															<?php /* tag "span" from line 131 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Category1, 'getName')); ?>
</span> (<?php /* tag "span" from line 131 */; ?>
<span><?php echo phptal_escape($ctx->path($ctx->Category1, 'getProductAll/count')); ?>
</span>)
														</a>
													</li><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

												</ul>
											</div><?php 
endforeach ;
$ctx = $tpl->popContext() ;
?>

										</div>
									</li>
									<?php /* tag "li" from line 138 */; ?>
<li><?php 
/* tag "a" from line 138 */ ;
if (null !== ($_tmp_3 = ($ctx->Active=='Dealer'?'active':'?'))):  ;
$_tmp_3 = ' class="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<a href="/khuyen-mai"<?php echo $_tmp_3 ?>
>KHUYẾN MÃI</a></li>
									<?php /* tag "li" from line 139 */; ?>
<li><?php 
/* tag "a" from line 139 */ ;
if (null !== ($_tmp_2 = ($ctx->Active=='Album'?'active':'?'))):  ;
$_tmp_2 = ' class="'.phptal_escape($_tmp_2).'"' ;
else:  ;
$_tmp_2 = '' ;
endif ;
?>
<a href="/hinh-anh"<?php echo $_tmp_2 ?>
>HÌNH ẢNH</a></li>
									<?php /* tag "li" from line 140 */; ?>
<li><?php 
/* tag "a" from line 140 */ ;
if (null !== ($_tmp_1 = ($ctx->Active=='Video'?'active':'?'))):  ;
$_tmp_1 = ' class="'.phptal_escape($_tmp_1).'"' ;
else:  ;
$_tmp_1 = '' ;
endif ;
?>
<a href="/video"<?php echo $_tmp_1 ?>
>VIDEO</a></li>
									<?php /* tag "li" from line 141 */; ?>
<li><?php 
/* tag "a" from line 141 */ ;
if (null !== ($_tmp_3 = ($ctx->Active=='Contact'?'active':'?'))):  ;
$_tmp_3 = ' class="'.phptal_escape($_tmp_3).'"' ;
else:  ;
$_tmp_3 = '' ;
endif ;
?>
<a href="/lien-he"<?php echo $_tmp_3 ?>
>LIÊN HỆ</a></li>
								</ul>
							</nav>							
						</div>
					</div>
				</div>
			</div>
		</div>
	</header><?php 
}

 ?>
<?php 
function tpl_543e37e1_mFront__QFFtSQlAAKfcf2fV8yq2Gg_IncludeJS(PHPTAL $_thistpl, PHPTAL $tpl) {
$tpl = clone $tpl ;
$ctx = $tpl->getContext() ;
$_translator = $tpl->getTranslator() ;
?>
<span>						
		<?php /* tag "script" from line 40 */; ?>
<script src="/mvc/templates/front/js/jquery-1.11.0.min.js"></script>
		<?php /* tag "script" from line 41 */; ?>
<script src="/mvc/templates/front/js/bootstrap.min.js"></script>
		<?php /* tag "script" from line 42 */; ?>
<script src="/mvc/templates/front/js/smoothscroll.js"></script>
		<?php /* tag "script" from line 43 */; ?>
<script src="/mvc/templates/front/js/retina-1.1.0.min.js"></script>
		<?php /* tag "script" from line 44 */; ?>
<script src="/mvc/templates/front/js/jquery.placeholder.js"></script>
		<?php /* tag "script" from line 45 */; ?>
<script src="/mvc/templates/front/js/jquery.hoverIntent.min.js"></script>
		<?php /* tag "script" from line 46 */; ?>
<script src="/mvc/templates/front/js/twitter/jquery.tweet.min.js"></script>
		<?php /* tag "script" from line 47 */; ?>
<script src="/mvc/templates/front/js/jquery.flexslider-min.js"></script>
		<?php /* tag "script" from line 48 */; ?>
<script src="/mvc/templates/front/js/owl.carousel.min.js"></script>
		<?php /* tag "script" from line 49 */; ?>
<script src="/mvc/templates/front/js/jflickrfeed.min.js"></script>
		<?php /* tag "script" from line 50 */; ?>
<script src="/mvc/templates/front/js/jquery.prettyPhoto.js"></script>
		<?php /* tag "script" from line 51 */; ?>
<script src="/mvc/templates/front/js/jquery.sequence-min.js"></script>
		<?php /* tag "script" from line 52 */; ?>
<script src="/mvc/templates/front/js/colpick.js"></script>
		<?php /* tag "script" from line 53 */; ?>
<script src="/mvc/templates/front/js/main.js"></script>
		<?php /* tag "script" from line 54 */; ?>
<script src="/mvc/templates/front/js/modernizr.custom.js"></script>
		<?php /* tag "script" from line 55 */; ?>
<script src="/mvc/templates/front/js/jquery.isotope.min.js"></script>
		<?php /* tag "script" from line 56 */; ?>
<script src="/mvc/templates/front/js/jquery.fitvids.js"></script>
		<?php /* tag "script" from line 57 */; ?>
<script src="/mvc/templates/front/js/jquery.elastislide.js"></script>
		<?php /* tag "script" from line 58 */; ?>
<script src="/mvc/templates/front/js/jquery.mlens-1.3.min.js"></script>
	</span><?php 
}

 ?>
<?php 
function tpl_543e37e1_mFront__QFFtSQlAAKfcf2fV8yq2Gg_IncludeCSS(PHPTAL $_thistpl, PHPTAL $tpl) {
$tpl = clone $tpl ;
$ctx = $tpl->getContext() ;
$_translator = $tpl->getTranslator() ;
?>
<span>	
		<?php /* tag "link" from line 26 */; ?>
<link rel="stylesheet" href="/mvc/templates/front/css/bootstrap.min.css"/>
		<?php /* tag "link" from line 27 */; ?>
<link rel="stylesheet" href="/mvc/templates/front/css/font-awesome.min.css"/>
		<?php /* tag "link" from line 28 */; ?>
<link rel="stylesheet" href="/mvc/templates/front/css/prettyPhoto.css"/>
		<?php /* tag "link" from line 29 */; ?>
<link rel="stylesheet" href="/mvc/templates/front/css/colpick.css"/>
		<?php /* tag "link" from line 30 */; ?>
<link rel="stylesheet" href="/mvc/templates/front/css/sequence-slider.css"/>
		<?php /* tag "link" from line 31 */; ?>
<link rel="stylesheet" href="/mvc/templates/front/css/owl.carousel.css"/>
		<?php /* tag "link" from line 32 */; ?>
<link rel="stylesheet" href="/mvc/templates/front/css/style.css"/>
		<?php /* tag "link" from line 33 */; ?>
<link rel="stylesheet" href="/mvc/templates/front/css/responsive.css"/>
	</span><?php 
}

 ?>
<?php 
function tpl_543e37e1_mFront__QFFtSQlAAKfcf2fV8yq2Gg_IncludeMETA(PHPTAL $_thistpl, PHPTAL $tpl) {
$tpl = clone $tpl ;
$ctx = $tpl->getContext() ;
$_translator = $tpl->getTranslator() ;
?>
<span>
		<?php /* tag "title" from line 7 */; ?>
<title><?php echo 'Website Khu Ẩm Thực Sinh Thái Hương Sen Hồng Đồng Tháp'; ?>
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
<meta name="keywords" content="Website Khu Ẩm Thực Sinh Thái Hương Sen Hồng Đồng Tháp"/>
		<?php /* tag "meta" from line 15 */; ?>
<meta name="description" content="Website Khu Ẩm Thực Sinh Thái Hương Sen Hồng Đồng Tháp"/>
		<?php /* tag "meta" from line 16 */; ?>
<meta name="page-topic" content="Website Khu Ẩm Thực Sinh Thái Hương Sen Hồng Đồng Tháp"/>
		<?php /* tag "meta" from line 17 */; ?>
<meta name="Abstract" content="Website Khu Ẩm Thực Sinh Thái Hương Sen Hồng Đồng Tháp"/>
		<?php /* tag "meta" from line 18 */; ?>
<meta name="classification" content="Website Khu Ẩm Thực Sinh Thái Hương Sen Hồng Đồng Tháp"/>
		<?php /* tag "link" from line 19 */; ?>
<link rel="shortcut icon" type="image/png" href="/data/images/icon.ico"/>
	</span><?php 
}

 ?>
<?php 
function tpl_543e37e1_mFront__QFFtSQlAAKfcf2fV8yq2Gg(PHPTAL $tpl, PHPTAL_Context $ctx) {
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
	<?php /* tag "span" from line 39 */; ?>

	
	<!-- ======================================================================== -->
	<!-- HEADER																	  -->
	<!-- ======================================================================== -->
	<?php /* tag "header" from line 64 */; ?>

	
	<!-- ======================================================================== -->
	<!-- PAGE TITLE																  -->
	<!-- ======================================================================== -->
	<?php /* tag "div" from line 154 */; ?>

	
	<!-- ======================================================================== -->
	<!-- MENU																	  -->
	<!-- ======================================================================== -->
	<?php /* tag "div" from line 173 */; ?>

	
	<!-- ======================================================================== -->
	<!-- LOCATION BAR															  -->
	<!-- ======================================================================== -->
	<?php /* tag "div" from line 208 */; ?>

	
	<!-- ======================================================================== -->
	<!-- SUBCRIBE															  	  -->
	<!-- ======================================================================== -->
	<?php /* tag "div" from line 223 */; ?>

									
	<!-- ======================================================================== -->
	<!-- TESTMONIALS														  	  -->
	<!-- ======================================================================== -->
	<?php /* tag "div" from line 236 */; ?>

	
	<!-- ======================================================================== -->
	<!-- LASTEST POST														  	  -->
	<!-- ======================================================================== -->
	<?php /* tag "div" from line 260 */; ?>

									
	<!-- ======================================================================== -->
	<!-- FOOTER																	  -->
	<!-- ======================================================================== -->
	<?php /* tag "footer" from line 289 */; ?>

			
	<!-- ======================================================================== -->
	<!-- OPTION PANEL															  -->
	<!-- ======================================================================== -->
	<?php /* tag "div" from line 343 */; ?>

	
	<!-- ======================================================================== 	-->
	<!-- ADS SERVICE															  			-->
	<!-- ======================================================================== 	-->
	<?php /* tag "div" from line 572 */; ?>

</body>
</html><?php 
/* end */ ;

}

?>
<?php /* 
*** DO NOT EDIT THIS FILE ***

Generated by PHPTAL from G:\AppsWeb\cmsA\www.huongsenhong.com\mvc\templates\mFront.xhtml (edit that file instead) */; ?>