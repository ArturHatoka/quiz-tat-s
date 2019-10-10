<?php
if ($_POST['login'] && $_POST['pass']){
	$res1 = mysql_query("SELECT * FROM ".MySQLprefix."_admins WHERE login='".$_POST['login']."'");
	if (mysql_num_rows($res1) == 1){
		$row = mysql_fetch_assoc($res1);
		if ($row['password'] == md5($_POST['pass'])){
			$_SESSION['lginin'] = 1;
			$_SESSION['accesss'] = explode("|", $row['last_name']);
			$_SESSION['u_id'] = $row['id'];
		}
	}
}
?>