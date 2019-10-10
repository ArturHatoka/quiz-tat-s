<?php
include("_mysql.php");
include("_additional.php");
$headers  = 'MIME-Version: 1.0'."\r\n".'Content-type: text/html; charset=utf-8'."\r\n".'From: '.$additional[2].' <noreplay@'.$_SERVER['SERVER_NAME'].'>'."\r\n";
mysql_query("INSERT INTO ".MySQLprefix."_faq (name, question, st) VALUES ('".$_POST['name']."', '".$_POST['text']."', 0)");
mail($additional[11], 'Отзыв от '.$_POST['name'], '<p>'.$_POST['name'].':<br/><i>'.$_POST['text'].'</i></p>', $headers);
?>
<p style="color:green">Сообщение отправлено. Мы опубликуем его на сайте после проверки модератором.</p>