	<div class="the1">
		<table class="hed">
			<tr>
				<td class="logo-td<?=(strlen($additional[2].$additional[3])==0?' twologo':'')?>">
					<a class="logo" href="/"><img src="/<?=$additional[5]?>" /></a>
				</td>
				<?php if(strlen($additional[2].$additional[3])>0){ ?>
				<td class="name-td" width="*">
					<a class="name" href="/"><?=$additional[2]?></a>
					<br/>
					<a class="slogan" href="/"><?=$additional[3]?></a>
				</td>
				<?php } ?>
				<td class="telef">
					<div class="te">
						<?php $tel_cnt = explode("\r\n", $additional[4]); foreach($tel_cnt AS $tel_cnti){ ?>
						<p><?=$tel_cnti?></p>
						<?php } ?>
					</div>
					<?php if($additional[33]==0){ ?><a class="nap write-us">Сделать заявку</a><?php } ?>
					<?php if($additional[32]==0){ ?><a class="nap call-back">Заказать звонок</a><?php } ?>
				</td>
			</tr>
		</table>
		<?php
		if($additional[28]==1 && $additional[10]==1)
			include('_slider_on_main.php');
		?>
		<?php if($additional[30]==0){
		$result = mysql_query("SELECT url, menu, id, p_id FROM ".MySQLprefix."_mypages WHERE place='top' AND shows=1 AND id!=77 ORDER BY p_id ASC, sort_id ASC");
		if($result)
			while($row = mysql_fetch_assoc($result)){
				$treeid[] = $row["id"];
				$treename[] = $row["menu"];
				$treeurl[] = $row["url"];
				$treepid[] = $row["p_id"];
				$treelevel[] = 0;
			}
		$count = count($treeid);
		for($i=0; $i<$count-1; $i++){
			$g = $i;
			for($j=1; $j<$count; $j++)
				if($treepid[$j] == $treeid[$i]){
					$jid = $treeid[$j];
					$jpid = $treepid[$j];
					$jname = $treename[$j];
					$jurl = $treeurl[$j];
					$jlevel = $treelevel[$i]+1;
					$k = $j;
					while ($k>$g+1){
						$treeid[$k] = $treeid[$k-1];
						$treepid[$k] = $treepid[$k-1];
						$treename[$k] = $treename[$k-1];
						$treeurl[$k] = $treeurl[$k-1];
						$treelevel[$k] = $treelevel[$k-1];
						$k = $k - 1;
					}
					$treeid[$g+1] = $jid;
					$treepid[$g+1] = $jpid;
					$treename[$g+1] = $jname;
					$treeurl[$g+1] = $jurl;
					$treelevel[$g+1] = $jlevel;
					$g++;
				}
		}
		?>
		<div id="smoothmenu1" class="ddsmoothmenu">
			<ul class="menu">
				<?php
				for($i=0; $i<$count; $i++){
					?>
				<li>
					<a <?php if($treeurl[$i]==$urls[0] || $treeurl[$i]=='main' && $url['target_type']=='main'){ ?>class="act-m" <?php } ?>href="<?=(substr($treeurl[$i],0,4)=='http'?$treeurl[$i].'" target="_blank':($treeid[$i]==2?$cur_city[0]:'').'/'.($treeurl[$i]!='main'?$treeurl[$i].'/':''))?>"><?=$treename[$i]?></a>
					<?php
					if(isset($treelevel[$i+1]) && $treelevel[$i+1] > $treelevel[$i]){
						?>
					<ul>
						<?php
					}
					if(isset($treelevel[$i+1]) && $treelevel[$i+1] == $treelevel[$i]){
						?>
				</li>
						<?php
					}
					if(isset($treelevel[$i+1]) && $treelevel[$i+1] < $treelevel[$i]){
						?>
						</li>
						<?php
						for($m = 1; $m <= $treelevel[$i] - (isset($treelevel[$i+1])?$treelevel[$i+1]:0); $m++){
							?>
					</ul>
				</li>
							<?php
						}
					}
				}
				?>
			</ul>
		</div>
		<?php } ?>
	</div>
	<div class="the2 none"></div>
		<?php if($additional[60]==1){ ?>
		<form class="search" action="" method="get">
			<a></a>
			<input type="text" name="searchline" class="searchline" placeholder="поиск по сайту" />
		</form>
		<script type="text/javascript">
			<!--
			$(document).ready(function(){
				$('.search').submit(function(){
					$('.search a').click();
					return false;
				});
				$('.search a').click(function(){
					if($('.searchline').val().length>0)
						$.post('/admin/_check_search_ajax.php', {line: $('.searchline').val()}, function(data){
							$('.pop-up-bg').fadeIn(250,function(){
								$('.result_ajax').fadeIn(250,function(){
									$('.result_ajax2').html(data);
									$('.result_ajax').css('margin-top', '-' + ($('.result_ajax2').height()<500?$('.result_ajax2').height()/2:250) + 'px');
								});
							});
						});
				});
			});
			//-->
		</script>
		<?php } ?>