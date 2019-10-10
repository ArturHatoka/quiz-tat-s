<?php
ini_set('display_errors', 0);
session_start();
if (!$_SESSION['lginin'])
	$_SESSION['lginin'] = 2;
if ($_SESSION['random_key'])
    $_SESSION['random_key'] = "";
if ($_SESSION['editpic'])
	$_SESSION['editpic'] = 0;
include('_mysql.php');
include('checkuser.php');
$showCities = mysql_result(mysql_query("SELECT text FROM ".MySQLprefix."_additional WHERE id=41"),0);
$showOrders = mysql_result(mysql_query("SELECT text FROM ".MySQLprefix."_additional WHERE id=55"),0);
$showbrands = mysql_result(mysql_query("SELECT text FROM ".MySQLprefix."_additional WHERE id=65"),0);
$pages[0] = 'Меню';
$pages[9] = 'Вопросы';
$pages[8] = 'Настройки';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>СИСТЕМА УПРАВЛЕНИЯ САЙТОМ</title>
<?php
if(!$_GET['go']){
	if(count($_SESSION['accesss']) > 0){
		if($_SESSION['accesss'][0] == 'all')
			$go = 5;
		else
			$go = $_SESSION['accesss'][0]+3;
	}
}else{
	if(count($_SESSION['accesss']) > 0){
		if($_SESSION['accesss'][0] == 'all')
			$go = $_GET['go'];
		else{
			$accepted = 0;
			for($p = 0; $p < count($_SESSION['accesss']); $p++)
				if($_SESSION['accesss'][$p]+3 == $_GET['go'])
					$accepted = 1;
			$go = $accepted == 1 ? $_GET['go'] : $go = 5;
		}
	}else
		$go = 5;
}
if ($_POST['login'] == 'none' and $_POST['pass'] == 'none')
	$_SESSION['lginin'] = 2;
if ($_SESSION['lginin'] != 2){ ?>
	<link rel='stylesheet' type='text/css' href='css/main.css' media='all' />
	<link rel='stylesheet' type='text/css' href='css/pikaday.css' media='all' />
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="ajexfilemanager/ajex.js"></script>
	<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
	<script src="js/moment.min.js"></script>
    <script src="js/pikaday.js"></script>
<?php }else{ ?>
	<link rel='stylesheet' type='text/css' href='css/login.css' media='all' />
<?php } ?>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
</head>
<body style="background:#5EACEB url(img/sinii-fon-oboi.jpg) no-repeat 50% 50%;background-attachment:fixed;">
<?php if ($_SESSION['lginin'] != 2) { ?>
	<ul style="width:990px;padding:5px 3px 8px 3px;margin:20px auto;background:url(img/menu_bg.png) 50% 50%;height:30px;border-radius:10px;border-color:#ccc #011393 #011393 #ccc;border-width:0 1px 1px 0;">
		<?php if($_SESSION['lginin'] == 1 && ($_POST['login'] != 'none' || $_POST['pass'] != 'none')){ ?><li style="float:right;display:block;height:30px;list-style:none;"><form method='post' action='cms.php'><input type='hidden' name='login' value='none' /><input type='hidden' name='pass' value='none' /><input style="display:block;padding:3px 10px;background:#fff;border-radius:5px;color:#011393;border:0;" type='submit' value='Выйти' /></form></li><?php } ?>
		<li style="float:right;display:block;height:30px;list-style:none;"><a style="display:block;padding:5px 10px;background:#fff;border-radius:5px;color:#011393;" target="_blank" href="/">Сайт</a></li>
		<?php foreach($pages AS $key => $val){ ?>
			<?php if(in_array($key, $_SESSION['accesss'])){ ?>
		<li style="float:left;display:block;height:30px;list-style:none;"><a style="display:block;padding:5px 7px;background:#fff;border-radius:5px;color:#011393;<?php if($key+3==$go){ ?>text-decoration:none;font-weight:bold;<?php } ?>" href="cms.php?go=<?php echo $key+3; ?>"><?php echo $val; ?></a></li>
			<?php } ?>
		<?php } ?>
	</ul>
	<div style="width:980px;padding:10px;margin:0 auto;overflow:hidden;background:#fff;background:rgba(255,255,255,0.5);border-radius:10px;clear:both">
		<?php include($go.".phtml"); ?>
	</div>
	<?php
	include('_sitemap.php');
}else{
	include("login.phtml");
}
?>
</body>
</html>