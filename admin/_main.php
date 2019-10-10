		<?php
		if($additional[28]==0 && $additional[10]==1)
			include('_slider_on_main.php');
		?>
		<div class="wide">
			<?php include('_left.php'); ?>
			<div class="r-740<?php if($additional[29]==1){ ?> w-1024<?php } ?>">
				<?php
				if($additional[10]==0)
					include('_slider_on_main.php');
				?>
				<div class="pagetext">
					<h1><?=$seo["h1"]?></h1>
					<?php
					$ar_rf = array('%%__FORMA__%%');
					$ar_to = array('
	<div class="pop-up write-us-pop" style="position:relative;left:0;top:0;margin:20px auto;z-index:1;background:#F9F9F9;box-shadow:0 0 5px #ccc;padding:20px 20px 0 20px;overflow:hidden">
		<form method="post" class="write-us-form">
			<label>Ваше имя или название организации:</label>
			<input type="text" name="name" />
			<label>Контактная информация (телефон или e-mail):</label>
			<input type="text" name="contacts" />
			<label>Текст сообщения:</label>
			<textarea name="text"></textarea>
		</form>
		<a class="submit write-us-submit">Отправить</a>
	</div>');
					?>
					<?=str_replace($ar_rf,$ar_to,$seo["text"])?>
					<script type="text/javascript" src="//yastatic.net/share/share.js" charset="utf-8"></script><div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="small" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,gplus" data-yashareTheme="counter" style="float:right;text-align:right"></div>
				</div>
				<?php if($additional[61]==1){ ?>
				<div class="pagetext">
					<h2><?=$additional[62]?></h2>
					<ul class="partners">
						<?php
						$result = mysql_query("SELECT logo, name FROM ".MySQLprefix."_partners ORDER BY id ASC");
						$pCnt = 0;
						if($result && mysql_num_rows($result)>0)
							while($good = mysql_fetch_assoc($result)){
								$pCnt++;
								?>
						<li class="<?=($pCnt>6?'none':'')?>">
							<?php
							$pic = 'admin/uploads/nophoto.png';
							$pics = explode('|', $good['logo']);
							if(is_array($pics) && count($pics)>0)
								foreach($pics AS $picc)
									if(strlen($picc)>0 && $pic == 'admin/uploads/nophoto.png')
										$pic = $picc;
							?>
							<img src="/<?=$pic?>" />
							<span><?=$good['name']?></span>
						</li>
									<?php
								}
						?>
					</ul>
					<a class="partners-all">Смотреть все</a>
					<a class="partners-none">Скрыть</a>
					<script>
						<!--
						$(document).ready(function(){
							var s = 0;
							$('.partners li').each(function(){
								s++;
								if(s/6-Math.floor(s/6)==0)
									$(this).after('<br style="clear:both" />');
							});
							$('.partners-all').click(function(){
								$('.partners li').each(function(){
									if($(this).index()>5)
										$(this).removeClass('none');
								});
								$(this).hide();
								$('.partners-none').show();
							});
							$('.partners-none').click(function(){
								$('.partners li').each(function(){
									if($(this).index()>5)
										$(this).addClass('none');
								});
								$(this).hide();
								$('.partners-all').show();
							});
						});
						//-->
					</script>
				</div>
				<?php } ?>
			</div>
		</div>