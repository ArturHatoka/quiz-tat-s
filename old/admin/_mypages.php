		<div class="wide">
			<?php include('_left.php'); ?>
			<div class="r-740<?php if($additional[29]==1){ ?> w-1024<?php } ?>">
				<?php
				$parent = $seo['p_id'];
				$tree[] = array('/'.$seo['url'], $seo['menu']);
				while($parent!=0){
					if(isset($par_data))
						unset($par_data);
					$par_r = mysql_query("SELECT url, id, menu, p_id FROM ".MySQLprefix."_mypages WHERE id='".$parent."' LIMIT 0, 1");
					if($par_r && mysql_num_rows($par_r)==1)
						$par_data = mysql_fetch_assoc($par_r);
					//$tree[] = '/<a href="/'.$par_data['url'].'/">'.$par_data['menu'].'</a>';
					$tree[] = array('/'.$par_data['url'], $par_data['menu']);
					$parent = $par_data['p_id'];
				}
				?>
				<div class="tree">
					<a href="/">Главная</a>
					<?php
					for($tn = count($tree)-1; $tn>=0; $tn--){
						?>/<a<?php if($tn>0){?> href="<?php for($tn2 = count($tree)-1; $tn2>=$tn; $tn2--){echo $tree[$tn2][0];} ?>/"<?php } ?>><?=$tree[$tn][1]?></a><?php
					}
					?>
				</div>
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
					<?php
					if($seo['id']==77){
						$cities = mysql_query("SELECT * FROM ".MySQLprefix."_cities WHERE st=1 ORDER BY name ASC");
						if($cities && mysql_num_rows($cities)>0){
							?>
					<style>
						.cities3{width:100%}
							.cities3 td{width:25%}
								.cities3 a:hover{text-decoration:none}
					</style>
					<table class="cities3">
						<tr>
							<td style="vertical-align:top">
							<?php
							while($city = mysql_fetch_assoc($cities))
								$citi[mb_substr($city['name'], 0, 1, 'UTF-8')][] = '<a style="line-height:20px" href="/'.$city['url'].'/">'.$city['name'].'</a><br/>';
							$allc = 0;
							foreach($citi AS $a => $ac)
								$allc += 2 + count($ac);
							$allc += 3;
							$allc3 = ceil($allc / 4);
							$cc = 0;
							$ctd = 1;
							foreach($citi AS $a => $ac){
								$cc++;
								echo '<b style="font-size:20px">'.$a.'</b><br/>';
								foreach($ac AS $c){
									$cc++;
									echo $c;
									if($cc >= $allc3 * $ctd){
										echo '</td><td style="vertical-align:top">';
										$cc++;
										echo '<b style="font-size:20px">'.$a.'</b><br/>';
										$ctd++;
									}
								}
								$cc++;
								echo '<br/>';
							}
							?>
							</td>
						</tr>
					</table>
							<?php
						}
					}
					?>
				</div>
				<?php if(strlen($seo["logo"])>0){ ?>
				<br/>
				<br/>
				<div class="thumbs phg">
					<div class="h2">Фотогалерея</div>
					<br style="clear:both" />
					<?php
					$img = explode("|", $seo["logo"]);
					if(isset($img) && is_array($img) && count($img)>0)
						foreach($img AS $im)
							if(strlen($im)>0){
								?>
					<div class="photoalb">
						<a rel="gal" href="/<?=$im?>">
							<img src="/<?=str_replace(".","_small.",$im)?>" />
						</a><a></a>
					</div>
								<?php
							}
					?>
				</div>
				<script>
					<!--
					$(document).ready(function(){
						var s = 0;
						$('.photoalb').each(function(){
							s++;
							if(s/3-Math.floor(s/3)==0)
								$(this).after('<br style="clear:both" />');
						});
					});
					//-->
				</script>
				<?php } ?>
			</div>
		</div>