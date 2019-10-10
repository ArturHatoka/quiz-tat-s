<?php
$additional_r = mysql_query("SELECT * FROM ".MySQLprefix."_additional");
while($additional_i = mysql_fetch_assoc($additional_r))
	$additional[$additional_i['id']] = $additional_i['text'];
?>