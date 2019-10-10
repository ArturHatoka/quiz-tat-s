<table class="footer">
    <tr>
        <td class="left-td-1">
			<?=str_replace("\r\n","<br/>",$additional[12])?>
			<?php if($additional[41]==0){ ?>
			<a href="/vsya-rossiya/"><img src="/admin/img/0.gif" /></a>
			<?php } ?>
		</td>
		<td class="left-td-2">
			<div class="te">
				<table><tr><td>
				<?php foreach($tel_cnt AS $tel_cnti){ ?>
				<p><?=$tel_cnti?></p>
				<?php } ?>
				</td></tr></table>
			</div>
		</td>
		<?php if($additional[35]==0){ ?>
		<td class="center-td-3">
			<span class="media43">
				<table><tr><td>
				<?php
				$arrts = explode("\r\n", $additional[15]);
				foreach($arrts AS $l)
					$art[] = explode(",", $l);
				$ra = round(rand(0,count($arrts)-1),0);
				?>
				<a href="<?=$art[$ra][1]?>"><?=$art[$ra][0]?></a>
				</td></tr></table>
			</span>
		</td>
		<?php } ?>
		<td class="center-td-4">
			<!--noindex-->
			<?=$additional[14]?>
			<!--/noindex-->
		</td>
	</tr>      
</table>