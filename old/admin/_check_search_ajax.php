<?php
$HEVA_CMS = "3.1.5.20130222";
include("_mysql.php");
$wordTemp = explode(' ', trim($_POST['line']));
$words = array_unique($wordTemp);
$found = 0;

unset($searching);
foreach($words AS $txt)
	if(isset($txt) && is_string($txt) && strlen($txt)>0)
		$searching[] = "(`".MySQLprefix."_goods`.`name` LIKE '%".mysql_real_escape_string($txt)."%' OR `".MySQLprefix."_goods`.`desc_full` LIKE '%".mysql_real_escape_string($txt)."%')";
if(isset($searching) && is_array($searching) && count($searching)>0){
	$search = mysql_query("SELECT id, name FROM ".MySQLprefix."_goods WHERE id>0 AND (".implode(" AND ", $searching).") GROUP BY id");
	if($search && mysql_num_rows($search)>0){
		$found++;
		while($srch = mysql_fetch_assoc($search)){
			?><a href="/goods/<?=$srch['id']?>/"><?=$srch['name']?></a><?php
		}
	}
}
unset($searching);
foreach($words AS $txt)
	if(isset($txt) && is_string($txt) && strlen($txt)>0)
		$searching[] = "(`".MySQLprefix."_mypages`.`menu` LIKE '%".mysql_real_escape_string($txt)."%' OR `".MySQLprefix."_mypages`.`text` LIKE '%".mysql_real_escape_string($txt)."%')";
if(isset($searching) && is_array($searching) && count($searching)>0){
	$search = mysql_query("SELECT url, menu FROM ".MySQLprefix."_mypages WHERE id>0 AND (".implode(" AND ", $searching).") GROUP BY id");
	if($search && mysql_num_rows($search)>0){
		$found++;
		while($srch = mysql_fetch_assoc($search)){
			?><a href="/<?=$srch['url']?>/"><?=$srch['menu']?></a><?php
		}
	}
}
if($found == 0){
	?><b>Поиск не дал результатов</b><?php
}
?>