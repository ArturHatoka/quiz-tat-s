<?php
$HEVA_CMS = "3.1.5.20130222";
if (ini_get('register_globals') == '1' || strtolower(ini_get('register_globals')) == 'on')
	die('Отключите register_globals в php.ini/.htaccess (угроза безопасности)');
session_start();
if (strpos($_SERVER['REQUEST_URI'], '_small.') > 0 && !file_exists("..".$_SERVER['REQUEST_URI'])){
	include("_small.php");
	die;
}
if(isset($_SESSION['user']))
	$user = $_SESSION['user'];
else{
	if (isset($_COOKIE['user']))
		$_SESSION['user'] = $user = $_COOKIE['user'];
	else{
		$_SESSION['user'] = $user = round(rand(10000000000,99999999999),0);
		setcookie("user", $user, time()+3600*24*30);
	}
}
ini_set('display_errors', 0);
include("_mysql.php");
include("_additional.php");
include("_url.php");
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6"> <![endif]-->
<!--[if IE 7 ]> <html lang="en" class="ie7"> <![endif]-->
<!--[if IE 8 ]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9 ]> <html lang="en" class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->
<head prefix="og: http://ogp.me/ns#">
	<title><?=$seo['title']?></title>
	<meta name="description" content="<?=$seo['description']?>" />
	<meta name="keywords" content="<?=$seo['keywords']?>" />
	
	<meta http-equiv="x-dns-prefetch-control" content="on"/>
	<link rel="dns-prefetch" href="/" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<meta name="language" content="ru" />
	<meta name="viewport" content="width=device-width" />
	<meta name="robots" content="index, follow" />
	
	<meta property='og:image' content='/<?=$additional[13]?>' />
	<meta property='og:title' content='<?=$seo['title']?>' />
	<meta property='og:description' content='<?=$seo['description']?>' />
	
	<link href="libs/bootstrap/css/bootstrap.min2bb2.css?v=1492073204" type="text/css" rel="stylesheet"/>
	<style  type="text/css">
		.user_form:not(.horizontal) .user_form_submit {
			-webkit-margin-before:4px;
			padding-bottom: 0
		}
		.user_form .inp {
			width: 100%;
			margin: 0;
			padding-left: 10px;
		}
		.user_form .header_text {
			-webkit-margin-after: 18px;
		}
		body,#site_wrapper1{min-width:1170px;}
	</style>
	<link href="web/build/pages/publishedcd83.css?v=1523429573" type="text/css" rel="stylesheet" />
	<link href="web/build/slick/slick1618.css?v=1523429557" type="text/css" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css?family=Open%20Sans:300normal&amp;subset=latin,cyrillic" type="text/css" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css?family=Roboto:400normal&amp;subset=latin,cyrillic" type="text/css" rel="stylesheet" />
	<link href="web/Rubik_Normal.css" type="text/css" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css?family=Open%20Sans:400normal&amp;subset=latin,cyrillic" type="text/css" rel="stylesheet" />
	<link href="modules_sty/adapter/web/css/style_view51c1.css?v=1517463386" type="text/css" rel="stylesheet" />
	<link href="web/build/pages/sites0ffd.css?v=1523429574" type="text/css" rel="stylesheet" />
	<style  id="btn-style-h-a"  type="text/css">
		form[frm-id='opros'] .wind-footer .btn-new{
			font-family: Rubik; font-weight: 400; font-style:normal;font-size:20px;color:#030303;padding:10px 35px;padding:10px 35px;background:#FFEE03;border:1px solid #FFEE03;-moz-border-radius:0;-webkit-border-radius:0;border-radius:0;
		}
		form[frm-id='opros'] .wind-footer .btn-new:hover{
			background:#FFEB3B;border-color:#FFEB3B!important;color:#030303;
		}
		form[frm-id='opros'] .wind-footer .btn-new:active{
			background:transparent;border-color:#FFEB3B!important;color:#030303;transform:scale(0.97);
		}
		div[data-id='b-opros'].blk_form .blk_form_wrap.is_popover .btn-new{
			font-family: Open Sans; font-weight: 400; font-style:normal;font-size:20px;color:#030303;padding:10px 25px;padding:10px 25px;background:#FFEE03;border:1px solid #FFEE03;-moz-border-radius:0;-webkit-border-radius:0;border-radius:0;
		}
		div[data-id='b-opros'].blk_form .blk_form_wrap.is_popover .btn-new:hover{
			background:#FFEE03;border-color:#FFEE03!important;color:#030303;
		}
		div[data-id='b-opros'].blk_form .blk_form_wrap.is_popover .btn-new:active{
			background:#FFEE03;border-color:#FFEE03!important;color:#030303;transform:scale(0.97);
		}
	</style>
	<style id="site_styles_buttons" type="text/css">
		.blk_form .blk_form_wrap.is_popover .btn-new, .user_form_submit .btn-new, .blk_button_data_wrap .btn-new {font-family: Open Sans; font-weight: 300; font-style:normal;font-size:20px;color:#fff;padding:10px 20px;padding:10px 20px;background:#2084d6;border:none;-moz-border-radius:5px;-webkit-border-radius:5px;border-radius:5px}
	</style>

	<?=$additional[6]?>

	<?=$additional[7]?>

</head>
<body class=" sprint5">
	<div id="site_wrapper1">
		<div id="sections_list">
			<div blk_class="section" class="blk_section bg_type_image sprint4 is_cover" data-par-speed="" id="d3744c68c8fa430f8ca1b8de5c9c904b" data-id="s-d3744c68c8fa430f8ca1b8de5c9c904b" bg_type="image" pos="1" style=" padding-bottom:90px;padding-top:60px;background-color:#fff">
				<div class="section_image_container">
					<div id="section_image_d3744c68c8fa430f8ca1b8de5c9c904b" class="section-image" style="background-image: url('/<?=$additional[13]?>');background-position:50% 50%;background-repeat:no-repeat;filter:none"></div>
				</div>
				<div id="section_image_svg_d3744c68c8fa430f8ca1b8de5c9c904b" class="svg_wrap section-image__svg" style="display:none"><div class="svg_container"></div></div>
				<div class="section-blackout" style="-ms-filter:'progid:DXImageTransform.Microsoft.Alpha(Opacity=0.89)'; filter:alpha(opacity=0.89); -moz-opacity:0.89; -khtml-opacity:0.89; opacity:0.89;background-color: #1F1E1E;"></div>
				<div class="mha clearfix blk_section_inner" style="width:1170px; background-position: 50% 0%;background-repeat: no-repeat;">
					<div class="section-cell tpl_cell tpl_section_cell sortable_cell l_float  " id="b932d09ed1eb4266aef72f3e760a0c52" style="width: 100%;">
						<div blk_class="blk_container" class="blk_container v3 cnt-cells-3 orange_cell_resize " id="558aceb4069b4ea7ab5ac1d67478ae11" type_id="" pos="1">
							<div class="blk_container_cells_wrap" style="margin:0 -10px">
								<div class="blk_container_cells cells-3">
									<div class="td_container_cell" cell_id="d4048d59e64b4700b8a6c86692a4342f" style="width:31.992%;padding:0 10px">
										<div class="cell v3 container_cell sortable_cell first_cell" id="d4048d59e64b4700b8a6c86692a4342f" style="border-radius:0px;padding:0px">
											<div class="blk blk_image_ext" id="735bd7467d2d427b8c68b4d36008b8cc" blk_class="blk_image_ext" type_id="21" pos="1" data-id="b-735bd7467d2d427b8c68b4d36008b8cc">
												<div class="blk-data ie_css3 clearfix">
													<div class="blk_image_data_wrap no_sel c_text" >
														<div class="img_container">
															<img style="width:121px;border-radius:0" src="/<?=$additional[5]?>" medium-style-w="121" data-quality="95" oncontextmenu="return false" ondragstart="return false" />
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="td_container_cell" cell_id="1d70b5ad718f44ef80549d0dae0fd8c9" style="width:36.014%;padding:0 10px">
										<div class="cell v3 container_cell sortable_cell" id="1d70b5ad718f44ef80549d0dae0fd8c9" style="border-radius:0px;padding:0px">
											<div class="blk blk_text blk-no-bg-lpm-449" id="335aaf9fb7fd4b2cb5f90f43660279b8"    blk_class="blk_text" type_id="1" pos="1" data-id="b-335aaf9fb7fd4b2cb5f90f43660279b8">
												<div class="blk-data ie_css3 clearfix" style="padding:0px">
													<link f_id="open_sans_light" type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300normal&amp;subset=latin,cyrillic" />
													<p style="text-align: center;">
														<span style="font-size:16px;">
															<span f_id="open_sans_light" style="font-family:open sans;font-style:normal;font-weight:300;">
																<font color="#fff" face="open sans"><?=str_replace("\r\n","<br />",$additional[2])?></font>
															</span>
														</span>
													</p>
												</div>
											</div>
											<div class="blk blk_divider " id="8844bbd2a831402ca1ef74abb8bede90" blk_class="blk_divider" type_id="11" pos="2" data-id="b-8844bbd2a831402ca1ef74abb8bede90"><div class="blk-data ie_css3 clearfix"><div class="blk_divider_self no_text no_sel " bg="#cccccc" style="margin:0 0 0 0;height:10px">&nbsp;<div style="background:#cccccc; height: 1px; margin: -0px 0 0 0" class="divider-line "></div></div></div></div>
										</div>
									</div>
									<div class="td_container_cell" cell_id="852a000c5ab54486a3fa0005fe7d82ca" style="width:31.993%;padding:0 10px">
										<div class="cell v3 container_cell sortable_cell" id="852a000c5ab54486a3fa0005fe7d82ca" style="border-radius:0px;padding:0px">
											<div class="blk blk_text blk-no-bg-lpm-449" id="50a3af0d9e78452f8b2753cd348b717e"    blk_class="blk_text" type_id="1" pos="1" data-id="b-50a3af0d9e78452f8b2753cd348b717e">
												<div class="blk-data ie_css3 clearfix" style="padding:0px">
													<link f_id="open_sans_light" type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300normal&amp;subset=latin,cyrillic" />
													<p style="text-align: right;">
														<span f_id="open_sans_light" style="font-family:open sans;font-style:normal;font-weight:300;">
															<font color="#fff" face="open sans">
																<span style="font-size: 22px;">
																	<?=str_replace("\r\n","<br />",$additional[4])?>
																</span>
															</font>
														</span>
													</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="blk blk_text blk-no-bg-lpm-449" id="d6768a1000024625af88ebf1e538bafe" blk_class="blk_text" type_id="1" pos="2" data-id="b-d6768a1000024625af88ebf1e538bafe">
							<div class="blk-data ie_css3 clearfix" style="padding:0px">
								<link f_id="open_sans_extra_bold" type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:800normal&amp;subset=latin,cyrillic" />
								<p style="text-align: center;">
									<span style="font-size:36px;">
										<span f_id="open_sans_extra_bold" style="font-family:open sans;font-style:normal;font-weight:800;">
											<span style="color:#fff;">
												<?=str_replace("\r\n","<br />",$additional[3])?>
											</span>
										</span>
									</span>
								</p>
							</div>
						</div>
						<div class="blk blk_text blk-no-bg-lpm-449" id="05fa78df6dbb42d1bc763cf1fbd431de"    blk_class="blk_text" type_id="1" pos="22" data-id="b-05fa78df6dbb42d1bc763cf1fbd431de">
							<div class="blk-data ie_css3 clearfix" style="padding:0px 0px 20px 0px">
								<p style="text-align: center;">
									<span style="font-size:20px">
										<font color="#fff" face="open sans">
											<?=str_replace("\r\n","<br />",$additional[12])?>
										</font>
									</span>
									<br />
									&nbsp;
								</p>
							</div>
						</div>
						<div class="blk blk_form  blk-no-bg blk_form_popover " id="opros" blk_class="blk_form" type_id="6" pos="23" data-id="b-opros">
							<div class="blk-data ie_css3 clearfix">
								<div class="blk_form_wrap c_text is_popover quiz-form">
									<form class="frm_lead ie_css3 user_form labels_top form_new published" id="frmopros" method="POST" action="/admin/_write-us-order.php" frm-id="opros" data-is-regulation-enabled="1" data-is-progressbar-enabled="0" data-is-steps-shown="1" data-progress-color="424242" suссess-message="Спасибо!\nВаша заявка принята.\nВ ближайшее время мы с вами свяжемся!" goal-popover="call_open" goal-submitted="call_ok" ga-category="" ga-event="" data-goto-url="" data-mes-url="1" data-send-post="0" data-post-url="" data-post-data="" data-text-sms="Ваша заявка принята!" data-allow-sms="0" style="border:1px solid rgba(204,204,204,1);">
										<input type="hidden" name="formName" value="frm_leadopros"/>
										<input type="hidden" name="field1" value="" class="frm_field1" id="frmopros__field1"/>
										<div class="wind-header no_sel">
											<div class="quiz-popup-header">
												<div class="quiz-popup-header__cell">
													<button type="button" class="quiz__nav quiz__nav_prev quiz__disabled">
														<svg x="0px" y="0px" viewBox="0 0 44 44">
															<path class="st0" d="M33.9,39.8L15,21.8L33.4,4.2c0.9-0.9,0.9-2.3,0.1-3.2C32.6,0,31.2,0,30.3,0.8L10.1,20.1c-0.5,0.4-0.7,1-0.7,1.7 s0.3,1.2,0.7,1.7l20.7,19.7c0.9,0.9,2.4,0.8,3.2-0.1C34.9,42.2,34.8,40.7,33.9,39.8z"/>
														</svg>
														<span>Назад</span>
													</button>
												</div>
												<div class="quiz-popup-header__cell quiz-nav-indicator is_active" id="quiz__steps_bar">
													<div class="quiz-nav-indicator__text">
														Шаг <span id="steps_bar">1</span> / <span id="all_steps"></span>
													</div>
												</div>
												<div class="quiz-popup-header__cell">
													<a class="wind-close">
														<div>
															<svg width="44" height="44" viewBox="0 0 44 44">
																<path id="path0_fill" fill-rule="evenodd" d="M 43.0127 43.0122C 43.7939 42.2314 43.7939 40.9648 43.0127 40.1841L 24.6279 21.7993L 43.0127 3.41455C 43.7939 2.6333 43.7939 1.36719 43.0127 0.585938C 42.2314 -0.194824 40.9658 -0.194824 40.1846 0.585938L 21.7998 18.9707L 3.41504 0.585938C 2.63379 -0.195312 1.36719 -0.195312 0.585938 0.585938C -0.195312 1.36719 -0.195312 2.6333 0.585938 3.41455L 18.9717 21.7993L 0.586914 40.1841C -0.194336 40.9653 -0.194336 42.2314 0.586914 43.0127C 1.36719 43.7935 2.63379 43.7935 3.41504 43.0127L 21.7998 24.6279L 40.1846 43.0122C 40.9648 43.7935 42.2314 43.7935 43.0127 43.0122Z"></path>
															</svg>
														</div>
													</a>
												</div>
											</div>
										</div>
										<div class="wind-body">
											<div class="body_content">
												<div class="user_form_fields_list">
													<?
													$pos = 1;
													$questions = mysql_query("SELECT * FROM ".MySQLprefix."_questions WHERE p_id='0' ORDER BY sort_id ASC");
													if ($questions && mysql_num_rows($questions)>0)
														while ($question = mysql_fetch_assoc($questions)){
															?>
													<div class="field clearfix <?=($question['qtype']==7?'fradio':'fcheckbox')?> quiz is_required" pos="<?=$pos?>" field-id="<?=$question['id']?>" type-id="<?=$question['qtype']?>" data-type="<?=($question['qtype']==7?'fradio':'fcheckbox')?>" data-cls="<?=($question['qtype']==7?'fradio':'fcheckbox')?>">
														<div class="label_wrap l_float no_sel quiz-step__header">
															<label style="color:#000;font-size:14px;font-family: arial,helvetica neue,helvetica,sans-serif;font-weight: initial;font-style:normal;margin-left:0" for="frmopros__field<?=$question['id']?>" class="quiz-step__label">
																<span class="label_txt"><?=$question['name']?></span>
																<span class="quiz-hidden">:</span><span class="ui_required quiz-hidden" title="Обязательное поле">*</span>
															</label>
														</div>
														<div class="field_wrap">
															<?
															$answers = mysql_query("SELECT * FROM ".MySQLprefix."_questions WHERE p_id='".$question['id']."' ORDER BY sort_id ASC");
															if ($answers && mysql_num_rows($answers)>0)
																while ($answer = mysql_fetch_assoc($answers)){
																	?>
															<label class="<?=($question['qtype']==7?'radio':'checkbox')?> quiz-field quiz-field__col-3 quiz-field--no-image">
																<input class="ie_css3 quiz-field__input" style="border-color:rgba(204,204,204,1);background-color:rgba(255,255,255,1);border-radius:4px;-webkit-border-radius:4px;color:#000;height:50px;font-size:14px" id="frmopros__field<?=$question['id']?><?=($question['qtype']==7?'':$answer['id'])?>" type="<?=($question['qtype']==7?'radio':'checkbox')?>" name="frmopros[field<?=$question['id']?>]<?=($question['qtype']==7?'':'[id'.$answer['id'].']')?>" value="<?=$answer['name']?>"<?=($answer['checked']==1?' checked="checked"':'')?> />
																<span class="text quiz-field__descr"><?=$answer['name']?></span>
																<span class="quiz-field__cover"></span>
															</label>
																	<?
																}
															?>
															<div style="color:rgba(119,119,119,1);" class="hint quiz-hidden empty"></div><div class="error_wrapper"><div class="error_centered"><div class="ui_error hidden" for="frmopros__field<?=$question['id']?>"></div></div></div>
														</div>
													</div>
															<?
															$pos++;
														}
													?>
													<div class="field clearfix fphone quiz is_required" pos="<?=$pos?>"  field-id="contact" type-id="4" data-type="ftextbox" data-cls="fphone">
														<div class="label_wrap l_float no_sel quiz-step__header">
															<label style="color:#000;font-size:14px;font-family: arial,helvetica neue,helvetica,sans-serif;font-weight: initial;font-style:normal;margin-left:0" for="frmopros__fieldcontact" class="quiz-step__label">
																<span class="label_txt">Укажите номер телефона<br/>для получения ответа</span>
																<span class="quiz-hidden">:</span>
																<span class="ui_required quiz-hidden" title="Обязательное поле">*</span>
															</label>
														</div>
														<div class="field_wrap">
															<input style="border-color:rgba(204,204,204,1);background-color:rgba(255,255,255,1);border-radius:4px;-webkit-border-radius:4px;color:#000;height:50px;font-size:14px" class="inp ie_css3 quiz__input-field" id="frmopros__fieldcontact"  type="text" maxlength="300" name="frmopros[fieldcontact]" required />
															<div style="color:rgba(119, 119, 119, 1);" class="hint quiz-hidden empty"></div>
															<div class="error_wrapper">
																<div class="error_centered">
																	<div class="ui_error hidden" for="frmopros__fieldcontact"></div>     
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<!--close wind-body-->
										<div class="wind-footer user_form_submit no_sel c_text" submit-align="c_text">         
											<button type="button" class="btn-new quiz__nav quiz__nav_next quiz__disabled">Вперед</button>
											<button class="btn-new ie_css3 btn-submit" type="submit" >Отправить</button>
											<div class="user_form_regulation field">
												<div class="field_wrap" style="font-family: Roboto;font-weight: 400;font-style:normal;color:rgba(170, 170, 170, 1);font-size:12px;text-align:center">
													<p>Нажимая на кнопку, вы принимаете <a style="color:rgba(197, 164, 126, 1);" href="/regulation/" target="_blank" rel="nofollow" >Положение</a> и <a style="color:rgba(197, 164, 126, 1);" href="/consent/" target="_blank" rel="nofollow" >Согласие</a> на обработку персональных данных.</p>
												</div>
											</div>
										</div>
									</form>
									<a class="btn-new ie_css3 btn-form-popover" onclick="return popoverForm(this);">Пройти тест</a>
								</div>
							</div>
						</div>
						<div class="blk blk_divider " id="0b425007123a46f5bae197ca34c1615a"    blk_class="blk_divider" type_id="11" pos="25" data-id="b-0b425007123a46f5bae197ca34c1615a"     >  <div class="blk-data ie_css3 clearfix">      <div class="blk_divider_self no_text no_sel no_divider_line" bg="#cccccc" style="margin:0 0 0 0;height:5px;">&nbsp;       <div style="background:#cccccc; height: 1px; margin: -0px 0 0 0" class="divider-line "></div>   </div></div>   </div>
						<div blk_class="blk_container" class="blk_container v3 cnt-cells-3 orange_cell_resize " id="557072bd64ad40cba8a41a0dd1f0b57f" type_id="" pos="26">
							<div class="blk_container_cells_wrap" style="margin:0 -10px">
								<div class="blk_container_cells cells-3">
									<div class="td_container_cell" cell_id="1102961e62794a638581d7df7633724d" style="width:33.333%;padding:0 10px">
										<!--cell-->
										<div class="cell v3 container_cell sortable_cell first_cell" id="1102961e62794a638581d7df7633724d" style="border-radius:0px;padding:0px">             
											<div class="blk blk_image_ext " id="6cb05e15697f44e781ea1763628fe910"    blk_class="blk_image_ext" type_id="21" pos="1" data-id="b-6cb05e15697f44e781ea1763628fe910"     >  <div class="blk-data ie_css3 clearfix">         <div class="blk_image_data_wrap no_sel c_text" >           <div class="img_container  " > <img style="width: 64px; border-radius: 0px; "  src="files/c/a/6/ca6284952c9943f51509e1e47f16fc64/-/scale/x1/-/crop/0x0x64x64/-/resize/64/-/quality/95/file.png" medium-style-w="64" data-quality="95" oncontextmenu="return false" ondragstart="return false" />              </div>        </div></div>   </div>
											<div class="blk blk_text blk-no-bg-lpm-449" id="aabdab7a9ff94a7f8a0c1bd26655bf6c"    blk_class="blk_text" type_id="1" pos="2" data-id="b-aabdab7a9ff94a7f8a0c1bd26655bf6c"     >  <div class="blk-data ie_css3 clearfix" style="padding:0px"><p style="text-align: center;"><span style="font-size:14px;"><font color="#fff" face="open sans"><?=str_replace("\r\n","<br/>",$additional[8])?></font></span></p></div>   </div>
										</div>
										<!--end-cell-->
									</div>
									<div class="td_container_cell" cell_id="7b802ccf64dc4ad3a628347cf5b1dd94" style="width:33.333%;padding:0 10px">
										<!--cell-->
										<div class="cell v3 container_cell sortable_cell" id="7b802ccf64dc4ad3a628347cf5b1dd94" style="border-radius:0px;padding:0px">
											<div class="blk blk_divider " id="3e9358fee4244a50a2728d18a462c6ec"    blk_class="blk_divider" type_id="11" pos="1" data-id="b-3e9358fee4244a50a2728d18a462c6ec">
												<div class="blk-data ie_css3 clearfix">      <div class="blk_divider_self no_text no_sel no_divider_line" bg="#cccccc" style="margin:0 0 0 0;height:30px">&nbsp;       <div style="background:#cccccc; height: 1px; margin: -0px 0 0 0" class="divider-line "></div>   </div></div>
											</div>
											<div class="blk blk_image_ext " id="b52790bf9e3045aa902a5bf53762969f"    blk_class="blk_image_ext" type_id="21" pos="12" data-id="b-b52790bf9e3045aa902a5bf53762969f"     >  <div class="blk-data ie_css3 clearfix">         <div class="blk_image_data_wrap no_sel c_text" >           <div class="img_container  " > <img style="width: 64px; border-radius: 0px; "  src="files/5/2/9/5297eed5e3116c0b557ed077723a5660/-/scale/x1/-/crop/0x0x64x64/-/resize/64/-/quality/95/file.png" medium-style-w="64" data-quality="95" oncontextmenu="return false" ondragstart="return false" />              </div>        </div></div>   </div>
											<div class="blk blk_text blk-no-bg-lpm-449" id="d7dab2e5099540a4a773867d4cf02227"    blk_class="blk_text" type_id="1" pos="13" data-id="b-d7dab2e5099540a4a773867d4cf02227"     >  <div class="blk-data ie_css3 clearfix" style="padding:0px 0px 30px 0px"><p style="text-align: center;"><font color="#fff" face="open sans"><span style="font-size: 14px;"><?=str_replace("\r\n","<br/>",$additional[9])?></span></font></p></div>   </div>
										</div>
										<!--end-cell-->
									</div>
									<div class="td_container_cell" cell_id="10bf699e38264da28e72c707a10106fd" style="width:33.333%;padding:0 10px">         <!--cell-->         <div class="cell v3 container_cell sortable_cell" id="10bf699e38264da28e72c707a10106fd" style="border-radius:0px;padding:0px">             <div class="blk blk_image_ext " id="cf77bdbb968f4299949513e73333ca3b"    blk_class="blk_image_ext" type_id="21" pos="1" data-id="b-cf77bdbb968f4299949513e73333ca3b"     >  <div class="blk-data ie_css3 clearfix">         <div class="blk_image_data_wrap no_sel c_text" >           <div class="img_container  " > <img style="width: 64px; border-radius: 0px; "  src="files/d/4/d/d4d8bba0a2aff5cbac2644058b6b163e/-/scale/x1/-/crop/0x0x64x64/-/resize/64/-/quality/95/file.png" medium-style-w="64" data-quality="95" oncontextmenu="return false" ondragstart="return false" />              </div>        </div></div>   </div><div class="blk blk_text blk-no-bg-lpm-449" id="ce7231c0de2346be9ae959efc2f0d565"    blk_class="blk_text" type_id="1" pos="2" data-id="b-ce7231c0de2346be9ae959efc2f0d565"     >  <div class="blk-data ie_css3 clearfix" style="padding:0px"><p style="text-align: center;"><span style="font-size:14px;"><font color="#fff" face="open sans"><?=str_replace("\r\n","<br/>",$additional[10])?></font></span></p></div>   </div></div>         <!--end-cell-->     </div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="trans_down">             <div class="trans_triangle_down" style="height: 40px">     <svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 100 100" preserveAspectRatio="none">         <path d="M 0 100 H 100 V 0 H 100.00 L 50 100 L 0.00 0 H 0 Z" style="fill: #fff;"></path>     </svg> </div>     </div>
			</div>
			<div blk_class="section" class="blk_section bg_type_empty     sprint4          "  data-par-speed="" id="85a96ac1ccfb4ca0827ab4cbf954cf61" data-id="s-85a96ac1ccfb4ca0827ab4cbf954cf61" bg_type="empty" pos="4" style=" padding-bottom: 30px;padding-top: 30px;background-color: #fff;">
				<div class="section_image_container">     <div id="section_image_85a96ac1ccfb4ca0827ab4cbf954cf61" class="section-image " style="     background-position: 50% 0%;    background-repeat: no-repeat;             filter: none;    "     ></div></div>
				<div id="section_image_svg_85a96ac1ccfb4ca0827ab4cbf954cf61" class="svg_wrap section-image__svg" style="display: none;">     <div class="svg_container">  </div> </div>
				<div class="mha clearfix blk_section_inner" style="width:1170px; background-position: 50% 0%;background-repeat: no-repeat;">          <div class="section-cell tpl_cell tpl_section_cell sortable_cell l_float  " id="11c83fbedfa540cf8dcc648b7f307402" style="width: 100%;"> <div class="blk blk_text blk-no-bg-lpm-449" id="ea7cbf113a6145fa9d5f30ad3daaa2ed"    blk_class="blk_text" type_id="1" pos="1" data-id="b-ea7cbf113a6145fa9d5f30ad3daaa2ed"     > <div class="blk-data ie_css3 clearfix" style="padding:0px 0px 0px 0px"><link f_id="open_sans_light" type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300normal&amp;subset=latin,cyrillic" /><p style="text-align: center;"><span style="font-size:24px;"><span f_id="open_sans_light" style="font-family:open sans;font-style:normal;font-weight:300;"><font face="open sans"><?=str_replace("\r\n","<br/>",$additional[4])?></font></span></span></p><?=$seo['text']?></div>   </div>          </div>         </div>
			</div>
			<div blk_class="section" class="blk_section bg_type_     sprint4          "  data-par-speed="" id="aaa111" data-id="s-aaa111" bg_type="" pos="9999999999">
				<div class="section_image_container">     <div id="section_image_aaa111" class="section-image " style="filter: none;    "     ></div></div>
				<div id="section_image_svg_aaa111" class="svg_wrap section-image__svg" style="display: none;">     <div class="svg_container">  </div> </div>
				<div class="mha clearfix blk_section_inner" style="width:1170px; ">
					<div class="section-cell tpl_cell tpl_section_cell sortable_cell l_float  " id="one" style="width: 100%;"> 
						<div id="sign_cont">
							<?=$additional[15]?>
						</div>
					</div>
					<?=$additional[14]?>
				</div>
			</div>
		</div>
		<div id="popup_list"></div>
	</div>
	<div id="wind_container" style="display:none;">
		<div class="wind hidden popover-form" id="formPopover" tabindex="-1"></div>
		<div class="wind hidden" id="btnPopupWnd" tabindex="-1" style="width: 600px"><div class="wind-header"> <a class="wind-close" id="wc1"><div></div></a> <div class="fnt div_h3"></div></div><div class="wind-body"></div><div class="wind-footer c_text"> <button class="btn wind-btn-apply btn-small" style="padding:2px 10px">Закрыть</button></div></div>
		<div class="wind hidden iblk no_sel" id="j_lead_alert" tabindex="-1" style="width:450px" oncontextmenu="return false">
			<div class="wind_close_wrap"> <a class="wind-close">   <svg enable-background="new 0 0 512 512" id="Layer_1" version="1.1" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M284.1,256L506.2,33.9c7.8-7.8,7.8-20.3,0-28.1s-20.3-7.8-28.1,0L256,227.9L33.9,5.8  c-7.8-7.8-20.3-7.8-28.1,0s-7.8,20.3,0,28.1L227.9,256L5.8,478.1c-7.8,7.8-7.8,20.3,0,28.1c3.9,3.9,9,5.8,14,5.8s10.2-1.9,14-5.8  L256,284.1l222.1,222.1c3.9,3.9,9,5.8,14,5.8s10.2-1.9,14-5.8c7.8-7.8,7.8-20.3,0-28.1L284.1,256z"/></svg> </a></div>
			<div class="checkmark"> <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 56.693 56.693" height="75.693px" id="Layer_1" version="1.1" viewBox="0 0 56.693 56.693" width="75.693px" xml:space="preserve"><path d="M45.922,11.767c-9.709-9.707-25.443-9.705-35.15,0c-9.709,9.711-9.711,25.447-0.002,35.155  c9.707,9.709,25.447,9.711,35.156,0.002C55.633,37.219,55.629,21.476,45.922,11.767z M40.409,21.747L26.316,40.201  c-0.452,0.591-1.137,0.941-1.878,0.956h-0.005h-0.052c-0.721,0-1.398-0.314-1.858-0.863l-6.038-7.139  c-0.419-0.494-0.619-1.125-0.566-1.773c0.055-0.648,0.358-1.236,0.853-1.656c0.957-0.811,2.625-0.668,3.432,0.287l4.083,4.826  l12.253-16.047c0.762-0.996,2.411-1.221,3.412-0.458c0.517,0.395,0.849,0.967,0.935,1.612  C40.973,20.591,40.804,21.231,40.409,21.747z"/></svg></div>
			<div id="jAlertBody"></div>
			<div class="wind-footer c_text"> <a class="wind-btn-apply w10 no_sel" ondragstart="return false">OK</a></div>
		</div>
	</div>
	<script type="text/javascript">
		window.baseUrl='<?=$_SERVER['SERVER_NAME']?>';
		window.baseDomain='<?=$_SERVER['SERVER_NAME']?>';
		window.dbgMode=false;
		window.isHttps=false;
		window.siteId='0';
		window.cdnUrl='<?=$_SERVER['SERVER_NAME']?>';
	</script>
	<script src="web/build/jquery/jquery1618.js?v=1523429557" type="text/javascript"></script>
	<script src="web/build/jquery/jquery-sites1618.js?v=1523429557" type="text/javascript"></script>
	<script src="libs/bootstrap/js/bootstrap.mincadf.js?v=1447404439" type="text/javascript"></script>
	<script src="web/build/pages/publishedeb50.js?v=1523429570" type="text/javascript"></script>
	<script src="modules_sty/payment_acceptance/web/js/ymis_managerb938.js?v=1520416619" type="text/javascript"></script>
	<script src="web/build/slick/slick1618.js?v=1523429557" type="text/javascript"></script>
	<script type="text/javascript">
		FE.runOnObjectReady('sitesMan',function(){sitesMan.hasTariffDaily=false;});
	</script>
	<script src="modules_sty/pages/web/js/bg_medium_stylee0b0.js?v=1512022407" type="text/javascript"></script>
	<script src="modules_sty/adapter/web/js/adapter_manager2ecb.js?v=1521115328" type="text/javascript"></script>
	<script type="text/javascript">
		FE.runOnObjectReady('adapterManager',function(){adapterManager.MTR83 = 1;adapterManager.data = {"mobile370":{"05fa78df6dbb42d1bc763cf1fbd431de":{"padding_top":0,"padding_bottom":20},"0b425007123a46f5bae197ca34c1615a":{"blc_height":5},"335aaf9fb7fd4b2cb5f90f43660279b8":{"padding_top":0,"padding_bottom":0},"3e9358fee4244a50a2728d18a462c6ec":{"blc_height":35},"50a3af0d9e78452f8b2753cd348b717e":{"padding_top":12,"padding_bottom":40},"557072bd64ad40cba8a41a0dd1f0b57f":{"count_cell_in_row":1},"aabdab7a9ff94a7f8a0c1bd26655bf6c":{"text_align":"center","font_size":16,"padding_top":0,"padding_bottom":0},"ce7231c0de2346be9ae959efc2f0d565":{"padding_top":0,"padding_bottom":0},"d6768a1000024625af88ebf1e538bafe":{"padding_top":0,"padding_bottom":20},"d7dab2e5099540a4a773867d4cf02227":{"body":"<p style=\"text-align: inherit; font-size: inherit; line-height: normal;\"><font color=\"#fff\" face=\"open sans\"><span style=\"font-size: inherit; text-align: inherit; line-height: normal;\">\u0417\u0430\u043f\u043e\u043b\u043d\u0435\u043d\u0438\u0435 \u044d\u0442\u043e\u0433\u043e \u0442\u0435\u0441\u0442\u0430 \u0437\u0430\u0439\u043c\u0435\u0442<br \/>\u0443 \u0432\u0430\u0441 \u043d\u0435 \u0431\u043e\u043b\u044c\u0448\u0435 5 \u043c\u0438\u043d\u0443\u0442<\/span><\/font><\/p>","text_align":"center","font_size":16,"padding_top":0,"padding_bottom":35},"ea7cbf113a6145fa9d5f30ad3daaa2ed":{"padding_top":0,"padding_bottom":15},"85a96ac1ccfb4ca0827ab4cbf954cf61":{"pad_bottom":30,"pad_top":58},"1102961e62794a638581d7df7633724d":{"width":98.276},"7b802ccf64dc4ad3a628347cf5b1dd94":{"width":98.276},"10bf699e38264da28e72c707a10106fd":{"width":98.276}}};});
		FE.runOnObjectReady('adapterManager',function(){adapterManager.view_port='view';adapterManager.site_width=parseInt('1170');adapterManager.initStates({"pc":true,"mobile370":true});adapterManager.initResize([{"name":"pc","min":"0","max":"65000"},{"name":"mobile370","min":"0","max":"500"}]);});
	</script>
</body>
</html>