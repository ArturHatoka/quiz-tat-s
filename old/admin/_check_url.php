<?php
include("_mysql.php");
if(strlen($_POST['newurl'])>0 && mysql_result(mysql_query("SELECT count(*) FROM ".MySQLprefix."_urls WHERE ".($_POST['edit']>0?"(target_id!='".$_POST['edit']."' AND target_id!='0') AND ":"")."url='".$_POST['newurl']."'"), 0)==0 && mysql_result(mysql_query("SELECT count(*) FROM ".MySQLprefix."_cities WHERE ".($_POST['city']>0?"(id!='".$_POST['city']."') AND ":"")."url='".$_POST['newurl']."'"), 0)==0)
	echo '0';
else
	echo '1';
?>